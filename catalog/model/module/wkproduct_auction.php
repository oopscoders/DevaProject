<?php

################################################################################################
# Product auction for Opencart 2.1.x.x From webkul http://webkul.com    #
################################################################################################
class ModelModuleWkproductauction extends Model {
	
	public function getProductBids($product_id){
		$date = new DateTime('2014-06-1', new DateTimeZone($this->config->get('wkproduct_auction_timezone_set')));
		$zone = $date->format('P');
		$query = "SELECT CONVERT_TZ(NOW(), @@session.time_zone, '$zone') as time;";
		$data = $this->db->query($query)->row;
		$time = date("Y-m-d H:i:s", strtotime($data['time']));

	      $result = $this->db->query("SELECT  wab.user_bid,c.firstname,c.lastname FROM ".DB_PREFIX."wkauctionbids wab LEFT JOIN ".DB_PREFIX."customer c ON wab.user_id=c.customer_id WHERE wab.product_id = '".$product_id."' AND wab.start_date <= '".$time."' AND wab.end_date >= '".$time."' AND winner != 1 ORDER BY wab.user_bid DESC LIMIT 0,10")->rows;
	    return $result;
	}
	public function getProductAuction(){
		$date = new DateTime('2014-06-1', new DateTimeZone($this->config->get('wkproduct_auction_timezone_set')));
		$zone = $date->format('P');
		$query = "SELECT CONVERT_TZ(NOW(), @@session.time_zone, '$zone') as time;";
		$data = $this->db->query($query)->row;
		$time = date("Y-m-d H:i:s", strtotime($data['time']));

	      $result = $this->db->query("SELECT * FROM ".DB_PREFIX."wkauction WHERE start_date <= '".$time."' AND end_date >= '".$time."' AND isauction = 1 ")->rows;	     
	      return $result;
	}	
	public function getAuction($product_id) {
		$data = $this->db->query("SELECT MAX(wab.user_bid) atleast,wa.* FROM " . DB_PREFIX . "wkauction wa LEFT JOIN ". DB_PREFIX . "wkauctionbids wab ON (wa.id=wab.auction_id)  WHERE wa.product_id = '" . (int)$product_id . "' AND isauction=1");
		return $data->rows;
	}
	public function getAuctionbids($auction_id) {
		$data = $this->db->query("SELECT * FROM " . DB_PREFIX . "wkauctionbids WHERE sold=0 AND auction_id = '" . (int)$auction_id . "' ORDER BY user_bid");
		return $data->rows;
	}
	public function getauctionendTime($product_id){
		$data = $this->db->query("SELECT end_date FROM ".DB_PREFIX."wkauction WHERE product_id = '".$product_id."'");
		return $data->row;
	}
	
