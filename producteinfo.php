<?php 
if(isset($_GET['idproducte'])){


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/navbar.css" />
    <link rel="stylesheet" href="css/home.css" />
    <link rel="stylesheet" href="css/infoproducte.css">
    <link href="css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" />
    <title>information producte</title>
</head>

<body>
    <?php  
     $name = "poducte";
     include "navbar.php"; 
     include "fonction/classporducte.php";
     $id_procute = $_GET['idproducte'];
     ?>
    <div id="nothing">16856472</div>
    <div class="contanier">
        <div class="profilecommand">
            <div class="hascomand">
                <p>quantite</p>
                <p>
                    <?php echo($object ->quantite($id_procute)); ?>
                </p>
            </div>
            <!-- <div class="monye">
                <p>quantite now</p>
                <p><?php 
                // echo($object ->quantite_now($id_procute));
                 ?></p>
            </div> -->
            <div class="by">
                <p>selling</p>
                <p><?php echo($object ->selling($id_procute)); ?></p>
            </div>
            <div class="selling">
                <p>money</p>
                <p><?php echo($object ->money($id_procute)); ?> DH </p>
            </div>
            <div class="numcomand">
                <p>N_Of_comd_ex</p>
                <p><?php echo($object ->n_commen_ex($id_procute)); ?></p>
            </div>
            <div class="retire">
                <p> return </p>
                <p><?php echo($object ->returns($id_procute)); ?></p>
            </div>
        </div>







        <main class="container">
            <?php 
            $infopro = $object->infoproducte($id_procute);  
            $imageprince = $infopro['infoproducte']['photo']; 
            $otherimage = $infopro['photo'] ;
            $infop = $infopro['infoproducte'];
            ?>
            <!-- Left Column / Headphones Image -->
            <div class="left-column">
                <img data-image="red" class="active" src="image/<?php echo $imageprince ?>" alt="">

                <div class="slideimage">

                    <?php 
                     foreach($otherimage as $value){ 
                     echo "<img src='image/{$value['photo']}' class = 'imageproducte' alt=''>";
                    }
                    ?>

                </div>
            </div>
            <!-- <div class=" slideimage">
                <img src="image/mouse.png" alt="">
            </div> -->


            <!-- Right Column -->
            <div class="right-column">

                <!-- Product Description -->
                <div class="product-description">
                    <h1><?php echo $infop['cat'] ?></h1>
                    <h2><?php echo $infop['name'] ?></h2>
                    <p><?php echo $infop['detail'] ?></p>
                </div>

                <!-- Product Configuration -->
                <div class="product-configuration">

                    <!-- Product Color -->

                    <!-- Cable Configuration -->
                    <!-- Product Pricing -->
                    <div class="product-id">
                        <span> Id_Producte: <?php echo $infop['id_produit'] ?></span>
                    </div>
                    <div class="product-reference">
                        <span>Refernce_Producte : <?php echo $infop['ref_produit'] ?></span>
                    </div>
                    <div class="product-reference">
                        <span>Designation : <span id="design"> <?php echo $infop['design'] ?> </span></span>
                    </div>
                    <div class="product-etate">
                        <span>Etate : <span><?php echo $infop['etat'] ?></span></span>
                    </div>
                    <div class="product-price">
                        <span>Price : <span><?php echo $infop['prix_u'] ?> DH</span></span>
                    </div>
                </div>
        </main>


        <?php  
         $res = $object->clientsellingproduct($id_procute);
                        if($res[0]['quantite'] != ""){
        ?>
        <main class="table" id="selling">
            <section class="table__header">
                <h1>clients selling this producte</h1>
                <div class="input-group">
                    <input type="search" id="search" placeholder="Search Data..." />
                    <i class="fa-sharp fa-solid fa-magnifying-glass"></i>
                </div>
            </section>
            <section class="table__body">
                <table>
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Telephone</th>
                            <th>email</th>
                            <th>Quantite</th>

                            <th>action</th>
                        </tr>
                    </thead>
                    <tbody id="clients">
                        <?php 
                
                           foreach( $object->clientsellingproduct($id_procute) as $value ){
                            echo"
                            <tr>
                                <td>{$value['clinetinfo']['id_client']}</td>
                                <td>{$value['clinetinfo']['name']}</td>
                                <td>{$value['clinetinfo']['telephone']}</td>
                                <td>{$value['clinetinfo']['email']}</td>
                                <td>
                                    {$value['quantite']}
                                </td>
                                <td class='actions'>
                                    <a href='profile.php?idc={$value['clinetinfo']['id_client']}' class='more'>
                                        <i class='fa-solid fa-circle-info'></i>
                                        <p>more</p>
                                    </a>
                                </td>
                            </tr> 
                            ";
                           }
                            ?>
                    </tbody>
                </table>

            </section>
        </main>
        <?php  
        }
        ?>
        <?php
            $res =  $object->clienthascommentproducte($id_procute) ;
            if($res[0]['quantite'] != ""){ 
        ?>
        <main class="table" id="commande">
            <section class="table__header order">
                <h1>clients has order in this producte</h1>
                <div class="input-group">
                    <input type="search" id="search" placeholder="Search Data..." />
                    <i class="fa-sharp fa-solid fa-magnifying-glass"></i>
                </div>
            </section>
            <section class="table__body">
                <table>
                    <thead class="orders">
                        <tr>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Telephone</th>
                            <th>email</th>
                            <th>quantite</th>

                            <th>action</th>
                        </tr>
                    </thead>
                    <tbody id="clients" class="orders">
                        <?php 
                            // include "fonction/classclient.php";  
                       
                           foreach( $object->clienthascommentproducte($id_procute) as $value ){
                            echo"
                               <tr>
                                <td>{$value['clinetinfo']['id_client']}</td>
                                <td>{$value['clinetinfo']['name']}</td>
                                <td>{$value['clinetinfo']['telephone']}</td>
                                <td>{$value['clinetinfo']['email']}</td>
                                <td>
                                    {$value['quantite']}
                                </td>
                                <td class='actions'>
                                    <a href='profile.php?idc={$value['clinetinfo']['id_client']}' class='more'>
                                        <i class='fa-solid fa-circle-info'></i>
                                        <p>more</p>
                                    </a>
                                </td>
                            </tr> 
                            ";
                            }
                       
                        ?>
                    </tbody>
                </table>
            </section>
        </main>
        <?php 
        }
        ?>

        <?php 
          $res = $object->clientreturnproduct($id_procute); 
          if($res[0]['quantite'] != ""){
        ?>
        <main class="table" id="returns">
            <section class="table__header return">
                <h1>clients return this producte</h1>
                <div class="input-group">
                    <input type="search" id="search" placeholder="Search Data..." />
                    <i class="fa-sharp fa-solid fa-magnifying-glass"></i>
                </div>
            </section>
            <section class="table__body">
                <table>
                    <thead class="return">
                        <tr>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Telephone</th>
                            <th>email</th>
                            <th>quantite</th>

                            <th>action</th>
                        </tr>
                    </thead>
                    <tbody id="clients" class="return">
                        <?php 
                            // include "fonction/classclient.php";   
                       
                           foreach( $object->clientreturnproduct($id_procute) as $value ){
                            echo"
                              <tr>
                                <td>{$value['clinetinfo']['id_client']}</td>
                                <td>{$value['clinetinfo']['name']}</td>
                                <td>{$value['clinetinfo']['telephone']}</td>
                                <td>{$value['clinetinfo']['email']}</td>
                                <td>
                                    {$value['quantite']}
                                </td>
                                <td class='actions'>
                                    <a href='profile.php?idc={$value['clinetinfo']['id_client']}' class='more'>
                                        <i class='fa-solid fa-circle-info'></i>
                                        <p>more</p>
                                    </a>
                                </td>
                            </tr> 
                            ";
                            }
                            ?>
                    </tbody>
                </table>
            </section>
        </main>
        <?php  
          }
         ?>

        <div class="action light-theme ">
            <h3>Action</h3>
            <div class="mainaction">
                <div class="delet" data-id="<?php echo $id_procute;?>">
                    <p> Delet</p>
                </div>
                <div class="edite" id="updateinfo">
                    <p> Update info</p>
                </div>
                <div class="edite" id="updatephoto">
                    <p> Update photo</p>
                </div>
            </div>
        </div>
        <div>
            <div class="successfuly">
            </div>

            <div class="errore">
            </div>
        </div>
        <div class="containerupdate">
            <i class="fa-sharp fa-solid fa-arrow-left-long" id="las2"></i>
            <h2>upadte information producte</h2>
            <div>
                <form action="">
                    <div class="info1">
                        <div>
                            <p>name produite</p>
                            <input type="text" id="name" required placeholder="name producte"
                                value="<?php echo $infop['name'] ?>">
                        </div>
                        <div>
                            <p>designation producte</p>
                            <input type="text" id="designaion" required placeholder="designation producte"
                                value="<?php echo $infop['design'] ?> ">
                        </div>
                        <div>
                            <p>prix</p>
                            <input type="number" id="prix" required placeholder="prix"
                                value="<?php echo $infop['prix_u']?>">
                        </div>
                        <div>
                            <p>Quantite</p>
                            <input type="number" id="quantite" required placeholder="Quantite"
                                value="<?php echo($object ->quantite($id_procute)); ?>">
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
                                <option value="<?php echo $infop['cat'] ?>"><?php echo $infop['cat'] ?></option>
                                <option value="newcat">new categorie</option>
                            </select>
                        </div>
                        <div class="newcat">
                            <p> new categorie</p>
                            <input type="text" id="newcategories" placeholder="name categorie">
                        </div>
                        <div>
                            <p>detaile</p>

                            <textarea name="" id="detail" cols="30" rows="10">
                                <?php echo $infop['detail'] ?>
                            </textarea>
                        </div>
                        <div>
                            <button id="edite" data-id="<?php echo $id_procute;?>">Update</button>
                        </div>
                    </div>




                </form>
            </div>
        </div>
        <div class="updatephotos">
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
                    <div class="slideimages">

                        <?php 
                     foreach($otherimage as $value){  
                        echo "
                        <div class='image'>
                            <img src='image/{$value['photo']}' data-text='nothing' alt=''>
                            <i class='fa-solid fa-trash' data-id='{$value['id_photo']}' data-text='71bANEDuPrL._AC_SL1500_.jpg'
                                class='imageexiste'></i>
                        </div>
                        ";
                         }
                    ?>

                    </div>
                </div>
                <div id="btn">
                    <button id="next1">next</button>
                </div>
            </div>
        </div>


    </div>
    </div>
    <script src="js/jquery-3.6.4.min.js"></script>
    <script src="js/infoproducte.js"></script>
</body>

</html>

<?php 
}else{ 
    header('Location: producte.php');
    exit();
}
?>