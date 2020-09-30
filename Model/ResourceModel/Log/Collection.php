<?php

declare(strict_types=1);

namespace Arthurbes\ErpOrder\Model\ResourceModel\Log;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{

    /**
     * @var string
     */
    protected $_idFieldName = 'id';

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(
            \Arthurbes\ErpOrder\Model\Log::class,
            \Arthurbes\ErpOrder\Model\ResourceModel\Log::class
        );
    }
}