	public function totalBidsOnProduct($product_id){
		$countBids = $this->db->query("SELECT wa.end_date FROM ".DB_PREFIX."wkauction wa LEFT JOIN ".DB_PREFIX."wkauctionbids wab ON wa.end_date=wab.end_date WHERE wab.product_id='".$product_id."'")->rows;
		return count($countBids);
	}
	public function updateAuctionbids($auction_id) {
		$date = new DateTime('2014-06-01', new DateTimeZone($this->config->get('wkproduct_auction_timezone_set')));
		$zone = $date->format('P');
		$query = "SELECT CONVERT_TZ(NOW(), @@session.time_zone, '$zone') as time;";
		$data = $this->db->query($query)->row;
		$time = date("Y-m-d H:i:s", strtotime($data['time']));
		
		$check = $this->db->query("SELECT wab.id FROM ".DB_PREFIX."wkauction wa LEFT JOIN ".DB_PREFIX."wkauctionbids wab ON wa.end_date=wab.end_date WHERE wa.id='".$auction_id."' ")->row;

		if(!empty($check['id'])){
		$this->language->load('module/wkproduct_auction');

		$bids=$this->db->query("SELECT MAX(user_bid) id FROM " . DB_PREFIX . "wkauctionbids WHERE auction_id = '" . (int)$auction_id . "' AND winner = '0' ");
		$bid_id=$bids->row;

        $ids=$this->db->query("SELECT * FROM " . DB_PREFIX . "wkauctionbids WHERE user_bid='" . (double)$bid_id['id'] . "'");
        $record=$ids->row;
        
        if(!isset($record['product_id'])){
        	$this->db->query("UPDATE " . DB_PREFIX . "wkauction SET isauction=0 WHERE id = '" .(int)$auction_id . "'");
        	return true;
        }
        $price=$this->db->query("SELECT price FROM " . DB_PREFIX . "product WHERE product_id='" . (int)$record['product_id'] . "'");
		$price=$price->row;
		$code=rand();
		$discount=$price['price']-$bid_id['id'];

		$quantity = $this->db->query("SELECT quantity_limit ,product_id FROM " . DB_PREFIX . "wkauction WHERE id =".(int)$auction_id ." ")->row;		

		$total=$price['price']*$quantity['quantity_limit'];
		
		$voucher_limit= $this->db->query("SELECT voucher_time_limit FROM " . DB_PREFIX . "wkauction WHERE id = '" .(int)$auction_id . "'")->row;

		$this->db->query("INSERT INTO " . DB_PREFIX . "coupon SET name ='Bid Coupon',uses_total=1,uses_customer='1',type='F',status=1,code = '" .$code. "',discount = '" .$discount. "',total = '" .$total. "', date_start = '".$time."',date_end = '" . $voucher_limit['voucher_time_limit'] . "'");

		$coupon=$this->db->query("SELECT MAX(coupon_id) id, date_end FROM " . DB_PREFIX . "coupon")->row;
	
		$this->db->query("INSERT INTO " . DB_PREFIX . "coupon_product SET coupon_id = '" .(int)$coupon['id']. "',product_id = '" .(int)$record['product_id']. "'");
		$this->db->query("UPDATE " . DB_PREFIX . "wkauctionbids SET winner=1 WHERE user_bid='" . (double)$bid_id['id'] . "'");
        $this->db->query("UPDATE " . DB_PREFIX . "wkauction SET isauction=0 WHERE id = '" .(int)$auction_id . "'");

        $prod=$this->db->query("SELECT name FROM " . DB_PREFIX . "product_description WHERE product_id='" . (int)$record['product_id'] . "'")->row;
        
        $detail= $this->language->get('bid_message_customer_message1').$prod['name'].$this->language->get('bid_message_customer_message2').$code. $this->language->get('bid_message_customer_message3').date('d-m-Y', strtotime($voucher_limit['voucher_time_limit'])). $this->language->get('bid_message_customer_message4');
  
        $customer=$this->db->query("SELECT * FROM ".DB_PREFIX ."customer WHERE customer_id='" . (int)$record['user_id'] . "'")->row;

		$admindetail= $this->language->get('bid_message_admin_message1').$customer['firstname']." ".$customer['lastname'] .$this->language->get('bid_message_admin_message2').$prod['name'].$this->language->get('bid_message_admin_message3').$code.$this->language->get('bid_message_admin_message4').date('d-m-Y', strtotime($voucher_limit['voucher_time_limit'])).'.';
		
		$language = new Language('catalog/');
		
		$language->load('catalog/mail');

		$data['text_hello'] = $language->get('text_hello');	
		$data['text_name'] = $language->get('entry_name');	
		$data['text_email'] = $language->get('email');					
		$data['text_pname'] = $language->get('entry_pname').$prod['name'];		
		$data['text_to_admin'] = html_entity_decode($admindetail, ENT_QUOTES, 'UTF-8');
		$data['text_to_seller'] = html_entity_decode($detail, ENT_QUOTES, 'UTF-8');
		$data['text_auto'] = false;		
		$data['text_sellersubject'] = $language->get('ptext_sellersubject');
		$data['text_adminsubject'] = $language->get('ptext_adminsubject');

		$data['text_thanksadmin'] = $language->get('text_thanksadmin');	

		$data['autoApprove'] = false;	
		$data['name'] = $this->config->get('config_name');

		$data['store_name'] = $this->config->get('store_name');
		$data['store_url'] = HTTP_SERVER;
		$data['logo'] = HTTP_SERVER.'image/' . $this->config->get('config_logo');			
		$data['customer'] = $customer;

		$data['seller'] = true;			

		$html = $this->load->view('default/template/catalog/pmail.tpl', $data);

		$toAdmin=array();
		$toseller=array();

		$toseller['emailto']=$customer['email'];
		$toseller['message']=$html;
		$toseller['mailfrom']=$this->config->get('config_email');
		$toseller['subject']=$this->language->get('bid_message_customer_subject');
		$toseller['name']=$this->config->get('config_name');
		$sta = $this->sendMail($toseller);
		
		$data['seller'] = false;			
		$data['admin'] = true;
		$html = $this->load->view('default/template/catalog/pmail.tpl', $data);
		
		$toAdmin['emailto']=$this->config->get('config_email');
		$toAdmin['message']=$html;
		$toAdmin['mailfrom']=$this->config->get('config_email');
		$toAdmin['subject']=$this->language->get('bid_message_customer_subject');
		$toAdmin['name']=$customer['firstname']." ".$customer['lastname'];
		$this->sendMail($toAdmin);
		return true;
		}
	}

