$(document).ready(function () {
  $(".delet").click(function () {
    let btndelet = document.querySelector(".delet");
    let idpro = btndelet.dataset.id;

    let xtp = new XMLHttpRequest();
    xtp.open("post", "./fonction/traitementproducet.php");
    xtp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xtp.onreadystatechange = function () {
      if (this.status === 200 && this.readyState === 4) {
        console.log(this.responseText);
        if (this.responseText == "can't delet this producte") {
          $(".errore").text("can't delet this producte");
          $(".errore").fadeToggle(1000, function () {
            $(".errore").fadeToggle(1000);
          });
        } else {
          $(".successfuly").text(this.responseText);
          $(".successfuly").fadeToggle(1000, function () {
            $(".successfuly").fadeToggle(1000, function () {
              window.location.replace(
                "http://localhost:8080/gestioncommend/admin/producte.php"
              );
            });
          });
        }
      }
    };
    let id = $("#i").text();
    var data = {
      idproduite: idpro,
    };
    xtp.send("delet=" + encodeURIComponent(JSON.stringify(data)));
  });

  // update info produte
  console.log("hlel");
  $(".form-container").slideToggle(2000);
  let name = $("#name");
  let designaion = $("#designaion");
  let categorie = $("#categorie");
  let quantite = $("#quantite");
  let prix = $("#prix");
  let newcat = $("#newcategories");
  $("#categorie").on("change", function () {
    if ($("#categorie").val() == "newcat") {
      $(".cat").css("display", "none");
      $(".newcat").css("display", "block");
      $("#newcategories").focus();
    }
  });
  newcat.blur(function () {
    if (!newcat.val()) {
      $("#newcategories").css("borderColor", "red");
      $("#edite").css({ "pointer-events": "none" });
    } else {
      $("#newcategories").css("borderColor", "#29fb43");
      $("#edite").css({ "pointer-events": "stroke" });
    }
  });

  $("#edite").click(function (e) {
    e.preventDefault();
    name = $("#name").val();
    designaion = $("#designaion").val();
    categorie = $("#categorie").val();
    quantite = $("#quantite").val();
    prix = $("#prix").val();
    newcat = $("#newcategories").val();
    description = $("#detail").val();
    let etat = $("#etat").val();
    if (!name && !designaion && !quantite && !prix) {
      $("#name").css("borderColor", "red");
      $("#designaion").css("borderColor", "red");
      $("#quantite").css("borderColor", "red");
      $("#prix").css("borderColor", "red");
      return false;
    } else if (!name) {
      $("#name").css("borderColor", "red");
      return false;
    } else if (!designaion) {
      $("#designaion").css("borderColor", "red");
      return false;
    } else if (!quantite) {
      $("#quantite").css("borderColor", "red");
      return false;
    } else if (!prix) {
      $("#prix").css("borderColor", "red");
      return false;
    } else {
      let lastcats = "";
      if (categorie == "newcat") {
        lastcats = newcat;
      } else {
        lastcats = categorie;
      }
      let btnedite = document.getElementById("edite");
      let idpro = btnedite.dataset.id;
      console.log("id", idpro);
      let xtp = new XMLHttpRequest();
      xtp.open("post", "./fonction/traitementproducet.php");
      xtp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      xtp.onreadystatechange = function () {
        if (this.status === 200 && this.readyState === 4) {
          console.log(this.responseText);
          $(".containerupdate").slideToggle(1300, function () {
            $(".successfuly").text("update successfully");
            // $(".successfuly").text(this.responseText);
            $(".successfuly").fadeToggle(1000, function () {
              $(".successfuly").fadeToggle(1000);
            });
          });
        }
      };
      var data = {
        id: idpro,
        cat: lastcats,
        descriptions: description,
        pris: prix,
        quantites: quantite,
        designaions: designaion,
        names: name,
        etats: etat,
      };
      xtp.send("upadateinfo=" + encodeURIComponent(JSON.stringify(data)));
    }
  });

  $("#updateinfo").click(function () {
    $(".containerupdate").slideToggle(1200);
  });

  $(".image").click(function () {
    let ii = $(".image").children("i");
    ii.css("display", "none");
    $(".image").children("img").css("border", "2px dashed rgb(0, 153, 255)");
    let i = $(this).children("i");
    let datatext = i.attr("data-id");
    $(this).children("img").css("border", "3px dashed red");
    i.css("display", "block");
    orde = true;
    ///
    i.click(function () {
      console.log("hellow ord");
      $(this).parent().remove();

      let xtp = new XMLHttpRequest();
      xtp.open("post", "./fonction/traitementproducet.php");
      xtp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      xtp.onreadystatechange = function () {
        if (this.status === 200 && this.readyState === 4) {
          console.log(this.responseText);
        }
      };
      let idprod = $("#nothing").text();
      var data = {
        imagedelet: datatext,
        idprodui: idprod,
      };
      xtp.send("deletimage=" + encodeURIComponent(JSON.stringify(data)));
    });
    document.addEventListener("click", (e) => {
      if (!e.target.dataset.text) {
        let ii = $(".image").children("i");
        ii.css("display", "none");
        $(".image")
          .children("img")
          .css("border", "2px dashed rgb(0, 153, 255)");
      }
    });
  });
  let cliciamge = "";
  let image = $(".addimages");
  console.log(image);
  let imagesArray = [];
  image.on("change", function ({ target }) {
    let file = target.files[0];
    imagesArray.push(file);
    let index = imagesArray.indexOf(file);
    console.log("image change ");

    $(".slideimages").append(`<div class="imageadds">
                            <img src="${URL.createObjectURL(
                              this.files[0]
                            )}" class="imageuplod" data-text="click" data-id=${index} id="ima${index}" alt="">
                            <i class="fa-solid fa-trash " id="id${index}" data-id=${index}  "></i>
                        </div>`);
  });
  document.addEventListener("click", (e) => {
    if (e.target.dataset.text == "click") {
      console.log("hellow ot sfs");
      // e.style.cssText = "border-color:red;";
      let delet = document.getElementById(`id${e.target.dataset.id}`);
      console.log(delet);
      delet.style.cssText = "display:block;";
      let imagedelet = document.getElementById(`ima${e.target.dataset.id}`);
      // $(`ima${e.target.dataset.id}`).css("borderColor", "red");
      imagedelet.style.cssText = "border: 3px dashed red;";
      let di = e.target.dataset.id;

      document.addEventListener("click", (e) => {
        if (e.target.dataset.id == di) {
          let parent = delet.parentNode;
          index = Number(di);
          console.log(index);
          imagesArray.splice(index, 1);
          console.log(imagesArray);
          parent.remove();
          delet = "";
          imagedelet = "";
          di = "";
          return false;
        } else {
          if (di) {
            delet.style.cssText = "display:none;";
            imagedelet.style.cssText = "border: 2px dashed rgb(0, 153, 255);";
            delet = "";
            imagedelet = "";
            return false;
          }
        }
      });
    }
  });

  $("#next1").click(function (e) {
    e.preventDefault();
    imagesArray.forEach((e, index) => {
      console.log(index);
      if (index == imagesArray.length - 1) {
        let formData = new FormData();
        formData.append("image2", e);
        async function lastimage() {
          $.ajax({
            url: "./fonction/traitementproducet.php",
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            success: await function (response) {
              console.log(response);
              infoprod();
            },
          });
        }
        lastimage();
        // send about producte information to back end

        function infoprod() {
          let xtp = new XMLHttpRequest();
          xtp.open("post", "./fonction/traitementproducet.php");
          xtp.setRequestHeader(
            "Content-type",
            "application/x-www-form-urlencoded"
          );
          xtp.onreadystatechange = function () {
            if (this.status === 200 && this.readyState === 4) {
              // console.log(this.responseText);
              $(".updatephotos").slideToggle(1500, function () {
                $(".successfuly").text("update photo successfuly ");
                $(".successfuly").slideToggle(1700, function () {
                  $(".successfuly").slideToggle(1700);
                });
              });
            }
          };
          let idprod = $("#nothing").text();
          var data = {
            idp: idprod,
          };
          xtp.send("insertph=" + encodeURIComponent(JSON.stringify(data)));
        }

        return false;
      } else {
        let formData = new FormData();
        formData.append("image1", e);
        $.ajax({
          url: "./fonction/traitementproducet.php",
          type: "POST",
          data: formData,
          processData: false,
          contentType: false,
          success: function (response) {
            console.log(response);
          },
        });
      }
    });
  });
  $("#las1").click(function () {
    $(".updatephotos").slideToggle(1500);
  });
  $("#updatephoto").click(function () {
    $(".updatephotos").slideToggle(1500);
  });
});
$(".imageproducte").click(function () {
  let newimage = $(this).attr("src");
  $(".active").attr("src", newimage);
});
