! function(t, e) {
	"function" == typeof define && define.amd ? define("common/js/common/SiteSearch", e) : "object" == typeof exports ? module.exports = e() : t.SiteSearch = e()
}(this, function() {
	function t(t) {
		this.opts = $.extend({
			box: "#siteSearch"
		}, t), this.$searchBox = $(t.box), this.$input = this.$searchBox.find(".txt"), this.$form = this.$searchBox.find("form"), this.searchUrl = this.$form.attr("action"), this.ajaxUrls = {
			sitesearch: "qcross/home/ajax?action=sitesearch"
		}, this.searchTimer = null, this.$history = null, this.$autocomplete = null, this._history = [], this._search = {}, this.init()
	}
	return t.prototype = {
		init: function() {
			this.createHistory(), this.createAutoComplete(), this.bindEvent(), this.getStorage()
		},
		bindEvent: function() {
			var t = this;
			this.$input.on("focus", function() {
				t.hideLayer(), t.searchBoxActive()
			}), this.$searchBox.on("click", function() {
				t.$input.trigger("focus")
			}), this.$input.on("keyup", function(e) {
				switch (e.keyCode) {
					case 38:
						t.switchUpDown("up");
						break;
					case 40:
						t.switchUpDown("down");
						break;
					default:
						clearTimeout(t.searchTimer), t.searchTimer = setTimeout(function() {
							"" == t.getSearchWord() ? t.showHistory() : t.searchWord(t.getSearchWord())
						}, 400)
				}
			}), this.$form.on("submit", function() {
				var e = $.trim(t.$input.val()),
					s = t.searchUrl + "?wd=" + window.encodeURIComponent(e);
				return "" == e ? !1 : void t.setStorage(e, s)
			})
		},
		searchBoxActive: function() {
			this.$searchBox.addClass("active"), this.clickDocumentEvent(this.$searchBox[0], this.searchBoxClose), "" == this.getSearchWord() ? this.showHistory() : this.searchWord(this.getSearchWord())
		},
		searchBoxClose: function() {
			this.$searchBox.removeClass("active"), this.$input.val(""), this.$history && this.$history.removeClass("show")
		},
		clickDocumentEvent: function(t, e) {
			var s = this,
				i = "e_" + (new Date).getTime();
			$(document).unbind("click." + i), $(document).bind("click." + i, function(a) {
				HomeUtil.isParent(a.target, t) || a.target == t || (e.call(s), $(document).unbind("click." + i))
			})
		},
		createHistory: function() {
			if (!window.localStorage) return !1;
			var t = this,
				e = ['<div class="q-layer q-layer-sitesearch-history">', "<ul>", "</ul>", '<div class="history-clear">', '<a href="javascript:;">清空历史纪录</a>', "</div>", "</div>"];
			this.$searchBox.append(e.join("")), this.$history = this.$searchBox.find(".q-layer-sitesearch-history"), this.$history.on("click", ".history-clear > a", function() {
				t.clearStorage()
			})
		},
		hideLayer: function() {
			this.$searchBox.find(".q-layer").removeClass("show")
		},
		showHistory: function() {
			if (!this._history.length) return !1;
			for (var t = [], e = 0; e < this._history.length && (t.push('<li data-type="history" data-wd="' + this._history[e].key + '"><a href="' + this._history[e].url + '">' + this._history[e].key + "</a></li>"), !(e >= 4)); e++);
			this.$history.find("ul").html(t.join("")), this.$history.addClass("show"), this.hideAutoComplete()
		},
		hideHistory: function() {
			this.$history.removeClass("show")
		},
		showAutoComplete: function() {
			this.$autocomplete.addClass("show")
		},
		hideAutoComplete: function() {
			this.$autocomplete.removeClass("show")
		},
		createAutoComplete: function() {
			var t = ['<div class="q-layer q-layer-sitesearch-autocomplete">', "<ul>", "</ul>", "</div>"];
			this.$searchBox.append(t.join("")), this.$autocomplete = this.$searchBox.find(".q-layer-sitesearch-autocomplete")
		},
		getStorage: function() {
			if (window.localStorage && window.localStorage.sitesearch_history) {
				var t = window.localStorage.sitesearch_history;
				this._history = JSON.parse(t)
			}
		},
		setStorage: function(t, e) {
			if (!window.localStorage) return !1;
			for (var s = -1, i = 0; i < this._history.length; i++)
				if (this._history[i].key == t) {
					s = i;
					break
				} - 1 != s && this._history.splice(i, 1), this._history.unshift({
				key: t,
				url: e
			}), window.localStorage.sitesearch_history = JSON.stringify(this._history)
		},
		getSearchWord: function() {
			return HomeUtil.fliterScript($.trim(this.$input.val()))
		},
		setSearchWord: function(t) {
			this.$input.val(t)
		},
		clearStorage: function() {
			return window.localStorage ? (window.localStorage.removeItem("sitesearch_history"), this._history = [], void this.$history.find("ul").empty()) : !1
		},
		switchUpDown: function(t) {
			this.$history.is(":visible") ? this.switchUpDownInHistory(t) : this.$autocomplete.is(":visible") && this.switchUpDownInAutoComplete(t)
		},
		switchUpDownInHistory: function(t) {
			var e = this.$history.find("li"),
				s = this.$history.find("li.current"),
				i = null;
			i = "up" == t ? s.length && s.prev().length ? s.prev() : e.last() : s.length && s.next().length ? s.next() : e.first(), this.currentLayer(i)
		},
		switchUpDownInAutoComplete: function(t) {
			var e = this.$autocomplete.find("li"),
				s = this.$autocomplete.find("li.current"),
				i = null;
			i = "up" == t ? s.length && s.prev().length ? s.prev() : e.last() : s.length && s.next().length ? s.next() : e.first(), this.currentLayer(i)
		},
		currentLayer: function(t) {
			switch (t.addClass("current").siblings().removeClass("current"), this.$form.attr("action", this.searchUrl), t.attr("data-type")) {
				case "history":
					this.setSearchWord(t.attr("data-wd"));
					break;
				case "item":
					this.$form.attr("action", t.find("a").attr("href"));
					break;
				case "word":
					this.setSearchWord(t.find("a").text())
			}
		},
		ajaxSearch: function(t) {
			var e = this,
				s = {
					keyword: t,
					timer: (new Date).getTime()
				};
			$.getJSON(this.ajaxUrls.sitesearch, s, function(s) {
				0 == s.error_code ? s.data.list.length ? e.renderAutoComplete(e.$autocomplete, s.data, t) : e.hideLayer() : s.data.msg && ajaxError(s.data.msg)
			})
		},
		searchWord: function(t) {
			this._search[t] ? this.renderAutoComplete(this.$autocomplete, this._search[t]) : this.ajaxSearch(t)
		},
		renderAutoComplete: function(t, e, s) {
			var i = [];
			if ("string" == typeof e) i = e;
			else {
				for (var a = 0; a < e.list.length; a++) {
					var n = e.list[a];
					"item" == n.type_name ? (i.push('<li data-type="item">'), i.push('<a href="' + n.url + '">'), i.push("<dl>"), i.push("<dt>"), i.push('<img src="' + n.src + '" width="30" height="30" />'), i.push("</dt>"), i.push("<dd>"), i.push("<p>"), i.push('<span class="cn">' + n.cn_name + "</span>"), i.push('<span class="en">' + n.en_name + "</span>"), i.push("</p>"), i.push("<p>"), i.push('<span class="poi">' + n.belong_name + "</span>"), i.push("</p>"), i.push("</dd>"), i.push("</dl>"), i.push("</a>"), i.push("</li>")) : i.push('<li data-type="word"><a href="' + n.url + '">' + n.word + "</a></li>")
				}
				i = i.join("")
			}
			i && (t.find("ul").html(i), this._search[s] = i), this.hideHistory(), this.showAutoComplete()
		},
		replaceKeyword: function(t, e) {
			return t.replace(e, "<em>" + e + "</em>")
		}
	}, t
}), define("common/js/common/UserStatus", [], function() {
	function t(t) {
		this.opts = $.extend({
			box: "#userStatus"
		}, t), this.$userStatusBox = $(this.opts.box), this.ajaxUrls = {
			userStatus: "qcross/home/ajax?action=loginstatus",
			msgCount: "qcross/user/ajax.php?action=getunreadcount",
			msgInfo: "qcross/home/ajax?action=notice"
		}, this.newMessage = !0, this.xhrStatus = null, this.userStatusCount = 1, this.init()
	}
	return t.prototype = {
		init: function() {
			window.QYER = window.QYER || {
				uid: 0
			}, this.getUserStatus()
		},
		getUserStatus: function() {
			var t = this;
			this.xhrStatus = $.ajax({
				url: this.ajaxUrls.userStatus,
				data: {
					timer: +new Date
				},
				dataType: "json",
				timeout: 3e3,
				success: function(e) {
					0 == e.error_code && (e.data.uid > 0 && (t.renderUserInfoInner(e.data.userinfo), window.QYER.uid = e.data.uid), t.bindEvent(), window.__userStatusCallBack && __userStatusCallBack.call(window, e.data))
				},
				error: function(e, s, i) {
					10 === t.userStatusCount || "timeout" === s && (t.userStatusCount += 1, t.xhrStatus.abort(), t.getUserStatus())
				}
			})
		},
		renderLoginInner: function() {
			var t = ['<div class="login show">', '<a class="otherlogin-link" href="javascript:;" rel="noflow" data-bn-ipg="index-head-un-qq" data-type="qq"><i class="iconfont icon-qq"></i></a> ', '<a class="otherlogin-link" href="javascript:;" rel="noflow" data-bn-ipg="index-head-un-weibo" data-type="weibo"><i class="iconfont icon-weibo"></i></a> ', '<a class="otherlogin-link" href="javascript:;" rel="noflow" data-bn-ipg="index-head-un-wechat" data-type="weixin"><i class="iconfont icon-weixin"></i></a> ', '<a href="http://login.qyer.com/?action=register" data-bn-ipg="index-head-un-register">注册</a> ', '<a href="http://login.qyer.com/?action=login" data-bn-ipg="index-head-un-login">登录</a>', "</div>"].join("");
			this.$userStatusBox.html(t)
		},
		renderUserInfoInner: function(t) {
			function e(t) {
				var e = "";
				return e += ' <span class="auth_avatar_q s">', e += "<i" + (t.url && "" != t.url ? " onclick=\"window.location='" + t.url + "';\"" : "") + ' class="icon ' + t.type + '" title="' + t.text + '"></i>', e += "</span>"
			}
			var s = ['<div class="user-info show">', '<div class="userstatus">', '<span class="avatar">', '<a href="http://www.qyer.com/u/' + t.uid + '" data-bn-ipg="index-head-user" target="_blank"><img src="' + t.avatar + '" width="32" height="32"></a>', "</span>", ' <span class="username"><a href="http://www.qyer.com/u/' + t.uid + '" data-bn-ipg="index-head-user" target="_blank">' + t.username + "</a></span>", t.auth ? e(t.auth) : "", ' <span><i class="iconfont icon-jiantouxia"></i></span>', t.menuInner, "</div>", '<div class="usermsg">', '<a class="message" href="javascript:;"><i class="iconfont icon-xinfeng"></i> <em class="num">' + (t.msgCount && t.msgCount > 0 ? t.msgCount : "") + "</em></a>", '<em class="newmsg"' + (t.msgCount && t.msgCount ? "" : ' style="display:none;"') + "></em>", '<div class="q-layer q-layer-message">', '<div class="layer-msg-tab">', "<ul>", '<li class="current' + (t.msg && t.msg.board ? " new" : "") + '" data-msg-type="board"><a data-bn-ipg="index-head-msgdrop-tab-black" href="javascript:;">站内通知</a></li>', "<li" + (t.msg && t.msg.notice ? ' class="new"' : "") + ' data-msg-type="notice"><a data-bn-ipg="index-head-msgdrop-tab-notice" href="javascript:;">消息</a></li>', "<li" + (t.msg && t.msg.message ? ' class="new"' : "") + ' data-msg-type="message"><a data-bn-ipg="index-head-msgdrop-tab-letter" href="javascript:;">私信</a></li>', "</ul>", "</div>", '<div class="layer-msg-container">', '<div class="layer-msg-item layer-msg-item-board" style="display: block;">', '<div class="layer-msg-inner"><div class="loading"></div></div>', '<div class="layer-msg-more">', '<a data-bn-ipg="index-head-black-all" href="' + t.msgUrl.board + '">查看全部</a>', "</div>", "</div>", '<div class="layer-msg-item layer-msg-item-notice">', '<div class="layer-msg-inner"><div class="loading"></div></div>', '<div class="layer-msg-more">', '<a data-bn-ipg="index-head-notice-all" href="' + t.msgUrl.notice + '">查看全部</a>', "</div>", "</div>", '<div class="layer-msg-item layer-msg-item-message">', '<div class="layer-msg-inner"><div class="loading"></div></div>', '<div class="layer-msg-more">', '<a data-bn-ipg="index-head-letter-all" href="' + t.msgUrl.message + '">查看全部</a>', "</div>", "</div>", "</div>", "</div>", "</div>", "</div>"].join("");
			this.$userStatusBox.html(s), this.getUserMsgCount()
		},
		renderUserMsgInner: function(t) {
			this.renderMsg("board", t.board, this.$userStatusBox.find(".layer-msg-item-board > .layer-msg-inner")), this.renderMsg("notice", t.notice, this.$userStatusBox.find(".layer-msg-item-notice > .layer-msg-inner")), this.renderMsg("message", t.message, this.$userStatusBox.find(".layer-msg-item-message > .layer-msg-inner"))
		},
		renderMsg: function(t, e, s) {
			var i, a, n = [];
			switch (t) {
				case "board":
					i = "站内通知", a = "black";
					break;
				case "notice":
					i = "消息", a = "notice";
					break;
				case "message":
				default:
					i = "私信", a = "letter"
			}
			if (this.$userStatusBox.find("[data-msg-type=" + t + "]")[e.unread > 0 ? "addClass" : "removeClass"]("new"), e.list.length) {
				n.push("<ul>");
				for (var r = 0; r < e.list.length; r++) {
					var o = e.list[r];
					n.push("<li" + (0 == o.unread ? "" : ' class="unread"') + ">"), n.push('<div class="layer-msg-cont">'), n.push('<p class="cont">'), n.push('<a href="' + o.url + '" data-bn-ipg="index-head-msgrdrop-' + a + "List-" + r + '">' + ("message" == t ? o.from + ": " : "") + o.msg + "</a>"), n.push("</p>"), n.push("</div>"), n.push("</li>")
				}
				n.push("</ul>")
			} else n.push('<div class="msg-empty">暂时没有新的' + i + "</div>");
			s.html(n.join(""))
		},
		getUserMsgCount: function() {
			var t = this,
				e = !0,
				s = 0;
			$(window).focus(function() {
				e = !0
			}).blur(function() {
				e = !1
			});
			var i = function() {
				var i = !!s,
					a = 10 * Math.random() < 7,
					n = !e;
				i || a || n || (t.hasNewMessage = !0, $.getJSON(t.ajaxUrls.msgCount, {
					timer: (new Date).getTime()
				}).done(function(e) {
					s = e.total_count, t.$userStatusBox.find(".newmsg")[e.total_count > 0 ? "show" : "hide"](), t.$userStatusBox.find(".num").html(e.total_count)
				}))
			};
			setInterval(function() {
				i()
			}, 3e4)
		},
		getUserMsgInfo: function() {
			var t = this;
			this.newMessage = !1, $.getJSON(this.ajaxUrls.msgInfo, {
				timer: (new Date).getTime()
			}).done(function(e) {
				0 == e.error_code && t.renderUserMsgInner(e.data)
			})
		},
		bindEvent: function() {
			var t = this;
			this.$userStatusBox.on("click", ".otherlogin-link", function() {
				HomeUtil.otherlogin(this.getAttribute("data-type"))
			}).on("mouseenter", ".userstatus,.usermsg", function() {
				clearTimeout(this.timer), $(this).addClass("hover"), $(this).hasClass("usermsg") && t.newMessage && t.getUserMsgInfo()
			}).on("mouseleave", ".userstatus,.usermsg", function() {
				var t = $(this);
				this.timer = setTimeout(function() {
					t.removeClass("hover")
				}, 500)
			}).on("click", ".layer-msg-tab li", function() {
				if ($(this).hasClass("current")) return !1;
				var e = this.getAttribute("data-msg-type");
				$(this).addClass("current").siblings().removeClass("current"), t.$userStatusBox.find(".layer-msg-item-" + e).show().siblings().hide()
			})
		},
		otherlogin: function(t, e) {
			var e = "http://login.qyer.com/auth.php?action=" + t + "&popup=1&refer=" + (e || window.location.href);
			window.open(e, "newwindow", "width=600,height=530,top=100,left=300,toolbar=no,menubar=no,scrollbars=no,resizable=no,location=no,status=no"), e = null
		}
	}, t
}), $(function() {
	requirejs(["common/js/common/SiteSearch"], function(t) {
		new t({
			box: "#siteSearch"
		})
	}), requirejs(["common/js/common/UserStatus"], function(t) {
		new t({
			box: "#userStatus"
		})
	}), $(".nav li.nav-list-layer").on("mouseenter", function() {
		clearTimeout(this.timer), $(this).addClass("hover"), $(this).siblings(".hover").length && $(this).siblings(".hover").removeClass("hover")
	}), $(".nav li.nav-list-layer").on("mouseleave", function() {
		var t = $(this);
		this.timer = setTimeout(function() {
			t.removeClass("hover")
		}, 500)
	})
}), define("common/js/common/nav", function() {});

