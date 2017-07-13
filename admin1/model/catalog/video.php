<?php
class ModelCatalogVideo extends Model {
	public function addInformation($data) {
		$this->db->query("INSERT INTO " . DB_PREFIX . "video SET sort_order = '" . (int)$data['sort_order'] . "', status = '" . (int)$data['status'] . "', url = '" . $this->db->escape($data['url']) . "' ");

		$video_id = $this->db->getLastId();


		/*if (isset($data['image'])) {
			$this->db->query("UPDATE " . DB_PREFIX . "information SET image = '" . $this->db->escape($data['image']) . "' WHERE information_id = '" . (int)$information_id . "'");
		}*/

		foreach ($data['video_description'] as $language_id => $value) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "video_description SET video_id = '" . (int)$video_id . "', language_id = '" . (int)$language_id . "', title = '" . $this->db->escape($value['title']) . "', description = '" . $this->db->escape($value['description']) . "', meta_title = '" . $this->db->escape($value['meta_title']) . "', meta_description = '" . $this->db->escape($value['meta_description']) . "', meta_keyword = '" . $this->db->escape($value['meta_keyword']) . "'");
		}
//Information to Category
		if (isset($data['info_category'])) {
			foreach ($data['info_category'] as $category_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "information_to_info_category SET information_id = '" . (int)$information_id . "', category_id = '" . (int)$category_id . "'");
			}
		}


//Ralated Information
		if (isset($data['related_information'])) {
			foreach ($data['related_information'] as $related_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "information_related SET information_id = '" . (int)$information_id . "', related_id = '" . (int)$related_id . "'");
			}
		}


//Ralated Information Test0
		if (isset($data['related_information_test'])) {
			foreach ($data['related_information_test'] as $related_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "information_related SET information_id = '" . (int)$information_id . "', related_id = '" . (int)$related_id . "'");
			}
		}


		$this->cache->delete('video');

		return $video_id;
	}

	public function editInformation($video_id, $data) {
		$this->db->query("UPDATE " . DB_PREFIX . "video SET sort_order = '" . (int)$data['sort_order'] . "', status = '" . (int)$data['status'] . "', url='" . $this->db->escape($data['url']) . "' WHERE video_id = '" . (int)$video_id . "'");

		
		/*if (isset($data['image'])) {
			$this->db->query("UPDATE " . DB_PREFIX . "information SET image = '" . $this->db->escape($data['image']) . "' WHERE information_id = '" . (int)$information_id . "'");
		}*/
			
		$this->db->query("DELETE FROM " . DB_PREFIX . "video_description WHERE video_id = '" . (int)$video_id . "'");

		foreach ($data['video_description'] as $language_id => $value) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "video_description SET video_id = '" . (int)$video_id . "', language_id = '" . (int)$language_id . "', title = '" . $this->db->escape($value['title']) . "', description = '" . $this->db->escape($value['description']) . "', meta_title = '" . $this->db->escape($value['meta_title']) . "', meta_description = '" . $this->db->escape($value['meta_description']) . "', meta_keyword = '" . $this->db->escape($value['meta_keyword']) . "'");
		}

		$this->db->query("DELETE FROM " . DB_PREFIX . "video_to_store WHERE video_id = '" . (int)$video_id . "'");

		/*if (isset($data['video_store'])) {
			foreach ($data['video_store'] as $store_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "video_to_store SET video_id = '" . (int)$video_id . "', store_id = '" . (int)$store_id . "'");
			}
		}*/
	//Information to Category
			$this->db->query("DELETE FROM " . DB_PREFIX . "information_to_info_category WHERE information_id = '" . (int)$information_id . "'");

		if (isset($data['info_category'])) {
			foreach ($data['info_category'] as $category_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "information_to_info_category SET information_id = '" . (int)$information_id . "', category_id = '" . (int)$category_id . "'");
			}
		}


//Related Information
			$this->db->query("DELETE FROM " . DB_PREFIX . "information_related WHERE information_id = '" . (int)$information_id . "'");

		if (isset($data['related_information'])) {
			foreach ($data['related_information'] as $related_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "information_related SET information_id = '" . (int)$information_id . "', related_id = '" . (int)$related_id . "'");
			}
		}


		$this->cache->delete('video');
	}

	public function deleteVideo($video_id) {
		$this->db->query("DELETE FROM " . DB_PREFIX . "video WHERE video_id = '" . (int)$video_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "video_description WHERE video_id = '" . (int)$video_id . "'");
		

		$this->cache->delete('video');
	}

public function getInformationDescription($information_id) {
		$query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "information_description  id WHERE information_id = '" . (int)$information_id . "' AND id.language_id = '" . (int)$this->config->get('config_language_id') . "'");

		return $query->row;
	}

public function getInformationDescriptionTest($information_id) {
		$query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "information_description  id WHERE information_id = '" . (int)$information_id . "' AND id.language_id = '" . (int)$this->config->get('config_language_id') . "'");

		return $query->row;
	}



	public function getInformation($video_id) {
		$query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "video WHERE video_id = '" . (int)$video_id . "' ");

		return $query->row;
	}

	

	public function getInformations($data = array()) {
		if ($data) {
			$sql = "SELECT * FROM " . DB_PREFIX . "video i LEFT JOIN " . DB_PREFIX . "video_description id ON (i.video_id = id.video_id) WHERE id.language_id = '" . (int)$this->config->get('config_language_id') . "'";

			if (!empty($data['filter_name'])) {
			$sql .= " AND id.title LIKE '%" . $this->db->escape($data['filter_name']) . "%'";
			}


			$sort_data = array(
				'id.title',
				'i.sort_order'
			);
				

			if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
				$sql .= " ORDER BY " . $data['sort'];
			} else {
				$sql .= " ORDER BY id.title";
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
}
	
	public function getInformationCategory($information_id) {
		$information_category = array();

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "information_to_info_category WHERE information_id = '" . (int)$information_id . "'");

		foreach ($query->rows as $result) {
			$information_category[] = $result['category_id'];
		}

		return $information_category;
	}

	
	public function getInformationDescriptions($video_id) {
		$information_description_data = array();

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "video_description WHERE video_id = '" . (int)$video_id . "'");

		foreach ($query->rows as $result) {
			$information_description_data[$result['language_id']] = array(
				'title'            => $result['title'],
				'description'      => $result['description'],
				'meta_title'       => $result['meta_title'],
				'meta_description' => $result['meta_description'],
				'meta_keyword'     => $result['meta_keyword']

			);
		}

		return $information_description_data;
	}

	public function getInformationStores($information_id) {
		$information_store_data = array();

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "information_to_store WHERE information_id = '" . (int)$information_id . "'");

		foreach ($query->rows as $result) {
			$information_store_data[] = $result['store_id'];
		}

		return $information_store_data;
	}

	public function getInformationLayouts($information_id) {
		$information_layout_data = array();

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "information_to_layout WHERE information_id = '" . (int)$information_id . "'");

		foreach ($query->rows as $result) {
			$information_layout_data[$result['store_id']] = $result['layout_id'];
		}

		return $information_layout_data;
	}

	public function getTotalInformations() {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "video");

		return $query->row['total'];
	}

	public function getTotalInformationsByLayoutId($layout_id) {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "information_to_layout WHERE layout_id = '" . (int)$layout_id . "'");

		return $query->row['total'];
	}
}