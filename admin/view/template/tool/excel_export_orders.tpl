<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <style type="text/css">
    #excel_export_orders tr td input[type=checkbox] {float: left;cursor: pointer;}
    #excel_export_orders label {font-weight: normal;line-height: 13px;padding: 7px 0px 0px 7px;cursor: pointer;}
    #excel_export_orders label.highlighted {color: #1e91cf;}
    #excel_export_orders h3 {font-size: 14px;font-weight: bold;margin: 15px 0px 10px 0px;padding: 0px;}
    .date {width: 130px;float: left;}
    .date-to {float: left;height: 35px;line-height: 35px;padding: 0px 10px;}
    .clear {clear: both;}
  </style>
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <button type="submit" form="excel_export_orders" data-toggle="tooltip" title="<?php echo $text_download_excel; ?>" class="btn btn-default"><i class="fa fa-download"></i></button>
        <a href="<?php echo $cancel; ?>" data-toggle="tooltip" title="<?php echo $text_cancel; ?>" class="btn btn-default"><i class="fa fa-reply"></i></a>
      </div>
      <h1><?php echo $heading_title; ?></h1>
      <ul class="breadcrumb">
        <?php foreach ($breadcrumbs as $breadcrumb) { ?>
        <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
        <?php } ?>
      </ul>
    </div>
  </div>
  <div class="container-fluid">
    <?php if ($warning) { ?>
      <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $warning; ?><button type="button" class="close" data-dismiss="alert">&times;</button></div>
    <?php } ?>
    <?php if ($success) { ?>
      <div class="alert alert-success"><i class="fa fa-check-circle"></i> <?php echo $success; ?><button type="button" form="form-backup" class="close" data-dismiss="alert">&times;</button></div>
    <?php } ?>
    <div class="panel panel-default">
      <div class="panel-heading"><h3 class="panel-title"><i class="fa fa-exchange"></i><?php echo $heading_title; ?></h3></div>
      <div class="panel-body">
        <form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post" id="excel_export_orders">
          <div id="form-left" style="float: left; margin-right: 50px;">
            <table cellpadding="0" cellspacing="0" style="float: left; margin-right: 30px;">
              <tr>
                <td><input type="checkbox" name="download[order_id]" id="download_order_id" value="1" /></td>
                <td><label for="download_order_id"><?php echo $text_order_id; ?></label></td>
              </tr>
              <tr>
                <td><input type="checkbox" name="download[invoice_no]" id="download_invoice_no" value="1" /></td>
                <td><label for="download_invoice_no"><?php echo $text_invoice_no; ?></label></td>
              </tr>
              <tr>
                <td><input type="checkbox" name="download[invoice_prefix]" id="download_invoice_prefix" value="1" /></td>
                <td><label for="download_invoice_prefix"><?php echo $text_invoice_prefix; ?></label></td>
              </tr>
              <tr>
                <td><input type="checkbox" name="download[store_name]" id="download_store_name" value="1" /></td>
                <td><label for="download_store_name"><?php echo $text_store_name; ?></label></td>
              </tr>
              <tr>
                <td><input type="checkbox" name="download[comment]" id="download_comment" value="1" /></td>
                <td><label for="download_comment"><?php echo $text_comment; ?></label></td>
              </tr>
              <tr>
                <td><input type="checkbox" name="download[total]" id="download_total" value="1" /></td>
                <td><label for="download_total"><?php echo $text_total; ?></label></td>
              </tr>
              <tr>
                <td><input type="checkbox" name="download[reward]" id="download_reward" value="1" /></td>
                <td><label for="download_reward"><?php echo $text_reward; ?></label></td>
              </tr>
              <tr>
                <td><input type="checkbox" name="download[product_id]" id="download_product_id" value="1" /></td>
                <td><label for="download_product_id"><?php echo $text_product_id; ?></label></td>
              </tr>
              <tr>
                <td><input type="checkbox" name="download[product_name]" id="download_product_name" value="1" /></td>
                <td><label for="download_product_name"><?php echo $text_product_name; ?></label></td>
              </tr>
              <tr>
                <td><input type="checkbox" name="download[product_model]" id="download_product_model" value="1" /></td>
                <td><label for="download_product_model"><?php echo $text_product_model; ?></label></td>
              </tr>
              <tr>
                <td><input type="checkbox" name="download[product_price]" id="download_product_price" value="1" /></td>
                <td><label for="download_product_price"><?php echo $text_product_price; ?></label></td>
              </tr>
              <tr>
                <td><input type="checkbox" name="download[product_total_price]" id="download_product_total_price" value="1" /></td>
                <td><label for="download_product_total_price"><?php echo $text_product_total_price; ?></label></td>
              </tr>
              <tr>
                <td><input type="checkbox" name="download[product_quantity]" id="download_product_quantity" value="1" /></td>
                <td><label for="download_product_quantity"><?php echo $text_product_quantity; ?></label></td>
              </tr>
              <tr>
                <td><input type="checkbox" name="download[product_option]" id="download_product_option" value="1" /></td>
                <td><label for="download_product_option"><?php echo $text_product_option; ?></label></td>
              </tr>
              <tr>
                <td><input type="checkbox" name="download[product_sku]" id="download_sku" value="1" /></td>
                <td><label for="download_sku"><?php echo $text_product_sku; ?></label></td>
              </tr>
            </table>
            
            <table cellpadding="0" cellspacing="0" style="float: left; margin-right: 30px;">
              <tr>
                <td><input type="checkbox" name="download[affiliate_id]" id="download_affiliate_id" value="1" /></td>
                <td><label for="download_affiliate_id"><?php echo $text_affiliate_id; ?></label></td>
              </tr>
              <tr>
                <td><input type="checkbox" name="download[commission]" id="download_commission" value="1" /></td>
                <td><label for="download_commission"><?php echo $text_commission; ?></label></td>
              </tr>
              <tr>
                <td><input type="checkbox" name="download[language_id]" id="download_language_id" value="1" /></td>
                <td><label for="download_language_id"><?php echo $text_language_id; ?></label></td>
              </tr>
              <tr>
                <td><input type="checkbox" name="download[currency_value]" id="download_currency_value" value="1" /></td>
                <td><label for="download_currency_value"><?php echo $text_currency_value; ?></label></td>
              </tr>
              <tr>
                <td><input type="checkbox" name="download[customer_id]" id="download_customer_id" value="1" /></td>
                <td><label for="download_customer_id"><?php echo $text_customer_id; ?></label></td>
              </tr>
              <tr>
                <td><input type="checkbox" name="download[customer_group_id]" id="download_customer_group_id" value="1" /></td>
                <td><label for="download_customer_group_id"><?php echo $text_customer_group_id; ?></label></td>
              </tr>
              <tr>
                <td><input type="checkbox" name="download[firstname]" id="download_firstname" value="1" /></td>
                <td><label for="download_firstname"><?php echo $text_firstname; ?></label></td>
              </tr>
              <tr>
                <td><input type="checkbox" name="download[lastname]" id="download_lastname" value="1" /></td>
                <td><label for="download_lastname"><?php echo $text_lastname; ?></label></td>
              </tr>
              <tr>
                <td><input type="checkbox" name="download[email]" id="download_email" value="1" /></td>
                <td><label for="download_email"><?php echo $text_email; ?></label></td>
              </tr>
              <tr>
                <td><input type="checkbox" name="download[telephone]" id="download_telephone" value="1" /></td>
                <td><label for="download_telephone"><?php echo $text_telephone; ?></label></td>
              </tr>
              <tr>
                <td><input type="checkbox" name="download[fax]" id="download_fax" value="1" /></td>
                <td><label for="download_fax"><?php echo $text_fax; ?></label></td>
              </tr>
              <tr>
                <td><input type="checkbox" name="download[order_status_id]" id="download_order_status_id" value="1" /></td>
                <td><label for="download_order_status_id"><?php echo $text_order_status_id; ?></label></td>
              </tr>
              <tr>
                <td><input type="checkbox" name="download[date_added]" id="download_date_added" value="1" /></td>
                <td><label for="download_date_added"><?php echo $text_date_added; ?></label></td>
              </tr>
              <tr>
                <td><input type="checkbox" name="download[date_modified]" id="download_date_modified" value="1" /></td>
                <td><label for="download_date_modified"><?php echo $text_date_modified; ?></label></td>
              </tr>
              <tr>
                <td><input type="checkbox" name="download[ip]" id="download_ip" value="1" /></td>
                <td><label for="download_ip"><?php echo $text_ip; ?></label></td>
              </tr>
            </table>
            
            <table cellpadding="0" cellspacing="0" style="float: left; margin-right: 30px;">
              <tr>
                <td><input type="checkbox" name="download[shipping_firstname]" id="download_shipping_firstname" value="1" /></td>
                <td><label for="download_shipping_firstname"><?php echo $text_shipping_firstname; ?></label></td>
              </tr>
              <tr>
                <td><input type="checkbox" name="download[shipping_lastname]" id="download_shipping_lastname" value="1" /></td>
                <td><label for="download_shipping_lastname"><?php echo $text_shipping_lastname; ?></label></td>
              </tr>
              <tr>
                <td><input type="checkbox" name="download[shipping_company]" id="download_shipping_company" value="1" /></td>
                <td><label for="download_shipping_company"><?php echo $text_shipping_company; ?></label></td>
              </tr>
              <tr>
                <td><input type="checkbox" name="download[shipping_address_1]" id="download_shipping_address_1" value="1" /></td>
                <td><label for="download_shipping_address_1"><?php echo $text_shipping_address_1; ?></label></td>
              </tr>
              <tr>
                <td><input type="checkbox" name="download[shipping_address_2]" id="download_shipping_address_2" value="1" /></td>
                <td><label for="download_shipping_address_2"><?php echo $text_shipping_address_2; ?></label></td>
              </tr>
              <tr>
                <td><input type="checkbox" name="download[shipping_city]" id="download_shipping_city" value="1" /></td>
                <td><label for="download_shipping_city"><?php echo $text_shipping_city; ?></label></td>
              </tr>
              <tr>
                <td><input type="checkbox" name="download[shipping_postcode]" id="download_shipping_postcode" value="1" /></td>
                <td><label for="download_shipping_postcode"><?php echo $text_shipping_postcode; ?></label></td>
              </tr>
              <tr>
                <td><input type="checkbox" name="download[shipping_country]" id="download_shipping_country" value="1" /></td>
                <td><label for="download_shipping_country"><?php echo $text_shipping_country; ?></label></td>
              </tr>
              <tr>
                <td><input type="checkbox" name="download[shipping_zone]" id="download_shipping_zone" value="1" /></td>
                <td><label for="download_shipping_zone"><?php echo $text_shipping_zone; ?></label></td>
              </tr>
              <tr>
                <td><input type="checkbox" name="download[shipping_address_format]" id="download_shipping_address_format" value="1" /></td>
                <td><label for="download_shipping_address_format"><?php echo $text_shipping_address_format; ?></label></td>
              </tr>
              <tr>
                <td><input type="checkbox" name="download[shipping_method]" id="download_shipping_method" value="1" /></td>
                <td><label for="download_shipping_method"><?php echo $text_shipping_method; ?></label></td>
              </tr>
            </table>
            
            <table cellpadding="0" cellspacing="0" style="float: left; margin-right: 30px;">
              <tr>
                <td><input type="checkbox" name="download[payment_firstname]" id="download_payment_firstname" value="1" /></td>
                <td><label for="download_payment_firstname"><?php echo $text_payment_firstname; ?></label></td>
              </tr>
              <tr>
                <td><input type="checkbox" name="download[payment_lastname]" id="download_payment_lastname" value="1" /></td>
                <td><label for="download_payment_lastname"><?php echo $text_payment_lastname; ?></label></td>
              </tr>
              <tr>
                <td><input type="checkbox" name="download[payment_company]" id="download_payment_company" value="1" /></td>
                <td><label for="download_payment_company"><?php echo $text_payment_company; ?></label></td>
              </tr>
              <tr>
                <td><input type="checkbox" name="download[payment_address_1]" id="download_payment_address_1" value="1" /></td>
                <td><label for="download_payment_address_1"><?php echo $text_payment_address_1; ?></label></td>
              </tr>
              <tr>
                <td><input type="checkbox" name="download[payment_address_2]" id="download_payment_address_2" value="1" /></td>
                <td><label for="download_payment_address_2"><?php echo $text_payment_address_2; ?></label></td>
              </tr>
              <tr>
                <td><input type="checkbox" name="download[payment_city]" id="download_payment_city" value="1" /></td>
                <td><label for="download_payment_city"><?php echo $text_payment_city; ?></label></td>
              </tr>
              <tr>
                <td><input type="checkbox" name="download[payment_postcode]" id="download_payment_postcode" value="1" /></td>
                <td><label for="download_payment_postcode"><?php echo $text_payment_postcode; ?></label></td>
              </tr>
              <tr>
                <td><input type="checkbox" name="download[payment_country]" id="download_payment_country" value="1" /></td>
                <td><label for="download_payment_country"><?php echo $text_payment_country; ?></label></td>
              </tr>
              <tr>
                <td><input type="checkbox" name="download[payment_zone]" id="download_payment_zone" value="1" /></td>
                <td><label for="download_payment_zone"><?php echo $text_payment_zone; ?></label></td>
              </tr>
              <tr>
                <td><input type="checkbox" name="download[payment_address_format]" id="download_payment_address_format" value="1" /></td>
                <td><label for="download_payment_address_format"><?php echo $text_payment_address_format; ?></label></td>
              </tr>
              <tr>
                <td><input type="checkbox" name="download[payment_method]" id="download_payment_method" value="1" /></td>
                <td><label for="download_payment_method"><?php echo $text_payment_method; ?></label></td>
              </tr>
            </table>
          </div>

          <div style="float: left; border-left: 1px solid gray; padding-left: 40px;">
            <h3><?php echo $text_checked; ?>:</h3>
            <table cellpadding="0" cellspacing="0">
              <tr>
                <td><input type="radio" name="checked" value="check_main_data" id="check_main_data" onClick="check(this.value);" /></td>
                <td><label for="check_main_data"><?php echo $text_check_main_data; ?></label></td>
              </tr>
              <tr>
                <td><input type="radio" name="checked" value="check_all_important_data" id="check_all_important_data" onClick="check(this.value);" /></td>
                <td><label for="check_all_important_data"><?php echo $text_check_all_important_data; ?></label></td>
              </tr>
              <tr>
                <td><input type="radio" name="checked" value="check_all" id="check_all" onClick="check(this.value);" /></td>
                <td><label for="check_all"><?php echo $text_check_all; ?></label></td>
              </tr>
              <tr>
                <td><input type="radio" name="checked" value="check_none" id="check_none" onClick="check(this.value);" /></td>
                <td><label for="check_none"><?php echo $text_check_none; ?></label></td>
              </tr>
            </table>

            <h3><?php echo $text_export_date; ?>:</h3>

            <div class="input-group date" id="date-start">
              <input type="text" name="date_start" value="<?php echo $default_date_start;?>" data-date-format="YYYY-MM-DD" id="input-date-start" class="form-control" />
              <span class="input-group-btn">
                <button class="btn btn-default" type="button"><i class="fa fa-calendar"></i></button>
              </span>
            </div>
    
            <span class="date-to"><?php echo $text_to; ?></span> 
          
            <div class="input-group date" id="date-stop">
              <input type="text" name="date_stop" value="<?php echo $default_date_stop;?>" data-date-format="YYYY-MM-DD" id="input-date-stop" class="form-control" />
              <span class="input-group-btn">
                <button class="btn btn-default" type="button"><i class="fa fa-calendar"></i></button>
              </span>
            </div>
          
            <div class="clear"></div>
          
            <h3><?php echo $text_select_language; ?>:</h3>
            <select name="language_id">
              <?php foreach($languages as $language){?>
                <option value="<?php echo $language['language_id'];?>"><?php echo $language['name'];?></option>
              <?php }?>
            </select>
            
            <h3><?php echo $text_another_setting; ?>:</h3>
            <input type="checkbox" name="separated_products" value="1" id="separated_products" checked="checked" /><label for="separated_products" style="width: 180px;"><?php echo $text_product_to_separated_line;?></label><br />
            <input type="checkbox" name="price_code" value="1" id="price_code" checked="checked" /><label for="price_code" style="width: 180px;"><?php echo $text_price_with_symbol; ?></label>
      
            <script type="text/javascript">
              function check(check_type){
                if(check_type == 'check_main_data'){
                  uncheckAll();
                  document.getElementById('download_order_id').checked                  = true;
                  document.getElementById('download_invoice_no').checked                = true;
                  document.getElementById('download_invoice_prefix').checked            = true;
                  document.getElementById('download_store_name').checked                = true;
                  document.getElementById('download_total').checked                     = true;
                  document.getElementById('download_reward').checked                    = true;
                  document.getElementById('download_order_status_id').checked           = true;
                  document.getElementById('download_date_added').checked                = true;
                  document.getElementById('download_shipping_firstname').checked        = true;
                  document.getElementById('download_shipping_lastname').checked         = true;
                  document.getElementById('download_shipping_company').checked          = true;
                  document.getElementById('download_shipping_address_1').checked        = true;
                  document.getElementById('download_shipping_address_2').checked        = true;
                  document.getElementById('download_shipping_city').checked             = true;
                  document.getElementById('download_shipping_postcode').checked         = true;
                  document.getElementById('download_shipping_country').checked          = true;
                  document.getElementById('download_shipping_zone').checked             = true;
                  document.getElementById('download_shipping_address_format').checked   = true;
                  document.getElementById('download_shipping_method').checked           = true;
                  document.getElementById('download_payment_firstname').checked         = true;
                  document.getElementById('download_payment_lastname').checked          = true;
                  document.getElementById('download_payment_company').checked           = true;
                  document.getElementById('download_payment_address_1').checked         = true;
                  document.getElementById('download_payment_address_2').checked         = true;
                  document.getElementById('download_payment_city').checked              = true;
                  document.getElementById('download_payment_postcode').checked          = true;
                  document.getElementById('download_payment_country').checked           = true;
                  document.getElementById('download_payment_zone').checked              = true;
                  document.getElementById('download_payment_address_format').checked    = true;
                  document.getElementById('download_payment_method').checked            = true;
                  document.getElementById('download_commission').checked                = true;
                  document.getElementById('download_currency_value').checked            = true;
                  document.getElementById('download_firstname').checked                 = true;
                  document.getElementById('download_lastname').checked                  = true;
                  document.getElementById('download_email').checked                     = true;
                  document.getElementById('download_telephone').checked                 = true;
                  document.getElementById('download_fax').checked                       = true;
                  document.getElementById('download_product_id').checked                = true;
                  document.getElementById('download_product_name').checked              = true;
                  document.getElementById('download_product_model').checked             = true;
                  document.getElementById('download_product_price').checked             = true;
                  document.getElementById('download_product_total_price').checked       = true;
                  document.getElementById('download_product_quantity').checked          = true;
                  document.getElementById('download_product_option').checked            = true;
                  document.getElementById('download_sku').checked                       = true;
                }
              
                if(check_type == 'check_all_important_data'){
                  uncheckAll();
                  document.getElementById('download_order_id').checked                  = true;
                  document.getElementById('download_invoice_no').checked                = true;
                  document.getElementById('download_invoice_prefix').checked            = true;
                  document.getElementById('download_store_name').checked                = true;
                  document.getElementById('download_comment').checked                   = true;
                  document.getElementById('download_total').checked                     = true;
                  document.getElementById('download_reward').checked                    = true;
                  document.getElementById('download_order_status_id').checked           = true;
                  document.getElementById('download_date_added').checked                = true;
                  document.getElementById('download_shipping_firstname').checked        = true;
                  document.getElementById('download_shipping_lastname').checked         = true;
                  document.getElementById('download_shipping_company').checked          = true;
                  document.getElementById('download_shipping_address_1').checked        = true;
                  document.getElementById('download_shipping_address_2').checked        = true;
                  document.getElementById('download_shipping_city').checked             = true;
                  document.getElementById('download_shipping_postcode').checked         = true;
                  document.getElementById('download_shipping_country').checked          = true;
                  document.getElementById('download_shipping_zone').checked             = true;
                  document.getElementById('download_shipping_address_format').checked   = true;
                  document.getElementById('download_shipping_method').checked           = true;
                  document.getElementById('download_payment_firstname').checked         = true;
                  document.getElementById('download_payment_lastname').checked          = true;
                  document.getElementById('download_payment_company').checked           = true;
                  document.getElementById('download_payment_address_1').checked         = true;
                  document.getElementById('download_payment_address_2').checked         = true;
                  document.getElementById('download_payment_city').checked              = true;
                  document.getElementById('download_payment_postcode').checked          = true;
                  document.getElementById('download_payment_country').checked           = true;
                  document.getElementById('download_payment_zone').checked              = true;
                  document.getElementById('download_payment_address_format').checked    = true;
                  document.getElementById('download_payment_method').checked            = true;
                  document.getElementById('download_commission').checked                = true;
                  document.getElementById('download_currency_value').checked            = true;
                  document.getElementById('download_customer_id').checked               = true;
                  document.getElementById('download_customer_group_id').checked         = true;
                  document.getElementById('download_firstname').checked                 = true;
                  document.getElementById('download_lastname').checked                  = true;
                  document.getElementById('download_email').checked                     = true;
                  document.getElementById('download_telephone').checked                 = true;
                  document.getElementById('download_fax').checked                       = true;
                  document.getElementById('download_product_id').checked                = true;
                  document.getElementById('download_product_name').checked              = true;
                  document.getElementById('download_product_model').checked             = true;
                  document.getElementById('download_product_price').checked             = true;
                  document.getElementById('download_product_total_price').checked       = true;
                  document.getElementById('download_product_quantity').checked          = true;
                  document.getElementById('download_product_option').checked            = true;
                  document.getElementById('download_sku').checked                       = true;
                }
                if(check_type == 'check_all'){checkAll();}
                if(check_type == 'check_none'){uncheckAll();}
                highlightCheckbox();
              }
      
              function uncheckAll(){
                document.getElementById('download_order_id').checked                  = false;
                document.getElementById('download_invoice_no').checked                = false;
                document.getElementById('download_invoice_prefix').checked            = false;
                document.getElementById('download_store_name').checked                = false;
                document.getElementById('download_comment').checked                   = false;
                document.getElementById('download_total').checked                     = false;
                document.getElementById('download_reward').checked                    = false;
                document.getElementById('download_order_status_id').checked           = false;
                document.getElementById('download_date_added').checked                = false;
                document.getElementById('download_date_modified').checked             = false;
                document.getElementById('download_ip').checked                        = false;
                document.getElementById('download_shipping_firstname').checked        = false;
                document.getElementById('download_shipping_lastname').checked         = false;
                document.getElementById('download_shipping_company').checked          = false;
                document.getElementById('download_shipping_address_1').checked        = false;
                document.getElementById('download_shipping_address_2').checked        = false;
                document.getElementById('download_shipping_city').checked             = false;
                document.getElementById('download_shipping_postcode').checked         = false;
                document.getElementById('download_shipping_country').checked          = false;
                document.getElementById('download_shipping_zone').checked             = false;
                document.getElementById('download_shipping_address_format').checked   = false;
                document.getElementById('download_shipping_method').checked           = false;
                document.getElementById('download_payment_firstname').checked         = false;
                document.getElementById('download_payment_lastname').checked          = false;
                document.getElementById('download_payment_company').checked           = false;
                document.getElementById('download_payment_address_1').checked         = false;
                document.getElementById('download_payment_address_2').checked         = false;
                document.getElementById('download_payment_city').checked              = false;
                document.getElementById('download_payment_postcode').checked          = false;
                document.getElementById('download_payment_country').checked           = false;
                document.getElementById('download_payment_zone').checked              = false;
                document.getElementById('download_payment_address_format').checked    = false;
                document.getElementById('download_payment_method').checked            = false;
                document.getElementById('download_affiliate_id').checked              = false;
                document.getElementById('download_commission').checked                = false;
                document.getElementById('download_language_id').checked               = false;
                document.getElementById('download_currency_value').checked            = false;
                document.getElementById('download_customer_id').checked               = false;
                document.getElementById('download_customer_group_id').checked         = false;
                document.getElementById('download_firstname').checked                 = false;
                document.getElementById('download_lastname').checked                  = false;
                document.getElementById('download_email').checked                     = false;
                document.getElementById('download_telephone').checked                 = false;
                document.getElementById('download_fax').checked                       = false;
                document.getElementById('download_product_id').checked                = false;
                document.getElementById('download_product_name').checked              = false;
                document.getElementById('download_product_model').checked             = false;
                document.getElementById('download_product_price').checked             = false;
                document.getElementById('download_product_total_price').checked       = false;
                document.getElementById('download_product_quantity').checked          = false;
                document.getElementById('download_product_option').checked            = false;
                document.getElementById('download_sku').checked                       = false;
              }
      
              function checkAll(){
                document.getElementById('download_order_id').checked                  = true;
                document.getElementById('download_invoice_no').checked                = true;
                document.getElementById('download_invoice_prefix').checked            = true;
                document.getElementById('download_store_name').checked                = true;
                document.getElementById('download_comment').checked                   = true;
                document.getElementById('download_total').checked                     = true;
                document.getElementById('download_reward').checked                    = true;
                document.getElementById('download_order_status_id').checked           = true;
                document.getElementById('download_date_added').checked                = true;
                document.getElementById('download_date_modified').checked             = true;
                document.getElementById('download_ip').checked                        = true;
                document.getElementById('download_shipping_firstname').checked        = true;
                document.getElementById('download_shipping_lastname').checked         = true;
                document.getElementById('download_shipping_company').checked          = true;
                document.getElementById('download_shipping_address_1').checked        = true;
                document.getElementById('download_shipping_address_2').checked        = true;
                document.getElementById('download_shipping_city').checked             = true;
                document.getElementById('download_shipping_postcode').checked         = true;
                document.getElementById('download_shipping_country').checked          = true;
                document.getElementById('download_shipping_zone').checked             = true;
                document.getElementById('download_shipping_address_format').checked   = true;
                document.getElementById('download_shipping_method').checked           = true;
                document.getElementById('download_payment_firstname').checked         = true;
                document.getElementById('download_payment_lastname').checked          = true;
                document.getElementById('download_payment_company').checked           = true;
                document.getElementById('download_payment_address_1').checked         = true;
                document.getElementById('download_payment_address_2').checked         = true;
                document.getElementById('download_payment_city').checked              = true;
                document.getElementById('download_payment_postcode').checked          = true;
                document.getElementById('download_payment_country').checked           = true;
                document.getElementById('download_payment_zone').checked              = true;
                document.getElementById('download_payment_address_format').checked    = true;
                document.getElementById('download_payment_method').checked            = true;
                document.getElementById('download_affiliate_id').checked              = true;
                document.getElementById('download_commission').checked                = true;
                document.getElementById('download_language_id').checked               = true;
                document.getElementById('download_currency_value').checked            = true;
                document.getElementById('download_customer_id').checked               = true;
                document.getElementById('download_customer_group_id').checked         = true;
                document.getElementById('download_firstname').checked                 = true;
                document.getElementById('download_lastname').checked                  = true;
                document.getElementById('download_email').checked                     = true;
                document.getElementById('download_telephone').checked                 = true;
                document.getElementById('download_fax').checked                       = true;
                document.getElementById('download_product_id').checked                = true;
                document.getElementById('download_product_name').checked              = true;
                document.getElementById('download_product_model').checked             = true;
                document.getElementById('download_product_price').checked             = true;
                document.getElementById('download_product_total_price').checked       = true;
                document.getElementById('download_product_quantity').checked          = true;
                document.getElementById('download_product_option').checked            = true;
                document.getElementById('download_sku').checked                       = true;
              }
              
              function highlightCheckbox(){
                $("#form-left input[type=checkbox]").each(function( index ) {
                  var checkbox_id = $(this).attr('id');
                  if($(this).prop("checked") == true){
                    $('label[for='+checkbox_id+']').addClass("highlighted");
                  }else{
                   $('label[for='+checkbox_id+']').removeClass("highlighted");
                  }
                });
              }
              
              $("#excel_export_orders input[type=checkbox]").click(function(){
                highlightCheckbox();
              });
              
          		$('#date-start').datetimepicker({pickTime: false});
          		$('#date-stop').datetimepicker({pickTime: false});
            </script>
            
            </div>
        </form>
      </div>
    </div>
  </div>
</div>
<?php echo $footer; ?>