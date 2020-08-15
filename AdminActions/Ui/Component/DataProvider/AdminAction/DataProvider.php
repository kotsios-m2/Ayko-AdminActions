<?php

namespace Kotsios\AdminActions\Ui\Component\DataProvider\AdminAction;

use Kotsios\AdminActions\Api\Data\AdminActionInterface;
use Kotsios\AdminActions\Model\ResourceModel\AdminAction\Grid\CollectionFactory;
use Magento\Ui\DataProvider\AbstractDataProvider;

class DataProvider extends AbstractDataProvider
{
    /** @var CollectionFactory */
    protected $collection;

    /** @var array */
    protected $_loadedData;

    /**
     * DataProvider constructor.
     * @param string $name
     * @param string $primaryFieldName
     * @param string $requestFieldName
     * @param CollectionFactory $collectionFactory
     * @param array $meta
     * @param array $data
     */
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $collectionFactory,
        array $meta = [],
        array $data = []
    ) {
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
        $this->collection = $collectionFactory->create();
    }

    /**
     * @return array
     */
    public function getData()
    {
        if (isset($this->_loadedData)) {
            return $this->_loadedData;
        }

        /** @var AdminActionInterface[] $items */
        $items = $this->collection->getItems();

        if ($items) {
            foreach ($items as $adminAction) {
                $adminActionData = $adminAction->getData();
                $this->_loadedData["items"][] = $adminActionData;
            }
            $this->_loadedData["totalRecords"] = count($this->_loadedData["items"]);
        }

        return $this->_loadedData;
    }
}
