<?php 
/*
-- ---------------------------------------------------------------
-- MARKETPLACE MULTI BUYER MULTI SELLER + SUPPORT RESELLER SYSTEM
-- CREATED BY : ROBBY PRIHANDAYA
-- COPYRIGHT  : Copyright (c) 2018 - 2019, PHPMU.COM. (https://phpmu.com/)
-- LICENSE    : http://opensource.org/licenses/MIT  MIT License
-- CREATED ON : 2019-03-26
-- UPDATED ON : 2019-03-27
-- ---------------------------------------------------------------
*/
class Model_app extends CI_model{
    public function view($table){
        return $this->db->get($table);
    }

    public function insert($table,$data){
        return $this->db->insert($table, $data);
    }
    public function insert_id($table,$data){
         $this->db->insert($table, $data);
         return $this->db->insert_id();
    }

    public function edit($table, $data){
        return $this->db->get_where($table, $data);
    }
 
    public function update($table, $data, $where){
        return $this->db->update($table, $data, $where); 
    }

    public function delete($table, $where){
        return $this->db->delete($table, $where);
    }

    public function view_where($table,$data){
        $this->db->where($data);
        return $this->db->get($table);
    }
    public function dataUsers($email){
        $this->db->where('users_email',$email);
        $this->db->or_where('users_username',$email);
        return $this->db->get('users');
    }
    public function dataBuku($cat,$qty,$keyword){
        $table1= 'buku';
        $table2 = 'kategori';
        $field1= 'buku_kategori_id';
        $field2 = 'kategori_id';
        $order = 'buku_judul';
        $ordering = 'DESC';
        if($qty == 'y'){
            $where =  $this->db->where('buku_qty >',0);
        }else if($qty == 'n'){
           $where =  $this->db->where('buku_qty',0);
        }else{
            $where ='';

        }
        if($cat == 'all'){
            $where1 = '';
        }else{
            $where1 =  $this->db->where('kategori_slug',$cat);
        }
        if($keyword != null){
            $where2 = $this->db->like('buku_judul',$keyword);
        }else{
            $where2= '';
        }

         $this->db->select('*');
        $this->db->from($table1);
        $this->db->join($table2, $table1.'.'.$field1.'='.$table2.'.'.$field2);
        $where;
        $where1;
        $where2;
        $this->db->order_by($order,$ordering);
        return $this->db->get();
    }
    public function dataBukuLimit($cat,$qty,$keyword,$baris,$dari){
        $table1= 'buku';
        $table2 = 'kategori';
        $field1= 'buku_kategori_id';
        $field2 = 'kategori_id';
        $order = 'buku_judul';
        $ordering = 'DESC';
        if($qty == 'y'){
            $where =  $this->db->where('buku_qty >',0);
        }else if($qty == 'n'){
           $where =  $this->db->where('buku_qty',0);
        }else{
            $where ='';

        }
        if($cat == 'all'){
            $where1 = '';
        }else{
            $where1 =  $this->db->where('kategori_slug',$cat);
        }
        if($keyword != null){
            $where2 = $this->db->like('buku_judul',$keyword);
        }else{
            $where2= '';
        }
         $this->db->select('*');
        $this->db->from($table1);
        $this->db->join($table2, $table1.'.'.$field1.'='.$table2.'.'.$field2);
        $where;
        $where1;
        $where2;
        
        $this->db->order_by($order,$ordering);
        $this->db->limit($baris, $dari);
        return $this->db->get();
    }
    public function view_ordering_limit($table,$order,$ordering,$baris,$dari){
        $this->db->select('*');
        $this->db->order_by($order,$ordering);
        $this->db->limit($dari, $baris);
        return $this->db->get($table);
    }

    public function view_where_ordering_limit($table,$data,$order,$ordering,$baris,$dari){
        $this->db->select('*');
        $this->db->where($data);
        $this->db->order_by($order,$ordering);
        $this->db->limit($dari, $baris);
        return $this->db->get($table);
    }
    
    public function view_ordering($table,$order,$ordering){
        $this->db->select('*');
        $this->db->from($table);
        $this->db->order_by($order,$ordering);
        return $this->db->get()->result_array();
    }   
    public function view_order($table,$order,$ordering){
        $this->db->select('*');
        $this->db->from($table);
        $this->db->order_by($order,$ordering);
        return $this->db->get();
    }

    public function view_where_ordering($table,$data,$order,$ordering){
        $this->db->where($data);
        $this->db->order_by($order,$ordering);
        return $this->db->get($table);
        
    }
    public function view_where_ordering_group($table,$data,$order,$ordering,$group){
        $this->db->where($data);
        $this->db->group_by($group);
        $this->db->order_by($order,$ordering);
    
        return $this->db->get($table);
        
    }
    function generateTransaksi()
    {
       
			$pre = 'KPOP'.mdate("%y%m",time());	
			$query = " SELECT * FROM transaksi WHERE transaksi_no LIKE '$pre%' ORDER BY transaksi_no DESC LIMIT 1";
			$query = $this->db->query($query);
			$rsv_no = "$pre"."00";
			foreach($query->result() as $row){
				$rsv_no = $row->transaksi_no;
			}
			// echo $rsv_no;
			$rsv_no = substr($rsv_no,4) + 1;
			// echo substr($rsv_no,4);
			return  "KPOP".$rsv_no;
    }
    public function view_join_one($table1,$table2,$field,$order,$ordering){
        $this->db->select('*');
        $this->db->from($table1);
        $this->db->join($table2, $table1.'.'.$field.'='.$table2.'.'.$field);
        $this->db->order_by($order,$ordering);
        return $this->db->get()->result_array();
    }

