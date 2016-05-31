/**
 * Theme javascript functions file.
 *
 */
( function( a ) {
	"use strict";

	var  
        body = a("body"),
		container = a(".projects"),
        b       = a(".site-header"),
		active = ("js--active"),
		formContainer = a(".formContainer"),
		o = a('.projects'),
        j       = a("#site-search"),
        preload = ('js--preload'),
		dur = 200;

    /* Adds SVG targets to the social navigation */ 
    function social_svg()  {
        var social = [
        '500px', 
        'bandsintown', 
        'behance', 
        'codepen', 
        'dribbble', 
        'dropbox',
        'email', 
        'facebook', 
        'flickr', 
        'foursquare', 
        'github', 
        'googleplay',
        'google', 
        'houzz', 
        'instagram', 
        'itunes', 
        'linkedin',
        'medium',
        'meetup', 
        'pinterest', 
        'rdio', 
        'reddit', 
        'rss',
        'smugmug',
        'soundcloud', 
        'spotify', 
        'squarespace', 
        'stumbleupon', 
        'tumblr',
        'twitch',
        'twitter', 
        'vevo', 
        'vimeo', 
        'vine', 
        'vsco',
        'yelp', 
        'youtube',
        ];  

        social.forEach(function(icon) {
            a('a[href*="' + icon + '"] svg use').each(function() {
                a(this).attr("xlink:href", a(this).attr("xlink:href") + '#' + icon + "-mask");
            });
        });
    }

	/* fitVids */
	a("body").fitVids();

	/* Loading Progress Bar */ 
	NProgress.configure({
	     minimum: .7,
	     showSpinner: !1
	}),
		       
	document.onreadystatechange = function () {
		if (document.readyState == "interactive") {
	    		NProgress.start();
		}
	}

	var everythingLoaded = setInterval(function() {
		if (/loaded|complete/.test(document.readyState)) {
			clearInterval(everythingLoaded);
			setTimeout(function(){NProgress.done()},1000);
		}
	}, 10);

    function scrollingDiv() {
        var 
        $window = a(window),
        windowHeight    = a(window).height(),
        sidebarSection  = a(".sidebar--section"),
        scroll          = ("js--scroll");

        if($window.width() > 768) {
            sidebarSection.children().each(function(){
                if ( windowHeight < a(this).innerHeight() ) {
                    a(this).parent().addClass(scroll);
                } else {
                    a(this).parent().removeClass(scroll);
                }
            });
        }
    }

	/* Document Ready */
	a(document).ready(function() {
        scrollingDiv();
        social_svg();
        b();

        var projects = a(".projects"),
            k = document.getElementById("close-button"),
            l = a(k),
            m = !1,
            p = ( a(".project"), a("#modal") ),
            q = a("#modal-content"),
            r = a("#loading"),
            s = a(".post-edit-link");

        function b() {
            a(".video").fitVids();
        }

        function d() {
            m = !0, body.addClass("modal-open"), p.animate({
                scrollTop: 0
            }, 300), p.addClass("modal--show"), r.addClass("loading--show"), q.addClass("modal-content--show")
        }

        function e() {
            m = !1,
            setTimeout(function() {
                q.html(""), l.removeClass("button--close--show"), q.removeClass("modal-content--show"), body.removeClass("modal-open"), p.css("-webkit-overflow-scrolling", "auto"), p.removeClass("modal--show")
            }, 400)
        }

        function f() {
            r.removeClass("loading--show"), q.find(".type-portfolio").addClass("project--show"), l.addClass("button--close--show"), setTimeout(function() {
                p.css("-webkit-overflow-scrolling", "touch")
            }, 300)
        }

        function g() {
            d(), setTimeout(function() {
                q.find(".type-portfolio").removeClass("project--show"), setTimeout(function() {
                    q.html("")
                }, 400)
            }, 300), l.removeClass("button--close--show"), r.addClass("loading--show")
        }

        function h(b) {
            a.get(b, function(b) {
                var c = a(b).find(".project");
                 setTimeout(function() {
                   f()
                }, 200)
            })
        }

        a( '#modal-close' ).on( 'click', function() {
            e();
        }), 

        a( '#close-button' ).on( 'click', function() {
            e();
        });

        if( body.hasClass('modal-active') ) {
            projects.on("click", ".project a", function(b) {

                if( !a(this).hasClass('project--link_external') ) {
                    b.preventDefault(), history.pushState(null, null, this.href), d(), h(a(this).attr("href"))
                }
                
            });
        };

        /* Load posts via AJAX */
        if( body.hasClass('modal-active') ) {
            a(".project a").click(function(event) {
                if( !a(this).hasClass('project--link_external') ) {

                    event.preventDefault();

                    a("#loading-body").show();
                    var post_id = a(this).data("id");
                    var ajaxURL = site.ajaxurl;

                    a.ajax({
                        type: 'POST',
                        url: ajaxURL,
                        data: {"action": "load-content", post_id: post_id },
                        success: function(response) {
                            a("#modal-content").html(response);
                            a("#loading-body").hide();
                        return false;
                        }
                    });
                }
            });
        };

	    /* Enable menu toggle for small screens */ 
        a( '.mobile-menu-toggle' ).on( 'click', function() {
                body.toggleClass( 'nav-open' );
        } );

        a( '#nav-close' ).on( 'click', function() {
                body.toggleClass( 'nav-open' );
        } );
	}),

    /* Resize functions */ 
    a(window).resize(function(){
         scrollingDiv();
    });

} )( jQuery );