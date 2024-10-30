<?php
session_start(); 
include 'conexao.php';

$query = $_GET['query'];
$sql = "SELECT * FROM produtos WHERE nome LIKE :query";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':query', '%' . $query . '%');
$stmt->execute();

$resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
foreach ($resultados as $produto) {
    echo "<div class='produto'>";
    echo "<h5>" . $produto['nome'] . "</h5>";
    echo "<p>Preço: R$" . number_format($produto['preco'], 2, ',', '.') . "</p>";
    echo "</div>";
}
?>
