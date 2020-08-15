<?php

namespace Kotsios\AdminActions\Cron;

use Kotsios\AdminActions\Api\AdminActionRepositoryInterface;
use Kotsios\AdminActions\Api\Data\AdminActionInterface;
use Kotsios\AdminActions\Api\Data\AdminActionSearchResultInterface;
use Kotsios\AdminActions\Helper\Config;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Psr\Log\LoggerInterface;

/**
 * Class Delete
 * @package Kotsios\AdminActions\Cron
 */
class Delete {

    /** @var LoggerInterface */
    protected $logger;

    /** @var Config */
    protected $config;

    /** @var AdminActionRepositoryInterface */
    protected $adminActionRepository;

    /** @var SearchCriteriaBuilder */
    protected $searchCriteriaBuilder;

    /**
     * Delete constructor.
     * @param LoggerInterface $logger
     */
    public function __construct(
        LoggerInterface $logger,
        Config $config,
        AdminActionRepositoryInterface $adminActionRepository,
        SearchCriteriaBuilder $searchCriteriaBuilder
    ) {
        $this->logger = $logger;
        $this->config = $config;
        $this->adminActionRepository = $adminActionRepository;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
    }

    /**
     * Get admin actions older than 'X' days and delete one by one
     */
    public function execute() {

        if ($days = $this->config->getDays()) {

            $from = strtotime('-' . $days . ' day', strtotime($to));
            $from = date('Y-m-d h:i:s', $from);

            $searchCriteria = $this->searchCriteriaBuilder->addFilter(
                'datetime',
                $from,
                'lt'
            )->create();

            foreach ($this->regionalStockAgentRepository->getList($searchCriteria)->getItems() as $adminAction) {
                $this->adminActionRepository->delete($adminAction);
            }
        }
    }
}
