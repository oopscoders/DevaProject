<?php
class ControllerModuleSliderpPlus extends Controller
{
	private $error = array();
	
	public function index()
	{
		$this->load->language('module/sliderpplus');
		
		$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('extension/module');
		
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			if (!isset($this->request->get['module_id'])) {
				$this->model_extension_module->addModule('sliderpplus', $this->request->post);
			} else {
				$this->model_extension_module->editModule($this->request->get['module_id'], $this->request->post);
			}
			
			$this->session->data['success'] = $this->language->get('text_success');
			
			$this->response->redirect($this->url->link('extension/module', 'token=' . $this->session->data['token'] , 'SSL'));
		
		}
		
		$data['heading_title'] = $this->language->get('heading_title');
		
		$data['text_edit']     = $this->language->get('text_edit');
		$data['text_enabled']  = $this->language->get('text_enabled');
		$data['text_disabled'] = $this->language->get('text_disabled');
		
		$data['entry_name']       = $this->language->get('entry_name');
		$data['entry_banner']     = $this->language->get('entry_banner');
		$data['entry_title']      = $this->language->get('entry_title');
		$data['entry_link']       = $this->language->get('entry_link');
		$data['entry_image']      = $this->language->get('entry_image');
		$data['entry_sort_order'] = $this->language->get('entry_sort_order');
		$data['entry_width']      = $this->language->get('entry_width');
		$data['entry_height']     = $this->language->get('entry_height');
		$data['entry_effect']     = $this->language->get('entry_effect');
		$data['entry_status']     = $this->language->get('entry_status');
		
		$data['button_save']       = $this->language->get('button_save');
		$data['button_cancel']     = $this->language->get('button_cancel');
		$data['button_banner_add'] = $this->language->get('button_banner_add');
		$data['button_remove']     = $this->language->get('button_remove');
		
		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}
		
		if (isset($this->error['name'])) {
			$data['error_name'] = $this->error['name'];
		} else {
			$data['error_name'] = '';
		}
		
		if (isset($this->error['width'])) {
			$data['error_width'] = $this->error['width'];
		} else {
			$data['error_width'] = '';
		}
		
		if (isset($this->error['height'])) {
			$data['error_height'] = $this->error['height'];
		} else {
			$data['error_height'] = '';
		}
		
		$data['breadcrumbs'] = array();
		
		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL')
		);
		
		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_module'),
			'href' => $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL')
		);
		
		if (!isset($this->request->get['module_id'])) {
			$data['breadcrumbs'][] = array(
				'text' => $this->language->get('heading_title'),
				'href' => $this->url->link('module/sliderpplus', 'token=' . $this->session->data['token'], 'SSL')
			);
		} else {
			$data['breadcrumbs'][] = array(
				'text' => $this->language->get('heading_title'),
				'href' => $this->url->link('module/sliderpplus', 'token=' . $this->session->data['token'] . '&module_id=' . $this->request->get['module_id'], 'SSL')
			);
		}
		
		if (!isset($this->request->get['module_id'])) {
			$data['action'] = $this->url->link('module/sliderpplus', 'token=' . $this->session->data['token'], 'SSL');
		} else {
			$data['action'] = $this->url->link('module/sliderpplus', 'token=' . $this->session->data['token'] . '&module_id=' . $this->request->get['module_id'], 'SSL');
		}
		
		$data['cancel'] = $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL');
		
		if (isset($this->request->get['module_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
			$module_info = $this->model_extension_module->getModule($this->request->get['module_id']);
		}
		
		if (isset($this->request->post['name'])) {
			$data['name'] = $this->request->post['name'];
		} elseif (!empty($module_info)) {
			$data['name'] = $module_info['name'];
		} else {
			$data['name'] = '';
		}
		
		$this->load->model('localisation/language');
		
		$data['languages'] = $this->model_localisation_language->getLanguages();
		
		$this->load->model('tool/image');
		
		if (isset($this->request->post['banner_image'])) {
			$banner_images = $this->request->post['banner_image'];
		} elseif (!empty($module_info['banner_image'])) {
			$banner_images = $module_info['banner_image'];
		} else {
			$banner_images = array();
		}
		
		$data['banner_images'] = array();
		
		foreach ($banner_images as $banner_image) {
			if (is_file(DIR_IMAGE . $banner_image['image'])) {
				$image = $banner_image['image'];
				$thumb = $banner_image['image'];
			} else {
				$image = '';
				$thumb = 'no_image.png';
			}
			
			$data['banner_images'][$banner_image['sort_order']] = array(
				'banner_image_description' => $banner_image['banner_image_description'],
				'link' 	=> $banner_image['link'],
				'image' => $image,
				'thumb' => $this->model_tool_image->resize($thumb, 100, 100),
				'sort_order' => $banner_image['sort_order']
			);
		}
		
		ksort($data['banner_images']);
		
		if (isset($this->request->post['width'])) {
			$data['width'] = $this->request->post['width'];
		} elseif (!empty($module_info)) {
			$data['width'] = $module_info['width'];
		} else {
			$data['width'] = '';
		}
		
		if (isset($this->request->post['height'])) {
			$data['height'] = $this->request->post['height'];
		} elseif (!empty($module_info)) {
			$data['height'] = $module_info['height'];
		} else {
			$data['height'] = '';
		}
		
		$data['effect_seletor'] = array(
			'fade' 		=> 'Fade',
			'backSlide' => 'Back Slide',
			'goDown' 	=> 'Go Down',
			'fadeUp' 	=> 'Fade Up'
		);
		
		if (isset($this->request->post['effect'])) {
			$data['effect'] = $this->request->post['effect'];
		} elseif (!empty($module_info['effect'])) {
			$data['effect'] = $module_info['effect'];
		} else {
			$data['effect'] = '';
		}
		
		if (isset($this->request->post['status'])) {
			$data['status'] = $this->request->post['status'];
		} elseif (!empty($module_info)) {
			$data['status'] = $module_info['status'];
		} else {
			$data['status'] = '';
		}
		
		
		$data['placeholder'] = $this->model_tool_image->resize('no_image.png', 100, 100);
		
		$data['header']      = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer']      = $this->load->controller('common/footer');
		
		$this->response->setOutput($this->load->view('module/sliderpplus.tpl', $data));
	}
	
	protected function validate()
	{
		if (!$this->user->hasPermission('modify', 'module/sliderpplus')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
		
		if ((utf8_strlen($this->request->post['name']) < 3) || (utf8_strlen($this->request->post['name']) > 64)) {
			$this->error['name'] = $this->language->get('error_name');
		}
		
		if (empty($this->request->post['banner_image'])) {
			$this->error['warning'] = $this->language->get('error_banner');
		}
		
		if (!$this->request->post['width']) {
			$this->error['width'] = $this->language->get('error_width');
		}
		
		if (!$this->request->post['height']) {
			$this->error['height'] = $this->language->get('error_height');
		}
		
		return !$this->error;
	}
}
