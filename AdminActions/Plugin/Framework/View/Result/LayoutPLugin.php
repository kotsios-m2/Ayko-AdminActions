<?php

namespace Ayko\AdminActions\Plugin\Framework\View\Result;

use Ayko\AdminActions\Api\Data\AdminActionInterface;
use Ayko\AdminActions\Api\AdminActionRepositoryInterface;
use Ayko\AdminActions\Helper\DataProcessor as DataProcessorHelper;
use Ayko\AdminActions\Model\AdminActionFactory;
use Magento\Backend\Model\Auth\Session as AuthSession;
use Magento\Framework\App\Request\Http;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\HTTP\PhpEnvironment\RemoteAddress;
use Magento\Framework\Stdlib\DateTime\DateTime;
use Magento\Framework\View\Result\Layout;

/**
 * Class LayoutPLugin
 * @package Ayko\AdminActions\Plugin\Framework\View\Result
 */
class LayoutPLugin
{
    /**
     * @var Http
     */
    protected $_request;

    /**
     * @var AdminActionRepositoryInterface
     */
    protected $_adminActionRepository;

    /**
     * @var DateTime
     */
    protected $_dateTime;

    /**
     * @var DataProcessorHelper
     */
    protected $_dataProcessorHelper;

    /**
     * @var AuthSession
     */
    protected $_authSession;

    /**
     * @var AdminActionFactory
     */
    protected $_adminActionFactory;

    /**
     * @var RemoteAddress
     */
    protected $_remoteAddress;

    /**
     * AfterSaveObserver constructor.
     * @param Http $request
     * @param AdminActionRepositoryInterface $adminActionRepository
     * @param DateTime $dateTime
     * @param DataProcessorHelper $dataProcessorHelper
     * @param AuthSession $authSession
     * @param AdminActionFactory $adminActionFactory
     * @param RemoteAddress $remoteAddress
     */
    public function __construct(
        Http $request,
        AdminActionRepositoryInterface $adminActionRepository,
        DateTime $dateTime,
        DataProcessorHelper $dataProcessorHelper,
        AuthSession $authSession,
        AdminActionFactory $adminActionFactory,
        RemoteAddress $remoteAddress
    ) {
        $this->_request = $request;
        $this->_adminActionRepository = $adminActionRepository;
        $this->_dateTime = $dateTime;
        $this->_authSession = $authSession;
        $this->_adminActionFactory = $adminActionFactory;
        $this->_remoteAddress = $remoteAddress;
        $this->_dataProcessorHelper = $dataProcessorHelper;
    }

    /**
     * @param Layout $subject
     * @param ResponseInterface $httpResponse
     * @return ResponseInterface[]
     */
    public function beforeRenderResult(Layout $subject, ResponseInterface $httpResponse)
    {
            $entity = $this->_dataProcessorHelper->getEntity($this->_request);

            if (!$this->_request->getPostValue() &&
                $this->_dataProcessorHelper->isInEntitiesToTrack($this->_request, $entity)) {
                $adminActionRow = [
                    AdminActionInterface::ADMIN_ACTION_DATETIME => $this->_dateTime->gmtDate(),
                    AdminActionInterface::ADMIN_ACTION_ACTION => ucfirst($this->_request->getActionName()),
                    AdminActionInterface::ADMIN_ACTION_ENTITY => ucfirst($this->_dataProcessorHelper->getEntity($this->_request)),
                    AdminActionInterface::ADMIN_ACTION_FULL_ACTION_NAME => $this->_request->getFullActionName(),
                    AdminActionInterface::ADMIN_ACTION_USERNAME => $this->_authSession->getUser()->getUsername(),
                    AdminActionInterface::ADMIN_ACTION_IP_ADDRESS => $this->_remoteAddress->getRemoteAddress(),
                    AdminActionInterface::ADMIN_ACTION_REQUEST_DATA =>
                        $this->_dataProcessorHelper->getRequestData($this->_request, $entity),
                    AdminActionInterface::ADMIN_ACTION_POST_DATA => null
                ];

                $adminAction = $this->_adminActionFactory->create();
                $adminAction->addData($adminActionRow);
                $this->_adminActionRepository->save($adminAction);
            }

        return [$httpResponse];
    }
}
