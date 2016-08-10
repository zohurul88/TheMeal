<?php

class User_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function get_last_ten_entries()
    {
        $query = $this->db->get('user', 10);
        //var_dump($query->result());
    }

    public function ajax_insert($req)
    {
    	if(!$this->is_ajax()){
    		return array('status'=>403);
    	}
        $this->fullname = $req->name; // please read the below note
        $this->email    = $req->email;
        $this->password = md5($req->password);
        if ($this->db->insert('user', $this)) {
            $response = array('status' => 200);
            $this->db->where("id", $this->db->insert_id());
            $query            = $this->db->get("user");
            $result           = $query->result();unset($result['password']);
            $response['data'] = $result[0];
        } else {
            $response = array('status' => 500);
            $response = array('error' => "Nothing To Insert/ Internel Error");
        }
        return $response;
    }

    private function is_ajax()
    {
    	return (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest' && isset($_SERVER['HTTP_AUTHORITY']) && $_SERVER['HTTP_AUTHORITY']==md5(session_id()));
    }

    public function all()
    {
        return $this->db->get("user")->result();
    }

    public function find($id)
    {
        $this->db->where('id',$id);
        return $this->db->get("user")->result();
    }

    public function allID()
    {
        $userid=array();
        foreach($this->db->get("user")->result() as $user)
            $userid[$user->id]=$user;
        return $userid;
    }

    public function delete($id)
    {
        if(!$this->is_ajax()){
            return array('status'=>403);
        }
        $this->db->where('id',$id);
        $this->db->delete('user');
        if($this->db->affected_rows())
            return array('status'=>200,'msg'=>'User Deleted');
        return array('status'=>404,'msg'=>'User Not Found!');
    }

    public function can_login($user,$pass)
    {
        $this->db->where('email',$user);
        $this->db->where('password',$pass); 
        $query=$this->db->get("user");
        if($query->num_rows()>0)
            {return $query->result()[0]->id;}
        return false;
    }
}
