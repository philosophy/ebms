<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Update_Users_Table extends CI_Migration {

    public function up() {
        $fields = array(
            'first_name' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => TRUE
            ),
            'middle_name' => array(
                'type' => 'VARCHAR',
                'constraint' => '50',
                'null' => TRUE
            ),
            'last_name' => array(
                'type' => 'VARCHAR',
                'constraint' => '50',
                'null' => TRUE
            ),
            'address' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => TRUE
            ),
            'gender' => array(
                'type' => 'INT',
                'constraint' => '1',
                'null' => TRUE
            ),
            'date_of_birth' => array(
                'type' => 'DATETIME',
                'null' => TRUE
            ),
            'status' => array(
                'type' => 'INT',
                'constraint' => '1',
                'null' => TRUE
            ),
            'home_phone' => array(
                'type' => 'VARCHAR',
                'constraint' => '50',
                'null' => TRUE
            ),
            'work_phone' => array(
                'type' => 'VARCHAR',
                'constraint' => '50',
                'null' => TRUE
            ),
             'date_hired' => array(
                'type' => 'DATETIME',
                'null' => TRUE
            ),
            'sss_no' => array(
                'type' => 'VARCHAR',
                'constraint' => '50',
                'null' => TRUE
            ),
            'tin_no' => array(
                'type' => 'VARCHAR',
                'constraint' => '50',
                'null' => TRUE
            ),
            'philhealth' => array(
                'type' => 'VARCHAR',
                'constraint' => '50',
                'null' => TRUE
            ),
            'pagibig' => array(
                'type' => 'VARCHAR',
                'constraint' => '50',
                'null' => TRUE
            ),
            'archive' => array(
                'type' => 'INT',
                'constraint' => '1',
                'null' => TRUE
            ),
            'employee_status_id' => array(
                'type' => 'INT',
                'null' => TRUE
            )
            );

        $this->dbforge->add_column('users', $fields);
    }

    public function down() {
        $this->dbforge->drop_column('users', 'first_name');
        $this->dbforge->drop_column('users', 'last_name');
        $this->dbforge->drop_column('users', 'middle_name');
        $this->dbforge->drop_column('users', 'address');
        $this->dbforge->drop_column('users', 'gender');
        $this->dbforge->drop_column('users', 'date_of_birth');
        $this->dbforge->drop_column('users', 'status');
        $this->dbforge->drop_column('users', 'home_phone');
        $this->dbforge->drop_column('users', 'work_phone');
        $this->dbforge->drop_column('users', 'sss_no');
        $this->dbforge->drop_column('users', 'tin_no');
        $this->dbforge->drop_column('users', 'philhealth');
        $this->dbforge->drop_column('users', 'pagibig');
        $this->dbforge->drop_column('users', 'employee_status_id');
    }

}
?>
