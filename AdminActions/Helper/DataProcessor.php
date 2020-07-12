<?php

namespace Ayko\AdminActions\Helper;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\App\Helper\Context;
use Magento\Framework\App\Request\Http;
use Magento\Framework\Serialize\SerializerInterface;

class DataProcessor extends AbstractHelper
{
    /** @var string[] */
    const ENTITIES_TO_MONITOR = [
        'customer',
        'product',
        'category',
        'order',
        'invoice',
        'shipments',
        'creditmemo'
    ];

    /** @var SerializerInterface */
    protected $_serializer;

    public function __construct(
        Context $context,
        SerializerInterface $serializer
    ) {
        parent::__construct($context);
        $this->_serializer = $serializer;
    }

    /**
     * @param Http $request
     * @return string|null
     */
    public function getEntity(Http $request)
    {
        $routerName = $request->getRouteName();
        $controllerName = $request->getControllerName();

        return ((strpos($routerName, "catalog") !== false) || (strpos($routerName, "sales") !== false)) ?
            $controllerName : $routerName;
    }

    /**
     * @param Http $request
     * @return bool
     */
    public function isInEntitiesToTrack(Http $request, $entity = null)
    {
        if (!$entity) {
            $entity = $this->getEntity($request);
        }

        return in_array(strtolower($entity), self::ENTITIES_TO_MONITOR);
    }

    /**
     * @param Http $request
     * @param null $entity
     * @return bool|string
     */
    public function getRequestData(Http $request)
    {
        return $this->_serializer->serialize($request->getParams());
    }

    /**
     * @param Http $request
     * @param null $entity
     * @return bool|string
     */
    public function getPostData(Http $request)
    {
        return ($request->getPostValue() && !empty($request->getPostValue())) ?
            $this->_serializer->serialize($request->getPostValue()) : null;
    }
}
