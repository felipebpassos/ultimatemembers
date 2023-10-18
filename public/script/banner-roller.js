const bannerContainer = document.querySelector(".banner-container");
const leftArrow = document.querySelector(".left-arrow");
const rightArrow = document.querySelector(".right-arrow");
const fadeBefore = document.querySelector(".fade-before");
const fadeAfter = document.querySelector(".fade-after");

let scrollAmount = 0;
const scrollStep = 445;

updateArrowVisibility();

leftArrow.addEventListener("click", () => {
    scrollAmount -= scrollStep;
    if (scrollAmount < 0) scrollAmount = 0;
    bannerContainer.style.transform = `translateX(-${scrollAmount}px)`;
    updateArrowVisibility();
});

rightArrow.addEventListener("click", () => {
    const maxScroll = bannerContainer.scrollWidth - bannerContainer.clientWidth;
    scrollAmount += scrollStep;
    if (scrollAmount > maxScroll) scrollAmount = maxScroll;
    bannerContainer.style.transform = `translateX(-${scrollAmount}px)`;
    updateArrowVisibility();
});

function updateArrowVisibility() {
    const maxScroll = bannerContainer.scrollWidth - bannerContainer.clientWidth;
    leftArrow.style.display = scrollAmount > 0 ? "block" : "none";
    fadeBefore.style.display = scrollAmount > 0 ? "block" : "none";
    rightArrow.style.display = scrollAmount < maxScroll ? "block" : "none";
    fadeAfter.style.display = scrollAmount < maxScroll ? "block" : "none";
}