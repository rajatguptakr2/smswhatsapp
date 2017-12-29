<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Admin extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->database();
        $this->load->library('session');
        /* form controls*/
        $this->load->helper('form');
        $this->load->helper('url');
        $this->load->helper('date');

       /*cache control*/
		$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
		$this->output->set_header('Pragma: no-cache');
    }

    /***default functin, redirects to login page if no admin logged in yet***/
    public function index()
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url() . 'index.php?login', 'refresh');
        if ($this->session->userdata('admin_login') == 1)
            redirect(base_url() . 'index.php?admin/dashboard', 'refresh');
    }

    /***ADMIN DASHBOARD***/
    function dashboard()
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
        $page_data['page_name']  = 'dashboard';
        $page_data['page_title'] = get_phrase('admin_dashboard');
        $this->load->view('backend/index', $page_data);
    }

  /***ADMIN CONFIGURATION ***/
    function document_categories($para1='',$para2='')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');

		if($para1 == 'add_category'){
			$data['doc_name'] = $this->input->post('doc_name');
			$data['doc_type'] = $this->input->post('doc_type');
			$data['doc_added'] = date('Y-m-d H:i:s') ;
			$data['doc_addedby'] = $_SESSION['name'];
			$this->db->insert('doucment_category', $data);
			$this->session->set_flashdata('flash_message' , get_phrase('document_category_added'));
			redirect(base_url() . 'index.php?admin/document_categories/', 'refresh');
		}

		if($para1 == 'edit_category'){
			$data['doc_name'] = $this->input->post('doc_name');
			$data['doc_type'] = $this->input->post('doc_type');
			$data['doc_updated'] = date('Y-m-d H:i:s') ;
			$data['doc_updatedby'] = $_SESSION['name'];

			$this->db->where('doc_id', $para2);
            $this->db->update('doucment_category', $data);

			$this->session->set_flashdata('flash_message' , get_phrase('document_category_updated'));
			redirect(base_url() . 'index.php?admin/document_categories/', 'refresh');
		}
		if($para1 == 'delete_category'){
			$doc_id = $para2;
			$this->crud_model->delete_category($doc_id);
			$this->session->set_flashdata('flash_message' , get_phrase('document_category_deleted'));
			redirect(base_url() . 'index.php?admin/document_categories/', 'refresh');
		}

	    if($para2){
			$page_data['doc_id']  = $para2;
			$page_data['page_name']  = 'document_categories';
			$page_data['page_title'] = get_phrase('update_document_categories');
			$this->load->view('backend/index', $page_data);
		}else{
			$page_data['page_name']  = 'document_categories';
			$page_data['page_title'] = get_phrase('add_document_categories');
			$this->load->view('backend/index', $page_data);
		}
    }

	function delete_mdoc($mdoc_id = '' ,$student_id=''){
		$this->crud_model->delete_mdoc($mdoc_id);
		$this->session->set_flashdata('flash_message' , get_phrase('document_deleted_sucessfully'));
		redirect(base_url() . 'index.php?admin/student_view/'.$student_id, 'refresh');
	}
	function update_mdoc_status($mdoc_id = '' ,$student_id='',$status = ''){
		$this->crud_model->update_mdoc_status($mdoc_id,$student_id,$status);
		$this->session->set_flashdata('flash_message' , get_phrase('document_status_changed_sucessfully'));
		redirect(base_url() . 'index.php?admin/student_view/'.$student_id, 'refresh');
	}



 function preview_doccat($para1='')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');

        $page_data['doc_id']  = $para1;
        $page_data['page_name']  = 'view_document_category';
        $page_data['page_title'] = get_phrase('view_document_category');
        $this->load->view('backend/index', $page_data);
    }

    /****MANAGE STUDENTS CLASSWISE*****/
	function student_add()
	{
		if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');

		$page_data['page_name']  = 'student_add';
		$page_data['page_title'] = get_phrase('add_student');
		$this->load->view('backend/index', $page_data);
	}

	function student_bulk_add($param1 = '')
	{
		if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
			$bulk_validation = 0;
			if($param1 == 'add_bulk_student') {

				 $running_year = $this->db->get_where('settings' , array(
							'type' => 'running_year'
						))->row()->description;

				 $filename=$_FILES["upload_file"]["tmp_name"];
				 $file = fopen($filename, "r");
				 fgetcsv($file);     // skip first line
				 $total= count($file);
				 $file = fopen($filename, "r");
				 if($_FILES["upload_file"]["size"] > 0) {
				 $row = 0;
				 while (($emapData = fgetcsv($file, 10000, ",")) !== FALSE){
						if($row == 0){ $row++; continue; }
						$maxid = 0; $row = $this->db->query('SELECT MAX(student_id) AS `maxid` FROM `student`')->row();
						$maxid = $row->maxid + 1;
						$maxidd = 'STU-'.$maxid;
						$password = $this->random_password(8);
						$birthday = date("Y-m-d", strtotime($emapData[3]));
						$admission_date = date("Y-m-d", strtotime($emapData[6]));
						$data['student_logid'] = $maxidd;
					    $data['student_title'] = $emapData[0];
					    $data['name'] = $emapData[1];
					    $data['email'] = $emapData[2];
					    $data['birthday'] = $birthday;
					    $data['sex'] = $emapData[4];
					    $data['phone'] = $emapData[5];
					    $data['admission_date'] = $admission_date;
					    $data['admission_cat'] = $emapData[7];
					    $data['nationality'] = $emapData[8];
					    $data['address'] = $emapData[9];
					    $data['password'] = $password;

						$this->db->insert('student', $data);
						$student_id = $this->db->insert_id();
						$data2['student_id'] = $student_id;
							$data2['enroll_code']    = substr(md5(rand(0, 1000000)), 0, 7);
							if($this->input->post('class_id') != null){
							  $data2['class_id']       = $this->input->post('class_id');
							}
							if ($this->input->post('section_id') != '') {
								$data2['section_id'] = $this->input->post('section_id');
							}
							$data2['date_added']     = strtotime(date("Y-m-d H:i:s"));
							$data2['year']           = $running_year;
							$this->db->insert('enroll', $data2);
					 }
				        fclose($file);
                        $this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
				 }
           }
		$page_data['page_name']  = 'student_bulk_add';
		$page_data['page_title'] = get_phrase('add_bulk_student');
		$this->load->view('backend/index', $page_data);
	}

    function get_sections($class_id)
    {
        $page_data['class_id'] = $class_id;
        $this->load->view('backend/admin/student_bulk_add_sections' , $page_data);
    }

	function student_information($class_id = '')
	{
		if ($this->session->userdata('admin_login') != 1)
            redirect('login', 'refresh');

		$page_data['page_name']  	= 'student_information';
		$page_data['page_title'] 	= get_phrase('student_information'). " - ".get_phrase('class')." : ".
											$this->crud_model->get_class_name($class_id);
		$page_data['class_id'] 	= $class_id;
		$this->load->view('backend/index', $page_data);
	}

   function student_view($student_id = ''){

		if ($this->session->userdata('admin_login') != 1)
            redirect('login', 'refresh');

		$page_data['student_id']  	= $student_id;
		$page_data['page_name']  	= 'student_view';
		$page_data['page_title'] 	= get_phrase('student_profile');

		$this->load->view('backend/index', $page_data);
	}

	function upload_document(){
		$category = $this->input->post('category');
		$docDetails = $this->input->post('doc_details');
		$fileUpload = $this->input->post('doc_fileupload');
		$student_id = $this->input->post('student_id');
		$doc_id = $this->input->post('doc_id');
		$user_type = $this->input->post('user_type');
		$total = count($docDetails);

		for($i=0; $i<=$total ;$i++){
			$details =  $docDetails[$i];
			$categorys =  $category[$i];
			$docId = $doc_id[$i];
			$studentid = $student_id[$i];

			if($details !=""){
			$data['mdoc_catid'] = $doc_id[$i];
			$data['mdoc_catname'] = $category[$i];
			$data['mdoc_details'] = $docDetails[$i];
			$data['mdoc_relid '] = $student_id;
			$data['mdoc_usertyp'] = $user_type;
			$data['mdoc_status '] = 'P';
			$this->db->insert('manage_document', $data);
			$mdoc_id = $this->db->insert_id();
            if($_FILES['doc_fileupload']['tmp_name'][$i]){
				$temp = $_FILES['doc_fileupload']['tmp_name'][$i];
				$fileNames = $_FILES['doc_fileupload']['name'][$i];
                $fileName = $categorys."-".$studentid;
				$fileName = str_replace(' ', '', $fileName);
				$ext = pathinfo($fileNames, PATHINFO_EXTENSION);
				$file_path = 'uploads/student_documents/'."." . $fileName.$ext;
			    if (file_exists($file_path)) {
					unlink($file_path);
				}
				$data2['mdoc_file'] = $fileName.".".$ext;
                $this->db->where('mdoc_id', $mdoc_id);
                $this->db->update('manage_document', $data2);
			 move_uploaded_file($temp, 'uploads/student_documents/' . $fileName.".".$ext);
			}
	     	}
		 }
		 $this->session->set_flashdata('flash_message' , get_phrase('document_uploaded_successfully'));
		 redirect(base_url() . 'index.php?admin/student_view/'.$student_id, 'refresh');
	}

   function personel_details($student_id = ''){

		if ($this->session->userdata('admin_login') != 1)
            redirect('login', 'refresh');

		$page_data['student_id']  	= $student_id;
		$page_data['page_name']  	= 'personel_details';
		$page_data['page_title'] 	= get_phrase('update_personel_details')." : ".$this->crud_model->get_student_name($student_id);;

		$this->load->view('backend/index', $page_data);
	}

  function academic_details($student_id = ''){

		if ($this->session->userdata('admin_login') != 1)
            redirect('login', 'refresh');

		$page_data['student_id']  	= $student_id;
		$page_data['page_name']  	= 'academic_details';
		$page_data['page_title'] 	= get_phrase('update_academic_details')." : ".$this->crud_model->get_student_name($student_id);;

		$this->load->view('backend/index', $page_data);
	}
   function guardian_details($student_id = ''){

		if ($this->session->userdata('admin_login') != 1)
            redirect('login', 'refresh');

		$page_data['student_id']  	= $student_id;
		$page_data['page_name']  	= 'guardian_details';
		$page_data['page_title'] 	= get_phrase('add_guardian_details')." : ".$this->crud_model->get_student_name($student_id);;

		$this->load->view('backend/index', $page_data);
	}

    function student_marksheet($student_id = '') {
        if ($this->session->userdata('admin_login') != 1)
            redirect('login', 'refresh');
        $class_id     = $this->db->get_where('enroll' , array(
            'student_id' => $student_id , 'year' => $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description
        ))->row()->class_id;
        $student_name = $this->db->get_where('student' , array('student_id' => $student_id))->row()->name;
        $class_name   = $this->db->get_where('class' , array('class_id' => $class_id))->row()->name;
        $page_data['page_name']  =   'student_marksheet';
        $page_data['page_title'] =   get_phrase('marksheet_for') . ' ' . $student_name . ' (' . get_phrase('class') . ' ' . $class_name . ')';
        $page_data['student_id'] =   $student_id;
        $page_data['class_id']   =   $class_id;
        $this->load->view('backend/index', $page_data);
    }

    function student_marksheet_print_view($student_id , $exam_id) {
        if ($this->session->userdata('admin_login') != 1)
            redirect('login', 'refresh');
        $class_id     = $this->db->get_where('enroll' , array(
            'student_id' => $student_id , 'year' => $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description
        ))->row()->class_id;
        $class_name   = $this->db->get_where('class' , array('class_id' => $class_id))->row()->name;

        $page_data['student_id'] =   $student_id;
        $page_data['class_id']   =   $class_id;
        $page_data['exam_id']    =   $exam_id;
        $this->load->view('backend/admin/student_marksheet_print_view', $page_data);
    }


    function student($param1 = '', $param2 = '', $param3 = '')
    {

        if ($this->session->userdata('admin_login') != 1)
            redirect('login', 'refresh');
        $running_year = $this->db->get_where('settings' , array(
            'type' => 'running_year'
        ))->row()->description;
        if ($param1 == 'create') {
            $data['name']         = $this->input->post('name');

            if($this->input->post('birthday') != null){
			  $originalDate = $this->input->post('birthday');
              $newDate = date("Y-m-d", strtotime($originalDate));
              $data['birthday']     = $newDate;
            }
            if($this->input->post('sex') != null){
              $data['sex']          = $this->input->post('sex');
            }

           /*  if($this->input->post('address') != null){
              $data['address']      = $this->input->post('address');
            } */
            if($this->input->post('phone') != null){
              $data['phone']        = $this->input->post('phone');
            }

            $data['email']        = $this->input->post('email');
            $data['status']        = 1 ;

			$password = $this->random_password(8);
			$data['password']  = $password;

           /*  if($this->input->post('parent_id') != null){
                $data['parent_id']    = $this->input->post('parent_id');
            }
            if($this->input->post('dormitory_id') != null){
                $data['dormitory_id'] = $this->input->post('dormitory_id');
            }

            if($this->input->post('transport_id') != null){
                $data['transport_id'] = $this->input->post('transport_id');
            }*/
			if($this->input->post('student_logid') != null){
                $data['student_logid'] = 'STU-'.$this->input->post('student_logid');
            }
			if($this->input->post('student_title') != null){
                $data['student_title'] = $this->input->post('student_title');
            }
			if($this->input->post('admission_cat') != null){
                $data['admission_cat'] = $this->input->post('admission_cat');
            }
			if($this->input->post('nationality') != null){
                $data['nationality'] = $this->input->post('nationality');
            }
			if($this->input->post('admission_date') != null){
				$originalDate2 = $this->input->post('admission_date');
                $newDate2 = date("Y-m-d", strtotime($originalDate2));
                $data['admission_date'] = $newDate2;
            }else{
                $data['admission_date'] = date("Y-m-d");
			}


			if($this->input->post('student_status') != null){
                $data['student_status'] = $this->input->post('student_status');
            }

            $validation = email_validation($data['email']);
            if($validation == 1){
                $this->db->insert('student', $data);
                $student_id = $this->db->insert_id();

                $data2['student_id']     = $student_id;
                $data2['enroll_code']    = substr(md5(rand(0, 1000000)), 0, 7);
                if($this->input->post('class_id') != null){
                  $data2['class_id']       = $this->input->post('class_id');
                }
                if ($this->input->post('section_id') != '') {
                    $data2['section_id'] = $this->input->post('section_id');
                }
                if ($this->input->post('roll') != '') {
                    $data2['roll']           = $this->input->post('roll');
                }
                $data2['date_added']     = strtotime(date("Y-m-d H:i:s"));
                $data2['year']           = $running_year;
                $this->db->insert('enroll', $data2);
                move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/student_image/' . $student_id . '.jpg');

                // $this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
                $this->email_model->account_opening_email('student', $data['email']); //SEND EMAIL ACCOUNT OPENING EMAIL
            }
            else{
				echo "Email Address invalid!"; die;
                // $this->session->set_flashdata('error_message' , get_phrase('this_email_id_is_not_available'));
            }
			echo "Sucessfully Submitted"; die;
            // redirect(base_url() . 'index.php?admin/student_add/', 'refresh');
        }
        if ($param1 == 'do_update') {
				$data['name']           = $this->input->post('name');
				$data['email']          = $this->input->post('email');
				$data['parent_id']      = $this->input->post('parent_id');
            if($this->input->post('birthday') != null){
			  $originalDate = $this->input->post('birthday');
              $newDate = date("Y-m-d", strtotime($originalDate));
              $data['birthday']     = $newDate;
            }
            if ($this->input->post('sex') != null) {
                $data['sex']            = $this->input->post('sex');
            }
			if ($this->input->post('birthplace') != null) {
                $data['birthplace']            = $this->input->post('birthplace');
            }
			if ($this->input->post('language') != null) {
                $data['languages']            = $this->input->post('language');
            }

            if ($this->input->post('phone') != null) {
                $data['phone']          = $this->input->post('phone');
            }
			  if($this->input->post('address') != null){
              $data['address']      = $this->input->post('address');
            }

            if($this->input->post('student_title') != null){
                $data['student_title'] = $this->input->post('student_title');
            }

			if($this->input->post('bloodgroup') != null){
                $data['bloodgroup'] = $this->input->post('bloodgroup');
            }

			if($this->input->post('admission_cat') != null){
                $data['admission_cat'] = $this->input->post('admission_cat');
            }

			if($this->input->post('nationality') != null){
                $data['nationality'] = $this->input->post('nationality');
            }

			if($this->input->post('religion') != null){
                $data['religion'] = $this->input->post('religion');
            }

			if($this->input->post('blood_group') != null){
                $data['blood_group'] = $this->input->post('blood_group');
            }
			if($this->input->post('admission_date') != null){
				$originalDate2 = $this->input->post('admission_date');
                $newDate2 = date("Y-m-d", strtotime($originalDate2));
                $data['admission_date'] = $newDate2;
            }else{
                $data['admission_date'] = date("Y-m-d");
			}

            /* $validation = email_validation_for_edit($data['email'], $param2, 'student');
            if($validation == 1){  */


                $this->db->where('student_id', $param2);
                $this->db->update('student', $data);

               /*  $data2['section_id'] = $this->input->post('section_id');
                if ($this->input->post('roll') != null) {
                  $data2['roll'] = $this->input->post('roll');
                }
                else{
                  $data2['roll'] = null;
                }
                $running_year = $this->db->get_where('settings' , array('type'=>'running_year'))->row()->description;
                $this->db->where('student_id' , $param2);
                $this->db->where('year' , $running_year);
                $this->db->update('enroll' , array(
                    'section_id' => $data2['section_id'] , 'roll' => $data2['roll']
                ));

                move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/student_image/' . $param2 . '.jpg');
                $this->crud_model->clear_cache(); */
                $this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
          /*  }
           else{
             $this->session->set_flashdata('error_message' , get_phrase('this_email_id_is_not_available'));
           } */
            redirect(base_url() . 'index.php?admin/student_view/' . $param2, 'refresh');
        }


		 if ($param1 == 'do_academic_update') {
				   if ($this->input->post('class_id') != null) {
						$data['class_id']            = $this->input->post('class_id');
					}
					if ($this->input->post('section_id') != null) {
					   $data['section_id']        = $this->input->post('section_id');
					}
					if ($this->input->post('roll_number') != null) {
						$data['roll_number']          = $this->input->post('roll_number');
					}
					if ($this->input->post('Status') != null) {
						$data2['Status']          = $this->input->post('Status');
					}

		        $running_year = $this->db->get_where('settings' , array('type'=>'running_year'))->row()->description;
		        $this->db->where('student_id' , $param2);
                $this->db->where('year' , $running_year);
                $this->db->update('enroll' , array(
                    'class_id' => $data['class_id'] ,'section_id' => $data['section_id'] , 'roll' => $data['roll_number']
                ));

				$this->db->where('student_id' , $param2);
                $this->db->update('student' , array(
                    'status' => $data2['Status']
                ));

				 $this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
				 redirect(base_url() . 'index.php?admin/student_view/' . $param2, 'refresh');
		 }

		 if ($param1 == 'add_guardian') {

            if ($this->input->post('name') != null) {
                $data['name']            = $this->input->post('name');
            }
			if ($this->input->post('student_id') != null) {
                $data['rel_stuid']            = $this->input->post('student_id');
            }
            if ($this->input->post('relation') != null) {
               $data['relation']        = $this->input->post('relation');
            }
            if ($this->input->post('mobile_no') != null) {
                $data['mobile_no']          = $this->input->post('mobile_no');
            }
			if ($this->input->post('phone_no') != null) {
                $data['phone']          = $this->input->post('phone_no');
            }
			if ($this->input->post('qualification') != null) {
                $data['qualification']          = $this->input->post('qualification');
            }
		   if ($this->input->post('occupation') != null) {
                $data['profession']          = $this->input->post('occupation');
            }
		   if ($this->input->post('income') != null) {
                $data['income']          = $this->input->post('income');
            }
		    if ($this->input->post('email') != null) {
                $data['email']          = $this->input->post('email');
            }
		    if ($this->input->post('home_address') != null) {
                $data['home_address']          = $this->input->post('home_address');
            }
		    if ($this->input->post('office_address') != null) {
                $data['office_address']          = $this->input->post('office_address');
            }
		    $this->db->insert('parent', $data);
			 redirect(base_url() . 'index.php?admin/student_view/' . $param2, 'refresh');
            }


         }


		 function upload_image ($student_id) {
			 if($_FILES['fileupload']['tmp_name']){
			 $fileName_path  = 'uploads/student_image/' . $student_id . '.jpg';

			 if (file_exists($fileName_path)) {
					unlink($fileName_path);
				}

		     move_uploaded_file($_FILES['fileupload']['tmp_name'], 'uploads/student_image/' . $student_id . '.jpg');
			 redirect(base_url() . 'index.php?admin/student_view/' . $student_id, 'refresh');
			 }else{ redirect(base_url() . 'index.php?admin/student_view/' . $student_id, 'refresh'); }
		 }

   function update_guardian($param1 = '', $param2 = '', $param3 = '')
	{

		if($_POST){
	    if ($this->input->post('name') != null) {
                $data['name']            = $this->input->post('name');
            }
            if ($this->input->post('relation') != null) {
               $data['relation']        = $this->input->post('relation');
            }
            if ($this->input->post('mobile_no') != null) {
                $data['mobile_no']          = $this->input->post('mobile_no');
            }
			if ($this->input->post('phone_no') != null) {
                $data['phone']          = '+91'.$this->input->post('phone_no');
            }
   //           if ($this->input->post('mobile_no') != null) {
   //              $data['mobile_no']          = $this->input->post('mob_code').$this->input->post('mobile_no');
   //          }
			// if ($this->input->post('phone_no') != null) {
   //              $data['phone']          = $this->input->post('phone_code').$this->input->post('phone_no');
   //          }
			if ($this->input->post('qualification') != null) {
                $data['qualification']          = $this->input->post('qualification');
            }
		   if ($this->input->post('occupation') != null) {
                $data['profession']          = $this->input->post('occupation');
            }
		   if ($this->input->post('income') != null) {
                $data['income']          = $this->input->post('income');
            }
		    if ($this->input->post('email') != null) {
                $data['email']          = $this->input->post('email');
            }
		    if ($this->input->post('home_address') != null) {
                $data['home_address']          = $this->input->post('home_address');
            }
		    if ($this->input->post('office_address') != null) {
                $data['office_address']          = $this->input->post('office_address');
            }

                $this->db->where('parent_id' , $param1);
                $this->db->update('parent' , $data);
				redirect(base_url() . 'index.php?admin/student_view/' . $param2, 'refresh');

	}
	}
	function update_emergency($param1 = '',$param2 = ''){
		        $data['emergency_contact'] = $param1;
		        $this->db->where('student_id' , $param2);
                $this->db->update('student' , $data);
				echo "updated"; die;

	}

    function delete_guardian($parent_id = '',$student_id = '') {
      $this->crud_model->delete_guardian($parent_id);
      $this->session->set_flashdata('flash_message' , get_phrase('guardian_deleted'));
      redirect(base_url() . 'index.php?admin/student_view/' . $student_id, 'refresh');
    }
    function delete_student($student_id = '', $class_id = '') {
      $this->crud_model->delete_student($student_id);
      $this->session->set_flashdata('flash_message' , get_phrase('student_deleted'));
      redirect(base_url() . 'index.php?admin/student_information/' . $class_id, 'refresh');
    }

    // STUDENT PROMOTION
    function student_promotion($param1 = '' , $param2 = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect('login', 'refresh');

        if($param1 == 'promote') {
            $running_year  =   $this->input->post('running_year');
            $from_class_id =   $this->input->post('promotion_from_class_id');
            $students_of_promotion_class =   $this->db->get_where('enroll' , array(
                'class_id' => $from_class_id , 'year' => $running_year
            ))->result_array();
            foreach($students_of_promotion_class as $row) {
                $enroll_data['enroll_code']     =   substr(md5(rand(0, 1000000)), 0, 7);
                $enroll_data['student_id']      =   $row['student_id'];
                $enroll_data['class_id']        =   $this->input->post('promotion_status_'.$row['student_id']);
                $enroll_data['year']            =   $this->input->post('promotion_year');
                $enroll_data['date_added']      =   strtotime(date("Y-m-d H:i:s"));
                $this->db->insert('enroll' , $enroll_data);
            }
            $this->session->set_flashdata('flash_message' , get_phrase('new_enrollment_successfull'));
            redirect(base_url() . 'index.php?admin/student_promotion' , 'refresh');
        }

        $page_data['page_title']    = get_phrase('student_promotion');
        $page_data['page_name']  = 'student_promotion';
        $this->load->view('backend/index', $page_data);
    }

