<?php
class Login extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        //menjalankan fungsi construct

        $this->load->model('M_login');
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
    }
    public function index()
    {
        $this->load->view('login');
    }

    public function aksi_login()
    {
        $username = $this->input->post('username', true);
        $password = $this->input->post('password', true);
        $where = array(
            'nama_user' => $username,

        );

        $cek = $this->M_login->cek_login("tbl_user", $where)->num_rows();
        if ($cek > 0 && $password == 'eureka123') {
            $data_session = array(
                'nama' => $username,
                'status' => 'login'

            );
            $this->session->set_userdata($data_session);
            redirect('CrudProduk/');
        } else {
            $this->session->set_flashdata('flash', 'salah');

            redirect('Login/');
        }
    }


    function logout()
    {
        $this->session->sess_destroy();
        redirect('Login/');
    }
}
