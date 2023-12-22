const imgUploadForm = document.getElementById('perfil-upload-form');
const logoUploadForm = document.getElementById('logo');
const faviconUploadForm = document.getElementById('favicon');
const loginUploadForm = document.getElementById('login-img-form');

const profileImgForm = document.getElementById('perfil-img-form');
const ImgLogo = document.getElementById('img-logo');
const ImgFavicon = document.getElementById('img-favicon');
const ImgLogin = document.getElementById('img-login');

function updateImages(file, img) {
    const reader = new FileReader();

    reader.onload = function(e) {
        img.setAttribute('src', e.target.result);
    }

    reader.readAsDataURL(file);
}

if (imgUploadForm) {
    imgUploadForm.addEventListener('change', function() {
        let file = this.files[0];
        updateImages(file, profileImgForm);
    });
}

if (logoUploadForm) {
    logoUploadForm.addEventListener('change', function() {
        let file = this.files[0];
        updateImages(file, ImgLogo);
    });
}

if (faviconUploadForm) {
    faviconUploadForm.addEventListener('change', function() {
        let file = this.files[0];
        updateImages(file, ImgFavicon);
    });
}

if (loginUploadForm) {
    loginUploadForm.addEventListener('change', function() {
        let file = this.files[0];
        updateImages(file, ImgLogin);
    });
}