// reset login
    function reset_login($param1 = '' , $param2 = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect('login', 'refresh');

        $page_data['page_title']    = get_phrase('reset_login');
        $page_data['page_name']  = 'reset_login';
        $this->load->view('backend/index', $page_data);
    }

	function reset_password($param1 = '' , $param2 = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect('login', 'refresh');

        $page_data['page_title']    = get_phrase('reset_password');
        $page_data['page_name']  = 'reset_password';
        $this->load->view('backend/index', $page_data);
    }


	 function update_student_login( $param1 = '' , $param2 = '' )
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect('login', 'refresh');

		if($_POST) {
			$student_logid = $this->input->post('student_logid');
			$student_id = $this->input->post('student_id');
			$student = $this->db->get_where('student', array('student_logid =' => $student_logid ))->row();
		    if(!empty($student)){
				echo "1"; die;
			}else{
				$data['student_logid'] = $student_logid;
				$this->db->where('student_id' , $student_id);
                $this->db->update('student' , $data);
				echo "0"; die;
			}
		}
        $page_data['stu_id']    = $param1;
        $page_data['page_title']    = get_phrase('update_student_login');
        $page_data['page_name']  = 'update_student_login';
        $this->load->view('backend/index', $page_data);
    }

	 function update_student_password( $param1 = '' , $param2 = '' )
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect('login', 'refresh');

		        $password = $this->random_password(8);
				$data['password'] = $password;
				$this->db->where('student_id' , $param1);
                $this->db->update('student' , $data);

		$this->session->set_flashdata('flash_message' , get_phrase('password_updated_sucessfully'));
        redirect( base_url().'index.php?admin/reset_password/', 'refresh');
    }



    function get_students_to_promote($class_id_from , $class_id_to , $running_year , $promotion_year)
    {
        $page_data['class_id_from']     =   $class_id_from;
        $page_data['class_id_to']       =   $class_id_to;
        $page_data['running_year']      =   $running_year;
        $page_data['promotion_year']    =   $promotion_year;
        $this->load->view('backend/admin/student_promotion_selector' , $page_data);
    }


     /****MANAGE PARENTS CLASSWISE*****/
    function parent($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect('login', 'refresh');
        if ($param1 == 'create') {
            $data['name']        			= $this->input->post('name');
            $data['email']       			= $this->input->post('email');
            $data['password']    			= sha1($this->input->post('password'));
            if ($this->input->post('phone') != null) {
               $data['phone'] = $this->input->post('phone');
            }
            if ($this->input->post('address') != null) {
               $data['address'] = $this->input->post('address');
            }
            if ($this->input->post('profession') != null) {
               $data['profession'] = $this->input->post('profession');
            }
            $validation = email_validation($data['email']);
            if($validation == 1){
                $this->db->insert('parent', $data);
                $this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
                $this->email_model->account_opening_email('parent', $data['email']); //SEND EMAIL ACCOUNT OPENING EMAIL
            }
            else{
                $this->session->set_flashdata('error_message' , get_phrase('this_email_id_is_not_available'));
            }

            redirect(base_url() . 'index.php?admin/parent/', 'refresh');
        }
        if ($param1 == 'edit') {
            $data['name']                   = $this->input->post('name');
            $data['email']                  = $this->input->post('email');
            if ($this->input->post('phone') != null) {
               $data['phone'] = $this->input->post('phone');
            }
            else{
              $data['phone'] = null;
            }
            if ($this->input->post('address') != null) {
                $data['address'] = $this->input->post('address');
            }
            else{
               $data['address'] = null;
            }
            if ($this->input->post('profession') != null) {
                $data['profession'] = $this->input->post('profession');
            }
            else{
                $data['profession'] = null;
            }
            $validation = email_validation_for_edit($data['email'], $param2, 'parent');
            if ($validation == 1) {
                $this->db->where('parent_id' , $param2);
                $this->db->update('parent' , $data);
                $this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
            }
            else{
                $this->session->set_flashdata('error_message' , get_phrase('this_email_id_is_not_available'));
            }

            redirect(base_url() . 'index.php?admin/parent/', 'refresh');
        }
        if ($param1 == 'delete') {
            $this->db->where('parent_id' , $param2);
            $this->db->delete('parent');
            $this->session->set_flashdata('flash_message' , get_phrase('data_deleted'));
            redirect(base_url() . 'index.php?admin/parent/', 'refresh');
        }
        $page_data['page_title'] 	= get_phrase('all_parents');
        $page_data['page_name']  = 'parent';
        $this->load->view('backend/index', $page_data);
    }

    /*** PAYROLL / HR ***/
    function usertype ($param1 = '', $param2 = '', $param3 = '') {
      if($param1 == ''){
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
        $this->load->model('Crud_model');
        //Get school id from session and pass to function below
        $data = $this->crud_model->usertype_list('1');
        $page_data['usertype_list'] = $data;
        $page_data['page_name'] = 'add_user_type';
        $page_data['page_title'] = get_phrase('add_user_type');
        $this->load->view('backend/index', $page_data);
      }
      if($param1 == 'add'){
        $data['school_id'] = '1';
        $data['usertype'] = $this->input->post('usertype');
        $this->load->model('Crud_model');
        $check = $this->Crud_model->usertype_check($data);
        if($check > 0){
          $msg = array(
            'message' => 'Usertype alredy present'
          );
          echo json_encode($msg);
        }else{
          $result = $this->Crud_model->usertype_add($data);
          if($result){
            $msg = array(
              'message' => 'Usertype added successfully'
            );
            echo json_encode($msg);
          }else{
            $msg = array(
              'message' => 'Error in adding Usertype'
            );
            echo json_encode($msg);
          }
        }
      }
      // delete usertype using id
      if($param1 == 'delete'){
        $data['id'] = $param2;
        $data['school_id'] = '1';
        $this->load->model('Crud_model');
        $check = $this->Crud_model->usertype_delete($data);
        if($check){
          $msg = array(
            'message' => 'Usertype deleted successfully'
          );
          echo json_encode($msg);
        }else{
          $msg = array(
            'message' => 'Error in deleting'
          );
          echo json_encode($msg);
        }
      }
    }
    function department ($param1 = '' , $param2 = '', $param3 = '') {
      if($param1 == ''){
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
            $this->load->model('Crud_model');
            //Get school id from session and pass to function below
            $data = $this->crud_model->department_list('1');
            $page_data['department_list'] = $data;
        $page_data['page_name'] = 'add_department';
        $page_data['page_title'] = get_phrase('add_department');
        $this->load->view('backend/index', $page_data);
      }
      if($param1 == 'add'){
        $data['name'] = $this->input->post('name');
        $data['school_id'] = '1';
        $this->load->model('Crud_model');
        $check = $this->Crud_model->department_check($data);
        if($check > 0){
          $msg = array(
            'message' => 'Department alredy present'
          );
          echo json_encode($msg);
        }else{
          $result = $this->Crud_model->department_add($data);
          if($result){
            $msg = array(
              'message' => 'Department added successfully',
              'status' => '400'
            );
            echo json_encode($msg);
          }else{
            $msg = array(
              'message' => 'Error in adding department'
            );
            echo json_encode($msg);
          }
        }
      }
      if($param1 == 'delete'){
        $data['id'] = $param2;
        $data['school_id'] = '1';
        $this->load->model('Crud_model');
        $check = $this->Crud_model->department_delete($data);
        if($check){
          $msg = array(
            'message' => 'Department deleted successfully'
          );
          echo json_encode($msg);
        }else{
          $msg = array(
            'message' => 'Error in deleting'
          );
          echo json_encode($msg);
        }
      }
    }
    function designation ($param1 = '' , $param2 = '', $param3 = '') {
      if($param1 == ''){
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
            $this->load->model('Crud_model');
            //Get school id from session and pass to function below
            $data = $this->crud_model->designation_list('1');
            $page_data['designation_list'] = $data;
        $page_data['page_name'] = 'add_designation';
        $page_data['page_title'] = get_phrase('add_designation');
        $this->load->view('backend/index', $page_data);
      }
      if($param1 == 'add'){
        $data['name'] = $this->input->post('name');
        $data['school_id'] = '1';
        $this->load->model('Crud_model');
        $check = $this->Crud_model->designation_check($data);
        if($check > 0){
          $msg = array(
            'message' => 'Designation alredy present'
          );
          echo json_encode($msg);
        }else{
          $result = $this->Crud_model->designation_add($data);
          if($result){
            $msg = array(
              'message' => 'Designation added successfully',
              'status' => '400'
            );
            echo json_encode($msg);
          }else{
            $msg = array(
              'message' => 'Error in adding designation'
            );
            echo json_encode($msg);
          }
        }
      }
      if($param1 == 'delete'){
        $data['id'] = $param2;
        $data['school_id'] = '1';
        $this->load->model('Crud_model');
        $check = $this->Crud_model->designation_delete($data);
        if($check){
          $msg = array(
            'message' => 'Designation deleted successfully'
          );
          echo json_encode($msg);
        }else{
          $msg = array(
            'message' => 'Error in deleting'
          );
          echo json_encode($msg);
        }
      }
    }
    function employee ($param1 = '' , $param2 = '', $param3 = '') {
        if ($param1 == '') {
            if ($this->session->userdata('admin_login') != 1)
                redirect(base_url(), 'refresh');
                // Pre data
                $this->load->model('Crud_model');
                // Function need school id here we pass 1 as school id
                $page_data['department_list'] = $this->Crud_model->department_list('1');
                $page_data['designation_list'] = $this->Crud_model->designation_list('1');
                $page_data['usertype_list'] = $this->Crud_model->usertype_list('1');

                $page_data['page_name'] = 'add_employee';
                $page_data['page_title'] = get_phrase('add_employee');
                $this->load->view('backend/index', $page_data);
        }
        if($param1 == 'delete'){
          $data['school_id'] = '1';
          $data['id'] = $this->input->post('id');
          $this->load->model('Crud_model');
          $check = $this->Crud_model->employee_delete($data);
          if($check){
            $msg = array(
              'message' => 'Employee deleted successfully',
              'status' => '400'
            );
            echo json_encode($msg);
          }else{
            $msg = array(
              'message' => 'Error in deleting'
            );
            echo json_encode($msg);
          }
        }
       if ($param1 == 'list') {
            if ($this->session->userdata('admin_login') != 1)
                redirect(base_url(), 'refresh');
                //Pre data
                $this->load->model('Crud_model');
                // School id required here
                $page_data['employee_list'] = $this->Crud_model->employee_list('1');
                $page_data['page_name'] = 'employee_list';
                $page_data['page_title'] = get_phrase('employee_list');
                $this->load->view('backend/index', $page_data);
        }
        if($param1 == 'add'){
          //School id
          $data['school_id'] = '1';
          $data['employee_code'] = $this->input->post('employeeCode');
          $data['department'] = $this->input->post('department');
          $data['designation'] = $this->input->post('designation');
          $data['qualification'] = $this->input->post('qualification');
          $data['experience'] = $this->input->post('totalExperience');
          $data['usertype'] = $this->input->post('usertype');
          $data['joining_date'] = date('Y-m-d', strtotime($this->input->post('joinDate')));
          $data['first_name'] = $this->input->post('firstName');
          $data['middle_name'] = $this->input->post('middleName');
          $data['last_name'] = $this->input->post('lastName');
          $data['dob'] = date('Y-m-d', strtotime($this->input->post('dob')));
          $data['gender'] = $this->input->post('gender');
          $data['present_address'] = $this->input->post('presentAddress');
          $data['permanent_address'] = $this->input->post('permanentAddress');
          $data['country'] = $this->input->post('country');
          $data['state'] = $this->input->post('state');
          $data['city'] = $this->input->post('city');
          $data['pincode'] = $this->input->post('pin');
          $data['mobile'] = $this->input->post('mobile');
          $data['email'] = $this->input->post('email');
          $data['image'] = 'path';

          $this->load->model('Crud_model');
          $check = $this->Crud_model->employee_check($data);
          if($check > 0){
            $msg = array(
              'message' => 'Employee alredy present'
            );
            echo json_encode($msg);
          }else{
            $result = $this->Crud_model->employee_add($data);
            if($result){
              $msg = array(
                'message' => 'Employee added successfully'
              );
              echo json_encode($msg);
            }else{
              $msg = array(
                'message' => 'Error in adding employee'
              );
              echo json_encode($msg);
            }
          }
        }
    }
    function bank ($param1 = '', $param2 = '') {
      if($param1 == ''){
        if ($this->session->userdata('admin_login') != 1)
                redirect(base_url(), 'refresh');
              $this->load->model('Crud_model');
              //Pre data
              $page_data['bank_list'] = $this->Crud_model->bank_list('1');
              $page_data['designation_list'] = $this->Crud_model->designation_list('1');
              $page_data['department_list'] = $this->Crud_model->department_list('1');
              $page_data['details_list'] = $this->Crud_model->details_list('1');
              $page_data['page_name'] = 'add_bank_details';
              $page_data['page_title'] = get_phrase('add_bank');
              $this->load->view('backend/index', $page_data);
      }
      if($param1 == 'add_bank'){
        $data['school_id'] = '1';
        $data['name'] = $this->input->post('bankName');
        $this->load->model('Crud_model');
        $check = $this->Crud_model->bank_check($data);
        if($check > 0){
          $msg = array(
            'message' => 'Bank alredy present'
          );
          echo json_encode($msg);
        }else{
          $result = $this->Crud_model->bank_add($data);
          if($result){
            $msg = array(
              'message' => 'Bank added successfully',
              'status' => '400'
            );
            echo json_encode($msg);
          }else{
            $msg = array(
              'message' => 'Error in adding bank'
            );
            echo json_encode($msg);
          }
        }
      }
      if($param1 == 'delete'){
        $data['id'] = $this->input->post('id');
        $data['school_id'] = '1';
        $this->load->model('Crud_model');
        $check = $this->Crud_model->bank_delete($data);
        if($check){
          $msg = array(
            'message' => 'Bank deleted successfully'
          );
          echo json_encode($msg);
        }else{
          $msg = array(
            'message' => 'Error in deleting'
          );
          echo json_encode($msg);
        }
      }
      if($param1 == 'get_employee_list'){
        $data['school_id'] = '1';
        $data['designation'] = $this->input->post('designation');
        $this->load->model('Crud_model');
        $result = $this->Crud_model->get_employee_name($data);
        echo json_encode($result);
      }
      if($param1 == 'add_details'){
        $data['school_id'] = '1';
        $data['designation'] = $this->input->post('designation');
        $data['employee_code'] = $this->input->post('employee_code');
        $data['bank_name'] = $this->input->post('bankName');
        $data['branch'] = $this->input->post('branch');
        $data['address'] = $this->input->post('address');
        $data['phone'] = $this->input->post('phone');
        $data['ifsc'] = $this->input->post('ifsc');
        $data['account'] = $this->input->post('account');
        $data['dd_address'] = $this->input->post('dd');
        $this->load->model('Crud_model');
        $check = $this->Crud_model->bank_detail_add($data);
        if($check){
          echo json_encode(array('message' => 'Details added successfully'));
        }else{
          echo json_encode(array('message' => 'Error in adding details'));
        }
      }
    }

    //payroll
    function payhead($param1, $param2){
      if($param1 == ''){
        if ($this->session->userdata('admin_login') != 1)
                redirect(base_url(), 'refresh');
            $this->load->model('Crud_model');
            $page_data['paytype_list'] = $this->Crud_model->payhead_list('1');
            $page_data['page_name'] = 'payhead';
            $page_data['page_title'] = get_phrase('pay_head_type');
            $this->load->view('backend/index', $page_data);
      }
      if($param1 == 'add'){
        $data['school_id'] = '1';
        $data['name'] = $this->input->post('pay');
        $data['description'] = $this->input->post('desc');
        $data['type'] = $this->input->post('type');
        $this->load->model('Crud_model');
        $check = $this->Crud_model->payhead_add($data);
        if($check){
          $msg  = array('message' => 'Paytpe added successfully');
          echo json_encode($msg);
        }else{
          $msg = array('message' => 'Error in adding details');
          echo json_encode($msg);
        }
      }
    }
    function paytype($param1 , $param2){
      if($param1 == ''){
        if ($this->session->userdata('admin_login') != 1)
                redirect(base_url(), 'refresh');
            $this->load->model('Crud_model');
            $page_data['payable_list'] = $this->Crud_model->payable_list('1');
            $page_data['page_name'] = 'paytype';
            $page_data['page_title'] = get_phrase('payable_type');
            $this->load->view('backend/index', $page_data);
      }
      if($param1 == 'add'){
        $data['school_id'] = '1';
        $data['name'] = $this->input->post('payable');
        $this->load->model('Crud_model');
        $check  = $this->Crud_model->payable_add($data);
        if($check){
          $msg = array('message' => 'Payable type added sccessfully',
        'status' => '400');
          echo json_encode($msg);
        }else{
          $msg = array('message' => 'Error in adding payable type');
          echo json_encode($msg);
        }
      }
    }
    function salary($param1 , $param2){
      if($param1 == ''){
        if ($this->session->userdata('admin_login') != 1)
                redirect(base_url(), 'refresh');
            $this->load->model('Crud_model');
            $page_data['designation_list'] = $this->Crud_model->designation_list('1');
            $page_data['payhead_list'] = $this->Crud_model->payhead_list('1');
            $page_data['salary_list'] = $this->Crud_model->salary_list('1');
            $page_data['page_name'] = 'salary_setting';
            $page_data['page_title'] = get_phrase('salary_settings');
            $this->load->view('backend/index', $page_data);
      }
      if($param1 == 'get_employee_list'){
        $data['school_id'] = '1';
        $data['designation'] = $this->input->post('designation');
        $this->load->model('Crud_model');
        $result = $this->Crud_model->get_employee_name($data);
        echo json_encode($result);
      }
      if($param1 == 'add'){
        $data['school_id'] = '1';
        $data['designation'] = $this->input->post('designation');
        $data['employee_code'] = $this->input->post('emp_code');
        $data['payhead'] = $this->input->post('payhead');
        $data['unit'] = $this->input->post('unit');
        $data['type'] = $this->input->post('type');
        $this->load->model('Crud_model');
        $check = $this->Crud_model->salary_add($data);
        if($check){
          echo json_encode(array('message' => 'Salary setting added successfully', 'status' => '400'));
        }else{
          echo json_encode(array('message' => 'Error in saving'));
        }
      }
    }
    function employee_salary($param1 , $param2){
      if($param1 == ''){
        if ($this->session->userdata('admin_login') != 1)
                redirect(base_url(), 'refresh');
            $this->load->model('Crud_model');
            $page_data['designation_list'] = $this->Crud_model->designation_list('1');
            $page_data['payhead_list'] = $this->Crud_model->payhead_list('1');
            $page_data['salary_list'] = $this->Crud_model->salary_list('1');
            $page_data['page_name'] = 'employee_salary';
            $page_data['page_title'] = get_phrase('employee_salary');
            $this->load->view('backend/index', $page_data);
      }

    }
    function leave($param1, $param2){
      if($param1 == ''){
        if ($this->session->userdata('admin_login') != 1)
                redirect(base_url(), 'refresh');
                $this->load->model('Crud_model');
                $page_data['leave_list'] = $this->Crud_model->leave_list('1');
            $page_data['page_name'] = 'leave_category';
            $page_data['page_title'] = get_phrase('leave_category');
            $this->load->view('backend/index', $page_data);
      }
      if($param1 == 'add'){
        $data['school_id'] = '1';
        $data['name'] = $this->input->post('name');
        $this->load->model('Crud_model');
        $check = $this->Crud_model->leave_add($data);
        if($check){
          echo json_encode(array('message' => 'Leave category added successfully', 'status' => '400'));
        }else{
          echo json_encode(array('message' => 'Error in saving'));
        }
      }
    }
    function leave_detail($param1, $param2){
      if($param1 == ''){
        if ($this->session->userdata('admin_login') != 1)
                redirect(base_url(), 'refresh');
                $this->load->model('Crud_model');
                $page_data['leave_detail_list'] = $this->Crud_model->leave_detail_list('1');
                $page_data['leave_list'] = $this->Crud_model->leave_list('1');
                $page_data['designation_list'] = $this->Crud_model->designation_list('1');
            $page_data['page_name'] = 'leave_details';
            $page_data['page_title'] = get_phrase('leave_details');
            $this->load->view('backend/index', $page_data);
      }
      if($param1 == 'add'){
        $data['school_id'] = '1';
        $data['name'] = $this->input->post('name');
        $data['designation'] = $this->input->post('designation');
        $data['count'] = $this->input->post('count');
        $this->load->model('Crud_model');
        $check = $this->Crud_model->leave_detail_add($data);
        if($check){
          echo json_encode(array('message' => 'Leave category added successfully', 'status' => '400'));
        }else{
          echo json_encode(array('message' => 'Error in saving'));
        }
      }
    }
    function leave_application($param1, $param2){
      if($param1 == ''){
        if ($this->session->userdata('admin_login') != 1)
                redirect(base_url(), 'refresh');
              $this->load->model('Crud_model');
              $page_data['leave_application_list'] = $this->Crud_model->leave_application_list('1');
                $page_data['leave_list'] = $this->Crud_model->leave_list('1');
            $page_data['page_name'] = 'leave_application';
            $page_data['page_title'] = get_phrase('leave_application');
            $this->load->view('backend/index', $page_data);
      }
      if($param1 == 'add'){
        $data['school_id'] = '1';
        $data['category'] = $this->input->post('category');
        $data['from_date'] = date('Y-m-d', strtotime($this->input->post('from_date')));
        $data['to_date'] = date('Y-m-d', strtotime($this->input->post('to_date')));
        $data['reason'] = $this->input->post('reason');
        $this->load->model('Crud_model');
        $check = $this->Crud_model->leave_application_add($data);
        if($check){
          $msg = array('message' => 'Leave created successfully', 'status' => '400');
          echo json_encode($msg);
        }else{
          $msg = array('message' => 'Error in saving');
          echo json_encode($msg);
        }
      }
    }
    function leave_approval($param1, $param2){
      if($param1 == ''){
        if ($this->session->userdata('admin_login') != 1)
                redirect(base_url(), 'refresh');
                $this->load->model('Crud_model');
                $page_data['leave_list'] = $this->Crud_model->leave_list('1');
            $page_data['page_name'] = 'leave_approval';
            $page_data['page_title'] = get_phrase('leave_approval');
            $this->load->view('backend/index', $page_data);
      }
      if($param1 == 'add'){
        $data['school_id'] = '1';
        $data['name'] = $this->input->post('name');
        $this->load->model('Crud_model');
        $check = $this->Crud_model->leave_add($data);
        if($check){
          echo json_encode(array('message' => 'Leave category added successfully', 'status' => '400'));
        }else{
          echo json_encode(array('message' => 'Error in saving'));
        }
      }
    }
    /****MANAGE TEACHERS*****/
    function teacher($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
        if ($param1 == 'create') {
            $data['name']     = $this->input->post('name');
            $data['email']    = $this->input->post('email');
            $data['password'] = sha1($this->input->post('password'));
            if ($this->input->post('birthday') != null) {
                $data['birthday'] = $this->input->post('birthday');
            }
            if ($this->input->post('sex') != null) {
               $data['sex'] = $this->input->post('sex');
            }
            if ($this->input->post('address') != null) {
                $data['address'] = $this->input->post('address');
            }
            if ($this->input->post('phone') != null) {
                $data['phone'] = $this->input->post('phone');
            }
            $validation = email_validation($data['email']);
            if($validation == 1){
                $this->db->insert('teacher', $data);
                $teacher_id = $this->db->insert_id();
                move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/teacher_image/' . $teacher_id . '.jpg');
                $this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
                $this->email_model->account_opening_email('teacher', $data['email']); //SEND EMAIL ACCOUNT OPENING EMAIL
            }
            else{
                $this->session->set_flashdata('error_message' , get_phrase('this_email_id_is_not_available'));
            }

            redirect(base_url() . 'index.php?admin/teacher/', 'refresh');
        }
        if ($param1 == 'do_update') {
            $data['name']        = $this->input->post('name');
            $data['email']       = $this->input->post('email');

            if ($this->input->post('birthday') != null) {
                $data['birthday'] = $this->input->post('birthday');
            }
            else{
              $data['birthday'] = null;
            }
            if ($this->input->post('sex') != null) {
                $data['sex']         = $this->input->post('sex');
            }
            if ($this->input->post('address') != null) {
                $data['address']     = $this->input->post('address');
            }
            else{
              $data['address'] = null;
            }
            if ($this->input->post('phone') != null) {
               $data['phone']       = $this->input->post('phone');
            }
            else{
              $data['phone'] = null;
            }
            $validation = email_validation_for_edit($data['email'], $param2, 'teacher');
            if($validation == 1){
                $this->db->where('teacher_id', $param2);
                $this->db->update('teacher', $data);
                move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/teacher_image/' . $param2 . '.jpg');
                $this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
            }
            else{
                $this->session->set_flashdata('error_message' , get_phrase('this_email_id_is_not_available'));
            }

            redirect(base_url() . 'index.php?admin/teacher/', 'refresh');
        }
        else if ($param1 == 'personal_profile') {
            $page_data['personal_profile']   = true;
            $page_data['current_teacher_id'] = $param2;
        }
        else if ($param1 == 'edit') {
            $page_data['edit_data'] = $this->db->get_where('teacher', array(
                'teacher_id' => $param2
            ))->result_array();
        }
        if ($param1 == 'delete') {
            $this->db->where('teacher_id', $param2);
            $this->db->delete('teacher');
            $this->session->set_flashdata('flash_message' , get_phrase('data_deleted'));
            redirect(base_url() . 'index.php?admin/teacher/', 'refresh');
        }
        $page_data['teachers']   = $this->db->get('teacher')->result_array();
        $page_data['page_name']  = 'teacher';
        $page_data['page_title'] = get_phrase('manage_teacher');
        $this->load->view('backend/index', $page_data);
    }

    /****MANAGE SUBJECTS*****/
    function subject($param1 = '', $param2 = '' , $param3 = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
        if ($param1 == 'create') {
            $data['name']       = $this->input->post('name');
            $data['class_id']   = $this->input->post('class_id');
            $data['year']       = $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description;
            if ($this->input->post('teacher_id') != null) {
                $data['teacher_id'] = $this->input->post('teacher_id');
            }

            $this->db->insert('subject', $data);
            $this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
            redirect(base_url() . 'index.php?admin/subject/'.$data['class_id'], 'refresh');
        }
        if ($param1 == 'do_update') {
            $data['name']       = $this->input->post('name');
            $data['class_id']   = $this->input->post('class_id');
            $data['teacher_id'] = $this->input->post('teacher_id');
            $data['year']       = $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description;

            $this->db->where('subject_id', $param2);
            $this->db->update('subject', $data);
            $this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
            redirect(base_url() . 'index.php?admin/subject/'.$data['class_id'], 'refresh');
        } else if ($param1 == 'edit') {
            $page_data['edit_data'] = $this->db->get_where('subject', array(
                'subject_id' => $param2
            ))->result_array();
        }
        if ($param1 == 'delete') {
            $this->db->where('subject_id', $param2);
            $this->db->delete('subject');
            $this->session->set_flashdata('flash_message' , get_phrase('data_deleted'));
            redirect(base_url() . 'index.php?admin/subject/'.$param3, 'refresh');
        }
        $running_year = $this->db->get_where('settings', array('type' => 'running_year'))->row()->description;
		    $page_data['class_id']   = $param1;
        $page_data['subjects']   = $this->db->get_where('subject' , array('class_id' => $param1, 'year' => $running_year))->result_array();
        $page_data['page_name']  = 'subject';
        $page_data['page_title'] = get_phrase('manage_subject');
        $this->load->view('backend/index', $page_data);
    }

    /****MANAGE CLASSES*****/
    function classes($param1 = '', $param2 = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
        if ($param1 == 'create') {
            $data['name']         = $this->input->post('name');
            $data['teacher_id']   = $this->input->post('teacher_id');
            if ($this->input->post('name_numeric') != null) {
                $data['name_numeric'] = $this->input->post('name_numeric');
            }

            $this->db->insert('class', $data);
            $class_id = $this->db->insert_id();
            //create a section by default
            $data2['class_id']  =   $class_id;
            $data2['name']      =   'A';
            $data2['teacher_id']=$data['teacher_id'];
            $this->db->insert('section' , $data2);

            $this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
            redirect(base_url() . 'index.php?admin/classes/', 'refresh');
        }
        if ($param1 == 'do_update') {
            $data['name']         = $this->input->post('name');
            $data['teacher_id']   = $this->input->post('teacher_id');
            if ($this->input->post('name_numeric') != null) {
                $data['name_numeric'] = $this->input->post('name_numeric');
            }
            else{
               $data['name_numeric'] = null;
            }
            $this->db->where('class_id', $param2);
            $this->db->update('class', $data);
            $this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
            redirect(base_url() . 'index.php?admin/classes/', 'refresh');
        } else if ($param1 == 'edit') {
            $page_data['edit_data'] = $this->db->get_where('class', array(
                'class_id' => $param2
            ))->result_array();
        }
        if ($param1 == 'delete') {
            $this->db->where('class_id', $param2);
            $this->db->delete('class');
            $this->session->set_flashdata('flash_message' , get_phrase('data_deleted'));
            redirect(base_url() . 'index.php?admin/classes/', 'refresh');
        }
        $page_data['classes']    = $this->db->get('class')->result_array();
        $page_data['page_name']  = 'class';
        $page_data['page_title'] = get_phrase('manage_class');
        $this->load->view('backend/index', $page_data);
    }
     function get_subject($class_id)
    {
        $subject = $this->db->get_where('subject' , array(
            'class_id' => $class_id
        ))->result_array();
        foreach ($subject as $row) {
            echo '<option value="' . $row['subject_id'] . '">' . $row['name'] . '</option>';
        }
    }
    // ACADEMIC SYLLABUS
    function academic_syllabus($class_id = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
        // detect the first class
        if ($class_id == '')
            $class_id           =   $this->db->get('class')->first_row()->class_id;

        $page_data['page_name']  = 'academic_syllabus';
        $page_data['page_title'] = get_phrase('academic_syllabus');
        $page_data['class_id']   = $class_id;
        $this->load->view('backend/index', $page_data);
    }

    function upload_academic_syllabus()
    {
        $data['academic_syllabus_code'] =   substr(md5(rand(0, 1000000)), 0, 7);
        if ($this->input->post('description') != null) {
           $data['description'] = $this->input->post('description');
        }
        $data['title']                  =   $this->input->post('title');
        $data['class_id']               =   $this->input->post('class_id');
        $data['subject_id']             =   $this->input->post('subject_id');
        $data['uploader_type']          =   $this->session->userdata('login_type');
        $data['uploader_id']            =   $this->session->userdata('login_user_id');
        $data['year']                   =   $this->db->get_where('settings',array('type'=>'running_year'))->row()->description;
        $data['timestamp']              =   strtotime(date("Y-m-d H:i:s"));
        //uploading file using codeigniter upload library
        $files = $_FILES['file_name'];
        $this->load->library('upload');
        $config['upload_path']   =  'uploads/syllabus/';
        $config['allowed_types'] =  '*';
        $_FILES['file_name']['name']     = $files['name'];
        $_FILES['file_name']['type']     = $files['type'];
        $_FILES['file_name']['tmp_name'] = $files['tmp_name'];
        $_FILES['file_name']['size']     = $files['size'];
        $this->upload->initialize($config);
        $this->upload->do_upload('file_name');

        $data['file_name'] = $_FILES['file_name']['name'];

        $this->db->insert('academic_syllabus', $data);
        $this->session->set_flashdata('flash_message' , get_phrase('syllabus_uploaded'));
        redirect(base_url() . 'index.php?admin/academic_syllabus/' . $data['class_id'] , 'refresh');

    }

    function download_academic_syllabus($academic_syllabus_code)
    {
        $file_name = $this->db->get_where('academic_syllabus', array(
            'academic_syllabus_code' => $academic_syllabus_code
        ))->row()->file_name;
        $this->load->helper('download');
        $data = file_get_contents("uploads/syllabus/" . $file_name);
        $name = $file_name;
        force_download($name, $data);
    }

    function delete_academic_syllabus($academic_syllabus_code) {
      $file_name = $this->db->get_where('academic_syllabus', array(
          'academic_syllabus_code' => $academic_syllabus_code
      ))->row()->file_name;
      if (file_exists('uploads/syllabus/'.$file_name)) {
        unlink('uploads/syllabus/'.$file_name);
      }
      $this->db->where('academic_syllabus_code', $academic_syllabus_code);
      $this->db->delete('academic_syllabus');

      $this->session->set_flashdata('flash_message' , get_phrase('data_deleted'));
      redirect(base_url() . 'index.php?admin/academic_syllabus' , 'refresh');

    }

    /****MANAGE SECTIONS*****/
    function section($class_id = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
        // detect the first class
        if ($class_id == '')
            $class_id           =   $this->db->get('class')->first_row()->class_id;

        $page_data['page_name']  = 'section';
        $page_data['page_title'] = get_phrase('manage_sections');
        $page_data['class_id']   = $class_id;
        $this->load->view('backend/index', $page_data);
    }

    function sections($param1 = '' , $param2 = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
        if ($param1 == 'create') {
            $data['name']       =   $this->input->post('name');
            $data['class_id']   =   $this->input->post('class_id');
            $data['teacher_id'] =   $this->input->post('teacher_id');
            if ($this->input->post('nick_name') != null) {
               $data['nick_name'] = $this->input->post('nick_name');
            }
            $validation = duplication_of_section_on_create($data['class_id'], $data['name']);
            if($validation == 1){
                $this->db->insert('section' , $data);
                $this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
            }
            else{
                $this->session->set_flashdata('error_message' , get_phrase('duplicate_name_of_section_is_not_allowed'));
            }

            redirect(base_url() . 'index.php?admin/section/' . $data['class_id'] , 'refresh');
        }

        if ($param1 == 'edit') {
            $data['name']       =   $this->input->post('name');
            $data['class_id']   =   $this->input->post('class_id');
            $data['teacher_id'] =   $this->input->post('teacher_id');
            if ($this->input->post('nick_name') != null) {
                $data['nick_name'] = $this->input->post('nick_name');
            }
            else{
                $data['nick_name'] = null;
            }
            $validation = duplication_of_section_on_edit($param2, $data['class_id'], $data['name']);
            if ($validation == 1) {
               $this->db->where('section_id' , $param2);
               $this->db->update('section' , $data);
               $this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
            }
            else{
               $this->session->set_flashdata('error_message' , get_phrase('duplicate_name_of_section_is_not_allowed'));
            }

            redirect(base_url() . 'index.php?admin/section/' . $data['class_id'] , 'refresh');
        }

        if ($param1 == 'delete') {
            $this->db->where('section_id' , $param2);
            $this->db->delete('section');
            $this->session->set_flashdata('flash_message' , get_phrase('data_deleted'));
            redirect(base_url() . 'index.php?admin/section' , 'refresh');
        }
    }

    function get_class_section($class_id)
    {
        $sections = $this->db->get_where('section' , array(
            'class_id' => $class_id
        ))->result_array();
        foreach ($sections as $row) {
            echo '<option value="' . $row['section_id'] . '" >' . $row['name'] . '</option>';
        }
    }

    function get_class_subject($class_id)
    {
        $subjects = $this->db->get_where('subject' , array(
            'class_id' => $class_id
        ))->result_array();
        foreach ($subjects as $row) {
            echo '<option value="' . $row['subject_id'] . '">' . $row['name'] . '</option>';
        }
    }

    function get_class_students($class_id)
    {
        $students = $this->db->get_where('enroll' , array(
            'class_id' => $class_id , 'year' => $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description
        ))->result_array();
        foreach ($students as $row) {
            $name = $this->db->get_where('student' , array('student_id' => $row['student_id']))->row()->name;
            echo '<option value="' . $row['student_id'] . '">' . $name . '</option>';
        }
    }

    function get_class_students_mass($class_id)
    {
        $students = $this->db->get_where('enroll' , array(
            'class_id' => $class_id , 'year' => $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description
        ))->result_array();
        echo '<div class="form-group">
                <label class="col-sm-3 control-label">' . get_phrase('students') . '</label>
                <div class="col-sm-9">';
        foreach ($students as $row) {
             $name = $this->db->get_where('student' , array('student_id' => $row['student_id']))->row()->name;
            echo '<div class="checkbox">
                    <label><input type="checkbox" class="check" name="student_id[]" value="' . $row['student_id'] . '">' . $name .'</label>
                </div>';
        }
        echo '<br><button type="button" class="btn btn-default" onClick="select()">'.get_phrase('select_all').'</button>';
        echo '<button style="margin-left: 5px;" type="button" class="btn btn-default" onClick="unselect()"> '.get_phrase('select_none').' </button>';
        echo '</div></div>';
    }



    /****MANAGE EXAMS*****/
    function exam($param1 = '', $param2 = '' , $param3 = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
        if ($param1 == 'create') {
            $data['name']    = $this->input->post('name');
            $data['date']    = $this->input->post('date');
            $data['year']    = $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description;
            if ($this->input->post('comment') != null) {
                $data['comment'] = $this->input->post('comment');
            }
            $this->db->insert('exam', $data);
            $this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
            redirect(base_url() . 'index.php?admin/exam/', 'refresh');
        }
        if ($param1 == 'edit' && $param2 == 'do_update') {
            $data['name']    = $this->input->post('name');
            $data['date']    = $this->input->post('date');
            if ($this->input->post('comment') != null) {
                $data['comment'] = $this->input->post('comment');
            }
            else{
              $data['comment'] = null;
            }
            $data['year']    = $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description;

            $this->db->where('exam_id', $param3);
            $this->db->update('exam', $data);
            $this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
            redirect(base_url() . 'index.php?admin/exam/', 'refresh');
        }
        else if ($param1 == 'edit') {
            $page_data['edit_data'] = $this->db->get_where('exam', array(
                'exam_id' => $param2
            ))->result_array();
        }
        if ($param1 == 'delete') {
            $this->db->where('exam_id', $param2);
            $this->db->delete('exam');
            $this->session->set_flashdata('flash_message' , get_phrase('data_deleted'));
            redirect(base_url() . 'index.php?admin/exam/', 'refresh');
        }
        $running_year = $this->db->get_where('settings', array('type' => 'running_year'))->row()->description;
        $page_data['exams']      = $this->db->get_where('exam', array('year' => $running_year))->result_array();
        $page_data['page_name']  = 'exam';
        $page_data['page_title'] = get_phrase('manage_exam');
        $this->load->view('backend/index', $page_data);
    }

    /****** SEND EXAM MARKS VIA SMS ********/
    function exam_marks_sms($param1 = '' , $param2 = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');

        if ($param1 == 'send_sms') {

            $exam_id    =   $this->input->post('exam_id');
            $class_id   =   $this->input->post('class_id');
            $receiver   =   $this->input->post('receiver');
            if ($exam_id != '' && $class_id != '' && $receiver != '') {
            // get all the students of the selected class
            $students = $this->db->get_where('enroll' , array(
                'class_id' => $class_id,
                    'year' => $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description
            ))->result_array();
            // get the marks of the student for selected exam
            foreach ($students as $row) {
                if ($receiver == 'student')
                    $receiver_phone = $this->db->get_where('student' , array('student_id' => $row['student_id']))->row()->phone;
                if ($receiver == 'parent') {
                    $parent_id =  $this->db->get_where('student' , array('student_id' => $row['student_id']))->row()->parent_id;
                    if($parent_id != '' || $parent_id != null) {
                        $receiver_phone = $this->db->get_where('parent' , array('parent_id' => $row['parent_id']))->row()->phone;
                        if($receiver_phone == null){
                          $this->session->set_flashdata('error_message' , get_phrase('parent_phone_number_is_not_found'));
                        }
                    }
                }
                $running_year = $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description;
                $this->db->where('exam_id' , $exam_id);
                $this->db->where('student_id' , $row['student_id']);
                $this->db->where('year', $running_year);
                $marks = $this->db->get('mark')->result_array();

                $message = '';
                foreach ($marks as $row2) {
                    $subject       = $this->db->get_where('subject' , array('subject_id' => $row2['subject_id']))->row()->name;
                    $mark_obtained = $row2['mark_obtained'];
                    $message      .= $row2['student_id'] . $subject . ' : ' . $mark_obtained . ' , ';

                }
                // send sms
                $this->sms_model->send_sms( $message , $receiver_phone );
            }
            $this->session->set_flashdata('flash_message' , get_phrase('message_sent'));
          }
          else{
            $this->session->set_flashdata('error_message' , get_phrase('select_all_the_fields'));
          }
            redirect(base_url() . 'index.php?admin/exam_marks_sms' , 'refresh');
        }

        $page_data['page_name']  = 'exam_marks_sms';
        $page_data['page_title'] = get_phrase('send_marks_by_sms');
        $this->load->view('backend/index', $page_data);
    }

    /****MANAGE EXAM MARKS*****/
    function marks2($exam_id = '', $class_id = '', $subject_id = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');

        if ($this->input->post('operation') == 'selection') {
            $page_data['exam_id']    = $this->input->post('exam_id');
            $page_data['class_id']   = $this->input->post('class_id');
            $page_data['subject_id'] = $this->input->post('subject_id');

            if ($page_data['exam_id'] > 0 && $page_data['class_id'] > 0 && $page_data['subject_id'] > 0) {
                redirect(base_url() . 'index.php?admin/marks2/' . $page_data['exam_id'] . '/' . $page_data['class_id'] . '/' . $page_data['subject_id'], 'refresh');
            } else {
                $this->session->set_flashdata('mark_message', 'Choose exam, class and subject');
                redirect(base_url() . 'index.php?admin/marks2/', 'refresh');
            }
        }
        if ($this->input->post('operation') == 'update') {
            $students = $this->db->get_where('enroll' , array('class_id' => $class_id , 'year' => $running_year))->result_array();
            foreach($students as $row) {
                $data['mark_obtained'] = $this->input->post('mark_obtained_' . $row['student_id']);
                $data['comment']       = $this->input->post('comment_' . $row['student_id']);

                $this->db->where('mark_id', $this->input->post('mark_id_' . $row['student_id']));
                $this->db->update('mark', array('mark_obtained' => $data['mark_obtained'] , 'comment' => $data['comment']));
            }
            $this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
            redirect(base_url() . 'index.php?admin/marks2/' . $this->input->post('exam_id') . '/' . $this->input->post('class_id') . '/' . $this->input->post('subject_id'), 'refresh');
        }
        $page_data['exam_id']    = $exam_id;
        $page_data['class_id']   = $class_id;
        $page_data['subject_id'] = $subject_id;

        $page_data['page_info'] = 'Exam marks';

        $page_data['page_name']  = 'marks2';
        $page_data['page_title'] = get_phrase('manage_exam_marks');
        $this->load->view('backend/index', $page_data);
    }

    function marks_manage()
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
        $page_data['page_name']  =   'marks_manage';
        $page_data['page_title'] = get_phrase('manage_exam_marks');
        $this->load->view('backend/index', $page_data);
    }

    function marks_manage_view($exam_id = '' , $class_id = '' , $section_id = '' , $subject_id = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
        $page_data['exam_id']    =   $exam_id;
        $page_data['class_id']   =   $class_id;
        $page_data['subject_id'] =   $subject_id;
        $page_data['section_id'] =   $section_id;
        $page_data['page_name']  =   'marks_manage_view';
        $page_data['page_title'] = get_phrase('manage_exam_marks');
        $this->load->view('backend/index', $page_data);
    }

    function marks_selector()
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');

        $data['exam_id']    = $this->input->post('exam_id');
        $data['class_id']   = $this->input->post('class_id');
        $data['section_id'] = $this->input->post('section_id');
        $data['subject_id'] = $this->input->post('subject_id');
        $data['year']       = $this->db->get_where('settings' , array('type'=>'running_year'))->row()->description;
        if($data['class_id'] != '' && $data['exam_id'] != ''){
        $query = $this->db->get_where('mark' , array(
                    'exam_id' => $data['exam_id'],
                        'class_id' => $data['class_id'],
                            'section_id' => $data['section_id'],
                                'subject_id' => $data['subject_id'],
                                    'year' => $data['year']
                ));
        if($query->num_rows() < 1) {
            $students = $this->db->get_where('enroll' , array(
                'class_id' => $data['class_id'] , 'section_id' => $data['section_id'] , 'year' => $data['year']
            ))->result_array();
            foreach($students as $row) {
                $data['student_id'] = $row['student_id'];
                $this->db->insert('mark' , $data);
            }
        }
        redirect(base_url() . 'index.php?admin/marks_manage_view/' . $data['exam_id'] . '/' . $data['class_id'] . '/' . $data['section_id'] . '/' . $data['subject_id'] , 'refresh');
    }
    else{
        $this->session->set_flashdata('error_message' , get_phrase('select_all_the_fields'));
        $page_data['page_name']  =   'marks_manage';
        $page_data['page_title'] = get_phrase('manage_exam_marks');
        $this->load->view('backend/index', $page_data);
    }
}

    function marks_update($exam_id = '' , $class_id = '' , $section_id = '' , $subject_id = '')
    {
        if ($class_id != '' && $exam_id != '') {
        $running_year = $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description;
        $marks_of_students = $this->db->get_where('mark' , array(
            'exam_id' => $exam_id,
                'class_id' => $class_id,
                    'section_id' => $section_id,
                        'year' => $running_year,
                            'subject_id' => $subject_id
        ))->result_array();
        foreach($marks_of_students as $row) {
            $obtained_marks = $this->input->post('marks_obtained_'.$row['mark_id']);
            $comment = $this->input->post('comment_'.$row['mark_id']);
            $this->db->where('mark_id' , $row['mark_id']);
            $this->db->update('mark' , array('mark_obtained' => $obtained_marks , 'comment' => $comment));
        }
        $this->session->set_flashdata('flash_message' , get_phrase('marks_updated'));
        redirect(base_url().'index.php?admin/marks_manage_view/'.$exam_id.'/'.$class_id.'/'.$section_id.'/'.$subject_id , 'refresh');
    }
    else{
        $this->session->set_flashdata('error_message' , get_phrase('select_all_the_fields'));
        $page_data['page_name']  =   'marks_manage';
        $page_data['page_title'] = get_phrase('manage_exam_marks');
        $this->load->view('backend/index', $page_data);
    }
}
    function marks_get_subject($class_id)
    {
        $page_data['class_id'] = $class_id;
        $this->load->view('backend/admin/marks_get_subject' , $page_data);
    }

    // TABULATION SHEET
    function tabulation_sheet($class_id = '' , $exam_id = '') {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');

        if ($this->input->post('operation') == 'selection') {
            $page_data['exam_id']    = $this->input->post('exam_id');
            $page_data['class_id']   = $this->input->post('class_id');

            if ($page_data['exam_id'] > 0 && $page_data['class_id'] > 0) {
                redirect(base_url() . 'index.php?admin/tabulation_sheet/' . $page_data['class_id'] . '/' . $page_data['exam_id'] , 'refresh');
            } else {
                $this->session->set_flashdata('mark_message', 'Choose class and exam');
                redirect(base_url() . 'index.php?admin/tabulation_sheet/', 'refresh');
            }
        }
        $page_data['exam_id']    = $exam_id;
        $page_data['class_id']   = $class_id;

        $page_data['page_info'] = 'Exam marks';

        $page_data['page_name']  = 'tabulation_sheet';
        $page_data['page_title'] = get_phrase('tabulation_sheet');
        $this->load->view('backend/index', $page_data);

    }

    function tabulation_sheet_print_view($class_id , $exam_id) {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
        $page_data['class_id'] = $class_id;
        $page_data['exam_id']  = $exam_id;
        $this->load->view('backend/admin/tabulation_sheet_print_view' , $page_data);
    }


    /****MANAGE GRADES*****/
    function grade($param1 = '', $param2 = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
        if ($param1 == 'create') {
            $data['name']        = $this->input->post('name');
            $data['grade_point'] = $this->input->post('grade_point');
            $data['mark_from']   = $this->input->post('mark_from');
            $data['mark_upto']   = $this->input->post('mark_upto');
            if ($this->input->post('comment') != null) {
                $data['comment'] = $this->input->post('comment');
            }

            $this->db->insert('grade', $data);
            $this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
            redirect(base_url() . 'index.php?admin/grade/', 'refresh');
        }
        if ($param1 == 'do_update') {
            $data['name']        = $this->input->post('name');
            $data['grade_point'] = $this->input->post('grade_point');
            $data['mark_from']   = $this->input->post('mark_from');
            $data['mark_upto']   = $this->input->post('mark_upto');
            if ($this->input->post('comment') != null) {
                $data['comment'] = $this->input->post('comment');
            }
            else{
              $data['comment'] = null;
            }

            $this->db->where('grade_id', $param2);
            $this->db->update('grade', $data);
            $this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
            redirect(base_url() . 'index.php?admin/grade/', 'refresh');
        } else if ($param1 == 'edit') {
            $page_data['edit_data'] = $this->db->get_where('grade', array(
                'grade_id' => $param2
            ))->result_array();
        }
        if ($param1 == 'delete') {
            $this->db->where('grade_id', $param2);
            $this->db->delete('grade');
            $this->session->set_flashdata('flash_message' , get_phrase('data_deleted'));
            redirect(base_url() . 'index.php?admin/grade/', 'refresh');
        }
        $page_data['grades']     = $this->db->get('grade')->result_array();
        $page_data['page_name']  = 'grade';
        $page_data['page_title'] = get_phrase('manage_grade');
        $this->load->view('backend/index', $page_data);
    }

    /**********MANAGING CLASS ROUTINE******************/
    function class_routine($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
        if ($param1 == 'create') {

            if($this->input->post('class_id') != null){
               $data['class_id']       = $this->input->post('class_id');
            }

            $data['section_id']     = $this->input->post('section_id');
            $data['subject_id']     = $this->input->post('subject_id');
            $data['time_start']     = $this->input->post('time_start') + (12 * ($this->input->post('starting_ampm') - 1));
            $data['time_end']       = $this->input->post('time_end') + (12 * ($this->input->post('ending_ampm') - 1));
            $data['time_start_min'] = $this->input->post('time_start_min');
            $data['time_end_min']   = $this->input->post('time_end_min');
            $data['day']            = $this->input->post('day');
            $data['year']           = $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description;
            // checking duplication
            $array = array(
               'section_id'    => $data['section_id'],
               'class_id'      => $data['class_id'],
               'time_start'    => $data['time_start'],
               'time_end'      => $data['time_end'],
               'time_start_min'=> $data['time_start_min'],
               'time_end_min'  => $data['time_end_min'],
               'day'           => $data['day'],
               'year'          => $data['year']
            );
            $validation = duplication_of_class_routine_on_create($array);
            if ($validation == 1) {
                $this->db->insert('class_routine', $data);
                $this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
            }
            else{
                $this->session->set_flashdata('error_message' , get_phrase('time_conflicts'));
            }

            redirect(base_url() . 'index.php?admin/class_routine_add/', 'refresh');
        }
        if ($param1 == 'do_update') {
            $data['class_id']       = $this->input->post('class_id');
            if($this->input->post('section_id') != '') {
                $data['section_id'] = $this->input->post('section_id');
            }
            $data['subject_id']     = $this->input->post('subject_id');
            $data['time_start']     = $this->input->post('time_start') + (12 * ($this->input->post('starting_ampm') - 1));
            $data['time_end']       = $this->input->post('time_end') + (12 * ($this->input->post('ending_ampm') - 1));
            $data['time_start_min'] = $this->input->post('time_start_min');
            $data['time_end_min']   = $this->input->post('time_end_min');
            $data['day']            = $this->input->post('day');
            $data['year']           = $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description;
            if ($data['subject_id'] != '') {
            // checking duplication
            $array = array(
               'section_id'    => $data['section_id'],
               'class_id'      => $data['class_id'],
               'time_start'    => $data['time_start'],
               'time_end'      => $data['time_end'],
               'time_start_min'=> $data['time_start_min'],
               'time_end_min'  => $data['time_end_min'],
               'day'           => $data['day'],
               'year'          => $data['year']
            );
            $validation = duplication_of_class_routine_on_edit($array, $param2);

            if ($validation == 1) {
                $this->db->where('class_routine_id', $param2);
                $this->db->update('class_routine', $data);
                $this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
            }
            else{
                $this->session->set_flashdata('error_message' , get_phrase('time_conflicts'));
            }
          }
          else{
            $this->session->set_flashdata('error_message' , get_phrase('subject_is_not_found'));
          }

            redirect(base_url() . 'index.php?admin/class_routine_view/' . $data['class_id'], 'refresh');
        }
        else if ($param1 == 'edit') {
            $page_data['edit_data'] = $this->db->get_where('class_routine', array(
                'class_routine_id' => $param2
            ))->result_array();
        }
        if ($param1 == 'delete') {
            $class_id = $this->db->get_where('class_routine' , array('class_routine_id' => $param2))->row()->class_id;
            $this->db->where('class_routine_id', $param2);
            $this->db->delete('class_routine');
            $this->session->set_flashdata('flash_message' , get_phrase('data_deleted'));
            redirect(base_url() . 'index.php?admin/class_routine_view/' . $class_id, 'refresh');
        }

    }

    function class_routine_add()
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
        $page_data['page_name']  = 'class_routine_add';
        $page_data['page_title'] = get_phrase('add_class_routine');
        $this->load->view('backend/index', $page_data);
    }

    function class_routine_view($class_id)
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
        $page_data['page_name']  = 'class_routine_view';
        $page_data['class_id']  =   $class_id;
        $page_data['page_title'] = get_phrase('class_routine');
        $this->load->view('backend/index', $page_data);
    }

    function class_routine_print_view($class_id , $section_id)
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect('login', 'refresh');
        $page_data['class_id']   =   $class_id;
        $page_data['section_id'] =   $section_id;
        $this->load->view('backend/admin/class_routine_print_view' , $page_data);
    }

    function get_class_section_subject($class_id)
    {
        $page_data['class_id'] = $class_id;
        $this->load->view('backend/admin/class_routine_section_subject_selector' , $page_data);
    }

    function section_subject_edit($class_id , $class_routine_id)
    {
        $page_data['class_id']          =   $class_id;
        $page_data['class_routine_id']  =   $class_routine_id;
        $this->load->view('backend/admin/class_routine_section_subject_edit' , $page_data);
    }

    function manage_attendance()
    {
        if($this->session->userdata('admin_login')!=1)
            redirect(base_url() , 'refresh');

        $page_data['page_name']  =  'manage_attendance';
        $page_data['page_title'] =  get_phrase('manage_attendance_of_class');
        $this->load->view('backend/index', $page_data);
    }

    function manage_attendance_view($class_id = '' , $section_id = '' , $timestamp = '')
    {
        if($this->session->userdata('admin_login')!=1)
            redirect(base_url() , 'refresh');
        $class_name = $this->db->get_where('class' , array(
            'class_id' => $class_id
        ))->row()->name;
        $page_data['class_id'] = $class_id;
        $page_data['timestamp'] = $timestamp;
        $page_data['page_name'] = 'manage_attendance_view';
        $section_name = $this->db->get_where('section' , array(
            'section_id' => $section_id
        ))->row()->name;
        $page_data['section_id'] = $section_id;
        $page_data['page_title'] = get_phrase('manage_attendance_of_class') . ' ' . $class_name . ' : ' . get_phrase('section') . ' ' . $section_name;
        $this->load->view('backend/index', $page_data);
    }
    function get_section($class_id) {
          $page_data['class_id'] = $class_id;
          $this->load->view('backend/admin/manage_attendance_section_holder' , $page_data);
    }
    function attendance_selector()
    {
        $data['class_id']   = $this->input->post('class_id');
        $data['year']       = $this->input->post('year');
        $data['timestamp']  = strtotime($this->input->post('timestamp'));
        $data['section_id'] = $this->input->post('section_id');
        $query = $this->db->get_where('attendance' ,array(
            'class_id'=>$data['class_id'],
                'section_id'=>$data['section_id'],
                    'year'=>$data['year'],
                        'timestamp'=>$data['timestamp']
        ));
        if($query->num_rows() < 1) {
            $students = $this->db->get_where('enroll' , array(
                'class_id' => $data['class_id'] , 'section_id' => $data['section_id'] , 'year' => $data['year']
            ))->result_array();

            foreach($students as $row) {
                $attn_data['class_id']   = $data['class_id'];
                $attn_data['year']       = $data['year'];
                $attn_data['timestamp']  = $data['timestamp'];
                $attn_data['section_id'] = $data['section_id'];
                $attn_data['student_id'] = $row['student_id'];
                $this->db->insert('attendance' , $attn_data);
            }

        }
        redirect(base_url().'index.php?admin/manage_attendance_view/'.$data['class_id'].'/'.$data['section_id'].'/'.$data['timestamp'],'refresh');
    }

    function attendance_update($class_id = '' , $section_id = '' , $timestamp = '')
    {
        $running_year = $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description;
        $active_sms_service = $this->db->get_where('settings' , array('type' => 'active_sms_service'))->row()->description;
        $attendance_of_students = $this->db->get_where('attendance' , array(
            'class_id'=>$class_id,'section_id'=>$section_id,'year'=>$running_year,'timestamp'=>$timestamp
        ))->result_array();
        foreach($attendance_of_students as $row) {
            $attendance_status = $this->input->post('status_'.$row['attendance_id']);
            $this->db->where('attendance_id' , $row['attendance_id']);
            $this->db->update('attendance' , array('status' => $attendance_status));

            if ($attendance_status == 2) {

                if ($active_sms_service != '' || $active_sms_service != 'disabled') {
                    $student_name   = $this->db->get_where('student' , array('student_id' => $row['student_id']))->row()->name;
                    $parent_id      = $this->db->get_where('student' , array('student_id' => $row['student_id']))->row()->parent_id;
                    $message        = 'Your child' . ' ' . $student_name . 'is absent today.';
                    if($parent_id != null && $parent_id != 0){
                        $receiver_phone = $this->db->get_where('parent' , array('parent_id' => $parent_id))->row()->phone;
                        if($receiver_phone != '' || $receiver_phone != null){
                            $this->sms_model->send_sms($message,$receiver_phone);
                        }
                        else{
                            $this->session->set_flashdata('error_message' , get_phrase('parent_phone_number_is_not_found'));
                        }
                    }
                    else{
                        $this->session->set_flashdata('error_message' , get_phrase('parent_phone_number_is_not_found'));
                    }
                }
            }
        }
        $this->session->set_flashdata('flash_message' , get_phrase('attendance_updated'));
        redirect(base_url().'index.php?admin/manage_attendance_view/'.$class_id.'/'.$section_id.'/'.$timestamp , 'refresh');
    }

	/****** DAILY ATTENDANCE *****************/
	function manage_attendance2($date='',$month='',$year='',$class_id='' , $section_id = '' , $session = '')
	{
		if($this->session->userdata('admin_login')!=1)
            redirect(base_url() , 'refresh');

        $active_sms_service = $this->db->get_where('settings' , array('type' => 'active_sms_service'))->row()->description;
        $running_year = $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description;


		if($_POST)
		{
			// Loop all the students of $class_id
            $this->db->where('class_id' , $class_id);
            if($section_id != '') {
                $this->db->where('section_id' , $section_id);
            }
            //$session = base64_decode( urldecode( $session ) );
            $this->db->where('year' , $session);
            $students = $this->db->get('enroll')->result_array();
            foreach ($students as $row)
            {
                $attendance_status  =   $this->input->post('status_' . $row['student_id']);

                $this->db->where('student_id' , $row['student_id']);
                $this->db->where('date' , $date);
                $this->db->where('year' , $year);
                $this->db->where('class_id' , $row['class_id']);
                if($row['section_id'] != '' && $row['section_id'] != 0) {
                    $this->db->where('section_id' , $row['section_id']);
                }
                $this->db->where('session' , $session);

                $this->db->update('attendance' , array('status' => $attendance_status));

                if ($attendance_status == 2) {

                    if ($active_sms_service != '' || $active_sms_service != 'disabled') {
                        $student_name   = $this->db->get_where('student' , array('student_id' => $row['student_id']))->row()->name;
                        $parent_id      = $this->db->get_where('student' , array('student_id' => $row['student_id']))->row()->parent_id;
                        $receiver_phone = $this->db->get_where('parent' , array('parent_id' => $parent_id))->row()->phone;
                        $message        = 'Your child' . ' ' . $student_name . 'is absent today.';
                        $this->sms_model->send_sms($message,$receiver_phone);
                    }
                }

            }

			$this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
			redirect(base_url() . 'index.php?admin/manage_attendance/'.$date.'/'.$month.'/'.$year.'/'.$class_id.'/'.$section_id.'/'.$session , 'refresh');
		}
        $page_data['date']       =	$date;
        $page_data['month']      =	$month;
        $page_data['year']       =	$year;
        $page_data['class_id']   =  $class_id;
        $page_data['section_id'] =  $section_id;
        $page_data['session']    =  $session;

        $page_data['page_name']  =	'manage_attendance';
        $page_data['page_title'] =	get_phrase('manage_daily_attendance');
		$this->load->view('backend/index', $page_data);
	}
	function attendance_selector2()
	{
        //$session = $this->input->post('session');
        //$encoded_session = urlencode( base64_encode( $session ) );
		redirect(base_url() . 'index.php?admin/manage_attendance/'.$this->input->post('date').'/'.
					$this->input->post('month').'/'.
						$this->input->post('year').'/'.
							$this->input->post('class_id').'/'.
                                $this->input->post('section_id').'/'.
                                    $this->input->post('session') , 'refresh');
	}
        ///////ATTENDANCE REPORT /////
     function attendance_report() {
         $page_data['month']        = date('m');
         $page_data['page_name']    = 'attendance_report';
         $page_data['page_title']   = get_phrase('attendance_report');
         $this->load->view('backend/index',$page_data);
     }
     function attendance_report_view($class_id = '', $section_id = '', $month = '', $sessional_year = '')
     {
         if($this->session->userdata('admin_login')!=1)
            redirect(base_url() , 'refresh');

        $class_name                     = $this->db->get_where('class', array('class_id' => $class_id))->row()->name;
        $section_name                   = $this->db->get_where('section', array('section_id' => $section_id))->row()->name;
        $page_data['class_id']          = $class_id;
        $page_data['section_id']        = $section_id;
        $page_data['month']             = $month;
        $page_data['sessional_year']    = $sessional_year;
        $page_data['page_name']         = 'attendance_report_view';
        $page_data['page_title']        = get_phrase('attendance_report_of_class') . ' ' . $class_name . ' : ' . get_phrase('section') . ' ' . $section_name;
        $this->load->view('backend/index', $page_data);
     }
     function attendance_report_print_view($class_id ='' , $section_id = '' , $month = '', $sessional_year = '') {
          if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');

        $page_data['class_id']          = $class_id;
        $page_data['section_id']        = $section_id;
        $page_data['month']             = $month;
        $page_data['sessional_year']    = $sessional_year;
        $this->load->view('backend/admin/attendance_report_print_view' , $page_data);
    }

    function attendance_report_selector()
    {   if($this->input->post('class_id') == '' || $this->input->post('sessional_year') == '') {
            $this->session->set_flashdata('error_message' , get_phrase('please_make_sure_class_and_sessional_year_are_selected'));
            redirect(base_url() . 'index.php?admin/attendance_report', 'refresh');
        }
        $data['class_id']       = $this->input->post('class_id');
        $data['section_id']     = $this->input->post('section_id');
        $data['month']          = $this->input->post('month');
        $data['sessional_year'] = $this->input->post('sessional_year');
        redirect(base_url() . 'index.php?admin/attendance_report_view/' . $data['class_id'] . '/' . $data['section_id'] . '/' . $data['month'] . '/' . $data['sessional_year'], 'refresh');
    }

    /******MANAGE BILLING / INVOICES WITH STATUS*****/
    function invoice($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');

        if ($param1 == 'create') {
            $data['student_id']         = $this->input->post('student_id');
            $data['title']              = $this->input->post('title');
            $data['amount']             = $this->input->post('amount');
            $data['amount_paid']        = $this->input->post('amount_paid');
            $data['due']                = $data['amount'] - $data['amount_paid'];
            $data['status']             = $this->input->post('status');
            $data['creation_timestamp'] = strtotime($this->input->post('date'));
            $data['year']               = $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description;
            if ($this->input->post('description') != null) {
                $data['description']    = $this->input->post('description');
            }

            $this->db->insert('invoice', $data);
            $invoice_id = $this->db->insert_id();

            $data2['invoice_id']        =   $invoice_id;
            $data2['student_id']        =   $this->input->post('student_id');
            $data2['title']             =   $this->input->post('title');
            $data2['payment_type']      =  'income';
            $data2['method']            =   $this->input->post('method');
            $data2['amount']            =   $this->input->post('amount_paid');
            $data2['timestamp']         =   strtotime($this->input->post('date'));
            $data2['year']              =  $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description;
            if ($this->input->post('description') != null) {
                $data2['description']    = $this->input->post('description');
            }
            $this->db->insert('payment' , $data2);

            $this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
            redirect(base_url() . 'index.php?admin/student_payment', 'refresh');
        }

        if ($param1 == 'create_mass_invoice') {
            foreach ($this->input->post('student_id') as $id) {

                $data['student_id']         = $id;
                $data['title']              = $this->input->post('title');
                $data['description']        = $this->input->post('description');
                $data['amount']             = $this->input->post('amount');
                $data['amount_paid']        = $this->input->post('amount_paid');
                $data['due']                = $data['amount'] - $data['amount_paid'];
                $data['status']             = $this->input->post('status');
                $data['creation_timestamp'] = strtotime($this->input->post('date'));
                $data['year']               = $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description;

                $this->db->insert('invoice', $data);
                $invoice_id = $this->db->insert_id();

                $data2['invoice_id']        =   $invoice_id;
                $data2['student_id']        =   $id;
                $data2['title']             =   $this->input->post('title');
                $data2['description']       =   $this->input->post('description');
                $data2['payment_type']      =  'income';
                $data2['method']            =   $this->input->post('method');
                $data2['amount']            =   $this->input->post('amount_paid');
                $data2['timestamp']         =   strtotime($this->input->post('date'));
                $data2['year']               =   $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description;

                $this->db->insert('payment' , $data2);
            }

            $this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
            redirect(base_url() . 'index.php?admin/student_payment', 'refresh');
        }

        if ($param1 == 'do_update') {
            $data['student_id']         = $this->input->post('student_id');
            $data['title']              = $this->input->post('title');
            $data['description']        = $this->input->post('description');
            $data['amount']             = $this->input->post('amount');
            $data['status']             = $this->input->post('status');
            $data['creation_timestamp'] = strtotime($this->input->post('date'));

            $this->db->where('invoice_id', $param2);
            $this->db->update('invoice', $data);
            $this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
            redirect(base_url() . 'index.php?admin/income', 'refresh');
        } else if ($param1 == 'edit') {
            $page_data['edit_data'] = $this->db->get_where('invoice', array(
                'invoice_id' => $param2
            ))->result_array();
        }
        if ($param1 == 'take_payment') {
            $data['invoice_id']   =   $this->input->post('invoice_id');
            $data['student_id']   =   $this->input->post('student_id');
            $data['title']        =   $this->input->post('title');
            $data['description']  =   $this->input->post('description');
            $data['payment_type'] =   'income';
            $data['method']       =   $this->input->post('method');
            $data['amount']       =   $this->input->post('amount');
            $data['timestamp']    =   strtotime($this->input->post('timestamp'));
            $data['year']         =   $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description;
            $this->db->insert('payment' , $data);

            $status['status']   =   $this->input->post('status');
            $this->db->where('invoice_id' , $param2);
            $this->db->update('invoice' , array('status' => $status['status']));

            $data2['amount_paid']   =   $this->input->post('amount');
            $data2['status']        =   $this->input->post('status');
            $this->db->where('invoice_id' , $param2);
            $this->db->set('amount_paid', 'amount_paid + ' . $data2['amount_paid'], FALSE);
            $this->db->set('due', 'due - ' . $data2['amount_paid'], FALSE);
            $this->db->update('invoice');

            $this->session->set_flashdata('flash_message' , get_phrase('payment_successfull'));
            redirect(base_url() . 'index.php?admin/income/', 'refresh');
        }

        if ($param1 == 'delete') {
            $this->db->where('invoice_id', $param2);
            $this->db->delete('invoice');
            $this->session->set_flashdata('flash_message' , get_phrase('data_deleted'));
            redirect(base_url() . 'index.php?admin/income', 'refresh');
        }
        $page_data['page_name']  = 'invoice';
        $page_data['page_title'] = get_phrase('manage_invoice/payment');
        $this->db->order_by('creation_timestamp', 'desc');
        $page_data['invoices'] = $this->db->get('invoice')->result_array();
        $this->load->view('backend/index', $page_data);
    }

    /**********ACCOUNTING********************/
    function income($param1 = 'invoices' , $param2 = '')
    {
       if ($this->session->userdata('admin_login') != 1)
            redirect('login', 'refresh');

        if ($param2 == 'filter_history')
            $page_data['student_id'] = $this->input->post('student_id');
        else
            $page_data['student_id'] = 'all';

        $page_data['page_name']  = 'income';
        $page_data['page_title'] = get_phrase('student_payments');
        $this->db->order_by('creation_timestamp', 'desc');
        $page_data['invoices'] = $this->db->get('invoice')->result_array();
        $page_data['active_tab']  = $param1;
        $this->load->view('backend/index', $page_data);
    }

    function student_payment($param1 = '' , $param2 = '' , $param3 = '') {

        if ($this->session->userdata('admin_login') != 1)
            redirect('login', 'refresh');
        $page_data['page_name']  = 'student_payment';
        $page_data['page_title'] = get_phrase('create_student_payment');
        $this->load->view('backend/index', $page_data);
    }

    function expense($param1 = '' , $param2 = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect('login', 'refresh');
        if ($param1 == 'create') {
            $data['title']               =   $this->input->post('title');
            $data['expense_category_id'] =   $this->input->post('expense_category_id');
            $data['payment_type']        =   'expense';
            $data['method']              =   $this->input->post('method');
            $data['amount']              =   $this->input->post('amount');
            $data['timestamp']           =   strtotime($this->input->post('timestamp'));
            $data['year']                =   $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description;
            if ($this->input->post('description') != null) {
                $data['description']     =   $this->input->post('description');
            }
            $this->db->insert('payment' , $data);
            $this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
            redirect(base_url() . 'index.php?admin/expense', 'refresh');
        }

        if ($param1 == 'edit') {
            $data['title']               =   $this->input->post('title');
            $data['expense_category_id'] =   $this->input->post('expense_category_id');
            $data['payment_type']        =   'expense';
            $data['method']              =   $this->input->post('method');
            $data['amount']              =   $this->input->post('amount');
            $data['timestamp']           =   strtotime($this->input->post('timestamp'));
            $data['year']                =   $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description;
            if ($this->input->post('description') != null) {
                $data['description']     =   $this->input->post('description');
            }
            else{
                $data['description']     =   null;
            }
            $this->db->where('payment_id' , $param2);
            $this->db->update('payment' , $data);
            $this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
            redirect(base_url() . 'index.php?admin/expense', 'refresh');
        }

        if ($param1 == 'delete') {
            $this->db->where('payment_id' , $param2);
            $this->db->delete('payment');
            $this->session->set_flashdata('flash_message' , get_phrase('data_deleted'));
            redirect(base_url() . 'index.php?admin/expense', 'refresh');
        }

        $page_data['page_name']  = 'expense';
        $page_data['page_title'] = get_phrase('expenses');
        $this->load->view('backend/index', $page_data);
    }

    function expense_category($param1 = '' , $param2 = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect('login', 'refresh');
        if ($param1 == 'create') {
            $data['name']   =   $this->input->post('name');
            $this->db->insert('expense_category' , $data);
            $this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
            redirect(base_url() . 'index.php?admin/expense_category');
        }
        if ($param1 == 'edit') {
            $data['name']   =   $this->input->post('name');
            $this->db->where('expense_category_id' , $param2);
            $this->db->update('expense_category' , $data);
            $this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
            redirect(base_url() . 'index.php?admin/expense_category');
        }
        if ($param1 == 'delete') {
            $this->db->where('expense_category_id' , $param2);
            $this->db->delete('expense_category');
            $this->session->set_flashdata('flash_message' , get_phrase('data_deleted'));
            redirect(base_url() . 'index.php?admin/expense_category');
        }

        $page_data['page_name']  = 'expense_category';
        $page_data['page_title'] = get_phrase('expense_category');
        $this->load->view('backend/index', $page_data);
    }

    /**********MANAGE LIBRARY / BOOKS********************/
    function book($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect('login', 'refresh');
        if ($param1 == 'create') {
            $data['name']        = $this->input->post('name');
            $data['class_id']    = $this->input->post('class_id');
            if ($this->input->post('description') != null) {
               $data['description'] = $this->input->post('description');
            }
            if ($this->input->post('price') != null) {
               $data['price'] = $this->input->post('price');
            }
            if ($this->input->post('author') != null) {
               $data['author'] = $this->input->post('author');
            }


            $this->db->insert('book', $data);
            $this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
            redirect(base_url() . 'index.php?admin/book', 'refresh');
        }
        if ($param1 == 'do_update') {
            $data['name']        = $this->input->post('name');
            $data['class_id']    = $this->input->post('class_id');
            if ($this->input->post('description') != null) {
               $data['description'] = $this->input->post('description');
            }
            else{
               $data['description'] = null;
            }
            if ($this->input->post('price') != null) {
               $data['price'] = $this->input->post('price');
            }
            else{
                $data['price'] = null;
            }
            if ($this->input->post('author') != null) {
               $data['author'] = $this->input->post('author');
            }
            else{
               $data['author'] = null;
            }
            $this->db->where('book_id', $param2);
            $this->db->update('book', $data);
            $this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
            redirect(base_url() . 'index.php?admin/book', 'refresh');
        } else if ($param1 == 'edit') {
            $page_data['edit_data'] = $this->db->get_where('book', array(
                'book_id' => $param2
            ))->result_array();
        }
        if ($param1 == 'delete') {
            $this->db->where('book_id', $param2);
            $this->db->delete('book');
            $this->session->set_flashdata('flash_message' , get_phrase('data_deleted'));
            redirect(base_url() . 'index.php?admin/book', 'refresh');
        }
        $page_data['books']      = $this->db->get('book')->result_array();
        $page_data['page_name']  = 'book';
        $page_data['page_title'] = get_phrase('manage_library_books');
        $this->load->view('backend/index', $page_data);

    }
    /**********MANAGE TRANSPORT / VEHICLES / ROUTES********************/
    function vehicle($param1 = '', $param2 = ''){
        if ($this->session->userdata('admin_login') != 1)
        redirect(base_url(), 'refresh');
        if ($param1 == ''){
          $page_data['page_name'] = 'transport_vehicle';
          $page_data['page_title'] = get_phrase('add_vehicle');
          $this->load->view('backend/index', $page_data);
        }
      if ($param1 == 'add'){
          $data['vehicleNumber'] = $this->input->post('vehicleNumber');
          $data['seats'] = $this->input->post('seats');
          $data['max'] = $this->input->post('max');
          $data['type'] = $this->input->post('type');
          $data['contactPerson'] = $this->input->post('contactPerson');
          $date = $this->input->post('insuranceDate');
          $date = strtotime($date);
          $date = date('Y-m-d', $date);
          $data['insuranceDate'] = $date;
          $this->load->model('Crud_model');
          $duplicate = $this->Crud_model->vehicle_check($data['vehicleNumber']);
          if($duplicate > 0){
            $data = array(
              'message' => 'Vehicle with same number present'
            );
            echo json_encode($data);
          }else{
            $check = $this->Crud_model->vehicle_add($data, $vNumber);
            if($check){
              $data = array(
                'message' => 'Vehicle added successfully'
              );
              echo json_encode($data);
            }else{
              $data = array(
                'message' => 'Error please contact administrator'
              );
              echo json_encode($data);
            }
          }
      }
    }
    function driver($param1 = '', $param2 = '') {
        if ($this->session->userdata('admin_login') != 1)
        redirect(base_url(), 'refresh');
        $page_data['page_name'] = 'transport_driver';
        $page_data['page_title'] = get_phrase('add_driver');
        $this->load->view('backend/index', $page_data);
    }
    function route() {
        if($this->session->userdata('admin_login') != 1)
            redirect('login', 'refresh');
        $page_data['page_name'] = 'transport_route';
        $page_data['page_title'] = get_phrase('add_route');
        $this->load->view('backend/index', $page_data);
    }
    function fare(){
      if($this->session->userdata('admin_login') != 1)
          redirect('login', 'refresh');
      $page_data['page_name'] = 'transport_fare';
      $page_data['page_title'] = get_phrase('add_fare');
      $this->load->view('backend/index', $page_data);
    }
    function destination () {
        if($this->session->userdata('admin_login') != 1)
            redirect('login', 'refresh');
        $page_data['page_name'] = 'transport_destination';
        $page_data['page_title'] = get_phrase('add_destination');
        $this->load->view('backend/index', $page_data);
    }
    function transport_allocation () {
        if($this->session->userdata('admin_login') != 1)
            redirect('login', 'refresh');
        $page_data['page_name'] = 'transport_allocation';
        $page_data['page_title'] = get_phrase('transport_allocation');
        $this->load->view('backend/index', $page_data);
    }
    function fee_collection () {
        if($this->session->userdata('admin_login') != 1)
            redirect('login', 'refresh');
        $page_data['page_name'] = 'transport_fee_collection';
        $page_data['page_title'] = get_phrase('transport_fee_collection');
        $this->load->view('backend/index', $page_data);
    }
    function transport_import () {
        if($this->session->userdata('admin_login') != 1)
            redirect('login', 'refresh');
        $page_data['page_name'] = 'transport_import';
        $page_data['page_title'] = get_phrase('transport_allocation_import');
        $this->load->view('backend/index', $page_data);
    }
    function transport_alert () {
        if($this->session->userdata('admin_login') != 1)
            redirect('login', 'refresh');
        $page_data['page_name'] = 'transport_alert';
        $page_data['page_title'] = get_phrase('SMS_alert');
        $this->load->view('backend/index', $page_data);
    }
    /**********MANAGE DORMITORY / HOSTELS / ROOMS ********************/
    function dormitory($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect('login', 'refresh');
        if ($param1 == 'create') {
            $data['name']           = $this->input->post('name');
            $data['number_of_room'] = $this->input->post('number_of_room');
            if ($this->input->post('description') != null) {
                $data['description']    = $this->input->post('description');
            }

            $this->db->insert('dormitory', $data);
            $this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
            redirect(base_url() . 'index.php?admin/dormitory', 'refresh');
        }
        if ($param1 == 'do_update') {
            $data['name']           = $this->input->post('name');
            $data['number_of_room'] = $this->input->post('number_of_room');
            if ($this->input->post('description') != null) {
                $data['description']    = $this->input->post('description');
            }
            else{
                $data['description'] = null;
            }
            $this->db->where('dormitory_id', $param2);
            $this->db->update('dormitory', $data);
            $this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
            redirect(base_url() . 'index.php?admin/dormitory', 'refresh');
        } else if ($param1 == 'edit') {
            $page_data['edit_data'] = $this->db->get_where('dormitory', array(
                'dormitory_id' => $param2
            ))->result_array();
        }
        if ($param1 == 'delete') {
            $this->db->where('dormitory_id', $param2);
            $this->db->delete('dormitory');
            $this->session->set_flashdata('flash_message' , get_phrase('data_deleted'));
            redirect(base_url() . 'index.php?admin/dormitory', 'refresh');
        }
        $page_data['dormitories'] = $this->db->get('dormitory')->result_array();
        $page_data['page_name']   = 'dormitory';
        $page_data['page_title']  = get_phrase('manage_dormitory');
        $this->load->view('backend/index', $page_data);

    }
    function details () {
        if($this->session->userdata('admin_login') != 1)
            redirect('login', 'refresh');
        $page_data['page_name'] = 'dormitory_details';
        $page_data['page_title'] = get_phrase('dormitory_details');
        $this->load->view('backend/index', $page_data);
    }
    function rooms () {
        if($this->session->userdata('admin_login') != 1)
            redirect('login', 'refresh');
        $page_data['page_name'] = 'dormitory_room';
        $page_data['page_title'] = get_phrase('dormitory_room');
        $this->load->view('backend/index', $page_data);
    }
    function dormitory_hostel_allocation () {
        if($this->session->userdata('admin_login') != 1)
            redirect('login', 'refresh');
        $page_data['page_name'] = 'dormitory_hostel_allocation';
        $page_data['page_title'] = get_phrase('dormitory_hostel_allocation');
        $this->load->view('backend/index', $page_data);
    }
    function dormitory_request_details () {
        if($this->session->userdata('admin_login') != 1)
            redirect('login', 'refresh');
        $page_data['page_name'] = 'dormitory_request_details';
        $page_data['page_title'] = get_phrase('dormitory_request_details');
        $this->load->view('backend/index', $page_data);
    }
    function dormitory_hostel_transfer () {
        if($this->session->userdata('admin_login') != 1)
            redirect('login', 'refresh');
        $page_data['page_name'] = 'dormitory_hostel_transfer';
        $page_data['page_title'] = get_phrase('dormitory_hostel_transfer');
        $this->load->view('backend/index', $page_data);
    }
    function dormitory_hostel_register () {
        if($this->session->userdata('admin_login') != 1)
            redirect('login', 'refresh');
        $page_data['page_name'] = 'dormitory_hostel_register';
        $page_data['page_title'] = get_phrase('dormitory_hostel_regsiter');
        $this->load->view('backend/index', $page_data);
    }
    function dormitory_hostel_visitors () {
        if($this->session->userdata('admin_login') != 1)
            redirect('login', 'refresh');
        $page_data['page_name'] = 'dormitory_hostel_visitors';
        $page_data['page_title'] = get_phrase('dormitory_hostel_visitors');
        $this->load->view('backend/index', $page_data);
    }
    function dormitory_fee_collection () {
        if($this->session->userdata('admin_login') != 1)
            redirect('login', 'refresh');
        $page_data['page_name'] = 'dormitory_fee_collection';
        $page_data['page_title'] = get_phrase('dormitory_fee_collection');
        $this->load->view('backend/index', $page_data);
    }
    function dormitory_reports () {
        if($this->session->userdata('admin_login') != 1)
            redirect('login', 'refresh');
        $page_data['page_name'] = 'dormitory_reports';
        $page_data['page_title'] = get_phrase('dormitory_reports');
        $this->load->view('backend/index', $page_data);
    }

    /*** TASK MANAGER ***/
    function taskassign () {
        if($this->session->userdata('admin_login') != 1)
            redirect('login', 'refresh');
        $page_data['page_name'] = 'task_assign';
        $page_data['page_title'] = get_phrase('assign_task');
        $this->load->view('backend/index', $page_data);
    }
    function taskdetails () {
        if($this->session->userdata('admin_login') != 1)
            redirect('login', 'refresh');
        $page_data['page_name'] = 'task_details';
        $page_data['page_title'] = get_phrase('task_details');
        $this->load->view('backend/index', $page_data);
    }

    /***MANAGE EVENT / NOTICEBOARD, WILL BE SEEN BY ALL ACCOUNTS DASHBOARD**/
    function noticeboard($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');

        if ($param1 == 'create') {
            $data['notice_title']     = $this->input->post('notice_title');
            $data['notice']           = $this->input->post('notice');
            $data['create_timestamp'] = strtotime($this->input->post('create_timestamp'));
            $this->db->insert('noticeboard', $data);

            $check_sms_send = $this->input->post('check_sms');

            if ($check_sms_send == 1) {
                // sms sending configurations

                $parents  = $this->db->get('parent')->result_array();
                $students = $this->db->get('student')->result_array();
                $teachers = $this->db->get('teacher')->result_array();
                $date     = $this->input->post('create_timestamp');
                $message  = $data['notice_title'] . ' ';
                $message .= get_phrase('on') . ' ' . $date;
                foreach($parents as $row) {
                    $reciever_phone = $row['phone'];
                    $this->sms_model->send_sms($message , $reciever_phone);
                }
                foreach($students as $row) {
                    $reciever_phone = $row['phone'];
                    $this->sms_model->send_sms($message , $reciever_phone);
                }
                foreach($teachers as $row) {
                    $reciever_phone = $row['phone'];
                    $this->sms_model->send_sms($message , $reciever_phone);
                }
            }

            $this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
            redirect(base_url() . 'index.php?admin/noticeboard/', 'refresh');
        }
        if ($param1 == 'do_update') {
            $data['notice_title']     = $this->input->post('notice_title');
            $data['notice']           = $this->input->post('notice');
            $data['create_timestamp'] = strtotime($this->input->post('create_timestamp'));
            $this->db->where('notice_id', $param2);
            $this->db->update('noticeboard', $data);

            $check_sms_send = $this->input->post('check_sms');

            if ($check_sms_send == 1) {
                // sms sending configurations

                $parents  = $this->db->get('parent')->result_array();
                $students = $this->db->get('student')->result_array();
                $teachers = $this->db->get('teacher')->result_array();
                $date     = $this->input->post('create_timestamp');
                $message  = $data['notice_title'] . ' ';
                $message .= get_phrase('on') . ' ' . $date;
                foreach($parents as $row) {
                    $reciever_phone = $row['phone'];
                    $this->sms_model->send_sms($message , $reciever_phone);
                }
                foreach($students as $row) {
                    $reciever_phone = $row['phone'];
                    $this->sms_model->send_sms($message , $reciever_phone);
                }
                foreach($teachers as $row) {
                    $reciever_phone = $row['phone'];
                    $this->sms_model->send_sms($message , $reciever_phone);
                }
            }

            $this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
            redirect(base_url() . 'index.php?admin/noticeboard/', 'refresh');
        } else if ($param1 == 'edit') {
            $page_data['edit_data'] = $this->db->get_where('noticeboard', array(
                'notice_id' => $param2
            ))->result_array();
        }
        if ($param1 == 'delete') {
            $this->db->where('notice_id', $param2);
            $this->db->delete('noticeboard');
            $this->session->set_flashdata('flash_message' , get_phrase('data_deleted'));
            redirect(base_url() . 'index.php?admin/noticeboard/', 'refresh');
        }
        if ($param1 == 'mark_as_archive') {
            $this->db->where('notice_id' , $param2);
            $this->db->update('noticeboard' , array('status' => 0));
            redirect(base_url() . 'index.php?admin/noticeboard/', 'refresh');
        }

        if ($param1 == 'remove_from_archived') {
            $this->db->where('notice_id' , $param2);
            $this->db->update('noticeboard' , array('status' => 1));
            redirect(base_url() . 'index.php?admin/noticeboard/', 'refresh');
        }
        $page_data['page_name']  = 'noticeboard';
        $page_data['page_title'] = get_phrase('manage_noticeboard');
        $this->load->view('backend/index', $page_data);
    }
    function reload_noticeboard() {
        $this->load->view('backend/admin/noticeboard');
    }
    /* private messaging */

    function message($param1 = 'message_home', $param2 = '', $param3 = '') {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
        $max_size = 2097152;
        if ($param1 == 'send_new') {
            if (!file_exists('uploads/private_messaging_attached_file/')) {
              $oldmask = umask(0);  // helpful when used in linux server
              mkdir ('uploads/private_messaging_attached_file/', 0777);
            }
            if ($_FILES['attached_file_on_messaging']['name'] != "") {
              if($_FILES['attached_file_on_messaging']['size'] > $max_size){
                $this->session->set_flashdata('error_message' , get_phrase('file_size_can_not_be_larger_that_2_Megabyte'));
                redirect(base_url() . 'index.php?admin/message/message_new/', 'refresh');
              }
              else{
                $file_path = 'uploads/private_messaging_attached_file/'.$_FILES['attached_file_on_messaging']['name'];
                move_uploaded_file($_FILES['attached_file_on_messaging']['tmp_name'], $file_path);
              }
            }

            $message_thread_code = $this->crud_model->send_new_private_message();
            $this->session->set_flashdata('flash_message', get_phrase('message_sent!'));
            redirect(base_url() . 'index.php?admin/message/message_read/' . $message_thread_code, 'refresh');
        }

        if ($param1 == 'send_reply') {

            if (!file_exists('uploads/private_messaging_attached_file/')) {
              $oldmask = umask(0);  // helpful when used in linux server
              mkdir ('uploads/private_messaging_attached_file/', 0777);
            }
            if ($_FILES['attached_file_on_messaging']['name'] != "") {
              if($_FILES['attached_file_on_messaging']['size'] > $max_size){
                $this->session->set_flashdata('error_message' , get_phrase('file_size_can_not_be_larger_that_2_Megabyte'));
                redirect(base_url() . 'index.php?admin/message/message_read/' . $param2, 'refresh');
              }
              else{
                $file_path = 'uploads/private_messaging_attached_file/'.$_FILES['attached_file_on_messaging']['name'];
                move_uploaded_file($_FILES['attached_file_on_messaging']['tmp_name'], $file_path);
              }
            }

            $this->crud_model->send_reply_message($param2);  //$param2 = message_thread_code
            $this->session->set_flashdata('flash_message', get_phrase('message_sent!'));
            redirect(base_url() . 'index.php?admin/message/message_read/' . $param2, 'refresh');
        }

        if ($param1 == 'message_read') {
            $page_data['current_message_thread_code'] = $param2;  // $param2 = message_thread_code
            $this->crud_model->mark_thread_messages_read($param2);
        }

        $page_data['message_inner_page_name']   = $param1;
        $page_data['page_name']                 = 'message';
        $page_data['page_title']                = get_phrase('private_messaging');
        $this->load->view('backend/index', $page_data);
    }

    /*****SITE/SYSTEM SETTINGS*********/
    function system_settings($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url() . 'index.php?login', 'refresh');

        if ($param1 == 'do_update') {

            $data['description'] = $this->input->post('system_name');
            $this->db->where('type' , 'system_name');
            $this->db->update('settings' , $data);

            $data['description'] = $this->input->post('system_title');
            $this->db->where('type' , 'system_title');
            $this->db->update('settings' , $data);

            $data['description'] = $this->input->post('address');
            $this->db->where('type' , 'address');
            $this->db->update('settings' , $data);

            $data['description'] = $this->input->post('phone');
            $this->db->where('type' , 'phone');
            $this->db->update('settings' , $data);

            $data['description'] = $this->input->post('paypal_email');
            $this->db->where('type' , 'paypal_email');
            $this->db->update('settings' , $data);

            $data['description'] = $this->input->post('payumoney_merchant_key');
            $this->db->where('type' , 'payumoney_merchant_key');
            $this->db->update('settings' , $data);

            $data['description'] = $this->input->post('payumoney_salt_id');
            $this->db->where('type' , 'payumoney_salt_id');
            $this->db->update('settings' , $data);

            $data['description'] = $this->input->post('currency');
            $this->db->where('type' , 'currency');
            $this->db->update('settings' , $data);

            $data['description'] = $this->input->post('system_email');
            $this->db->where('type' , 'system_email');
            $this->db->update('settings' , $data);

            $data['description'] = $this->input->post('system_name');
            $this->db->where('type' , 'system_name');
            $this->db->update('settings' , $data);

            $data['description'] = $this->input->post('language');
            $this->db->where('type' , 'language');
            $this->db->update('settings' , $data);

            $data['description'] = $this->input->post('text_align');
            $this->db->where('type' , 'text_align');
            $this->db->update('settings' , $data);

            $data['description'] = $this->input->post('running_year');
            $this->db->where('type' , 'running_year');
            $this->db->update('settings' , $data);

            $this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
            redirect(base_url() . 'index.php?admin/system_settings/', 'refresh');
        }
        if ($param1 == 'upload_logo') {
            move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/logo.png');
            $this->session->set_flashdata('flash_message', get_phrase('settings_updated'));
            redirect(base_url() . 'index.php?admin/system_settings/', 'refresh');
        }
        if ($param1 == 'change_skin') {
            $data['description'] = $param2;
            $this->db->where('type' , 'skin_colour');
            $this->db->update('settings' , $data);
            $this->session->set_flashdata('flash_message' , get_phrase('theme_selected'));
            redirect(base_url() . 'index.php?admin/system_settings/', 'refresh');
        }
        $page_data['page_name']  = 'system_settings';
        $page_data['page_title'] = get_phrase('system_settings');
        $page_data['settings']   = $this->db->get('settings')->result_array();
        $this->load->view('backend/index', $page_data);
    }

    function get_session_changer()
    {
        $this->load->view('backend/admin/change_session');
    }

    function change_session()
    {
        $data['description'] = $this->input->post('running_year');
        $this->db->where('type' , 'running_year');
        $this->db->update('settings' , $data);
        $this->session->set_flashdata('flash_message' , get_phrase('session_changed'));
        redirect(base_url() . 'index.php?admin/dashboard/', 'refresh');
    }

	/***** UPDATE PRODUCT *****/

	function update( $task = '', $purchase_code = '' ) {

        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');

        // Create update directory.
        $dir    = 'update';
        if ( !is_dir($dir) )
            mkdir($dir, 0777, true);

        $zipped_file_name   = $_FILES["file_name"]["name"];
        $path               = 'update/' . $zipped_file_name;

        move_uploaded_file($_FILES["file_name"]["tmp_name"], $path);

        // Unzip uploaded update file and remove zip file.
        $zip = new ZipArchive;
        $res = $zip->open($path);
        if ($res === TRUE) {
            $zip->extractTo('update');
            $zip->close();
            unlink($path);
        }

        $unzipped_file_name = substr($zipped_file_name, 0, -4);
        $str                = file_get_contents('./update/' . $unzipped_file_name . '/update_config.json');
        $json               = json_decode($str, true);



		// Run php modifications
		require './update/' . $unzipped_file_name . '/update_script.php';

        // Create new directories.
        if(!empty($json['directory'])) {
            foreach($json['directory'] as $directory) {
                if ( !is_dir( $directory['name']) )
                    mkdir( $directory['name'], 0777, true );
            }
        }

        // Create/Replace new files.
        if(!empty($json['files'])) {
            foreach($json['files'] as $file)
                copy($file['root_directory'], $file['update_directory']);
        }

        $this->session->set_flashdata('flash_message' , get_phrase('product_updated_successfully'));
        redirect(base_url() . 'index.php?admin/system_settings');
    }

    /*****SMS SETTINGS*********/
    function sms_settings($param1 = '' , $param2 = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url() . 'index.php?login', 'refresh');
        if ($param1 == 'clickatell') {

            $data['description'] = $this->input->post('clickatell_user');
            $this->db->where('type' , 'clickatell_user');
            $this->db->update('settings' , $data);

            $data['description'] = $this->input->post('clickatell_password');
            $this->db->where('type' , 'clickatell_password');
            $this->db->update('settings' , $data);

            $data['description'] = $this->input->post('clickatell_api_id');
            $this->db->where('type' , 'clickatell_api_id');
            $this->db->update('settings' , $data);

            $this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
            redirect(base_url() . 'index.php?admin/sms_settings/', 'refresh');
        }

        if ($param1 == 'twilio') {

            $data['description'] = $this->input->post('twilio_account_sid');
            $this->db->where('type' , 'twilio_account_sid');
            $this->db->update('settings' , $data);

            $data['description'] = $this->input->post('twilio_auth_token');
            $this->db->where('type' , 'twilio_auth_token');
            $this->db->update('settings' , $data);

            $data['description'] = $this->input->post('twilio_sender_phone_number');
            $this->db->where('type' , 'twilio_sender_phone_number');
            $this->db->update('settings' , $data);

            $this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
            redirect(base_url() . 'index.php?admin/sms_settings/', 'refresh');
        }
        if ($param1 == 'msg91') {

            $data['description'] = $this->input->post('authentication_key');
            $this->db->where('type' , 'msg91_authentication_key');
            $this->db->update('settings' , $data);

            $data['description'] = $this->input->post('sender_ID');
            $this->db->where('type' , 'msg91_sender_ID');
            $this->db->update('settings' , $data);

            $this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
            redirect(base_url() . 'index.php?admin/sms_settings/', 'refresh');
        }

        if ($param1 == 'active_service') {

            $data['description'] = $this->input->post('active_sms_service');
            $this->db->where('type' , 'active_sms_service');
            $this->db->update('settings' , $data);

            $this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
            redirect(base_url() . 'index.php?admin/sms_settings/', 'refresh');
        }

        $page_data['page_name']  = 'sms_settings';
        $page_data['page_title'] = get_phrase('sms_settings');
        $page_data['settings']   = $this->db->get('settings')->result_array();
        $this->load->view('backend/index', $page_data);
    }

    /*****LANGUAGE SETTINGS*********/
    function manage_language($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('admin_login') != 1)
			redirect(base_url() . 'index.php?login', 'refresh');

		if ($param1 == 'edit_phrase') {
			$page_data['edit_profile'] 	= $param2;
		}
		if ($param1 == 'update_phrase') {
			$language	=	$param2;
			$total_phrase	=	$this->input->post('total_phrase');
			for($i = 1 ; $i < $total_phrase ; $i++)
			{
				//$data[$language]	=	$this->input->post('phrase').$i;
				$this->db->where('phrase_id' , $i);
				$this->db->update('language' , array($language => $this->input->post('phrase'.$i)));
			}
			redirect(base_url() . 'index.php?admin/manage_language/edit_phrase/'.$language, 'refresh');
		}
		if ($param1 == 'do_update') {
			$language        = $this->input->post('language');
			$data[$language] = $this->input->post('phrase');
			$this->db->where('phrase_id', $param2);
			$this->db->update('language', $data);
			$this->session->set_flashdata('flash_message', get_phrase('settings_updated'));
			redirect(base_url() . 'index.php?admin/manage_language/', 'refresh');
		}
		if ($param1 == 'add_phrase') {
			$data['phrase'] = $this->input->post('phrase');
			$this->db->insert('language', $data);
			$this->session->set_flashdata('flash_message', get_phrase('settings_updated'));
			redirect(base_url() . 'index.php?admin/manage_language/', 'refresh');
		}
		if ($param1 == 'add_language') {
			$language = $this->input->post('language');
			$this->load->dbforge();
			$fields = array(
				$language => array(
					'type' => 'LONGTEXT'
				)
			);
			$this->dbforge->add_column('language', $fields);

			$this->session->set_flashdata('flash_message', get_phrase('settings_updated'));
			redirect(base_url() . 'index.php?admin/manage_language/', 'refresh');
		}
		if ($param1 == 'delete_language') {
			$language = $param2;
			$this->load->dbforge();
			$this->dbforge->drop_column('language', $language);
			$this->session->set_flashdata('flash_message', get_phrase('settings_updated'));

			redirect(base_url() . 'index.php?admin/manage_language/', 'refresh');
		}
		$page_data['page_name']        = 'manage_language';
		$page_data['page_title']       = get_phrase('manage_language');
		//$page_data['language_phrases'] = $this->db->get('language')->result_array();
		$this->load->view('backend/index', $page_data);
    }

    /*****BACKUP / RESTORE / DELETE DATA PAGE**********/
    function backup_restore($operation = '', $type = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');

        if ($operation == 'create') {
            $this->crud_model->create_backup($type);
        }
        if ($operation == 'restore') {
            $this->crud_model->restore_backup();
            $this->session->set_flashdata('backup_message', 'Backup Restored');
            redirect(base_url() . 'index.php?admin/backup_restore/', 'refresh');
        }
        if ($operation == 'delete') {
            $this->crud_model->truncate($type);
            $this->session->set_flashdata('backup_message', 'Data removed');
            redirect(base_url() . 'index.php?admin/backup_restore/', 'refresh');
        }

        $page_data['page_info']  = 'Create backup / restore from backup';
        $page_data['page_name']  = 'backup_restore';
        $page_data['page_title'] = get_phrase('manage_backup_restore');
        $this->load->view('backend/index', $page_data);
    }

    /******MANAGE OWN PROFILE AND CHANGE PASSWORD***/
    function manage_profile($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url() . 'index.php?login', 'refresh');
        if ($param1 == 'update_profile_info') {
            $data['name']  = $this->input->post('name');
            $data['email'] = $this->input->post('email');

            $admin_id = $param2;

            $validation = email_validation_for_edit($data['email'], $admin_id, 'admin');
            if($validation == 1){
                $this->db->where('admin_id', $this->session->userdata('admin_id'));
                $this->db->update('admin', $data);
                move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/admin_image/' . $this->session->userdata('admin_id') . '.jpg');
                $this->session->set_flashdata('flash_message', get_phrase('account_updated'));
            }
            else{
                $this->session->set_flashdata('error_message', get_phrase('this_email_id_is_not_available'));
            }
            redirect(base_url() . 'index.php?admin/manage_profile/', 'refresh');
        }
        if ($param1 == 'change_password') {
            $data['password']             = sha1($this->input->post('password'));
            $data['new_password']         = sha1($this->input->post('new_password'));
            $data['confirm_new_password'] = sha1($this->input->post('confirm_new_password'));

            $current_password = $this->db->get_where('admin', array(
                'admin_id' => $this->session->userdata('admin_id')
            ))->row()->password;
            if ($current_password == $data['password'] && $data['new_password'] == $data['confirm_new_password']) {
                $this->db->where('admin_id', $this->session->userdata('admin_id'));
                $this->db->update('admin', array(
                    'password' => $data['new_password']
                ));
                $this->session->set_flashdata('flash_message', get_phrase('password_updated'));
            } else {
                $this->session->set_flashdata('error_message', get_phrase('password_mismatch'));
            }
            redirect(base_url() . 'index.php?admin/manage_profile/', 'refresh');
        }
        $page_data['page_name']  = 'manage_profile';
        $page_data['page_title'] = get_phrase('manage_profile');
        $page_data['edit_data']  = $this->db->get_where('admin', array(
            'admin_id' => $this->session->userdata('admin_id')
        ))->result_array();
        $this->load->view('backend/index', $page_data);
    }

    // VIEW QUESTION PAPERS
    function question_paper($param1 = "", $param2 = "")
    {
        if ($this->session->userdata('admin_login') != 1)
        {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }

        $data['page_name']  = 'question_paper';
        $data['page_title'] = get_phrase('question_paper');
        $this->load->view('backend/index', $data);
    }

    // MANAGE LIBRARIANS
    function librarian($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect('login', 'refresh');

        if ($param1 == 'create') {
            $data['name']       = $this->input->post('name');
            $data['email']      = $this->input->post('email');
            $data['password']   = sha1($this->input->post('password'));
            $validation = email_validation($data['email']);
            if ($validation == 1) {
                $this->db->insert('librarian', $data);
                $this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
                $this->email_model->account_opening_email('librarian', $data['email'], $this->input->post('password')); //SEND EMAIL ACCOUNT OPENING EMAIL
            }
            else{
                $this->session->set_flashdata('error_message' , get_phrase('this_email_id_is_not_available'));
            }
            redirect(base_url() . 'index.php?admin/librarian/', 'refresh');
        }

        if ($param1 == 'edit') {
            $data['name']   = $this->input->post('name');
            $data['email']  = $this->input->post('email');
            $validation = email_validation_for_edit($data['email'], $param2, 'librarian');
            if ($validation == 1) {
                $this->db->where('librarian_id' , $param2);
                $this->db->update('librarian' , $data);
                $this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
            }
            else{
                $this->session->set_flashdata('error_message' , get_phrase('this_email_id_is_not_available'));
            }

            redirect(base_url() . 'index.php?admin/librarian/', 'refresh');
        }

        if ($param1 == 'delete') {
            $this->db->where('librarian_id' , $param2);
            $this->db->delete('librarian');

            $this->session->set_flashdata('flash_message' , get_phrase('data_deleted'));
            redirect(base_url() . 'index.php?admin/librarian/', 'refresh');
        }

        $page_data['page_title']    = get_phrase('all_librarians');
        $page_data['page_name']     = 'librarian';
        $this->load->view('backend/index', $page_data);
    }

    // MANAGE ACCOUNTANTS
    function accountant($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect('login', 'refresh');

        if ($param1 == 'create') {
            $data['name']       = $this->input->post('name');
            $data['email']      = $this->input->post('email');
            $data['password']   = sha1($this->input->post('password'));

            $validation = email_validation($data['email']);
            if ($validation == 1) {
                $this->db->insert('accountant', $data);
                $this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
                $this->email_model->account_opening_email('accountant', $data['email'], $this->input->post('password')); //SEND EMAIL ACCOUNT OPENING EMAIL
            }
            else{
                $this->session->set_flashdata('error_message' , get_phrase('this_email_id_is_not_available'));
            }

            redirect(base_url() . 'index.php?admin/accountant', 'refresh');
        }

        if ($param1 == 'edit') {
            $data['name']   = $this->input->post('name');
            $data['email']  = $this->input->post('email');

            $validation = email_validation_for_edit($data['email'], $param2, 'accountant');
            if($validation == 1){
                $this->db->where('accountant_id' , $param2);
                $this->db->update('accountant' , $data);
                $this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
            }
            else{
                $this->session->set_flashdata('error_message' , get_phrase('this_email_id_is_not_available'));
            }

            redirect(base_url() . 'index.php?admin/accountant', 'refresh');
        }

        if ($param1 == 'delete') {
            $this->db->where('accountant_id' , $param2);
            $this->db->delete('accountant');

            $this->session->set_flashdata('flash_message' , get_phrase('data_deleted'));
            redirect(base_url() . 'index.php?admin/accountant', 'refresh');
        }

        $page_data['page_title']    = get_phrase('all_accountants');
        $page_data['page_name']     = 'accountant';
        $this->load->view('backend/index', $page_data);
    }
	public function checkEmail(){
		$email  = $this->input->post('email');
		$this->db->select('*');
        $this->db->from('student');
        $this->db->where('email', $email);
        $query = $this->db->get();
		if ( $query->num_rows() > 0 ){
        echo "exist"; die;
       }
	}

	public function random_password( $length = 8 ) {
    $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()_-=+;:,.?";
    $password = substr( str_shuffle( $chars ), 0, $length );
    return $password;
}
public function getmultipleWhatsappMessage()
{
	if ($this->session->userdata('admin_login') != 1)
             redirect(base_url(), 'refresh');
    else
    {
		$this->db->select('*');
		$this->db->from('groups');
		$query = $this->db->get();

		$this->db->select('*');
		$this->db->from('groups_student a');
		$this->db->join('student b', 'b.student_id = a.student_id');
		$this->db->join('parent c', 'c.rel_stuid = b.student_id');
		$query2 = $this->db->get();

		$this->db->select('*');
		$this->db->from('messageTemplate');
		$query3 = $this->db->get();		
		
		$page_data['page_title']    = get_phrase('whatsapp Message');
	    $page_data['page_name']     = 'whatsAppTemplate';
	    $page_data['query']     = $query;
	    $page_data['query2']     = $query2;
	    $page_data['query3']     = $query3;
	    $this->load->view('backend/index', $page_data);
	}
}

