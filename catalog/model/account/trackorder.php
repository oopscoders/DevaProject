<?php
class ModelAccountTrackorder extends Model {
	public function getTrackorder($order_id,$email) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "order WHERE order_id = '" . (int)$order_id . "' AND email = '" . $email . "' AND order_status_id > 0");
    
    return $query->row;		
	}
	
	public function getOrderHistoris($order_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "order_history WHERE order_id = '" . (int)$order_id . "' ORDER BY date_added ASC");
    
    return $query->rows;		
	}
	
	public function getOrderStatus($order_status_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "order_status WHERE order_status_id = '" . (int)$order_status_id . "' AND language_id = '". (int)$this->config->get('config_language_id') ."'");
    
    return $query->row;		
	}
}