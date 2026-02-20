(() => {    
  const dot = document.getElementById('cursor-dot');
  const outline = document.getElementById('cursor-outline');

  // Only run on desktop
  if (window.matchMedia("(min-width: 768px)").matches) {

    let mouseX = 0, mouseY = 0;
    let outlineX = 0, outlineY = 0;
    const speed = 0.2; // lag speed

    // Track mouse movement
    window.addEventListener('mousemove', (e) => {
      mouseX = e.clientX;
      mouseY = e.clientY;

      dot.style.left = mouseX + 'px';
      dot.style.top = mouseY + 'px';
    });

    function animateOutline() {
      outlineX += (mouseX - outlineX) * speed;
      outlineY += (mouseY - outlineY) * speed;

      outline.style.left = outlineX + 'px';
      outline.style.top = outlineY + 'px';

      requestAnimationFrame(animateOutline);
    }
    animateOutline();

    // Hover effects
    const links = document.querySelectorAll('a, button, .group');
    links.forEach(link => {
      link.addEventListener('mouseenter', () => {
        outline.classList.add('cursor-hover-active');
      });
      link.addEventListener('mouseleave', () => {
        outline.classList.remove('cursor-hover-active');
      });
    });

  } else {
    // Mobile: remove all cursor elements
    if (dot) dot.remove();
    if (outline) outline.remove();
  }

})();

 const swiper = new Swiper(".projectSwiper", {
    slidesPerView: 1,
    spaceBetween: 30,
    loop: false, // Set to true if you want infinite loop
    navigation: {
      nextEl: ".project-next",
      prevEl: ".project-prev",
    },
    breakpoints: {
      768: { slidesPerView: 2 },
      1024: { slidesPerView: 2.3 } // Shows 2 full and a bit of the 3rd
    },
    on: {
      init: function () { updateProgressBar(this); },
      slideChange: function () { updateProgressBar(this); }
    }
  });

  function updateProgressBar(s) {
    const progress = ((s.activeIndex) / (s.slides.length - s.params.slidesPerView)) * 100;
    document.querySelector('.swiper-progress-bar').style.width = `${progress}%`;
  }

  // Video Play on Hover (Inside Swiper)
  document.querySelectorAll('.swiper-slide').forEach(slide => {
    const video = slide.querySelector('video');
    if(video) {
      slide.addEventListener('mouseenter', () => video.play());
      slide.addEventListener('mouseleave', () => {
        video.pause();
        video.currentTime = 0;
      });
    }
  });
  // js/main.js

// Page full-ah load aagura varaikkum wait pannum
window.addEventListener("load", function() {
    
    // Check if GSAP is available
    if (typeof gsap !== 'undefined') {
        gsap.registerPlugin(ScrollTrigger);

        // -------------------------------------------------------
        // 1. HERO SECTION - Cinematic Entrance
        // -------------------------------------------------------
        const heroTl = gsap.timeline();

        heroTl
            .from("#hero", { opacity: 0, duration: 1 })
            .from("#hero h1", { 
                y: 100, 
                opacity: 0, 
                skewY: 7, 
                duration: 1.2, 
                ease: "expo.out" 
            }, "-=0.5")
            .from("#hero p", { 
                y: 30, 
                opacity: 0, 
                duration: 0.8 
            }, "-=0.8")
            .from("#hero a", { 
                scale: 0.8, 
                opacity: 0, 
                stagger: 0.2, 
                ease: "back.out(1.7)" 
            }, "-=0.5")
            .from(".group\\/profile", { 
                scale: 0.9, 
                opacity: 0, 
                duration: 1.5, 
                ease: "elastic.out(1, 0.5)" 
            }, "-=1");


        // -------------------------------------------------------
        // 2. TECH STACK - Staggered Grid Reveal
        // -------------------------------------------------------
        // main.js kulla...

// 1. Selector-a correct-ah ".grid > div" nu mathunga
// Appo thaan cards ovvonna zoom aagum
gsap.from("#tech-stack .grid > div", {
    scrollTrigger: {
        trigger: "#tech-stack",
        start: "top 80%", // Konjam mela trigger aagura mari vachukalam
        markers: false,   // Check panna true nu mathi parunga (screen-la lines varum)
    },
    scale: 0.1,         // Romba chinnathula irunthu
    opacity: 0,
    duration: 0.8,
    stagger: 0.2,
    ease: "back.out(1.7)",
    clearProps: "all"   // Animation mudinjathuku apram hidden state-la irukatha thadukkum
});

// 2. Progress bar logic (Cards vanthutu apram start aaganum)
gsap.from("#tech-stack .h-full", {
    scrollTrigger: {
        trigger: "#tech-stack",
        start: "top 60%",
    },
    width: "0%",
    duration: 1.2,
    delay: 0.5,
    ease: "power2.out"
});


        // -------------------------------------------------------
        // 3. EDUCATION - Alternating Timeline Pop
        // -------------------------------------------------------
        const eduCards = gsap.utils.toArray("#education .group");
        
        eduCards.forEach((card, i) => {
            gsap.from(card, {
                scrollTrigger: {
                    trigger: card,
                    start: "top 85%",
                    toggleActions: "play none none reverse"
                },
                x: i % 2 === 0 ? -50 : 50, // Even cards left, odd cards right
                opacity: 0,
                duration: 1,
                ease: "power3.out"
            });
        });

        console.log("All Animations Initialized!");

    } else {
        console.error("GSAP not detected. Check functions.php enqueue order.");
    }
});

