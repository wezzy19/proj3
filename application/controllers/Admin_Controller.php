<?php
defined ('BASEPATH') OR exit('No direct script across allowed');

class Admin_Controller extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->library(['form_validation']);
        $this->load->model(['users_model']);
       
    }

    public function index ()
    {

        if(isset($_SESSION['user'])){
            redirect(base_url('index.php/dashboard'));
        }

        if (isset($_POST['login_btn'])) {
            $email= $this->input->post('user_email');
            $pw= $this->input->post('user_password');

            $user_data=$this->users_model->authenticate($email,$pw);

            if($user_data!==0){

                $user_info = [
                    'user_id'=>$user_data[0]->id,
                    'fullname'=>$user_data[0]->fullname,
                ];

                $this->session->set_userdata('user',$user_info);
                redirect('dashboard');

            }else{

                $this->session->set_flashdata('msg_login','Invalid Password. Please try again.');
            }
    
        }

        $this->load->view('backend/pages/login');
    }

    public function dashboard ()
    { 
        if(!isset($_SESSION['user'])){

            $this->session->set_flashdata('msg_login','Please Login');
            redirect(base_url('index.php/admin'));
        }
    

        $this->load->view('backend/include/header');
        $this->load->view('backend/include/nav');
        $this->load->view('backend/pages/dashboard');
        $this->load->view('backend/include/footer');
    }

    public function logout(){

        $this->session->unset_userdata('user');
        redirect(base_url('index.php/admin'));
        
    }

    public function add_resident(){
        
        if(!isset($_SESSION['user'])){
            $this->session->set_flashdata('msg_login','You are not logged in. Please Login First');
            redirect(base_url('index.php/admin'));
        }

        $this->form_validation->set_rules('full_name','Full Name','trim|required|min_length[2]|max_length[50]');
        $this->form_validation->set_rules('address','Address','trim|required|min_length[2]|max_length[50]');
        $this->form_validation->set_rules('purok','Purok','trim|required|min_length[2]|max_length[50]');
        $this->form_validation->set_rules('birth_place','Birth Place','trim|required|min_length[2]|max_length[50]');
        $this->form_validation->set_rules('sex','Sex','trim|required');
        $this->form_validation->set_rules('birth_date','Birth Date','trim|required');
        $this->form_validation->set_rules('contact','Contact','trim|required|min_length[2]|max_length[50]');
        $this->form_validation->set_rules('nationality','Nationality','trim|required|min_length[2]|max_length[50]');
        $this->form_validation->set_rules('civil_status','Civil Status','trim|required|min_length[2]|max_length[50]');
        $this->form_validation->set_rules('religion','Religion','trim|required|min_length[2]|max_length[50]');
        $this->form_validation->set_error_delimiters('<p style="color:red;">','<p>');

        if($this->form_validation->run()==FALSE){

            $this->load->view('backend/include/header');
            $this->load->view('backend/include/nav');
            $this->load->view('backend/pages/add_resident');
            $this->load->view('backend/include/footer');
            

        }else{

            $resident_data = [
                'full_name' => $this->input->post('full_name', TRUE),
                'address' => $this->input->post('address', TRUE),
                'purok' => $this->input->post('purok', TRUE),
                'sex' => $this->input->post('sex', TRUE),
                'birth_date' => $this->input->post('birth_date', TRUE),
                'birth_place' => $this->input->post('birth_place', TRUE),
                'contact' => $this->input->post('contact', TRUE),
                'nationality' => $this->input->post('nationality', TRUE),
                'civil_status' => $this->input->post('civil_status', TRUE),
                'religion' => $this->input->post('religion', TRUE),
            ];


            $insert = $this->db->insert('resident',$resident_data);

            $insert_id = $this->db->insert_id();

            if( is_int($insert_id) ){
                redirect(base_url('index.php/dashboard/view-residents'));
            }


        }
        


    }


    public function view_resident(){

        if(!isset($_SESSION['user'])){
            $this->session->set_flashdata('msg_login','You are not logged in. Please Login First');
            redirect(base_url('index.php/admin'));
        }


        $resident_list = $this->db->get('resident')->result();

        $data = [
'resident_list'=>$resident_list
        ];

        $this->load->view('backend/include/header');
        $this->load->view('backend/include/nav');
        $this->load->view('backend/pages/view_resident',$data);
        $this->load->view('backend/include/footer');
    }
    public function delete_resident($id){
        $this->db->db_debug = TRUE;
        $this->db->where('resident_id',$id);
        $this->db->delete('resident');
        redirect(base_url('index.php/dashboard/view-residents'));
    }
    public function update_resident($resident_id) {
        if (!isset($_SESSION['user'])) {
            $this->session->set_flashdata('msg_login', 'You are not logged in. Please Login First');
            redirect(base_url('index.php/admin'));
        }
    
      
        $this->form_validation->set_rules('full_name','Full Name','trim|required|min_length[2]|max_length[50]');
        $this->form_validation->set_rules('address','Address','trim|required|min_length[2]|max_length[50]');
        $this->form_validation->set_rules('purok','Purok','trim|required|min_length[2]|max_length[50]');
        $this->form_validation->set_rules('birth_place','Birth Place','trim|required|min_length[2]|max_length[50]');
        $this->form_validation->set_rules('sex','Sex','trim|required');
        $this->form_validation->set_rules('birth_date','Birth Date','trim|required');
        $this->form_validation->set_rules('contact','Contact','trim|required|min_length[2]|max_length[50]');
        $this->form_validation->set_rules('nationality','Nationality','trim|required|min_length[2]|max_length[50]');
        $this->form_validation->set_rules('civil_status','Civil Status','trim|required|min_length[2]|max_length[50]');
        $this->form_validation->set_rules('religion','Religion','trim|required|min_length[2]|max_length[50]');
        $this->form_validation->set_error_delimiters('<p style="color:red;">','<p>');
    
        if ($this->form_validation->run() == FALSE) {
            // Load the resident data based on the resident_id
            $resident_data = $this->db->get_where('resident', array('resident_id' => $resident_id))->row();
    
            $data = [
                'resident_data' => $resident_data
            ];
    
            $this->load->view('backend/include/header');
            $this->load->view('backend/include/nav');
            $this->load->view('backend/pages/update_resident', $data);
            $this->load->view('backend/include/footer');
        } else {
            // Update the resident data
            $resident_data = [
                'full_name' => $this->input->post('full_name', TRUE),
                'address' => $this->input->post('address', TRUE),
                'purok' => $this->input->post('purok', TRUE),
                'sex' => $this->input->post('sex', TRUE),
                'birth_date' => $this->input->post('birth_date', TRUE),
                'birth_place' => $this->input->post('birth_place', TRUE),
                'contact' => $this->input->post('contact', TRUE),
                'nationality' => $this->input->post('nationality', TRUE),
                'civil_status' => $this->input->post('civil_status', TRUE),
                'religion' => $this->input->post('religion', TRUE),
            ];
    
            $this->db->where('resident_id', $resident_id);
            $update = $this->db->update('resident', $resident_data);
    
            if ($update) {
                redirect(base_url('index.php/dashboard/view-residents'));
            }
        }
    }
    
    
    
} 