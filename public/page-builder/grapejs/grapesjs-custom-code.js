/*! grapesjs-custom-code - 0.1.3 */ ! function (e, t) {
    "object" == typeof exports && "object" == typeof module ? module.exports = t() : "function" == typeof define && define.amd ? define([], t) : "object" == typeof exports ? exports["grapesjs-custom-code"] = t() : e["grapesjs-custom-code"] = t()
}(window, function () {
    return function (e) {
        var t = {};

        function o(n) {
            if (t[n]) return t[n].exports;
            var r = t[n] = {
                i: n,
                l: !1,
                exports: {}
            };
            return e[n].call(r.exports, r, r.exports, o), r.l = !0, r.exports
        }
        return o.m = e, o.c = t, o.d = function (e, t, n) {
            o.o(e, t) || Object.defineProperty(e, t, {
                enumerable: !0,
                get: n
            })
        }, o.r = function (e) {
            "undefined" != typeof Symbol && Symbol.toStringTag && Object.defineProperty(e, Symbol.toStringTag, {
                value: "Module"
            }), Object.defineProperty(e, "__esModule", {
                value: !0
            })
        }, o.t = function (e, t) {
            if (1 & t && (e = o(e)), 8 & t) return e;
            if (4 & t && "object" == typeof e && e && e.__esModule) return e;
            var n = Object.create(null);
            if (o.r(n), Object.defineProperty(n, "default", {
                    enumerable: !0,
                    value: e
                }), 2 & t && "string" != typeof e)
                for (var r in e) o.d(n, r, function (t) {
                    return e[t]
                }.bind(null, r));
            return n
        }, o.n = function (e) {
            var t = e && e.__esModule ? function () {
                return e.default
            } : function () {
                return e
            };
            return o.d(t, "a", t), t
        }, o.o = function (e, t) {
            return Object.prototype.hasOwnProperty.call(e, t)
        }, o.p = "", o(o.s = 1)
    }([function (e, t, o) {
        "use strict";
        Object.defineProperty(t, "__esModule", {
            value: !0
        });
        t.keyCustomCode = "custom-code-plugin__code", t.typeCustomCode = "custom-code", t.commandNameCustomCode = "custom-code:open-modal"
    }, function (e, t, o) {
        "use strict";
        Object.defineProperty(t, "__esModule", {
            value: !0
        });
        var n = Object.assign || function (e) {
                for (var t = 1; t < arguments.length; t++) {
                    var o = arguments[t];
                    for (var n in o) Object.prototype.hasOwnProperty.call(o, n) && (e[n] = o[n])
                }
                return e
            },
            r = d(o(2)),
            i = d(o(3)),
            s = d(o(4));

        function d(e) {
            return e && e.__esModule ? e : {
                default: e
            }
        }
        t.default = function (e) {
            var t = arguments.length > 1 && void 0 !== arguments[1] ? arguments[1] : {},
                o = n({
                    blockLabel: "Custom Code",
                    blockCustomCode: {},
                    propsCustomCode: {},
                    placeholderContent: "<span>Insert here your custom code</span>",
                    toolbarBtnCustomCode: {},
                    placeholderScript: '<div style="pointer-events: none; padding: 10px;">\n      <svg viewBox="0 0 24 24" style="height: 30px; vertical-align: middle;">\n        <path d="M13 14h-2v-4h2m0 8h-2v-2h2M1 21h22L12 2 1 21z"></path>\n        </svg>\n      Custom code with <i>&lt;script&gt;</i> can\'t be rendered on the canvas\n    </div>',
                    modalTitle: "Insert your code",
                    codeViewOptions: {},
                    buttonLabel: "Save",
                    commandCustomCode: {}
                }, t);
            (0, r.default)(e, o), (0, i.default)(e, o), (0, s.default)(e, o)
        }
    }, function (e, t, o) {
        "use strict";
        Object.defineProperty(t, "__esModule", {
            value: !0
        });
        var n = Object.assign || function (e) {
                for (var t = 1; t < arguments.length; t++) {
                    var o = arguments[t];
                    for (var n in o) Object.prototype.hasOwnProperty.call(o, n) && (e[n] = o[n])
                }
                return e
            },
            r = o(0);
        t.default = function (e) {
            var t = arguments.length > 1 && void 0 !== arguments[1] ? arguments[1] : {},
                o = e.DomComponents,
                i = o.getType("default"),
                s = i.model,
                d = t.toolbarBtnCustomCode,
                a = void 0;
            o.addType("script", {
                view: {
                    onRender: function () {
                        this.model.closestType(r.typeCustomCode) && (this.el.innerHTML = "")
                    }
                }
            }), o.addType(r.typeCustomCode, {
                model: s.extend({
                    defaults: n({}, s.prototype.defaults, {
                        name: "Custom Code",
                        editable: !0
                    }, t.propsCustomCode),
                    init: function () {
                        this.listenTo(this, "change:" + r.keyCustomCode, this.onCustomCodeChange);
                        var e = this.get(r.keyCustomCode) || t.placeholderContent;
                        !this.components().length && this.components(e);
                        var o = this.get("toolbar"),
                            i = "custom-code";
                        d && !o.filter(function (e) {
                            return e.id === i
                        }).length && o.unshift(n({
                            id: i,
                            command: r.commandNameCustomCode,
                            label: '<svg viewBox="0 0 24 24">\n              <path d="M14.6 16.6l4.6-4.6-4.6-4.6L16 6l6 6-6 6-1.4-1.4m-5.2 0L4.8 12l4.6-4.6L8 6l-6 6 6 6 1.4-1.4z"></path>\n            </svg>'
                        }, d))
                    },
                    onCustomCodeChange: function () {
                        this.components(this.get(r.keyCustomCode))
                    }
                }, {
                    isComponent: function () {
                        return !1
                    }
                }),
                view: i.view.extend({
                    events: {
                        dblclick: "onActive"
                    },
                    init: function () {
                        this.listenTo(this.model.components(), "add remove reset", this.onComponentsChange), this.onComponentsChange()
                    },
                    onComponentsChange: function () {
                        var e = this;
                        a && clearInterval(a), a = setTimeout(function () {
                            var o = e.model,
                                n = 1;
                            (o.get(r.keyCustomCode) || "").indexOf("<script") >= 0 && (e.el.innerHTML = t.placeholderScript, n = 0), o.set({
                                droppable: n
                            })
                        }, 0)
                    },
                    onActive: function () {
                        var e = this.model;
                        this.em.get("Commands").run(r.commandNameCustomCode, {
                            target: e
                        })
                    }
                })
            })
        }
    }, function (e, t, o) {
        "use strict";
        Object.defineProperty(t, "__esModule", {
            value: !0
        });
        var n = Object.assign || function (e) {
                for (var t = 1; t < arguments.length; t++) {
                    var o = arguments[t];
                    for (var n in o) Object.prototype.hasOwnProperty.call(o, n) && (e[n] = o[n])
                }
                return e
            },
            r = o(0);
        t.default = function (e) {
            var t = arguments.length > 1 && void 0 !== arguments[1] ? arguments[1] : {},
                o = e.BlockManager,
                i = t.blockCustomCode,
                s = t.blockLabel;
            i && o.add(r.typeCustomCode, n({
                label: '<svg viewBox="0 0 24 24">\n        <path d="M14.6 16.6l4.6-4.6-4.6-4.6L16 6l6 6-6 6-1.4-1.4m-5.2 0L4.8 12l4.6-4.6L8 6l-6 6 6 6 1.4-1.4z"></path>\n      </svg>\n      <div>' + s + "</div>",
                category: "Code",
                activate: !0,
                select: !0,
                content: {
                    type: r.typeCustomCode
                }
            }, i))
        }
    }, function (e, t, o) {
        "use strict";
        Object.defineProperty(t, "__esModule", {
            value: !0
        });
        var n = Object.assign || function (e) {
                for (var t = 1; t < arguments.length; t++) {
                    var o = arguments[t];
                    for (var n in o) Object.prototype.hasOwnProperty.call(o, n) && (e[n] = o[n])
                }
                return e
            },
            r = o(0);
        t.default = function (e) {
            var t = arguments.length > 1 && void 0 !== arguments[1] ? arguments[1] : {},
                o = e.Commands,
                i = t.modalTitle,
                s = t.codeViewOptions,
                d = t.commandCustomCode,
                a = function (e, t) {
                    t instanceof HTMLElement ? e.appendChild(t) : t && e.insertAdjacentHTML("beforeend", t)
                };
            o.add(r.commandNameCustomCode, n({
                keyCustomCode: r.keyCustomCode,
                run: function (e, t) {
                    var o = arguments.length > 2 && void 0 !== arguments[2] ? arguments[2] : {};
                    this.editor = e, this.options = o, this.target = o.target || e.getSelected();
                    var n = this.target;
                    n && n.get("editable") && this.showCustomCode(n)
                },
                stop: function (e) {
                    e.Modal.close()
                },
                showCustomCode: function (e) {
                    var t = this,
                        o = this.editor,
                        n = this.options.title || i,
                        s = this.getContent(),
                        d = e.get(r.keyCustomCode) || "";
                    o.Modal.open({
                        title: n,
                        content: s
                    }).getModel().once("change:open", function () {
                        return o.stopCommand(t.id)
                    }), this.getCodeViewer().setContent(d)
                },
                getPreContent: function () {},
                getPostContent: function () {},
                getContent: function () {
                    var e = this.editor,
                        t = document.createElement("div"),
                        o = this.getCodeViewer(),
                        n = e.getConfig("stylePrefix");
                    return t.className = n + "custom-code", a(t, this.getPreContent()), t.appendChild(o.getElement()), a(t, this.getPostContent()), a(t, this.getContentActions()), o.refresh(), setTimeout(function () {
                        return o.focus()
                    }, 0), t
                },
                getContentActions: function () {
                    var e = this,
                        o = this.editor,
                        n = document.createElement("button"),
                        r = o.getConfig("stylePrefix");
                    return n.innerHTML = t.buttonLabel, n.className = r + "btn-prim " + r + "btn-import__custom-code", n.onclick = function () {
                        return e.handleSave()
                    }, n
                },
                handleSave: function () {
                    var e = this.editor,
                        t = this.target,
                        o = this.getCodeViewer().getContent();
                    t.set(r.keyCustomCode, o), e.Modal.close()
                },
                getCodeViewer: function () {
                    var e = this.editor;
                    return this.codeViewer || (this.codeViewer = e.CodeManager.createViewer(n({
                        codeName: "htmlmixed",
                        theme: "hopscotch",
                        readOnly: 0
                    }, s))), this.codeViewer
                }
            }, d))
        }
    }])
});
//# sourceMappingURL=grapesjs-custom-code.min.js.map
