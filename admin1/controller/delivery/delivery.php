<?php
class ControllerDeliveryDelivery extends Controller {
	private $error = array();
	public function index() {
		$this->load->language('delivery/delivery');
		$this->document->setTitle($this->language->get('heading_title'));
		$this->load->model('delivery/delivery');
		$this->getList();
	}
		public function delete() {
		$this->load->language('delivery/delivery');
		$this->document->setTitle($this->language->get('heading_title'));
		$this->load->model('delivery/delivery');
			if (isset($this->request->get['delivery_id'])&& $this->validateDelete()){
			$this->model_delivery_delivery->DeleteDelivery($delivery_id);
			}
		 /*if (isset($this->request->post['selected']) && $this->validateDelete()) {
			foreach ($this->request->post['selected'] as $delivery_id) {
				$this->model_delivery_delivery->deleteDelivery($delivery_id);
			}
			*/
			$this->session->data['success'] = $this->language->get('text_success');
			$url = '';
			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}
			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}
			$this->response->redirect($this->url->link('delivery/delivery', 'token=' . $this->session->data['token'] . $url, true));
		$this->getList();
		}
		protected function validateDelete() {
		if (!$this->user->hasPermission('modify', 'delivery/delivery')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		$this->load->model('delivery/delivery');

		foreach ($this->request->post['selected'] as $delivery_id) {
			$delivery_total = $this->model_delivery_delivery->getTotalDeliveryByDeliveryId($delivery_id);

			if ($delivery_total) {
				$this->error['warning'] = sprintf($this->language->get('error_delivery'), $delivery_total);
			}
		}

		return !$this->error;
	}


	public function add() {
		$this->load->language('delivery/delivery');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('delivery/delivery');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$this->model_delivery_delivery->addDelivery($this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			$this->response->redirect($this->url->link('catalog/manufacturer', 'token=' . $this->session->data['token'] . $url, true));
		}

		$this->getForm();
	}
	protected function getForm() {
		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_form'] = !isset($this->request->get['delivery_id']) ? $this->language->get('text_add') : $this->language->get('text_edit');
		$data['text_enabled'] = $this->language->get('text_enabled');
		$data['text_disabled'] = $this->language->get('text_disabled');
		$data['text_default'] = $this->language->get('text_default');
		$data['text_percent'] = $this->language->get('text_percent');
		$data['text_amount'] = $this->language->get('text_amount');

		$data['entry_fname'] = $this->language->get('entry_fname');
		$data['entry_lname'] = $this->language->get('entry_lname');
		$data['entry_gender'] = $this->language->get('entry_gender');
		$data['entry_db'] = $this->language->get('entry_db');
		$data['entry_address'] = $this->language->get('entry_address');
		$data['entry_email'] = $this->language->get('entry_email');
		$data['entry_image'] = $this->language->get('entry_image');
		$data['entry_sort'] = $this->language->get('entry_sort');
		$data['entry_phone'] = $this->language->get('entry_phone');
		$data['entry_sort_order'] = $this->language->get('entry_sort_order');
		
		$data['entry_status'] = $this->language->get('entry_status');
		$data['help_keyword'] = $this->language->get('help_keyword');

		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel');

		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		if (isset($this->error['fname'])) {
			$data['error_fname'] = $this->error['fname'];
		} else {
			$data['error_fname'] = '';
		}
		$url = '';

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}

		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], true)
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('delivery/delivery', 'token=' . $this->session->data['token'] . $url, true)
		);

		if (!isset($this->request->get['delivery_id'])) {
			$data['action'] = $this->url->link('delivery/delivery/add', 'token=' . $this->session->data['token'] . $url, true);
		} else {
			$data['action'] = $this->url->link('delivery/delivery/edit', 'token=' . $this->session->data['token'] . '&delivery_id=' . $this->request->get['delivery_id'] . $url, true);
		}

		$data['cancel'] = $this->url->link('delivery/delivery', 'token=' . $this->session->data['token'] . $url, true);

		if (isset($this->request->get['delivery_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
			$delivery_info = $this->model_delivery_delivery->getDelivery($this->request->get['delivery_id']);
		}

		$data['token'] = $this->session->data['token'];

		if (isset($this->request->post['fname'])) {
			$data['fname'] = $this->request->post['fname'];
		} elseif (!empty($delivery_info)) {
			$data['fname'] = $delivery_info['fname'];
		} else {
			$data['fname'] = '';
		}
		
		if (isset($this->request->post['lname'])) {
			$data['lname'] = $this->request->post['lname'];
		} elseif (!empty($delivery_info)) {
			$data['lname'] = $delivery_info['lname'];
		} else {
			$data['lname'] = '';
		}
		
		if (isset($this->request->post['gender'])) {
			$data['gender'] = $this->request->post['gender'];
		} elseif (!empty($delivery_info)) {
			$data['gender'] = $delivery_info['gender'];
		} else {
			$data['gender'] = '';
		}
		
		if (isset($this->request->post['db'])) {
			$data['db'] = $this->request->post['db'];
		} elseif (!empty($delivery_info)) {
			$data['db'] = $delivery_info['db'];
		} else {
			$data['db'] = '';
		}
		
		if (isset($this->request->post['address'])) {
			$data['address'] = $this->request->post['address'];
		} elseif (!empty($delivery_info)) {
			$data['address'] = $delivery_info['address'];
		} else {
			$data['address'] = '';
		}
		
		if (isset($this->request->post['email'])) {
			$data['email'] = $this->request->post['email'];
		} elseif (!empty($delivery_info)) {
			$data['email'] = $delivery_info['email'];
		} else {
			$data['email'] = '';
		}
		
		if (isset($this->request->post['phone'])) {
			$data['phone'] = $this->request->post['phone'];
		} elseif (!empty($delivery_info)) {
			$data['phone'] = $delivery_info['phone'];
		} else {
			$data['phone'] = '';
		}
		
		if (isset($this->request->post['delivery_image'])) {
			$data['delivery_image'] = $this->request->post['delivery_image'];
		} elseif (!empty($delivery_info)) {
			$data['delivery_image'] = $delivery_info['delivery_image'];
		} else {
			$data['delivery_image'] = '';
		}
		if (isset($this->request->post['store_order'])) {
			$data['store_order'] = $this->request->post['store_order'];
		} elseif (!empty($delivery_info)) {
			$data['store_order'] = $delivery_info['store_order'];
		} else {
			$data['store_order'] = '';
		}
		if (isset($this->request->post['status'])) {
			$data['status'] = $this->request->post['status'];
		} elseif (!empty($delivery_info)) {
			$data['status'] = $delivery_info['status'];
		} else {
			$data['status'] = '';
		}
		
		/*
		if (isset($this->request->post['manufacturer_store'])) {
			$data['manufacturer_store'] = $this->request->post['manufacturer_store'];
		} elseif (isset($this->request->get['manufacturer_id'])) {
			$data['manufacturer_store'] = $this->model_catalog_manufacturer->getManufacturerStores($this->request->get['manufacturer_id']);
		} else {
			$data['manufacturer_store'] = array(0);
		}

		if (isset($this->request->post['keyword'])) {
			$data['keyword'] = $this->request->post['keyword'];
		} elseif (!empty($manufacturer_info)) {
			$data['keyword'] = $manufacturer_info['keyword'];
		} else {
			$data['keyword'] = '';
		}
*/

		$this->load->model('tool/image');

		if (isset($this->request->post['delivery_image']) && is_file(DIR_IMAGE . $this->request->post['delivery_image'])) {
			$data['thumb'] = $this->model_tool_image->resize($this->request->post['delivery_image'], 100, 100);
		} elseif (!empty($manufacturer_info) && is_file(DIR_IMAGE . $manufacturer_info['delivery_image'])) {
			$data['thumb'] = $this->model_tool_image->resize($manufacturer_info['delivery_image'], 100, 100);
		} else {
			$data['thumb'] = $this->model_tool_image->resize('no_image.png', 100, 100);
		}

		$data['placeholder'] = $this->model_tool_image->resize('no_image.png', 100, 100);
		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('delivery/delivery_form', $data));
	}


	
	
	protected function getList() {
		//for sort order of Delivery 
		if (isset($this->request->get['sort'])) {
			$sort = $this->request->get['sort'];
		} else {
			$sort = 'fname';
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

		$url = '';

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}

		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], true)
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('delivery/delivery', 'token=' . $this->session->data['token'] . $url, true)
		);

		$data['add'] = $this->url->link('delivery/delivery/add', 'token=' . $this->session->data['token'] . $url, true);
		$data['delete'] = $this->url->link('delivery/delivery/delete', 'token=' . $this->session->data['token'] . $url, true);

		$data['deliverys'] = array();
