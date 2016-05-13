<?php
/******************************************************
 * @package Camera Slideshow for Opencart 1.5.x
 * @version 1.0
 * @author EcomTeck (http://ecomteck.com)
 * @copyright	Copyright (C) May 2013 ecomteck.com <@emai:ecomteck@gmail.com>.All rights reserved.
 * @license		GNU General Public License version 2
*******************************************************/

class ControllerModuleEcslideshow extends Controller {
	private $error = array();

	public function index() {
		$data = array();

		$this->language->load('module/ecslideshow');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('extension/module');

		$this->load->model('ecslideshow/banner');

		$this->model_ecslideshow_banner->installModule();

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$action = isset($this->request->post["action"])?$this->request->post["action"]:"";
			unset($this->request->post["action"]);
			if (!isset($this->request->get['module_id'])) {
				$this->model_extension_module->addModule('ecslideshow', $this->request->post);
			} else {
				$this->model_extension_module->editModule($this->request->get['module_id'], $this->request->post);
			}	

			$this->session->data['success'] = $this->language->get('text_success');

			$module_id = isset($this->request->get['module_id'])?'&module_id='.$this->request->get['module_id']:'';

			if($action == "save_stay"){
				$this->response->redirect($this->url->link('module/ecslideshow', 'token=' . $this->session->data['token'].$module_id, 'SSL'));
			}else{
				$this->response->redirect($this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'));
			}

		}

		$this->document->addScript('view/javascript/ecslideshow/color_picker/js/colpick.js');
		$this->document->addStyle('view/javascript/ecslideshow/color_picker/css/colpick.css');
		$this->document->addStyle('view/stylesheet/ecslideshow.css');
		$data['heading_title'] = $this->language->get('heading_title');

		$data['language'] = $this->language;
		$data['text_module_setting'] = $this->language->get('text_module_setting');
		$data['text_enabled'] = $this->language->get('text_enabled');
		$data['text_disabled'] = $this->language->get('text_disabled');
		$data['text_header_top'] = $this->language->get('text_header_top');
		$data['text_header_bottom'] = $this->language->get('text_header_bottom');
		$data['text_content_top'] = $this->language->get('text_content_top');
		$data['text_content_bottom'] = $this->language->get('text_content_bottom');
		$data['text_column_left'] = $this->language->get('text_column_left');
		$data['text_column_right'] = $this->language->get('text_column_right');
        $data['text_footer_top'] = $this->language->get('text_footer_top');
		$data['text_footer_bottom'] = $this->language->get('text_footer_bottom');
        $data['text_alllayout'] = $this->language->get('text_alllayout');
		$data['text_default'] = $this->language->get('text_default');

		$data['entry_name'] = $this->language->get('entry_name');

		$data['entry_strip_html_code'] = $this->language->get('entry_strip_html_code');

		$data['entry_content'] = $this->language->get('entry_content');
		$data['entry_layout'] = $this->language->get('entry_layout');
		$data['entry_store'] = $this->language->get('entry_store');
		$data['entry_position'] = $this->language->get('entry_position');
		$data['entry_status'] = $this->language->get('entry_status');
		$data['entry_sort_order'] = $this->language->get('entry_sort_order');
		$data['entry_custom_position'] = $this->language->get('entry_custom_position');
		$data['help_custom_position'] = $this->language->get('help_custom_position');
		$data['entry_show_custom_code'] = $this->language->get('entry_show_custom_code');

		$data['button_save'] = $this->language->get('button_save');
		$data['button_save_stay'] = $this->language->get('button_save_stay');
		$data['button_cancel'] = $this->language->get('button_cancel');
		$data['button_add_new_block'] = $this->language->get('button_add_new_block');
		$data['text_alllayout'] = $this->language->get('text_all_layout');
		$data['link_to_module'] = $this->url->link('module/ecslideshow', 'token=' . $this->session->data['token'], 'SSL');
		$data['link_to_banner'] = $this->url->link('module/ecslideshow/banner', 'token=' . $this->session->data['token'], 'SSL');

		$data['button_remove'] = $this->language->get('button_remove');

		$data['entry_support_rtl'] = $this->language->get('entry_support_rtl');
		$data['entry_banner'] = $this->language->get('entry_banner');
		$data['help_banner'] = $this->language->get('help_banner');
		$data['text_select_banner'] = $this->language->get('text_select_banner');
		$data['entry_limit'] = $this->language->get('entry_limit');
		$data['entry_random_slider'] = $this->language->get('entry_random_slider');
		$data['entry_module_width'] = $this->language->get('entry_module_width');
		$data['entry_module_height'] = $this->language->get('entry_module_height');
		$data['entry_main_width'] = $this->language->get('entry_main_width');
		$data['entry_main_height'] = $this->language->get('entry_main_height');
		$data['entry_thumbnail_width'] = $this->language->get('entry_thumbnail_width');
		$data['entry_thumbnail_height'] = $this->language->get('entry_thumbnail_height');
		$data['entry_resize_main_image'] = $this->language->get('entry_resize_main_image');
		$data['entry_resize_type'] = $this->language->get('entry_resize_type');
		$data['entry_slider_caption'] = $this->language->get('entry_slider_caption');
		$data['entry_show_caption'] = $this->language->get('entry_show_caption');
		$data['entry_caption_effect'] = $this->language->get('entry_caption_effect');
		$data['entry_show_product_info'] = $this->language->get('entry_show_product_info');
		$data['entry_title_max_chars'] = $this->language->get('entry_title_max_chars');
		$data['entry_description_max_chars'] = $this->language->get('entry_description_max_chars');
		$data['entry_caption_background_color'] = $this->language->get('entry_caption_background_color');
		$data['entry_caption_text_color'] = $this->language->get('entry_caption_text_color');
		$data['entry_caption_link_color'] = $this->language->get('entry_caption_link_color');
		$data['entry_custom_css'] = $this->language->get('entry_custom_css');
		$data['entry_addtocart_bg_color'] = $this->language->get('entry_addtocart_bg_color');
		$data['entry_addtocart_color'] = $this->language->get('entry_addtocart_color');
		$data['entry_price_color'] = $this->language->get('entry_price_color');
		$data['entry_special_price_color'] = $this->language->get('entry_special_price_color');
		$data['entry_slider_effect'] = $this->language->get('entry_slider_effect');
		$data['entry_skin'] = $this->language->get('entry_skin');
		$data['entry_alignment'] = $this->language->get('entry_alignment');
		$data['entry_auto_advance'] = $this->language->get('entry_auto_advance');
		$data['entry_mobile_auto_advance'] = $this->language->get('entry_mobile_auto_advance');
		$data['entry_bar_direction'] = $this->language->get('entry_bar_direction');
		$data['entry_bar_position'] = $this->language->get('entry_bar_position');
		$data['entry_slide_height'] = $this->language->get('entry_slide_height');
		$data['entry_min_height'] = $this->language->get('entry_min_height');
		$data['entry_cols'] = $this->language->get('entry_cols');
		$data['entry_rows'] = $this->language->get('entry_rows');
		$data['entry_easing'] = $this->language->get('entry_easing');
		$data['entry_fx'] = $this->language->get('entry_fx');
		$data['entry_hover'] = $this->language->get('entry_hover');
		$data['entry_loader'] = $this->language->get('entry_loader');
		$data['entry_navigation'] = $this->language->get('entry_navigation');
		$data['entry_navigation_hover'] = $this->language->get('entry_navigation_hover');
		$data['entry_pagination'] = $this->language->get('entry_pagination');
		$data['entry_play_pause'] = $this->language->get('entry_play_pause');
		$data['entry_thumbnails'] = $this->language->get('entry_thumbnails');
		$data['entry_time'] = $this->language->get('entry_time');
		$data['entry_trans_period'] = $this->language->get('entry_trans_period');
		$data['entry_async_loading'] = $this->language->get('entry_async_loading');
		$data['tab_block'] = $this->language->get('tab_block');
		$data['tab_module'] = $this->language->get('tab_module');


		if (isset($this->error['name'])) {
			$data['error_name'] = $this->error['name'];
		} else {
			$data['error_name'] = '';
		}

		$data['resiztypes'] = array(''=>$this->language->get('text_default'),
										 'default'=>$this->language->get('text_white_space'),
										 'w'=>$this->language->get("text_resize_width"),
										 'h'=>$this->language->get("text_resize_height"));

		$data['positions'] = array(
										  'content_top',
										  'content_bottom',
										  'column_left',
										  'column_right'
		);
		$data['caption_effects'] = array('moveFromLeft',
										'moveFomRight',
										'moveFromTop',
										'moveFromBottom',
										'fadeIn',
										'fadeFromLeft',
										'fadeFromRight',
										'fadeFromTop',
										'fadeFromBottom');

   	 	$data['skins'] = array("camera_amber_skin",
								"camera_ash_skin",
								"camera_azure_skin",
								"camera_beige_skin",
								"camera_black_skin",
								"camera_blue_skin",
								"camera_brown_skin",
								"camera_burgundy_skin",
								"camera_charcoal_skin",
								"camera_chocolate_skin",
								"camera_coffee_skin",
								"camera_cyan_skin",
								"camera_fuchsia_skin",
								"camera_gold_skin",
								"camera_green_skin",
								"camera_grey_skin",
								"camera_indigo_skin",
								"camera_khaki_skin",
								"camera_lime_skin",
								"camera_magenta_skin",
								"camera_maroon_skin",
								"camera_orange_skin",
								"camera_olive_skin",
								"camera_pink_skin",
								"camera_pistachio_skin",
								"camera_red_skin",
								"camera_tangerine_skin",
								"camera_turquoise_skin",
								"camera_violet_skin",
								"camera_white_skin",
								"camera_yellow_skin");
   		$data['alignments'] = array("topLeft",
									"topCenter",
									"topRight",
									"centerLeft",
									"center",
									"centerRight",
									"bottomLeft",
									"bottomCenter",
									"bottomRight");
   		$data['directions'] = array("leftToRight",
   											"rightToLeft",
   											"topToBottom",
   											"bottomToTop");
   		$data['bar_positions'] = array("left","right","top","bottom");
   		$data['easings'] = array('linear',
   										'swing',
   										'easeInQuad',
   										'easeOutQuad',
   										'easeInOutQuad',
   										'easeInCubic',
   										'easeOutCubic',
   										'easeInOutCubic',
   										'easeInQuart',
   										'easeOutQuart',
   										'easeInOutQuart',
   										'easeInQuint',
   										'easeOutQuint',
   										'easeInOutQuint',
   										'easeInExpo',
   										'easeOutExpo',
   										'easeInOutExpo',
   										'easeInSine',
   										'easeOutSine',
   										'easeInOutSine',
   										'easeInCirc',
   										'easeOutCirc',
   										'easeInOutCirc',
   										'easeInElastic',
   										'easeOutElastic',
   										'easeInOutElastic',
   										'easeInBack',
   										'easeOutBack',
   										'easeInOutBack',
   										'easeInBounce',
   										'easeOutBounce',
   										'easeInOutBounce'
   										);
   		$fx = "random,simpleFade,curtainTopLeft,curtainTopRight,curtainBottomLeft,curtainBottomRight,curtainSliceLeft,curtainSliceRight,blindCurtainTopLeft,blindCurtainTopRight,blindCurtainBottomLeft,blindCurtainBottomRight,blindCurtainSliceBottom,blindCurtainSliceTop,stampede,mosaic,mosaicReverse,mosaicRandom,mosaicSpiral,mosaicSpiralReverse,topLeftBottomRight,bottomRightTopLeft,bottomLeftTopRight,bottomLeftTopRight,scrollLeft,scrollRight,scrollHorz,scrollBottom,scrollTop";

   		$data['effects'] = explode(",",$fx);
   		$loaders = "pie,bar,none";
   		$data['loaders'] = explode(",",$loaders);
   		$data['yesno'] = array('1'=>$this->language->get("text_yes"),
   									 "0"=>$this->language->get("text_no"));
		$this->load->model('localisation/language');
   		$languages = $this->model_localisation_language->getLanguages();
		$data['languages'] = $languages;

 		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		if (isset($this->error['dimension'])) {
			$data['error_dimension'] = $this->error['dimension'];
		} else {
			$data['error_dimension'] = array();
		}

  		$data['breadcrumbs'] = array();

   		$data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => false
   		);