public function postmultipleWhatsappMessage()
{
	$sent=array();
	$not_sent=array();
	if ($this->session->userdata('admin_login') != 1)
             redirect(base_url(), 'refresh');
    else
    {
    		$numbers= array();
			$message= $this->input->post('message');
			$this->db->from('student a');
			$this->db->join('parent b', 'b.rel_stuid = a.student_id');	
			$query = $this->db->get();
			foreach ($query->result() as $row)
			{
	        	 $number= $row->mobile_no;
	        	 $student_id = $row->student_id;
	        	
	        	$response = $this->contact_gateway($student_id, $number, $message);
	        	if (strpos($response, 'queued') !== false) 
	        	{
 				   array_push($sent, $number);
 				   $this->session->set_flashdata('sent',$sent); 
 				}
				else {
						array_push($not_sent, $number);
						$this->session->set_flashdata('not_sent',$not_sent); 
					}
	        }
	}
	$page_data['page_name']  = 'dashboard';
    $page_data['page_title'] = get_phrase('admin_dashboard');
    $this->load->view('backend/index', $page_data);
}
public function postmultipleGroupWhatsappMessage()
{
	$sent_group=array();
	$not_sent_group=array();
	if ($this->session->userdata('admin_login') != 1)
             redirect(base_url(), 'refresh');
	else
	{
		if(!empty($this->input->post('checkboxlist')))
		 {
			foreach ( $this->input->post('checkboxlist') as $obj)
			{
				$numbers= array();
				$message= $this->input->post('groupMessage');			 	
	    		$this->db->select('*');
				$this->db->from('groups_student a');
				$this->db->join('student b', 'b.student_id = a.student_id');
				$this->db->join('parent c', 'c.rel_stuid = b.student_id');
				$this->db->where('a.group_id', $obj);				
				$query = $this->db->get();
				foreach ($query->result() as $row)
				{
		        	$number= $row->mobile_no;
		        	$student_id = $row->student_id;
		        	$response = $this->contact_gateway($student_id, $number, $message);
		        	if (strpos($response, 'queued') !== false) {
	 				  	array_push($sent_group, $number);
	 				  	$this->session->set_flashdata('sent_group',$sent_group); 
	 				 }
					else {
						array_push($not_sent_group, $number);
						$this->session->set_flashdata('not_sent_group',$not_sent_group); 
						}
		         }
				}
		    }
		    else
		    {
		    	$this->session->set_flashdata('empty','You Forgot to select the checkboxes. No message was sent.'); 
		    }
	 }
	$page_data['page_name']  = 'dashboard';
    $page_data['page_title'] = get_phrase('admin_dashboard');
    $this->load->view('backend/index', $page_data);
}

