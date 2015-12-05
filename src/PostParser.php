<?php

namespace FbParser;

use PHPHtmlParser\Dom\AbstractNode;
use PHPHtmlParser\Dom\Collection;

/**
 * @property AbstractNode post
 */
class PostParser
{
    public function getTimestamp()
    {
        return $this->post->find('.timestampContent')->getParent()->getAttribute('data-utime');
    }

    public function getLink()
    {
        $link = $this->post->find('.timestampContent')->getParent()->getParent()->getAttribute('href');
        return 'https://www.facebook.com' . $link;
    }

    public function isFixed()
    {
        /** @var Collection $collection */
        $collection = $this->post->find('i.sp_eRXu9ggaZIb');
        return $collection->count() > 0;
    }

    public function getBody()
    {
        $userContent = $this->post->find('.userContent');
        $media = $userContent->nextSibling();
        return (string)$userContent . (string)$media;
    }

    public function setPost($post)
    {
        $this->post = $post;
        return $this;
    }
}
