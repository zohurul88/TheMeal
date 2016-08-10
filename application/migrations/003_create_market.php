<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Migration_Create_market extends CI_Migration
{

    public function up()
    {
        $this->dbforge->add_field(array(
            'id'       => array(
                'type'           => 'INT',
                'constraint'     => 11,
                'auto_increment' => true,
            ),
            'user_id'  => array(
                'type'       => 'INT',
                'constraint' => 11,
            ),
            'day'     => array(
                'type'       => 'ENUM("su","mo","tu","we","th","fr","sa")',
            ) 
        ));
        $this->dbforge->add_key('id', true);
        $this->dbforge->create_table('market');
    }

    public function down()
    {
        $this->dbforge->drop_table('market');
    }
}
