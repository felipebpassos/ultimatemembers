const imgUploadForm = document.getElementById('img-upload-form');
const profileImgForm = document.getElementById('perfil-img-form');

function updateImages(file) {
    const reader = new FileReader();

    reader.onload = function(e) {
        profileImgForm.setAttribute('src', e.target.result);
    }

    reader.readAsDataURL(file);
}

imgUploadForm.addEventListener('change', function() {
    const file = this.files[0];
    updateImages(file);
});