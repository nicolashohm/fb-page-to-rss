<?php
require_once 'vendor/autoload.php';

use PHPHtmlParser\Dom;

$pageId = &$argv[1];
if (empty($pageId)) {
    die('Usage `php render.php GitHub` to generate rss feed for `https://www.facebook.com/GitHub`');
}

$url = sprintf('https://www.facebook.com/%s?_fb_noscript=1', urlencode($pageId));
$dom = new Dom;
$dom->loadFromUrl($url, ['whitespaceTextNode' => false], new \FbPageToRSS\Curl());

$parser = new \FbPageToRSS\FbParser($dom);
$feedGenerator = new \FbPageToRSS\FeedGenerator($parser);
$feedGenerator->setSkipFixedPost(true);
echo $feedGenerator->render();
