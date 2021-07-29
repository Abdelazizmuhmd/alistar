window.theme = window.theme ||
{};

window.Slate = window.Slate ||
{};

/**
 *
 *  Slate a11y-helpers
 *
 */

Slate.A11yHelpers = (function ()
{
	var A11yHelpers = function ()
	{
		this.init();

		$('.in-page-link').on(
			'click',
			$.proxy(function (evt)
			{
				this.pageLinkFocus($(evt.currentTarget.hash));
			}, this)
		);
	};

	A11yHelpers.prototype.init = function ()
	{
		// on init, check if we need to set page focus
		var hash = window.location.hash;
		if (hash)
		{
			if (document.getElementById(hash.slice(1)))
			{
				this.pageLinkFocus($(hash));
			}
		}
	};

	A11yHelpers.prototype.trapFocus = function ($container, eventNamespace)
	{
		var eventName = eventNamespace ? 'focusin.' + eventNamespace : 'focusin';

		$container.attr('tabindex', '-1');
		$(document).on(eventName, function (evt)
		{
			if ($container[0] !== evt.target && !$container.has(evt.target).length)
			{
				$container.focus();
			}
		});
	};

	A11yHelpers.prototype.removeTrapFocus = function ($container, eventNamespace)
	{
		var eventName = eventNamespace ? 'focusin.' + eventNamespace : 'focusin';

		$container.removeAttr('tabindex');
		$(document).off(eventName);
	};

	/*
	 * For use when focus shifts to a container rather than a link
	 * eg for In-page links, after scroll, focus shifts to content area
	 * so that next `tab` is where user expects
	 * if focusing a link, just $link.focus();
	 */
	A11yHelpers.prototype.pageLinkFocus = function ($element)
	{
		if (!$element.length) return;

		$element.get(0).tabIndex = -1;
		$element.focus().addClass('js-focus-hidden');
		$element.one('blur', function ()
		{
			$element.removeClass('js-focus-hidden').removeAttr('tabindex');
		});
	};

	return A11yHelpers;
})();

/**
 *
 *  Slate uri-helpers
 *
 */

