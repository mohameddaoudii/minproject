$(document).ready(function () {
  $(".garde").click(function () {
    let id = $(this).attr("data-id");
    window.location = `http://localhost:8080/gestioncommend/admin/producteinfo.php?idproducte=${id}`;
  });

  $(".addprocute").click(function () {
    console.log("hello welcom");
    $(".containerupdate").slideToggle(1000);

    let ref = $("#ref_produite");
    let designaion = $("#designaion");
    let categorie = $("#categorie");
    let quantite = $("#quantite");
    let prix = $("#prix");
    let newcat = $("#newcategories");
    ref.blur(function () {
      if (!ref.val()) {
        $("#ref_produite").css("borderColor", "red");
        $("#labelref_produite").css("color", "red");
        $("#ajoute").css({ "pointer-events": "none" });
      } else {
        $("#ref_produite").css("borderColor", "#29fb43");
        $("#labelref_produite").css("color", "#29fb43");
        $("#ajoute").css({ "pointer-events": "stroke" });
      }
    });

    designaion.blur(function () {
      if (!designaion.val()) {
        $("#designaion").css("borderColor", "red");
        $("#labeldesignaion").css("color", "red");
        $("#ajoute").css({ "pointer-events": "none" });
      } else {
        $("#designaion").css("borderColor", "#29fb43");
        $("#labeldesignaion").css("color", "#29fb43");
        $("#ajoute").css({ "pointer-events": "stroke" });
      }
    });
    $("#categorie").on("change", function () {
      if ($("#categorie").val() == "newcat") {
        $(".cat").css("display", "none");
        $("#labelcategorie").css("display", "none");
        $("#newcat").css("display", "block");
        $("#newcategories").focus();
      } else {
        $("#categorie").css("borderColor", "#29fb43");
        $("#labelcategorie").css("color", "#29fb43");
        $("#labelcategorie").css("top", "-20px");
        $("#ajoute").css({ "pointer-events": "stroke" });
      }
    });
    newcat.blur(function () {
      if (!newcat.val()) {
        $("#newcategories").css("borderColor", "red");
        $("#labelnewcat").css("color", "red");
        $("#ajoute").css({ "pointer-events": "none" });
      } else {
        $("#newcategories").css("borderColor", "#29fb43");
        $("#labelnewcat").css("color", "#29fb43");
        $("#ajoute").css({ "pointer-events": "stroke" });
      }
    });

    quantite.blur(function () {
      if (!quantite.val()) {
        $("#quantite").css("borderColor", "red");
        $("#labelquantite").css("color", "red");
        $("#ajoute").css({ "pointer-events": "none" });
      } else {
        $("#quantite").css("borderColor", "#29fb43");
        $("#labelquantite").css("color", "#29fb43");
        $("#ajoute").css({ "pointer-events": "stroke" });
      }
    });
    prix.blur(function () {
      if (!prix.val()) {
        $("#prix").css("borderColor", "red");
        $("#labelprix").css("color", "red");
        $("#ajoute").css({ "pointer-events": "none" });
      } else {
        $("#prix").css("borderColor", "#29fb43");
        $("#labelprix").css("color", "#29fb43");
        $("#ajoute").css({ "pointer-events": "stroke" });
      }
    });
    $("#ajoute").click(function (e) {
      e.preventDefault();
      if (!ref.val() && !designaion.val() && !quantite.val() && !prix.val()) {
        $("#ref_produite").css("borderColor", "red");
        $("#labelref_produite").css("color", "red");
        $("#designaion").css("borderColor", "red");
        $("#labeldesignaion").css("color", "red");
        $("#quantite").css("borderColor", "red");
        $("#labelquantite").css("color", "red");
        $("#prix").css("borderColor", "red");
        $("#labelprix").css("color", "red");
      } else if (!ref.val()) {
        $("#ref_produite").css("borderColor", "red");
        $("#labelref_produite").css("color", "red");
        $("#ajoute").css({ "pointer-events": "none" });
      } else if (!designaion.val()) {
        $("#designaion").css("borderColor", "red");
        $("#labeldesignaion").css("color", "red");
      } else if (!quantite.val()) {
        $("#quantite").css("borderColor", "red");
        $("#labelquantite").css("color", "red");
        $("#ajoute").css({ "pointer-events": "none" });
      } else if (!prix.val()) {
        $("#prix").css("borderColor", "red");
        $("#labelprix").css("color", "red");
        $("#ajoute").css({ "pointer-events": "none" });
      } else {
        $(".containerupdate").slideToggle(1000, function () {
          $(".parte3").slideToggle(1000);
        });
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
    $(".containerimages").show();

    $(".slideimage").append(`<div class="b">
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
    console.log("hellow dfs");
    let ref = $("#ref_produite").val();
    let designaion = $("#designaion").val();
    let categorie = $("#categorie").val();
    let quantite = $("#quantite").val();
    let prix = $("#prix").val();
    let newcat = $("#newcat").val();
    let description = $("#description").val();
    let lastcat = "";
    if (categorie == "newcat") {
      lastcat = newcat;
    } else {
      lastcat = categorie;
    }
    console.log("lenght", imagesArray.length);

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
              // console.log(response);
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
              if (this.responseText == "insert producte") {
                console.log("fuck in your day");
                $(".parte3").slideToggle(1000, function () {
                  $(".successfully").fadeToggle(1500, function () {
                    $(".successfully").fadeToggle(1500);
                  });
                });
              }
            }
          };
          var data = {
            cat: lastcat,
            descriptions: description,
            pris: prix,
            quantites: quantite,
            designaions: designaion,
            refs: ref,
          };
          xtp.send("infoproducte=" + encodeURIComponent(JSON.stringify(data)));
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

  //search producte

  let searchs = $("#search");
  let clients = $("#clients");
  let elmetclient = "";
  searchs.focus(function () {
    elmetclient = clients.html();
    addEventListener("keyup", (e) => {
      let xtp = new XMLHttpRequest();
      xtp.open("post", "./fonction/traitementproducet.php");
      xtp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      xtp.onreadystatechange = function () {
        if (this.status === 200 && this.readyState === 4) {
          console.log(this.responseText);
          let resulta = JSON.parse(this.responseText);
          // console.log(resulta);
          let clientse = "";
          clients.html("");
          resulta.forEach((element) => {
            clientse = `
           <tr>
              <td>${element["id_produit"]}</td>
              <td>${element["name"]}</td>
              <td class='designation'>${element["design"]}</td>
              <td>${element["cat"]}</td>
              <td>
                  ${element["prix_u"]}
              </td>
                <td>
                  ${element["quantite"]}
              </td>
              <td class='actions'>
                  <a href='producteinfo.php?idproducte=${element["id_produit"]}' class='more'>
                      <i class='fa-solid fa-circle-info'></i>
                      <p>more</p>
                  </a>
              </td>
          </tr> 
            `;
            clients.append(clientse);
          });
        }
      };
      var data = {
        datasearch: searchs.val(),
      };
      xtp.send("search=" + encodeURIComponent(JSON.stringify(data)));
    });
  });
});
