INSERT INTO xcart_ccprocessors VALUES ('MojoPay','C','cc_mojopay.php','payments/cc_mojopay.tpl','','','','','','','','','','N','N','N','','','payments/cc_mojopay_customer.tpl',0,'','Y',0,'','0%','0%');
INSERT INTO `xcart_payment_methods` (`paymentid`, `payment_method`, `payment_template`, `payment_script` , `protocol`, `active`, `af_check`,`surcharge`,`surcharge_type`)
VALUES ('32', 'MojoPay', 'customer/main/payment_cc.tpl', 'payment_cc.php', 'http','Y','Y','0.00','$');

INSERT INTO `xcart_payment_methods` (`paymentid`, `payment_method`, `payment_template`, `payment_script` , `active`, `af_check`,`surcharge`,`processor_file`,`surcharge_type`)
VALUES ((select `paymentid` from `xcart_ccprocessors` where `module_name` = 'MojoPay'), 'MojoPay', 'payments/cc_mojopay_costumer.tpl', 'payment_cc.php', 'Y','N','0.00','cc_mojopay.php', '$')


INSERT INTO xcart_languages set code='en', name='lbl_cc_mojopay_account_number', value=' MojoPay Account Number', topic='Labels';
INSERT INTO xcart_languages set code='en', name='lbl_cc_mojopay_store_id', value='MojoPay Store ID', topic='Labels';
INSERT INTO xcart_languages set code='en', name='lbl_cc_mojopay_password', value='MojoPay Store Password', topic='Labels';
INSERT INTO xcart_languages set code='en', name='lbl_cc_mojopay_title', value='Title', topic='Labels';
INSERT INTO xcart_languages set code='en', name='lbl_cc_mojopay_description', value='Description', topic='Labels';
INSERT INTO xcart_languages set code='en', name='lbl_cc_mojopay_testmode', value='MojoPay Sandbox', topic='Labels';
INSERT INTO xcart_languages set code='en', name='lbl_cc_mojopay_cc_types', value='Accepted Cards', topic='Labels';
INSERT INTO xcart_languages set code='en', name='lbl_credit_card_information', value='Credit Card Information', topic='Labels';

INSERT INTO xcart_languages set code='en', name='lbl_cc_info', value='Credit Card Information', topic='Labels';
INSERT INTO xcart_languages set code='en', name='lbl_cc_mojopay_cc_owner', value='Card Owner', topic='Labels';
INSERT INTO xcart_languages set code='en', name='lbl_cc_mojopay_cc_number', value='Card Number', topic='Labels';
INSERT INTO xcart_languages set code='en', name='lbl_cc_mojopay_cc_type', value='Card Type', topic='Labels';
INSERT INTO xcart_languages set code='en', name='lbl_cc_mojopay_expire_date', value='Card Expiry Date', topic='Labels';
INSERT INTO xcart_languages set code='en', name='lbl_cc_mojopay_expire_month', value='Card Expiry Month', topic='Labels';
INSERT INTO xcart_languages set code='en', name='lbl_cc_mojopay_expire_year', value='Card Expiry year', topic='Labels';
INSERT INTO xcart_languages set code='en', name='lbl_cc_mojopay_cc_cvv2', value='Card Security Code (CVV2)', topic='Labels';

