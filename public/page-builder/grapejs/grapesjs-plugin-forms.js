/*! grapesjs-plugin-forms - 2.0.1 */ ! function (e, t) {
    'object' == typeof exports && 'object' == typeof module ? module.exports = t() : 'function' == typeof define && define.amd ? define([], t) : 'object' == typeof exports ? exports["grapesjs-plugin-forms"] = t() : e["grapesjs-plugin-forms"] = t()
}(window, (function () {
    return function (e) {
        var t = {};

        function n(o) {
            if (t[o]) return t[o].exports;
            var r = t[o] = {
                i: o,
                l: !1,
                exports: {}
            };
            return e[o].call(r.exports, r, r.exports, n), r.l = !0, r.exports
        }
        return n.m = e, n.c = t, n.d = function (e, t, o) {
            n.o(e, t) || Object.defineProperty(e, t, {
                enumerable: !0,
                get: o
            })
        }, n.r = function (e) {
            'undefined' != typeof Symbol && Symbol.toStringTag && Object.defineProperty(e, Symbol.toStringTag, {
                value: 'Module'
            }), Object.defineProperty(e, '__esModule', {
                value: !0
            })
        }, n.t = function (e, t) {
            if (1 & t && (e = n(e)), 8 & t) return e;
            if (4 & t && 'object' == typeof e && e && e.__esModule) return e;
            var o = Object.create(null);
            if (n.r(o), Object.defineProperty(o, 'default', {
                    enumerable: !0,
                    value: e
                }), 2 & t && 'string' != typeof e)
                for (var r in e) n.d(o, r, function (t) {
                    return e[t]
                }.bind(null, r));
            return o
        }, n.n = function (e) {
            var t = e && e.__esModule ? function () {
                return e['default']
            } : function () {
                return e
            };
            return n.d(t, 'a', t), t
        }, n.o = function (e, t) {
            return Object.prototype.hasOwnProperty.call(e, t)
        }, n.p = "", n(n.s = 1)
    }([function (e, t) {
        e.exports = function (e, t, n) {
            return t in e ? Object.defineProperty(e, t, {
                value: n,
                enumerable: !0,
                configurable: !0,
                writable: !0
            }) : e[t] = n, e
        }
    }, function (e, t, n) {
        "use strict";
        n.r(t);
        var o = n(0),
            r = n.n(o),
            a = 'form',
            i = 'input',
            c = 'textarea',
            s = 'select',
            p = 'checkbox',
            u = 'radio',
            l = 'button',
            m = 'label',
            d = 'option',
            h = function (e) {
                var t = e.DomComponents,
                    n = {
                        name: 'id'
                    },
                    o = {
                        name: 'for'
                    },
                    r = {
                        name: 'name'
                    },
                    h = {
                        name: 'placeholder'
                    },
                    f = {
                        name: 'value'
                    },
                    v = {
                        type: 'checkbox',
                        name: 'required'
                    },
                    g = {
                        type: 'checkbox',
                        name: 'checked'
                    };
                t.addType(a, {
                    isComponent: function (e) {
                        return 'FORM' == e.tagName
                    },
                    model: {
                        defaults: {
                            tagName: 'form',
                            droppable: ':not(form)',
                            draggable: ':not(form)',
                            attributes: {
                                method: 'get'
                            },
                            traits: [{
                                type: 'select',
                                name: 'method',
                                options: [{
                                    value: 'get',
                                    name: 'GET'
                                }, {
                                    value: 'post',
                                    name: 'POST'
                                }]
                            }, {
                                name: 'action'
                            }]
                        }
                    },
                    view: {
                        events: {
                            submit: function (e) {
                                return e.preventDefault()
                            }
                        }
                    }
                }), t.addType(i, {
                    isComponent: function (e) {
                        return 'INPUT' == e.tagName
                    },
                    model: {
                        defaults: {
                            tagName: 'input',
                            draggable: 'form, form *',
                            droppable: !1,
                            highlightable: !1,
                            attributes: {
                                type: 'text'
                            },
                            traits: [r, h, {
                                type: 'select',
                                name: 'type',
                                options: [{
                                    value: 'text'
                                }, {
                                    value: 'email'
                                }, {
                                    value: 'password'
                                }, {
                                    value: 'number'
                                }]
                            }, v]
                        }
                    },
                    extendFnView: ['updateAttributes'],
                    view: {
                        updateAttributes: function () {
                            this.el.setAttribute('autocomplete', 'off')
                        }
                    }
                }), t.addType(c, {
                    extend: i,
                    isComponent: function (e) {
                        return 'TEXTAREA' == e.tagName
                    },
                    model: {
                        defaults: {
                            tagName: 'textarea',
                            attributes: {},
                            traits: [r, h, v]
                        }
                    }
                }), t.addType(d, {
                    isComponent: function (e) {
                        return 'OPTION' == e.tagName
                    },
                    model: {
                        defaults: {
                            tagName: 'option',
                            layerable: !1,
                            droppable: !1,
                            draggable: !1,
                            highlightable: !1
                        }
                    }
                });
                var b = function (e, t) {
                    return {
                        type: d,
                        components: t,
                        attributes: {
                            value: e
                        }
                    }
                };
                t.addType(s, {
                    extend: i,
                    isComponent: function (e) {
                        return 'SELECT' == e.tagName
                    },
                    model: {
                        defaults: {
                            tagName: 'select',
                            components: [b('opt1', 'Option 1'), b('opt2', 'Option 2')],
                            traits: [r, {
                                name: 'options',
                                type: 'select-options'
                            }, v]
                        }
                    },
                    view: {
                        events: {
                            mousedown: function (e) {
                                return e.preventDefault()
                            }
                        }
                    }
                }), t.addType(p, {
                    extend: i,
                    isComponent: function (e) {
                        return 'INPUT' == e.tagName && 'checkbox' == e.type
                    },
                    model: {
                        defaults: {
                            copyable: !1,
                            attributes: {
                                type: 'checkbox'
                            },
                            traits: [n, r, f, v, g]
                        }
                    },
                    view: {
                        events: {
                            click: function (e) {
                                return e.preventDefault()
                            }
                        },
                        init: function () {
                            this.listenTo(this.model, 'change:attributes:checked', this.handleChecked)
                        },
                        handleChecked: function () {
                            this.el.checked = !!this.model.get('attributes').checked
                        }
                    }
                }), t.addType(u, {
                    extend: p,
                    isComponent: function (e) {
                        return 'INPUT' == e.tagName && 'radio' == e.type
                    },
                    model: {
                        defaults: {
                            attributes: {
                                type: 'radio'
                            }
                        }
                    }
                }), t.addType(l, {
                    extend: i,
                    isComponent: function (e) {
                        return 'BUTTON' == e.tagName
                    },
                    model: {
                        defaults: {
                            tagName: 'button',
                            attributes: {
                                type: 'button'
                            },
                            text: 'Send',
                            traits: [{
                                name: 'text',
                                changeProp: !0
                            }, {
                                type: 'select',
                                name: 'type',
                                options: [{
                                    value: 'button'
                                }, {
                                    value: 'submit'
                                }, {
                                    value: 'reset'
                                }]
                            }]
                        },
                        init: function () {
                            var e = this.components(),
                                t = 1 === e.length && e.models[0],
                                n = t && t.is('textnode') && t.get('content') || '',
                                o = n || this.get('text');
                            this.set({
                                text: o
                            }), this.on('change:text', this.__onTextChange), o !== n && this.__onTextChange()
                        },
                        __onTextChange: function () {
                            this.components(this.get('text'))
                        }
                    },
                    view: {
                        events: {
                            click: function (e) {
                                return e.preventDefault()
                            }
                        }
                    }
                }), t.addType(m, {
                    extend: 'text',
                    isComponent: function (e) {
                        return 'LABEL' == e.tagName
                    },
                    model: {
                        defaults: {
                            tagName: 'label',
                            components: 'Label',
                            traits: [o]
                        }
                    }
                })
            },
            f = function (e) {
                e.TraitManager.addType('select-options', {
                    events: {
                        keyup: 'onChange'
                    },
                    onValueChange: function () {
                        for (var e = this.model, t = this.target, n = e.get('value').trim().split('\n'), o = [], r = 0; r < n.length; r++) {
                            var a = n[r].split('::');
                            o.push({
                                type: d,
                                components: a[1] || a[0],
                                attributes: {
                                    value: a[0]
                                }
                            })
                        }
                        t.components().reset(o), t.view.render()
                    },
                    getInputEl: function () {
                        if (!this.$input) {
                            for (var e = [], t = this.target.components(), n = 0; n < t.length; n++) {
                                var o = t.models[n],
                                    r = o.get('attributes').value || '',
                                    a = o.components().models[0],
                                    i = a && a.get('content') || '';
                                e.push("".concat(r, "::").concat(i))
                            }
                            this.$input = document.createElement('textarea'), this.$input.value = e.join("\n")
                        }
                        return this.$input
                    }
                })
            };

        function v(e, t) {
            var n = Object.keys(e);
            if (Object.getOwnPropertySymbols) {
                var o = Object.getOwnPropertySymbols(e);
                t && (o = o.filter((function (t) {
                    return Object.getOwnPropertyDescriptor(e, t).enumerable
                }))), n.push.apply(n, o)
            }
            return n
        }

        function g(e) {
            for (var t = 1; t < arguments.length; t++) {
                var n = null != arguments[t] ? arguments[t] : {};
                t % 2 ? v(Object(n), !0).forEach((function (t) {
                    r()(e, t, n[t])
                })) : Object.getOwnPropertyDescriptors ? Object.defineProperties(e, Object.getOwnPropertyDescriptors(n)) : v(Object(n)).forEach((function (t) {
                    Object.defineProperty(e, t, Object.getOwnPropertyDescriptor(n, t))
                }))
            }
            return e
        }
        var b = function (e) {
            var t = arguments.length > 1 && void 0 !== arguments[1] ? arguments[1] : {},
                n = t,
                o = e.BlockManager,
                r = function (e, t) {
                    n.blocks.indexOf(e) >= 0 && o.add(e, g(g({}, t), {}, {
                        category: {
                            id: 'forms',
                            label: 'Forms'
                        }
                    }))
                };
            r(a, {
                label: 'Form',
                media: '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M22 5.5c0-.3-.5-.5-1.3-.5H3.4c-.8 0-1.3.2-1.3.5v3c0 .3.5.5 1.3.5h17.4c.8 0 1.3-.2 1.3-.5v-3zM21 8H3V6h18v2zM22 10.5c0-.3-.5-.5-1.3-.5H3.4c-.8 0-1.3.2-1.3.5v3c0 .3.5.5 1.3.5h17.4c.8 0 1.3-.2 1.3-.5v-3zM21 13H3v-2h18v2z"/><rect width="10" height="3" x="2" y="15" rx=".5"/></svg>',
                content: {
                    type: a,
                    components: [{
                        components: [{
                            type: m,
                            components: 'Name'
                        }, {
                            type: i
                        }]
                    }, {
                        components: [{
                            type: m,
                            components: 'Email'
                        }, {
                            type: i,
                            attributes: {
                                type: 'email'
                            }
                        }]
                    }, {
                        components: [{
                            type: m,
                            components: 'Gender'
                        }, {
                            type: p,
                            attributes: {
                                value: 'M'
                            }
                        }, {
                            type: m,
                            components: 'M'
                        }, {
                            type: p,
                            attributes: {
                                value: 'F'
                            }
                        }, {
                            type: m,
                            components: 'F'
                        }]
                    }, {
                        components: [{
                            type: m,
                            components: 'Message'
                        }, {
                            type: c
                        }]
                    }, {
                        components: [{
                            type: l
                        }]
                    }]
                }
            }), r(i, {
                label: 'Input',
                media: '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M22 9c0-.6-.5-1-1.3-1H3.4C2.5 8 2 8.4 2 9v6c0 .6.5 1 1.3 1h17.4c.8 0 1.3-.4 1.3-1V9zm-1 6H3V9h18v6z"/><path d="M4 10h1v4H4z"/></svg>',
                content: {
                    type: i
                }
            }), r(c, {
                label: 'Textarea',
                media: '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M22 7.5c0-.9-.5-1.5-1.3-1.5H3.4C2.5 6 2 6.6 2 7.5v9c0 .9.5 1.5 1.3 1.5h17.4c.8 0 1.3-.6 1.3-1.5v-9zM21 17H3V7h18v10z"/><path d="M4 8h1v4H4zM19 7h1v10h-1zM20 8h1v1h-1zM20 15h1v1h-1z"/></svg>',
                content: {
                    type: c
                }
            }), r(s, {
                label: 'Select',
                media: '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M22 9c0-.6-.5-1-1.3-1H3.4C2.5 8 2 8.4 2 9v6c0 .6.5 1 1.3 1h17.4c.8 0 1.3-.4 1.3-1V9zm-1 6H3V9h18v6z"/><path d="M18.5 13l1.5-2h-3zM4 11.5h11v1H4z"/></svg>',
                content: {
                    type: s
                }
            }), r(l, {
                label: 'Button',
                media: '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M22 9c0-.6-.5-1-1.3-1H3.4C2.5 8 2 8.4 2 9v6c0 .6.5 1 1.3 1h17.4c.8 0 1.3-.4 1.3-1V9zm-1 6H3V9h18v6z"/><path d="M4 11.5h16v1H4z"/></svg>',
                content: {
                    type: l
                }
            }), r(m, {
                label: 'Label',
                media: '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M22 11.9c0-.6-.5-.9-1.3-.9H3.4c-.8 0-1.3.3-1.3.9V17c0 .5.5.9 1.3.9h17.4c.8 0 1.3-.4 1.3-.9V12zM21 17H3v-5h18v5z"/><rect width="14" height="5" x="2" y="5" rx=".5"/><path d="M4 13h1v3H4z"/></svg>',
                content: {
                    type: m
                }
            }), r(p, {
                label: 'Checkbox',
                media: '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M10 17l-5-5 1.41-1.42L10 14.17l7.59-7.59L19 8m0-5H5c-1.11 0-2 .89-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5a2 2 0 0 0-2-2z"></path></svg>',
                content: {
                    type: p
                }
            }), r(u, {
                label: 'Radio',
                media: '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M12 20c-4.42 0-8-3.58-8-8s3.58-8 8-8 8 3.58 8 8-3.58 8-8 8m0-18C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2m0 5c-2.76 0-5 2.24-5 5s2.24 5 5 5 5-2.24 5-5-2.24-5-5-5z"></path></svg>',
                content: {
                    type: u
                }
            })
        };

        function y(e, t) {
            var n = Object.keys(e);
            if (Object.getOwnPropertySymbols) {
                var o = Object.getOwnPropertySymbols(e);
                t && (o = o.filter((function (t) {
                    return Object.getOwnPropertyDescriptor(e, t).enumerable
                }))), n.push.apply(n, o)
            }
            return n
        }

        function w(e) {
            for (var t = 1; t < arguments.length; t++) {
                var n = null != arguments[t] ? arguments[t] : {};
                t % 2 ? y(Object(n), !0).forEach((function (t) {
                    r()(e, t, n[t])
                })) : Object.getOwnPropertyDescriptors ? Object.defineProperties(e, Object.getOwnPropertyDescriptors(n)) : y(Object(n)).forEach((function (t) {
                    Object.defineProperty(e, t, Object.getOwnPropertyDescriptor(n, t))
                }))
            }
            return e
        }
        t["default"] = function (e) {
            var t = arguments.length > 1 && void 0 !== arguments[1] ? arguments[1] : {},
                n = w({
                    blocks: ['form', 'input', 'textarea', 'select', 'button', 'label', 'checkbox', 'radio']
                }, t);
            h(e, n), f(e), b(e, n)
        }
    }])
}));
//# sourceMappingURL=grapesjs-plugin-forms.min.js.map
