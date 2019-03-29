<?php

class MY_Form_validation extends CI_Form_validation
{
    protected $CI;

    public function __construct()
    {
        parent::__construct();
        $this->CI =& get_instance();
    }

    /**
     * @param string $valuw
     * @param string $tableAndColumn Ie. "domain,url"
     * @return bool
     */
    public function not_exists($value, $tableAndColumn)
    {
        $tableAndColumnArray = explode(',', $tableAndColumn);
        $table = $tableAndColumnArray[0];
        $column = $tableAndColumnArray[1];

        $this->CI->load->database();
        $count = $this->CI->db->from($table)->where($column, $value)->count_all_results();
        if ($count === 0)
        {
            $this->CI->form_validation->set_message('not_exists', 'The %s field does not exist in '.$table.'.');
            return FALSE;
        }

        return TRUE;
    }

    public function recaptcha_check()
    {
        $this->CI->load->library('recaptcha');

        // Catch the user's answer
        $captcha_answer = $this->CI->input->post('g-recaptcha-response');

        // Verify user's answer
        $response = $this->CI->recaptcha->verifyResponse($captcha_answer);

        if ($response['success']) // Your success code here
        {
            return TRUE;
        }
        else // Something goes wrong
        {
            $this->CI->form_validation->set_message('recaptcha_check', $response);
            return FALSE;
        }
    }
}
