<?php 
include "db.php";  
class gestionorder extends connection{

     public function infoproducte($id_producte){ 
            $sql ="SELECT * FROM produit where id_produit =?"; 
            $resulta = $this->connectiondb()->prepare($sql);
            $resulta->execute([$id_producte]); 
            $ifnoproducte = [];
            while ($row = $resulta->fetch(PDO::FETCH_ASSOC)){ 
                $ifnoproducte[] =  $row['name']; 
                $ifnoproducte[] =  $row['photo'];
                $ifnoproducte[] =  $row['prix_u'];
            }
            return $ifnoproducte;
        }

  public function getInfo($id_client){
    $sql = "SELECT * FROM `client` WHERE id_client = ?;"; 
    $retsult = $this->connectiondb()->prepare($sql);  
    $retsult->execute([$id_client]);  
    $info = [];
    while ($row = $retsult->fetch(PDO::FETCH_ASSOC)){ 
        $info[] =  $row ;
    } 
    return $info;
   }
   public function getnameclient($id_client){
    $sql = "SELECT * FROM `client` WHERE id_client = ?;"; 
    $retsult = $this->connectiondb()->prepare($sql);  
    $retsult->execute([$id_client]);  
    $name = "";
    while ($row = $retsult->fetch(PDO::FETCH_ASSOC)){ 
        $name =  $row['name'];
    } 
    return $name;
   }
   public function listeorder() { 
    $sql = "SELECT * FROM `commande`;"; 
    $retsult = $this->connectiondb()->prepare($sql);  
    $retsult->execute([]);  
    $listcommande = [];
    while ($row = $retsult->fetch(PDO::FETCH_ASSOC)){  
        $name= $this->getnameclient($row['id_client']); 
        $row['name'] = $name;
        $listcommande[] =  $row ;
    } 
    return $listcommande;
   }  

  public function sepdifiqueorder($idcommande) { 
    $sql = "SELECT * FROM `commande` WHERE id_command = ? ;"; 
    $retsult = $this->connectiondb()->prepare($sql);  
    $retsult->execute([$idcommande]);  
    $listcommande = [];
    while ($row = $retsult->fetch(PDO::FETCH_ASSOC)){  
        $name= $this->getnameclient($row['id_client']); 
        $row['name'] = $name;
        $listcommande[] =  $row ;
    } 
    return $listcommande;
   }  


    public function infocommande($idcommande){ 
         $sql = "SELECT * FROM `lignecommande` WHERE id_command = ?"; 
        $result = $this->connectiondb()->prepare($sql);
        $result->execute([$idcommande]);  
        $infoproducte = []; 
         while ($row = $result->fetch(PDO::FETCH_ASSOC)){  

              $inf = $this->infoproducte($row['id_produit']);
              $row['name'] = $inf[0]; 
              $row['photo'] = $inf[1]; 
              $row['prix_u'] = $inf[2]; 

               $infoproducte[] =$row;
         }
         return $infoproducte;
    } 

  public function TotalPayment($idcommande) { 
    $sql = "SELECT prix_command FROM `commande` WHERE id_command =?;"; 
    $retsult = $this->connectiondb()->prepare($sql);  
    $retsult->execute([$idcommande]);  
    $TotalPayment = "";
    while ($row = $retsult->fetch(PDO::FETCH_ASSOC)){  
        $TotalPayment =  $row['prix_command'];
    } 
    return $TotalPayment;
   }   
  public function categorie(){ 
        $sql = "SELECT cat FROM `produit`"; 
        $result = $this->connectiondb()->prepare($sql);
        $result->execute([]);  
        $arraycat = []; 
         while ($row = $result->fetch(PDO::FETCH_ASSOC)){ 
               $arraycat[] =$row['cat'] ;
         }
         return $arraycat;
    }

