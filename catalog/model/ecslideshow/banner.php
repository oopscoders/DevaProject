<?php
class ModelEcslideshowBanner extends Model {	
	public function getBanner($banner_id, $limit_banner = 50, $random = 0) {
		$limit = "";
		$orderby = " ORDER BY bi.ordering";
		if(!empty($limit_banner)){
			$limit = " LIMIT ".$limit_banner;
		}
		if($random){
			$orderby = " ORDER BY RAND()";
		}
		$data = array();
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "ecbanner_image bi LEFT JOIN " . DB_PREFIX . "ecbanner_image_description bid ON (bi.ecbanner_image_id  = bid.ecbanner_image_id) WHERE bi.ecbanner_id = '" . (int)$banner_id . "' AND bid.language_id = '" . (int)$this->config->get('config_language_id') . "'".$orderby.$limit);
		$data['banners'] = $query->rows;

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "ecbanner WHERE ecbanner_id = " . (int)$banner_id );
		$data['banner_info'] = $query->row;
		return $data;
	}
	public function resize($filename, $width, $height, $type = "") {
		if (!is_file(DIR_IMAGE . $filename)) {
			return;
		}

		$extension = pathinfo($filename, PATHINFO_EXTENSION);

		$old_image = $filename;
		$new_image = 'cache/' . utf8_substr($filename, 0, utf8_strrpos($filename, '.')) . '-' . $width . 'x' . $height . $type . '.' . $extension;

		if (!is_file(DIR_IMAGE . $new_image) || (filectime(DIR_IMAGE . $old_image) > filectime(DIR_IMAGE . $new_image))) {
			$path = '';

			$directories = explode('/', dirname(str_replace('../', '', $new_image)));

			foreach ($directories as $directory) {
				$path = $path . '/' . $directory;

				if (!is_dir(DIR_IMAGE . $path)) {
					@mkdir(DIR_IMAGE . $path, 0777);
				}
			}

			list($width_orig, $height_orig) = getimagesize(DIR_IMAGE . $old_image);

			if ($width_orig != $width || $height_orig != $height) {
				$image = new Image(DIR_IMAGE . $old_image);
				$image->resize($width, $height, $type);
				$image->save(DIR_IMAGE . $new_image);
			} else {
				copy(DIR_IMAGE . $old_image, DIR_IMAGE . $new_image);
			}
		}

		if ($this->request->server['HTTPS']) {
			return $this->config->get('config_ssl') . 'image/' . $new_image;
		} else {
			return $this->config->get('config_url') . 'image/' . $new_image;
		}
	}
}
?>