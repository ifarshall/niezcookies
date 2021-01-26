<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Calender extends CI_Controller {

	function __construct()
    {
        parent::__construct();
        check_not_login();
        $this->load->model('model_calender');
    }

	public function index()
	{
        $this->template->load('template', 'calender');
    }

    function load()
    {
        $event_data = $this->model_calender->fetch_all_event();
        foreach($event_data->result_array() as $row)
        {
            $data[] = array(
                'id' => $row['id'],
                'title' => $row['title'],
                'start' => $row['start_event'],
                'end' => $row['end_event'],
            );
        }
        echo json_encode($data);
    }

    function insert()
    {
        if($this->input->post('title'))
        {
            $data = array(
                'title' => $this->input->post('title'),
                'start_event' => $this->input->post('start'),
                'end_event' => $this->input->post('end'),
            );
            $this->model_calender->insert_event($data);
        }
    }

    function update()
    {
        if($this->input->post('id'))
        {
            $data = array(
                'title' => $this->input->post('title'),
                'start_event' => $this->input->post('start'),
                'end_event' => $this->input->post('end'),
            );

            $this->model_calender->update_event($data,
                $this->input->post('id'));
        }
    }

    function del()
    {
        if($this->input->post('id'))
        {
            $this->model_calender->delete_event($this->input->post('id'));
        }
    }
}