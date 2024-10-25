<?php
session_start();

// Função para salvar hóspedes
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['nome'])) {
    if (isset($_POST['edit_index']) && $_POST['edit_index'] !== '') {
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
        $index = $_POST['edit_index'];
        $_SESSION['quartos'][$index] = [
            "numero_quarto" => $_POST['numero_quarto'],
            "tipo_quarto" => $_POST['tipo_quarto'],
            "preco_diaria" => $_POST['preco_diaria'],
            "status_quarto" => $_POST['status_quarto']
        ];
    } else {
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
        $index = $_POST['edit_index'];
        $_SESSION['reservas'][$index] = [
            "hospede" => $_POST['hospede'],
            "quarto" => $_POST['quarto'],
            "checkin" => $_POST['checkin'],
            "checkout" => $_POST['checkout'],
            "status_reserva" => $_POST['status_reserva']
        ];
    } else {
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
    $_SESSION['hospedes'] = array_values($_SESSION['hospedes']);
}
if (isset($_GET['excluir_quarto'])) {
    $index = $_GET['excluir_quarto'];
    unset($_SESSION['quartos'][$index]);
    $_SESSION['quartos'] = array_values($_SESSION['quartos']);
}
if (isset($_GET['excluir_reserva'])) {
    $index = $_GET['excluir_reserva'];
    unset($_SESSION['reservas'][$index]);
    $_SESSION['reservas'] = array_values($_SESSION['reservas']);
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
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Cadastro e Reserva de Pousada</title>
    <link rel="stylesheet" href="style.css">
    <script src="script.js" defer></script>
</head>
<body>
<div class="main-container">
    <div class="container">
        <!-- Seção de Imagem -->
        <div class="image-section" style="background-image: url('img/pousada5.png');"></div>

        <!-- Seção de Formulário -->
        <div class="form-section">
            <h2>Cadastro e Reserva</h2>

            <!-- Botões de seleção -->
            <div class="button-container">
                <button class="select-button" onclick="mostrarFormulario('formHospedes')">Cadastro de Hóspedes</button>
                <button class="select-button" onclick="mostrarFormulario('formQuartos')">Cadastro de Quartos</button>
                <button class="select-button" onclick="mostrarFormulario('formReserva')">Reserva de Quartos</button>
            </div>

            <!-- Formulário de Cadastro de Hóspedes -->
            <form id="formHospedes" style="display:none;" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                <h2>Cadastro de Hóspedes</h2>
                <div class="form-group">
                    <label for="nome">Nome:</label>
                    <input type="text" name="nome" placeholder="Nome Completo">
                </div>
                <div class="form-group">
                    <label for="cpf">CPF:</label>
                    <input type="text" name="cpf" placeholder="000.000.000-00" maxlength="14" oninput="formatCPF(this)">
                </div>
                <div class="form-group">
                    <label for="endereco">Endereço:</label>
                    <input type="text" name="endereco" placeholder="Rua, Número, Bairro, Cidade">
                </div>
                <div class="form-group">
                    <label for="telefone">Telefone:</label>
                    <input type="text" name="telefone" placeholder="(00) 0 0000-0000" maxlength="15" oninput="formatPhone(this)">
                </div>
                <div class="form-group">
                    <label for="email">E-mail:</label>
                    <input type="email" name="email" placeholder="exemplo@email.com">
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
                    <input type="text" name="numero_quarto" placeholder="Número do Quarto">
                </div>
                <div class="form-group">
                    <label for="tipo_quarto">Tipo de Quarto:</label>
                    <input type="text" name="tipo_quarto" placeholder="Simples, Duplo, Luxo, etc.">
                </div>
                <div class="form-group">
                    <label for="preco_diaria">Preço da Diária:</label>
                    <input type="text" name="preco_diaria" placeholder="R$ 0,00">
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
                    <input type="text" name="hospede" placeholder="Nome do Hóspede">
                </div>
                <div class="form-group">
                    <label for="quarto">Quarto:</label>
                    <input type="text" name="quarto" placeholder="Número do Quarto">
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
                        <option value="cancelada">Cancelada</option>
                    </select>
                </div>
                <input type="submit" value="Reservar">
            </form>
        </div>
    </div>


        <!-- Fim da Seção de Formulário / Início exibição -->

        <div class="container-data">
        <div class="data-display">

            <!-- Hóspedes Cadastrados -->
            <div class="category-container" onclick="toggleContent(this)">
                <h2>
                    Hóspedes Cadastrados
                    <span class="toggle-arrow" style="background-image: url('img/seta-baixo.svg');"></span>
                </h2>
                <ul class="content">
                    <?php if (!empty($_SESSION['hospedes'])): ?>
                        <?php foreach ($_SESSION['hospedes'] as $index => $hospede): ?>
                            <li>
                                <?php echo "Nome: " . htmlspecialchars($hospede['nome']) . "<br>CPF: " . htmlspecialchars($hospede['cpf']); ?>
                                <br>
                                <a class="see-button" href="?ver_quarto=<?php echo $index; ?>">Ver</a>
                                <a class="edit-button" href="?editar_hospede=<?php echo $index; ?>">Editar</a>
                                <a class="delete-button" href="?excluir_hospede=<?php echo $index; ?>">Excluir</a>
                                <br>
                            </li>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p>Nenhum hóspede cadastrado.</p>
                    <?php endif; ?>
                </ul>
            </div>

            <!-- Quartos Cadastrados -->
            <div class="category-container" onclick="toggleContent(this)">
                <h2>
                    Quartos Cadastrados
                    <span class="toggle-arrow" style="background-image: url('img/seta-baixo.png');"></span>
                </h2>
                <ul class="content">
                    <?php if (!empty($_SESSION['quartos'])): ?>
                        <?php foreach ($_SESSION['quartos'] as $index => $quarto): ?>
                            <li>
                                <?php echo "Quarto: " . htmlspecialchars($quarto['numero_quarto']) . "<br>Tipo: " . htmlspecialchars($quarto['tipo_quarto']); ?>
                                <br>
                                <a class="see-button" href="?ver_quarto=<?php echo $index; ?>">Ver</a>
                                <a class="edit-button" href="?editar_quarto=<?php echo $index; ?>">Editar</a>
                                <a class="delete-button" href="?excluir_quarto=<?php echo $index; ?>">Excluir</a>
                                <span class="status-indicator" style="background-color: <?php echo $quarto['status_quarto'] == 'disponivel' ? '#32CD32' : '#FF4500'; ?>"></span>
                                <br>
                            </li>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p>Nenhum quarto cadastrado.</p>
                    <?php endif; ?>
                </ul>
            </div>

            <!-- Reservas Cadastradas -->
            <div class="category-container" onclick="toggleContent(this)">
                <h2>
                    Reservas Cadastradas
                    <span class="toggle-arrow" style="background-image: url('img/seta-baixo.png');"></span>
                </h2>
                <ul class="content">
                    <?php if (!empty($_SESSION['reservas'])): ?>
                        <?php foreach ($_SESSION['reservas'] as $index => $reserva): ?>
                            <li>
                                <?php echo "Hóspede: " . htmlspecialchars($reserva['hospede']) . "<br>Quarto: " . htmlspecialchars($reserva['quarto']); ?>
                                <br>
                                <a class="see-button" href="?ver_quarto=<?php echo $index; ?>">Ver</a>
                                <a class="edit-button" href="?editar_reserva=<?php echo $index; ?>">Editar</a>
                                <a class="delete-button" href="?excluir_reserva=<?php echo $index; ?>">Excluir</a>
                                <br>
                            </li>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p>Nenhuma reserva cadastrada.</p>
                    <?php endif; ?>
                </ul>
            </div>

        </div>
    </div>


    </div>
</div>
</body>
</html>
