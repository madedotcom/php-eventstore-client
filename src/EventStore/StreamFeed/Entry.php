<?php

namespace EventStore\StreamFeed;

/**
 * Class Entry
 * @package EventStore\StreamFeed
 */
final class Entry
{
    use HasLinks;

    /**
     * @var array
     */
    private $json;

    /**
     * @param array $json
     */
    public function __construct(array $json)
    {
       $this->json = $json;
    }

    /**
     * @return null|string
     */
    public function getEventUrl()
    {
        $alternate = $this->getLinkUrl(LinkRelation::ALTERNATE());

        return $alternate;
    }

    public function getType()
    {
        return (isset($this->json['eventType'])) ? $this->json['eventType'] : $this->json['summary'];
    }

    public function getVersion()
    {
        $parts = explode('/', $this->getEventUrl());

        return (int) array_pop($parts);
    }

    /**
     * @return array
     */
    protected function getLinks()
    {
        return $this->json['links'];
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->json['eventId'];
    }

    /**
     * @return string
     */
    public function getData()
    {
        return $this->json['data'];
    }
}
