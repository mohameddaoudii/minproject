$(document).ready(function () {
  // document.querySelector("nav").classList.add("fixed-top");

  // edite client

  $(".edite").click(function () {
    console.log(window.scrollY);
    $(".form-container ").slideToggle(2000, function () {
      window.scrollTo(0, 1000);
    });
  });
  let name = $("#name");
  let tele = $("#telephone");
  let addres = $("#address");
  let email = $("#email");
  let city = $("#city");
  name.blur(function () {
    if (!name.val()) {
      $("#name").css("borderColor", "red");
      $("#labelname").css("color", "red");
      $("#ajoute").css({ "pointer-events": "none" });
    } else {
      $("#name").css("borderColor", "#29fb43");
      $("#labelname").css("color", "#29fb43");
      $("#ajoute").css({ "pointer-events": "stroke" });
    }
  });
  tele.blur(function () {
    if (!tele.val()) {
      $("#telephone").css("borderColor", "red");
      $("#labeltel").css("color", "red");
      $("#ajoute").css({ "pointer-events": "none" });
    } else {
      let regx = /(06|07)[0-9]{8}/g;
      let valu = tele.val();
      if (regx.test(valu) && valu.length == 10) {
        $("#telephone").css("borderColor", "#29fb43");
        $("#labeltel").css("color", "#29fb43");
        $("#ajoute").css({ "pointer-events": "stroke" });
      } else {
        $("#telephone").css("borderColor", "red");
        $("#labeltel").css("color", "red");
        $("#ajoute").css({ "pointer-events": "none" });
      }
    }
  });
  addres.blur(function () {
    if (!addres.val()) {
      $("#address").css("borderColor", "red");
      $("#labeladdress").css("color", "red");
      $("#ajoute").css({ "pointer-events": "none" });
    } else {
      $("#address").css("borderColor", "#29fb43");
      $("#labeladdress").css("color", "#29fb43");
      $("#ajoute").css({ "pointer-events": "stroke" });
    }
  });
  email.blur(function () {
    if (email.val()) {
      if (/\w{5,}@gmail.com/gi.test(email.val())) {
        $("#email").css("borderColor", "#29fb43");
        $("#labelemail").css("color", "#29fb43");
      } else {
        $("#email").css("borderColor", "red");
        $("#labelemail").css("color", "red");
      }
    } else {
      $("#labelemail").css("color", "#888");
      $("#email").css("borderColor", "#2c2e33");
      // email.reset();
    }
  });
  city.blur(function () {
    if (city.val()) {
      $("#city").css("borderColor", "#29fb43");
      $("#labelcity").css("color", "#29fb43");
    }
  });

  $("#ajoute").click(function (e) {
    e.preventDefault();
    let name = $("#name").val();
    let tele = $("#telephone").val();
    let email = $("#email").val();
    let city = $("#city").val();
    let address = $("#address").val();
    if (!name && !tele && !address) {
      console.log("require");
      $("#name").css("borderColor", "red");
      $("#telephone").css("borderColor", "red");
      $("#address").css("borderColor", "red");
      $("#labelname").css("color", "red");
      $("#labeltel").css("color", "red");
      $("#labeladdress").css("color", "red");
      return false;
    } else if (!name) {
      $("#name").css("borderColor", "red");
      $("#labelname").css("color", "red");
      return false;
    } else if (!tele) {
      $("#telephone").css("borderColor", "red");
      $("#labeltel").css("color", "red");
      return false;
    } else if (!address) {
      $("#address").css("borderColor", "red");
      $("#labeladdress").css("color", "red");
      return false;
    } else {
      if (!email) {
        email = "privet";
      }
      if (!city) {
        city = "privet";
      }

      // insert new client
      let xtp = new XMLHttpRequest();
      xtp.open("post", "./fonction/traitement.php");
      xtp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      xtp.onreadystatechange = function () {
        if (this.status === 200 && this.readyState === 4) {
          // console.log(this.responseText);

          if (this.responseText == "edite") {
            $(".form-container ").slideToggle(1000);
            function fadeout() {
              $("#statusinsert").fadeOut(1000);
            }
            $("#statusinsert").fadeIn(1500, function () {
              setTimeout(fadeout(), 1500);
            });
          } else {
            console.log(this.responseText);
          }
        }
      };
      let id = $("#i").text();
      var data = {
        names: name,
        teles: tele,
        emails: email,
        addresse: address,
        citys: city,
        idc: id,
      };
      xtp.send("edite=" + encodeURIComponent(JSON.stringify(data)));
    }
  });

  //delet client
  $(".delet").click(function () {
    //
    let xtp = new XMLHttpRequest();
    xtp.open("post", "./fonction/traitement.php");
    xtp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xtp.onreadystatechange = function () {
      if (this.status === 200 && this.readyState === 4) {
        // console.log(this.responseText);

        if (this.responseText == "delet") {
          function fadeout() {
            $("#deletsta").fadeOut(1000);
          }
          $("#deletsta").fadeIn(1500, function () {
            setTimeout(fadeout(), 1500);
          });
          window.location =
            "http://localhost:8080/gestioncommend/admin/client.php";
        } else {
          console.log(this.responseText);
        }
      }
    };
    let id = $("#i").text();
    var data = {
      idc: id,
    };
    xtp.send("delet=" + encodeURIComponent(JSON.stringify(data)));

    //
  });

  // contacte whit client
  $(".contacte").click(function () {
    $(".cotanteclient").slideToggle(1500);

    $("#send").click(function () {
      let subject = $("#subjec").val();
      let body = $("#body").val();
      if (!subject && !body) {
        $("#subjec").css("borderColor", "red");
        $(".subject").css("color", "red");
        $("#body").css("borderColor", "red");
        $(".body").css("color", "red");
        return false;
      } else if (!subject) {
        $("#subjec").css("borderColor", "red");
        $(".subject").css("color", "red");
        return false;
      } else if (!body) {
        $("#body").css("borderColor", "red");
        $(".body").css("color", "red");
        $("#subjec").css("borderColor", "rgb(178 174 203)");
        $(".subject").css("color", "#0089ff");
        return false;
      } else {
        $("#subjec").css("borderColor", "rgb(178 174 203)");
        $(".subject").css("color", "#0089ff");
        $("#body").css("borderColor", "rgb(178 174 203)");
        $(".body").css("color", "#0089ff");

        //send information  email
        console.log($("#email").text());
        let xtp = new XMLHttpRequest();
        xtp.open("post", "./fonction/traitement.php");
        xtp.setRequestHeader(
          "Content-type",
          "application/x-www-form-urlencoded"
        );
        xtp.onreadystatechange = function () {
          if (this.status === 200 && this.readyState === 4) {
            console.log(this.responseText);
            $("#subjec").val("");
            $("#body").val("");
            $(".cotanteclient").slideToggle(1500, function () {
              $("#statusinsert").text("Send Email Successfully");
              $("#statusinsert").fadeToggle(1500, function () {
                $("#statusinsert").fadeToggle(1500);
              });
            });
          }
        };
        var data = {
          subjet: $("#subjec").val(),
          bod: $("#body").val(),
          email: $("#email").text(),
        };
        xtp.send("sendemail=" + encodeURIComponent(JSON.stringify(data)));
      }
    });
  });
});

// console.log("navigator", Navigator.platform);
// document.cookie = "nav = 'daoudi'";
// let s = Array(f, e, s);
// // let im = new Image()
