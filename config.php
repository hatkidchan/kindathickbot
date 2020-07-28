<?php

// Telegram bot token
define("BOT_TOKEN", "0694201337:ISITjU5TmeORtH-_istOke9kINDAtH1ck00");

// URL of ThichAPI
define("THICK_URL", "https://example.org/thick.php");

// URL of webhook
define("WEBHOOK_URL", "https://example.org/bot.php");

// URL of Telegram API
define("API_URL", "https://api.telegram.org/");

// Path to ThickAPI temp folder
define("THICK_TMP", "/tmp");

// List of THICK sounds
// First element is start, second is end, obviously
$thick_variants = [
    ["thick/billy_kinda_thick_s.mp3", "thick/billy_kinda_thick_e.mp3", "Is is just me or this %s looking kinda.. THICC!"],
    ["thick/glasses_thick_s.mp3", "thick/glasses_thick_e.mp3", "Is is just me or those %s looking kinds THICC? I'm just sayin'"],
    ["thick/damn_boi_thick_s.mp3", "thick/damn_boi_thick_e.mp3", "Damn boi, %s looking kinda THICC!"],
];

// Response to any text message
$response_text = <<<EOF
What's up, Boners?
This freaking bot (me) can send voice messages with Dani's awesome THICC
phrases. Just use me anywhere via inline.
Also, you can use this bot only if you're wishlisted Karlson on Steam (actually no).
By the way, subscribe to <a href="https://youtube.com/danidev">Dani</a> on YouTube.

Boner, who made this shit: @hatkidchan, he is freaking dumb ass with arms from his ass, really.
EOF;
define("GENERIC_RESPONSE_TEXT", $response_text);

?>
