<!DOCTYPE HTML>  
<html>

<head>
<meta charset="UTF-8">
  <title>Cadastro e Reserva de Pousada</title>
  <link rel="stylesheet" href="style.css"> <!-- Aqui você está linkando o arquivo CSS -->
  <style>
    .error {
      color: #FF0000;
    }
  </style>
</head>

<body>
<div class="container">
    <!-- Seção de Imagem -->
    <div class="image-section">
      <!-- A imagem da pousada será carregada via CSS como background -->
    </div>
    
  <?php
  // define variáveis e defina como valores vazios
  $nomeErro = $cpfErro = $enderecoErro = $telefoneErro = $emailErro = $dataNascimentoErro = "";
  $numeroQuartoErro = $tipoQuartoErro = $precoDiariaErro = $statusQuartoErro = "";
  $hospedeErro = $quartoErro = $checkinErro = $checkoutErro = $statusReservaErro = "";
  
  // Variáveis para hóspedes
  $nome = $cpf = $endereco = $telefone = $email = $dataNascimento = "";
  
  // Variáveis para quartos
  $numeroQuarto = $tipoQuarto = $precoDiaria = $statusQuarto = "";

  // Variáveis para reservas
  $hospede = $quarto = $checkin = $checkout = $statusReserva = "";

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validação do nome (hóspede)
    if (empty($_POST["nome"])) {
      $nomeErro = "O nome é obrigatório";
    } else {
      $nome = test_input($_POST["nome"]);
      if (!preg_match("/^[a-zA-Z-' ]*$/", $nome)) {
        $nomeErro = "Somente letras e espaços em branco são permitidos";
      }
    }

    // Validação do CPF
    if (empty($_POST["cpf"])) {
      $cpfErro = "O CPF é obrigatório";
    } else {
      $cpf = test_input($_POST["cpf"]);
      if (!preg_match("/^[0-9]{11}$/", $cpf)) {
        $cpfErro = "Formato de CPF inválido";
      }
    }

    // Validação do endereço
    if (empty($_POST["endereco"])) {
      $enderecoErro = "O endereço é obrigatório";
    } else {
      $endereco = test_input($_POST["endereco"]);
    }

    // Validação do telefone
    if (empty($_POST["telefone"])) {
      $telefoneErro = "O telefone é obrigatório";
    } else {
      $telefone = test_input($_POST["telefone"]);
      if (!preg_match("/^[0-9]{10,11}$/", $telefone)) {
        $telefoneErro = "Formato de telefone inválido";
      }
    }

    // Validação do email
    if (empty($_POST["email"])) {
      $emailErro = "O e-mail é obrigatório";
    } else {
      $email = test_input($_POST["email"]);
      if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailErro = "Formato de e-mail inválido";
      }
    }

    // Validação da data de nascimento
    if (empty($_POST["data_nascimento"])) {
      $dataNascimentoErro = "A data de nascimento é obrigatória";
    } else {
      $dataNascimento = test_input($_POST["data_nascimento"]);
      if (!preg_match("/^\d{4}-\d{2}-\d{2}$/", $dataNascimento)) {
        $dataNascimentoErro = "Formato de data inválido";
      }
    }

    // Validação do número do quarto
    if (empty($_POST["numero_quarto"])) {
      $numeroQuartoErro = "O número do quarto é obrigatório";
    } else {
      $numeroQuarto = test_input($_POST["numero_quarto"]);
      if (!preg_match("/^[0-9]+$/", $numeroQuarto)) {
        $numeroQuartoErro = "Número de quarto inválido";
      }
    }

    // Validação do tipo de quarto
    if (empty($_POST["tipo_quarto"])) {
      $tipoQuartoErro = "O tipo de quarto é obrigatório";
    } else {
      $tipoQuarto = test_input($_POST["tipo_quarto"]);
    }

    // Validação do preço da diária
    if (empty($_POST["preco_diaria"])) {
      $precoDiariaErro = "O preço da diária é obrigatório";
    } else {
      $precoDiaria = test_input($_POST["preco_diaria"]);
      if (!preg_match("/^[0-9]+(\.[0-9]{1,2})?$/", $precoDiaria)) {
        $precoDiariaErro = "Formato de preço inválido";
      }
    }

    // Validação do status do quarto
    if (empty($_POST["status_quarto"])) {
      $statusQuartoErro = "O status do quarto é obrigatório";
    } else {
      $statusQuarto = test_input($_POST["status_quarto"]);
    }

    // Validação do hóspede (reserva)
    if (empty($_POST["hospede"])) {
      $hospedeErro = "O hóspede é obrigatório";
    } else {
      $hospede = test_input($_POST["hospede"]);
    }

    // Validação do quarto (reserva)
    if (empty($_POST["quarto"])) {
      $quartoErro = "O quarto é obrigatório";
    } else {
      $quarto = test_input($_POST["quarto"]);
    }

    // Validação do check-in
    if (empty($_POST["checkin"])) {
      $checkinErro = "A data de check-in é obrigatória";
    } else {
      $checkin = test_input($_POST["checkin"]);
      if (!preg_match("/^\d{4}-\d{2}-\d{2}$/", $checkin)) {
        $checkinErro = "Formato de data inválido";
      }
    }

    // Validação do check-out
    if (empty($_POST["checkout"])) {
      $checkoutErro = "A data de check-out é obrigatória";
    } else {
      $checkout = test_input($_POST["checkout"]);
      if (!preg_match("/^\d{4}-\d{2}-\d{2}$/", $checkout)) {
        $checkoutErro = "Formato de data inválido";
      }
    }

    // Validação do status da reserva
    if (empty($_POST["status_reserva"])) {
      $statusReservaErro = "O status da reserva é obrigatório";
    } else {
      $statusReserva = test_input($_POST["status_reserva"]);
    }
  }

  function test_input($dados)
  {
    $dados = trim($dados);
    $dados = stripslashes($dados);
    $dados = htmlspecialchars($dados);
    return $dados;
  }
  ?>

    
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
    <h2>Cadastro de Hóspedes</h2>
    Nome: <input type="text" name="nome" value="<?php echo $nome;?>">
    <span class="error">* <?php echo $nomeErro;?></span>
    <br><br>
    CPF: <input type="text" name="cpf" value="<?php echo $cpf;?>">
    <span class="error">* <?php echo $cpfErro;?></span>
    <br><br>
    Endereço: <input type="text" name="endereco" value="<?php echo $endereco;?>">
    <span class="error">* <?php echo $enderecoErro;?></span>
    <br><br>
    Telefone: <input type="text" name="telefone" value="<?php echo $telefone;?>">
    <span class="error">* <?php echo $telefoneErro;?></span>
    <br><br>
    E-mail: <input type="text" name="email" value="<?php echo $email;?>">
    <span class="error">* <?php echo $emailErro;?></span>
    <br><br>
    Data de Nascimento: <input type="date" name="data_nascimento" value="<?php echo $dataNascimento;?>">
    <span class="error">* <?php echo $dataNascimentoErro;?></span>
    <br><br>

    <h2>Cadastro de Quartos</h2>
    Número do Quarto: <input type="text" name="numero_quarto" value="<?php echo $numeroQuarto;?>">
    <span class="error">* <?php echo $numeroQuartoErro;?></span>
    <br><br>
    Tipo de Quarto: <input type="text" name="tipo_quarto" value="<?php echo $tipoQuarto;?>">
    <span class="error">* <?php echo $tipoQuartoErro;?></span>
    <br><br>
    Preço da Diária: <input type="text" name="preco_diaria" value="<?php echo $precoDiaria;?>">
    <span class="error">* <?php echo $precoDiariaErro;?></span>
    <br><br>
    Status do Quarto: 
    <select name="status_quarto">
      <option value="disponivel" <?php if ($statusQuarto == "disponivel") echo "selected"; ?>>Disponível</option>
      <option value="ocupado" <?php if ($statusQuarto == "ocupado") echo "selected"; ?>>Ocupado</option>
    </select>
    <span class="error">* <?php echo $statusQuartoErro;?></span>
    <br><br>

    <h2>Reserva de Quartos</h2>
    Hóspede: <input type="text" name="hospede" value="<?php echo $hospede;?>">
    <span class="error">* <?php echo $hospedeErro;?></span>
    <br><br>
    Quarto: <input type="text" name="quarto" value="<?php echo $quarto;?>">
    <span class="error">* <?php echo $quartoErro;?></span>
    <br><br>
    Data de Check-in: <input type="date" name="checkin" value="<?php echo $checkin;?>">
    <span class="error">* <?php echo $checkinErro;?></span>
    <br><br>
    Data de Check-out: <input type="date" name="checkout" value="<?php echo $checkout;?>">
    <span class="error">* <?php echo $checkoutErro;?></span>
    <br><br>
    Status da Reserva: 
    <select name="status_reserva">
      <option value="confirmada" <?php if ($statusReserva == "confirmada") echo "selected"; ?>>Confirmada</option>
      <option value="cancelada" <?php if ($statusReserva == "cancelada") echo "selected"; ?>>Cancelada</option>
    </select>
    <span class="error">* <?php echo $statusReservaErro;?></span>
    <br><br>

    <input type="submit" name="submit" value="Enviar">
  </form>

  <?php
  echo "<h2>Seu input:</h2>";
  echo "Nome: " . $nome . "<br>";
  echo "CPF: " . $cpf . "<br>";
  echo "Endereço: " . $endereco . "<br>";
  echo "Telefone: " . $telefone . "<br>";
  echo "E-mail: " . $email . "<br>";
  echo "Data de Nascimento: " . $dataNascimento . "<br><br>";

  echo "Número do Quarto: " . $numeroQuarto . "<br>";
  echo "Tipo de Quarto: " . $tipoQuarto . "<br>";
  echo "Preço da Diária: " . $precoDiaria . "<br>";
  echo "Status do Quarto: " . $statusQuarto . "<br><br>";

  echo "Hóspede: " . $hospede . "<br>";
  echo "Quarto: " . $quarto . "<br>";
  echo "Check-in: " . $checkin . "<br>";
  echo "Check-out: " . $checkout . "<br>";
  echo "Status da Reserva: " . $statusReserva . "<br>";
  ?>

</body>

</html>
