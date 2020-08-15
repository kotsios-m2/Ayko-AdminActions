<?php

namespace Kotsios\AdminActions\Api\Data;

/**
 * Interface AdminActionInterface
 * @package Kotsios\AdminActions\Api\Data
 */
interface AdminActionInterface
{
    const ADMIN_ACTION_ID = "id";
    const ADMIN_ACTION_DATETIME = "datetime";
    const ADMIN_ACTION_ACTION = "action";
    const ADMIN_ACTION_ENTITY = "entity";
    const ADMIN_ACTION_FULL_ACTION_NAME = "full_action_name";
    const ADMIN_ACTION_USERNAME = "username";
    const ADMIN_ACTION_IP_ADDRESS = "ip_address";
    const ADMIN_ACTION_REQUEST_DATA = "request_data";
    const ADMIN_ACTION_POST_DATA = "post_data";

    /**
     * @return string
     */
    public function getId();

    /**
     * @return mixed
     */
    public function getDatetime();

    /**
     * @return string
     */
    public function getAction();

    /**
     * @return string
     */
    public function getEntity();

    /**
     * @return string
     */
    public function getFullActionName();

    /**
     * @return string
     */
    public function getUsername();

    /**
     * @return string
     */
    public function getIpAddress();

    /**
     * @return mixed
     */
    public function getRequestData();

    /**
     * @return mixed
     */
    public function getPostData();

    /**
     * @param $id
     * @return mixed
     */
    public function setId($id);

    /**
     * @param $datetime
     * @return mixed
     */
    public function setDatetime($datetime);

    /**
     * @param $action
     * @return mixed
     */
    public function setAction($action);

    /**
     * @param $entity
     * @return mixed
     */
    public function setEntity($entity);

    /**
     * @param $fullActionName
     * @return mixed
     */
    public function setFullActionName($fullActionName);

    /**
     * @param $username
     * @return mixed
     */
    public function setUsername($username);

    /**
     * @param $ipAddress
     * @return mixed
     */
    public function setIpAddress($ipAddress);

    /**
     * @param $requestData
     * @return mixed
     */
    public function setRequestData($requestData);

    /**
     * @param $postData
     * @return mixed
     */
    public function setPostData($postData);

}
