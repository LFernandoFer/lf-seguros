function validarFormulario(){
    const nome = document.querySelector('#nome').value.trim(); 
    const senha = document.getElementById('senha').value.trim();
    const telefone = document.getElementById('telefone').value.trim();
    const idade = document.getElementById('idade').value.trim();
    const sexo = document.getElementByName('sexo').value;
    const veiculo = document.getElementById('veiculo').value;
    const termos = document.getElementById('termos').value;



    let sexoSelec = false;
    for(let radio of sexo)
    {
        if(radio.checked)
        {
            sexo = true;
            break;
        }
    }
}