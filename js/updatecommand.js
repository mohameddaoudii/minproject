$(document).ready(function () {
  console.log("hello word ");
  let updatinfocommand = [];
  let deletlignecommand = [];
  $(".updatequantite").blur(function () {
    let firsquantite = $(this).attr("data-value");
    if ($(this).val() == firsquantite) {
      console.log("same value");
    } else {
      $(this).attr("data-value", $(this).val());
      console.log("dose not same vlaue");

      let totaleprice =
        Number($(this).attr("data-price")) * Number($(this).val());
      $(this).parent().next().text(`${totaleprice} : DH`);

      ////

      ///
      let lasttotale =
        parseFloat($("#totalepayement").attr("data-totale")) -
        parseFloat($(this).parent().next().attr("data-price"));

      let newtotalepayement = totaleprice + lasttotale;
      ///
      ///
      ///

      ///
      $("#totalepayement").text(`${newtotalepayement} : DH`);
      $("#totalepayement").attr("data-totale", newtotalepayement);

      $(this).parent().next().attr("data-price", totaleprice);

      var data = {
        quantite: $(this).val(),
        idligne: $(this).attr("data-idligne"),
        totale: totaleprice,
      };
      updatinfocommand.push(data);
      console.log(updatinfocommand);
    }
  });

  ////

  $(".insertupdate").click(function () {
    // delet ligne commande

    deletlignecommand.forEach((e) => {
      let xtp = new XMLHttpRequest();
      xtp.open("post", "./fonction/traitementcommnad.php");
      xtp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      xtp.onreadystatechange = function () {
        if (this.status === 200 && this.readyState === 4) {
          console.log(this.responseText);
        }
      };
      xtp.send("deletlignecommande=" + encodeURIComponent(JSON.stringify(e)));
    });
    // update infoligne commande
    updatinfocommand.forEach((e) => {
      let xtp = new XMLHttpRequest();
      xtp.open("post", "./fonction/traitementcommnad.php");
      xtp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      xtp.onreadystatechange = function () {
        if (this.status === 200 && this.readyState === 4) {
          console.log(this.responseText);
        }
      };
      xtp.send(
        "updateinfoligncommand=" + encodeURIComponent(JSON.stringify(e))
      );
    });
    //update info commande commande
    let xtp = new XMLHttpRequest();
    xtp.open("post", "./fonction/traitementcommnad.php");
    xtp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xtp.onreadystatechange = function () {
      if (this.status === 200 && this.readyState === 4) {
        $(".updatecommande ").slideToggle(1500, function () {
          $(".succefully").html("<p>Update seccussfully</p");
          $(".succefully").fadeToggle(1500, function () {
            $(".succefully").fadeToggle(1500);
          });
        });
      }
    };
    // let id =
    let etas = $("#etat").val();
    let dataa = {
      idcommand: $("#totalepayement").attr("data-id"),
      totalepyement: $("#totalepayement").attr("data-totale"),
      etat: etas,
    };
    xtp.send("updatecommande=" + encodeURIComponent(JSON.stringify(dataa)));
  });

  // delet ligne commande
  //

  $(".deletlignecommande").click(function () {
    let idlignecommand = $(this).attr("data-id");
    let newtotalepayement =
      parseFloat($("#totalepayement").attr("data-totale")) -
      parseFloat($(this).attr("data-price"));

    $("#totalepayement").attr("data-totale", newtotalepayement);
    $("#totalepayement").text(`${newtotalepayement} : DH`);
    console.log(newtotalepayement);
    let dataid = {
      id: idlignecommand,
    };
    $(this).parents("tr").remove();
    deletlignecommand.push(dataid);
  });

  //
  $("#updateorder").click(function () {
    $(".updatecommande ").slideToggle(1500);
  });

  // delet order
  $("#deletcommande").click(function () {
    let idcom = Number($(this).attr("data-id"));

    let xtp = new XMLHttpRequest();
    xtp.open("post", "./fonction/traitementcommnad.php");
    xtp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xtp.onreadystatechange = function () {
      if (this.status === 200 && this.readyState === 4) {
        console.log(this.responseText);
        if (this.responseText == "can't delet this order") {
          $(".errore").html("<p>can't delet this order </p>");
          $(".errore").fadeToggle(1500, function () {
            $(".errore").fadeToggle(1500);
          });
        } else {
          $(".succefully").html("<p>Delet successfully</p>");
          $(".succefully").fadeToggle(1500, function () {
            $(".succefully").fadeToggle(1500, function () {
              window.location.replace(
                "http://localhost:8080/gestioncommend/admin/commande.php"
              );
            });
          });
        }
      }
    };
    let da = {
      idcommande: idcom,
    };
    xtp.send("deletcommand=" + encodeURIComponent(JSON.stringify(da)));
  });
});
