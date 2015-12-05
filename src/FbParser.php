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

    public function getDescription()
    {
        $description = '';
        $infoIcon = $this->dom->find('i.sx_c1fe4a');
        if (count($infoIcon)) {
            $description = strip_tags($infoIcon[0]->getParent()->getParent());
        }
        return trim($description);
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
        return $this->dom->find('.userContentWrapper');
    }

    public function getCopyright()
    {
        return trim(strip_tags($this->dom->find('.rhcFooterCopyright')));
    }
}
