let closeCircle = $('.close-ring__circle');

function startAnimation() {
    closeCircle.css('strokeDashoffset', 0);
}

function resetAnimation() {
    closeCircle.css('strokeDashoffset', '188.496');
}
