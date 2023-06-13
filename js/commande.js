$(document).ready(function () {
  let searchs = $("#search");
  let clients = $("#clients");
  let elmetclient = "";
  searchs.focus(function () {
    elmetclient = clients.html();
    addEventListener("keyup", (e) => {
      let xtp = new XMLHttpRequest();
      xtp.open("post", "./fonction/traitementcommnad.php");
      xtp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      xtp.onreadystatechange = function () {
        if (this.status === 200 && this.readyState === 4) {
          console.log(this.responseText);
          let resulta = JSON.parse(this.responseText);
          // console.log(resulta);
          let clientse = "";
          clients.html("");
          resulta.forEach((element) => {
            let etat = "";
            if (element.etat == "encommande") {
              etat = "encours";
            } else if (element.etat == "true") {
              etat = "validate";
            } else if (element.etat == "false") {
              etat = "refuse";
            }
            clientse = `
            <tr>
                <td>${element.id_command}</td>
                <td>${element.name}</td>
                <td>${element.date_command}</td>
                <td>${element.prix_command}</td>
                <td class='etat'>
                   <p class="${element.etat}"> ${etat}</p>
                </td>
                <td class="actions">
                    <a href="commandeinfo.php?idcommande=${element.id_command}" class="more">
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
});
