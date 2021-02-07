<?php  
 class Crud_model extends CI_Model  
 {  
      var $table = "customer_details";  
      var $select_column = array("c_id", "c_name", "c_address", "c_reg_no","c_chassis_no","c_engine_no","model_name","c_contact_no","gstin_no","c_sales_date","c_email");  
      var $order_column = array(null,"c_name", "c_address", "c_reg_no","c_chassis_no","c_engine_no","model_name","c_contact_no","gstin_no","c_sales_date","c_email");  
      function make_query()  
      {  
           $this->db->select($this->select_column);  
           $this->db->from($this->table);  
           if(isset($_POST["search"]["value"]))  
           {  
                $this->db->like("c_name", $_POST["search"]["value"]);  
                $this->db->or_like("c_address", $_POST["search"]["value"]);  
                $this->db->or_like("c_reg_no", $_POST["search"]["value"]);  
                $this->db->or_like("c_chassis_no", $_POST["search"]["value"]);  
                $this->db->or_like("c_engine_no", $_POST["search"]["value"]);  
                $this->db->or_like("model_name", $_POST["search"]["value"]);  
                $this->db->or_like("c_contact_no", $_POST["search"]["value"]);  
                $this->db->or_like("gstin_no", $_POST["search"]["value"]);  
                $this->db->or_like("c_sales_date", $_POST["search"]["value"]);  
                $this->db->or_like("c_email", $_POST["search"]["value"]);    
           }  
           if(isset($_POST["order"]))  
           {  
                $this->db->order_by($this->order_column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);  
           }  
           else  
           {  
                $this->db->order_by('c_id', 'ASC');  
           }  
      }  
      function make_datatables(){  
           $this->make_query();  
           if($_POST["length"] != -1)  
           {  
                $this->db->limit($_POST['length'], $_POST['start']);  
           }  
           $query = $this->db->get();  
           return $query->result();  
      }  
      function get_filtered_data(){  
           $this->make_query();  
           $query = $this->db->get();  
           return $query->num_rows();  
      }       
      function get_all_data()  
      {  
           $this->db->select("*");  
           $this->db->from($this->table);  
           return $this->db->count_all_results();  
      }  
 }