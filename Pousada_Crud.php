<?php
session_start(); // Inicia a sessão para armazenar dados temporariamente

// Função para salvar hóspedes
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['nome'])) {
    if (isset($_POST['edit_index']) && $_POST['edit_index'] !== '') {
        // Edita o hóspede existente
        $index = $_POST['edit_index'];
        $_SESSION['hospedes'][$index] = [
            "nome" => $_POST['nome'],
            "cpf" => $_POST['cpf'],
            "endereco" => $_POST['endereco'],
            "telefone" => $_POST['telefone'],
            "email" => $_POST['email'],
            "data_nascimento" => $_POST['data_nascimento']
        ];
    } else {
        // Adiciona um novo hóspede
        $_SESSION['hospedes'][] = [
            "nome" => $_POST['nome'],
            "cpf" => $_POST['cpf'],
            "endereco" => $_POST['endereco'],
            "telefone" => $_POST['telefone'],
            "email" => $_POST['email'],
            "data_nascimento" => $_POST['data_nascimento']
        ];
    }
}

// Função para salvar quartos
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['numero_quarto'])) {
    if (isset($_POST['edit_index']) && $_POST['edit_index'] !== '') {
        // Edita o quarto existente
        $index = $_POST['edit_index'];
        $_SESSION['quartos'][$index] = [
            "numero_quarto" => $_POST['numero_quarto'],
            "tipo_quarto" => $_POST['tipo_quarto'],
            "preco_diaria" => $_POST['preco_diaria'],
            "status_quarto" => $_POST['status_quarto']
        ];
    } else {
        // Adiciona um novo quarto
        $_SESSION['quartos'][] = [
            "numero_quarto" => $_POST['numero_quarto'],
            "tipo_quarto" => $_POST['tipo_quarto'],
            "preco_diaria" => $_POST['preco_diaria'],
            "status_quarto" => $_POST['status_quarto']
        ];
    }
}

// Função para salvar reservas
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['hospede'])) {
    if (isset($_POST['edit_index']) && $_POST['edit_index'] !== '') {
        // Edita a reserva existente
        $index = $_POST['edit_index'];
        $_SESSION['reservas'][$index] = [
            "hospede" => $_POST['hospede'],
            "quarto" => $_POST['quarto'],
            "checkin" => $_POST['checkin'],
            "checkout" => $_POST['checkout'],
            "status_reserva" => $_POST['status_reserva']
        ];
    } else {
        // Adiciona uma nova reserva
        $_SESSION['reservas'][] = [
            "hospede" => $_POST['hospede'],
            "quarto" => $_POST['quarto'],
            "checkin" => $_POST['checkin'],
            "checkout" => $_POST['checkout'],
            "status_reserva" => $_POST['status_reserva']
        ];
    }
}

// Função para excluir registros
if (isset($_GET['excluir_hospede'])) {
    $index = $_GET['excluir_hospede'];
    unset($_SESSION['hospedes'][$index]);
    $_SESSION['hospedes'] = array_values($_SESSION['hospedes']); // Reindexa o array
}
if (isset($_GET['excluir_quarto'])) {
    $index = $_GET['excluir_quarto'];
    unset($_SESSION['quartos'][$index]);
    $_SESSION['quartos'] = array_values($_SESSION['quartos']); // Reindexa o array
}
if (isset($_GET['excluir_reserva'])) {
    $index = $_GET['excluir_reserva'];
    unset($_SESSION['reservas'][$index]);
    $_SESSION['reservas'] = array_values($_SESSION['reservas']); // Reindexa o array
}

// Variáveis para edição
$editHospede = null;
$editQuarto = null;
$editReserva = null;

if (isset($_GET['editar_hospede'])) {
    $index = $_GET['editar_hospede'];
    $editHospede = $_SESSION['hospedes'][$index];
    $editHospede['index'] = $index;
}
if (isset($_GET['editar_quarto'])) {
    $index = $_GET['editar_quarto'];
    $editQuarto = $_SESSION['quartos'][$index];
    $editQuarto['index'] = $index;
}
if (isset($_GET['editar_reserva'])) {
    $index = $_GET['editar_reserva'];
    $editReserva = $_SESSION['reservas'][$index];
    $editReserva['index'] = $index;
}
?>

