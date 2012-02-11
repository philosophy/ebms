<?php

class User_model extends CI_Model {

    private $user_id = '';
    private $username = '';
    private $first_name = '';
    private $middle_name = '';
    private $last_name = '';
    private $email = '';
    private $address;
    private $gender;
    private $date_of_birth;
    private $status_id;
    private $home_phone;
    private $work_phone;
    private $password;
    private $new_password;
    private $security_question_id;
    private $security_answer;

    function __construct() {
        parent::__construct();
    }

    function set_userid($val) {
        $this->user_id = $val;
    }
    function set_username($val) {
        $this->username = $val;
    }
    function set_first_name($val) {
        $this->first_name = $val;
    }
    function set_middle_name($val) {
        $this->middle_name = $val;
    }
    function set_last_name($val) {
        $this->last_name = $val;
    }
    function set_email($val) {
        $this->email = $val;
    }
    function set_address($val) {
        $this->address = $val;
    }
    function set_gender($val) {
        $this->gender = $val;
    }
    function set_date_of_birth($val) {
        $this->date_of_birth = $val;
    }
    function set_status_id($val) {
        $this->status_id = $val;
    }
    function set_home_phone($val) {
        $this->home_phone = $val;
    }
    function set_work_phone($val) {
        $this->work_phone = $val;
    }
    function set_password($val) {
        $this->password = trim($val);
    }
    function set_new_password($val) {
        $this->new_password = trim($val);
    }
    function set_securityQuestionId($val) {
        $this->security_question_id = $val;
    }
    function set_securityAnswer($val) {
        $this->security_answer = trim($val);
    }

    function get_userid() {
        return $this->user_id;
    }
    function get_username() {
        return  $this->username;
    }
    function get_first_name() {
        return $this->first_name;
    }
    function get_middle_name() {
        return $this->middle_name;
    }
    function get_last_name() {
        return $this->last_name;
    }
    function get_email() {
        return $this->email;
    }
    function get_address() {
        return $this->address;
    }
    function get_gender() {
        return $this->gender;
    }
    function get_date_of_birth() {
        return $this->date_of_birth;
    }
    function get_status_id() {
        return $this->status_id;
    }
    function get_home_phone() {
        return  $this->home_phone;
    }
    function get_work_phone() {
        return $this->work_phone;
    }
    function get_password() {
        return $this->password;
    }
    function get_new_password() {
        return $this->new_password;
    }
    function get_securityQuestionId() {
        return  $this->security_question_id;
    }
    function get_securityAnswer() {
        return $this->security_answer;
    }

    function update_profile() {
        return $this->ion_auth->update_user($this->user_id, array(
            'username' => $this->get_username(),
            'first_name' => $this->get_first_name(),
            'middle_name' => $this->get_middle_name(),
            'last_name' => $this->get_last_name(),
            'email' => $this->get_email(),
            'address' => $this->get_address(),
            'gender' => $this->get_gender(),
            'date_of_birth' => $this->get_date_of_birth(),
            'status_id' => $this->get_status_id(),
            'home_phone' => $this->get_home_phone(),
            'work_phone' => $this->get_work_phone()
        ));
    }

    function updateSecuritySettings() {
        $result = $this->ion_auth->update_user($this->get_userid(), array(
            'security_question_id' => $this->get_securityQuestionId(),
            'security_answer' => $this->get_securityAnswer()
        ));
        return $result;
    }

    function updatePassword() {
        return $this->ion_auth->update_user($this->get_userid(), array(
            'password' => $this->get_new_password()
        ));
    }

    function emailExists() {
        $sql = "SELECT * FROM users WHERE id != ? and email = ?";
        $query = $this->db->query($sql, array($this->get_userid(), $this->get_email()));

        if ($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    function retrieveUserEmail() {
        $sql = "SELECT email FROM users WHERE id = ?";
        $query = $this->db->query($sql, array($this->get_userid()));

        if ($query->num_rows() > 0) {
            $row = $query->row();
            return $row->email;
        } else {
            return null;
        }
    }

    function verifyOldPassword() {
        $sql = "SELECT password FROM users where id = ?";
        $query = $this->db->query($sql, array($this->get_userid()));

        if ($query->num_rows() > 0) {
            $row = $query->row();
            $oldpass = $row->password;
        } else {
            return false;
        }
        $new_pass =  $this->ion_auth->hash_password_db($this->get_email(), $this->get_password());
        if ($oldpass == $new_pass) {
            return true;
        } else {
            return false;
        }
    }

    function createUser() {
        return $this->ion_auth->register(
                    $this->get_username(),
                    $this->get_password(),
                    $this->get_email(),
                    array(
                        'first_name' => $this->get_first_name(),
                        'last_name' => $this->get_last_name(),
                        'middle_name' => $this->get_middle_name(),
                        'address' => $this->get_address()
                    )
                );
    }
}

?>
