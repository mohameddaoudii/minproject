<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>client</title>
    <link rel="stylesheet" href="css/navbar.css" />
    <link rel="stylesheet" href="css/home.css" />
    <link rel="stylesheet" href="css/client.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.0/css/bootstrap.min.css" /> -->
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

</head>

<body>
    <?php  
    $name = "client";
    include "navbar.php"
    ?>
    <div class="containright">
        <div class="pop">
            <div>
                <h1>hi welcom back !</h1>
                <p>client</p>
            </div>

            <div>
                <div class="addclient">
                    <i class="fa-solid fa-user-plus"></i>
                    <p>add client</p>
                </div>
            </div>
        </div>
        <div class="clinet">
            <main class="table">
                <section class="table__header">
                    <h1>Table clients</h1>
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
                                <th>city</th>

                                <th>action</th>
                            </tr>
                        </thead>
                        <tbody id="clients">
                            <?php 
                            include "fonction/classclient.php"; 
                           foreach( $object->AfficheClient() as $value ){
                            echo"
                            <tr>
                                <td>{$value['id_client']}</td>
                                <td>{$value['name']}</td>
                                <td>{$value['telephone']}</td>
                                <td>{$value['email']}</td>
                                <td>
                                    {$value['villle']}
                                </td>
                                <td class='actions'>
                                    <a href='profile.php?idc={$value['id_client']}' class='more'>
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
        <form class="form-container" id="reset">
            <i class="fa-sharp fa-solid fa-arrow-left-long" id="las1"></i>
            <h2>new client</h2>
            <div class="form-group">
                <input type="text" id="name" />
                <label for="name" id="labelname">Name</label>
            </div>
            <div class="form-group">
                <input type="tel" id="telephone" />
                <label for="telephone" id="labeltel">Telephone</label>
            </div>
            <div class="form-group">
                <input type="email" id="email" />
                <label for="email" id="labelemail">Email</label>
            </div>
            <div class="form-group">
                <input type="text" id="city" />
                <label for="city" id="labelcity">City</label>
            </div>
            <div class="form-group">
                <textarea id="address"></textarea>
                <label for="address" id="labeladdress">Address</label>
            </div>
            <button type="submit" id="ajoute">Submit</button>
        </form>
    </div>
    </div>


    <script src="js/jquery-3.6.4.min.js"></script>
    <script src="js/client.js"></script>
</body>

</html>