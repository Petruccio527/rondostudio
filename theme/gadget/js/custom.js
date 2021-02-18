jQuery( document ).ready(function( $ ) {


	"use strict";

		lightbox.option({
	      'resizeDuration': 200,
	      'wrapAround': true
	    })
		

		$(window).load(function() { // makes sure the whole site is loaded
		    $("#status").fadeOut(); // will first fade out the loading animation
		    $("#preloader").delay(800).fadeOut("slow"); // will fade out the white DIV that covers the website.
		})


		$('.filters ul li').on('click', function(){
		  $('.filters ul li').removeClass('active');
		  $(this).addClass('active');
		  
		  var data = $(this).attr('data-filter');
		  $grid.isotope({
		    filter: data
		  })
		});

		var $grid = $('.grid');

		$grid.imagesLoaded( function() {
			$grid.isotope({
				itemSelector: ".all",
				percentPosition: true,
				masonry: {
					columnWidth: ".all"
				}
			});
		});


        
	    $('.owl-carousel').owlCarousel({
		nav:false,
		autoplay:true,
		autoplayTimeout:12000,
		autoplayHoverPause:false,
		items:1,
		loop:true,
		margin:10

		});



		/************** Toggle *********************/
		// Cache selectors
		
		if(window.location.pathname === "/s"){
			var lastId,
				topMenu = $(".menu-first"),
				topMenuHeight = 100,
				// All list items
				menuItems = topMenu.find("a"),
				// Anchors corresponding to menu items
				scrollItems = menuItems.map(function(){
				
				if($(this).hasClass('external')) {
					return;
				}
					
				var item = $($(this).attr("href"));
				if (item.length) { return item; }
				});

			// Bind click handler to menu items
			// so we can get a fancy scroll animation

				menuItems .on('click', function(e){
				var href = $(this).attr("href"),
					offsetTop = href === "#" ? 0 : $(href).offset().top-topMenuHeight+1;
				$('html, body').stop().animate({ 
					scrollTop: offsetTop
				}, 750);
				e.preventDefault();
				});

				// Bind to scroll
				$(window).scroll(function(){
				// Get container scroll position
				var fromTop = $(this).scrollTop()+topMenuHeight;
				
				// Get id of current scroll item
				var cur = scrollItems.map(function(){
					if ($(this).offset().top < fromTop)
					return this;
				});
				// Get the id of the current element
				cur = cur[cur.length-1];
				var id = cur && cur.length ? cur[0].id : "";
				
				if (lastId !== id) {
					lastId = id;
					// Set/remove active class
					menuItems
						.parent().removeClass("active")
						.end().filter("[href=#"+id+"]").parent().addClass("active");
				}                   
			});
		}


	    $(window).scroll(function(){
	         $('.main-header').toggleClass('scrolled', $(this).scrollTop() > 80);
	     });


	    $(window).scroll(function(){
	         $('.back-to-top').toggleClass('back-to-top-visible', $(this).scrollTop() > 1000);
	     });



	    $('a[href="#top"]').on('click', function(){
	        $('html, body').animate({scrollTop: 0}, 'slow');
	        return false;
	    });


	    $('.toggle-menu').on('click', function(){
	        $('.menu-first').toggleClass('show');
	        // $('.menu-first').slideToggle();
	    });

	    $('.menu-first li a').on('click', function(){
	      $('.menu-first').removeClass('show');
	    });

		if(window.location.pathname === "/"){
			$('a[href*=#]').on('click', function(e) {
			e.preventDefault();
			$('html, body').animate({ scrollTop: $($(this).attr('href')).offset().top -99 }, 800, 'linear');
			});
		}
 
 
});
