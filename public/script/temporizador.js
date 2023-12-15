// Função para o temporizador com horas e minutos informados
function startTimer(hours, minutes, display) {
    var totalSeconds = (hours * 3600) + (minutes * 60);
    var timer = totalSeconds,
        remainingHours, remainingMinutes, seconds;
    setInterval(function () {
        remainingHours = parseInt(timer / 3600, 10);
        remainingMinutes = parseInt((timer % 3600) / 60, 10);
        seconds = parseInt(timer % 60, 10);

        remainingHours = remainingHours < 10 ? "0" + remainingHours : remainingHours;
        remainingMinutes = remainingMinutes < 10 ? "0" + remainingMinutes : remainingMinutes;
        seconds = seconds < 10 ? "0" + seconds : seconds;

        display.textContent = remainingHours + ":" + remainingMinutes + ":" + seconds;

        if (--timer < 0) {
            // Aqui você pode adicionar a lógica quando o tempo acabar
            // Por exemplo, finalizar a prova automaticamente
        } else if (remainingHours == 0 && remainingMinutes <= 29) {
            display.style.color = "red"; // Altera a cor para vermelho
        }
    }, 1000);
}

// Quando a página carrega, inicia o temporizador com horas e minutos informados
window.onload = function () {
    var hours = 0; // Quantidade de horas
    var minutes = 31; // Quantidade de minutos
    var display = document.querySelector('.temporizador');
    startTimer(hours, minutes, display);
};