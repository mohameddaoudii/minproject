<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/navbar.css" />
    <link rel="stylesheet" href="css/home.css" />
    <link rel="stylesheet" href="css/addproducte.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" />
    <title>Producte</title>
</head>

<body>
    <?php  
    $name = "client";
    include "navbar.php"
    ?>
    <div class="containeradd">
        <div class="addprocute light-theme">
            <form class="form-container" id="reset">
                <div class="parte1">
                    <h2>Add producte</h2>
                    <div class="form-group">
                        <input type="text" id="ref_produite" />
                        <label for="name" id="labelref_produite">ref_produite</label>
                    </div>
                    <div class="form-group">
                        <input type="text" id="designaion" />
                        <label for="telephone" id="labeldesignaion">designaion</label>
                    </div>
                    <div class="form-group">
                        <select name="categorie" id="categorie">
                            <option value=" "></option>
                            <option value="newcat">new categorie</option>
                        </select>
                        <label for="categorie" id="labelcategorie">categorie</label>
                    </div>
                    <div class="form-group">
                        <input type="text" id="newcat" />
                        <label for="telephone" id="labelnewcat">name categorie</label>
                    </div>
                    <div class="form-group">
                        <input type="number" id="quantite" />
                        <label for="quantite" id="labelquantite">Quantite</label>
                    </div>
                    <div class="form-group">
                        <input type="number" id="prix" />
                        <label for="prix" id="labelprix">prix</label>
                    </div>
                    <button id="ajoute">Next</button>

                </div>
                <div class="part2">
                    <i class="fa-sharp fa-solid fa-arrow-left-long" id="las"></i>
                    <h2>description producte</h2>
                    <div class="form-group">
                        <textarea name="description" id="description" cols="30" rows="2"></textarea>
                        <label for="description" id="labeldescription">description</label>
                    </div>
                    <div class="containerimage">
                        <div id="btn">
                            <button id="next">next</button>
                        </div>
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
                        <button id="next1">next</button>
                    </div>
                </div>


            </form>
        </div>
    </div>

    </div>
    </div>
    <script src="js/jquery-3.6.4.min.js"></script>
    <script src="js/addproducte.js"></script>
</body>

</html>