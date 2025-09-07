document.addEventListener("DOMContentLoaded", () => {
    const form = document.getElementById("formCad");

    form.addEventListener("submit", function(e) {
        e.preventDefault();

        if (!validarFormulario()) return;

        const formData = new FormData(form);

        // Adiciona o sexo usando a função do validaForm.js
        const sexo = obterSexoSelecionado();
        formData.set("sexo", sexo);

        const xhr = new XMLHttpRequest();
        xhr.open("POST", "cadastro.php", true);

        xhr.onload = function() {
            const errorMessage = document.getElementById('error-message');
            if (xhr.status === 200) {
                try {
                    const response = JSON.parse(xhr.responseText);
                    if (response.success) {
                        errorMessage.style.color = "green";
                        errorMessage.textContent = response.message;
                        form.reset();
                    } else {
                        errorMessage.style.color = "red";
                        errorMessage.textContent = response.message;
                    }
                } catch (e) {
                    errorMessage.style.color = "red";
                    errorMessage.textContent = "Resposta inválida do servidor.";
                }
            } else {
                errorMessage.style.color = "red";
                errorMessage.textContent = "Erro ao enviar formulário. Código: " + xhr.status;
            }
        };

        xhr.onerror = function() {
            const errorMessage = document.getElementById('error-message');
            errorMessage.style.color = "red";
            errorMessage.textContent = "Erro de conexão ao enviar o formulário.";
        };

        xhr.send(formData);
    });
});