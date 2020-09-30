<?php

declare(strict_types=1);

namespace Arthurbes\ErpOrder\Helper;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\App\ObjectManager;
use Magento\Framework\App\Helper\Context;
use Magento\Customer\Api\CustomerRepositoryInterfaceFactory;
use Magento\Customer\Model\Customer;

class Data extends AbstractHelper
{
    public $customerRepository;
    public $customer;

    /**
    * @param CustomerRepositoryInterface $customerRepository
    */
    public function __construct(
        Context $context,
        CustomerRepositoryInterfaceFactory $customerRepository,
        Customer $customer
    )
    {
        $this->customerRepository = $customerRepository->create();
        $this->customer = $customer;
        parent::__construct($context);
    }

    public function getData($order) {
        $data = array(
            "customer"          => $this->getCustomerData($order),
            "shipping_address"  => $this->getShippingData($order),
            "items"             => $this->getItemsData($order),
            "shipping_method"   => $order->getShippingMethod(),
            "payment_method"    => $order->getPayment()->getMethod(),
            "subtotal"          => $order->getSubtotal(),
            "shipping_amount"   => $order->getShippingAmount(),
            "discount"          => $order->getDiscountAmount(),
            "total"             => $order->getGrandTotal(),
        );
        
        return $data;
    }

    protected function getCustomerData($order) {
        $data = array();
        
        $customer = $this->customerRepository->getById($order->getCustomerId());
        
        if(!$customer) return $data;
        
        $name[] = $customer->getFirstname();
        if($customer->getMiddlename() && trim($customer->getMiddlename()) != "") {
            $name[] = $customer->getMiddlename();
        }
        if($customer->getLastname() && trim($customer->getLastname()) != "") {
            $name[] = $customer->getLastname();
        }
        $data['name'] = implode(" ", $name);
        
        if ($typeAttr = $customer->getCustomAttribute('type')){
           $type = $typeAttr->getValue();
        } else {
            if ($cnpjAttr = $customer->getCustomAttribute('cnpj')) {
                if(trim($cnpjAttr->getValue()) != "") {
                    $data['cnpj'] = $cnpjAttr->getValue();
                    $type = "pj";
                }
            } 
            if ($cpfAttr = $customer->getCustomAttribute('cpf')) {
                if(trim($cpfAttr->getValue()) != "") {
                    $data['cpf_cnpj'] = $cpfAttr->getValue();
                    $type = "pf";
                }
            }

            if (!isset($data['cnpj']) && !isset($data['cpf'])) {
                $taxvat = preg_replace('/\D/', '', $customer->getTaxvat());
                if (strlen($taxvat) > 11) {                    
                    $data['cnpj'] = $taxvat;
                    $type = "pj";
                } else {
                    $data['cpf_cnpj'] = $taxvat;
                    $type = "pf";
                }
            }
        }

        if($type == "pj") { 
            if ($razaoSocialAttr = $customer->getCustomAttribute('razao_social')) {
                /* Não foi deixado obrigatório para não quebrar o módulo na falta do campo */
                $data['razao_social'] = $razaoSocialAttr->getValue();
            }

            if ($nomeFantasiaAttr = $customer->getCustomAttribute('nome_fantasia')) {
                /* Não foi deixado obrigatório para não quebrar o módulo na falta do campo */
                $data['nome_fantasia'] = $nomeFantasiaAttr->getValue();
            }

            if ($ieAttr = $customer->getCustomAttribute('ie')) {
                $data['ie'] = $ieAttr->getValue();
            }
        } else {
            if ($customer->getDob()) {
                try{
                    if($customer->getDob() && trim($customer->getDob()) != "") {
                        $dobDT = new \DateTime();
                        $dobDT->setTimestamp(strtotime($customer->getDob()));
                        $data['dob'] = $dobDT->format("d/m/Y");
                    } else {
                        $data['dob'] = $customer->getDob();
                    }
                } catch (\Exception $e) {
                    $data['dob'] = $customer->getDob();
                }
            }
        }

        return $data;
    }

    protected function getShippingData($order) {
        $data = array();
        $shipping = $order->getShippingAddress();
        $street = $shipping->getStreet();
        $data["street"] = $street[0];
        $data["number"] = $street[1];

        if (isset($street[2])) {
            $data["additional"] = $street[2];
        }

        if (isset($street[3])) {
            $data["neighborhood"] = $street[3];
        }

        $data["city"] = $shipping->getCity();

        if ($shipping->getCityIbgeCode()) {
            $data["city_ibge_code"] = $shipping->getCityIbgeCode();
        }

        $data["uf"] = $shipping->getRegion();
        $data["country"] = $shipping->getCountryId();

        return $data;
    }

    protected function getItemsData($order) {
        $items = array();
        
        foreach ($order->getAllVisibleItems() as $item) {
            $items[] = array(
                "sku"   => $item->getSku(),
                "name"  => $item->getName(),
                "price" => $item->getPrice(),
                "qty"   => $item->getQtyOrdered(),
            );
        }
        return $items;
    }
}