// Based off the node module query-string https://github.com/sindresorhus/query-string
('use strict');
Slate.QueryString = (function ()
{
	var _encode = function (value)
	{
		return encodeURIComponent(value);
	};

	return {
		parse: function (str)
		{
			var ret = Object.create(null);

			if (typeof str !== 'string')
			{
				return ret;
			}

			str = str.trim().replace(/^(\?|#|&)/, '');

			if (!str)
			{
				return ret;
			}

			str.split('&').forEach(function (param)
			{
				var parts = param.replace(/\+/g, ' ').split('=');
				// Firefox (pre 40) decodes `%3D` to `=`
				// https://github.com/sindresorhus/query-string/pull/37
				var key = parts.shift();
				var val = parts.length > 0 ? parts.join('=') : undefined;

				key = decodeURIComponent(key);

				// missing `=` should be `null`:
				// http://w3.org/TR/2012/WD-url-20120524/#collect-url-parameters
				val = val === undefined ? null : decodeURIComponent(val);

				if (ret[key] === undefined)
				{
					ret[key] = val;
				}
				else if (Array.isArray(ret[key]))
				{
					ret[key].push(val);
				}
				else
				{
					ret[key] = [ret[key], val];
				}
			});

			return ret;
		},

		stringify: function (obj)
		{
			return obj ?
				Object.keys(obj)
				.sort()
				.map(function (key)
				{
					var val = obj[key];

					if (val === undefined)
					{
						return '';
					}

					if (val === null)
					{
						return key;
					}

					if (Array.isArray(val))
					{
						var result = [];

						val
							.slice()
							.sort()
							.forEach(function (val2)
							{
								if (val2 === undefined) return;

								if (val2 === null)
								{
									result.push(_encode(key));
								}
								else
								{
									result.push(_encode(key) + '=' + _encode(val2));
								}
							});

						return result.join('&');
					}

					return _encode(key) + '=' + _encode(val);
				})
				.filter(function (x)
				{
					return x.length > 0;
				})
				.join('&') :
				'';
		}
	};
})();


Slate.init = function ()
{

};


! function (a, b, c)
{
	var d = window.matchMedia;
	"undefined" != typeof module && module.exports ? module.exports = c(d) : "function" == typeof define && define.amd ? define(function ()
	{
		return b[a] = c(d)
	}) : b[a] = c(d)
}("enquire", this, function (a)
{
	"use strict";

	function b(a, b)
	{
		var c, d = 0,
			e = a.length;
		for (d; e > d && (c = b(a[d], d), c !== !1); d++);
	}

	function c(a)
	{
		return "[object Array]" === Object.prototype.toString.apply(a)
	}

	function d(a)
	{
		return "function" == typeof a
	}

	function e(a)
	{
		this.options = a, !a.deferSetup && this.setup()
	}

	function f(b, c)
	{
		this.query = b, this.isUnconditional = c, this.handlers = [], this.mql = a(b);
		var d = this;
		this.listener = function (a)
		{
			d.mql = a, d.assess()
		}, this.mql.addListener(this.listener)
	}

	function g()
	{
		if (!a) throw new Error("matchMedia not present, legacy browsers require a polyfill");
		this.queries = {}, this.browserIsIncapable = !a("only all").matches
	}
	return e.prototype = {
		setup: function ()
		{
			this.options.setup && this.options.setup(), this.initialised = !0
		},
		on: function ()
		{
			!this.initialised && this.setup(), this.options.match && this.options.match()
		},
		off: function ()
		{
			this.options.unmatch && this.options.unmatch()
		},
		destroy: function ()
		{
			this.options.destroy ? this.options.destroy() : this.off()
		},
		equals: function (a)
		{
			return this.options === a || this.options.match === a
		}
	}, f.prototype = {
		addHandler: function (a)
		{
			var b = new e(a);
			this.handlers.push(b), this.matches() && b.on()
		},
		removeHandler: function (a)
		{
			var c = this.handlers;
			b(c, function (b, d)
			{
				return b.equals(a) ? (b.destroy(), !c.splice(d, 1)) : void 0
			})
		},
		matches: function ()
		{
			return this.mql.matches || this.isUnconditional
		},
		clear: function ()
		{
			b(this.handlers, function (a)
			{
				a.destroy()
			}), this.mql.removeListener(this.listener), this.handlers.length = 0
		},
		assess: function ()
		{
			var a = this.matches() ? "on" : "off";
			b(this.handlers, function (b)
			{
				b[a]()
			})
		}
	}, g.prototype = {
		register: function (a, e, g)
		{
			var h = this.queries,
				i = g && this.browserIsIncapable;
			return h[a] || (h[a] = new f(a, i)), d(e) && (e = {
				match: e
			}), c(e) || (e = [e]), b(e, function (b)
			{
				d(b) && (b = {
					match: b
				}), h[a].addHandler(b)
			}), this
		},

	}, new g
});


/*! Magnific Popup - v1.0.0 - 2015-03-30
 * http://dimsemenov.com/plugins/magnific-popup/
 * Copyright (c) 2015 Dmitry Semenov; */


/*
 * jQuery FlexSlider v2.2.2
 * Copyright 2012 WooThemes
 * Contributing Author: Tyler Smith
 */


/**
 * @license
 * lodash 4.5.1 (Custom Build) lodash.com/license | Underscore.js 1.8.3 underscorejs.org/LICENSE
 * Build: `lodash core -o ./dist/lodash.core.js`
 */
;
(function ()
{

	





	function o(n)
	{
		return n && n.Object === Object ? n : null
	}


	function a(n)
	{
		if (Y(n) && !Pn(n))
		{
			if (n instanceof l) return n;
			if (En.call(n, "__wrapped__"))
			{
				var t = new l(n.__wrapped__, n.__chain__);
				return t.__actions__ = N(n.__actions__), t
			}
		}
		return new l(n)
	}

	function l(n, t)
	{
		this.__wrapped__ = n, this.__actions__ = [], this.__chain__ = !!t
	}


	function s(n)
	{
		return X(n) ? Fn(n) :
		{}
	}




	function y(n, t)
	{
		var r = [];
		return $n(n, function (n, e, u)
		{
			t(n, e, u) && r.push(n)
		}), r
	}

	
	function g(n, t)
	{
		return n && qn(n, t, en)
	}

	function b(n, t)
	{
		return y(t, function (t)
		{
			return Q(n[t])
		})
	}

	

	function d(n)
	{
		var t = typeof n;
		return "function" == t ? n : null == n ? cn : ("object" == t ? x : A)(n)
	}

	function w(n)
	{
		n = null == n ? n : Object(n);
		var t, r = [];
		for (t in n) r.push(t);
		return r
	}




	function A(n)
	{
		return function (t)
		{
			return null == t ? an : t[n]
		}
	}



	function T(t, r)
	{
		return P(r, function (t, r)
		{
			return r.func.apply(r.thisArg, n([t], r.args))
		}, t)
	}

	function F(n, t, r, e)
	{
		r || (r = {});
		for (var u = -1, o = t.length; ++u < o;)
		{
			var i = t[u],
				c = e ? e(r[i], n[i], i, r, n) : n[i],
				f = r,
				a = f[i];
			En.call(f, i) && (a === c || a !== a && c !== c) && (c !== an || i in f) || (f[i] = c)
		}
		return r
	}

	function R(n)
	{
		return V(function (t, r)
		{
			var e = -1,
				u = r.length,
				o = u > 1 ? r[u - 1] : an,
				o = typeof o == "function" ? (u--, o) : an;
			for (t = Object(t); ++e < u;)
			{
				var i = r[e];
				i && n(t, i, e, o)
			}
			return t
		})
	}






	function z(n)
	{
		var t = n ? n.length : an;
		if (W(t) && (Pn(n) || nn(n) || K(n)))
		{
			n = String;
			for (var r = -1, e = Array(t); ++r < t;) e[r] = n(r);
			t = e
		}
		else t = null;
		return t
	}

	function C(n)
	{
		var t = n && n.constructor,
			t = Q(t) && t.prototype || xn;
		return n === t
	}

	function G(n)
	{
		return n ? n[0] : an
	}

	function J(n, t)
	{
		return r(n, d(t), $n)
	}

	function M(n, t)
	{
		return $n(n, typeof t == "function" ? t : cn)
	}

	function P(n, t, r)
	{
		return e(n, d(t), r, 3 > arguments.length, $n)
	}

	function U(n, t)
	{
		var r;
		if (typeof t != "function") throw new TypeError("Expected a function");
		return n = Un(n),
			function ()
			{
				return 0 < --n && (r = t.apply(this, arguments)), 1 >= n && (t = an), r
			}
	}

	function V(n)
	{
		var t;
		if (typeof n != "function") throw new TypeError("Expected a function");
		return t = In(t === an ? n.length - 1 : Un(t), 0),
			function ()
			{
				for (var r = arguments, e = -1, u = In(r.length - t, 0), o = Array(u); ++e < u;) o[e] = r[t + e];
				for (u = Array(t + 1), e = -1; ++e < t;) u[e] = r[e];
				return u[t] = o, n.apply(this, u)
			}
	}


	function K(n)
	{
		return Y(n) && L(n) && En.call(n, "callee") && (!Rn.call(n, "callee") || "[object Arguments]" == kn.call(n))
	}

	function L(n)
	{
		return null != n && !(typeof n == "function" && Q(n)) && W(zn(n))
	}

	function Q(n)
	{
		return n = X(n) ? kn.call(n) : "", "[object Function]" == n || "[object GeneratorFunction]" == n
	}

	function W(n)
	{
		return typeof n == "number" && n > -1 && 0 == n % 1 && 9007199254740991 >= n
	}

	function X(n)
	{
		var t = typeof n;
		return !!n && ("object" == t || "function" == t);
	}

	function Y(n)
	{
		return !!n && typeof n == "object"
	}

	function Z(n)
	{
		return typeof n == "number" || Y(n) && "[object Number]" == kn.call(n)
	}

	function nn(n)
	{
		return typeof n == "string" || !Pn(n) && Y(n) && "[object String]" == kn.call(n)
	}

	function tn(n, t)
	{
		return t > n
	}

	function rn(n)
	{
		return typeof n == "string" ? n : null == n ? "" : n + ""
	}

	function en(n)
	{
		var t = C(n);
		if (!t && !L(n)) return Dn(Object(n));
		var r, e = z(n),
			u = !!e,
			e = e || [],
			o = e.length;
		for (r in n) !En.call(n, r) || u && ("length" == r || f(r, o)) || t && "constructor" == r || e.push(r);
		return e
	}

	function un(n)
	{
		for (var t = -1, r = C(n), e = w(n), u = e.length, o = z(n), i = !!o, o = o || [], c = o.length; ++t < u;)
		{
			var a = e[t];
			i && ("length" == a || f(a, c)) || "constructor" == a && (r || !En.call(n, a)) || o.push(a)
		}
		return o
	}

	function on(n)
	{
		return n ? u(n, en(n)) : []
	}

	function cn(n)
	{
		return n
	}

	function fn(t, r, e)
	{
		var u = en(r),
			o = b(r, u);
		null != e || X(r) && (o.length || !u.length) || (e = r, r = t, t = this, o = b(r, en(r)));
		var i = X(e) && "chain" in e ? e.chain : true,
			c = Q(t);
		return $n(o, function (e)
		{
			var u = r[e];
			t[e] = u, c && (t.prototype[e] = function ()
			{
				var r = this.__chain__;
				if (i || r)
				{
					var e = t(this.__wrapped__);
					return (e.__actions__ = N(this.__actions__)).push(
					{
						func: u,
						args: arguments,
						thisArg: t
					}), e.__chain__ = r, e
				}
				return u.apply(t, n([this.value()], arguments))
			})
		}), t
	}
	var an, ln = 1 / 0,
		pn = /[&<>"'`]/g,
		sn = RegExp(pn.source),
		hn = /^(?:0|[1-9]\d*)$/,
		vn = {
			"&": "&amp;",
			"<": "&lt;",
			">": "&gt;",
			'"': "&quot;",
			"'": "&#39;",
			"`": "&#96;"
		},
		yn = {
			"function": true,
			object: true
		},
		_n = yn[typeof exports] && exports && !exports.nodeType ? exports : an,
		gn = yn[typeof module] && module && !module.nodeType ? module : an,
		bn = gn && gn.exports === _n ? _n : an,
		jn = o(yn[typeof self] && self),
		mn = o(yn[typeof window] && window),
		dn = o(yn[typeof this] && this),
		wn = o(_n && gn && typeof global == "object" && global) || mn !== (dn && dn.window) && mn || jn || dn || Function("return this")(),
		On = Array.prototype,
		xn = Object.prototype,
		En = xn.hasOwnProperty,
		An = 0,
		kn = xn.toString,
		Nn = wn._,
		Sn = wn.Reflect,
		Tn = Sn ? Sn.f : an,
		Fn = Object.create,
		Rn = xn.propertyIsEnumerable,
		Bn = wn.isFinite,
		Dn = Object.keys,
		In = Math.max,
		$n = function (n, t)
		{
			return function (r, e)
			{
				if (null == r) return r;
				if (!L(r)) return n(r, e);
				for (var u = r.length, o = t ? u : -1, i = Object(r);
					(t ? o-- : ++o < u) && false !== e(i[o], o, i););
				return r
			}
		}(g),
		qn = function (n)
		{
			return function (t, r, e)
			{
				var u = -1,
					o = Object(t);
				e = e(t);
				for (var i = e.length; i--;)
				{
					var c = e[n ? i : ++u];
					if (false === r(o[c], c, o)) break
				}
				return t
			}
		}();
	Tn && !Rn.call(
	{
		valueOf: 1
	}, "valueOf") && (w = function (n)
	{
		n = Tn(n);
		for (var t, r = []; !(t = n.next()).done;) r.push(t.value);
		return r
	});
	var zn = A("length"),
		Cn = V(function (t, r)
		{
			return Pn(t) || (t = null == t ? [] : [Object(t)]), _(r, 1),
				n(N(t), on)
		}),
		Gn = V(function (n, t, r)
		{
			return D(n, t, r)
		}),
		Jn = V(function (n, t)
		{
			return h(n, 1, t)
		}),
		Mn = V(function (n, t, r)
		{
			return h(n, Vn(t) || 0, r)
		}),
		Pn = Array.isArray,
		Un = Number,
		Vn = Number,
		Hn = R(function (n, t)
		{
			F(t, en(t), n)
		}),
		Kn = R(function (n, t)
		{
			F(t, un(t), n)
		}),
		Ln = R(function (n, t, r, e)
		{
			F(t, un(t), n, e)
		}),
		Qn = V(function (n)
		{
			return n.push(an, p), Ln.apply(an, n)
		}),
		Wn = V(function (n, t)
		{
			return null == n ?
			{} : E(n, _(t, 1))
		}),
		Xn = d;
	l.prototype = s(a.prototype), l.prototype.constructor = l, a.assignIn = Kn, a.before = U, a.bind = Gn, a.chain = function (n)
	{
		return n = a(n),
			n.__chain__ = true, n
	}, a.compact = function (n)
	{
		return y(n, Boolean)
	}, a.concat = Cn, a.create = function (n, t)
	{
		var r = s(n);
		return t ? Hn(r, t) : r
	}, a.defaults = Qn, a.defer = Jn, a.delay = Mn, a.filter = function (n, t)
	{
		return y(n, d(t))
	}, a.flatten = function (n)
	{
		return n && n.length ? _(n, 1) : []
	}, a.flattenDeep = function (n)
	{
		return n && n.length ? _(n, ln) : []
	}, a.iteratee = Xn, a.keys = en, a.map = function (n, t)
	{
		return O(n, d(t))
	}, a.matches = function (n)
	{
		return x(Hn(
		{}, n))
	}, a.mixin = fn, a.negate = function (n)
	{
		if (typeof n != "function") throw new TypeError("Expected a function");
		return function ()
		{
			return !n.apply(this, arguments)
		}
	}, a.once = function (n)
	{
		return U(2, n)
	}, a.pick = Wn, a.slice = function (n, t, r)
	{
		var e = n ? n.length : 0;
		return r = r === an ? e : +r, e ? k(n, null == t ? 0 : +t, r) : []
	}, a.sortBy = function (n, t)
	{
		var r = 0;
		return t = d(t), O(O(n, function (n, e, u)
		{
			return {
				c: n,
				b: r++,
				a: t(n, e, u)
			}
		}).sort(function (n, t)
		{
			var r;
			n:
			{
				r = n.a;
				var e = t.a;
				if (r !== e)
				{
					var u = null === r,
						o = r === an,
						i = r === r,
						c = null === e,
						f = e === an,
						a = e === e;
					if (r > e && !c || !i || u && !f && a || o && a)
					{
						r = 1;
						break n
					}
					if (e > r && !u || !a || c && !o && i || f && i)
					{
						r = -1;
						break n
					}
				}
				r = 0
			}
			return r || n.b - t.b;
		}), A("c"))
	}, a.tap = function (n, t)
	{
		return t(n), n
	}, a.thru = function (n, t)
	{
		return t(n)
	}, a.toArray = function (n)
	{
		return L(n) ? n.length ? N(n) : [] : on(n)
	}, a.values = on, a.extend = Kn, fn(a, a), a.clone = function (n)
	{
		return X(n) ? Pn(n) ? N(n) : F(n, en(n)) : n
	}, a.escape = function (n)
	{
		return (n = rn(n)) && sn.test(n) ? n.replace(pn, i) : n
	}, a.every = function (n, t, r)
	{
		return t = r ? an : t, v(n, d(t))
	}, a.find = J, a.forEach = M, a.has = function (n, t)
	{
		return null != n && En.call(n, t)
	}, a.head = G, a.identity = cn, a.indexOf = function (n, t, r)
	{
		var e = n ? n.length : 0;
		r = typeof r == "number" ? 0 > r ? In(e + r, 0) : r : 0,
			r = (r || 0) - 1;
		for (var u = t === t; ++r < e;)
		{
			var o = n[r];
			if (u ? o === t : o !== o) return r
		}
		return -1
	}, a.isArguments = K, a.isArray = Pn, a.isBoolean = function (n)
	{
		return true === n || false === n || Y(n) && "[object Boolean]" == kn.call(n)
	}, a.isDate = function (n)
	{
		return Y(n) && "[object Date]" == kn.call(n)
	}, a.isEmpty = function (n)
	{
		if (L(n) && (Pn(n) || nn(n) || Q(n.splice) || K(n))) return !n.length;
		for (var t in n)
			if (En.call(n, t)) return false;
		return true
	}, a.isEqual = function (n, t)
	{
		return j(n, t)
	}, a.isFinite = function (n)
	{
		return typeof n == "number" && Bn(n)
	}, a.isFunction = Q, a.isNaN = function (n)
	{
		return Z(n) && n != +n
	}, a.isNull = function (n)
	{
		return null === n
	}, a.isNumber = Z, a.isObject = X, a.isRegExp = function (n)
	{
		return X(n) && "[object RegExp]" == kn.call(n)
	}, a.isString = nn, a.isUndefined = function (n)
	{
		return n === an
	}, a.last = function (n)
	{
		var t = n ? n.length : 0;
		return t ? n[t - 1] : an
	}, a.max = function (n)
	{
		return n && n.length ? t(n, cn, H) : an
	}, a.min = function (n)
	{
		return n && n.length ? t(n, cn, tn) : an
	}, a.noConflict = function ()
	{
		return wn._ === this && (wn._ = Nn), this
	}, a.noop = function () {}, a.reduce = P, a.result = function (n, t, r)
	{
		return t = null == n ? an : n[t],
			t === an && (t = r), Q(t) ? t.call(n) : t
	}, a.size = function (n)
	{
		return null == n ? 0 : (n = L(n) ? n : en(n), n.length)
	}, a.some = function (n, t, r)
	{
		return t = r ? an : t, S(n, d(t))
	}, a.uniqueId = function (n)
	{
		var t = ++An;
		return rn(n) + t
	}, a.each = M, a.first = G, fn(a, function ()
	{
		var n = {};
		return g(a, function (t, r)
		{
			En.call(a.prototype, r) || (n[r] = t)
		}), n
	}(),
	{
		chain: false
	}), a.VERSION = "4.5.1", $n("pop join replace reverse split push shift sort splice unshift".split(" "), function (n)
	{
		var t = (/^(?:replace|split)$/.test(n) ? String.prototype : On)[n],
			r = /^(?:push|sort|unshift)$/.test(n) ? "tap" : "thru",
			e = /^(?:pop|join|replace|shift)$/.test(n);
		a.prototype[n] = function ()
		{
			var n = arguments;
			return e && !this.__chain__ ? t.apply(this.value(), n) : this[r](function (r)
			{
				return t.apply(r, n)
			})
		}
	}), a.prototype.toJSON = a.prototype.valueOf = a.prototype.value = function ()
	{
		return T(this.__wrapped__, this.__actions__)
	}, (mn || jn ||
	{})._ = a, typeof define == "function" && typeof define.amd == "object" && define.amd ? define(function ()
	{
		return a
	}) : _n && gn ? (bn && ((gn.exports = a)._ = a), _n._ = a) : wn._ = a
}).call(this);

/* ================ SLATE ================ */
window.theme = window.theme ||
{};

theme.Sections = function Sections()
{
	this.constructors = {};
	this.instances = [];

};

theme.Sections.prototype = _.assignIn(
{}, theme.Sections.prototype,
{
	_createInstance: function (container, constructor)
	{
		var $container = $(container);
		var id = $container.attr('data-section-id');
		var type = $container.attr('data-section-type');

		constructor = constructor || this.constructors[type];

		if (_.isUndefined(constructor)) return;

		var instance = _.assignIn(new constructor(container),
		{
			id: id,
			type: type,
			container: container
		});

		this.instances.push(instance);
	},

	_onSectionLoad: function (evt)
	{
		var container = $('[data-section-id]', evt.target)[0];
		if (container)
		{
			this._createInstance(container);
		}
	},

	_onSectionUnload: function (evt)
	{
		this.instances = _.filter(this.instances, function (instance)
		{
			var isEventInstance = instance.id === evt.originalEvent.detail.sectionId;

			if (isEventInstance)
			{
				if (_.isFunction(instance.onUnload))
				{
					instance.onUnload(evt);
				}
			}

			return !isEventInstance;
		});
	},

	_onSelect: function (evt)
	{
		// eslint-disable-next-line no-shadow
		var instance = _.find(this.instances, function (instance)
		{
			return instance.id === evt.originalEvent.detail.sectionId;
		});

		if (!_.isUndefined(instance) && _.isFunction(instance.onSelect))
		{
			instance.onSelect(evt);
		}
	},

	_onDeselect: function (evt)
	{
		// eslint-disable-next-line no-shadow
		var instance = _.find(this.instances, function (instance)
		{
			return instance.id === evt.originalEvent.detail.sectionId;
		});

		if (!_.isUndefined(instance) && _.isFunction(instance.onDeselect))
		{
			instance.onDeselect(evt);
		}
	},

	_onBlockSelect: function (evt)
	{
		// eslint-disable-next-line no-shadow
		var instance = _.find(this.instances, function (instance)
		{
			return instance.id === evt.originalEvent.detail.sectionId;
		});

		if (!_.isUndefined(instance) && _.isFunction(instance.onBlockSelect))
		{
			instance.onBlockSelect(evt);
		}
	},

	_onBlockDeselect: function (evt)
	{
		// eslint-disable-next-line no-shadow
		var instance = _.find(this.instances, function (instance)
		{
			return instance.id === evt.originalEvent.detail.sectionId;
		});

		if (!_.isUndefined(instance) && _.isFunction(instance.onBlockDeselect))
		{
			instance.onBlockDeselect(evt);
		}
	},

	register: function (type, constructor)
	{
		this.constructors[type] = constructor;

		$('[data-section-type=' + type + ']').each(
			function (index, container)
			{
				this._createInstance(container, constructor);
			}.bind(this)
		);
	}
});


/* ================ MODULES ================ */
theme.Hero = (function ()
{
	theme.sliders = function (slider, sectionId)
	{
		this.$slider = $(slider);
		this.$sliderContainer = this.$slider.parent();
		this.sectionId = sectionId;
		this.selectors = {
			slide: '[data-slider-item]',
			activeSlide: '.flex-active-slide',
			navigationButton: '[data-slider-navigation]',
			previousArrow: '[data-slider-prev]',
			pauseButton: '[data-slider-pause]',
			textContentMobile: '[data-text-mobile]',
			indicatorDotsContainer: '.flex-control-nav',
			hideSlideClass: 'slide-hide'
		};
		$.extend(theme.strings,
		{
			loadSlideA11yString: this.$slider.data('slide-nav-a11y'),
			activeSlideA11yString: this.$slider.data('slide-nav-active-a11y')
		});
		this.sliderArgs = {
			animation: this.$slider.data('transition'),
			animationSpeed: 500,
			pauseOnHover: true,
			keyboard: false,
			slideshow: this.$slider.data('autoplay'),
			slideshowSpeed: this.$slider.data('speed'),
			controlNav: true,
			directionNav: false,
			smoothHeight: false,
			controlsContainer: this.$sliderContainer.find('[data-slider-controls]'),
			before: function (slider)
			{
				var $slider = $(slider);
				$slider.resize();
				$slider
					.find(this.selectors.slide)
					.not(this.selectors.activeSlide)
					.removeClass(this.selectors.hideSlideClass);

				this.showMobileText(slider.animatingTo);
			}.bind(this),
			start: function (slider)
			{
				this.slideshowA11y(slider);
			}.bind(this),
			after: function (slider)
			{
				var $slider = $(slider);
				var $slides = $slider.find(this.selectors.slide);
				var $activeSlide = $slider.find(this.selectors.activeSlide);
				var $indicatorDots = this.$sliderContainer.find(
					this.selectors.indicatorDotsContainer + ' a'
				);
				var currentSlide = slider.currentSlide;

				$slider
					.find(this.selectors.slide)
					.not(this.selectors.activeSlide)
					.addClass(this.selectors.hideSlideClass);
				$slider.resize();

				$slides.attr('aria-hidden', true);
				$activeSlide.attr('aria-hidden', false);

				$indicatorDots.each(function (index)
				{
					var $element = $(this);
					$element.attr('aria-label', slideLabel(currentSlide, index));
					if (index === currentSlide)
					{
						$element.attr('aria-current', true);
					}
					else
					{
						$element.removeAttr('aria-current');
					}
				});
			}.bind(this),
			init: function (slider)
			{
				var $slider = $(slider);
				var previousArrow = this.selectors.previousArrow;
				$slider
					.find(this.selectors.activeSlide)
					.removeClass(this.selectors.hideSlideClass);

				this.$sliderContainer
					.find(this.selectors.navigationButton)
					.on('click keyup', function (evt)
					{
						if (
							evt.type === 'keyup' &&
							!(evt.keyCode === '13' || evt.keyCode === '32')
						)
						{
							return;
						}
						if ($(this).is(previousArrow))
						{
							$slider.flexslider('prev');
						}
						else
						{
							$slider.flexslider('next');
						}
					});

				if (this.sliderArgs.slideshow)
				{
					var $pauseButton = this.$sliderContainer.find(
						this.selectors.pauseButton
					);
					var pausedClass = 'is-paused';

					$pauseButton.on('click', function ()
					{
						var $element = $(this);
						var isPaused = $element.hasClass(pausedClass);

						$element.toggleClass(pausedClass, !isPaused).attr(
						{
							'aria-label': isPaused ?
								$element.data('label-pause') :
								$element.data('label-play'),
							'aria-pressed': !isPaused
						});

						if (isPaused)
						{
							$slider.flexslider('play');
						}
						else
						{
							$slider.flexslider('pause');
						}
					});
				}
			}.bind(this)
		};

		this.slideshowA11y = function (slider)
		{
			var $slider = $(slider);
			var $sliderContainer = this.$sliderContainer;
			var $slides = $slider.find(this.selectors.slide);
			var $activeSlide = $slider.find(this.selectors.activeSlide);
			var sectionId = this.sectionId;
			var $indicatorsContainer = $sliderContainer.find(
				this.selectors.indicatorDotsContainer
			);
			var $indicatorDots = $indicatorsContainer.find('a');

			$sliderContainer
				.on('keyup', this.keyboardNavigation.bind(this))
				.on('focusin', function (evt)
				{
					if (
						$(this).has(evt.target).length &&
						$slider.attr('aria-live') === 'polite'
					)
					{
						return;
					}

					$slider.attr('aria-live', 'polite');
				})
				.on('focusout', function (evt)
				{
					if ($(this).has(evt.relatedTarget).length)
					{
						return;
					}

					$slider.removeAttr('aria-live');
				});

			$slides.each(function ()
			{
				$(this).attr('aria-hidden', true);
			});

			$activeSlide.attr('aria-hidden', false);

			// Turn off default listeners set by flexslider
			$indicatorsContainer.off('click touchend MSPointerUp keyup', 'a, img');

			$indicatorDots.each(function (index)
			{
				var $element = $(this);
				$element
					.attr(
					{
						'aria-label': slideLabel(0, index),
						'data-slide-number': index + 1,
						'aria-controls': '#' +
							$slides
							.filter(':not(.clone)')
							.eq(index)
							.attr('id'),
						href: '#flexslider--' + sectionId
					})
					.on('keyup click', function (evt)
					{
						if (evt.type === 'keyup')
						{
							if (evt.which === 9)
							{
								evt.stopImmediatePropagation();
							}
							if (evt.which !== 13 && evt.which !== 32)
							{
								return;
							}
						}

						evt.preventDefault();

						var slideNumber = $(evt.target).data('slide-number') - 1;

						$slider.flexslider(slideNumber);

						if (evt.type === 'keyup' || evt.detail === 0)
						{
							$sliderContainer.focus();
						}
					});

				if (index === 0)
				{
					$element.attr('aria-current', true);
				}
			});
		};

		this.showMobileText = function (slideIndex)
		{
			var $allTextContent = this.$sliderContainer.find(
				this.selectors.textContentMobile
			);
			var $currentTextContent = $allTextContent.filter(
				'[data-mobile-slide-text=' + slideIndex + ']'
			);
			$allTextContent.hide();
			$currentTextContent.show();
		};

		this.keyboardNavigation = function (evt)
		{
			if (evt.keyCode === 37)
			{
				this.$slider.flexslider('prev');
			}
			if (evt.keyCode === 39)
			{
				this.$slider.flexslider('next');
			}
		};

		if (this.$slider.length)
		{
			if (this.$slider.find('li').length === 1)
			{
				this.sliderArgs.slideshow = false;
				this.sliderArgs.slideshowSpeed = 0;
				this.sliderArgs.controlNav = false;
				this.sliderArgs.directionNav = false;
				this.sliderArgs.touch = false;
			}

			var slideshow = this.$slider.flexslider(this.sliderArgs);

			this.showMobileText(0);

			return slideshow;
		}
	};

	function slideLabel(activeSlideIndex, currentIndex)
	{
		var label =
			activeSlideIndex === currentIndex ?
			theme.strings.activeSlideA11yString :
			theme.strings.loadSlideA11yString;

		return label.replace('[slide_number]', currentIndex + 1);
	}

	return theme.sliders;
})();


/* ================ Sections ================ */






window.theme = window.theme ||
{};

var classes = {
	navCollapse: 'site-nav__collapse',
	navExpand: 'site-nav__expand',
	activeSubmenu: 'site-nav__submenu--active',
	collapsedSubmenus: 'site-nav__submenu--collapsed',
	expandedSubmenus: 'site-nav__submenu--expanded'
};

var selectors = {
	submenu: '.site-nav__submenu',
	collapsedSubmenus: '.site-nav__submenu--collapsed',
	expandedSubmenus: '.site-nav__submenu--expanded',
	submenuTrigger: '.site-nav__link',
	submenuTriggerText: '.site-nav__link__text',
	submenuParent: '.site-nav--has-submenu',
	activeSubmenuParent: '.site-nav--active',
	activeSubmenu: '.site-nav__submenu--active',
	mobileMenuTrigger: '#ToggleMobileMenu',
	siteNav: '#SiteNav'
};

theme.SidebarSection = (function ()
{
	function Sidebar()
	{
		this.init();

		$(selectors.mobileMenuTrigger).on(
			'click',
			function (evt)
			{
				var $mobileMenu = $(evt.target).closest(selectors.mobileMenuTrigger);
				evt.preventDefault();
				$mobileMenu.toggleClass('open');
				$(selectors.siteNav).slideToggle(400, function ()
				{
					// Hide submenus on menu toggle
					$(selectors.submenuParent)
						.has(selectors.expandedSubmenus)
						.hideSubmenu(0);
				});
			}.bind(this)
		);
	}

	Sidebar.prototype = _.assignIn(
	{}, Sidebar.prototype,
	{
		init: function ()
		{
			$(selectors.submenuTrigger).on('click', function ()
			{
				var $trigger = $(this);
				var $parent = $trigger.parent(selectors.submenuParent);
				var shouldExpand = $trigger.hasClass(classes.navExpand);

				if (shouldExpand)
				{
					// Remove active class from all submenus
					$(selectors.activeSubmenu).removeClass(classes.activeSubmenu);

					// Show submenus with active elements
					$parent
						.find(selectors.collapsedSubmenus)
						.has(selectors.activeSubmenuParent)
						.parent(selectors.submenuParent)
						.not($parent)
						.showSubmenu(0);

					$parent.showSubmenu(400);

					// Hide all other menus on the same level
					$parent
						.siblings(selectors.submenuParent)
						.has(selectors.expandedSubmenus)
						.hideSubmenu(400);
				}
				else
				{
					$parent.hideSubmenu(400);
				}
			});
		}
	});

	$.fn.showSubmenu = function (duration)
	{
		// Toggle button
		this.children(selectors.submenuTrigger)
			.removeClass(classes.navExpand)
			.addClass(classes.navCollapse)
			.attr('aria-expanded', true)
			.children(selectors.submenuTriggerText)
			.text('-');

		// Show menu
		this.children(selectors.submenu)
			.addClass(classes.activeSubmenu)
			.addClass(classes.expandedSubmenus)
			.removeClass(classes.collapsedSubmenus)
			.slideDown(duration)
			.attr('aria-hidden', false);

		return this;
	};

	$.fn.hideSubmenu = function (duration)
	{
		// Toggle button
		this.children(selectors.submenuTrigger)
			.removeClass(classes.navCollapse)
			.addClass(classes.navExpand)
			.attr('aria-expanded', false)
			.children(selectors.submenuTriggerText)
			.text('+');

		// Hide submenu
		this.children(selectors.submenu)
			.addClass(classes.collapsedSubmenus)
			.removeClass(classes.expandedSubmenus)
			.slideUp(duration, function ()
			{
				// Hide all child submenus
				$(this)
					.find(selectors.expandedSubmenus)
					.not(this)
					.parent(selectors.submenuParent)
					.hideSubmenu(0);
			})
			.attr('aria-hidden', true);

		return this;
	};

	return Sidebar;
})();




window.theme = window.theme ||
{};



// Add theme-related JS after _slate.js.liquid

theme.initCache = function ()
{
	theme.cache = {
		$html: $('html'),

	
		$siteNav: $('#SiteNav')



    };
};

theme.variables = {
	// Breakpoints from src/stylesheets/sass/_variables.scss.liquid
	mediaQuerySmall: 'screen and (max-width: 749px)',
	mediaQueryMediumUp: 'screen and (min-width: 750px)',
	bpSmall: false,
	queryParams:
	{}
};

theme.init = function ()
{
	theme.initCache();
	theme.setBreakpoints();
	

};

//important
theme.setBreakpoints = function ()
{
	enquire.register(theme.variables.mediaQuerySmall,
	{
		match: function ()
		{
			theme.variables.bpSmall = true;
			theme.cache.$siteNav.hide();
		},
		unmatch: function ()
		{
			theme.variables.bpSmall = false;
			theme.cache.$siteNav.show();
		}
	});
};







$(document).ready(function ()
{
	var sections = new theme.Sections();


	sections.register('sidebar-section', theme.SidebarSection);



});

$(theme.init);