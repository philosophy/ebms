<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_Employees_Table extends CI_Migration {

    public function up() {
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'INT',
                'constraint' => '11',
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'employee_code' => array(
                'type' => 'VARCHAR',
                'constraint' => '50',
                'null' => FALSE
            ),
            'first_name' => array(
                'type' => 'VARCHAR',
                'constraint' => '50',
                'null' => FALSE
            ),
            'middle_name' => array(
                'type' => 'VARCHAR',
                'constraint' => '30',
                'null' => FALSE
            ),
            'last_name' => array(
                'type' => 'VARCHAR',
                'constraint' => '50',
                'null' => FALSE
            ),
            'address' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => FALSE
            ),
            'date_of_birth' => array(
                'type' => 'DATE',
                'null' => FALSE
            ),
            'gender' => array(
                'type' => 'INT',
                'constraint' => '2',
                'null' => FALSE
            ),
            'marital_status' => array(
                'type' => 'INT',
                'constraint' => '1',
                'null' => FALSE
            ),
            'home_phone' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => TRUE,
            ),
            'work_phone' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => TRUE,
            ),
            'date_hired' => array(
                'type' => 'DATE',
                'null' => TRUE
            ),
            'sss_no' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => TRUE
            ),
            'tin_no' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => TRUE
            ),
            'philhealth' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => TRUE
            ),
            'pagibig' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => TRUE
            ),
            'salary' => array(
                'type' => 'DECIMAL',
                'constraint' => '10,2',
                'null' => TRUE
            ),
            'active' => array(
                'type' => 'INT',
                'default' => '1',
                'null' => FALSE
            ),
            'employee_status_id' => array(
                'type' => 'INT',
                'constraint' => '11',
                'null' => TRUE
            ),
            'department_id' => array(
                'type' => 'INT',
                'constraint' => '11',
                'null' => TRUE
            ),
            'position_id' => array(
                'type' => 'INT',
                'constraint' => '11',
                'null' => TRUE
            ),
            'created_by' => array(
                'type' => 'INT',
                'constraint' => '11',
                'null' => FALSE
            ),
            'date_created' => array(
                'type' => 'DATETIME',
                'null' => FALSE
            ),
            'last_updated_by' => array(
                'type' => 'INT',
                'constraint' => '11',
                'null' => TRUE
            ),
            'last_updated_at' => array(
                'type' => 'DATETIME',
                'null' => TRUE
            ),
            'company_id' => array(
                'type' => 'INT',
                'constraint' => '11',
                'null' => FALSE
            )
        ));

        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('employees');
    }

    public function down() {
        $this->dbforge->drop_table('employees');
    }

}
?>