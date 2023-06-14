<?php  
include "db.php";  
// class  gestion page the client
class gestionclient extends connection{  
   public function AfficheClient() { 
    $sql = "SELECT * FROM `client`;"; 
    $retsult = $this->connectiondb()->prepare($sql);  
    $retsult->execute([]);  
    $listclient = [];
    while ($row = $retsult->fetch(PDO::FETCH_ASSOC)){ 
        $listclient[] =  $row ;
    } 
    return $listclient;
   }  
   //function get informartion about clinet for edite  
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
   //function edite client   

   public function edite($id_client,$name,$telephone,$email,$villle,$address){ 
    $sql = "UPDATE `client` SET `name`=?,`telephone`=?,`email`=?,`villle`=?,`address`=? WHERE id_client = ?"; 
    $stmt = $this->connectiondb()->prepare($sql); 
    $stmt->execute([$name,$telephone,$email,$villle,$address,$id_client]); 
   } 
   //function remove client 
   public function delet($id_client){ 
    $sql ="DELETE FROM client WHERE id_client = ? and id_client not in (SELECT id_client FROM commande);"; 
    $stmt = $this->connectiondb()->prepare($sql); 
    $stmt->execute([$id_client]);
    if($stmt->rowCount()>0){ 
      return "delet successfully"; 
    }else{ 
      return "can't delet this client";
    }
   } 

   //function  insert client  
   public function insert($name,$telephone,$email,$villle,$address){ 
    $sql = "INSERT INTO `client`(`name`, `telephone`, `email`, `villle`, `address`) VALUES (?,?,?,?,?)"; 
    $stmt = $this->connectiondb()->prepare($sql);  
    $stmt->execute([$name,$telephone,$email,$villle,$address]);
   }
   //function search about client 
   public function search($data){ 
    $sql = "SELECT * FROM client WHERE name LIKE ?;"; 
    $retsult = $this->connectiondb()->prepare($sql); 
    $retsult->execute(["$data%",]);  
    $searcharray = [];
    while($row = $retsult->fetch(PDO::FETCH_ASSOC)){ 
        $searcharray[] = $row;
    }
    return $searcharray;
   }  
   // if has commande 
   public function hascommande($idc){  
      $sql = "SELECT * FROM `commande` WHERE id_client = ? AND etat = 'encommande';"; 
      $retsult = $this->connectiondb()->prepare($sql); 
      $retsult->execute([$idc]);   
      $searcharray = [];
      while($row = $retsult->fetch(PDO::FETCH_ASSOC)){ 
            $searcharray[] = $row;
      }
      if(count($searcharray)>0){ 
        return "yes";
      }else{ 
        return "No";
      }
   } 
   public function money($id){ 
       $sql = "SELECT SUM(prix_command)as  moneys  FROM `commande` WHERE id_client = ? AND  etat = 'true';" ;
       $retsult = $this->connectiondb()->prepare($sql); 
       $retsult->execute([$id]);    
       $money = "";
       while($row = $retsult->fetch(PDO::FETCH_ASSOC)){ 
            $money = $row['moneys'];
       }   
       if(isset($money)){ 
         return $money;
       }else{ 
            $money = 0 ;
            return $money;
       }

    }  
    public function numcommendby($id){ 
        $sql = "SELECT COUNT(*) as numcommend FROM `commande` WHERE id_client = ? AND etat = 'true';";
        $retsult = $this->connectiondb()->prepare($sql); 
        $retsult->execute([$id]);     
        $numcommend = ""; 
         while($row = $retsult->fetch(PDO::FETCH_ASSOC)){ 
            $numcommend = $row['numcommend'];
         }   
         return $numcommend;
    }
    public function numcommend($id){ 
        $sql = "SELECT COUNT(*) as numcommend FROM `commande` WHERE id_client = ? ;";
        $retsult = $this->connectiondb()->prepare($sql); 
        $retsult->execute([$id]);     
        $numcommend = ""; 
         while($row = $retsult->fetch(PDO::FETCH_ASSOC)){ 
            $numcommend = $row['numcommend'];
         }   
         return $numcommend;
    } 
    public function numcommendreturn($id){ 
        $sql = "SELECT COUNT(*) as numcommend FROM `commande` WHERE id_client = ? and etat = 'false' ;";
        $retsult = $this->connectiondb()->prepare($sql); 
        $retsult->execute([$id]);     
        $numcommend = ""; 
         while($row = $retsult->fetch(PDO::FETCH_ASSOC)){ 
            $numcommend = $row['numcommend'];
         }   
         return $numcommend;
    } 
    
}  

$object = new gestionclient();   
// echo "<pre>"; 
// echo($object->AfficheClient())
?>