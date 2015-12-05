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
            /** @var AbstractNode $clearfix */
            $clearfix = $post->find('.clearfix')[0];
            $clearfix->getParent()->removeChild($clearfix->id());
            /** @var AbstractNode $commentable */
            $commentable = $post->find('.commentable_item')[0];
            $commentable->getParent()->removeChild($commentable->id());

        }
        return $posts;
    }

}
$dom = new Dom;
$dom->loadFromFile('fb.html');

$parser = new FbPageParser($dom);
#$parser->printUserContent();
$posts = $parser->fullPosts();
