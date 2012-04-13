<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_Status_Id_Column extends CI_Migration {

    public function up() {
        $fields = array(
            'status_id' => array(
                'type' => 'INT',
                'constraint' => '1',
                'null' => TRUE,
                'default' => 0
            ),
            );

        $this->dbforge->add_column('users', $fields);
    }

    public function down() {
        $this->dbforge->drop_column('users', 'status_id');
    }

}
?>
