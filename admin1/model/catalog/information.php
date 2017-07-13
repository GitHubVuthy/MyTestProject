<?php
class ModelCatalogInformation extends Model {
	public function addInformation($data) {
		$this->db->query("INSERT INTO " . DB_PREFIX . "information SET sort_order = '" . (int)$data['sort_order'] . "', bottom = '" . (isset($data['bottom']) ? (int)$data['bottom'] : 0) . "', status = '" . (int)$data['status'] . "'");

		$information_id = $this->db->getLastId();


		if (isset($data['image'])) {
			$this->db->query("UPDATE " . DB_PREFIX . "information SET image = '" . $this->db->escape($data['image']) . "' WHERE information_id = '" . (int)$information_id . "'");
		}

		foreach ($data['information_description'] as $language_id => $value) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "information_description SET information_id = '" . (int)$information_id . "', language_id = '" . (int)$language_id . "', title = '" . $this->db->escape($value['title']) . "', description = '" . $this->db->escape($value['description']) . "', meta_title = '" . $this->db->escape($value['meta_title']) . "', meta_description = '" . $this->db->escape($value['meta_description']) . "', meta_keyword = '" . $this->db->escape($value['meta_keyword']) . "'");
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




		if (isset($data['information_store'])) {
			foreach ($data['information_store'] as $store_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "information_to_store SET information_id = '" . (int)$information_id . "', store_id = '" . (int)$store_id . "'");
			}
		}
//Info_category field that just add new
 
		if (isset($data['information_layout'])) {
			foreach ($data['information_layout'] as $store_id => $layout_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "information_to_layout SET information_id = '" . (int)$information_id . "', store_id = '" . (int)$store_id . "', layout_id = '" . (int)$layout_id . "'");
			}
		}

		if (isset($data['keyword'])) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "url_alias SET query = 'information_id=" . (int)$information_id . "', keyword = '" . $this->db->escape($data['keyword']) . "'");
		}

		$this->cache->delete('information');

		return $information_id;
	}

	public function editInformation($information_id, $data) {
		$this->db->query("UPDATE " . DB_PREFIX . "information SET sort_order = '" . (int)$data['sort_order'] . "', bottom = '" . (isset($data['bottom']) ? (int)$data['bottom'] : 0) . "', status = '" . (int)$data['status'] . "' WHERE information_id = '" . (int)$information_id . "'");

		
		if (isset($data['image'])) {
			$this->db->query("UPDATE " . DB_PREFIX . "information SET image = '" . $this->db->escape($data['image']) . "' WHERE information_id = '" . (int)$information_id . "'");
		}
			
		$this->db->query("DELETE FROM " . DB_PREFIX . "information_description WHERE information_id = '" . (int)$information_id . "'");

		foreach ($data['information_description'] as $language_id => $value) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "information_description SET information_id = '" . (int)$information_id . "', language_id = '" . (int)$language_id . "', title = '" . $this->db->escape($value['title']) . "', description = '" . $this->db->escape($value['description']) . "', meta_title = '" . $this->db->escape($value['meta_title']) . "', meta_description = '" . $this->db->escape($value['meta_description']) . "', meta_keyword = '" . $this->db->escape($value['meta_keyword']) . "'");
		}

		$this->db->query("DELETE FROM " . DB_PREFIX . "information_to_store WHERE information_id = '" . (int)$information_id . "'");

		if (isset($data['information_store'])) {
			foreach ($data['information_store'] as $store_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "information_to_store SET information_id = '" . (int)$information_id . "', store_id = '" . (int)$store_id . "'");
			}
		}
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


		$this->db->query("DELETE FROM " . DB_PREFIX . "information_to_layout WHERE information_id = '" . (int)$information_id . "'");

		if (isset($data['information_layout'])) {
			foreach ($data['information_layout'] as $store_id => $layout_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "information_to_layout SET information_id = '" . (int)$information_id . "', store_id = '" . (int)$store_id . "', layout_id = '" . (int)$layout_id . "'");
			}
		}

		$this->db->query("DELETE FROM " . DB_PREFIX . "url_alias WHERE query = 'information_id=" . (int)$information_id . "'");

		if ($data['keyword']) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "url_alias SET query = 'information_id=" . (int)$information_id . "', keyword = '" . $this->db->escape($data['keyword']) . "'");
		}

		$this->cache->delete('information');
	}

	public function deleteInformation($information_id) {
		$this->db->query("DELETE FROM " . DB_PREFIX . "information WHERE information_id = '" . (int)$information_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "information_description WHERE information_id = '" . (int)$information_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "information_to_store WHERE information_id = '" . (int)$information_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "information_to_layout WHERE information_id = '" . (int)$information_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "url_alias WHERE query = 'information_id=" . (int)$information_id . "'");

		$this->cache->delete('information');
	}

public function getInformationDescription($information_id) {
		$query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "information_description  id WHERE information_id = '" . (int)$information_id . "' AND id.language_id = '" . (int)$this->config->get('config_language_id') . "'");

		return $query->row;
	}

