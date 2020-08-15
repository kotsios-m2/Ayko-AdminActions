<?php

namespace Kotsios\AdminActions\Model;

use Kotsios\AdminActions\Api\Data\AdminActionInterface;
use Magento\Framework\Model\AbstractModel;

/**
 * Class AdminAction
 * @package Kotsios\AdminActions\Model
 */
class AdminAction extends AbstractModel implements AdminActionInterface
{
    protected $_eventPrefix = 'kotsios_adminactions';

    /**
     * @inheritdoc
     */
    protected function _construct()
    {
        $this->_init('Kotsios\AdminActions\Model\ResourceModel\AdminAction');
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->getData(AdminActionInterface::ADMIN_ACTION_ID);
    }

    /**
     * @inheritdoc
     */
    public function setId($id)
    {
        $this->setData(AdminActionInterface::ADMIN_ACTION_ID, $id);
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getDatetime()
    {
        return $this->getData(AdminActionInterface::ADMIN_ACTION_DATETIME);
    }

    /**
     * @inheritdoc
     */
    public function setDatetime($datetime)
    {
        $this->setData(AdminActionInterface::ADMIN_ACTION_DATETIME, $datetime);
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getAction()
    {
        return $this->getData(AdminActionInterface::ADMIN_ACTION_ACTION);
    }

    /**
     * @inheritdoc
     */
    public function setAction($action)
    {
        $this->setData(AdminActionInterface::ADMIN_ACTION_ACTION, $action);
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getEntity()
    {
        return $this->getData(AdminActionInterface::ADMIN_ACTION_ENTITY);
    }

    /**
     * @inheritdoc
     */
    public function setEntity($entity)
    {
        $this->setData(AdminActionInterface::ADMIN_ACTION_ENTITY, $entity);
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getFullActionName()
    {
        return $this->getData(AdminActionInterface::ADMIN_ACTION_FULL_ACTION_NAME);
    }

    /**
     * @inheritdoc
     */
    public function setFullActionName($fullActionName)
    {
        $this->setData(AdminActionInterface::ADMIN_ACTION_FULL_ACTION_NAME, $fullActionName);
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getUsername()
    {
        return $this->getData(AdminActionInterface::ADMIN_ACTION_USERNAME);
    }

    /**
     * @inheritdoc
     */
    public function setUsername($username)
    {
        $this->setData(AdminActionInterface::ADMIN_ACTION_USERNAME, $username);
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getIpAddress()
    {
        return $this->getData(AdminActionInterface::ADMIN_ACTION_IP_ADDRESS);
    }

    /**
     * @inheritdoc
     */
    public function setIpAddress($ipAddress)
    {
        $this->setData(AdminActionInterface::ADMIN_ACTION_IP_ADDRESS, $ipAddress);
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getRequestData()
    {
        return $this->getData(AdminActionInterface::ADMIN_ACTION_REQUEST_DATA);
    }

    /**
     * @inheritdoc
     */
    public function setRequestData($requestData)
    {
        $this->setData(AdminActionInterface::ADMIN_ACTION_REQUEST_DATA, $requestData);
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getPostData()
    {
        return $this->getData(AdminActionInterface::ADMIN_ACTION_REQUEST_DATA);
    }

    /**
     * @inheritdoc
     */
    public function setPostData($requestData)
    {
        $this->setData(AdminActionInterface::ADMIN_ACTION_POST_DATA, $post);
        return $this;
    }
}
