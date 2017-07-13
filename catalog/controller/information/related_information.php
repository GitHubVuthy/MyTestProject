<?php
class ControllerInformationRelatedInformation extends Controller {
	public function index() {
		$this->load->language('information/information');
		$this->load->model('catalog/information');
		$this->load->model('tool/image');
		$data['text_empty'] = $this->language->get('text_empty');

		if (isset($this->request->get['information_id'])) {
			$information_id = $this->request->get['information_id'];
		} else {
			$information_id = '';
		}
		$data['informations']=array();
		$results = $this->model_catalog_information->getRelateds($information_id);
		if ($results)
		{
			$message="Have Values";

				foreach ($results as $result) {
				if ($result['image']) {
					$image = $this->model_tool_image->resize($result['image'], $this->config->get($this->config->get('config_theme') . '_image_product_width'), $this->config->get($this->config->get('config_theme') . '_image_product_height'));
				} else {
					$image = $this->model_tool_image->resize('placeholder.png', $this->config->get($this->config->get('config_theme') . '_image_product_width'), $this->config->get($this->config->get('config_theme') . '_image_product_height'));
				}
					$data['informations'][] = array(
					'information_id'  => $result['information_id'],
					'thumb'       => $image,
					'name'        => $result['title'],
					'description' => utf8_substr(strip_tags(html_entity_decode($result['description'], ENT_QUOTES, 'UTF-8')), 0, $this->config->get($this->config->get('config_theme') . '_product_description_length')) . '..',
					
					'href'        => $this->url->link('information/information', 'information_id=' .$result['information_id']  )
				);
		
			}
			
		}
		else{
			$message="No Values";
		}
		//Please make sure that we need $data to return value

			$data['column_left'] = $this->load->controller('common/column_left');
			$data['column_right'] = $this->load->controller('common/column_right');
			$data['content_top'] = $this->load->controller('common/content_top');
			$data['content_bottom'] = $this->load->controller('common/content_bottom');
			$data['footer'] = $this->load->controller('common/footer');
			$data['header'] = $this->load->controller('common/header');
			$data['message']=$message;

			$this->response->setOutput($this->load->view('information/related_information', $data));
	}
}
