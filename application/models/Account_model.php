<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Account_model extends CI_Model {
	var $table = 'view_account';
	var $column = array('id_user', 'username', 'fullname', 'designation', 'tgl_lahir', 'no_hp', 'email', 'nm_role', 'user_status', 'nm_processby'); //set column field database for order and search
	var $order = array('id_user' => 'desc'); // default order 
	
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->library('session');
	}
	
	function _get_datatables_query()
	{
		$this->db->from($this->table);

		$i = 0;
	
		foreach ($this->column as $item) // loop column 
		{
			if($_POST['search']['value']) // if datatable send POST for search
			{
				
				if($i===0) // first loop
				{
					$this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND. 
					$this->db->like($item, $_POST['search']['value']);
				}
				else
				{
					$this->db->or_like($item, $_POST['search']['value']);
				}

				if(count($this->column) - 1 == $i) //last loop
					$this->db->group_end(); //close bracket
			}
			$column[$i] = $item; // set column array variable to order processing
			$i++;
		}
		
		if(isset($_POST['order'])) // here order processing
		{
			$this->db->order_by($column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		} 
		else if(isset($this->order))
		{
			$order = $this->order;
			$this->db->order_by(key($order), $order[key($order)]);
		}
	}
	
	function get_datatables()
	{
		$this->_get_datatables_query();
		if($_POST['length'] != -1)
		$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get();
		return $query->result();
	}

	function count_filtered()
	{
		$this->_get_datatables_query();
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function count_all()
	{
		$this->db->from($this->table);
		return $this->db->count_all_results();
	}

	function test_conn(){
		$query= $this->db->query('SELECT * from tbl_user');
		return $query->result();
	}
	
	function login($username, $password)
	{
        
		$query = $this->db->query('SELECT tbl_user.id_user, tbl_user.insert_date, tbl_user.insert_by, tbl_user.update_date, tbl_user.update_by,
								   tbl_user.username, tbl_user.fullname, tbl_user.designation, tbl_user.email, tbl_user.id_role,
								   tbl_user.user_pictures, tbl_user.user_status, tbl_role.nm_role FROM tbl_user
								   LEFT JOIN tbl_role ON tbl_user.id_role = tbl_role.id_role
								   WHERE tbl_user.username = "'.$username.'" AND tbl_user.password = "'.MD5($password).'" AND tbl_user.user_status = "Aktif"  LIMIT 1');
								   
        if($query->num_rows() == 1)
		{
            
			return $query->result(); //if data is true
        }
		else
		{
            return false; //if data is wrong
        }
		
    }
	
	function get_jkel()
	{
		$table = 'tbl_user';
		$field = 'jkel';
		
		//$jkel = array('' => '');
        if ($table == '' || $field == '') return $jkel;
        $CI =& get_instance();
        preg_match_all("/'(.*?)'/", $CI->db->query("SHOW COLUMNS FROM {$table} LIKE '{$field}'")->row()->Type, $matches);
        foreach ($matches[1] as $key => $value)
		{
            $jkel[$value] = $value; 
		}
		$jkel=array("Laki-laki"=>"Laki-laki","Perempuan"=>"Perempuan","Lainnya"=>"Lainnya");
        return $jkel;
	}
	
	function get_role()
	{
		$id_role = $this->session->userdata('id_role');
		
		if($id_role == '1')
		{	
			$query = $this->db->query('SELECT * FROM tbl_role ORDER BY id_role ASC');
		}
		else
		{
			$query = $this->db->query("SELECT * FROM tbl_role WHERE id_role != '1' ORDER BY id_role ASC");
		}	
		
		$role = array('' => '');
		foreach ($query->result() as $detail_role)
		{
                $role[$detail_role->id_role] = $detail_role->nm_role;
        }
		return $role;
	}
	
	
	function get_user_status()
	{
		$table = 'tbl_user';
		$field = 'user_status';
		
		$user_status = array('' => '');
        if ($table == '' || $field == '') return $user_status;
        $CI =& get_instance();
        preg_match_all("/'(.*?)'/", $CI->db->query("SHOW COLUMNS FROM {$table} LIKE '{$field}'")->row()->Type, $matches);
        foreach ($matches[1] as $key => $value)
		{
            $user_status[$value] = $value; 
        }
        return $user_status;
	}
	
	function username_check($username)
	{
		$this->db->select('*');
        $this->db->from('tbl_user');
        $this->db->where('username', $username);
        $this->db->limit(1);
		
		$query = $this->db->get();
        if($query->num_rows() == 1)
		{
            return false; //if data is true
        }
		else
		{
            return true; //if data is wrong
        }
	}
	
	function password_check($password, $id_user)
	{
		$this->db->where('username', $this->session->userdata('username'));
        $this->db->where('id_user', $id_user);
		$this->db->where('password', $password);
		$query = $this->db->get('tbl_user');
		
        if($query->num_rows() > 0)
		{
            return true; //if data is true
        }
		else
		{
            return false; //if data is wrong
        }
	}
	
	function get_id_user()
	{
		$query = $this->db->query("SELECT IFNULL(MAX(nomor)+1,1) AS nomor FROM tbl_user WHERE DATE_FORMAT(insert_date,'%Y%m')= DATE_FORMAT(NOW(),'%Y%m')");
		$row = $query->row();
		$nomor = $row->nomor;
				
		$tahun = date ('Ym');
		$id_user = sprintf( '%s%03d' , $tahun , $nomor );
		
		$account = array('nomor' => $nomor,
						 'id_user' => $id_user
		);
		
		return $account;
	}
	
	function save_detail_account($data)
	{
		$this->db->insert('tbl_user', $data);
		return $this->db->insert_id();				   
	}
	
	function get_detail_account($id_user)
	{
		$account = $this->db->query('SELECT * FROM tbl_user WHERE id_user="'.$id_user.'"');
		return $account->row();						   
	}
	
	function update_detail_account($id_user, $data)
	{
		$this->db->update('tbl_user', $data, $id_user);
		return $this->db->affected_rows();			   
	}
	
	function delete_detail_account($id_user)
	{
		$this->db->where('id_user', $id_user);
		$this->db->delete('tbl_user');
	}
	
	function update_all_tables($id_user)
	{
		
	}
	
	function view_detail_account($id_user)
	{
		$approval = $this->db->query("SELECT tbl_user.id_user, tbl_user.username, tbl_user.fullname, tbl_user.designation, 
									  DATE_FORMAT(tbl_user.tgl_signin, '%d') AS tgl_signin, DATE_FORMAT(tbl_user.tgl_signin, '%m') AS bln_signin, DATE_FORMAT(tbl_user.tgl_signin, '%Y') AS thn_signin,	
									  tbl_user.tmp_lahir, tbl_user.jkel,
									  DATE_FORMAT(tbl_user.tgl_lahir, '%d') AS tgl_lahir, DATE_FORMAT(tbl_user.tgl_lahir, '%m') AS bln_lahir, DATE_FORMAT(tbl_user.tgl_lahir, '%Y') AS thn_lahir,
									  tbl_user.no_hp, tbl_user.email, tbl_user.user_pictures, tbl_role.nm_role, tbl_user.user_status 
									  FROM tbl_user
									  LEFT JOIN tbl_role ON tbl_user.id_role = tbl_role.id_role
									  WHERE tbl_user.id_user ='".$id_user."'");
		return $approval->row();						   
	}
	
	function get_account_info($username)
	{
		$account = $this->db->query("SELECT tbl_user.id_user, tbl_user.username, tbl_user.fullname, tbl_user.designation,
									 DATE_FORMAT(tbl_user.tgl_lahir, '%d') AS tgl_lahir, DATE_FORMAT(tbl_user.tgl_lahir, '%m') AS bln_lahir, DATE_FORMAT(tbl_user.tgl_lahir, '%Y') AS thn_lahir,
									 tbl_user.no_hp, tbl_user.email, tbl_user.id_role, tbl_role.nm_role, tbl_user.user_pictures
									 FROM tbl_user
									 LEFT JOIN tbl_role ON tbl_user.id_role = tbl_role.id_role 
									 WHERE username='".$username."'");
		return $account;
	}
	
}

