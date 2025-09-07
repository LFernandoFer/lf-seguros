function obterSexoSelecionado() {
    const radios = document.getElementsByName('sexo');
    for (let radio of radios) {
        if (radio.checked) {
            return radio.value;
        }
    }
    return null;
}
function validarFormulario() {
    const nome = document.getElementById('nome').value.trim();
    const senha = document.getElementById('senha').value.trim();
    const termos = document.getElementById('termos');
    const errorMessage = document.getElementById('error-message');

    errorMessage.textContent = '';
    errorMessage.style.color = 'red';

    if (!nome) { errorMessage.textContent = "Preencha o nome!"; return false; }
    if (!senha) { errorMessage.textContent = "Preencha a senha!"; return false; }
    if (!obterSexoSelecionado()) { errorMessage.textContent = "Selecione o sexo!"; return false; }
    if (!termos.checked) { errorMessage.textContent = "Você deve aceitar os termos!"; return false; }

    return true;
}