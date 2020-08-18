<?php

namespace Bearer\Model;

/**
 * Class DataCollectionRule
 */
class DataCollectionRule
{
    /**
     * @var string|null
     */
    private $filterHash;

    /**
     * @var array
     */
    private $params = [];

    /**
     * @var DynamicConfig|null
     */
    private $config;

    /**
     * @var string|null
     */
    private $signature;

    /**
     * @return string|null
     */
    public function getFilterHash()
    {
        return $this->filterHash;
    }

    /**
     * @param string|null $filterHash
     * @return DataCollectionRule
     */
    public function setFilterHash($filterHash)
    {
        $this->filterHash = $filterHash;
        return $this;
    }

    /**
     * @return array
     */
    public function getParams()
    {
        return $this->params;
    }

    /**
     * @param array $params
     * @return DataCollectionRule
     */
    public function setParams($params)
    {
        $this->params = $params;
        return $this;
    }

    /**
     * @return DynamicConfig|null
     */
    public function getConfig()
    {
        return $this->config;
    }

    /**
     * @param DynamicConfig|null $config
     * @return $this
     */
    public function setConfig($config)
    {
        $this->config = $config;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getSignature()
    {
        return $this->signature;
    }

    /**
     * @param string|null $signature
     * @return DataCollectionRule
     */
    public function setSignature($signature)
    {
        $this->signature = $signature;
        return $this;
    }
}
