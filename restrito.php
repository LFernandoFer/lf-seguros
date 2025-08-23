<?php
session_start();

if (!isset($_SESSION['id'])) {
    header("Location: login.html");
    exit();
}
?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Area Restrita</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <img src="lf seguros logo.webp" alt="LF seguros logo">   
</header>
<nav>
    <a href="index.html" role="navigation">Início</a>
    <a href="cadastro.html" role="navigation">Cadastrar</a>  
    <a href="login.html" role="navigation">Login</a>     
</nav>
<section class="login" id="login">
    <h1 class="h1">Bem-Vindo,<?php echo htmlspecialchars($_SESSION['usuario']); ?></h1>

    <button class="btn" onclick="Usuarios()" role="button">Gerenciar Usuarios</button>
    <button class="btn" onclick="Mensagens()" role="button">Visualizar mensagens</button>
</section>
</body>
<script>
    function Usuarios()
    {
        //document.location.href = "/login.html"
    }
    function Mensagens()
    {
        //document.location.href = "/mensagens.html"
    }
</script>
</html>