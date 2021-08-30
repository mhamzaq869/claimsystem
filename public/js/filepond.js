/*!
 * FilePond 4.27.0
 * Licensed under MIT, https://opensource.org/licenses/MIT/
 * Please visit https://pqina.nl/filepond/ for details.
 */

/* eslint-disable */

! function(e, t) { "object" == typeof exports && "undefined" != typeof module ? t(exports) : "function" == typeof define && define.amd ? define(["exports"], t) : t((e = e || self).FilePond = {}) }(this, function(e) {
    "use strict";
    var t = function(e, t) { for (var n in e) e.hasOwnProperty(n) && t(n, e[n]) },
        n = function(e) { var n = {}; return t(e, function(t) {! function(e, t, n) { "function" != typeof n ? Object.defineProperty(e, t, Object.assign({}, n)) : e[t] = n }(n, t, e[t]) }), n },
        r = function(e, t) {
            var n = arguments.length > 2 && void 0 !== arguments[2] ? arguments[2] : null;
            if (null === n) return e.getAttribute(t) || e.hasAttribute(t);
            e.setAttribute(t, n)
        },
        o = ["svg", "path"],
        i = function(e) { return o.includes(e) },
        a = function(e, n) { var o = arguments.length > 2 && void 0 !== arguments[2] ? arguments[2] : {}; "object" == typeof n && (o = n, n = null); var a = i(e) ? document.createElementNS("http://www.w3.org/2000/svg", e) : document.createElement(e); return n && (i(e) ? r(a, "class", n) : a.className = n), t(o, function(e, t) { r(a, e, t) }), a },
        u = function(e, t) { return function(e, n) { return void 0 !== n ? t.splice(n, 0, e) : t.push(e), e } },
        s = function(e, t) { return function(n) { return t.splice(t.indexOf(n), 1), n.element.parentNode && e.removeChild(n.element), n } },
        l = "undefined" != typeof window && void 0 !== window.document,
        c = function() { return l },
        f = "children" in (c() ? a("svg") : {}) ? function(e) { return e.children.length } : function(e) { return e.childNodes.length },
        d = function(e, t, n, r) {
            var o = n[0] || e.left,
                i = n[1] || e.top,
                a = o + e.width,
                u = i + e.height * (r[1] || 1),
                s = { element: Object.assign({}, e), inner: { left: e.left, top: e.top, right: e.right, bottom: e.bottom }, outer: { left: o, top: i, right: a, bottom: u } };
            return t.filter(function(e) { return !e.isRectIgnored() }).map(function(e) { return e.rect }).forEach(function(e) { p(s.inner, Object.assign({}, e.inner)), p(s.outer, Object.assign({}, e.outer)) }), E(s.inner), s.outer.bottom += s.element.marginBottom, s.outer.right += s.element.marginRight, E(s.outer), s
        },
        p = function(e, t) { t.top += e.top, t.right += e.left, t.bottom += e.top, t.left += e.left, t.bottom > e.bottom && (e.bottom = t.bottom), t.right > e.right && (e.right = t.right) },
        E = function(e) { e.width = e.right - e.left, e.height = e.bottom - e.top },
        _ = function(e) { return "number" == typeof e },
        T = function(e) { return e < .5 ? 2 * e * e : (4 - 2 * e) * e - 1 },
        I = {
            spring: function() {
                var e = arguments.length > 0 && void 0 !== arguments[0] ? arguments[0] : {},
                    t = e.stiffness,
                    r = void 0 === t ? .5 : t,
                    o = e.damping,
                    i = void 0 === o ? .75 : o,
                    a = e.mass,
                    u = void 0 === a ? 10 : a,
                    s = null,
                    l = null,
                    c = 0,
                    f = !1,
                    d = n({
                        interpolate: function(e, t) {
                            if (!f) {
                                if (!_(s) || !_(l)) return f = !0, void(c = 0);
                                (function(e, t, n) { var r = arguments.length > 3 && void 0 !== arguments[3] ? arguments[3] : .001; return Math.abs(e - t) < r && Math.abs(n) < r })(l += c += -(l - s) * r / u, s, c *= i) || t ? (l = s, c = 0, f = !0, d.onupdate(l), d.oncomplete(l)) : d.onupdate(l)
                            }
                        },
                        target: {
                            set: function(e) {
                                if (_(e) && !_(l) && (l = e), null === s && (s = e, l = e), l === (s = e) || void 0 === s) return f = !0, c = 0, d.onupdate(l), void d.oncomplete(l);
                                f = !1
                            },
                            get: function() { return s }
                        },
                        resting: { get: function() { return f } },
                        onupdate: function(e) {},
                        oncomplete: function(e) {}
                    });
                return d
            },
            tween: function() {
                var e, t, r = arguments.length > 0 && void 0 !== arguments[0] ? arguments[0] : {},
                    o = r.duration,
                    i = void 0 === o ? 500 : o,
                    a = r.easing,
                    u = void 0 === a ? T : a,
                    s = r.delay,
                    l = void 0 === s ? 0 : s,
                    c = null,
                    f = !0,
                    d = !1,
                    p = null,
                    E = n({
                        interpolate: function(n, r) { f || null === p || (null === c && (c = n), n - c < l || ((e = n - c - l) >= i || r ? (e = 1, t = d ? 0 : 1, E.onupdate(t * p), E.oncomplete(t * p), f = !0) : (t = e / i, E.onupdate((e >= 0 ? u(d ? 1 - t : t) : 0) * p)))) },
                        target: {
                            get: function() { return d ? 0 : p },
                            set: function(e) {
                                if (null === p) return p = e, E.onupdate(e), void E.oncomplete(e);
                                e < p ? (p = 1, d = !0) : (d = !1, p = e), f = !1, c = null
                            }
                        },
                        resting: { get: function() { return f } },
                        onupdate: function(e) {},
                        oncomplete: function(e) {}
                    });
                return E
            }
        },
        v = function(e, t, n) {
            var r = e[t] && "object" == typeof e[t][n] ? e[t][n] : e[t] || e,
                o = "string" == typeof r ? r : r.type,
                i = "object" == typeof r ? Object.assign({}, r) : {};
            return I[o] ? I[o](i) : null
        },
        m = function(e, t, n) {
            var r = arguments.length > 3 && void 0 !== arguments[3] && arguments[3];
            (t = Array.isArray(t) ? t : [t]).forEach(function(t) {
                e.forEach(function(e) {
                    var o = e,
                        i = function() { return n[e] },
                        a = function(t) { return n[e] = t };
                    "object" == typeof e && (o = e.key, i = e.getter || i, a = e.setter || a), t[o] && !r || (t[o] = { get: i, set: a })
                })
            })
        },
        h = function(e) { return null != e },
        g = { opacity: 1, scaleX: 1, scaleY: 1, translateX: 0, translateY: 0, rotateX: 0, rotateY: 0, rotateZ: 0, originX: 0, originY: 0 },
        R = function(e, t) {
            if (Object.keys(e).length !== Object.keys(t).length) return !0;
            for (var n in t)
                if (t[n] !== e[n]) return !0;
            return !1
        },
        O = function(e, t) {
            var n = t.opacity,
                r = t.perspective,
                o = t.translateX,
                i = t.translateY,
                a = t.scaleX,
                u = t.scaleY,
                s = t.rotateX,
                l = t.rotateY,
                c = t.rotateZ,
                f = t.originX,
                d = t.originY,
                p = t.width,
                E = t.height,
                _ = "",
                T = "";
            (h(f) || h(d)) && (T += "transform-origin: " + (f || 0) + "px " + (d || 0) + "px;"), h(r) && (_ += "perspective(" + r + "px) "), (h(o) || h(i)) && (_ += "translate3d(" + (o || 0) + "px, " + (i || 0) + "px, 0) "), (h(a) || h(u)) && (_ += "scale3d(" + (h(a) ? a : 1) + ", " + (h(u) ? u : 1) + ", 1) "), h(c) && (_ += "rotateZ(" + c + "rad) "), h(s) && (_ += "rotateX(" + s + "rad) "), h(l) && (_ += "rotateY(" + l + "rad) "), _.length && (T += "transform:" + _ + ";"), h(n) && (T += "opacity:" + n + ";", 0 === n && (T += "visibility:hidden;"), n < 1 && (T += "pointer-events:none;")), h(E) && (T += "height:" + E + "px;"), h(p) && (T += "width:" + p + "px;");
            var I = e.elementCurrentStyle || "";
            T.length === I.length && T === I || (e.style.cssText = T, e.elementCurrentStyle = T)
        },
        D = {
            styles: function(e) {
                var t = e.mixinConfig,
                    n = e.viewProps,
                    r = e.viewInternalAPI,
                    o = e.viewExternalAPI,
                    i = e.view,
                    a = Object.assign({}, n),
                    u = {};
                m(t, [r, o], n);
                var s = function() { return i.rect ? d(i.rect, i.childViews, [n.translateX || 0, n.translateY || 0], [n.scaleX || 0, n.scaleY || 0]) : null };
                return r.rect = { get: s }, o.rect = { get: s }, t.forEach(function(e) { n[e] = void 0 === a[e] ? g[e] : a[e] }), { write: function() { if (R(u, n)) return O(i.element, n), Object.assign(u, Object.assign({}, n)), !0 }, destroy: function() {} }
            },
            listeners: function(e) {
                e.mixinConfig, e.viewProps, e.viewInternalAPI;
                var t, n = e.viewExternalAPI,
                    r = (e.viewState, e.view),
                    o = [],
                    i = (t = r.element, function(e, n) { t.addEventListener(e, n) }),
                    a = function(e) { return function(t, n) { e.removeEventListener(t, n) } }(r.element);
                return n.on = function(e, t) { o.push({ type: e, fn: t }), i(e, t) }, n.off = function(e, t) { o.splice(o.findIndex(function(n) { return n.type === e && n.fn === t }), 1), a(e, t) }, { write: function() { return !0 }, destroy: function() { o.forEach(function(e) { a(e.type, e.fn) }) } }
            },
            animations: function(e) {
                var n = e.mixinConfig,
                    r = e.viewProps,
                    o = e.viewInternalAPI,
                    i = e.viewExternalAPI,
                    a = Object.assign({}, r),
                    u = [];
                return t(n, function(e, t) {
                    var n = v(t);
                    n && (n.onupdate = function(t) { r[e] = t }, n.target = a[e], m([{ key: e, setter: function(e) { n.target !== e && (n.target = e) }, getter: function() { return r[e] } }], [o, i], r, !0), u.push(n))
                }), {
                    write: function(e) {
                        var t = document.hidden,
                            n = !0;
                        return u.forEach(function(r) { r.resting || (n = !1), r.interpolate(e, t) }), n
                    },
                    destroy: function() {}
                }
            },
            apis: function(e) {
                var t = e.mixinConfig,
                    n = e.viewProps,
                    r = e.viewExternalAPI;
                m(t, r, n)
            }
        },
        y = function() {
            var e = arguments.length > 0 && void 0 !== arguments[0] ? arguments[0] : {},
                t = arguments.length > 1 && void 0 !== arguments[1] ? arguments[1] : {},
                n = arguments.length > 2 && void 0 !== arguments[2] ? arguments[2] : {};
            return t.layoutCalculated || (e.paddingTop = parseInt(n.paddingTop, 10) || 0, e.marginTop = parseInt(n.marginTop, 10) || 0, e.marginRight = parseInt(n.marginRight, 10) || 0, e.marginBottom = parseInt(n.marginBottom, 10) || 0, e.marginLeft = parseInt(n.marginLeft, 10) || 0, t.layoutCalculated = !0), e.left = t.offsetLeft || 0, e.top = t.offsetTop || 0, e.width = t.offsetWidth || 0, e.height = t.offsetHeight || 0, e.right = e.left + e.width, e.bottom = e.top + e.height, e.scrollTop = t.scrollTop, e.hidden = null === t.offsetParent, e
        },
        S = function() {
            var e = arguments.length > 0 && void 0 !== arguments[0] ? arguments[0] : {},
                t = e.tag,
                r = void 0 === t ? "div" : t,
                o = e.name,
                i = void 0 === o ? null : o,
                l = e.attributes,
                c = void 0 === l ? {} : l,
                p = e.read,
                E = void 0 === p ? function() {} : p,
                _ = e.write,
                T = void 0 === _ ? function() {} : _,
                I = e.create,
                v = void 0 === I ? function() {} : I,
                m = e.destroy,
                h = void 0 === m ? function() {} : m,
                g = e.filterFrameActionsForChild,
                R = void 0 === g ? function(e, t) { return t } : g,
                O = e.didCreateView,
                S = void 0 === O ? function() {} : O,
                A = e.didWriteView,
                b = void 0 === A ? function() {} : A,
                P = e.ignoreRect,
                L = void 0 !== P && P,
                M = e.ignoreRectUpdate,
                w = void 0 !== M && M,
                C = e.mixins,
                N = void 0 === C ? [] : C;
            return function(e) {
                var t, o = arguments.length > 1 && void 0 !== arguments[1] ? arguments[1] : {},
                    l = a(r, "filepond--" + i, c),
                    p = window.getComputedStyle(l, null),
                    _ = y(),
                    I = null,
                    m = !1,
                    g = [],
                    O = [],
                    A = {},
                    P = {},
                    M = [T],
                    C = [E],
                    G = [h],
                    U = function() { return l },
                    B = function() { return g.concat() },
                    q = function() { return I || (I = d(_, g, [0, 0], [1, 1])) },
                    V = { element: { get: U }, style: { get: function() { return p } }, childViews: { get: B } },
                    F = Object.assign({}, V, { rect: { get: q }, ref: { get: function() { return A } }, is: function(e) { return i === e }, appendChild: (t = l, function(e, n) { void 0 !== n && t.children[n] ? t.insertBefore(e, t.children[n]) : t.appendChild(e) }), createChildView: function(e) { return function(t, n) { return t(e, n) } }(e), linkView: function(e) { return g.push(e), e }, unlinkView: function(e) { g.splice(g.indexOf(e), 1) }, appendChildView: u(0, g), removeChildView: s(l, g), registerWriter: function(e) { return M.push(e) }, registerReader: function(e) { return C.push(e) }, registerDestroyer: function(e) { return G.push(e) }, invalidateLayout: function() { return l.layoutCalculated = !1 }, dispatch: e.dispatch, query: e.query }),
                    x = {
                        element: { get: U },
                        childViews: { get: B },
                        rect: { get: q },
                        resting: { get: function() { return m } },
                        isRectIgnored: function() { return L },
                        _read: function() {
                            I = null, g.forEach(function(e) { return e._read() }), !(w && _.width && _.height) && y(_, l, p);
                            var e = { root: j, props: o, rect: _ };
                            C.forEach(function(t) { return t(e) })
                        },
                        _write: function(e, t, n) { var r = 0 === t.length; return M.forEach(function(i) {!1 === i({ props: o, root: j, actions: t, timestamp: e, shouldOptimize: n }) && (r = !1) }), O.forEach(function(t) {!1 === t.write(e) && (r = !1) }), g.filter(function(e) { return !!e.element.parentNode }).forEach(function(o) { o._write(e, R(o, t), n) || (r = !1) }), g.forEach(function(o, i) { o.element.parentNode || (j.appendChild(o.element, i), o._read(), o._write(e, R(o, t), n), r = !1) }), m = r, b({ props: o, root: j, actions: t, timestamp: e }), r },
                        _destroy: function() { O.forEach(function(e) { return e.destroy() }), G.forEach(function(e) { e({ root: j, props: o }) }), g.forEach(function(e) { return e._destroy() }) }
                    },
                    Y = Object.assign({}, V, { rect: { get: function() { return _ } } });
                Object.keys(N).sort(function(e, t) { return "styles" === e ? 1 : "styles" === t ? -1 : 0 }).forEach(function(e) {
                    var t = D[e]({ mixinConfig: N[e], viewProps: o, viewState: P, viewInternalAPI: F, viewExternalAPI: x, view: n(Y) });
                    t && O.push(t)
                });
                var j = n(F);
                v({ root: j, props: o });
                var k = f(l);
                return g.forEach(function(e, t) { j.appendChild(e.element, k + t) }), S(j), n(x)
            }
        },
        A = function(e, t) {
            return function(n) {
                var r = n.root,
                    o = n.props,
                    i = n.actions,
                    a = void 0 === i ? [] : i,
                    u = n.timestamp,
                    s = n.shouldOptimize;
                a.filter(function(t) { return e[t.type] }).forEach(function(t) { return e[t.type]({ root: r, props: o, action: t.data, timestamp: u, shouldOptimize: s }) }), t && t({ root: r, props: o, actions: a, timestamp: u, shouldOptimize: s })
            }
        },
        b = function(e, t) { return t.parentNode.insertBefore(e, t) },
        P = function(e, t) { return t.parentNode.insertBefore(e, t.nextSibling) },
        L = function(e) { return Array.isArray(e) },
        M = function(e) { return null == e },
        w = function(e) { return e.trim() },
        C = function(e) { return "" + e },
        N = function(e) { return "boolean" == typeof e },
        G = function(e) { return N(e) ? e : "true" === e },
        U = function(e) { return "string" == typeof e },
        B = function(e) { return _(e) ? e : U(e) ? C(e).replace(/[a-z]+/gi, "") : 0 },
        q = function(e) { return parseInt(B(e), 10) },
        V = function(e) { return parseFloat(B(e)) },
        F = function(e) { return _(e) && isFinite(e) && Math.floor(e) === e },
        x = function(e) { var t = arguments.length > 1 && void 0 !== arguments[1] ? arguments[1] : 1e3; if (F(e)) return e; var n = C(e).trim(); return /MB$/i.test(n) ? (n = n.replace(/MB$i/, "").trim(), q(n) * t * t) : /KB/i.test(n) ? (n = n.replace(/KB$i/, "").trim(), q(n) * t) : q(n) },
        Y = function(e) { return "function" == typeof e },
        j = { process: "POST", patch: "PATCH", revert: "DELETE", fetch: "GET", restore: "GET", load: "GET" },
        k = function(e, t, n, r, o) {
            if (null === t) return null;
            if ("function" == typeof t) return t;
            var i = { url: "GET" === n || "PATCH" === n ? "?" + e + "=" : "", method: n, headers: o, withCredentials: !1, timeout: r, onload: null, ondata: null, onerror: null };
            if (U(t)) return i.url = t, i;
            if (Object.assign(i, t), U(i.headers)) {
                var a = i.headers.split(/:(.+)/);
                i.headers = { header: a[0], value: a[1] }
            }
            return i.withCredentials = G(i.withCredentials), i
        },
        H = function(e) { return "object" == typeof e && null !== e },
        X = function(e) { return L(e) ? "array" : function(e) { return null === e }(e) ? "null" : F(e) ? "int" : /^[0-9]+ ?(?:GB|MB|KB)$/gi.test(e) ? "bytes" : function(e) { return H(e) && U(e.url) && H(e.process) && H(e.revert) && H(e.restore) && H(e.fetch) }(e) ? "api" : typeof e },
        W = {
            array: function(e) { var t = arguments.length > 1 && void 0 !== arguments[1] ? arguments[1] : ","; return M(e) ? [] : L(e) ? e : C(e).split(t).map(w).filter(function(e) { return e.length }) },
            boolean: G,
            int: function(e) { return "bytes" === X(e) ? x(e) : q(e) },
            number: V,
            float: V,
            bytes: x,
            string: function(e) { return Y(e) ? e : C(e) },
            function: function(e) {
                return function(e) {
                    for (var t = self, n = e.split("."), r = null; r = n.shift();)
                        if (!(t = t[r])) return null;
                    return t
                }(e)
            },
            serverapi: function(e) { return (r = {}).url = U(n = e) ? n : n.url || "", r.timeout = n.timeout ? parseInt(n.timeout, 10) : 0, r.headers = n.headers ? n.headers : {}, t(j, function(e) { r[e] = k(e, n[e], j[e], r.timeout, r.headers) }), r.remove = n.remove || null, delete r.headers, r; var n, r },
            object: function(e) { try { return JSON.parse(e.replace(/{\s*'/g, '{"').replace(/'\s*}/g, '"}').replace(/'\s*:/g, '":').replace(/:\s*'/g, ':"').replace(/,\s*'/g, ',"').replace(/'\s*,/g, '",')) } catch (e) { return null } }
        },
        z = function(e, t, n) {
            if (e === t) return e;
            var r, o = X(e);
            if (o !== n) {
                var i = (r = e, W[n](r));
                if (o = X(i), null === i) throw 'Trying to assign value with incorrect type to "' + option + '", allowed type: "' + n + '"';
                e = i
            }
            return e
        },
        Q = function(e) {
            var r = {};
            return t(e, function(t) {
                var n, o, i, a = e[t];
                r[t] = (n = a[0], o = a[1], i = n, { enumerable: !0, get: function() { return i }, set: function(e) { i = z(e, n, o) } })
            }), n(r)
        },
        Z = function(e) { var t = arguments.length > 1 && void 0 !== arguments[1] ? arguments[1] : "-"; return e.split(/(?=[A-Z])/).map(function(e) { return e.toLowerCase() }).join(t) },
        $ = function(e) {
            return function(n, r, o) {
                var i = {};
                return t(e, function(e) {
                    var t = Z(e, "_").toUpperCase();
                    i["SET_" + t] = function(r) {
                        try { o.options[e] = r.value } catch (e) {}
                        n("DID_SET_" + t, { value: o.options[e] })
                    }
                }), i
            }
        },
        K = function(e) { return function(n) { var r = {}; return t(e, function(e) { r["GET_" + Z(e, "_").toUpperCase()] = function(t) { return n.options[e] } }), r } },
        J = 1,
        ee = 2,
        te = 3,
        ne = 4,
        re = 5,
        oe = function() { return Math.random().toString(36).substr(2, 9) };

    function ie(e) { this.wrapped = e }

    function ae(e) {
        var t, n;

        function r(t, n) {
            try {
                var i = e[t](n),
                    a = i.value,
                    u = a instanceof ie;
                Promise.resolve(u ? a.wrapped : a).then(function(e) { u ? r("next", e) : o(i.done ? "return" : "normal", e) }, function(e) { r("throw", e) })
            } catch (e) { o("throw", e) }
        }

        function o(e, o) {
            switch (e) {
                case "return":
                    t.resolve({ value: o, done: !0 });
                    break;
                case "throw":
                    t.reject(o);
                    break;
                default:
                    t.resolve({ value: o, done: !1 })
            }(t = t.next) ? r(t.key, t.arg): n = null
        }
        this._invoke = function(e, o) {
            return new Promise(function(i, a) {
                var u = { key: e, arg: o, resolve: i, reject: a, next: null };
                n ? n = n.next = u : (t = n = u, r(e, o))
            })
        }, "function" != typeof e.return && (this.return = void 0)
    }

    function ue(e, t) {
        if (null == e) return {};
        var n, r, o = function(e, t) {
            if (null == e) return {};
            var n, r, o = {},
                i = Object.keys(e);
            for (r = 0; r < i.length; r++) n = i[r], t.indexOf(n) >= 0 || (o[n] = e[n]);
            return o
        }(e, t);
        if (Object.getOwnPropertySymbols) { var i = Object.getOwnPropertySymbols(e); for (r = 0; r < i.length; r++) n = i[r], t.indexOf(n) >= 0 || Object.prototype.propertyIsEnumerable.call(e, n) && (o[n] = e[n]) }
        return o
    }
    "function" == typeof Symbol && Symbol.asyncIterator && (ae.prototype[Symbol.asyncIterator] = function() { return this }), ae.prototype.next = function(e) { return this._invoke("next", e) }, ae.prototype.throw = function(e) { return this._invoke("throw", e) }, ae.prototype.return = function(e) { return this._invoke("return", e) };

    function se(e) { return function(e) { if (Array.isArray(e)) { for (var t = 0, n = new Array(e.length); t < e.length; t++) n[t] = e[t]; return n } }(e) || le(e) || function() { throw new TypeError("Invalid attempt to spread non-iterable instance") }() }

    function le(e) { if (Symbol.iterator in Object(e) || "[object Arguments]" === Object.prototype.toString.call(e)) return Array.from(e) }
    var ce, fe, de = function(e, t) { return e.splice(t, 1) },
        pe = function() {
            var e = [],
                t = function(t, n) { de(e, e.findIndex(function(e) { return e.event === t && (e.cb === n || !n) })) },
                n = function(t, n, r) { e.filter(function(e) { return e.event === t }).map(function(e) { return e.cb }).forEach(function(e) { return function(e, t) { t ? e() : document.hidden ? Promise.resolve(1).then(e) : setTimeout(e, 0) }(function() { return e.apply(void 0, se(n)) }, r) }) };
            return {
                fireSync: function(e) {
                    for (var t = arguments.length, r = new Array(t > 1 ? t - 1 : 0), o = 1; o < t; o++) r[o - 1] = arguments[o];
                    n(e, r, !0)
                },
                fire: function(e) {
                    for (var t = arguments.length, r = new Array(t > 1 ? t - 1 : 0), o = 1; o < t; o++) r[o - 1] = arguments[o];
                    n(e, r, !1)
                },
                on: function(t, n) { e.push({ event: t, cb: n }) },
                onOnce: function(n, r) { e.push({ event: n, cb: function() { t(n, r), r.apply(void 0, arguments) } }) },
                off: t
            }
        },
        Ee = function(e, t, n) { Object.getOwnPropertyNames(e).filter(function(e) { return !n.includes(e) }).forEach(function(n) { return Object.defineProperty(t, n, Object.getOwnPropertyDescriptor(e, n)) }) },
        _e = ["fire", "process", "revert", "load", "on", "off", "onOnce", "retryLoad", "extend", "archive", "archived", "release", "released", "requestProcessing", "freeze"],
        Te = function(e) { var t = {}; return Ee(e, t, _e), t },
        Ie = { INIT: 1, IDLE: 2, PROCESSING_QUEUED: 9, PROCESSING: 3, PROCESSING_COMPLETE: 5, PROCESSING_ERROR: 6, PROCESSING_REVERT_ERROR: 10, LOADING: 7, LOAD_ERROR: 8 },
        ve = { INPUT: 1, LIMBO: 2, LOCAL: 3 },
        me = function(e) { return /[^0-9]+/.exec(e) },
        he = function() { return me(1.1.toLocaleString())[0] },
        ge = { BOOLEAN: "boolean", INT: "int", NUMBER: "number", STRING: "string", ARRAY: "array", OBJECT: "object", FUNCTION: "function", ACTION: "action", SERVER_API: "serverapi", REGEX: "regex" },
        Re = [],
        Oe = function(e, t, n) {
            return new Promise(function(r, o) {
                var i = Re.filter(function(t) { return t.key === e }).map(function(e) { return e.cb });
                if (0 !== i.length) {
                    var a = i.shift();
                    i.reduce(function(e, t) { return e.then(function(e) { return t(e, n) }) }, a(t, n)).then(function(e) { return r(e) }).catch(function(e) { return o(e) })
                } else r(t)
            })
        },
        De = function(e, t, n) { return Re.filter(function(t) { return t.key === e }).map(function(e) { return e.cb(t, n) }) },
        ye = function(e, t) { return Re.push({ key: e, cb: t }) },
        Se = function() { return Object.assign({}, Ae) },
        Ae = {
            id: [null, ge.STRING],
            name: ["filepond", ge.STRING],
            disabled: [!1, ge.BOOLEAN],
            className: [null, ge.STRING],
            required: [!1, ge.BOOLEAN],
            captureMethod: [null, ge.STRING],
            allowSyncAcceptAttribute: [!0, ge.BOOLEAN],
            allowDrop: [!0, ge.BOOLEAN],
            allowBrowse: [!0, ge.BOOLEAN],
            allowPaste: [!0, ge.BOOLEAN],
            allowMultiple: [!1, ge.BOOLEAN],
            allowReplace: [!0, ge.BOOLEAN],
            allowRevert: [!0, ge.BOOLEAN],
            allowRemove: [!0, ge.BOOLEAN],
            allowProcess: [!0, ge.BOOLEAN],
            allowReorder: [!1, ge.BOOLEAN],
            allowDirectoriesOnly: [!1, ge.BOOLEAN],
            forceRevert: [!1, ge.BOOLEAN],
            maxFiles: [null, ge.INT],
            checkValidity: [!1, ge.BOOLEAN],
            itemInsertLocationFreedom: [!0, ge.BOOLEAN],
            itemInsertLocation: ["before", ge.STRING],
            itemInsertInterval: [75, ge.INT],
            dropOnPage: [!1, ge.BOOLEAN],
            dropOnElement: [!0, ge.BOOLEAN],
            dropValidation: [!1, ge.BOOLEAN],
            ignoredFiles: [
                [".ds_store", "thumbs.db", "desktop.ini"], ge.ARRAY
            ],
            instantUpload: [!0, ge.BOOLEAN],
            maxParallelUploads: [2, ge.INT],
            allowMinimumUploadDuration: [!0, ge.BOOLEAN],
            chunkUploads: [!1, ge.BOOLEAN],
            chunkForce: [!1, ge.BOOLEAN],
            chunkSize: [5e6, ge.INT],
            chunkRetryDelays: [
                [500, 1e3, 3e3], ge.ARRAY
            ],
            server: [null, ge.SERVER_API],
            fileSizeBase: [1e3, ge.INT],
            labelDecimalSeparator: [he(), ge.STRING],
            labelThousandsSeparator: [(ce = he(), fe = 1e3.toLocaleString(), fe !== 1e3.toString() ? me(fe)[0] : "." === ce ? "," : "."), ge.STRING],
            labelIdle: ['Drag & Drop your files or <span class="filepond--label-action">Browse</span>', ge.STRING],
            labelInvalidField: ["Field contains invalid files", ge.STRING],
            labelFileWaitingForSize: ["Waiting for size", ge.STRING],
            labelFileSizeNotAvailable: ["Size not available", ge.STRING],
            labelFileCountSingular: ["file in list", ge.STRING],
            labelFileCountPlural: ["files in list", ge.STRING],
            labelFileLoading: ["Loading", ge.STRING],
            labelFileAdded: ["Added", ge.STRING],
            labelFileLoadError: ["Error during load", ge.STRING],
            labelFileRemoved: ["Removed", ge.STRING],
            labelFileRemoveError: ["Error during remove", ge.STRING],
            labelFileProcessing: ["Uploading", ge.STRING],
            labelFileProcessingComplete: ["Upload complete", ge.STRING],
            labelFileProcessingAborted: ["Upload cancelled", ge.STRING],
            labelFileProcessingError: ["Error during upload", ge.STRING],
            labelFileProcessingRevertError: ["Error during revert", ge.STRING],
            labelTapToCancel: ["tap to cancel", ge.STRING],
            labelTapToRetry: ["tap to retry", ge.STRING],
            labelTapToUndo: ["tap to undo", ge.STRING],
            labelButtonRemoveItem: ["Remove", ge.STRING],
            labelButtonAbortItemLoad: ["Abort", ge.STRING],
            labelButtonRetryItemLoad: ["Retry", ge.STRING],
            labelButtonAbortItemProcessing: ["Cancel", ge.STRING],
            labelButtonUndoItemProcessing: ["Undo", ge.STRING],
            labelButtonRetryItemProcessing: ["Retry", ge.STRING],
            labelButtonProcessItem: ["Upload", ge.STRING],
            iconRemove: ['<svg width="26" height="26" viewBox="0 0 26 26" xmlns="http://www.w3.org/2000/svg"><path d="M11.586 13l-2.293 2.293a1 1 0 0 0 1.414 1.414L13 14.414l2.293 2.293a1 1 0 0 0 1.414-1.414L14.414 13l2.293-2.293a1 1 0 0 0-1.414-1.414L13 11.586l-2.293-2.293a1 1 0 0 0-1.414 1.414L11.586 13z" fill="currentColor" fill-rule="nonzero"/></svg>', ge.STRING],
            iconProcess: ['<svg width="26" height="26" viewBox="0 0 26 26" xmlns="http://www.w3.org/2000/svg"><path d="M14 10.414v3.585a1 1 0 0 1-2 0v-3.585l-1.293 1.293a1 1 0 0 1-1.414-1.415l3-3a1 1 0 0 1 1.414 0l3 3a1 1 0 0 1-1.414 1.415L14 10.414zM9 18a1 1 0 0 1 0-2h8a1 1 0 0 1 0 2H9z" fill="currentColor" fill-rule="evenodd"/></svg>', ge.STRING],
            iconRetry: ['<svg width="26" height="26" viewBox="0 0 26 26" xmlns="http://www.w3.org/2000/svg"><path d="M10.81 9.185l-.038.02A4.997 4.997 0 0 0 8 13.683a5 5 0 0 0 5 5 5 5 0 0 0 5-5 1 1 0 0 1 2 0A7 7 0 1 1 9.722 7.496l-.842-.21a.999.999 0 1 1 .484-1.94l3.23.806c.535.133.86.675.73 1.21l-.804 3.233a.997.997 0 0 1-1.21.73.997.997 0 0 1-.73-1.21l.23-.928v-.002z" fill="currentColor" fill-rule="nonzero"/></svg>', ge.STRING],
            iconUndo: ['<svg width="26" height="26" viewBox="0 0 26 26" xmlns="http://www.w3.org/2000/svg"><path d="M9.185 10.81l.02-.038A4.997 4.997 0 0 1 13.683 8a5 5 0 0 1 5 5 5 5 0 0 1-5 5 1 1 0 0 0 0 2A7 7 0 1 0 7.496 9.722l-.21-.842a.999.999 0 1 0-1.94.484l.806 3.23c.133.535.675.86 1.21.73l3.233-.803a.997.997 0 0 0 .73-1.21.997.997 0 0 0-1.21-.73l-.928.23-.002-.001z" fill="currentColor" fill-rule="nonzero"/></svg>', ge.STRING],
            iconDone: ['<svg width="26" height="26" viewBox="0 0 26 26" xmlns="http://www.w3.org/2000/svg"><path d="M18.293 9.293a1 1 0 0 1 1.414 1.414l-7.002 7a1 1 0 0 1-1.414 0l-3.998-4a1 1 0 1 1 1.414-1.414L12 15.586l6.294-6.293z" fill="currentColor" fill-rule="nonzero"/></svg>', ge.STRING],
            oninit: [null, ge.FUNCTION],
            onwarning: [null, ge.FUNCTION],
            onerror: [null, ge.FUNCTION],
            onactivatefile: [null, ge.FUNCTION],
            oninitfile: [null, ge.FUNCTION],
            onaddfilestart: [null, ge.FUNCTION],
            onaddfileprogress: [null, ge.FUNCTION],
            onaddfile: [null, ge.FUNCTION],
            onprocessfilestart: [null, ge.FUNCTION],
            onprocessfileprogress: [null, ge.FUNCTION],
            onprocessfileabort: [null, ge.FUNCTION],
            onprocessfilerevert: [null, ge.FUNCTION],
            onprocessfile: [null, ge.FUNCTION],
            onprocessfiles: [null, ge.FUNCTION],
            onremovefile: [null, ge.FUNCTION],
            onpreparefile: [null, ge.FUNCTION],
            onupdatefiles: [null, ge.FUNCTION],
            onreorderfiles: [null, ge.FUNCTION],
            beforeDropFile: [null, ge.FUNCTION],
            beforeAddFile: [null, ge.FUNCTION],
            beforeRemoveFile: [null, ge.FUNCTION],
            beforePrepareFile: [null, ge.FUNCTION],
            stylePanelLayout: [null, ge.STRING],
            stylePanelAspectRatio: [null, ge.STRING],
            styleItemPanelAspectRatio: [null, ge.STRING],
            styleButtonRemoveItemPosition: ["left", ge.STRING],
            styleButtonProcessItemPosition: ["right", ge.STRING],
            styleLoadIndicatorPosition: ["right", ge.STRING],
            styleProgressIndicatorPosition: ["right", ge.STRING],
            styleButtonRemoveItemAlign: [!1, ge.BOOLEAN],
            files: [
                [], ge.ARRAY
            ],
            credits: [
                ["https://pqina.nl/", "Powered by PQINA"], ge.ARRAY
            ]
        },
        be = function(e, t) { return M(t) ? e[0] || null : F(t) ? e[t] || null : ("object" == typeof t && (t = t.id), e.find(function(e) { return e.id === t }) || null) },
        Pe = function(e) { if (M(e)) return e; if (/:/.test(e)) { var t = e.split(":"); return t[1] / t[0] } return parseFloat(e) },
        Le = function(e) { return e.filter(function(e) { return !e.archived }) },
        Me = { EMPTY: 0, IDLE: 1, ERROR: 2, BUSY: 3, READY: 4 },
        we = [Ie.LOAD_ERROR, Ie.PROCESSING_ERROR, Ie.PROCESSING_REVERT_ERROR],
        Ce = [Ie.LOADING, Ie.PROCESSING, Ie.PROCESSING_QUEUED, Ie.INIT],
        Ne = [Ie.PROCESSING_COMPLETE],
        Ge = function(e) { return we.includes(e.status) },
        Ue = function(e) { return Ce.includes(e.status) },
        Be = function(e) { return Ne.includes(e.status) },
        qe = function(e) {
            return {
                GET_STATUS: function() {
                    var t = Le(e.items),
                        n = Me.EMPTY,
                        r = Me.ERROR,
                        o = Me.BUSY,
                        i = Me.IDLE,
                        a = Me.READY;
                    return 0 === t.length ? n : t.some(Ge) ? r : t.some(Ue) ? o : t.some(Be) ? a : i
                },
                GET_ITEM: function(t) { return be(e.items, t) },
                GET_ACTIVE_ITEM: function(t) { return be(Le(e.items), t) },
                GET_ACTIVE_ITEMS: function() { return Le(e.items) },
                GET_ITEMS: function() { return e.items },
                GET_ITEM_NAME: function(t) { var n = be(e.items, t); return n ? n.filename : null },
                GET_ITEM_SIZE: function(t) { var n = be(e.items, t); return n ? n.fileSize : null },
                GET_STYLES: function() { return Object.keys(e.options).filter(function(e) { return /^style/.test(e) }).map(function(t) { return { name: t, value: e.options[t] } }) },
                GET_PANEL_ASPECT_RATIO: function() { return /circle/.test(e.options.stylePanelLayout) ? 1 : Pe(e.options.stylePanelAspectRatio) },
                GET_ITEM_PANEL_ASPECT_RATIO: function() { return e.options.styleItemPanelAspectRatio },
                GET_ITEMS_BY_STATUS: function(t) { return Le(e.items).filter(function(e) { return e.status === t }) },
                GET_TOTAL_ITEMS: function() { return Le(e.items).length },
                IS_ASYNC: function() { return H(e.options.server) && (H(e.options.server.process) || Y(e.options.server.process)) }
            }
        },
        Ve = function(e, t, n) { return Math.max(Math.min(n, e), t) },
        Fe = function(e) { return /^\s*data:([a-z]+\/[a-z0-9-+.]+(;[a-z-]+=[a-z0-9-]+)?)?(;base64)?,([a-z0-9!$&',()*+;=\-._~:@\/?%\s]*)\s*$/i.test(e) },
        xe = function(e) { return e.split("/").pop().split("?").shift() },
        Ye = function(e) { return e.split(".").pop() },
        je = function(e) { var t = arguments.length > 1 && void 0 !== arguments[1] ? arguments[1] : ""; return (t + e).slice(-t.length) },
        ke = function() { var e = arguments.length > 0 && void 0 !== arguments[0] ? arguments[0] : new Date; return e.getFullYear() + "-" + je(e.getMonth() + 1, "00") + "-" + je(e.getDate(), "00") + "_" + je(e.getHours(), "00") + "-" + je(e.getMinutes(), "00") + "-" + je(e.getSeconds(), "00") },
        He = function(e, t) {
            var n = arguments.length > 2 && void 0 !== arguments[2] ? arguments[2] : null,
                r = arguments.length > 3 && void 0 !== arguments[3] ? arguments[3] : null,
                o = "string" == typeof n ? e.slice(0, e.size, n) : e.slice(0, e.size, e.type);
            return o.lastModifiedDate = new Date, e._relativePath && (o._relativePath = e._relativePath), U(t) || (t = ke()), t && null === r && Ye(t) ? o.name = t : (r = r || function(e) { if ("string" != typeof e) return ""; var t = e.split("/").pop(); return /svg/.test(t) ? "svg" : /zip|compressed/.test(t) ? "zip" : /plain/.test(t) ? "txt" : /msword/.test(t) ? "doc" : /[a-z]+/.test(t) ? "jpeg" === t ? "jpg" : t : "" }(o.type), o.name = t + (r ? "." + r : "")), o
        },
        Xe = function(e, t) { var n = window.BlobBuilder = window.BlobBuilder || window.WebKitBlobBuilder || window.MozBlobBuilder || window.MSBlobBuilder; if (n) { var r = new n; return r.append(e), r.getBlob(t) } return new Blob([e], { type: t }) },
        We = function(e) { return (/^data:(.+);/.exec(e) || [])[1] || null },
        ze = function(e) { var t = We(e); return function(e, t) { for (var n = new ArrayBuffer(e.length), r = new Uint8Array(n), o = 0; o < e.length; o++) r[o] = e.charCodeAt(o); return Xe(n, t) }(function(e) { return atob(function(e) { return e.split(",")[1].replace(/\s/g, "") }(e)) }(e), t) },
        Qe = function(e) { if (!/^content-disposition:/i.test(e)) return null; var t = e.split(/filename=|filename\*=.+''/).splice(1).map(function(e) { return e.trim().replace(/^["']|[;"']{0,2}$/g, "") }).filter(function(e) { return e.length }); return t.length ? decodeURI(t[t.length - 1]) : null },
        Ze = function(e) { if (/content-length:/i.test(e)) { var t = e.match(/[0-9]+/)[0]; return t ? parseInt(t, 10) : null } return null },
        $e = function(e) { return /x-content-transfer-id:/i.test(e) && (e.split(":")[1] || "").trim() || null },
        Ke = function(e) {
            var t = { source: null, name: null, size: null },
                n = e.split("\n"),
                r = !0,
                o = !1,
                i = void 0;
            try {
                for (var a, u = n[Symbol.iterator](); !(r = (a = u.next()).done); r = !0) {
                    var s = a.value,
                        l = Qe(s);
                    if (l) t.name = l;
                    else {
                        var c = Ze(s);
                        if (c) t.size = c;
                        else {
                            var f = $e(s);
                            f && (t.source = f)
                        }
                    }
                }
            } catch (e) { o = !0, i = e } finally { try { r || null == u.return || u.return() } finally { if (o) throw i } }
            return t
        },
        Je = function(e) {
            var t = { source: null, complete: !1, progress: 0, size: null, timestamp: null, duration: 0, request: null },
                n = function(n) {
                    e ? (t.timestamp = Date.now(), t.request = e(n, function(e) { t.duration = Date.now() - t.timestamp, t.complete = !0, e instanceof Blob && (e = He(e, e.name || xe(n))), r.fire("load", e instanceof Blob ? e : e ? e.body : null) }, function(e) { r.fire("error", "string" == typeof e ? { type: "error", code: 0, body: e } : e) }, function(e, n, o) { o && (t.size = o), t.duration = Date.now() - t.timestamp, e ? (t.progress = n / o, r.fire("progress", t.progress)) : t.progress = null }, function() { r.fire("abort") }, function(e) {
                        var n = Ke("string" == typeof e ? e : e.headers);
                        r.fire("meta", { size: t.size || n.size, filename: n.name, source: n.source })
                    })) : r.fire("error", { type: "error", body: "Can't load URL", code: 400 })
                },
                r = Object.assign({}, pe(), {
                    setSource: function(e) { return t.source = e },
                    getProgress: function() { return t.progress },
                    abort: function() { t.request && t.request.abort && t.request.abort() },
                    load: function() {
                        var e, o, i = t.source;
                        r.fire("init", i), i instanceof File ? r.fire("load", i) : i instanceof Blob ? r.fire("load", He(i, i.name)) : Fe(i) ? r.fire("load", He(ze(i), e, null, o)) : n(i)
                    }
                });
            return r
        },
        et = function(e) { return /GET|HEAD/.test(e) },
        tt = function(e, t, n) {
            var r = { onheaders: function() {}, onprogress: function() {}, onload: function() {}, ontimeout: function() {}, onerror: function() {}, onabort: function() {}, abort: function() { o = !0, a.abort() } },
                o = !1,
                i = !1;
            n = Object.assign({ method: "POST", headers: {}, withCredentials: !1 }, n), t = encodeURI(t), et(n.method) && e && (t = "" + t + encodeURIComponent("string" == typeof e ? e : JSON.stringify(e)));
            var a = new XMLHttpRequest;
            return (et(n.method) ? a : a.upload).onprogress = function(e) { o || r.onprogress(e.lengthComputable, e.loaded, e.total) }, a.onreadystatechange = function() { a.readyState < 2 || 4 === a.readyState && 0 === a.status || i || (i = !0, r.onheaders(a)) }, a.onload = function() { a.status >= 200 && a.status < 300 ? r.onload(a) : r.onerror(a) }, a.onerror = function() { return r.onerror(a) }, a.onabort = function() { o = !0, r.onabort() }, a.ontimeout = function() { return r.ontimeout(a) }, a.open(n.method, t, !0), F(n.timeout) && (a.timeout = n.timeout), Object.keys(n.headers).forEach(function(e) {
                var t = unescape(encodeURIComponent(n.headers[e]));
                a.setRequestHeader(e, t)
            }), n.responseType && (a.responseType = n.responseType), n.withCredentials && (a.withCredentials = !0), a.send(e), r
        },
        nt = function(e, t, n, r) { return { type: e, code: t, body: n, headers: r } },
        rt = function(e) { return function(t) { e(nt("error", 0, "Timeout", t.getAllResponseHeaders())) } },
        ot = function(e) { return /\?/.test(e) },
        it = function() { for (var e = "", t = arguments.length, n = new Array(t), r = 0; r < t; r++) n[r] = arguments[r]; return n.forEach(function(t) { e += ot(e) && ot(t) ? t.replace(/\?/, "&") : t }), e },
        at = function() {
            var e = arguments.length > 0 && void 0 !== arguments[0] ? arguments[0] : "",
                t = arguments.length > 1 ? arguments[1] : void 0;
            if ("function" == typeof t) return t;
            if (!t || !U(t.url)) return null;
            var n = t.onload || function(e) { return e },
                r = t.onerror || function(e) { return null };
            return function(o, i, a, u, s, l) {
                var c = tt(o, it(e, t.url), Object.assign({}, t, { responseType: "blob" }));
                return c.onload = function(e) {
                    var r = e.getAllResponseHeaders(),
                        a = Ke(r).name || xe(o);
                    i(nt("load", e.status, "HEAD" === t.method ? null : He(n(e.response), a), r))
                }, c.onerror = function(e) { a(nt("error", e.status, r(e.response) || e.statusText, e.getAllResponseHeaders())) }, c.onheaders = function(e) { l(nt("headers", e.status, null, e.getAllResponseHeaders())) }, c.ontimeout = rt(a), c.onprogress = u, c.onabort = s, c
            }
        },
        ut = 0,
        st = 1,
        lt = 2,
        ct = 3,
        ft = 4,
        dt = function(e, t, n, r, o, i, a, u, s, l, c) {
            for (var f = [], d = c.chunkTransferId, p = c.chunkServer, E = c.chunkSize, _ = c.chunkRetryDelays, T = { serverId: d, aborted: !1 }, I = t.ondata || function(e) { return e }, v = t.onload || function(e, t) { return "HEAD" === t ? e.getResponseHeader("Upload-Offset") : e.response }, m = t.onerror || function(e) { return null }, h = Math.floor(r.size / E), g = 0; g <= h; g++) {
                var R = g * E,
                    O = r.slice(R, R + E, "application/offset+octet-stream");
                f[g] = { index: g, size: O.size, offset: R, data: O, file: r, progress: 0, retries: se(_), status: ut, error: null, request: null, timeout: null }
            }
            var D, y, S, A, b = function(e) { return e.status === ut || e.status === ct },
                P = function(t) {
                    if (!T.aborted)
                        if (t = t || f.find(b)) {
                            t.status = lt, t.progress = null;
                            var n = p.ondata || function(e) { return e },
                                o = p.onerror || function(e) { return null },
                                u = it(e, p.url, T.serverId),
                                l = "function" == typeof p.headers ? p.headers(t) : Object.assign({}, p.headers, { "Content-Type": "application/offset+octet-stream", "Upload-Offset": t.offset, "Upload-Length": r.size, "Upload-Name": r.name }),
                                c = t.request = tt(n(t.data), u, Object.assign({}, p, { headers: l }));
                            c.onload = function() { t.status = st, t.request = null, w() }, c.onprogress = function(e, n, r) { t.progress = e ? n : null, M() }, c.onerror = function(e) { t.status = ct, t.request = null, t.error = o(e.response) || e.statusText, L(t) || a(nt("error", e.status, o(e.response) || e.statusText, e.getAllResponseHeaders())) }, c.ontimeout = function(e) { t.status = ct, t.request = null, L(t) || rt(a)(e) }, c.onabort = function() { t.status = ut, t.request = null, s() }
                        } else f.every(function(e) { return e.status === st }) && i(T.serverId)
                },
                L = function(e) { return 0 !== e.retries.length && (e.status = ft, clearTimeout(e.timeout), e.timeout = setTimeout(function() { P(e) }, e.retries.shift()), !0) },
                M = function() {
                    var e = f.reduce(function(e, t) { return null === e || null === t.progress ? null : e + t.progress }, 0);
                    if (null === e) return u(!1, 0, 0);
                    var t = f.reduce(function(e, t) { return e + t.size }, 0);
                    u(!0, e, t)
                },
                w = function() { f.filter(function(e) { return e.status === lt }).length >= 1 || P() };
            return T.serverId ? (D = function(e) { T.aborted || (f.filter(function(t) { return t.offset < e }).forEach(function(e) { e.status = st, e.progress = e.size }), w()) }, y = it(e, p.url, T.serverId), S = { headers: "function" == typeof t.headers ? t.headers(T.serverId) : Object.assign({}, t.headers), method: "HEAD" }, (A = tt(null, y, S)).onload = function(e) { return D(v(e, S.method)) }, A.onerror = function(e) { return a(nt("error", e.status, m(e.response) || e.statusText, e.getAllResponseHeaders())) }, A.ontimeout = rt(a)) : function(i) {
                var u = new FormData;
                H(o) && u.append(n, JSON.stringify(o));
                var s = "function" == typeof t.headers ? t.headers(r, o) : Object.assign({}, t.headers, { "Upload-Length": r.size }),
                    l = Object.assign({}, t, { headers: s }),
                    c = tt(I(u), it(e, t.url), l);
                c.onload = function(e) { return i(v(e, l.method)) }, c.onerror = function(e) { return a(nt("error", e.status, m(e.response) || e.statusText, e.getAllResponseHeaders())) }, c.ontimeout = rt(a)
            }(function(e) { T.aborted || (l(e), T.serverId = e, w()) }), { abort: function() { T.aborted = !0, f.forEach(function(e) { clearTimeout(e.timeout), e.request && e.request.abort() }) } }
        },
        pt = function() {
            var e = arguments.length > 0 && void 0 !== arguments[0] ? arguments[0] : "",
                t = arguments.length > 1 ? arguments[1] : void 0,
                n = arguments.length > 2 ? arguments[2] : void 0,
                r = arguments.length > 3 ? arguments[3] : void 0;
            return "function" == typeof t ? function() { for (var e = arguments.length, o = new Array(e), i = 0; i < e; i++) o[i] = arguments[i]; return t.apply(void 0, [n].concat(o, [r])) } : t && U(t.url) ? function(e, t, n, r) {
                return function(o, i, a, u, s, l, c) {
                    if (o) {
                        var f = r.chunkUploads,
                            d = f && o.size > r.chunkSize,
                            p = f && (d || r.chunkForce);
                        if (o instanceof Blob && p) return dt(e, t, n, o, i, a, u, s, l, c, r);
                        var E = t.ondata || function(e) { return e },
                            _ = t.onload || function(e) { return e },
                            T = t.onerror || function(e) { return null },
                            I = "function" == typeof t.headers ? t.headers(o, i) || {} : Object.assign({}, t.headers),
                            v = Object.assign({}, t, { headers: I }),
                            m = new FormData;
                        H(i) && m.append(n, JSON.stringify(i)), (o instanceof Blob ? [{ name: null, file: o }] : o).forEach(function(e) { m.append(n, e.file, null === e.name ? e.file.name : "" + e.name + e.file.name) });
                        var h = tt(E(m), it(e, t.url), v);
                        return h.onload = function(e) { a(nt("load", e.status, _(e.response), e.getAllResponseHeaders())) }, h.onerror = function(e) { u(nt("error", e.status, T(e.response) || e.statusText, e.getAllResponseHeaders())) }, h.ontimeout = rt(u), h.onprogress = s, h.onabort = l, h
                    }
                }
            }(e, t, n, r) : null
        },
        Et = function() {
            var e = arguments.length > 0 && void 0 !== arguments[0] ? arguments[0] : "",
                t = arguments.length > 1 ? arguments[1] : void 0;
            if ("function" == typeof t) return t;
            if (!t || !U(t.url)) return function(e, t) { return t() };
            var n = t.onload || function(e) { return e },
                r = t.onerror || function(e) { return null };
            return function(o, i, a) { var u = tt(o, e + t.url, t); return u.onload = function(e) { i(nt("load", e.status, n(e.response), e.getAllResponseHeaders())) }, u.onerror = function(e) { a(nt("error", e.status, r(e.response) || e.statusText, e.getAllResponseHeaders())) }, u.ontimeout = rt(a), u }
        },
        _t = function() {
            var e = arguments.length > 0 && void 0 !== arguments[0] ? arguments[0] : 0,
                t = arguments.length > 1 && void 0 !== arguments[1] ? arguments[1] : 1;
            return e + Math.random() * (t - e)
        },
        Tt = function(e, t) {
            var n = { complete: !1, perceivedProgress: 0, perceivedPerformanceUpdater: null, progress: null, timestamp: null, perceivedDuration: 0, duration: 0, request: null, response: null },
                r = t.allowMinimumUploadDuration,
                o = function() { n.request && (n.perceivedPerformanceUpdater.clear(), n.request.abort && n.request.abort(), n.complete = !0) },
                i = Object.assign({}, pe(), {
                    process: function(t, o) {
                        var a = function() { 0 !== n.duration && null !== n.progress && i.fire("progress", i.getProgress()) },
                            u = function() { n.complete = !0, i.fire("load-perceived", n.response.body) };
                        i.fire("start"), n.timestamp = Date.now(), n.perceivedPerformanceUpdater = function(e) {
                            var t = arguments.length > 1 && void 0 !== arguments[1] ? arguments[1] : 1e3,
                                n = (arguments.length > 2 && void 0 !== arguments[2] && arguments[2], arguments.length > 3 && void 0 !== arguments[3] ? arguments[3] : 25),
                                r = arguments.length > 4 && void 0 !== arguments[4] ? arguments[4] : 250,
                                o = null,
                                i = Date.now();
                            return function a() {
                                var u = Date.now() - i,
                                    s = _t(n, r);
                                u + s > t && (s = u + s - t);
                                var l = u / t;
                                l >= 1 || document.hidden ? e(1) : (e(l), o = setTimeout(a, s))
                            }(), { clear: function() { clearTimeout(o) } }
                        }(function(e) { n.perceivedProgress = e, n.perceivedDuration = Date.now() - n.timestamp, a(), n.response && 1 === n.perceivedProgress && !n.complete && u() }, r ? _t(750, 1500) : 0), n.request = e(t, o, function(e) { n.response = H(e) ? e : { type: "load", code: 200, body: "" + e, headers: {} }, n.duration = Date.now() - n.timestamp, n.progress = 1, i.fire("load", n.response.body), 1 === n.perceivedProgress && u() }, function(e) { n.perceivedPerformanceUpdater.clear(), i.fire("error", H(e) ? e : { type: "error", code: 0, body: "" + e }) }, function(e, t, r) { n.duration = Date.now() - n.timestamp, n.progress = e ? t / r : null, a() }, function() { n.perceivedPerformanceUpdater.clear(), i.fire("abort", n.response ? n.response.body : null) }, function(e) { i.fire("transfer", e) })
                    },
                    abort: o,
                    getProgress: function() { return n.progress ? Math.min(n.progress, n.perceivedProgress) : null },
                    getDuration: function() { return Math.min(n.duration, n.perceivedDuration) },
                    reset: function() { o(), n.complete = !1, n.perceivedProgress = 0, n.progress = 0, n.timestamp = null, n.perceivedDuration = 0, n.duration = 0, n.request = null, n.response = null }
                });
            return i
        },
        It = function(e) { return e.substr(0, e.lastIndexOf(".")) || e },
        vt = function(e) { return !!(e instanceof File || e instanceof Blob && e.name) },
        mt = function() {
            var e = arguments.length > 0 && void 0 !== arguments[0] ? arguments[0] : null,
                t = arguments.length > 1 && void 0 !== arguments[1] ? arguments[1] : null,
                r = arguments.length > 2 && void 0 !== arguments[2] ? arguments[2] : null,
                o = oe(),
                i = { archived: !1, frozen: !1, released: !1, source: null, file: r, serverFileReference: t, transferId: null, processingAborted: !1, status: t ? Ie.PROCESSING_COMPLETE : Ie.INIT, activeLoader: null, activeProcessor: null },
                a = null,
                u = {},
                s = function(e) { return i.status = e },
                l = function(e) {
                    if (!i.released && !i.frozen) {
                        for (var t = arguments.length, n = new Array(t > 1 ? t - 1 : 0), r = 1; r < t; r++) n[r - 1] = arguments[r];
                        f.fire.apply(f, [e].concat(n))
                    }
                },
                c = function(e, t, n) {
                    var r = e.split("."),
                        o = r[0],
                        i = r.pop(),
                        a = u;
                    r.forEach(function(e) { return a = a[e] }), JSON.stringify(a[i]) !== JSON.stringify(t) && (a[i] = t, l("metadata-update", { key: o, value: u[o], silent: n }))
                },
                f = Object.assign({
                    id: { get: function() { return o } },
                    origin: { get: function() { return e } },
                    serverId: { get: function() { return i.serverFileReference } },
                    transferId: { get: function() { return i.transferId } },
                    status: { get: function() { return i.status } },
                    filename: { get: function() { return i.file.name } },
                    filenameWithoutExtension: { get: function() { return It(i.file.name) } },
                    fileExtension: { get: function() { return Ye(i.file.name) } },
                    fileType: { get: function() { return i.file.type } },
                    fileSize: { get: function() { return i.file.size } },
                    file: { get: function() { return i.file } },
                    relativePath: { get: function() { return i.file._relativePath } },
                    source: { get: function() { return i.source } },
                    getMetadata: function(e) {
                        return function e(t) {
                            if (!H(t)) return t;
                            var n = L(t) ? [] : {};
                            for (var r in t)
                                if (t.hasOwnProperty(r)) {
                                    var o = t[r];
                                    n[r] = o && H(o) ? e(o) : o
                                }
                            return n
                        }(e ? u[e] : u)
                    },
                    setMetadata: function(e, t, n) { if (H(e)) { var r = e; return Object.keys(r).forEach(function(e) { c(e, r[e], t) }), e } return c(e, t, n), t },
                    extend: function(e, t) { return d[e] = t },
                    abortLoad: function() { i.activeLoader ? i.activeLoader.abort() : (s(Ie.INIT), l("load-abort")) },
                    retryLoad: function() { i.activeLoader && i.activeLoader.load() },
                    requestProcessing: function() { i.processingAborted = !1, s(Ie.PROCESSING_QUEUED) },
                    abortProcessing: function() {
                        return new Promise(function(e) {
                            if (!i.activeProcessor) return i.processingAborted = !0, s(Ie.IDLE), l("process-abort"), void e();
                            a = function() { e() }, i.activeProcessor.abort()
                        })
                    },
                    load: function(t, n, r) {
                        i.source = t, f.fireSync("init"), i.file ? f.fireSync("load-skip") : (i.file = function(e) { var t = [e.name, e.size, e.type]; return e instanceof Blob || Fe(e) ? t[0] = e.name || ke() : Fe(e) ? (t[1] = e.length, t[2] = We(e)) : U(e) && (t[0] = xe(e), t[1] = 0, t[2] = "application/octet-stream"), { name: t[0], size: t[1], type: t[2] } }(t), n.on("init", function() { l("load-init") }), n.on("meta", function(t) { i.file.size = t.size, i.file.filename = t.filename, t.source && (e = ve.LIMBO, i.serverFileReference = t.source, i.status = Ie.PROCESSING_COMPLETE), l("load-meta") }), n.on("progress", function(e) { s(Ie.LOADING), l("load-progress", e) }), n.on("error", function(e) { s(Ie.LOAD_ERROR), l("load-request-error", e) }), n.on("abort", function() { s(Ie.INIT), l("load-abort") }), n.on("load", function(t) {
                            i.activeLoader = null;
                            var n = function(t) { i.file = vt(t) ? t : i.file, e === ve.LIMBO && i.serverFileReference ? s(Ie.PROCESSING_COMPLETE) : s(Ie.IDLE), l("load") };
                            i.serverFileReference ? n(t) : r(t, n, function(e) { i.file = t, l("load-meta"), s(Ie.LOAD_ERROR), l("load-file-error", e) })
                        }), n.setSource(t), i.activeLoader = n, n.load())
                    },
                    process: function e(t, n) {
                        if (i.processingAborted) i.processingAborted = !1;
                        else if (s(Ie.PROCESSING), a = null, i.file instanceof Blob) {
                            t.on("load", function(e) { i.transferId = null, i.serverFileReference = e }), t.on("transfer", function(e) { i.transferId = e }), t.on("load-perceived", function(e) { i.activeProcessor = null, i.transferId = null, i.serverFileReference = e, s(Ie.PROCESSING_COMPLETE), l("process-complete", e) }), t.on("start", function() { l("process-start") }), t.on("error", function(e) { i.activeProcessor = null, s(Ie.PROCESSING_ERROR), l("process-error", e) }), t.on("abort", function(e) { i.activeProcessor = null, i.transferId = null, i.serverFileReference = e, s(Ie.IDLE), l("process-abort"), a && a() }), t.on("progress", function(e) { l("process-progress", e) });
                            var r = console.error;
                            n(i.file, function(e) { i.archived || t.process(e, Object.assign({}, u)) }, r), i.activeProcessor = t
                        } else f.on("load", function() { e(t, n) })
                    },
                    revert: function(e, t) { return new Promise(function(n, r) { null !== i.serverFileReference ? (e(i.serverFileReference, function() { i.serverFileReference = null, n() }, function(e) { t ? (s(Ie.PROCESSING_REVERT_ERROR), l("process-revert-error"), r(e)) : n() }), s(Ie.IDLE), l("process-revert")) : n() }) }
                }, pe(), { freeze: function() { return i.frozen = !0 }, release: function() { return i.released = !0 }, released: { get: function() { return i.released } }, archive: function() { return i.archived = !0 }, archived: { get: function() { return i.archived } } }),
                d = n(f);
            return d
        },
        ht = function(e, t) { var n = function(e, t) { return M(t) ? 0 : U(t) ? e.findIndex(function(e) { return e.id === t }) : -1 }(e, t); if (!(n < 0)) return e[n] || null },
        gt = function(e, t, n, r, o, i) {
            var a = tt(null, e, { method: "GET", responseType: "blob" });
            return a.onload = function(n) {
                var r = n.getAllResponseHeaders(),
                    o = Ke(r).name || xe(e);
                t(nt("load", n.status, He(n.response, o), r))
            }, a.onerror = function(e) { n(nt("error", e.status, e.statusText, e.getAllResponseHeaders())) }, a.onheaders = function(e) { i(nt("headers", e.status, null, e.getAllResponseHeaders())) }, a.ontimeout = rt(n), a.onprogress = r, a.onabort = o, a
        },
        Rt = function(e) { return 0 === e.indexOf("//") && (e = location.protocol + e), e.toLowerCase().replace("blob:", "").replace(/([a-z])?:\/\//, "$1").split("/")[0] },
        Ot = function(e) { return function() { return Y(e) ? e.apply(void 0, arguments) : e } },
        Dt = function(e, t) { clearTimeout(t.listUpdateTimeout), t.listUpdateTimeout = setTimeout(function() { e("DID_UPDATE_ITEMS", { items: Le(t.items) }) }, 0) },
        yt = function(e) { for (var t = arguments.length, n = new Array(t > 1 ? t - 1 : 0), r = 1; r < t; r++) n[r - 1] = arguments[r]; return new Promise(function(t) { if (!e) return t(!0); var r = e.apply(void 0, n); return null == r ? t(!0) : "boolean" == typeof r ? t(r) : void("function" == typeof r.then && r.then(t)) }) },
        St = function(e, t) { e.items.sort(function(e, n) { return t(Te(e), Te(n)) }) },
        At = function(e, t) {
            return function() {
                var n = arguments.length > 0 && void 0 !== arguments[0] ? arguments[0] : {},
                    r = n.query,
                    o = n.success,
                    i = void 0 === o ? function() {} : o,
                    a = n.failure,
                    u = void 0 === a ? function() {} : a,
                    s = ue(n, ["query", "success", "failure"]),
                    l = be(e.items, r);
                l ? t(l, i, u, s || {}) : u({ error: nt("error", 0, "Item not found"), file: null })
            }
        },
        bt = function(e, n, r) {
            return {
                ABORT_ALL: function() { Le(r.items).forEach(function(e) { e.freeze(), e.abortLoad(), e.abortProcessing() }) },
                DID_SET_FILES: function(t) {
                    var n = t.value,
                        o = (void 0 === n ? [] : n).map(function(e) { return { source: e.source ? e.source : e, options: e.options } }),
                        i = Le(r.items);
                    i.forEach(function(t) { o.find(function(e) { return e.source === t.source || e.source === t.file }) || e("REMOVE_ITEM", { query: t, remove: !1 }) }), i = Le(r.items), o.forEach(function(t, n) { i.find(function(e) { return e.source === t.source || e.file === t.source }) || e("ADD_ITEM", Object.assign({}, t, { interactionMethod: re, index: n })) })
                },
                DID_UPDATE_ITEM_METADATA: function(t) {
                    var o = t.id,
                        i = t.action,
                        a = t.change;
                    a.silent || (clearTimeout(r.itemUpdateTimeout), r.itemUpdateTimeout = setTimeout(function() {
                        var t = ht(r.items, o);
                        if (n("IS_ASYNC")) { var u, s = function() { setTimeout(function() { e("REQUEST_ITEM_PROCESSING", { query: o }) }, 32) }; return t.status === Ie.PROCESSING_COMPLETE ? (u = r.options.instantUpload, void t.revert(Et(r.options.server.url, r.options.server.revert), n("GET_FORCE_REVERT")).then(u ? s : function() {}).catch(function() {})) : t.status === Ie.PROCESSING ? function(e) { t.abortProcessing().then(e ? s : function() {}) }(r.options.instantUpload) : void(r.options.instantUpload && s()) }
                        Oe("SHOULD_PREPARE_OUTPUT", !1, { item: t, query: n, action: i, change: a }).then(function(r) {
                            var i = n("GET_BEFORE_PREPARE_FILE");
                            i && (r = i(t, r)), r && e("REQUEST_PREPARE_OUTPUT", { query: o, item: t, success: function(t) { e("DID_PREPARE_OUTPUT", { id: o, file: t }) } }, !0)
                        })
                    }, 0))
                },
                MOVE_ITEM: function(e) {
                    var t = e.query,
                        n = e.index,
                        o = be(r.items, t);
                    if (o) {
                        var i = r.items.indexOf(o);
                        i !== (n = Ve(n, 0, r.items.length - 1)) && r.items.splice(n, 0, r.items.splice(i, 1)[0])
                    }
                },
                SORT: function(t) {
                    var o = t.compare;
                    St(r, o), e("DID_SORT_ITEMS", { items: n("GET_ACTIVE_ITEMS") })
                },
                ADD_ITEMS: function(t) {
                    var r = t.items,
                        o = t.index,
                        i = t.interactionMethod,
                        a = t.success,
                        u = void 0 === a ? function() {} : a,
                        s = t.failure,
                        l = void 0 === s ? function() {} : s,
                        c = o;
                    if (-1 === o || void 0 === o) {
                        var f = n("GET_ITEM_INSERT_LOCATION"),
                            d = n("GET_TOTAL_ITEMS");
                        c = "before" === f ? 0 : d
                    }
                    var p = n("GET_IGNORED_FILES"),
                        E = r.filter(function(e) { return vt(e) ? !p.includes(e.name.toLowerCase()) : !M(e) }).map(function(t) { return new Promise(function(n, r) { e("ADD_ITEM", { interactionMethod: i, source: t.source || t, success: n, failure: r, index: c++, options: t.options || {} }) }) });
                    Promise.all(E).then(u).catch(l)
                },
                ADD_ITEM: function(t) {
                    var o = t.source,
                        i = t.index,
                        a = void 0 === i ? -1 : i,
                        u = t.interactionMethod,
                        s = t.success,
                        l = void 0 === s ? function() {} : s,
                        c = t.failure,
                        f = void 0 === c ? function() {} : c,
                        d = t.options,
                        p = void 0 === d ? {} : d;
                    if (M(o)) f({ error: nt("error", 0, "No source"), file: null });
                    else if (!vt(o) || !r.options.ignoredFiles.includes(o.name.toLowerCase())) {
                        if (! function(e) { var t = Le(e.items).length; if (!e.options.allowMultiple) return 0 === t; var n = e.options.maxFiles; return null === n || t < n }(r)) {
                            if (r.options.allowMultiple || !r.options.allowMultiple && !r.options.allowReplace) { var E = nt("warning", 0, "Max files"); return e("DID_THROW_MAX_FILES", { source: o, error: E }), void f({ error: E, file: null }) }
                            var _ = Le(r.items)[0];
                            if (_.status === Ie.PROCESSING_COMPLETE || _.status === Ie.PROCESSING_REVERT_ERROR) { var T = n("GET_FORCE_REVERT"); if (_.revert(Et(r.options.server.url, r.options.server.revert), T).then(function() { T && e("ADD_ITEM", { source: o, index: a, interactionMethod: u, success: l, failure: f, options: p }) }).catch(function() {}), T) return }
                            e("REMOVE_ITEM", { query: _.id })
                        }
                        var I = "local" === p.type ? ve.LOCAL : "limbo" === p.type ? ve.LIMBO : ve.INPUT,
                            v = mt(I, I === ve.INPUT ? null : o, p.file);
                        Object.keys(p.metadata || {}).forEach(function(e) { v.setMetadata(e, p.metadata[e]) }), De("DID_CREATE_ITEM", v, { query: n, dispatch: e });
                        var m = n("GET_ITEM_INSERT_LOCATION");
                        r.options.itemInsertLocationFreedom || (a = "before" === m ? -1 : r.items.length),
                            function(e, t, n) { M(t) || (void 0 === n ? e.push(t) : function(e, t, n) { e.splice(t, 0, n) }(e, n = Ve(n, 0, e.length), t)) }(r.items, v, a), Y(m) && o && St(r, m);
                        var h = v.id;
                        v.on("init", function() { e("DID_INIT_ITEM", { id: h }) }), v.on("load-init", function() { e("DID_START_ITEM_LOAD", { id: h }) }), v.on("load-meta", function() { e("DID_UPDATE_ITEM_META", { id: h }) }), v.on("load-progress", function(t) { e("DID_UPDATE_ITEM_LOAD_PROGRESS", { id: h, progress: t }) }), v.on("load-request-error", function(t) {
                            var n = Ot(r.options.labelFileLoadError)(t);
                            if (t.code >= 400 && t.code < 500) return e("DID_THROW_ITEM_INVALID", { id: h, error: t, status: { main: n, sub: t.code + " (" + t.body + ")" } }), void f({ error: t, file: Te(v) });
                            e("DID_THROW_ITEM_LOAD_ERROR", { id: h, error: t, status: { main: n, sub: r.options.labelTapToRetry } })
                        }), v.on("load-file-error", function(t) { e("DID_THROW_ITEM_INVALID", { id: h, error: t.status, status: t.status }), f({ error: t.status, file: Te(v) }) }), v.on("load-abort", function() { e("REMOVE_ITEM", { query: h }) }), v.on("load-skip", function() { e("COMPLETE_LOAD_ITEM", { query: h, item: v, data: { source: o, success: l } }) }), v.on("load", function() {
                            var t = function(t) {
                                t ? (v.on("metadata-update", function(t) { e("DID_UPDATE_ITEM_METADATA", { id: h, change: t }) }), Oe("SHOULD_PREPARE_OUTPUT", !1, { item: v, query: n }).then(function(t) {
                                    var i = n("GET_BEFORE_PREPARE_FILE");
                                    i && (t = i(v, t));
                                    var a = function() { e("COMPLETE_LOAD_ITEM", { query: h, item: v, data: { source: o, success: l } }), Dt(e, r) };
                                    t ? e("REQUEST_PREPARE_OUTPUT", { query: h, item: v, success: function(t) { e("DID_PREPARE_OUTPUT", { id: h, file: t }), a() } }, !0) : a()
                                })) : e("REMOVE_ITEM", { query: h })
                            };
                            Oe("DID_LOAD_ITEM", v, { query: n, dispatch: e }).then(function() { yt(n("GET_BEFORE_ADD_FILE"), Te(v)).then(t) }).catch(function() { t(!1) })
                        }), v.on("process-start", function() { e("DID_START_ITEM_PROCESSING", { id: h }) }), v.on("process-progress", function(t) { e("DID_UPDATE_ITEM_PROCESS_PROGRESS", { id: h, progress: t }) }), v.on("process-error", function(t) { e("DID_THROW_ITEM_PROCESSING_ERROR", { id: h, error: t, status: { main: Ot(r.options.labelFileProcessingError)(t), sub: r.options.labelTapToRetry } }) }), v.on("process-revert-error", function(t) { e("DID_THROW_ITEM_PROCESSING_REVERT_ERROR", { id: h, error: t, status: { main: Ot(r.options.labelFileProcessingRevertError)(t), sub: r.options.labelTapToRetry } }) }), v.on("process-complete", function(t) { e("DID_COMPLETE_ITEM_PROCESSING", { id: h, error: null, serverFileReference: t }), e("DID_DEFINE_VALUE", { id: h, value: t }) }), v.on("process-abort", function() { e("DID_ABORT_ITEM_PROCESSING", { id: h }) }), v.on("process-revert", function() { e("DID_REVERT_ITEM_PROCESSING", { id: h }), e("DID_DEFINE_VALUE", { id: h, value: null }) }), e("DID_ADD_ITEM", { id: h, index: a, interactionMethod: u }), Dt(e, r);
                        var g = r.options.server || {},
                            R = g.url,
                            O = g.load,
                            D = g.restore,
                            y = g.fetch;
                        v.load(o, Je(I === ve.INPUT ? U(o) && function(e) { return (e.indexOf(":") > -1 || e.indexOf("//") > -1) && Rt(location.href) !== Rt(e) }(o) && y ? at(R, y) : gt : at(R, I === ve.LIMBO ? D : O)), function(e, t, r) { Oe("LOAD_FILE", e, { query: n }).then(t).catch(r) })
                    }
                },
                REQUEST_PREPARE_OUTPUT: function(e) {
                    var t = e.item,
                        r = e.success,
                        o = e.failure,
                        i = void 0 === o ? function() {} : o,
                        a = { error: nt("error", 0, "Item not found"), file: null };
                    if (t.archived) return i(a);
                    Oe("PREPARE_OUTPUT", t.file, { query: n, item: t }).then(function(e) {
                        Oe("COMPLETE_PREPARE_OUTPUT", e, { query: n, item: t }).then(function(e) {
                            if (t.archived) return i(a);
                            r(e)
                        })
                    })
                },
                COMPLETE_LOAD_ITEM: function(t) {
                    var o = t.item,
                        i = t.data,
                        a = i.success,
                        u = i.source,
                        s = n("GET_ITEM_INSERT_LOCATION");
                    if (Y(s) && u && St(r, s), e("DID_LOAD_ITEM", { id: o.id, error: null, serverFileReference: o.origin === ve.INPUT ? null : u }), a(Te(o)), o.origin !== ve.LOCAL) return o.origin === ve.LIMBO ? (e("DID_COMPLETE_ITEM_PROCESSING", { id: o.id, error: null, serverFileReference: u }), void e("DID_DEFINE_VALUE", { id: o.id, value: u })) : void(n("IS_ASYNC") && r.options.instantUpload && e("REQUEST_ITEM_PROCESSING", { query: o.id }));
                    e("DID_LOAD_LOCAL_ITEM", { id: o.id })
                },
                RETRY_ITEM_LOAD: At(r, function(e) { e.retryLoad() }),
                REQUEST_ITEM_PREPARE: At(r, function(t, n, r) { e("REQUEST_PREPARE_OUTPUT", { query: t.id, item: t, success: function(r) { e("DID_PREPARE_OUTPUT", { id: t.id, file: r }), n({ file: t, output: r }) }, failure: r }, !0) }),
                REQUEST_ITEM_PROCESSING: At(r, function(t, o, i) {
                    if (t.status === Ie.IDLE || t.status === Ie.PROCESSING_ERROR) t.status !== Ie.PROCESSING_QUEUED && (t.requestProcessing(), e("DID_REQUEST_ITEM_PROCESSING", { id: t.id }), e("PROCESS_ITEM", { query: t, success: o, failure: i }, !0));
                    else {
                        var a = function() { return e("REQUEST_ITEM_PROCESSING", { query: t, success: o, failure: i }) },
                            u = function() { return document.hidden ? a() : setTimeout(a, 32) };
                        t.status === Ie.PROCESSING_COMPLETE || t.status === Ie.PROCESSING_REVERT_ERROR ? t.revert(Et(r.options.server.url, r.options.server.revert), n("GET_FORCE_REVERT")).then(u).catch(function() {}) : t.status === Ie.PROCESSING && t.abortProcessing().then(u)
                    }
                }),
                PROCESS_ITEM: At(r, function(t, o, i) {
                    var a = n("GET_MAX_PARALLEL_UPLOADS");
                    if (n("GET_ITEMS_BY_STATUS", Ie.PROCESSING).length !== a) {
                        if (t.status !== Ie.PROCESSING) {
                            var u = function t() {
                                var n = r.processingQueue.shift();
                                if (n) {
                                    var o = n.id,
                                        i = n.success,
                                        a = n.failure,
                                        u = be(r.items, o);
                                    u && !u.archived ? e("PROCESS_ITEM", { query: o, success: i, failure: a }, !0) : t()
                                }
                            };
                            t.onOnce("process-complete", function() { o(Te(t)), u(), n("GET_ITEMS_BY_STATUS", Ie.PROCESSING_COMPLETE).length === r.items.length && e("DID_COMPLETE_ITEM_PROCESSING_ALL") }), t.onOnce("process-error", function(e) { i({ error: e, file: Te(t) }), u() });
                            var s = r.options;
                            t.process(Tt(pt(s.server.url, s.server.process, s.name, { chunkTransferId: t.transferId, chunkServer: s.server.patch, chunkUploads: s.chunkUploads, chunkForce: s.chunkForce, chunkSize: s.chunkSize, chunkRetryDelays: s.chunkRetryDelays }), { allowMinimumUploadDuration: n("GET_ALLOW_MINIMUM_UPLOAD_DURATION") }), function(r, o, i) { Oe("PREPARE_OUTPUT", r, { query: n, item: t }).then(function(n) { e("DID_PREPARE_OUTPUT", { id: t.id, file: n }), o(n) }).catch(i) })
                        }
                    } else r.processingQueue.push({ id: t.id, success: o, failure: i })
                }),
                RETRY_ITEM_PROCESSING: At(r, function(t) { e("REQUEST_ITEM_PROCESSING", { query: t }) }),
                REQUEST_REMOVE_ITEM: At(r, function(t) { yt(n("GET_BEFORE_REMOVE_FILE"), Te(t)).then(function(n) { n && e("REMOVE_ITEM", { query: t }) }) }),
                RELEASE_ITEM: At(r, function(e) { e.release() }),
                REMOVE_ITEM: At(r, function(t, o, i, a) {
                    var u = function() {
                            var n = t.id;
                            ht(r.items, n).archive(), e("DID_REMOVE_ITEM", { error: null, id: n, item: t }), Dt(e, r), o(Te(t))
                        },
                        s = r.options.server;
                    t.origin === ve.LOCAL && s && Y(s.remove) && !1 !== a.remove ? (e("DID_START_ITEM_REMOVE", { id: t.id }), s.remove(t.source, function() { return u() }, function(n) { e("DID_THROW_ITEM_REMOVE_ERROR", { id: t.id, error: nt("error", 0, n, null), status: { main: Ot(r.options.labelFileRemoveError)(n), sub: r.options.labelTapToRetry } }) })) : (a.revert && t.origin !== ve.LOCAL && null !== t.serverId && t.revert(Et(r.options.server.url, r.options.server.revert), n("GET_FORCE_REVERT")), u())
                }),
                ABORT_ITEM_LOAD: At(r, function(e) { e.abortLoad() }),
                ABORT_ITEM_PROCESSING: At(r, function(t) { t.serverId ? e("REVERT_ITEM_PROCESSING", { id: t.id }) : t.abortProcessing().then(function() { r.options.instantUpload && e("REMOVE_ITEM", { query: t.id }) }) }),
                REQUEST_REVERT_ITEM_PROCESSING: At(r, function(t) {
                    if (r.options.instantUpload) {
                        var o = function(n) { n && e("REVERT_ITEM_PROCESSING", { query: t }) },
                            i = n("GET_BEFORE_REMOVE_FILE");
                        if (!i) return o(!0);
                        var a = i(Te(t));
                        return null == a ? o(!0) : "boolean" == typeof a ? o(a) : void("function" == typeof a.then && a.then(o))
                    }
                    e("REVERT_ITEM_PROCESSING", { query: t })
                }),
                REVERT_ITEM_PROCESSING: At(r, function(t) {
                    t.revert(Et(r.options.server.url, r.options.server.revert), n("GET_FORCE_REVERT")).then(function() {
                        (r.options.instantUpload || function(e) { return !vt(e.file) }(t)) && e("REMOVE_ITEM", { query: t.id })
                    }).catch(function() {})
                }),
                SET_OPTIONS: function(n) {
                    var r = n.options;
                    t(r, function(t, n) { e("SET_" + Z(t, "_").toUpperCase(), { value: n }) })
                }
            }
        },
        Pt = function(e) { return e },
        Lt = function(e) { return document.createElement(e) },
        Mt = function(e, t) {
            var n = e.childNodes[0];
            n ? t !== n.nodeValue && (n.nodeValue = t) : (n = document.createTextNode(t), e.appendChild(n))
        },
        wt = function(e, t, n, r) { var o = (r % 360 - 90) * Math.PI / 180; return { x: e + n * Math.cos(o), y: t + n * Math.sin(o) } },
        Ct = function(e, t, n, r, o) {
            var i = 1;
            return o > r && o - r <= .5 && (i = 0), r > o && r - o >= .5 && (i = 0),
                function(e, t, n, r, o, i) {
                    var a = wt(e, t, n, o),
                        u = wt(e, t, n, r);
                    return ["M", a.x, a.y, "A", n, n, 0, i, 0, u.x, u.y].join(" ")
                }(e, t, n, 360 * Math.min(.9999, r), 360 * Math.min(.9999, o), i)
        },
        Nt = S({
            tag: "div",
            name: "progress-indicator",
            ignoreRectUpdate: !0,
            ignoreRect: !0,
            create: function(e) {
                var t = e.root,
                    n = e.props;
                n.spin = !1, n.progress = 0, n.opacity = 0;
                var r = a("svg");
                t.ref.path = a("path", { "stroke-width": 2, "stroke-linecap": "round" }), r.appendChild(t.ref.path), t.ref.svg = r, t.appendChild(r)
            },
            write: function(e) {
                var t = e.root,
                    n = e.props;
                if (0 !== n.opacity) {
                    n.align && (t.element.dataset.align = n.align);
                    var o = parseInt(r(t.ref.path, "stroke-width"), 10),
                        i = .5 * t.rect.element.width,
                        a = 0,
                        u = 0;
                    n.spin ? (a = 0, u = .5) : (a = 0, u = n.progress);
                    var s = Ct(i, i, i - o, a, u);
                    r(t.ref.path, "d", s), r(t.ref.path, "stroke-opacity", n.spin || n.progress > 0 ? 1 : 0)
                }
            },
            mixins: { apis: ["progress", "spin", "align"], styles: ["opacity"], animations: { opacity: { type: "tween", duration: 500 }, progress: { type: "spring", stiffness: .95, damping: .65, mass: 10 } } }
        }),
        Gt = S({
            tag: "button",
            attributes: { type: "button" },
            ignoreRect: !0,
            ignoreRectUpdate: !0,
            name: "file-action-button",
            mixins: { apis: ["label"], styles: ["translateX", "translateY", "scaleX", "scaleY", "opacity"], animations: { scaleX: "spring", scaleY: "spring", translateX: "spring", translateY: "spring", opacity: { type: "tween", duration: 250 } }, listeners: !0 },
            create: function(e) {
                var t = e.root,
                    n = e.props;
                t.element.innerHTML = (n.icon || "") + "<span>" + n.label + "</span>", n.isDisabled = !1
            },
            write: function(e) {
                var t = e.root,
                    n = e.props,
                    o = n.isDisabled,
                    i = t.query("GET_DISABLED") || 0 === n.opacity;
                i && !o ? (n.isDisabled = !0, r(t.element, "disabled", "disabled")) : !i && o && (n.isDisabled = !1, t.element.removeAttribute("disabled"))
            }
        }),
        Ut = function(e) {
            var t = arguments.length > 1 && void 0 !== arguments[1] ? arguments[1] : ".",
                n = arguments.length > 2 && void 0 !== arguments[2] ? arguments[2] : 1e3,
                r = n,
                o = n * n,
                i = n * n * n;
            return (e = Math.round(Math.abs(e))) < r ? e + " bytes" : e < o ? Math.floor(e / r) + " KB" : e < i ? Bt(e / o, 1, t) + " MB" : Bt(e / i, 2, t) + " GB"
        },
        Bt = function(e, t, n) { return e.toFixed(t).split(".").filter(function(e) { return "0" !== e }).join(n) },
        qt = function(e) {
            var t = e.root,
                n = e.props;
            Mt(t.ref.fileSize, Ut(t.query("GET_ITEM_SIZE", n.id), ".", t.query("GET_FILE_SIZE_BASE"))), Mt(t.ref.fileName, Pt(t.query("GET_ITEM_NAME", n.id)))
        },
        Vt = function(e) {
            var t = e.root,
                n = e.props;
            F(t.query("GET_ITEM_SIZE", n.id)) || Mt(t.ref.fileSize, t.query("GET_LABEL_FILE_SIZE_NOT_AVAILABLE"))
        },
        Ft = S({
            name: "file-info",
            ignoreRect: !0,
            ignoreRectUpdate: !0,
            write: A({ DID_LOAD_ITEM: qt, DID_UPDATE_ITEM_META: qt, DID_THROW_ITEM_LOAD_ERROR: Vt, DID_THROW_ITEM_INVALID: Vt }),
            didCreateView: function(e) { De("CREATE_VIEW", Object.assign({}, e, { view: e })) },
            create: function(e) {
                var t = e.root,
                    n = e.props,
                    o = Lt("span");
                o.className = "filepond--file-info-main", r(o, "aria-hidden", "true"), t.appendChild(o), t.ref.fileName = o;
                var i = Lt("span");
                i.className = "filepond--file-info-sub", t.appendChild(i), t.ref.fileSize = i, Mt(i, t.query("GET_LABEL_FILE_WAITING_FOR_SIZE")), Mt(o, Pt(t.query("GET_ITEM_NAME", n.id)))
            },
            mixins: { styles: ["translateX", "translateY"], animations: { translateX: "spring", translateY: "spring" } }
        }),
        xt = function(e) { return Math.round(100 * e) },
        Yt = function(e) {
            var t = e.root,
                n = e.action,
                r = null === n.progress ? t.query("GET_LABEL_FILE_LOADING") : t.query("GET_LABEL_FILE_LOADING") + " " + xt(n.progress) + "%";
            Mt(t.ref.main, r), Mt(t.ref.sub, t.query("GET_LABEL_TAP_TO_CANCEL"))
        },
        jt = function(e) {
            var t = e.root;
            Mt(t.ref.main, ""), Mt(t.ref.sub, "")
        },
        kt = function(e) {
            var t = e.root,
                n = e.action;
            Mt(t.ref.main, n.status.main), Mt(t.ref.sub, n.status.sub)
        },
        Ht = S({
            name: "file-status",
            ignoreRect: !0,
            ignoreRectUpdate: !0,
            write: A({
                DID_LOAD_ITEM: jt,
                DID_REVERT_ITEM_PROCESSING: jt,
                DID_REQUEST_ITEM_PROCESSING: function(e) {
                    var t = e.root;
                    Mt(t.ref.main, t.query("GET_LABEL_FILE_PROCESSING")), Mt(t.ref.sub, t.query("GET_LABEL_TAP_TO_CANCEL"))
                },
                DID_ABORT_ITEM_PROCESSING: function(e) {
                    var t = e.root;
                    Mt(t.ref.main, t.query("GET_LABEL_FILE_PROCESSING_ABORTED")), Mt(t.ref.sub, t.query("GET_LABEL_TAP_TO_RETRY"))
                },
                DID_COMPLETE_ITEM_PROCESSING: function(e) {
                    var t = e.root;
                    Mt(t.ref.main, t.query("GET_LABEL_FILE_PROCESSING_COMPLETE")), Mt(t.ref.sub, t.query("GET_LABEL_TAP_TO_UNDO"))
                },
                DID_UPDATE_ITEM_PROCESS_PROGRESS: function(e) {
                    var t = e.root,
                        n = e.action,
                        r = null === n.progress ? t.query("GET_LABEL_FILE_PROCESSING") : t.query("GET_LABEL_FILE_PROCESSING") + " " + xt(n.progress) + "%";
                    Mt(t.ref.main, r), Mt(t.ref.sub, t.query("GET_LABEL_TAP_TO_CANCEL"))
                },
                DID_UPDATE_ITEM_LOAD_PROGRESS: Yt,
                DID_THROW_ITEM_LOAD_ERROR: kt,
                DID_THROW_ITEM_INVALID: kt,
                DID_THROW_ITEM_PROCESSING_ERROR: kt,
                DID_THROW_ITEM_PROCESSING_REVERT_ERROR: kt,
                DID_THROW_ITEM_REMOVE_ERROR: kt
            }),
            didCreateView: function(e) { De("CREATE_VIEW", Object.assign({}, e, { view: e })) },
            create: function(e) {
                var t = e.root,
                    n = Lt("span");
                n.className = "filepond--file-status-main", t.appendChild(n), t.ref.main = n;
                var r = Lt("span");
                r.className = "filepond--file-status-sub", t.appendChild(r), t.ref.sub = r, Yt({ root: t, action: { progress: null } })
            },
            mixins: { styles: ["translateX", "translateY", "opacity"], animations: { opacity: { type: "tween", duration: 250 }, translateX: "spring", translateY: "spring" } }
        }),
        Xt = { AbortItemLoad: { label: "GET_LABEL_BUTTON_ABORT_ITEM_LOAD", action: "ABORT_ITEM_LOAD", className: "filepond--action-abort-item-load", align: "LOAD_INDICATOR_POSITION" }, RetryItemLoad: { label: "GET_LABEL_BUTTON_RETRY_ITEM_LOAD", action: "RETRY_ITEM_LOAD", icon: "GET_ICON_RETRY", className: "filepond--action-retry-item-load", align: "BUTTON_PROCESS_ITEM_POSITION" }, RemoveItem: { label: "GET_LABEL_BUTTON_REMOVE_ITEM", action: "REQUEST_REMOVE_ITEM", icon: "GET_ICON_REMOVE", className: "filepond--action-remove-item", align: "BUTTON_REMOVE_ITEM_POSITION" }, ProcessItem: { label: "GET_LABEL_BUTTON_PROCESS_ITEM", action: "REQUEST_ITEM_PROCESSING", icon: "GET_ICON_PROCESS", className: "filepond--action-process-item", align: "BUTTON_PROCESS_ITEM_POSITION" }, AbortItemProcessing: { label: "GET_LABEL_BUTTON_ABORT_ITEM_PROCESSING", action: "ABORT_ITEM_PROCESSING", className: "filepond--action-abort-item-processing", align: "BUTTON_PROCESS_ITEM_POSITION" }, RetryItemProcessing: { label: "GET_LABEL_BUTTON_RETRY_ITEM_PROCESSING", action: "RETRY_ITEM_PROCESSING", icon: "GET_ICON_RETRY", className: "filepond--action-retry-item-processing", align: "BUTTON_PROCESS_ITEM_POSITION" }, RevertItemProcessing: { label: "GET_LABEL_BUTTON_UNDO_ITEM_PROCESSING", action: "REQUEST_REVERT_ITEM_PROCESSING", icon: "GET_ICON_UNDO", className: "filepond--action-revert-item-processing", align: "BUTTON_PROCESS_ITEM_POSITION" } },
        Wt = [];
    t(Xt, function(e) { Wt.push(e) });
    var zt, Qt = function(e) { if ("right" === Jt(e)) return 0; var t = e.ref.buttonRemoveItem.rect.element; return t.hidden ? null : t.width + t.left },
        Zt = function(e) { return e.ref.buttonAbortItemLoad.rect.element.width },
        $t = function(e) { return Math.floor(e.ref.buttonRemoveItem.rect.element.height / 4) },
        Kt = function(e) { return Math.floor(e.ref.buttonRemoveItem.rect.element.left / 2) },
        Jt = function(e) { return e.query("GET_STYLE_BUTTON_REMOVE_ITEM_POSITION") },
        en = { buttonAbortItemLoad: { opacity: 0 }, buttonRetryItemLoad: { opacity: 0 }, buttonRemoveItem: { opacity: 0 }, buttonProcessItem: { opacity: 0 }, buttonAbortItemProcessing: { opacity: 0 }, buttonRetryItemProcessing: { opacity: 0 }, buttonRevertItemProcessing: { opacity: 0 }, loadProgressIndicator: { opacity: 0, align: function(e) { return e.query("GET_STYLE_LOAD_INDICATOR_POSITION") } }, processProgressIndicator: { opacity: 0, align: function(e) { return e.query("GET_STYLE_PROGRESS_INDICATOR_POSITION") } }, processingCompleteIndicator: { opacity: 0, scaleX: .75, scaleY: .75 }, info: { translateX: 0, translateY: 0, opacity: 0 }, status: { translateX: 0, translateY: 0, opacity: 0 } },
        tn = { buttonRemoveItem: { opacity: 1 }, buttonProcessItem: { opacity: 1 }, info: { translateX: Qt }, status: { translateX: Qt } },
        nn = { buttonAbortItemProcessing: { opacity: 1 }, processProgressIndicator: { opacity: 1 }, status: { opacity: 1 } },
        rn = { DID_THROW_ITEM_INVALID: { buttonRemoveItem: { opacity: 1 }, info: { translateX: Qt }, status: { translateX: Qt, opacity: 1 } }, DID_START_ITEM_LOAD: { buttonAbortItemLoad: { opacity: 1 }, loadProgressIndicator: { opacity: 1 }, status: { opacity: 1 } }, DID_THROW_ITEM_LOAD_ERROR: { buttonRetryItemLoad: { opacity: 1 }, buttonRemoveItem: { opacity: 1 }, info: { translateX: Qt }, status: { opacity: 1 } }, DID_START_ITEM_REMOVE: { processProgressIndicator: { opacity: 1, align: Jt }, info: { translateX: Qt }, status: { opacity: 0 } }, DID_THROW_ITEM_REMOVE_ERROR: { processProgressIndicator: { opacity: 0, align: Jt }, buttonRemoveItem: { opacity: 1 }, info: { translateX: Qt }, status: { opacity: 1, translateX: Qt } }, DID_LOAD_ITEM: tn, DID_LOAD_LOCAL_ITEM: { buttonRemoveItem: { opacity: 1 }, info: { translateX: Qt }, status: { translateX: Qt } }, DID_START_ITEM_PROCESSING: nn, DID_REQUEST_ITEM_PROCESSING: nn, DID_UPDATE_ITEM_PROCESS_PROGRESS: nn, DID_COMPLETE_ITEM_PROCESSING: { buttonRevertItemProcessing: { opacity: 1 }, info: { opacity: 1 }, status: { opacity: 1 } }, DID_THROW_ITEM_PROCESSING_ERROR: { buttonRemoveItem: { opacity: 1 }, buttonRetryItemProcessing: { opacity: 1 }, status: { opacity: 1 }, info: { translateX: Qt } }, DID_THROW_ITEM_PROCESSING_REVERT_ERROR: { buttonRevertItemProcessing: { opacity: 1 }, status: { opacity: 1 }, info: { opacity: 1 } }, DID_ABORT_ITEM_PROCESSING: { buttonRemoveItem: { opacity: 1 }, buttonProcessItem: { opacity: 1 }, info: { translateX: Qt }, status: { opacity: 1 } }, DID_REVERT_ITEM_PROCESSING: tn },
        on = S({
            create: function(e) {
                var t = e.root;
                t.element.innerHTML = t.query("GET_ICON_DONE")
            },
            name: "processing-complete-indicator",
            ignoreRect: !0,
            mixins: { styles: ["scaleX", "scaleY", "opacity"], animations: { scaleX: "spring", scaleY: "spring", opacity: { type: "tween", duration: 250 } } }
        }),
        an = A({
            DID_SET_LABEL_BUTTON_ABORT_ITEM_PROCESSING: function(e) {
                var t = e.root,
                    n = e.action;
                t.ref.buttonAbortItemProcessing.label = n.value
            },
            DID_SET_LABEL_BUTTON_ABORT_ITEM_LOAD: function(e) {
                var t = e.root,
                    n = e.action;
                t.ref.buttonAbortItemLoad.label = n.value
            },
            DID_SET_LABEL_BUTTON_ABORT_ITEM_REMOVAL: function(e) {
                var t = e.root,
                    n = e.action;
                t.ref.buttonAbortItemRemoval.label = n.value
            },
            DID_REQUEST_ITEM_PROCESSING: function(e) {
                var t = e.root;
                t.ref.processProgressIndicator.spin = !0, t.ref.processProgressIndicator.progress = 0
            },
            DID_START_ITEM_LOAD: function(e) {
                var t = e.root;
                t.ref.loadProgressIndicator.spin = !0, t.ref.loadProgressIndicator.progress = 0
            },
            DID_START_ITEM_REMOVE: function(e) {
                var t = e.root;
                t.ref.processProgressIndicator.spin = !0, t.ref.processProgressIndicator.progress = 0
            },
            DID_UPDATE_ITEM_LOAD_PROGRESS: function(e) {
                var t = e.root,
                    n = e.action;
                t.ref.loadProgressIndicator.spin = !1, t.ref.loadProgressIndicator.progress = n.progress
            },
            DID_UPDATE_ITEM_PROCESS_PROGRESS: function(e) {
                var t = e.root,
                    n = e.action;
                t.ref.processProgressIndicator.spin = !1, t.ref.processProgressIndicator.progress = n.progress
            }
        }),
        un = S({
            create: function(e) {
                var n, r = e.root,
                    o = e.props.id,
                    i = r.query("GET_ALLOW_REVERT"),
                    a = r.query("GET_ALLOW_REMOVE"),
                    u = r.query("GET_ALLOW_PROCESS"),
                    s = r.query("GET_INSTANT_UPLOAD"),
                    l = r.query("IS_ASYNC"),
                    c = r.query("GET_STYLE_BUTTON_REMOVE_ITEM_ALIGN");
                l ? u && !i ? n = function(e) { return !/RevertItemProcessing/.test(e) } : !u && i ? n = function(e) { return !/ProcessItem|RetryItemProcessing|AbortItemProcessing/.test(e) } : u || i || (n = function(e) { return !/Process/.test(e) }) : n = function(e) { return !/Process/.test(e) };
                var f = n ? Wt.filter(n) : Wt.concat();
                if (s && i && (Xt.RevertItemProcessing.label = "GET_LABEL_BUTTON_REMOVE_ITEM", Xt.RevertItemProcessing.icon = "GET_ICON_REMOVE"), l && !i) {
                    var d = rn.DID_COMPLETE_ITEM_PROCESSING;
                    d.info.translateX = Kt, d.info.translateY = $t, d.status.translateY = $t, d.processingCompleteIndicator = { opacity: 1, scaleX: 1, scaleY: 1 }
                }
                if (l && !u && (["DID_START_ITEM_PROCESSING", "DID_REQUEST_ITEM_PROCESSING", "DID_UPDATE_ITEM_PROCESS_PROGRESS", "DID_THROW_ITEM_PROCESSING_ERROR"].forEach(function(e) { rn[e].status.translateY = $t }), rn.DID_THROW_ITEM_PROCESSING_ERROR.status.translateX = Zt), c && i) {
                    Xt.RevertItemProcessing.align = "BUTTON_REMOVE_ITEM_POSITION";
                    var p = rn.DID_COMPLETE_ITEM_PROCESSING;
                    p.info.translateX = Qt, p.status.translateY = $t, p.processingCompleteIndicator = { opacity: 1, scaleX: 1, scaleY: 1 }
                }
                a || (Xt.RemoveItem.disabled = !0), t(Xt, function(e, t) {
                    var n = r.createChildView(Gt, { label: r.query(t.label), icon: r.query(t.icon), opacity: 0 });
                    f.includes(e) && r.appendChildView(n), t.disabled && (n.element.setAttribute("disabled", "disabled"), n.element.setAttribute("hidden", "hidden")), n.element.dataset.align = r.query("GET_STYLE_" + t.align), n.element.classList.add(t.className), n.on("click", function(e) { e.stopPropagation(), t.disabled || r.dispatch(t.action, { query: o }) }), r.ref["button" + e] = n
                }), r.ref.processingCompleteIndicator = r.appendChildView(r.createChildView(on)), r.ref.processingCompleteIndicator.element.dataset.align = r.query("GET_STYLE_BUTTON_PROCESS_ITEM_POSITION"), r.ref.info = r.appendChildView(r.createChildView(Ft, { id: o })), r.ref.status = r.appendChildView(r.createChildView(Ht, { id: o }));
                var E = r.appendChildView(r.createChildView(Nt, { opacity: 0, align: r.query("GET_STYLE_LOAD_INDICATOR_POSITION") }));
                E.element.classList.add("filepond--load-indicator"), r.ref.loadProgressIndicator = E;
                var _ = r.appendChildView(r.createChildView(Nt, { opacity: 0, align: r.query("GET_STYLE_PROGRESS_INDICATOR_POSITION") }));
                _.element.classList.add("filepond--process-indicator"), r.ref.processProgressIndicator = _, r.ref.activeStyles = []
            },
            write: function(e) {
                var n = e.root,
                    r = e.actions,
                    o = e.props;
                an({ root: n, actions: r, props: o });
                var i = r.concat().filter(function(e) { return /^DID_/.test(e.type) }).reverse().find(function(e) { return rn[e.type] });
                if (i) {
                    n.ref.activeStyles = [];
                    var a = rn[i.type];
                    t(en, function(e, r) {
                        var o = n.ref[e];
                        t(r, function(t, r) {
                            var i = a[e] && void 0 !== a[e][t] ? a[e][t] : r;
                            n.ref.activeStyles.push({ control: o, key: t, value: i })
                        })
                    })
                }
                n.ref.activeStyles.forEach(function(e) {
                    var t = e.control,
                        r = e.key,
                        o = e.value;
                    t[r] = "function" == typeof o ? o(n) : o
                })
            },
            didCreateView: function(e) { De("CREATE_VIEW", Object.assign({}, e, { view: e })) },
            name: "file"
        }),
        sn = S({
            create: function(e) {
                var t = e.root,
                    n = e.props;
                t.ref.fileName = Lt("legend"), t.appendChild(t.ref.fileName), t.ref.file = t.appendChildView(t.createChildView(un, { id: n.id })), t.ref.data = !1
            },
            ignoreRect: !0,
            write: A({
                DID_LOAD_ITEM: function(e) {
                    var t = e.root,
                        n = e.props;
                    Mt(t.ref.fileName, Pt(t.query("GET_ITEM_NAME", n.id)))
                }
            }),
            didCreateView: function(e) { De("CREATE_VIEW", Object.assign({}, e, { view: e })) },
            tag: "fieldset",
            name: "file-wrapper"
        }),
        ln = { type: "spring", damping: .6, mass: 7 },
        cn = function(e, t, n) {
            var r = S({ name: "panel-" + t.name + " filepond--" + n, mixins: t.mixins, ignoreRectUpdate: !0 }),
                o = e.createChildView(r, t.props);
            e.ref[t.name] = e.appendChildView(o)
        },
        fn = S({
            name: "panel",
            read: function(e) { var t = e.root; return e.props.heightCurrent = t.ref.bottom.translateY },
            write: function(e) {
                var t = e.root,
                    n = e.props;
                if (null !== t.ref.scalable && n.scalable === t.ref.scalable || (t.ref.scalable = !N(n.scalable) || n.scalable, t.element.dataset.scalable = t.ref.scalable), n.height) {
                    var r = t.ref.top.rect.element,
                        o = t.ref.bottom.rect.element,
                        i = Math.max(r.height + o.height, n.height);
                    t.ref.center.translateY = r.height, t.ref.center.scaleY = (i - r.height - o.height) / 100, t.ref.bottom.translateY = i - o.height
                }
            },
            create: function(e) {
                var t = e.root,
                    n = e.props;
                [{ name: "top" }, { name: "center", props: { translateY: null, scaleY: null }, mixins: { animations: { scaleY: ln }, styles: ["translateY", "scaleY"] } }, { name: "bottom", props: { translateY: null }, mixins: { animations: { translateY: ln }, styles: ["translateY"] } }].forEach(function(e) { cn(t, e, n.name) }), t.element.classList.add("filepond--" + n.name), t.ref.scalable = null
            },
            ignoreRect: !0,
            mixins: { apis: ["height", "heightCurrent", "scalable"] }
        }),
        dn = { type: "spring", stiffness: .75, damping: .45, mass: 10 },
        pn = { DID_START_ITEM_LOAD: "busy", DID_UPDATE_ITEM_LOAD_PROGRESS: "loading", DID_THROW_ITEM_INVALID: "load-invalid", DID_THROW_ITEM_LOAD_ERROR: "load-error", DID_LOAD_ITEM: "idle", DID_THROW_ITEM_REMOVE_ERROR: "remove-error", DID_START_ITEM_REMOVE: "busy", DID_START_ITEM_PROCESSING: "busy processing", DID_REQUEST_ITEM_PROCESSING: "busy processing", DID_UPDATE_ITEM_PROCESS_PROGRESS: "processing", DID_COMPLETE_ITEM_PROCESSING: "processing-complete", DID_THROW_ITEM_PROCESSING_ERROR: "processing-error", DID_THROW_ITEM_PROCESSING_REVERT_ERROR: "processing-revert-error", DID_ABORT_ITEM_PROCESSING: "cancelled", DID_REVERT_ITEM_PROCESSING: "idle" },
        En = A({
            DID_UPDATE_PANEL_HEIGHT: function(e) {
                var t = e.root,
                    n = e.action;
                t.height = n.height
            }
        }),
        _n = A({
            DID_GRAB_ITEM: function(e) {
                var t = e.root;
                e.props.dragOrigin = { x: t.translateX, y: t.translateY }
            },
            DID_DRAG_ITEM: function(e) { e.root.element.dataset.dragState = "drag" },
            DID_DROP_ITEM: function(e) {
                var t = e.root,
                    n = e.props;
                n.dragOffset = null, n.dragOrigin = null, t.element.dataset.dragState = "drop"
            }
        }, function(e) {
            var t = e.root,
                n = e.actions,
                r = e.props,
                o = e.shouldOptimize;
            "drop" === t.element.dataset.dragState && t.scaleX <= 1 && (t.element.dataset.dragState = "idle");
            var i = n.concat().filter(function(e) { return /^DID_/.test(e.type) }).reverse().find(function(e) { return pn[e.type] });
            i && i.type !== r.currentState && (r.currentState = i.type, t.element.dataset.filepondItemState = pn[r.currentState] || "");
            var a = t.query("GET_ITEM_PANEL_ASPECT_RATIO") || t.query("GET_PANEL_ASPECT_RATIO");
            a ? o || (t.height = t.rect.element.width * a) : (En({ root: t, actions: n, props: r }), !t.height && t.ref.container.rect.element.height > 0 && (t.height = t.ref.container.rect.element.height)), o && (t.ref.panel.height = null), t.ref.panel.height = t.height
        }),
        Tn = S({
            create: function(e) {
                var t = e.root,
                    n = e.props;
                t.ref.handleClick = function(e) { return t.dispatch("DID_ACTIVATE_ITEM", { id: n.id }) }, t.element.id = "filepond--item-" + n.id, t.element.addEventListener("click", t.ref.handleClick), t.ref.container = t.appendChildView(t.createChildView(sn, { id: n.id })), t.ref.panel = t.appendChildView(t.createChildView(fn, { name: "item-panel" })), t.ref.panel.height = null, n.markedForRemoval = !1, t.query("GET_ALLOW_REORDER") && (t.element.dataset.dragState = "idle", t.element.addEventListener("pointerdown", function(e) {
                    if (e.isPrimary) {
                        var r = !1,
                            o = e.pageX,
                            i = e.pageY;
                        n.dragOrigin = { x: t.translateX, y: t.translateY }, n.dragCenter = { x: e.offsetX, y: e.offsetY };
                        var a, u, s, l = (a = t.query("GET_ACTIVE_ITEMS"), u = a.map(function(e) { return e.id }), s = void 0, { setIndex: function(e) { s = e }, getIndex: function() { return s }, getItemIndex: function(e) { return u.indexOf(e.id) } });
                        t.dispatch("DID_GRAB_ITEM", { id: n.id, dragState: l });
                        var c = function(e) { e.isPrimary && (e.stopPropagation(), e.preventDefault(), n.dragOffset = { x: e.pageX - o, y: e.pageY - i }, n.dragOffset.x * n.dragOffset.x + n.dragOffset.y * n.dragOffset.y > 16 && !r && (r = !0, t.element.removeEventListener("click", t.ref.handleClick)), t.dispatch("DID_DRAG_ITEM", { id: n.id, dragState: l })) };
                        document.addEventListener("pointermove", c), document.addEventListener("pointerup", function e(a) { a.isPrimary && (document.removeEventListener("pointermove", c), document.removeEventListener("pointerup", e), n.dragOffset = { x: a.pageX - o, y: a.pageY - i }, t.dispatch("DID_DROP_ITEM", { id: n.id, dragState: l }), r && setTimeout(function() { return t.element.addEventListener("click", t.ref.handleClick) }, 0)) })
                    }
                }))
            },
            write: _n,
            destroy: function(e) {
                var t = e.root,
                    n = e.props;
                t.element.removeEventListener("click", t.ref.handleClick), t.dispatch("RELEASE_ITEM", { query: n.id })
            },
            tag: "li",
            name: "item",
            mixins: { apis: ["id", "interactionMethod", "markedForRemoval", "spawnDate", "dragCenter", "dragOrigin", "dragOffset"], styles: ["translateX", "translateY", "scaleX", "scaleY", "opacity", "height"], animations: { scaleX: "spring", scaleY: "spring", translateX: dn, translateY: dn, opacity: { type: "tween", duration: 150 } } }
        }),
        In = function(e, t) { return Math.max(1, Math.floor((e + 1) / t)) },
        vn = function(e, t, n) {
            if (n) {
                var r = e.rect.element.width,
                    o = t.length,
                    i = null;
                if (0 === o || n.top < t[0].rect.element.top) return -1;
                var a = t[0].rect.element,
                    u = a.marginLeft + a.marginRight,
                    s = a.width + u,
                    l = In(r, s);
                if (1 === l) {
                    for (var c = 0; c < o; c++) {
                        var f = t[c],
                            d = f.rect.outer.top + .5 * f.rect.element.height;
                        if (n.top < d) return c
                    }
                    return o
                }
                for (var p = a.marginTop + a.marginBottom, E = a.height + p, _ = 0; _ < o; _++) {
                    var T = _ % l * s,
                        I = Math.floor(_ / l) * E,
                        v = I - a.marginTop,
                        m = T + s,
                        h = I + E + a.marginBottom;
                    if (n.top < h && n.top > v) {
                        if (n.left < m) return _;
                        i = _ !== o - 1 ? _ : null
                    }
                }
                return null !== i ? i : o
            }
        },
        mn = { height: 0, width: 0, get getHeight() { return this.height }, set setHeight(e) { 0 !== this.height && 0 !== e || (this.height = e) }, get getWidth() { return this.width }, set setWidth(e) { 0 !== this.width && 0 !== e || (this.width = e) }, setDimensions: function(e, t) { 0 !== this.height && 0 !== e || (this.height = e), 0 !== this.width && 0 !== t || (this.width = t) } },
        hn = function(e, t, n) {
            var r = arguments.length > 3 && void 0 !== arguments[3] ? arguments[3] : 0,
                o = arguments.length > 4 && void 0 !== arguments[4] ? arguments[4] : 1;
            e.dragOffset ? (e.translateX = null, e.translateY = null, e.translateX = e.dragOrigin.x + e.dragOffset.x, e.translateY = e.dragOrigin.y + e.dragOffset.y, e.scaleX = 1.025, e.scaleY = 1.025) : (e.translateX = t, e.translateY = n, Date.now() > e.spawnDate && (0 === e.opacity && gn(e, t, n, r, o), e.scaleX = 1, e.scaleY = 1, e.opacity = 1))
        },
        gn = function(e, t, n, r, o) { e.interactionMethod === re ? (e.translateX = null, e.translateX = t, e.translateY = null, e.translateY = n) : e.interactionMethod === ee ? (e.translateX = null, e.translateX = t - 20 * r, e.translateY = null, e.translateY = n - 10 * o, e.scaleX = .8, e.scaleY = .8) : e.interactionMethod === te ? (e.translateY = null, e.translateY = n - 30) : e.interactionMethod === J && (e.translateX = null, e.translateX = t - 30, e.translateY = null) },
        Rn = function(e) { return e.rect.element.height + .5 * e.rect.element.marginBottom + .5 * e.rect.element.marginTop },
        On = A({
            DID_ADD_ITEM: function(e) {
                var t = e.root,
                    n = e.action,
                    r = n.id,
                    o = n.index,
                    i = n.interactionMethod;
                t.ref.addIndex = o;
                var a = Date.now(),
                    u = a,
                    s = 1;
                if (i !== re) {
                    s = 0;
                    var l = t.query("GET_ITEM_INSERT_INTERVAL"),
                        c = a - t.ref.lastItemSpanwDate;
                    u = c < l ? a + (l - c) : a
                }
                t.ref.lastItemSpanwDate = u, t.appendChildView(t.createChildView(Tn, { spawnDate: u, id: r, opacity: s, interactionMethod: i }), o)
            },
            DID_REMOVE_ITEM: function(e) {
                var t = e.root,
                    n = e.action.id,
                    r = t.childViews.find(function(e) { return e.id === n });
                r && (r.scaleX = .9, r.scaleY = .9, r.opacity = 0, r.markedForRemoval = !0)
            },
            DID_DRAG_ITEM: function(e) {
                var t = e.root,
                    n = e.action,
                    r = n.id,
                    o = n.dragState,
                    i = t.query("GET_ITEM", { id: r }),
                    a = t.childViews.find(function(e) { return e.id === r }),
                    u = t.childViews.length,
                    s = o.getItemIndex(i);
                if (a) {
                    var l, c = a.dragOrigin.x + a.dragOffset.x + a.dragCenter.x,
                        f = a.dragOrigin.y + a.dragOffset.y + a.dragCenter.y,
                        d = Rn(a),
                        p = (l = a).rect.element.width + .5 * l.rect.element.marginLeft + .5 * l.rect.element.marginRight,
                        E = Math.floor(t.rect.outer.width / p);
                    E > u && (E = u);
                    var _ = Math.floor(u / E + 1);
                    mn.setHeight = d * _, mn.setWidth = p * E;
                    var T = {
                            y: Math.floor(f / d),
                            x: Math.floor(c / p),
                            getGridIndex: function() { return f > mn.getHeight || f < 0 || c > mn.getWidth || c < 0 ? s : this.y * E + this.x },
                            getColIndex: function() {
                                for (var e = t.query("GET_ACTIVE_ITEMS"), n = t.childViews.filter(function(e) { return e.rect.element.height }), r = e.map(function(e) { return n.find(function(t) { return t.id === e.id }) }), o = r.findIndex(function(e) { return e === a }), i = Rn(a), u = r.length, s = u, l = 0, c = 0, d = 0, p = 0; p < u; p++)
                                    if (l = Rn(r[p]), f < (c = (d = c) + l)) {
                                        if (o > p) { if (f < d + i) { s = p; break } continue }
                                        s = p;
                                        break
                                    }
                                return s
                            }
                        },
                        I = E > 1 ? T.getGridIndex() : T.getColIndex();
                    t.dispatch("MOVE_ITEM", { query: a, index: I });
                    var v = o.getIndex();
                    if (void 0 === v || v !== I) {
                        if (o.setIndex(I), void 0 === v) return;
                        t.dispatch("DID_REORDER_ITEMS", { items: t.query("GET_ACTIVE_ITEMS"), origin: s, target: I })
                    }
                }
            }
        }),
        Dn = S({
            create: function(e) {
                var t = e.root;
                r(t.element, "role", "list"), t.ref.lastItemSpanwDate = Date.now()
            },
            write: function(e) {
                var t = e.root,
                    n = e.props,
                    r = e.actions,
                    o = e.shouldOptimize;
                On({ root: t, props: n, actions: r });
                var i = n.dragCoordinates,
                    a = t.rect.element.width,
                    u = t.childViews.filter(function(e) { return e.rect.element.height }),
                    s = t.query("GET_ACTIVE_ITEMS").map(function(e) { return u.find(function(t) { return t.id === e.id }) }).filter(function(e) { return e }),
                    l = i ? vn(t, s, i) : null,
                    c = t.ref.addIndex || null;
                t.ref.addIndex = null;
                var f = 0,
                    d = 0,
                    p = 0;
                if (0 !== s.length) {
                    var E = s[0].rect.element,
                        _ = E.marginTop + E.marginBottom,
                        T = E.marginLeft + E.marginRight,
                        I = E.width + T,
                        v = E.height + _,
                        m = In(a, I);
                    if (1 === m) {
                        var h = 0,
                            g = 0;
                        s.forEach(function(e, t) {
                            if (l) {
                                var n = t - l;
                                g = -2 === n ? .25 * -_ : -1 === n ? .75 * -_ : 0 === n ? .75 * _ : 1 === n ? .25 * _ : 0
                            }
                            o && (e.translateX = null, e.translateY = null), e.markedForRemoval || hn(e, 0, h + g);
                            var r = (e.rect.element.height + _) * (e.markedForRemoval ? e.opacity : 1);
                            h += r
                        })
                    } else {
                        var R = 0,
                            O = 0;
                        s.forEach(function(e, t) {
                            t === l && (f = 1), t === c && (p += 1), e.markedForRemoval && e.opacity < .5 && (d -= 1);
                            var n = t + p + f + d,
                                r = n % m,
                                i = Math.floor(n / m),
                                a = r * I,
                                u = i * v,
                                s = Math.sign(a - R),
                                E = Math.sign(u - O);
                            R = a, O = u, e.markedForRemoval || (o && (e.translateX = null, e.translateY = null), hn(e, a, u, s, E))
                        })
                    }
                }
            },
            tag: "ul",
            name: "list",
            didWriteView: function(e) {
                var t = e.root;
                t.childViews.filter(function(e) { return e.markedForRemoval && 0 === e.opacity && e.resting }).forEach(function(e) { e._destroy(), t.removeChildView(e) })
            },
            filterFrameActionsForChild: function(e, t) { return t.filter(function(t) { return !t.data || !t.data.id || e.id === t.data.id }) },
            mixins: { apis: ["dragCoordinates"] }
        }),
        yn = A({
            DID_DRAG: function(e) {
                var t = e.root,
                    n = e.props,
                    r = e.action;
                t.query("GET_ITEM_INSERT_LOCATION_FREEDOM") && (n.dragCoordinates = { left: r.position.scopeLeft - t.ref.list.rect.element.left, top: r.position.scopeTop - (t.rect.outer.top + t.rect.element.marginTop + t.rect.element.scrollTop) })
            },
            DID_END_DRAG: function(e) { e.props.dragCoordinates = null }
        }),
        Sn = S({
            create: function(e) {
                var t = e.root,
                    n = e.props;
                t.ref.list = t.appendChildView(t.createChildView(Dn)), n.dragCoordinates = null, n.overflowing = !1
            },
            write: function(e) {
                var t = e.root,
                    n = e.props,
                    r = e.actions;
                if (yn({ root: t, props: n, actions: r }), t.ref.list.dragCoordinates = n.dragCoordinates, n.overflowing && !n.overflow && (n.overflowing = !1, t.element.dataset.state = "", t.height = null), n.overflow) {
                    var o = Math.round(n.overflow);
                    o !== t.height && (n.overflowing = !0, t.element.dataset.state = "overflow", t.height = o)
                }
            },
            name: "list-scroller",
            mixins: { apis: ["overflow", "dragCoordinates"], styles: ["height", "translateY"], animations: { translateY: "spring" } }
        }),
        An = function(e, t, n) {
            var o = arguments.length > 3 && void 0 !== arguments[3] ? arguments[3] : "";
            n ? r(e, t, o) : e.removeAttribute(t)
        },
        bn = function(e) {
            var t = e.root,
                n = e.action;
            t.query("GET_ALLOW_SYNC_ACCEPT_ATTRIBUTE") && An(t.element, "accept", !!n.value, n.value ? n.value.join(",") : "")
        },
        Pn = function(e) {
            var t = e.root,
                n = e.action;
            An(t.element, "multiple", n.value)
        },
        Ln = function(e) {
            var t = e.root,
                n = e.action;
            An(t.element, "webkitdirectory", n.value)
        },
        Mn = function(e) {
            var t = e.root,
                n = t.query("GET_DISABLED"),
                r = t.query("GET_ALLOW_BROWSE"),
                o = n || !r;
            An(t.element, "disabled", o)
        },
        wn = function(e) {
            var t = e.root;
            e.action.value ? 0 === t.query("GET_TOTAL_ITEMS") && An(t.element, "required", !0) : An(t.element, "required", !1)
        },
        Cn = function(e) {
            var t = e.root,
                n = e.action;
            An(t.element, "capture", !!n.value, !0 === n.value ? "" : n.value)
        },
        Nn = function(e) {
            var t = e.root,
                n = t.element;
            t.query("GET_TOTAL_ITEMS") > 0 ? (An(n, "required", !1), An(n, "name", !1)) : (An(n, "name", !0, t.query("GET_NAME")), t.query("GET_CHECK_VALIDITY") && n.setCustomValidity(""), t.query("GET_REQUIRED") && An(n, "required", !0))
        },
        Gn = S({
            tag: "input",
            name: "browser",
            ignoreRect: !0,
            ignoreRectUpdate: !0,
            attributes: { type: "file" },
            create: function(e) {
                var t = e.root,
                    n = e.props;
                t.element.id = "filepond--browser-" + n.id, r(t.element, "name", t.query("GET_NAME")), r(t.element, "aria-controls", "filepond--assistant-" + n.id), r(t.element, "aria-labelledby", "filepond--drop-label-" + n.id), bn({ root: t, action: { value: t.query("GET_ACCEPTED_FILE_TYPES") } }), Pn({ root: t, action: { value: t.query("GET_ALLOW_MULTIPLE") } }), Ln({ root: t, action: { value: t.query("GET_ALLOW_DIRECTORIES_ONLY") } }), Mn({ root: t }), wn({ root: t, action: { value: t.query("GET_REQUIRED") } }), Cn({ root: t, action: { value: t.query("GET_CAPTURE_METHOD") } }), t.ref.handleChange = function(e) {
                    if (t.element.value) {
                        var r = Array.from(t.element.files).map(function(e) { return e._relativePath = e.webkitRelativePath, e });
                        setTimeout(function() {
                            n.onload(r),
                                function(e) {
                                    if (e && "" !== e.value) {
                                        try { e.value = "" } catch (e) {}
                                        if (e.value) {
                                            var t = Lt("form"),
                                                n = e.parentNode,
                                                r = e.nextSibling;
                                            t.appendChild(e), t.reset(), r ? n.insertBefore(e, r) : n.appendChild(e)
                                        }
                                    }
                                }(t.element)
                        }, 250)
                    }
                }, t.element.addEventListener("change", t.ref.handleChange)
            },
            destroy: function(e) {
                var t = e.root;
                t.element.removeEventListener("change", t.ref.handleChange)
            },
            write: A({
                DID_LOAD_ITEM: Nn,
                DID_REMOVE_ITEM: Nn,
                DID_THROW_ITEM_INVALID: function(e) {
                    var t = e.root;
                    t.query("GET_CHECK_VALIDITY") && t.element.setCustomValidity(t.query("GET_LABEL_INVALID_FIELD"))
                },
                DID_SET_DISABLED: Mn,
                DID_SET_ALLOW_BROWSE: Mn,
                DID_SET_ALLOW_DIRECTORIES_ONLY: Ln,
                DID_SET_ALLOW_MULTIPLE: Pn,
                DID_SET_ACCEPTED_FILE_TYPES: bn,
                DID_SET_CAPTURE_METHOD: Cn,
                DID_SET_REQUIRED: wn
            })
        }),
        Un = 13,
        Bn = 32,
        qn = function(e, t) { e.innerHTML = t; var n = e.querySelector(".filepond--label-action"); return n && r(n, "tabindex", "0"), t },
        Vn = S({
            name: "drop-label",
            ignoreRect: !0,
            create: function(e) {
                var t = e.root,
                    n = e.props,
                    o = Lt("label");
                r(o, "for", "filepond--browser-" + n.id), r(o, "id", "filepond--drop-label-" + n.id), r(o, "aria-hidden", "true"), t.ref.handleKeyDown = function(e) {
                    (e.keyCode === Un || e.keyCode === Bn) && (e.preventDefault(), t.ref.label.click())
                }, t.ref.handleClick = function(e) { e.target === o || o.contains(e.target) || t.ref.label.click() }, o.addEventListener("keydown", t.ref.handleKeyDown), t.element.addEventListener("click", t.ref.handleClick), qn(o, n.caption), t.appendChild(o), t.ref.label = o
            },
            destroy: function(e) {
                var t = e.root;
                t.ref.label.addEventListener("keydown", t.ref.handleKeyDown), t.element.removeEventListener("click", t.ref.handleClick)
            },
            write: A({
                DID_SET_LABEL_IDLE: function(e) {
                    var t = e.root,
                        n = e.action;
                    qn(t.ref.label, n.value)
                }
            }),
            mixins: { styles: ["opacity", "translateX", "translateY"], animations: { opacity: { type: "tween", duration: 150 }, translateX: "spring", translateY: "spring" } }
        }),
        Fn = S({ name: "drip-blob", ignoreRect: !0, mixins: { styles: ["translateX", "translateY", "scaleX", "scaleY", "opacity"], animations: { scaleX: "spring", scaleY: "spring", translateX: "spring", translateY: "spring", opacity: { type: "tween", duration: 250 } } } }),
        xn = A({
            DID_DRAG: function(e) {
                var t = e.root,
                    n = e.action;
                t.ref.blob ? (t.ref.blob.translateX = n.position.scopeLeft, t.ref.blob.translateY = n.position.scopeTop, t.ref.blob.scaleX = 1, t.ref.blob.scaleY = 1, t.ref.blob.opacity = 1) : function(e) {
                    var t = e.root,
                        n = .5 * t.rect.element.width,
                        r = .5 * t.rect.element.height;
                    t.ref.blob = t.appendChildView(t.createChildView(Fn, { opacity: 0, scaleX: 2.5, scaleY: 2.5, translateX: n, translateY: r }))
                }({ root: t })
            },
            DID_DROP: function(e) {
                var t = e.root;
                t.ref.blob && (t.ref.blob.scaleX = 2.5, t.ref.blob.scaleY = 2.5, t.ref.blob.opacity = 0)
            },
            DID_END_DRAG: function(e) {
                var t = e.root;
                t.ref.blob && (t.ref.blob.opacity = 0)
            }
        }),
        Yn = S({
            ignoreRect: !0,
            ignoreRectUpdate: !0,
            name: "drip",
            write: function(e) {
                var t = e.root,
                    n = e.props,
                    r = e.actions;
                xn({ root: t, props: n, actions: r });
                var o = t.ref.blob;
                0 === r.length && o && 0 === o.opacity && (t.removeChildView(o), t.ref.blob = null)
            }
        }),
        jn = function(e, t) { return e.ref.fields[t] },
        kn = function(e) { e.query("GET_ACTIVE_ITEMS").forEach(function(t) { e.ref.fields[t.id] && e.element.appendChild(e.ref.fields[t.id]) }) },
        Hn = function(e) { var t = e.root; return kn(t) },
        Xn = A({
            DID_SET_DISABLED: function(e) {
                var t = e.root;
                t.element.disabled = t.query("GET_DISABLED")
            },
            DID_ADD_ITEM: function(e) {
                var t = e.root,
                    n = e.action,
                    r = Lt("input");
                r.type = "hidden", r.name = t.query("GET_NAME"), r.disabled = t.query("GET_DISABLED"), t.ref.fields[n.id] = r, kn(t)
            },
            DID_LOAD_ITEM: function(e) {
                var t = e.root,
                    n = e.action,
                    r = jn(t, n.id);
                r && null !== n.serverFileReference && (r.value = n.serverFileReference)
            },
            DID_REMOVE_ITEM: function(e) {
                var t = e.root,
                    n = e.action,
                    r = jn(t, n.id);
                r && (r.parentNode && r.parentNode.removeChild(r), delete t.ref.fields[n.id])
            },
            DID_DEFINE_VALUE: function(e) {
                var t = e.root,
                    n = e.action,
                    r = jn(t, n.id);
                r && (null === n.value ? r.removeAttribute("value") : r.value = n.value, kn(t))
            },
            DID_REORDER_ITEMS: Hn,
            DID_SORT_ITEMS: Hn
        }),
        Wn = S({ tag: "fieldset", name: "data", create: function(e) { return e.root.ref.fields = {} }, write: Xn, ignoreRect: !0 }),
        zn = ["jpg", "jpeg", "png", "gif", "bmp", "webp", "svg", "tiff"],
        Qn = ["css", "csv", "html", "txt"],
        Zn = { zip: "zip|compressed", epub: "application/epub+zip" },
        $n = function() { var e = arguments.length > 0 && void 0 !== arguments[0] ? arguments[0] : ""; return e = e.toLowerCase(), zn.includes(e) ? "image/" + ("jpg" === e ? "jpeg" : "svg" === e ? "svg+xml" : e) : Qn.includes(e) ? "text/" + e : Zn[e] || "" },
        Kn = function(e) {
            return new Promise(function(t, n) {
                var r = sr(e);
                if (r.length && !Jn(e)) return t(r);
                er(e).then(t)
            })
        },
        Jn = function(e) { return !!e.files && e.files.length > 0 },
        er = function(e) {
            return new Promise(function(t, n) {
                var r = (e.items ? Array.from(e.items) : []).filter(function(e) { return tr(e) }).map(function(e) { return nr(e) });
                r.length ? Promise.all(r).then(function(e) {
                    var n = [];
                    e.forEach(function(e) { n.push.apply(n, e) }), t(n.filter(function(e) { return e }).map(function(e) { return e._relativePath || (e._relativePath = e.webkitRelativePath), e }))
                }).catch(console.error) : t(e.files ? Array.from(e.files) : [])
            })
        },
        tr = function(e) { if (ar(e)) { var t = ur(e); if (t) return t.isFile || t.isDirectory } return "file" === e.kind },
        nr = function(e) { return new Promise(function(t, n) { ir(e) ? rr(ur(e)).then(t).catch(n) : t([e.getAsFile()]) }) },
        rr = function(e) {
            return new Promise(function(t, n) {
                var r = [],
                    o = 0,
                    i = 0,
                    a = function() { 0 === i && 0 === o && t(r) };
                ! function e(t) {
                    o++;
                    var u = t.createReader();
                    ! function t() {
                        u.readEntries(function(n) {
                            if (0 === n.length) return o--, void a();
                            n.forEach(function(t) {
                                t.isDirectory ? e(t) : (i++, t.file(function(e) {
                                    var n = or(e);
                                    t.fullPath && (n._relativePath = t.fullPath), r.push(n), i--, a()
                                }))
                            }), t()
                        }, n)
                    }()
                }(e)
            })
        },
        or = function(e) {
            if (e.type.length) return e;
            var t = e.lastModifiedDate,
                n = e.name,
                r = $n(Ye(e.name));
            return r.length ? ((e = e.slice(0, e.size, r)).name = n, e.lastModifiedDate = t, e) : e
        },
        ir = function(e) { return ar(e) && (ur(e) || {}).isDirectory },
        ar = function(e) { return "webkitGetAsEntry" in e },
        ur = function(e) { return e.webkitGetAsEntry() },
        sr = function(e) {
            var t = [];
            try {
                if ((t = cr(e)).length) return t;
                t = lr(e)
            } catch (e) {}
            return t
        },
        lr = function(e) { var t = e.getData("url"); return "string" == typeof t && t.length ? [t] : [] },
        cr = function(e) { var t = e.getData("text/html"); if ("string" == typeof t && t.length) { var n = t.match(/src\s*=\s*"(.+?)"/); if (n) return [n[1]] } return [] },
        fr = [],
        dr = function(e) { return { pageLeft: e.pageX, pageTop: e.pageY, scopeLeft: e.offsetX || e.layerX, scopeTop: e.offsetY || e.layerY } },
        pr = function(e) { var t = fr.find(function(t) { return t.element === e }); if (t) return t; var n = Er(e); return fr.push(n), n },
        Er = function(e) {
            var n = [],
                r = { dragenter: vr, dragover: mr, dragleave: gr, drop: hr },
                o = {};
            t(r, function(t, r) { o[t] = r(e, n), e.addEventListener(t, o[t], !1) });
            var i = {
                element: e,
                addListener: function(a) {
                    return n.push(a),
                        function() { n.splice(n.indexOf(a), 1), 0 === n.length && (fr.splice(fr.indexOf(i), 1), t(r, function(t) { e.removeEventListener(t, o[t], !1) })) }
                }
            };
            return i
        },
        _r = function(e, t) { var n, r = function(e, t) { return "elementFromPoint" in e || (e = document), e.elementFromPoint(t.x, t.y) }("getRootNode" in (n = t) ? n.getRootNode() : document, { x: e.pageX - window.pageXOffset, y: e.pageY - window.pageYOffset }); return r === t || t.contains(r) },
        Tr = null,
        Ir = function(e, t) { try { e.dropEffect = t } catch (e) {} },
        vr = function(e, t) {
            return function(e) {
                e.preventDefault(), Tr = e.target, t.forEach(function(t) {
                    var n = t.element,
                        r = t.onenter;
                    _r(e, n) && (t.state = "enter", r(dr(e)))
                })
            }
        },
        mr = function(e, t) {
            return function(e) {
                e.preventDefault();
                var n = e.dataTransfer;
                Kn(n).then(function(r) {
                    var o = !1;
                    t.some(function(t) {
                        var i = t.filterElement,
                            a = t.element,
                            u = t.onenter,
                            s = t.onexit,
                            l = t.ondrag,
                            c = t.allowdrop;
                        Ir(n, "copy");
                        var f = c(r);
                        if (f)
                            if (_r(e, a)) {
                                if (o = !0, null === t.state) return t.state = "enter", void u(dr(e));
                                if (t.state = "over", i && !f) return void Ir(n, "none");
                                l(dr(e))
                            } else i && !o && Ir(n, "none"), t.state && (t.state = null, s(dr(e)));
                        else Ir(n, "none")
                    })
                })
            }
        },
        hr = function(e, t) {
            return function(e) {
                e.preventDefault();
                var n = e.dataTransfer;
                Kn(n).then(function(n) {
                    t.forEach(function(t) {
                        var r = t.filterElement,
                            o = t.element,
                            i = t.ondrop,
                            a = t.onexit,
                            u = t.allowdrop;
                        if (t.state = null, !r || _r(e, o)) return u(n) ? void i(dr(e), n) : a(dr(e))
                    })
                })
            }
        },
        gr = function(e, t) {
            return function(e) {
                Tr === e.target && t.forEach(function(t) {
                    var n = t.onexit;
                    t.state = null, n(dr(e))
                })
            }
        },
        Rr = function(e, t, n) {
            e.classList.add("filepond--hopper");
            var r = n.catchesDropsOnPage,
                o = n.requiresDropOnElement,
                i = n.filterItems,
                a = void 0 === i ? function(e) { return e } : i,
                u = function(e, t, n) {
                    var r = pr(t),
                        o = { element: e, filterElement: n, state: null, ondrop: function() {}, onenter: function() {}, ondrag: function() {}, onexit: function() {}, onload: function() {}, allowdrop: function() {} };
                    return o.destroy = r.addListener(o), o
                }(e, r ? document.documentElement : e, o),
                s = "",
                l = "";
            u.allowdrop = function(e) { return t(a(e)) }, u.ondrop = function(e, n) {
                var r = a(n);
                t(r) ? (l = "drag-drop", c.onload(r, e)) : c.ondragend(e)
            }, u.ondrag = function(e) { c.ondrag(e) }, u.onenter = function(e) { l = "drag-over", c.ondragstart(e) }, u.onexit = function(e) { l = "drag-exit", c.ondragend(e) };
            var c = { updateHopperState: function() { s !== l && (e.dataset.hopperState = l, s = l) }, onload: function() {}, ondragstart: function() {}, ondrag: function() {}, ondragend: function() {}, destroy: function() { u.destroy() } };
            return c
        },
        Or = !1,
        Dr = [],
        yr = function(e) {
            var t = document.activeElement;
            if (t && /textarea|input/i.test(t.nodeName)) {
                for (var n = !1, r = t; r !== document.body;) {
                    if (r.classList.contains("filepond--root")) { n = !0; break }
                    r = r.parentNode
                }
                if (!n) return
            }
            Kn(e.clipboardData).then(function(e) { e.length && Dr.forEach(function(t) { return t(e) }) })
        },
        Sr = function() {
            var e = function(e) { t.onload(e) },
                t = {
                    destroy: function() {
                        var t;
                        t = e, de(Dr, Dr.indexOf(t)), 0 === Dr.length && (document.removeEventListener("paste", yr), Or = !1)
                    },
                    onload: function() {}
                };
            return function(e) { Dr.includes(e) || (Dr.push(e), Or || (Or = !0, document.addEventListener("paste", yr))) }(e), t
        },
        Ar = null,
        br = null,
        Pr = [],
        Lr = function(e, t) { e.element.textContent = t },
        Mr = function(e, t, n) {
            var r = e.query("GET_TOTAL_ITEMS");
            Lr(e, n + " " + t + ", " + r + " " + (1 === r ? e.query("GET_LABEL_FILE_COUNT_SINGULAR") : e.query("GET_LABEL_FILE_COUNT_PLURAL"))), clearTimeout(br), br = setTimeout(function() {! function(e) { e.element.textContent = "" }(e) }, 1500)
        },
        wr = function(e) { return e.element.parentNode.contains(document.activeElement) },
        Cr = function(e) {
            var t = e.root,
                n = e.action,
                r = t.query("GET_ITEM", n.id).filename,
                o = t.query("GET_LABEL_FILE_PROCESSING_ABORTED");
            Lr(t, r + " " + o)
        },
        Nr = function(e) {
            var t = e.root,
                n = e.action,
                r = t.query("GET_ITEM", n.id).filename;
            Lr(t, n.status.main + " " + r + " " + n.status.sub)
        },
        Gr = S({
            create: function(e) {
                var t = e.root,
                    n = e.props;
                t.element.id = "filepond--assistant-" + n.id, r(t.element, "role", "status"), r(t.element, "aria-live", "polite"), r(t.element, "aria-relevant", "additions")
            },
            ignoreRect: !0,
            ignoreRectUpdate: !0,
            write: A({
                DID_LOAD_ITEM: function(e) {
                    var t = e.root,
                        n = e.action;
                    if (wr(t)) {
                        t.element.textContent = "";
                        var r = t.query("GET_ITEM", n.id);
                        Pr.push(r.filename), clearTimeout(Ar), Ar = setTimeout(function() { Mr(t, Pr.join(", "), t.query("GET_LABEL_FILE_ADDED")), Pr.length = 0 }, 750)
                    }
                },
                DID_REMOVE_ITEM: function(e) {
                    var t = e.root,
                        n = e.action;
                    if (wr(t)) {
                        var r = n.item;
                        Mr(t, r.filename, t.query("GET_LABEL_FILE_REMOVED"))
                    }
                },
                DID_COMPLETE_ITEM_PROCESSING: function(e) {
                    var t = e.root,
                        n = e.action,
                        r = t.query("GET_ITEM", n.id).filename,
                        o = t.query("GET_LABEL_FILE_PROCESSING_COMPLETE");
                    Lr(t, r + " " + o)
                },
                DID_ABORT_ITEM_PROCESSING: Cr,
                DID_REVERT_ITEM_PROCESSING: Cr,
                DID_THROW_ITEM_REMOVE_ERROR: Nr,
                DID_THROW_ITEM_LOAD_ERROR: Nr,
                DID_THROW_ITEM_INVALID: Nr,
                DID_THROW_ITEM_PROCESSING_ERROR: Nr
            }),
            tag: "span",
            name: "assistant"
        }),
        Ur = function(e) { var t = arguments.length > 1 && void 0 !== arguments[1] ? arguments[1] : "-"; return e.replace(new RegExp(t + ".", "g"), function(e) { return e.charAt(1).toUpperCase() }) },
        Br = function(e) {
            var t = arguments.length > 1 && void 0 !== arguments[1] ? arguments[1] : 16,
                n = !(arguments.length > 2 && void 0 !== arguments[2]) || arguments[2],
                r = Date.now(),
                o = null;
            return function() {
                for (var i = arguments.length, a = new Array(i), u = 0; u < i; u++) a[u] = arguments[u];
                clearTimeout(o);
                var s = Date.now() - r,
                    l = function() { r = Date.now(), e.apply(void 0, a) };
                s < t ? n || (o = setTimeout(l, t - s)) : l()
            }
        },
        qr = function(e) { return e.preventDefault() },
        Vr = function(e) { var t = e.ref.list.childViews[0].childViews[0]; return t ? { top: t.rect.element.marginTop, bottom: t.rect.element.marginBottom } : { top: 0, bottom: 0 } },
        Fr = function(e) {
            var t = 0,
                n = 0,
                r = e.ref.list,
                o = r.childViews[0],
                i = o.childViews.filter(function(e) { return e.rect.element.height }),
                a = e.query("GET_ACTIVE_ITEMS").map(function(e) { return i.find(function(t) { return t.id === e.id }) }).filter(function(e) { return e });
            if (0 === a.length) return { visual: t, bounds: n };
            var u = o.rect.element.width,
                s = vn(o, a, r.dragCoordinates),
                l = a[0].rect.element,
                c = l.marginTop + l.marginBottom,
                f = l.marginLeft + l.marginRight,
                d = l.width + f,
                p = l.height + c,
                E = void 0 !== s && s >= 0 ? 1 : 0,
                _ = a.find(function(e) { return e.markedForRemoval && e.opacity < .45 }) ? -1 : 0,
                T = a.length + E + _,
                I = In(u, d);
            return 1 === I ? a.forEach(function(e) {
                var r = e.rect.element.height + c;
                n += r, t += r * e.opacity
            }) : (n = Math.ceil(T / I) * p, t = n), { visual: t, bounds: n }
        },
        xr = function(e) { var t = e.ref.measureHeight || null; return { cappedHeight: parseInt(e.style.maxHeight, 10) || null, fixedHeight: 0 === t ? null : t } },
        Yr = function(e, t) {
            var n = e.query("GET_ALLOW_REPLACE"),
                r = e.query("GET_ALLOW_MULTIPLE"),
                o = e.query("GET_TOTAL_ITEMS"),
                i = e.query("GET_MAX_FILES"),
                a = t.length;
            return !r && a > 1 || !!(F(i = r ? i : n ? i : 1) && o + a > i) && (e.dispatch("DID_THROW_MAX_FILES", { source: t, error: nt("warning", 0, "Max files") }), !0)
        },
        jr = function(e, t, n) { var r = e.childViews[0]; return vn(r, t, { left: n.scopeLeft - r.rect.element.left, top: n.scopeTop - (e.rect.outer.top + e.rect.element.marginTop + e.rect.element.scrollTop) }) },
        kr = function(e) {
            var t = e.query("GET_ALLOW_DROP"),
                n = e.query("GET_DISABLED"),
                r = t && !n;
            if (r && !e.ref.hopper) {
                var o = Rr(e.element, function(t) { var n = e.query("GET_BEFORE_DROP_FILE") || function() { return !0 }; return !e.query("GET_DROP_VALIDATION") || t.every(function(t) { return De("ALLOW_HOPPER_ITEM", t, { query: e.query }).every(function(e) { return !0 === e }) && n(t) }) }, { filterItems: function(t) { var n = e.query("GET_IGNORED_FILES"); return t.filter(function(e) { return !vt(e) || !n.includes(e.name.toLowerCase()) }) }, catchesDropsOnPage: e.query("GET_DROP_ON_PAGE"), requiresDropOnElement: e.query("GET_DROP_ON_ELEMENT") });
                o.onload = function(t, n) {
                    var r = e.ref.list.childViews[0].childViews.filter(function(e) { return e.rect.element.height }),
                        o = e.query("GET_ACTIVE_ITEMS").map(function(e) { return r.find(function(t) { return t.id === e.id }) }).filter(function(e) { return e });
                    Oe("ADD_ITEMS", t, { dispatch: e.dispatch }).then(function(t) {
                        if (Yr(e, t)) return !1;
                        e.dispatch("ADD_ITEMS", { items: t, index: jr(e.ref.list, o, n), interactionMethod: ee })
                    }), e.dispatch("DID_DROP", { position: n }), e.dispatch("DID_END_DRAG", { position: n })
                }, o.ondragstart = function(t) { e.dispatch("DID_START_DRAG", { position: t }) }, o.ondrag = Br(function(t) { e.dispatch("DID_DRAG", { position: t }) }), o.ondragend = function(t) { e.dispatch("DID_END_DRAG", { position: t }) }, e.ref.hopper = o, e.ref.drip = e.appendChildView(e.createChildView(Yn))
            } else !r && e.ref.hopper && (e.ref.hopper.destroy(), e.ref.hopper = null, e.removeChildView(e.ref.drip))
        },
        Hr = function(e, t) {
            var n = e.query("GET_ALLOW_BROWSE"),
                r = e.query("GET_DISABLED"),
                o = n && !r;
            o && !e.ref.browser ? e.ref.browser = e.appendChildView(e.createChildView(Gn, Object.assign({}, t, {
                onload: function(t) {
                    Oe("ADD_ITEMS", t, { dispatch: e.dispatch }).then(function(t) {
                        if (Yr(e, t)) return !1;
                        e.dispatch("ADD_ITEMS", { items: t, index: -1, interactionMethod: te })
                    })
                }
            })), 0) : !o && e.ref.browser && (e.removeChildView(e.ref.browser), e.ref.browser = null)
        },
        Xr = function(e) {
            var t = e.query("GET_ALLOW_PASTE"),
                n = e.query("GET_DISABLED"),
                r = t && !n;
            r && !e.ref.paster ? (e.ref.paster = Sr(), e.ref.paster.onload = function(t) {
                Oe("ADD_ITEMS", t, { dispatch: e.dispatch }).then(function(t) {
                    if (Yr(e, t)) return !1;
                    e.dispatch("ADD_ITEMS", { items: t, index: -1, interactionMethod: ne })
                })
            }) : !r && e.ref.paster && (e.ref.paster.destroy(), e.ref.paster = null)
        },
        Wr = A({
            DID_SET_ALLOW_BROWSE: function(e) {
                var t = e.root,
                    n = e.props;
                Hr(t, n)
            },
            DID_SET_ALLOW_DROP: function(e) {
                var t = e.root;
                kr(t)
            },
            DID_SET_ALLOW_PASTE: function(e) {
                var t = e.root;
                Xr(t)
            },
            DID_SET_DISABLED: function(e) {
                var t = e.root,
                    n = e.props;
                kr(t), Xr(t), Hr(t, n), t.query("GET_DISABLED") ? t.element.dataset.disabled = "disabled" : t.element.removeAttribute("data-disabled")
            }
        }),
        zr = S({
            name: "root",
            read: function(e) {
                var t = e.root;
                t.ref.measure && (t.ref.measureHeight = t.ref.measure.offsetHeight)
            },
            create: function(e) {
                var t = e.root,
                    n = e.props,
                    r = t.query("GET_ID");
                r && (t.element.id = r);
                var o = t.query("GET_CLASS_NAME");
                o && o.split(" ").filter(function(e) { return e.length }).forEach(function(e) { t.element.classList.add(e) }), t.ref.label = t.appendChildView(t.createChildView(Vn, Object.assign({}, n, { translateY: null, caption: t.query("GET_LABEL_IDLE") }))), t.ref.list = t.appendChildView(t.createChildView(Sn, { translateY: null })), t.ref.panel = t.appendChildView(t.createChildView(fn, { name: "panel-root" })), t.ref.assistant = t.appendChildView(t.createChildView(Gr, Object.assign({}, n))), t.ref.data = t.appendChildView(t.createChildView(Wn, Object.assign({}, n))), t.ref.measure = Lt("div"), t.ref.measure.style.height = "100%", t.element.appendChild(t.ref.measure), t.ref.bounds = null, t.query("GET_STYLES").filter(function(e) { return !M(e.value) }).map(function(e) {
                    var n = e.name,
                        r = e.value;
                    t.element.dataset[n] = r
                }), t.ref.widthPrevious = null, t.ref.widthUpdated = Br(function() { t.ref.updateHistory = [], t.dispatch("DID_RESIZE_ROOT") }, 250), t.ref.previousAspectRatio = null, t.ref.updateHistory = [];
                var i = window.matchMedia("(pointer: fine) and (hover: hover)").matches,
                    a = "PointerEvent" in window;
                t.query("GET_ALLOW_REORDER") && a && !i && (t.element.addEventListener("touchmove", qr, { passive: !1 }), t.element.addEventListener("gesturestart", qr));
                var u = t.query("GET_CREDITS");
                if (2 === u.length) {
                    var s = document.createElement("a");
                    s.className = "filepond--credits", s.setAttribute("aria-hidden", "true"), s.href = u[0], s.tabindex = -1, s.target = "_blank", s.rel = "noopener noreferrer", s.textContent = u[1], t.element.appendChild(s), t.ref.credits = s
                }
            },
            write: function(e) {
                var t = e.root,
                    n = e.props,
                    r = e.actions;
                if (Wr({ root: t, props: n, actions: r }), r.filter(function(e) { return /^DID_SET_STYLE_/.test(e.type) }).filter(function(e) { return !M(e.data.value) }).map(function(e) {
                        var n = e.type,
                            r = e.data,
                            o = Ur(n.substr(8).toLowerCase(), "_");
                        t.element.dataset[o] = r.value, t.invalidateLayout()
                    }), !t.rect.element.hidden) {
                    t.rect.element.width !== t.ref.widthPrevious && (t.ref.widthPrevious = t.rect.element.width, t.ref.widthUpdated());
                    var o = t.ref.bounds;
                    o || (o = t.ref.bounds = xr(t), t.element.removeChild(t.ref.measure), t.ref.measure = null);
                    var i = t.ref,
                        a = i.hopper,
                        u = i.label,
                        s = i.list,
                        l = i.panel;
                    a && a.updateHopperState();
                    var c = t.query("GET_PANEL_ASPECT_RATIO"),
                        f = t.query("GET_ALLOW_MULTIPLE"),
                        d = t.query("GET_TOTAL_ITEMS"),
                        p = d === (f ? t.query("GET_MAX_FILES") || 1e6 : 1),
                        E = r.find(function(e) { return "DID_ADD_ITEM" === e.type });
                    if (p && E) {
                        var _ = E.data.interactionMethod;
                        u.opacity = 0, f ? u.translateY = -40 : _ === J ? u.translateX = 40 : u.translateY = _ === te ? 40 : 30
                    } else p || (u.opacity = 1, u.translateX = 0, u.translateY = 0);
                    var T = Vr(t),
                        I = Fr(t),
                        v = u.rect.element.height,
                        m = !f || p ? 0 : v,
                        h = p ? s.rect.element.marginTop : 0,
                        g = 0 === d ? 0 : s.rect.element.marginBottom,
                        R = m + h + I.visual + g,
                        O = m + h + I.bounds + g;
                    if (s.translateY = Math.max(0, m - s.rect.element.marginTop) - T.top, c) {
                        var D = t.rect.element.width,
                            y = D * c;
                        c !== t.ref.previousAspectRatio && (t.ref.previousAspectRatio = c, t.ref.updateHistory = []);
                        var S = t.ref.updateHistory;
                        if (S.push(D), S.length > 4)
                            for (var A = S.length, b = A - 10, P = 0, L = A; L >= b; L--)
                                if (S[L] === S[L - 2] && P++, P >= 2) return;
                        l.scalable = !1, l.height = y;
                        var w = y - m - (g - T.bottom) - (p ? h : 0);
                        I.visual > w ? s.overflow = w : s.overflow = null, t.height = y
                    } else if (o.fixedHeight) {
                        l.scalable = !1;
                        var C = o.fixedHeight - m - (g - T.bottom) - (p ? h : 0);
                        I.visual > C ? s.overflow = C : s.overflow = null
                    } else if (o.cappedHeight) {
                        var N = R >= o.cappedHeight,
                            G = Math.min(o.cappedHeight, R);
                        l.scalable = !0, l.height = N ? G : G - T.top - T.bottom;
                        var U = G - m - (g - T.bottom) - (p ? h : 0);
                        R > o.cappedHeight && I.visual > U ? s.overflow = U : s.overflow = null, t.height = Math.min(o.cappedHeight, O - T.top - T.bottom)
                    } else {
                        var B = d > 0 ? T.top + T.bottom : 0;
                        l.scalable = !0, l.height = Math.max(v, R - B), t.height = Math.max(v, O - B)
                    }
                    t.ref.credits && l.heightCurrent && (t.ref.credits.style.transform = "translateY(" + l.heightCurrent + "px)")
                }
            },
            destroy: function(e) {
                var t = e.root;
                t.ref.paster && t.ref.paster.destroy(), t.ref.hopper && t.ref.hopper.destroy(), t.element.removeEventListener("touchmove", qr), t.element.removeEventListener("gesturestart", qr)
            },
            mixins: { styles: ["height"] }
        }),
        Qr = function() {
            var e = arguments.length > 0 && void 0 !== arguments[0] ? arguments[0] : {},
                r = null,
                o = Se(),
                i = function(e) {
                    var t = arguments.length > 1 && void 0 !== arguments[1] ? arguments[1] : [],
                        n = arguments.length > 2 && void 0 !== arguments[2] ? arguments[2] : [],
                        r = Object.assign({}, e),
                        o = [],
                        i = [],
                        a = function(e, t, n) {!n || document.hidden ? (c[e] && c[e](t), o.push({ type: e, data: t })) : i.push({ type: e, data: t }) },
                        u = function(e) { for (var t, n = arguments.length, r = new Array(n > 1 ? n - 1 : 0), o = 1; o < n; o++) r[o - 1] = arguments[o]; return l[e] ? (t = l)[e].apply(t, r) : null },
                        s = {
                            getState: function() { return Object.assign({}, r) },
                            processActionQueue: function() { var e = [].concat(o); return o.length = 0, e },
                            processDispatchQueue: function() {
                                var e = [].concat(i);
                                i.length = 0, e.forEach(function(e) {
                                    var t = e.type,
                                        n = e.data;
                                    a(t, n)
                                })
                            },
                            dispatch: a,
                            query: u
                        },
                        l = {};
                    t.forEach(function(e) { l = Object.assign({}, e(r), {}, l) });
                    var c = {};
                    return n.forEach(function(e) { c = Object.assign({}, e(a, u, r), {}, c) }), s
                }({ items: [], listUpdateTimeout: null, itemUpdateTimeout: null, processingQueue: [], options: Q(o) }, [qe, K(o)], [bt, $(o)]);
            i.dispatch("SET_OPTIONS", { options: e });
            var a = function() { document.hidden || i.dispatch("KICK") };
            document.addEventListener("visibilitychange", a);
            var u = null,
                s = !1,
                l = !1,
                c = null,
                f = null,
                d = function() { s || (s = !0), clearTimeout(u), u = setTimeout(function() { s = !1, c = null, f = null, l && (l = !1, i.dispatch("DID_STOP_RESIZE")) }, 500) };
            window.addEventListener("resize", d);
            var p = zr(i, { id: oe() }),
                E = !1,
                T = !1,
                I = {
                    _read: function() { s && (f = window.innerWidth, c || (c = f), l || f === c || (i.dispatch("DID_START_RESIZE"), l = !0)), T && E && (E = null === p.element.offsetParent), E || (p._read(), T = p.rect.element.hidden) },
                    _write: function(e) {
                        var t, n = i.processActionQueue().filter(function(e) { return !/^SET_/.test(e.type) });
                        E && !n.length || (g(n), E = p._write(e, n, l), (t = i.query("GET_ITEMS")).forEach(function(e, n) { e.released && de(t, n) }), E && i.processDispatchQueue())
                    }
                },
                v = function(e) {
                    return function(t) {
                        var n = { type: e };
                        if (!t) return n;
                        if (t.hasOwnProperty("error") && (n.error = t.error ? Object.assign({}, t.error) : null), t.status && (n.status = Object.assign({}, t.status)), t.file && (n.output = t.file), t.source) n.file = t.source;
                        else if (t.item || t.id) {
                            var r = t.item ? t.item : i.query("GET_ITEM", t.id);
                            n.file = r ? Te(r) : null
                        }
                        return t.items && (n.items = t.items.map(Te)), /progress/.test(e) && (n.progress = t.progress), t.hasOwnProperty("origin") && t.hasOwnProperty("target") && (n.origin = t.origin, n.target = t.target), n
                    }
                },
                m = { DID_DESTROY: v("destroy"), DID_INIT: v("init"), DID_THROW_MAX_FILES: v("warning"), DID_INIT_ITEM: v("initfile"), DID_START_ITEM_LOAD: v("addfilestart"), DID_UPDATE_ITEM_LOAD_PROGRESS: v("addfileprogress"), DID_LOAD_ITEM: v("addfile"), DID_THROW_ITEM_INVALID: [v("error"), v("addfile")], DID_THROW_ITEM_LOAD_ERROR: [v("error"), v("addfile")], DID_THROW_ITEM_REMOVE_ERROR: [v("error"), v("removefile")], DID_PREPARE_OUTPUT: v("preparefile"), DID_START_ITEM_PROCESSING: v("processfilestart"), DID_UPDATE_ITEM_PROCESS_PROGRESS: v("processfileprogress"), DID_ABORT_ITEM_PROCESSING: v("processfileabort"), DID_COMPLETE_ITEM_PROCESSING: v("processfile"), DID_COMPLETE_ITEM_PROCESSING_ALL: v("processfiles"), DID_REVERT_ITEM_PROCESSING: v("processfilerevert"), DID_THROW_ITEM_PROCESSING_ERROR: [v("error"), v("processfile")], DID_REMOVE_ITEM: v("removefile"), DID_UPDATE_ITEMS: v("updatefiles"), DID_ACTIVATE_ITEM: v("activatefile"), DID_REORDER_ITEMS: v("reorderfiles") },
                h = function(e) {
                    var t = Object.assign({ pond: A }, e);
                    delete t.type, p.element.dispatchEvent(new CustomEvent("FilePond:" + e.type, { detail: t, bubbles: !0, cancelable: !0, composed: !0 }));
                    var n = [];
                    e.hasOwnProperty("error") && n.push(e.error), e.hasOwnProperty("file") && n.push(e.file);
                    var r = ["type", "error", "file"];
                    Object.keys(e).filter(function(e) { return !r.includes(e) }).forEach(function(t) { return n.push(e[t]) }), A.fire.apply(A, [e.type].concat(n));
                    var o = i.query("GET_ON" + e.type.toUpperCase());
                    o && o.apply(void 0, n)
                },
                g = function(e) {
                    e.length && e.filter(function(e) { return m[e.type] }).forEach(function(e) {
                        var t = m[e.type];
                        (Array.isArray(t) ? t : [t]).forEach(function(t) { "DID_INIT_ITEM" === e.type ? h(t(e.data)) : setTimeout(function() { h(t(e.data)) }, 0) })
                    })
                },
                R = function(e) { return new Promise(function(t, n) { i.dispatch("REQUEST_ITEM_PREPARE", { query: e, success: function(e) { t(e) }, failure: function(e) { n(e) } }) }) },
                O = function(e, t) { var n; return "object" != typeof e || (n = e).file && n.id || t || (t = e, e = void 0), i.dispatch("REMOVE_ITEM", Object.assign({}, t, { query: e })), null === i.query("GET_ACTIVE_ITEM", e) },
                D = function() {
                    for (var e = arguments.length, t = new Array(e), n = 0; n < e; n++) t[n] = arguments[n];
                    return new Promise(function(e, n) {
                        var r = [],
                            o = {};
                        if (L(t[0])) r.push.apply(r, t[0]), Object.assign(o, t[1] || {});
                        else { var a = t[t.length - 1]; "object" != typeof a || a instanceof Blob || Object.assign(o, t.pop()), r.push.apply(r, t) }
                        i.dispatch("ADD_ITEMS", { items: r, index: o.index, interactionMethod: J, success: e, failure: n })
                    })
                },
                y = function() { return i.query("GET_ACTIVE_ITEMS") },
                S = function(e) { return new Promise(function(t, n) { i.dispatch("REQUEST_ITEM_PROCESSING", { query: e, success: function(e) { t(e) }, failure: function(e) { n(e) } }) }) },
                A = Object.assign({}, pe(), {}, I, {}, function(e, n) { var r = {}; return t(n, function(t) { r[t] = { get: function() { return e.getState().options[t] }, set: function(n) { e.dispatch("SET_" + Z(t, "_").toUpperCase(), { value: n }) } } }), r }(i, o), {
                    setOptions: function(e) { return i.dispatch("SET_OPTIONS", { options: e }) },
                    addFile: function(e) { var t = arguments.length > 1 && void 0 !== arguments[1] ? arguments[1] : {}; return new Promise(function(n, r) { D([{ source: e, options: t }], { index: t.index }).then(function(e) { return n(e && e[0]) }).catch(r) }) },
                    addFiles: D,
                    getFile: function(e) { return i.query("GET_ACTIVE_ITEM", e) },
                    processFile: S,
                    prepareFile: R,
                    removeFile: O,
                    moveFile: function(e, t) { return i.dispatch("MOVE_ITEM", { query: e, index: t }) },
                    getFiles: y,
                    processFiles: function() { for (var e = arguments.length, t = new Array(e), n = 0; n < e; n++) t[n] = arguments[n]; var r = Array.isArray(t[0]) ? t[0] : t; if (!r.length) { var o = y().filter(function(e) { return !(e.status === Ie.IDLE && e.origin === ve.LOCAL) && e.status !== Ie.PROCESSING && e.status !== Ie.PROCESSING_COMPLETE && e.status !== Ie.PROCESSING_REVERT_ERROR }); return Promise.all(o.map(S)) } return Promise.all(r.map(S)) },
                    removeFiles: function() { for (var e = arguments.length, t = new Array(e), n = 0; n < e; n++) t[n] = arguments[n]; var r, o = Array.isArray(t[0]) ? t[0] : t; "object" == typeof o[o.length - 1] ? r = o.pop() : Array.isArray(t[0]) && (r = t[1]); var i = y(); return o.length ? o.map(function(e) { return _(e) ? i[e] ? i[e].id : null : e }).filter(function(e) { return e }).map(function(e) { return O(e, r) }) : Promise.all(i.map(function(e) { return O(e, r) })) },
                    prepareFiles: function() {
                        for (var e = arguments.length, t = new Array(e), n = 0; n < e; n++) t[n] = arguments[n];
                        var r = Array.isArray(t[0]) ? t[0] : t,
                            o = r.length ? r : y();
                        return Promise.all(o.map(R))
                    },
                    sort: function(e) { return i.dispatch("SORT", { compare: e }) },
                    browse: function() {
                        var e = p.element.querySelector("input[type=file]");
                        e && e.click()
                    },
                    destroy: function() { A.fire("destroy", p.element), i.dispatch("ABORT_ALL"), p._destroy(), window.removeEventListener("resize", d), document.removeEventListener("visibilitychange", a), i.dispatch("DID_DESTROY") },
                    insertBefore: function(e) { return b(p.element, e) },
                    insertAfter: function(e) { return P(p.element, e) },
                    appendTo: function(e) { return e.appendChild(p.element) },
                    replaceElement: function(e) { b(p.element, e), e.parentNode.removeChild(e), r = e },
                    restoreElement: function() { r && (P(r, p.element), p.element.parentNode.removeChild(p.element), r = null) },
                    isAttachedTo: function(e) { return p.element === e || r === e },
                    element: { get: function() { return p.element } },
                    status: { get: function() { return i.query("GET_STATUS") } }
                });
            return i.dispatch("DID_INIT"), n(A)
        },
        Zr = function() {
            var e = arguments.length > 0 && void 0 !== arguments[0] ? arguments[0] : {},
                n = {};
            return t(Se(), function(e, t) { n[e] = t[0] }), Qr(Object.assign({}, n, {}, e))
        },
        $r = function(e) {
            var n = arguments.length > 1 && void 0 !== arguments[1] ? arguments[1] : {},
                o = [];
            t(e.attributes, function(t) { o.push(e.attributes[t]) });
            var i = o.filter(function(e) { return e.name }).reduce(function(t, n) { var o, i = r(e, n.name); return t[(o = n.name, Ur(o.replace(/^data-/, "")))] = i === n.name || i, t }, {});
            return function e(n, r) {
                t(r, function(r, o) {
                    t(n, function(e, t) {
                        var i = new RegExp(r);
                        if (i.test(e) && (delete n[e], !1 !== o))
                            if (U(o)) n[o] = t;
                            else {
                                var a, u = o.group;
                                H(o) && !n[u] && (n[u] = {}), n[u][(a = e.replace(i, ""), a.charAt(0).toLowerCase() + a.slice(1))] = t
                            }
                    }), o.mapping && e(n[o.group], o.mapping)
                })
            }(i, n), i
        },
        Kr = function() {
            return (arguments.length <= 0 ? void 0 : arguments[0]) instanceof HTMLElement ? function(e) {
                var t = arguments.length > 1 && void 0 !== arguments[1] ? arguments[1] : {},
                    n = { "^class$": "className", "^multiple$": "allowMultiple", "^capture$": "captureMethod", "^webkitdirectory$": "allowDirectoriesOnly", "^server": { group: "server", mapping: { "^process": { group: "process" }, "^revert": { group: "revert" }, "^fetch": { group: "fetch" }, "^restore": { group: "restore" }, "^load": { group: "load" } } }, "^type$": !1, "^files$": !1 };
                De("SET_ATTRIBUTE_TO_OPTION_MAP", n);
                var r = Object.assign({}, t),
                    o = $r("FIELDSET" === e.nodeName ? e.querySelector("input[type=file]") : e, n);
                Object.keys(o).forEach(function(e) { H(o[e]) ? (H(r[e]) || (r[e] = {}), Object.assign(r[e], o[e])) : r[e] = o[e] }), r.files = (t.files || []).concat(Array.from(e.querySelectorAll("input:not([type=file])")).map(function(e) { return { source: e.value, options: { type: e.dataset.type } } }));
                var i = Zr(r);
                return e.files && Array.from(e.files).forEach(function(e) { i.addFile(e) }), i.replaceElement(e), i
            }.apply(void 0, arguments) : Zr.apply(void 0, arguments)
        },
        Jr = ["fire", "_read", "_write"],
        eo = function(e) { var t = {}; return Ee(e, t, Jr), t },
        to = function(e, t) { return e.replace(/(?:{([a-zA-Z]+)})/g, function(e, n) { return t[n] }) },
        no = function(e) {
            var t = new Blob(["(", e.toString(), ")()"], { type: "application/javascript" }),
                n = URL.createObjectURL(t),
                r = new Worker(n);
            return {
                transfer: function(e, t) {},
                post: function(e, t, n) {
                    var o = oe();
                    r.onmessage = function(e) { e.data.id === o && t(e.data.message) }, r.postMessage({ id: o, message: e }, n)
                },
                terminate: function() { r.terminate(), URL.revokeObjectURL(n) }
            }
        },
        ro = function(e) {
            return new Promise(function(t, n) {
                var r = new Image;
                r.onload = function() { t(r) }, r.onerror = function(e) { n(e) }, r.src = e
            })
        },
        oo = function(e, t) { var n = e.slice(0, e.size, e.type); return n.lastModifiedDate = e.lastModifiedDate, n.name = t, n },
        io = function(e) { return oo(e, e.name) },
        ao = [],
        uo = function(e) {
            if (!ao.includes(e)) {
                ao.push(e);
                var n, r = e({ addFilter: ye, utils: { Type: ge, forin: t, isString: U, isFile: vt, toNaturalFileSize: Ut, replaceInString: to, getExtensionFromFilename: Ye, getFilenameWithoutExtension: It, guesstimateMimeType: $n, getFileFromBlob: He, getFilenameFromURL: xe, createRoute: A, createWorker: no, createView: S, createItemAPI: Te, loadImage: ro, copyFile: io, renameFile: oo, createBlob: Xe, applyFilterChain: Oe, text: Mt, getNumericAspectRatioFromString: Pe }, views: { fileActionButton: Gt } });
                n = r.options, Object.assign(Ae, n)
            }
        },
        so = (zt = c() && !("[object OperaMini]" === Object.prototype.toString.call(window.operamini)) && "visibilityState" in document && "Promise" in window && "slice" in Blob.prototype && "URL" in window && "createObjectURL" in window.URL && "performance" in window && ("supports" in (window.CSS || {}) || /MSIE|Trident/.test(window.navigator.userAgent)), function() { return zt }),
        lo = { apps: [] },
        co = function() {};
    if (e.Status = {}, e.FileStatus = {}, e.FileOrigin = {}, e.OptionTypes = {}, e.create = co, e.destroy = co, e.parse = co, e.find = co, e.registerPlugin = co, e.getOptions = co, e.setOptions = co, so()) {
        ! function(e, t) {
            var n = arguments.length > 2 && void 0 !== arguments[2] ? arguments[2] : 60,
                r = "__framePainter";
            if (window[r]) return window[r].readers.push(e), void window[r].writers.push(t);
            window[r] = { readers: [e], writers: [t] };
            var o = window[r],
                i = 1e3 / n,
                a = null,
                u = null,
                s = null,
                l = null,
                c = function() { document.hidden ? (s = function() { return window.setTimeout(function() { return f(performance.now()) }, i) }, l = function() { return window.clearTimeout(u) }) : (s = function() { return window.requestAnimationFrame(f) }, l = function() { return window.cancelAnimationFrame(u) }) };
            document.addEventListener("visibilitychange", function() { l && l(), c(), f(performance.now()) });
            var f = function e(t) {
                u = s(e), a || (a = t);
                var n = t - a;
                n <= i || (a = t - n % i, o.readers.forEach(function(e) { return e() }), o.writers.forEach(function(e) { return e(t) }))
            };
            c(), f(performance.now())
        }(function() { lo.apps.forEach(function(e) { return e._read() }) }, function(e) { lo.apps.forEach(function(t) { return t._write(e) }) });
        var fo = function t() { document.dispatchEvent(new CustomEvent("FilePond:loaded", { detail: { supported: so, create: e.create, destroy: e.destroy, parse: e.parse, find: e.find, registerPlugin: e.registerPlugin, setOptions: e.setOptions } })), document.removeEventListener("DOMContentLoaded", t) };
        "loading" !== document.readyState ? setTimeout(function() { return fo() }, 0) : document.addEventListener("DOMContentLoaded", fo);
        var po = function() { return t(Se(), function(t, n) { e.OptionTypes[t] = n[1] }) };
        e.Status = Object.assign({}, Me), e.FileOrigin = Object.assign({}, ve), e.FileStatus = Object.assign({}, Ie), e.OptionTypes = {}, po(), e.create = function() { var t = Kr.apply(void 0, arguments); return t.on("destroy", e.destroy), lo.apps.push(t), eo(t) }, e.destroy = function(e) { var t = lo.apps.findIndex(function(t) { return t.isAttachedTo(e) }); return t >= 0 && (lo.apps.splice(t, 1)[0].restoreElement(), !0) }, e.parse = function(t) { return Array.from(t.querySelectorAll(".filepond")).filter(function(e) { return !lo.apps.find(function(t) { return t.isAttachedTo(e) }) }).map(function(t) { return e.create(t) }) }, e.find = function(e) { var t = lo.apps.find(function(t) { return t.isAttachedTo(e) }); return t ? eo(t) : null }, e.registerPlugin = function() {
            for (var e = arguments.length, t = new Array(e), n = 0; n < e; n++) t[n] = arguments[n];
            t.forEach(uo), po()
        }, e.getOptions = function() { var e = {}; return t(Se(), function(t, n) { e[t] = n[0] }), e }, e.setOptions = function(n) { return H(n) && (lo.apps.forEach(function(e) { e.setOptions(n) }), function(e) { t(e, function(e, t) { Ae[e] && (Ae[e][0] = z(t, Ae[e][0], Ae[e][1])) }) }(n)), e.getOptions() }
    }
    e.supported = so, Object.defineProperty(e, "__esModule", { value: !0 })
});