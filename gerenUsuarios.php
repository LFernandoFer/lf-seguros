<?php
session_start();

// precisa estar logado
if (!isset($_SESSION['id'])) {
    header("Location: login.html");
    exit();
}

// precisa ter permissao SIM ou ADM
if ($_SESSION['permissao'] !== 'SIM' && $_SESSION['permissao'] !== 'ADM') {
    header("Location: restrito.php?erro=permissao");
    exit();
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciar Usuários</title>
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
    <h1 id="h1">Painel de Gerenciamento</h1>
    <section>
    <form id="userForm">
        <input type="hidden" id="userId">
        <input type="text" id="name" placeholder="Nome" required>
        <input type="tel" id="telefone" placeholder="Telefone" required>
        <input type="text" id="permissao" placeholder="Permissão" required>
        <button type="submit" class="btn">Salvar</button>
    </form>
    </section>
    <p id="error-message"></p>

    <hr>
<section>
<h2 id="h2">Usuários</h2>    
    <table border="1" bgcolor="#FFFFFF">
        <thead bgcolor="#49a67f">
            <tr>
                <th>Nome</th><th>Telefone</th><th>Permissões</th><th>Ações</th>
            </tr>
        </thead>
        <tbody id="userTable"></tbody>
    </table>
</section>
    <script src="js/gerenUsuarios.js"></script>
</body>
</html>