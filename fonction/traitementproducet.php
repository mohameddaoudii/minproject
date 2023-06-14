<?php 
$i =0; 
include "classporducte.php";
if(isset($_FILES['image1'])){ 
    if($i == 0){ 
        $i = 1;
        echo "the first time";
    }
    $image1 = $_FILES['image1']; 
    $namefile = time().$image1["name"];
    // print_r($image1);
    move_uploaded_file(
        // Temp image location
        $image1["tmp_name"],

        // New image location
        "../image/".$namefile
    ); 
    $fh = fopen("image.txt", "a");
    fwrite($fh, "$namefile\n");
    fclose($fh);
}
if(isset($_FILES['image2'])){ 
    echo "the last one ";
    $image2 = $_FILES['image2'];
    $namefile = time().$image2["name"];

    $fh = fopen("image.txt", "a");
    fwrite($fh, "$namefile\n");
    fclose($fh);
    move_uploaded_file(
        // Temp image location
        $image2["tmp_name"],

        // New image location
        "../image/". time().$image2["name"]
    );
}  
if(isset($_POST['infoproducte'])){ 
     $infoproducte= $_POST['infoproducte']; 
     $infoproducte = json_decode($infoproducte) ;  
      if (is_object($infoproducte)) {
        // Gets the properties of the given object
        // with get_object_vars function
        $infoproducte = get_object_vars($infoproducte);
    }   
     $lines = file('image.txt');  
     $photos = $lines[0]; 
     if(empty($photos)){ 
        $photos = 'admin/image/360_F_499933117_ZAUBfv3P1HEOsZDrnkbNCt4jc3AodArl.jpg';
     }
     $ref_produit = $infoproducte['refs'];
     $design =$infoproducte['designaions'];
     $cat =$infoproducte['cat'];
     $prix_u = $infoproducte['pris'];
     $quantite =$infoproducte['quantites'];
     $detail = $infoproducte['descriptions'];
     $id=$object->insertporducte($ref_produit,$design,$cat,$prix_u,$quantite,$detail,$photos);

    //  print_r($infoproducte);
    $count = 0;
    foreach($lines as $line) {
       $object->insertphoto($id,$line);
    }
    $fh = fopen("image.txt", "w");
    fclose($fh); 
    echo "insert producte";
}
if(isset($_POST['delet'])){ 
     $delet= $_POST['delet']; 
     $delet = json_decode($delet) ;  
      if (is_object($delet)) {
        $delet = get_object_vars($delet);
     }    
    $id_produite = $delet['idproduite'];
   echo $object->deleteproducte($id_produite);

}

if(isset($_POST['upadateinfo'])){ 
     $upadateinfo= $_POST['upadateinfo']; 
     $upadateinfo = json_decode($upadateinfo) ;  
      if (is_object($upadateinfo)) {
        // Gets the properties of the given object
        // with get_object_vars function
        $upadateinfo = get_object_vars($upadateinfo);
     }   
     $id = intval($upadateinfo["id"]); 
    //  echo "idphp $id";
     $cat =$upadateinfo["cat"];
    //  echo "catphp $cat";
     $descriptions =$upadateinfo["descriptions"];
    //  echo "descriptionsphp $descriptions";
     $pris =intval($upadateinfo["pris"]);
     $quantites =intval($upadateinfo["quantites"]);
     $designaions =$upadateinfo["designaions"];
     $names =$upadateinfo["names"];
     $etats =$upadateinfo["etats"]; 
     echo $object->upadetinfoprodute($id,$designaions,$cat,$pris,$quantites,$etats,$descriptions,$names);
    //  echo "update successfully";
}

if(isset($_POST['deletimage'])){ 
     $deletimage= $_POST['deletimage']; 
     $deletimage = json_decode($deletimage) ;  
      if (is_object($deletimage)) {
        // Gets the properties of the given object
        // with get_object_vars function
        $deletimage = get_object_vars($deletimage);
     }    
     $photo =   $deletimage['imagedelet']; 
     $id_producte =  $deletimage['idprodui']; 
     $object->delephoto($id_producte,$photo);
    echo "image delet successfully";
}


if(isset($_POST['insertph'])){ 
     $insertph= $_POST['insertph']; 
     $insertph = json_decode($insertph) ;  
      if (is_object($insertph)) {
        $insertph = get_object_vars($insertph);
     }    
    $id_produite = $insertph['idp'];
    $lines = file('image.txt'); 
    $object->updatephotoprince($id_produite,$lines[0]);
    $count = 0;
    foreach($lines as $line) {
       $object->insertphoto($id_produite,$line);
    } 
    echo "upadate photo";
    $fh = fopen("image.txt", "w");
    fclose($fh);



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