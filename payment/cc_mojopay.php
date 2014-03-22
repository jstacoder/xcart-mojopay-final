<?php
if (!defined('XCART_START')) { header("Location: ../"); die("Access denied"); }
/* @name: cc_mojopay.php
 * @author: Kyle Roux
 * @desc: processing file for mojopay payment gateway
 */
if ($_SERVER['REQUEST_METHOD'] == "POST") 
{
    if(file_exists("./auth.php")) {
        include_once "./auth.php";
    }
    
    if(!is_array($secure_oid)) {
        $oid = $secure_oid;
    } else {
        $oid = $secure_oid[0];
    }

    $module_params = func_get_pm_params('cc_mojopay.php');
    $webset = 1;    
    
    if(file_exists($xcart_dir."/class_cc_mojopay.php")) {
        require_once $xcart_dir."/class_cc_mojopay.php";
    }
    $sessid = $oid;
    $mojo = new Mojopay_Payment_Gateway();
    $response = $mojo->send_request();
    if ((string)$response->decision == "ACCEPTED") {
        // transaction was processed, clear cart and give customer the invoice
        $bill_output['code'] = 1;
        $bill_output['txnid'] = (string)$response->confirmationNumber;
        $bill_output['sessid'] = $bill_output['txnid'];
    } else {
        // transaction failed, show message and redirect back
        $bill_output['code'] = 2;
        $bill_output['billmes'] = (string)$response->description;
        $error = 'error_ccprocessor_error';
    }
 

    if(!$duplicate) {
        db_query("REPLACE INTO $sql_tbl[cc_pp3_data] (ref,sessid) VALUES ('".addslashes($oid)."','".$XCARTSESSID."')");
    } 
    include_once $xcart_dir."/payment/payment_ccend.php";


}
exit; 
?>




