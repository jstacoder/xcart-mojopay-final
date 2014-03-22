X-Cart MojoPay module


INSTALLATION
---


1. To add the MojoPay module to X-Cart, copy these files from your upload directory to your X-Cart directory.

    * cc_mojopay.php - should be copied to $xcart_dir/payment/

            it should be:
    
            $xcart_dir/payment/cc_mojopay.php

    * class_cc_mojopay.php - should be copied to $xcart_dir/include/classes/
    
            it should be:
            
            $xcart_dir/include/classes/class_cc_mojopay.php

    * cc_mojopay.tpl and cc_mojopay_customer.tpl should be copied to $xcart_dir/skin/common_files/payments/
        
            they shold be:

            $xcart_dir/skin/common_files/cc_mojopay.tpl
            &
            $xcart_dir/skin/common_files/cc_mojopay_customer.tpl


2. After successful copying you will have to log in to your X-Cart admin. 

3.  In Admin go to Tools->Patch/Upgrade.  
    
    Scroll down to "Apply SQL patch" and click browse to retrieve 
    xcart-mojopay-gateway.sql from your upload directory. 
    
    Cikck Apply to apply patch.

4. In Admin go to Settings->
                    Payment Gateways
                    
5. Select "MojoPay" and click the checkbox to add the gateway to your checkout process

6. click save chenges

All Done

5. In Admin go to Payment Methods and check the MojoPay gateway  to enable it and click "Apply Changes"

6.In Admin -> Payment Methods scroll to MojoPay and click configure.
