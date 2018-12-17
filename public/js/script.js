$(function(){

    
    
/*------------------- card ----------------------- */
  // Auto-scroll
  $('.carousel').carousel({
    interval: 1000
  });

  // Control buttons
  $('.next').click(function () {
    $('.carousel').carousel('next');
    return false;
  });

  $('.prev').click(function () {
    $('.carousel').carousel('prev');
    return false;
  });

  // On carousel scroll
  $(".carousel").on("slide.bs.carousel", function (e) {
    var $e = $(e.relatedTarget);
    var idx = $e.index();
    var itemsPerSlide = 3;
    var totalItems = $(".carousel-item").length;
    if (idx >= totalItems - (itemsPerSlide - 1)) {
      var it = itemsPerSlide -
          (totalItems - idx);
      for (var i = 0; i < it; i++) {
        // append slides to end 
        if (e.direction == "left") {
          $(
            ".carousel-item").eq(i).appendTo(".carousel-inner");
        } else {
          $(".carousel-item").eq(0).appendTo(".carousel-inner");
        }
      }
    }
});


    ////////////// profile //////////////////////
    
    $('#edit_name').click(function(){
        $('#form-name').show();
        $('#info-name').hide();
    });
    
    $('#edit_account').click(function(){
        $('#form-account').show();
        $('#edit_account').hide();
        $('#info-account').hide();
    });
    
    $('#close-name').click(function(){
        $('#form-name').hide();
        $('#info-name').show();
    });
    
    $('#close-account').click(function(){
        $('#form-account').hide();
        $('#edit_account').show();
        $('#info-account').show();
    });

    $('.notif-blok').click(function(){
        $('.notif-blok').hide();
    });




    /////////////////////////////////////////////



    $("#wizard").steps({
        headerTag: "h4",
        bodyTag: "section",
        transitionEffect: "fade",
        enableAllSteps: true,
        transitionEffectSpeed: 500,
        labels: {
            next: "Next",
            previous: "Back"
        },
        onStepChanging: function (event, currentIndex, newIndex) { 
            console.log(newIndex, currentIndex);           

             

            if ( newIndex === 1 ) {

                $('.steps ul').addClass('step-2');
                $('.actions ul li:nth-child(2) a').html('Next').show();
                $('.actions ul li:nth-child(2)').addClass('step-2');
                $('.actions ul li:nth-child(2) a').html('Next');
            } else {
                $('.steps ul').removeClass('step-2');
                $('.actions ul li:nth-child(2)').removeClass('step-2');
                //$('.actions ul li:nth-child(2) a').html('Next').hide();
                $('.actions ul li:nth-child(2) a').html('Next');
                
                //$('.actions ul li').hide();
            }
            
            if ( newIndex === 2 ) {
                
               $('.steps ul').addClass('step-3');
               $('.actions ul li:nth-child(3)').addClass('step-3');
              // $('.actions ul li:nth-child(3) a').html('Back');
               //$('.actions ul li:nth-child(3) a').html('Next').hide();

            } else {
                $('.steps ul').removeClass('step-3');
                $('.actions ul li:nth-child(3)').removeClass('step-3');
                //$('.actions ul li:nth-child(3) a').html('Next');
            }

            // if ( newIndex === 3 ) {
            //     $('.steps ul').addClass('step-4');
            //     $('.actions ul').addClass('step-last');
            //     //$('.actions ul li').hide();
            // } else {
            //     $('.steps ul').removeClass('step-4');
            //     //$('.actions ul li').hide();

            // }

            return true; 
        }

    });

    // Custome Jquery Step Button
    $('.forward').click(function(){
    	$("#wizard").steps('next');
    });

    $('.backward').click(function(){
        $("#wizard").steps('previous');
    });

    var flag=0,flag1=0;
    
    $('.awal').click(function(){
        $('.ex1, .ex2, .on,.off').toggle();
        $('.ex1').css('height', '300');
        $('.ex1').css('overflowY', 'scroll');
        $('.ex2').hide();
        if(flag) {
            $('.ex1, .ex2,.on,.off').hide();
            flag=0;
        }
     });
     
    $('.awal1').click(function(){
        $('.ex3, .ex4, .on1,.off1').toggle();
        $('.ex3').css('height', '300');
        $('.ex3').css('overflowY', 'scroll');
        $('.ex4').hide();
        if(flag1) {
            $('.ex3, .ex4,.on1,.off1').hide();
            flag1=0;
        }
     });

    $('.on').click(function(){
        $('.ex1, .ex2').show();
        $('.ex1').css('height', '300');
        $('.ex1').css('overflowY', 'scroll');
        $('.ex2').hide();
     });

    $('.on1').click(function(){
        $('.ex3, .ex4').show();
        $('.ex3').css('height', '300');
        $('.ex3').css('overflowY', 'scroll');
        $('.ex4').hide();
     });

    $('.off').click(function(){
        $('.ex1, .ex2').show();
        $('.ex2').css('height', '300');
        $('.ex2').css('overflowY', 'scroll');
        $('.ex1').hide();
        flag=1;
    });

    $('.off1').click(function(){
        $('.ex3, .ex4').show();
        $('.ex4').css('height', '300');
        $('.ex4').css('overflowY', 'scroll');
        $('.ex3').hide();
        flag1=1;
    });

    //////////// ADOPT CAT //////////

    $('.ad-btn').click(function(){
        $('#id_cat').attr('value', $(this).val());
        console.log("val: " + $(this).val());
    });

    $('.ad-btn').click(function(){
        $('#id_cat').attr('value', $(this).val());
        console.log("val: " + $(this).val());
    });

});