private function contact_gateway($student_id, $number, $message)
		{
			$dateTime = date('Y-m-d H:i:s');
			$insertMsgRecord = array(
        		'number' => $number,
        		'sent_on' => $dateTime,
        		'student_id' => $student_id
			);

			$this->db->insert('whatsappSent', $insertMsgRecord);

			  $postData = array(
			  'number' => $number,  // TODO: Specify the recipient's number here. NOT the gateway number  /// only those receipients can be added who are have registered themselves through the gateway number.
			  'message' => $message,
			);
			$headers = array(
			  'Content-Type: application/json',
			  'X-WM-CLIENT-ID: '.$this->config->item('whatsClientId'),
			  'X-WM-CLIENT-SECRET: '.$this->config->item('whatsClientSecret')
			);
			$url = 'http://api.whatsmate.net/v3/whatsapp/single/text/message/' . $this->config->item('whatsInstanceId');
			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postData));
			$response = curl_exec($ch);
			curl_close($ch);
			return $response;
		}

public function getgrouping()
{
		if ($this->session->userdata('admin_login') != 1)
             redirect(base_url(), 'refresh');
		else
		{
			$this->db->select('*');
			$this->db->from('student');
			
			$query = $this->db->get();
			$page_data['page_title']    = get_phrase('Create Groups');
		    $page_data['page_name']     = 'grouping';
		    $page_data['query']     	=  $query;
		    $this->load->view('backend/index', $page_data);
		}
}
public function postgrouping()
{
		if ($this->session->userdata('admin_login') != 1)
             redirect(base_url(), 'refresh');
		else
		{
			{
				$group = $this->input->post('grouping_name');
				if(!empty($this->input->post('mycheck')))
	 			{
	 				
	 				$data = array(
       							 	'name' => $group,
									);

					$this->db->insert('groups', $data);
					$groupInsertId = $this->db->insert_id();

	 				foreach ( $this->input->post('mycheck') as $obj)
					{
						
					$data2 = array(
       							 	'group_id' => $groupInsertId,
       							 	'student_id' => $obj
									);

					$this->db->insert('groups_student', $data2);
					
					$this->session->set_flashdata('created_group','Your Group has Been Created'); 
					
					}

	 			}else
					{
						$this->session->set_flashdata('created_group_error','Invalid Input Fields'); 						
					}

				$this->db->select('*');
				$this->db->from('student a');
				$this->db->join('parent b', 'b.rel_stuid = a.student_id');
				$query = $this->db->get();
				$page_data['page_title']    = get_phrase('Create Groups');
			    $page_data['page_name']     = 'grouping';
			    $page_data['query']     	=  $query;
			    $this->load->view('backend/index', $page_data);
			}

		}
}

