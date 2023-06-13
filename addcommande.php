 <!DOCTYPE html>
 <html lang="en">

 <head>
     <meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel="stylesheet" href="css/navbar.css" />
     <link rel="stylesheet" href="css/home.css" />
     <!-- <link rel="stylesheet" href="css/commandeinfo.css"> -->
     <!-- <link rel="stylesheet" href="css/commande.css" /> -->
     <link rel="stylesheet" href="css/addcommande.css" />
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" />
     <link rel="stylesheet" href="css/producte.css">

     <title>procute.php</title>
 </head>

 <body>
     <?php  
     $name = "poducte";
     include "navbar.php"; 
     include "fonction/classorder.php";    
     $info = $object->selecproducte() 
 ?>
     <div class="container">
         <div class="pop">
             <div>
                 <h1>new commande<h1>
             </div>
         </div>

         <div class="productepresnt">

             <?php 
            foreach($info as $key=>$value){ 
                echo " 
            <div class='containerproducte'>
                <h3> $key </h3>
                <div>
                    <div class='producte'> 
                        "; 
                        foreach($value as $keys => $values){
                            $stock = "";
                            if ($values['quantite'] > 0 ){ 
                                $stock = "Available";
                            }else{ 
                                $stock = "Not Available";
                            }
                        echo "
                        <div class='garde' data-id='{$values['id_produit']}'>
                            <div class='image'>
                                <img src='image/{$values['photo']}' alt=''>
                            </div>
                            <div class='title'>
                                <p>{$values['name']}</p>
                            </div>
                            <div class='categorie'>
                                <p>{$values['design']}</p>
                            </div>
                            <div class='prix'>
                                <p>{$values['prix_u']} DH</p>
                            </div>
                            <div class='addcart'>
                                <input type='text' id='id{$values['id_produit']}' name='' value='1' class='quantite'> 
                            
                            <button class='addtocart' data-name='{$values['name']}' data-image='{$values['photo']}'  data-id='{$values['id_produit']}' data-price='{$values['prix_u']}'>  
                                <i class='fa fa-cart-plus me-2'></i>
                                    <p> Add to card  </p>
                            </button>
                            </div>
                            <button class='remove'> remove </button>

                        </div> 
                        ";
                        }
                        echo "
                    </div>
                </div>
            </div>  
            ";
            }
            ?>
             <div class="newcommande">next</div>
         </div>

         <div class='tableproductechose'>
             <main class="table">
                 <section class="table__header">
                     <h1>Information Order</h1>
                 </section>
                 <section class='idclientdate'>
                     <div>
                         <p>id clinet </p>
                         <input type="text" name="" id="idclient">
                     </div>
                     <div>
                         <p>date commande </p>
                         <input type="datess" name="" id="datePicker">
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
                                 <!-- <th>id_commande</th> -->
                                 <!-- <th>action</th> -->
                             </tr>
                         </thead>
                         <tbody id="clients">
                         </tbody>
                     </table>
                 </section>
                 <section class="totale">

                     <h3>Total Payment</h3>
                     <ul>
                         <li>Subtotal :</li>
                         <li id="totalepayement"></li>
                     </ul>
                 </section>
             </main>
             <div class="insertcommande">insert commande</div>
         </div>
         <div class="successfully">
             <p>order Insert</p>
         </div>

     </div>

     </div>
     </div>
     <!-- <button class='remove'>
         remove
     </button> -->

     <script src="js/jquery-3.6.4.min.js"></script>
     <script src="js/addcommand.js"></script>
 </body>

 </html>