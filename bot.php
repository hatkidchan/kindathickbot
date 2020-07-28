<?php

require_once "utils.php";
if(!($data = file_get_contents('php://input')))
{
    http_response_code(400);
    die();
}

$update = json_decode($data, TRUE);
if(isset($update['inline_query']))
{
    $query_id = $update['inline_query']['id'];
    $query_text = $update['inline_query']['query'];
    $results = [];
    if($query_text == '')
    {
        $results[] = text_article('Type something, Boner!', 'Cringe..');
    } else {
        foreach($thick_variants as $i => $something)
        {
            $results[] = voice_message(
                THICK_URL . '?' . http_build_query([
                    'q' => $query_text, 'i' => $i
                ]), $something[2]
            );
        }
    }
    answer_query($query_id, $results);
}


?>
