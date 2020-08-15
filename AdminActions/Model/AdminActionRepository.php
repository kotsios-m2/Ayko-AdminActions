<?php

namespace Kotsios\AdminActions\Model;

use Kotsios\AdminActions\Api\AdminActionRepositoryInterface;
use Kotsios\AdminActions\Api\Data\AdminActionInterface;
use Kotsios\AdminActions\Model\ResourceModel\AdminAction as AdminActionResource;
use Kotsios\AdminActions\Model\ResourceModel\AdminAction\Grid\CollectionFactory;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Api\SearchResultsInterfaceFactory;
use Magento\Framework\Api\SortOrder;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;

/**
 * Class AdminActionRepository
 * @package Kotsios\AdminActions\Model
 */
class AdminActionRepository implements AdminActionRepositoryInterface
{
    /** @var AdminActionFactory */
    protected $objectFactory;

    /** @var AdminActionResource */
    protected $resourceModel;

    /** @var SearchResultsInterfaceFactory */
    protected $searchResultsFactory;

    /** @var CollectionFactory */
    protected $collectionFactory;

    /**
     * AdminActionRepository constructor.
     * @param AdminActionFactory $objectFactory
     * @param AdminActionResource $resourceModel
     * @param CollectionFactory $collectionFactory
     * @param SearchResultsInterfaceFactory $searchResultsFactory
     */
    public function __construct(
        AdminActionFactory $objectFactory,
        AdminActionResource $resourceModel,
        CollectionFactory $collectionFactory,
        SearchResultsInterfaceFactory $searchResultsFactory
    ) {
        $this->objectFactory = $objectFactory;
        $this->resourceModel = $resourceModel;
        $this->collectionFactory = $collectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
    }

    /**
     * @inheritdoc
     */
    public function getById($id)
    {
        /** @var AdminAction $adminAction */
        $adminAction = $this->objectFactory->create();
        $this->resourceModel->load($adminAction, $id);
        if (!$adminAction->getId()) {
            throw new NoSuchEntityException(__('Entity with id "%1" does not exist.', $id));
        }
        return $adminAction;
    }

    /**
     * @inheritdoc
     */
    public function save(AdminActionInterface $adminAction)
    {
        try {
            $this->resourceModel->save($adminAction);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__($exception->getMessage()));
        }
        return $adminAction;
    }

    /**
     * @inheritdoc
     */
    public function delete($adminAction)
    {
        try {
            $this->resourceModel->delete($adminAction);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__($exception->getMessage()));
        }
        return true;
    }

    /**
     * @inheritdoc
     */
    public function deleteById($entityId)
    {
        try {
            $this->delete($this->getById($entityId));
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__($exception->getMessage()));
        }
    }

    /**
     * @param SearchCriteriaInterface $criteria
     * @return \Magento\Framework\Api\SearchResultsInterface|mixed
     */
    public function getList(SearchCriteriaInterface $criteria)
    {
        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($criteria);
        $collection = $this->collectionFactory->create();
        foreach ($criteria->getFilterGroups() as $filterGroup) {
            $fields = [];
            $conditions = [];
            foreach ($filterGroup->getFilters() as $filter) {
                $condition = $filter->getConditionType() ? $filter->getConditionType() : 'eq';
                $fields[] = $filter->getField();
                $conditions[] = [$condition => $filter->getValue()];
            }
            if ($fields) {
                $collection->addFieldToFilter($fields, $conditions);
            }
        }
        $searchResults->setTotalCount($collection->getSize());
        $sortOrders = $criteria->getSortOrders();
        if ($sortOrders) {
            /** @var SortOrder $sortOrder */
            foreach ($sortOrders as $sortOrder) {
                $collection->addOrder(
                    $sortOrder->getField(),
                    ($sortOrder->getDirection() == SortOrder::SORT_ASC) ? 'ASC' : 'DESC'
                );
            }
        }
        $collection->setCurPage($criteria->getCurrentPage());
        $collection->setPageSize($criteria->getPageSize());
        $objects = [];
        foreach ($collection as $objectModel) {
            $objects[] = $objectModel;
        }
        $searchResults->setItems($objects);
        return $searchResults;
    }
}
