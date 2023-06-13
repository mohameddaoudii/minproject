<?php  
include "classclient.php" ; 
if(isset($_POST['insert'])){ 
     $insert= $_POST['insert']; 
     $insert = json_decode($insert) ;  
      if (is_object($insert)) {
        // Gets the properties of the given object
        // with get_object_vars function
        $insert = get_object_vars($insert);
     }    
     $names = $insert['names'];
     $teles = $insert['teles']; 
     $emails = $insert['emails']; 
     $citys = $insert['citys'];  
     $addresse = $insert['addresse'];
     $object->insert($names,$teles,$emails,$citys,$addresse); 
     echo "insert";
}  
//search about client 
if(isset($_POST['search'])){ 
     $search= $_POST['search']; 
     $search = json_decode($search) ;  
      if (is_object($search)) {
        // Gets the properties of the given object
        // with get_object_vars function
        $search = get_object_vars($search);
     }    
     $data = $search["datasearch"]; 
     $resulta = $object->search($data);  
     $resulta = json_encode($resulta); 
     echo $resulta;
} 
// edite client   

 if(isset($_POST['edite'])){ 
     $edite= $_POST['edite']; 
     $edite = json_decode($edite) ;  
      if (is_object($edite)) {
        // Gets the properties of the given object
        // with get_object_vars function
        $edite = get_object_vars($edite);
     }    
     $id = $edite["idc"];
     $names = $edite['names'];
     $teles = $edite['teles']; 
     $emails = $edite['emails']; 
     $citys = $edite['citys'];  
     $addresse = $edite['addresse'];

     $object->edite($id,$names,$teles,$emails,$citys,$addresse); 
     echo "edite";
}  
//delet client 
 if(isset($_POST['delet'])){ 
     $delet= $_POST['delet']; 
     $delet = json_decode($delet) ;  
      if (is_object($delet)) {
        $delet = get_object_vars($delet);
     }   
     $idc = $delet['idc'] ; 
      $object->delet($idc);  
      echo "delet";
 } 

  if(isset($_POST['sendemail'])){  
     include "../php/index.php";
     $sendemail= $_POST['sendemail']; 
     $sendemail = json_decode($sendemail) ;  
      if (is_object($sendemail)) {
        $sendemail = get_object_vars($sendemail);
     }   
     $subject = $sendemail['subjet'] ; 
     $body = $sendemail['bod'] ; 
     $email = $sendemail['email'] ;  
     verfie($email,$body,$subject);
     echo "email send";


 } 
?>