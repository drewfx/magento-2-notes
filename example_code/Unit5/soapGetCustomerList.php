<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require('vendor/zendframework/zend-server/src/Client.php');
require('vendor/zendframework/zend-soap/src/Client.php');
require('vendor/zendframework/zend-soap/src/Client/Common.php');

$wsdlurl = 'http://your_magento_site.loc/index.php/soap?wsdl&services=customerCustomerRepositoryV1';

$token = 'YOUR_MAGENTO_TOKEN_HERE';

$opts = ['http' => ['header' => "Authorization: Bearer ".$token]];
$context = stream_context_create($opts);

$serviceArgs = array('searchCriteria'=>
    array('filterGroups' =>
        array ('filters' =>
            array('field' =>'firstname',
                'value' => 'Veronica' ,
                'condition_type' => 'eq')
        )
    )
);
$soapClient = new \Zend\Soap\Client($wsdlurl);
$soapClient->setSoapVersion(SOAP_1_2);
$soapClient->setStreamContext($context);

$result = $soapClient->customerCustomerRepositoryV1GetList($serviceArgs);

echo "<pre>"; print_r($result);