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

        // catalog-menu on img click - redirect to /catalog/id
        $('#catalog-menu ul .category-menu-item').on('click', 'img', function() {
            var url = $(this.parentNode).find('a').attr('href');
            document.location.href = url;
        });

        /* goods-view catalog-view fix properties table */
        $(function () {
            var table = $('.goods-container .goods-view-block .goods-view-tabs .tab-content .tab-pane table');
            table.addClass('table table-bordered table-responsive table-striped');
            $('.catalog-view-props-table table').each(function() {
                $(this).addClass('table table-bordered table-responsive table-striped');
            });
        });
        


        // adminka
        
        // admin/category: toggle category
        $('.category-level-0').find('li').on('click', '.has-subcat', function (e) {
            e.preventDefault();
            $(this.parentNode.parentNode.parentNode).find('.category-level-1').toggle();
            var folder = $(this.parentNode).find('i');
            if(folder.hasClass('fa-folder-open')) {
                folder.removeClass('fa-folder-open').addClass('fa-folder');
            } else {
                
                folder.removeClass('fa-folder').addClass('fa-folder-open');
            }
        });

        // admin/category:  toggle category on DOM load
        $(function () {
            $('.category-level-1').toggle();
        });


        // admin/category: delete category
        /*$('.admin-categories-list').on('click', '.fa-close', function () { 
            alert($(this.parentNode).text());
        });*/

        // admin/goods: category filter block
        $('.category-filter-block').find('.btn-group a').click(function () {
            
            $('.category-filter-block').find('.btn-group a').each(function () {
                $(this).removeClass('active');
            });

            var filterCat = $(this).attr('category');
            $(this).addClass('active');
            var counter = 1;
            $('.tovar-block').each(function () {
                var cat = $(this).attr('category');
                $(this).addClass('hidden');
                if(cat){
                    if(filterCat == 0){
                        $(this).removeClass('hidden');
                    } else {
                        if (filterCat == cat) {
                            $(this).removeClass('hidden');
                        }
                    }
                    if(!$(this).hasClass('hidden')) {
                        $(this).find('.tovar-counter').html(counter);
                        counter++;
                    }
                }
                var cursUsd = $('#curs-usd').html();
                var cursEur = $('#curs-eur').html();
                var rub = $(this).find('.tovar-price-rub').html();
                var usd = parseFloat($(this).find('.tovar-price-usd').html()) * parseFloat(cursUsd);
                var eur = parseFloat($(this).find('.tovar-price-eur').html()) * parseFloat(cursEur);
                
                if(rub == 0) {
                    var rubFixed = parseFloat(rub) + parseFloat(usd) + parseFloat(eur);
                    $(this).find('.tovar-price-rub').html(parseFloat(rubFixed).toFixed(2));
                }
            });
        });
        
        // admin/goods: category filter block on DOM load
        $(function () {
            $('.category-filter-block').find('.btn-group .active').click();
        });

        // admin/goods: build category-pagination-block and page attr for .tovar-block
        function buildPagination(pageSize) {
            $('.category-pagination-block .btn-group').find('button').each(function() {
                $(this).remove();
            });
            $('<button>', {
                html: '1',
                id: 'btn-pagination-block-1',
                class: 'btn btn-default active',
                click: function() {
                    var page = $(this).html();
                    
                    $('.category-pagination-block').find('.btn-group button').each(function () {
                        $(this).removeClass('active');
                    });

                    $(this).addClass('active');

                    $('.tovar-block').each(function () {
                        $(this).hide();
                        if($(this).attr('page') == page) {
                            $(this).show();
                        }
                    });
                }
            }).appendTo('.category-pagination-block .btn-group');

            //var pageSize = $('#select-pages-count').val();       // change pagination page size here!
            var page = 1;           // current page number
            var goodsCounter = 0;   // counter for all goods
            var first = 1;          // first good number in range
            var last = (Number(first) + Number(pageSize) - 1);    // last good number in range
            
            $('.tovar-block').each(function () {

                /*
                    Object.keys(obj)    //получить свойства объекта
                    var user = {
                        name: "Петя",
                        age: 30
                    }
                    var keys = Object.keys(user);
                    alert( keys ); // name, age
                */
                
                
                /*var obj = document.getElementsByClassName('tovar-block');
                Object.keys(obj).forEach(function(key) {
                    console.log(key, ':', this[key].getAttribute('category'));
                  }, obj);*/
                  

                if (goodsCounter == last) {
                    first = last;
                    last = (Number(first) + Number(pageSize)); 
                    page++;
                }
                $(this).attr('page', page);
                goodsCounter++;
            });

            for(var i=1; i<page; i++) {
                $('<button>', {
                    html: (i+1),
                    class: 'btn btn-default',
                    click: function() {    
                        var page = $(this).html();
                        
                        $('.category-pagination-block').find('.btn-group button').each(function () {
                            $(this).removeClass('active');
                        });
    
                        $(this).addClass('active');
                        
    
                        $('.tovar-block').each(function () {
                            $(this).hide();
                            if($(this).attr('page') == page) {
                                $(this).show();
                            }
                        });
                    }
                }).appendTo('.category-pagination-block .btn-group');
            }
        }
        // admin/goods: show category-pagination-block
        $(function () {
            buildPagination($('#select-pages-count').val());
        });
        
        $('#select-pages-count').change(function () {
            buildPagination($(this).val());
            $('.category-pagination-block').find('.btn-group .active').click();
        });

        // admin/goods: click on first button
        $(function () {
            $('#btn-pagination-block-1').click();
        });

        // admin/goods-add: goods-pagination-block on button click
        $('.goods-pagination-block').find('.btn-group button').click(function() {
            $('.goods-pagination-block').find('.btn-group button').each(function() {
                $(this).removeClass('active');
            });
            $(this).addClass('active');
            var tab = $(this).attr('tab');
            if(tab) {
                if(tab == 0) {
                    $('.dashboard-block').each(function() {
                        $(this).show();
                    });
                } else {
                    $('.dashboard-block').each(function() {
                        if($(this).attr('tab')) {
                            $(this).hide();
                            if($(this).attr('tab') == tab) {
                                $(this).show();
                            }
                        }
                    });
                }   
            }  
        });

        // admin/goods-add: goods-pagination-block click on first button
        $(function () {
            $('.dashboard-block').each(function() {
                $('.goods-pagination-block').find('.btn-group .active').click();
            });
        });

        // admin/goods-edit-add: dropdown menu for brands
        $('#brand-field').click(function () {
            $("#brand-dropdown-menu").toggle();
        });
        $('#brand-dropdown-menu').find('li').click(function () {
            $('#brand-field').val($(this).html());
            $(this.parentNode).toggle();
        });

        // admin/goods-edit-add: dropdown menu for types
        $('#type-field').click(function () {
            $("#type-dropdown-menu").toggle();
        });
        $('#type-dropdown-menu').find('li').click(function () {
            $('#type-field').val($(this).html());
            $(this.parentNode).toggle();
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

        // admin/banners/category: load image on banner '#banner-image' click
        $('#input-load-image').change(function() {
            previewImage('banner-image','input-load-image','input-image-file');
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

        // admin/banners: select banner position on DOM load
        $(function () {
            $('#select-banner-position').change();
        });

        // admin/goods-add: load image on button '#btn-load-photoN' click
        $(function () {
            $('#btn-load-photo1').click(function() {
                imgLoad('input-load-photo-1');
            });
            $('#btn-load-photo2').click(function() {
                imgLoad('input-load-photo-2');
            });
            $('#btn-load-photo3').click(function() {
                imgLoad('input-load-photo-3');
            });
            $('#btn-load-photo4').click(function() {
                imgLoad('input-load-photo-4');
            });
        });

        // admin/banners: load image on '#goods-image-N' click
        $(function () {
            $('#goods-image-1').click(function() {
                imgLoad('input-load-photo-1');
            });
            $('#goods-image-2').click(function() {
                imgLoad('input-load-photo-2');
            });
            $('#goods-image-3').click(function() {
                imgLoad('input-load-photo-3');
            });
            $('#goods-image-4').click(function() {
                imgLoad('input-load-photo-4');
            });
        });

        // admin/banners/category: load photoN on '#goods-image-N' click
        $('#input-load-photo-1').change(function() {
            previewImage('goods-image-1','input-load-photo-1','input-image-photo-1');
        });
        $('#input-load-photo-2').change(function() {
            previewImage('goods-image-2','input-load-photo-2','input-image-photo-2');
        });
        $('#input-load-photo-3').change(function() {
            previewImage('goods-image-3','input-load-photo-3','input-image-photo-3');
        });
        $('#input-load-photo-4').change(function() {
            previewImage('goods-image-4','input-load-photo-4','input-image-photo-4');
        });

        // translit rus-to-eng
        function translit(input){
            // Символ, на который будут заменяться все спецсимволы
            var space = '-';
            // Берем значение из нужного поля и переводим в нижний регистр
            var text = input.val().toLowerCase();
                
            // Массив для транслитерации
            var transl = {
            'а': 'a', 'б': 'b', 'в': 'v', 'г': 'g', 'д': 'd', 'е': 'e', 'ё': 'e', 'ж': 'zh',
            'з': 'z', 'и': 'i', 'й': 'j', 'к': 'k', 'л': 'l', 'м': 'm', 'н': 'n',
            'о': 'o', 'п': 'p', 'р': 'r','с': 's', 'т': 't', 'у': 'u', 'ф': 'f', 'х': 'h',
            'ц': 'c', 'ч': 'ch', 'ш': 'sh', 'щ': 'sh','ъ': space, 'ы': 'y', 'ь': space, 'э': 'e', 'ю': 'yu', 'я': 'ya',
            ' ': space, '_': space, '`': space, '~': space, '!': space, '@': space,
            '#': space, '$': space, '%': space, '^': space, '&': space, '*': space,
            '(': space, ')': space,'-': space, '\=': space, '+': space, '[': space,
            ']': space, '\\': space, '|': space, '/': space,'.': space, ',': space,
            '{': space, '}': space, '\'': space, '"': space, ';': space, ':': space,
            '?': space, '<': space, '>': space, '№':space
            }
                           
            var result = '';
            var curent_sim = '';
                           
            for(i=0; i < text.length; i++) {
                // Если символ найден в массиве то меняем его
                if(transl[text[i]] != undefined) {
                     if(curent_sim != transl[text[i]] || curent_sim != space){
                         result += transl[text[i]];
                         curent_sim = transl[text[i]];
                                                                    }                                                                            
                }
                // Если нет, то оставляем так как есть
                else {
                    result += text[i];
                    curent_sim = text[i];
                }                             
            }         
                           
            result = TrimStr(result);              
                           
            // Выводим результат
            //$('#alias').val(result);
            return result;
               
            }
            function TrimStr(s) {
                s = s.replace(/^-/, '');
                return s.replace(/-$/, '');
            }
            
            // admin/category-add-edit translint link from name
            $('#input-category-name').keyup( function() {
                $('#input-category-link').val(translit($(this)));
                $('#input-category-title').val($(this).val());
            });

            // admin/goods-add-edit build keywords from type and model
            $('#type-field').change( function() {
                var type = $(this).val();
                var model = $('#model-field').val();
                var keywords = '';
                if(type == '' && model == '') {
                    keywords = '';
                } else if (type == '' && model != '') {
                    keywords = model;
                } else if(type != '' && model == '') {
                    keywords = type;
                } else {
                    keywords = type + ' ' + model;
                }
                $('#keywords-field').val(keywords);
            });
            $('#model-field').change( function() {
                var model = $(this).val();
                var type = $('#type-field').val();
                var keywords = '';
                if(model == '' && type == '') {
                    keywords = '';
                } else if (model == '' && type != '') {
                    keywords = type;
                } else if(model != '' && type == '') {
                    keywords = model;
                } else {
                    keywords = type + ' ' + model;
                }
                $('#keywords-field').val(keywords);
            });
            $('#type-dropdown-menu').find('li').click(function() {
                $('#type-field').change();
            });
        
        // admin/clients: client-head sort
        $('.client-head').find('h5').on('click', 'a', function(e) {
            e.preventDefault();
            $('.client-head').find('h5').each(function() {
                $(this).find('i').addClass('hidden');
            });
            
            var i = $(this.parentNode).find('i');
            
            if (i.hasClass('hidden')) {
                i.removeClass('hidden');
            }
            
            function changeClass(i) {
                if (i.hasClass('fa-arrow-down')) {
                    i.removeClass('fa-arrow-down').addClass('fa-arrow-up');
                } else {
                    i.removeClass('fa-arrow-up').addClass('fa-arrow-down');
                }
            }
            changeClass(i);

            function sortByClientName() {
                var clientsArray = [];
                $('.client-block').each(function(){
                    //$(this).remove();
                    $(this).appendTo(this.parentNode);
                });
            }
            $('.client-block').each(function(){
                //$(this).remove();
                $(this).appendTo(this.parentNode);
                //alert($(this).html());
            });
            sortByClientName();
            
            i.click(function() {
                changeClass($(this));
                sortByClientName();
            });
        });

        // admin/clients: search
        $('#search #admin-clients-search-input').keyup(function(){
            var str = $(this).val();
            var clientCounter = 1;
            $('.client-block').each(function(){
                $(this).hide();
                var txt = $(this).find('.client-name-block a').html();
                if( txt.toLowerCase() == str.toLowerCase() || str == '' ) {
                    $(this).show();
                    $(this).find('.client-counter').html(clientCounter++);
                }
            });
        });
            

        /*
        
    +DORS 10 -$23;
DORS 10  лупа автономная - $23; 
    +DORS 15 - $36 ;
    +DORS 25 - $66;
    +DORS 50 (черный) - $14;
    +DORS 50 (серый) - $14 ;
    +DORS 60 (черный) - $18; DORS 60 (серый) - $18 ;
    +DORS 115 - $26;
    +DORS 125 -  $31;
    +DORS 135 - $35;
    +DORS 145 - $46
    +DORS 1000 М3 (черный) - $75; DORS 1000 М3 (серый)  - $75; 
    +DORS 1100- $136;
    +DORS 1170 Light Универсальный детектор - $136 ;
    +DORS 1170D Универсальный детектор - $190;
    +DORS 1050A (универс. детектор)  NEW - $130;
DORS 1200 - $180;
    +DORS 1250 М1 (+Антистокс, МГ) - $245;
    +DORS 1300 M2 (+Антистокс-контроль (iAS), МГ, 20х) - $480;
    +DORS 1010 -  $56;
    +DORS 1020 - $80;
    +DORS CT 2015  NEW - 5 650р ;
    +DORS CT 2015  с АКБ NEW - 6 330р.;
    +DORS 210 RUB  (iAS, CIS, МГ, ИК, УФ) - 9 800р.
    +DORS 210 RUB Compact  (iAS, CIS, МГ, ИК, УФ)    NEW - 9 800р.

(опция) Программатор для  DORS 210 - $30
    +DORS 230 M2  - $240
    +DORS 230 M2 с аккумулятором  - $260 


Сортировщики банкнот:

    +https://deep2000.ru/oborudovanie/sortirovshiki_banknot/Kisan%20Newton%20PF.html (3200 $)

    +https://deep2000.ru/oborudovanie/sortirovshiki_banknot/sortirovshchik-banknot-kisan-k2.html  ( 1170 $)

    +https://deep2000.ru/oborudovanie/sortirovshiki_banknot/PLUS%20624N.html  ( 950 $)

    +https://deep2000.ru/oborudovanie/sortirovshiki_banknot/ribao-bcs-150.html  (1100 $)

    +https://deep2000.ru/oborudovanie/sortirovshiki_banknot/k5.html  (13000 $)


Счетчики банкнот: 

    +https://deep2000.ru/oborudovanie/schetchiki_banknot/Ribao%20R-506.html  ( 260 $ )

    +цена?   https://deep2000.ru/oborudovanie/schetchiki_banknot/schetchik-banknot-plus-p-16.html 

    +https://deep2000.ru/oborudovanie/schetchiki_banknot/ds-25.html ( 150 $)

    +https://deep2000.ru/oborudovanie/schetchiki_banknot/ds-50.html (240 $)

Детекторы валют:

    +https://deep2000.ru/oborudovanie/detektory_valut/MD%208007.html  ( 340 $)

https://deep2000.ru/oborudovanie/detektory_valut/PF%209007.html  ( 510 $)

https://deep2000.ru/oborudovanie/detektory_valut/md8000.html ( 250 $)

https://deep2000.ru/oborudovanie/detektory_valut/pf_9000.html (490 $)

https://deep2000.ru/oborudovanie/detektory_valut/ird_2200.html ( 90$)

https://deep2000.ru/oborudovanie/detektory_valut/ird-1000.html  (78 $)


Счетчики и сортировщики монет:

https://deep2000.ru/oborudovanie/obrabotka_monet/Zebra.html  (

https://deep2000.ru/oborudovanie/obrabotka_monet/schetchik-i-sortirovshchik-monet-zebra-301.html ( 4300 $)

https://deep2000.ru/oborudovanie/obrabotka_monet/pelican_301.html (2400 $)

https://deep2000.ru/oborudovanie/obrabotka_monet/schetchik-monet-cs-2000.html (450 $)

https://deep2000.ru/oborudovanie/obrabotka_monet/cs-100.html (240 $)
        */