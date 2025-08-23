// Ao carregar a página, verifica se há um usuário salvo no localStorage
document.addEventListener("DOMContentLoaded", function () {
    const savedUsername = localStorage.getItem("rememberedUsername");

    if (savedUsername) {
        document.getElementById("username").value = savedUsername;
        document.getElementById("rememberMe").checked = true;
    }
});

// Evento de envio do formulário
document.getElementById("loginForm").addEventListener("submit", function (e) {
    e.preventDefault();

    const form = document.getElementById("loginForm");
    const formData = new FormData(form);
    const rememberMe = document.getElementById("rememberMe").checked;
    const username = document.getElementById("username").value;

    const xhr = new XMLHttpRequest();
    xhr.open("POST", "login.php", true);

    xhr.onload = function () {
        if (xhr.status === 200) {
            try {
                const response = JSON.parse(xhr.responseText);

                if (response.success) {
                    // Salva ou remove o nome de usuário no localStorage
                    if (rememberMe) {
                        localStorage.setItem("rememberedUsername", username);
                    } else {
                        localStorage.removeItem("rememberedUsername");
                    }

                    // Redireciona para o dashboard
                    window.location.href = "dashboard.php";
                } else {
                    document.getElementById("error-message").textContent = response.message;
                }
            } catch (err) {
                document.getElementById("error-message").textContent = "Erro inesperado.";
            }
        } else {
            document.getElementById("error-message").textContent = "Erro na requisição.";
        }
    };

    xhr.onerror = function () {
        document.getElementById("error-message").textContent = "Erro de rede.";
    };

    xhr.send(formData);
});
