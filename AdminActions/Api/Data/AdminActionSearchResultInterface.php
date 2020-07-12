<?php

namespace Ayko\AdminActions\Api\Data;

use Magento\Framework\Api\Search\SearchResultInterface;

/**
 * Interface AdminActionSearchResultInterface
 * @package Ayko\AdminActions\Api\Data
 */
interface AdminActionSearchResultInterface extends SearchResultInterface
{
    /**
     * @return \Magento\Framework\Api\Search\DocumentInterface[]
     */
    public function getItems();

    /**
     * @param array|null $items
     * @return AdminActionSearchResultInterface
     */
    public function setItems(array $items = null);
}
