<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_Employee_Schedule_Table extends CI_Migration {

    public function up() {
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'INT',
                'null' => FALSE,
                'auto_increment' => TRUE
            ),

            'day' => array(
                'type' => 'INT',
                'null' => FALSE
            ),
            'start_time' => array(
                'type' => 'DATETIME',
                'null' => FALSE
            ),
            'end_time' => array(
                'type' => 'DATETIME',
                'null' => FALSE
            ),
            'start_break_time' => array(
                'type' => 'DATETIME',
                'null' => FALSE
            ),
            'end_break_time' => array(
                'type' => 'DATETIME',
                'null' => FALSE
            ),
            'active' => array(
                'type' => 'TINYINT',
                'null' => FALSE
            ),
            'created_by' => array(
                'type' => 'INT',
                'null' => FALSE
            ),
            'date_created' => array(
                'type' => 'DATETIME',
                'null' => FALSE
            ),
            'last_updated_by' => array(
                'type' => 'INT',
                'null' => TRUE,
            ),
            'last_updated_at' => array(
                'type' => 'DATETIME',
                'null' => TRUE
            ),
            'employee_id' => array(
                'type' => 'INT',
                'null' => FALSE
            )
        ));

        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('employee_schedule');
    }

    public function down() {
        $this->dbforge->drop_table('employee_schedule');
    }

}
?>