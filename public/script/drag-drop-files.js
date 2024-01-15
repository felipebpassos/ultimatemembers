const dropImg = document.getElementById('dropImg');
const imgInfo = document.getElementById('imgInfo');
const capaAula = document.getElementById('capaAula');

const dropImgEdit = document.getElementById('dropImgEdit');
const imgInfoEdit = document.getElementById('imgInfoEdit');
const capaAulaEdit = document.getElementById('capaAulaEdit');

const dropApostila = document.getElementById('dropApostila');
const apostilaInfo = document.getElementById('apostilaInfo');
const apostila = document.getElementById('apostila');

const dropVideoModulo = document.getElementById('dropVideoModulo');
const videoInfoModulo = document.getElementById('videoInfoModulo');
const videoModulo = document.getElementById('videoModulo');

const dropImgModulo = document.getElementById('dropImgModulo');
const imgInfoModulo = document.getElementById('imgInfoModulo');
const capaModulo = document.getElementById('capaModulo');

const dropVideoModuloEdit = document.getElementById('dropVideoModuloEdit');
const videoInfoModuloEdit = document.getElementById('videoInfoModuloEdit');
const videoModuloEdit = document.getElementById('videoModuloEdit');

const dropImgModuloEdit = document.getElementById('dropImgModuloEdit');
const imgInfoModuloEdit = document.getElementById('imgInfoModuloEdit');
const capaModuloEdit = document.getElementById('capaModuloEdit');

// Impedir o comportamento padrão de arrastar e soltar para dropVideo
dropVideoModulo.addEventListener('dragover', (e) => {
    e.preventDefault();
    dropVideoModulo.classList.add('active');
});

dropVideoModulo.addEventListener('dragleave', () => {
    dropVideoModulo.classList.remove('active');
});

dropVideoModulo.addEventListener('drop', (e) => {
    e.preventDefault();
    dropVideoModulo.classList.remove('active');
    handleVideoFile(videoInfoModulo, e.dataTransfer.files[0]);
});

dropVideoModuloEdit.addEventListener('dragover', (e) => {
    e.preventDefault();
    dropVideoModuloEdit.classList.add('active');
});

dropVideoModuloEdit.addEventListener('dragleave', () => {
    dropVideoModuloEdit.classList.remove('active');
});

dropVideoModuloEdit.addEventListener('drop', (e) => {
    e.preventDefault();
    dropVideoModuloEdit.classList.remove('active');
    handleVideoFile(videoInfoModuloEdit, e.dataTransfer.files[0]);
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
    handleImageFile(imgInfo, e.dataTransfer.files[0]);
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
    handleImageFile(imgInfoEdit, e.dataTransfer.files[0]);
});

dropApostila.addEventListener('dragover', (e) => {
    e.preventDefault();
    dropApostila.classList.add('active');
});

dropApostila.addEventListener('dragleave', () => {
    dropApostila.classList.remove('active');
});

dropApostila.addEventListener('drop', (e) => {
    e.preventDefault();
    dropApostila.classList.remove('active');
    handleTextFile(apostilaInfo, e.dataTransfer.files[0]);
});

dropImgModulo.addEventListener('dragover', (e) => {
    e.preventDefault();
    dropImgModulo.classList.add('active');
});

dropImgModulo.addEventListener('dragleave', () => {
    dropImgModulo.classList.remove('active');
});

dropImgModulo.addEventListener('drop', (e) => {
    e.preventDefault();
    dropImgModulo.classList.remove('active');
    handleImageFile(imgInfoModulo, e.dataTransfer.files[0]);
});

dropImgModuloEdit.addEventListener('dragover', (e) => {
    e.preventDefault();
    dropImgModuloEdit.classList.add('active');
});

dropImgModuloEdit.addEventListener('dragleave', () => {
    dropImgModuloEdit.classList.remove('active');
});

dropImgModuloEdit.addEventListener('drop', (e) => {
    e.preventDefault();
    dropImgModuloEdit.classList.remove('active');
    handleImageFile(imgInfoModuloEdit, e.dataTransfer.files[0]);
});

// Lidar com o clique para selecionar um arquivo de vídeo
dropVideoModulo.addEventListener('click', () => {
    videoModulo.click();
});

videoModulo.addEventListener('change', () => {
    handleVideoFile(videoInfoModulo, videoModulo.files[0]);
});

dropVideoModuloEdit.addEventListener('click', () => {
    videoModuloEdit.click();
});

videoModuloEdit.addEventListener('change', () => {
    handleVideoFile(videoInfoModuloEdit, videoModuloEdit.files[0]);
});

// Lidar com o clique para selecionar um arquivo de imagem
dropImg.addEventListener('click', () => {
    capaAula.click();
});

capaAula.addEventListener('change', () => {
    handleImageFile(imgInfo, capaAula.files[0]);
});

dropImgEdit.addEventListener('click', () => {
    capaAulaEdit.click();
});

capaAulaEdit.addEventListener('change', () => {
    handleImageFile(imgInfoEdit, capaAulaEdit.files[0]);
});

dropApostila.addEventListener('click', () => {
    apostila.click();
});

dropApostila.addEventListener('change', () => {
    handleTextFile(apostilaInfo, apostila.files[0]);
});

dropImgModulo.addEventListener('click', () => {
    capaModulo.click();
});

capaModulo.addEventListener('change', () => {
    handleImageFile(imgInfoModulo, capaModulo.files[0]);
});

dropImgModuloEdit.addEventListener('click', () => {
    capaModuloEdit.click();
});

capaModuloEdit.addEventListener('change', () => {
    handleImageFile(imgInfoModuloEdit, capaModuloEdit.files[0]);
});

// Função para lidar com o arquivo de vídeo selecionado ou arrastado
function handleVideoFile(elemento, file) {
    elemento.textContent = '';

    if (file) {
        elemento.textContent = `Arquivo de vídeo selecionado: ${file.name}`;
    }
}

// Função para lidar com o arquivo de imagem selecionado ou arrastado
function handleImageFile(elemento, file) {
    elemento.textContent = '';

    if (file) {
        elemento.textContent = `Arquivo de imagem selecionado: ${file.name}`;
    }
}

// Função para lidar com o arquivo de apostila selecionado ou arrastado
function handleTextFile(elemento, file) {
    elemento.textContent = '';

    if (file) {
        elemento.textContent = `Arquivo selecionado: ${file.name}`;
    }
}