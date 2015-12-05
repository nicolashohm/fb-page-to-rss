<?php
require_once 'vendor/autoload.php';

use PHPHtmlParser\Dom;
use Sunra\PhpSimple\HtmlDomParser;

#$dom = new Dom;
#$dom->loadFromFile('fb.html');
#$contents = $dom->find('div');
#var_dump($contents);
#var_dump($dom);

#$dom = HtmlDomParser::file_get_html('fb.html');
#$elems = $dom->find('div[data-time]');
#var_dump($elems);

#$dom = new DOMDocument();
#$dom->loadHTMLFile('fb.html');
#var_dump($dom);

$doc = file_get_contents('fb.html');
/*$doc = str_replace('<!--', '', $doc);
$doc = str_replace('-->', '', $doc);
$doc = str_replace('class="_5sem"', 'class="postContainer"', $doc);//*/
$dom = new Dom;
$dom->load($doc);
$contents = $dom->find('.userContent');
foreach ($contents as $post) {
    $post = (string)$post;
    #printf('%s%s',PHP_EOL, strip_tags($post));
}

$fullPosts = $dom->find('.userContentWrapper');
