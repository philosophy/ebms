<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_Archive_Column extends CI_Migration {

    public function up() {
        $fields = array(
            'archive' => array(
                'type' => 'INT',
                'constraint' => '1',
                'null' => TRUE
            ),
            );

        $this->dbforge->add_column('users', $fields);
    }

    public function down() {
        $this->dbforge->drop_column('users', 'archive');
    }

}
?>
