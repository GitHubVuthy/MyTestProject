<?php
class ControllerProductThisWeekMenu extends Controller {
	public function index() {
		$this->load->language('product/this_week_menu');
		$this->load->model('catalog/product');
		$this->load->model('extension/extension');
		$this->load->model('tool/image');
		$this->load->model('extension/module');

		if (isset($this->request->get['sort'])) {
			$sort = $this->request->get['sort'];
		} else {
			$sort = 'p.sort_order';
		}

		if (isset($this->request->get['order'])) {
			$order = $this->request->get['order'];
		} else {
			$order = 'ASC';
		}

		if (isset($this->request->get['page'])) {
			$page = $this->request->get['page'];
		} else {
			$page = 1;
		}

		if (isset($this->request->get['limit'])) {
			$limit = (int)$this->request->get['limit'];
		} else {
			$limit = $this->config->get($this->config->get('config_theme') . '_product_limit');
		}

		$this->document->setTitle($this->language->get('heading_title'));

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/home')
		);

		$url = '';
		//today is monday
		if (1 == date('N')){
			$monday = time();
		}else{
			$monday = strtotime('last Monday');
		}
		
		if (7 == date('N')){
			$sunday = time();
		}else{
			$sunday = strtotime('Next Sunday');
		}
		
		$first_day =  date('Y-m-d',$monday);
		$last_day =  date('Y-m-d', $sunday);
		$data['first_day'] = $first_day;
		$data['last_day'] = $last_day;

