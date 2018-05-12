window.QYER || (window.QYER = {
	uid: 0
}), ! function() {
	var t = jQuery;
	! function() {
		window.qyerUtil = {
			init: function() {
				window.QYER && window.QYER.frameVersion > 1 && (this._initHead(), this.spam_text_filter(), this.includeGA(), this.frameCompatibleh())
			},
			frameCompatibleh: function() {
				window._qyer_userid = window.QYER.uid, window.setCookie = this.setCookie, window.getCookie = this.getCookie, window._gaq = window._gaq || []
			},
			includeGA: function() {
				window._gaq = window._gaq || [], window._gaq.push(["_setAccount", "UA-185023-1"], ["_setDomainName", "qyer.com"], ["_setSiteSpeedSampleRate", 10], ["_addIgnoredRef", "qyer.com"], ["_addOrganic", "soso", "w"], ["_addOrganic", "sogou", "query"], ["_addOrganic", "baidu", "word"], ["_addOrganic", "baidu", "q1"], ["_addOrganic", "baidu", "q2"], ["_addOrganic", "m.baidu", "word"], ["_addOrganic", "so.360", "q"], ["_addOrganic", "so", "q"], ["_addOrganic", "baidu", "w"], ["_addOrganic", "cn.bing", "q"], ["_addOrganic", "sm", "q"], ["_trackPageview"]), "https:" == document.location.protocol ? requirejs(["https://ssl.google-analytics.com/ga.js"]) : requirejs(["http://qt.qyer.com/beacon.js", "http://www.google-analytics.com/ga.js"])
			},
			setCookie: function(t, e, n) {
				var i = 365,
					o = new Date;
				arguments[2] || (n = 1), 1 == n ? (o.setTime(o.getTime() + 24 * i * 60 * 60 * 1e3), document.cookie = t + "=" + escape(e) + "; path=/;domain=.qyer.com;expires=" + o.toGMTString()) : document.cookie = t + "=" + escape(e) + "; path=/;domain=.qyer.com", i = o = null
			},
			getCookie: function(t) {
				var e = document.cookie.match(new RegExp("(^| )" + t + "=([^;]*)(;|$)"));
				return null != e ? unescape(e[2]) : null
			},
			_initHead: function() {
				"ask.qyer.com" == window.location.hostname && t(".qyer_header_bg").css("position", "fixed")
			},
			_head: null,
			_getHead: function() {
				return this._head || (this._head = document.getElementsByTagName("head")[0]), this._head
			},
			loadCss: function(e, n) {
				n === !1 ? this.insertStyle(t.ajax({
					url: e,
					async: !1
				}).responseText) : t('<link rel="stylesheet" type="text/css" />').attr("href", e).appendTo(this._getHead())
			},
			insertStyle: function(t) {
				var e = document.createElement("style");
				e.type = "text/css", e.styleSheet ? e.styleSheet.cssText = t : e.innerHTML = t, this._getHead().appendChild(e), e = null
			},
			sliceArguments: function(t, e) {
				for (var n = [], i = e; i < t.length; i++) n.push(t[i]);
				return n
			},
			isMobile: function() {
				var t = navigator.userAgent;
				return t.match(/Android/i) || -1 != t.indexOf("iPhone") || -1 != t.indexOf("iPad")
			},
			getWordLen: function(e, n) {
				function i(t) {
					if ("undefined" == typeof t) return 0;
					var e = t.match(/[^\x00-\x80]/g);
					return t.length + (e ? e.length : 0)
				}

				function o(t) {
					return t.replace(/[^\x00-\xff]/g, "*")
				}
				return n && (e = o(e)), i(t.trim(e))
			},
			subStr: function(t, e) {
				for (var n, i, o = 0, r = 0; r < t.length; r++)
					if (n = t.charAt(r), o += encodeURI(n).length > 2 ? 1 : .5, o >= e) return i = o == e ? r + 1 : r, t.substr(0, i);
				return t
			},
			doTrackCode: function(e) {
				var n = "__dotarckcodebutton__";
				document.getElementById(n) || t('<button id="' + n + '" style="display:none;">dotarckcodebutton</button>').appendTo(document.body), t("#" + n).attr("data-bn-ipg", e).trigger("click"), n = null
			},
			ajaxFillter: function(t, e, n) {
				if (0 != window.location.href.indexOf("http://plan.qyer.com") && "object" == typeof t && t.extra && t.extra.code) switch (0 | t.extra.code) {
					case 1:
						window.qyerUtil.showAntiSpam(t.extra.msg)
				}
			},
			showAntiSpam: function(t) {
				requirejs(["web_ct_antispam"], function(e) {
					e.show(t)
				})
			},
			doAjax: function(e) {
				var n, i, o;
				if (n = e.minResponseTime ? new Date : null, o = function(t) {
						if ("undefined" == typeof t.error_code) try {
							t.error_code = t.error, t.result = t.result, 0 != t.error_code && (t.data = t.data || {}, t.data.msg = t.msg)
						} catch (n) {}
						0 == t.error_code ? ("undefined" == typeof t.data && (t.data = e.__defaultData__), e.onCallSuccessBefore && e.onCallSuccessBefore(t), e.onSuccess && e.onSuccess(t), e.onCallSuccessAfter && e.onCallSuccessAfter(t)) : e.onError && e.onError(t)
					}, e.testData) return "undefined" == typeof e.testData.data && (e.testData.data = e.__defaultData__), void setTimeout(function() {
					o(e.testData)
				}, e.minResponseTime || 200);
				var r = window.location.host,
					a = e.url || e.posturl,
					l = e.data,
					c = "json";
				if (/static.qyer.com/.test(r) === !0 || /qyerstatic.com/.test(r) === !0) {
					var s;
					l = t.extend({}, l, {
						__qFED__: e.__qFED__
					}), e.__qFED__ && e.__qFED__.id && (s = e.__qFED__.id, e.type = "GET"), a = "http://fe.2b6.me:3000/service/api/" + s, c = "jsonp", api = null
				}
				var d = t.ajax({
					type: e.type || "POST",
					url: a,
					dataType: c,
					data: l,
					cache: e.cache || !1,
					success: function(t) {
						n ? (i = new Date - n, setTimeout(function() {
							o.call(null, t)
						}, i > e.minResponseTime ? 0 : e.minResponseTime - i)) : o.call(null, t), n = i = null
					},
					error: function(t, n) {
						e.onError && e.onError({
							error_code: -1,
							__server_error__: !0,
							__server_status__: d.statusText,
							result: "error",
							data: {
								msg: n || {}
							}
						})
					}
				});
				return d
			},
			runOneInPeriodOfTime: function(t, e) {
				var n;
				return function(i, o, r, a, l) {
					window.clearTimeout(n), n = window.setTimeout(function() {
						t(i, o, r, a, l)
					}, e || 300)
				}
			},
			isLogin: function() {
				return !(!window.QYER || !window.QYER.uid)
			},
			doLogin: function(t) {
				window.qyerUtil.isLogin() || requirejs(["web_ct_logindialog"], function(e) {
					e.show(t)
				})
			},
			doSignin: function(e) {
				requirejs(["web_ct_logindialog"], function(n) {
					n.show(t.extend({}, {
						page: "regist"
					}, e))
				})
			},
			getUrlParam: function(t, e) {
				var n, i = new RegExp("(^|&)" + t + "=([^&]*)(&|$)");
				if (e) {
					var o = e.indexOf("?"); - 1 != o && (n = e.substr(e.indexOf("?") + 1))
				} else n = window.location.search.substr(1);
				if (!n) return null;
				var r = n.match(i);
				return null != r ? unescape(r[2]) : null
			},
			spam_text_filter: function() {
				var e, n, i, o, r;
				e = /(http:\/\/)?[\w\.]*\.?(mafengwo\.cn|mafengwo\.com|mafengwo\.net)[a-zA-Z\/0-9&\?\.#\-_]*/gim, r = t(".qyer_spam_text_filter"), r.find("a").each(function() {
					n = t(this), (-1 != (n.html() + n.attr("href")).indexOf("mafengwo.cn") || -1 != (n.html() + n.attr("href")).indexOf("mafengwo.com") || -1 != (n.html() + n.attr("href")).indexOf("mafengwo.net")) && n.replaceWith(t(this).html())
				}), r.each(function() {
					if (n = t(this), i = n.html().replace(/\<script.*?\>document\.write\(AC_FL_RunContent.*?\<\/script\>/gim, ""), o = i.match(/\<img[\s\S]*?\>/gim), null != o)
						for (var r = 0; r < o.length; r++) i = i.replace(o[r], "[imgimg]" + r + "[/imgimg]");
					if (i = i.replace(e, ""), null != o)
						for (var r = 0; r < o.length; r++) i = i.replace("[imgimg]" + r + "[/imgimg]", o[r]);
					n.html(i)
				}), e = n = i = o = r = null
			},
			openUrl: function(e) {
				var n = t('<form action="' + e + '" target="_blank" method="get"></form>');
				n.appendTo(document.body), n.submit(), setTimeout(function() {
					n.remove(), n = null
				}, 8e3)
			}
		}
	}(), ! function() {
		function t(t, e) {
			for (var n in e) t[n] = e[n]
		}
		t(Date.prototype, {
			qGetWeekStr: function() {
				return "星期" + ["日", "一", "二", "三", "四", "五", "六"][this.getDay()]
			},
			qAddDate: function(t) {
				return this.setDate(this.getDate() + t), this
			},
			qToString: function(t) {
				var e = [this.getFullYear(), this.getMonth() + 1, this.getDate()];
				return e.join(t || "-")
			}
		}), t(String.prototype, {
			qToDate: function(t) {
				var e = this.split(t || "-");
				e = [0 | e[0], (0 | e[1]) - 1, 0 | e[2]];
				var n = new Date(e[0], e[1], e[2]);
				return e.length = 0, e = null, n
			},
			qToIntFixed: function() {
				var t = 0 | this;
				return 10 > t ? "0" + t : t.toString()
			},
			qToHTML: function() {
				return this.replace(/</gi, "&lt;").replace(/>/gi, "&gt;").replace(/\n/gi, "<br />").replace(/\t/gi, "&nbsp;&nbsp;&nbsp;&nbsp;")
			}
		})
	}()
}(), $(function() {
	qyerUtil.init()
}), ! function(t, e, n, i) {
	var o = t(e);
	t.fn.lazyload = function(r) {
		function a() {
			var e = 0;
			c.each(function() {
				var n = t(this);
				if (!s.skip_invisible || n.is(":visible"))
					if (t.abovethetop(this, s) || t.leftofbegin(this, s));
					else if (t.belowthefold(this, s) || t.rightoffold(this, s)) {
					if (++e > s.failure_limit) return !1
				} else n.trigger("appear"), e = 0
			})
		}
		var l, c = this,
			s = {
				threshold: 0,
				failure_limit: 0,
				event: "scroll",
				effect: "show",
				container: e,
				data_attribute: "original",
				skip_invisible: !0,
				appear: null,
				load: null,
				placeholder: "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAYAAAAfFcSJAAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAAJcEhZcwAADsQAAA7EAZUrDhsAAAANSURBVBhXYzh8+PB/AAffA0nNPuCLAAAAAElFTkSuQmCC"
			};
		return r && (i !== r.failurelimit && (r.failure_limit = r.failurelimit, delete r.failurelimit), i !== r.effectspeed && (r.effect_speed = r.effectspeed, delete r.effectspeed), t.extend(s, r)), l = s.container === i || s.container === e ? o : t(s.container), 0 === s.event.indexOf("scroll") && l.bind(s.event, function() {
			return a()
		}), this.each(function() {
			var e = this,
				n = t(e);
			e.loaded = !1, (n.attr("src") === i || n.attr("src") === !1) && n.is("img") && n.attr("src", s.placeholder), n.one("appear", function() {
				if (!this.loaded) {
					if (s.appear) {
						var i = c.length;
						s.appear.call(e, i, s)
					}
					t("<img />").bind("load", function() {
						var i = n.attr("data-" + s.data_attribute);
						n.hide(), n.is("img") ? n.attr("src", i) : n.css("background-image", "url('" + i + "')"), n[s.effect](s.effect_speed), e.loaded = !0;
						var o = t.grep(c, function(t) {
							return !t.loaded
						});
						if (c = t(o), s.load) {
							var r = c.length;
							s.load.call(e, r, s)
						}
					}).attr("src", n.attr("data-" + s.data_attribute))
				}
			}), 0 !== s.event.indexOf("scroll") && n.bind(s.event, function() {
				e.loaded || n.trigger("appear")
			})
		}), o.bind("resize", function() {
			a()
		}), /(?:iphone|ipod|ipad).*os 5/gi.test(navigator.appVersion) && o.bind("pageshow", function(e) {
			e.originalEvent && e.originalEvent.persisted && c.each(function() {
				t(this).trigger("appear")
			})
		}), t(n).ready(function() {
			a()
		}), this
	}, t.belowthefold = function(n, r) {
		var a;
		return a = r.container === i || r.container === e ? (e.innerHeight ? e.innerHeight : o.height()) + o.scrollTop() : t(r.container).offset().top + t(r.container).height(), a <= t(n).offset().top - r.threshold
	}, t.rightoffold = function(n, r) {
		var a;
		return a = r.container === i || r.container === e ? o.width() + o.scrollLeft() : t(r.container).offset().left + t(r.container).width(), a <= t(n).offset().left - r.threshold
	}, t.abovethetop = function(n, r) {
		var a;
		return a = r.container === i || r.container === e ? o.scrollTop() : t(r.container).offset().top, a >= t(n).offset().top + r.threshold + t(n).height()
	}, t.leftofbegin = function(n, r) {
		var a;
		return a = r.container === i || r.container === e ? o.scrollLeft() : t(r.container).offset().left, a >= t(n).offset().left + r.threshold + t(n).width()
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
	requirejs(["common/js/jquery.ImgScrcollBlock"], function() {
		$(".zw-module-banner-imglist").length && $(".zw-module-banner-imglist").imgScrollBlock({
			topScroll: !1,
			leftScroll: !0,
			showControlDot: !0,
			defaultStart: !0
		})
	})
}), $(function() {
	requirejs(["common/js/zw-banner1"], function() {
		$(".zw-module-banner1-wrap").length && $(".zw-module-banner1-wrap").zw_banner1({
			time: 5e3
		})
	})
}), $(function() {
	var t = {
		$sp_condition_line: $(".slide-btn").parents(".condition-line"),
		$sub_list_cell: $(".sub-list-tit-cell"),
		$sub_list_county_cell: $(".sub-list-county-cell"),
		init: function() {
			this.init_continent(), this.set_extra_cell(), this.bind_event()
		},
		bind_event: function() {
			var t = this;
			this.$sp_condition_line.on("click", ".slide-btn", function(e) {
				t.click_morebtn(this)
			}).on("mouseover", ".sub-list-tit-cell", function(e) {
				t.continent_hover(this)
			})
		},
		init_continent: function() {
			if (this.$sub_list_cell.filter(".active").length) {
				var t = this.$sub_list_cell.filter(".active").attr("data-id");
				this.set_continent(t)
			}
		},
		click_morebtn: function(t) {
			var e = $(t),
				n = e.parents(".condition-line").find(".condition-sub-list-wrap"),
				i = e.find(".slide-btn-ico");
			n.length && (n.slideToggle(), i.toggleClass(function(t, e) {
				return $(this).is(".unflod") ? $(this).parent().find(".slide-btn-text").text("更多") : $(this).parent().find(".slide-btn-text").text("收起"), "unflod"
			}))
		},
		set_continent: function(t, e) {
			e ? e.parents(".condition-sub-list-wrap").find(".sub-list-county-cell").hide().filter("." + t).show() : this.$sub_list_county_cell.hide().filter("." + t).show()
		},
		continent_hover: function(t) {
			var e = $(t),
				n = e.attr("data-id");
			e.addClass("active").siblings(".active").removeClass("active"), this.set_continent(n, e)
		},
		set_extra_cell: function() {
			this.$sp_condition_line.each(function() {
				var t = $(this),
					e = t.find(".condition-list-wrap > .condition-list .condition-btn-link"),
					n = t.find('.condition-sub-list-wrap .condition-btn-link[data-active="1"]'),
					i = n.attr("data-id"),
					o = !1;
				if (n.length && (e.each(function(t) {
						var e = $(this).attr("data-id");
						i == e && (o = !0)
					}), 0 == o)) {
					var r = n.eq(0).clone().addClass("active").attr("href", "javascript:void(0);").wrap('<li class="condition-list-cell extra-add"></li>').parent();
					t.find(".condition-list-wrap > .condition-list").append(r)
				}
			})
		}
	};
	t.init()
}), $(function() {
	var t = {
		init: function() {
			this.bind_event()
		},
		bind_event: function() {
			var t = this;
			$(".clear-search").on("click", function(e) {
				t.clear_search(this)
			})
		},
		clear_search: function(t) {
			var e = ($(t), window.location.href.split("?")[0]),
				n = window.location.search;
			return kw = n.split(n.match(/&kw=[^&#]*/)), kw = kw.join(""), "&" == kw.charAt(kw.length - 1) && (kw = kw.slice(0, -1)), $(".search-text").val(""), window.location.href = e + kw + "#anchor_filtrate", !1
		}
	};
	t.init()
}), $(function() {
	var t = {
		init: function() {
			this.lazy_load()
		},
		bind_event: function() {},
		lazy_load: function() {
			$(".zw-module-bigcard-wrap .zw-module-bigcard-item").find("img").lazyload({
				effect: "fadeIn"
			})
		}
	};
	t.init()
}), $(function() {
	var t = {
		init: function() {
			this.lazy_load()
		},
		bind_event: function() {},
		lazy_load: function() {
			$(".zw-module-smallcard-list li").find("img").lazyload({
				effect: "fadeIn"
			})
		}
	};
	t.init()
}), $(function() {
	var t = {
		init: function() {
			this.lazy_load()
		},
		bind_event: function() {},
		lazy_load: function() {
			$(".zw-module-findmore-wrap .findmore-list-cell").find(".link-img").lazyload({
				effect: "fadeIn"
			})
		}
	};
	t.init()
}), $(function() {
	var t = {
		init: function() {
			this.lazy_load()
		},
		bind_event: function() {},
		lazy_load: function() {
			$(".zw-module-recommand-wrap li").find(".zw-module-smallcard-itemimg").lazyload({
				effect: "fadeIn"
			})
		}
	};
	t.init()
}), $(function() {
	var t = {
		$filtrate_condition: $(".zw-module-filtrate-condition"),
		$dock_wrap: $(".zw-module-dock-wrap"),
		$sortnav: $(".zw-module-sortnav-wrap"),
		$dock_search: $(".dock-search"),
		$searchform: $(".zw-module-sortnav-searchform"),
		$dock_filtrate: $(".js-dock-filtrate"),
		init: function() {
			this.bind_event()
		},
		bind_event: function() {
			var t = this;
			this.copy_flitrate(), $(window).on("scroll", function(e) {
				t.window_scroll(this)
			})
		},
		window_scroll: function(t) {
			if (this.$sortnav.length && this.$dock_search.length && this.$searchform.length) {
				var e = $("body").scrollTop() || $(document).scrollTop() || $("html").scrollTop(),
					n = this.$sortnav.offset().top + this.$sortnav.height(),
					i = 20;
				e > n + i ? (this.$dock_wrap.show(), this.$dock_search.append(this.$searchform)) : (this.$dock_wrap.hide(), this.$sortnav.append(this.$searchform))
			}
		},
		copy_flitrate: function() {
			if (this.$filtrate_condition.length) {
				var t = this.$filtrate_condition.find(".condition-line"),
					e = this.$dock_filtrate.find(".dock-nav-condition-wrap");
				t.each(function(t) {
					var n = $(this),
						i = n.attr("data-lmtype"),
						o = e.filter('[data-type="' + i + '"]'),
						r = n.clone(!0),
						a = r.find(".condition-title").text(),
						l = r.find(".condition-btn-link.active").text();
					r.find(".condition-title").remove(), "csdq" == i ? (o = e.filter('[data-type="mdd"]'), o.length && o.parents(".dock-nav-cell").show()) : ("全部" == l && (l = a), o.length && o.parents(".dock-nav-cell").find(".dock-nav-title-text").text(l).end().show()), o.append(r)
				})
			}
		}
	};
	t.init()
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