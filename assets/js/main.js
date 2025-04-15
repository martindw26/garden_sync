
document.addEventListener('DOMContentLoaded', function () {
  const slider = document.querySelector('.slider');
  const slides = document.querySelectorAll('.slide');
  let index = 0;
  let interval = setInterval(nextSlide, 4000);

  function nextSlide() {
    index = (index + 1) % slides.length;
    slider.scrollTo({
      left: slides[index].offsetLeft,
      behavior: 'smooth'
    });
  }

  // Manual control with swipe
  let startX = 0;
  slider.addEventListener('touchstart', e => {
    startX = e.touches[0].clientX;
    clearInterval(interval);
  });

  slider.addEventListener('touchend', e => {
    let endX = e.changedTouches[0].clientX;
    if (endX < startX - 30) index = (index + 1) % slides.length;
    if (endX > startX + 30) index = (index - 1 + slides.length) % slides.length;
    slider.scrollTo({ left: slides[index].offsetLeft, behavior: 'smooth' });
    interval = setInterval(nextSlide, 4000);
  });
});
