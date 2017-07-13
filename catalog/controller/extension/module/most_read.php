<?php
class ControllerExtensionModuleMostRead extends Controller {
	public function index($setting) {
		$this->load->language('extension/module/most_read');

		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_tax'] = $this->language->get('text_tax');

		$data['button_cart'] = $this->language->get('button_cart');
		$data['button_wishlist'] = $this->language->get('button_wishlist');
		$data['button_compare'] = $this->language->get('button_compare');

		$this->load->model('catalog/information');
		$this->load->model('tool/image');

	

		if (isset($this->request->get['information_id'])) {
			$information_id = $this->request->get['information_id'];
		} else {
			$information_id = '';
		}
		$data['information_id']=$information_id;
		$data['informations']=array();
		$results = $this->model_catalog_information->getMostRead($information_id);
		if ($results)
		{
			$message="Have Values";

				foreach ($results as $result) {
				if ($result['image']) {
					$image = $this->model_tool_image->resize($result['image'], $this->config->get($this->config->get('config_theme') . '_image_category_width'), $this->config->get($this->config->get('config_theme') . '_image_category_height'));
				} else {
					$image = $this->model_tool_image->resize('placeholder.png', $this->config->get($this->config->get('config_theme') . '_image_category_width'), $this->config->get($this->config->get('config_theme') . '_image_category_height'));
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
		
			return $this->load->view('extension/module/most_read', $data);
		
	}
}