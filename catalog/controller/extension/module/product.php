<?php
class ControllerExtensionModuleProduct extends Controller {
	public function index($setting) {
		$this->load->language('extension/module/product');

		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_tax'] = $this->language->get('text_tax');

		$data['button_cart'] = $this->language->get('button_cart');
		$data['button_wishlist'] = $this->language->get('button_wishlist');
		$data['button_compare'] = $this->language->get('button_compare');

		$this->load->model('extension/module/product');
		$this->load->model('tool/image');

		$data['products']=array();
		$results = $this->model_extension_module_product->getProducts();
		if ($results)
		{
			$message="Have Values";

				foreach ($results as $result) {
				if ($result['image']) {
					$image = $this->model_tool_image->resize($result['image'], $this->config->get($this->config->get('config_theme') . '_image_product_width'), $this->config->get($this->config->get('config_theme') . '_image_product_height'));
				} else {
					$image = $this->model_tool_image->resize('placeholder.png', $this->config->get($this->config->get('config_theme') . '_image_product_width'), $this->config->get($this->config->get('config_theme') . '_image_product_height'));
				}
					$data['products'][] = array(
					'product_id'  => $result['product_id'],
					'thumb'       => $image,
					'name'        => $result['name'],
					'description' => utf8_substr(strip_tags(html_entity_decode($result['description'], ENT_QUOTES, 'UTF-8')), 0, $this->config->get($this->config->get('config_theme') . '_product_description_length')) . '..',
					
					'href'        => $this->url->link('catalog/product', 'product_id=' .$result['product_id']  )
				);
		
			}
			
		}
		
			return $this->load->view('extension/module/product', $data);
		
	}
}