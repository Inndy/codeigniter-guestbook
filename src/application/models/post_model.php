<?php

class Post_model extends CI_Model
{
    public $author;
    public $title;
    public $content;
    public $del_pwd;

    public function __construct($from = null)
    {
        // Call the CI_Model constructor
        parent::__construct();
		$this->load->database();
        if(is_array($from)) {
            $this->fill($from);
        }
    }

    public function fill($from, $fields = ['author', 'title', 'content', 'del_pwd'])
    {
        foreach($fields as $field) {
            $this->$field = $from[$field];
        }
    }

    public function find($id)
    {
        return $this->db->get_where('posts', ['id' => $id])->result()[0] ?: null;
    }

    public function get_all()
    {
        return $this->db->get('posts')->result();
    }

    public function get_last($n = 10)
    {
        $query = $this->db->select('*')->from('posts')->limit($n)->order_by('id', 'DESC');
        return $query->get()->result();
    }

    public function insert()
    {
        $ret = $this->db->insert('posts', $this);
        if ($ret) {
            $this->id = $this->db->insert_id();
            return true;
        } else {
            return false;
        }
    }

    public function update($id)
    {
        $this->db->update('posts', $this, ['id' => $id]);
    }

    public function delete($id)
    {
        $this->db->delete('posts', ['id' => $id]);
    }
}
