<?php
/*
 * Made by DeadSekt
 * https://fenixcms.com
 */

 include '../core/functions/pdo.class.php';
 $db = new Database();
 
 class Picker{
	 global $database;
	 
	 function verifyService($id){
		 $result = $db->query_select("SELECT * FROM fx_services_datacenters WHERE id='$id'", false);
		 if($result){
			 return "202";
			 break;
		 }else{
			 return "204";
			 break;
		 }
	 }
	 
	 function isAvailable($dc){
		 $result = $db->query_select("SELECT * FROM fx_services_datacenters WHERE location='$dc' AND cid=''", false);
		 if($result){
			 return "100";
			 break;
		 }else{
			 return "204";
			 break;
		 }
	 }
	 
	 function takeService($id, $dc, $cid, $cycle){
		 if(self::isAvailable($dc)=="available"){
			 $query = $db->query_insert("INSERT INTO fx_services_list (customer,type,datacenter,cycle) values ($cid, '$id', '$dc', '$cycle')", false);
			 if($query){
				 return "201";
			 }else{
				 return "303";
			 }
		 }else{
			 return "204";
		 }
	 }
	 
 }

?>