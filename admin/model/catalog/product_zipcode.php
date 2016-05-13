<?php
class ModelCatalogProductZipcode extends Model {
	public function add($data) {
		$this->event->trigger('pre.admin.product_zipcode.add', $data);

		if (isset($data['product_zipcode'])) {
			foreach ($data['product_zipcode'] as $value) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "product_zipcode SET product_id = '" . $this->db->escape($data['product_id']) . "', zipcode = '" .  $this->db->escape($value['zipcode']) . "'");
			}
		}

		$this->event->trigger('post.admin.product_zipcode.add', $product_zipcode_id);

		return $product_zipcode_id;
	}
	
	public function addProductZipcode($data) {
		$this->event->trigger('pre.admin.product_zipcode.add', $data);

		$this->db->query("INSERT INTO " . DB_PREFIX . "product_zipcode SET product_id = '" . $this->db->escape($data['product_id']) . "', zipcode = '" .  $this->db->escape($data['zipcode']) . "'");
		
		$this->event->trigger('post.admin.product_zipcode.add', $product_zipcode_id);

		return $product_zipcode_id;
	}

	public function edit($product_id, $data) {
		$this->event->trigger('pre.admin.product_zipcode.edit', $data);
		
		$this->db->query("DELETE FROM " . DB_PREFIX . "product_zipcode WHERE product_id = '" . (int)$product_id . "'");

		if (isset($data['product_zipcode'])) {
			foreach ($data['product_zipcode'] as $value) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "product_zipcode SET product_id = '" . $this->db->escape($data['product_id']) . "', zipcode = '" .  $this->db->escape($value['zipcode']) . "'");
			}
		}

		$this->event->trigger('post.admin.product_zipcode.edit', $product_zipcode_id);

		return $product_zipcode_id;
	}
	
	public function editProductZipcode($product_zipcode_id, $data) {
		$this->event->trigger('pre.admin.product_zipcode.edit', $data);
		
		$this->db->query("UPDATE " . DB_PREFIX . "product_zipcode SET product_id = '" . $this->db->escape($data['product_id']) . "', zipcode = '" .  $this->db->escape($data['zipcode']) . "' WHERE product_zipcode_id = '". (int)$product_zipcode_id ."'");
		
		$this->event->trigger('post.admin.product_zipcode.edit', $product_zipcode_id);

		return $product_zipcode_id;
	}

	public function deleteProductZipcode($product_zipcode_id) {
		$this->event->trigger('pre.admin.product_zipcode.delete', $product_zipcode_id);

		$this->db->query("DELETE FROM " . DB_PREFIX . "product_zipcode WHERE product_zipcode_id = '" . (int)$product_zipcode_id . "'");

		$this->event->trigger('post.admin.product_zipcode.delete', $product_zipcode_id);
	}

	public function getProductZipcode($product_id) {
		$query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "product_zipcode WHERE product_id = '" . (int)$product_id . "'");

		return $query->row;
	}

	public function getProductZipcodeById($product_zipcode_id) {
		$query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "product_zipcode WHERE product_zipcode_id = '" . (int)$product_zipcode_id . "'");

		return $query->row;
	}

	public function getProductZipcodes($data = array()) {
		$sql = "SELECT pz.*, pd.name, p.model FROM " . DB_PREFIX . "product_zipcode pz LEFT JOIN ". DB_PREFIX ."product p ON(pz.product_id=p.product_id) LEFT JOIN ". DB_PREFIX ."product_description pd ON(p.product_id=pd.product_id) WHERE pd.language_id = '". (int)$this->config->get('config_language_id') ."'";

		if (!empty($data['filter_name'])) {
			$sql .= " AND pd.name LIKE '" . $this->db->escape($data['filter_name']) . "%'";
		}

		if (!empty($data['filter_model'])) {
			$sql .= " AND p.model LIKE '" . $this->db->escape($data['filter_model']) . "%'";
		}

		if (!empty($data['filter_zipcode'])) {
			$sql .= " AND pz.zipcode LIKE '" . $this->db->escape($data['filter_zipcode']) . "%'";
		}

		
		$sort_data = array(
			'pd.name',
			'p.model',
			'pz.product_zipcode_id',
		);

		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			$sql .= " ORDER BY " . $data['sort'];
		} else {
			$sql .= " ORDER BY pd.name";
		}

		if (isset($data['order']) && ($data['order'] == 'DESC')) {
			$sql .= " DESC";
		} else {
			$sql .= " ASC";
		}

		if (isset($data['start']) || isset($data['limit'])) {
			if ($data['start'] < 0) {
				$data['start'] = 0;
			}

			if ($data['limit'] < 1) {
				$data['limit'] = 20;
			}

			$sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
		}

		// echo $sql; die();
		
		$query = $this->db->query($sql);

		return $query->rows;
	}

	public function getProductZipcodeSettings($product_id) {
		$product_zipcode_data = array();

		$product_zipcode_data_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_zipcode WHERE product_id = '" . (int)$product_id . "' ORDER BY zipcode ASC");
		
		foreach ($product_zipcode_data_query->rows as $value) {
			$product_zipcode_data[] = array(
				'product_id'                 => $value['product_id'],
				'zipcode'                    => $value['zipcode'],
			);
		}

		return $product_zipcode_data;
	}

	public function getTotalProductZipcodes($data = array()) {
		$sql = "SELECT COUNT(*) AS total FROM " . DB_PREFIX . "product_zipcode pz LEFT JOIN ". DB_PREFIX ."product p ON(pz.product_id=p.product_id) LEFT JOIN ". DB_PREFIX ."product_description pd ON(p.product_id=pd.product_id) WHERE pd.language_id = '". (int)$this->config->get('config_language_id') ."'";
		
		if (!empty($data['filter_name'])) {
			$sql .= " AND pd.name LIKE '" . $this->db->escape($data['filter_name']) . "%'";
		}

		if (!empty($data['filter_model'])) {
			$sql .= " AND p.model LIKE '" . $this->db->escape($data['filter_model']) . "%'";
		}

		if (!empty($data['filter_zipcode'])) {
			$sql .= " AND pz.zipcode LIKE '" . $this->db->escape($data['filter_zipcode']) . "%'";
		}
		
		$query = $this->db->query($sql);

		return $query->row['total'];
	}
}