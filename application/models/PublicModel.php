<?php
class PublicModel extends CI_Model {

private $activeDate='';

    public function __construct()
    {
    	
    }
    

	function dLookUp($field, $tbl, $criteria ='') {
		if(empty($criteria)) {
            $q = $this->db->query("SELECT ".$field." as TX FROM ".$tbl);    
        } else {
            $q = $this->db->query("SELECT ".$field." as TX FROM ".$tbl." WHERE ".$criteria);
        }

        if($q->num_rows() <> 0) {
        	$row = $q->row();
        	if(!empty($row->TX)){
        		return $row->TX;	
        	}			
        }
        return '';		
    }
    
}