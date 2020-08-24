<script>
/**/

function verificar(){
  var total = 0;
  $("select.v_signal_select").each(function(){
    console.log($(this).val());
    if($(this).val()!=""){
      total = total +1;
    }
  });
  if(total>2){
    $("#filter-submit").prop('disabled', false);
  }else{
    $("#filter-submit").prop('disabled', true);
  }
}
(function() {
    var AjaxMonitor, Bar, DocumentMonitor, ElementMonitor, ElementTracker, EventLagMonitor, Evented, Events, NoTargetError, Pace, RequestIntercept, SOURCE_KEYS, Scaler, SocketRequestTracker, XHRRequestTracker, animation, avgAmplitude, bar, cancelAnimation, cancelAnimationFrame, defaultOptions, extend, extendNative, getFromDOM, getIntercept, handlePushState, ignoreStack, init, now, options, requestAnimationFrame, result, runAnimation, scalers, shouldIgnoreURL, shouldTrack, source, sources, uniScaler, _WebSocket, _XDomainRequest, _XMLHttpRequest, _i, _intercept, _len, _pushState, _ref, _ref1, _replaceState,
      __slice = [].slice,
      __hasProp = {}.hasOwnProperty,
      __extends = function(child, parent) { for (var key in parent) { if (__hasProp.call(parent, key)) child[key] = parent[key]; } function ctor() { this.constructor = child; } ctor.prototype = parent.prototype; child.prototype = new ctor(); child.__super__ = parent.prototype; return child; },
      __indexOf = [].indexOf || function(item) { for (var i = 0, l = this.length; i < l; i++) { if (i in this && this[i] === item) return i; } return -1; };
  
    defaultOptions = {
      catchupTime: 100,
      initialRate: .03,
      minTime: 250,
      ghostTime: 100,
      maxProgressPerFrame: 20,
      easeFactor: 1.25,
      startOnPageLoad: true,
      restartOnPushState: true,
      restartOnRequestAfter: 500,
      target: 'body',
      elements: {
        checkInterval: 100,
        selectors: ['body']
      },
      eventLag: {
        minSamples: 10,
        sampleCount: 3,
        lagThreshold: 3
      },
      ajax: {
        trackMethods: ['GET'],
        trackWebSockets: true,
        ignoreURLs: []
      }
    };
  
    now = function() {
      var _ref;
      return (_ref = typeof performance !== "undefined" && performance !== null ? typeof performance.now === "function" ? performance.now() : void 0 : void 0) != null ? _ref : +(new Date);
    };
  
    requestAnimationFrame = window.requestAnimationFrame || window.mozRequestAnimationFrame || window.webkitRequestAnimationFrame || window.msRequestAnimationFrame;
  
    cancelAnimationFrame = window.cancelAnimationFrame || window.mozCancelAnimationFrame;
  
    if (requestAnimationFrame == null) {
      requestAnimationFrame = function(fn) {
        return setTimeout(fn, 50);
      };
      cancelAnimationFrame = function(id) {
        return clearTimeout(id);
      };
    }
  
    runAnimation = function(fn) {
      var last, tick;
      last = now();
      tick = function() {
        var diff;
        diff = now() - last;
        if (diff >= 33) {
          last = now();
          return fn(diff, function() {
            return requestAnimationFrame(tick);
          });
        } else {
          return setTimeout(tick, 33 - diff);
        }
      };
      return tick();
    };
  
    result = function() {
      var args, key, obj;
      obj = arguments[0], key = arguments[1], args = 3 <= arguments.length ? __slice.call(arguments, 2) : [];
      if (typeof obj[key] === 'function') {
        return obj[key].apply(obj, args);
      } else {
        return obj[key];
      }
    };
  
    extend = function() {
      var key, out, source, sources, val, _i, _len;
      out = arguments[0], sources = 2 <= arguments.length ? __slice.call(arguments, 1) : [];
      for (_i = 0, _len = sources.length; _i < _len; _i++) {
        source = sources[_i];
        if (source) {
          for (key in source) {
            if (!__hasProp.call(source, key)) continue;
            val = source[key];
            if ((out[key] != null) && typeof out[key] === 'object' && (val != null) && typeof val === 'object') {
              extend(out[key], val);
            } else {
              out[key] = val;
            }
          }
        }
      }
      return out;
    };
  
    avgAmplitude = function(arr) {
      var count, sum, v, _i, _len;
      sum = count = 0;
      for (_i = 0, _len = arr.length; _i < _len; _i++) {
        v = arr[_i];
        sum += Math.abs(v);
        count++;
      }
      return sum / count;
    };
  
    getFromDOM = function(key, json) {
      var data, e, el;
      if (key == null) {
        key = 'options';
      }
      if (json == null) {
        json = true;
      }
      el = document.querySelector("[data-pace-" + key + "]");
      if (!el) {
        return;
      }
      data = el.getAttribute("data-pace-" + key);
      if (!json) {
        return data;
      }
      try {
        return JSON.parse(data);
      } catch (_error) {
        e = _error;
        return typeof console !== "undefined" && console !== null ? console.error("Error parsing inline pace options", e) : void 0;
      }
    };
  
    Evented = (function() {
      function Evented() {}
  
      Evented.prototype.on = function(event, handler, ctx, once) {
        var _base;
        if (once == null) {
          once = false;
        }
        if (this.bindings == null) {
          this.bindings = {};
        }
        if ((_base = this.bindings)[event] == null) {
          _base[event] = [];
        }
        return this.bindings[event].push({
          handler: handler,
          ctx: ctx,
          once: once
        });
      };
  
      Evented.prototype.once = function(event, handler, ctx) {
        return this.on(event, handler, ctx, true);
      };
  
      Evented.prototype.off = function(event, handler) {
        var i, _ref, _results;
        if (((_ref = this.bindings) != null ? _ref[event] : void 0) == null) {
          return;
        }
        if (handler == null) {
          return delete this.bindings[event];
        } else {
          i = 0;
          _results = [];
          while (i < this.bindings[event].length) {
            if (this.bindings[event][i].handler === handler) {
              _results.push(this.bindings[event].splice(i, 1));
            } else {
              _results.push(i++);
            }
          }
          return _results;
        }
      };
  
      Evented.prototype.trigger = function() {
        var args, ctx, event, handler, i, once, _ref, _ref1, _results;
        event = arguments[0], args = 2 <= arguments.length ? __slice.call(arguments, 1) : [];
        if ((_ref = this.bindings) != null ? _ref[event] : void 0) {
          i = 0;
          _results = [];
          while (i < this.bindings[event].length) {
            _ref1 = this.bindings[event][i], handler = _ref1.handler, ctx = _ref1.ctx, once = _ref1.once;
            handler.apply(ctx != null ? ctx : this, args);
            if (once) {
              _results.push(this.bindings[event].splice(i, 1));
            } else {
              _results.push(i++);
            }
          }
          return _results;
        }
      };
  
      return Evented;
  
    })();
  
    Pace = window.Pace || {};
  
    window.Pace = Pace;
  
    extend(Pace, Evented.prototype);
  
    options = Pace.options = extend({}, defaultOptions, window.paceOptions, getFromDOM());
  
    _ref = ['ajax', 'document', 'eventLag', 'elements'];
    for (_i = 0, _len = _ref.length; _i < _len; _i++) {
      source = _ref[_i];
      if (options[source] === true) {
        options[source] = defaultOptions[source];
      }
    }
  
    NoTargetError = (function(_super) {
      __extends(NoTargetError, _super);
  
      function NoTargetError() {
        _ref1 = NoTargetError.__super__.constructor.apply(this, arguments);
        return _ref1;
      }
  
      return NoTargetError;
  
    })(Error);
  
    Bar = (function() {
      function Bar() {
        this.progress = 0;
      }
  
      Bar.prototype.getElement = function() {
        var targetElement;
        if (this.el == null) {
          targetElement = document.querySelector(options.target);
          if (!targetElement) {
            throw new NoTargetError;
          }
          this.el = document.createElement('div');
          this.el.className = "pace pace-active";
          document.body.className = document.body.className.replace(/pace-done/g, '');
          document.body.className += ' pace-running';
          this.el.innerHTML = '<div class="pace-progress">\n  <div class="pace-progress-inner"></div>\n</div>\n<div class="pace-activity"></div>';
          if (targetElement.firstChild != null) {
            targetElement.insertBefore(this.el, targetElement.firstChild);
          } else {
            targetElement.appendChild(this.el);
          }
        }
        return this.el;
      };
  
      Bar.prototype.finish = function() {
        var el;
        el = this.getElement();
        el.className = el.className.replace('pace-active', '');
        el.className += ' pace-inactive';
        document.body.className = document.body.className.replace('pace-running', '');
        return document.body.className += ' pace-done';
      };
  
      Bar.prototype.update = function(prog) {
        this.progress = prog;
        return this.render();
      };
  
      Bar.prototype.destroy = function() {
        try {
          this.getElement().parentNode.removeChild(this.getElement());
        } catch (_error) {
          NoTargetError = _error;
        }
        return this.el = void 0;
      };
  
      Bar.prototype.render = function() {
        var el, key, progressStr, transform, _j, _len1, _ref2;
        if (document.querySelector(options.target) == null) {
          return false;
        }
        el = this.getElement();
        transform = "translate3d(" + this.progress + "%, 0, 0)";
        _ref2 = ['webkitTransform', 'msTransform', 'transform'];
        for (_j = 0, _len1 = _ref2.length; _j < _len1; _j++) {
          key = _ref2[_j];
          el.children[0].style[key] = transform;
        }
        if (!this.lastRenderedProgress || this.lastRenderedProgress | 0 !== this.progress | 0) {
          el.children[0].setAttribute('data-progress-text', "" + (this.progress | 0) + "%");
          if (this.progress >= 100) {
            progressStr = '99';
          } else {
            progressStr = this.progress < 10 ? "0" : "";
            progressStr += this.progress | 0;
          }
          el.children[0].setAttribute('data-progress', "" + progressStr);
        }
        return this.lastRenderedProgress = this.progress;
      };
  
      Bar.prototype.done = function() {
        return this.progress >= 100;
      };
  
      return Bar;
  
    })();
  
    Events = (function() {
      function Events() {
        this.bindings = {};
      }
  
      Events.prototype.trigger = function(name, val) {
        var binding, _j, _len1, _ref2, _results;
        if (this.bindings[name] != null) {
          _ref2 = this.bindings[name];
          _results = [];
          for (_j = 0, _len1 = _ref2.length; _j < _len1; _j++) {
            binding = _ref2[_j];
            _results.push(binding.call(this, val));
          }
          return _results;
        }
      };
  
      Events.prototype.on = function(name, fn) {
        var _base;
        if ((_base = this.bindings)[name] == null) {
          _base[name] = [];
        }
        return this.bindings[name].push(fn);
      };
  
      return Events;
  
    })();
  
    _XMLHttpRequest = window.XMLHttpRequest;
  
    _XDomainRequest = window.XDomainRequest;
  
    _WebSocket = window.WebSocket;
  
    extendNative = function(to, from) {
      var e, key, _results;
      _results = [];
      for (key in from.prototype) {
        try {
          if ((to[key] == null) && typeof from[key] !== 'function') {
            if (typeof Object.defineProperty === 'function') {
              _results.push(Object.defineProperty(to, key, {
                get: function() {
                  return from.prototype[key];
                },
                configurable: true,
                enumerable: true
              }));
            } else {
              _results.push(to[key] = from.prototype[key]);
            }
          } else {
            _results.push(void 0);
          }
        } catch (_error) {
          e = _error;
        }
      }
      return _results;
    };
  
    ignoreStack = [];
  
    Pace.ignore = function() {
      var args, fn, ret;
      fn = arguments[0], args = 2 <= arguments.length ? __slice.call(arguments, 1) : [];
      ignoreStack.unshift('ignore');
      ret = fn.apply(null, args);
      ignoreStack.shift();
      return ret;
    };
  
    Pace.track = function() {
      var args, fn, ret;
      fn = arguments[0], args = 2 <= arguments.length ? __slice.call(arguments, 1) : [];
      ignoreStack.unshift('track');
      ret = fn.apply(null, args);
      ignoreStack.shift();
      return ret;
    };
  
    shouldTrack = function(method) {
      var _ref2;
      if (method == null) {
        method = 'GET';
      }
      if (ignoreStack[0] === 'track') {
        return 'force';
      }
      if (!ignoreStack.length && options.ajax) {
        if (method === 'socket' && options.ajax.trackWebSockets) {
          return true;
        } else if (_ref2 = method.toUpperCase(), __indexOf.call(options.ajax.trackMethods, _ref2) >= 0) {
          return true;
        }
      }
      return false;
    };
  
    RequestIntercept = (function(_super) {
      __extends(RequestIntercept, _super);
  
      function RequestIntercept() {
        var monitorXHR,
          _this = this;
        RequestIntercept.__super__.constructor.apply(this, arguments);
        monitorXHR = function(req) {
          var _open;
          _open = req.open;
          return req.open = function(type, url, async) {
            if (shouldTrack(type)) {
              _this.trigger('request', {
                type: type,
                url: url,
                request: req
              });
            }
            return _open.apply(req, arguments);
          };
        };
        window.XMLHttpRequest = function(flags) {
          var req;
          req = new _XMLHttpRequest(flags);
          monitorXHR(req);
          return req;
        };
        try {
          extendNative(window.XMLHttpRequest, _XMLHttpRequest);
        } catch (_error) {}
        if (_XDomainRequest != null) {
          window.XDomainRequest = function() {
            var req;
            req = new _XDomainRequest;
            monitorXHR(req);
            return req;
          };
          try {
            extendNative(window.XDomainRequest, _XDomainRequest);
          } catch (_error) {}
        }
        if ((_WebSocket != null) && options.ajax.trackWebSockets) {
          window.WebSocket = function(url, protocols) {
            var req;
            if (protocols != null) {
              req = new _WebSocket(url, protocols);
            } else {
              req = new _WebSocket(url);
            }
            if (shouldTrack('socket')) {
              _this.trigger('request', {
                type: 'socket',
                url: url,
                protocols: protocols,
                request: req
              });
            }
            return req;
          };
          try {
            extendNative(window.WebSocket, _WebSocket);
          } catch (_error) {}
        }
      }
  
      return RequestIntercept;
  
    })(Events);
  
    _intercept = null;
  
    getIntercept = function() {
      if (_intercept == null) {
        _intercept = new RequestIntercept;
      }
      return _intercept;
    };
  
    shouldIgnoreURL = function(url) {
      var pattern, _j, _len1, _ref2;
      _ref2 = options.ajax.ignoreURLs;
      for (_j = 0, _len1 = _ref2.length; _j < _len1; _j++) {
        pattern = _ref2[_j];
        if (typeof pattern === 'string') {
          if (url.indexOf(pattern) !== -1) {
            return true;
          }
        } else {
          if (pattern.test(url)) {
            return true;
          }
        }
      }
      return false;
    };
  
    getIntercept().on('request', function(_arg) {
      var after, args, request, type, url;
      type = _arg.type, request = _arg.request, url = _arg.url;
      if (shouldIgnoreURL(url)) {
        return;
      }
      if (!Pace.running && (options.restartOnRequestAfter !== false || shouldTrack(type) === 'force')) {
        args = arguments;
        after = options.restartOnRequestAfter || 0;
        if (typeof after === 'boolean') {
          after = 0;
        }
        return setTimeout(function() {
          var stillActive, _j, _len1, _ref2, _ref3, _results;
          if (type === 'socket') {
            stillActive = request.readyState < 2;
          } else {
            stillActive = (0 < (_ref2 = request.readyState) && _ref2 < 4);
          }
          if (stillActive) {
            Pace.restart();
            _ref3 = Pace.sources;
            _results = [];
            for (_j = 0, _len1 = _ref3.length; _j < _len1; _j++) {
              source = _ref3[_j];
              if (source instanceof AjaxMonitor) {
                source.watch.apply(source, args);
                break;
              } else {
                _results.push(void 0);
              }
            }
            return _results;
          }
        }, after);
      }
    });
  
    AjaxMonitor = (function() {
      function AjaxMonitor() {
        var _this = this;
        this.elements = [];
        getIntercept().on('request', function() {
          return _this.watch.apply(_this, arguments);
        });
      }
  
      AjaxMonitor.prototype.watch = function(_arg) {
        var request, tracker, type, url;
        type = _arg.type, request = _arg.request, url = _arg.url;
        if (shouldIgnoreURL(url)) {
          return;
        }
        if (type === 'socket') {
          tracker = new SocketRequestTracker(request);
        } else {
          tracker = new XHRRequestTracker(request);
        }
        return this.elements.push(tracker);
      };
  
      return AjaxMonitor;
  
    })();
  
    XHRRequestTracker = (function() {
      function XHRRequestTracker(request) {
        var event, size, _j, _len1, _onreadystatechange, _ref2,
          _this = this;
        this.progress = 0;
        if (window.ProgressEvent != null) {
          size = null;
          request.addEventListener('progress', function(evt) {
            if (evt.lengthComputable) {
              return _this.progress = 100 * evt.loaded / evt.total;
            } else {
              return _this.progress = _this.progress + (100 - _this.progress) / 2;
            }
          }, false);
          _ref2 = ['load', 'abort', 'timeout', 'error'];
          for (_j = 0, _len1 = _ref2.length; _j < _len1; _j++) {
            event = _ref2[_j];
            request.addEventListener(event, function() {
              return _this.progress = 100;
            }, false);
          }
        } else {
          _onreadystatechange = request.onreadystatechange;
          request.onreadystatechange = function() {
            var _ref3;
            if ((_ref3 = request.readyState) === 0 || _ref3 === 4) {
              _this.progress = 100;
            } else if (request.readyState === 3) {
              _this.progress = 50;
            }
            return typeof _onreadystatechange === "function" ? _onreadystatechange.apply(null, arguments) : void 0;
          };
        }
      }
  
      return XHRRequestTracker;
  
    })();
  
    SocketRequestTracker = (function() {
      function SocketRequestTracker(request) {
        var event, _j, _len1, _ref2,
          _this = this;
        this.progress = 0;
        _ref2 = ['error', 'open'];
        for (_j = 0, _len1 = _ref2.length; _j < _len1; _j++) {
          event = _ref2[_j];
          request.addEventListener(event, function() {
            return _this.progress = 100;
          }, false);
        }
      }
  
      return SocketRequestTracker;
  
    })();
  
    ElementMonitor = (function() {
      function ElementMonitor(options) {
        var selector, _j, _len1, _ref2;
        if (options == null) {
          options = {};
        }
        this.elements = [];
        if (options.selectors == null) {
          options.selectors = [];
        }
        _ref2 = options.selectors;
        for (_j = 0, _len1 = _ref2.length; _j < _len1; _j++) {
          selector = _ref2[_j];
          this.elements.push(new ElementTracker(selector));
        }
      }
  
      return ElementMonitor;
  
    })();
  
    ElementTracker = (function() {
      function ElementTracker(selector) {
        this.selector = selector;
        this.progress = 0;
        this.check();
      }
  
      ElementTracker.prototype.check = function() {
        var _this = this;
        if (document.querySelector(this.selector)) {
          return this.done();
        } else {
          return setTimeout((function() {
            return _this.check();
          }), options.elements.checkInterval);
        }
      };
  
      ElementTracker.prototype.done = function() {
        return this.progress = 100;
      };
  
      return ElementTracker;
  
    })();
  
    DocumentMonitor = (function() {
      DocumentMonitor.prototype.states = {
        loading: 0,
        interactive: 50,
        complete: 100
      };
  
      function DocumentMonitor() {
        var _onreadystatechange, _ref2,
          _this = this;
        this.progress = (_ref2 = this.states[document.readyState]) != null ? _ref2 : 100;
        _onreadystatechange = document.onreadystatechange;
        document.onreadystatechange = function() {
          if (_this.states[document.readyState] != null) {
            _this.progress = _this.states[document.readyState];
          }
          return typeof _onreadystatechange === "function" ? _onreadystatechange.apply(null, arguments) : void 0;
        };
      }
  
      return DocumentMonitor;
  
    })();
  
    EventLagMonitor = (function() {
      function EventLagMonitor() {
        var avg, interval, last, points, samples,
          _this = this;
        this.progress = 0;
        avg = 0;
        samples = [];
        points = 0;
        last = now();
        interval = setInterval(function() {
          var diff;
          diff = now() - last - 50;
          last = now();
          samples.push(diff);
          if (samples.length > options.eventLag.sampleCount) {
            samples.shift();
          }
          avg = avgAmplitude(samples);
          if (++points >= options.eventLag.minSamples && avg < options.eventLag.lagThreshold) {
            _this.progress = 100;
            return clearInterval(interval);
          } else {
            return _this.progress = 100 * (3 / (avg + 3));
          }
        }, 50);
      }
  
      return EventLagMonitor;
  
    })();
  
    Scaler = (function() {
      function Scaler(source) {
        this.source = source;
        this.last = this.sinceLastUpdate = 0;
        this.rate = options.initialRate;
        this.catchup = 0;
        this.progress = this.lastProgress = 0;
        if (this.source != null) {
          this.progress = result(this.source, 'progress');
        }
      }
  
      Scaler.prototype.tick = function(frameTime, val) {
        var scaling;
        if (val == null) {
          val = result(this.source, 'progress');
        }
        if (val >= 100) {
          this.done = true;
        }
        if (val === this.last) {
          this.sinceLastUpdate += frameTime;
        } else {
          if (this.sinceLastUpdate) {
            this.rate = (val - this.last) / this.sinceLastUpdate;
          }
          this.catchup = (val - this.progress) / options.catchupTime;
          this.sinceLastUpdate = 0;
          this.last = val;
        }
        if (val > this.progress) {
          this.progress += this.catchup * frameTime;
        }
        scaling = 1 - Math.pow(this.progress / 100, options.easeFactor);
        this.progress += scaling * this.rate * frameTime;
        this.progress = Math.min(this.lastProgress + options.maxProgressPerFrame, this.progress);
        this.progress = Math.max(0, this.progress);
        this.progress = Math.min(100, this.progress);
        this.lastProgress = this.progress;
        return this.progress;
      };
  
      return Scaler;
  
    })();
  
    sources = null;
  
    scalers = null;
  
    bar = null;
  
    uniScaler = null;
  
    animation = null;
  
    cancelAnimation = null;
  
    Pace.running = false;
  
    handlePushState = function() {
      if (options.restartOnPushState) {
        return Pace.restart();
      }
    };
  
    if (window.history.pushState != null) {
      _pushState = window.history.pushState;
      window.history.pushState = function() {
        handlePushState();
        return _pushState.apply(window.history, arguments);
      };
    }
  
    if (window.history.replaceState != null) {
      _replaceState = window.history.replaceState;
      window.history.replaceState = function() {
        handlePushState();
        return _replaceState.apply(window.history, arguments);
      };
    }
  
    SOURCE_KEYS = {
      ajax: AjaxMonitor,
      elements: ElementMonitor,
      document: DocumentMonitor,
      eventLag: EventLagMonitor
    };
  
    (init = function() {
      var type, _j, _k, _len1, _len2, _ref2, _ref3, _ref4;
      Pace.sources = sources = [];
      _ref2 = ['ajax', 'elements', 'document', 'eventLag'];
      for (_j = 0, _len1 = _ref2.length; _j < _len1; _j++) {
        type = _ref2[_j];
        if (options[type] !== false) {
          sources.push(new SOURCE_KEYS[type](options[type]));
        }
      }
      _ref4 = (_ref3 = options.extraSources) != null ? _ref3 : [];
      for (_k = 0, _len2 = _ref4.length; _k < _len2; _k++) {
        source = _ref4[_k];
        sources.push(new source(options));
      }
      Pace.bar = bar = new Bar;
      scalers = [];
      return uniScaler = new Scaler;
    })();
  
    Pace.stop = function() {
      Pace.trigger('stop');
      Pace.running = false;
      bar.destroy();
      cancelAnimation = true;
      if (animation != null) {
        if (typeof cancelAnimationFrame === "function") {
          cancelAnimationFrame(animation);
        }
        animation = null;
      }
      return init();
    };
  
    Pace.restart = function() {
      Pace.trigger('restart');
      Pace.stop();
      return Pace.start();
    };
  
    Pace.go = function() {
      var start;
      Pace.running = true;
      bar.render();
      start = now();
      cancelAnimation = false;
      return animation = runAnimation(function(frameTime, enqueueNextFrame) {
        var avg, count, done, element, elements, i, j, remaining, scaler, scalerList, sum, _j, _k, _len1, _len2, _ref2;
        remaining = 100 - bar.progress;
        count = sum = 0;
        done = true;
        for (i = _j = 0, _len1 = sources.length; _j < _len1; i = ++_j) {
          source = sources[i];
          scalerList = scalers[i] != null ? scalers[i] : scalers[i] = [];
          elements = (_ref2 = source.elements) != null ? _ref2 : [source];
          for (j = _k = 0, _len2 = elements.length; _k < _len2; j = ++_k) {
            element = elements[j];
            scaler = scalerList[j] != null ? scalerList[j] : scalerList[j] = new Scaler(element);
            done &= scaler.done;
            if (scaler.done) {
              continue;
            }
            count++;
            sum += scaler.tick(frameTime);
          }
        }
        avg = sum / count;
        bar.update(uniScaler.tick(frameTime, avg));
        if (bar.done() || done || cancelAnimation) {
          bar.update(100);
          Pace.trigger('done');
          return setTimeout(function() {
            bar.finish();
            Pace.running = false;
            return Pace.trigger('hide');
          }, Math.max(options.ghostTime, Math.max(options.minTime - (now() - start), 0)));
        } else {
          return enqueueNextFrame();
        }
      });
    };
  
    Pace.start = function(_options) {
      extend(options, _options);
      Pace.running = true;
      try {
        bar.render();
      } catch (_error) {
        NoTargetError = _error;
      }
      if (!document.querySelector('.pace')) {
        return setTimeout(Pace.start, 50);
      } else {
        Pace.trigger('start');
        return Pace.go();
      }
    };
  
    if (typeof define === 'function' && define.amd) {
      define(['pace'], function() {
        return Pace;
      });
    } else if (typeof exports === 'object') {
      module.exports = Pace;
    } else {
      if (options.startOnPageLoad) {
        Pace.start();
      }
    }
  
  }).call(this);
