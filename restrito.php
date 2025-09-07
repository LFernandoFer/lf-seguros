<?php
session_start();

if (!isset($_SESSION['id'])) {
    header("Location: login.html");
    exit();
}

$erroPermissao = isset($_GET['erro']) && $_GET['erro'] === 'permissao';
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Área Restrita</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<header>
    <img src="lf seguros logo.webp" alt="LF seguros logo">   
</header>
<nav>
    <a href="index.html">Início</a>
    <a href="cadastro.html">Cadastrar</a>  
    <a href="login.html">Login</a>     
    <a href="logout.php">Sair</a>
</nav>
<section class="login" id="login">
    <h1 class="h1">Bem-Vindo, <?php echo htmlspecialchars($_SESSION['usuario']); ?></h1>

    <button class="btn" onclick="Usuarios()" role="button">Gerenciar Usuários</button>
    <button class="btn" onclick="Mensagens()" role="button">Gerenciar Orçamentos</button>

    <p id="error-message" style="color:red;">
        <?php 
        if ($erroPermissao) {
            echo "Você não possui a permissão necessária para acessar o Gerenciamento de Usuários.";
        }
        ?>
    </p>
</section>
</body>
<script>
function Usuarios() {
    document.location.href = "gerenUsuarios.php";
}
function Mensagens() {
    document.location.href = "orcamentos.php";
}
</script>
</html>