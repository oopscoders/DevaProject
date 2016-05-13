<?php
class Controllercatalogproductzipcode extends Controller {
	private $error = array();

	public function index() {
		$this->load->language('catalog/product_zipcode');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('catalog/product_zipcode');

		$this->getList();
	}

	public function add() {
		$this->load->language('catalog/product_zipcode');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('catalog/product_zipcode');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$this->model_catalog_product_zipcode->add($this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';
			
			if (isset($this->request->get['filter_name'])) {
				$url .= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
			}

			if (isset($this->request->get['filter_model'])) {
				$url .= '&filter_model=' . urlencode(html_entity_decode($this->request->get['filter_model'], ENT_QUOTES, 'UTF-8'));
			}
			
			if (isset($this->request->get['filter_zipcode'])) {
				$url .= '&filter_zipcode=' . urlencode(html_entity_decode($this->request->get['filter_zipcode'], ENT_QUOTES, 'UTF-8'));
			}
			
			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			$this->response->redirect($this->url->link('catalog/product_zipcode', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}

		$this->getForm();
	}
	
	public function addProductZipcode() {
		$this->load->language('catalog/product_zipcode');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('catalog/product_zipcode');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateProductZipCodeForm()) {
			$this->model_catalog_product_zipcode->addProductZipcode($this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';
			
			if (isset($this->request->get['filter_name'])) {
				$url .= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
			}

			if (isset($this->request->get['filter_model'])) {
				$url .= '&filter_model=' . urlencode(html_entity_decode($this->request->get['filter_model'], ENT_QUOTES, 'UTF-8'));
			}
			
			if (isset($this->request->get['filter_zipcode'])) {
				$url .= '&filter_zipcode=' . urlencode(html_entity_decode($this->request->get['filter_zipcode'], ENT_QUOTES, 'UTF-8'));
			}
			
			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			$this->response->redirect($this->url->link('catalog/product_zipcode', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}

		$this->getProductZipCodeForm();
	}

	public function edit() {
		$this->load->language('catalog/product_zipcode');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('catalog/product_zipcode');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$this->model_catalog_product_zipcode->edit($this->request->get['product_id'], $this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';

			if (isset($this->request->get['filter_name'])) {
				$url .= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
			}

			if (isset($this->request->get['filter_model'])) {
				$url .= '&filter_model=' . urlencode(html_entity_decode($this->request->get['filter_model'], ENT_QUOTES, 'UTF-8'));
			}

			if (isset($this->request->get['filter_zipcode'])) {
				$url .= '&filter_zipcode=' . urlencode(html_entity_decode($this->request->get['filter_zipcode'], ENT_QUOTES, 'UTF-8'));
			}
			
			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			$this->response->redirect($this->url->link('catalog/product_zipcode', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}

		$this->getForm();
	}
	
	public function editProductZipcode() {
		$this->load->language('catalog/product_zipcode');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('catalog/product_zipcode');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateProductZipCodeForm()) {
			$this->model_catalog_product_zipcode->editProductZipcode($this->request->get['product_zipcode_id'], $this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';

			if (isset($this->request->get['filter_name'])) {
				$url .= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
			}

			if (isset($this->request->get['filter_model'])) {
				$url .= '&filter_model=' . urlencode(html_entity_decode($this->request->get['filter_model'], ENT_QUOTES, 'UTF-8'));
			}

			if (isset($this->request->get['filter_zipcode'])) {
				$url .= '&filter_zipcode=' . urlencode(html_entity_decode($this->request->get['filter_zipcode'], ENT_QUOTES, 'UTF-8'));
			}
			
			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			$this->response->redirect($this->url->link('catalog/product_zipcode', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}

		$this->getProductZipCodeForm();
	}

	public function delete() {
		$this->load->language('catalog/product_zipcode');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('catalog/product_zipcode');

		if (isset($this->request->post['selected']) && $this->validateDelete()) {
			foreach ($this->request->post['selected'] as $product_zipcode_id) {
				$this->model_catalog_product_zipcode->deleteProductZipcode($product_zipcode_id);
			}

			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';

			if (isset($this->request->get['filter_name'])) {
				$url .= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
			}

			if (isset($this->request->get['filter_model'])) {
				$url .= '&filter_model=' . urlencode(html_entity_decode($this->request->get['filter_model'], ENT_QUOTES, 'UTF-8'));
			}
			
			if (isset($this->request->get['filter_zipcode'])) {
				$url .= '&filter_zipcode=' . urlencode(html_entity_decode($this->request->get['filter_zipcode'], ENT_QUOTES, 'UTF-8'));
			}
			
			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			$this->response->redirect($this->url->link('catalog/product_zipcode', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}

		$this->getList();
	}

	protected function getList() {
		if (isset($this->request->get['filter_name'])) {
			$filter_name = $this->request->get['filter_name'];
		} else {
			$filter_name = null;
		}

		if (isset($this->request->get['filter_model'])) {
			$filter_model = $this->request->get['filter_model'];
		} else {
			$filter_model = null;
		}
		
		if (isset($this->request->get['filter_zipcode'])) {
			$filter_zipcode = $this->request->get['filter_zipcode'];
		} else {
			$filter_zipcode = null;
		}
		
		if (isset($this->request->get['sort'])) {
			$sort = $this->request->get['sort'];
		} else {
			$sort = 'pd.name';
		}

		if (isset($this->request->get['order'])) {
			$order = $this->request->get['order'];
		} else {
			$order = 'ASC';
		}

		if (isset($this->request->get['page'])) {
			$page = $this->request->get['page'];
		} else {
			$page = 1;
		}

		$url = '';

		if (isset($this->request->get['filter_name'])) {
			$url .= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_model'])) {
			$url .= '&filter_model=' . urlencode(html_entity_decode($this->request->get['filter_model'], ENT_QUOTES, 'UTF-8'));
		}
		

		if (isset($this->request->get['filter_zipcode'])) {
			$url .= '&filter_zipcode=' . urlencode(html_entity_decode($this->request->get['filter_zipcode'], ENT_QUOTES, 'UTF-8'));
		}
		
		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}

		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('catalog/product_zipcode', 'token=' . $this->session->data['token'] . $url, 'SSL')
		);

		$data['add'] = $this->url->link('catalog/product_zipcode/add', 'token=' . $this->session->data['token'] . $url, 'SSL');
		$data['delete'] = $this->url->link('catalog/product_zipcode/delete', 'token=' . $this->session->data['token'] . $url, 'SSL');

		$data['product_zipcodes'] = array();

		$filter_data = array(
			'filter_name'	  		=> $filter_name,
			'filter_model'	  	=> $filter_model,
			'filter_zipcode'	  => $filter_zipcode,
			'sort'  => $sort,
			'order' => $order,
			'start' => ($page - 1) * $this->config->get('config_limit_admin'),
			'limit' => $this->config->get('config_limit_admin')
		);

		$product_zipcode_total = $this->model_catalog_product_zipcode->getTotalProductZipcodes($filter_data);

		$results = $this->model_catalog_product_zipcode->getProductZipcodes($filter_data);

		foreach ($results as $result) {
			$data['product_zipcodes'][] = array(
				'product_zipcode_id' => $result['product_zipcode_id'],
				'name'      => $result['name'],
				'model'     => $result['model'],
				'zipcode'     => $result['zipcode'],
				'edit'      => $this->url->link('catalog/product_zipcode/edit', 'token=' . $this->session->data['token'] . '&product_id=' . $result['product_id'] . $url, 'SSL'),
				'edit_product_zipcode'      => $this->url->link('catalog/product_zipcode/editProductZipcode', 'token=' . $this->session->data['token'] . '&product_zipcode_id=' . $result['product_zipcode_id'] . $url, 'SSL')
			);
		}

		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_list'] = $this->language->get('text_list');
		$data['text_no_results'] = $this->language->get('text_no_results');
		$data['text_confirm'] = $this->language->get('text_confirm');

		$data['column_name'] = $this->language->get('column_name');
		$data['column_zipcode'] = $this->language->get('column_zipcode');
		$data['column_model'] = $this->language->get('column_model');
		$data['column_action'] = $this->language->get('column_action');
		
		$data['entry_product'] = $this->language->get('entry_product');
		$data['entry_model'] = $this->language->get('entry_model');
		$data['entry_zipcode'] = $this->language->get('entry_zipcode');
		
		$data['button_filter'] = $this->language->get('button_filter');
		$data['button_add'] = $this->language->get('button_add');
		$data['button_edit'] = $this->language->get('button_edit');
		$data['button_delete'] = $this->language->get('button_delete');
		$data['token'] = $this->session->data['token'];

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

		if (isset($this->request->post['selected'])) {
			$data['selected'] = (array)$this->request->post['selected'];
		} else {
			$data['selected'] = array();
		}

		$url = '';

		
		if (isset($this->request->get['filter_name'])) {
			$url .= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_model'])) {
			$url .= '&filter_model=' . urlencode(html_entity_decode($this->request->get['filter_model'], ENT_QUOTES, 'UTF-8'));
		}
		
		if (isset($this->request->get['filter_zipcode'])) {
			$url .= '&filter_zipcode=' . urlencode(html_entity_decode($this->request->get['filter_zipcode'], ENT_QUOTES, 'UTF-8'));
		}
		
		if ($order == 'ASC') {
			$url .= '&order=DESC';
		} else {
			$url .= '&order=ASC';
		}

		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}

		$data['sort_name'] = $this->url->link('catalog/product_zipcode', 'token=' . $this->session->data['token'] . '&sort=pd.name' . $url, 'SSL');
		$data['sort_model'] = $this->url->link('catalog/product_zipcode', 'token=' . $this->session->data['token'] . '&sort=p.model' . $url, 'SSL');
		$data['sort_zipcode'] = $this->url->link('catalog/product_zipcode', 'token=' . $this->session->data['token'] . '&sort=pz.zipcode' . $url, 'SSL');

		$url = '';

		if (isset($this->request->get['filter_name'])) {
			$url .= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_model'])) {
			$url .= '&filter_model=' . urlencode(html_entity_decode($this->request->get['filter_model'], ENT_QUOTES, 'UTF-8'));
		}
		
		if (isset($this->request->get['filter_zipcode'])) {
			$url .= '&filter_zipcode=' . urlencode(html_entity_decode($this->request->get['filter_zipcode'], ENT_QUOTES, 'UTF-8'));
		}
		
		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}

		$pagination = new Pagination();
		$pagination->total = $product_zipcode_total;
		$pagination->page = $page;
		$pagination->limit = $this->config->get('config_limit_admin');
		$pagination->url = $this->url->link('catalog/product_zipcode', 'token=' . $this->session->data['token'] . $url . '&page={page}', 'SSL');

		$data['pagination'] = $pagination->render();

		$data['results'] = sprintf($this->language->get('text_pagination'), ($product_zipcode_total) ? (($page - 1) * $this->config->get('config_limit_admin')) + 1 : 0, ((($page - 1) * $this->config->get('config_limit_admin')) > ($product_zipcode_total - $this->config->get('config_limit_admin'))) ? $product_zipcode_total : ((($page - 1) * $this->config->get('config_limit_admin')) + $this->config->get('config_limit_admin')), $product_zipcode_total, ceil($product_zipcode_total / $this->config->get('config_limit_admin')));

		$data['filter_name'] = $filter_name;
		$data['filter_model'] = $filter_model;
		$data['filter_zipcode'] = $filter_zipcode;
		
		$data['sort'] = $sort;
		$data['order'] = $order;

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('catalog/product_zipcode_list.tpl', $data));
	}

	protected function getForm() {
		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_form'] = !isset($this->request->get['product_id']) ? $this->language->get('text_add') : $this->language->get('text_edit');
		$data['text_enabled'] = $this->language->get('text_enabled');
		$data['text_disabled'] = $this->language->get('text_disabled');
		$data['text_default'] = $this->language->get('text_default');
		$data['text_none'] = $this->language->get('text_none');

		$data['entry_zipcode'] = $this->language->get('entry_zipcode');
		$data['entry_product'] = $this->language->get('entry_product');
		
		$data['help_product'] = $this->language->get('help_product');

		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel');
		$data['button_product_zipcode_add'] = $this->language->get('button_product_zipcode_add');
		$data['button_remove'] = $this->language->get('button_remove');

		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		if (isset($this->error['product'])) {
			$data['error_product'] = $this->error['product'];
		} else {
			$data['error_product'] = '';
		}
		
		if (isset($this->error['zipcode'])) {
			$data['error_zipcode'] = $this->error['zipcode'];
		} else {
			$data['error_zipcode'] = array();
		}
		
		$url = '';

		if (isset($this->request->get['filter_name'])) {
			$url .= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_model'])) {
			$url .= '&filter_model=' . urlencode(html_entity_decode($this->request->get['filter_model'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_zipcode'])) {
			$url .= '&filter_zipcode=' . urlencode(html_entity_decode($this->request->get['filter_zipcode'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}

		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('catalog/product_zipcode', 'token=' . $this->session->data['token'] . $url, 'SSL')
		);

		if (!isset($this->request->get['product_id'])) {
			$data['action'] = $this->url->link('catalog/product_zipcode/add', 'token=' . $this->session->data['token'] . $url, 'SSL');
		} else {
			$data['action'] = $this->url->link('catalog/product_zipcode/edit', 'token=' . $this->session->data['token'] . '&product_id=' . $this->request->get['product_id'] . $url, 'SSL');
		}

		$data['cancel'] = $this->url->link('catalog/product_zipcode', 'token=' . $this->session->data['token'] . $url, 'SSL');

		if (isset($this->request->get['product_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
			$product_zipcode_info = $this->model_catalog_product_zipcode->getProductZipcode($this->request->get['product_id']);
		}

		$data['token'] = $this->session->data['token'];
		
		$this->load->model('catalog/product');

		if (isset($this->request->post['product_id'])) {
			$data['product_id'] = $this->request->post['product_id'];
		} elseif (!empty($product_zipcode_info)) {
			$data['product_id'] = $product_zipcode_info['product_id'];
		} else {
			$data['product_id'] = 0;
		}

		if (isset($this->request->post['product'])) {
			$data['product'] = $this->request->post['product'];
		} elseif (!empty($product_zipcode_info)) {
			$product_info = $this->model_catalog_product->getProduct($product_zipcode_info['product_id']);

			if ($product_info) {
				$data['product'] = $product_info['name'];
			} else {
				$data['product'] = '';
			}
		} else {
			$data['product'] = '';
		}
		
		
		if (isset($this->request->post['product_zipcode'])) {
			$product_zipcodes = $this->request->post['product_zipcode'];
		} elseif (isset($this->request->get['product_id'])) {
			$product_zipcodes = $this->model_catalog_product_zipcode->getProductZipcodeSettings($this->request->get['product_id']);
		} else {
			$product_zipcodes = array();
		}
		

		$data['product_zipcodes'] = array();

		foreach ($product_zipcodes as $product_zipcode) {
			$data['product_zipcodes'][] = array(
				'zipcode'               => $product_zipcode['zipcode'],
			);
		}

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('catalog/product_zipcode_form.tpl', $data));
	}
	
	protected function getProductZipCodeForm() {
		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_form'] = !isset($this->request->get['product_zipcode_id']) ? $this->language->get('text_add') : $this->language->get('text_edit');
		$data['text_enabled'] = $this->language->get('text_enabled');
		$data['text_disabled'] = $this->language->get('text_disabled');
		$data['text_default'] = $this->language->get('text_default');
		$data['text_none'] = $this->language->get('text_none');

		$data['entry_zipcode'] = $this->language->get('entry_zipcode');
		$data['entry_product'] = $this->language->get('entry_product');
		
		$data['help_product'] = $this->language->get('help_product');

		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel');
		$data['button_product_zipcode_add'] = $this->language->get('button_product_zipcode_add');
		$data['button_remove'] = $this->language->get('button_remove');

		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		if (isset($this->error['product'])) {
			$data['error_product'] = $this->error['product'];
		} else {
			$data['error_product'] = '';
		}
		
		if (isset($this->error['zipcode'])) {
			$data['error_zipcode'] = $this->error['zipcode'];
		} else {
			$data['error_zipcode'] = '';
		}
		
		$url = '';

		if (isset($this->request->get['filter_name'])) {
			$url .= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_model'])) {
			$url .= '&filter_model=' . urlencode(html_entity_decode($this->request->get['filter_model'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_zipcode'])) {
			$url .= '&filter_zipcode=' . urlencode(html_entity_decode($this->request->get['filter_zipcode'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}

		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('catalog/product_zipcode', 'token=' . $this->session->data['token'] . $url, 'SSL')
		);

		if (!isset($this->request->get['product_zipcode_id'])) {
			$data['action'] = $this->url->link('catalog/product_zipcode/addProductZipcode', 'token=' . $this->session->data['token'] . $url, 'SSL');
		}else{
			$data['action'] = $this->url->link('catalog/product_zipcode/editProductZipcode', 'token=' . $this->session->data['token'] . '&product_zipcode_id=' . $this->request->get['product_zipcode_id'] . $url, 'SSL');
		}

		$data['cancel'] = $this->url->link('catalog/product_zipcode', 'token=' . $this->session->data['token'] . $url, 'SSL');

		if (isset($this->request->get['product_zipcode_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
			$product_zipcode_info = $this->model_catalog_product_zipcode->getProductZipcodeById($this->request->get['product_zipcode_id']);
		}

		$data['token'] = $this->session->data['token'];
		
		$this->load->model('catalog/product');

		if (isset($this->request->post['product_id'])) {
			$data['product_id'] = $this->request->post['product_id'];
		} elseif (!empty($product_zipcode_info)) {
			$data['product_id'] = $product_zipcode_info['product_id'];
		} else {
			$data['product_id'] = 0;
		}

		if (isset($this->request->post['product'])) {
			$data['product'] = $this->request->post['product'];
		} elseif (!empty($product_zipcode_info)) {
			$product_info = $this->model_catalog_product->getProduct($product_zipcode_info['product_id']);

			if ($product_info) {
				$data['product'] = $product_info['name'];
			} else {
				$data['product'] = '';
			}
		} else {
			$data['product'] = '';
		}
		
		
		if (isset($this->request->post['zipcode'])) {
			$data['zipcode'] = $this->request->post['zipcode'];
		} elseif (!empty($product_zipcode_info)) {
			$data['zipcode'] = $product_zipcode_info['zipcode'];
		} else {
			$data['zipcode'] = '';
		}
		
		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('catalog/product_zipcode_id_form.tpl', $data));
	}

	protected function validateProductZipCodeForm() {
		if (!$this->user->hasPermission('modify', 'catalog/product_zipcode')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		if (empty($this->request->post['product_id'])) {
			$this->error['product'] = $this->language->get('error_product');
		}
		
		if(utf8_strlen($this->request->post['zipcode']) < 2 || utf8_strlen($this->request->post['zipcode']) > 10){
			$this->error['zipcode'] = $this->language->get('error_zipcode');
		}
		
		return !$this->error;
	}
	
	protected function validateForm() {
		if (!$this->user->hasPermission('modify', 'catalog/product_zipcode')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		if (empty($this->request->post['product_id'])) {
			$this->error['product'] = $this->language->get('error_product');
		}

		if (!empty($this->request->post['product_zipcode'])) {
			foreach ($this->request->post['product_zipcode'] as $row => $value) {
				if(utf8_strlen($value['zipcode']) < 2 || utf8_strlen($value['zipcode']) > 10){
					$this->error['zipcode'][$row]['zipcode'] = $this->language->get('error_zipcode');
				}
			}
		}else{
			$this->error['warning'] = $this->language->get('error_empty_zipcode');
		}

		return !$this->error;
	}

	protected function validateDelete() {
		if (!$this->user->hasPermission('modify', 'catalog/product_zipcode')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		return !$this->error;
	}
}