    public function view_join_where($table1,$table2,$field,$where,$order,$ordering){
        $this->db->select('*');
        $this->db->from($table1);
        $this->db->join($table2, $table1.'.'.$field.'='.$table2.'.'.$field);
        $this->db->where($where);
        $this->db->order_by($order,$ordering);
        return $this->db->get()->result_array();
    }
    public function join_where($table1,$table2,$field1,$field2,$where){
        $this->db->select('*');
        $this->db->from($table1);
        $this->db->join($table2, $table1.'.'.$field1.'='.$table2.'.'.$field2);
        $this->db->where($where);
       
        return $this->db->get();
    }
    public function join_where_order($table1,$table2,$field,$where,$order,$ordering){
        $this->db->select('*');
        $this->db->from($table1);
        $this->db->join($table2, $table1.'.'.$field.'='.$table2.'.'.$field);
        $this->db->where($where);
        $this->db->order_by($order,$ordering);
        return $this->db->get();
    }
    public function join_where_order2($table1,$table2,$field1,$field2,$where,$order,$ordering){
        $this->db->select('*');
        $this->db->from($table1);
        $this->db->join($table2, $table1.'.'.$field1.'='.$table2.'.'.$field2);
        $this->db->where($where);
        $this->db->order_by($order,$ordering);
        return $this->db->get();
    }
    public function join_where_order_group_by($table1,$table2,$field1,$field2,$where,$order,$ordering,$group){
        $this->db->select('*');
        $this->db->from($table1);
        $this->db->join($table2, $table1.'.'.$field1.'='.$table2.'.'.$field2);
        $this->db->where($where);
        $this->db->group_by($group);
        $this->db->order_by($order,$ordering);
        return $this->db->get();
    }
    public function join_where_order_limit($table1,$table2,$field1,$field2,$where,$order,$ordering,$dari,$baris){
        $this->db->select('*');
        $this->db->from($table1);
        $this->db->join($table2, $table1.'.'.$field1.'='.$table2.'.'.$field2);
        $this->db->where($where);
        $this->db->order_by($order,$ordering);
        $this->db->limit($dari,$baris);
        return $this->db->get();
    }
    public function join_order($table1,$table2,$field,$order,$ordering){
        $this->db->select('*');
        $this->db->from($table1);
        $this->db->join($table2, $table1.'.'.$field.'='.$table2.'.'.$field);
     
        $this->db->order_by($order,$ordering);
        return $this->db->get();
    }
    public function view_left_join_where($table1,$table2,$field,$where,$order,$ordering){
        $this->db->select('*');
        $this->db->from($table1);
        $this->db->join($table2, $table1.'.'.$field.'='.$table2.'.'.$field,'left');
        $this->db->where($where);
        $this->db->order_by($order,$ordering);
        return $this->db->get()->result_array();
    }
    function seo_berita($title)
	{
			
			$query = " SELECT * FROM berita WHERE  berita_seo =  '$title' ";
			$query = $this->db->query($query);
            if($query->num_rows() > 0){
                return $title.'_'.rand(4,100);
            }else{
                return $title;
            }
		
	}
    function dataPelayanan($status,$start,$end){
        if($status == null OR $status == 'all'){
            $where = "";
        }else{
            $where = "pm_status= '".$status."'";
        }
        $start = "AND".$start." 00:00:00";
        $end = $end." 23:59:59";
      $query = $this->db->query("SELECT * FROM pelayanan_masyarakat a JOIN masyarakat_temp b ON a.pm_temp_id = b.temp_id  WHERE pm_date >= '".$start."' AND pm_date <= '".$end."' AND pm_status != 'undone' $where 
                 ORDER BY CASE WHEN pm_status = 'proses' THEN 0 
                               WHEN pm_status = 'done' THEN 1
                               WHEN pm_status = 'cancel' THEN 2
                               WHEN pm_status = 'expired' THEN 3
                               ELSE 4 END,
                            pm_date DESC");
        return $query;
    }
    function insertStatistik(){
       
        
        if ($this->agent->is_browser())
        {
                $agent = $this->agent->browser().' '.$this->agent->version().' '.$this->agent->platform(); 
        }
        elseif ($this->agent->is_robot())
        {
                $agent = $this->agent->robot().' '.$this->agent->platform();
        }
        elseif ($this->agent->is_mobile())
        {
                $agent = $this->agent->mobile().' '.$this->agent->platform();
        }
        $ip = $this->input->ip_address();
        $cekView = $this->model_app->view_where('statistik',array('stat_ip'=>$ip,'stat_date'=>date('Y-m-d')));
        if($cekView->num_rows() > 0){
            $rowV = $cekView->row_array();
            $hits = $rowV['stat_hit']+1;
              $data = array('stat_hit'=>$hits,'stat_agent'=>$agent);
            return $this->db->update('statistik', $data, array('stat_ip'=>$rowV['stat_ip'])); 
           
        }else{
            $data = array('stat_ip'=>$ip,'stat_agent'=>$agent,'stat_hit'=>1,'stat_date'=>date('Y-m-d'),'stat_time'=>date('H:i:s'));
            return $this->db->insert('statistik', $data);

          
            
        }
    
}
 
}