public function getSentHistory()
{
		if ($this->session->userdata('admin_login') != 1)
             redirect(base_url(), 'refresh');
		else
		{
			$this->db->select('*');
			$this->db->from('whatsappSent');
			$this->db->join('student', 'student.student_id = whatsappSent.student_id');
			$query = $this->db->get();
			$page_data['page_title']    = get_phrase('WhatsApp Message History');
		    $page_data['page_name']     = 'WhatsAppMessageHistory';
		    $page_data['query']     	=  $query;
		    $this->load->view('backend/index', $page_data);
		}
}

public function getTemplate()
{
	if ($this->session->userdata('admin_login') != 1)
             redirect(base_url(), 'refresh');
		else
		{
			$this->db->select('*');
			$this->db->from('messageTemplate');
			$query = $this->db->get();
			$page_data['page_title']    = get_phrase('Message Template');
		    $page_data['page_name']     = 'messageTemplate';
		    $page_data['query']     	=  $query;
		    $this->load->view('backend/index', $page_data);
		}	
}
public function postMessageTemplate(){
	if ($this->session->userdata('admin_login') != 1)
             redirect(base_url(), 'refresh');
		else
		{
			

			$message = $this->input->post('message');
			$name = $this->input->post('name');

			$dateTime = date('Y-m-d H:i:s');
			$insertMsgTemplate = array(
        		'name' => $name,
        		'created_on' => $dateTime,
        		'message' => $message
			);
			$this->db->insert('messageTemplate', $insertMsgTemplate);
			$this->session->set_flashdata('created_template','Your Template has Been Created'); 

			$this->db->select('*');
			$this->db->from('messageTemplate');
			$query = $this->db->get();
			
			$page_data['page_title']    = get_phrase('Message Template');
		    $page_data['page_name']     = 'messageTemplate';
		    $page_data['query']     	=  $query;
		    $this->load->view('backend/index', $page_data);
		}
}

