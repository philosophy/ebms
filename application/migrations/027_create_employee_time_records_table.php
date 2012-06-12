<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_Employee_Time_Records_Table extends CI_Migration {

    public function up() {
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'INT',
                'constraint' => '11',
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'record_date' => array(
                'type' => 'DATETIME',
                'null' => FALSE
            ),
            'time_in' => array(
                'type' => 'DATETIME',
                'null' => FALSE
            ),
            'time_out' => array(
                'type' => 'DATETIME',
                'null' => TRUE
            ),
            'total_hours_worked' => array(
                'type' => 'int',
                'constraint' => '11',
                'null' => TRUE
            ),
            'total_minutes_worked' => array(
                'type' => 'int',
                'constraint' => '11',
                'null' => TRUE
            ),
            'active' => array(
                'type' => 'INT',
                'default' => '1',
                'null' => FALSE
            ),
            'employee_id' => array(
                'type' => 'INT',
                'constraint' => '11',
                'null' => FALSE
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
        $this->dbforge->create_table('employee_time_records');
    }

    public function down() {
        $this->dbforge->drop_table('employee_time_records');
    }

}
?>