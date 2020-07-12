<?php

namespace Ayko\AdminActions\Api;

/**
 * Interface AdminActionRepositoryInterface
 * @package Ayko\AdminActions\Api
 */
interface AdminActionRepositoryInterface
{
    /**
     * @param $id
     * @return mixed
     */
    public function getById($id);

    /**
     * @param Data\AdminActionInterface $adminAction
     * @return mixed
     */
    public function save(Data\AdminActionInterface $adminAction);

    /**
     * @param $adminAction
     * @return mixed
     */
    public function delete($adminAction);

    /**
     * @param $entityId
     * @return mixed
     */
    public function deleteById($entityId);

    /**
     * @param \Magento\Framework\Api\SearchCriteriaInterface $criteria
     * @return mixed
     */
    public function getList(\Magento\Framework\Api\SearchCriteriaInterface $criteria);
}
