<?php  

if(isset($_GET['idcommande'])){ 
 $idcommande= $_GET['idcommande'];
 include "fonction/classorder.php";  
 $infocommande = $object->sepdifiqueorder($idcommande); 
//  echo "<pre>";
//  print_r($infocommande);
 if(count($infocommande)>0){
    $etat = ""; 
    if($infocommande[0]['etat'] == "encommande"){ 
        $etat = "encours";
    }elseif ($infocommande[0]['etat'] == "true" ) { 
        $etat = "validate";
    }elseif ($infocommande[0]['etat'] == "false" ) { 
        $etat = "annule";
    }
    echo $etat;


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/navbar.css" />
    <link rel="stylesheet" href="css/home.css" />
    <link rel="stylesheet" href="css/commandeinfo.css">
    <link rel="stylesheet" href="css/commande.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" />
    <title>info commande</title>
</head>

<body>

    <?php  
     $name = "poducte";
     include "navbar.php";  
   
     ?>
    <div class="contanier">
        <div class="pop">
            <div>
                <h1>hi welcom back !</h1>
                <div class="tableproducte">
                    <p>
                        Information Order
                    </p>
                </div>
            </div>
            <div class="addprodcute">
                <a id="updateorder">update order</a>
                <a id="deletcommande" data-id="<?php echo $idcommande ; ?>">Delet order</a>

            </div>
        </div>
        <main class="table">
            <section class="table__header">
                <h1>Information Order</h1>
            </section>
            <section class="table__body">
                <table>
                    <thead>
                        <tr>
                            <th>producte</th>
                            <th>price</th>
                            <th>quantite</th>
                            <th>totale</th>
                            <!-- <th>id_commande</th> -->
                            <!-- <th>action</th> -->
                        </tr>
                    </thead>
                    <tbody id="clients">
                        <?php 
                    foreach($object->infocommande($idcommande) as $value ){   
                        echo "
                        <tr>
                            <td class='producte'>
                                <div class='infoprodsel'>
                                    <div class='imageproducte'><img src='image/{$value['photo']}'
                                            alt=''>
                                    </div>
                                    <div class='nameanddesigntion'>
                                        <p class='nameproducte'>{$value['name']}</p>
                                    </div>
                                </div>
                            </td>
                            <td>
                                {$value['prix_u']} : DH
                            </td>
                            <td>
                                <p class='quantite'>{$value['qte_commande']}</p>

                            </td>
                            <td>
                            {$value['prix']} : DH
                            </td>
                            </tr>
                            ";
                        }
                            //    foreach( $object->listeorder() as $value ){ 
                        //     $etat =  =  ""; 
                        //     if($value['etat = '] == "encommande"){ 
                        //          $etat =  "encours"; 
                        //     }elseif($value['etat'] == "true"){ 
                        //            $etat =  "validate"; 
                        //     }elseif($value['etat'] == "false"){ 
                        //            $etat =  "refuse"; 
                        //     }

                        //     echo"
                        //     <tr>
                        //         <td>{$value['id_command']}</td>
                        //         <td>{$value['name']}</td>
                        //         <td>{$value['date_command']}</td>
                        //         <td>{$value['prix_command']}</td>
                        //         <td class = 'etat'>
                        //             <p class='{$value['etat']}'>$etat</p>
                        //         </td>
                        //         <!-- <a href=''></a> -->
                        //     </tr> 
                        //     ";
                        //     ?>
                    </tbody>
                </table>
            </section>
            <section class="totale">

                <h3>Total Payment</h3>
                <ul>
                    <li>Subtotal :</li>
                    <li><?php echo $object->TotalPayment($idcommande); ?>DH</li>
                </ul>
            </section>
        </main>


        <div class="about light-theme">
            <h3>informatin client</h3>
            <div>
                <?php  
                // include "fonction/classclient.php"; 
                $info = $object->getInfo($infocommande[0]['id_client']);  
                // echo "<pre>";
                // print_r($info);
                foreach($info[0] as $key=>$value){  
                echo "
                <ul>
                    <li>$key :</li>
                    <li>$value</li>
                </ul>  
                ";
                } 
                ?>


            </div>
        </div>
        <div class="updatecommande">
            <main class="table" id="tableupdate">
                <section class="table__header">
                    <h1>update Information Order</h1>
                    <div class="etats">
                        <p>etat commande</p>
                        <select name="" id="etat">
                            <option value="<?php echo $infocommande[0]['etat'] ;?>"><?php echo $etat ; ?>
                            </option>
                            <option value="encommande">encours</option>
                            <option value="true">validate</option>
                            <option value="false">annule</option>
                        </select>
                    </div>
                </section>

                <section class="table__body">
                    <table>
                        <thead>
                            <tr>
                                <th>producte</th>
                                <th>price</th>
                                <th>quantite</th>
                                <th>totale</th>
                                <th>action</th>
                                <!-- <th>id_commande</th> -->
                                <!-- <th>action</th> -->
                            </tr>
                        </thead>
                        <tbody id="clients">
                            <?php 
                    foreach($object->infocommande($idcommande) as $value ){   
                        echo "
                        <tr>
                            <td class='producte'>
                                <div class='infoprodsel'>
                                    <div class='imageproducte'><img src='image/{$value['photo']}'
                                            alt=''>
                                    </div>
                                    <div class='nameanddesigntion'>
                                        <p class='nameproducte'>{$value['name']}</p>
                                    </div>
                                </div>
                            </td>
                            <td data-to = '{$value['prix_u']}' >
                                {$value['prix_u']} : DH
                            </td>
                            <td>
                                <input type='number' class='quantite updatequantite'  
                                  data-price = '{$value['prix_u']}'
                                  data-value ='{$value['qte_commande']}' 
                                 value='{$value['qte_commande']}' data-idligne='{$value['id_lignecommande']}'/>
                            </td>
                            <td data-price='{$value['prix']}'>
                            {$value['prix']} : DH
                            </td> 
                            <td> 
                            <button class='deletlignecommande'  data-price='{$value['prix']}'  data-id='{$value['id_lignecommande']}' >delet </button>
                            </td>
                            </tr>
                            ";
                        }
                            //    foreach( $object->listeorder() as $value ){ 
                        //     $etat =  ""; 
                        //     if($value['etat'] == "encommande"){ 
                        //          $etat =  "encours"; 
                        //     }elseif($value['etat'] == "true"){ 
                        //            $etat =  "validate"; 
                        //     }elseif($value['etat'] == "false"){ 
                        //            $etat =  "refuse"; 
                        //     }

                        //     echo"
                        //     <tr>
                        //         <td>{$value['id_command']}</td>
                        //         <td>{$value['name']}</td>
                        //         <td>{$value['date_command']}</td>
                        //         <td>{$value['prix_command']}</td>
                        //         <td class = 'etat'>
                        //             <p class='{$value['etat']}'>$etat</p>
                        //         </td>
                        //         <!-- <a href=''></a> -->
                        //     </tr> 
                        //     ";
                        //     ?>
                        </tbody>
                    </table>
                </section>
                <section class="totale">

                    <h3>Total Payment</h3>
                    <ul>
                        <li>Subtotal :</li>
                        <li id="totalepayement" data-id='<?php echo $idcommande; ?>'
                            data-totale="<?php echo $object->TotalPayment($idcommande); ?>">
                            <?php echo $object->TotalPayment($idcommande); ?>DH</li>
                    </ul>
                </section>
                <section class='actioninsertupdate'>
                    <button class='addproducte'>add producte</button>
                    <button class='insertupdate'>insert update</button>
                </section>
            </main>
        </div>
        <div class="errore">
        </div>
        <div class="succefully">

        </div>

    </div>

    </div>
    </div>

    <script src="js/jquery-3.6.4.min.js"></script>
    <script src="js/updatecommand.js"></script>

</body>

</html>

<?php 
}else{ 
 header("Location: commande.php") ;
 exit();
}
}else{ 
 header("Location: commande.php") ;
 exit();
}
?>