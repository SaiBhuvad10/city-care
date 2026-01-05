let slides = document.querySelectorAll('.slide');
let currentIndex = 0;

function showSlide(index) {
    const slidesWrapper = document.querySelector('.slides');
    slidesWrapper.style.transform = `translateX(-${index * 100}%)`;
}

function nextSlide() {
    currentIndex++;
    if(currentIndex >= slides.length) currentIndex = 0;
    showSlide(currentIndex);
}

// Auto slide every 3 seconds
setInterval(nextSlide, 3000);
