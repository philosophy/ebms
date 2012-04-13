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
    private $group_id = 2;
    private $table_name = 'users';
    private $company_id;
    private $updated_at;
    private $created_by;
    private $last_updated_by;

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
    function set_group_id($val) {
        $this->group_id = trim($val);
    }
    function set_company_id($val) {
        $this->company_id = $val;
    }
    function set_created_by($val) {
        $this->created_by = $val;
    }
    function set_last_updated_by($val) {
        $this->last_updated_by = $val;
    }

    function get_userid() {
        return (int)$this->user_id;
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
    function get_group_id() {
        return $this->group_id;
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
    function get_company_id() {
        return (int)$this->company_id;
    }
    function get_created_by() {
        return (int)$this->company_id;
    }
    function get_last_updated_by() {
        return (int)$this->last_updated_by;
    }

    function update_profile() {
        $result = $this->ion_auth->update_user($this->user_id, array(
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
        ), $this->get_company_id());

        if ($result === TRUE) {
            /* insert audit UPDATE */
            parent::insertAuditTrail($this->get_userid(), 2, $this->get_userid(), lang('update_profile'), $this->get_company_id(), $this->table_name);
        }
        return $result;
    }

    function update_user() {
        $result = $this->ion_auth->update_user($this->user_id, array(
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
            'work_phone' => $this->get_work_phone(),
            'group_id' => $this->get_group_id()
        ));

        if ($result === TRUE) {
            /* insert audit UPDATE */
            parent::insertAuditTrail($this->get_last_updated_by(), 2, $this->get_userid(), lang('update_user'), $this->get_company_id(), $this->table_name);
        }

        return $result;
    }

    function updateSecuritySettings() {
/*        $result = $this->ion_auth->update_user($this->get_userid(), array(
            'security_question_id' => $this->get_securityQuestionId(),
            'security_answer' => $this->get_securityAnswer()
        ));*/

        $this->db->trans_start();
        $data = array(
            'security_question_id' => $this->get_securityQuestionId(),
            'security_answer' => $this->get_securityAnswer()
        );

        $this->db->where('id', $this->get_userid());
        $this->db->update('users', $data);

        /* insert audit UPDATE */
        parent::insertAuditTrail($this->get_last_updated_by(), 2, $this->get_userid(), lang('update_employee_status'), $this->get_company_id(), $this->table_name);

        $this->db->trans_complete();
        if ($this->db->trans_status() === TRUE) {
            return true;
        } else {
            return false;
        }

//        if ($result === TRUE) {
//            /* insert audit UPDATE */
//            parent::insertAuditTrail($this->get_userid(), 2, $this->get_userid(), lang('update_security'), $this->get_company_id(), $this->table_name);
//        }
//        return $result;
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
        $result = $this->ion_auth->register(
                    $this->get_username(),
                    $this->get_password(),
                    $this->get_email(),
                    array(
                        'first_name' => $this->get_first_name(),
                        'last_name' => $this->get_last_name(),
                        'middle_name' => $this->get_middle_name(),
                        'address' => $this->get_address(),
                        'group_id' => $this->get_group_id()
                    )
                );

        $sql = 'SELECT id from users where company_id = ? and created_by = ? order by date_created desc limit 1';
        $query = $this->db->query($sql, array('company_id' => $this->get_company_id(), 'created_by' => $this->get_created_by()));

        if ($result === TRUE) {
            /* insert audit UPDATE */
            parent::insertAuditTrail($this->get_created_by(), 2, $query->row()->id, lang('create_user'), $this->get_company_id(), $this->table_name);
        }
        return $result;
    }

    function deactivateUser() {
        $result = $this->ion_auth->deactivate_user($this->get_userid());

        if ($result === TRUE) {
            /* insert audit DELETE */
            parent::insertAuditTrail($this->get_last_updated_by(), 3, $this->get_userid(), lang('deactivate_user'), $this->get_company_id(), $this->table_name);
        }
        return $result;
    }

    function activateUser() {
        $result = $this->ion_auth->activate_user($this->get_userid());
        if ($result === TRUE) {
            /* insert audit UPDATE */
            parent::insertAuditTrail($this->get_last_updated_by(), 2, $this->get_userid(), lang('activate_user'), $this->get_company_id(), $this->table_name);
        }
        return $result;
    }
}

?>
