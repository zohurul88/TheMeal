<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Migration_Create_meallist extends CI_Migration
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
            'mealdate'     => array(
                'type'       => 'DATETIME', 
                'null'       => false, 
            ),
            'meal' => array(
                'type'       => 'INT',
                'constraint' => 2,
            ),
        ));
        $this->dbforge->add_key('id', true);
        $this->dbforge->create_table('meallist');
    }

    public function down()
    {
        $this->dbforge->drop_table('meallist');
    }
}
