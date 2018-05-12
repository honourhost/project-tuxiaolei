var w = 320;
var h = 480;
var cw = 320;
var ch = 240;
var fps = 1e3 / 30;
var canvas, context, levelCount, imageSprite, timeout;
var strings = {
	witr: "猜猜金币在哪儿？<br>（请选择）",
	fail: ["是不是眼花了？", "别瞎猜，看准了再选", "太快了吗？"],
	ok: ["这个太简单了", "还不错，不过这只是练习！", "你确定没有使诈？", "好", "再接再厉", "很好", "太棒了", "下一关会更难哦", "牛逼！", "不可思议", "太夸张了吧", "太厉害了有木有？？", "你是怎么做到的？！", "肯定是运气！", "你的眼力那么好，你家人知道吗？", "不会再让你过关的，小心哦！", "简直无法置信！", "从来没有人能到这一关", "大神，教教我你的诀窍吧！", "我不玩了！我不玩了！"]
};
var init = function() {
	imageSprite = new Image;
	imageSprite.src = "http://t2.qpic.cn/mblogpic/9da063a894328c654b4c/2000";
	play68_init();
	welcomeView()
};
var welcomeView = function() {
	var e = document.getElementById("logo");
	e.style.display = "block";
	var t = new OpacityTween(e, null, 0, 100, .5);
	t.start();
	t.onMotionFinished = function() {
		setTimeout(function() {
			var t = new OpacityTween(e, null, 100, 0, .5);
			t.start();
			t.onMotionFinished = function() {
				e.style.display = "none";
				menuView()
			}
		},
		500)
	}
};
var menuView = function() {
	var e = document.getElementById("playButton");
	e.style.display = "block";
	var t = new OpacityTween(e, null, 0, 100, .5);
	t.start();
	t.onMotionFinished = function() {
		e.onclick = function(t) {
			e.style.display = "none";
			gameView();
			play68_init()
		}
	}
};
var gameView = function() {
	canvas = document.getElementById("canvas");
	canvas.style.display = "block";
	canvas.width = cw;
	canvas.height = ch;
	context = canvas.getContext("2d");
	levelCount = 1;
	livesCount = 3;
	var e = document.getElementById("level");
	var t = document.getElementById("lives");
	var n = false;
	e.innerHTML = "关卡：" + levelCount;
	e.style.display = t.style.display = "block";
	var r = document.getElementById("hearts");
	var i = "";
	for (var s = 0; s < livesCount; s++) {
		i += '<div class="heart">&nbsp;</div>'
	}
	r.innerHTML = i;
	var o = 28;
	var u = 28;
	var a = 15;
	var f = 0;
	var l = 0;
	var c = 60;
	var h = 100;
	var p = 50;
	var d = 53;
	var v = 57;
	var m = function() {
		this.draw = function() {
			context.fillStyle = "#222";
			context.fillRect(0, 0, cw, ch)
		}
	};
	var g = function() {
		this.draw = function() {
			context.drawImage(imageSprite, 6, 100, 82, 86, this.x - 41, this.y, 82, 86)
		}
	};
	var y = function() {
		this.draw = function() {
			var e = context.globalAlpha;
			try {
				context.globalAlpha = this.alpha
			} catch(t) {}
			context.drawImage(imageSprite, 94, 100, 82, 86, this.x - 41, this.y, 82, 86);
			try {
				context.globalAlpha = e
			} catch(t) {}
		}
	};
	var b = function() {
		this.draw = function() {
			context.drawImage(imageSprite, 257, 5, 82, 152, this.x - 41, this.y, 82, 152)
		}
	};
	var w = function() {
		this.draw = function() {
			context.drawImage(imageSprite, 159, 55, 44, 26, this.x - 22, this.y, 44, 26)
		}
	};
	var E = {
		bg: new m,
		bucketShadow: new y,
		coin: new w,
		bucket: new g,
		bucketWs1: new b,
		bucketWs2: new b
	};
	var S = c + (h + h * l);
	E.bucket.x = S;
	E.coin.x = S;
	E.coin.y = p + v;
	E.bucketShadow.x = S;
	E.bucketShadow.y = p + d;
	E.bucketWs1.x = c + (l == 0 ? 0 : h);
	E.bucketWs2.x = c + (l == 0 ? h * 2 : l == -1 ? +h * 2 : 0);
	E.bucket.y = E.bucketWs1.y = E.bucketWs2.y = p;
	var x = function(e) {
		if (n) {
			return
		}
		var t = c + (h + h * e);
		E.bucket.x = t;
		if (e != l) {
			E.coin.x = -2e3;
			E.coin.y = -2e3
		} else {
			E.coin.x = t;
			E.coin.y = p + v
		}
		E.bucketShadow.x = t;
		E.bucketWs1.x = c + (e == 0 ? 0 : h);
		E.bucketWs2.x = c + (e == 0 ? h * 2 : e == -1 ? +h * 2 : 0);
		var r = new Tween({},
		null, Tween.strongEaseInOut, 0, 50, 1);
		r.start();
		r.onMotionChanged = function(e) {
			var t = e.target._pos;
			E.bucket.y = p - t;
			E.bucketShadow.y = p + d + t;
			E.bucketShadow.alpha = 1 - t * .016;
			T()
		};
		r.onMotionFinished = function(e) {
			setTimeout(function() {
				var e = new Tween({},
				null, Tween.strongEaseInOut, 50, 0, 1);
				e.start();
				e.onMotionChanged = function(e) {
					var t = e.target._pos;
					E.bucket.y = p - t;
					E.bucketShadow.y = p + d + t;
					E.bucketShadow.alpha = 1 - t * .016;
					T()
				}
			},
			500)
		}
	};
	var T = function() {
		for (key in E) {
			var e = E[key];
			e.draw()
		}
	};
	var N = function() {
		var e = document.getElementById("msg");
		e.style.display = "block";
		var t = new OpacityTween(e, null, 0, 100, .2);
		t.start();
		e.innerHTML = strings.witr
	};
	var C = function() {
		var e = document.getElementById("b");
		var t = document.getElementById("b1");
		var n = document.getElementById("b2");
		var r = document.getElementById("b3");
		e.style.display = t.style.display = n.style.display = r.style.display = "block";
		t.onclick = function(e) {
			O( - 1)
		};
		n.onclick = function(e) {
			O(0)
		};
		r.onclick = function(e) {
			O(1)
		}
	};
	var k = function() {
		if (n) {
			return
		}
		var e = document.getElementById("level");
		levelCount++;
		e.innerHTML = "关卡：" + levelCount;
		o = u + Math.sqrt(levelCount * 1.5);
		a += Math.floor(levelCount / 3)
	};
	var L = function() {
		if (n) {
			return
		}
		var e = document.getElementById("hearts");
		livesCount--;
		for (node in e.childNodes) {
			var t = e.childNodes[node];
			if (t.className == "heart") {
				var r = new OpacityTween(t, null, 100, 0, .5);
				r.start();
				r.onMotionFinished = function() {
					e.removeChild(t);
					if (livesCount < 1) {
						levelScore = levelCount;
						A();
						return
					}
				};
				break
			}
		}
	};
	var A = function() {
		clearTimeout(timeout);
		n = true;
		canvas.style.display = "none";
		var e = document.getElementById("level");
		var t = document.getElementById("lives");
		e.style.display = t.style.display = "none";
		updateShareScore(levelCount - 1);
		setTimeout(function() {
			show_share()
		},
		1500);
		var r = document.getElementById("msg");
		r.style.display = "block";
		var i = new OpacityTween(r, null, 0, 100, .2);
		i.start();
		r.style.margin = "200px 0 0 0";
		r.innerHTML = "游戏结束";
		setTimeout(function() {
			r.style.display = "none";
			menuView()
		},
		1500)
	};
	var O = function(e) {
		if (n) {
			return
		}
		var t = document.getElementById("b");
		var r = document.getElementById("b1");
		var i = document.getElementById("b2");
		var s = document.getElementById("b3");
		var o = document.getElementById("msg");
		r.style.display = i.style.display = s.style.display = o.style.display = "none";
		x(e);
		setTimeout(function() {
			if (n) {
				return
			}
			if (e == l) {
				var t = levelCount - 1;
				if (t > strings.ok.length - 1) {
					t = strings.ok.length - 1
				}
				o.innerHTML = strings.ok[t];
				k()
			} else {
				o.innerHTML = strings.fail[livesCount - 1];
				L()
			}
			o.style.display = "block";
			var r = new OpacityTween(o, null, 0, 100, .2);
			r.start();
			r.onMotionFinished = function() {
				if (n) {
					return
				}
				setTimeout(function() {
					var e = new OpacityTween(o, null, 100, 0, .2);
					e.start();
					e.onMotionFinished = function() {
						if (n) {
							return
						}
						o.innerHTML = "关卡：" + levelCount;
						var e = new OpacityTween(o, null, 0, 100, .2);
						e.start();
						e.onMotionFinished = function() {
							if (n) {
								return
							}
							setTimeout(function() {
								var e = new OpacityTween(o, null, 100, 0, .2);
								e.start();
								e.onMotionFinished = function() {
									if (n) {
										return
									}
									o.style.display = "none";
									l = 0;
									x(0);
									setTimeout(function() {
										f = 0;
										M()
									},
									3e3)
								}
							},
							1e3)
						}
					}
				},
				1500)
			}
		},
		2500)
	};
	var M = function() {
		if (n) {
			return
		}
		f++;
		if (f > a) {
			N();
			C();
			return
		}
		var e = Math.floor(Math.random() * 3);
		var t = Math.floor(Math.random() * 2);
		var r = 0;
		if (t == 1) {
			r = 180
		}
		var i = o;
		if (e == 2) {
			i = i * .8
		}
		i *= t == 0 ? 1 : -1;
		var s, u, d, v, m, g, y, b;
		var w = 24;
		var S = function() {
			if (n) {
				return
			}
			var t = r + i;
			if (t > 180) {
				r = 180
			} else if (t < 0) {
				r = 0
			} else {
				r += i
			}
			E.bg.draw();
			y = deg2rad(r - 90);
			b = deg2rad(r + 90);
			if (e == 0) {
				s = p + Math.cos(y) * w;
				u = p + Math.cos(b) * w;
				d = p;
				v = c + h / 2 + Math.sin(y) * (h / 2);
				m = c + h / 2 + Math.sin(b) * (h / 2);
				g = c + h * 2;
				if (s > u) {
					context.drawImage(imageSprite, 257, 5, 82, 152, m - 41, u, 82, 152);
					context.drawImage(imageSprite, 257, 5, 82, 152, v - 41, s, 82, 152)
				} else {
					context.drawImage(imageSprite, 257, 5, 82, 152, v - 41, s, 82, 152);
					context.drawImage(imageSprite, 257, 5, 82, 152, m - 41, u, 82, 152)
				}
				context.drawImage(imageSprite, 257, 5, 82, 152, g - 41, d, 82, 152)
			} else if (e == 1) {
				d = p + Math.cos(y) * w;
				u = p + Math.cos(b) * w;
				s = p;
				g = c + h / 2 + h + Math.sin(y) * (h / 2);
				m = c + h / 2 + h + Math.sin(b) * (h / 2);
				v = c;
				if (s > u) {
					context.drawImage(imageSprite, 257, 5, 82, 152, m - 41, u, 82, 152);
					context.drawImage(imageSprite, 257, 5, 82, 152, v - 41, s, 82, 152)
				} else {
					context.drawImage(imageSprite, 257, 5, 82, 152, v - 41, s, 82, 152);
					context.drawImage(imageSprite, 257, 5, 82, 152, m - 41, u, 82, 152)
				}
				context.drawImage(imageSprite, 257, 5, 82, 152, g - 41, d, 82, 152)
			} else if (e == 2) {
				s = p + Math.cos(y) * w * 1.3;
				d = p + Math.cos(b) * w * 1.3;
				u = p;
				v = c + h + Math.sin(y) * h;
				g = c + h + Math.sin(b) * h;
				m = c + h;
				if (s > u) {
					context.drawImage(imageSprite, 257, 5, 82, 152, g - 41, d, 82, 152);
					context.drawImage(imageSprite, 257, 5, 82, 152, m - 41, u, 82, 152);
					context.drawImage(imageSprite, 257, 5, 82, 152, v - 41, s, 82, 152)
				} else {
					context.drawImage(imageSprite, 257, 5, 82, 152, v - 41, s, 82, 152);
					context.drawImage(imageSprite, 257, 5, 82, 152, m - 41, u, 82, 152);
					context.drawImage(imageSprite, 257, 5, 82, 152, g - 41, d, 82, 152)
				}
			}
			if (r >= 180 || r <= 0) {
				if (e == 0) {
					if (l == -1 || l == 0) {
						l = l == -1 ? 0 : -1
					}
				} else if (e == 1) {
					if (l == 1 || l == 0) {
						l = l == 1 ? 0 : 1
					}
				} else if (e == 2) {
					if (l == 1 || l == -1) {
						l *= -1
					}
				}
				r = 0;
				M()
			} else {
				timeout = setTimeout(S, fps)
			}
		};
		timeout = setTimeout(S, fps)
	};
	var _ = function() {
		T();
		setTimeout(function() {
			x(l)
		},
		300);
		setTimeout(function() {
			f = 0;
			M()
		},
		3e3)
	};
	_()
};
var deg2rad = function(e) {
	return e * Math.PI / 180
};
init()