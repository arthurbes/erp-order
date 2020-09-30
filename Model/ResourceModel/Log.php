<?php
declare(strict_types=1);

namespace Arthurbes\ErpOrder\Model\ResourceModel;

class Log extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('arthurbes_erporder_log', 'id');
    }
}

