<?php

declare(strict_types=1);

namespace Arthurbes\ErpOrder\Model;

use Arthurbes\ErpOrder\Model\LogFactory;
use Magento\Framework\Api\DataObjectHelper;
use Magento\Framework\Model\Context;
use Magento\Framework\Registry;
use Magento\Framework\HTTP\Client\Curl;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Store\Model\ScopeInterface;
use Magento\Framework\Model\AbstractModel;


class Connection extends AbstractModel
{

    protected $curl;
    protected $logFactory;
    protected $scopeConfig;

    /**
     * @param Context $context
     * @param Registry $registry
     * @param Log $log
     * @param Curl $curl,
     * @param ScopeConfigInterface $scopeConfig
     * @param array $data
     */
    public function __construct(
        Context $context,
        Registry $registry,
        LogFactory $logFactory,
        Curl $curl,
        ScopeConfigInterface $scopeConfig,
        array $data = []
    ) {
        $this->curl = $curl;
        $this->scopeConfig = $scopeConfig;
        $this->logFactory = $logFactory;
        parent::__construct($context, $registry, null, null, $data);
    }

    /**
     * Retrieve log model with log data
     * @return LogInterface
     */
    public function sendData($params)
    {
        $apiKey = $this->scopeConfig->getValue('erp_order/general/api_key', ScopeInterface::SCOPE_STORE);
        $endpoint = $this->scopeConfig->getValue('erp_order/general/endpoint', ScopeInterface::SCOPE_STORE);

        $headers = [
            "Content-Type" => "application/json",
            "Authorization" => "Bearer " . $apiKey
        ];
        $this->curl->setHeaders($headers);

        $params = (is_array($params)) ? json_encode($params) : $params;
        $this->curl->post($endpoint, $params);
        
        $response = $this->curl->getBody();
        $status = $this->curl->getStatus();

        $log = $this->logFactory->create();

        if ($status == 200 || $status == 201) {
            $log->setError(0);
            $log->setMessage("Enviado com sucesso!");
        } else {
            $log->setError(1);
            $log->setMessage("Erro ao enviar!");
        }

        $log->save();
        
        return !$log->getError();
    }
}

