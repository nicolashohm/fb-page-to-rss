<?php
require_once 'vendor/autoload.php';

use PHPHtmlParser\Dom;

$dom = new Dom;
$dom->loadFromFile('fb.html');

$parser = new \FbParser\FbParser($dom);

$feedGenerator = new \FbParser\FeedGenerator($parser);
$feedGenerator->setSkipFixedPost(true);
echo $feedGenerator->render();