function ajaxError(t) {
	requirejs(["web_old_tip"], function(e) {
		e.tip({
			text: t || "请求错误",
			type: "error"
		})
	})
}
define("common/models/common/component/footerBanner/footerBanner", ["require"], function(t) {
		function e() {
			this.href = window.location.href, this.refer = document.referrer, this.source = null, this.isnew = this.getCookie("isnew"), this.init()
		}
		var i = jQuery;
		e.prototype = {
			href: null,
			refer: null,
			source: null,
			isnew: null,
			init: function() {
				if (this.setSource(), window.QYER && window.QYER.uid > 0) return !1;
				var t, e;
				return t = "m|login", e = new RegExp("^http://(" + t + ").(qyer|go2eu).com", "i"), e.test(this.href) ? !1 : (this.getHtml(), void this.setIsnew())
			},
			getHtml: function() {
				var t = this;
				i.get("/qcross/place/api.php?action=banner&url=" + encodeURIComponent(this.href) + "&isnewuser=" + this.isnew + "&source=" + encodeURIComponent(this.getSource()), function(e) {
					"" !== e && (i("body").append(e), t.bindEvent(), t = null)
				})
			},
			bindEvent: function() {
				var t = this;
				i(document).on("click", "._jslogin", function(t) {
					qyerUtil.doLogin()
				}).on("click", "._jslogin_reg", function(t) {
					qyerUtil.doSignin()
				}).on("click", ".qyer_layer_close", function(e) {
					i("._jsbeforelogindiv").fadeOut(1e3, function() {
						i(this).remove(), t = null
					})
				})
			},
			setCookie: function(t, e, i) {
				window.qyerUtil.setCookie(t, e, i)
			},
			getCookie: function(t) {
				return window.qyerUtil.getCookie(t)
			},
			setSource: function() {
				if (this.getSource(), !this.source) {
					var t = ".+",
						e = new RegExp("^http://(" + t + ").(qyer|go2eu).com", "i");
					this.refer && !e.test(this.refer) && this.setCookie("source_url", this.refer), t = e = null
				}
			},
			getSource: function() {
				return this.source = this.getCookie("source_url"), this.source
			},
			setIsnew: function() {
				this.isnew || this.setCookie("isnew", (new Date).getTime())
			},
			beforeloginshow: function() {
				setTimeout(function() {
					i("._jsbeforelogindiv").fadeIn(500)
				}, 100)
			}
		};
		var o = {
			show: function() {
				!window.banner && (window.banner = new e)
			}
		};
		return o
	}),
	function(t, e) {
		"function" == typeof define && define.amd ? define("common/js/common/Carousel", e) : "object" == typeof exports ? module.exports = e() : t.Carousel = e()
	}(this, function() {
		function t(t) {
			var t = $.extend({
				box: "#qyer_banner",
				carousel: "#carousel",
				bannerbg: "#bannerbg",
				speeds: 5e3,
				onSlide: null
			}, t);
			this.opts = t, this.$bannerBox = $(t.box), this.$carouselBox = $(t.carousel), this.$bannerbgBox = $(t.bannerbg), this.$carouselInner = null, this.$barLeft = null, this.$barRight = null, this.autoTimer = null, this.isImgLoaded = !1, this.init()
		}
		return t.prototype = {
			init: function() {
				var t = this;
				return this.$carouselBox.find(".bannerimg").length <= 1 ? !1 : void setTimeout(function() {
					t.createLoadImg(t.$carouselBox.find(".bannerimg"))
				}, 2e3)
			},
			appendCarouselInner: function() {
				this.$carouselInner = $(this.createCarouselInner(this.$carouselBox.find(".carousel-data > li"))), this.$carouselBox.empty().append(this.$carouselInner).append(['<div class="bar left">', '<a class="iconfont icon-jiantou1zuo" data-bn-ipg="index-top-slideLeft" href="javascript:;"></a>', "</div>", '<div class="bar right">', '<a class="iconfont icon-jiantou1you" data-bn-ipg="index-top-slideRight" href="javascript:;"></a>', "</div>"].join("")), this.$barLeft = this.$carouselBox.find(".bar.left"), this.$barRight = this.$carouselBox.find(".bar.right")
			},
			createLoadImg: function(t) {
				var e = 0,
					i = this,
					o = function() {
						e++, e == t.length && (i.appendCarouselInner(), i.bindEvent(), i.isImgLoaded = !0, i.autoSlider())
					};
				t.each(function() {
					var t = new Image;
					t.src = this.value, t.setAttribute("data-bannerimg", this.getAttribute("data-bannerimg")), t.complete ? o() : t.onload = function() {
						o()
					}
				})
			},
			imgAllLoaded: function() {
				var t = this,
					e = function() {
						t.$barLeft ? (t.$barLeft.show().addClass("animationShow"), t.$barRight.show().addClass("animationShow")) : setTimeout(function() {
							e()
						}, 10)
					};
				e()
			},
			createCarouselInner: function(t) {
				var e = [],
					i = [];
				return win_w = Math.max(document.body.clientWidth, document.documentElement.clientWidth), t.each(function(e) {
					var o = "";
					o += "<li" + (0 == e ? ' class="current"' : "") + ">", o += '<div class="img" style="width: ' + win_w + "px;background-image: url(" + $(".bannerimg", this).val() + ');">', o += '<input type="hidden" class="h_imgsrc" value="' + $(".bannerimg", this).val() + '">', o += '<input type="hidden" class="h_text" value="' + $(".bannertext", this).val() + '">', o += '<input type="hidden" class="h_url" value="' + $(".bannerurl", this).val() + '">', o += '<div class="hotlink"><a data-bn-ipg="index-top-guide-' + $(".itemid", this).val() + '" href="' + $(".bannerlink", this).val() + '" target="_blank"></a></div>', o += '<div class="text-panel">', o += '<span class="num"><i>' + ++e + "</i>/<em>" + t.length + "</em></span>", o += '<div class="text">', o += $(".text", this).html(), o += "</div>", o += "</div>", o += "</div>", o += "</li>", i.push(o)
				}), e = ['<div class="carousel-inner">', "<ul>", i.join(""), "</ul>", "</div>"], e.join("")
			},
			bindEvent: function() {
				var t = this;
				$(window).resize(function(e) {
					var i = Math.max(document.body.clientWidth, document.documentElement.clientWidth);
					return 1160 >= i ? !1 : void t.$carouselInner.find("li,.img").width(i)
				}), this.$barLeft.bind("click", function() {
					t.stopAutoSlider(), t.slider("left")
				}), this.$barRight.bind("click", function() {
					t.stopAutoSlider(), t.slider("right")
				}), this.$bannerBox.bind("mouseleave", function() {
					t.isImgLoaded && t.autoSlider()
				}).bind("mouseenter", function() {
					t.stopAutoSlider()
				})
			},
			getTargetLi: function(t, e) {
				var i = "right" == t ? e.next().length ? e.next() : e.siblings().first() : e.prev().length ? e.prev() : e.siblings().last();
				return i
			},
			slider: function(t) {
				var e = this,
					i = this.$carouselInner.find(".current").length ? this.$carouselInner.find(".current") : this.$carouselInner.find("li:first"),
					o = this.getTargetLi(t, i);
				i[0].className = "transition " + t, o[0].className = "current anim-" + t, i.animate({
					width: 0
				}, 800, function() {
					this.style.width = "", this.className = "", e.opts.onSlide && e.opts.onSlide.call(e, o)
				})
			},
			setSearch: function(t) {
				this.$bannerBox.find(".place .txt").attr("placeholder", t.find(".h_text").val()), this.$bannerBox.find(".place .btn").attr("href", t.find(".h_url").val() ? t.find(".h_url").val() : "javascript:;")
			},
			autoSlider: function() {
				var t = this;
				clearInterval(this.autoTimer), this.autoTimer = setInterval(function() {
					t.slider("right")
				}, t.opts.speeds)
			},
			stopAutoSlider: function() {
				clearInterval(this.autoTimer)
			},
			changeBlurBg: function(t) {}
		}, t
	}),
	function(t, e) {
		"function" == typeof define && define.amd ? define("common/js/common/Slider", e) : "object" == typeof exports ? module.exports = e() : t.Slider = e()
	}(this, function() {
		function t(t) {
			this.opts = $.extend({
				box: ".slider",
				speeds: 5e3,
				onSlide: null,
				gradualShowClass: "gradually_col4_show"
			}, t), this.$sliderBox = $(this.opts.box), this.$sliderInner = this.$sliderBox.find(".slider-inner"), this.$sliderControl = this.$sliderBox.find(".slider-control"), this.init()
		}
		return t.prototype = {
			init: function() {
				this.bindEvent()
			},
			bindEvent: function() {
				var t = this;
				this.$sliderControl.on("mouseenter", "a", function() {
					return $(this).hasClass("current") ? !1 : void t.switchItem($(this))
				})
			},
			switchItem: function(t) {
				t.addClass("current").siblings().removeClass("current"), this.$sliderInner.find(".item").hide().removeClass(this.opts.gradualShowClass).eq(t.index()).show().addClass(this.opts.gradualShowClass).find(".lazy").lazyload({
					effect: "fadeIn"
				})
			}
		}, t
	}),
	function(t, e) {
		"function" == typeof define && define.amd ? define("common/js/home/PlaceSearch", e) : "object" == typeof exports ? module.exports = e() : t.PlaceSearch = e()
	}(this, function() {
		function t(t) {
			this.opts = $.extend({
				box: "#search",
				placeSearchBox: ".place_search_box",
				placeSearchHistory: ".q-layer-placesearch-history"
			}, t), this.$searchBox = $(this.opts.box), this.$placeSearchBox = $(this.opts.placeSearchBox), this.$history = $(this.opts.placeSearchHistory), this.$autocomplete = null, this.$input = $(".placesearch_txt"), this.$form = $(".place_search_form"), this.ajaxUrls = {
				placesearch: "qcross/home/ajax?action=search"
			}, this.searchTimer = null, this._history = [], this._search = {}, this.xhr = null, this.init()
		}
		return t.prototype = {
			init: function() {
				this.createAutoComplete(), this.getStorage(), this.bindEvent(), this.$input.trigger("focus")
			},
			showHistory: function() {
				this.getHistory(), this.$history.addClass("show"), this.hideAutoComplete(), this.clickDocumentEvent(this.$searchBox[0], this.searchBoxClose)
			},
			getHistory: function() {
				if (!this._history.length) return !1;
				var t = ['<div class="placesearch-history-title">', '<a class="fr placesearch-history-clear" href="javascript:;">清空记录</a>', "<span>搜索记录</span>", "</div>"];
				t.push('<div class="placesearch-history-cont history">');
				for (var e = 0; e < this._history.length; e++) t.push('<a data-bn-ipg="index-top-placeHistory-' + e + '" href="' + this._history[e].url + '&area_name='+this._history[e].key+'" target="_blank">' + this._history[e].key + "</a>");
				t.push("</div>"), $(".placesearch_history_box").html(t.join(""))
			},
			hideHistory: function() {
				this.$history.removeClass("show")
			},
			createAutoComplete: function() {
				var t = $('<div class="q-layer q-layer-placesearch-autocomplete"><ul></ul></div');
				this.$searchBox.append(t), this.$autocomplete = t
			},
			showAutoComplete: function() {
				this.hideHistory(), this.$autocomplete.addClass("show"), this.clickDocumentEvent(this.$searchBox[0], this.searchBoxClose)
			},
			hideAutoComplete: function() {
				this.$autocomplete.removeClass("show")
			},
			hideLayer: function() {
				this.hideHistory(), this.hideAutoComplete()
			},
			bindEvent: function() {
				var t = this;
				this.$input.on("click", function(e, i) {
					t.searchBoxActive()
				}), 
				/*this.$input.on("keyup", function(e) {
					if (9 == e.keyCode || 16 == e.keyCode || 17 == e.keyCode || 18 == e.keyCode || 20 == e.keyCode || 91 == e.keyCode || 93 == e.keyCode) return !1;
					switch (e.keyCode) {
						case 38:
							t.switchUpDown("up");
							break;
						case 40:
							t.switchUpDown("down");
							break;
						case 13:
							break;
						default:
							clearTimeout(t.searchTimer), t.setSearchLink(""), t.searchTimer = setTimeout(function() {
								"" === t.getSearchWord() ? (t.showHistory(), t.setSearchLink(t.getCarouselUrl())) : (t.showAutoComplete(), t.searchWord(t.getSearchWord()))
							}, 400)
					}
				}), */
				this.$autocomplete.on("mouseenter", "li", function() {
					t.currentLayer($(this))
				}), this.$searchBox.on("click", ".tab a", function() {
					t.hideLayer()
				}), this.$form.on("submit", function() {
					return "" == $(this).attr("action") ? !1 : void t.setStorage(t.getSearchWord(), t.getSearchLink())
				}), this.$history.on("click", ".placesearch-history-clear", function() {
					t.clearStorage()
				})
			},
			searchBoxActive: function() {
				"" === this.getSearchWord() ? this.showHistory() : this.searchWord(this.getSearchWord())
			},
			searchBoxClose: function() {
				this.hideLayer()
			},
			clickDocumentEvent: function(t, e) {
				var i = this,
					o = "e_" + (new Date).getTime();
				$(document).unbind("click." + o), $(document).bind("click." + o, function(s) {
					HomeUtil.isParent(s.target, t) || s.target == t || (e.call(i), $(document).unbind("click." + o))
				})
			},
			switchUpDown: function(t) {
				this.$autocomplete.is(":visible") && this.switchUpDownInAutoComplete(t)
			},
			switchUpDownInAutoComplete: function(t) {
				var e = this.$autocomplete.find("li"),
					i = this.$autocomplete.find("li.current"),
					o = null;
				o = "up" == t ? i.length && i.prev().length ? i.prev() : e.last() : i.length && i.next().length ? i.next() : e.first(), this.currentLayer(o)
			},
			currentLayer: function(t) {
				t.addClass("current").siblings().removeClass("current"), this.setSearchLink(t.attr("data-url"))
			},
			getSearchWord: function() {
				return HomeUtil.fliterScript($.trim(this.$input.val()))
			},
			setSearchWord: function(t) {
				this.$input.val(t)
			},
			getCarouselUrl: function() {
				return $("#carousel li.current .h_url").val()
			},
			getSearchLink: function() {
				return this.$form.attr("action")
			},
			setSearchLink: function(t) {
				this.$form.attr("action", t)
			},
			getStorage: function() {
				if (window.localStorage && window.localStorage.placesearch_history) {
					var t = window.localStorage.placesearch_history;
					this._history = JSON.parse(t)
				}
				return this._history
			},
			setStorage: function(t, e) {
				if (!window.localStorage || "" == t) return !1;
				for (var i = -1, o = 0; o < this._history.length; o++)
					if (this._history[o].key == t) {
						i = o;
						break
					} - 1 != i && this._history.splice(o, 1), this._history.unshift({
					key: t,
					url: e
				}), window.localStorage.placesearch_history = JSON.stringify(this._history)
			},
			clearStorage: function() {
				return window.localStorage ? (window.localStorage.removeItem("placesearch_history"), this._history = [], void this.$history.find(".history").empty()) : !1
			},
			searchWord: function(t) {
				this._search[t] ? this.setAutoComplete(this.$autocomplete, this._search[t]) : (this.ajaxSearch(t), this.$autocomplete.html(this.ajaxLoading()))
			},
			ajaxSearch: function(t) {
				var e = this,
					i = {
						keyword: t,
						timer: (new Date).getTime()
					};
				$.getJSON(this.ajaxUrls.placesearch, i, function(i) {
					0 == i.error_code ? i.data.keyword == e.getSearchWord() && e.renderAutoComplete(e.$autocomplete, i.data, t) : i.data.msg && ajaxError(i.data.msg)
				})
			},
			renderAutoComplete: function(t, e, i) {
				var o = [],
					s = 0;
				if (o.push("<ul>"), !$.isEmptyObject(e.list))
					for (var n in e.list) {
						var a = e.list[n];
						if ("poi" == a.type_name) o.push('<li data-type="' + a.type_name + '" data-url="' + a.url + '">'), o.push('<div class="placesearch-title">'), o.push('<a data-bn-ipg="index-top-placeThink-' + s + '" class="placesearch-poi" href="' + a.url + '" target="_blank">'), o.push('<san class="fr">' + a.belong_name + "</san>"), o.push('<em class="cn">' + a.cn_name + '</em> <em class="en">' + a.en_name + "</em>"), o.push("</a>"), o.push("</div>"), o.push("</li>");
						else {
							o.push('<li data-type="' + a.type_name + '" data-url="' + a.url + '">'), o.push('<div class="placesearch-title placesearch-city-title">'), o.push('<a data-bn-ipg="index-top-placeThink-' + s + '" class="placesearch-name" href="' + a.url + '" target="_blank">'), o.push('<san class="fr">' + a.belong_name + "</san>"), o.push('<em class="cn">' + a.cn_name + '</em> <em class="en">' + a.en_name + "</em>"), o.push("</a>"), o.push("</div>"), o.push('<div class="placesearch-info">');
							for (var r = 0; r < a.entry.length; r++) {
								var l = a.entry[r];
								o.push('<a data-bn-ipg="index-top-placeThink-' + s + r + '" href="' + l.url + '" class="placesearch-info-block" target="_blank">'), o.push('<i class="iconfont ' + l["class"] + '"></i>'), o.push("<span>" + l.name + "</span>"), o.push("</a>")
							}
							o.push("</div>"), o.push("</li>")
						}
						s += 1
					}
				o.push('<li data-type="result-empty" data-url="http://search.qyer.com/index?wd=' + encodeURIComponent(i) + '"><div class="placesearch-title"><a class="placesearch-poi" href="http://search.qyer.com/index?wd=' + encodeURIComponent(i) + '" target="_blank">查看更多关于“<span style="color: #10B042;">' + i + "</span>”的搜索结果</a></div></li>"), o.push("</ul>"), o = o.join(""), t.html(o), this._search[i] = {
					html: o,
					url: e.url
				}, this.currentLayer(t.find("li:first")), this.hideHistory()
			},
			setAutoComplete: function(t, e) {
				var i = e.html;
				t.html(i), this.currentLayer(t.find("li:first")), this.hideHistory(), this.showAutoComplete()
			},
			ajaxLoading: function() {
				return '<div class="loading"></div>'
			}
		}, t
	}),
	function(t, e) {
		"function" == typeof define && define.amd ? define("common/js/home/ZSearch", e) : "object" == typeof exports ? module.exports = e() : t.ZSearch = e()
	}(this, function() {
		function t(t) {
			this.opts = $.extend({
				box: "#search",
				zSearchBox: ".z_search_box",
				zSearchHistory: ".q-layer-zsearch-history"
			}, t), this.$searchBox = $(this.opts.box), this.$zSearchBox = $(this.opts.zSearchBox), this.$history = $(this.opts.zSearchHistory), this.$autocomplete = null, this.$input = $(".zsearch_txt"), this.$form = $(".z_search_form"), this.ajaxUrls = {
				zsearch: "qcross/home/ajax?action=search"
			}, this.searchTimer = null, this._history = [], this._search = {}, this.init()
		}
		return t.prototype = {
			init: function() {
				this.createAutoComplete(), this.getStorage(), this.bindEvent()
			},
			showHistory: function() {
				this.getHistory(), this.$history.addClass("show"), this.hideAutoComplete(), this.clickDocumentEvent(this.$searchBox[0], this.searchBoxClose)
			},
			getHistory: function() {
				if (!this._history.length) return !1;
				var t = ['<div class="zsearch-history-title">', '<a class="fr zsearch-history-clear" href="javascript:;">清空记录</a>', "<span>搜索记录</span>", "</div>"];
				t.push('<div class="zsearch-history-cont history">');
				for (var e = 0; e < this._history.length; e++) t.push('<a data-bn-ipg="index-top-lmHistory-' + e + '" href="' + this._history[e].url + '" target="_blank">' + this._history[e].key + "</a>");
				t.push("</div>"), $(".zsearch_history_box").html(t.join(""))
			},
			hideHistory: function() {
				this.$history.removeClass("show")
			},
			createAutoComplete: function() {
				var t = $('<div class="q-layer q-layer-zsearch-autocomplete"><ul></ul></div');
				this.$searchBox.append(t), this.$autocomplete = t
			},
			showAutoComplete: function() {
				this.$autocomplete.addClass("show"), this.clickDocumentEvent(this.$searchBox[0], this.searchBoxClose)
			},
			hideAutoComplete: function() {
				this.$autocomplete.removeClass("show")
			},
			hideLayer: function() {
				this.hideHistory(), this.hideAutoComplete()
			},
			bindEvent: function() {
				var t = this;
				this.$input.on("click", function(e, i) {
					t.searchBoxActive()
				}), this.$input.on("keyup", function(e) {
					return 9 == e.keyCode || 16 == e.keyCode || 17 == e.keyCode || 18 == e.keyCode || 20 == e.keyCode || 91 == e.keyCode || 93 == e.keyCode ? !1 : void("" === t.getSearchWord() ? t.showHistory() : t.hideHistory())
				}), this.$autocomplete.on("mouseenter", "li", function() {
					t.currentLayer($(this))
				}), this.$searchBox.on("click", ".tab a", function() {
					t.hideLayer()
				}), this.$form.on("submit", function() {
					return "" == $(this).attr("action") ? !1 : void t.setStorage(t.getSearchWord(), t.getSearchLink())
				}), this.$history.on("click", ".zsearch-history-clear", function() {
					t.clearStorage()
				})
			},
			searchBoxActive: function() {
				"" === this.getSearchWord() && this.showHistory()
			},
			searchBoxClose: function() {
				this.hideLayer()
			},
			clickDocumentEvent: function(t, e) {
				var i = this,
					o = "e_" + (new Date).getTime();
				$(document).unbind("click." + o), $(document).bind("click." + o, function(s) {
					HomeUtil.isParent(s.target, t) || s.target == t || (e.call(i), $(document).unbind("click." + o))
				})
			},
			switchUpDown: function(t) {
				this.$autocomplete.is(":visible") && this.switchUpDownInAutoComplete(t)
			},
			switchUpDownInAutoComplete: function(t) {
				var e = this.$autocomplete.find("li"),
					i = this.$autocomplete.find("li.current"),
					o = null;
				o = "up" == t ? i.length && i.prev().length ? i.prev() : e.last() : i.length && i.next().length ? i.next() : e.first(), this.currentLayer(o)
			},
			currentLayer: function(t) {
				t.addClass("current").siblings().removeClass("current"), this.$form.attr("action", t.attr("data-url"))
			},
			getSearchWord: function() {
				return HomeUtil.fliterScript($.trim(this.$input.val()))
			},
			setSearchWord: function(t) {
				this.$input.val(t)
			},
			getSearchLink: function() {
				return this.$form.attr("data-action")
			},
			setSearchLink: function(t) {
				this.$form.attr("action", t)
			},
			getStorage: function() {
				if (window.localStorage && window.localStorage.zsearch_history) {
					var t = window.localStorage.zsearch_history;
					this._history = JSON.parse(t)
				}
				return this._history
			},
			setStorage: function(t, e) {
				if (!window.localStorage || "" == t) return !1;
				for (var i = -1, o = 0; o < this._history.length; o++)
					if (this._history[o].key == t) {
						i = o;
						break
					} - 1 != i && this._history.splice(o, 1), this._history.unshift({
					key: t,
					url: e + "&kw=" + window.encodeURIComponent(t)
				}), window.localStorage.zsearch_history = JSON.stringify(this._history)
			},
			clearStorage: function() {
				return window.localStorage ? (window.localStorage.removeItem("zsearch_history"), this._history = [], void this.$history.find(".history").empty()) : !1
			},
			searchWord: function(t) {
				this._search[t] ? this.setAutoComplete(this.$autocomplete, this._search[t]) : this.ajaxSearch(t)
			},
			ajaxSearch: function(t) {
				var e = this,
					i = {
						keyword: t,
						timer: (new Date).getTime()
					};
				$.getJSON(this.ajaxUrls.zsearch, i, function(i) {
					0 == i.error_code ? e.renderAutoComplete(e.$autocomplete, i.data, t) : i.data.msg && ajaxError(i.data.msg)
				})
			},
			renderAutoComplete: function(t, e, i) {
				var o = [];
				if (e.list.length) {
					o.push("<ul>");
					for (var s = 0; s < e.list.length; s++) {
						var n = e.list[s];
						if ("poi" == n.type_name) o.push('<li data-type="' + n.type_name + '" data-wd="' + (n.cn_name ? n.cn_name : n.en_name) + '" data-url="' + n.url + '">'), o.push('<div class="zsearch-title">'), o.push('<a class="zsearch-poi" href="' + n.url + '">'), o.push('<san class="fr">' + n.belong_name + "</san>"), o.push('<em class="cn">' + n.cn_name + '</em> <em class="en">' + n.en_name + "</em>"), o.push("</a>"), o.push("</div>"), o.push("</li>");
						else {
							o.push('<li data-type="' + n.type_name + '" data-wd="' + (n.cn_name ? n.cn_name : n.en_name) + '" data-url="' + n.url + '">'), o.push('<div class="zsearch-title zsearch-city-title">'), o.push('<a class="zsearch-name" href="' + n.url + '">'), o.push('<san class="fr">' + n.belong_name + "</san>"), o.push('<em class="cn">' + n.cn_name + '</em> <em class="en">' + n.en_name + "</em>"), o.push("</a>"), o.push("</div>"), o.push('<div class="zsearch-info">');
							for (var a = 0; a < n.entry.length; a++) {
								var r = n.entry[a];
								o.push('<a href="' + r.url + '" class="zsearch-info-block">'), o.push('<i class="iconfont ' + r["class"] + '"></i>'), o.push("<span>" + r.name + "</span>"), o.push("</a>")
							}
							o.push("</div>"), o.push("</li>")
						}
					}
					o.push("</ul>")
				} else o.push('<div class="result-empty">没有匹配的目的地</div>');
				o = o.join(""), t.html(o), this._search[i] = {
					html: o,
					url: e.url
				}, this.setSearchLink(e.url ? e.url : ""), this.hideHistory(), this.showAutoComplete()
			},
			setAutoComplete: function(t, e) {
				var i = e.html;
				t.html(i), this.setSearchLink(e.url ? e.url : ""), this.hideHistory(), this.showAutoComplete()
			}
		}, t
	}), define("common/models/basic/js/normalize", [], function() {
		function t(t, i, s) {
			if (t.match(r) || t.match(a)) return t;
			t = n(t);
			var l = s.match(a),
				c = i.match(a);
			return !c || l && l[1] == c[1] && l[2] == c[2] ? o(e(t, i), s) : e(t, i)
		}

		function e(t, e) {
			if ("./" == t.substr(0, 2) && (t = t.substr(2)), t.match(r) || t.match(a)) return t;
			var i = e.split("/"),
				o = t.split("/");
			for (i.pop(); curPart = o.shift();) ".." == curPart ? i.pop() : i.push(curPart);
			return i.join("/")
		}

		function o(t, e) {
			var o = e.split("/");
			for (o.pop(), e = o.join("/") + "/", i = 0; e.substr(i, 1) == t.substr(i, 1);) i++;
			for (;
				"/" != e.substr(i, 1);) i--;
			e = e.substr(i + 1), t = t.substr(i + 1), o = e.split("/");
			var s = t.split("/");
			for (out = ""; o.shift();) out += "../";
			for (; curPart = s.shift();) out += curPart + "/";
			return out.substr(0, out.length - 1)
		}
		var s = /([^:])\/+/g,
			n = function(t) {
				return t.replace(s, "$1/")
			},
			a = /[^\:\/]*:\/\/([^\/])*/,
			r = /^(\/|data:)/,
			l = function(e, i, o) {
				i = n(i), o = n(o);
				for (var s, a, e, r = /@import\s*("([^"]*)"|'([^']*)')|url\s*\((?!#)\s*(\s*"([^"]*)"|'([^']*)'|[^\)]*\s*)\s*\)/gi; s = r.exec(e);) {
					a = s[3] || s[2] || s[5] || s[6] || s[4];
					var l;
					l = t(a, i, o);
					var c = s[5] || s[6] ? 1 : 0;
					e = e.substr(0, r.lastIndex - a.length - c - 1) + l + e.substr(r.lastIndex - c - 1), r.lastIndex = r.lastIndex + (l.length - a.length)
				}
				return e
			};
		return l.convertURIBase = t, l.absoluteURI = e, l.relativeURI = o, l
	}), define("common/models/basic/js/require-css", [], function() {
		if ("undefined" == typeof window) return {
			load: function(t, e, i) {
				i()
			}
		};
		var t = document.getElementsByTagName("head")[0],
			e = window.navigator.userAgent.match(/Trident\/([^ ;]*)|AppleWebKit\/([^ ;]*)|Opera\/([^ ;]*)|rv\:([^ ;]*)(.*?)Gecko\/([^ ;]*)|MSIE\s([^ ;]*)|AndroidWebKit\/([^ ;]*)/) || 0,
			i = !1,
			o = !0;
		e[1] || e[7] ? i = parseInt(e[1]) < 6 || parseInt(e[7]) <= 9 : e[2] || e[8] ? o = !1 : e[4] && (i = parseInt(e[4]) < 18);
		var s = {};
		s.pluginBuilder = "./css-builder";
		var n, a, r, l = function() {
				n = document.createElement("style"), t.appendChild(n), a = n.styleSheet || n.sheet
			},
			c = 0,
			h = [],
			d = function(t) {
				c++, 32 == c && (l(), c = 0), a.addImport(t), n.onload = function() {
					u()
				}
			},
			u = function() {
				r();
				var t = h.shift();
				return t ? (r = t[1], void d(t[0])) : void(r = null)
			},
			p = function(t, e) {
				if (a && a.addImport || l(), a && a.addImport) r ? h.push([t, e]) : (d(t), r = e);
				else {
					n.textContent = '@import "' + t + '";';
					var i = setInterval(function() {
						try {
							n.sheet.cssRules, clearInterval(i), e()
						} catch (t) {}
					}, 10)
				}
			},
			f = function(e, i) {
				var s = document.createElement("link");
				if (s.type = "text/css", s.rel = "stylesheet", o) s.onload = function() {
					s.onload = function() {}, setTimeout(i, 7)
				};
				else var n = setInterval(function() {
					for (var t = 0; t < document.styleSheets.length; t++) {
						var e = document.styleSheets[t];
						if (e.href == s.href) return clearInterval(n), i()
					}
				}, 10);
				s.href = e, t.appendChild(s)
			};
		return s.normalize = function(t, e) {
			return ".css" == t.substr(t.length - 4, 4) && (t = t.substr(0, t.length - 4)), e(t)
		}, s.load = function(t, e, o, s) {
			(i ? p : f)(e.toUrl(t + ".css"), o)
		}, s
	}), define("common/models/basic/js/require-css!web_old_tip", [], function() {}), define("web_old_tip", ["css!web_old_tip"], function() {
		function t(t) {
			o.html(t.text || "&nbsp;"), i[0].className = "qui-tip-box", "error" == t.type ? i.addClass("qui-tip-box-error") : "warning" == t.type && i.addClass("qui-tip-box-warning")
		}
		var e, i, o, s = jQuery;
		! function() {
			var t = ['<div class="qui-tip" style="display:none;" >', '<div class="qui-tip-box">', '<span class="qui-tip-text fontYaHei">这里是提示文本</span>', "</div>", "</div>"].join("");
			e = s(t), o = e.find(".qui-tip-text"), i = e.find(".qui-tip-box"), e.appendTo(document.body)
		}();
		var n = {
			_timer: null,
			tip: function(i) {
				return t(i), e.slideDown(200), window.clearTimeout(this._timer), this._timer = setTimeout(function() {
					e.slideUp(200)
				}, i.time || 3e3), this
			}
		};
		return n
	}), define("common/js/home/Interest", ["common/js/common/Slider", "web_old_tip"], function(t, e) {
		function i(t) {
			this.opts = $.extend({
				box: "#interest"
			}, t), this.ajaxUrls = {
				interest: "qcross/home/ajax?action=guess",
				uninterest: "qcross/home/ajax?action=notinterest"
			}, this.$interestBox = $(t.box), this.uid = null, this.ajaxLoad = !1, this.draft = null, this.init()
		}
		return i.prototype = {
			init: function() {
				this.ajaxInterest(!0), this.bindEvent()
			},
			ajaxInterest: function(t) {
				var e = this,
					i = {
						timer: +new Date
					};
				$.getJSON(this.ajaxUrls.interest, i, function(i) {
					0 === i.error_code && (e.uid = i.data.uid, e.renderInterest(i.data.list, t, i.data.requestId), e.draft = i.data.draft)
				})
			},
			ajaxUnInterest: function(t) {
				var e = t.parent(),
					i = this,
					o = {
						groupid: t.attr("data-group"),
						item_id: t.attr("data-id"),
						type: t.attr("data-type"),
						timer: (new Date).getTime()
					};
				$.getJSON(this.ajaxUrls.uninterest, o, function(t) {
					0 === t.error_code && i.renderItem(e, t.data.item)
				})
			},
			renderInterest: function(t, e, i) {
				var o, s = ['<a class="change" data-bn-ipg="index-guess-change" data-ra_arg="' + i + '|0" data-requestid="' + i + '" href="javascript:;"><i class="iconfont icon-shuaxin"></i> 换一换</a>'];
				s.push('<div class="interest_inner">'), s.push(this.getInterestInner(t)), s.push("</div>"), o = $(s.join("")), 0 === this.uid && o.find("li").eq(3).addClass("li_login").html(this.getLoginInner()), this.$interestBox.html(o), $("img.lazy:visible", this.$interestBox).lazyload({
					effect: "fadeIn"
				})
			},
			renderItem: function(t, e) {
				t.append(this.getItemInner(e, "sub"))
			},
			getInterestInner: function(t) {
				for (var e = [], i = 0; i < t.length; i++) {
					e.push("<ul" + (0 === i ? ' style="display: block;" class="gradually_col4_show"' : "") + ">");
					for (var o = 0; o < t[i].length; o++) e.push("<li>"), e.push(this.getItemInner(t[i][o], i, o)), e.push("</li>");
					e.push("</ul>")
				}
				return e.join("")
			},
			getItemInner: function(t, e, i, o) {
				var s = [];
				return s.push('<div class="item ' + (o ? o : "") + '" data-group="' + e + '" data-index="' + i + '" data-type="' + t.type + '" data-id="' + t.id + '">'), s.push('<a class="close iconfont icon-wrong" data-bn-ipg="index-guess-dislike-' + t.type + '" href="javascript:;" title="并不感兴趣" data-ra_arg="' + t.ra_arg + '"></a>'), s.push('<div class="img">'), s.push('<a data-bn-ipg="index-guess-pic' + e + i + "-" + t.type + "-" + t.id + '" data-ra_arg="' + t.ra_arg + '" href="' + t.url + '" target="_blank">'), o ? s.push('<img src="' + t.pic + '" width="275" height="185">') : s.push('<img class="lazy" src="http://home.qyerstatic.com/common/images/common/grey.gif" data-original="' + t.pic + '" width="275" height="185">'), s.push('<div class="bg">'), s.push('<div class="p"></div>'), s.push("<span>" + t.reason + "</span>"), s.push("</div>"), s.push('<div class="tag">'), s.push('<span><i class="iconfont ' + t["class"] + '"></i></span>'), s.push('<span class="bt">' + t.subtype + "</span>"), s.push("</div>"), s.push("</a>"), s.push("</div>"), s.push('<div class="info">'), s.push('<a data-bn-ipg="index-guess-title' + e + i + "-" + t.type + "-" + t.id + '" data-ra_arg="' + t.ra_arg + '" href="' + t.url + '" target="_blank">'), s.push('<div class="subtitle">'), "undefined" != typeof t.title ? s.push("<p>" + t.title + "</p>") : (t.cn_name && s.push('<p class="ellipsis">' + t.cn_name + "</p>"), t.en_name && s.push('<p class="ellipsis"><span>' + t.en_name + "</span></p>")), s.push("</div>"), s.push('<div class="bottom">'), s.push('<span class="fr">' + this.getItemRightInner(t) + "</span>"), s.push('<span class="f14">' + this.getItemLeftInner(t) + "</span>"), s.push("</div>"), s.push("</a>"), s.push("</div>"), s.push("</div>"), s.join("")
			},
			getItemLeftInner: function(t) {
				return t.text ? t.text : t.username ? t.username : t.place ? t.place : ""
			},
			getItemRightInner: function(t) {
				return "poi" == t.type ? t.ranking : "city" == t.type ? t.been_to_counts + "个人去过这里" : "skus" == t.type ? t.price : "threads" == t.type ? t.total_views + "人浏览过" : "mguide" == t.type ? t.poi_count : ""
			},
			getLoginInner: function() {
				var t, e = ['<div class="login">', '<div class="login-title">', "<h3>让我们更懂你</h3>", "<p>拥有穷游账号，获得更准确的推荐</p>", "</div>", '<div class="login-link">', '<a data-bn-ipg="index-guess-un-register" href="javascript:;" class="register-btn register-phone">立即注册</a>', "<span>", '已有帐号？<a data-bn-ipg="index-guess-un-login" class="login-mail" href="javascript:;">登录</a>', "</span>", "</div>", '<div class="auth-login">', '<a data-bn-ipg="index-guess-un-email" class="register-mail" href="javascript:;">使用邮箱注册</a>', '<a data-bn-ipg="index-guess-un-qq" data-type="qq" href="javascript:;" class="login-auth iconfont icon-qq1"></a>', '<a data-bn-ipg="index-guess-un-weibo" data-type="weibo" href="javascript:;" class="login-auth iconfont icon-weibo1"></a>', '<a data-bn-ipg="index-guess-un-wechat" data-type="weixin" href="javascript:;" class="login-auth iconfont icon-weixin1"></a>', "</div>", "</div>"].join("");
				return t = $(e), t.on("click", ".register-phone", function() {
					qyerUtil.doSignin({
						pageType: "phone"
					})
				}).on("click", ".register-mail", function() {
					qyerUtil.doSignin()
				}).on("click", ".login-mail", function() {
					qyerUtil.doLogin()
				}).on("click", ".login-auth", function() {
					HomeUtil.otherlogin(this.getAttribute("data-type"))
				}), t
			},
			bindEvent: function() {
				var t = this;
				this.$interestBox.on("click", ".change", function() {
					var e = t.$interestBox.find(".interest_inner > ul:visible").hide().removeClass("gradually_col4_show").next();
					e.length || (e = t.$interestBox.find(".interest_inner > ul:first")), this.setAttribute("data-ra_arg", this.getAttribute("data-requestid") + "|" + e.index()), e.show().addClass("gradually_col4_show").find("img.lazy").lazyload({
						effect: "fadeIn"
					})
				}), this.$interestBox.on("click", ".close", function() {
					t.uid > 0 ? t.unInterest($(this).closest(".item")) : qyerUtil.doLogin()
				})
			},
			unInterest: function(t) {
				var i = this,
					o = t.attr("data-type"),
					s = t.attr("data-group"),
					n = t.attr("data-id"),
					a = t.attr("data-index"),
					r = t.find(".tag .bt").html(),
					l = null,
					c = null,
					h = {
						groupid: s,
						item_id: n,
						type: o,
						timer: (new Date).getTime()
					};
				this.draft[o] && this.draft[o].length ? (c = this.draft[o].splice(0, 1), l = $(this.getItemInner(c[0], s, a, "sub")), t.prev().remove(), t.after(l), setTimeout(function() {
					i.changeItem(t, l)
				}, 10), $.getJSON(this.ajaxUrls.uninterest, h, function(t) {
					0 === t.error_code
				})) : e.tip({
					text: "今天没有更多" + r + "推荐了，明天再来看看吧～",
					type: "warning"
				})
			},
			changeItem: function(t, e) {
				t.addClass("del"), e.removeClass("sub")
			},
			ajaxLoading: function() {
				return '<div class="sk-wave"><div class="sk-rect sk-rect1"></div> <div class="sk-rect sk-rect2"></div> <div class="sk-rect sk-rect3"></div> <div class="sk-rect sk-rect4"></div> <div class="sk-rect sk-rect5"></div></div>'
			}
		}, i
	}), define("common/js/common/FlipTimer", [], function() {
		function t(t) {
			this.opts = $.extend({
				box: ".flip-box",
				isFlip: !0
			}, t), this.$flipBox = $(this.opts.box), this.flipTimer = this.opts.datetime || this.$flipBox.attr("data-timer") || "", this.timer = null, this.init()
		}
		return t.prototype = {
			init: function() {
				var t = this;
				this.createFlipInner(), this.opts.isFlip && (this.endDate = new Date(this.flipTimer), this.endTime = this.endDate.getTime(), setTimeout(function() {
					t.updateTime()
				}, 0))
			},
			updateTime: function() {
				var t = this,
					e = (new Date).getTime(),
					i = this.endTime - e,
					o = {
						hour: this.timeToString(Math.floor(i / 1e3 / 60 / 60 % 24)),
						minute: this.timeToString(Math.floor(i / 1e3 / 60 % 60)),
						second: this.timeToString(Math.floor(i / 1e3 % 60))
					};
				if (o.hour < 99 && i > 1) {
					for (var s in o) this.setTimes(s, o[s]);
					this.timer = setTimeout(function() {
						t.updateTime()
					}, 1e3)
				} else "function" == typeof this.opts.timeEndCallback && this.opts.timeEndCallback()
			},
			stopTime: function() {
				var t = this;
				clearTimeout(this.timer), this.$flipBox.html(""), setTimeout(function() {
					t.createFlipInner()
				}, 365)
			},
			createFlipInner: function() {
				var t = ['<div class="flip-group">', '<div class="flip-digit">', '<span class="num top hour-tens-top">0</span>', '<span class="num bottom hour-tens-bottom"><i>0</i></span>', '<div class="flip-swapper hour-tens-swapper">', '<span class="num top hour-tens-top-anim">0</span>', '<span class="num bottom hour-tens-bottom-anim"><i>0</i></span>', "</div>", "</div>", '<div class="flip-digit">', '<span class="num top hour-ones-top">0</span>', '<span class="num bottom hour-ones-bottom"><i>0</i></span>', '<div class="flip-swapper hour-ones-swapper">', '<span class="num top hour-ones-top-anim">0</span>', '<span class="num bottom hour-ones-bottom-anim"><i>0</i></span>', "</div>", "</div>", "</div>", '<div class="flip-colon">:</div>', '<div class="flip-group">', '<div class="flip-digit">', '<span class="num top minute-tens-top">0</span>', '<span class="num bottom minute-tens-bottom"><i>0</i></span>', '<div class="flip-swapper minute-tens-swapper">', '<span class="num top minute-tens-top-anim">0</span>', '<span class="num bottom minute-tens-bottom-anim"><i>0</i></span>', "</div>", "</div>", '<div class="flip-digit">', '<span class="num top minute-ones-top">0</span>', '<span class="num bottom minute-ones-bottom"><i>0</i></span>', '<div class="flip-swapper minute-ones-swapper">', '<span class="num top minute-ones-top-anim">0</span>', '<span class="num bottom minute-ones-bottom-anim"><i>0</i></span>', "</div>", "</div>", "</div>", '<div class="flip-colon">:</div>', '<div class="flip-group">', '<div class="flip-digit">', '<span class="num top second-tens-top">0</span>', '<span class="num bottom second-tens-bottom"><i>0</i></span>', '<div class="flip-swapper second-tens-swapper">', '<span class="num top second-tens-top-anim">0</span>', '<span class="num bottom second-tens-bottom-anim"><i>0</i></span>', "</div>", "</div>", '<div class="flip-digit">', '<span class="num top second-ones-top">0</span>', '<span class="num bottom second-ones-bottom"><i>0</i></span>', '<div class="flip-swapper second-ones-swapper">', '<span class="num top second-ones-top-anim">0</span>', '<span class="num bottom second-ones-bottom-anim"><i>0</i></span>', "</div>", "</div>", "</div>"].join("");
				this.$flipBox.html(t)
			},
			setTimes: function(t, e) {
				this.setTime(this.getPreviousTime(t + "-tens"), e[0], t + "-tens"), this.setTime(this.getPreviousTime(t + "-ones"), e[1], t + "-ones")
			},
			setTime: function(t, e, i) {
				t !== e && (setTimeout(function() {
					$("." + i + "-top", this.$flipBox).text(e)
				}, 150), setTimeout(function() {
					$("." + i + "-bottom > i", this.$flipBox).text(e)
				}, 365), this.animateTime(t, e, i))
			},
			animateTime: function(t, e, i) {
				var o, s, n = this;
				o = $("." + i + "-top-anim", this.$flipBox), s = $("." + i + "-bottom-anim", this.$flipBox), o.show(), s.show(), o.text(t), s.find("i").text(e), this.animateNumSwap(i), setTimeout(function() {
					n.hideNumSwap(i)
				}, 365)
			},
			animateNumSwap: function(t) {
				$("." + t + "-swapper").addClass("animate")
			},
			hideNumSwap: function(t) {
				$("." + t + "-swapper").removeClass("animate"), $("." + t + "-top-anim", this.$flipBox).hide(), $("." + t + "-bottom-anim", this.$flipBox).hide()
			},
			getPreviousTime: function(t) {
				return $("." + t + "-top", this.$flipBox).text()
			},
			timeToString: function(t) {
				var e;
				return e = t.toString(), 1 === e.length ? "0" + e : e
			}
		}, t
	}), define("common/js/home/Lastminute", ["common/js/common/Slider", "common/js/common/FlipTimer"], function(t, e) {
		function i(t) {
			this.opts = $.extend({
				box: "#lastminute"
			}, t), this.ajaxUrls = {
				lastminute: "qcross/home/ajax?action=lastmin",
				lmhour: "qcross/home/ajax?action=lmhour"
			}, this.$lastminuteBox = $(t.box), this.$buytodayContainer = this.$lastminuteBox.find(".buytoday-container"), this.$buytoday = null, this.sliderLen = 0, this.init()
		}
		return i.prototype = {
			init: function() {
				this.loadLastminute()
			},
			loadLastminute: function() {
				var t = this,
					e = {
						timer: (new Date).getTime()
					};
				$.getJSON(this.ajaxUrls.lastminute, e, function(e) {
					0 === e.error_code && t.renderLastminute(e.data.item)
				})
			},
			renderLastminute: function(t) {
				var e, i = [],
					o = [];
				this.sliderLen = Math.ceil((t.length + 2) / 6), o.push('<div class="slider-control">'), i.push('<div class="slider slider-lastminute">'), i.push('<div class="slider-inner">');
				for (var s = 0; s < this.sliderLen; s++) {
					i.push('<div class="item' + (0 === s ? " active" : "") + '">'), i.push("<ul>");
					var n = 0;
					for (0 === s && (i.push('<li class="buytoday"></li>'), n = 2), n; 6 > n; n++) {
						var a = n + 6 * s - 2;
						if (!t[a]) break;
						i.push("<li>"), i.push(this.getItemInner(t[a], "" + s + n)), i.push("</li>")
					}
					i.push("</ul>"), i.push("</div>"), o.push("<a" + (0 === s ? ' class="current"' : "") + ' data-bn-ipg="index-world-page" href="javascript:;"></a>')
				}
				i.push("</div>"), o.push("</div>"), i.push(o.join("")), i.push("</div>"), i.push('<div class="more">'), i.push('<a href="http://z.qyer.com/" data-bn-ipg="index-world-more" target="_blank">查看更多折扣</a>'), i.push("</div>"), e = $(i.join("")), this.$buytoday = e.find(".buytoday"), this.addBuyToday(this.$buytodayContainer.find(".buytoday:first")), this.$lastminuteBox.find(".sk-wave").hide(), this.$lastminuteBox.append(e), this.bindEvent()
			},
			getItemInner: function(t, e) {
				return ['<a data-bn-ipg="index-world-zhe-' + e + "-" + t.id + '" href="' + t.url + '" target="_blank" data-ra_arg="' + t.ra_arg + '"><div class="discount" data-id="' + t.id + '">', '<img class="lazy img" src="http://home.qyerstatic.com/common/images/common/grey.gif" data-original="' + t.imgsrc + '" width="120" height="120">', '<div class="inner">', '<div class="caption">', "" + t.title, "</div>", '<div class="st">', '<span class="time">' + t.datetime + "</span>", '<span class="tag">' + t.tag + "</span>", "</div>", '<div class="price">', "<span>" + t.price + "</span>", "</div>", "</div>", "</div></a>"].join("")
			},
			bindEvent: function() {
				new t({
					box: ".slider-lastminute",
					gradualShowClass: "gradually_col3_show"
				}), $("img.lazy:visible", this.$lastminuteBox).lazyload({
					effect: "fadeIn"
				})
			},
			addBuyToday: function(t) {
				var i, o = this,
					s = t.find(".flip-box"),
					n = t.find(".btn"),
					a = t.find(".disabled"),
					r = t.attr("data-id"),
					l = new Date,
					c = new Date(s.attr("data-timer-start")),
					h = new Date(s.attr("data-timer-end")),
					d = {
						box: s
					},
					u = null,
					p = function() {
						var t = o.$buytodayContainer.find(".buytoday:first");
						t.length ? o.addBuyToday(t) : (n.hide(), a.text("已抢光").show())
					},
					f = function() {
						$.getJSON(o.ajaxUrls.lmhour, {
							id: r,
							timer: +l
						}).done(function(t) {
							0 === t.error_code && (1 == t.data.onsale ? (n.show(), a.hide(), setTimeout(f, 6e4)) : (n.hide(), a.text("已抢光").show(), u && u.stopTime()))
						})
					};
				if (s.attr("data-timer-next") && (i = new Date(s.attr("data-timer-next"))), this.$buytoday.html(t), c > l) d = $.extend(d, {
					isFlip: !0,
					datetime: c,
					timeEndCallback: function() {
						f()
					}
				}), a.text("马上开抢").show();
				else if (h > l) 0 == t.attr("data-isonline") ? d.isFlip = !1 : d = $.extend(d, {
					isFlip: !0,
					datetime: h,
					timeEndCallback: function() {
						p()
					}
				}), t.find("h3").html("限时秒杀"), f();
				else if (i) {
					if (!(36e5 >= i - l && h != i)) return void p();
					d.isFlip = !1, a.text("已抢光").show(), setTimeout(p, i - l)
				} else d.isFlip = !1, a.show();
				u = new e(d)
			}
		}, i
	}), define("common/js/home/Hottravels", ["common/js/common/Slider"], function(t) {
		"use strict";

		function e(t) {
			this.opts = $.extend({
				box: "#Hottravels"
			}, t), this.ajaxUrls = {
				hottravels: "qcross/home/ajax?action=thread"
			}, this.$hottravelsBox = $(t.box), this.sliderLen = 0, this.init()
		}
		return e.prototype = {
			init: function() {
				this.loadHottravels()
			},
			loadHottravels: function() {
				var t = this,
					e = {
						timer: +new Date
					};
				$.getJSON(this.ajaxUrls.hottravels, e).done(function(e) {
					0 === e.error_code && t.renderHottravels(e.data)
				})
			},
			renderHottravels: function(t) {
				var e = [],
					i = [];
				e.push('<div class="slider slider-hottravels">'), i.push('<div class="slider-control">'), e.push('<div class="slider-inner">');
				for (var o = 0, s = t.length; s > o; o++) {
					e.push('<div class="item" style="' + (0 === o ? "display: block;" : "") + '">'), e.push("<ul>");
					for (var n = 0, a = t[o].length; a > n; n++) {
						var r = t[o][n];
						e.push("<li>"), e.push('<div class="travel">'), e.push('<div class="photo">'), e.push('<a data-bn-ipg="index-hotThread-pic-' + o + n + '" href="' + r.url + '" target="_blank" data-ra_arg="' + r.ra_arg + '"><img class="lazy" src="http://home.qyerstatic.com/common/images/common/grey.gif" data-original="' + r.pic + '" width="275" height="185"></a>'), e.push('<div class="like"><i class="iconfont icon-xiangqu1"></i> ' + r.total_likes + "</div>"), e.push("</div>"), e.push('<div class="inner">'), e.push('<div class="info">'), e.push('<span class="avatar">'), e.push('<a data-bn-ipg="index-hotThread-writerPic-' + o + n + '" href="' + r.auth.user_url + '" target="_blank"><img class="lazy" src="http://home.qyerstatic.com/common/images/common/grey.gif" data-original="' + r.auth.avatar + '"></a>'), e.push("</span>"), e.push('<span class="txt">'), e.push('<a data-bn-ipg="index-hotThread-name-' + o + n + '" href="' + r.auth.user_url + '" target="_blank">' + r.username + "</a>"), r.auth && "" !== r.auth.auth_type && (e.push('<span class="auth_avatar_q s"> '), "member" == r.auth.auth_type ? e.push('<i onclick="window.location=\'http://www.qyer.com/u/member/xuan\';" class="icon member" data-toggle="tooltip" data-placement="top" data-original-title="' + r.auth.attestation + '"></i>') : "company" == r.auth.auth_type ? e.push('<i onclick="window.location=\'http://www.qyer.com/u/company/xuan\';" class="icon company" data-toggle="tooltip" data-placement="top" data-original-title="' + r.auth.attestation + '"></i>') : "qyer" == r.auth.auth_type && e.push('<i class="icon qyer" data-toggle="tooltip" data-placement="top" data-original-title="' + r.auth.attestation + '"></i>'), e.push("</span>")), e.push("</span>"), e.push("</div>"), e.push('<a data-bn-ipg="index-hotThread-title-' + o + n + '" href="' + r.url + '" target="_blank" data-ra_arg="' + r.ra_arg + '">'), e.push('<div class="caption">'), e.push(r.subject), e.push("</div>"), e.push("</a>"), e.push("</div>"), 0 !== r.digest && e.push('<em class="tip">精华</em>'), e.push("</div>"), e.push("</li>")
					}
					e.push("</ul>"), e.push("</div>"), i.push("<a" + (0 === o ? ' class="current"' : "") + ' data-bn-ipg="index-hotThread-page" href="javascript:;"></a>')
				}
				e.push("</div>"), i.push("</div>"), e.push(i.join("")), e.push("</div>"), e.push('<div class="more">'), e.push('<a href="http://bbs.qyer.com" data-bn-ipg="index-hotThread-more" target="_blank">查看更多游记</a>'), e.push("</div>"), this.$hottravelsBox.html(e.join("")), this.bindEvent()
			},
			bindEvent: function() {
				new t({
					box: ".slider-hottravels",
					gradualShowClass: "gradually_col4_show"
				}), $("img.lazy:visible", this.$HottravelsBox).lazyload({
					effect: "fadeIn"
				}), $('[data-toggle="tooltip"]', this.$HottravelsBox).tooltip({
					container: "body"
				})
			}
		}, e
	}), define("common/js/home/Usercard", [], function() {
		function t(t) {
			this.opts = $.extend({
				box: "#usercard"
			}, t), this.ajaxUrls = {
				usercard: "qcross/home/ajax?action=persons",
				follow: "qcross/user/ajax.php"
			}, this.$usercardBox = $(t.box), this.$cardcont = this.$usercardBox.find(".cardcont"), this.ajaxLoad = !1, this.sliderLen = 0, this.init()
		}
		return t.prototype = {
			init: function() {
				this.loadUser()
			},
			loadUser: function() {
				var t = this,
					e = {
						timer: (new Date).getTime()
					};
				return this.ajaxLoad ? !1 : (this.ajaxLoad = !0, void $.getJSON(this.ajaxUrls.usercard, e, function(e) {
					t.ajaxLoad = !1, 0 == e.error_code && t.renderUsercard(e.data)
				}))
			},
			renderUsercard: function(t) {
				var e = [];
				if (t.length)
					for (var i = 0; i < t.length; i++) {
						e.push("<ul" + (0 == i ? ' class="gradually_col2_show show"' : "") + ">");
						for (var o = 0; o < t[i].length; o++) {
							var s = t[i][o];
							e.push("<li>"), e.push('<div class="item">'), e.push('<div class="avatar">'), e.push('<a data-bn-ipg="index-discover-pic-' + i + o + '" href="' + s.url + '" target="_blank"><img class="lazy" src="http://home.qyerstatic.com/common/images/common/grey.gif" data-original="' + s.avatar + '" width="60" height="60"></a>'), s.auth && (e.push('<span class="auth_avatar_q posa m">'), e.push("<i" + (s.auth.url ? " onclick=\"window.location='" + s.auth.url + "';\"" : "") + ' class="icon ' + s.auth.type + '" title="' + s.auth.text + '"></i>'), e.push("</span>")), e.push("</div>"), e.push('<div class="inner">'), e.push('<a class="ui_attent_btn follow _js_follow_func" href="javascript:void(0);" data-bn-ipg="index-discover-follow-' + i + o + '" data-uid="' + s.uid + '" data-relate="1" data-each="' + (s.each ? s.each : "0") + '">关注</a>'), e.push('<p class="name">'), e.push('<a data-bn-ipg="index-discover-name-' + i + o + '" href="' + s.url + '" target="_blank">' + s.username + "</a>"), e.push("</p>"), e.push('<p class="fans"><em>' + s.fans + "</em>粉丝</p>"), e.push('<p class="auth"><span>' + (s.auth ? s.auth.text : "") + "</span></p>"), e.push("</div>"), e.push("</div>"), e.push("</li>")
						}
						e.push("</ul>")
					} else e = ['<div class="userEmpty">您已关注了所有最新认证用户</div>'];
				t.length > 1 && this.$usercardBox.find(".change").show(), this.$cardcont.html(e.join("")), this.bindEvent()
			},
			bindEvent: function() {
				var t = this;
				this.$usercardBox.on("click", ".change", function() {
					t.changeUserCard()
				}), this.$usercardBox.on("click", "._js_follow_func", function() {
					qyerUtil.isLogin() ? t.follow($(this)) : qyerUtil.doLogin()
				}), $("img.lazy:visible", this.$usercardBox).lazyload({
					effect: "fadeIn"
				})
			},
			changeUserCard: function() {
				var t = this.$usercardBox.find(".show"),
					e = t.next().length ? t.next() : this.$usercardBox.find("ul:first");
				t.removeClass("show gradually_col2_show"), e.addClass("show gradually_col2_show").find("img.lazy").lazyload({
					effect: "fadeIn"
				})
			},
			ajaxLoading: function() {
				return '<div class="sk-wave"><div class="sk-rect sk-rect1"></div> <div class="sk-rect sk-rect2"></div> <div class="sk-rect sk-rect3"></div> <div class="sk-rect sk-rect4"></div> <div class="sk-rect sk-rect5"></div></div>'
			},
			follow: function(t) {
				function e(t, e, i) {
					i.attr("data-relate", e), "1" == t ? i.hasClass("ui_attent_btn_each") ? (i.removeClass("ui_attent_btn_each"), i.hasClass("_js_index_switch_do") && jQuery("._js_index_switch_do").removeClass("ui_attent_btn_each")) : (i.addClass("ui_attent_btn_each"), i.hasClass("_js_index_switch_do") && jQuery("._js_index_switch_do").addClass("ui_attent_btn_each")) : i.hasClass("ui_attent_btn_yes") ? (i.removeClass("ui_attent_btn_yes"), i.hasClass("_js_index_switch_do") && jQuery("._js_index_switch_do").removeClass("ui_attent_btn_yes")) : (i.addClass("ui_attent_btn_yes"), i.hasClass("_js_index_switch_do") && jQuery("._js_index_switch_do").addClass("ui_attent_btn_yes"))
				}
				var i = t.attr("data-uid"),
					o = t.attr("data-relate"),
					s = t.attr("data-each"),
					n = "";
				n = 1 == o ? "action=addfriend&fuid=" + i : "action=channelfriend&uid=" + i;
				var a = this.ajaxUrls.follow;
				jQuery.ajax({
					type: "POST",
					url: a,
					data: n,
					dataType: "json",
					beforeSend: function(t) {},
					success: function(i) {
						"ok" == i.result ? (o = 0 == o ? 1 : 0, e(s, o, t)) : e(s, o, t)
					}
				})
			}
		}, t
	}),
	function(t, e) {
		"function" == typeof define && define.amd ? define("common/js/common/Scroll", e) : "object" == typeof exports ? module.exports = e() : t.Scroll = e()
	}(this, function() {
		function t(t) {
			this.opts = $.extend({
				box: ".scroll",
				speeds: 5e3
			}, t), this.$scrollBox = $(this.opts.box), this.$ul = this.$scrollBox.find("ul"), this.h = this.$ul.find("li").height(), this.timer = null, this.init()
		}
		return t.prototype = {
			init: function() {
				this.$ul.css({
					position: "relative"
				}), this.autoScroll(), this.bindEvent(), this.imglazy(this.$ul.find("li:eq(0) .imglazy")[0]), this.imglazy(this.$ul.find("li:eq(1) .imglazy")[0])
			},
			scroll: function() {
				var t = this;
				_li = this.$ul.find("li:first"), _li.addClass("animationHide"), this.imglazy(this.$ul.find("li:eq(2) .imglazy")[0]), t.$ul.animate({
					top: -(t.h + 20)
				}, 500, function() {
					t.$ul.css("top", 0), _li.removeClass("animationHide").appendTo(t.$ul)
				})
			},
			autoScroll: function() {
				var t = this;
				clearInterval(this.timer), this.timer = setInterval(function() {
					t.scroll()
				}, this.opts.speeds)
			},
			stopScroll: function() {
				clearInterval(this.timer)
			},
			bindEvent: function() {
				var t = this;
				this.$scrollBox.on("mouseenter", function() {
					t.stopScroll()
				}).on("mouseleave", function() {
					t.autoScroll()
				})
			},
			imglazy: function(t) {
				-1 != t.src.indexOf("grey.gif") && (t.src = t.getAttribute("data-original"))
			}
		}, t
	}), define("common/models/basic/js/require-css!web_old_tooltips", [], function() {}), ! function(t) {
		define("web_old_tooltips", ["css!web_old_tooltips"], t(jQuery))
	}(function(t) {
		"use strict";

		function e(e) {
			return this.each(function() {
				var o = t(this),
					s = o.data("bs.tooltip"),
					n = "object" == typeof e && e;
				(s || !/destroy|hide/.test(e)) && (s || o.data("bs.tooltip", s = new i(this, n)), "string" == typeof e && s[e]())
			})
		}
		var i = function(t, e) {
			this.type = null, this.options = null, this.enabled = null, this.timeout = null, this.hoverState = null, this.$element = null, this.init("tooltip", t, e)
		};
		i.VERSION = "3.3.4", i.TRANSITION_DURATION = 150, i.DEFAULTS = {
			animation: !0,
			placement: "top",
			selector: !1,
			template: '<div class="tooltip" role="tooltip"><div class="tooltip-arrow"></div><div class="tooltip-inner"></div></div>',
			trigger: "hover focus",
			title: "",
			delay: 0,
			html: !1,
			container: !1,
			viewport: {
				selector: "body",
				padding: 0
			}
		}, i.prototype.init = function(e, i, o) {
			if (this.enabled = !0, this.type = e, this.$element = t(i), this.options = this.getOptions(o), this.$viewport = this.options.viewport && t(this.options.viewport.selector || this.options.viewport), this.$element[0] instanceof document.constructor && !this.options.selector) throw new Error("`selector` option must be specified when initializing " + this.type + " on the window.document object!");
			for (var s = this.options.trigger.split(" "), n = s.length; n--;) {
				var a = s[n];
				if ("click" == a) this.$element.on("click." + this.type, this.options.selector, t.proxy(this.toggle, this));
				else if ("manual" != a) {
					var r = "hover" == a ? "mouseenter" : "focusin",
						l = "hover" == a ? "mouseleave" : "focusout";
					this.$element.on(r + "." + this.type, this.options.selector, t.proxy(this.enter, this)), this.$element.on(l + "." + this.type, this.options.selector, t.proxy(this.leave, this))
				}
			}
			this.options.selector ? this._options = t.extend({}, this.options, {
				trigger: "manual",
				selector: ""
			}) : this.fixTitle()
		}, i.prototype.getDefaults = function() {
			return i.DEFAULTS
		}, i.prototype.getOptions = function(e) {
			return e = t.extend({}, this.getDefaults(), this.$element.data(), e), e.delay && "number" == typeof e.delay && (e.delay = {
				show: e.delay,
				hide: e.delay
			}), e
		}, i.prototype.getDelegateOptions = function() {
			var e = {},
				i = this.getDefaults();
			return this._options && t.each(this._options, function(t, o) {
				i[t] != o && (e[t] = o)
			}), e
		}, i.prototype.enter = function(e) {
			var i = e instanceof this.constructor ? e : t(e.currentTarget).data("bs." + this.type);
			return i && i.$tip && i.$tip.is(":visible") ? void(i.hoverState = "in") : (i || (i = new this.constructor(e.currentTarget, this.getDelegateOptions()), t(e.currentTarget).data("bs." + this.type, i)), clearTimeout(i.timeout), i.hoverState = "in", i.options.delay && i.options.delay.show ? void(i.timeout = setTimeout(function() {
				"in" == i.hoverState && i.show()
			}, i.options.delay.show)) : i.show())
		}, i.prototype.leave = function(e) {
			var i = e instanceof this.constructor ? e : t(e.currentTarget).data("bs." + this.type);
			return i || (i = new this.constructor(e.currentTarget, this.getDelegateOptions()), t(e.currentTarget).data("bs." + this.type, i)), clearTimeout(i.timeout), i.hoverState = "out", i.options.delay && i.options.delay.hide ? void(i.timeout = setTimeout(function() {
				"out" == i.hoverState && i.hide()
			}, i.options.delay.hide)) : i.hide()
		}, i.prototype.show = function() {
			var e = t.Event("show.bs." + this.type);
			if (this.hasContent() && this.enabled) {
				this.$element.trigger(e);
				var o = t.contains(this.$element[0].ownerDocument.documentElement, this.$element[0]);
				if (e.isDefaultPrevented() || !o) return;
				var s = this,
					n = this.tip(),
					a = this.getUID(this.type);
				this.setContent(), n.attr("id", a), this.$element.attr("aria-describedby", a), this.options.animation && n.addClass("fade");
				var r = "function" == typeof this.options.placement ? this.options.placement.call(this, n[0], this.$element[0]) : this.options.placement,
					l = /\s?auto?\s?/i,
					c = l.test(r);
				c && (r = r.replace(l, "") || "top"), n.detach().css({
					top: 0,
					left: 0,
					display: "block"
				}).addClass(r).data("bs." + this.type, this), this.options.container ? n.appendTo(this.options.container) : n.insertAfter(this.$element);
				var h = this.getPosition(),
					d = n[0].offsetWidth,
					u = n[0].offsetHeight;
				if (c) {
					var p = r,
						f = this.options.container ? t(this.options.container) : this.$element.parent(),
						m = this.getPosition(f);
					r = "bottom" == r && h.bottom + u > m.bottom ? "top" : "top" == r && h.top - u < m.top ? "bottom" : "right" == r && h.right + d > m.width ? "left" : "left" == r && h.left - d < m.left ? "right" : r, n.removeClass(p).addClass(r)
				}
				var g = this.getCalculatedOffset(r, h, d, u);
				this.applyPlacement(g, r);
				var v = function() {
					var t = s.hoverState;
					s.$element.trigger("shown.bs." + s.type), s.hoverState = null, "out" == t && s.leave(s)
				};
				t.support.transition && this.$tip.hasClass("fade") ? n.one("bsTransitionEnd", v).emulateTransitionEnd(i.TRANSITION_DURATION) : v()
			}
		}, i.prototype.applyPlacement = function(e, i) {
			var o = this.tip(),
				s = o[0].offsetWidth,
				n = o[0].offsetHeight,
				a = parseInt(o.css("margin-top"), 10),
				r = parseInt(o.css("margin-left"), 10);
			isNaN(a) && (a = 0), isNaN(r) && (r = 0), e.top = e.top + a, e.left = e.left + r, t.offset.setOffset(o[0], t.extend({
				using: function(t) {
					o.css({
						top: Math.round(t.top),
						left: Math.round(t.left)
					})
				}
			}, e), 0), o.addClass("in");
			var l = o[0].offsetWidth,
				c = o[0].offsetHeight;
			"top" == i && c != n && (e.top = e.top + n - c);
			var h = this.getViewportAdjustedDelta(i, e, l, c);
			h.left ? e.left += h.left : e.top += h.top;
			var d = /top|bottom/.test(i),
				u = d ? 2 * h.left - s + l : 2 * h.top - n + c,
				p = d ? "offsetWidth" : "offsetHeight";
			o.offset(e), this.replaceArrow(u, o[0][p], d)
		}, i.prototype.replaceArrow = function(t, e, i) {
			this.arrow().css(i ? "left" : "top", 50 * (1 - t / e) + "%").css(i ? "top" : "left", "")
		}, i.prototype.setContent = function() {
			var t = this.tip(),
				e = this.getTitle();
			t.find(".tooltip-inner")[this.options.html ? "html" : "text"](e), t.removeClass("fade in top bottom left right")
		}, i.prototype.hide = function(e) {
			function o() {
				"in" != s.hoverState && n.detach(), s.$element.removeAttr("aria-describedby").trigger("hidden.bs." + s.type), e && e()
			}
			var s = this,
				n = t(this.$tip),
				a = t.Event("hide.bs." + this.type);
			return this.$element.trigger(a), a.isDefaultPrevented() ? void 0 : (n.removeClass("in"), t.support.transition && n.hasClass("fade") ? n.one("bsTransitionEnd", o).emulateTransitionEnd(i.TRANSITION_DURATION) : o(), this.hoverState = null, this)
		}, i.prototype.fixTitle = function() {
			var t = this.$element;
			(t.attr("title") || "string" != typeof t.attr("data-original-title")) && t.attr("data-original-title", t.attr("title") || "").attr("title", "")
		}, i.prototype.hasContent = function() {
			return this.getTitle()
		}, i.prototype.getPosition = function(e) {
			e = e || this.$element;
			var i = e[0],
				o = "BODY" == i.tagName,
				s = i.getBoundingClientRect();
			null == s.width && (s = t.extend({}, s, {
				width: s.right - s.left,
				height: s.bottom - s.top
			}));
			var n = o ? {
					top: 0,
					left: 0
				} : e.offset(),
				a = {
					scroll: o ? document.documentElement.scrollTop || document.body.scrollTop : e.scrollTop()
				},
				r = o ? {
					width: t(window).width(),
					height: t(window).height()
				} : null;
			return t.extend({}, s, a, r, n)
		}, i.prototype.getCalculatedOffset = function(t, e, i, o) {
			return "bottom" == t ? {
				top: e.top + e.height,
				left: e.left + e.width / 2 - i / 2
			} : "top" == t ? {
				top: e.top - o,
				left: e.left + e.width / 2 - i / 2
			} : "left" == t ? {
				top: e.top + e.height / 2 - o / 2,
				left: e.left - i
			} : {
				top: e.top + e.height / 2 - o / 2,
				left: e.left + e.width
			}
		}, i.prototype.getViewportAdjustedDelta = function(t, e, i, o) {
			var s = {
				top: 0,
				left: 0
			};
			if (!this.$viewport) return s;
			var n = this.options.viewport && this.options.viewport.padding || 0,
				a = this.getPosition(this.$viewport);
			if (/right|left/.test(t)) {
				var r = e.top - n - a.scroll,
					l = e.top + n - a.scroll + o;
				r < a.top ? s.top = a.top - r : l > a.top + a.height && (s.top = a.top + a.height - l)
			} else {
				var c = e.left - n,
					h = e.left + n + i;
				c < a.left ? s.left = a.left - c : h > a.width && (s.left = a.left + a.width - h)
			}
			return s
		}, i.prototype.getTitle = function() {
			var t, e = this.$element,
				i = this.options;
			return t = e.attr("data-original-title") || ("function" == typeof i.title ? i.title.call(e[0]) : i.title)
		}, i.prototype.getUID = function(t) {
			do t += ~~(1e6 * Math.random()); while (document.getElementById(t));
			return t
		}, i.prototype.tip = function() {
			return this.$tip = this.$tip || t(this.options.template)
		}, i.prototype.arrow = function() {
			return this.$arrow = this.$arrow || this.tip().find(".tooltip-arrow")
		}, i.prototype.enable = function() {
			this.enabled = !0
		}, i.prototype.disable = function() {
			this.enabled = !1
		}, i.prototype.toggleEnabled = function() {
			this.enabled = !this.enabled
		}, i.prototype.toggle = function(e) {
			var i = this;
			e && (i = t(e.currentTarget).data("bs." + this.type), i || (i = new this.constructor(e.currentTarget, this.getDelegateOptions()), t(e.currentTarget).data("bs." + this.type, i))), i.tip().hasClass("in") ? i.leave(i) : i.enter(i)
		}, i.prototype.destroy = function() {
			var t = this;
			clearTimeout(this.timeout), this.hide(function() {
				t.$element.off("." + t.type).removeData("bs." + t.type)
			})
		};
		var o = t.fn.tooltip;
		t.fn.tooltip = e, t.fn.tooltip.Constructor = i, t.fn.tooltip.noConflict = function() {
			return t.fn.tooltip = o, this
		}
	}), window.qyerUtil.insertStyle([".qui-feedback { position:fixed; _position:absolute; z-index:99; top:120px; right:-246px; display:none;}", ".qui-feedback .icon { float:left; width:24px; height:150px; background:url(http://static.qyer.com/models/common/component/feedback/icons_feedback.png) 0 0 no-repeat; cursor:pointer;}", ".qui-feedback.js-current > .icon { background-position:-29px 0;}", ".qui-feedback .cnt { float:left; width:246px; height:280px; background-color:#e8e4df;}", ".qui-feedback .cnt form { padding:10px; font-size:0;}", ".qui-feedback .cnt textarea { width:214px; height:192px; padding:2px 5px; border:1px solid #ccc; font-size:12px;}", ".qui-feedback .cnt input { float:right; margin-top:10px;}", ".qui-feedback .help { position:relative; top:-1px; border:1px solid #ccc; border-top:none; background:#fefdc9; height:24px; line-height:22px; text-align:center;font-size:12px;}", ".qui-feedback .help a { font-weight:bold; }"].join("")), setTimeout(function() {
		! function() {
			function t() {
				this.init()
			}
			var e;
			t.prototype = {
				$div: null,
				init: function() {
					this.createDom(), this.bindEvt()
				},
				tip: function(t) {
					requirejs(["web_old_tip"], function(e) {
						e.tip(t)
					})
				},
				createDom: function() {
					var t1 = ['<div class="qui-feedback" style="display:none;">', '<div class="icon js-btn" title="意见反馈"></div>', '<div class="cnt">', '<form method="post">', '<textarea class="js-feedback-cnt" cols="50" rows="10" placeholder="有任何意见或建议请告诉我们"></textarea>', '<p class="help">使用遇到问题？请先进入<a href="http://bbs.qyer.com/forum-10-1.html" target="_blank">帮助中心</a></p>', '<input class="ui_button js-submitBtn" type="button" value="提交" class="ui_button">', "</form>", "</div>", "</div>"].join("");
					$(document.body).append(t), this.$div = $(".qui-feedback"), $(window).scrollTop() >= 400 && this.$div.fadeIn(300), $div = null
				},
				showLogin: function() {
					qyerUtil.doLogin()
				},
				bindEvt: function() {
					var t = this;
					this.$div.on("click", ".js-btn", function(e) {
						t[t.$div.hasClass("js-current") ? "hideDiv" : "showDiv"]()
					}).on("click", "textarea.js-feedback-cnt", function(t) {
						window.QYER && window.QYER.uid || e.showLogin()
					}).on("click", "input.js-submitBtn", function(i) {
						if (window.QYER && window.QYER.uid) {
							var o = t.checkForm();
							o && t.submitForm(o)
						} else e.showLogin()
					}), $(document).on("click", function(e) {
						var i = $(e.target);
						i.closest(".qui-feedback").size() < 1 && t.hideDiv()
					}), $(window).on("scroll", function() {
						var e = $(this).scrollTop();
						e >= 400 ? t.$div.fadeIn(300) : t.$div.fadeOut(300)
					})
				},
				showDiv: function() {
					var t = this;
					this.$div.animate({
						right: 0
					}, 200, function() {
						t.$div.addClass("js-current")
					})
				},
				hideDiv: function() {
					var t = this;
					this.$div.animate({
						right: -246
					}, 200, function() {
						t.$div.removeClass("js-current")
					})
				},
				checkValue: {
					cnt: function(t) {
						var i = $(".js-feedback-cnt").val();
						if (i = $.trim(i), "" == i || "有任何意见或建议请告诉我们" == i) return e.tip({
							text: "意见或建议不能为空",
							type: "error"
						}), !1;
						var o = window.qyerUtil.getWordLen(i);
						return 20 > o ? (e.tip({
							text: "不能少于10个字",
							type: "error"
						}), !1) : i
					}
				},
				checkForm: function() {
					var t = this.$div.find(".js-feedback-cnt").val();
					return this.checkValue.cnt(t)
				},
				submitForm: function(t) {
					var i = this,
						o = {
							data: {
								cnt: t,
								url: location.href
							},
							onSuccess: function(t) {
								i.$div.find("textarea.js-feedback-cnt").val(""), e.tip({
									text: t.data.msg
								})
							},
							onError: function(t) {
								77 == t.error_code ? e.showLogin() : e.tip({
									text: ret.data.msg,
									type: "error"
								})
							}
						};
					this.postFeedback(o)
				},
				postFeedback: function(t) {
					t.posturl = "qcross/place/api.php?action=feedback", window.qyerUtil.doAjax(t)
				}
			}, e = new t
		}()
	}, 3e3), define("common/models/common/component/feedback/feedback", function() {}), $(function() {
		"use strict";

		function t() {
			$(".header")[($(window).width() < 1280 ? "add" : "remove") + "Class"]("media_header_1280")
		}
		var e = [{
			id: "interest"
		}, {
			id: "lastminute"
		}, {
			id: "hottravels"
		}, {
			id: "usercard"
		}, {
			id: "commentcard"
		}];
		(navigator.userAgent.indexOf("MSIE7.0") > 0 || navigator.userAgent.indexOf("MSIE 8.0") > 0) && (t(), $(window).on("resize", t)), window.__userStatusCallBack = function(t) {
			t.uid > 0 ? $(".link-comment").attr("href", "http://www.qyer.com/u/" + t.uid + "/footprint?showcomm=1") : (requirejs(["common/models/common/component/footerBanner/footerBanner"], function(t) {
					t.show()
				}), jQuery(document).on("click", "._jsweibologin", function() {
					var t = jQuery(this).attr("url");
					t || (t = window.location.href);
					var e = "http://login.qyer.com/auth.php?action=weibo&popup=1&refer=" + t;
					window.open(e, "newwindow", "height=450px,width=600px,top=100,left=300,toolbar=no,menubar=no,scrollbars=no, resizable=no,location=no, status=no")
				}), jQuery(document).on("click", "._jsqqlogin", function() {
					var t = jQuery(this).attr("url");
					t || (t = window.location.href);
					var e = "http://login.qyer.com/auth.php?action=qq&popup=1&refer=" + t;
					window.open(e, "newwindow", "height=450px,width=600px,top=100,left=300,toolbar=no,menubar=no,scrollbars=no, resizable=no,location=no, status=no")
				})), window._qyer_userid = t.uid,
				function() {
					var t = document.createElement("script");
					if (t.type = "text/javascript", t.async = !0, t.src = "http://qt.qyer.com/beacon.js", "https:" == document.location.protocol);
					else {
						var e = document.getElementsByTagName("script")[0];
						e.parentNode.insertBefore(t, e)
					}
				}()
		}, NProgress.start(), $(window).load(function() {
			NProgress.done()
		}), requirejs(["common/js/common/Carousel"], function(t) {
			new t({
				box: "#qyer_banner",
				carousel: "#carousel",
				bannerbg: "#bannerbg",
				onSlide: function(t) {
					$(".placesearch_txt").attr("placeholder", $(t).find(".h_text").val()), "" === $.trim($(".placesearch_txt").val()) && $(".place_search_form").attr("action", $(t).find(".h_url").val())
				}
			})
		}), requirejs(["common/js/common/Slider"], function(t) {
			new t({
				box: ".slider-hottravels"
			})
		}), requirejs(["common/js/home/PlaceSearch", "common/js/home/ZSearch"], function(t, e) {
			new t({
				box: "#search"
			}), new e({
				box: "#search"
			})
		}), requirejs(["common/js/home/Interest", "common/js/home/Lastminute", "common/js/home/Hottravels", "common/js/home/Usercard", "common/js/common/Scroll"], function(t, i, o, s, n) {
			function a(e) {
				switch (e) {
					case "interest":
						new t({
							box: "#interest"
						});
						break;
					case "lastminute":
						new i({
							box: "#lastminute"
						});
						break;
					case "hottravels":
						new o({
							box: "#hottravels"
						});
						break;
					case "usercard":
						new s({
							box: "#usercard"
						});
						break;
					case "commentcard":
						new n({
							box: ".scroll"
						})
				}
			}
			for (var r = 0; r < e.length; r++) a(e[r].id)
		}), $("#search").on("click", ".tab a", function() {
			var t = this.getAttribute("data-type");
			switch (($("#search").hasClass("active-place") && "z" == t || $("#search").hasClass("active-z") && "place" == t) && ($("#search .panel-inner .plan").css("visibility", "hidden"), setTimeout(function() {
				$("#search .panel-inner .plan").css("visibility", "visible")
			}, 200)), $("#search")[0].className = "search active-" + t, t) {
				case "place":
					$("#search ." + t + "search_txt")[0].select();
					break;
				case "z":
					$("#search ." + t + "search_txt")[0].select()
			}
		});
		for (var i = 0; i < e.length; i++) document.getElementById(e[i].id) && (e[i].index = i, e[i].offsetTop = document.getElementById(e[i].id).offsetTop);
		"undefined" != typeof document.createElement("div").style.transform && $(window).bind("scroll", function() {
			var t = Math.max(document.documentElement.scrollTop, document.body.scrollTop),
				e = 80 > t / 8 ? t / 8 : 80;
			$("#search").css({
				transform: "translateY(" + Math.floor(e / 1.8) + "px)"
			}), $(".carousel-inner").css({
				transform: "translateY(" + Math.floor(e) + "px)"
			}).find(".text-panel").css({
				transform: "translateY(" + Math.floor(-e) + "px)"
			})
		}), $(".link-comment").click(function() {
			return qyerUtil.isLogin() ? void 0 : (qyerUtil.doLogin(), !1)
		}), requirejs(["web_old_tooltips"], function() {
			$('[data-toggle="tooltip"]').tooltip({
				container: "body"
			})
		}), $("img.lazy").lazyload({
			effect: "fadeIn"
		}), requirejs(["common/models/common/component/feedback/feedback"])
	}), window.scrollTo(0, 0), window.getCookie = qyerUtil.getCookie, define("common/js/home/index", function() {}),
	function(t) {
		var e = document,
			i = "appendChild",
			o = "styleSheet",
			s = e.createElement("style");
		s.type = "text/css", e.getElementsByTagName("head")[0][i](s), s[o] ? s[o].cssText = t : s[i](e.createTextNode(t))
	}(".qui-tip{position:fixed;top:75pt;left:0;width:100%;text-align:center;display:none;z-index:1100}.qui-tip-box{display:inline-block;min-width:90pt;max-width:390px;padding:20px 30px;background-color:#fff;box-shadow:0 2px 7px rgba(0,0,0,.25);border:1px solid silver;text-align:left;font-size:18px;line-height:2pc}.qui-tip-text{display:block;position:relative;padding-left:34px}.qui-tip-text:before{content:'';position:absolute;left:0;top:4px;width:24px;height:24px;background:url(http://fed.static.qyer.com/core/web/common/resource/ui/oldtip/icons2.png) no-repeat #fff}.qui-tip-box-error .qui-tip-text:before{background-position:0 -5pc}.qui-tip-box-warning .qui-tip-text:before{background-position:0 -40px}.tooltip{position:absolute;z-index:1070;display:block;font-family:\"Helvetica Neue\",Helvetica,Arial,sans-serif;font-size:9pt;font-weight:400;line-height:1.4;filter:alpha(opacity=0);opacity:0}.tooltip:after{content:''}.tooltip.in{filter:alpha(opacity=90);opacity:.9}.tooltip.top{padding:5px 0;margin-top:-3px}.tooltip.right{padding:0 5px;margin-left:3px}.tooltip.bottom{padding:5px 0;margin-top:3px}.tooltip.left{padding:0 5px;margin-left:-3px}.tooltip-inner{max-width:200px;padding:3px 8px;color:#959595;text-align:center;text-decoration:none;background-color:#f5f5f5;border:1px solid #d7d7d7;border-radius:4px}.tooltip-arrow,.tooltip:after{position:absolute;width:0;height:0;border-color:transparent;border-style:solid}.tooltip.top .tooltip-arrow,.tooltip.top:after{bottom:0;left:50%;margin-left:-5px;border-width:5px 5px 0;border-top-color:#D7D7D7}.tooltip.top:after{bottom:1px;border-top-color:#f5f5f5}.tooltip.top-left .tooltip-arrow,.tooltip.top-left:after{right:5px;bottom:0;margin-bottom:-5px;border-width:5px 5px 0;border-top-color:#D7D7D7}.tooltip.top-left:after{bottom:1px;border-top-color:#f5f5f5}.tooltip.top-right .tooltip-arrow,.tooltip.top-right:after{bottom:0;left:5px;margin-bottom:-5px;border-width:5px 5px 0;border-top-color:#D7D7D7}.tooltip.top-right:after{bottom:1px;border-top-color:#f5f5f5}.tooltip.right .tooltip-arrow,.tooltip.right:after{top:50%;left:0;margin-top:-5px;border-width:5px 5px 5px 0;border-right-color:#D7D7D7}.tooltip.right:after{left:1px;border-right-color:#f5f5f5}.tooltip.left .tooltip-arrow,.tooltip.left:after{top:50%;right:0;margin-top:-5px;border-width:5px 0 5px 5px;border-left-color:#D7D7D7}.tooltip.left:after{right:1px;border-left-color:#f5f5f5}.tooltip.bottom .tooltip-arrow,.tooltip.bottom:after{top:0;left:50%;margin-left:-5px;border-width:0 5px 5px;border-bottom-color:#D7D7D7}.tooltip.bottom:after{top:1px;border-bottom-color:#f5f5f5}.tooltip.bottom-left .tooltip-arrow,.tooltip.bottom-left:after{top:0;right:5px;margin-top:-5px;border-width:0 5px 5px;border-bottom-color:#D7D7D7}.tooltip.bottom-left:after{top:1px;border-bottom-color:#f5f5f5}.tooltip.bottom-right .tooltip-arrow,.tooltip.bottom-right:after{top:0;left:5px;margin-top:-5px;border-width:0 5px 5px;border-bottom-color:#D7D7D7}.tooltip.bottom-right:after{top:1px;border-bottom-color:#f5f5f5}.fade{opacity:0;-webkit-transition:opacity .15s linear;-o-transition:opacity .15s linear;transition:opacity .15s linear}.fade.in{opacity:1}");