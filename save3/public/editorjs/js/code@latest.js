/***
 * Skipped minification because the original files appears to be already minified.
 * Do NOT use SRI with dynamically generated files! More information: https://www.jsdelivr.com/using-sri-with-dynamic-files
 */
! function (e, t) {
    "object" == typeof exports && "object" == typeof module ? module.exports = t() : "function" == typeof define && define.amd ? define([], t) : "object" == typeof exports ? exports.CodeTool = t() : e.CodeTool = t()
}(window, (function () {
    return function (e) {
        var t = {};

        function n(r) {
            if (t[r]) return t[r].exports;
            var o = t[r] = {
                i: r,
                l: !1,
                exports: {}
            };
            return e[r].call(o.exports, o, o.exports, n), o.l = !0, o.exports
        }
        return n.m = e, n.c = t, n.d = function (e, t, r) {
            n.o(e, t) || Object.defineProperty(e, t, {
                enumerable: !0,
                get: r
            })
        }, n.r = function (e) {
            "undefined" != typeof Symbol && Symbol.toStringTag && Object.defineProperty(e, Symbol.toStringTag, {
                value: "Module"
            }), Object.defineProperty(e, "__esModule", {
                value: !0
            })
        }, n.t = function (e, t) {
            if (1 & t && (e = n(e)), 8 & t) return e;
            if (4 & t && "object" == typeof e && e && e.__esModule) return e;
            var r = Object.create(null);
            if (n.r(r), Object.defineProperty(r, "default", {
                    enumerable: !0,
                    value: e
                }), 2 & t && "string" != typeof e)
                for (var o in e) n.d(r, o, function (t) {
                    return e[t]
                }.bind(null, o));
            return r
        }, n.n = function (e) {
            var t = e && e.__esModule ? function () {
                return e.default
            } : function () {
                return e
            };
            return n.d(t, "a", t), t
        }, n.o = function (e, t) {
            return Object.prototype.hasOwnProperty.call(e, t)
        }, n.p = "/", n(n.s = 4)
    }([function (e, t, n) {
        var r = n(1),
            o = n(2);
        "string" == typeof (o = o.__esModule ? o.default : o) && (o = [
            [e.i, o, ""]
        ]);
        var a = {
            insert: "head",
            singleton: !1
        };
        r(o, a);
        e.exports = o.locals || {}
    }, function (e, t, n) {
        "use strict";
        var r, o = function () {
                return void 0 === r && (r = Boolean(window && document && document.all && !window.atob)), r
            },
            a = function () {
                var e = {};
                return function (t) {
                    if (void 0 === e[t]) {
                        var n = document.querySelector(t);
                        if (window.HTMLIFrameElement && n instanceof window.HTMLIFrameElement) try {
                            n = n.contentDocument.head
                        } catch (e) {
                            n = null
                        }
                        e[t] = n
                    }
                    return e[t]
                }
            }(),
            i = [];

        function c(e) {
            for (var t = -1, n = 0; n < i.length; n++)
                if (i[n].identifier === e) {
                    t = n;
                    break
                } return t
        }

        function u(e, t) {
            for (var n = {}, r = [], o = 0; o < e.length; o++) {
                var a = e[o],
                    u = t.base ? a[0] + t.base : a[0],
                    s = n[u] || 0,
                    l = "".concat(u, " ").concat(s);
                n[u] = s + 1;
                var d = c(l),
                    f = {
                        css: a[1],
                        media: a[2],
                        sourceMap: a[3]
                    }; - 1 !== d ? (i[d].references++, i[d].updater(f)) : i.push({
                    identifier: l,
                    updater: b(f, t),
                    references: 1
                }), r.push(l)
            }
            return r
        }

        function s(e) {
            var t = document.createElement("style"),
                r = e.attributes || {};
            if (void 0 === r.nonce) {
                var o = n.nc;
                o && (r.nonce = o)
            }
            if (Object.keys(r).forEach((function (e) {
                    t.setAttribute(e, r[e])
                })), "function" == typeof e.insert) e.insert(t);
            else {
                var i = a(e.insert || "head");
                if (!i) throw new Error("Couldn't find a style target. This probably means that the value for the 'insert' parameter is invalid.");
                i.appendChild(t)
            }
            return t
        }
        var l, d = (l = [], function (e, t) {
            return l[e] = t, l.filter(Boolean).join("\n")
        });

        function f(e, t, n, r) {
            var o = n ? "" : r.media ? "@media ".concat(r.media, " {").concat(r.css, "}") : r.css;
            if (e.styleSheet) e.styleSheet.cssText = d(t, o);
            else {
                var a = document.createTextNode(o),
                    i = e.childNodes;
                i[t] && e.removeChild(i[t]), i.length ? e.insertBefore(a, i[t]) : e.appendChild(a)
            }
        }

        function p(e, t, n) {
            var r = n.css,
                o = n.media,
                a = n.sourceMap;
            if (o ? e.setAttribute("media", o) : e.removeAttribute("media"), a && btoa && (r += "\n/*# sourceMappingURL=data:application/json;base64,".concat(btoa(unescape(encodeURIComponent(JSON.stringify(a)))), " */")), e.styleSheet) e.styleSheet.cssText = r;
            else {
                for (; e.firstChild;) e.removeChild(e.firstChild);
                e.appendChild(document.createTextNode(r))
            }
        }
        var h = null,
            v = 0;

        function b(e, t) {
            var n, r, o;
            if (t.singleton) {
                var a = v++;
                n = h || (h = s(t)), r = f.bind(null, n, a, !1), o = f.bind(null, n, a, !0)
            } else n = s(t), r = p.bind(null, n, t), o = function () {
                ! function (e) {
                    if (null === e.parentNode) return !1;
                    e.parentNode.removeChild(e)
                }(n)
            };
            return r(e),
                function (t) {
                    if (t) {
                        if (t.css === e.css && t.media === e.media && t.sourceMap === e.sourceMap) return;
                        r(e = t)
                    } else o()
                }
        }
        e.exports = function (e, t) {
            (t = t || {}).singleton || "boolean" == typeof t.singleton || (t.singleton = o());
            var n = u(e = e || [], t);
            return function (e) {
                if (e = e || [], "[object Array]" === Object.prototype.toString.call(e)) {
                    for (var r = 0; r < n.length; r++) {
                        var o = c(n[r]);
                        i[o].references--
                    }
                    for (var a = u(e, t), s = 0; s < n.length; s++) {
                        var l = c(n[s]);
                        0 === i[l].references && (i[l].updater(), i.splice(l, 1))
                    }
                    n = a
                }
            }
        }
    }, function (e, t, n) {
        (t = n(3)(!1)).push([e.i, ".ce-code__textarea {\n    min-height: 200px;\n    font-family: Menlo, Monaco, Consolas, Courier New, monospace;\n    color: #41314e;\n    line-height: 1.6em;\n    font-size: 12px;\n    background: #f8f7fa;\n    border: 1px solid #f1f1f4;\n    box-shadow: none;\n    white-space: pre;\n    word-wrap: normal;\n    overflow-x: auto;\n    resize: vertical;\n}\n", ""]), e.exports = t
    }, function (e, t, n) {
        "use strict";
        e.exports = function (e) {
            var t = [];
            return t.toString = function () {
                return this.map((function (t) {
                    var n = function (e, t) {
                        var n = e[1] || "",
                            r = e[3];
                        if (!r) return n;
                        if (t && "function" == typeof btoa) {
                            var o = (i = r, c = btoa(unescape(encodeURIComponent(JSON.stringify(i)))), u = "sourceMappingURL=data:application/json;charset=utf-8;base64,".concat(c), "/*# ".concat(u, " */")),
                                a = r.sources.map((function (e) {
                                    return "/*# sourceURL=".concat(r.sourceRoot || "").concat(e, " */")
                                }));
                            return [n].concat(a).concat([o]).join("\n")
                        }
                        var i, c, u;
                        return [n].join("\n")
                    }(t, e);
                    return t[2] ? "@media ".concat(t[2], " {").concat(n, "}") : n
                })).join("")
            }, t.i = function (e, n, r) {
                "string" == typeof e && (e = [
                    [null, e, ""]
                ]);
                var o = {};
                if (r)
                    for (var a = 0; a < this.length; a++) {
                        var i = this[a][0];
                        null != i && (o[i] = !0)
                    }
                for (var c = 0; c < e.length; c++) {
                    var u = [].concat(e[c]);
                    r && o[u[0]] || (n && (u[2] ? u[2] = "".concat(n, " and ").concat(u[2]) : u[2] = n), t.push(u))
                }
            }, t
        }
    }, function (e, t, n) {
        "use strict";
        n.r(t), n.d(t, "default", (function () {
            return a
        }));
        n(0);

        function r(e, t) {
            for (var n = 0; n < t.length; n++) {
                var r = t[n];
                r.enumerable = r.enumerable || !1, r.configurable = !0, "value" in r && (r.writable = !0), Object.defineProperty(e, r.key, r)
            }
        }

        function o(e, t, n) {
            return t && r(e.prototype, t), n && r(e, n), e
        }
        /**
         * CodeTool for Editor.js
         *
         * @author CodeX (team@ifmo.su)
         * @copyright CodeX 2018
         * @license MIT
         * @version 2.0.0
         */
        var a = function () {
            function e(t) {
                var n = t.data,
                    r = t.config,
                    o = t.api,
                    a = t.readOnly;
                ! function (e, t) {
                    if (!(e instanceof t)) throw new TypeError("Cannot call a class as a function")
                }(this, e), this.api = o, this.readOnly = a, this.placeholder = this.api.i18n.t(r.placeholder || e.DEFAULT_PLACEHOLDER), this.CSS = {
                    baseClass: this.api.styles.block,
                    input: this.api.styles.input,
                    wrapper: "ce-code",
                    textarea: "ce-code__textarea"
                }, this.nodes = {
                    holder: null,
                    textarea: null
                }, this.data = {
                    code: n.code || ""
                }, this.nodes.holder = this.drawView()
            }
            return o(e, null, [{
                key: "isReadOnlySupported",
                get: function () {
                    return !0
                }
            }, {
                key: "enableLineBreaks",
                get: function () {
                    return !0
                }
            }]), o(e, [{
                key: "drawView",
                value: function () {
                    var e = this,
                        t = document.createElement("div"),
                        n = document.createElement("textarea");
                    return t.classList.add(this.CSS.baseClass, this.CSS.wrapper), n.classList.add(this.CSS.textarea, this.CSS.input), n.textContent = this.data.code, n.placeholder = this.placeholder, this.readOnly && (n.disabled = !0), t.appendChild(n), n.addEventListener("keydown", (function (t) {
                        switch (t.code) {
                            case "Tab":
                                e.tabHandler(t)
                        }
                    })), this.nodes.textarea = n, t
                }
            }, {
                key: "render",
                value: function () {
                    return this.nodes.holder
                }
            }, {
                key: "save",
                value: function (e) {
                    return {
                        code: e.querySelector("textarea").value
                    }
                }
            }, {
                key: "onPaste",
                value: function (e) {
                    var t = e.detail.data;
                    this.data = {
                        code: t.textContent
                    }
                }
            }, {
                key: "tabHandler",
                value: function (e) {
                    e.stopPropagation(), e.preventDefault();
                    var t, n = e.target,
                        r = e.shiftKey,
                        o = n.selectionStart,
                        a = n.value;
                    if (r) {
                        var i = function (e, t) {
                            for (var n = "";
                                "\n" !== n && t > 0;) t -= 1, n = e.substr(t, 1);
                            return "\n" === n && (t += 1), t
                        }(a, o);
                        if ("  " !== a.substr(i, "  ".length)) return;
                        n.value = a.substring(0, i) + a.substring(i + "  ".length), t = o - "  ".length
                    } else t = o + "  ".length, n.value = a.substring(0, o) + "  " + a.substring(o);
                    n.setSelectionRange(t, t)
                }
            }, {
                key: "data",
                get: function () {
                    return this._data
                },
                set: function (e) {
                    this._data = e, this.nodes.textarea && (this.nodes.textarea.textContent = e.code)
                }
            }], [{
                key: "toolbox",
                get: function () {
                    return {
                        icon: '<svg width="14" height="14" viewBox="0 -1 14 14" xmlns="http://www.w3.org/2000/svg" > <path d="M3.177 6.852c.205.253.347.572.427.954.078.372.117.844.117 1.417 0 .418.01.725.03.92.02.18.057.314.107.396.046.075.093.117.14.134.075.027.218.056.42.083a.855.855 0 0 1 .56.297c.145.167.215.38.215.636 0 .612-.432.934-1.216.934-.457 0-.87-.087-1.233-.262a1.995 1.995 0 0 1-.853-.751 2.09 2.09 0 0 1-.305-1.097c-.014-.648-.029-1.168-.043-1.56-.013-.383-.034-.631-.06-.733-.064-.263-.158-.455-.276-.578a2.163 2.163 0 0 0-.505-.376c-.238-.134-.41-.256-.519-.371C.058 6.76 0 6.567 0 6.315c0-.37.166-.657.493-.846.329-.186.56-.342.693-.466a.942.942 0 0 0 .26-.447c.056-.2.088-.42.097-.658.01-.25.024-.85.043-1.802.015-.629.239-1.14.672-1.522C2.691.19 3.268 0 3.977 0c.783 0 1.216.317 1.216.921 0 .264-.069.48-.211.643a.858.858 0 0 1-.563.29c-.249.03-.417.076-.498.126-.062.04-.112.134-.139.291-.031.187-.052.562-.061 1.119a8.828 8.828 0 0 1-.112 1.378 2.24 2.24 0 0 1-.404.963c-.159.212-.373.406-.64.583.25.163.454.342.612.538zm7.34 0c.157-.196.362-.375.612-.538a2.544 2.544 0 0 1-.641-.583 2.24 2.24 0 0 1-.404-.963 8.828 8.828 0 0 1-.112-1.378c-.009-.557-.03-.932-.061-1.119-.027-.157-.077-.251-.14-.29-.08-.051-.248-.096-.496-.127a.858.858 0 0 1-.564-.29C8.57 1.401 8.5 1.185 8.5.921 8.5.317 8.933 0 9.716 0c.71 0 1.286.19 1.72.574.432.382.656.893.671 1.522.02.952.033 1.553.043 1.802.009.238.041.458.097.658a.942.942 0 0 0 .26.447c.133.124.364.28.693.466a.926.926 0 0 1 .493.846c0 .252-.058.446-.183.58-.109.115-.281.237-.52.371-.21.118-.377.244-.504.376-.118.123-.212.315-.277.578-.025.102-.045.35-.06.733-.013.392-.027.912-.042 1.56a2.09 2.09 0 0 1-.305 1.097c-.2.323-.486.574-.853.75a2.811 2.811 0 0 1-1.233.263c-.784 0-1.216-.322-1.216-.934 0-.256.07-.47.214-.636a.855.855 0 0 1 .562-.297c.201-.027.344-.056.418-.083.048-.017.096-.06.14-.134a.996.996 0 0 0 .107-.396c.02-.195.031-.502.031-.92 0-.573.039-1.045.117-1.417.08-.382.222-.701.427-.954z" /> </svg>',
                        title: "Code"
                    }
                }
            }, {
                key: "DEFAULT_PLACEHOLDER",
                get: function () {
                    return "Enter a code"
                }
            }, {
                key: "pasteConfig",
                get: function () {
                    return {
                        tags: ["pre"]
                    }
                }
            }, {
                key: "sanitize",
                get: function () {
                    return {
                        code: !0
                    }
                }
            }]), e
        }()
    }]).default
}));
