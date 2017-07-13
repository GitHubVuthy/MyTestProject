<?php
class ModelExtensionModuleProduct extends Model {
	public function getProducts(){
		$query=$this->db->query("SELECT * from ".DB_PREFIX."product p INNER JOIN ".DB_PREFIX."product_description pd on (p.product_id=pd.product_id) where pd.language_id=1 ORDER BY p.product_id ASC LIMIT 0,3 ");
	return $query->rows;
	}
}