<?php

require_once('vendor/autoload.php');

$client = new ABAPI\Clients\AuthClient('wHChPP625nbT4lTF25JIjfutLPzPeAAN');
$ab = new ABAPI\AB($client);

var_dump($ab->list()->getList(14));