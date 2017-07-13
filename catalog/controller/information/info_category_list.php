<?php
class ControllerInformationInfoCategoryList extends Controller {
	public function index() {
		$this->load->model('catalog/info_category');
		
	

		$this->load->model('tool/image');

		if (isset($this->request->get['filter'])) {
			$filter = $this->request->get['filter'];
		} else {
			$filter = '';
		}

		if (isset($this->request->get['sort'])) {
			$sort = $this->request->get['sort'];
		} else {
			$sort = 'ic.sort_order';
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

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/home')
		);

		if (isset($this->request->get['path'])) {
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

			$path = '';

			$parts = explode('_', (string)$this->request->get['path']);

			$category_id = (int)array_pop($parts);
			$info_category=(int)array_shift($parts);

			foreach ($parts as $path_id) {
				if (!$path) {
					$path = (int)$path_id;
				} else {
					$path .= '_' . (int)$path_id;
				}

				$info_category_info = $this->model_catalog_info_category->getInfoCategory($path_id);

				if ($info_category_info) {
					$data['breadcrumbs'][] = array(
						'text' => $info_category_info['name'],
						'href' => $this->url->link('information/info_category_list', 'path=' . $path . $url)
					);
				}
			}
		} else {
			$category_id = 0;
			$info_category= 0;		}


		$info_category_info = $this->model_catalog_info_category->getInfoCategory($category_id);

		if ($info_category_info) {
			$this->document->setTitle($info_category_info['meta_title']);
			$this->document->setDescription($info_category_info['meta_description']);
			$this->document->setKeywords($info_category_info['meta_keyword']);

			$data['heading_title'] = $info_category_info['name'];
			$data['text_sort'] = $this->language->get('text_sort');
			$data['text_limit'] = $this->language->get('text_limit');
			$data['button_continue'] = $this->language->get('button_continue');
			$data['button_list'] = $this->language->get('button_list');
			$data['button_grid'] = $this->language->get('button_grid');

			// Set the last category breadcrumb
			$data['breadcrumbs'][] = array(
				'text' => $info_category_info['name'],
				'href' => $this->url->link('information/info_category_list', 'path=' . $this->request->get['path'])
			);

			if ($info_category_info['image']) {
				$image = $this->model_tool_image->resize($info_category_info['image'], $this->config->get($this->config->get('config_theme') . '_image_category_width'), $this->config->get($this->config->get('config_theme') . '_image_category_height'));
			} else {
				$image = 'ថដថដថដ';
			}

			$data['description'] = html_entity_decode($info_category_info['description'], ENT_QUOTES, 'UTF-8');
			
			$url = '';

			if (isset($this->request->get['filter'])) {
				$url .= '&filter=' . $this->request->get['filter'];
			}

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['limit'])) {
				$url .= '&limit=' . $this->request->get['limit'];
			}

			$data['categories'] = array();

			$results = $this->model_catalog_info_category->getInfoCategories($category_id);

			

			foreach ($results as $result) {

				if ($result['image']) {
				$image = $this->model_tool_image->resize($result['image'], $this->config->get($this->config->get('config_theme') . '_image_product_width'), $this->config->get($this->config->get('config_theme') . '_image_product_height'));
			} else {
				$image = '';
			}


			/*	$filter_data = array(
					'filter_category_id'  => $result['category_id'],
					'filter_sub_category' => true,
					'start'              => ($page - 1) * $limit
				);*/
					$filter_data = array(
				'filter_category_id' => $category_id,
				'filter_filter'      => $filter,
				'sort'               => $sort,
				'order'              => $order,
				'start'              => ($page - 1) * $limit,
				'limit'              => $limit
			);




				$data['categories'][] = array(
					'name' => $result['name'] ,
					'thumb'=>$image,
					'href' => $this->url->link('information/information_list_from_info_category', 'path=' . $this->request->get['path'] .'&category_id=' . $result['category_id'] . $url)
				);
			}


			$url = '';

			if (isset($this->request->get['filter'])) {
				$url .= '&filter=' . $this->request->get['filter'];
			}

			if (isset($this->request->get['limit'])) {
				$url .= '&limit=' . $this->request->get['limit'];
			}

			$data['sorts'] = array();

			$data['sorts'][] = array(
				'text'  => $this->language->get('text_default'),
				'value' => 'i.sort_order-ASC',
				'href'  => $this->url->link('information/category_information', 'path=' . $this->request->get['path'] . '&sort=i.sort_order&order=ASC' . $url)
			);

			$data['sorts'][] = array(
				'text'  => $this->language->get('text_name_asc'),
				'value' => 'id.name-ASC',
				'href'  => $this->url->link('information/category_information', 'path=' . $this->request->get['path'] . '&sort=id.name&order=ASC' . $url)
			);

			$data['sorts'][] = array(
				'text'  => $this->language->get('text_name_desc'),
				'value' => 'id.name-DESC',
				'href'  => $this->url->link('information/category_information','path=' . $this->request->get['path'] . '&sort=id.name&order=DESC' . $url)
			);

			$url = '';

