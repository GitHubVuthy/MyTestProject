<?php
class ModelCatalogVideo extends Model {
	public function getVideos() {
		$query = $this->db->query("SELECT v.video_id, v.url, v.status,vd.language_id, vd.title, vd.description, vd.meta_description, vd.meta_keyword, vd.meta_title FROM oc_video v INNER JOIN oc_video_description vd on (v.video_id=vd.video_id) where vd.language_id=1 and v.status=1  ");

		return $query->rows;

	}


	}


