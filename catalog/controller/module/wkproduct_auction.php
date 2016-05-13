<?php
################################################################################################
#  Product auction Module for Opencart 2.1.x.x from webkul http://webkul.com      #
################################################################################################
?><?php
class ControllerModuleWkproductauction extends Controller {
	
	private $data = array();

	public function index() {
				
		//LOAD LANGUAGE
		$this->language->load('module/wkproduct_auction');

		//SET TITLE
  		$this->data['heading_title'] = $this->language->get('heading_title');
  		$this->data['text_biddetails'] = $this->language->get('text_biddetails');
  		$this->data['text_bidlist'] = $this->language->get('text_bidlist');
  		$this->data['text_bidnow'] = $this->language->get('text_bidnow');
  		$this->data['text_list_bids'] = $this->language->get('text_list_bids');
  		$this->data['text_name'] = $this->language->get('text_name');
  		$this->data['text_bids'] = $this->language->get('text_bids');
  		$this->data['text_nobids'] = $this->language->get('text_nobids');
  		$this->data['text_quantity'] = $this->language->get('text_quantity');
  		$this->data['entry_auction'] = $this->language->get('entry_auction');
  		$this->data['entry_winner'] = $this->language->get('entry_winner');
  		$this->data['entry_time_left'] = $this->language->get('entry_time_left');
  		$this->data['entry_bids'] = $this->language->get('entry_bids');
  		$this->data['entry_min_price'] = $this->language->get('entry_min_price');
  		$this->data['entry_max_price'] = $this->language->get('entry_max_price');
  		$this->data['entry_start_time'] = $this->language->get('entry_start_time');
  		$this->data['entry_close_time'] = $this->language->get('entry_close_time');
  		$this->data['entry_your_price'] = $this->language->get('entry_your_price');
  		$this->data['entry_thnaks'] = $this->language->get('entry_thnaks');
  		$this->data['entry_no_bids'] = $this->language->get('entry_no_bids');
  		$this->data['entry_bids_error'] = $this->language->get('entry_bids_error');
  		$this->data['entry_ammount_error'] = $this->language->get('entry_ammount_error');
  		$this->data['entry_login_error'] = $this->language->get('entry_login_error');
  		$this->data['entry_ammount_less_error'] = $this->language->get('entry_ammount_less_error');
  		$this->data['entry_ammount_range_error'] = $this->language->get('entry_ammount_range_error');
      		
		//LOAD MODEL FILES
		$this->load->model('module/wkproduct_auction');
		$this->document->addScript('catalog/view/javascript/wkproduct_auction/countdown.js');  
		$this->document->addScript('catalog/view/javascript/wkproduct_auction/jquery.lwtCountdown-1.0.js');		
		$this->document->addStyle('catalog/view/theme/default/stylesheet/wkauction.style.css');
		$this->document->addStyle('catalog/view/theme/default/stylesheet/wkauction/main.css');

		$this->load->model('catalog/product');
		$this->data['current_user']=0;
		$this->data['wuser']=0;	
   		if(isset($this->session->data['customer_id']))
	    {
	      $this->data['current_user']=$this->session->data['customer_id'];
	    } 
		$results = array();
		$this->data['winner']=0;
		$this->data['timeout']=0;
		$this->data['auction_id']='';
		$this->data['min']='';
		$this->data['max']='';
		$this->data['end']='';
		$this->data['start']='';
		$this->data['bids']=array();
		if(isset($this->request->get['product_id'])){
		$results = $this->model_module_wkproduct_auction->getAuction($this->request->get['product_id']);
		$bidList = $this->model_module_wkproduct_auction->getProductBids($this->request->get['product_id']);
		$this->data['totalBids'] = $this->model_module_wkproduct_auction->totalBidsOnProduct($this->request->get['product_id']);	
			foreach($bidList as $detail){
			      $this->data['bids'][]=array(
				      'bid' => $this->currency->format($detail['user_bid']),
				      'name' => $detail['firstname']." ".$detail['lastname'],
			      );
			}
        }

		date_default_timezone_set($this->config->get('wkproduct_auction_timezone_set'));
		if (isset($this->request->server['HTTPS']) && (($this->request->server['HTTPS'] == 'on') || ($this->request->server['HTTPS'] == '1'))) {
         		$this->data['base'] = $this->config->get('config_ssl');
      		} else {
         		$this->data['base'] = $this->config->get('config_url');
      		}
	        $count=0;	       
	        foreach ($results as $result) {	        	        	  
	            $this->data['auction_id']=$result['id'];
				$this->data['min']=$this->currency->format($result['min']);
				$this->data['max']=$this->currency->format($result['max']);
				$this->data['end']=$result['end_date'];
				$this->data['start']=$result['start_date'];
				$this->data['quant_limit']=$result['quantity_limit'];
				$this->data['quant_limit']=$result['quantity_limit'];
				$this->data['voucher_limit']=$result['voucher_time_limit'];
				
				if($result['atleast']==''){
					$this->data['atleast'] = $this->currency->format($result['min']);
				}else{
					$this->data['atleast'] = $this->currency->format($result['atleast']);
				}				
				$dat = date('Y-m-d H:i:s');				  
				
				if($result['start_date'] <= $dat && $result['end_date'] > $dat) {
				   	$this->data['timeout']=1;           
				}else if ($count == 0){ 
					$this->model_module_wkproduct_auction->updateAuctionbids($this->data['auction_id']);
				}				
			  $count=$count+1;
		  }
		
		if(isset($this->session->data['bidsuccess'])) {
			$this->data['bidmsg'] = $this->session->data['bidsuccess'];
		    unset($this->session->data['bidsuccess']);
		}

	    $this->data['currency_value'] = $this->currency->getValue($this->session->data['currency']);
	    $this->data['product_id'] = $this->request->get['product_id'];
	    
		$bids=array();
		
		if(isset($this->data['auction_id'])){
			$bids = $this->model_module_wkproduct_auction->getAuctionbids($this->data['auction_id']);
		}

        $this->data['my_bids']=array();
		foreach ($bids as $bid) {
		    $this->data['endDate'] = $this->model_module_wkproduct_auction->getauctionendTime($bid['product_id']);
	            $this->data['my_bids'][]=array(
	            	'user_id' =>$bid['user_id'],
                    'auction_id' =>$bid['auction_id'],
                    'user_bid' =>$bid['user_bid'],
                    'winner'=>$bid['winner'],
                    'end_date' => $bid['end_date'],
	            );
		}
		
		//CHOOSE TEMPLATE
		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/wkproduct_auction.tpl')) {
			return $this->load->view($this->config->get('config_template') . '/template/module/wkproduct_auction.tpl', $this->data);
		} else {
			return $this->load->view('default/template/module/wkproduct_auction.tpl', $this->data);
		}

	}

	public function wkauctionbids(){

		$this->load->model('module/wkproduct_auction');
		$this->language->load('module/wkproduct_auction');
		
		if(isset($this->request->post['auction']) AND isset($this->request->post['bids'])){
				$data = $this->request->post;
				$left = $data['left'];
         		$right = $data['right'];
         		$value = $data['value'];
				$result = $this->model_module_wkproduct_auction->wkauctionbids_viewbids($data['auction']);

		        $text_main = "<div class='bids' style='font-size:11px;'>".$this->language->get('entry_no_bids')."</div>";
		        if($result){
		        	$text = '';
			        foreach ($result as $row) {
			              $ubi=$row['user_bid']*$value;
				          $ubi=round($ubi, 2);
				          $ubid="";
				          $first = $row['firstname'];
				          $last = $row['lastname'];
				          if($left){
				          	$ubid=$left.$ubi;
				           }else{
				         	 $ubid=$ubi.$right;
				           }
				                
				          $text=$text."<tr style=\"height:25px;border:1px solid #858585\"><td style=\"font-size:12px;color:#5C5B4C \">".$first.' '.$last."</td><td style=\"font-size:12px;color:#5C5B4C \">".$ubid."</td></tr>";
			          	}
			          }
		         
		          if(isset($text)){
		          	$text_main = $text;
		          }
		          $json['success'] = $text_main;
				 
		    }

		    if($this->customer->getId()){
			    if(isset($this->request->post['amount']) AND isset($this->request->post['auction'])){
			    	$data = $this->request->post;
			    	$user = (int)$this->customer->getId();
			    	$result = $this->model_module_wkproduct_auction->wkauctionbids_insertbids($data,$user);
			    	$json['success'] = $result;
			    	if($result = 'done') {
						$this->session->data['bidsuccess'] = $this->language->get('text_bid_success');
					}
				 }
			  }		    

	     	$this->response->setOutput(json_encode($json));
	    
	}
}
?>
