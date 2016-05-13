<?php
################################################################################################
#  Product auction for Opencart 2.1.x.x From webkul http://webkul.com  	  	       #
################################################################################################
class ModelModuleWkproductauction extends Model {
	
	public function createEventTable() {
		$sql="CREATE TABLE IF NOT EXISTS " . DB_PREFIX . "wkauction(id INT PRIMARY KEY AUTO_INCREMENT, product_id integer,name varchar(50), isauction varchar(5), min varchar(25),max varchar(25),start_date datetime,end_date datetime,quantity_limit int(5),voucher_time_limit varchar(30))";
		$this->db->query($sql);
		$sql="CREATE TABLE IF NOT EXISTS " . DB_PREFIX . "wkauctionbids(id INT PRIMARY KEY AUTO_INCREMENT, product_id integer, auction_id integer,user_id integer,date datetime,start_date datetime,end_date datetime, user_bid double ,winner varchar(2),sold varchar(2))";
		$this->db->query($sql);
	
	}

}
?>
