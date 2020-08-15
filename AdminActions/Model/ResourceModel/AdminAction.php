<?php

namespace Kotsios\AdminActions\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

/**
 * Class AdminAction
 * @package Kotsios\AdminActions\Model\ResourceModel
 */
class AdminAction extends AbstractDb
{
    /**
     * @inheritdoc
     */
    public function _construct()
    {
        $this->_init('kotsios_adminactions', 'id');
    }
}