<!DOCTYPE HTML>
<html>
<head>
    <meta charset="UTF-8">
    <title>Cadastro e Reserva de Pousada</title>
    <link rel="stylesheet" href="style.css"> <!-- Link para o CSS -->
    <script src="script.js" defer></script> <!-- Link para o JavaScript -->
</head>
<body>

<div class="container">
    <!-- Seção de Imagem -->
    <div class="image-section" style="background-image: url('img/pousada5.png');"></div>

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

      <!-- Formulário de Edição de Hóspedes -->
      <?php if ($editHospede): ?>
      <div class="edit-form">
          <h2>Editar Hóspede</h2>
          <form method="post" action="">
              <input type="hidden" name="edit_index" value="<?php echo $editHospede['index']; ?>">
              <div class="form-group">
                  <label for="nome">Nome:</label>
                  <input type="text" name="nome" value="<?php echo htmlspecialchars($editHospede['nome']); ?>">
              </div>
              <div class="form-group">
                  <label for="cpf">CPF:</label>
                  <input type="text" name="cpf" value="<?php echo htmlspecialchars($editHospede['cpf']); ?>">
              </div>
              <div class="form-group">
                  <label for="endereco">Endereço:</label>
                  <input type="text" name="endereco" value="<?php echo htmlspecialchars($editHospede['endereco']); ?>">
              </div>
              <div class="form-group">
                  <label for="telefone">Telefone:</label>
                  <input type="text" name="telefone" value="<?php echo htmlspecialchars($editHospede['telefone']); ?>">
              </div>
              <div class="form-group">
                  <label for="email">E-mail:</label>
                  <input type="email" name="email" value="<?php echo htmlspecialchars($editHospede['email']); ?>">
              </div>
              <div class="form-group">
                  <label for="data_nascimento">Data de Nascimento:</label>
                  <input type="date" name="data_nascimento" value="<?php echo htmlspecialchars($editHospede['data_nascimento']); ?>">
              </div>
              <input type="submit" value="Salvar Alterações">
          </form>
      </div>
      <?php endif; ?>

      <!-- Formulário de Edição de Quartos -->
      <?php if ($editQuarto): ?>
      <div class="edit-form">
          <h2>Editar Quarto</h2>
          <form method="post" action="">
              <input type="hidden" name="edit_index" value="<?php echo $editQuarto['index']; ?>">
              <div class="form-group">
                  <label for="numero_quarto">Número do Quarto:</label>
                  <input type="text" name="numero_quarto" value="<?php echo htmlspecialchars($editQuarto['numero_quarto']); ?>">
              </div>
              <div class="form-group">
                  <label for="tipo_quarto">Tipo de Quarto:</label>
                  <input type="text" name="tipo_quarto" value="<?php echo htmlspecialchars($editQuarto['tipo_quarto']); ?>">
              </div>
              <div class="form-group">
                  <label for="preco_diaria">Preço da Diária:</label>
                  <input type="text" name="preco_diaria" value="<?php echo htmlspecialchars($editQuarto['preco_diaria']); ?>">
              </div>
              <div class="form-group">
                  <label for="status_quarto">Status:</label>
                  <select name="status_quarto">
                      <option value="disponivel" <?php if($editQuarto['status_quarto'] == 'disponivel') echo 'selected'; ?>>Disponível</option>
                      <option value="ocupado" <?php if($editQuarto['status_quarto'] == 'ocupado') echo 'selected'; ?>>Ocupado</option>
                  </select>
              </div>
              <input type="submit" value="Salvar Alterações">
          </form>
      </div>
      <?php endif; ?>

      <!-- Formulário de Edição de Reservas -->
      <?php if ($editReserva): ?>
      <div class="edit-form">
          <h2>Editar Reserva</h2>
          <form method="post" action="">
              <input type="hidden" name="edit_index" value="<?php echo $editReserva['index']; ?>">
              <div class="form-group">
                  <label for="hospede">Hóspede:</label>
                  <input type="text" name="hospede" value="<?php echo htmlspecialchars($editReserva['hospede']); ?>">
              </div>
              <div class="form-group">
                  <label for="quarto">Quarto:</label>
                  <input type="text" name="quarto" value="<?php echo htmlspecialchars($editReserva['quarto']); ?>">
              </div>
              <div class="form-group">
                  <label for="checkin">Data de Check-in:</label>
                  <input type="date" name="checkin" value="<?php echo htmlspecialchars($editReserva['checkin']); ?>">
              </div>
              <div class="form-group">
                  <label for="checkout">Data de Check-out:</label>
                  <input type="date" name="checkout" value="<?php echo htmlspecialchars($editReserva['checkout']); ?>">
              </div>
              <div class="form-group">
                  <label for="status_reserva">Status da Reserva:</label>
                  <select name="status_reserva">
                      <option value="confirmada" <?php if($editReserva['status_reserva'] == 'confirmada') echo 'selected'; ?>>Confirmada</option>
                      <option value="pendente" <?php if($editReserva['status_reserva'] == 'pendente') echo 'selected'; ?>>Pendente</option>
                  </select>
              </div>
              <input type="submit" value="Salvar Alterações">
          </form>
      </div>
      <?php endif; ?>
       
    </div>
  </div>

  <!-- Fim da Seção de Formulário / Inicio exibição -->

  <div class="container-data">
    <div class="data-display">

        <!-- Hóspedes Cadastrados -->
        <div class="category-container">
            <h2>Hóspedes Cadastrados</h2>
            <?php if (!empty($_SESSION['hospedes'])): ?>
                <ul>
                    <?php foreach ($_SESSION['hospedes'] as $index => $hospede): ?>
                        <li>
                            <?php echo "Nome: " . htmlspecialchars($hospede['nome']) . "<br>CPF: " . htmlspecialchars($hospede['cpf']); ?>
                            <br><a class="edit-button" href="?editar_hospede=<?php echo $index; ?>">Editar</a>
                            <a class="delete-button" href="?excluir_hospede=<?php echo $index; ?>">Excluir</a><br>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php else: ?>
                <p>Nenhum hóspede cadastrado.</p>
            <?php endif; ?>
        </div>

        <!-- Quartos Cadastrados -->
        <div class="category-container">
            <h2>Quartos Cadastrados</h2>
            <?php if (!empty($_SESSION['quartos'])): ?>
                <ul>
                    <?php foreach ($_SESSION['quartos'] as $index => $quarto): ?>
                        <li>
                            <?php echo "Quarto: " . htmlspecialchars($quarto['numero_quarto']) . "<br>Tipo: " . htmlspecialchars($quarto['tipo_quarto']); ?>
                            <br><a class="edit-button" href="?editar_quarto=<?php echo $index; ?>">Editar</a>
                            <a class="delete-button" href="?excluir_quarto=<?php echo $index; ?>">Excluir</a><br>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php else: ?>
                <p>Nenhum quarto cadastrado.</p>
            <?php endif; ?>
        </div>

        <!-- Reservas Cadastradas -->
        <div class="category-container">
            <h2>Reservas Cadastradas</h2>
            <?php if (!empty($_SESSION['reservas'])): ?>
                <ul>
                    <?php foreach ($_SESSION['reservas'] as $index => $reserva): ?>
                        <li>
                            <?php echo "Hóspede: " . htmlspecialchars($reserva['hospede']) . "<br>Quarto: " . htmlspecialchars($reserva['quarto']); ?>
                            <br><a class="edit-button" href="?editar_reserva=<?php echo $index; ?>">Editar</a>
                            <a class="delete-button" href="?excluir_reserva=<?php echo $index; ?>">Excluir</a><br>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php else: ?>
                <p>Nenhuma reserva cadastrada.</p>
            <?php endif; ?>
        </div>

    </div>
</div>
</body>
</html>