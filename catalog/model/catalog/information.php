<?php
class ModelCatalogInformation extends Model {

	public function views($information_id,$views) {
		$this->db->query("UPDATE ".DB_PREFIX."information SET views='".(int)$views."' WHERE information_id = '" . (int)$information_id . "'");
		
		$this->cache->delete('information');
	}

public function getMostRead($information_id) {
		$query = $this->db->query("SELECT * FROM ".DB_PREFIX."information i INNER JOIN ".DB_PREFIX."information_description id on (i.information_id=id.information_id) WHERE id.language_id=1 ORDER BY views DESC LIMIT 0,3 ");

		return $query->rows;

	}


	/*public function getMostRead() {
		$query = $this->db->query("SELECT * FROM ".DB_PREFIX."information i LEFT JOIN oc_information_description id ON (i.information_id = id.information_id) LEFT JOIN ".DB_PREFIX."information_to_store i2s ON (i.information_id = i2s.information_id) WHERE id.language_id = '".(int)$this->config->get('config_language_id')."' AND i.status = '1' order by views DESC LIMIT 0, 5 ");

		return $query->row;
	}
*/

	public function getInformation($information_id) {
		$query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "information i LEFT JOIN " . DB_PREFIX . "information_description id ON (i.information_id = id.information_id) LEFT JOIN " . DB_PREFIX . "information_to_store i2s ON (i.information_id = i2s.information_id) WHERE i.information_id = '" . (int)$information_id . "' AND id.language_id = '" . (int)$this->config->get('config_language_id') . "' AND i2s.store_id = '" . (int)$this->config->get('config_store_id') . "' AND i.status = '1'");

		return $query->row;
	}

	public function getInformationLayoutId($information_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "information_to_layout WHERE information_id = '" . (int)$information_id . "' AND store_id = '" . (int)$this->config->get('config_store_id') . "'");

		if ($query->num_rows) {
			return $query->row['layout_id'];
		} else {
			return 0;
		}
	}

public function getInformationDescription($information_id) {
		$query = $this->db->query("SELECT  * FROM " . DB_PREFIX . "information_description  id WHERE information_id = '" . (int)$information_id . "' AND id.language_id = '" . (int)$this->config->get('config_language_id') . "'");

		return $query->row;
	}

//New code of getRelatedInformation
public function getRelatedInformation($information_id) {
		$related_information = array();

		$query = $this->db->query("SELECT related_id FROM " . DB_PREFIX . "information_related limit 3 WHERE information_id = '" . (int)$information_id . "' ");

		foreach ($query->rows as $result) {
			$related_information[] = $result['related_id'];
		}

		return $related_information;
	}

//Testing
public function getRelatedInfoNew($information_id)
{
	$query= $this->db->query("SELECT * FROM " . DB_PREFIX . "information_related ir INNER JOIN  " . DB_PREFIX . "information_description id on ir.information_id=id.information_id INNER JOIN " . DB_PREFIX . "information i on ir.related_id=i.information_id where id.language_id = '" . (int)$this->config->get('config_language_id') . "' and ir.information_id = '" . (int)$information_id . "' limit 3");
}

// New Code of getRelatedInformationDescription

	public function getRelatedInformationDescription($information_id) {
		$query = $this->db->query("SELECT ir.information_id, ir.related_id, id.title FROM " . DB_PREFIX . "information_description id INNER JOIN  " . DB_PREFIX . "information_related ir ON (id.information_id = ir.related_id)  WHERE id.information_id = '" . (int)$information_id . "'  AND id.language_id = '" . (int)$this->config->get('config_language_id') . "'");
		return $query->row;
	}



	public function getRelateds($information_id) {
		$query = $this->db->query("SELECT * from ". DB_PREFIX ."information_description id INNER JOIN ". DB_PREFIX ."information_related ir on (id.information_id=ir.related_id) INNER JOIN  " . DB_PREFIX . "information i ON (id.information_id = i.information_id) where ir.information_id='".(int)$information_id."' AND id.language_id = '" . (int)$this->config->get('config_language_id') . "' limit 3 ");

		return $query->rows;

	}







public function getInformations($data = array()) {

	$sql = "SELECT *";

		if (!empty($data['filter_category_id'])) {
			if (!empty($data['filter_sub_category'])) {
				$sql .= " FROM " . DB_PREFIX . "info_category_path icp LEFT JOIN " . DB_PREFIX . "information_to_info_category i2c ON (icp.category_id = i2c.category_id)";
			} else {
				$sql .= " FROM " . DB_PREFIX . "information_to_info_category i2c";
			}

			
				$sql .= " LEFT JOIN " . DB_PREFIX . "information i ON (i2c.information_id = i.information_id)";
			
		} else {
			$sql .= " FROM " . DB_PREFIX . "information i";
		}

		$sql .= " LEFT JOIN " . DB_PREFIX . "information_description id ON (i.information_id = id.information_id) LEFT JOIN " . DB_PREFIX . "information_to_store i2s ON (i.information_id = i2s.information_id) WHERE id.language_id = '" . (int)$this->config->get('config_language_id') . "' AND i.status = '1' AND i2s.store_id = '" . (int)$this->config->get('config_store_id') . "'";

		if (!empty($data['filter_category_id'])) {
			if (!empty($data['filter_sub_category'])) {
				$sql .= " AND icp.path_id = '" . (int)$data['filter_category_id'] . "'";
			} else {
				$sql .= " AND i2c.category_id = '" . (int)$data['filter_category_id'] . "'";
			}

		
		}

		


		$sort_data = array(
			'id.title',
			'i.sort_order',
			
		);

		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			if ($data['sort'] == 'id.title') {
				$sql .= " ORDER BY LCASE(" . $data['sort'] . ")";
			}
			 else {
				$sql .= " ORDER BY " . $data['sort'];
			}
		} else {
			$sql .= " ORDER BY i.sort_order";
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

		$information_data = array();

		$query = $this->db->query($sql);

		foreach ($query->rows as $result) {
			$information_data[$result['information_id']] = $this->getInformation($result['information_id']);
		}

		return $information_data;
	}



		
	public function getTotalInformations($parent_id) {
		$query = $this->db->query("SELECT COUNT( DISTINCT `information_id`) as total FROM " . DB_PREFIX . "information_to_info_category where category_id= '" . (int)$parent_id . "'" );

		return $query->row['total'];
	}


	

}
	


