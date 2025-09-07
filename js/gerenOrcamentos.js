document.addEventListener("DOMContentLoaded", function () {
    loadOrcamento();

    document.getElementById("orcForm").addEventListener("submit", function (e) {
        e.preventDefault();
        const id = document.getElementById("userId").value;
        const name = document.getElementById("name").value;
        const telefone = document.getElementById("telefone").value;
        const idade = document.getElementById("idade").value;
        const sexo = document.getElementById("sexo").value;
        const veiculo = document.getElementById("veiculo").value;
        


        const formData = new FormData();
        formData.append("name", name);
        formData.append("telefone", telefone);
        formData.append("idade", idade);
        formData.append("sexo", sexo);
        formData.append("veiculo", veiculo);
        let url = "createOrcamento.php";        
        if (id) {
            formData.append("id", id);
            url = "updateOrcamento.php";
        }

        const xhr = new XMLHttpRequest();
        xhr.open("POST", url, true);
        
        xhr.onload = function () {
            if (xhr.status === 200) {
                try {
                    const response = JSON.parse(xhr.responseText);

                    if (response.success) {
                        alert(response.message);
                        document.getElementById("orcForm").reset();
                        loadOrcamento();
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

function loadOrcamento() {
    const xhr = new XMLHttpRequest();
    xhr.open("GET", "carregarOrcamentos.php", true);
    xhr.onload = function () {
        const users = JSON.parse(this.responseText);
        const table = document.getElementById("orcTable");
        table.innerHTML = "";

        users.forEach(user => {
            const row = `<tr>
                <td>${user.USUARIO}</td>
                <td>${user.TELEFONE}</td>
                <td>${user.IDADE}</td>
                <td>${user.SEXO}</td>
                <td>${user.VEICULO}</td>
                <td>
                    <button onclick="editOrcamento(
                        ${user.ID}, 
                        '${user.USUARIO}',
                        '${user.TELEFONE}', 
                        '${user.IDADE}',
                        '${user.SEXO}',
                        '${user.VEICULO}')
                        ">🖋️</button>
                    <button onclick="deleteOrcamento(${user.ID})">🗑️</button>
                </td>
            </tr>`;
            table.innerHTML += row;
        });
    };
    xhr.send();
}

function editOrcamento(
    id, name, telefone, idade,sexo,veiculo) {
    document.getElementById("userId").value = id;
    document.getElementById("name").value = name;
    document.getElementById("telefone").value = telefone;
    document.getElementById("idade").value = idade;
    document.getElementById("sexo").value = sexo;
    document.getElementById("veiculo").value = veiculo;
    
    const campoName = document.getElementById("name");
    campoName.setAttribute("readonly", true);
}

function deleteOrcamento(id) {
    if (!confirm("Tem certeza que deseja excluir este orçamento?")) return;

    const xhr = new XMLHttpRequest();
    xhr.open("DELETE", "deleteOrcamento.php?id="+id , true);
    xhr.onload = function () {
        if (xhr.status === 200) {
            try {
                const response = JSON.parse(xhr.responseText);

                if (response.success) {
                    alert(response.message);
                    loadOrcamento();
                    console.log(id);
                } else {
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
