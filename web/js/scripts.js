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
		/*function ActiveLinksMain(id){
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
			};*/
	
	/* active-menu-catalog */
		/*function ActiveLinksCatalog(id){
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
			};*/
	
	/* add to cart from goods preview */
		$('.buy-from-preview').click(function () {			
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
        
        /* add to cart from catalog-view */
		$('.buy-from-catalog-view').click(function () {			
                    $('#cart-price').html(
                            parseInt($('#cart-price').html()) + parseInt($(this.parentNode).find('span').html())
                    );
                    $('#cart-quantity').html(parseInt($('#cart-quantity').html()) + 1);
                    Cookies.set('cart-price', parseInt($('#cart-price').html()), { expires: 10 });
                    Cookies.set('cart-quantity', parseInt($('#cart-quantity').html()), { expires: 10 });
                    $.gritter.add({
                        title: 'Товар добавлен:',
                        text: $(this.parentNode.parentNode).find('h3 a').html(),
                        image: $(this.parentNode.parentNode.parentNode).find('img').attr('src'),
                        sticky: false,
                        position: 'top-right',
                        time: '2000'
                    });
		}) ;
        
        /* add to cart from good's view */
		$('.buy-from-view1').click(function () {			
                    $('#cart-price').html(
                        parseInt($('#cart-price').html()) + parseInt($(this.parentNode).find('span').html())
                    );
                    $('#cart-quantity').html(parseInt($('#cart-quantity').html()) + 1);
                    var totalSum = 0;
                    $('#cart-table').find('#cart-table-empty-tr').remove();
                    $('#cart-table').find('#cart-table-total-tr').remove();
                    $('#cart-table').append('<tr>');
                    $('#cart-table').append(
                        '<tr>' +
                        '<td class="text-center" width="20%"><img src="' + $(this.parentNode.parentNode.parentNode.parentNode).find('img').attr('src') + '" alt="" class="img-responsive"></td>' +
                        '<td>' + $('h1').html() + $('#goods-id').html() + '</td>' +
                        '<td class="cart-table-price">' + parseInt($(this.parentNode).find('span').html()) + '</td></tr>'
                    );
                    /*var cartGoods = {
                        image: $(this.parentNode.parentNode.parentNode).find('img').attr('src'), 
                        name: $('h1').html(), 
                        price: parseInt($(this.parentNode).find('span').html())
                    };
                    var cartGoodsJSON = JSON.stringify(cartGoods);*/
                    /*if (Cookies.get('cart-goods')) {
                        var goodsInCookies = [];
                        goodsInCookies.push(Cookies.get('cart-goods'));
                        goodsInCookies.push($('h1').html());
                    }*/
                    $('#cart-table').append(
                        '<tr id="cart-table-total-tr">' +
                        '<td></td>' +
                        '<td>Итого:</td>' +
                        '<td class="text-center text-danger"><span id="cart-total"></span></td></tr>'
                    );
                    $('#cart-table').find('.cart-table-price').each(function( ) {
                        var currentSum = $(this).html();
                        totalSum = Number(totalSum) + Number(currentSum);
                        $('#cart-total').html(totalSum);
                    });
                    $('#cart-table-buttons-block').removeClass('hidden');
                    Cookies.set('cart-price', parseInt($('#cart-price').html()), { expires: -1 });
                    Cookies.set('cart-quantity', parseInt($('#cart-quantity').html()), { expires: -1 });
                    
                    /*
                     * алгоритм:
                     * проверяем, есть ли кука
                     * если нет - пишем в нее id и кол-во товара (1)
                     * если есть - читаем куку, и обновляем кол-во товара (+1)
                     * сохранаяем куку
                     */
                    /*var goodsArray = {};
                    var goodsFromCookies;
                    if (!Cookies.get('cart-goods')) {
                        goodsArray = { 
                            id:  $('#goods-id').html(), 
                            count: 1, 
                            price: parseInt($(this.parentNode).find('span').html())
                        };
                    } else {
                        goodsFromCookies = JSON.parse(Cookies.get('cart-goods'));
                        goodsArray = { 
                            id:  $('#goods-id').html(), 
                            count: (goodsFromCookies.count+1),
                            price: parseInt($(this.parentNode).find('span').html())
                        };
                    }
                    Cookies.set('cart-goods', JSON.stringify(goodsArray), { expires: -1 });*/
                    //alert(goodsFromCookies.id + ', ' + goodsFromCookies.count + ', ' + goodsFromCookies.price);
                    
                    /*if (!Cookies.get('sbt24order')) {
                    var orderCookies = RandomString(12);
                        Cookies.set('sbt24order', orderCookies, { expires: -1 });
                    } else {
                        alert(Cookies.get('sbt24order'));
                    };*/
                    
                    /*if (!Cookies.get('sbt24order')) {
                    var orderCookies = RandomString(12);
                        Cookies.set('sbt24order', orderCookies, { expires: -1 });
                    } else {
                        alert(Cookies.get('sbt24order'));
                    };*/
                    
                    /*var company = 'new';
                    $.ajax({
                        url: 'ajax/cart-add-client',
                        type: 'POST',
                        data: { company: company },
                        success: function(res){
                            console.log(res);
                        },
                        error: function(err){
                            alert(err.responseText);
                            console.log(err);
                        }
                    });*/
                    
                    //Cookies.remove('sbt24order');
                    $.gritter.add({
                        title: 'Товар добавлен:',
                        text: $('h1').html(),
                        image: $(this.parentNode.parentNode.parentNode.parentNode.parentNode).find('img').attr('src'),
                        sticky: false,
                        position: 'top-right',
                        time: '2000'
                    });
		}) ;
        
        /* read cart from cookies https://itchief.ru/lessons/javascript/javascript-working-with-cookies */
                /*$(document).ready(function () {
                    if (Cookies.get('cart-quantity')) {
                        $('#cart-price').html(parseInt(Cookies.get('cart-price')));
                        $('#cart-quantity').html(parseInt(Cookies.get('cart-quantity')));
                    } else {
                        $('#cart-price').html('0.00');
                        $('#cart-quantity').html(parseInt(0));
                    }
                });*/
	
	/* swiper slider on main page */
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
        
        // randomize file name
        function RandomString(length) {
            var str = '';
            for ( ; str.length < length; str += Math.random().toString(36).substr(2) );
            return str.substr(0, length);
        }(20);
        
        // admin: toggle category
        $('.category-level-0').find('li').on('click', 'a', function (e) {
            e.preventDefault();
            $(this.parentNode.parentNode.parentNode).find('.category-level-1').toggle();
            var folder = $(this.parentNode).find('i');
            if(folder.hasClass('fa-folder-open')) {
                folder.removeClass('fa-folder-open').addClass('fa-folder');
            } else {
                
                folder.removeClass('fa-folder').addClass('fa-folder-open');
            }
            /*if(folder.hasClass('fa-folder-o')) {
                folder.removeClass('fa-folder-o').addClass('fa-folder-open-o');
            } else {
                folder.removeClass('fa-folder-open-o').addClass('fa-folder-o');
            }*/
        });

        // admin:  toggle category on DOM load
        $(function () {
            $('.category-level-1').toggle();
        });


        // admin: edit category
        $('.admin-categories-list').on('click', '.fa-close', function () {
            
            alert($(this.parentNode).text());
            
        });

        // admin: image click delegation on id
        function imgLoad(id){
            document.getElementById(id).click();
        }

        // admin: download image function
        function previewImage(imgId, fileId, fileNameId) {  
            // создаем переменные для картинки и файла из input
            var preview = document.getElementById(imgId);
            var file    = document.getElementById(fileId).files[0];
            var reader  = new FileReader();
            reader.onloadend = function () {
                preview.src = reader.result;
                // file name generetion
                function RandomString(length) {    
                    var str = '';
                    for ( ; str.length < length; 
                        str += Math.random().toString(36).substr(2) );
                    return str.substr(0, length);
                }(20);
                // get file extantion
                var ext = file.name.substring(file.name.lastIndexOf('.'));
                document.getElementById(fileNameId).value = RandomString(20) + ext;
            }
            if (file) {
                reader.readAsDataURL(file);
            } else {
                preview.src = "images/image.png";
            }
        }
        
        // admin/banners: load image on button '#btn-load-image' click
        $(function () {
            $('#btn-load-image').click(function() {
                imgLoad('input-load-image');
            });
        });

        // admin/banners: load image on banner '#banner-image' click
        $(function () {
            $('#banner-image').click(function() {
                imgLoad('input-load-image');
            });
        });

        // admin/banners: load image on banner '#banner-image' click
        $(function () {
            $('#input-load-image').change(function() {
                previewImage('banner-image','input-load-image','input-image-file');
            });
        });

        // admin/banners: select help text on change
        $('#select-banner-position').change(function() {          
            var key = $(this).val();
            var text = '';            
            switch (key) {
                case '0':
                    text = 'Выберите позицию из списка';
                    break;
                case '1':
                    text = 'Слайдер на главной странице состоит из одного или нескольких слайдов.<br> Размер всех картинок для слайдера должен быть одинаковым, оптимально: 900х380px';
                    break;           
                case '2':
                    text = 'Баннер на главной странице между блоками Новые товары и Хиты продаж. Баннер должен быть горизонтальным, оптимальный размер 900х380px';
                    break;             
                case '3':
                    text = 'Баннер в каталоге выводится в разделах каталога. Баннер должен быть горизонтальным, оптимальный размер 900х240px';
                    break;
                case '4':
                    text = 'Баннер в левом меню, можно добавлять несколько баннеров  в позицию, выводятся в случайном порядке по  2 шт. Оптимальный размер 400х300px';
                    break;
                default:
                    text = 'Выберите позицию из списка';
                    break;
            }
            $('#position-comment').html( text );
        });

        
        $(function () {
            $('#select-banner-position').change();
        });

        /*$('.goods-view-block').find('form').on('beforeValidate', function(event) {
            alert('beforeValidate');
            event.preventDefault();
            $('#cart-price').html(
                            parseInt($('#cart-price').html()) + parseInt($(this.parentNode).find('span').html())
                    );
            $('#cart-quantity').html(parseInt($('#cart-quantity').html()) + 1);
            Cookies.set('cart-price', parseInt($('#cart-price').html()), { expires: 10 });
            Cookies.set('cart-quantity', parseInt($('#cart-quantity').html()), { expires: 10 });
            $.gritter.add({
                title: 'Товар добавлен:',
                text: $('h1').html(),
                image: $(this.parentNode.parentNode.parentNode).find('img').attr('src'),
                sticky: false,
                position: 'top-right',
                time: '2000'
            });
            return false;
        });*/
        
        /*$('.goods-view-block').find('form').on('submit', function(event) {
            event.preventDefault();
            alert($(this).html());
            $('#cart-price').html(
                            parseInt($('#cart-price').html()) + parseInt($(this.parentNode).find('span').html())
                    );
            $('#cart-quantity').html(parseInt($('#cart-quantity').html()) + 1);
            Cookies.set('cart-price', parseInt($('#cart-price').html()), { expires: 10 });
            Cookies.set('cart-quantity', parseInt($('#cart-quantity').html()), { expires: 10 });
            $.gritter.add({
                title: 'Товар добавлен:',
                text: $('h1').html(),
                image: $(this.parentNode.parentNode.parentNode).find('img').attr('src'),
                sticky: false,
                position: 'top-right',
                time: '2000'
            });
            $('.goods-view-block').find('form').reset();
            $.pjax.reload({container: $(this)});
            return true;
        });*/
        