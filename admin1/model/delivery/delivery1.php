<?php
class ModelDeliveryDelivery1 extends Model {
	
		public function editDelivery($delivery_id, $data) {
		$this->db->query("UPDATE " . DB_PREFIX . "delivery SET 
		fname = '" . $this->db->escape($data['fname']) . "',
		lname = '" . $this->db->escape($data['lname']) . "',
		gender = '" . $this->db->escape($data['gender']) ."',
		db = '" . $this->db->escape($data['db']) . "',
		address = '" . $this->db->escape($data['address']) . "',
		email = '" . $this->db->escape($data['email']) . "',
		phone = '" . $this->db->escape($data['phone']) . "',
		
		sort_order = '" . $this->db->escape($data['sort_order']) . "',
		status = '" . $this->db->escape($data['status']) . "' 
		WHERE delivery_id = '" . (int)$delivery_id . "'");


		$this->cache->delete('delivery');
	}
		
		
	public function addDelivery($data) {
		$this->db->query("INSERT INTO " . DB_PREFIX . "delivery SET
		fname = '" . $this->db->escape($data['fname']) . "',
		lname = '" . $this->db->escape($data['lname']) . "',
		gender = '" . $this->db->escape($data['gender']) ."',
		db = '" . $this->db->escape($data['db']) . "',
		address = '" . $this->db->escape($data['address']) . "',
		email = '" . $this->db->escape($data['email']) . "',
		phone = '" . $this->db->escape($data['phone']) . "',
		
		sort_order = '" . $this->db->escape($data['sort_order']) . "',
		status = '" . $this->db->escape($data['status']) . "' ");
	
		$delivery_id = $this->db->getLastId();

		if (isset($data['delivery_image'])) {
			$this->db->query("UPDATE " . DB_PREFIX . "delivery SET 
			delivery_image = '" . $this->db->escape($data['delivery_image']) . "' 
			WHERE delivery_id = '" . (int)$delivery_id . "'");
		}

		$this->cache->delete('delivery');

		return $delivery_id;
	}
	
	
	public function deleteDelivery($delivery_id) {
		$this->db->query("DELETE FROM " . DB_PREFIX . "delivery WHERE delivery_id = '" . (int)$delivery_id . "'");
		
		$this->cache->delete('delivery');
	}
	
	public function getTotalDeliveryByDeliveryId($delivery_id) {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "delivery WHERE delivery_id = '" . (int)$delivery_id . "'");

		return $query->row['total'];
	}
	
	public function getDelivery($delivery_id) {
		$query = $this->db->query("SELECT * from " . DB_PREFIX . "delivery WHERE delivery_id='" . (int)$delivery_id . "' ");

		return $query->row;
	}

	public function getDeliverys($data = array()) {
		$sql = "SELECT * , CONCAT(fname,' ',lname) as name FROM " . DB_PREFIX . "delivery";


		if (!empty($data['filter_name'])) {
			$implode[] = "CONCAT(fname, ' ', fname) LIKE '%" . $this->db->escape($data['filter_name']) . "%'";
			//$implode[] = "telephone LIKE '%" . $this->db->escape($data['filter_name']) . "%'";
		}

		$sort_data = array(
			'fname',
			'sort_order'
		);

	if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			$sql .= " ORDER BY " . $data['sort'];
		} else {
			$sql .= " ORDER BY fname";
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

		$query = $this->db->query($sql);

		return $query->rows;
	}
	public function getTotalDeliverys() {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "delivery");

		return $query->row['total'];
	}
}
