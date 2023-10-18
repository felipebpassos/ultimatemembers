const video = document.getElementById("video-intro");
const playPauseButton = document.getElementById("play-pause");
const muteButton = document.getElementById("mute");

playPauseButton.addEventListener("click", function () {
    if (video.paused) {
        video.play();
        playPauseButton.classList.remove("play");
        playPauseButton.classList.add("pause");
        playPauseButton.querySelector("img").src = "http://localhost/ultimatemembers/public/img/pause.png"; // Altera a imagem para pause.png
    } else {
        video.pause();
        playPauseButton.classList.remove("pause");
        playPauseButton.classList.add("play");
        playPauseButton.querySelector("img").src = "http://localhost/ultimatemembers/public/img/play.png"; // Altera a imagem para play.png
    }
});

muteButton.addEventListener("click", function () {
    if (video.muted) {
        video.muted = false;
        muteButton.classList.remove("unmute");
        muteButton.classList.add("mute");
        muteButton.querySelector("img").src = "http://localhost/ultimatemembers/public/img/sound.png"; // Altera a imagem para sound.png
    } else {
        video.muted = true;
        muteButton.classList.remove("mute");
        muteButton.classList.add("unmute");
        muteButton.querySelector("img").src = "http://localhost/ultimatemembers/public/img/mute.png"; // Altera a imagem para mute.png
    }
});