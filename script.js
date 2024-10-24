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

function mostrarFormulario(formId) {
  // Esconde todos os formulários
  var forms = document.querySelectorAll("form");
  forms.forEach(function (form) {
    form.style.display = "none";
  });

  // Mostra o formulário selecionado
  var form = document.getElementById(formId);
  form.style.display = "block";
}
