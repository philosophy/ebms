<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_Educational_Background_Table extends CI_Migration {

    public function up() {
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'INT',
                'constraint' => '11',
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'school_name' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => FALSE
            ),
            'date_graduated' => array(
                'type' => 'DATETIME',
                'null' => FALSE
            ),
            'remarks' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
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
        $this->dbforge->create_table('educational_background');
    }

    public function down() {
        $this->dbforge->drop_table('educational_background');
    }
}