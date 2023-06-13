<?php  
class connection { 
     public function connectiondb()
    {
        try {
            //code...
            $conn = new PDO("mysql:host=localhost;dbname=admincommande", "root", "");
            // echo "connetion successily"; 
            return $conn;
        } catch (PDOException $e) {
            //throw $th; 
            echo $e->getMessage();
        }

    } 

}  
// $obje = new connection(); 
// $obje->connectiondb()
?>