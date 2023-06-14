 <!DOCTYPE html>
 <html lang="en">

 <head>
     <meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel="stylesheet" href="css/navbar.css" />
     <link rel="stylesheet" href="css/home.css" />
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" />
     <link rel="stylesheet" href="css/producte.css">

     <title>procute</title>
 </head>

 <body>
     <?php  
     $name = "poducte";
     include "navbar.php"; 
     include "fonction/classporducte.php";    
     $info = $object->selecproducte() 
 ?>
     <div class="container">
         <div class="pop">
             <div>
                 <h1>hi welcom back !</h1>
                 <div class="tableproducte">
                     <p>
                         List
                     </p>
                     <i class="fa-solid fa-angle-right"></i>
                     <p>
                         producte
                     </p>
                 </div>
             </div>
             <div class="addprodcute">
                 <a class="addprocute"> + Add producte</a>
             </div>


         </div>


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
                         <div class='stock'>
                             <span>stock :</span><span> $stock</span>
                         </div>
                         <div class='prix'>
                             <p>{$values['prix_u']} DH</p>
                         </div>
                         <div class='stock'>
                         </div>
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


         <div class="containerupdate">
             <i class="fa-sharp fa-solid fa-arrow-left-long" id="las3"></i>
             <h2>insert producte</h2>
             <div>
                 <form action="">
                     <div class="info1">
                         <div>
                             <p id="labelref_produite">name produite</p>
                             <input type="text" id="ref_produite" required="" placeholder="name producte">
                         </div>
                         <div>
                             <p id="labeldesignaion">designation producte</p>
                             <input type="text" id="designaion" required="" placeholder="designation producte">
                         </div>
                         <div>
                             <p id="labelprix">prix</p>
                             <input type="number" id="prix" required="" placeholder="prix">
                         </div>
                         <div>
                             <p id="labelquantite">Quantite</p>
                             <input type="number" id="quantite" required="" placeholder="Quantite">
                         </div>
                         <div>
                             <p>etat</p>
                             <select name="etat" id="etat">
                                 <option value="encours">encours</option>
                                 <option value="true">true</option>
                                 <option value="false">false</option>
                             </select>
                         </div>
                     </div>
                     <div class="info2">
                         <div class="cat">
                             <p>categorie</p>
                             <select name="categorie" id="categorie">
                                 <option value="pc & accessories">pc & accessories</option>
                                 <option value="newcat">new categorie</option>
                             </select>
                         </div>
                         <div id="newcat">
                             <p id="labelnewcat"> new categorie</p>
                             <input type="text" id="newcategories" placeholder="name categorie">
                         </div>
                         <div>
                             <p>detaile</p>

                             <textarea name="" id="description" cols="30" rows="10">
                                </textarea>
                         </div>
                         <div>
                             <button id="ajoute" data-id="16856472">Next</button>
                         </div>
                     </div>




                 </form>
             </div>
         </div>
         <div class="parte3">
             <i class="fa-sharp fa-solid fa-arrow-left-long" id="las1"></i>
             <h2>image producte</h2>
             <div class="wrapper">
                 <!-- <img src="image/Accessories_ecoute.jpg" class="imageuplod" alt="">
                        <i class="fa-solid fa-xmark"></i> -->
                 <div class="upload-box">
                     <input type="file" accept="image/*" id="addimage" class="addimages" />
                     <img id="newimage" src="image/upload.png" alt="" />
                     <p>Upload Image Producte</p>
                 </div>
             </div>
             <div class="containerimages">
                 <div class="slideimage">
                 </div>
             </div>
             <div id="btn">
                 <button id="next1">Insert</button>
             </div>
         </div>

         <div class='tableauproductes'>
             <main class="table">
                 <section class="table__header">
                     <h1>Table producte</h1>
                     <div class="input-group">
                         <input type="search" id="search" placeholder="Search Data..." />
                         <i class="fa-sharp fa-solid fa-magnifying-glass"></i>
                     </div>
                 </section>
                 <section class="table__body">
                     <table>
                         <thead>
                             <tr>
                                 <th>Id_produit</th>
                                 <th>Name</th>
                                 <th>designation</th>
                                 <th>categorie</th>
                                 <th>prix_u</th>
                                 <th>quantite</th>
                                 <th>action</th>
                             </tr>
                         </thead>
                         <tbody id="clients">
                             <?php 
                           foreach( $object->sellectallprocut() as $value ){
                            echo"
                            <tr>
                                <td>{$value['id_produit']}</td>
                                <td>{$value['name']}</td>
                                <td class='designation'>{$value['design']}</td>
                                <td>{$value['cat']}</td>
                                <td>
                                    {$value['prix_u']}
                                </td>
                                 <td>
                                    {$value['quantite']}
                                </td>
                                <td class='actions'>
                                    <a href='producteinfo.php?idproducte={$value['id_produit']}' class='more'>
                                        <i class='fa-solid fa-circle-info'></i>
                                        <p>more</p>
                                    </a>
                                </td>
                                <!-- <a href=''></a> -->
                            </tr> 
                            ";
                            }
                            ?>
                         </tbody>
                     </table>
                 </section>
             </main>
         </div>
         <div class="successfully">
             <p>procute Insert</p>
         </div>





     </div>
     </div>
     </div>

     <script src="js/jquery-3.6.4.min.js"></script>
     <script src="js/producte.js"></script>
 </body>

 </html>