  public function selecproducte(){ 
       $categorie =  $this->categorie();   
       $allproducte = [];
      foreach($categorie as $value){ 
        $sql = "SELECT * FROM `produit` WHERE cat = ? and etat = 'true';"; 
        $result = $this->connectiondb()->prepare($sql);
        $result->execute([$value]);  
        $catproducte = [];
         while ($row = $result->fetch(PDO::FETCH_ASSOC)){ 
               $catproducte[] =$row;
         } 
         $allproducte[$value] =  $catproducte;
       } 
       return $allproducte;
    }
   public function insercommand($idcommande,$id_client,$datecommande,$prix_command,$etat){ 
    $sql = "INSERT INTO `commande`(`id_command`, `id_client`, `date_command`, `prix_command`, `etat`) VALUES (?,?,?,?,?)"; 
    $retsult = $this->connectiondb()->prepare($sql);  
    $retsult->execute([$idcommande,$id_client,$datecommande,$prix_command,$etat]); 
    echo "commande is insert successfully";
   }
  public function inserlignecommande($idcommande,$quantite,$idproduite,$price,$idlignecommand){ 
    $sql = "INSERT INTO `lignecommande`(`id_command`, `id_produit`, `qte_commande`, `prix`, `id_lignecommande`) VALUES (?,?,?,?,?)"; 
    $retsult = $this->connectiondb()->prepare($sql);  
    $retsult->execute([$idcommande,$idproduite,$quantite,$price,$idlignecommand]); 
    echo "commande is insert successfully";
   } 

  public function updateinfolignecommande($idlignecommand,$quantite,$newprice){ 
    $sql = "UPDATE `lignecommande` SET `qte_commande`=? ,`prix`= ? WHERE `id_lignecommande`=?"; 
    $retsult = $this->connectiondb()->prepare($sql);  
    $retsult->execute([$quantite,$newprice,$idlignecommand]); 
    echo "update successfully";
  }

  public function updatecommande($idcommande,$totalepayement,$etat){ 
    $sql = "UPDATE `commande` SET `prix_command`=? ,`etat`=? WHERE `id_command`= ?"; 
    $retsult = $this->connectiondb()->prepare($sql);  
    $retsult->execute([$totalepayement,$etat,$idcommande]); 
    echo "update successfully";
  }

  public function deletlignecommande($idlignecommand){ 
    $sql = "DELETE FROM `lignecommande` WHERE id_lignecommande = ?"; 
    $retsult = $this->connectiondb()->prepare($sql);  
    $retsult->execute([$idlignecommand]); 
    echo "delet successfully";
  }
  public function deletcommand($idcommande){ 

     $etatcom = ""; 
    foreach($this->sepdifiqueorder($idcommande) as $value){ 
      if($value['etat'] == "true"){ 
        $etatcom = "impossible";
      }
    }; 
    if($etatcom != "impossible"){ 
      $sql = "DELETE FROM `lignecommande` WHERE id_command = ?"; 
      $retsult = $this->connectiondb()->prepare($sql);  
      $retsult->execute([$idcommande]); 
      $sql = "DELETE FROM `commande` WHERE id_command = ? AND etat != 'true';"; 
      $retsult = $this->connectiondb()->prepare($sql);  
      $retsult->execute([$idcommande]);  
        return "delet successfully";
      }else{ 
        return "can't delet this order";
        
    }
  }



  public function search($data) { 
        $sql = "SELECT * FROM commande INNER JOIN client ON commande.id_client = client.id_client WHERE client.name LIKE ?"; 
        $retsult = $this->connectiondb()->prepare($sql); 
        $retsult->execute(["$data%",]);  
        $searcharray = [];
        while($row = $retsult->fetch(PDO::FETCH_ASSOC)){ 
            $searcharray[] = $row;
        }
        return $searcharray;
        
  }
}
$object = new gestionorder();    
//  echo "<pre>";:
// print_r($object->sepdifiqueorder(23751571));
//  echo $object->deletcommand(6154059);

?>