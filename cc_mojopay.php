<?php
/* @name: cc_mojopay.php
 * @author: Kyle Roux
 * @desc: processing file for mojopay payment gateway
 */
if ($_SERVER['REQUEST_METHOD'] == "POST") 
{
    if(file_exists("./auth.php")) {
        include_once "./auth.php";
    } 
    
    class Mojopay_Payment_Gateway
    {
    
        public function __construct()
        {
            $this->module_params = func_get_pm_params('cc_mojopay.php');
            $this->_set_data();
            $this->_build_request();
        }

        private function _build_request()
        {
            $this->_no_cvv = false;
            $data = $this->_xmlData;
            if (!isset($data['confirmationNumber'])) // build a ccAuthRequestV1 object
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
                    $xml .= '<cvdIndicator>1</cvdIndicator>';
                    if (strlen($data['cvd']) < 3) {
                        //$data['cvd'] = '000';
                        $ithis->_no_cvv = true;
                    }
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
                    $xml .= '<phone>' . $data['phone'] . '</phone>';
                    $xml .= '<email>' . $data['email'] . '</email>';
                    $xml .= '</billingDetails>';
                    $xml .= '<shippingDetails>';
                    $xml .= '<firstName>' . $data['shippingFirstName'] . '</firstName>';
                    $xml .= '<lastName>' . $data['shippingLastName'] . '</lastName>';
                    $xml .= '<street>' . $data['shippingStreet'] . '</street>';
                    $xml .= '<city>' . $data['shippingCity'] . '</city>';
                    $xml .= '<region>' . $data['shippingRegion'] . '</region>';
                    $xml .= '<country>' . $data['billingCountry'] . '</country>';
                    $xml .= '<zip>' . $data['shippingZip'] . '</zip>';
                    $xml .= '<phone>' . $data['phone'] . '</phone>';
                    $xml .= '<email>' . $data['email'] . '</email>';
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
            $this->_requestXml = $xml;
        }



        private function _set_data()
        {
            if(false)
            {
                $this->_xmlData = array(
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
                'email' => 'kyle@level2designs.com',
                'phone' => '7147836369',
                'shippingFirstName' => 'Kyle',  
                'shippingLastName' => 'Roux',
                'shippingStreet' => '2555 w winston rd.',
                'shippingCity' => 'anaheim',
                'shippingRegion' => 'California',
                'shippingZip' => '92801',
                'shippingCountry' => 'US',
                'email' => 'kyle@level2designs.com',
                'amount' => substr(sprintf("%01.2f","10.0") , 0, 15),
                'cardNum' => '4007000000027',
                'month' => '12',
                'year' => '2016',
                'cvd' => '111'
                );

            } else {
                global $cart;
                global $bill_lastname;
                global $bill_firstname;
                global $userinfo;

                $this->_xmlData = array(
                'accountNum' => $this->module_params['param01'],
                'storeID' => $this->module_params['param02'],
                'storePwd' => $this->module_params['param03'],
                'merchantRefNum' =>  '77777',
                'billingFirstName' => substr($bill_firstname,0,40), 
                'billingLastName' => substr($bill_lastname,0,40),
                'billingStreet' => substr($userinfo["b_address"],0,50),
                'billingStreet2' => substr($userinfo["b_address2"],0,50),
                'billingCity' => substr($userinfo["b_city"],0,50),
                'billingRegion' => substr($userinfo["b_statename"],0,50),
                'billingZip' => substr($userinfo["b_zipcode"],0,50),
                'billingCountry' => substr($userinfo["b_country"],0,50),
                'email' => substr($userinfo["email"],0,50),
                'phone' => substr($userinfo["phone"],0,50),
                'shippingFirstName' => substr($userinfo["s_firstname"],0,50),
                'shippingLastName' => substr($userinfo["s_lastname"],0,50),
                'shippingStreet' => substr($userinfo["s_address"],0,50),
                'shippingCity' => substr($userinfo["s_city"],0,50),
                'shippingRegion' => substr($userinfo["s_statename"],0,50),
                'shippingZip' => substr($userinfo["b_zipcode"],0,50),
                'snippingCountry' => substr($userinfo["b_country"],0,50),
                'email' => substr($userinfo["email"],0,50),
                'amount' => substr(sprintf("%01.2f",$cart['total_cost']) , 0, 15),
                'cardNum' => $userinfo['cc_number'],
                'month' => substr($userinfo['cc_expire_date_month'], 0,2),
                'year' => substr($userinfo['cc_expire_date_year'], 0, 4),
                'cvd' => $userinfo['cc_cvv2']
                );
            }
            return true;
        }

        private function _get_txn_mode()
        {
            if(isset($testing))
       
            {
                return 'ccPurchase';
            }
            if (isset($this->_xmlData['confirmationNumber']))
            {
                $mode = 'ccSettlement';
            } else {
                if ((int)$this->module_params['param08'] === 1)
                {
                    $mode = 'ccPurchase';
                } else {
                    $mode = 'ccAuthorize';
                }
            }
            return $mode;
        }

        public function send_request($post_string = null)
        {
            
            $test_mode = intval($this->module_params['param06']);
            if ($test_mode === 1)
                {
                    $gateway_url = 'https://webservices.test.mojopay.com/creditcardWS/CreditCardServlet/v1';
                } else {
                    $gateway_url = 'https://webservices.mojopay.com/creditcardWS/CreditCardServlet/v1';
                }
            $transactionMode = $this->_get_txn_mode();
            if ($post_string !== null)
                {
                $message = $post_string;
                } else {
                    $message = $this->_requestXml;
                }
            $request = "&txnMode=$transactionMode&txnRequest=$message";

 
            $curl = curl_init();
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($curl, CURLOPT_POST, 1);
            curl_setopt($curl, CURLOPT_URL, $gateway_url);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $request);
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 2);

            $response = curl_exec($curl);
            curl_close($curl);

            $this->_postResult = $response;
            $rtn = new SimpleXMLElement($this->_postResult);
            return $rtn;

        }

        private function _process_mojopay_response()
        {
            $mojopay_response = new SimpleXMLElement($this->_postResult);
            $results = array(
            'confirmationNumber' => (string)$mojopay_response->confirmationNumber,
            'result' => (string)$mojopay_response->decision,
            'code'=> (int)$mojopay_response->code,
            'description' => (string)$mojopay_response->description,
            'error' => (string)$mojopay_response->detail[2]->value,
            'txnTime' => (string)$mojopay_response->txnTime
            );
            return $results;
        }

        public function good_cvv()
        {
            return $this->_no_cvv;
        }

        function do_post_request($xml)
        {
            $response = send_request($xml);
            $result = process_mojopay_response($response);
            return $result;
        }

    }
    
    
    if(!is_array($secure_oid)) {
        $oid = $secure_oid;
    } else {
        $oid = $secure_oid[0];
    }

    $webset = 1;    

    // create connection to mojopay
    $mojo = new Mojopay_Payment_Gateway;
    // rend cc payment request and recieve result
    $response = $mojo->send_request();
    if ((string)$response->decision == "ACCEPTED") {
        // transaction was processed, clear cart and give customer the invoice
        $bill_output['code'] = 1;
        $bill_output['txnid'] = (string)$response->confirmationNumber;
        //$bill_output['sessid'] = rand();
    } else {
        // transaction failed, show message and redirect back
        $bill_output['code'] = 2;
        if((int)$response->code == 5023) {
            $bill_output['billmes'] = "You either entered an incorrect cvv or you did not enter enough digits, please check your information and try again.";
            $error = 'error_ccprocessing_baddata';
        } else {
            $bill_output['billmes'] =  (string)$response->description;
            $error = 'error_ccprocessor_error';
        }
    
    }
  include_once $xcart_dir."/payment/payment_ccend.php";
  if(!$duplicate) {
    db_query("REPLACE INTO $sql_tbl[cc_pp3_data] (ref,sessid) VALUES ('".addslashes($oid)."','".$XCARTSESSID."')");
  } 



} 
    
exit; 
?>




