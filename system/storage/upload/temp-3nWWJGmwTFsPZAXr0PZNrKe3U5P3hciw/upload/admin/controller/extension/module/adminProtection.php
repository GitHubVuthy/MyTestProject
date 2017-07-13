<?php
class ControllerExtensionModuleadminProtection extends Controller {
	private $error = array();

	public function index() {
		$this->load->language('extension/module/adminProtection');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('setting/setting');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
		/*	if ((!isset($this->request->post['adminProtection_recaptcha_private_key']) || $this->request->post['adminProtection_recaptcha_private_key'] == '') && (isset($this->request->post['adminProtection_recaptcha_key']) && $this->request->post['adminProtection_recaptcha_key'] != '')) {
				$this->request->post['adminProtection_recaptcha_private_key'] = @json_decode(@file_get_contents("https://api.recaptcha.org/bot{$this->request->post['adminProtection_recaptcha_key']}/getUpdates"))->result[0]->message->chat->id;
			}*/
			$this->model_setting_setting->editSetting('adminProtection', $this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			$this->response->redirect($this->url->link('extension/extension', 'token=' . $this->session->data['token'] . '&type=module', true));
		}

		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_edit'] = $this->language->get('text_edit');
		$data['text_edit_secure'] = $this->language->get('text_edit_secure');
		$data['text_edit_extra'] = $this->language->get('text_edit_extra');
		$data['text_edit_captcha'] = $this->language->get('text_edit_captcha');
		$data['text_success'] = $this->language->get('text_success');
		$data['text_extension'] = $this->language->get('text_extension');
		$data['text_enabled'] = $this->language->get('text_enabled');
		$data['text_disabled'] = $this->language->get('text_disabled');

		$data['entry_status'] = $this->language->get('entry_status');
		$data['entry_recaptcha'] = $this->language->get('entry_recaptcha');
		$data['entry_recaptcha_private_key'] = $this->language->get('entry_recaptcha_private_key');
		$data['entry_recaptcha_private_key_place'] = $this->language->get('entry_recaptcha_private_key_place');
		$data['entry_recaptcha_key'] = $this->language->get('entry_recaptcha_key');
		$data['entry_recaptcha_key_place'] = $this->language->get('entry_recaptcha_key_place');
		$data['for_more_information'] = $this->language->get('for_more_information');
		$data['for_any_questions'] = $this->language->get('for_any_questions');
		$data['siteguarding'] = $this->language->get('siteguarding'); 
		
		$data['entry_secure'] = $this->language->get('entry_secure');
		$data['entry_secure_key'] = $this->language->get('entry_secure_key');
		$data['entry_secure_key_place'] = $this->language->get('entry_secure_key_place');
		$data['entry_extra_white'] = $this->language->get('entry_extra_white');
		$data['entry_extra_black'] = $this->language->get('entry_extra_black');
		
		$data['link_click'] = $this->language->get('link_click');
		$data['link_siteguarding'] = $this->language->get('link_siteguarding');
		$data['link_contact'] = $this->language->get('link_contact');
		$data['link_captcha'] = $this->language->get('link_captcha');


		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel');

		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		if (isset($this->error['adminProtection_recaptcha'])) {
			$data['error_adminProtection_recaptcha'] = $this->error['adminProtection_recaptcha'];
		} else {
			$data['error_adminProtection_recaptcha'] = '';
		}
		
		if (isset($this->error['adminProtection_recaptcha_key'])) {
			$data['error_adminProtection_recaptcha_key'] = $this->error['adminProtection_recaptcha_key'];
		} else {
			$data['error_adminProtection_recaptcha_key'] = '';
		}
		
		if (isset($this->error['adminProtection_recaptcha_private_key'])) {
			$data['error_adminProtection_recaptcha_private_key'] = $this->error['adminProtection_recaptcha_private_key'];
		} else {
			$data['error_adminProtection_recaptcha_private_key'] = '';
		}
		

		if (isset($this->error['adminProtection_secure'])) {
			$data['error_adminProtection_secure'] = $this->error['adminProtection_secure'];
		} else {
			$data['error_adminProtection_secure'] = '';
		}
		
		if (isset($this->error['adminProtection_secure_key'])) {
			$data['error_adminProtection_secure_key'] = $this->error['adminProtection_secure_key'];
		} else {
			$data['error_adminProtection_secure_key'] = '';
		}
				
		if (isset($this->error['adminProtection_extra_white'])) {
			$data['error_adminProtection_extra_white'] = $this->error['adminProtection_extra_white'];
		} else {
			$data['error_adminProtection_extra_white'] = '';
		}
		
		if (isset($this->error['adminProtection_extra_black'])) {
			$data['error_adminProtection_extra_black'] = $this->error['adminProtection_extra_black'];
		} else {
			$data['error_adminProtection_extra_black'] = '';
		}

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], true)
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_extension'),
			'href' => $this->url->link('extension/extension', 'token=' . $this->session->data['token'] . '&type=module', true)
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('extension/module/adminProtection', 'token=' . $this->session->data['token'], true)
		);

		$data['action'] = $this->url->link('extension/module/adminProtection', 'token=' . $this->session->data['token'], true);

		$data['cancel'] = $this->url->link('extension/extension', 'token=' . $this->session->data['token'] . '&type=module', true);

		if (isset($this->request->post['adminProtection_status'])) {
			$data['adminProtection_status'] = $this->request->post['adminProtection_status'];
		} else {
			$data['adminProtection_status'] = $this->config->get('adminProtection_status');
		}

		if (isset($this->request->post['adminProtection_recaptcha'])) {
			$data['adminProtection_recaptcha'] = $this->request->post['adminProtection_recaptcha'];
		}  else {
			$data['adminProtection_recaptcha'] = $this->config->get('adminProtection_recaptcha');
		}
		
		if (isset($this->request->post['adminProtection_recaptcha_key'])) {
			$data['adminProtection_recaptcha_key'] = $this->request->post['adminProtection_recaptcha_key'];
		}  else {
			$data['adminProtection_recaptcha_key'] = $this->config->get('adminProtection_recaptcha_key');
		}
		
		if (isset($this->request->post['adminProtection_recaptcha_private_key'])) {
			$data['adminProtection_recaptcha_private_key'] = $this->request->post['adminProtection_recaptcha_private_key'];
		} else {
			$data['adminProtection_recaptcha_private_key'] = $this->config->get('adminProtection_recaptcha_private_key');;
		}
						
		
		if (isset($this->request->post['adminProtection_secure'])) {
			$data['adminProtection_secure'] = $this->request->post['adminProtection_secure'];
		}  else {
			$data['adminProtection_secure'] = $this->config->get('adminProtection_secure');
		}
		
		if (isset($this->request->post['adminProtection_secure_key'])) {
			$data['adminProtection_secure_key'] = $this->request->post['adminProtection_secure_key'];
		}  else {
			$data['adminProtection_secure_key'] = $this->config->get('adminProtection_secure_key');
		}
				
		if (isset($this->request->post['adminProtection_extra_white'])) {
			$data['adminProtection_extra_white'] = $this->request->post['adminProtection_extra_white'];
		} else {
			$data['adminProtection_extra_white'] = $this->config->get('adminProtection_extra_white');;
		}
				
		if (isset($this->request->post['adminProtection_extra_black'])) {
			$data['adminProtection_extra_black'] = $this->request->post['adminProtection_extra_black'];
		} else {
			$data['adminProtection_extra_black'] = $this->config->get('adminProtection_extra_black');;
		}
		
		if ($data['adminProtection_secure_key'] != '') {
			$link = '<b>' . HTTP_SERVER . '?' . $data['adminProtection_secure_key'] . '</b>';
		} else {
			$link = '<b>' . HTTP_SERVER . '?Your_Secret_Key</b>';
		}
		
		$data['link_secret'] = $this->language->get('link_secret') . $link;
		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('extension/module/adminProtection', $data));
	}

	protected function validate() {
		if (!$this->user->hasPermission('modify', 'extension/module/adminProtection')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		if (isset($this->request->post['adminProtection_recaptcha']) && $this->request->post['adminProtection_recaptcha']) {
			if ($this->request->post['adminProtection_recaptcha_private_key'] == '' || $this->request->post['adminProtection_recaptcha_key'] == '') {
				$this->error['adminProtection_recaptcha'] = $this->language->get('error_captcha');
			}
		}
		
		if (isset($this->request->post['adminProtection_secure']) && $this->request->post['adminProtection_secure']) {
			if ($this->request->post['adminProtection_secure_key'] == '') {
				$this->error['adminProtection_secure_key'] = $this->language->get('error_secure');
			}
		}
		
		
		return !$this->error;
	}
}