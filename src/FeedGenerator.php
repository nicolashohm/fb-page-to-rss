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
    protected $skipFixedPost = false;

    public function __construct(FbParser $parser)
    {
        $this->parser = $parser;
    }

    public function render()
    {
        $this->initFeed();
        $postParser = new PostParser();

        foreach ($this->parser->getPosts() as $post) {
            $postParser->setPost($post);
            if ($this->isSkipFixedPost() && $postParser->isFixed()) {
                continue;
            }
            $item = clone $this->itemPrototype;
            $item
                #->title('Post')
                ->description($postParser->getBody())
                ->url($postParser->getLink())
                ->pubDate($postParser->getTimestamp())
                ->guid($postParser->getLink(), true)
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
                ->description($this->parser->getDescription())
                ->url($this->parser->getURL())
                ->language($this->parser->getLocale())
                ->copyright($this->parser->getCopyright())
                ->pubDate(time())
                ->lastBuildDate(time())
                #->ttl(60)
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
     * @return $this
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
     * @return $this
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
     * @return $this
     */
    public function setFeed(Feed $feed)
    {
        $this->feed = $feed;
        return $this;
    }

    /**
     * @return boolean
     */
    public function isSkipFixedPost()
    {
        return $this->skipFixedPost;
    }

    /**
     * @param boolean $skipFixedPost
     * @return $this
     */
    public function setSkipFixedPost($skipFixedPost)
    {
        $this->skipFixedPost = $skipFixedPost;
        return $this;
    }

}
