<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_Audit_Trail_Table extends CI_Migration {

    public function up() {
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'INT',
                'constraint' => '11',
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'user_id' => array(
                'type' => 'INT',
                'constraint' => '11',
                'null' => FALSE
            ),
            'subject_id' => array(
                'type' => 'INT',
                'constraint' => '11',
                'null' => FALSE
            ),
            'type' => array(
                'type' => 'INT',
                'constraint' => '11',
                'null' => FALSE
            ),
            'details' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => FALSE
            ),
            'date_created' => array(
                'type' => 'DATETIME',
                'null' => FALSE
            ),
            'company_id' => array(
                'type' => 'INT',
                'constraint' => '11',
                'null' => FALSE
            ),
            'table_name' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => FALSE
            )
            ));
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('audit_trail');
    }

    public function down() {
        $this->dbforge->drop_table('audit_trail');
    }
}