
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kot extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Kot_model');
    }

    public function index($table_id) {
        $data['kot_items'] = $this->Kot_model->get_kot_items($table_id);
        $this->load->view('kot/index', $data);
    }

    public function add_item() {
        $data = $this->input->post();
        $this->Kot_model->add_item($data);
        redirect('kot/index/' . $data['table_id']);
    }
}
