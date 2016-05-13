<?php
class ControllerModuleSliderpPlus extends Controller {
	public function index($setting) {
		static $module = 0;

		$this->load->model('design/banner');
		$this->load->model('tool/image');

		$this->document->addStyle('catalog/view/javascript/jquery/owl-carousel/owl.carousel.css');
		$this->document->addStyle('catalog/view/javascript/jquery/owl-carousel/sliderp.css');
		$this->document->addScript('catalog/view/javascript/jquery/owl-carousel/owl.carousel.min.js');
		$this->document->addStyle('catalog/view/javascript/jquery/owl-carousel/owl.transitions.css');
		
		$data['effect'] = $setting['effect'];
		
		
		$data['banners'] = array();

		$results = $setting['banner_image'];

		foreach ($results as $result) {
			if (is_file(DIR_IMAGE . $result['image'])) {
				$data['banners'][] = array(
					'title' => $result['banner_image_description'][(int)$this->config->get('config_language_id')]['title'],
					'link'  => $result['link'],
					'width' => $setting['width'],
					'height'=> $setting['height'],
					'image' => $this->model_tool_image->resize($result['image'], $setting['width'], $setting['height'])
				);
			}
		}

		$data['module'] = $module++;

		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/sliderpplus.tpl')) {
			return $this->load->view($this->config->get('config_template') . '/template/module/sliderpplus.tpl', $data);
		} else {
			return $this->load->view('default/template/module/sliderpplus.tpl', $data);
		}
	}
}