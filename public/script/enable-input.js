// Obtenha uma referência aos elementos de botões de opção
const disponivelRadio = document.getElementById('disponivel');
const emBreveRadio = document.getElementById('em_breve');
const indisponivelRadio = document.getElementById('indisponivel');
const dataInput = document.getElementById('data');
const horaInput = document.getElementById('hora');

// Adicione ouvintes de eventos para os botões de opção
disponivelRadio.addEventListener('change', updateDataHoraInputs);
emBreveRadio.addEventListener('change', updateDataHoraInputs);
indisponivelRadio.addEventListener('change', updateDataHoraInputs);

function updateDataHoraInputs() {
    // Verifique qual botão de opção está selecionado
    if (emBreveRadio.checked) {
        // Se "Em Breve" estiver selecionado, habilite os campos de entrada de data e hora
        dataInput.disabled = false;
        horaInput.disabled = false;
    } else {
        // Caso contrário, desabilite os campos de entrada de data e hora
        dataInput.disabled = true;
        horaInput.disabled = true;
        // Limpe os valores dos campos de entrada de data e hora
        dataInput.value = '';
        horaInput.value = '';
    }
}