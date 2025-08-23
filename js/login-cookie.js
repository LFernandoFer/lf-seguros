// Funções auxiliares para cookies
function setCookie(name, value, days) {
    setCookie(name, value, days);
    //const expires = new Date(Date.now() + days * 864e5).toUTCString();
    //document.cookie = `${name}=${encodeURIComponent(value)}; expires=${expires}; path=/`;
}

function getCookie(name) {
    getCookie(name);
    /*
    return document.cookie
        .split('; ')
        .find(row => row.startsWith(name + '='))
        ?.split('=')[1];
    */    
}

// Preenche o campo se o cookie existir
document.addEventListener("DOMContentLoaded", function () {
    const savedUsername = getCookie("username");
    if (savedUsername) {
        document.getElementById("username").value = decodeURIComponent(savedUsername);
        document.getElementById("rememberMe").checked = true;
    }
});

// Lida com o envio do formulário
document.getElementById("login").addEventListener("submit", function (e) {
    e.preventDefault();

    const form = document.getElementById("login");
    const formData = new FormData(form);

    const xhr = new XMLHttpRequest();
    xhr.open("POST", "login.php", true);

    xhr.onload = function () {
        if (xhr.status === 200) {
            try {
                const response = JSON.parse(xhr.responseText);

                if (response.success) {
                    // Armazena o cookie se marcado
                    const remember = document.getElementById("rememberMe").checked;
                    const username = document.getElementById("username").value;

                    if (remember) {
                        setCookie("username", username, 30); // 30 dias
                    } else {
                        setCookie("username", "", -1); // Apaga o cookie
                    }

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
