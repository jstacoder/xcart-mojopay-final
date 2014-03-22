
{if $hide_header ne "Y"}
  <h3>{$lng.lbl_cc_info}</h3>
{/if}

{if $config.General.checkout_module eq 'One_Page_Checkout'}
<ul>
  <li class="single-field">
    {capture name=regfield}
         <input type="text" name="cc_owner" id="cc_owner" size="32" maxlength="32" value="">
    {/capture}
    {include file="modules/One_Page_Checkout/opc_form_field.tpl" content=$smarty.capture.regfield required="Y" name=$lng.lbl_cc_mojopay_cc_owner field="cc_owner"}
  </li>
  <li class="single-field">
    {capture name=regfield}
      <input type="text" name="cc_number" id="cc_number" size="32" maxlength="32" value="">
    {/capture}
    {include file="modules/One_Page_Checkout/opc_form_field.tpl" content=$smarty.capture.regfield required="Y" name=$lng.lbl_cc_mojopay_cc_number field="cc_number"}
  </li>
  <li class="single-field">
    {capture name=regfield}
      <select name="cc_type"> 
        <option value="MasterCard">MasterCard</option>
        <option value="Visa">Visa</option>
        <option value="Discover">Discover</option>
        <option value="AmericanExpress">AmericanExpress</option>
      </select>
    {/capture}
    {include file="modules/One_Page_Checkout/opc_form_field.tpl" content=$smarty.capture.regfield required="Y" name=$lng.lbl_cc_mojopay_cc_type field="cc_type"}
  </li>
  <li class="single-field">
    {capture name=regfield}
      <select name="cc_expire_date_month">
        <option value="01">January</option>
        <option value="02">February</option>
        <option value="03">March</option>
        <option value="04">April</option>
        <option value="05">May</option>
        <option value="06">June</option>
        <option value="07">July</option>
        <option value="08">August</option>
        <option value="09">September</option>
        <option value="10">October</option>
        <option value="11">November</option>
        <option value="12">December</option>
      </select>
    {/capture}
    {include file="modules/One_Page_Checkout/opc_form_field.tpl" content=$smarty.capture.regfield required="Y" name=$lng.lbl_cc_mojopay_expire_month field="cc_expire_date_month"}
  </li>
  <li class="single-field">
    {capture name=regfield} 
      <select name="cc_expire_date_year">
        <option value="2013">2013</option>
        <option value="2014">2014</option>
        <option value="2015">2015</option>
        <option value="2016">2016</option>
        <option value="2017">2017</option>
        <option value="2018">2018</option>
        <option value="2019">2019</option>
        <option value="2020">2020</option>
        <option value="2021">2021</option>
        <option value="2022">2022</option>
        <option value="2023">2023</option>
      </select>
    {/capture}    
    {include file="modules/One_Page_Checkout/opc_form_field.tpl" content=$smarty.capture.regfield required="Y" name=$lng.lbl_cc_mojopay_expire_year field="cc_expire_date_year"}
  </li>
  <li class="single-field">
    {capture name=regfield}
      <input type="text" name="cc_cvv2" value="" size="3" maxlength="3">
    {/capture}
    {include file="modules/One_Page_Checkout/opc_form_field.tpl" content=$smarty.capture.regfield required="Y" name=$lng.lbl_cc_mojopay_cc_cvv2 field="cc_cvv2"}
  </li>
</ul>
{else}
<table cellspacing="0" class="data-table">
{if $hide_header ne "Y"}
<tr>
  <td class="register-section-title" colspan="3">
  <label>{$lng.lbl_cc_info}</label>
  </td>
</tr>
{/if}
<tr>
  <td class="data-name"><label for="cc_owner">{$lng.lbl_cc_mojopay_cc_owner}</label></td>
  <td class="data-required">*</td>
  <td>
      <input type="text" name="cc_owner" id="cc_owner" size="32" maxlength="32" value="">
  </td>
</tr>
<tr>
  <td class="data-name"><label for="cc_number">{$lng.lbl_cc_mojopay_cc_number}</label></td>
  <td class="data-required">*</td>
  <td>
      <input type="text" name="cc_number" id="cc_number" size="32" maxlength="32" value="">
  </td>
</tr>
<tr>
  <td class="data-name"><label for="cc_type">{$lng.lbl_cc_mojopay_cc_type}</label></td>
  <td class="data-required">*</td>
  <td><select name="cc_type"> 
        <option value="MasterCard">MasterCard</option>
        <option value="Visa">Visa</option>
        <option value="Discover">Discover</option>
        <option value="AmericanExpress">AmericanExpress</option>
      </select>
  </td>
</tr>
<tr>
  <td><label for="cc_expire_date">{$lng.lbl_cc_mojopay_expire_date}</label></td>
  <td>
    <select name="cc_expire_date_month">
      <option value="01">January</option>
      <option value="02">February</option>
      <option value="03">March</option>
      <option value="04">April</option>
      <option value="05">May</option>
      <option value="06">June</option>
      <option value="07">July</option>
      <option value="08">August</option>
      <option value="09">September</option>
      <option value="10">October</option>
      <option value="11">November</option>
      <option value="12">December</option>
    </select>
    /
    <select name="cc_expire_date_year">
      <option value="2013">2013</option>
      <option value="2014">2014</option>
      <option value="2015">2015</option>
      <option value="2016">2016</option>
      <option value="2017">2017</option>
      <option value="2018">2018</option>
      <option value="2019">2019</option>
      <option value="2020">2020</option>
      <option value="2021">2021</option>
      <option value="2022">2022</option>
      <option value="2023">2023</option>
    </select>
  </td>
</tr>
<tr>
  <td class="data-name"><label for="cc_cvv2">{$lng.lbl_cc_mojopay_cc_cvv2}</label></td>
  <td class="data-required">*</td>
  <td><input type="text" name="cc_cvv2" value="" size="3"></td>
</tr>
</table>
{/if}
