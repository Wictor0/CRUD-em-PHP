<?php
// Conexão com o banco de dados
$servername = "localhost";
$username = "root";
$password = "";  // Altere se necessário
$dbname = "pousada_db";

// Cria a conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica se a conexão foi bem-sucedida
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Funções de CRUD para a tabela QUARTOS

// 1. Criar um quarto
function criarQuarto($conn, $numero, $tipo, $preco_diaria) {
    $sql = "INSERT INTO QUARTOS (numero, tipo, preco_diaria) VALUES ('$numero', '$tipo', '$preco_diaria')";
    if ($conn->query($sql) === TRUE) {
        echo "Quarto criado com sucesso.<br>";
    } else {
        echo "Erro ao criar quarto: " . $conn->error . "<br>";
    }
}

// 2. Listar todos os quartos
function listarQuartos($conn) {
    $sql = "SELECT * FROM QUARTOS";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "Número: {$row['numero']} | Tipo: {$row['tipo']} | Preço Diária: {$row['preco_diaria']}<br>";
        }
    } else {
        echo "Nenhum quarto encontrado.<br>";
    }
}

// 3. Atualizar um quarto
function atualizarQuarto($conn, $numero, $novoTipo, $novoPrecoDiaria) {
    $sql = "UPDATE QUARTOS SET tipo = '$novoTipo', preco_diaria = '$novoPrecoDiaria' WHERE numero = '$numero'";
    if ($conn->query($sql) === TRUE) {
        echo "Quarto atualizado com sucesso.<br>";
    } else {
        echo "Erro ao atualizar quarto: " . $conn->error . "<br>";
    }
}

// 4. Excluir um quarto
function excluirQuarto($conn, $numero) {
    $sql = "DELETE FROM QUARTOS WHERE numero = '$numero'";
    if ($conn->query($sql) === TRUE) {
        echo "Quarto excluído com sucesso.<br>";
    } else {
        echo "Erro ao excluir quarto: " . $conn->error . "<br>";
    }
}

// Exemplos de Uso das Funções
// criarQuarto($conn, 101, 'Casal', 200.00);
// listarQuartos($conn);
// atualizarQuarto($conn, 101, 'Família', 250.00);
// excluirQuarto($conn, 101);

// Fecha a conexão
$conn->close();
?>