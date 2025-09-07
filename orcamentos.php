<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orçamentos</title>
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
    <h1 id="h1"></h1>
    
    <section>
<h2 id="h2">Usuários</h2>    
    <table border="1" bgcolor="#FFFFFF">
        <thead bgcolor="#49a67f">
            <tr>
                <th>Nome</th>
                <th>Telefone</th>
                <th>Idade</th>
                <th>Sexo</th>
                <th>Veículo</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody id="orcTable"></tbody>
    </table>
</section>
<hr>
<section class="login">
<h2 id="h2">Orçamento</h2>
<form id="orcForm">
    <input type="hidden" id="userId">
    <input type="text" id="name" placeholder="Nome" required>
    <input type="tel" id="telefone" placeholder="Telefone" required>
<p>
    <input type="number" id="idade" placehoolder = "00"> 
</p>
    <input type="text" id="sexo" placeholder="Sexo" required>
    <input type="text" id="veiculo" placeholder="Veículo" required>
    <button type="submit" class="btn">Salvar</button>
</form>
</section>
<p id="error-message"></p>
    
<script src="js/gerenOrcamentos.js"></script>
    </section>
</body>
</html>