    public function sendMail($data){
		$mail = new Mail();	
		$mail->protocol = $this->config->get('config_mail_protocol');
		$mail->parameter = $this->config->get('config_mail_parameter');
		$mail->hostname = $this->config->get('config_smtp_host');
		$mail->username = $this->config->get('config_smtp_username');
		$mail->password = $this->config->get('config_smtp_password');
		$mail->port = $this->config->get('config_smtp_port');
		$mail->timeout = $this->config->get('config_smtp_timeout');				
		$mail->setTo($data['emailto']);
		$mail->setFrom($data['mailfrom']);
		$mail->setSender($data['name']);
		$mail->setSubject(html_entity_decode($data['subject'], ENT_QUOTES, 'UTF-8'));					
		$mail->setHtml($data['message']);
		$mail->send();
	}

	public function wkauctionbids_viewbids($auction){
			$query =$this->db->query("SELECT c.firstname,c.lastname,wa.user_bid FROM " . DB_PREFIX . "wkauctionbids wa LEFT JOIN ". DB_PREFIX ."customer c ON (c.customer_id=wa.user_id) WHERE wa.auction_id = '" . (int)$auction . "' AND winner != 1 ORDER BY wa.user_bid DESC");
		        return $query->rows;
	}

	public function wkauctionbids_insertbids($data,$user){
		$date = new DateTime('2014-06-1', new DateTimeZone($this->config->get('wkproduct_auction_timezone_set')));
		$zone = $date->format('P');
		$query = "SELECT CONVERT_TZ(NOW(), @@session.time_zone, '$zone') as time;";
		$cur_time = $this->db->query($query)->row;
		
		$userExist = $this->db->query("SELECT user_id,product_id FROM ".DB_PREFIX."wkauctionbids WHERE user_id = '".$data['user']."' AND product_id='".$data['product_id']."' AND winner = 0 " )->row;
		$sql = "SELECT MAX(wab.user_bid) id,wa.min,wa.max,wa.product_id FROM " . DB_PREFIX . "wkauction wa LEFT JOIN ". DB_PREFIX . "wkauctionbids wab ON (wa.id=wab.auction_id) WHERE wa.id = '" . (int)$data['auction'] . "' AND wab.winner = 0 AND wab.start_date<='".$cur_time['time']."' AND wab.end_date>='".$cur_time['time']."' ";
	
        $sql=$this->db->query($sql)->row;
    
        $range = $this->db->query("SELECT min,max FROM ".DB_PREFIX."wkauction WHERE id='".$data['auction']."' ")->row;

            if($data['amount']>=$range['max'] || $data['amount']<=$range['min']){
			  return 'not done';
			}
               
            if(isset($sql['product_id'])){
				  if(count($sql)!=0 && $data['amount']<=$sql['id']){
				      return 'not'; //only for checking not messages
				  }
            }
	  if($userExist){
	      $query=$this->db->query("UPDATE " . DB_PREFIX . "wkauctionbids SET winner='0',sold='0',auction_id = '" . (int)$data['auction']. "', user_id = '" .(int)$user."', product_id = '" .(int)$data['product_id']."', start_date = '" .$this->db->escape($data['start_date']). "', end_date = '" .$this->db->escape($data['end_date'])."', date = '".$cur_time['time']."', user_bid = '" .(double)$data['amount']."' WHERE user_id = '".$userExist['user_id']."' AND product_id = '".$userExist['product_id']."' AND winner = 0 ");
	  }else{
	     $query=$this->db->query("INSERT INTO " . DB_PREFIX . "wkauctionbids SET winner='0',sold='0',auction_id = '" . (int)$data['auction']. "', user_id = '" .(int)$user."', product_id = '" .(int)$data['product_id']."', start_date = '" .$this->db->escape($data['start_date']). "', end_date = '" .$this->db->escape($data['end_date'])."', date = '".$cur_time['time']."', user_bid = '" .(double)$data['amount']."'");
	  }
               return 'done';  //only for checking not mesaages
	}

}

?>
