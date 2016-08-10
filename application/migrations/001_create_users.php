<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Migration_Create_users extends CI_Migration
{

    public function up()
    {
        $this->dbforge->add_field(array(
            'id'               => array(
                'type'           => 'INT',
                'constraint'     => 11, 
                'auto_increment' => true,
            ),
            'fullname'       => array(
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ),
            'email'       => array(
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ),
            'password'       => array(
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ) 
        ));
        $this->dbforge->add_key('id', true);
        $this->dbforge->create_table('user');
    }

    public function down()
    {
        $this->dbforge->drop_table('user');
    }
}