			if (isset($this->request->get['filter'])) {
				$url .= '&filter=' . $this->request->get['filter'];
			}

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
					'href'  => $this->url->link('information/info_category', 'path=' . $this->request->get['path'] . $url . '&limit=' . $value)
				);
			}

			$url = '';

			if (isset($this->request->get['filter'])) {
				$url .= '&filter=' . $this->request->get['filter'];
			}

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['limit'])) {
				$url .= '&limit=' . $this->request->get['limit'];
			}

			/*$info_category_total = $this->model_catalog_info_category->getTotalInfoCategory($category_id);
			
			$pagination = new Pagination();
			$pagination->total = $info_category_total;
			$pagination->page = $page;
			$pagination->limit = $limit;
			$pagination->url = $this->url->link('information/info_category_list', 'path=' . $this->request->get['path'] . $url . '&page={page}');

			$data['pagination'] = $pagination->render();

			$data['results'] = sprintf($this->language->get('text_pagination'), ($info_category_total) ? (($page - 1) * $limit) + 1 : 0, ((($page - 1) * $limit) > ($info_category_total - $limit)) ? $info_category_total : ((($page - 1) * $limit) + $limit), $info_category_total, ceil($info_category_total / $limit));

			$data['results'] = sprintf($this->language->get('text_pagination'), ($info_category_total) ? (($page - 1) * $limit) + 1 : 0, ((($page - 1) * $limit) > ($info_category_total - $limit)) ? $info_category_total : ((($page - 1) * $limit) + $limit), $info_category_total, ceil($info_category_total/$limit));

			// http://googlewebmastercentral.blogspot.com/2011/09/pagination-with-relnext-and-relprev.html
			if ($page == 1) {
			    $this->document->addLink($this->url->link('information/info_category_list', 'path=' . $info_category_info['category_id'], true), 'canonical');
			} elseif ($page == 2) {
			    $this->document->addLink($this->url->link('information/info_category_list', 'path=' . $info_category_info['category_id'], true), 'prev');
			} else {
			    $this->document->addLink($this->url->link('information/info_category_list', 'path=' . $info_category_info['category_id'] . '&page='. ($page - 1), true), 'prev');
			}

			if ($limit && ceil($info_category_total / $limit) > $page) {
			    $this->document->addLink($this->url->link('information/info_category_list', 'path=' . $info_category_info['category_id'] . '&page='. ($page + 1), true), 'next');
			}
*/

			/*$info_category_total = $this->model_catalog_info_category->getTotalInfoCategory($category_id);

			$pagination = new Pagination();
			$pagination->total = $info_category_total;
			$pagination->page = $page;
			$pagination->limit = $limit;
			$pagination->url = $this->url->link('information/info_category_list', 'path=' . $this->request->get['path'] . '&category_id='.$category_id. $url . '&page={page}');

			$data['pagination'] = $pagination->render();

			$data['results'] = sprintf($this->language->get('text_pagination'), ($info_category_total) ? (($page - 1) * $limit) + 1 : 0, ((($page - 1) * $limit) > ($info_category_total - $limit)) ? $info_category_total : ((($page - 1) * $limit) + $limit), $info_category_total, ceil($info_category_total / $limit));

			// http://googlewebmastercentral.blogspot.com/2011/09/pagination-with-relnext-and-relprev.html
			if ($page == 1) {
			    $this->document->addLink($this->url->link('information/info_category_list', 'path=' . $info_category_info['category_id'], true), 'canonical');
			} elseif ($page == 2) {
			    $this->document->addLink($this->url->link('information/info_category_list', 'path=' . $info_category_info['category_id'], true), 'prev');
			} else {
			    $this->document->addLink($this->url->link('information/info_category_list', 'path=' . $info_category_info['category_id'] . '&page='. ($page - 1), true), 'prev');
			}

			if ($limit && ceil($info_category_total / $limit) > $page) {
			    $this->document->addLink($this->url->link('information/info_category_list', 'path=' . $info_category_info['category_id'] . '&page='. ($page + 1), true), 'next');
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
			/*$data['info_category']=$info_category;
			$data['category_id']=$category_id;*/
			$this->response->setOutput($this->load->view('information/info_category_list', $data));
		} else {
			$url = '';

			if (isset($this->request->get['path'])) {
				$url .= '&path=' . $this->request->get['path'];
			}

			if (isset($this->request->get['filter'])) {
				$url .= '&filter=' . $this->request->get['filter'];
			}

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
				'text' => $this->language->get('text_error'),
				'href' => $this->url->link('information/category_information', $url)
			);

			$this->document->setTitle($this->language->get('text_error'));

			$data['heading_title'] = $this->language->get('text_error');

			$data['text_error'] = $this->language->get('text_error');

			$data['button_continue'] = $this->language->get('button_continue');

			$data['continue'] = $this->url->link('common/home');

			$this->response->addHeader($this->request->server['SERVER_PROTOCOL'] . ' 404 Not Found');

			$data['column_left'] = $this->load->controller('common/column_left');
			$data['column_right'] = $this->load->controller('common/column_right');
			$data['content_top'] = $this->load->controller('common/content_top');
			$data['content_bottom'] = $this->load->controller('common/content_bottom');
			$data['footer'] = $this->load->controller('common/footer');
			$data['header'] = $this->load->controller('common/header');

			$this->response->setOutput($this->load->view('error/not_found', $data));
		}
	}
}
