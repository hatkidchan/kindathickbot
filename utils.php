<?php

require_once "config.php";

function guidv4($data)
{
    assert(strlen($data) == 16);

    $data[6] = chr(ord($data[6]) & 0x0f | 0x40); // set version to 0100
    $data[8] = chr(ord($data[8]) & 0x3f | 0x80); // set bits 6-7 to 10

    return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
}

function guidv4r()
{
    return guidv4(random_bytes(16));
}

function tg_request($method, $params=[])
{
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_POST, TRUE);
    curl_setopt($curl, CURLOPT_URL, API_URL . "bot" . BOT_TOKEN . "/" . $method);
    curl_setopt($curl, CURLOPT_HEADER, FALSE);
    curl_setopt($curl, CURLOPT_HTTPHEADER, [
        "Content-Type: application/json"
    ]);
    curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($params));
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
    $result = json_decode(curl_exec($curl), TRUE);
    curl_close($curl);
    return $result;
}

function text_article($title, $content='Bruh', $description='')
{
    return [
        "id" => guidv4r(), "type" => "article",
        "title" => $title, "description" => $description,
        "input_message_content" => [
            "message_text" => $content,
            "parse_mode" => "html",
        ]
    ];
}

function voice_message($url, $title)
{
    return [
        "id" => guidv4r(), "type" => "voice",
        "voice_url" => $url, "title" => $title
    ];
}

function answer_query($query_id, $results)
{
    return tg_request("answerInlineQuery", [
        "inline_query_id" => $query_id,
        "results" => $results,
        "cache_time" => 600,
        "is_personal" => FALSE
    ]);
}

?>
