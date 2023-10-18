document.addEventListener('DOMContentLoaded', function () {
    const aulasBtn = document.getElementById('aulas-btn');
    const video = document.getElementById("video-intro");
    const muteButton = document.getElementById("mute");
    const mainElement = document.querySelector('main');

    aulasBtn.addEventListener('click', function () {
        mainElement.scrollIntoView();
        video.muted = true;
        muteButton.classList.remove("mute");
        muteButton.classList.add("unmute");
        muteButton.querySelector("img").src = "http://localhost/ultimatemembers/public/img/mute.png";
    });
});
