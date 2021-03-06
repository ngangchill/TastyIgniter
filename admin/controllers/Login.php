<?php if ( ! defined('BASEPATH')) exit('No direct access allowed');

class Login extends Admin_Controller {

	public function index() {
		$this->lang->load('login');

        if ($this->user->islogged()) {
  			redirect('dashboard');
		}

        $this->template->setTitle($this->lang->line('text_title'));

        $data['site_name']  = $this->config->item('site_name');
        $data['reset_url'] = site_url('login/reset');

		if ($this->input->post() AND $this->validateLoginForm() === TRUE) {
            if (!$this->user->login($this->input->post('user'), $this->input->post('password'))) {										// checks if form validation routines ran successfully
                $this->alert->set('danger', $this->lang->line('alert_username_not_found'));
                redirect('login');
            } else {
                log_activity($this->user->getStaffId(), 'logged in', 'staffs', get_activity_message('activity_logged_in',
                    array('{staff}', '{link}'),
                    array($this->user->getStaffName(), admin_url('staffs/edit?id='.$this->user->getStaffId()))
                ));

                if ($previous_url = $this->session->tempdata('previous_url')) {
                    $this->session->unset_tempdata('previous_url');
                    redirect($previous_url);
                }

                redirect(referrer_url());
            }
        }

		$this->template->render('login', $data);
	}

	public function reset() {
        $this->lang->load('login');

        $this->load->model('Staffs_model');
		if ($this->user->islogged()) {
  			redirect('dashboard');
		}

        $this->template->setTitle($this->lang->line('text_password_reset_title'));
		$data['login_url'] = site_url('login');

		if ($this->input->post() AND $this->validateResetForm() === TRUE) {
			redirect('login');
		}

		$this->template->render('login_reset', $data);
	}

	private function validateLoginForm() {
		// START of form validation rules
		$this->form_validation->set_rules('user', 'lang:label_username', 'xss_clean|trim|required');
		$this->form_validation->set_rules('password', 'lang:label_password', 'xss_clean|trim|required|min_length[6]|max_length[32]');
		// END of form validation rules

		if ($this->form_validation->run() === TRUE) {
            return TRUE;
        } else {
            return FALSE;
        }
	}

	private function validateResetForm() {
		$this->form_validation->set_rules('user_email', 'lang:label_username_email', 'xss_clean|trim|required|callback__check_user');	//validate form

		if ($this->form_validation->run() === TRUE) {										// checks if form validation routines ran successfully
			if ($this->Staffs_model->resetPassword($this->input->post('user_email'))) {		// checks if form validation routines ran successfully
				$this->alert->set('success', $this->lang->line('alert_success_reset'));
				return TRUE;
			} else {
				$this->alert->set('danger', $this->lang->line('alert_email_not_sent'));
				redirect('login/reset');
			}
		} else {
			return FALSE;
		}
	}

	public function _check_user($str) {
		if (!$this->Staffs_model->resetPassword($str)) {
			$this->form_validation->set_message('_check_user', $this->lang->line('error_no_user_found'));
			return FALSE;
		}

		return TRUE;
	}
}

/* End of file login.php */
/* Location: ./admin/controllers/login.php */