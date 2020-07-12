<?php

namespace Ayko\AdminActions\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

/**
 * Class AdminAction
 * @package Ayko\AdminActions\Model\ResourceModel
 */
class AdminAction extends AbstractDb
{
    /**
     * @inheritdoc
     */
    public function _construct()
    {
        $this->_init('ayko_adminactions', 'id');
    }
}