///// type effect //////////////
var TxtType = function(el, toRotate, period) {
        this.toRotate = toRotate;
        this.el = el;
        this.loopNum = 0;
        this.period = parseInt(period, 10) || 2000;
        this.txt = '';
        this.tick();
        this.isDeleting = false;
    };

    TxtType.prototype.tick = function() {
        var i = this.loopNum % this.toRotate.length;
        var fullTxt = this.toRotate[i];

        if (this.isDeleting) {
        this.txt = fullTxt.substring(0, this.txt.length - 1);
        } else {
        this.txt = fullTxt.substring(0, this.txt.length + 1);
        }

        this.el.innerHTML = '<span class="wrap">'+this.txt+'</span>';

        var that = this;
        var delta = 200 - Math.random() * 100;

        if (this.isDeleting) { delta /= 2; }

        if (!this.isDeleting && this.txt === fullTxt) {
        delta = this.period;
        this.isDeleting = true;
        } else if (this.isDeleting && this.txt === '') {
        this.isDeleting = false;
        this.loopNum++;
        delta = 500;
        }

        setTimeout(function() {
        that.tick();
        }, delta);
    };

    window.onload = function() {
        var elements = document.getElementsByClassName('typewrite');
        for (var i=0; i<elements.length; i++) {
            var toRotate = elements[i].getAttribute('data-type');
            var period = elements[i].getAttribute('data-period');
            if (toRotate) {
              new TxtType(elements[i], JSON.parse(toRotate), period);
            }
        }
        // INJECT CSS
        var css = document.createElement("style");
        css.type = "text/css";
        css.innerHTML = ".typewrite > .wrap { border-right: 0.08em solid #fff}";
        document.body.appendChild(css);
    };

////// scroll effect ////////////

$(document).on("scroll", function () {
  var pageTop = $(document).scrollTop()
  var pageBottom = pageTop + $(window).height()
  var tags = $(".scroll-animate")

  for (var i = 0; i < tags.length; i++) {
    var tag = tags[i]

    if ($(tag).position().top < pageBottom) {
      $(tag).addClass("visible")
    } else {
      $(tag).removeClass("visible")
    }
  }
});



    