public function getInformationDescriptionTest($information_id) {
		$query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "information_description  id WHERE information_id = '" . (int)$information_id . "' AND id.language_id = '" . (int)$this->config->get('config_language_id') . "'");

		return $query->row;
	}



	public function getInformation($information_id) {
		$query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "information WHERE information_id = '" . (int)$information_id . "' ");

		return $query->row;
	}

	public function getRelatedInformation($information_id) {
		$related_information = array();

		$query = $this->db->query("SELECT related_id FROM " . DB_PREFIX . "information_related  WHERE information_id = '" . (int)$information_id . "'");

		foreach ($query->rows as $result) {
			$related_information[] = $result['related_id'];
		}

		return $related_information;
	}


	public function getRelatedInformationTest($information_id) {
		$related_information_test = array();

		$query = $this->db->query("SELECT related_id FROM " . DB_PREFIX . "information_related  WHERE information_id = '" . (int)$information_id . "'");

		foreach ($query->rows as $result) {
			$related_information_test[] = $result['related_id'];
		}

		return $related_information_test;
	}


/*
	public function getRelatedInformationDescription($information_id) {0
0	0	0$0q0u0e0r0y0 0=0 0$0t0h0i0s0-0>0d0b0-0>0q0u0e0r0y0(0"0S0E0L0E0C0T0 0i0r0.0i0n0f0o0r0m0a0t0i0o0n0_0i0d0,0 0i0r0.0r0e0l0a0t0e0d0_0i0d0,0 0i0d0.0t0i0t0l0e0 0F0R0O0M0 0"0 0.0 0D0B0_0P0R0E0F0I0X0 0.0 0"0i0n0f0o0r0m0a0t0i0o0n0_0d0e0s0c0r0i0p0t0i0o0n0 0i0d0 0I0N0N0E0R0 0J0O0I0N0 0 0"0 0.0 0D0B0_0P0R0E0F0I0X0 0.0 0"0i0n0f0o0r0m0a0t0i0o0n.00_related ir ON (id.information_id = ir.related_id) WHERE id.information_id = '" . (int)$informati0on_id . "'  AND id.language_id = '" . (int)$this->config->get('config_language_id') . "'");
		retur0000000000000n $query->row;
	}
*/

/*SELECT * FROM `oc_information_related` ir INNER JOIN `information` id on ir.information_id=id.information_id INNER JOIN `oc_information` i on ir.related_id=i.information_id WHERE language_id=1 and ir.information_id=4 */


/*	public function getInfoCategory($category_id) {
		$query = $this->db->query("SELECT DISTINCT *, (SELECT GROUP_CONCAT(cd1.name ORDER BY level SEPARATOR '&nbsp;&nbsp;&gt;&nbsp;&nbsp;') FROM " . DB_PREFIX . "info_category_path cp LEFT JOIN " . DB0_PR000000000000000000000000000EFIX . "info_category_description cd1 ON (cp.path_id = cd1.category_id AND cp.category_id != cp.path_id) WHERE cp.category_id = c.category_id AND cd1.language_id = '" . (int)$this->config->get('config_language_id') . "' GROUP BY cp.category_id) AS path, (SELECT DISTINCT keyword FROM " . DB_PREFIX . "url_alias WHERE query = 'category_id=" . (int)$category_id . "') AS keyword FROM " . DB_PREFIX . "info_category c LEFT JOIN " . DB_PREFIX . "info_category_description cd2 ON (c.category_id = cd2.category_id) WHERE c.category_id = '" . (int)$category_id . "' AND cd2.language_id = '" . (int)$this->config->get('config_language_id') . "'");

		return $query->row;
	}
*/
	public function getInformations($data = array()) {
		if ($data) {
			$sql = "SELECT * FROM " . DB_PREFIX . "information i LEFT JOIN " . DB_PREFIX . "information_description id ON (i.information_id = id.information_id) WHERE id.language_id = '" . (int)$this->config->get('config_language_id') . "'";

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
		} /*else {
			$information_data = $this->cache->get('information.' . (int)$this->config->get('config_language_id'));

			if (!$information_data) {
				$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "information i LEFT JOIN " . DB_PREFIX . "information_description id ON (i.information_id = id.information_id) WHERE id.language_id = '" . (int)$this->config->get('config_language_id') . "' ORDER BY id.title");

				$information_data = $query->rows;

				$this->cache->set('information.' . (int)$this->config->get('config_language_id'), $information_data);
			}

			return $information_data;
		}*/
	}
	
	public function getInformationCategory($information_id) {
		$information_category = array();

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "information_to_info_category WHERE information_id = '" . (int)$information_id . "'");

		foreach ($query->rows as $result) {
			$information_category[] = $result['category_id'];
		}

		return $information_category;
	}

	
	public function getInformationDescriptions($information_id) {
		$information_description_data = array();

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "information_description WHERE information_id = '" . (int)$information_id . "'");

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
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "information");

		return $query->row['total'];
	}

	public function getTotalInformationsByLayoutId($layout_id) {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "information_to_layout WHERE layout_id = '" . (int)$layout_id . "'");

		return $query->row['total'];
	}
}