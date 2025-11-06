const swiper = new Swiper('.swiper', {
  // Optional parameters
  // direction: 'vertical',
  loop: true,
  slidesPerView: 1,
  spaceBetween: 16,

  // If we need pagination
  pagination: {
    el: '.swiper-pagination',
  },

  breakpoints: {
    640: {
      slidesPerView: 2,
      spaceBetween: 20,
    },
    768: {
      slidesPerView: 3,
      spaceBetween: 30,
    },
   
  },

  // Navigation arrows
  navigation: {
    nextEl: '.swiper-button-next',
    prevEl: '.swiper-button-prev',
  },

  // And if we need scrollbar
  scrollbar: {
    el: '.swiper-scrollbar',
  },
});

lucide.createIcons({
  attrs:{
    "stroke-width" : "1.5"
  }
});



AOS?.init && AOS.init({
  duration: 700
});


(()=>{

  window.addEventListener("scroll", function(){

    const header = document.querySelector('.site-header');
    if( window.scrollY > 100 ){
      header.classList.add("active")
    }else{
      header.classList.remove("active")
    }
    
  })

  document.querySelector(".fcf-contact-us").addEventListener("form_success",function(e){
    let modal = new bootstrap.Modal(document.querySelector('#exampleModal'), {
      keyboard: false
    })
    modal.show();
   
   
  })

})()