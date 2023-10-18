const video = document.getElementById('video');
const button = document.getElementById('img-aula-2');

button.addEventListener('click', function () {
    if (video.classList.contains('hidden')) {
        video.classList.remove('hidden');
        button.classList.add('hidden');
    }
});