public function examination()
{
	if ($this->session->userdata('admin_login') != 1)
             redirect(base_url(), 'refresh');
		else
		{
			$this->db->select('*');
			$this->db->from('exam');
			$query = $this->db->get();
			$page_data['page_title']    = get_phrase('Online Examination Portal');
		    $page_data['page_name']     = 'examination';
		    $page_data['query']     	=  $query;
		    $this->load->view('backend/index', $page_data);
		}	
}
public function offline_examination()
{
	if ($this->session->userdata('admin_login') != 1)
             redirect(base_url(), 'refresh');
		else
		{
			$this->db->select('*');
			$this->db->from('offline_exam');
			$query = $this->db->get();
			$page_data['page_title']    = get_phrase('Offline Examination Portal');
		    $page_data['page_name']     = 'offline_examination';
		    $page_data['query']     	=  $query;
		    $this->load->view('backend/index', $page_data);
		}	
}
 public function postAddOfflineExam()
    {
        if ($this->session->userdata('admin_login') != 1)
             redirect(base_url(), 'refresh');
		else
		{   	

           	$this->db->select('*');
			$this->db->from('offline_exam');
			$query = $this->db->get();
			$page_data['page_title']    = get_phrase('Offline Examination Portal');
		    $page_data['page_name']     = 'offline_examination';
		    $page_data['query']     	=  $query;


           	$date = $this->input->post('date');
			$name = $this->input->post('name');
			// $file_name = $this->input->post('file_upload');
			// $config['upload_path']          = 'uploads/question_papers/';
   //          $config['allowed_types']        = 'pdf';
            
		    
		    // $this->load->library('upload', $config);

		    $files = $_FILES['file_upload'];
	        $this->load->library('upload');
	        $config['upload_path']   =  'uploads/question_papers/';
	        $config['allowed_types'] =  '*';
	        $_FILES['file_upload']['name']     = $files['name'];
	        $_FILES['file_upload']['type']     = $files['type'];
	        $_FILES['file_upload']['tmp_name'] = $files['tmp_name'];
	        $_FILES['file_upload']['size']     = $files['size'];
	        //var_dump($files['name']);
	        $this->upload->initialize($config);
	        //$this->upload->do_upload('file_upload');

	        if ( ! $this->upload->do_upload('file_upload'))
            {
                    $page_data['error'] = array('error' => $this->upload->display_errors());
					$this->load->view('backend/index', $page_data);
			}
            else
            {
                    $page_data['success'] = array('upload_data' => $this->upload->data());
                    $insertRecord = array(
		        		'name' => $name,
		        		'date_of_exam'=> $date,
		        		'file_name' => $files['name']
					);
					$this->db->insert('offline_exam', $insertRecord);
					$this->load->view('backend/index', $page_data);
            }
		}
    }
