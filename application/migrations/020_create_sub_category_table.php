<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_Sub_Category_Table extends CI_Migration {

    public function up() {
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'INT',
                'constraint' => '11',
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'code' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => FALSE
            ),
            'category_id' => array(
                'type' => 'INT',
                'constraint' => '11',
                'null' => FALSE
            ),
            'name' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
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
            'company_id' => array(
                'type' => 'INT',
                'constraint' => '11',
                'null' => FALSE
            )
            ));
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('sub_category');
    }

    public function down() {
        $this->dbforge->drop_table('sub_category');
    }
}