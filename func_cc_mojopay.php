<?php
$txnMode = array(
	'auth' => 'ccAuthorize',
	'settle' => 'ccSettlement',
	'capture' => 'ccPurchase')

$mode = 'capture';

function build_request($data)
{
	if (isset($data['confirmationNumber'])) // build a ccAuthRequestV1 object
	{
		$xml = ''; // reset var
		$xml = '<?xml version="1.0" encoding="UTF-8"?>';
		$xml .= '<ccAuthRequestV1 xmlns="http://www.mojopay.com/creditcard/xmlschema/v1" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.mojopay.com/creditcard/xmlschema/v1">';
		$xml .= '<merchantAccount>';
		$xml .= '<accountNum>' . $data['accountNum']  . '</accountNum>';
		$xml .= '<storeID>' . $data['storeID'] . '</storeID>';
		$xml .= '<storePwd>' . $data['storePwd'] . '</storePwd>';
		$xml .= '</merchantAccount>';
		$xml .= '<merchantRefNum>' . $data['merchantRefNum'] . '</merchantRefNum>';
		$xml .= '<amount>' . $data['amount'] . '</amount>';
		$xml .= '<card>';
		$xml .= '<cardNum>' . $data['cardNum'] . '</cardNum>';
		$xml .= '<cardExpiry>';
		$xml .= '<month>' .  $data['month'] . '</month>';
		$xml .= '<year>' . $data['year'] . '</year>';
		$xml .= '</cardExpiry>';
		$xml .= '<cardType>' . $data['ccType'] . '</cardType>';
		$xml .= '<cvdIndicator>1</cvdIndicator>';
		$xml .= '<cvd>' . $data['cvd'] . '</cvd>';
		$xml .= '</card>';
		$xml .= '<billingDetails>';
		$xml .= '<firstName>' . $data['billingFirstName'] . '</firstName>';
		$xml .= '<lastName>' . $data['billingLastName'] . '</lastName>';
		$xml .= '<street>' . $data['billingStreet'] . '</street>';
		$xml .= '<city>' . $data['billingCity'] . '</city>';
		$xml .= '<region>' . $data['billingRegion'] . '</region>';
		$xml .= '<country>' . $data['billingCountry'] . '</country>';
		$xml .= '<zip>' . $data['billingZip'] . '</zip>';
		$xml .= '<phone>' . $data['billingPhone'] . '</phone>';
		$xml .= '<email>' . $data['billingEmail'] . '</email>';
		$xml .= '</billingDetails>';
		$xml .= '<shippingDetails>';
		$xml .= '<firstName>' . $data['shippingFirstName'] . '</firstName>';
		$xml .= '<lastName>' . $data['shippingLastName'] . '</lastName>';
		$xml .= '<street>' . $data['shippingStreet'] . '</street>';
		$xml .= '<city>' . $data['shippingCity'] . '</city>';
		$xml .= '<region>' . $data['shippingRegion'] . '</region>';
		$xml .= '<country>' . $data['shippingCountry'] . '</country>';
		$xml .= '<zip>' . $data['shippingZip'] . '</zip>';
		$xml .= '<phone>' . $data['shippingPhone'] . '</phone>';
		$xml .= '<email>' . $data['shippingEmail'] . '</email>';
		$xml .= '</shippingDetails>';
		$xml .= '</ccAuthRequestV1>';

	} else { // build a ccPostAuthRequestV1 object
		$xml = ''; // reset var

		$xml = '<?xml version="1.0" encoding="UTF-8"?>';
		$xml .= '<ccPostAuthRequestV1 xmlns="http://www.mojopay.com/creditcard/xmlschema/v1" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.mojopay.com/creditcard/xmlschema/v1">';
		$xml .= '<merchantAccount>';
		$xml .= '<accountNum>' . $data['accountNum']  . '</accountNum>';
		$xml .= '<storeID>' . $data['storeID'] . '</storeID>';
		$xml .= '<storePwd>' . $data['storePwd'] . '</storePwd>';
		$xml .= '</merchantAccount>';
		$xml .= '<confirmationNumber>' . $data['confirmationNumber'] . '</confirmationNumber>';
		$xml .= '<merchantRefNum>' . $data['merchantRefNum'] . '</merchantRefNum>';
		$xml .= '<amount>' . $data['amount'] . '</amount>';	
		$xml .= '</ccPostAuthRequestV1>';

	}
    return $xml;
}



