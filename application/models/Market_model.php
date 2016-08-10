<?php

class Market_model extends CI_Model
{
    private $table = "market";
    public function __construct()
    {
        parent::__construct();
    }

    public function save($req)
    {
        if (isset($req->id)) {

        } else {
            $this->day = $req->day; // please read the below note
            $this->user_id    = $req->user; 
            if ($this->db->insert($this->table, $this)) {
                $response = array('status' => 200);
            }
        }
        return $response;
    }

    public function all()
    {
        $this->db->select('*');
        $this->db->from($this->table.' a'); 
        $this->db->join('user b', 'b.id=a.user_id', 'left');  
        return $this->db->get()->result();
    }

    public function find($id)
    {
        $this->db->select('*');
        $this->db->from($this->table.' a'); 
        $this->db->join('user b', 'b.id=a.user_id', 'left');  
        $this->db->where('a.id',$id);
        return $this->db->get()->result();
    }

}
