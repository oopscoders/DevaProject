<?php
class ControllerAccountTrackorder extends Controller {
	public function index() {
		 

		$this->load->language('account/trackorder');

		$this->document->setTitle($this->language->get('heading_title'));

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/home')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_account'),
			'href' => $this->url->link('account/trackorder', '', 'SSL')
		);

		if (isset($this->session->data['success'])) {
			$data['success'] = $this->session->data['success'];

			unset($this->session->data['success']);
		} else {
			$data['success'] = '';
		}

		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_email'] = $this->language->get('text_email');
		$data['text_order'] = $this->language->get('text_order');
		$data['button_track'] = $this->language->get('button_track');

		$data['column_left'] = $this->load->controller('common/column_left');
		$data['column_right'] = $this->load->controller('common/column_right');
		$data['content_top'] = $this->load->controller('common/content_top');
		$data['content_bottom'] = $this->load->controller('common/content_bottom');
		$data['footer'] = $this->load->controller('common/footer');
		$data['header'] = $this->load->controller('common/header');

		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/account/trackorder.tpl')) {
			$this->response->setOutput($this->load->view($this->config->get('config_template') . '/template/account/trackorder.tpl', $data));
		} else {
			$this->response->setOutput($this->load->view('default/template/account/trackorder.tpl', $data));
		}
	}

	public function trackOrder() {
		$json = array();
		
		$this->load->language('account/trackorder');
		
		$data['text_empty'] = $this->language->get('text_empty');
		
		$this->load->model('account/trackorder');
		
		if(empty($this->request->post['order_id'])){
			$json['error_order_id'] = $this->language->get('error_order_id');
		}
		
		if ((utf8_strlen($this->request->post['email']) > 96) || !preg_match('/^[^\@]+@.*.[a-z]{2,15}$/i', $this->request->post['email'])) {
			$json['error_email'] = $this->language->get('error_email');
		}
		
		if(!$json) {
			$order_info = $this->model_account_trackorder->getTrackorder($this->request->post['order_id'], $this->request->post['email']);	
			if(!empty($order_info)) {
				$results = $this->model_account_trackorder->getOrderHistoris($this->request->post['order_id']);
				$data['order_histories'] = array();
				foreach($results as $result) {
					$order_status_info = $this->model_account_trackorder->getOrderStatus($result['order_status_id']);
					$data['order_histories'][] = array(
						'order_history_id' => $result['order_history_id'],
						'order_id'         => $result['order_id'],
						'order_status'  => ($order_status_info) ? $order_status_info['name'] : '',
						'notify'           => $result['notify'],
						'comment'          => $result['comment'],
						'date_added'       => date('M d, Y', strtotime($result['date_added'])),
					);	
				}
				
				$data['column_status'] = $this->language->get('column_status');
				$data['column_date_added'] = $this->language->get('column_date_added');
				$data['text_order_history'] = $this->language->get('text_order_history');
				$data['text_your_order'] = sprintf($this->language->get('text_your_order'), $order_info['order_id']);
				
				$json['success'] = $this->language->get('text_success');
				if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/account/trackorder_history.tpl')) {
					$json['order_html'] = $this->load->view($this->config->get('config_template') . '/template/account/trackorder_history.tpl', $data);
				} else {
					$json['order_html'] = $this->load->view('default/template/account/trackorder_history.tpl', $data);
				}
				
			}else{
				$json['error_not_found'] = $this->language->get('error_not_found');
			}
		}
		
	  $this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}
}
