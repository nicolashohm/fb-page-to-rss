<?php
require_once 'vendor/autoload.php';

use PHPHtmlParser\Dom;
use PHPHtmlParser\Dom\AbstractNode;

class FbPageParser {

    public function __construct(Dom $dom)
    {
        $this->dom = $dom;
    }

    public function printUserContent()
    {
        $contents = $this->dom->find('.userContent');
        foreach ($contents as $post) {
            $post = (string)$post;
            printf('%s%s',PHP_EOL, strip_tags($post));
        }
    }

    public function fullPosts()
    {
        /** @var AbstractNode[] $posts */
        $posts = $this->dom->find('.userContentWrapper');
        foreach ($posts as $post) {
            $clearfix = $post->find('.clearfix');
            $clearfix[0]->clear();
            printf('%s%s',PHP_EOL, strip_tags($post));
        }
    }

}
$dom = new Dom;
$dom->loadFromFile('fb.html');

$parser = new FbPageParser($dom);
#$parser->printUserContent();
$parser->fullPosts();
