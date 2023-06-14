<?php
if(isset($_GET["idc"]))  {  
    include "fonction/classclient.php"; 
    $idc =$_GET["idc"]; 
    $exisete = $object->getInfo($idc); 
    if(count($exisete)>0){ 
        echo "";
    }else{ 
    header('Location: client.php');
    exit;
  }
    
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/home.css" />
    <link rel="stylesheet" href="css/navbar.css" />
    <link rel="stylesheet" href="css/profile.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" />
    <title>profile</title>
</head>

<body class="light-theme ">
    <?php  
    $name = "Profile";
    include "navbar.php"
    ?>
    <div class="firstcontainer light-theme">
        <div class="profile light-theme">
            <div class="profilecommand">
                <div class="hascomand">
                    <p>has comand</p>
                    <p> <?php echo $object->hascommande($idc) ; ?> </p>
                </div>
                <div class="monye">
                    <p>monye </p>
                    <p><?php echo $object->money($idc) ; ?> DH</p>
                </div>
                <div class="by">
                    <p>commndby </p>
                    <p><?php echo $object->numcommendby($idc) ; ?></p>
                </div>
                <div class="numcomand">
                    <p>num comand</p>
                    <p><?php echo $object->numcommend($idc) ; ?></p>
                </div>
                <div class="retire">
                    <p> return </p>
                    <p><?php echo $object->numcommendreturn($idc) ; ?></p>
                </div>
            </div>
        </div>
        <div class="about light-theme">
            <h3>About</h3>
            <div>
                <?php  
                // include "fonction/classclient.php"; 
                $info = $object->getInfo($idc);  
                // echo "<pre>";
                // print_r($info);
                echo "<li id='email'>{$info[0]['email']}</li> ";

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
        <div class="action light-theme ">
            <div id="i">
                <?php echo $info[0]['id_client'] ?>
            </div>
            <h3>Action</h3>
            <div class="mainaction">
                <div class="delet">
                    <i class="fa-solid fa-user-minus"></i>
                    <p> Delet</p>
                </div>
                <div class="edite">
                    <i class="fa-solid fa-user-pen"></i>
                    <p> Edite</p>
                </div>
                <div class="contacte">
                    <i class="fa-solid fa-envelope"></i>
                    <p> contacte</p>
                </div>
            </div>
        </div>

        <form class="form-container" id="reset">
            <i class="fa-sharp fa-solid fa-arrow-left-long" id="las2"></i>
            <h2>Edite clinet</h2>
            <div class="form-group">
                <input type="text" id="name" value="<?php echo $info[0]['name']  ?>" />
                <label for="name" id="labelname">Name</label>
            </div>
            <div class="form-group">
                <input type="tel" id="telephone" value="<?php echo $info[0]['telephone']  ?>" />
                <label for="telephone" id="labeltel">Telephone</label>
            </div>
            <div class="form-group">
                <input type="email" id="email" value="<?php echo $info[0]['email']  ?>" />
                <label for="email" id="labelemail">Email</label>
            </div>
            <div class="form-group">
                <input type="text" id="city" value="<?php echo $info[0]['villle']  ?>" />
                <label for="city" id="labelcity">City</label>
            </div>
            <div class="form-group">
                <input id="address" value="<?php echo $info[0]['address']  ?>" />
                <label for="address" id="labeladdress">Address</label>
            </div>
            <button id="ajoute">edite</button>
        </form>
        <div class="cotanteclient">
            <i class="fa-sharp fa-solid fa-arrow-left-long" id="las1"></i>
            <h2>contacte</h2>
            <div>
                <p class="subject">subject</p>
                <input type="text" id="subjec">
            </div>
            <div>
                <p class="body">body</p>
                <textarea name="" id="body" cols="30" rows="10"></textarea>
            </div>
            <button id="send">
                Send
            </button>
        </div>

        <div id="statusinsert">

        </div>
        <div id="deletsta">
            <p>can't delet this client</p>
        </div>
    </div>


    </div>
    </div>
    <script src="js/jquery-3.6.4.min.js"></script>
    <script src="js/profile.js"></script>
</body>


</html>

<?php   

 }else{  
    header('Location: client.php');
    exit;
 }

?>