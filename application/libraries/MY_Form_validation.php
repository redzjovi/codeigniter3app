<?php

class MY_Form_validation extends CI_Form_validation
{
    protected $ci;

    function __construct()
    {
        parent::__construct();
        $this->ci =& get_instance();
    }

    public function recaptcha_check()
    {
        $this->ci->load->library('recaptcha');

        // Catch the user's answer
        $captcha_answer = $this->ci->input->post('g-recaptcha-response');

        // Verify user's answer
        $response = $this->ci->recaptcha->verifyResponse($captcha_answer);

        if ($response['success']) // Your success code here
        {
            return TRUE;
        }
        else // Something goes wrong
        {
            $this->ci->form_validation->set_message('recaptcha_check', $response);
            return FALSE;
        }
    }
}
