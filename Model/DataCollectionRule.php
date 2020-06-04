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
    public function getFilterHash(): ?string
    {
        return $this->filterHash;
    }

    /**
     * @param string|null $filterHash
     * @return DataCollectionRule
     */
    public function setFilterHash(?string $filterHash): DataCollectionRule
    {
        $this->filterHash = $filterHash;
        return $this;
    }

    /**
     * @return array
     */
    public function getParams(): array
    {
        return $this->params;
    }

    /**
     * @param array $params
     * @return DataCollectionRule
     */
    public function setParams(array $params): DataCollectionRule
    {
        $this->params = $params;
        return $this;
    }

    /**
     * @return DynamicConfig|null
     */
    public function getConfig(): ?DynamicConfig
    {
        return $this->config;
    }

    /**
     * @param DynamicConfig|null $config
     * @return $this
     */
    public function setConfig(?DynamicConfig $config): DataCollectionRule
    {
        $this->config = $config;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getSignature(): ?string
    {
        return $this->signature;
    }

    /**
     * @param string|null $signature
     * @return DataCollectionRule
     */
    public function setSignature(?string $signature): DataCollectionRule
    {
        $this->signature = $signature;
        return $this;
    }
}
