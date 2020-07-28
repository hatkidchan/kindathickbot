<?php

require_once "utils.php";

var_export(tg_request("setWebhook", [
    "url" => WEBHOOK_URL
]));

?>
