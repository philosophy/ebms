<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_Sessions_Table extends CI_Migration {

    public function up() {
        $this->dbforge->add_field(array(
            'session_id' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => TRUE,
                'default' => 0
            ),

            'ip_address' => array(
                'type' => 'VARCHAR',
                'constraint' => '16',
                'default' => 0
            ),
            'user_agent' => array(
                'type' => 'INT',
                'constraint' => '10',
                'unsigned' => TRUE,
                'default' => 0,
                'null' => FALSE
            ),
            'last_activity' => array(
                'type' => 'INT',
                'constraint' => '10',
                'unsigned' => TRUE,
                'default' => 0,
                'null' => FALSE
            ),
            'user_data' => array(
                'type' => 'TEXT',
                'null' => FALSE
            )
        ));

        $this->dbforge->add_key('session_id', TRUE);
        $this->dbforge->add_key('last_activity');
        $this->dbforge->create_table('sessions');
    }

    public function down() {
        $this->dbforge->drop_table('sessions');
    }

}
?>