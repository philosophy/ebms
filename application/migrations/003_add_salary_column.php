<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_salary_column extends CI_Migration {

    public function up() {
        $fields = array(
            'salary' => array(
                'type' => 'DECIMAL',
                'constraints' => '(10,2)',
                'null' => TRUE
            ));

        $this->dbforge->add_column('users', $fields);
    }

    public function down() {
        $this->dbforge->drop_column('users', 'salary');
    }

}
?>