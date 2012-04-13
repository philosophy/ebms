<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Additional_Users_Column extends CI_Migration {

    public function up() {
        $fields = array(
            'company_id' => array(
                'type' => 'INT',
                'constraint' => '11',
                'null' => FALSE
            ),
            'security_question_id' => array(
                'type' => 'INT',
                'constraint' => '11',
                'null' => TRUE
            ),
            'security_answer' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => TRUE
            ),
            'created_by' => array(
                'type' => 'INT',
                'constraint' => '11',
                'null' => FALSE
            ),
            'last_updated_by' => array(
                'type' => 'INT',
                'constraint' => '11',
                'null' => FALSE
            )
        );

        $this->dbforge->add_column('users', $fields);
    }

    public function down() {
        $this->dbforge->drop_column('users', 'company_id');
        $this->dbforge->drop_column('users', 'security_question_id');
        $this->dbforge->drop_column('users', 'security_answer');
        $this->dbforge->drop_column('users', 'created_by');
        $this->dbforge->drop_column('users', 'last_updated_by');
    }

}
?>
