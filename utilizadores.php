<?php

$host = 'localhost';
$dbname = 'mercearia';
$user = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT id, nome_utilizador, tipo_utilizador, dataNascimento FROM utilizadores";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $utilizadores = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    die("Erro na conexão: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Utilizadores</title>
    <link rel="stylesheet" href="estilos.css"> 
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Lista de Utilizadores</h2>
        <table  class="table table-bordered mt-3">
            <thead>
                <tr>
                    <th>ID</th>
                    <th >Nome do Utilizador</th>
                    <th >Tipo de Utilizador</th>
                    <th >Data de Nascimento</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($utilizadores as $utilizador): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($utilizador['id']); ?></td>
                        <td><?php echo htmlspecialchars($utilizador['nome_utilizador']); ?></td>
                        <td><?php echo htmlspecialchars($utilizador['tipo_utilizador']); ?></td>
                        <td><?php echo htmlspecialchars($utilizador['dataNascimento']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
