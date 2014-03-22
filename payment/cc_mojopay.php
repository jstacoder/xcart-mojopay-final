<?php
if (!defined('XCART_START')) { header("Location: ../"); die("Access denied"); }
/* @name: cc_mojopay.php
 * @author: Kyle Roux
 * @desc: processing file for mojopay payment gateway
 */
if ($_SERVER['METHOD'] == "POST") 
{
    if(file_exists("./auth.php")) {
        include_once "./auth.php";
    }
    
    if(file_exists($xcart_dir . DS . 'include' . DS . 'classes' . 'class_cc_mojopay.php')) {
        require_once $xcart_dir . DS . 'include' . DS . 'classes' . 'class_cc_mojopay.php';
    }
    if(!is_array($secure_oid)) {
        $oid = $secure_oid;
    } else {
        $oid = $secure_oid[0];
    }

    $module_params = func_get_pm_params('cc_mojopay.php');
    $mojo = new Mojopay_Payment_Gateway;
    $response = $mojo->send_request();
    $webset = 2;    
    
    if ((string)$response->decision == 'ACCEPTED' && (int)$response->code == 0) (
        // transaction was processed, clear cart and give customer the invoice
        $bill_output['code'] = 1;
        $bill_output['txnid'] = (string)$response->confirmationNumber;
    } else {
        // transaction failed, show message and redirect back
        $bill_output['code'] = 2;
        $bill_output['billmes'] = (string)$response->error . PHP_EOL . (string)$response->description;
    }
 

    if(!$duplicate) {
        db_query("REPLACE INTO $sql_tbl[cc_pp3_data] (ref,sessid) VALUES ('".addslashes($oid)."','".$XCARTSESSID."')");
    } 
    include_once $xcart_dir."/payment/payment_ccend.php";


}
exit; 
?>




