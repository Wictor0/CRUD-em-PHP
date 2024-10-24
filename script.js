function mostrarFormulario() {
  var escolha = document.getElementById("tipoCadastro").value;

  // Esconde todos os formulários primeiro
  document.getElementById("formHospedes").style.display = "none";
  document.getElementById("formQuartos").style.display = "none";
  document.getElementById("formReserva").style.display = "none";

  // Altera a imagem de acordo com a escolha
  var imageSection = document.querySelector(".image-section");

  if (escolha === "hospedes") {
    document.getElementById("formHospedes").style.display = "block";
    imageSection.style.backgroundImage = "url('img/pousada2.png')";
  } else if (escolha === "quartos") {
    document.getElementById("formQuartos").style.display = "block";
    imageSection.style.backgroundImage = "url('img/pousada3.png')";
  } else if (escolha === "reserva") {
    document.getElementById("formReserva").style.display = "block";
    imageSection.style.backgroundImage = "url('img/pousada4.png')";
  }
}
