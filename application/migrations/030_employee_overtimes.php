<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_Employee_Overtimes_Table extends CI_Migration {

    public function up() {
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'INT',
                'constraint' => '11',
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'employee_id' => array(
                'type' => 'INT',
                'constraint' => '11',
                'null' => FALSE
            ),
            'date' => array(
                'type' => 'DATETIME',
                'null' => FALSE
            ),
            'minutes' => array(
                'type' => 'INT',
                'constraint' => '11',
                'null' => TRUE
            ),
            'flag' => array(
                'type' => 'INT',
                'constraint' => '11',
                'null' => FALSE,
                'default' => 0
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
                'null' => FALSE
            ),
            'last_updated_at' => array(
                'type' => 'DATETIME',
                'null' => FALSE
            ),
            'active' => array(
                'type' => 'INT',
                'default' => '1',
                'null' => FALSE
            ),
            'company_id' => array(
                'type' => 'INT',
                'constraint' => '11',
                'null' => FALSE
            )
            ));
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('employee_overtimes');
    }

    public function down() {
        $this->dbforge->drop_table('employee_times');
    }
}