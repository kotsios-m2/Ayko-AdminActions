<?php

namespace Ayko\AdminActions\Helper;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Store\Model\ScopeInterface;

/**
 * Class Config
 * @package Ayko\AdminActions\Helper
 */
class Config
{
    /**
     * @var ScopeConfigInterface
     */
    protected $_scopeConfig;

    /**
     * Config constructor.
     * @param ScopeConfigInterface $scopeConfig
     */
    public function __construct(
        ScopeConfigInterface $scopeConfig
    ) {
        $this->_scopeConfig = $scopeConfig;
    }

    /**
     * @return mixed
     */
    public function getDays()
    {
        return $this->_scopeConfig->getValue("ayko/cron/delete_older_than", ScopeInterface::SCOPE_STORE);
    }

    /**
     * @return mixed
     */
    public function getCronTime()
    {
        return $this->_scopeConfig->getValue('ayko/cron/delete_older_than', ScopeInterface::SCOPE_STORE);
    }
}