		$tomorrow = date("Y-m-d", strtotime('+1 days'));

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}

		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}

		if (isset($this->request->get['limit'])) {
			$url .= '&limit=' . $this->request->get['limit'];
		}

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('product/this_week_menu', $url)
		);

		$data['heading_title'] = $this->language->get('heading_title');
		$data['heading_title_monday'] = $this->language->get('heading_title_monday');
		$data['heading_title_tuesday'] = $this->language->get('heading_title_tuesday');
		$data['heading_title_wednesday'] = $this->language->get('heading_title_wednesday');
		$data['heading_title_thursday'] = $this->language->get('heading_title_thursday');
		$data['heading_title_friday'] = $this->language->get('heading_title_friday');
		$data['heading_title_saturday'] = $this->language->get('heading_title_saturday');
		$data['heading_title_sunday'] = $this->language->get('heading_title_sunday');

		$data['text_empty'] = $this->language->get('text_empty');
		$data['text_empty_monday'] = $this->language->get('text_empty_monday');
		$data['text_empty_tuesday'] = $this->language->get('text_empty_tuesday');
		$data['text_empty_wednesday'] = $this->language->get('text_empty_wednesday');
		$data['text_empty_thursday'] = $this->language->get('text_empty_thursday');
		$data['text_empty_friday'] = $this->language->get('text_empty_friday');
		$data['text_empty_saturday'] = $this->language->get('text_empty_saturday');
		$data['text_empty_sunday'] = $this->language->get('text_empty_sunday');
		$data['text_quantity'] = $this->language->get('text_quantity');
		$data['text_manufacturer'] = $this->language->get('text_manufacturer');
		$data['text_model'] = $this->language->get('text_model');
		$data['text_price'] = $this->language->get('text_price');
		$data['text_tax'] = $this->language->get('text_tax');
		$data['text_points'] = $this->language->get('text_points');
		$data['text_compare'] = sprintf($this->language->get('text_compare'), (isset($this->session->data['compare']) ? count($this->session->data['compare']) : 0));
		$data['text_sort'] = $this->language->get('text_sort');
		$data['text_limit'] = $this->language->get('text_limit');

		$data['button_cart'] = $this->language->get('button_cart');
		$data['button_wishlist'] = $this->language->get('button_wishlist');
		$data['button_compare'] = $this->language->get('button_compare');
		$data['button_list'] = $this->language->get('button_list');
		$data['button_grid'] = $this->language->get('button_grid');
		$data['button_continue'] = $this->language->get('button_continue');

		$data['compare'] = $this->url->link('product/compare');

		$data['products'] = array();
		$data['products_monday'] = array();
		$data['products_tuesday'] = array();
		$data['products_wednesday'] = array();
		$data['products_thursday'] = array();
		$data['products_friday'] = array();
		$data['products_saturday'] = array();
		$data['products_sunday'] = array();

		$filter_data = array(
			'sort'  => $sort,
			'order' => $order,
			'start' => ($page - 1) * $limit,
			'limit' => $limit
		);

		$modules = $this->model_extension_module->getModulesByCode('daily_menu');

		// $product_total = $this->model_catalog_product->getTotalProductSpecials();

		// $results = $this->model_catalog_product->getProductSpecials($filter_data);
		$start_date = strtotime($first_day);
		$end_date = strtotime($last_day);

		foreach ($modules as $module) {
			$module_info = $this->model_extension_module->getModule($module['module_id']);
			// $module_date = date_create($module_info['date']);

			// $module_date = strtotime($module_info['date']);
			$module_date = date('Y-m-d');
			$module_date = date('Y-m-d', strtotime($module_info['date']));
			$module_day_number = date('N', strtotime($module_info['date']));
			//  $paymentDate = date('Y-m-d');
    		//$paymentDate=date('Y-m-d', strtotime($paymentDate));;

			// if($module_info['date'] >= )	
			// if (($module_date >= $first_day) && ($module_date <= $last_day) && ($module_day_number == 1)) {
			//if(
			//	(date('Y-m-d', strtotime($module_info['date'])) >= $first_day)
			// 		&& (date('Y-m-d', strtotime($module_info['date'])) <= $last_day)  
			//		&& ($module_day_number == 1) ){
			if (($module_date >= $first_day) && ($module_date <= $last_day)) {
				if ($module_day_number == 1) {
					if (!empty($module_info['product'])) {
						// $products = $module['product'];
						$products = array_slice($module_info['product'], 0, (int)$module_info['limit']);
						// $products = array_slice($setting['product'], 0, (int)$setting['limit']);
					}

					foreach ($products as $product_id) {
						$product_info = $this->model_catalog_product->getProduct($product_id);

						if ($product_info) {
							if ($product_info['image']) {
								$image = $this->model_tool_image->resize($product_info['image'], $module_info['width'], $module_info['height']);
							} else {
								$image = $this->model_tool_image->resize('placeholder.png', $module_info['width'], $module_info['height']);
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

							$data['products_monday'][] = array(
								'date'		  => $module_date,	
								'product_id'  => $product_info['product_id'],
								'thumb'       => $image,
								'name'        => $product_info['name'],
								'description' => utf8_substr(strip_tags(html_entity_decode($product_info['description'], ENT_QUOTES, 'UTF-8')), 0, $this->config->get($this->config->get('config_theme') . '_product_description_length')) . '..',
								'price'       => $price,
								'special'     => $special,
								'tax'         => $tax,
								'minimum'     => $product_info['minimum'] > 0 ? $product_info['minimum'] : 1,
								'rating'      => $rating,
								'href'        => $this->url->link('product/product', 'product_id=' . $product_info['product_id'])
							);
						}
					}
				}
				
				if ($module_day_number == 2) {
					if (!empty($module_info['product'])) {
						// $products = $module['product'];
						$products = array_slice($module_info['product'], 0, (int)$module_info['limit']);
						// $products = array_slice($setting['product'], 0, (int)$setting['limit']);
					}

					foreach ($products as $product_id) {
						$product_info = $this->model_catalog_product->getProduct($product_id);

						if ($product_info) {
							if ($product_info['image']) {
								$image = $this->model_tool_image->resize($product_info['image'], $module_info['width'], $module_info['height']);
							} else {
								$image = $this->model_tool_image->resize('placeholder.png', $module_info['width'], $module_info['height']);
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

							$data['products_tuesday'][] = array(
								'product_id'  => $product_info['product_id'],
								'thumb'       => $image,
								'name'        => $product_info['name'],
								'description' => utf8_substr(strip_tags(html_entity_decode($product_info['description'], ENT_QUOTES, 'UTF-8')), 0, $this->config->get($this->config->get('config_theme') . '_product_description_length')) . '..',
								'price'       => $price,
								'special'     => $special,
								'tax'         => $tax,
								'minimum'     => $product_info['minimum'] > 0 ? $product_info['minimum'] : 1,
								'rating'      => $rating,
								'href'        => $this->url->link('product/product', 'product_id=' . $product_info['product_id'])
							);
						}
					}
					
				}

				if ($module_day_number == 3) {
					if (!empty($module_info['product'])) {
						// $products = $module['product'];
						$products = array_slice($module_info['product'], 0, (int)$module_info['limit']);
						// $products = array_slice($setting['product'], 0, (int)$setting['limit']);
					}

					foreach ($products as $product_id) {
						$product_info = $this->model_catalog_product->getProduct($product_id);

						if ($product_info) {
							if ($product_info['image']) {
								$image = $this->model_tool_image->resize($product_info['image'], $module_info['width'], $module_info['height']);
							} else {
								$image = $this->model_tool_image->resize('placeholder.png', $module_info['width'], $module_info['height']);
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

							$data['products_wednesday'][] = array(
								'product_id'  => $product_info['product_id'],
								'thumb'       => $image,
								'name'        => $product_info['name'],
								'description' => utf8_substr(strip_tags(html_entity_decode($product_info['description'], ENT_QUOTES, 'UTF-8')), 0, $this->config->get($this->config->get('config_theme') . '_product_description_length')) . '..',
								'price'       => $price,
								'special'     => $special,
								'tax'         => $tax,
								'minimum'     => $product_info['minimum'] > 0 ? $product_info['minimum'] : 1,
								'rating'      => $rating,
								'href'        => $this->url->link('product/product', 'product_id=' . $product_info['product_id'])
							);
						}
					}
					
				}

				// Thursday
				if ($module_day_number == 4) {
					if (!empty($module_info['product'])) {
						// $products = $module['product'];
						$products = array_slice($module_info['product'], 0, (int)$module_info['limit']);
						// $products = array_slice($setting['product'], 0, (int)$setting['limit']);
					}

					foreach ($products as $product_id) {
						$product_info = $this->model_catalog_product->getProduct($product_id);

						if ($product_info) {
							if ($product_info['image']) {
								$image = $this->model_tool_image->resize($product_info['image'], $module_info['width'], $module_info['height']);
							} else {
								$image = $this->model_tool_image->resize('placeholder.png', $module_info['width'], $module_info['height']);
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

							$data['products_thursday'][] = array(
								'product_id'  => $product_info['product_id'],
								'thumb'       => $image,
								'name'        => $product_info['name'],
								'description' => utf8_substr(strip_tags(html_entity_decode($product_info['description'], ENT_QUOTES, 'UTF-8')), 0, $this->config->get($this->config->get('config_theme') . '_product_description_length')) . '..',
								'price'       => $price,
								'special'     => $special,
								'tax'         => $tax,
								'minimum'     => $product_info['minimum'] > 0 ? $product_info['minimum'] : 1,
								'rating'      => $rating,
								'href'        => $this->url->link('product/product', 'product_id=' . $product_info['product_id'])
							);
						}
					}
					
				}


				// Friday	
				if ($module_day_number == 5) {
					if (!empty($module_info['product'])) {
						// $products = $module['product'];
						$products = array_slice($module_info['product'], 0, (int)$module_info['limit']);
						// $products = array_slice($setting['product'], 0, (int)$setting['limit']);
					}

					foreach ($products as $product_id) {
						$product_info = $this->model_catalog_product->getProduct($product_id);

						if ($product_info) {
							if ($product_info['image']) {
								$image = $this->model_tool_image->resize($product_info['image'], $module_info['width'], $module_info['height']);
							} else {
								$image = $this->model_tool_image->resize('placeholder.png', $module_info['width'], $module_info['height']);
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

							$data['products_friday'][] = array(
								'product_id'  => $product_info['product_id'],
								'thumb'       => $image,
								'name'        => $product_info['name'],
								'description' => utf8_substr(strip_tags(html_entity_decode($product_info['description'], ENT_QUOTES, 'UTF-8')), 0, $this->config->get($this->config->get('config_theme') . '_product_description_length')) . '..',
								'price'       => $price,
								'special'     => $special,
								'tax'         => $tax,
								'minimum'     => $product_info['minimum'] > 0 ? $product_info['minimum'] : 1,
								'rating'      => $rating,
								'href'        => $this->url->link('product/product', 'product_id=' . $product_info['product_id'])
							);
						}
					}
					
				}

				// Saturday
				if ($module_day_number == 6) {
					if (!empty($module_info['product'])) {
						// $products = $module['product'];
						$products = array_slice($module_info['product'], 0, (int)$module_info['limit']);
						// $products = array_slice($setting['product'], 0, (int)$setting['limit']);
					}

					foreach ($products as $product_id) {
						$product_info = $this->model_catalog_product->getProduct($product_id);

						if ($product_info) {
							if ($product_info['image']) {
								$image = $this->model_tool_image->resize($product_info['image'], $module_info['width'], $module_info['height']);
							} else {
								$image = $this->model_tool_image->resize('placeholder.png', $module_info['width'], $module_info['height']);
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

							$data['products_saturday'][] = array(
								'product_id'  => $product_info['product_id'],
								'thumb'       => $image,
								'name'        => $product_info['name'],
								'description' => utf8_substr(strip_tags(html_entity_decode($product_info['description'], ENT_QUOTES, 'UTF-8')), 0, $this->config->get($this->config->get('config_theme') . '_product_description_length')) . '..',
								'price'       => $price,
								'special'     => $special,
								'tax'         => $tax,
								'minimum'     => $product_info['minimum'] > 0 ? $product_info['minimum'] : 1,
								'rating'      => $rating,
								'href'        => $this->url->link('product/product', 'product_id=' . $product_info['product_id'])
							);
						}
					}
					
				}

				//Sunday
				if ($module_day_number == 7) {
					if (!empty($module_info['product'])) {
						// $products = $module['product'];
						$products = array_slice($module_info['product'], 0, (int)$module_info['limit']);
						// $products = array_slice($setting['product'], 0, (int)$setting['limit']);
					}

					foreach ($products as $product_id) {
						$product_info = $this->model_catalog_product->getProduct($product_id);

						if ($product_info) {
							if ($product_info['image']) {
								$image = $this->model_tool_image->resize($product_info['image'], $module_info['width'], $module_info['height']);
							} else {
								$image = $this->model_tool_image->resize('placeholder.png', $module_info['width'], $module_info['height']);
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

							$data['products_sunday'][] = array(
								'product_id'  => $product_info['product_id'],
								'thumb'       => $image,
								'name'        => $product_info['name'],
								'description' => utf8_substr(strip_tags(html_entity_decode($product_info['description'], ENT_QUOTES, 'UTF-8')), 0, $this->config->get($this->config->get('config_theme') . '_product_description_length')) . '..',
								'price'       => $price,
								'special'     => $special,
								'tax'         => $tax,
								'minimum'     => $product_info['minimum'] > 0 ? $product_info['minimum'] : 1,
								'rating'      => $rating,
								'href'        => $this->url->link('product/product', 'product_id=' . $product_info['product_id'])
							);
						}
					}
					
				}

			}
			
		}

		$url = '';

		if (isset($this->request->get['limit'])) {
			$url .= '&limit=' . $this->request->get['limit'];
		}

		$data['sorts'] = array();

		$data['sorts'][] = array(
			'text'  => $this->language->get('text_default'),
			'value' => 'p.sort_order-ASC',
			'href'  => $this->url->link('product/today', 'sort=p.sort_order&order=ASC' . $url)
		);

		$data['sorts'][] = array(
			'text'  => $this->language->get('text_name_asc'),
			'value' => 'pd.name-ASC',
			'href'  => $this->url->link('product/today', 'sort=pd.name&order=ASC' . $url)
		);

		$data['sorts'][] = array(
			'text'  => $this->language->get('text_name_desc'),
			'value' => 'pd.name-DESC',
			'href'  => $this->url->link('product/today', 'sort=pd.name&order=DESC' . $url)
		);

		$data['sorts'][] = array(
			'text'  => $this->language->get('text_price_asc'),
			'value' => 'ps.price-ASC',
			'href'  => $this->url->link('product/today', 'sort=ps.price&order=ASC' . $url)
		);

		$data['sorts'][] = array(
			'text'  => $this->language->get('text_price_desc'),
			'value' => 'ps.price-DESC',
			'href'  => $this->url->link('product/today', 'sort=ps.price&order=DESC' . $url)
		);

		if ($this->config->get('config_review_status')) {
			$data['sorts'][] = array(
				'text'  => $this->language->get('text_rating_desc'),
				'value' => 'rating-DESC',
				'href'  => $this->url->link('product/today', 'sort=rating&order=DESC' . $url)
			);

			$data['sorts'][] = array(
				'text'  => $this->language->get('text_rating_asc'),
				'value' => 'rating-ASC',
				'href'  => $this->url->link('product/today', 'sort=rating&order=ASC' . $url)
			);
		}

		$data['sorts'][] = array(
				'text'  => $this->language->get('text_model_asc'),
				'value' => 'p.model-ASC',
				'href'  => $this->url->link('product/today', 'sort=p.model&order=ASC' . $url)
		);

		$data['sorts'][] = array(
			'text'  => $this->language->get('text_model_desc'),
			'value' => 'p.model-DESC',
			'href'  => $this->url->link('product/special', 'sort=p.model&order=DESC' . $url)
		);

		$url = '';

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}

		$data['limits'] = array();

		$limits = array_unique(array($this->config->get($this->config->get('config_theme') . '_product_limit'), 25, 50, 75, 100));

		sort($limits);

		foreach($limits as $value) {
			$data['limits'][] = array(
				'text'  => $value,
				'value' => $value,
				'href'  => $this->url->link('product/today', $url . '&limit=' . $value)
			);
		}

		$url = '';

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}

		if (isset($this->request->get['limit'])) {
			$url .= '&limit=' . $this->request->get['limit'];
		}

		/*
		$pagination = new Pagination();
		$pagination->total = $product_total;
		$pagination->page = $page;
		$pagination->limit = $limit;
		$pagination->url = $this->url->link('product/today', $url . '&page={page}');

		$data['pagination'] = $pagination->render();

		$data['results'] = sprintf($this->language->get('text_pagination'), ($product_total) ? (($page - 1) * $limit) + 1 : 0, ((($page - 1) * $limit) > ($product_total - $limit)) ? $product_total : ((($page - 1) * $limit) + $limit), $product_total, ceil($product_total / $limit));

		// http://googlewebmastercentral.blogspot.com/2011/09/pagination-with-relnext-and-relprev.html
		if ($page == 1) {
		    $this->document->addLink($this->url->link('product/today', '', true), 'canonical');
		} elseif ($page == 2) {
		    $this->document->addLink($this->url->link('product/today', '', true), 'prev');
		} else {
		    $this->document->addLink($this->url->link('product/today', 'page='. ($page - 1), true), 'prev');
		}

		if ($limit && ceil($product_total / $limit) > $page) {
		    $this->document->addLink($this->url->link('product/today', 'page='. ($page + 1), true), 'next');
		}
		*/

		$data['sort'] = $sort;
		$data['order'] = $order;
		$data['limit'] = $limit;

		$data['continue'] = $this->url->link('common/home');

		$data['column_left'] = $this->load->controller('common/column_left');
		$data['column_right'] = $this->load->controller('common/column_right');
		$data['content_top'] = $this->load->controller('common/content_top');
		$data['content_bottom'] = $this->load->controller('common/content_bottom');
		$data['footer'] = $this->load->controller('common/footer');
		$data['header'] = $this->load->controller('common/header');

		$this->response->setOutput($this->load->view('product/this_week_menu', $data));
	}
}
