<?php  
include "db.php";  
 class gestionproducte  extends connection { 
    public function  insertporducte($ref_produit,$design,$cat,$prix_u,$quantite,$detail,$photo){ 
        $etat = "en cours";  
        $id_produit = time()/100;
        $sql = "INSERT INTO `produit`(`id_produit`, `name`, `design`, `cat`, `prix_u`, `quantite`, `etat`, `detail`, `photo`) VALUES (?,?,?,?,?,?,?,?,?)";
        $stmt = $this->connectiondb()->prepare($sql);  
        $stmt->execute([$id_produit,$ref_produit,$design,$cat,$prix_u,$quantite,$etat,$detail,$photo]);
        return $id_produit;
    }
    public function insertphoto($id_produit,$photo){ 
        $sql="INSERT INTO `photo`(`id_produit`, `photo`) VALUES (?,?)"; 
        $stmt = $this->connectiondb()->prepare($sql);  
        $stmt->execute([$id_produit,$photo]);
    }
    // return quantite 
    public function quantite($id_producte) { 
        $sql="SELECT quantite FROM produit WHERE id_produit = ?;"; 
        $resulta = $this->connectiondb()->prepare($sql); 
        $resulta->execute([$id_producte]);
        $quantite = "";
        while ($row = $resulta->fetch(PDO::FETCH_ASSOC)){ 
            $quantite =  $row["quantite"] ;
        } 
        if($quantite == ""){ 
            return 0;
        }else{ 
            return $quantite;
        }
    }
        // return quantite now 
    //     public function quantite_now($id_producte) { 
    //     $sql="SELECT quantite_now FROM produit WHERE id_produit = ?;"; 
    //     $resulta = $this->connectiondb()->prepare($sql); 
    //     $resulta->execute([$id_producte]);
    //     $quantite = "";
    //     while ($row = $resulta->fetch(PDO::FETCH_ASSOC)){ 
    //         $quantite =  $row["quantite_now"] ;
    //     } 
    //     if($quantite  == ""){ 
    //         return 0;
    //     }else{
    //         return $quantite;
    //     }
    // }
        public function money($id_producte){ 
            $sql ="SELECT prix_u as money FROM produit WHERE id_produit = ?;";
            $resulta = $this->connectiondb()->prepare($sql); 
            $resulta->execute([$id_producte]);
            $money = "";
            while ($row = $resulta->fetch(PDO::FETCH_ASSOC)){ 
                $money =  $row["money"] ;
            }  
            return $money * $this->selling($id_producte);
        }
        public function n_commen_ex($id_producte){ 
            $sql = "SELECT COUNT(*) as numbers FROM commande INNER JOIN lignecommande on commande.id_command = lignecommande.id_command WHERE commande.etat = 'encommande' and lignecommande.id_produit =?;";
            $resulta = $this->connectiondb()->prepare($sql); 
            $resulta->execute([$id_producte]);
            $number = "";
            while ($row = $resulta->fetch(PDO::FETCH_ASSOC)){ 
                $number =  $row["numbers"] ;
            } 
            return $number;
        }
         public function returns($id_producte){ 
            $sql = "SELECT lignecommande.qte_commande as numbers FROM commande INNER JOIN lignecommande on commande.id_command = lignecommande.id_command WHERE commande.etat = 'false' and lignecommande.id_produit =?;";
            $resulta = $this->connectiondb()->prepare($sql); 
            $resulta->execute([$id_producte]);
            $number = "";
            while ($row = $resulta->fetch(PDO::FETCH_ASSOC)){ 
                $number =  $row["numbers"];
            } 
            if ($number != ""){
                return $number;
            }else{  
                // echo 0;
                return 0;

            }
        }
        public function selling($id_producte){ 
            $sql = "SELECT lignecommande.qte_commande as numbers FROM commande INNER JOIN lignecommande on commande.id_command = lignecommande.id_command WHERE commande.etat = 'true' and lignecommande.id_produit =?;";
            $resulta = $this->connectiondb()->prepare($sql); 
            $resulta->execute([$id_producte]);
            $number = "";
            while ($row = $resulta->fetch(PDO::FETCH_ASSOC)){ 
                $number =  $row["numbers"];
            } 
            if ($number != ""){
                return $number;
            }else{ 
                return 0;
            }
        }
        public function infoproducte($id_producte){ 
            $sql ="SELECT * FROM produit where id_produit =?"; 
            $resulta = $this->connectiondb()->prepare($sql);
            $resulta->execute([$id_producte]); 
            $ifnoproducte = [];
            while ($row = $resulta->fetch(PDO::FETCH_ASSOC)){ 
                $ifnoproducte['infoproducte'] =  $row; 
                
                $sqli ="SELECT photo , id_photo FROM photo WHERE id_produit = ?"; 
                $pho = $this->connectiondb()->prepare($sqli);
                $pho->execute([$id_producte]); 
                $photos = [];
                while ($rowphoto  = $pho->fetch(PDO::FETCH_ASSOC)){ 
                    $photos[] = $rowphoto;
                }
                $ifnoproducte['photo'] =  $photos ;
             }  


            return $ifnoproducte;
        }
        public function clientsellingproduct($id_producte){ 
            $sql = "SELECT SUM(lignecommande.qte_commande) as numbers ,commande.id_client as idclient FROM commande INNER JOIN lignecommande on commande.id_command = lignecommande.id_command WHERE commande.etat = 'true' and lignecommande.id_produit = ?;";
            $resulta = $this->connectiondb()->prepare($sql);
            $resulta->execute([$id_producte]);   
             $clientsellling = [];
             while ($row = $resulta->fetch(PDO::FETCH_ASSOC)){ 
                $ifn = []; 
                $quantite =  $row["numbers"]; 
                $ifn['quantite'] = $quantite;
                $id_client = $row['idclient'];
                    $sql = "SELECT * FROM `client` WHERE id_client = ?;"; 
                    $retsult = $this->connectiondb()->prepare($sql);  
                    $retsult->execute([$id_client]);  
                    // $info = [];
                while ($row = $retsult->fetch(PDO::FETCH_ASSOC)){ 
                            $ifn['clinetinfo']  =  $row ;
                } 
                  $clientsellling[] = $ifn;
            } 
            return $clientsellling;
        }
        public function clienthascommentproducte($id_producte){ 
            $sql = "SELECT SUM(lignecommande.qte_commande) as numbers ,commande.id_client as idclient FROM commande INNER JOIN lignecommande on commande.id_command = lignecommande.id_command WHERE commande.etat = 'encommande' and lignecommande.id_produit = ?;";
            $resulta = $this->connectiondb()->prepare($sql);
            $resulta->execute([$id_producte]);   
             $clienthascommend = [];
             while ($row = $resulta->fetch(PDO::FETCH_ASSOC)){ 
                $ifn = []; 
                $quantite =  $row["numbers"]; 
                $ifn['quantite'] = $quantite;
                $id_client = $row['idclient'];
                    $sql = "SELECT * FROM `client` WHERE id_client = ?;"; 
                    $retsult = $this->connectiondb()->prepare($sql);  
                    $retsult->execute([$id_client]);  
                    // $info = [];
                while ($row = $retsult->fetch(PDO::FETCH_ASSOC)){ 
                            $ifn['clinetinfo']  =  $row ;
                } 
                  $clienthascommend[] = $ifn;
            } 
            return $clienthascommend;
        }
        public function clientreturnproduct($id_producte){ 
            $sql = "SELECT SUM(lignecommande.qte_commande) as numbers ,commande.id_client as idclient FROM commande INNER JOIN lignecommande on commande.id_command = lignecommande.id_command WHERE commande.etat = 'false' and lignecommande.id_produit = ?;";
            $resulta = $this->connectiondb()->prepare($sql);
            $resulta->execute([$id_producte]);   
             $clientreturn = [];
             while ($row = $resulta->fetch(PDO::FETCH_ASSOC)){ 
                $ifn = []; 
                $quantite =  $row["numbers"]; 
                $ifn['quantite'] = $quantite;
                $id_client = $row['idclient'];
                    $sql = "SELECT * FROM `client` WHERE id_client = ?;"; 
                    $retsult = $this->connectiondb()->prepare($sql);  
                    $retsult->execute([$id_client]);  
                    // $info = [];
                while ($row = $retsult->fetch(PDO::FETCH_ASSOC)){ 
                            $ifn['clinetinfo']  =  $row ;
                } 
                  $clientreturn[] = $ifn;
            } 
            return $clientreturn;
        }
       public function deleteproducte($id_producte){  
         $sql = "SELECT * FROM `commande` INNER JOIN lignecommande on commande.id_command = lignecommande.id_command WHERE lignecommande.id_produit = ? AND commande.etat ='encommande';"; 
         $resulta = $this->connectiondb()->prepare($sql);
         $resulta->execute([$id_producte]);   
         $count = $resulta->rowCount();
         if($count>0){ 
            return "can't delet this producte";
         }else{ 
            $sqlphoto = "DELETE FROM `photo` WHERE id_produit = ?"; 
            $result = $this->connectiondb()->prepare($sqlphoto);
            $result->execute([$id_producte]);   
            $sqlproduite = "DELETE FROM `produit` WHERE id_produit = ?";
            $resultpro = $this->connectiondb()->prepare($sqlproduite);
            $resultpro->execute([$id_producte]); 
            return "delet successfully";
         }
       }
       public function upadetinfoprodute($id_producte,$design,$cat,$prix_u,$quantite,$etat,$detail,$name){ 
        $sql = "UPDATE `produit` SET `design`=?,`cat`=?,`prix_u`=?,`quantite`=?,`etat`=?,`detail`=?,`name`=? WHERE `id_produit`= ?;"; 
        $resulta = $this->connectiondb()->prepare($sql);
        $resulta->execute([$design,$cat,$prix_u,$quantite,$etat,$detail,$name,$id_producte]);    
        return "Update successsfully";
      }
      public function delephoto($id_producte,$photo){ 
            $sqlphoto = "DELETE FROM `photo` WHERE id_produit = ? and id_photo = ?"; 
            $result = $this->connectiondb()->prepare($sqlphoto);
            $result->execute([$id_producte,$photo]); 
      } 
    //   public function  ($id_producte,$photo){ 
    //     $sql ="INSERT INTO `photo`(`id_produit`, `photo`) VALUES (?,?)"; 
    //     $result = $this->connectiondb()->prepare($sqlphoto);
    //     $result->execute([$id_producte,$photo]); 
    //   }  

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
        $sql = "SELECT * FROM `produit` WHERE cat = ?;"; 
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
    public function sellectallprocut(){ 
        $sql = "SELECT * FROM `produit` "; 
        $result = $this->connectiondb()->prepare($sql);
        $result->execute([]);  
        $procute = [];
         while ($row = $result->fetch(PDO::FETCH_ASSOC)){ 
               $procute[] =$row;
         } 
         return $procute;
    }
   public function search($data) { 
        $sql = "SELECT * FROM `produit` WHERE name LIKE ? OR design LIKE ? OR cat LIKE ?;"; 
        $retsult = $this->connectiondb()->prepare($sql); 
        $retsult->execute(["$data%","$data%","$data%",]);  
        $searcharray = [];
        while($row = $retsult->fetch(PDO::FETCH_ASSOC)){ 
            $searcharray[] = $row;
        }
        return $searcharray;
        
  }
 }
 $object =new gestionproducte();  
//  echo "<pre>";
//  print_r($object->selecproducte()); 
// echo $object->upadetinfoprodute(1,"mohamed","cat",12,111,"encours","pas detail","labtop");
?>