$(document).ready(function () {
  // document.querySelector("nav").classList.add("fixed-top");
  // $(".form-container").slideToggle(0);

  console.log("hellowo");
  $(".addclient").click(function () {
    console.log(window.scrollY);
    $(".form-container").slideToggle(2000, function () {
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

          if (this.responseText == "insert") {
            // console.log(this.responseText);
            let name = $("#name").val("");
            let tele = $("#telephone").val("");
            let email = $("#email").val("");
            let city = $("#city").val("");
            let address = $("#address").val("");
            // $("#reset").reset();
            $(".form-container").slideToggle(1000);
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
      var data = {
        names: name,
        teles: tele,
        emails: email,
        addresse: address,
        citys: city,
      };
      xtp.send("insert=" + encodeURIComponent(JSON.stringify(data)));
      console.log("very nice");
    }
  });

  //search about client
  let searchs = $("#search");
  let clients = $("#clients");
  let elmetclient = "";
  searchs.focus(function () {
    elmetclient = clients.html();
    addEventListener("keyup", (e) => {
      let xtp = new XMLHttpRequest();
      xtp.open("post", "./fonction/traitement.php");
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
                <td>${element.id_client}</td>
                <td>${element.name}</td>
                <td>${element.telephone}</td>
                <td>${element.email}</td>
                <td>
                   ${element.villle}
                </td>
                <td class="actions">
                    <a href="profile.php?idc=${element.id_client}" class="more">
                        <i class="fa-solid fa-circle-info"></i>
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
  $("#las1").click(function () {
    $(".form-container").slideToggle(1500);
  });
});
// });
