<?php
session_start(); 


if (!isset($_SESSION['id_utilizador'])) {
    header("Location: login.php"); 
    exit();
}


if ($_SESSION['tipo_utilizador'] !== 'admin') {
    header("Location: loja.php"); 
    exit();
}

$conn = new mysqli('localhost', 'root', '', 'mercearia');
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

$result = $conn->query("SELECT * FROM produtos");
?>
 <!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Admin</title>
    <script src="https://kit.fontawesome.com/22359c54e0.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="estilo.css"> 
</head>
<body>


<nav class="navbar navbar-expand-lg">
    <a class="navbar-brand" href="#">Gerenciador de Produtos</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
            <li class="nav-item">
                <a class="nav-link" href="loja.php"><i class="fas fa-home"></i> Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href=""><i class="fas fa-box"></i> Produtos</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#"><i class="fas fa-users"></i> Usuários</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#"><i class="fas fa-sign-out-alt"></i> Sair</a>
            </li>
        </ul>
    </div>
</nav>

<br>

<div class="tabela-container mt-5">
    
    <table class="table table-striped">
        <thead> 
            <tr>
                <th>Nome</th>
                <th>Preço</th>
                <th>Estoque</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()) { ?>
            <tr>
                <td><?php echo $row['nome']; ?></td>
                <td><?php echo $row['preco']; ?>€</td>
                <td><?php echo $row['estoque']; ?></td>
                <td>
                    <button class="btn btn-primary btn-sm"><i class="fa-solid fa-pen-to-square"></i> Editar</button>
                    <button class="btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i> Excluir</button>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>


<footer class="footer">
    <p>© 2024 Gerenciador de Produtos. Todos os direitos reservados.</p>
    <a href="#">Política de Privacidade</a> | 
    <a href="#">Termos de Uso</a> |
    <a href="#">Contato</a>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
