<!DOCTYPE HTML>  
<html>

<head>
  <meta charset="UTF-8">
  <title>Cadastro e Reserva de Pousada</title>
  <link rel="stylesheet" href="style.css"> <!-- Link para o CSS -->
  <script>
    function mostrarFormulario() {
      var escolha = document.getElementById("tipoCadastro").value;

      // Esconde todos os formulários primeiro
      document.getElementById("formHospedes").style.display = "none";
      document.getElementById("formQuartos").style.display = "none";
      document.getElementById("formReserva").style.display = "none";

      // Altera a imagem de acordo com a escolha
      var imageSection = document.querySelector('.image-section');

      if (escolha === "hospedes") {
        document.getElementById("formHospedes").style.display = "block";
        imageSection.style.backgroundImage = "url('pousada2.png')";
      } else if (escolha === "quartos") {
        document.getElementById("formQuartos").style.display = "block";
        imageSection.style.backgroundImage = "url('pousada3.png')";
      } else if (escolha === "reserva") {
        document.getElementById("formReserva").style.display = "block";
        imageSection.style.backgroundImage = "url('pousada4.png')";
      }
    }
  </script>
</head>

<body>

<div class="container">
    <!-- Seção de Imagem -->
    <div class="image-section" style="background-image: url('pousada5.png');">
      <!-- A imagem da pousada será carregada aqui -->
    </div>

    <!-- Seção de Formulário -->
    <div class="form-section">
      <h2>Cadastro e Reserva</h2>
      
      <!-- Menu de seleção -->
      <label for="tipoCadastro">Escolha uma opção:</label>
      <select id="tipoCadastro" name="tipoCadastro" onchange="mostrarFormulario()">
        <option value="">Selecione...</option>
        <option value="hospedes">Cadastro de Hóspedes</option>
        <option value="quartos">Cadastro de Quartos</option>
        <option value="reserva">Reserva de Quartos</option>
      </select>

      <!-- Formulário de Cadastro de Hóspedes -->
      <form id="formHospedes" style="display:none;" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
        <h2>Cadastro de Hóspedes</h2>
        <div class="form-group">
          <label for="nome">Nome:</label>
          <input type="text" name="nome">
        </div>
        <div class="form-group">
          <label for="cpf">CPF:</label>
          <input type="text" name="cpf">
        </div>
        <div class="form-group">
          <label for="endereco">Endereço:</label>
          <input type="text" name="endereco">
        </div>
        <div class="form-group">
          <label for="telefone">Telefone:</label>
          <input type="text" name="telefone">
        </div>
        <div class="form-group">
          <label for="email">E-mail:</label>
          <input type="email" name="email">
        </div>
        <div class="form-group">
          <label for="data_nascimento">Data de Nascimento:</label>
          <input type="date" name="data_nascimento">
        </div>
        <input type="submit" value="Cadastrar Hóspede">
      </form>

      <!-- Formulário de Cadastro de Quartos -->
      <form id="formQuartos" style="display:none;" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
        <h2>Cadastro de Quartos</h2>
        <div class="form-group">
          <label for="numero_quarto">Número do Quarto:</label>
          <input type="text" name="numero_quarto">
        </div>
        <div class="form-group">
          <label for="tipo_quarto">Tipo de Quarto:</label>
          <input type="text" name="tipo_quarto">
        </div>
        <div class="form-group">
          <label for="preco_diaria">Preço da Diária:</label>
          <input type="text" name="preco_diaria">
        </div>
        <div class="form-group">
          <label for="status_quarto">Status:</label>
          <select name="status_quarto">
            <option value="disponivel">Disponível</option>
            <option value="ocupado">Ocupado</option>
          </select>
        </div>
        <input type="submit" value="Cadastrar Quarto">
      </form>

      <!-- Formulário de Reserva de Quartos -->
      <form id="formReserva" style="display:none;" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
        <h2>Reserva de Quartos</h2>
        <div class="form-group">
          <label for="hospede">Hóspede:</label>
          <input type="text" name="hospede">
        </div>
        <div class="form-group">
          <label for="quarto">Quarto:</label>
          <input type="text" name="quarto">
        </div>
        <div class="form-group">
          <label for="checkin">Data de Check-in:</label>
          <input type="date" name="checkin">
        </div>
        <div class="form-group">
          <label for="checkout">Data de Check-out:</label>
          <input type="date" name="checkout">
        </div>
        <div class="form-group">
          <label for="status_reserva">Status da Reserva:</label>
          <select name="status_reserva">
            <option value="confirmada">Confirmada</option>
            <option value="pendente">Pendente</option>
          </select>
        </div>
        <input type="submit" value="Reservar Quarto">
      </form>
      
    </div>
  </div>

</body>

</html>

