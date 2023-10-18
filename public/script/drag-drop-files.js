const dropVideo = document.getElementById('dropVideo');
const videoInfo = document.getElementById('videoInfo');
const videoAula = document.getElementById('videoAula');

const dropImg = document.getElementById('dropImg');
const imgInfo = document.getElementById('imgInfo');
const capaAula = document.getElementById('capaAula');

const dropVideoEdit = document.getElementById('dropVideoEdit');
const videoInfoEdit = document.getElementById('videoInfoEdit');
const videoAulaEdit = document.getElementById('videoAulaEdit');

const dropImgEdit = document.getElementById('dropImgEdit');
const imgInfoEdit = document.getElementById('imgInfoEdit');
const capaAulaEdit = document.getElementById('capaAulaEdit');

// Impedir o comportamento padrão de arrastar e soltar para dropVideo
dropVideo.addEventListener('dragover', (e) => {
    e.preventDefault();
    dropVideo.classList.add('active');
});

dropVideo.addEventListener('dragleave', () => {
    dropVideo.classList.remove('active');
});

dropVideo.addEventListener('drop', (e) => {
    e.preventDefault();
    dropVideo.classList.remove('active');
    handleVideoFile(e.dataTransfer.files[0]);
});

dropVideoEdit.addEventListener('dragover', (e) => {
    e.preventDefault();
    dropVideoEdit.classList.add('active');
});

dropVideoEdit.addEventListener('dragleave', () => {
    dropVideoEdit.classList.remove('active');
});

dropVideoEdit.addEventListener('drop', (e) => {
    e.preventDefault();
    dropVideoEdit.classList.remove('active');
    handleVideoFile(e.dataTransfer.files[0]);
});

// Impedir o comportamento padrão de arrastar e soltar para dropImg
dropImg.addEventListener('dragover', (e) => {
    e.preventDefault();
    dropImg.classList.add('active');
});

dropImg.addEventListener('dragleave', () => {
    dropImg.classList.remove('active');
});

dropImg.addEventListener('drop', (e) => {
    e.preventDefault();
    dropImg.classList.remove('active');
    handleImageFile(e.dataTransfer.files[0]);
});

dropImgEdit.addEventListener('dragover', (e) => {
    e.preventDefault();
    dropImgEdit.classList.add('active');
});

dropImgEdit.addEventListener('dragleave', () => {
    dropImgEdit.classList.remove('active');
});

dropImgEdit.addEventListener('drop', (e) => {
    e.preventDefault();
    dropImgEdit.classList.remove('active');
    handleImageFile(e.dataTransfer.files[0]);
});

// Lidar com o clique para selecionar um arquivo de vídeo
dropVideo.addEventListener('click', () => {
    videoAula.click();
});

videoAula.addEventListener('change', () => {
    handleVideoFile(videoAula.files[0]);
});

dropVideoEdit.addEventListener('click', () => {
    videoAulaEdit.click();
});

videoAulaEdit.addEventListener('change', () => {
    handleVideoFile(videoAulaEdit.files[0]);
});

// Lidar com o clique para selecionar um arquivo de imagem
dropImg.addEventListener('click', () => {
    capaAula.click();
});

capaAula.addEventListener('change', () => {
    handleImageFile(capaAula.files[0]);
});

dropImgEdit.addEventListener('click', () => {
    capaAulaEdit.click();
});

capaAulaEdit.addEventListener('change', () => {
    handleImageFile(capaAulaEdit.files[0]);
});

// Função para lidar com o arquivo de vídeo selecionado ou arrastado
function handleVideoFile(file) {
    videoInfo.textContent = '';

    if (file) {
        videoInfo.textContent = `Arquivo de vídeo selecionado: ${file.name}`;
    }
}

// Função para lidar com o arquivo de imagem selecionado ou arrastado
function handleImageFile(file) {
    imgInfo.textContent = '';

    if (file) {
        imgInfo.textContent = `Arquivo de imagem selecionado: ${file.name}`;
    }
}