function set_data($test_data = false)
{
	if($test_data === true)
	{
        $mojopay_xml = array(
        'accountNum' => '89989693',
        'storeID' => 'test',
        'storePwd' => 'test',
        'merchantRefNum' =>  'Ref-' . rand(),
        'billingFirstName' => 'Kyle',
        'billingLastName' => 'Roux',
        'billingStreet' => '2555 w winston rd.',
        'billingCity' => 'anaheim',
        'billingRegion' => 'California',
        'billingZip' => '92801',
        'billingCountry' => 'US',
        'billingEmail' => 'kyle@level2designs.com',
        'billingPhone' => '7147836369',
        'shippingFirstName' => 'Kyle',
        'shippingLastName' => 'Roux',
        'shippingStreet' => '2555 w winston rd.',
        'shippingCity' => 'anaheim',
        'shippingRegion' => 'California',
        'shippingZip' => '92801',
        'shippingCountry' => 'US',
        'shippingEmail' => 'kyle@level2designs.com',
        'amount' => substr(sprintf("%01.2f","10.0") , 0, 15),
        'cardNum' => '4007000000027',
        'month' => '12',
        'year' => '2016',
        'cvd' => '111',
        'ccType' => 'VI'
        );

	} else {

		$mojopay_xml = array_filter(array(
		'accountNum' => $module_params['param01'],
        'storeID' => $module_params['param02'],
        'storePwd' => $module_params['param03'],
        'merchantRefNum' =>  $txnid,
        'billingFirstName' => substr($bill_firstname,0,40),
        'billingLastName' => substr($bill_lastname,0,40),
        'billingStreet' => substr($userinfo["b_address"],0,50),
		'billingStreet2' => substr($userinfo["b_address2"],0,50),
        'billingCity' => substr($userinfo["b_city"],0,50),
        'billingRegion' => substr($userinfo["b_statename"],0,50),
        'billingZip' => substr($userinfo["b_zipcode"],0,50),
        'billingCountry' => substr($userinfo["b_country"],0,50),
        'billingEmail' => substr($userinfo["email"],0,50),
        'billingPhone' => substr($userinfo["phone"],0,50),
        'shippingFirstName' => substr($userinfo["s_firstname"],0,50),
        'shippingLastName' => substr($userinfo["s_lastname"],0,50),
        'shippingStreet' => substr($userinfo["s_address"],0,50),
		'shippingStreet2' => substr($userinfo["s_address2"],0,50)
        'shippingCity' => substr($userinfo["s_city"],0,50),
        'shippingRegion' => substr($userinfo["s_statename"],0,50),
        'shippingZip' => substr($userinfo["b_zipcode"],0,50),
        'shippingCountry' => substr($userinfo["b_country"],0,50),
        'shippingEmail' => substr($userinfo["email"],0,50),
        'amount' => substr(sprintf("%01.2f","10.0") , 0, 15),
        'cardNum' => $userinfo['cc_number'],
        'month' => substr($userinfo['cc_exp_month'], 0,2),
        'year' => substr($userinfo['cc_exp_year'], 0, 2),
        'cvd' => $userinfo['cc_cvv2']
        ));
	}
    return $mojopay_xml;
}




function send_request($post_string)
{
	$test_mode = (int)$module_params['param06'];
	if ((int)$test_mode === 1) 
	{	
		$gateway_url = 'https://webservices.test.mojopay.com/creditcardWS/CreditCardServlet/v1';
	} else {
		$gateway_url = 'https://webservices.mojopay.com/creditcardWS/CreditCardServlet/v1';
	}
    $transactionMode = $txnMode[$mode];
    $message = "?txnMode=$transactionMode&txnRequest=$post_string";
    
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_POST, 1);
    curl_setopt($curl, CURLOPT_URL, $gateway_url);
	curl_setopt($curl, CURLOPT_POSTFIELDS, $message);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 2);

    $result = curl_exec($curl);
    curl_close($curl);

    return $result;
}

function process_mojopay_response($response)
    /* @param $mojopay_response - SimpleXMLElement*/
{
    $mojopay_response = new SimpleXMLElement($response);
    $results = array(
    'confirmationNumber' => $mojopay_response->confirmationNumber,
    'result' => $mojopay_response->decision,
    'code'=> (int)$mojopay_response->code,
    'description' => $mojopay_response->description,
    'error' => $mojopay_response->detail[2]->value,
    'txnTime' => $mojopay_response->txnTime
    );
    return $results
}

function do_post_request($xml)
{
	$response = send_request($xml);
	$result = process_mojopay_response($response);
	return $result
}




?>