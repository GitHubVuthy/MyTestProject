<?php
class ControllerInformationPayment extends Controller {
	private $error = array();

	public function index() {
		$this->load->language('information/payment');

		$this->document->setTitle($this->language->get('heading_title'));


		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/home')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('information/payment')
		);

		$data['heading_title'] = $this->language->get('heading_title');

		


		$this->response->setOutput($this->load->view('common/success', $data));
	}
}