//==========
// mywork animation
//=========
// Works Section Entrance
// main.js file kulla...

window.addEventListener("load", function() {
    
    // 1. Swiper-a initialize pannuvom
    const swiper = new Swiper('.projectSwiper', {
        slidesPerView: 1,
        spaceBetween: 30,
        breakpoints: {
            640: { slidesPerView: 2 },
            1024: { slidesPerView: 2.5 }
        }
    });

    // 2. Swiper ready aanathuku apram GSAP-a trigger pannuvom
    if (typeof gsap !== 'undefined') {
        gsap.registerPlugin(ScrollTrigger);

        // Title Animation
        gsap.from("#projects h3", {
            scrollTrigger: {
                trigger: "#projects",
                start: "top 80%",
            },
            x: -100,
            opacity: 0,
            duration: 1.2,
            ease: "expo.out"
        });

        // Swiper Container Zoom-in
        gsap.from(".projectSwiper", {
            scrollTrigger: {
                trigger: "#projects",
                start: "top 70%",
            },
            scale: 0.8, // Scale konjam korachi kudupom zoom-in nalla theriyum
            opacity: 0,
            duration: 1.5,
            ease: "power4.out"
        });
    }
});
//==========
//============
//my exp animation
//===============
// js/main.js
window.addEventListener("load", function() {
    if (typeof gsap !== 'undefined') {
        gsap.registerPlugin(ScrollTrigger);

        // EXPERIENCE CARDS ANIMATION
        // Card-oda outer div-a target panrom
        gsap.from("#experience .group", {
            scrollTrigger: {
                trigger: "#experience",
                start: "top 75%",
                // markers: true, // Itha enable panna screen-la triggers theriyum, check panna easy-ah irukum
            },
            y: 80,              // Keela irunthu mela varum
            opacity: 0,
            scale: 0.9,         // Light-ah zoom-in aagum
            duration: 1,
            stagger: {
                amount: 0.4     // Ovvoru card-kum gap kudukum
            },
            ease: "power3.out",
            onComplete: function() {
                // Animation mudinjathuku apram CSS Hover work aaga properties-a clear pannum
                gsap.set("#experience .group", { clearProps: "transform,opacity" });
            }
        });

    }
});
//============
window.addEventListener("load", function() {
    if (typeof gsap !== 'undefined') {
        gsap.registerPlugin(ScrollTrigger);

        // Contact Section - Side Entrance
        gsap.from("#contact .max-w-4xl", {
            scrollTrigger: {
                trigger: "#contact",
                start: "top 90%", // Section 90% screen-ku vanthona start aagum
                toggleActions: "play none none reverse",
            },
            x: 200,            // Right side-la irunthu 200px thalli start aagum
            opacity: 0,
            duration: 1.2,
            ease: "power4.out",
        });

        // Contact Card - Pop up effect (Title vanthathuku apram)
        gsap.from("#contact .group", {
            scrollTrigger: {
                trigger: "#contact .group",
                start: "top 85%",
            },
            scale: 0.9,
            opacity: 0,
            duration: 1,
            delay: 0.3,
            ease: "back.out(1.7)"
        });
    }
});
// Magnetic Button Logic for Contact Email
const emailBtn = document.querySelector('a[href*="mail.google.com"]');

if(emailBtn) {
    emailBtn.addEventListener('mousemove', (e) => {
        const rect = emailBtn.getBoundingClientRect();
        const x = e.clientX - rect.left - rect.width / 2;
        const y = e.clientY - rect.top - rect.height / 2;

        gsap.to(emailBtn, {
            x: x * 0.5,
            y: y * 0.5,
            duration: 0.3,
            ease: "power2.out"
        });
    });

    emailBtn.addEventListener('mouseleave', () => {
        gsap.to(emailBtn, {
            x: 0,
            y: 0,
            duration: 0.8,
            ease: "elastic.out(1, 0.3)"
        });
    });
}


