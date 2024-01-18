$(document).ready(function () {
    // Certifique-se de incluir este script após a inclusão da biblioteca Howler.js

    // Carregue o som
    const hoverLineSound = new Howl({
        src: ['http://localhost/ultimatemembers/public/sound/switch_click.mp3'], // Use o caminho absoluto para o arquivo de áudio
        volume: 0.02,
    });

    // Carregue o som
    const hoverVideoSound = new Howl({
        src: ['http://localhost/ultimatemembers/public/sound/switch_click.mp3'], // Use o caminho absoluto para o arquivo de áudio
        volume: 0.1,
    });

    // Carregue o som
    const selectVideoSound = new Howl({
        src: ['http://localhost/ultimatemembers/public/sound/switch_click.mp3'], // Use o caminho absoluto para o arquivo de áudio
        volume: 1,
    });

    // Use a delegação de eventos para lidar com o hover em elementos dinâmicos
    $(document).on({
        mouseenter: function () {
            // Executa quando o mouse entra na div (hover)
            hoverLineSound.play();
        },
        mouseleave: function () {
            // Executa quando o mouse sai da div
            // Adicione lógica adicional se necessário
        }
    }, '.linha');

    // Use a delegação de eventos para lidar com o hover em elementos dinâmicos
    $(document).on({
        mouseenter: function () {
            // Executa quando o mouse entra na div (hover)
            hoverVideoSound.play();
        },
        mouseleave: function () {
            // Executa quando o mouse sai da div
            // Adicione lógica adicional se necessário
        }
    }, '.video');

    // Use a delegação de eventos para lidar com o hover em elementos dinâmicos
    $(document).on({
        click: function () {
            // Executa quando o mouse entra na div (hover)
            selectVideoSound.play();
        },
    }, '.video');
});
