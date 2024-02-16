// Função para atualizar os campos de data e hora
function updateDataHoraInputs(dataInput, horaInput, radio) {
    // Verifique qual botão de opção está selecionado
    if (radio.checked) {
        // Desabilite os campos de entrada de data e hora por padrão
        dataInput.disabled = true;
        horaInput.disabled = true;

        // Se "Em Breve" estiver selecionado, habilite os campos de entrada de data e hora
        if (radio.id === 'em_breve' || radio.id === 'em_breveEdit') {
            dataInput.disabled = false;
            horaInput.disabled = false;
        }
    }
}

// Obtenha referências aos elementos de botões de opção do primeiro conjunto
const disponivelRadio = document.getElementById('disponivel');
const emBreveRadio = document.getElementById('em_breve');
const indisponivelRadio = document.getElementById('indisponivel');
const dataInput = document.getElementById('data');
const horaInput = document.getElementById('hora');

// Obtenha referências aos elementos de botões de opção do segundo conjunto
const disponivelEditRadio = document.getElementById('disponivelEdit');
const emBreveEditRadio = document.getElementById('em_breveEdit');
const indisponivelEditRadio = document.getElementById('indisponivelEdit');
const dataEditInput = document.getElementById('dataEdit');
const horaEditInput = document.getElementById('horaEdit');

// Adicione ouvintes de eventos para os botões de opção do primeiro conjunto
disponivelRadio.addEventListener('change', () => updateDataHoraInputs(dataInput, horaInput, disponivelRadio));
emBreveRadio.addEventListener('change', () => updateDataHoraInputs(dataInput, horaInput, emBreveRadio));
indisponivelRadio.addEventListener('change', () => updateDataHoraInputs(dataInput, horaInput, indisponivelRadio));

// Adicione ouvintes de eventos para os botões de opção do segundo conjunto
disponivelEditRadio.addEventListener('change', () => updateDataHoraInputs(dataEditInput, horaEditInput, disponivelEditRadio));
emBreveEditRadio.addEventListener('change', () => updateDataHoraInputs(dataEditInput, horaEditInput, emBreveEditRadio));
indisponivelEditRadio.addEventListener('change', () => updateDataHoraInputs(dataEditInput, horaEditInput, indisponivelEditRadio));


// Função para atualizar os campos de botão de ação
function updateBotaoAcaoInputs(textoInput, linkInput, radio) {
    // Verifique qual botão de opção está selecionado
    if (radio.checked) {
        // Desabilite os campos de entrada de data e hora por padrão
        textoInput.disabled = false;
        linkInput.disabled = false;
        textoInput.required = true;
        linkInput.required = true;
    } else {
        textoInput.disabled = true;
        linkInput.disabled = true;
        textoInput.required = false;
        linkInput.required = false;
    }
}

// Obtenha referências aos elementos de botões de opção do primeiro conjunto
const botaoRadio = document.getElementById('acao-btn-checkbox');
const textoInput = document.getElementById('textoBotao');
const linkInput = document.getElementById('linkBotao');

// Adicione ouvintes de eventos para os botões de opção do primeiro conjunto
botaoRadio.addEventListener('change', () => updateBotaoAcaoInputs(textoInput, linkInput, botaoRadio));

