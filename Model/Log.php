<?php

declare(strict_types=1);

namespace Arthurbes\ErpOrder\Model;

use Arthurbes\ErpOrder\Api\Data\LogInterface;
use Arthurbes\ErpOrder\Api\Data\LogInterfaceFactory;
use Arthurbes\ErpOrder\Model\ResourceModel\Log as ResourceLog;
use Arthurbes\ErpOrder\Model\ResourceModel\Log\Collection;
use Magento\Framework\Api\DataObjectHelper;
use Magento\Framework\Model\Context;
use Magento\Framework\Registry;


class Log extends \Magento\Framework\Model\AbstractModel
{

    protected $_eventPrefix = 'arthurbes_erporder_log';
    protected $logDataFactory;

    protected $dataObjectHelper;


    /**
     * @param Context $context
     * @param Registry $registry
     * @param LogInterfaceFactory $logDataFactory
     * @param DataObjectHelper $dataObjectHelper
     * @param ResourceLog $resource
     * @param Collection $resourceCollection
     * @param array $data
     */
    public function __construct(
        Context $context,
        Registry $registry,
        LogInterfaceFactory $logDataFactory,
        DataObjectHelper $dataObjectHelper,
        ResourceLog $resource,
        Collection $resourceCollection,
        array $data = []
    ) {
        $this->logDataFactory = $logDataFactory;
        $this->dataObjectHelper = $dataObjectHelper;
        parent::__construct($context, $registry, $resource, $resourceCollection, $data);
    }

    /**
     * Retrieve log model with log data
     * @return LogInterface
     */
    public function getDataModel()
    {
        $logData = $this->getData();
        
        $logDataObject = $this->logDataFactory->create();
        $this->dataObjectHelper->populateWithArray(
            $logDataObject,
            $logData,
            LogInterface::class
        );
        
        return $logDataObject;
    }
}

