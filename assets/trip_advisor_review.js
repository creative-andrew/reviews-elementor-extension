document.addEventListener("DOMContentLoaded", function() {
    let controlers = document.querySelectorAll('.ca-controlers span');
    let slides = document.querySelectorAll('.ca-reviews .slide-content');
    controlers.forEach(controler => {
         controler.addEventListener('click', e => {  
             slides.forEach(slide => {
                 slide.classList.remove('active');
             })
            let slideNumber = e.target.innerHTML;
            let slideToBeActivated = document.querySelector('.ca-reviews .slider-number'+slideNumber);
            slideToBeActivated.classList.add('active');
            let currentActiveControlNumber = document.querySelector('.ca-controlers .control-active');
            currentActiveControlNumber.classList.remove('control-active');
            e.target.classList.add('control-active')
         })
    })
   });