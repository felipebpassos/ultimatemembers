$(document).ready(function () {
    // Certifique-se de incluir este script após a inclusão da biblioteca Howler.js

    // Carregue o som
    const hoverQuiet = new Howl({
        src: ['http://localhost/ultimatemembers/public/sound/switch_click.mp3'], // Use o caminho absoluto para o arquivo de áudio
        volume: 0.02,
    });

    // Carregue o som
    const hoverStrong = new Howl({
        src: ['http://localhost/ultimatemembers/public/sound/switch_click.mp3'], // Use o caminho absoluto para o arquivo de áudio
        volume: 0.1,
    });

    // Carregue o som
    const click = new Howl({
        src: ['http://localhost/ultimatemembers/public/sound/switch_click.mp3'], // Use o caminho absoluto para o arquivo de áudio
        volume: 1,
    });

    // Use a delegação de eventos para lidar com o hover em elementos dinâmicos
    $(document).on({
        mouseenter: function () {
            // Executa quando o mouse entra na div (hover)
            hoverQuiet.play();
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
            hoverStrong.play();
        },
        mouseleave: function () {
            // Executa quando o mouse sai da div
            // Adicione lógica adicional se necessário
        }
    }, '.perfil-menu a');

    // Use a delegação de eventos para lidar com o hover em elementos dinâmicos
    $(document).on({
        mouseenter: function () {
            // Executa quando o mouse entra na div (hover)
            hoverStrong.play();
        },
        mouseleave: function () {
            // Executa quando o mouse sai da div
            // Adicione lógica adicional se necessário
        }
    }, '.relatorio');

    // Use a delegação de eventos para lidar com o hover em elementos dinâmicos
    $(document).on({
        mouseenter: function () {
            // Executa quando o mouse entra na div (hover)
            hoverStrong.play();
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
            click.play();
        },
    }, '.video');
});