public function download_question_paper()
    {
        $file_name = $this->input->post('download_file_name');
        $this->load->helper('download');
        if (file_exists ( "uploads/question_papers/" . $file_name )) {
        	$data = file_get_contents("uploads/question_papers/" . $file_name);
        	$name = $file_name;
	        force_download($name, $data);
	        // var_dump($name);        
        }
        else {
        	var_dump("uploads/question_papers/" . $file_name);
        }
        
    }
public function getAddExam()
{
	if ($this->session->userdata('admin_login') != 1)
             redirect(base_url(), 'refresh');
		else
		{
			$page_data['page_title']    = get_phrase('Add Exam');
		    $page_data['page_name']     = 'addExam';
		    $this->load->view('backend/index', $page_data);
		}	
}

public function postAddExam()
{
	if ($this->session->userdata('admin_login') != 1)
             redirect(base_url(), 'refresh');
		else
		{
		   $name =  $this->input->post('name');
		   $doc =  $this->input->post('doc');
		   $to =  $this->input->post('to');
		   $from =  $this->input->post('from');

		   $insertRecord = array(
        		'name' => $name,
        		'to_time' => $to,
        		'from_time' => $from,
        		'date' => $doc,
			);

			$this->db->insert('exam', $insertRecord);

			redirect(base_url().'index.php?admin/examination', 'refresh');
		}	
}
public function deleteExam($deleteId){
		$deleteId = $this->input->post('deleteId');
		$this ->db-> where('exam_id', $deleteId);
  		$this ->db-> delete('exam');
}
public function updateExam($updateId){
		$updateId = $this->input->post('updateId');
		$name = $this->input->post('name');
		$doc = $this->input->post('doc');
		$from = $this->input->post('from');
		$to = $this->input->post('to');
		$arr = array('name' => $name,'date' => $doc,'from_time' => $from,'to_time' => $to);
		$this->db->where('exam_id', $updateId);
    	$this->db->update('exam', $arr);
}
public function examinationEdit($exam_id){
	if ($this->session->userdata('admin_login') != 1)
             redirect(base_url(), 'refresh');
	else
	{
		$this->db->select('*');
		$this->db->from('exam');
		$this->db->where('exam_id', $exam_id);
		$query = $this->db->get();

		$this->db->select('*');
	    $this->db->from('exam a'); 
	    $this->db->join('questions b', 'b.exam_id=a.exam_id', 'right');
	    $this->db->join('mcq c', 'c.question_id=b.id', 'right');
	    $this->db->join('mcq_answers d', 'c.id=d.mcq_id', 'right');
	    $this->db->where('b.exam_id',$exam_id);
	    $this->db->order_by('c.question_id', 'desc');
	    $query2 = $this->db->get();

	    $this->db->select('*');
	    $this->db->from('exam e'); 
	    $this->db->join('questions f', 'f.exam_id=e.exam_id', 'right');
	    $this->db->join('descriptive g', 'g.question_id=f.id', 'right');
	    $this->db->where('f.exam_id',$exam_id);
	    $this->db->order_by('g.question_id', 'desc');	    
	    $query3 = $this->db->get();

	    $this->db->select('*');
	    $this->db->from('exam h'); 
	    $this->db->join('questions i', 'i.exam_id=h.exam_id','right');
	    $this->db->join('more_than_one_mcq j', 'j.question_id=i.id','right');
	    $this->db->join('more_than_one_mcq_answers k', 'j.id=k.mto_mcq_id','right');
	    $this->db->where('i.exam_id',$exam_id);
	    $this->db->order_by('j.question_id', 'desc');
	    $query4 = $this->db->get();

	  
        foreach ($query2->result() as $rowmcq)
			{
			    $rowmcq->options =  $this->db->select('value')->from('mcq_options')->where('mcq_id', $rowmcq->mcq_id)->get()->result();
			    $rowmcq->correct_option= $this->db->select('value')->from('mcq_options')->where('id', $rowmcq->correct_options_id)->get()->result();
			}

   
        foreach ($query4->result() as $rowmtomcq)
			{
			    $rowmtomcq->optionss =  $this->db->select('value')->from('more_than_one_mcq_options')->where('mto_mcq_id', $rowmtomcq->mto_mcq_id)->get()->result();
			    $rowmtomcq->correct_options_id =  $this->db->select('correct_options_id')->from('more_than_one_mcq_answers')->where('mto_mcq_id', $rowmtomcq->mto_mcq_id)->get()->result();
			    $arr = array();
			    foreach ($rowmtomcq->correct_options_id as $key) 
			    {
			    		array_push($arr, $key->correct_options_id);
			    }
			    $rowmtomcq->correct_options	= $this->db->select('value')->from('more_than_one_mcq_options')->where_in( 'id', $arr)->get()->result();
			}
    	 
    	$page_data['query']     	=  $query;
		$page_data['query2']     	=  $query2;
		$page_data['query3']     	=  $query3;
		$page_data['query4']     	=  $query4;
		$page_data['page_title']    = get_phrase('Edit Exam Questions');
	    $page_data['page_name']     = 'editExamQuestions';
	    $page_data['exam_id']     = $exam_id;
	    $this->load->view('backend/index', $page_data);
	}	
}

