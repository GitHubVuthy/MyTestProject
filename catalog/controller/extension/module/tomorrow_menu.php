<?php
class ControllerExtensionModuleTomorrowMenu extends Controller {
	public function index($setting) {
		$this->load->language('extension/module/tomorrow_menu');

		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_tax'] = $this->language->get('text_tax');

		$data['button_cart'] = $this->language->get('button_cart');
		$data['button_wishlist'] = $this->language->get('button_wishlist');
		$data['button_compare'] = $this->language->get('button_compare');

		$this->load->model('catalog/product');

		$this->load->model('tool/image');

		$data['products'] = array();
		
		$data["name"] = $setting["name"];

		if (!$setting['limit']) {
			$setting['limit'] = 4;
		}

		$today = date("Y-m-d");
		$data['today'] = $today;
		$tomorrow = date("Y-m-d", strtotime('+1 days'));
		$data['tomorrow'] = $tomorrow;

		$modules = $this->model_extension_module->getModulesByCode('daily_menu');

		foreach ($modules as $module) {
			$module_info = $this->model_extension_module->getModule($module['module_id']);
			if ($module_info['date'] === $tomorrow) {
				if (!empty($module_info['product'])) {
					// $products = $module['product'];
					$products = array_slice($module_info['product'], 0, (int)$module_info['limit']);
					// $products = array_slice($setting['product'], 0, (int)$setting['limit']);
				}

				foreach ($products as $product_id) {
					$product_info = $this->model_catalog_product->getProduct($product_id);

					if ($product_info) {
						if ($product_info['image']) {
							$image = $this->model_tool_image->resize($product_info['image'], $setting['width'], $setting['height']);
						} else {
							$image = $this->model_tool_image->resize('placeholder.png', $setting['width'], $setting['height']);
						}

						if ($this->customer->isLogged() || !$this->config->get('config_customer_price')) {
							$price = $this->currency->format($this->tax->calculate($product_info['price'], $product_info['tax_class_id'], $this->config->get('config_tax')), $this->session->data['currency']);
						} else {
							$price = false;
						}

						if ((float)$product_info['special']) {
							$special = $this->currency->format($this->tax->calculate($product_info['special'], $product_info['tax_class_id'], $this->config->get('config_tax')), $this->session->data['currency']);
						} else {
							$special = false;
						}

						if ($this->config->get('config_tax')) {
							$tax = $this->currency->format((float)$product_info['special'] ? $product_info['special'] : $product_info['price'], $this->session->data['currency']);
						} else {
							$tax = false;
						}

						if ($this->config->get('config_review_status')) {
							$rating = $product_info['rating'];
						} else {
							$rating = false;
						}

						$data['products'][] = array(
							'product_id'  => $product_info['product_id'],
							'thumb'       => $image,
							'name'        => $product_info['name'],
							'description' => utf8_substr(strip_tags(html_entity_decode($product_info['description'], ENT_QUOTES, 'UTF-8')), 0, $this->config->get($this->config->get('config_theme') . '_product_description_length')) . '..',
							'price'       => $price,
							'special'     => $special,
							'tax'         => $tax,
							'rating'      => $rating,
							'href'        => $this->url->link('product/product', 'product_id=' . $product_info['product_id'])
						);
					}
				}
				
			}
		}
				
		if ($data['products']) {
			return $this->load->view('extension/module/tomorrow_menu', $data);
		}
	}
}