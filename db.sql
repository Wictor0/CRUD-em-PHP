<?php
include 'conexao.php';

// Exemplo de listagem de quartos
$sql = "SELECT * FROM QUARTOS";
$result = $conn->query($sql);

echo "<h2>Lista de Quartos</h2>";
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "Número: {$row['numero']} | Tipo: {$row['tipo']} | Preço Diária: {$row['preco_diaria']}<br>";
    }
} else {
    echo "Nenhum quarto encontrado.";
}

// Fechar a conexão (opcional, pois ela fecha automaticamente no fim do script)
$conn->close();
?>