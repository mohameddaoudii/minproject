<?php  
include 'classorder.php';
if(isset($_POST['insertcommande'])){ 
     $insertcommande= $_POST['insertcommande']; 
     $insertcommande = json_decode($insertcommande) ;  
      if (is_object($insertcommande)) {
        // Gets the properties of the given object
        // with get_object_vars function
        $insertcommande = get_object_vars($insertcommande);
     }    
     $id_client =   $insertcommande['id_client']; 
     $date_commande =  $insertcommande['date_commande'];   
     $prixcommande =  $insertcommande['prixcommande'];   
     $productecommand =$insertcommande['productecommande'];   
     $idcommande = intval(time()/rand(1,350));
     $object->insercommand($idcommande,$id_client,$date_commande,$prixcommande,'encommande');  
     echo "insert commande"; 
    print_r($productecommand);
     if(!empty($productecommand)){ 
       foreach($productecommand as $value){  
        if (is_object($value)) {
        // Gets the properties of the given object
        // with get_object_vars function
        $value = get_object_vars($value);
       }  
       print_r($value);
         $idlingcomand = intval(time()/rand(10000,100000));
         $object->inserlignecommande($idcommande,$value["quant"],$value["id_producte"],$value["totale"], $idlingcomand);
       }
     }

    
}
if(isset($_POST['updateinfoligncommand'])){ 
     $updateinfoligncommand= $_POST['updateinfoligncommand']; 
     $updateinfoligncommand = json_decode($updateinfoligncommand) ;  
      if (is_object($updateinfoligncommand)) {
        // Gets the properties of the given object
        // with get_object_vars function
        $updateinfoligncommand = get_object_vars($updateinfoligncommand);
     }
     $idlignecommande =intval($updateinfoligncommand['idligne']); 
     $idquantite =  intval($updateinfoligncommand['quantite']); 
     $totale = floatval($updateinfoligncommand['totale']); 
     $object->updateinfolignecommande($idlignecommande,$idquantite,$totale);
     echo "update successfully";


}

if(isset($_POST['updatecommande'])){ 
     $updatecommande= $_POST['updatecommande']; 
     $updatecommande = json_decode($updatecommande) ;  
      if (is_object($updatecommande)) {
        // Gets the properties of the given object
        // with get_object_vars function
        $updatecommande = get_object_vars($updatecommande);
     }
     $idcommande =intval($updatecommande['idcommand']); 
     $totalepayement = $updatecommande['totalepyement']; 
     $etat = $updatecommande['etat']; 
     $object->updatecommande($idcommande,$totalepayement,$etat);
     echo "update successfully";
}

if(isset($_POST['deletlignecommande'])){ 
     $deletlignecommande= $_POST['deletlignecommande']; 
     $deletlignecommande = json_decode($deletlignecommande) ;  
      if (is_object($deletlignecommande)) {
        // Gets the properties of the given object
        // with get_object_vars function
        $deletlignecommande = get_object_vars($deletlignecommande);
     }
     $idlignecommande =intval($deletlignecommande['id']); 
     $object->deletlignecommande($idlignecommande);
     echo "delet successfully";
}

if(isset($_POST['deletcommand'])){ 

     
     $deletcommand= $_POST['deletcommand']; 
     $deletcommand = json_decode($deletcommand) ;  
      if (is_object($deletcommand)) {
        // Gets the properties of the given object
        // with get_object_vars function
        $deletcommand = get_object_vars($deletcommand);
     }
     $idcommande =intval($deletcommand['idcommande']); 
     echo $object->deletcommand($idcommande);
}


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

?>