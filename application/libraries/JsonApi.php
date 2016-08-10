<?php
class JsonAPi
{
    protected $CI;
    protected $_v       = 1.0;
    protected $_k       = "8j65uLSXiQ9uK7BJ86k5i9f2H5ypBzqW";
    protected $response = array();
    protected $id       = null;
    protected $name;
    public function __construct($key = null, $version = null)
    {
        //$this->_k=!empty($key)?$key:null;
        $this->_v                 = !empty($version) ? $version : $this->_v;
        $this->response['status'] = 404;
        $this->CI                 = &get_instance();
        $this->CI->output->set_content_type('application/json', 'utf-8');
        $this->CI->load->model('User_model', 'user');
        $this->CI->load->model('Market_model', 'market');
    }

    private function push($field, $info)
    {
        $this->response[$field] = $info;
    }

    private function status($status)
    {
        $this->response['status'] = $status;
    }

    public function oAuth($key)
    {
        return $this->_k == $key;
    }

    public function isNotAuth($key)
    {
        if (!$this->oAuth($key)) {
            $this->push('status', 403);
            $this->push('message', 'Unauthorized');
            $this->output();
            return false;
        }
        return true;
    }

    public function output()
    {
        $this->CI->output->set_status_header($this->response['status']);
        $this->CI->output->set_output(json_encode($this->response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
        $this->CI->output->_display();
        die();
    }

    public function proccess($action, $name, $id = null)
    {
        $this->id   = $id;
        $this->name = $name;
        call_user_func(array($this, $action));
    }

    public function get()
    {
        if ($this->name == 'user') {
            if ($this->id == null) {
                $this->status(200);
                $this->push('users', $this->CI->user->all());
            } elseif ($this->id) {
                $this->status(200);
                $this->push('users', $this->CI->user->find($this->id));
            }
        } elseif ($this->name == "market") {
            if ($this->id == null) {
                $this->status(200);
                $this->push('markets', $this->CI->market->all());
            } elseif ($this->id) {
                $this->status(200);
                $this->push('markets', $this->CI->market->find($this->id));
            }
        }
    }

}