/*here*/
		$filter_data = array(
			'sort'  => $sort,
			'order' => $order,
			'start' => ($page - 1) * $this->config->get('config_limit_admin'),
			'limit' => $this->config->get('config_limit_admin')
		);

		/*for Pagination*/ $delivery_total = $this->model_delivery_delivery->getTotalDeliverys();

		$results = $this->model_delivery_delivery->getDeliverys($filter_data);

		foreach ($results as $result) {
			$data['deliverys'][] = array(
				'delivery_id' => $result['delivery_id'],
				'fname'            => $result['fname'],
				'sort_order'      => $result['sort_order'],
				'edit'            => $this->url->link('delivery/delivery/edit', 'token=' . $this->session->data['token'] . '&delivery_id=' . $result['delivery_id'] . $url, true),
				'delete'            => $this->url->link('delivery/delivery/delete', 'token=' . $this->session->data['token'] . '&delivery_id=' . $result['delivery_id'] . $url, true)
			);
		}

		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_list'] = $this->language->get('text_list');
		$data['text_no_results'] = $this->language->get('text_no_results');
		$data['text_confirm'] = $this->language->get('text_confirm');

		$data['column_fname'] = $this->language->get('column_fname');
		$data['column_sort_order'] = $this->language->get('column_sort_order');
		$data['column_action'] = $this->language->get('column_action');

		$data['button_add'] = $this->language->get('button_add');
		$data['button_edit'] = $this->language->get('button_edit');
		$data['button_delete'] = $this->language->get('button_delete');

		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		if (isset($this->session->data['success'])) {
			$data['success'] = $this->session->data['success'];

			unset($this->session->data['success']);
		} else {
			$data['success'] = '';
		}

		if (isset($this->request->post['selected'])) {
			$data['selected'] = (array)$this->request->post['selected'];
		} else {
			$data['selected'] = array();
		}

		$url = '';

		if ($order == 'ASC') {
			$url .= '&order=DESC';
		} else {
			$url .= '&order=ASC';
		}

		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}

		$data['sort_fname'] = $this->url->link('delivery/delivery', 'token=' . $this->session->data['token'] . '&sort=fname' . $url, true);
		$data['sort_sort_order'] = $this->url->link('delivery/delivery', 'token=' . $this->session->data['token'] . '&sort=sort_order' . $url, true);

		$url = '';

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}

		$pagination = new Pagination();
		$pagination->total = $delivery_total;
		$pagination->page = $page;
		$pagination->limit = $this->config->get('config_limit_admin');
		$pagination->url = $this->url->link('delivery/delivery', 'token=' . $this->session->data['token'] . $url . '&page={page}', true);

		$data['pagination'] = $pagination->render();

		$data['results'] = sprintf($this->language->get('text_pagination'), ($delivery_total) ? (($page - 1) * $this->config->get('config_limit_admin')) + 1 : 0, ((($page - 1) * $this->config->get('config_limit_admin')) > ($delivery_total - $this->config->get('config_limit_admin'))) ? $delivery_total : ((($page - 1) * $this->config->get('config_limit_admin')) + $this->config->get('config_limit_admin')), $delivery_total, ceil($delivery_total / $this->config->get('config_limit_admin')));

		$data['sort'] = $sort;
		$data['order'] = $order;

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('delivery/delivery_list', $data));
	}

	protected function validateForm() {
		if (!$this->user->hasPermission('modify', 'delivery/delivery')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		if ((utf8_strlen($this->request->post['name']) < 2) || (utf8_strlen($this->request->post['fname']) > 64)) {
			$this->error['fname'] = $this->language->get('error_fname');
		}

		

		return !$this->error;
	}

	
	public function autocomplete() {
		$json = array();

		if (isset($this->request->get['filter_name'])) {
			$this->load->model('delivery/delivery');

			$filter_data = array(
				'filter_name' => $this->request->get['filter_name'],
				'start'       => 0,
				'limit'       => 5
			);

			$results = $this->model_delivery_delivery1->getDeliverys($filter_data);

			foreach ($results as $result) {
				$json[] = array(
					'delivery_id' => $result['delivery_id'],
					'fname'            => strip_tags(html_entity_decode($result['fname'], ENT_QUOTES, 'UTF-8')),
					'lname'            => strip_tags(html_entity_decode($result['lname'], ENT_QUOTES, 'UTF-8'))
				);
			}
		}

		$sort_order = array();

		foreach ($json as $key => $value) {
			$sort_order[$key] = $value['name'];
		}

		array_multisort($sort_order, SORT_ASC, $json);

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}
}