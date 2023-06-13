<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/navbar.css" />
    <link rel="stylesheet" href="css/home.css" />
    <link rel="stylesheet" href="css/commande.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" />
    <title>commande</title>
</head>

<body>

    <?php  
     $name = "poducte";
     include "navbar.php";  
     include "fonction/classorder.php";
     ?>
    <div class="contanier">
        <div class="pop">
            <div>
                <h1>hi welcom back !</h1>
                <div class="tableproducte">
                    <p>
                        Table
                    </p>
                    <i class="fa-solid fa-angle-right"></i>
                    <p>
                        Order
                    </p>
                </div>
            </div>
            <div class="addprodcute">
                <a href="addcommande.php"> + Add order</a>
            </div>
        </div>
        <main class="table" id="tablecommande">
            <section class="table__header">
                <h1>Table Order</h1>
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
                            <th>Date</th>
                            <th>prix</th>
                            <th>Etat</th>
                            <th>action</th>
                        </tr>
                    </thead>
                    <tbody id="clients">
                        <?php 
                           foreach( $object->listeorder() as $value ){ 
                            $etat =  ""; 
                            if($value['etat'] == "encommande"){ 
                                 $etat =  "encours"; 
                            }elseif($value['etat'] == "true"){ 
                                   $etat =  "validate"; 
                            }elseif($value['etat'] == "false"){ 
                                   $etat =  "refuse"; 
                            }

                            echo"
                            <tr>
                                <td>{$value['id_command']}</td>
                                <td>{$value['name']}</td>
                                <td>{$value['date_command']}</td>
                                <td>{$value['prix_command']}</td>
                                <td class = 'etat'>
                                    <p class='{$value['etat']}'>$etat</p>
                                </td>
                                <td class='actions'>
                                    <a href='commandeinfo.php?idcommande={$value['id_command']}' class='more'>
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

    </div>
    </div>

    <script src="js/jquery-3.6.4.min.js"></script>
    <script src="js/commande.js"></script>
</body>

</html>