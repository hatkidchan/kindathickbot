<?php

header("Content-type: audio/ogg");

require_once "utils.php";

$text = $_GET['q'];
$index = isset($_GET['i']) ? $_GET['i'] : array_rand($thick_variants);
$rand_key = guidv4r();

$variant = isset($thick_variants[$index])
           ? $thick_variants[$index]
           : array_rand($thick_variants);

function save_tts($string, $out_path)
{
    if(($fd = fopen($out_path, "wb")) == FALSE)
        return FALSE;
    
    $url = 'http://translate.google.com/translate_tts?';
    $url .= http_build_query(array(
        'ie' => 'UTF-8', 'client' => 'tw-ob',
        'q' => $string, 'tl' => 'en'
    ));


    $curl = curl_init();
    curl_setopt($curl, CURLOPT_FILE, $fd);
    curl_setopt($curl, CURLOPT_HEADER, 0);
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_HTTPHEADER, array(
        'User-Agent: '
        . 'Mozilla/5.0 '
        . '(X11; Linux i686; rv:60.0) '
        . 'Gecko/20100101 Firefox/60.0'
    ));
    
    curl_exec($curl);
    curl_close($curl);

}

save_tts($text, THICK_TMP . "/{$rand_key}-tts.ogg");
shell_exec("/usr/bin/env ffmpeg " . implode(' ', [
    '-loglevel', 'error',
    '-i', $variant[0],
    '-i', THICK_TMP . "/{$rand_key}-tts.ogg",
    '-i', $variant[1],
    '-filter_complex', "'concat=n=3:v=0:a=1[a]'",
    '-map', "'[a]'",
    '-ac', '1', '-strict', '-2',
    '-codec:a', 'libopus',
    '-b:a', '128k', '-vbr', 'off',
    '-ar', '24000',
    THICK_TMP . "/{$rand_key}-out.ogg"
]));

unlink(THICK_TMP . "/${rand_key}-tts.ogg");
echo file_get_contents(THICK_TMP . "/{$rand_key}-out.ogg");
unlink(THICK_TMP . "/${rand_key}-out.ogg");

?>
