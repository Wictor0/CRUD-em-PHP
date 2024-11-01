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

// Função para desabilitar todos os campos do formulário para visualização
function desabilitarFormulario(formId, desabilitar = true) {
  const form = document.getElementById(formId);
  Array.from(form.elements).forEach((element) => {
    element.disabled = desabilitar;
  });
  document.getElementById("submitHospede").style.display = desabilitar
    ? "none"
    : "block";
  document.getElementById("submitQuarto").style.display = desabilitar
    ? "none"
    : "block";
  document.getElementById("submitReserva").style.display = desabilitar
    ? "none"
    : "block";
}

// Função para visualizar dados de hóspedes
function verHospede(index) {
  const hospede = window.hospedes[index];
  if (hospede) {
    mostrarFormulario("formHospedes");
    document.querySelector('#formHospedes [name="nome"]').value = hospede.nome;
    document.querySelector('#formHospedes [name="cpf"]').value = hospede.cpf;
    document.querySelector('#formHospedes [name="endereco"]').value =
      hospede.endereco;
    document.querySelector('#formHospedes [name="telefone"]').value =
      hospede.telefone;
    document.querySelector('#formHospedes [name="email"]').value =
      hospede.email;
    document.querySelector('#formHospedes [name="data_nascimento"]').value =
      hospede.data_nascimento;
    desabilitarFormulario("formHospedes", true); // Desabilitar para visualização
  }
}

// Função para editar dados de hóspedes
function editarHospede(index) {
  const hospede = window.hospedes[index];
  if (hospede) {
    mostrarFormulario("formHospedes");
    document.querySelector('#formHospedes [name="nome"]').value = hospede.nome;
    document.querySelector('#formHospedes [name="cpf"]').value = hospede.cpf;
    document.querySelector('#formHospedes [name="endereco"]').value =
      hospede.endereco;
    document.querySelector('#formHospedes [name="telefone"]').value =
      hospede.telefone;
    document.querySelector('#formHospedes [name="email"]').value =
      hospede.email;
    document.querySelector('#formHospedes [name="data_nascimento"]').value =
      hospede.data_nascimento;
    document.querySelector('#formHospedes [name="edit_index"]').value = index;
    desabilitarFormulario("formHospedes", false); // Habilitar para edição
  }
}

// Função para visualizar dados de quartos
function verQuarto(index) {
  const quarto = window.quartos[index];
  if (quarto) {
    mostrarFormulario("formQuartos");
    document.querySelector('#formQuartos [name="numero_quarto"]').value =
      quarto.numero_quarto;
    document.querySelector('#formQuartos [name="tipo_quarto"]').value =
      quarto.tipo_quarto;
    document.querySelector('#formQuartos [name="preco_diaria"]').value =
      quarto.preco_diaria;
    document.querySelector('#formQuartos [name="status_quarto"]').value =
      quarto.status_quarto;
    desabilitarFormulario("formQuartos", true); // Desabilitar para visualização
  }
}

// Função para editar dados de quartos
function editarQuarto(index) {
  const quarto = window.quartos[index];
  if (quarto) {
    mostrarFormulario("formQuartos");
    document.querySelector('#formQuartos [name="numero_quarto"]').value =
      quarto.numero_quarto;
    document.querySelector('#formQuartos [name="tipo_quarto"]').value =
      quarto.tipo_quarto;
    document.querySelector('#formQuartos [name="preco_diaria"]').value =
      quarto.preco_diaria;
    document.querySelector('#formQuartos [name="status_quarto"]').value =
      quarto.status_quarto;
    document.querySelector('#formQuartos [name="edit_index"]').value = index;
    desabilitarFormulario("formQuartos", false); // Habilitar para edição
  }
}

// Função para visualizar dados de reservas
function verReserva(index) {
  const reserva = window.reservas[index];
  if (reserva) {
    mostrarFormulario("formReserva");
    document.querySelector('#formReserva [name="hospede"]').value =
      reserva.hospede;
    document.querySelector('#formReserva [name="quarto"]').value =
      reserva.quarto;
    document.querySelector('#formReserva [name="checkin"]').value =
      reserva.checkin;
    document.querySelector('#formReserva [name="checkout"]').value =
      reserva.checkout;
    document.querySelector('#formReserva [name="status_reserva"]').value =
      reserva.status_reserva;
    desabilitarFormulario("formReserva", true); // Desabilitar para visualização
  }
}

// Função para editar dados de reservas
function editarReserva(index) {
  const reserva = window.reservas[index];
  if (reserva) {
    mostrarFormulario("formReserva");
    document.querySelector('#formReserva [name="hospede"]').value =
      reserva.hospede;
    document.querySelector('#formReserva [name="quarto"]').value =
      reserva.quarto;
    document.querySelector('#formReserva [name="checkin"]').value =
      reserva.checkin;
    document.querySelector('#formReserva [name="checkout"]').value =
      reserva.checkout;
    document.querySelector('#formReserva [name="status_reserva"]').value =
      reserva.status_reserva;
    document.querySelector('#formReserva [name="edit_index"]').value = index;
    desabilitarFormulario("formReserva", false); // Habilitar para edição
  }
}
