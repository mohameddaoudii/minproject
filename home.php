<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/navbar.css" />
    <link rel="stylesheet" href="css/home.css" />
    <link rel="stylesheet" href="css/profile.css">
    <link rel="stylesheet" href="css/commande.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" />
    <title>Home</title>
</head>

<body>
    <?php  
     $name = "poducte";
     include "navbar.php";
      ?>
    <div class="firstcontainer light-theme">
        <div class="profile light-theme">
            <div class="profilecommand">
                <div class="hascomand">
                    <p>Numorder</p>
                    <p>0</p>
                </div>
                <div class="monye">
                    <p>selling</p>
                    <p>0</p>
                </div>
                <div class="by">
                    <p>Total balance</p>
                    <p>0</p>
                </div>
                <div class="retire">
                    <p>return</p>
                    <p>0</p>
                </div>
            </div>
        </div>
        <main class="table">
            <section class="table__header">
                <h1>Top Selling Product</h1>
            </section>
            <section class="table__body">
                <table>
                    <thead>
                        <tr>
                            <th>producte</th>
                            <th>price</th>
                            <th>quantite selling</th>
                            <th>totale</th>
                            <!-- <th>id_commande</th> -->
                            <!-- <th>action</th> -->
                        </tr>
                    </thead>
                    <tbody id="clients">
                        <?php 
                    // foreach($object->infocommande($idcommande) as $value ){   
                    //     echo "
                    //     <tr>
                    //         <td class='producte'>
                    //             <div class='infoprodsel'>
                    //                 <div class='imageproducte'><img src='image/{$value['photo']}'
                    //                         alt=''>
                    //                 </div>
                    //                 <div class='nameanddesigntion'>
                    //                     <p class='nameproducte'>{$value['name']}</p>
                    //                 </div>
                    //             </div>
                    //         </td>
                    //         <td>
                    //             {$value['prix_u']} : DH
                    //         </td>
                    //         <td>
                    //             <p class='quantite'>{$value['qte_commande']}</p>

                    //         </td>
                    //         <td>
                    //         {$value['prix']} : DH
                    //         </td>
                    //         </tr>
                    //         ";
                        // }
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
        </main>
    </div>
    </div>
    </div>
</body>

</html>