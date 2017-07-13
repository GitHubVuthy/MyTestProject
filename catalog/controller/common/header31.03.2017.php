<?php
class ControllerCommonHeader extends Controller {
	public function index() {
		// Analytics
		$this->load->model('extension/extension');

		$data['analytics'] = array();

		$analytics = $this->model_extension_extension->getExtensions('analytics');

		foreach ($analytics as $analytic) {
			if ($this->config->get($analytic['code'] . '_status')) {
				$data['analytics'][] = $this->load->controller('extension/analytics/' . $analytic['code'], $this->config->get($analytic['code'] . '_status'));
			}
		}

		if ($this->request->server['HTTPS']) {
			$server = $this->config->get('config_ssl');
		} else {
			$server = $this->config->get('config_url');
		}

		if (is_file(DIR_IMAGE . $this->config->get('config_icon'))) {
			$this->document->addLink($server . 'image/' . $this->config->get('config_icon'), 'icon');
		}

		$data['title'] = $this->document->getTitle();

		$data['base'] = $server;
		$data['description'] = $this->document->getDescription();
		$data['keywords'] = $this->document->getKeywords();
		$data['links'] = $this->document->getLinks();
		$data['styles'] = $this->document->getStyles();
		$data['scripts'] = $this->document->getScripts();
		$data['lang'] = $this->language->get('code');
		$data['direction'] = $this->language->get('direction');

		$data['name'] = $this->config->get('config_name');

		if (is_file(DIR_IMAGE . $this->config->get('config_logo'))) {
			$data['logo'] = $server . 'image/' . $this->config->get('config_logo');
			$data['logo1'] = $server . 'image/catalog/xs-white-garlic.jpg';
			$data['bheader'] = $server . 'image/catalog/bheader.png';
		} else {
			$data['logo'] = '';
			$data['logo1'] = $server . 'image/catalog/white-garlic.jpg';
			$data['bheader'] = $server . 'image/catalog/bheader.png';
		}

		$this->load->language('common/header');
		//About us text
		$data['text_about'] = $this->language->get('text_about');
		$data['text_founder'] = $this->language->get('text_founder');
		$data['text_supplyer'] = $this->language->get('text_supplyer');
		$data['text_cooking'] = $this->language->get('text_cooking');
		$data['text_packing'] = $this->language->get('text_packing');
		$data['text_partner'] = $this->language->get('text_partner');
		$data['text_feedback'] = $this->language->get('text_feedback');
		$data['text_gallary'] = $this->language->get('text_gallary');
		$data['text_mission'] = $this->language->get('text_mission');
		//Food and Health
		$data['text_food_health'] = $this->language->get('text_food_health');
		$data['text_benefites_of_vegetables'] = $this->language->get('text_benefites_of_vegetables');
		$data['text_food_for_heart_disease_people'] = $this->language->get('text_food_for_heart_disease_people');
		$data['text_foods_for_diabetes_people'] = $this->language->get('text_foods_for_diabetes_people');
		$data['text_food_for_high_blood_pressure_peple'] = $this->language->get('text_food_for_high_blood_pressure_peple');
		$data['text_food_for_pregnant_women'] = $this->language->get('text_food_for_pregnant_women');
		$data['text_food_for_women_childbirth'] = $this->language->get('text_food_for_women_childbirth');
		$data['text_meals_for_kids'] = $this->language->get('text_meals_for_kids');


		//Service text
		$data['text_service'] = $this->language->get('text_service');
		$data['text_daily_food'] = $this->language->get('text_daily_food');
		$data['text_food_party'] = $this->language->get('text_food_party');
		$data['text_food_snack'] = $this->language->get('text_food_snack');
		$data['text_organic_cafeterias'] = $this->language->get('text_organic_cafeterias');
		$data['text_organic_fruit'] = $this->language->get('text_organic_fruit');
		$data['text_organic_vegetables'] = $this->language->get('text_organic_vegetables');
		$data['text_food_magazine'] = $this->language->get('text_food_magazine');
		$data['text_course_cooking_for_tour'] = $this->language->get('text_course_cooking_for_tour');

		// Product Order Category
		$data['text_product_order_category'] = $this->language->get('text_product_order_category');
$data['text_home'] = $this->language->get('text_home');


		$data['text_home'] = $this->language->get('text_home');
		$data['this_week_menu'] = $this->url->link('product/this_week_menu');
		$data['text_today_menu'] = $this->language->get('text_today_menu');
		// Wishlist
		if ($this->customer->isLogged()) {
			$this->load->model('account/wishlist');

			$data['text_wishlist'] = sprintf($this->language->get('text_wishlist'), $this->model_account_wishlist->getTotalWishlist());
		} else {
			$data['text_wishlist'] = sprintf($this->language->get('text_wishlist'), (isset($this->session->data['wishlist']) ? count($this->session->data['wishlist']) : 0));
		}

		$data['text_shopping_cart'] = $this->language->get('text_shopping_cart');
		$data['text_logged'] = sprintf($this->language->get('text_logged'), $this->url->link('account/account', '', true), $this->customer->getFirstName(), $this->url->link('account/logout', '', true));

		$data['text_account'] = $this->language->get('text_account');
		$data['text_register'] = $this->language->get('text_register');
		$data['text_login'] = $this->language->get('text_login');
		$data['text_order'] = $this->language->get('text_order');
		$data['text_transaction'] = $this->language->get('text_transaction');
		$data['text_download'] = $this->language->get('text_download');
		$data['text_logout'] = $this->language->get('text_logout');
		$data['text_checkout'] = $this->language->get('text_checkout');
		$data['text_category'] = $this->language->get('text_category');
		$data['text_all'] = $this->language->get('text_all');

		$data['home'] = $this->url->link('common/home');
		$data['today_menu'] = $this->url->link('product/today_menu');

		$data['text_this_week_menu'] =  $this->language->get('text_this_week_menu');
		// Wishlist
		$data['wishlist'] = $this->url->link('account/wishlist', '', true);
		$data['logged'] = $this->customer->isLogged();
		$data['account'] = $this->url->link('account/account', '', true);
		$data['register'] = $this->url->link('account/register', '', true);
		$data['login'] = $this->url->link('account/login', '', true);
		$data['order'] = $this->url->link('account/order', '', true);
		$data['transaction'] = $this->url->link('account/transaction', '', true);
		$data['download'] = $this->url->link('account/download', '', true);
		$data['logout'] = $this->url->link('account/logout', '', true);
		$data['shopping_cart'] = $this->url->link('checkout/cart');
		$data['checkout'] = $this->url->link('checkout/checkout', '', true);
		$data['contact'] = $this->url->link('information/contact');
		$data['telephone'] = $this->config->get('config_telephone');

		// Menu
		$this->load->model('catalog/category');

		$this->load->model('catalog/product');
//About Us link
		$data['mission']=$this->url->link('information/information', 'information_id=11');
		$data['founder']=$this->url->link('information/information', 'information_id=10');	
		$data['supplyer']=$this->url->link('information/information', 'information_id=12');
		$data['cooking']=$this->url->link('information/information', 'information_id=13');
		$data['packing']=$this->url->link('information/information', 'information_id=14');
		$data['partner']=$this->url->link('information/information', 'information_id=15');
		$data['feedback']=$this->url->link('information/information', 'information_id=16');
		$data['gallary']=$this->url->link('information/information', 'information_id=17');
// Food and health link

		$data['benefites_of_vegetables']=$this->url->link('information/information', 'information_id=18');
		$data['food_for_heart_disease_people']=$this->url->link('information/information', 'information_id=19');	
		$data['foods_for_diabetes_people']=$this->url->link('information/information', 'information_id=20');
		$data['text_food_for_high_blood_pressure_people']=$this->url->link('information/information', 'information_id=21');
		$data['food_for_pregnant_women']=$this->url->link('information/information', 'information_id=22');
		$data['food_for_women_childbirth']=$this->url->link('information/information', 'information_id=31');
		$data['meals_for_kids']=$this->url->link('information/information', 'information_id=32');
		
// Service link

		$data['daily_food']=$this->url->link('information/information', 'information_id=23');	
		$data['food_party']=$this->url->link('information/information', 'information_id=24');
		$data['food_snack']=$this->url->link('information/information', 'information_id=25');
		$data['organic_cafeterias']=$this->url->link('information/information', 'information_id=26');
		$data['organic_fruit']=$this->url->link('information/information', 'information_id=27');
		$data['organic_vegetables']=$this->url->link('information/information', 'information_id=28');
		$data['food_magazine']=$this->url->link('information/information', 'information_id=29');
		$data['course_cooking_for_tour']=$this->url->link('information/information', 'information_id=30');
// Product Order Category
		$data['product_order_category']=$this->url->link('common/product_order_category');		

		$data['categories'] = array();

		/*$categories = $this->model_catalog_category->getCategories(0);

		foreach ($categories as $category) {
			if ($category['top']) {
				// Level 2
				$children_data = array();

				$children = $this->model_catalog_category->getCategories($category['category_id']);

				foreach ($children as $child) {
					$filter_data = array(
						'filter_category_id'  => $child['category_id'],
						'filter_sub_category' => true
					);

					$children_data[] = array(
						'name'  => $child['name'] . ($this->config->get('config_product_count') ? ' (' . $this->model_catalog_product->getTotalProducts($filter_data) . ')' : ''),
						'href'  => $this->url->link('product/category', 'path=' . $category['category_id'] . '_' . $child['category_id'])
					);
				}

				
                // Level 3 sultan
                $children_data_3 = array();

                $children_3 = $this->model_catalog_category->getCategories($child['category_id']);

                foreach ($children_3 as $child_3) {

                    $filter_data_3 = array(
                        'filter_category_id'  => $child_3['category_id'],
                        'filter_sub_category' => true
                    );

                    $children_data_3[] = array(
                        'name'  => $child_3['name'] . ($this->config->get('config_product_count') ? ' (' . $this->model_catalog_product->getTotalProducts($filter_data_3) . ')' : ''),
                        'href'  => $this->url->link('product/category', 'path=' . $child['category_id'] . '_' . $child_3['category_id'])
                    );
                }
                //end of level 3	




				// Level 1
				$data['categories'][] = array(
					'name'     => $category['name'],
					'children' => $children_data,
					'children_3' =>$children_data_3,					
					'column'   => $category['column'] ? $category['column'] : 1,
					'href'     => $this->url->link('product/category', 'path=' . $category['category_id'])
				);
			}
		}*/




/*
		$categories = $this->model_catalog_category->getCategories(0);

    foreach ($categories as $category) {
        if ($category['top']) {
            // Level 2
            $children_data = array();

            $children = $this->model_catalog_category->getCategories($category['category_id']);

            foreach ($children as $child) {
                // Level 3
                $grandchildren_data = array();

                $grandchildren = $this->model_catalog_category->getCategories($child['category_id']);

                foreach ($grandchildren as $grandchild) {

                    $grandchild_filter_data = array(
                        'filter_category_id'  => $grandchild['category_id'],
                        'filter_sub_category' => true
                    );

                    $grandchildren_data[] = array(
                        'name'  => $grandchild['name'] . ($this->config->get('config_product_count') ? ' (' . $this->model_catalog_product->getTotalProducts($grandchild_filter_data) . ')' : ''),
                        'href'  => $this->url->link('product/category', 'path=' . $category['category_id'] . '_' . $grandchild['category_id'])
                    );
                }

                $filter_data = array(
                    'filter_category_id'  => $child['category_id'],
                    'filter_sub_category' => true
                );

                $children_data[] = array(
                    'name'  => $child['name'] . ($this->config->get('config_product_count') ? ' (' . $this->model_catalog_product->getTotalProducts($filter_data) . ')' : ''),
                    'href'  => $this->url->link('product/category', 'path=' . $category['category_id'] . '_' . $child['category_id']),
                    'children' => $grandchildren_data,
                );
            }

            // Level 1
            $data['categories'][] = array(
                'name'     => $category['name'],
                'children' => $children_data,
                'column'   => $category['column'] ? $category['column'] : 1,
                'href'     => $this->url->link('product/category', 'path=' . $category['category_id'])
            );
        }
    }
*/	


$data['categories'] = array();

    $categories = $this->model_catalog_category->getCategories(0);

    foreach ($categories as $category) {

        if ($category['top']) {
            // Level 2
            $children_data = array();

            $children = $this->model_catalog_category->getCategories($category['category_id']);

            foreach ($children as $child) {

                // Level 3 sultan
                $children_data_3 = array();

                $children_3 = $this->model_catalog_category->getCategories($child['category_id']);

                foreach ($children_3 as $child_3) {

                    $filter_data_3 = array(
                        'filter_category_id'  => $child_3['category_id'],
                        'filter_sub_category' => true
                    );

                    $children_data_3[] = array(
                        'name'  => $child_3['name'] . ($this->config->get('config_product_count') ? ' (' . $this->model_catalog_product->getTotalProducts($filter_data_3) . ')' : ''),
                        'href'  => $this->url->link('product/category', 'path=' . $child['category_id'] . '_' . $child_3['category_id'])
                    );
                }
                //end of level 3


                $filter_data = array(
                    'filter_category_id'  => $child['category_id'],
                    'filter_sub_category' => true
                );

                $children_data[] = array(
                    'name'  => $child['name'] . ($this->config->get('config_product_count') ? ' (' . $this->model_catalog_product->getTotalProducts($filter_data) . ')' : ''),
                    'href'  => $this->url->link('product/category', 'path=' . $category['category_id'] . '_' . $child['category_id']),
                    'grand_childs' => $children_data_3

                );
            }

            // Level 1
            $data['categories'][] = array(
                'name'     => $category['name'],
                'children' => $children_data,
                'column'   => $category['column'] ? $category['column'] : 1,
                'href'     => $this->url->link('product/category', 'path=' . $category['category_id'])
            );
        }

    }


	$data['language'] = $this->load->controller('common/language');
		$data['currency'] = $this->load->controller('common/currency');
		$data['search'] = $this->load->controller('common/search');
		$data['cart'] = $this->load->controller('common/cart');

		// For page specific css
		if (isset($this->request->get['route'])) {
			if (isset($this->request->get['product_id'])) {
				$class = '-' . $this->request->get['product_id'];
			} elseif (isset($this->request->get['path'])) {
				$class = '-' . $this->request->get['path'];
			} elseif (isset($this->request->get['manufacturer_id'])) {
				$class = '-' . $this->request->get['manufacturer_id'];
			} elseif (isset($this->request->get['information_id'])) {
				$class = '-' . $this->request->get['information_id'];
			} else {
				$class = '';
			}

			$data['class'] = str_replace('/', '-', $this->request->get['route']) . $class;
		} else {
			$data['class'] = 'common-home';
		}

		return $this->load->view('common/header', $data);
	}
}
