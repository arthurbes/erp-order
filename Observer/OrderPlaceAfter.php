<?php
declare(strict_types=1);

namespace Arthurbes\ErpOrder\Observer;

use Arthurbes\ErpOrder\Helper\Data as HelperData;
use Arthurbes\ErpOrder\Model\Connection;
use Arthurbes\ErpOrder\Model\LogFactory;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Store\Model\ScopeInterface;
use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;

class OrderPlaceAfter implements ObserverInterface
{
    protected $helperData;
    protected $connection;
    protected $logFactory;
    protected $scopeConfig;

    /**
     * @param HelperData $helperData
     * @param Connection $connection
     * @param LogFactory $logFactory
     * @param ScopeConfigInterface $scopeConfig
     */
    public function __construct(
        HelperData $helperData,
        Connection $connection,
        LogFactory $logFactory,
        ScopeConfigInterface $scopeConfig
    ) {
        $this->helperData = $helperData;
        $this->connection = $connection;
        $this->logFactory = $logFactory;
        $this->scopeConfig = $scopeConfig;
    }

    /**
     * Execute observer
     *
     * @param \Magento\Framework\Event\Observer $observer
     * @return void
     */
    public function execute(
        Observer $observer
    ) {
        $active = $this->scopeConfig->getValue('erp_order/general/active', ScopeInterface::SCOPE_STORE);

        if($active) {
            try {
                $order = $observer->getEvent()->getOrder();
                $params = $this->helperData->getData($order);
                return $this->connection->sendData($params);
            }catch (\Exception $e) {
                $log = $this->logFactory->create();
                $log->setError(1);
                $log->setMessage("Erro ao obter dados do pedido: " . $e->getMessage());
                $log->save();
            }
        }
    }
}

