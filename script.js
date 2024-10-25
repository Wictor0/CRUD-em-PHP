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

// Função para aplicar máscara ao CPF
function formatCPF(input) {
  input.value = input.value
    .replace(/\D/g, "")
    .replace(/(\d{3})(\d)/, "$1.$2")
    .replace(/(\d{3})(\d)/, "$1.$2")
    .replace(/(\d{3})(\d{1,2})$/, "$1-$2");
}

// Função para aplicar máscara ao Telefone
function formatPhone(input) {
  input.value = input.value
    .replace(/\D/g, "")
    .replace(/(\d{2})(\d)/, "($1) $2")
    .replace(/(\d{1})(\d{4})(\d{4})$/, "$1 $2-$3");
}

function mostrarFormulario(formId) {
  // Esconde todos os formulários
  const forms = document.querySelectorAll("form");
  forms.forEach((form) => (form.style.display = "none"));

  // Remove a classe 'active' de todos os botões
  const buttons = document.querySelectorAll(".select-button");
  buttons.forEach((button) => button.classList.remove("active"));

  // Exibe o formulário selecionado
  const form = document.getElementById(formId);
  if (form) {
    form.style.display = "block";
  }

  // Adiciona a classe 'active' ao botão clicado
  event.target.classList.add("active");
}

function toggleContent(container) {
  const content = container.querySelector(".content");
  const arrow = container.querySelector(".toggle-arrow");
  if (content.style.display === "none" || content.style.display === "") {
    content.style.display = "block";
    arrow.style.backgroundImage = "url('img/seta-cima.svg')"; // seta para cima
  } else {
    content.style.display = "none";
    arrow.style.backgroundImage = "url('img/seta-baixo.svg')"; // seta para baixo
  }
}

document.addEventListener("DOMContentLoaded", function () {
  const containers = document.querySelectorAll(".category-container .content");
  containers.forEach((container) => (container.style.display = "none"));
});
