<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_Work_Experience_Table extends CI_Migration {

    public function up() {
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'INT',
                'constraint' => '11',
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'company_name' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => FALSE,
            ),
            'date_started' => array(
                'type' => 'DATE',
                'null' => FALSE
            ),
            'date_ended' => array(
                'type' => 'DATE',
                'null' => FALSE
            ),
            'work_description' => array(
                'type' => 'VARCHAR',
                'constraint' => '500',
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
            'employee_id' => array(
                'type' => 'INT',
                'constraint' => '11',
                'null' => FALSE
            )
            ));
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('work_experience');
    }

    public function down() {
        $this->dbforge->drop_table('work_experience');
    }
}