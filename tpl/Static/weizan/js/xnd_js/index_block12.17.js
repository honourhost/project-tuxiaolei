! function(t, e) {
	var n = function() {
		function n(e, n) {
			"dot" == e ? (n = '<ol class="dots">', t.each(i.li, function(t) {
				n += '<li class="' + (t == i.i ? e + " active" : e) + '">' + ++t + "</li>"
			}), n += "</ol>") : (n = '<div class="', n = n + e + 's">' + n + e + ' prev">' + i.o.prev + "</div>" + n + e + ' next">' + i.o.next + "</div></div>"), i.el.addClass("has-" + e + "s").append(n).find("." + e).click(function() {
				var e = t(this);
				e.hasClass("dot") ? i.stop().to(e.index()) : e.hasClass("prev") ? i.prev() : i.next()
			})
		}
		var i = this;
		i.o = {
			speed: 500,
			delay: 3e3,
			init: 0,
			pause: !e,
			loop: !e,
			keys: e,
			dots: e,
			arrows: e,
			prev: "&larr;",
			next: "&rarr;",
			fluid: e,
			starting: e,
			complete: e,
			items: ">ul",
			item: ">li",
			easing: "swing",
			autoplay: !0
		}, i.init = function(e, o) {
			i.o = t.extend(i.o, o), i.el = e, i.ul = e.find(i.o.items), i.max = [0 | e.outerWidth(), 0 | e.outerHeight()], i.li = i.ul.find(i.o.item).each(function(e) {
				var n = t(this),
					o = n.outerWidth(),
					a = n.outerHeight();
				o > i.max[0] && (i.max[0] = o), a > i.max[1] && (i.max[1] = a)
			});
			var o = i.o,
				a = i.ul,
				r = i.li,
				s = r.length;
			return i.i = 0, e.css({
				width: i.max[0],
				height: r.first().outerHeight(),
				overflow: "hidden"
			}), a.css({
				position: "relative",
				left: 0,
				width: 100 * s + "%"
			}), o.fluid ? r.css({
				"float": "left",
				width: 100 / s + "%"
			}) : r.css({
				"float": "left",
				width: i.max[0] + "px"
			}), o.autoplay && setTimeout(function() {
				0 | o.delay && (i.play(), o.pause && e.on("mouseover mouseout", function(t) {
					i.stop(), "mouseout" == t.type && i.play()
				}))
			}, 0 | o.init), o.keys && t(document).keydown(function(t) {
				var e = t.which;
				37 == e ? i.prev() : 39 == e ? i.next() : 27 == e && i.stop()
			}), o.dots && n("dot"), o.arrows && n("arrow"), o.fluid && t(window).resize(function() {
				i.r && clearTimeout(i.r), i.r = setTimeout(function() {
					var t = {
							height: r.eq(i.i).outerHeight()
						},
						n = e.outerWidth();
					a.css(t), t.width = Math.min(Math.round(n / e.parent().width() * 100), 100) + "%", e.css(t), r.css({
						width: n + "px"
					})
				}, 50)
			}).resize(), (t.event.special.move || t.Event("move")) && e.on("movestart", function(t) {
				t.distX > t.distY && t.distX < -t.distY || t.distX < t.distY && t.distX > -t.distY ? t.preventDefault() : e.data("left", i.ul.offset().left / e.width() * 100)
			}).on("move", function(t) {
				var n = 100 * t.distX / e.width();
				i.ul.css("left", e.data("left") + n + "%"), i.ul.data("left", n)
			}).on("moveend", function(t) {
				var e = i.ul.data("left");
				if (Math.abs(e) > 30) {
					var n = e > 0 ? i.i - 1 : i.i + 1;
					(0 > n || n >= s) && (n = i.i), i.to(n)
				} else i.to(i.i)
			}), i
		}, i.to = function(n, o) {
			i.t && (i.stop(), i.play());
			var a = i.o,
				r = i.el,
				s = i.ul,
				l = i.li,
				c = i.i,
				f = l.eq(n);
			if (t.isFunction(a.starting) && !o && a.starting(r, l.eq(c)), f.length && !(0 > n) || a.loop != e) {
				f.length || (n = 0), 0 > n && (n = l.length - 1), f = l.eq(n);
				var d = o ? 5 : 0 | a.speed,
					h = a.easing,
					u = {
						height: f.outerHeight()
					};
				s.queue("fx").length || (r.find(".dot").eq(n).addClass("active").siblings().removeClass("active"), r.animate(u, d, h) && s.animate(t.extend({
					left: "-" + n + "00%"
				}, u), d, h, function(e) {
					i.i = n, t.isFunction(a.complete) && !o && a.complete(r, f)
				}))
			}
		}, i.play = function() {
			i.t = setInterval(function() {
				i.to(i.i + 1)
			}, 0 | i.o.delay)
		}, i.stop = function() {
			return i.t = clearInterval(i.t), i
		}, i.next = function() {
			return i.stop().to(i.i + 1)
		}, i.prev = function() {
			return i.stop().to(i.i - 1)
		}
	};
	t.fn.unslider = function(e) {
		var i = this.length;
		return this.each(function(o) {
			var a = t(this),
				r = "unslider" + (i > 1 ? "-" + ++o : ""),
				s = (new n).init(a, e);
			a.data(r, s).data("key", r)
		})
	}, n.version = "1.0.0"
}(jQuery, !1),
function(t, e, n, i) {
	var o = t(e);
	t.fn.lazyload = function(a) {
		function r() {
			var e = 0;
			l.each(function() {
				var n = t(this);
				if (!c.skip_invisible || n.is(":visible"))
					if (t.abovethetop(this, c) || t.leftofbegin(this, c));
					else if (t.belowthefold(this, c) || t.rightoffold(this, c)) {
					if (++e > c.failure_limit) return !1
				} else n.trigger("appear"), e = 0
			})
		}
		var s, l = this,
			c = {
				threshold: 0,
				failure_limit: 0,
				event: "scroll",
				effect: "show",
				container: e,
				data_attribute: "original",
				skip_invisible: !1,
				appear: null,
				load: null,
				placeholder: "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAYAAAAfFcSJAAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAAJcEhZcwAADsQAAA7EAZUrDhsAAAANSURBVBhXYzh8+PB/AAffA0nNPuCLAAAAAElFTkSuQmCC"
			};
		return a && (i !== a.failurelimit && (a.failure_limit = a.failurelimit, delete a.failurelimit), i !== a.effectspeed && (a.effect_speed = a.effectspeed, delete a.effectspeed), t.extend(c, a)), s = c.container === i || c.container === e ? o : t(c.container), 0 === c.event.indexOf("scroll") && s.bind(c.event, function() {
			return r()
		}), this.each(function() {
			var e = this,
				n = t(e);
			e.loaded = !1, (n.attr("src") === i || n.attr("src") === !1) && n.is("img") && n.attr("src", c.placeholder), n.one("appear", function() {
				if (!this.loaded) {
					if (c.appear) {
						var i = l.length;
						c.appear.call(e, i, c)
					}
					t("<img />").bind("load", function() {
						var i = n.attr("data-" + c.data_attribute);
						n.hide(), n.is("img") ? n.attr("src", i) : n.css("background-image", "url('" + i + "')"), n[c.effect](c.effect_speed), e.loaded = !0;
						var o = t.grep(l, function(t) {
							return !t.loaded
						});
						if (l = t(o), c.load) {
							var a = l.length;
							c.load.call(e, a, c)
						}
					}).attr("src", n.attr("data-" + c.data_attribute))
				}
			}), 0 !== c.event.indexOf("scroll") && n.bind(c.event, function() {
				e.loaded || n.trigger("appear")
			})
		}), o.bind("resize", function() {
			r()
		}), /(?:iphone|ipod|ipad).*os 5/gi.test(navigator.appVersion) && o.bind("pageshow", function(e) {
			e.originalEvent && e.originalEvent.persisted && l.each(function() {
				t(this).trigger("appear")
			})
		}), t(n).ready(function() {
			r()
		}), this
	}, t.belowthefold = function(n, a) {
		var r;
		return r = a.container === i || a.container === e ? (e.innerHeight ? e.innerHeight : o.height()) + o.scrollTop() : t(a.container).offset().top + t(a.container).height(), r <= t(n).offset().top - a.threshold
	}, t.rightoffold = function(n, a) {
		var r;
		return r = a.container === i || a.container === e ? o.width() + o.scrollLeft() : t(a.container).offset().left + t(a.container).width(), r <= t(n).offset().left - a.threshold
	}, t.abovethetop = function(n, a) {
		var r;
		return r = a.container === i || a.container === e ? o.scrollTop() : t(a.container).offset().top, r >= t(n).offset().top + a.threshold + t(n).height()
	}, t.leftofbegin = function(n, a) {
		var r;
		return r = a.container === i || a.container === e ? o.scrollLeft() : t(a.container).offset().left, r >= t(n).offset().left + a.threshold + t(n).width()
	}, t.inviewport = function(e, n) {
		return !(t.rightoffold(e, n) || t.leftofbegin(e, n) || t.belowthefold(e, n) || t.abovethetop(e, n))
	}, t.extend(t.expr[":"], {
		"below-the-fold": function(e) {
			return t.belowthefold(e, {
				threshold: 0
			})
		},
		"above-the-top": function(e) {
			return !t.belowthefold(e, {
				threshold: 0
			})
		},
		"right-of-screen": function(e) {
			return t.rightoffold(e, {
				threshold: 0
			})
		},
		"left-of-screen": function(e) {
			return !t.rightoffold(e, {
				threshold: 0
			})
		},
		"in-viewport": function(e) {
			return t.inviewport(e, {
				threshold: 0
			})
		},
		"above-the-fold": function(e) {
			return !t.belowthefold(e, {
				threshold: 0
			})
		},
		"right-of-fold": function(e) {
			return t.rightoffold(e, {
				threshold: 0
			})
		},
		"left-of-fold": function(e) {
			return !t.rightoffold(e, {
				threshold: 0
			})
		}
	})
}(jQuery, window, document), $(function() {
	require(["web_qui_quiautocomplete"], function(t) {
		function e() {
			var t = 6,
				e = 0,
				o = "<ul>",
				a = i(),
				r = n();
			return o += a.join(""), e = a.length, r = r.slice(0, t - e), o += r.join(""), o += "</ul>"
		}

		function n() {
			var t = [];
			return t.push('<li><a href="" data-bn-ipg="zsj-search-hot"><em>热门搜索</em><span class="name">农家宴</span></a></li>'), t.push('<li><a href="" data-bn-ipg="zsj-search-hot"><em>热门搜索</em><span class="name">生态农场</span></a></li>'), t.push('<li><a href="" data-bn-ipg="zsj-search-hot"><em>热门搜索</em><span class="name">养殖场</span></a></li>'), t.push('<li><a href="" data-bn-ipg="zsj-search-hot"><em>热门搜索</em><span class="name">有机蔬菜</span></a></li>'), t.push('<li><a href="" data-bn-ipg="zsj-search-hot"><em>热门搜索</em><span class="name">羊肉</span></a></li>'),  t
		}

		function i() {
			for (var t = [], e = a(), n = "", i = "", o = 0; o < e.length && (n = e[o].val, i = "" === e[o].url ? "/?action=list&_type=search&zfrom=header&kw=" + encodeURIComponent(n) : e[o].url, t.push('<li><a href="' + i + '" data-bn-ipg="zsj-search-history"><em>历史记录</em><span class="zwui-iconfont icon-clock"></span><span class="name">' + n + "</span></a></li>"), 2 != o); o++);
			return t
		}

		function o(t, e) {
			var n = a(),
				i = {
					val: t || "",
					url: e || ""
				};
			if ("" !== t) {
				n.length > 10 && (n.length = 10);
				for (var o = 0; o < n.length; o++) n[o].val == t && n.splice(o, 1);
				window.localStorage && (n.unshift(i), window.localStorage.zuishijie_search_history = JSON.stringify(n))
			}
		}

		function a() {
			var t = [];
			return window.localStorage && window.localStorage.zuishijie_search_history && (t = jQuery.parseJSON(window.localStorage.zuishijie_search_history)), t
		}
		var r = e();
		new t({
			target: "#zwhomeSearchText",
			parent: "#zwhomeSearchs",
			width: "440",
			zindex: 99,
			dataSource: "/?action=search",
			submitOnEnter: !1,
			defalutHTML: r,
			onItemSelected: function(t) {
				var e = $(t).attr("data-url"),
					n = $(t).attr("data-value");
				o(n, e), window.location.href = e
			},
			onIndexChanged: function(t, e) {},
			onKeyEnter: function() {},
			contentHTML: function(t) {
				var e = "";
				return $.each(t.keywords, function(t, n) {
					n.title;
					e += '<li class="qui-autoComplete-item" data-value="' + n.title + '" data-url="' + n.url + '" data-bn-ipg="zsj-search-suggest"><em>' + n.type + '</em><span class="name">' + n.title + "</span></li>"
				}), e
			}
		});
		$("#zwhomeSearchs").on("submit", function(t) {
			var e = $("#zwhomeSearchText").val();
			return e = jQuery.trim(e), "" === e ? !1 : void o(e)
		})
	})
}), $(function() {
	function t(t) {
		window.clearTimeout(r), r = window.setTimeout(function() {
			"number" == typeof t && (s = t), n.css("width", "1160px"), i.children("li").removeClass("active").eq(s).addClass("active"), o.show(), a.hide().eq(s).show()
		}, 100)
	}

	function e() {
		window.clearTimeout(r), r = window.setTimeout(function() {
			n.css("width", ""), i.children("li").removeClass("active"), o.hide()
		}, 100)
	}
	var n = $("#zwCategory"),
		i = $("#zwCategoryList"),
		o = $("#zwCategoryContents"),
		a = $(".zw-home-category-content"),
		r = null,
		s = 0;
	i.on("mouseenter", "li", function(e) {
		var n = $(this).index();
		t(n)
	}).on("mouseleave", "li", function(t) {
		e()
	}), o.on("mouseenter", function(e) {
		t()
	}).on("mouseleave", function(t) {
		e()
	})
}), $(function() {
	var t = $("#homeSliders"),
		e = t.unslider({
			keys: !0,
			dots: !0,
			fluid: !0
		}),
		n = e.data("unslider");
	t.find(".btn-arrow").on("click", function(t) {
		var e = this.className.split(" ")[1];
		n[e]()
	}), t.find(".dots").on("click", "li", function(t) {
		var e = $(this).index();
		n.move(e)
	})
}), $(function() {
	function t(t) {
		$tdsaleList.eq(index).removeClass(t + " animated").addClass(t + " animated").one("webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend", function() {
			$(this).removeClass(t + " animated")
		})
	}
	var e = $("#tdsaleBtn"),
		n = $("#tdsaleContent");
	$tdsaleList = n.children(), max = $tdsaleList.size() - 1, index = 0, e.on("click", function(e) {
		index = index == max ? 0 : index + 1, $tdsaleList.hide().eq(index).show().find(".pics img").each(function(t, e) {
			var n = $(e).attr("data-original");
			$(e).attr("src", n)
		}), t("fadeIn")
	})
}), $(function() {
	function t(t, e) {
		$(e).removeClass(t + " animated").addClass(t + " animated").one("webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend", function() {
			$(this).removeClass(t + " animated")
		})
	}
	var e = $(".zw-home-tags");
	e.on("mouseenter", "li", function(e) {
		var n = $(this),
			i = n.parent().parent().next(),
			o = i.children(),
			a = "active",
			r = n.index();
		n.hasClass(a) || (n.addClass(a).siblings().removeClass(a), o.hide().eq(r).show().find(".pics img").each(function(t, e) {
			var n = $(e).attr("data-original");
			$(e).attr("src", n)
		}), t("fadeIn", o[r]))
	})
}), $(function() {
	$("img.lazy").lazyload()
}), $(function() {
	var t = {
		$floater: $(".zw-module-sidefloater-wrap"),
		$footer: $(".zw-footer"),
		$totop: $("#gototop"),
		wh: $(window).height(),
		init: function() {
			this.bind_event()
		},
		bind_event: function() {
			var t = this;
			this.$totop.on("click", function() {
				$("html,body").animate({
					scrollTop: "0"
				}, 500)
			}), $(window).on("scroll", function(e) {
				t.window_scroll(this)
			})
		},
		window_scroll: function(t) {
			var e = $("body").scrollTop() || $(document).scrollTop() || $("html").scrollTop(),
				n = 320;
			e > n ? (this.$floater.fadeIn("fast"), this.$footer.offset() && e + 200 + this.$floater.height() >= this.$footer.offset().top ? this.$floater.css({
				position: "absolute",
				top: this.$footer.offset().top - this.$floater.height()
			}) : this.$floater.css({
				position: "fixed",
				top: "200px"
			})) : this.$floater.fadeOut("fast"), e > 760 ? this.$totop.fadeIn(400) : this.$totop.fadeOut(400)
		}
	};
	t.init()
});