   		$data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_module'),
			'href'      => $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => ' :: '
   		);

   		if (!isset($this->request->get['module_id'])) {
			$data['breadcrumbs'][] = array(
				'text' => $this->language->get('heading_title'),
				'href' => $this->url->link('module/ecslideshow', 'token=' . $this->session->data['token'], 'SSL')
			);
		} else {
			$data['breadcrumbs'][] = array(
				'text' => $this->language->get('heading_title'),
				'href' => $this->url->link('module/ecslideshow', 'token=' . $this->session->data['token'] . '&module_id=' . $this->request->get['module_id'], 'SSL')
			);			
		}


		if (!isset($this->request->get['module_id'])) {
			$data['action'] = $this->url->link('module/ecslideshow', 'token=' . $this->session->data['token'], 'SSL');
		} else {
			$data['action'] = $this->url->link('module/ecslideshow', 'token=' . $this->session->data['token'] . '&module_id=' . $this->request->get['module_id'], 'SSL');
		}

		$data['cancel'] = $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL');

		$module_info = null;

		if (isset($this->request->get['module_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
			$module_info = $this->model_extension_module->getModule($this->request->get['module_id']);
		}

		$data = $this->bindData($data, $module_info);


		$this->load->model('ecslideshow/banner');
    	$data_filter = array("filter_status"=>1);

		$data['banners'] = $this->model_ecslideshow_banner->getBanners($data_filter);

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('module/ecslideshow/module.tpl', $data));
	}

	public function banner(){
		$this->language->load('module/ecslideshow');

		$this->document->setTitle($this->language->get('heading_banner_title'));

		$this->load->model('ecslideshow/banner');

		$this->model_ecslideshow_banner->installModule();


		$this->getList();
	}
	public function insert_banner(){
		$this->language->load('module/ecslideshow');
		$this->document->setTitle($this->language->get('heading_banner_title'));

		$this->load->model('ecslideshow/banner');

		$this->model_ecslideshow_banner->installModule();

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$action = isset($this->request->post['action'])?$this->request->post['action']: 'save_stay';

			$banner_id = $this->model_ecslideshow_banner->addBanner($this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}
			if($action == "save_stay"){
				$this->response->redirect($this->url->link('module/ecslideshow/update_banner', 'ecbanner_id='.$banner_id.'&token=' . $this->session->data['token'] . $url, 'SSL'));
			}else{
				$this->response->redirect($this->url->link('module/ecslideshow/banner', 'token=' . $this->session->data['token'] . $url, 'SSL'));
			}
			
		}

		$this->getForm();
	}
	public function update_banner(){
		$this->language->load('module/ecslideshow');

		$this->document->setTitle($this->language->get('heading_banner_title'));

		$this->load->model('ecslideshow/banner');

		$this->model_ecslideshow_banner->installModule();

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$action = isset($this->request->post['action'])?$this->request->post['action']: 'save_stay';

			$banner_id = $this->model_ecslideshow_banner->editBanner($this->request->get['ecbanner_id'], $this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}
			if($action == "save_stay"){
				$this->response->redirect($this->url->link('module/ecslideshow/update_banner', 'ecbanner_id='.$banner_id.'&token=' . $this->session->data['token'] . $url, 'SSL'));
			}else{
				$this->response->redirect($this->url->link('module/ecslideshow/banner', 'token=' . $this->session->data['token'] . $url, 'SSL'));
			}
			
		}

		$this->getForm();
	}
	public function delete_banner(){
		$this->language->load('module/ecslideshow');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('ecslideshow/banner');

		$this->model_ecslideshow_banner->installModule();

		if (isset($this->request->post['selected']) && $this->validateDelete()) {
			foreach ($this->request->post['selected'] as $banner_id) {
				$this->model_ecslideshow_banner->deleteBanner($banner_id);
			}

			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}
			$this->response->redirect($this->url->link('module/ecslideshow/banner', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}

		$this->getList();
	}
	protected function getList(){
		$data = array();
		$data['link_to_module'] = $this->url->link('module/ecslideshow', 'token=' . $this->session->data['token'], 'SSL');
		$data['link_to_banner'] = $this->url->link('module/ecslideshow/banner', 'token=' . $this->session->data['token'], 'SSL');
		$this->document->addStyle('view/stylesheet/ecslideshow.css');

		if (isset($this->request->get['filter_name'])) {
			$filter_name = $this->request->get['filter_name'];
		} else {
			$filter_name = '';
		}

		if (isset($this->request->get['filter_status'])) {
			$filter_status = $this->request->get['filter_status'];
		} else {
			$filter_status = null;
		}

		if (isset($this->request->get['sort'])) {
			$sort = $this->request->get['sort'];
		} else {
			$sort = 'name';
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
			$url .= '&filter_name=' . $this->request->get['filter_name'];
		}

		if (isset($this->request->get['filter_status'])) {
			$url .= '&filter_status=' . $this->request->get['filter_status'];
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
       		'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => false
   		);

   		$data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('module/ecslideshow', 'token=' . $this->session->data['token'] . $url, 'SSL'),
      		'separator' => ' :: '
   		);
      $data['breadcrumbs'][] = array(
          'text'      => $this->language->get('heading_banner_title'),
          'href'      => $this->url->link('module/ecslideshow/banner', 'token=' . $this->session->data['token'] . $url, 'SSL'),
          'separator' => ' :: '
      );

		$data['insert'] = $this->url->link('module/ecslideshow/insert_banner', 'token=' . $this->session->data['token'] . $url, 'SSL');
		$data['delete'] = $this->url->link('module/ecslideshow/delete_banner', 'token=' . $this->session->data['token'] . $url, 'SSL');
		$data['export'] = $this->url->link('module/ecslideshow/exportcsv', 'token=' . $this->session->data['token'] . $url, 'SSL');
		$data['import'] = $this->url->link('module/ecslideshow/importcsv', 'token=' . $this->session->data['token'] . $url, 'SSL');

		$data['banners'] = array();

		$data_filter = array(
			'filter_name' => $filter_name,
			'filter_status' => $filter_status,
			'sort'  => $sort,
			'order' => $order,
			'start' => ($page - 1) * $this->config->get('config_admin_limit'),
			'limit' => $this->config->get('config_admin_limit')
		);

		$banner_total = $this->model_ecslideshow_banner->getTotalBanners();

		$results = $this->model_ecslideshow_banner->getBanners($data_filter);

		foreach ($results as $result) {
			$action = array();

			$action[] = array(
				'text' => $this->language->get('text_edit_banner'),
				'class' => 'btn-primary',
				'href' => $this->url->link('module/ecslideshow/update_banner', 'token=' . $this->session->data['token'] . '&ecbanner_id=' . $result['ecbanner_id'] . $url, 'SSL')
			);

			$data['banners'][] = array(
				'ecbanner_id' => $result['ecbanner_id'],
				'name'      => $result['name'],
				'status'    => ($result['status'] ? $this->language->get('text_enabled') : $this->language->get('text_disabled')),
				'selected'  => isset($this->request->post['selected']) && in_array($result['ecbanner_id'], $this->request->post['selected']),
				'action'    => $action
			);
		}

		$data['heading_title'] = $this->language->get('heading_banner_title');

		$data['text_no_results'] = $this->language->get('text_no_results');

		$data['column_name'] = $this->language->get('column_name');
		$data['column_status'] = $this->language->get('column_status');
		$data['column_action'] = $this->language->get('column_action');

		$data['button_insert'] = $this->language->get('button_insert');
		$data['button_delete'] = $this->language->get('button_delete');
		$data['button_export'] = $this->language->get('button_export');
		$data['button_import'] = $this->language->get('button_import');
		$data['button_remove'] = $this->language->get('button_remove');
		$data['button_filter'] = $this->language->get('button_filter');


		$data['entry_name'] = $this->language->get('entry_name');
		$data['entry_status'] = $this->language->get('entry_status');
		$data['entry_support_rtl'] = $this->language->get('entry_support_rtl');
		$data['entry_banner'] = $this->language->get('entry_banner');
		$data['text_select_banner'] = $this->language->get('text_select_banner');
		$data['entry_limit'] = $this->language->get('entry_limit');
		$data['entry_random_slider'] = $this->language->get('entry_random_slider');
		$data['entry_module_width'] = $this->language->get('entry_module_width');
		$data['entry_module_height'] = $this->language->get('entry_module_height');
		$data['entry_main_width'] = $this->language->get('entry_main_width');
		$data['entry_main_height'] = $this->language->get('entry_main_height');
		$data['entry_thumbnail_width'] = $this->language->get('entry_thumbnail_width');
		$data['entry_thumbnail_height'] = $this->language->get('entry_thumbnail_height');
		$data['entry_resize_main_image'] = $this->language->get('entry_resize_main_image');
		$data['entry_resize_type'] = $this->language->get('entry_resize_type');
		$data['entry_slider_caption'] = $this->language->get('entry_slider_caption');
		$data['entry_show_caption'] = $this->language->get('entry_show_caption');
		$data['entry_caption_effect'] = $this->language->get('entry_caption_effect');
		$data['entry_show_product_info'] = $this->language->get('entry_show_product_info');
		$data['entry_title_max_chars'] = $this->language->get('entry_title_max_chars');

		$data['text_enabled'] = $this->language->get('text_enabled');
		$data['text_disabled'] = $this->language->get('text_disabled');
		$data['text_confirm'] = $this->language->get('text_confirm');

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

		$url = '';

		if (isset($this->request->get['filter_name'])) {
			$url .= '&filter_name=' . $this->request->get['filter_name'];
		}

		if (isset($this->request->get['filter_status'])) {
			$url .= '&filter_status=' . $this->request->get['filter_status'];
		}

		if ($order == 'ASC') {
			$url .= '&order=DESC';
		} else {
			$url .= '&order=ASC';
		}

		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}

		$data['sort_name'] = $this->url->link('module/ecslideshow/banner', 'token=' . $this->session->data['token'] . '&sort=name' . $url, 'SSL');
		$data['sort_status'] = $this->url->link('module/ecslideshow/banner', 'token=' . $this->session->data['token'] . '&sort=status' . $url, 'SSL');

		$url = '';

		if (isset($this->request->get['filter_name'])) {
			$url .= '&filter_name=' . $this->request->get['filter_name'];
		}

		if (isset($this->request->get['filter_status'])) {
			$url .= '&filter_status=' . $this->request->get['filter_status'];
		}

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}
		$this->load->model('localisation/language');
   		$languages = $this->model_localisation_language->getLanguages();
		$data['languages'] = $languages;
		
		$data['language'] = $this->language;

		$pagination = new Pagination();
		$pagination->total = $banner_total;
		$pagination->page = $page;
		$pagination->limit = $this->config->get('config_admin_limit');
		$pagination->text = $this->language->get('text_pagination');
		$pagination->url = $this->url->link('module/ecslideshow/banner', 'token=' . $this->session->data['token'] . $url . '&page={page}', 'SSL');

		$data['pagination'] = $pagination->render();

		$data['results'] = sprintf($this->language->get('text_pagination'), ($banner_total) ? (($page - 1) * $this->config->get('config_limit_admin')) + 1 : 0, ((($page - 1) * $this->config->get('config_limit_admin')) > ($banner_total - $this->config->get('config_limit_admin'))) ? $banner_total : ((($page - 1) * $this->config->get('config_limit_admin')) + $this->config->get('config_limit_admin')), $banner_total, ceil($banner_total / $this->config->get('config_limit_admin')));


		$data['filter_name'] = $filter_name;
		$data['filter_status'] = $filter_status;
		$data['sort'] = $sort;
		$data['order'] = $order;

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('module/ecslideshow/banner_list.tpl', $data));

	}

	protected function getForm(){
		$this->load->model('tool/image');
		$this->document->addStyle('view/stylesheet/ecslideshow.css');
		$data = array();

		$data['link_to_module'] = $this->url->link('module/ecslideshow', 'token=' . $this->session->data['token'], 'SSL');
		$data['link_to_banner'] = $this->url->link('module/ecslideshow/banner', 'token=' . $this->session->data['token'], 'SSL');


		$data['heading_title'] = $this->language->get('heading_banner_title');
		$data['text_edit_banner'] = $this->language->get('text_edit_banner');

		$data['text_enabled'] = $this->language->get('text_enabled');
		$data['text_disabled'] = $this->language->get('text_disabled');
		$data['text_default'] = $this->language->get('text_default');
		$data['text_image_manager'] = $this->language->get('text_image_manager');
 		$data['text_browse'] = $this->language->get('text_browse');
		$data['text_clear'] = $this->language->get('text_clear');
		$data['text_input_product_name'] = $this->language->get('text_input_product_name');

		$data['entry_name'] = $this->language->get('entry_name');
		$data['entry_description'] = $this->language->get('entry_description');
		$data['entry_custom_code'] = $this->language->get('entry_custom_code');
		$data['entry_video_embed_code'] = $this->language->get('entry_video_embed_code');
		$data['entry_product'] = $this->language->get('entry_product');
		$data['entry_sort_order'] = $this->language->get('entry_sort_order');
		$data['entry_slideshow_effect'] = $this->language->get('entry_slideshow_effect');
		$data['entry_caption_class'] = $this->language->get('entry_caption_class');
		$data['entry_caption_alignment'] = $this->language->get('entry_caption_alignment');
		$data['entry_image_alignment'] = $this->language->get('entry_image_alignment');
		$data['entry_easing'] = $this->language->get('entry_easing');
		$data['entry_effect'] = $this->language->get('entry_effect');
		$data['entry_show_caption'] = $this->language->get('entry_show_caption');
		$data['entry_show_slider_link'] = $this->language->get('entry_show_slider_link');
		$data['entry_product_id'] = $this->language->get('entry_product_id');

		$data['entry_title'] = $this->language->get('entry_title');
		$data['entry_link'] = $this->language->get('entry_link');
		$data['entry_image'] = $this->language->get('entry_image');
		$data['entry_status'] = $this->language->get('entry_status');
		$data['entry_main_width'] = $this->language->get('entry_main_width');
		$data['entry_main_height'] = $this->language->get('entry_main_height');
		$data['text_banner_image'] = $this->language->get('text_banner_image');
		$data['help_main_width'] = $this->language->get('help_main_width');
		$data['help_main_height'] = $this->language->get('help_main_height');

		$data['placeholder'] = $this->model_tool_image->resize('no_image.png', 100, 100);


		$data['tab_banner'] = $this->language->get('tab_banner');

		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel');
		$data['button_add_banner'] = $this->language->get('button_add_banner');
		$data['button_remove'] = $this->language->get('button_remove');
		$data['button_save_stay'] = $this->language->get('button_save_stay');

 		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else if (isset($this->session->data['error']) && isset($this->session->data['error']['warning'])) {
			$data['error_warning'] = $this->session->data['error']['warning'];
		} else {
			$data['error_warning'] = '';
		}

 		if (isset($this->error['name'])) {
			$data['error_name'] = $this->error['name'];
		} else {
			$data['error_name'] = '';
		}

 		if (isset($this->error['banner_image'])) {
			$data['error_banner_image'] = $this->error['banner_image'];
		} else {
			$data['error_banner_image'] = array();
		}

		if (isset($this->session->data['success'])) {
			$data['success'] = $this->session->data['success'];

			unset($this->session->data['success']);
		} else {
			$data['success'] = '';
		}
		
		$url = '';

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
       		'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => false
   		);

      $data['breadcrumbs'][] = array(
          'text'      => $this->language->get('heading_title'),
          'href'      => $this->url->link('module/ecslideshow', 'token=' . $this->session->data['token'] . $url, 'SSL'),
          'separator' => ' :: '
      );
      $data['breadcrumbs'][] = array(
          'text'      => $this->language->get('heading_banner_title'),
          'href'      => $this->url->link('module/ecslideshow/banner', 'token=' . $this->session->data['token'] . $url, 'SSL'),
          'separator' => ' :: '
      );

		if (!isset($this->request->get['ecbanner_id'])) {
			$data['action'] = $this->url->link('module/ecslideshow/insert_banner', 'token=' . $this->session->data['token'] . $url, 'SSL');
		} else {
			$data['action'] = $this->url->link('module/ecslideshow/update_banner', 'token=' . $this->session->data['token'] . '&ecbanner_id=' . $this->request->get['ecbanner_id'] . $url, 'SSL');
		}

		$data['cancel'] = $this->url->link('module/ecslideshow/banner', 'token=' . $this->session->data['token'] . $url, 'SSL');

		if (isset($this->request->get['ecbanner_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
			$banner_info = $this->model_ecslideshow_banner->getBanner($this->request->get['ecbanner_id']);
		}

		$data['token'] = $this->session->data['token'];

		if (isset($this->request->post['name'])) {
			$data['name'] = $this->request->post['name'];
		} elseif (!empty($banner_info)) {
			$data['name'] = $banner_info['name'];
		} else {
			$data['name'] = '';
		}

		if (isset($this->request->post['status'])) {
			$data['status'] = $this->request->post['status'];
		} elseif (!empty($banner_info)) {
			$data['status'] = $banner_info['status'];
		} else {
			$data['status'] = true;
		}

		if (isset($this->request->post['main_width'])) {
			$data['main_width'] = $this->request->post['main_width'];
		} elseif (!empty($banner_info)) {
			$data['main_width'] = $banner_info['main_width'];
		} else {
			$data['main_width'] = "";
		}

		if (isset($this->request->post['main_height'])) {
			$data['main_height'] = $this->request->post['main_height'];
		} elseif (!empty($banner_info)) {
			$data['main_height'] = $banner_info['main_height'];
		} else {
			$data['main_height'] = "";
		}

		$this->load->model('localisation/language');

		$data['languages'] = $this->model_localisation_language->getLanguages();

		$data['language'] = $this->language;

		$data['caption_alignment'] = array(
												"moveFromLeft",
												"moveFomRight",
												"moveFromTop",
												"moveFromBottom",
												"fadeIn",
												"fadeFromLeft",
												"fadeFromRight",
												"fadeFromTop",
												"fadeFromBottom");
		$data['image_alignments'] = array("topLeft",
									"topCenter",
									"topRight",
									"centerLeft",
									"center",
									"centerRight",
									"bottomLeft",
									"bottomCenter",
									"bottomRight");

   		$data['easings'] = array('linear',
   										'swing',
   										'easeInQuad',
   										'easeOutQuad',
   										'easeInOutQuad',
   										'easeInCubic',
   										'easeOutCubic',
   										'easeInOutCubic',
   										'easeInQuart',
   										'easeOutQuart',
   										'easeInOutQuart',
   										'easeInQuint',
   										'easeOutQuint',
   										'easeInOutQuint',
   										'easeInExpo',
   										'easeOutExpo',
   										'easeInOutExpo',
   										'easeInSine',
   										'easeOutSine',
   										'easeInOutSine',
   										'easeInCirc',
   										'easeOutCirc',
   										'easeInOutCirc',
   										'easeInElastic',
   										'easeOutElastic',
   										'easeInOutElastic',
   										'easeInBack',
   										'easeOutBack',
   										'easeInOutBack',
   										'easeInBounce',
   										'easeOutBounce',
   										'easeInOutBounce'
   										);
   		$fx = "random,simpleFade,curtainTopLeft,curtainTopRight,curtainBottomLeft,curtainBottomRight,curtainSliceLeft,curtainSliceRight,blindCurtainTopLeft,blindCurtainTopRight,blindCurtainBottomLeft,blindCurtainBottomRight,blindCurtainSliceBottom,blindCurtainSliceTop,stampede,mosaic,mosaicReverse,mosaicRandom,mosaicSpiral,mosaicSpiralReverse,topLeftBottomRight,bottomRightTopLeft,bottomLeftTopRight,bottomLeftTopRight,scrollLeft,scrollRight,scrollHorz,scrollBottom,scrollTop";

   		$data['effects'] = explode(",",$fx);

   		$data['yesno'] = array('1'=>$this->language->get("text_yes"),
   									 "0"=>$this->language->get("text_no"));

		$this->load->model('tool/image');

		if (isset($this->request->post['banner_image'])) {
			$banner_images = $this->request->post['banner_image'];
		} elseif (isset($this->request->get['ecbanner_id'])) {
			$banner_images = $this->model_ecslideshow_banner->getBannerImages($this->request->get['ecbanner_id']);
		} else {
			$banner_images = array();
		}

		$data['banner_images'] = array();

		foreach ($banner_images as $banner_image) {
			if ($banner_image['image'] && file_exists(DIR_IMAGE . $banner_image['image'])) {
				$image = $banner_image['image'];
			} else {
				$image = 'no_image.jpg';
			}

			$data['banner_images'][] = array(
				'banner_image_description' => $banner_image['banner_image_description'],
        		'product_id'               => $banner_image['product_id'],
				'link'                     => $banner_image['link'],
				'image'                    => $image,
				'ordering'				   => $banner_image['ordering'],
				'params'				   => is_array($banner_image['params'])?$banner_image['params']:unserialize($banner_image['params']),
				'thumb'                    => $this->model_tool_image->resize($image, 100, 100)
			);
		}


		$data['no_image'] = $this->model_tool_image->resize('no_image.jpg', 100, 100);

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('module/ecslideshow/banner_form.tpl', $data));
	}

	public function importcsv() {

		$this->language->load('module/ecslideshow');
		$this->load->model('ecslideshow/banner');
		$this->document->addStyle('view/stylesheet/ecslideshow.css');

		$this->document->setTitle($this->language->get('heading_import_banner_title'));

		$this->model_ecslideshow_banner->installModule();

		if (($this->request->server['REQUEST_METHOD'] == 'POST')) {
			$data['message'] = "";
			//Upload File
			if (is_uploaded_file($_FILES['file']['tmp_name'])) {
				$data['message'] = "<h1>" . "File ". $_FILES['file']['name'] ." uploaded successfully." . "</h1>";
				$data['message'] .= "<h2>Import to Database:</h2>";
				//readfile($_FILES['file']['tmp_name']);
			

				//Import uploaded file to Database
				$tmp = array();
				$header = array();
				$banners = array();
				$handle = fopen($_FILES['file']['tmp_name'], "r");
				$i = 0;
				while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
					if($i == 0 && !empty($data)) {
						$header = $data;
					} else {
						$tmp[] = $data;
					}
					$i++;
					
				}

				fclose($handle);

				if($tmp) {

					$banners = $this->model_ecslideshow_banner->getImportBanners( $tmp, $header );
					
					if($banners) {
						foreach ($banners as $banner) {
							if($banner_id = $this->model_ecslideshow_banner->addBanner($banner)) {
								$data['message'] .= "Imported <b>'".$banner['name']."'</b> Done.<br/>";
							} else {
								$data['message'] .= "Imported <b>'".$banner['name']."'</b> Error.<br/>";
							}
						}
					}
					
				}
			} else {
				$data['message'] = "Imported Error. Can not read the CSV file<br/>";
			}
			//view upload form

		}

		$data['heading_title'] = $this->language->get('heading_import_banner_title');

		$data['text_enabled'] = $this->language->get('text_enabled');
		$data['text_disabled'] = $this->language->get('text_disabled');
		$data['text_default'] = $this->language->get('text_default');
		$data['text_image_manager'] = $this->language->get('text_image_manager');
 		$data['text_browse'] = $this->language->get('text_browse');
		$data['text_clear'] = $this->language->get('text_clear');
		$data['text_help_import'] = $this->language->get('text_help_import');

		$data['entry_name'] = $this->language->get('entry_name');
		$data['entry_title'] = $this->language->get('entry_title');
		$data['entry_link'] = $this->language->get('entry_link');
		$data['entry_image'] = $this->language->get('entry_image');
		$data['entry_status'] = $this->language->get('entry_status');


		$data['button_import'] = $this->language->get('button_import');
		$data['button_cancel'] = $this->language->get('button_cancel');
		$data['button_add_banner'] = $this->language->get('button_add_banner');
		$data['button_remove'] = $this->language->get('button_remove');

 		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else if (isset($this->session->data['error']) && isset($this->session->data['error']['warning'])) {
			$data['error_warning'] = $this->session->data['error']['warning'];
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
          'href'      => $this->url->link('module/ecslideshow', 'token=' . $this->session->data['token'], 'SSL'),
          'separator' => ' :: '
      );
      $data['breadcrumbs'][] = array(
          'text'      => $this->language->get('heading_banner_title'),
          'href'      => $this->url->link('module/ecslideshow/banner', 'token=' . $this->session->data['token'] , 'SSL'),
          'separator' => ' :: '
      );

      	$data['language'] = $this->language;

      	$data['link_to_module'] = $this->url->link('module/ecslideshow', 'token=' . $this->session->data['token'], 'SSL');

		$data['link_to_banner'] = $this->url->link('module/ecslideshow/banner', 'token=' . $this->session->data['token'], 'SSL');

		$data['action'] = $this->url->link('module/ecslideshow/importcsv', 'token=' . $this->session->data['token'] , 'SSL');

		$data['cancel'] = $this->url->link('module/ecslideshow/banner', 'token=' . $this->session->data['token'], 'SSL');

		$data['token'] = $this->session->data['token'];

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('module/ecslideshow/import_form.tpl', $data));
	}
	public function exportcsv() {
		if (($this->request->server['REQUEST_METHOD'] == 'POST')) {

			$this->download_send_headers("ecslideshow_data_export_" . date("Y-m-d") . ".csv");
			$this->load->model('ecslideshow/banner');

			$data = array();
			$selected = isset($this->request->post['selected'])?$this->request->post['selected']:array();

			if($selected) {
				$data['filter_id'] = $selected;
			}

			$banners = $this->model_ecslideshow_banner->getBanners( $data );
			$data = array();
			if($banners) {

				foreach($banners as $banner){
					$tmpdata = array();
					$banner_images = $this->model_ecslideshow_banner->getBannerImages($banner['ecbanner_id']);
					$tmpdata['name'] = $banner['name'];
					$tmpdata['status'] = $banner['status'];
					$tmpdata['main_width'] = $banner['main_width'];
					$tmpdata['main_height'] = $banner['main_height'];
					if($banner_images) {
						$i = 1;
						foreach($banner_images as $banner_image) {
							$prefix = "image__".$i."__";
							$tmpdata[$prefix."link"] = $banner_image['link'];
							$tmpdata[$prefix."image"] = $banner_image['image'];
							$tmpdata[$prefix."product_id"] = $banner_image['product_id'];
							$tmpdata[$prefix."ordering"] = $banner_image['ordering'];
							$tmpdata[$prefix."params"] = $banner_image['params'];
							if(isset($banner_image['banner_image_description']) && $banner_image['banner_image_description']){
								$j = 1;
								foreach($banner_image['banner_image_description'] as $language_id => $description) {
									$prefix2 = $prefix."language__".$j."__";
									$tmpdata[$prefix2."title"] = $description['title'];
									$tmpdata[$prefix2."description"] = $description['description'];
									$tmpdata[$prefix2."custom_code"] = $description['custom_code'];
									$j++;
								}
							}
							$i++;
						}
					}
					$data[] = $tmpdata;
				}
			}
			echo $this->model_ecslideshow_banner->array2csv($data);
			die();

		} else {
			$this->response->redirect($this->url->link('module/ecslideshow/banner', 'token=' . $this->session->data['token'], 'SSL'));
		}
		
	}
	protected function download_send_headers($filename) {
	    // disable caching
	    $now = gmdate("D, d M Y H:i:s");
	    header("Expires: Tue, 03 Jul 2001 06:00:00 GMT");
	    header("Cache-Control: max-age=0, no-cache, must-revalidate, proxy-revalidate");
	    header("Last-Modified: {$now} GMT");

	    // force download  
	    header("Content-Type: application/force-download");
	    header("Content-Type: application/octet-stream");
	    header("Content-Type: application/download");

	    // disposition / encoding on response body
	    header("Content-Disposition: attachment;filename={$filename}");
	    header("Content-Transfer-Encoding: binary");
	}
	protected function validate() {
		if (!$this->user->hasPermission('modify', 'module/ecslideshow')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		if (isset($this->request->post['ecslideshow_module'])) {

		}

		if (!$this->error) {
			return true;
		} else {
			return false;
		}
	}
    protected function validateForm() {
        if (!$this->user->hasPermission('modify', 'module/ecslideshow')) {
            $this->error['warning'] = $this->language->get('error_permission');
        }
        $error = array();
        if ((strlen(utf8_decode($this->request->post['name'])) < 3) || (strlen(utf8_decode($this->request->post['name'])) > 100)) {
            $error[] = $this->language->get('error_name');
        }
        $error_title = $this->language->get('error_title');

        if (isset($this->request->post['banner_image'])) {
            foreach ($this->request->post['banner_image'] as $banner_image_id => $banner_image) {
                foreach ($banner_image['banner_image_description'] as $language_id => $banner_image_description) {
                    if ((strlen(utf8_decode($banner_image_description['title'])) < 2) || (strlen(utf8_decode($banner_image_description['title'])) > 100)) {
                        $this->error['banner_image'][$banner_image_id][$language_id] = $this->language->get('error_title');
                        $error[] = sprintf($error_title, $banner_image_id);
                    }

                }
            }
        }
        $html_error = "";
        if($error) {
        	$html_error = "<ul>";
        	foreach($error as $key=>$val) {
        		$html_error = "<li>".$val."</li>";
        	}
        	$html_error .= "</ul>";
        	$this->error['warning'] = $html_error;
        }
        
        $this->session->data['error'] = $this->error;

        if (!$this->error) {
            return true;
        } else {
            return false;
        }
    }

    protected function validateDelete() {
        if (!$this->user->hasPermission('modify', 'module/ecslideshow')) {
            $this->error['warning'] = $this->language->get('error_permission');
        }

        if (!$this->error) {
            return true;
        } else {
            return false;
        }
    }

    protected function bindData($data = array(), $module_info = array()){
        $defaults = array(
        	'name' => '',
        	'status' => '0',
        	'enable_async' => '0',
        	'skin'	=> 'camera_azure_skin',
            'alignment'				=> 'center',
            'resize_image'			=> 1,
            'resize_type'			=> '',
            'random_mode'			=> '0',
            'support_rtl'			=> 1,
            'show_caption'			=> 1,
            'caption_effect'		=> 'moveFromBottom',
            'title_max_chars'		=> 100,
            'description_max_chars'	=> 150,
            'show_product_info'		=> 1,
            'auto_advance'			=> '1',
            'mobile_auto_advance'	=> '1',
            'bar_direction'			=> 'leftToRight',
            'bar_position'			=> 'bottom',
            'cols'					=> '6',
            'easing'				=> 'easeInOutExpo',
            'fx'					=> array('random'),
            'grid_difference'		=> '250',
            'height'				=> '50%',
            'hover'					=> '1',
            'loader'				=> 'pie',
            'loader_color'			=> '#eeeeee',
            'loader_bg_color'		=> '#222222',
            'loader_opacity'		=> '.8',
            'min_height'			=> '200px',
            'navigation'			=> '1',
            'navigation_hover'		=> '1',
            'overlayer'				=> '1',
            'pagination'			=> '1',
            'play_pause'			=> '1',
            'is_striped'			=> '0',
            'show_custom_code'		=> '0',
            'pie_diameter'			=> '38',
            'pie_position'			=> 'rightTop',
            'rows'					=> '4',
            'sliced_cols'			=> '12',
            'sliced_rows'			=> '8',
            'slide_on'				=> 'random',
            'thumbnails'			=> '0',
            'time'					=> '7000',
            'trans_period'			=> '1500',
            'data_source'			=> 'banner',
            'limit'					=> '5',
            'background_color'		=> '',
            'text_color'			=> '',
            'link_color'			=> '',
            'addtocart_color'		=> '#000000',
            'addtocart_bg_color'	=> '#FFFFFF',
            'price_color'			=> '',
            'special_price_color'	=> '',
            'module_width'			=> '800px',
            'module_height'			=> '600px',
            'main_width'			=> '800',
            'main_height'			=> '600',
            'thumbnail_width'		=> '100',
            'thumbnail_height'		=> '75',
            'banner_id'				=> '0',
            'custom_css'			=> ''
        );

		foreach($defaults as $key=>$val) {

			if (isset($this->request->post[ $key ])) {
				$data[ $key ] = $this->request->post[ $key ];
			} elseif (!empty($module_info) && isset($module_info[ $key ])) {
				$data[ $key ] = $module_info[ $key ];
			} else {
				$data[ $key ] = $val;
			}

		}

		return $data;
		
    }
}
?>
