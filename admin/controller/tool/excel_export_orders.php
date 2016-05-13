<?php 
class ControllerToolExcelExportOrders extends Controller { 
	private $error = array();
	
	public function index() {
		$this->load->language('tool/excel_export_orders');
		$this->load->model('tool/excel_export_orders');
		
		if(isset($_GET['alert']) AND $_GET['alert'] == 'success'){
      $data['success_alert'] = $this->language->get('text_success');
    }else{$data['success_alert'] = '';}
		
		if(isset($_GET['alert']) AND $_GET['alert'] == 'warning'){
      $data['warning'] = $this->language->get('text_error_warning');
    }else{$data['warning'] = '';}
		
		if ($this->request->server['REQUEST_METHOD'] == 'POST') {
      $xml = $this->model_tool_excel_export_orders->exportExcel($this->request->post);
      if($xml){
        $this->response->redirect($this->url->link('tool/excel_export_orders', 'token=' . $this->session->data['token'] . '&alert=success&download='.$xml, 'SSL'));
      }else{
				$this->response->redirect($this->url->link('tool/excel_export_orders', 'token=' . $this->session->data['token'] . '&alert=warning', 'SSL'));
      }
    }
    
		if(isset($_GET['download'])){
      $redirect_url = '../system/download/'.htmlspecialchars($_GET['download']);
      if(VERSION >= "2.1.0.1"){
        $redirect_url = '../system/storage/download/'.htmlspecialchars($_GET['download']);
      }
      $this->response->redirect($redirect_url);
    }

		
		$this->document->setTitle($this->language->get('heading_title'));

		$data['heading_title']                  = $this->language->get('heading_title');
		$data['text_download_excel']            = $this->language->get('text_download_excel');
    $data['text_order_id']                  = $this->language->get('text_order_id');
    $data['text_invoice_no']                = $this->language->get('text_invoice_no');
    $data['text_invoice_prefix']            = $this->language->get('text_invoice_prefix');
    $data['text_store_id']                  = $this->language->get('text_store_id');
    $data['text_store_name']                = $this->language->get('text_store_name');
    $data['text_store_url']                 = $this->language->get('text_store_url');
    $data['text_customer_id']               = $this->language->get('text_customer_id');
    $data['text_customer_group_id']         = $this->language->get('text_customer_group_id');
    $data['text_firstname']                 = $this->language->get('text_firstname');
    $data['text_lastname']                  = $this->language->get('text_lastname');
    $data['text_email']                     = $this->language->get('text_email');
    $data['text_telephone']                 = $this->language->get('text_telephone');
    $data['text_fax']                       = $this->language->get('text_fax');
    $data['text_shipping_firstname']        = $this->language->get('text_shipping_firstname');
    $data['text_shipping_lastname']         = $this->language->get('text_shipping_lastname');
    $data['text_shipping_company']          = $this->language->get('text_shipping_company');
    $data['text_shipping_address_1']        = $this->language->get('text_shipping_address_1');
    $data['text_shipping_address_2']        = $this->language->get('text_shipping_address_2');
    $data['text_shipping_city']             = $this->language->get('text_shipping_city');
    $data['text_shipping_postcode']         = $this->language->get('text_shipping_postcode');
    $data['text_shipping_country']          = $this->language->get('text_shipping_country');
    $data['text_shipping_country_id']       = $this->language->get('text_shipping_country_id');
    $data['text_shipping_zone']             = $this->language->get('text_shipping_zone');
    $data['text_shipping_zone_id']          = $this->language->get('text_shipping_zone_id');
    $data['text_shipping_address_format']   = $this->language->get('text_shipping_address_format');
    $data['text_shipping_method']           = $this->language->get('text_shipping_method');
    $data['text_payment_firstname']         = $this->language->get('text_payment_firstname');
    $data['text_payment_lastname']          = $this->language->get('text_payment_lastname');
    $data['text_payment_company']           = $this->language->get('text_payment_company');
    $data['text_payment_address_1']         = $this->language->get('text_payment_address_1');
    $data['text_payment_address_2']         = $this->language->get('text_payment_address_2');
    $data['text_payment_city']              = $this->language->get('text_payment_city');
    $data['text_payment_postcode']          = $this->language->get('text_payment_postcode');
    $data['text_payment_country']           = $this->language->get('text_payment_country');
    $data['text_payment_country_id']        = $this->language->get('text_payment_country_id');
    $data['text_payment_zone']              = $this->language->get('text_payment_zone');
    $data['text_payment_zone_id']           = $this->language->get('text_payment_zone_id');
    $data['text_payment_address_format']    = $this->language->get('text_payment_address_format');
    $data['text_payment_method']            = $this->language->get('text_payment_method');
    $data['text_comment']                   = $this->language->get('text_comment');
    $data['text_total']                     = $this->language->get('text_total');
    $data['text_reward']                    = $this->language->get('text_reward');
    $data['text_order_status_id']           = $this->language->get('text_order_status_id');
    $data['text_affiliate_id']              = $this->language->get('text_affiliate_id');
    $data['text_commission']                = $this->language->get('text_commission');
    $data['text_language_id']               = $this->language->get('text_language_id');
    $data['text_currency_id']               = $this->language->get('text_currency_id');
    $data['text_currency_code']             = $this->language->get('text_currency_code');
    $data['text_currency_value']            = $this->language->get('text_currency_value');
    $data['text_date_added']                = $this->language->get('text_date_added');
    $data['text_date_modified']             = $this->language->get('text_date_modified');
    $data['text_ip']                        = $this->language->get('text_ip');
    $data['text_export_date']               = $this->language->get('text_export_date');
    $data['text_to']                        = $this->language->get('text_to');
    $data['text_product_sku']               = $this->language->get('text_product_sku');
    $data['text_order_product']             = $this->language->get('text_order_product');
		$data['text_export']                    = $this->language->get('text_export');
		$data['text_checked']                   = $this->language->get('text_checked');
		$data['text_check_main_data']           = $this->language->get('text_check_main_data');
		$data['text_check_all']                 = $this->language->get('text_check_all');
		$data['text_check_none']                = $this->language->get('text_check_none');
		$data['text_select_language']           = $this->language->get('text_select_language');
		$data['text_check_all_important_data']  = $this->language->get('text_check_all_important_data');
		$data['text_ean']                       = $this->language->get('text_ean');
		$data['text_jan']                       = $this->language->get('text_jan');
		$data['text_isbn']                      = $this->language->get('text_isbn');
		$data['text_mpn']                       = $this->language->get('text_mpn');
		$data['text_product_to_separated_line'] = $this->language->get('text_product_to_separated_line');
		$data['text_yes']                       = $this->language->get('text_yes');
		$data['text_no']                        = $this->language->get('text_no');
		$data['text_product_id']                = $this->language->get('text_product_id');
		$data['text_product_name']              = $this->language->get('text_product_name');
		$data['text_product_model']             = $this->language->get('text_product_model');
		$data['text_product_price']             = $this->language->get('text_product_price');
		$data['text_product_total_price']       = $this->language->get('text_product_total_price');
		$data['text_product_quantity']          = $this->language->get('text_product_quantity');
		$data['text_product_option']            = $this->language->get('text_product_option');
		$data['text_another_setting']           = $this->language->get('text_another_setting');
		$data['text_price_with_symbol']         = $this->language->get('text_price_with_symbol');
		$data['text_cancel']                    = $this->language->get('text_cancel');
		
		
		$year  = date("Y",time());
		$month = date("m",time());
		$day   = date("d",time());
		
		$default_date_start = mktime(0,0,0,$month,$day-1,$year);
		$default_date_stop = mktime(0,0,0,$month,$day,$year);
		
		$data['default_date_start'] = date("Y-m-d",$default_date_start);
		$data['default_date_stop']  = date("Y-m-d",$default_date_stop);
		

 		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}
		
		if (isset($this->session->data['success'])) {
			$data['success'] = $this->session->data['success'];
		
			unset($this->session->data['success']);
		} else {
			$data['success'] = '';
		}
		
		
		
		$data['breadcrumbs'] = array();
 		$data['breadcrumbs'][] = array(
   		'text'      => $this->language->get('text_home'),
    	'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),     		
  		'separator' => false
 		);
 		$data['breadcrumbs'][] = array(
   		'text'      => $this->language->get('heading_title'),
	    'href'      => $this->url->link('tool/excel_export_orders', 'token=' . $this->session->data['token'], 'SSL'),
  		'separator' => ' :: '
 		);

		$data['cancel']    = $this->url->link('extension/modification', 'token=' . $this->session->data['token'], 'SSL');
		$data['languages'] = $this->model_tool_excel_export_orders->getLanguages();

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');
		$this->response->setOutput($this->load->view('tool/excel_export_orders.tpl', $data));
    
    
	}
}
?>