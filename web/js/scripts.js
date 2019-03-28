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

    /* add to cart from new or hit goods on main page */
    $('.buy-from-preview').click(function () {
        let goodsId = $(this).closest('.goods-block').data('goodsId');
        // add cookie with goods-id
        Cookies.set('sbt24goods', parseInt(goodsId), { expires: 10 });
        let cartSum =  $('#cart-price').html();
        let thisPrice = $(this.parentNode).find('span').html();
        let newSum = parseFloat(cartSum) + parseFloat(thisPrice);
        $('#cart-price').html(parseFloat(newSum).toFixed(2));
        $('#cart-quantity').html(parseInt($('#cart-quantity').html()) + 1);
        $.gritter.add({
            title: 'Товар добавлен:',
            text: $(this.parentNode).find('h4').html(),
            image: $(this.parentNode.parentNode.parentNode).find('img').attr('src'),
            sticky: false,
            position: 'top-right',
            time: '2000'
        });
    });
    
    /* add to cart from new goods on main page (ajax) */
    $('#new-goods-form').on('beforeSubmit', function(e) {
        e.preventDefault();
        var form = $(this);
        var formData = form.serialize();
        $.ajax({
            url: form.attr('action'),
            type: form.attr('method'),
            data: formData,
            success: function (data) {
                    /*$.gritter.add({
                        title: 'Товар добавлен:',
                        text: $(this.parentNode.parentNode).find('h3 a').html(),
                        image: $(this.parentNode.parentNode.parentNode).find('img').attr('src'),
                        sticky: false,
                        position: 'top-right',
                        time: '2000'
                    });*/
                    // Yandex Metrika / goal - add to cart
                    ym(51001274, 'reachGoal', 'addToCart');
                return true;
            },
            error: function () {
                alert('При добавлении товара произошла ошибка!');
            }
        });
    }).on('submit', function(e){
        e.preventDefault();
    });

    /* add to cart from hit goods on main page (ajax) */
    $('#hit-goods-form').on('beforeSubmit', function(e) {
        e.preventDefault();
        var form = $(this);
        var formData = form.serialize();
        $.ajax({
            url: form.attr('action'),
            type: form.attr('method'),
            data: formData,
            success: function (data) {
                    /*$.gritter.add({
                        title: 'Товар добавлен:',
                        text: $(this.parentNode.parentNode).find('h3 a').html(),
                        image: $(this.parentNode.parentNode.parentNode).find('img').attr('src'),
                        sticky: false,
                        position: 'top-right',
                        time: '2000'
                    });*/
                    // Yandex Metrika / goal - add to cart
                    ym(51001274, 'reachGoal', 'addToCart');
                return true;
            },
            error: function () {
                alert('При добавлении товара произошла ошибка!');
            }
        });
    }).on('submit', function(e){
        e.preventDefault();
    });
    
    /* add to cart from catalog-view */
    $('.buy-from-catalog-view').click(function () {
        let goodsId = $(this).closest('.goods-list-block').data('goodsId');
        // add cookie with goods-id
        Cookies.set('sbt24goods', parseInt(goodsId), { expires: 10 });
        let cartSum =  $('#cart-price').html();
        let thisPrice = $(this.parentNode).find('span').html();
        let newSum = parseFloat(cartSum) + parseFloat(thisPrice);
        $('#cart-price').html(parseFloat(newSum).toFixed(2));
        $('#cart-quantity').html(parseInt($('#cart-quantity').html()) + 1);
        $.gritter.add({
            title: 'Товар добавлен:',
            text: $(this.parentNode.parentNode).find('h3 a').html(),
            image: $(this.parentNode.parentNode.parentNode).find('img').attr('src'),
            sticky: false,
            position: 'top-right',
            time: '2000'
        });
    }) ;
    
    /* add to cart from catalog-view (ajax) */
    $('#catalog-view-form').on('beforeSubmit', function(e) {
        e.preventDefault();
        var form = $(this);
        var formData = form.serialize();
        $.ajax({
            url: form.attr('action'),
            type: form.attr('method'),
            data: formData,
            success: function (data) {
                    /*$.gritter.add({
                        title: 'Товар добавлен:',
                        text: $(this.parentNode.parentNode).find('h3 a').html(),
                        image: $(this.parentNode.parentNode.parentNode).find('img').attr('src'),
                        sticky: false,
                        position: 'top-right',
                        time: '2000'
                    });*/
                    // Yandex Metrika / goal - add to cart
                    ym(51001274, 'reachGoal', 'addToCart');
                return true;
            },
            error: function () {
                alert('При добавлении товара произошла ошибка!');
            }
        });
    }).on('submit', function(e){
        e.preventDefault();
    });
    
    /* add to cart from good's view */
    $('.buy-from-view').click(function () {			
        let goodsId = $(this).closest('.goods-view-block').data('goodsId');
        // add cookie with goods-id
        Cookies.set('sbt24goods', parseInt(goodsId), { expires: 10 });
        let cartSum =  $('#cart-price').html();
        let thisPrice = $(this.parentNode).find('span').html();
        let newSum = parseFloat(cartSum) + parseFloat(thisPrice);
        $('#cart-price').html(parseFloat(newSum).toFixed(2));
        $('#cart-quantity').html(parseInt($('#cart-quantity').html()) + 1);
        $.gritter.add({
            title: 'Товар добавлен:',
            text: $('h1').html(),
            image: $('.goods-view-img-block').find('img').attr('src'),
            sticky: false,
            position: 'top-right',
            time: '2000'
        });
    }) ;
    
    /* add to cart from good's view form (ajax) */
    $('#goods-view-form').on('beforeSubmit', function(e) {
        e.preventDefault();
        var form = $(this);
        var formData = form.serialize();
        $.ajax({
            url: form.attr('action'),
            type: form.attr('method'),
            data: formData,
            success: function (data) {
                    /*$.gritter.add({
                        title: 'Товар добавлен:',
                        text: $(this.parentNode.parentNode).find('h3 a').html(),
                        image: $(this.parentNode.parentNode.parentNode).find('img').attr('src'),
                        sticky: false,
                        position: 'top-right',
                        time: '2000'
                    });*/
                    // Yandex Metrika / goal - add to cart
                    ym(51001274, 'reachGoal', 'addToCart');
                return true;
            },
            error: function () {
                alert('При добавлении товара произошла ошибка!');
            }
        });
    }).on('submit', function(e){
        e.preventDefault();
    });
    

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

    // https://github.com/dbrekalo/fastsearch

    /* goods-list-block paging */
    function catalogPagination(){
        // if there are no any goods-list-block - hide pagination and return
        if($.find('.goods-list-block') == false) {
            $('.filter-block').hide();
            $('.catalog-view-pagination-block').hide();
            return;
        }
        // vars:
        let pageQuantity = 0;  // pagination pages quantity (get below)
        let goodsQuantity = 0;  // goods quantity
        let currPage = 1;   // current page number
        let selectPageCount = $('#select-catalog-pages-count').val(); // selected page count
        let last = selectPageCount; // set last goods in range
        
        // init goods params
        $('.goods-list-block').each(function () {
            goodsQuantity++;    // calc goods quantity
            // update last if goodsQuantity == last
            if( goodsQuantity == (parseInt(last)+1) ) {
                currPage++; // set current page + 1
                last = parseInt(selectPageCount) * parseInt(currPage);
            }
            $(this).data('pageNumber', currPage);  // set data-page-number
        });

        // get pagination pages quantity
        pageQuantity = Math.ceil(goodsQuantity / selectPageCount);  

        // remove all pagination button
        $('.catalog-view-pagination .btn-group').find('button').each(function() {
            $(this).remove();
        });

        // add first default pagination button
        $('<button>', {
            html: '1',
            //id: 'btn-pagination-block-1',
            class: 'btn btn-default active',
            click: function() {
                let btnPageNum = $(this).html();    // num on selected button
                // set carrent page = html of current button
                currPage = btnPageNum;
                // set active current button
                $('.catalog-view-pagination').find('.btn-group button').each(function () {
                    $(this).removeClass('active');
                });
                $(this).addClass('active');
                $('.goods-list-block').each(function () {
                    $(this).hide();
                    if($(this).data('pageNumber') == currPage) {
                        $(this).show();
                    }
                });
            }
        }).appendTo('.catalog-view-pagination .btn-group');

        // add all pagination buttons (second... and more)
        for(var i=1; i<pageQuantity; i++) {
            $('<button>', {
                html: (i+1),
                class: 'btn btn-default',
                click: function() {    
                    let btnPageNum = $(this).html();    // num on selected button
                    // set carrent page = html of current button
                    currPage = btnPageNum;
                    // set active current button
                    $('.catalog-view-pagination').find('.btn-group button').each(function () {
                        $(this).removeClass('active');
                    });
                    $(this).addClass('active');
                    $('.goods-list-block').each(function () {
                        $(this).hide();
                        if($(this).data('pageNumber') == currPage) {
                            $(this).show();
                        }
                    });
                }
            }).appendTo('.catalog-view-pagination .btn-group');
        }
    }
    // set pagination on select page value
    $('#select-catalog-pages-count').change(function() {
        catalogPagination();
        $('.catalog-view-pagination .btn-group .active:first').click();
    });
    // set pagination on DOM load
    $(function () {
        catalogPagination();
        $('.catalog-view-pagination .btn-group .active:first').click();
    });

    // init lightbox    https://lokeshdhakar.com/projects/lightbox2
    $(function () {
        lightbox.option({
            'showImageNumberLabel': false,
            'maxWidth': 900,
        });
    });

    /* goods-list-block toggle show/hide*/
    
    $(function () {
        $('#filter-block-toggle').on('click', function() {
            $('.filter-block-container').toggle(500, function(){
                if($(this).css('display') == 'none') {
                    $('#filter-block-toggle').attr('title', 'Открыть расширенный поиск');
                    $('#filter-block-toggle')
                        .find('i')
                            .removeClass('fa-close')
                                .addClass('fa-chevron-down')
                                    .css({'color':'#5BB112'});
                } else {
                    $('#filter-block-toggle').attr('title', 'Скрыть  расширенный поиск');
                    $('#filter-block-toggle')
                        .find('i')
                            .removeClass('fa-chevron-down')
                                .addClass('fa-close')
                                    .css({'color':'#D9534F'});
                }
            });
            
        });
    });

    // catalog / filter block

    // catalog / filter block / init function min / max price and fill inputs
    function initFilterByMinMaxPrice() {
        let maxPrice = minPrice = 0;
        let priceArray = [];
        $('.goods-list-block').each(function () {
            let price = $(this).find('.goods-price span').html();
            if( $('.catalog-view-pagination-block').css('display') == 'none' 
                    && $(this).css('display') != 'none' ) {  
                priceArray.push(price);
                return;
            } else if($('.catalog-view-pagination-block').css('display') != 'none') {  
                priceArray.push(price);
            } else {  
                return;
            }
        });
        minPrice = Math.min.apply(Math, priceArray);
        maxPrice = Math.max.apply(Math, priceArray);
        $('.filter-block-price').find('#price-from').val(minPrice);
        $('.filter-block-price').find('#price-to').val(maxPrice);
    } // end initFilterByMinMaxPrice()

    // catalog / filter block / filter by min / max price, set slider range
    function filterByMinMaxPrice(minPrice, maxPrice) {
        $('.goods-list-block').each(function () {
            $(this).hide();
            let price = parseFloat($(this).find('.goods-price span').html());
            if( price >= parseFloat(minPrice) && price <= parseFloat(maxPrice) ) {  
                $(this).show();
            }
        });
    }

    // catalog / filter block / set slider-range
    /*function setSliderRange(minPrice, maxPrice) {
        $( "#slider-range" ).slider({
          range: true,
          min: 0,
          step: 10,
          max: maxPrice,
          values: [ minPrice, maxPrice ],
          slide: function( event, ui ) {
            $( "#amount" ).val( ui.values[ 0 ] + " - " + ui.values[ 1 ] );
          }
        });
        $("#amount").val( $("#slider-range").slider("values", 0) + " - " + $("#slider-range").slider("values", 1) + " руб.");
    }*/


    $('#btn-filter-apply').click(function() {
        $('.catalog-view-pagination .btn-group .active:first').click();
        let filterCount = 0;
        let allBrandsClear = allTypesClear = true;
        $('.goods-list-block').each(function () {
            $(this).data('pageNumber', 1);
            $(this).hide();
            $(this).data('show',0);
            let goods = $(this);
            let brand = $(this).data('brand');
            let type = $(this).data('type');
            $('.filter-by-brand li').each(function () {
                let labelBrand = $(this).find('label span').html();
                let checkedBrand = $(this).find('input[type="checkbox"]').is(':checked');
                if( checkedBrand && labelBrand == brand ){
                    $('.filter-by-type li').each(function () {
                        let labelType = $(this).find('label span').html();
                        let checkedType = $(this).find('input[type="checkbox"]').is(':checked');
                        if ( !checkedType ) {
                            $(goods).hide();
                            return;
                        }                    
                    });                     
                    $(goods).show();
                }
                if(checkedBrand) allBrandsClear = false;
            });
            $('.filter-by-type li').each(function () {
                let labelType = $(this).find('label span').html();
                let checkedType = $(this).find('input[type="checkbox"]').is(':checked');
                if( checkedType && type == labelType){
                    $(goods).show();
                }
                if(checkedType) allTypesClear = false;
            });
            
        });

        // if block is visible - calc block, if all checkbox are not checked - show block
        $('.goods-list-block').each(function () {
            if($(this).css('display') == 'block') {
                filterCount++;
                $(this).data('show',1);
            } else {
                $(this).data('show',0);
            }
            if(allBrandsClear && allTypesClear) {
                $(this).show();
                $(this).data('show',1);
            }
        });

        // if not any brands not any types selected
        if(allBrandsClear && allTypesClear) {
            $(this).html('<i class="fa fa-check"></i> Найти');
            catalogPagination();
            $('.catalog-view-pagination .btn-group .active:first').click();
            $('.catalog-view-pagination-block').show();
            initFilterByMinMaxPrice();
            let minPrice = $('.filter-block-price').find('#price-from').val();
            let maxPrice = $('.filter-block-price').find('#price-to').val();
            $( "#slider-range" ).slider( "option", "values", [ minPrice, maxPrice ]  );
        } else {
            $('.catalog-view-pagination-block').hide();
            $(this).html('<i class="fa fa-check"></i> Найдено: ' + filterCount);
        }

        
        

        /*let minPrice = $('.filter-block-price').find('#price-from').val();
        let maxPrice = $('.filter-block-price').find('#price-to').val();
        if (minPrice == '' || maxPrice == '') {
            return;
        } else {
            initFilterByMinMaxPrice();
            filterByMinMaxPrice(minPrice, maxPrice);
        }*/

        let minPrice = $('.filter-block-price').find('#price-from').val();
        let maxPrice = $('.filter-block-price').find('#price-to').val();
        if (minPrice == '' || maxPrice == '') {
            return;
        } else {
            initFilterByMinMaxPrice();
            let minPrice = $('.filter-block-price').find('#price-from').val();
            let maxPrice = $('.filter-block-price').find('#price-to').val();
            $( "#slider-range" ).slider( "option", "values", [ minPrice, maxPrice ]  );
            $("#amount").val( $("#slider-range").slider("values", 0) + " - " + $("#slider-range").slider("values", 1) + " руб.");
            /*filterByMinMaxPrice(minPrice, maxPrice);
            setSliderRange(minPrice, maxPrice);*/
        }

        // filter by max/min price and fill values of inputs
        
        var values = $( "#slider-range" ).slider( "option", "values" );
        //initFilterByMinMaxPrice();
        //filterByMinMaxPrice(values[0], values[1]);
        /*console.log(values);
        console.log(values[0]);
        console.log(values[1]);*/
        
    }); // end #btn-filter-apply click

    $('#btn-filter-cancel').click(function() {
        $('.goods-list-block').each(function () {
            $(this).show();
        });
        $('.filter-by-brand li').each(function () {
            $(this).find('input[type="checkbox"]').prop('checked', false);
        });
        $('.filter-by-type li').each(function () {
            $(this).find('input[type="checkbox"]').prop('checked', false);
        });
        $('#btn-filter-apply').html('<i class="fa fa-check"></i> Найти');
        catalogPagination();
        $('.catalog-view-pagination .btn-group .active:first').click();
        $('.catalog-view-pagination-block').show();
        initFilterByMinMaxPrice();
        let minPrice = $('.filter-block-price').find('#price-from').val();
        let maxPrice = $('.filter-block-price').find('#price-to').val();
        $( "#slider-range" ).slider( "option", "values", [ minPrice, maxPrice ]  );
        $('#btn-filter-apply').html('<i class="fa fa-check"></i> Найти');
    }); // end #btn-filter-cancel click
    
    // init filter buttons html
    $('.filter-by-brand li').find('input[type="checkbox"]').click(function() {
        $('#btn-filter-apply').html('<i class="fa fa-check"></i> Найти');
    });
    $('.filter-by-type li').find('input[type="checkbox"]').click(function() {
        $('#btn-filter-apply').html('<i class="fa fa-check"></i> Найти');
    });
    // init filter by max/min price
    $(function() {
        initFilterByMinMaxPrice();
        let minPrice = $('.filter-block-price').find('#price-from').val();
        let maxPrice = $('.filter-block-price').find('#price-to').val();
        $( "#slider-range" ).slider({
            range: true,
            min: 0,
            step: 10,
            max: maxPrice,
            values: [ minPrice, maxPrice ],
            slide: function( event, ui ) {
              $( "#amount" ).val( ui.values[ 0 ] + " - " + ui.values[ 1 ]  + " руб.");
            },
            change: function( event, ui ) {
                //console.log(ui.values[ 0 ] + ' - '+ ui.values[ 1 ]);
                //console.clear();
                let show = hide = 0;
                $('.goods-list-block').each(function () {
                    //let block = $(this);
                        
                        let price = $(this).find('.goods-price span').html();
                        let min = ui.values[ 0 ];
                        let max = ui.values[ 1 ];
                        
                        if( parseFloat(price) > parseFloat(min-10) 
                            && parseFloat(price) < parseFloat(max+10)
                            && $(this).data('show') == 1) {                           
                            $(this).show();
                            //console.log('show' + $(this).data('show'));
                            show++;
                        } else {
                            $(this).hide();
                            //console.log('hide' + $(this).data('show'));
                            hide++;
                        }
                        /*console.log($(this).css('display'));
                        console.log('goods-price span=' + $(this).find('.goods-price span').html());
    
                        console.log('price=' + price);
                        console.log('min=' + min);
                        console.log('max=' + max);*/
                    
                });
                //console.log('show=' + show);
                //console.log('hide=' + hide);
                $('#btn-filter-apply').html('<i class="fa fa-check"></i> Найдено: ' + show);
            }
        });
        $("#amount").val( $("#slider-range").slider("values", 0) + " - " + $("#slider-range").slider("values", 1) + " руб.");
    });
    $('.filter-block-price').find('#price-from').change(function() {
        $('#btn-filter-apply').html('<i class="fa fa-check"></i> Найти');
    });
    $('.filter-block-price').find('#price-to').change(function() {
        $('#btn-filter-apply').html('<i class="fa fa-check"></i> Найти');
    });

    // Yandex Metrika / goal - new invoice
    $('#cart-order-form').on('submit', function() {
        ym(51001274, 'reachGoal', 'invoice'); 
        return true;
    });


    // admin module
    
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

    //  admin/goods: fast goods search
    $('#search-goods-input').keyup(function() {
        let _this = $(this);
        $.each($(".tovar-block"), function() {
            if($(this).text().toLowerCase().indexOf($(_this).val().toLowerCase()) === -1) {
                $(this).hide();
            } else {
                $(this).show();                
            };
        });
    });

    //  admin/clients: fast client search
    $('#admin-clients-search-input').keyup(function() {
        let _this = $(this);
        //console.clear();
        $.each($(".client-block"), function() {
            console.log($(this).text().toLowerCase().indexOf($(_this).val().toLowerCase()));
            if($(this).text().toLowerCase().indexOf($(_this).val().toLowerCase()) === -1) {
                $(this).closest('.client-block').hide();
                //console.log('hide = ' + $(this).html()); // don't work without
                //return false;
            } else {
                $(this).closest('.client-block').show(); 
                //alert($(this).closest('.client-block').html());
                //console.log('show = ' + $(this).html()); // don't work without     
                //return true; 
            }
        });
    });

    //  admin/orders: fast order search
    $('#admin-order-search-input').keyup(function() {
        let _this = $(this);
        $.each($("table tbody tr"), function() {
            if($(this).text().toLowerCase().indexOf($(_this).val().toLowerCase()) === -1) {
                $(this).hide();
                //console.log('hide = ' + $(this).html()); // don't work without
            } else {
                $(this).show(); 
                //console.log('show = ' + $(this).html()); // don't work without 
            }
        });
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
    /*$('#search #admin-clients-search-input').keyup(function(){
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
    });*/
            
/* read cart from cookies https://itchief.ru/lessons/javascript/javascript-working-with-cookies */

        /*
        
    +DORS 10 -$23;
? DORS 10  лупа автономная - $23; 
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
    +DORS 1200 - $180;
    +DORS 1250 М1 (+Антистокс, МГ) - $245;
    +DORS 1300 M2 (+Антистокс-контроль (iAS), МГ, 20х) - $480;
    +DORS 1010 -  $56;
    +DORS 1020 - $80;
    +DORS CT 2015  NEW - 5 650р ;
    +DORS CT 2015  с АКБ NEW - 6 330р.;
    +DORS 210 RUB  (iAS, CIS, МГ, ИК, УФ) - 9 800р.
    +DORS 210 RUB Compact  (iAS, CIS, МГ, ИК, УФ)    NEW - 9 800р.

    +(опция) Программатор для  DORS 210 - $30
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

    + https://deep2000.ru/oborudovanie/detektory_valut/PF%209007.html  ( 510 $)

    +https://deep2000.ru/oborudovanie/detektory_valut/md8000.html ( 250 $)

    +https://deep2000.ru/oborudovanie/detektory_valut/pf_9000.html (490 $)

    +https://deep2000.ru/oborudovanie/detektory_valut/ird_2200.html ( 90$)

    +https://deep2000.ru/oborudovanie/detektory_valut/ird-1000.html  (78 $)


Счетчики и сортировщики монет:

+ цена ? https://deep2000.ru/oborudovanie/obrabotka_monet/Zebra.html  (

    +https://deep2000.ru/oborudovanie/obrabotka_monet/schetchik-i-sortirovshchik-monet-zebra-301.html ( 4300 $)

    +https://deep2000.ru/oborudovanie/obrabotka_monet/pelican_301.html (2400 $)

    +https://deep2000.ru/oborudovanie/obrabotka_monet/schetchik-monet-cs-2000.html (450 $)

    +https://deep2000.ru/oborudovanie/obrabotka_monet/cs-100.html (240 $)


Счетчики банкнот:

    +DORS CT1015 - $85 - http://dors.com/catalog/dors-ct1015/#specs
    +DORS CT1040 - $114 - http://dors.com/catalog/dors-ct1040/
    +DORS CT1040U - $122 - http://dors.com/catalog/dors-ct1040/
    +DORS CT1040UM - $140  - http://dors.com/catalog/dors-ct1040/ 
    +DORS 600  - $177 - http://dors.com/catalog/dors-600/ 
    +DORS 620  с функцией АS - $220  - http://dors.com/catalog/dors-620/ 
    +DORS 700 -  $295 - http://dors.com/catalog/dors-700/ 
    +DORS 750 -  $530  - http://dors.com/catalog/dors-750/#description 
    +Magner 35-2003 - $410 -  http://dors.com/catalog/magner-35/ 
    +Magner 35 S - $472 - http://dors.com/catalog/magner-35s/ 
    +Magner 75 D - $594 - http://dors.com/catalog/magner-75d-ud/
    +Magner 75 UD - $725 - http://dors.com/catalog/magner-75d-ud/ 
    +Magner 100 - $1 340 - http://dors.com/catalog/magner-100/

Сортировщики банкнот:

    +DORS 800 RUB -  $ 757 - http://dors.com/catalog/dors-800/
    +DORS 800 RUB/USD/EUR - $ 802  - http://dors.com/catalog/dors-800/
    +DORS 800 Multi (5 валют) - $847 - http://dors.com/catalog/dors-800/ 
    +Magner 150 Digital  - 1250$. -http://dors.com/catalog/magner-150/
    +Magner 175 - $1 690 - http://dors.com/catalog/magner-175/ 

    */