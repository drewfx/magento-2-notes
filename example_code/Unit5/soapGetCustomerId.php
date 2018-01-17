<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set("soap.wsdl_cache_enabled", 0);

require('vendor/zendframework/zend-server/src/Client.php');
require('vendor/zendframework/zend-soap/src/Client.php');
require('vendor/zendframework/zend-soap/src/Client/Common.php');
//
$wsdlurl = 'http://your_magento_site.loc/index.php/soap?wsdl&services=customerCustomerRepositoryV1';

$token = 'YOUR_MAGENTO_TOKEN_HERE';

$opts = ['http' => ['header' => "Authorization: Bearer ".$token]];
$context = stream_context_create($opts);

$soapClient = new \Zend\Soap\Client($wsdlurl);
$soapClient->setSoapVersion(SOAP_1_2);
$soapClient->setStreamContext($context);

$result = $soapClient->customerCustomerRepositoryV1GetById(array('customerId' => 1));

echo "<pre>"; print_r($result);