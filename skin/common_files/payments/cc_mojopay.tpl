<h3>Mojopay</h3>
{$lng.txt_cc_configure_top_text}
<br />
{capture name=dialog}
<form action="cc_processing.php?cc_processor={$smarty.get.cc_processor|escape:"url"}" method="post">
  <center>
    <table cellspacing="10">
      <tr>
        <td>{$lng.lbl_cc_mojopay_account_number}:</td>
        <td><input type="text" name="param01" size="32" value="{$module_data.param01|escape}" /></td>
      </tr>
      <tr>
        <td>{$lng.lbl_cc_mojopay_store_id}:</td>
        <td><input type="text" name="param02" size="32" value="{$module_data.param02|escape}" /></td>
      </tr>
      <tr>
        <td>{$lng.lbl_cc_mojopay_password}:</td>
        <td><input type="text" name="param03" size="32" value="{$module_data.param03|escape}" /></td>
      </tr>
      <tr>
        <td>{$lng.lbl_cc_mojopay_title}:</td>
        <td><input type="text" name="param04" size="32" value="{$module_data.param04|escape}" /></td>
      </tr>
      <tr>
        <td>{$lng.lbl_cc_mojopay_description}:</td>
        <td><textarea name="param05" rows="4" cols="50">{$module_data.param05|escape}</textarea></td>
      </tr>
      <tr>
        <td>{$lng.lbl_cc_mojopay_testmode}:</td>
        <td>
          <select name="param06">
              <option value="1" {if $module_data.param06 eq "1"} selected="selected"{/if}>Enabled</option>
              <option value="0"{if $module_data.param06 eq "0"} selected="selected"{/if}>Disabled</option>
          </select>
        </td>
      </tr>
    </table>
  </center>
  <br/>
  <br/>
  <input type="submit" value="{$lng.lbl_update|strip_tags:false|escape}" />
</form>

{/capture}
{include file="dialog.tpl" title=$lng.lbl_cc_settings content=$smarty.capture.dialog extra='width="100%"'}
