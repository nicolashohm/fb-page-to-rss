<?php

namespace FbParser;

use Suin\RSSWriter\Channel;
use Suin\RSSWriter\Feed;
use Suin\RSSWriter\Item;

/**
 * @property FbParser parser
 * @property Feed feed
 * @property Channel channel
 * @property Item $itemPrototype
 */
class FeedGenerator
{
    public function __construct(FbParser $parser)
    {
        $this->parser = $parser;
    }

    public function render()
    {
        $this->initFeed();

        foreach ($this->parser->getPosts() as $post) {
            $item = clone $this->itemPrototype;
            $item
                ->title('Post')
                ->description((string)$post)
                #->url('http://blog.example.com/2012/08/21/blog-entry/')
                #->pubDate(strtotime('Tue, 21 Aug 2012 19:50:37 +0900'))
                #->guid('http://blog.example.com/2012/08/21/blog-entry/', true)
                ->appendTo($this->channel)
            ;
        }

        return $this->feed;
    }

    protected function initFeed()
    {
        if (!isset($this->feed)) {
            $this->feed = new Feed();
        }
        if (!isset($this->channel)) {
            $this->channel = new Channel();
            $this->channel
                ->title($this->parser->getTitle())
                #->description("Channel Description")
                ->url($this->parser->getURL())
                ->language($this->parser->getLocale())
                /*->copyright('Copyright 2012, Foo Bar')
                ->pubDate(strtotime('Tue, 21 Aug 2012 19:50:37 +0900'))
                ->lastBuildDate(strtotime('Tue, 21 Aug 2012 19:50:37 +0900'))
                ->ttl(60)*/
                ->appendTo($this->feed);
        }
        if (!isset($this->itemPrototype)) {
            $this->itemPrototype = new Item();
        }
    }
    /**
     * @return Channel
     */
    public function getChannel()
    {
        return $this->channel;
    }

    /**
     * @param Channel $channel
     */
    public function setChannel(Channel $channel)
    {
        $this->channel = $channel;
        return $this;
    }

    /**
     * @return Item
     */
    public function getItemPrototype()
    {
        return $this->itemPrototype;
    }

    /**
     * @param Item $item
     */
    public function setItemPrototype(Item $item)
    {
        $this->itemPrototype = $item;
        return $this;
    }

    /**
     * @return Feed
     */
    public function getFeed()
    {
        return $this->feed;
    }

    /**
     * @param Feed $feed
     */
    public function setFeed(Feed $feed)
    {
        $this->feed = $feed;
        return $this;
    }

}
