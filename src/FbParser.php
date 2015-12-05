<?php

namespace FbParser;

use PHPHtmlParser\Dom;

class FbParser
{
    public function __construct(Dom $dom)
    {
        $this->dom = $dom;
    }

    public function getTitle()
    {
        return $this->dom->find('title')->innerHTML;
    }

    public function getLocale()
    {
        return $this->dom->find('#locale')->getAttribute('value');
    }

    public function getURL()
    {
        return $this->dom->find('input[name="next"]')->getAttribute('value');
    }

    public function getPosts()
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
