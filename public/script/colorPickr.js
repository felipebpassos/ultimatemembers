function criarPickr(el, corPadrao, inputId) {
    return Pickr.create({
        el: el,
        theme: 'nano', // ou 'monolith', ou 'nano'
        swatches: null,
        default: corPadrao,
        defaultRepresentation: 'HEX',
        components: {
            // Componentes principais
            preview: true,
            opacity: true,
            hue: true,
            // Opções de entrada / saída
            interaction: {
                hex: true,
                rgba: true,
                input: true,
                clear: true,
                save: true
            }
        }
    }).on('save', (color, instance) => {
        // Obtenha o valor no formato desejado
        var novaCor = color.toHEXA().toString('t');
        // Atualize o valor do input correspondente
        $(inputId).val(novaCor);
    });
}

// Criar instâncias Pickr
const pickrPrimario = criarPickr('.picker-primario', corPrimaria, '#cor_texto');
const pickrSecundario = criarPickr('.picker-secundario', corSecundaria, '#cor_fundo');