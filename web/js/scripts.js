/*
 * Java-скрипты
 */

	/* toTop Button */
	
		$(function() { 
			$(window).scroll(function() { 
			if($(this).scrollTop() != 0) { 
				$('#toTop').fadeIn(); 
					} else {	 
						$('#toTop').fadeOut(); 
					}	 
				}); 
				$('#toTop').click(function() { 
				$('body,html').animate({scrollTop:0},800); 
			}); 
		});
	
	
	/*Fix menu */
	
	$(document).ready(function(){
	        var $menu = $("#main-menu-container");
	        $(window).scroll(function(){
	            if ( $(this).scrollTop() > 100 && $menu.hasClass("default") ){
	                $menu.removeClass("default").addClass("fixed");
	            } else if($(this).scrollTop() <= 100 && $menu.hasClass("fixed")) {
	                $menu.removeClass("fixed").addClass("default");
			}
		});//scroll
	});
	
	/*scroll to anchor */
	$(document).ready(function() {
		$("a.scrolling-links").click(function () {
		  var elementClick = $(this).attr("href");
		  var destination = $(elementClick).offset().top-50;
		  $('html,body').animate( { scrollTop: destination }, 1100 );
		  return false;
		});
	});
	
	/* active-menu-main */
		function ActiveLinksMain(id){
			try{
				var el=document.getElementById(id).getElementsByTagName('a');
					var url=document.location.href;
					for(var i=0;i<el.length; i++){
					if (url==el[i].href){
					el[i].className = 'active_menu';
					};
				};
			}
			catch(e){}
			};
	
	/* active-menu-catalog */
		function ActiveLinksCatalog(id){
			try{
				var el=document.getElementById(id).getElementsByTagName('a');
					var url=document.location.href;
					for(var i=0;i<el.length; i++){
					if (url==el[i].href){
					el[i].className = 'active_menu';
					};
				};
			}
			catch(e){}
			};
	
	/* add to cart by click on button */
		$('.goods-buy').click(function () {			
                    $('#cart-price').html(
                            parseInt($('#cart-price').html()) + parseInt($(this.parentNode).find('span').html())
                    );
                    $('#cart-quantity').html(parseInt($('#cart-quantity').html()) + 1);
                    Cookies.set('cart-price', parseInt($('#cart-price').html()), { expires: 10 });
                    Cookies.set('cart-quantity', parseInt($('#cart-quantity').html()), { expires: 10 });
                    $.gritter.add({
                        title: 'Товар добавлен:',
                        text: $(this.parentNode).find('h4').html(),
                        image: $(this.parentNode).find('img').attr('src'),
                        sticky: false,
                        position: 'top-right',
                        time: '2000'
                    });
		}) ;
        
        
        /* read cart from cookies https://itchief.ru/lessons/javascript/javascript-working-with-cookies */
                $(document).ready(function () {
                    if (Cookies.get('cart-quantity')) {
                        $('#cart-price').html(parseInt(Cookies.get('cart-price')));
                        $('#cart-quantity').html(parseInt(Cookies.get('cart-quantity')));
                    } else {
                        $('#cart-price').html('0.00');
                        $('#cart-quantity').html(parseInt(0));
                    }
                    
                });
	
	/* swiper slider */
	$(document).ready(function () {
        //initialize swiper when document ready
        var mySwiper = new Swiper ('.swiper-container', {
		// Optional parameters
		autoplay: {
			delay: 5000,
			},
		pagination: {
				el: '.swiper-pagination',
				type: 'bullets',
				//type: 'progressbar',
				bulletElement: 'span',
				bulletClass: 'swiper-pagination-bullets',
				bulletActiveClass: 'swiper-pagination-bullet-active',
				clickable: true
			},
		navigation: {
				nextEl: '.swiper-button-next',
				prevEl: '.swiper-button-prev',
			},
		mousewheel: {
			invert: true,
			},
		effect: 'fade',
		fadeEffect: {
			crossFade: true
			},
		coverflowEffect: {
			rotate: 30,
			slideShadows: false,
			},
		loop: true
		})
	});
	
        /* active menu */
	$(function () {
            var location = window.location.href;
            var cur_url = '/sbt24/' + location.split('/').pop();    // !!!убрать '/sbt24/' заменить на '/'

            $('#main-menu ul li').each(function () {
                var link = $(this).find('a').attr('href');
                
                if (cur_url == link) {
                    $(this).find('a').addClass('active_menu');
                }
            });
        });
        
        /* preview i chevron change */
	$(function () {
            $('.preview').on('click', function(){
                if ($(this).find('i').hasClass('fa-chevron-down')) {
                    $(this).find('i').removeClass('fa-chevron-down').addClass('fa-chevron-up');
                } else {
                    $(this).find('i').removeClass('fa-chevron-up').addClass('fa-chevron-down');
                }
            });
        });