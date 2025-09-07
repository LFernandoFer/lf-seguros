document.addEventListener("DOMContentLoaded", function () {
    loadUsers();

    document.getElementById("userForm").addEventListener("submit", function (e) {
        e.preventDefault();
        const id = document.getElementById("userId").value;
        const name = document.getElementById("name").value;
        const telefone = document.getElementById("telefone").value;
        const permissao = document.getElementById("permissao").value;

        const formData = new FormData();
        formData.append("name", name);
        formData.append("telefone", telefone);
        formData.append("permissao", permissao);

        let url = "create.php";        
        if (id) {
            formData.append("id", id);
            url = "update.php";
        }

        const xhr = new XMLHttpRequest();
        xhr.open("POST", url, true);
        
        xhr.onload = function () {
            if (xhr.status === 200) {
                try {
                    const response = JSON.parse(xhr.responseText);

                    if (response.success) {
                        alert(response.message);
                        document.getElementById("userForm").reset();
                        loadUsers();
                    } else {
                        // Exibe mensagem de erro
                        document.getElementById("error-message").textContent = response.message;
                    }
                } catch (err) {
                    console.error("Erro ao processar a resposta JSON:", err);
                    document.getElementById("error-message").textContent = "Erro inesperado no cadastro.";
                }
            } else {
                console.error("Erro HTTP:", xhr.status);
                document.getElementById("error-message").textContent = "Erro na comunicação com o servidor.";
            }
        };

        xhr.onerror = function () {
            console.error("Erro de rede na requisição.");
            document.getElementById("error-message").textContent = "Erro de rede.";
        };
        xhr.send(formData);
    });
});

function loadUsers() {
    const xhr = new XMLHttpRequest();
    xhr.open("GET", "carregarUsuarios.php", true);
    xhr.onload = function () {
        const users = JSON.parse(this.responseText);
        const table = document.getElementById("userTable");
        table.innerHTML = "";

        users.forEach(user => {
            const row = `<tr>
                <td>${user.USUARIO}</td>
                <td>${user.TELEFONE}</td>
                <td>${user.PERMISSAO}</td>
                <td>
                    <button onclick="editUser(${user.ID}, '${user.USUARIO}', '${user.TELEFONE}', '${user.PERMISSAO}')">🖋️</button>
                    <button onclick="deleteUser(${user.ID})">🗑️</button>
                </td>
            </tr>`;
            table.innerHTML += row;
        });
    };
    xhr.send();
}

function editUser(id, name, telefone, permissao) {
    document.getElementById("userId").value = id;
    document.getElementById("name").value = name;
    document.getElementById("telefone").value = telefone;
    document.getElementById("permissao").value = permissao;
}

function deleteUser(id) {
    if (!confirm("Tem certeza que deseja excluir este usuário?")) return;

    const xhr = new XMLHttpRequest();
    xhr.open("DELETE", "delete.php?id="+id , true);
    xhr.onload = function () {
        if (xhr.status === 200) {
            try {
                const response = JSON.parse(xhr.responseText);

                if (response.success) {
                    alert(response.message);
                    loadUsers();
                    console.log(id);
                } else {
                    // Exibe mensagem de erro
                    document.getElementById("error-message").textContent = response.message;
                }
            } catch (err) {
                console.error("Erro ao processar a resposta JSON:", err);
                document.getElementById("error-message").textContent = "Erro inesperado no cadastro.";
            }
        } else {
            console.error("Erro HTTP:", xhr.status);
            document.getElementById("error-message").textContent = "Erro na comunicação com o servidor.";
        }
    };

    xhr.onerror = function () {
        console.error("Erro de rede na requisição.");
        document.getElementById("error-message").textContent = "Erro de rede.";
    };
    xhr.send();
}
