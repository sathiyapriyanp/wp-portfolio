

// Optional: AOS animation init
console.log("MAIN JS LOADED");
/* 
AOS?.init && AOS.init({ duration: 700 }); */

(() => {

  // ===== Filter popup open/close =====
  const openFilter = document.getElementById("openFilter");
  const closeFilter = document.getElementById("closeFilter");
  const filterPopup = document.getElementById("filterPopup");

  if (openFilter && filterPopup) {
    openFilter.addEventListener("click", () => filterPopup.classList.add("show"));
  }
  if (closeFilter && filterPopup) {
    closeFilter.addEventListener("click", () => filterPopup.classList.remove("show"));
  }

  // ===== Header scroll effect =====
  window.addEventListener("scroll", () => {
    const header = document.querySelector('.site-header');
    if (header) {
      if (window.scrollY > 100) header.classList.add("active");
      else header.classList.remove("active");
    }
  });

  // ===== jQuery ready =====
  jQuery(document).ready(function ($) {

    // ===== Mobile Menu Toggle =====
    $('.menu-toggle').on('click', () => $('.main-navigation').addClass('active'));
    $('.menu-close').on('click', () => $('.main-navigation').removeClass('active'));

    // ===== Hero Swiper Slider =====
    if (typeof Swiper !== "undefined" && document.querySelector(".mySwiper")) {
      new Swiper(".mySwiper", {
        loop: true,
        autoplay: { delay: 3000, disableOnInteraction: false },
        pagination: { el: ".swiper-pagination", clickable: true },
        navigation: { nextEl: ".swiper-button-next", prevEl: ".swiper-button-prev" },
      });
      console.log("✅ Hero Swiper initialized");
    }

    // ===== Contact form success modal =====
    const contactForm = $(".fcf-contact-us")[0];
    if (contactForm) {
      contactForm.addEventListener("form_success", function () {
        const modalEl = document.querySelector('#exampleModal');
        if (modalEl) new bootstrap.Modal(modalEl, { keyboard: false }).show();
      });
    }

    // ===== Popular Nurses Horizontal Scroll + Drag + Click + Auto-Scroll =====
    const track = $('.popular-nurses-track');

if(track.length){

    // Ensure track is scrollable (looping works only if wide)
    const trackEl = track[0];
    const wrapper = track.parent();

    // Duplicate items so scrollWidth becomes larger than container
    if(trackEl.scrollWidth <= wrapper.width()){
        let cloneCount = 0;
        while(trackEl.scrollWidth <= wrapper.width() * 1.5 && cloneCount < 5){
            track.append(track.children().clone(true));
            cloneCount++;
        }
    }

    let isDown = false,
        startX,
        scrollLeft,
        isDragging = false;

    // Mouse drag start
    track.on('mousedown', function(e){
        isDown = true;
        isDragging = false;
        $(this).addClass('active');
        startX = e.pageX - $(this).offset().left;
        scrollLeft = this.scrollLeft;
    });

    // Mouse drag move
    track.on('mousemove', function(e){
        if(!isDown) return;
        e.preventDefault();
        isDragging = true;
        const x = e.pageX - $(this).offset().left;
        const walk = (x - startX) * 1.6;
        this.scrollLeft = scrollLeft - walk;
    });

    // Mouse drag end
    track.on('mouseup mouseleave', function(){
        isDown = false;
        $(this).removeClass('active');
    });

    // Prevent click when dragging
    $('.popular-nurse-card a').on('click', function(e){
        if(isDragging) e.preventDefault();
    });

    // Auto-scroll
    let speed = 0.6;
    function autoScroll(){
        if(!isDown){
            track.scrollLeft(track.scrollLeft() + speed);

            if(track.scrollLeft() >= trackEl.scrollWidth / 2){
                track.scrollLeft(0);
            }
        }
        requestAnimationFrame(autoScroll);
    }
    autoScroll();
}

//3d slider start
// ===== 3D Slider Section =====
// ===== 3D Slider Mouse Effect =====
// ===== 3D Slider Mouse Effect =====
// ===== 3D Circular Slider =====
const $sliderTrack = $('#sliderTrack');
const $cards = $sliderTrack.find('.slider-card');
let current = 0;

function updateSlider() {
  const total = $cards.length;

  $cards.removeClass('active left right far-left far-right');

  $cards.each(function (i) {
    const position = (i - current + total) % total;

    if (position === 0) $(this).addClass('active');
    else if (position === 1) $(this).addClass('right');
    else if (position === 2) $(this).addClass('far-right');
    else if (position === total - 1) $(this).addClass('left');
    else if (position === total - 2) $(this).addClass('far-left');
  });
}
updateSlider();

// Click to center
$cards.on('click', function () {
  current = $cards.index(this);
  updateSlider();
});
$cards.on('click', function () {
  const clickedIndex = $cards.index(this);
  if (clickedIndex === current) return; // already center — ignore
  current = clickedIndex;
  updateSlider();
});
let clickCooldown = false;

$cards.on('click', function () {
  if (clickCooldown) return;
  const clickedIndex = $cards.index(this);
  if (clickedIndex === current) return;

  clickCooldown = true;
  setTimeout(() => clickCooldown = false, 400); // 400ms lock

  current = clickedIndex;
  updateSlider();
});


//3d slider end

//mobile slide section 2 daman

  });
  document.addEventListener("DOMContentLoaded", () => {
  let index = 0;
  const slider = document.getElementById("mobileSlider");
  if (!slider) return; // ✓ Prevent errors if slider not on page

  const slides = slider.children;
  const dots = document.querySelectorAll(".dot");

  function updateSlider() {
    slider.style.transform = `translateX(-${index * 100}%)`;

    dots.forEach(d => d.classList.remove("bg-gray-800"));
    dots[index].classList.add("bg-gray-800");
  }

  setInterval(() => {
    index = (index + 1) % slides.length;
    updateSlider();
  }, 3000);

  updateSlider();
});
 (function () {
      const inner = document.getElementById('trackInner');
      if (!inner) return;

      // Duplicate once to create continuous loop
      inner.innerHTML = inner.innerHTML + inner.innerHTML;

      // Compute duration so speed is consistent across screen sizes
      function setDuration() {
        const total = inner.scrollWidth / 2; // width of one set
        const speed = window.matchMedia('(max-width: 640px)').matches ? 60 : 45; // px per second
        const seconds = Math.max(8, Math.round(total / speed));
        inner.style.setProperty('--duration', seconds + 's');
      }

      setDuration();
      let resizeTimer;
      window.addEventListener('resize', () => {
        clearTimeout(resizeTimer);
        resizeTimer = setTimeout(setDuration, 120);
      });

      // Pause while interacting and resume on release (good for touch)
      let isTouching = false;
      inner.addEventListener('pointerdown', () => { inner.style.animationPlayState = 'paused'; isTouching = true; });
      window.addEventListener('pointerup', () => { if (isTouching) { inner.style.animationPlayState = ''; isTouching = false; } });
      inner.addEventListener('mouseenter', () => { inner.style.animationPlayState = 'paused'; });
      inner.addEventListener('mouseleave', () => { inner.style.animationPlayState = ''; });

      // Respect reduced motion
      if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
        inner.style.animation = 'none';
      }
    })();


    
  const dot = document.getElementById('cursor-dot');
  const outline = document.getElementById('cursor-outline');

  window.addEventListener('mousemove', (e) => {
    const posX = e.clientX;
    const posY = e.clientY;

    // Dot immediately follows mouse
    dot.style.left = posX + 'px';
    dot.style.top = posY + 'px';

    // Outline follows with smooth lag
    outline.animate({
      left: posX + 'px',
      top: posY + 'px'
    }, { duration: 400, fill: "forwards" });
  });

  // Buttons hover panna cursor perusaagum
  const links = document.querySelectorAll('a, button, .group');
  links.forEach(link => {
    link.addEventListener('mouseenter', () => {
      outline.classList.add('cursor-hover-active');
    });
    link.addEventListener('mouseleave', () => {
      outline.classList.remove('cursor-hover-active');
    });
  });

})();
