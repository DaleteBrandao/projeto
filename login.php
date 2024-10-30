<?php
session_start();
$conn = new mysqli('localhost', 'root', '', 'mercearia');
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

$mensagem_erro = '';  

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome_utilizador = $_POST['nome_utilizador'];  
    $senha = $_POST['senha'];

    $stmt = $conn->prepare("SELECT id, senha, tipo_utilizador FROM utilizadores WHERE nome_utilizador = ?");
    $stmt->bind_param("s", $nome_utilizador);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($id, $senha_hashed, $tipo_utilizador);
    
    if ($stmt->num_rows > 0) {
        $stmt->fetch();
        
        if (password_verify($senha, $senha_hashed)) {
            $_SESSION['id_utilizador'] = $id;
            $_SESSION['tipo_utilizador'] = $tipo_utilizador;

            if ($tipo_utilizador === 'admin') {
                header('Location: admin.php');  
            } else {
                header('Location: loja.php'); 
            }
            exit();
        } else {
            $mensagem_erro = "Senha incorreta!";  
        }
    } else {
        $mensagem_erro = "Utilizador não encontrado!";  
    }
    $stmt->close();
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="estilos.css"> 
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/22359c54e0.js" crossorigin="anonymous"></script>
</head>
  <body>
    <div class="navbar">
        <a href="loja.php" class="logo">  <img src="img/logo1.png" alt="Logo"></a>
        <a href="registro.php" class="registerUser"> <i class="fa-solid fa-user"></i> Registro</a>
        <a href="" class="cart"> <i class="fa-solid fa-cart-shopping"></i> Carrinho</a>
    </div>

    <div class="body-login">
       
        <?php if (!empty($mensagem_erro)) : ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $mensagem_erro; ?>
            </div>
        <?php endif; ?>
        
        <form class="form-login" action="login.php" method="POST">

            <h2 class="title1"> <i class="fa-brands fa-pagelines"></i> Login <i class="fa-brands fa-pagelines"></i></h2>
            <label for="nome_utilizador" class="label-login">Nome:</label>
            <input type="text" id="nome_utilizador" name="nome_utilizador" class="input-login" required> <br>

            <label for="senha" class="label-login">Senha:</label>
            <input type="password" id="senha" name="senha" class="input-login" required> <br>
            
            <button type="submit" class="button-login">Enviar</button>
        </form>
    </div>
    <div class="container"> 
        
     <h4 class="title1"> Quem Somos?</h4> 
     <h5 class="title2"> Bem-vindo à MVEGAN, a sua mercearia vegana de confiança! </h5> 
<p class="sobre-mais">  <i class="fa-solid fa-leaf" style= "margin-right: 10px;"></i> Na MVEGAN, acreditamos que uma alimentação saudável, sustentável e consciente é a 
chave para um futuro melhor. Por isso, estamos comprometidos em oferecer a você uma ampla
 variedade de produtos 100% veganos, frescos e de qualidade. 

 Nossa equipe está sempre pronta para ajudar, responder 
suas perguntas e garantir que você tenha a melhor experiência de compra.  <i class="fa-solid fa-leaf" style= "margin-right: 10px;"></i> </p> </div>

    <div class="footer">
        <p>&copy; 2024 Meu Site. Todos os direitos reservados.</p>
      <a href="https://x.com" target="_blank">  <i class="fa-brands fa-x-twitter fa-2x" ></i> </a>
      <a href="https://instagram.com" target="_blank">  <i class="fa-brands fa-square-instagram fa-2x" ></i> </a>    
      <a href="https://whatsapp.com" target="_blank"> <i class="fa-brands fa-square-whatsapp fa-2x"></i> </a>
      <a href="https://facebook.com" target="_blank"><i class="fa-brands fa-square-facebook fa-2x" ></i> </a>
      <a href="https://tiktok.com" target="_blank"><i class="fa-brands fa-tiktok fa-2x" ></i> </a>

    </div>
</body>
</html>
