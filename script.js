/// Função para mostrar o formulário selecionado
function mostrarFormulario(formId) {
  // Esconde todos os formulários
  const forms = document.querySelectorAll("form");
  forms.forEach((form) => (form.style.display = "none"));

  // Remove a classe 'active' de todos os botões
  const buttons = document.querySelectorAll(".select-button");
  buttons.forEach((button) => button.classList.remove("active"));

  // Exibe o formulário selecionado e adiciona a classe 'active' ao botão clicado
  const form = document.getElementById(formId);
  if (form) {
    form.style.display = "block";
    event.target.classList.add("active");
  }

  // Atualiza a imagem de acordo com o formulário exibido
  const imageSection = document.querySelector(".image-section");
  switch (formId) {
    case "formHospedes":
      imageSection.style.backgroundImage = "url('img/pousada2.png')";
      break;
    case "formQuartos":
      imageSection.style.backgroundImage = "url('img/pousada3.png')";
      break;
    case "formReserva":
      imageSection.style.backgroundImage = "url('img/pousada4.png')";
      break;
  }
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

// Função para alternar a exibição das setas nas categorias
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

// Oculta os conteúdos inicialmente
document.addEventListener("DOMContentLoaded", function () {
  const containers = document.querySelectorAll(".category-container .content");
  containers.forEach((container) => (container.style.display = "none"));
});