public function addDescQues()
{
	if ($this->session->userdata('admin_login') != 1)
             redirect(base_url(), 'refresh');
	else
	{
		$exam_id =  $this->input->post('examId');
		$question =  $this->input->post('editorText');
		$insertRecord = array(
        		'exam_id' => $exam_id
			);
		$this->db->insert('questions', $insertRecord);
		$question_id = $this->db->insert_id();

		$data2 = array(
					 	'question_id' => $question_id,
					 	'descriptive' => $question
					);
		$this->db->insert('descriptive', $data2);
		$this->session->set_flashdata('Question' , get_phrase('Question Added Sucessfully'));
	}
}
public function addMcqQues()
{
	if ($this->session->userdata('admin_login') != 1)
             redirect(base_url(), 'refresh');
	else
	{
		$exam_id =  $this->input->post('examId');
		$mcqQuestion =  $this->input->post('mcqQuestion');
		$mcqOpt =  $this->input->post('mcqOpt');
		$mcqAnswer =  $this->input->post('mcqAnswer');
		$no_of_options = $this->input->post('no_of_options');

		// var_dump($mcqOpt['0']);
				           
		$insertIntoQuestions = array(
        		'exam_id' => $exam_id
			);
		$this->db->insert('questions', $insertIntoQuestions);
		$question_id = $this->db->insert_id();

		$mcqQuestionInsert = array(
					 	'question_id' => $question_id,
					 	'mcq' => $mcqQuestion,
					 	'no_of_options' => $no_of_options
					);
		$this->db->insert('mcq', $mcqQuestionInsert);
		$mcq_id = $this->db->insert_id();



		for($i=0; $i < $no_of_options ; $i++) 
		{
			//var_dump($mcqOpt[$i]);
			$mcqOptInsert = array(
				 	'mcq_id' => $mcq_id,
				 	'value' => $mcqOpt[$i]
				 );
			$this->db->insert('mcq_options', $mcqOptInsert);
			var_dump($mcqOptInsert);
			
			if($mcqAnswer == $i+1)
			{
				$mcqAnswer = $this->db->insert_id();
			}
		}

		$mcqAnswerInsert = array(
					 	'mcq_id' => $mcq_id,
					 	'correct_options_id' => $mcqAnswer
					);
		$this->db->insert('mcq_answers', $mcqAnswerInsert);
		$this->session->set_flashdata('Question' , get_phrase('Question Added Sucessfully'));
	}
}
public function addMtoMcqQues()
{
	if ($this->session->userdata('admin_login') != 1)
             redirect(base_url(), 'refresh');
	else
	{
		$exam_id =  $this->input->post('examId');
		$mtoMcqQuestion =  $this->input->post('mtoMcqQuestion');
		$mtoMcqAnswer =  $this->input->post('mtoMcqAnswer');
		$question_id= '';
		$mtoMcqOpt =  $this->input->post('mtoMcqOpt');
		$no_of_options = $this->input->post('no_of_options');

		$insertIntoQuestions = array(
        		'exam_id' => $exam_id
			);
		$this->db->insert('questions', $insertIntoQuestions);
		$question_id = $this->db->insert_id();

		$mtoMcqQuestionInsert = array(
					 	'question_id' => $question_id,
					 	'mto_mcq' => $mtoMcqQuestion,
					 	'no_of_options' => $no_of_options
					);
		$this->db->insert('more_than_one_mcq', $mtoMcqQuestionInsert);
		$mto_mcq_id = $this->db->insert_id();
		//$mtoMcqAnswerArray = array();
			
		for($i=0; $i < $no_of_options ; $i++) 
		{	
			$mtoMcqOptInsert = array(
				 	'mto_mcq_id' => $mto_mcq_id,
				 	'value' => $mtoMcqOpt[$i]
				);
			
			$this->db->insert('more_than_one_mcq_options', $mtoMcqOptInsert);
			$mto_mcq_opt_id = $this->db->insert_id();
			
			
			foreach ($mtoMcqAnswer as $key) 
			{
				if($key == $i+1)
				{
					$mtoMcqAnswerInsert = array(
					 	'mto_mcq_id' => $mto_mcq_id,
					 	'correct_options_id' => $mto_mcq_opt_id,
					);
					$this->db->insert('more_than_one_mcq_answers', $mtoMcqAnswerInsert);
				}
			}
		}
		$this->session->set_flashdata('Question' , get_phrase('Question Added Sucessfully'));
	}
}
public function deleteQuestion($deleteId)
{
	$deleteId = $this->input->post('deleteId');
	// echo $deleteId.'hi';
	$this->db->where('id', $deleteId);
  	$this->db->delete('questions');
  	$this->session->set_flashdata('Question' , get_phrase('Question Deleted Sucessfully'));
}
public function mcqQuestionEdit($question_id)
{
	if ($this->session->userdata('admin_login') != 1)
             redirect(base_url(), 'refresh');
	else
	{
		$exam_id = '';
		$no_of_options = '';
		$this->db->select('exam_id');
		$this->db->from('questions');
		$this->db->where('id', $question_id);
		$query = $this->db->get();

		$this->db->select('no_of_options');
	    $this->db->from('mcq'); 
	    $this->db->where('question_id',$question_id);
	    $query2 = $this->db->get();
	    foreach ($query2->result() as $row2) 
	    {
	    	$no_of_options =  (int)$row2->no_of_options;
	    }


		foreach ($query->result() as $row) 
	    {
	    	$exam_id =  $row->exam_id;
	    }
		$page_data['question_id']     	=  $question_id;
		$page_data['page_title']    = get_phrase('Update Exam Questions');
	    $page_data['page_name']     = 'updateExamMcqQuestion';
	    $page_data['exam_id']     = $exam_id;
	    $page_data['no_of_options']     = $no_of_options;
	    //var_dump($no_of_options);
	    $this->load->view('backend/index', $page_data);
	}
}
public function mtoMcqQuestionEdit($question_id)
{
	if ($this->session->userdata('admin_login') != 1)
             redirect(base_url(), 'refresh');
	else
	{
		
		$exam_id = '';
		$this->db->select('exam_id');
		$this->db->from('questions');
		$this->db->where('id', $question_id);
		$query = $this->db->get();
		foreach ($query->result() as $row) 
	    {
	    	$exam_id =  $row->exam_id;
	    }
	    $this->db->select('no_of_options');
	    $this->db->from('more_than_one_mcq'); 
	    $this->db->where('question_id',$question_id);
	    $query2 = $this->db->get();
	    foreach ($query2->result() as $row2) 
	    {
	    	$no_of_options =  (int)$row2->no_of_options;
	    }

 		$page_data['no_of_options']     = $no_of_options;
		$page_data['question_id']     	=  $question_id;
		$page_data['page_title']    = get_phrase('Update Exam Questions');
	    $page_data['page_name']     = 'updateExamMtoMcqQuestion';
	    $page_data['exam_id']     = $exam_id;
	    $this->load->view('backend/index', $page_data);
	}
}
public function descQuestionEdit($question_id)
{
	
	if ($this->session->userdata('admin_login') != 1)
             redirect(base_url(), 'refresh');
	else
	{
		$exam_id = '';
		$this->db->select('exam_id');
		$this->db->from('questions');
		$this->db->where('id', $question_id);
		$query = $this->db->get();
		foreach ($query->result() as $row) 
	    {
	    	$exam_id =  $row->exam_id;
	    }
		$page_data['question_id']     	=  $question_id;		
		$page_data['page_title']    = get_phrase('Update Exam Questions');
	    $page_data['page_name']     = 'updateExamDescQuestion';
	    $page_data['exam_id']     = $exam_id;
	    $this->load->view('backend/index', $page_data);
	}
}
public function fillMcqQuestion()
{
	if ($this->session->userdata('admin_login') != 1)
             redirect(base_url(), 'refresh');
	else
	{
		$question_id = $this->input->post('question_id');
		
		$mcq_id = '';
		$correct = '';
		$mcqQuestion = '';
		$mcqOptions = array();
		$this->db->select('*');
		$this->db->from('mcq');
		$this->db->where('question_id', $question_id);
		$query = $this->db->get();
		foreach ($query->result() as $row) 
	    {
	    	$mcq_id = $row->id;
	    	$mcqQuestion = $row->mcq;
	    }

		$this->db->select('*');
		$this->db->from('mcq_answers');
		$this->db->where('mcq_id', $mcq_id);
		$query3 = $this->db->get();

		$this->db->select('*');
		$this->db->from('mcq_options');
		$this->db->where('mcq_id', $mcq_id);
		$this->db->order_by('id', 'asc');	
		$query2 = $this->db->get();

		foreach ($query2->result() as $key=>$value) 
	    {
	    	array_push($mcqOptions, $value->value);
	    	foreach ($query3->result() as $row3) 
	    	{
	    		if($row3->correct_options_id==$value->id)
	    		{
	    			$correct = $key;
	    		}
	    	}	
	    }
	    echo json_encode(array("question" => $mcqQuestion, "options" => $mcqOptions, 'mcq_id'=> $mcq_id, 'question_id'=>$question_id, 'correct' => $correct));			
	}
}
public function fillMtoMcqQuestion()
{
	if ($this->session->userdata('admin_login') != 1)
             redirect(base_url(), 'refresh');
	else
	{
		$question_id = $this->input->post('question_id');
		
		$correct = array();
		$mto_mcq_id = '';
		$mtoMcqQuestion = '';
		$mtoMcqOptions = array();
		$this->db->select('*');
		$this->db->from('more_than_one_mcq');
		$this->db->where('question_id', $question_id);
		$query = $this->db->get();
		foreach ($query->result() as $row) 
	    {
	    	$mto_mcq_id = $row->id;
	    	$mtoMcqQuestion = $row->mto_mcq;
	    }

	    $this->db->select('*');
		$this->db->from('more_than_one_mcq_answers');
		$this->db->where('mto_mcq_id', $mto_mcq_id);
		$query3 = $this->db->get();

		$this->db->select('*');
		$this->db->from('more_than_one_mcq_options');
		$this->db->where('mto_mcq_id', $mto_mcq_id);
		$query2 = $this->db->get();
		foreach ($query2->result() as $key=>$value) 
	    {
	    	array_push($mtoMcqOptions, $value->value);
	    	foreach ($query3->result() as $row3) 
	    	{
	    		if($row3->correct_options_id==$value->id)
	    		{
	    			array_push($correct, $key);
	    		}
	    	}	
	    }
	    echo json_encode(array("question" => $mtoMcqQuestion, "options" => $mtoMcqOptions, 'mcq_id'=> $mto_mcq_id, 'question_id'=>$question_id, 'correct'=>$correct));	
	}
}
public function fillDescQuestion()
{
	if ($this->session->userdata('admin_login') != 1)
             redirect(base_url(), 'refresh');
	else
	{
		$question_id = $this->input->post('question_id');
		$this->db->select('descriptive');
		$this->db->from('descriptive');
		$this->db->where('question_id', $question_id);
		$query = $this->db->get();
		//	echo $question_id;
		foreach ($query->result() as $row) 
	    {
	    	echo $row->descriptive;
	    }	
	}
}
public function updateMcqQuestion()
{
	$question_id = $this->input->post('question_id');
	$mcqQuestion = $this->input->post('mcqQuestion');
	$mcqAnswer =  $this->input->post('mcqAnswer');
	$mcqOpt = $this->input->post('mcqOpt');
	$exam_id = $this->input->post('exam_id');
	$no_of_options = $this->input->post('no_of_options');
	
	// var_dump($mcqOpt);


	$this->db->select('*');
	$this->db->from('mcq');
	$this->db->where('question_id', $question_id);
	$query = $this->db->get();
	foreach ($query->result() as $row) 
    {
    	$mcq_id = (int)$row->id;
    }

    $this->db->select('id');
	$this->db->from('mcq_options');
	$this->db->where('mcq_id', $mcq_id);
	$this->db->order_by('id', 'asc');
	$query2 = $this->db->get();
	for ($i=0; $i < $no_of_options; $i++) 
	{ 
		foreach ($query2->result() as $key=>$value) 
	    {    	
	    	if($key == $i)
	    	{	    		
	    		$this->db->where('id', $value->id);
	    		$this->db->update('mcq_options', array('value' => $mcqOpt[$i]));		
	    	}
	    	if($mcqAnswer == $key+1)
	    	{    		
	    		$this->db->where('mcq_id', $mcq_id);
	    		$this->db->update('mcq_answers', array('correct_options_id' => $value->id));		
	    	}
	    }
	}
	$this->db->where('question_id', $question_id);
    $this->db->update('mcq', array('mcq' => $mcqQuestion));
	echo $exam_id;
	$this->session->set_flashdata('Question' , get_phrase('Question Updated Sucessfully'));
}
public function updateMtoMcqQuestion()
{
	$question_id = $this->input->post('question_id');
	$no_of_options = $this->input->post('no_of_options');
	$mtoMcqQuestion = $this->input->post('mtoMcqQuestion');
	$mtoMcqOpt = $this->input->post('mtoMcqOpt');
	$exam_id = $this->input->post('exam_id');
	$mtoMcqAnswer =  $this->input->post('mtoMcqAnswer');
	$mto_mcq_id = '';
	
	$this->db->select('*');
	$this->db->from('more_than_one_mcq');
	$this->db->where('question_id', $question_id);
	$query = $this->db->get();
	foreach ($query->result() as $row) 
    {
    	$mto_mcq_id = $row->id;
    }

    $this->db->select('id');
	$this->db->from('more_than_one_mcq_options');
	$this->db->where('mto_mcq_id', $mto_mcq_id);
	$this->db->order_by('id', 'asc');
	$query2 = $this->db->get();
	for ($i=0; $i < $no_of_options; $i++) 
	{ 
		foreach ($query2->result() as $key=>$value) 
	    {
	    	
	    	if($key == $i)
	    	{
	    		$this->db->where('id', $value->id);
	    		$this->db->update('more_than_one_mcq_options', array('value' => $mtoMcqOpt[$i]));		
	    	}
	    }
	}
    //update answer
    $this->db->where('mto_mcq_id', $mto_mcq_id);
  	$this->db->delete('more_than_one_mcq_answers');
  	$arr = array();	
	foreach ($mtoMcqAnswer as $thisAnswer) 
	{
		foreach ($query2->result() as $key => $value) 
		{			
			if(($key+1) == $thisAnswer)
			{
				$mtoMcqAnswerInsert = array(
				 	'mto_mcq_id' => $mto_mcq_id,
				 	'correct_options_id' => $value->id,
				);
				$this->db->insert('more_than_one_mcq_answers', $mtoMcqAnswerInsert);
			}	
		}		
	}
    //echo json_encode(array('xx'=>$arr));	
	$this->db->where('question_id', $question_id);
    $this->db->update('more_than_one_mcq', array('mto_mcq' => $mtoMcqQuestion));
    echo $exam_id;
    $this->session->set_flashdata('Question' , get_phrase('Question Updated Sucessfully'));
}
public function updateDescQuestion()
{
	$question_id = $this->input->post('question_id');
	$descQuestion = $this->input->post('descQuestion');
	$exam_id = $this->input->post('exam_id');

	$this->db->where('question_id', $question_id);
    $this->db->update('descriptive', array('descriptive' => $descQuestion));
    echo $exam_id;
    $this->session->set_flashdata('Question' , get_phrase('Question Updated Sucessfully'));
}


}