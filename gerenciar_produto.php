<?php
session_start();

if (!isset($_SESSION['id_utilizador']) || $_SESSION['tipo_utilizador'] !== 'admin') {
    header("Location: login.php");
    exit();
}

$conn = new mysqli('localhost', 'root', '', 'mercearia');
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

$action = isset($_GET['action']) ? $_GET['action'] : null;
$id = isset($_GET['id']) ? intval($_GET['id']) : null;

if ($action === 'delete' && $id) {
    $sql = "DELETE FROM produtos WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    if ($stmt->execute()) {
        echo "Produto excluído com sucesso!";
    } else {
        echo "Erro ao excluir produto.";
    }
    $stmt->close();
    header("Location: admin.php");
    exit();
}

if ($action === 'edit' && $id) {
    $result = $conn->query("SELECT * FROM produtos WHERE id = $id");
    if ($result->num_rows > 0) {
        $produto = $result->fetch_assoc();
    } else {
        echo "Produto não encontrado.";
        exit();
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_GET['action']) && $_GET['action'] === 'update') {
    $id = intval($_POST['id']);
    $nome = $_POST['nome'];
    $preco = floatval($_POST['preco']);
    $estoque = intval($_POST['estoque']);
    $categoria = $_POST['categoria'];

    $sql = "UPDATE produtos SET nome = ?, preco = ?, estoque = ?, categoria = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sdiss", $nome, $preco, $estoque, $categoria, $id);

    if ($stmt->execute()) {
        echo "Produto atualizado com sucesso!";
    } else {
        echo "Erro ao atualizar produto.";
    }

    $stmt->close();
    header("Location: admin.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_GET['action']) && $_GET['action'] === 'add') {
    $nome = $_POST['nome'];
    $preco = floatval($_POST['preco']);
    $estoque = intval($_POST['estoque']);
    $categoria = $_POST['categoria'];

    $sql = "INSERT INTO produtos (nome, preco, estoque, categoria) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sdis", $nome, $preco, $estoque, $categoria);

    if ($stmt->execute()) {
        echo "Produto adicionado com sucesso!";
    } else {
        echo "Erro ao adicionar produto.";
    }

    $stmt->close();
    header("Location: admin.php");
    exit();
}

$result_produtos = $conn->query("SELECT * FROM produtos");
$conn->close();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciar Produto</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
<div class="body-login">

<?php if ($action === 'edit' && isset($produto)) : ?>
    <form class="form-login" action="gerenciar_produto.php?action=update" method="post">
        <h2>Editar Produto</h2>
        <input class="input-login" type="hidden" name="id" value="<?php echo htmlspecialchars($produto['id']); ?>">
        <label class="label-login" for="nome">Nome:</label>
        <input class="input-login" type="text" name="nome" value="<?php echo htmlspecialchars($produto['nome']); ?>" required><br>
        <label class="label-login" for="preco">Preço:</label>
        <input class="input-login" type="text" name="preco" value="<?php echo htmlspecialchars($produto['preco']); ?>" required><br>
        <label class="label-login" for="estoque">Estoque:</label>
        <input class="input-login" type="number" name="estoque" value="<?php echo htmlspecialchars($produto['estoque']); ?>" required><br><br>
        <label class="label-login" for="categoria">Categoria:</label>
        <select class="input-login" name="categoria" required>
            <option value="Fruta" <?php if($produto['categoria'] == 'Fruta') echo 'selected'; ?>>Fruta</option>
            <option value="Legumes" <?php if($produto['categoria'] == 'Legumes') echo 'selected'; ?>>Legumes</option>
            <option value="Óleos e gorduras" <?php if($produto['categoria'] == 'Óleos e gorduras') echo 'selected'; ?>>Óleos e gorduras</option>
            <option value="Bebidas vegetais" <?php if($produto['categoria'] == 'Bebidas vegetais') echo 'selected'; ?>>Bebidas vegetais</option>
            <option value="Proteínas" <?php if($produto['categoria'] == 'Proteínas') echo 'selected'; ?>>Proteínas</option>
            <option value="Cereais" <?php if($produto['categoria'] == 'Cereais') echo 'selected'; ?>>Cereais</option>
            <option value="Oleaginosas" <?php if($produto['categoria'] == 'Oleaginosas') echo 'selected'; ?>>Oleaginosas</option>
            <option value="Chás e infusões" <?php if($produto['categoria'] == 'Chás e infusões') echo 'selected'; ?>>Chás e infusões</option>
            <option value="Farinhas e grãos" <?php if($produto['categoria'] == 'Farinhas e grãos') echo 'selected'; ?>>Farinhas e grãos</option>
            <option value="Sementes" <?php if($produto['categoria'] == 'Sementes') echo 'selected'; ?>>Sementes</option>
            <option value="Adoçantes naturais" <?php if($produto['categoria'] == 'Adoçantes naturais') echo 'selected'; ?>>Adoçantes naturais</option>
            <option value="Snacks saudáveis" <?php if($produto['categoria'] == 'Snacks saudáveis') echo 'selected'; ?>>Snacks saudáveis</option>
            <option value="Ingredientes para culinária" <?php if($produto['categoria'] == 'Ingredientes para culinária') echo 'selected'; ?>>Ingredientes para culinária</option>
        </select><br><br>
        <button class="button-login" type="submit">Salvar Alterações</button>
    </form>
<?php elseif ($action === 'add') : ?>
    <form class="form-login" action="gerenciar_produto.php?action=add" method="post">
        <h2>Adicionar Produto</h2>
        <label class="label-login" for="nome">Nome:</label>
        <input class="input-login" type="text" name="nome" required><br>
        <label class="label-login" for="preco">Preço:</label>
        <input class="input-login" type="text" name="preco" required><br>
        <label class="label-login" for="estoque">Estoque:</label>
        <input class="input-login" type="number" name="estoque" required><br><br>
        <label class="label-login" for="categoria">Categoria:</label>
        <select class="input-login" name="categoria" required>
            <option value="Fruta">Fruta</option>
            <option value="Legumes">Legumes</option>
            <option value="Óleos e gorduras">Óleos e gorduras</option>
            <option value="Bebidas vegetais">Bebidas vegetais</option>
            <option value="Proteínas">Proteínas</option>
            <option value="Cereais">Cereais</option>
            <option value="Oleaginosas">Oleaginosas</option>
            <option value="Chás e infusões">Chás e infusões</option>
            <option value="Farinhas e grãos">Farinhas e grãos</option>
            <option value="Sementes">Sementes</option>
            <option value="Adoçantes naturais">Adoçantes naturais</option>
            <option value="Snacks saudáveis">Snacks saudáveis</option>
            <option value="Ingredientes para culinária">Ingredientes para culinária</option>
        </select><br><br>
        <button class="button-login" type="submit">Adicionar Produto</button>
    </form>
<?php endif; ?>


</div>
</body>
</html>

