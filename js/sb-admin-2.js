$body = $("body");

$(document).on({
    ajaxStart: function() { $body.addClass("loading");    },
     ajaxStop: function() { $body.removeClass("loading"); }    
});


(function($) {
  "use strict"; // Start of use strict

  // Toggle the side navigation
  $("#sidebarToggle, #sidebarToggleTop").on('click', function(e) {
    $("body").toggleClass("sidebar-toggled");
    $(".sidebar").toggleClass("toggled");
    if ($(".sidebar").hasClass("toggled")) {
      $('.sidebar .collapse').collapse('hide');
    };
  });

  // Close any open menu accordions when window is resized below 768px
  $(window).resize(function() {
    if ($(window).width() < 768) {
      $('.sidebar .collapse').collapse('hide');
    };
  });

  // Prevent the content wrapper from scrolling when the fixed side navigation hovered over
  $('body.fixed-nav .sidebar').on('mousewheel DOMMouseScroll wheel', function(e) {
    if ($(window).width() > 768) {
      var e0 = e.originalEvent,
        delta = e0.wheelDelta || -e0.detail;
      this.scrollTop += (delta < 0 ? 1 : -1) * 30;
      e.preventDefault();
    }
  });

  // Scroll to top button appear
  $(document).on('scroll', function() {
    var scrollDistance = $(this).scrollTop();
    if (scrollDistance > 100) {
      $('.scroll-to-top').fadeIn();
    } else {
      $('.scroll-to-top').fadeOut();
    }
  });

  // Smooth scrolling using jQuery easing
  $(document).on('click', 'a.scroll-to-top', function(e) {
    var $anchor = $(this);
    $('html, body').stop().animate({
      scrollTop: ($($anchor.attr('href')).offset().top)
    }, 1000, 'easeInOutExpo');
    e.preventDefault();
  });

})(jQuery); // End of use strict


var tour = new Tour({
    steps: [
    {
      element: "#inputEmail",
      title: "CAMPO DE E-MAIL",
      content: "Neste campo você deve informar o seu e-mail de login que foi registrado na plataforma."
    },
    {
      element: "#inputSenha",
      title: "CAMPO DE SENHA",
      content: "Informa a senha que você cadastrou no momento do seu registro no sistema."
    },
    {
      element: "#labelConectado",
      title: "SE MANTER CONECTADO",
      content: "Marque esta caixa se você deseja se manter conectado no sistema."
    }
    ,
    {
      element: "#btnEntrar",
      title: "BOTÃO ENTRAR",
      content: "Utilize este botão para entrar no sistema."
    }
  ],
  template: "<div class='popover tour'> <div class='arrow'></div> <h3 class='popover-title'></h3> <div class='popover-content'></div> <div class='popover-navigation'> <button class='btn btn-default' data-role='prev'>« Anterior</button> <span data-role='separator'>|</span> <button class='btn btn-default' data-role='next'>Próximo »</button> </div> <button class='btn btn-default' data-role='end'>Finalizar</button> </div>"
});
  
//-> Prepara para iniciar o tour.
tour.init();
  
//-> Inicia o tour.
tour.start();