<?php

require_once 'vendor/autoload.php';

use Goutte\Client;
$bot = new Client();
$bikroy = new Mahedimaruf\Bikroy($bot);
$city = 'dhaka';
$nextlink = $bikroy->start_page($city);

while ($nextlink) {
    echo $nextlink . "\n";
    $results = $bikroy->scrap($nextlink);
    var_dump($results['details']);
    $nextlink = $results['nextlink'];
}
