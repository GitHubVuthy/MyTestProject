<?php
class ControllerInformationVideo extends Controller {
	public function index() {
		$this->load->language('information/information');
		$this->load->model('catalog/video');
		$this->load->model('tool/image');
		$data['text_empty'] = $this->language->get('text_empty');

		if (isset($this->request->get['information_id'])) {
			$information_id = $this->request->get['information_id'];
		} else {
			$information_id = '';
		}
		$data['informations']=array();
		$results = $this->model_catalog_video->getVideos();
		if ($results)
		{
			$message="Have Values";

				foreach ($results as $result) {
				
					$data['informations'][] = array(
					'information_id'  => $result['video_id'],
					'url'        => $result['url'],
					'name'        => $result['title'],
					'description' => html_entity_decode($result['description'], ENT_QUOTES, 'UTF-8'),
					
					'href'        => $this->url->link('information/video', 'video_id=' .$result['video_id']  )
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

			$this->response->setOutput($this->load->view('information/video', $data));
	}
}