/**/



    $(function () {
        $('thead').hide();

        let config = Array();
        config['vsignal-filters'] = {
            url: "{{ route('vsignal-filters') }}",
            no_result: '<tr>' +
                '<td>{!! trans("signalsinventory.search.no-results") !!}</td>' +
                '<td></td>' +
                '<td></td>' +
                '<td></td>' +
                '<td></td>' +
                '<td></td>' +
                '<td></td>' +
                '<td></td>' +
                '<td></td>' +
                '</tr>',
            result_heading: '#signals_heading',
            result_caption: ' señales encontradas',
            render: function (container, data) {
                $.each(data, function (index, val) {
                  console.log(index);
                  //JSON.parse
                    container.append('<tr>' +
                        '<td>' + val.code + '</td>' +
                        '<td>' + val.group + '</td>' +
                        '<td>' + val.signal + '</td>' +
                        '<td>' + val.state + '</td>' +
                        '<td>' + val.street1 + '</td>' +
                        '<td>' + val.street2 + '</td>' +
                        '<td>' + val.latitude + '</td>' +
                        '<td>' + val.longitude + '</td>' +
                        '<td>' + val.google_address + '</td>' +
                        '<td>' + val.parish + '</td>' +
                        /*
                        '<td>' + val.fastener + '</td>' +
                        '<td>' + val.material + '</td>' +
                        
                        '<td>' + val.variation + '</td>' +

                        
                        '<td>' + val.neighborhood + '</td>' +*/
                        
                        '</tr>');

                    add_signal_marker(val);
                });
            },
            excel_export: '{{ url('/georeports/signals-excel/') }}',
        };
        config['light-filters'] = {
            url: '{{ route('light-filters') }}',
            no_result: '<tr>' +
                '<td>{!! trans("traffic-lights.search.no-results") !!}</td>' +
                '<td></td>' +
                '<td></td>' +
                '<td></td>' +
                '<td></td>' +
                '<td></td>' +
                '</tr>',
            result_heading: '#lights_heading',
            result_caption: ' semáforos encontrados',
            render: function (container, data) {
                $.each(data, function (index, val) {
                    container.append('<tr>' +
                        '<td>' + val.id + '</td>' +
                        '<td>' + val.brand + '</td>' +
                        '<td>' + val.fastener + '</td>' +
                        '<td>' + val.state + '</td>' +
                        '<td>' + val.orientation + '</td>' +
                        '<td>' + val.intersection + '</td>' +
                        '</tr>');

                    add_light_marker(val);
                });
            },
            excel_export: '{{ url('/georeports/lights-excel/') }}',
        };
        config['regulator-filters'] = {
            url: '{{ route('regulator-filters') }}',
            no_result: '<tr>' +
                '<td>{!! trans("traffic-lights.search.no-results") !!}</td>' +
                '<td></td>' +
                '<td></td>' +
                '<td></td>' +
                '<td></td>' +
                '<td></td>' +
                '</tr>',
            result_heading: '#regulators_heading',
            result_caption: ' reguladoras encontradas',
            render: function (container, data) {
                $.each(data, function (index, val) {
                    container.append('<tr>' +
                        '<td>' + val.id + '</td>' +
                        '<td>' + val.code + '</td>' +
                        '<td>' + val.erp_code + '</td>' +
                        '<td>' + val.brand + '</td>' +
                        '<td>' + val.state + '</td>' +
                        '<td>' + val.intersection + '</td>' +
                        '</tr>');

                    add_regulator_marker(val);
                });
            },
            excel_export: '{{ route('regulators-excel') }}',
        };

        let filter_form = $('.tab-pane.show form');
        let filter_submit = $('#filter-submit');
        let filter_reset = $('#filter-reset');
        let result_container = $('#result_table');
        let result_caption = $('#result_caption');

        let markers_list = [];
        let bounds = new google.maps.LatLngBounds();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        filter_submit.click(function (event) {
            event.preventDefault();
            clear_data();

            // Get current form id
            filter_form = $('.tab-pane.show form');
            let form_id = filter_form.attr('id');

            $("#excel-form").attr('action', config[form_id].excel_export);

            // Serialize form params
            let params = filter_form.serialize();
            $('#excel_criteria').val(params);

            result_container.html('<i class="fa fa-spinner fa-spin"></i> Buscando. Por favor espere...');

            disable_selectizes();
            Pace.track(function() {
                $.ajax({
                    type: 'POST',
                    url: config[form_id].url,
                    data: params,
                    async: true,
                    success: function (result) {
                      console.log(result);
                        let jsonData = JSON.parse(result);//JSON.stringify(result.data);//
                        clear_data();
                        
                        if (jsonData.length !== 0) {
                            /*result_caption.html(jsonData.length + config[form_id].result_caption);
                            config[form_id].render(result_container, jsonData);
                            map.fitBounds(bounds);

                            $('#excel-export').attr("disabled", false);
                            $('#save-image-btn').attr("disabled", false);
                            */
                           console.log("entro");
                           result_caption.html(jsonData.length + config[form_id].result_caption);
                           config[form_id].render(result_container, jsonData);
                           $('#excel-export').attr("disabled", false);
                          $('#save-image-btn').attr("disabled", false);
                        } else {
                            result_container.append(config[form_id].no_result);
                        }

                        $(config[form_id].result_heading).show();
                    },
                    error: function (response, status, error) {
                      console.log(response, status, error);
                        $(config[form_id].result_heading).show();
                        //console.log(response.responseText);
                        if (response.status === 422) {
                            result_container.html(config[form_id].no_result);
                        } else if (response.status === 500) {
                            result_container.html('Se produjo un error. Inténtelo de nuevo o contacte al administrador.');
                        }
                    },
                });
            });
            enable_selectizes();
        });

        clear_data = function () {
            // clear result_container
            result_container.html('');
            result_caption.html('');
            $('table thead').hide();

            // clear map markers
            for (let i = 0; i < markers_list.length; i++) {
                markers_list[i].setMap(null);
            }

            markers_list = [];
            bounds = new google.maps.LatLngBounds();

            $('#excel-export').attr("disabled", true);
            $('#save-image-btn').attr("disabled", true);
        };

        add_signal_marker = function (val) {
            let marker = new google.maps.Marker({
                map: map,
                //icon: "",
                title: val.code,
                optimized: false,
                position: new google.maps.LatLng(val.latitude, val.longitude)
            });

            bounds.extend(marker.position);

            marker['infowindow'] = new google.maps.InfoWindow({
                content: '<div class="card">\
                    <div class="card-horizontal">\
                    <div class="img-square-wrapper">\
                    <img class="picture-preview" src="' + val.picture + '" alt="' + val.code + '" title="' + val.code + '">\
                    </div>\
                    <div class="card-body">\
                    <h4 class="card-title">Señal: ' + val.code + '</h4>\
                    <p class="card-text">\
                    <p><strong>Dirección: </strong>' + val.google_address + '</p>\
                    <p><strong>Comentario: </strong>' + val.comment + '</p>\
                    </p>\
            </div>\
            </div>\
            </div>'
            });

            google.maps.event.addListener(marker, 'mouseover', function () {
                this['infowindow'].open(map, this);
            });

            google.maps.event.addListener(marker, 'mouseout', function () {
                this['infowindow'].close();
            });

            google.maps.event.addListener(marker, 'click', function () {
                var url = '{{ URL::to('vertical-signals/') }}' + '/' + val.id;
                $('#modal-vsignal').on('show.bs.modal', function (e) {
                    var message = 'message';

                    $(this).find('.modal-title').text('Señal vertical: ' + val.code);
                    $(this).find('.modal-body p').text(message);
                    //$(this).find('#signal-picture').attr('src', val.picture);
                    $(this).find('#signal-picture').css('background-image', 'url(' + val.picture + ')');
                    $(this).find('#signal-code').text(val.code);
                    $(this).find('#signal-group').text(val.group);
                    $(this).find('#signal-subgroup').text(val.subgroup);
                    $(this).find('#signal-lat').text(val.latitude);
                    $(this).find('#signal-lng').text(val.longitude);
                    $(this).find('#signal-address').text(val.google_address);
                    $(this).find('#signal-parish').text(val.parish);
                    $(this).find('#signal-neighborhood').text(val.neighborhood);
                    $(this).find('#signal-state').text(val.state);
                    $(this).find('#signal-material').text(val.material);
                    $(this).find('#signal-fastener').text(val.fastener);
                    $(this).find('#signal-comment').text(val.comment);

                    $(this).find('#anchor_view').attr("href", "/vertical-signals/" + val.id);
                    $(this).find('#anchor_edit').attr("href", "/vertical-signals/" + val.id + "/edit");
                });

                $('#modal-vsignal').modal('show');
            });

            markers_list.push(marker);
        }

        add_light_marker = function (val) {
            let marker = new google.maps.Marker({
                map: map,
                //icon: "",
                title: String(val.id),
                optimized: false,
                position: new google.maps.LatLng(val.latitude, val.longitude)
            });

            bounds.extend(marker.position);

            marker['infowindow'] = new google.maps.InfoWindow({
                content: '<div class="card">\
                    <div class="card-horizontal">\
                    <div class="img-square-wrapper">\
                    <img class="picture-preview" src="' + val.picture + '" alt="' + val.id + '" title="' + val.id + '">\
                    </div>\
                    <div class="card-body">\
                    <h4 class="card-title">Semáforo: ' + val.id + '</h4>\
                    <p class="card-text">\
                    <p><strong>Fabricante: </strong>' + val.brand + '</p>\
                    <p><strong>Estado: </strong>' + val.state + '</p>\
                    <p><strong>Orientación: </strong>' + val.orientation + '</p>\
                    </p>\
            </div>\
            </div>\
            </div>'
            });

            google.maps.event.addListener(marker, 'mouseover', function () {
                this['infowindow'].open(map, this);
            });

            google.maps.event.addListener(marker, 'mouseout', function () {
                this['infowindow'].close();
            });

            google.maps.event.addListener(marker, 'click', function () {
                var url = '{{ URL::to('traffic-lights/') }}' + '/' + val.id;
                $('#modal-light').on('show.bs.modal', function (e) {
                    var message = 'message';

                    $(this).find('.modal-title').text('Semáforo: ' + val.id);
                    $(this).find('.modal-body p').text(message);
                    //$(this).find('#light-picture').attr('src', val.picture);
                    $(this).find('#light-picture').css('background-image', 'url(' + val.picture + ')');
                    $(this).find('#light-id').text(val.id);
                    $(this).find('#light-code').text(val.code);
                    $(this).find('#light-intersection').text(val.intersection);
                    $(this).find('#light-tensor').text(val.tensor);
                    $(this).find('#light-pole').text(val.pole);
                    $(this).find('#light-regulator').text(val.regulator);
                    $(this).find('#light-brand').text(val.brand);
                    $(this).find('#light-model').text(val.model);
                    $(this).find('#light-state').text(val.state);
                    $(this).find('#light-fastener').text(val.fastener);
                    $(this).find('#light-comment').text(val.comment);

                    $(this).find('#anchor_view').attr("href", "/traffic-lights/" + val.id);
                    $(this).find('#anchor_edit').attr("href", "/traffic-lights/" + val.id + "/edit");
                });

                $('#modal-light').modal('show');
            });

            markers_list.push(marker);
        }

        add_regulator_marker = function (val) {
            let marker = new google.maps.Marker({
                map: map,
                //icon: "",
                title: String(val.id),
                optimized: false,
                position: new google.maps.LatLng(val.latitude, val.longitude)
            });

            bounds.extend(marker.position);

            marker['infowindow'] = new google.maps.InfoWindow({
                content: '<div class="card">\
                    <div class="card-horizontal">\
                    <div class="img-square-wrapper">\
                    <img class="picture-preview" src="' + val.picture_in + '" alt="' + val.id + '" title="' + val.id + '">\
                    </div>\
                    <div class="card-body">\
                    <h4 class="card-title">Reguladora: ' + val.id + '</h4>\
                    <p class="card-text">\
                    <p><strong>Fabricante: </strong>' + val.brand + '</p>\
                    <p><strong>Estado: </strong>' + val.state + '</p>\
                    </p>\
            </div>\
            </div>\
            </div>'
            });

            google.maps.event.addListener(marker, 'mouseover', function () {
                this['infowindow'].open(map, this);
            });

            google.maps.event.addListener(marker, 'mouseout', function () {
                this['infowindow'].close();
            });

            google.maps.event.addListener(marker, 'click', function () {
                var url = '{{ URL::to('regulator-boxes/') }}' + '/' + val.id;
                $('#modal-regulator').on('show.bs.modal', function (e) {
                    var message = 'message';

                    $(this).find('.modal-title').text('Reguladora: ' + val.id);
                    $(this).find('.modal-body p').text(message);
                    //$(this).find('#light-picture').attr('src', val.picture);
                    $(this).find('#regulator-picture').css('background-image', 'url(' + val.picture_in + ')');
                    $(this).find('#regulator-id').text(val.id);
                    $(this).find('#regulator-code').text(val.code);
                    $(this).find('#regulator-intersection').text(val.intersection);
                    $(this).find('#light-brand').text(val.brand);
                    $(this).find('#light-state').text(val.state);
                    $(this).find('#light-comment').text(val.comment);

                    $(this).find('#anchor_view').attr("href", "/regulator-boxes/" + val.id);
                    $(this).find('#anchor_edit').attr("href", "/regulator-boxes/" + val.id + "/edit");
                });

                $('#modal-regulator').modal('show');
            });

            markers_list.push(marker);
        }

        disable_selectizes = function () {
            $('.tab-pane.show form select').each(function () {
                this.selectize.disable();
            });
        };

        enable_selectizes = function () {
            $('.tab-pane.show form select').each(function () {
                this.selectize.enable();
            });
        };

        filter_reset.click(function (event) {
            event.preventDefault();

            $('.tab-pane.show form select').each(function () {
                this.selectize.clear();
            });
            clear_data();
        });
    });
</script>
