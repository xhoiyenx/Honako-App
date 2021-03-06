! function(o, t) {
    ! function(o) {
        "use strict";
        var t = function(t) {
            var a = this;
            a.options = t, a.$window = o(window), a.$document = o(document), a.isMobile = /Android|iPhone|iPad|iPod|BlackBerry|Windows Phone/g.test(navigator.userAgent || navigator.vendor || window.opera), a.$preloader = o(".page-preloader"), a.$content = o(".content"), a.$navbar = o(".navbar-youplay"), a.$navbarToggleBtn = a.$navbar.find("[data-toggle=off-canvas]"), a.$navbarToggleTarget = a.$navbar.find(a.$navbarToggleBtn.attr("data-target")), a.navbarSmall = !1, a.navbarMaxTop = 100, a.$searchToggle = o(".search-toggle"), a.$searchBlock = o(".search-block"), a.$inputs = o("input, textarea"), a.$ajaxForm = o(".youplay-form-ajax"), a.$accordions = o(".youplay-accordion"), a.$carousels = o(".youplay-carousel"), a.$sliders = o(".youplay-slider"), a.$owlCarousel = o(".owl-carousel"), a.$imagePopup = o(".image-popup"), a.$galleryPopup = o(".gallery-popup"), a.$videoPopup = o(".video-popup"), a.$revSlider = o(".rs-youplay"), a.$isotope = o(".isotope"), a.skrollr
        };
        t.DEFAULT = {
            parallax: !0,
            navbarSmall: !1,
            fadeBetweenPages: !0
        }, t.prototype.init = function(t) {
            function a() {
                e.options.navbarSmall || (e.options.navbarSmall = e.$navbar.hasClass("navbar-small")), e.options.fadeBetweenPages && e.fadeBetweenPages(), o('[data-toggle="tooltip"]').tooltip({
                    container: "body"
                }), o('[data-toggle="popover"]').popover(), "undefined" != typeof o.fn.owlCarousel && e.initOwlCarousel(), "undefined" != typeof o.fn.magnificPopup && e.initMagnificPopup(), "undefined" != typeof o.fn.revolution && e.initSliderRevolution(), "undefined" != typeof o.fn.isotope && e.initIsotope(), "undefined" !== o.fn.hexagonProgress && e.initHexagonRating(), e.navbarCollapse(), e.options.navbarSmall || (e.$window.on("scroll", function(o) {
                    e.navbarSize(e.$window.scrollTop())
                }), e.navbarSize(e.$window.scrollTop())), e.navbarSubmenuFix(), e.$searchToggle.on("click", function(o) {
                    o.preventDefault(), e.searchToggle()
                }), e.$document.on("keyup", function(o) {
                    27 == o.keyCode && e.searchToggle("close")
                }), e.$inputs.on("focus", function() {
                    e.inputsActive(this, !0)
                }), e.$inputs.on("blur", function() {
                    e.inputsActive(this)
                }), e.$inputs.filter("[autofocus]:eq(0)").focus(), e.initAjaxForm(), e.$accordions.find(".collapse").on("shown.bs.collapse", function() {
                    o(this).parent().find(".icon-plus").removeClass("icon-plus").addClass("icon-minus"), e.refresh()
                }).on("hidden.bs.collapse", function() {
                    o(this).parent().find(".icon-minus").removeClass("icon-minus").addClass("icon-plus"), e.refresh()
                }), e.options.parallax && !e.isMobile && "undefined" != typeof skrollr && (e.skrollr = skrollr.init({
                    smoothScrolling: !1,
                    forceHeight: !1
                }))
            }
            var e = this;
            e.options = o.extend({}, this.options, t), e.$preloader.length ? o(window).on("load", function() {
                a(), setTimeout(function() {
                    e.$preloader.fadeOut(function() {
                        o(this).find("> *").remove()
                    })
                }, 200)
            }) : (a(), o(window).on("load", function() {
                e.refresh()
            }))
        }, t.prototype.refresh = function() {
            this.skrollr && this.skrollr.refresh()
        }, t.prototype.initOwlCarousel = function() {
            this.$carousels.each(function() {
                var t = o(this).attr("data-autoplay");
                o(this).owlCarousel({
                    loop: !0,
                    stagePadding: 70,
                    nav: !0,
                    dots: !1,
                    autoplay: !!t,
                    autoplayTimeout: t,
                    autoplaySpeed: 600,
                    autoplayHoverPause: !0,
                    navText: ["", ""],
                    responsive: {
                        0: {
                            items: 1
                        },
                        500: {
                            items: 2
                        },
                        992: {
                            items: 3
                        },
                        1200: {
                            items: 4
                        }
                    }
                })
            }), this.$sliders.each(function() {
                var t = o(this).attr("data-autoplay");
                o(this).owlCarousel({
                    loop: !0,
                    nav: !1,
                    autoplay: t ? !0 : !1,
                    autoplayTimeout: t,
                    autoplaySpeed: 600,
                    autoplayHoverPause: !0,
                    items: 1
                })
            }), this.$owlCarousel.each(function() {
                var t = o(this).attr("data-autoplay");
                o(this).owlCarousel({
                    loop: !0,
                    dots: !0,
                    autoplay: !!t,
                    autoplayTimeout: t,
                    autoplaySpeed: 600,
                    autoplayHoverPause: !0,
                    responsive: {
                        0: {
                            items: 3
                        },
                        500: {
                            items: 4
                        },
                        992: {
                            items: 5
                        },
                        1200: {
                            items: 6
                        }
                    }
                })
            })
        }, t.prototype.initMagnificPopup = function() {
            var t = {
                closeOnContentClick: !0,
                closeBtnInside: !1,
                fixedContentPos: !1,
                mainClass: "mfp-no-margins mfp-img-mobile mfp-with-fade",
                tLoading: '<div class="preloader"></div>',
                removalDelay: 300,
                image: {
                    verticalFit: !0,
                    tError: '<a href="%url%">The image #%curr%</a> could not be loaded.'
                }
            };
            this.$imagePopup.magnificPopup(o.extend({
                type: "image"
            }, t)), this.$videoPopup.magnificPopup(o.extend({
                type: "iframe"
            }, t)), this.$galleryPopup.magnificPopup(o.extend({
                delegate: ".owl-item:not(.cloned) a",
                type: "image",
                gallery: {
                    enabled: !0,
                    navigateByImgClick: !0,
                    preload: [0, 1]
                },
                callbacks: {
                    elementParse: function(o) {
                        var t = /youtube.com|youtu.be|vimeo.com/g.test(o.src);
                        t ? o.type = "iframe" : o.type = "image"
                    }
                }
            }, t))
        }, t.prototype.initSliderRevolution = function() {
            var t = this;
            t.$revSlider.each(function() {
                var a = o(this),
                    e = {
                        dottedOverlay: "none",
                        navigationType: "bullet",
                        navigationArrows: "solo",
                        navigationStyle: "preview4",
                        fullWidth: a.hasClass("rs-fullwidth") ? "on" : "off",
                        fullScreen: a.hasClass("rs-fullscreen") ? "on" : "off",
                        spinner: "spinner4"
                    },
                    n = a.find(".tp-banner").show().revolution(e);
                n.on("revolution.slide.onloaded", function() {
                    t.refresh()
                })
            })
        }, t.prototype.initIsotope = function() {
            var t = this;
            t.$isotope.each(function() {
                var a = o(this).find(".isotope-list"),
                    e = o(this).find(".isotope-options");
                a.isotope({
                    layoutMode: "fitRows",
                    itemSelector: ".item"
                }), a.isotope("on", "arrangeComplete", function() {
                    t.refresh()
                }), a.isotope("on", "layoutComplete", function() {
                    t.refresh()
                }), e.on("click", "> :not(.active)", function(t) {
                    o(this).addClass("active").siblings().removeClass("active");
                    var e = o(this).attr("data-filter");
                    t.preventDefault(), a.isotope({
                        filter: function() {
                            if ("all" === e) return !0;
                            var t = o(this).attr("data-filters");
                            if (t) {
                                t = t.split(",");
                                for (var a in t)
                                    if (t[a].replace(/\s/g, "") === e) return !0
                            }
                            return !1
                        }
                    })
                })
            }), setTimeout(function() {
                t.refresh()
            }, 1e3)
        }, t.prototype.fadeBetweenPages = function() {
            var t = this;
            t.$document.on("click", 'a:not(.no-fade):not(.search-toggle):not(.image-popup):not([target="_blank"]):not(.btn):not(.button):not([href*=#]):not([href^=mailto]):not([href^="javascript:"])', function(a) {
                if (!o(this).parents(".gallery-popup:eq(0)").length && o(this).attr("href")) {
                    var e = this.href;
                    e && (a.preventDefault(), t.$preloader.fadeIn(500, function() {
                        window.location.href = e
                    }))
                }
            })
        }, t.prototype.navbarSize = function(o) {
            o > this.navbarMaxTop && !this.navbarSmall && (this.navbarSmall = !0, this.$navbar.addClass("navbar-small")), o <= this.navbarMaxTop && this.navbarSmall && (this.navbarSmall = !1, this.$navbar.removeClass("navbar-small"))
        }, t.prototype.navbarCollapse = function() {
            var o = this;
            o.$navbarToggleBtn.on("click", function() {
                var t = o.$navbarToggleTarget.hasClass("collapse");
                o.$navbarToggleTarget[(t ? "remove" : "add") + "Class"]("collapse"), o.$navbar[(t ? "add" : "remove") + "Class"]("youplay-navbar-collapsed")
            });
            var t;
            o.$window.on("resize", function() {
                o.$navbar.addClass("no-transition"), clearTimeout(t), t = setTimeout(function() {
                    o.$navbar.removeClass("no-transition")
                }, 50)
            }), o.$document.on("click", ".youplay-navbar-collapsed ~ .content-wrap", function() {
                o.$navbarToggleBtn.click()
            })
        }, t.prototype.navbarSubmenuFix = function() {
            this.$navbar.on("click", ".dropdown-menu .dropdown-toggle", function(t) {
                o(this).parent(".dropdown").toggleClass("open"), t.preventDefault(), t.stopPropagation()
            })
        }, t.prototype.initAjaxForm = function() {
            this.$ajaxForm.on("submit", function(t) {
                t.preventDefault();
                var a = o(this),
                    e = a.find('[type="submit"]');
                e.is(".disabled") || e.is("[disabled]") || o.post(o(this).attr("action"), o(this).serialize(), function(o, t) {
                    swal({
                        type: "success",
                        title: "Success!",
                        text: o,
                        showConfirmButton: !0,
                        confirmButtonClass: "btn-default"
                    }), a[0].reset()
                }).fail(function(o) {
                    swal({
                        type: "error",
                        title: "Error!",
                        text: o.responseText,
                        showConfirmButton: !0,
                        confirmButtonClass: "btn-default"
                    })
                })
            })
        }, t.prototype.searchToggle = function(o) {
            var t = this,
                a = t.$searchBlock.hasClass("active");
            "close" == o && !a || "open" == o && a || (a ? t.$searchBlock.removeClass("active") : (t.$searchBlock.addClass("active"), setTimeout(function() {
                t.$searchBlock.find("input").focus()
            }, 120)))
        }, t.prototype.inputsActive = function(t, a) {
            a ? o(t).parent().addClass("input-filled") : o(t).parent().removeClass("input-filled")
        }, t.prototype.initHexagonRating = function() {
            o(".youplay-hexagon-rating:not(.youplay-hexagon-rating-ready)").each(function() {
                var t = parseFloat(o(this).attr("data-max")) || 10,
                    a = parseFloat(o(this).text()) || 0,
                    e = parseFloat(o(this).attr("data-size")) || 120,
                    n = o(this).attr("data-back-color") || "rgba(255,255,255,0.1)",
                    i = o(this).attr("data-front-color") || "#fff";
                o(this).css({
                    width: e,
                    height: e
                }).hexagonProgress({
                    value: a / t,
                    size: e,
                    animation: !1,
                    startAngle: 61 * Math.PI / 180,
                    lineWidth: 2,
                    clip: !0,
                    lineBackFill: {
                        color: n
                    },
                    lineFrontFill: {
                        color: i
                    }
                }), o(this).addClass("youplay-hexagon-rating-ready")
            })
        }, window.youplay = new t(t.DEFAULT)
    }(jQuery), t["true"] = o
}({}, function() {
    return this
}());