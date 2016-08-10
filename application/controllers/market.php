<?php

class Market extends AdminController
{
	function add()
	{
		if($this->is_ajax())
		{
			$response=$this->market->save((object)$this->input->post());
			$this->output->set_status_header(200)->set_content_type('application/json', 'utf-8')->set_output(json_encode($response))->_display();
        exit;
		}
	}
}