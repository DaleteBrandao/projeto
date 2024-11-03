<?php
session_start();

$conn = new mysqli ('localhost', 'root', '' , 'mercearia');
if ($conn->connect_error) {
    die("Conexão falhou! " . $conn->connect_error);
}

?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mercearia VEGAN</title>
    <link rel="stylesheet" href="estilos.css"> 
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/22359c54e0.js" crossorigin="anonymous"></script>
</head>
<body>
<div class="navbar">
  <a href="index.html" class="nav-logo">MVEGAN</a>
  <div class="nav-links">
    <a href="#sobre">Sobre</a>
    <a href="loja.php">Produtos</a>
    <a href="#rodape">Contato</a>
    <a href="registro.php"> <i class="fa-solid fa-user"></i> Registro</a>
    <a  href="login.php"><i class="fas fa-sign-out-alt"></i> Sair</a>
  </div>
</div>

    <div class="container" id="sobre"> 
     <h4 class="title1"> Quem Somos?</h4> 
     <h5 class="title2"> Bem-vindo à MVEGAN, a sua mercearia vegana de confiança! </h5> 
<p class="sobre-mais">  <i class="fa-solid fa-leaf" style= "margin-right: 10px;"></i> Na MVEGAN, acreditamos que uma alimentação saudável, sustentável e consciente é a 
chave para um futuro melhor. Por isso, estamos comprometidos em oferecer a você uma ampla
 variedade de produtos 100% veganos, frescos e de qualidade. 

 Nossa equipe está sempre pronta para ajudar, responder 
suas perguntas e garantir que você tenha a melhor experiência de compra.  <i class="fa-solid fa-leaf" style= "margin-right: 10px;"></i> </p> </div>

    <div class="footer" id="rodape">
        <p>&copy; 2024 Meu Site. Todos os direitos reservados.</p>
      <a href="https://x.com" target="_blank">  <i class="fa-brands fa-x-twitter fa-2x" ></i> </a>
      <a href="https://instagram.com" target="_blank">  <i class="fa-brands fa-square-instagram fa-2x" ></i> </a>    
      <a href="https://whatsapp.com" target="_blank"> <i class="fa-brands fa-square-whatsapp fa-2x"></i> </a>
      <a href="https://facebook.com" target="_blank"><i class="fa-brands fa-square-facebook fa-2x" ></i> </a>
      <a href="https://tiktok.com" target="_blank"><i class="fa-brands fa-tiktok fa-2x" ></i> </a>

    </div>
</body>
</html>
