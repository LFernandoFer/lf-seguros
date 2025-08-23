document.getElementById("login").addEventListener("submit", function (e) {
    e.preventDefault(); // Impede o envio padrão do formulário

    const form = document.getElementById("login");
    const formData = new FormData(form);

    const xhr = new XMLHttpRequest();
    xhr.open("POST", "login.php", true);

    xhr.onload = function () {
        if (xhr.status === 200) {
            try {
                console.log("Resposta do servidor:", xhr.responseText);
                const response = JSON.parse(xhr.responseText);

                if (response.success) {
                    // Redireciona para o dashboard
                    window.location.href = "/lf%20seguros/restrito.php";
                } else {
                    // Exibe mensagem de erro
                    document.getElementById("error-message").textContent = response.message;
                }
            } catch (err) {
                console.error("Erro ao processar a resposta JSON:", err);
                document.getElementById("error-message").textContent = "Erro inesperado no login.";
            }
        } else {
            //console.error("Erro HTTP:", xhr.status);
            document.getElementById("error-message").textContent = "Erro na comunicação com o servidor.";
        }
    };

    xhr.onerror = function () {
        console.error("Erro de rede na requisição.");
        document.getElementById("error-message").textContent = "Erro de rede.";
    };

    xhr.send(formData);
});