$(document).ready(function () {
  let commande = [];
  $(".addtocart").click(function () {
    let id_product = Number($(this).attr("data-id"));
    let quantite = Number($(this).parent().children("input").val());
    let pric = parseFloat($(this).attr("data-price"));
    let total = quantite * pric;
    let nothi = $(this).parents(".producte").children(".garde");
    let image = `image/${$(this).attr("data-image")}`;
    let name = $(this).attr("data-name");
    infocommande = {
      quant: quantite,
      id_producte: id_product,
      price: pric,
      totale: total,
      img: image,
      namepro: name,
    };
    commande.push(infocommande);
    console.log(commande);
    let index = commande.indexOf(infocommande);
    console.log(index);
    $(this).parent().hide();
    let btnremov = $(this).parent().next("button");
    btnremov.css("display", "flex");
    btnremov.attr("data-index", index);
    index = "";
    infocommande = "";
    quantite = "";
    id_product = "";
    pric = "";
    total = "";
  });
  let totalepayement = 0;
  $(".newcommande").click(function () {
    $(".productepresnt").hide();
    $(".tableproductechose").show();
    commande.forEach((prod) => {
      totalepayement += prod.totale;
      let lineproducte = ` 
          <tr>
            <td class='productes'>
                <div class='infoprodsel'>
                    <div class='imageproducte'><img
                            src='${prod.img}'
                            alt=''>
                    </div>
                    <div class='nameanddesigntion'>
                        <p class='nameproducte'>${prod.namepro}</p>
                    </div>
                </div>
            </td>
            <td>
               ${prod.price}: DH
            </td>
            <td>
                <input type='number' class='quantite' value = '${prod.quant}'>

            </td>
            <td>
                ${prod.totale}: DH
            </td>
        </tr>
        `;
      $("#clients").append(lineproducte);
    });
    const currentDate = new Date();
    const year = currentDate.getFullYear();
    const month = String(currentDate.getMonth() + 1).padStart(2, "0");
    const day = String(currentDate.getDate()).padStart(2, "0");
    const formattedDate = `${year}-${month}-${day}`;

    document.getElementById("datePicker").value = formattedDate;

    console.log("totalepayement", totalepayement);
    $("#totalepayement").text(`${totalepayement} : DH`);
  });

  $(".insertcommande").click(function () {
    let idclinet = $("#idclient").val();
    let datecommande = $("#datePicker").val();
    if (!idclinet) {
      console.log("sfjsdf");
      $("#idclient").css("borderColor", "red");
      return false;
    }
    console.log("value", datecommande);
    let xtp = new XMLHttpRequest();
    xtp.open("post", "./fonction/traitementcommnad.php");
    xtp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xtp.onreadystatechange = function () {
      if (this.status === 200 && this.readyState === 4) {
        console.log(this.responseText);

        $(".successfully").fadeToggle(1000, function () {
          $(".successfully").fadeToggle(1000, function () {
            window.location.replace(
              "http://localhost:8080/gestioncommend/admin/commande.php"
            );
          });
        });
      }
    };
    var data = {
      id_client: idclinet,
      date_commande: datecommande,
      productecommande: commande,
      prixcommande: totalepayement,
    };
    xtp.send("insertcommande=" + encodeURIComponent(JSON.stringify(data)));
  });
});
