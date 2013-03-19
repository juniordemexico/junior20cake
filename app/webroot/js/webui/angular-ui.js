/**
 * AngularUI - The companion suite for AngularJS
 * @version v0.4.0 - 2013-03-19
 * @link http://angular-ui.github.com
 * @license MIT License, http://www.opensource.org/licenses/MIT
 */


angular.module('ui.config', []).value('ui.config', {});
angular.module('ui.filters', ['ui.config']);
angular.module('ui.directives', ['ui.config']);
angular.module('ui', ['ui.filters', 'ui.directives', 'ui.config']);

/**
 * Animates the injection of new DOM elements by simply creating the DOM with a class and then immediately removing it
 * Animations must be done using CSS3 transitions, but provide excellent flexibility
 *
 * @todo Add proper support for animating out
 * @param [options] {mixed} Can be an object with multiple options, or a string with the animation class
 *    class {string} the CSS class(es) to use. For example, 'ui-hide' might be an excellent alternative class.
 * @example <li ng-repeat="item in items" ui-animate=" 'ui-hide' ">{{item}}</li>
 */
angular.module('ui.directives').directive('uiAnimate', ['ui.config', '$timeout', function (uiConfig, $timeout) {
  var options = {};
  if (angular.isString(uiConfig.animate)) {
    options['class'] = uiConfig.animate;
  } else if (uiConfig.animate) {
    options = uiConfig.animate;
  }
  return {
    restrict: 'A', // supports using directive as element, attribute and class
    link: function ($scope, element, attrs) {
      var opts = {};
      if (attrs.uiAnimate) {
        opts = $scope.$eval(attrs.uiAnimate);
        if (angular.isString(opts)) {
          opts = {'class': opts};
        }
      }
      opts = angular.extend({'class': 'ui-animate'}, options, opts);

      element.addClass(opts['class']);
      $timeout(function () {
        element.removeClass(opts['class']);
      }, 20, false);
    }
  };
}]);


/*
 Gives the ability to style currency based on its sign.
 */
angular.module('ui.directives').directive('uiCurrency', ['ui.config', 'currencyFilter' , function (uiConfig, currencyFilter) {
  var options = {
    pos: 'ui-currency-pos',
    neg: 'ui-currency-neg',
    zero: 'ui-currency-zero'
  };
  if (uiConfig.currency) {
    angular.extend(options, uiConfig.currency);
  }
  return {
    restrict: 'EAC',
    require: 'ngModel',
    link: function (scope, element, attrs, controller) {
      var opts, // instance-specific options
        renderview,
        value;

      opts = angular.extend({}, options, scope.$eval(attrs.uiCurrency));

      renderview = function (viewvalue) {
        var num;
        num = viewvalue * 1;
        element.toggleClass(opts.pos, (num > 0) );
        element.toggleClass(opts.neg, (num < 0) );
        element.toggleClass(opts.zero, (num === 0) );
        if (viewvalue === '') {
          element.text('');
        } else {
          element.text(currencyFilter(num, opts.symbol));
        }
        return true;
      };

      controller.$render = function () {
        value = controller.$viewValue;
        element.val(value);
        renderview(value);
      };

    }
  };
}]);

/**
 * General-purpose Event binding. Bind any event not natively supported by Angular
 * Pass an object with keynames for events to ui-event
 * Allows $event object and $params object to be passed
 *
 * @example <input ui-event="{ focus : 'counter++', blur : 'someCallback()' }">
 * @example <input ui-event="{ myCustomEvent : 'myEventHandler($event, $params)'}">
 *
 * @param ui-event {string|object literal} The event to bind to as a string or a hash of events with their callbacks
 */
angular.module('ui.directives').directive('uiEvent', ['$parse',
  function ($parse) {
    return function (scope, elm, attrs) {
      var events = scope.$eval(attrs.uiEvent);
      angular.forEach(events, function (uiEvent, eventName) {
        var fn = $parse(uiEvent);
        elm.bind(eventName, function (evt) {
          var params = Array.prototype.slice.call(arguments);
          //Take out first paramater (event object);
          params = params.splice(1);
          scope.$apply(function () {
            fn(scope, {$event: evt, $params: params});
          });
        });
      });
    };
  }]);

/*
 * Defines the ui-if tag. This removes/adds an element from the dom depending on a condition
 * Originally created by @tigbro, for the @jquery-mobile-angular-adapter
 * https://github.com/tigbro/jquery-mobile-angular-adapter
 */
angular.module('ui.directives').directive('uiIf', [function () {
  return {
    transclude: 'element',
    priority: 1000,
    terminal: true,
    restrict: 'A',
    compile: function (element, attr, transclude) {
      return function (scope, element, attr) {

        var childElement;
        var childScope;
 
        scope.$watch(attr['uiIf'], function (newValue) {
          if (childElement) {
            childElement.remove();
            childElement = undefined;
          }
          if (childScope) {
            childScope.$destroy();
            childScope = undefined;
          }

          if (newValue) {
            childScope = scope.$new();
            transclude(childScope, function (clone) {
              childElement = clone;
              element.after(clone);
            });
          }
        });
      };
    }
  };
}]);
/**
 * General-purpose jQuery wrapper. Simply pass the plugin name as the expression.
 *
 * It is possible to specify a default set of parameters for each jQuery plugin.
 * Under the jq key, namespace each plugin by that which will be passed to ui-jq.
 * Unfortunately, at this time you can only pre-define the first parameter.
 * @example { jq : { datepicker : { showOn:'click' } } }
 *
 * @param ui-jq {string} The $elm.[pluginName]() to call.
 * @param [ui-options] {mixed} Expression to be evaluated and passed as options to the function
 *     Multiple parameters can be separated by commas
 * @param [ui-refresh] {expression} Watch expression and refire plugin on changes
 *
 * @example <input ui-jq="datepicker" ui-options="{showOn:'click'},secondParameter,thirdParameter" ui-refresh="iChange">
 */
angular.module('ui.directives').directive('uiJq', ['ui.config', '$timeout', function uiJqInjectingFunction(uiConfig, $timeout) {

  return {
    restrict: 'A',
    compile: function uiJqCompilingFunction(tElm, tAttrs) {

      if (!angular.isFunction(tElm[tAttrs.uiJq])) {
        throw new Error('ui-jq: The "' + tAttrs.uiJq + '" function does not exist');
      }
      var options = uiConfig.jq && uiConfig.jq[tAttrs.uiJq];

      return function uiJqLinkingFunction(scope, elm, attrs) {

        var linkOptions = [];

        // If ui-options are passed, merge (or override) them onto global defaults and pass to the jQuery method
        if (attrs.uiOptions) {
          linkOptions = scope.$eval('[' + attrs.uiOptions + ']');
          if (angular.isObject(options) && angular.isObject(linkOptions[0])) {
            linkOptions[0] = angular.extend({}, options, linkOptions[0]);
          }
        } else if (options) {
          linkOptions = [options];
        }
        // If change compatibility is enabled, the form input's "change" event will trigger an "input" event
        if (attrs.ngModel && elm.is('select,input,textarea')) {
          elm.on('change', function() {
            elm.trigger('input');
          });
        }

        // Call jQuery method and pass relevant options
        function callPlugin() {
          $timeout(function() {
            elm[attrs.uiJq].apply(elm, linkOptions);
          }, 0, false);
        }

        // If ui-refresh is used, re-fire the the method upon every change
        if (attrs.uiRefresh) {
          scope.$watch(attrs.uiRefresh, function(newVal) {
            callPlugin();
          });
        }
        callPlugin();
      };
    }
  };
}]);

angular.module('ui.directives').factory('keypressHelper', ['$parse', function keypress($parse){
  var keysByCode = {
    8: 'backspace',
    9: 'tab',
    13: 'enter',
    27: 'esc',
    32: 'space',
    33: 'pageup',
    34: 'pagedown',
    35: 'end',
    36: 'home',
    37: 'left',
    38: 'up',
    39: 'right',
    40: 'down',
    45: 'insert',
    46: 'delete'
  };

  var capitaliseFirstLetter = function (string) {
    return string.charAt(0).toUpperCase() + string.slice(1);
  };

  return function(mode, scope, elm, attrs) {
    var params, combinations = [];
    params = scope.$eval(attrs['ui'+capitaliseFirstLetter(mode)]);

    // Prepare combinations for simple checking
    angular.forEach(params, function (v, k) {
      var combination, expression;
      expression = $parse(v);

      angular.forEach(k.split(' '), function(variation) {
        combination = {
          expression: expression,
          keys: {}
        };
        angular.forEach(variation.split('-'), function (value) {
          combination.keys[value] = true;
        });
        combinations.push(combination);
      });
    });

    // Check only matching of pressed keys one of the conditions
    elm.bind(mode, function (event) {
      // No need to do that inside the cycle
      var altPressed = !!(event.metaKey || event.altKey);
      var ctrlPressed = !!event.ctrlKey;
      var shiftPressed = !!event.shiftKey;
      var keyCode = event.keyCode;

      // normalize keycodes
      if (mode === 'keypress' && !shiftPressed && keyCode >= 97 && keyCode <= 122) {
        keyCode = keyCode - 32;
      }

      // Iterate over prepared combinations
      angular.forEach(combinations, function (combination) {

        var mainKeyPressed = combination.keys[keysByCode[event.keyCode]] || combination.keys[event.keyCode.toString()];

        var altRequired = !!combination.keys.alt;
        var ctrlRequired = !!combination.keys.ctrl;
        var shiftRequired = !!combination.keys.shift;

        if (
          mainKeyPressed &&
          ( altRequired == altPressed ) &&
          ( ctrlRequired == ctrlPressed ) &&
          ( shiftRequired == shiftPressed )
        ) {
          // Run the function
          scope.$apply(function () {
            combination.expression(scope, { '$event': event });
          });
        }
      });
    });
  };
}]);

/**
 * Bind one or more handlers to particular keys or their combination
 * @param hash {mixed} keyBindings Can be an object or string where keybinding expression of keys or keys combinations and AngularJS Exspressions are set. Object syntax: "{ keys1: expression1 [, keys2: expression2 [ , ... ]]}". String syntax: ""expression1 on keys1 [ and expression2 on keys2 [ and ... ]]"". Expression is an AngularJS Expression, and key(s) are dash-separated combinations of keys and modifiers (one or many, if any. Order does not matter). Supported modifiers are 'ctrl', 'shift', 'alt' and key can be used either via its keyCode (13 for Return) or name. Named keys are 'backspace', 'tab', 'enter', 'esc', 'space', 'pageup', 'pagedown', 'end', 'home', 'left', 'up', 'right', 'down', 'insert', 'delete'.
 * @example <input ui-keypress="{enter:'x = 1', 'ctrl-shift-space':'foo()', 'shift-13':'bar()'}" /> <input ui-keypress="foo = 2 on ctrl-13 and bar('hello') on shift-esc" />
 **/
angular.module('ui.directives').directive('uiKeydown', ['keypressHelper', function(keypressHelper){
  return {
    link: function (scope, elm, attrs) {
      keypressHelper('keydown', scope, elm, attrs);
    }
  };
}]);

angular.module('ui.directives').directive('uiKeypress', ['keypressHelper', function(keypressHelper){
  return {
    link: function (scope, elm, attrs) {
      keypressHelper('keypress', scope, elm, attrs);
    }
  };
}]);

angular.module('ui.directives').directive('uiKeyup', ['keypressHelper', function(keypressHelper){
  return {
    link: function (scope, elm, attrs) {
      keypressHelper('keyup', scope, elm, attrs);
    }
  };
}]);
/*
 Attaches input mask onto input element
 */
angular.module('ui.directives').directive('uiMask', [
  function () {
    var maskDefinitions = {
      '9': /\d/,
      'A': /[a-zA-Z]/,
      '*': /[a-zA-Z0-9]/
    };
    return {
      priority: 100,
      require: 'ngModel',
      restrict: 'A',
      link: function (scope, iElement, iAttrs, controller) {
        var maskProcessed = false, eventsBound = false,
            maskCaretMap, maskPatterns, maskPlaceholder,
            value, valueMasked, isValid,
            // Vars for initializing/uninitializing
            originalPlaceholder = iAttrs.placeholder,
            originalMaxlength   = iAttrs.maxlength,
            // Vars used exclusively in eventHandler()
            oldValue, oldValueUnmasked, oldCaretPosition, oldSelectionLength;

        iAttrs.$observe('uiMask', initialize);
        controller.$formatters.push(formatter);
        controller.$parsers.push(parser);

        function initialize(maskAttr) {
          if (!angular.isDefined(maskAttr))
            return uninitialize();
          processRawMask(maskAttr);
          if (!maskProcessed)
            return uninitialize();
          initializeElement();
          bindEventListeners();
        }

        function uninitialize() {
          maskProcessed = false;
          unbindEventListeners();

          if (angular.isDefined(originalPlaceholder))
            iElement.attr('placeholder', originalPlaceholder);
          else
            iElement.removeAttr('placeholder');

          if (angular.isDefined(originalMaxlength))
            iElement.attr('maxlength', originalMaxlength);
          else
            iElement.removeAttr('maxlength');

          iElement.val(controller.$modelValue);
          controller.$viewValue = controller.$modelValue;
          return false;
        }

        function initializeElement() {
          value       = oldValueUnmasked = unmaskValue(controller.$modelValue || '');
          valueMasked = oldValue         = maskValue(value);
          isValid     = validateValue(value);
          viewValue   = isValid && value.length ? valueMasked : '';
          if (iAttrs.maxlength) // Double maxlength to allow pasting new val at end of mask
            iElement.attr('maxlength', maskCaretMap[maskCaretMap.length-1]*2);
          iElement.attr('placeholder', maskPlaceholder);
          iElement.val(viewValue);
          controller.$viewValue = viewValue;
          // Not using $setViewValue so we don't clobber the model value and dirty the form
          // without any kind of user interaction.
        }

        function bindEventListeners() {
          if (eventsBound)
            return true;
          iElement.bind('blur',              blurHandler);
          iElement.bind('mousedown mouseup', mouseDownUpHandler);
          iElement.bind('input keyup click', eventHandler);
          eventsBound = true;
        }

        function unbindEventListeners() {
          if (!eventsBound)
            return true;
          iElement.unbind('blur',      blurHandler);
          iElement.unbind('mousedown', mouseDownUpHandler);
          iElement.unbind('mouseup',   mouseDownUpHandler);
          iElement.unbind('input',     eventHandler);
          iElement.unbind('keyup',     eventHandler);
          iElement.unbind('click',     eventHandler);
          eventsBound = false;
        }

        function formatter(fromModelValue) {
          if (!maskProcessed)
            return fromModelValue;
          value   = unmaskValue(fromModelValue || '');
          isValid = validateValue(value);
          controller.$setValidity('mask', isValid);
          return isValid ? maskValue(value) : undefined;
        }

        function parser(fromViewValue) {
          if (!maskProcessed)
            return fromViewValue;
          value     = unmaskValue(fromViewValue || '');
          isValid   = validateValue(value);
          viewValue = value.length ? maskValue(value) : '';
          // We have to set viewValue manually as the reformatting of the input
          // value performed by eventHandler() doesn't happen until after
          // this parser is called, which causes what the user sees in the input
          // to be out-of-sync with what the controller's $viewValue is set to.
          controller.$viewValue = viewValue;
          controller.$setValidity('mask', isValid);
          if (value === '' && controller.$error.required !== undefined)
            controller.$setValidity('required', false);
          return isValid ? value : undefined;
        }

        function validateValue(value) {
          // Zero-length value validity is ngRequired's determination
          return value.length ? value.length === maskCaretMap.length - 1 : true;
        }

        function unmaskValue(value) {
          var valueUnmasked    = '',
              maskPatternCopys = maskPatterns.slice();
          angular.forEach(value.toString().split(''), function(chr, i) {
            if (maskPatternCopys.length && maskPatternCopys[0].test(chr)) {
              valueUnmasked += chr;
              maskPatternCopys.shift();
            }
          });
          return valueUnmasked;
        }

        function maskValue(unmaskedValue) {
          var valueMasked      = '',
              maskCaretMapCopy = maskCaretMap.slice();
          angular.forEach(maskPlaceholder.split(''), function(chr, i) {
            if (unmaskedValue.length && i === maskCaretMapCopy[0]) {
              valueMasked  += unmaskedValue.charAt(0) || '_';
              unmaskedValue = unmaskedValue.substr(1);
              maskCaretMapCopy.shift(); }
            else
              valueMasked += chr;
          });
          return valueMasked;
        }

        function processRawMask(mask) {
          var characterCount = 0;
          maskCaretMap       = [];
          maskPatterns       = [];
          maskPlaceholder    = '';

          // If mask is an array, it's a complex mask!
          if (mask instanceof Array) {
            angular.forEach(mask, function(item, i) {
              if (item instanceof RegExp) {
                maskCaretMap.push(characterCount++);
                maskPlaceholder += '_';
                maskPatterns.push(item);
              }
              else if (typeof item == 'string') {
                angular.forEach(item.split(''), function(chr, i) {
                  maskPlaceholder += chr;
                  characterCount++;
                });
              }
            });
          }
          // Otherwise it's a simple mask
          else if (typeof mask === 'string') {
            angular.forEach(mask.split(''), function(chr, i) {
              if (maskDefinitions[chr]) {
                maskCaretMap.push(characterCount);
                maskPlaceholder += '_';
                maskPatterns.push(maskDefinitions[chr]);
              }
              else
                maskPlaceholder += chr;
              characterCount++;
            });
          }
          // Caret position immediately following last position is valid.
          maskCaretMap.push(maskCaretMap.slice().pop() + 1);
          maskProcessed = maskCaretMap.length > 1 ? true : false;
        }

        function blurHandler(e) {
          oldCaretPosition   = 0;
          oldSelectionLength = 0;
          if (!isValid || value.length === 0) {
            valueMasked = '';
            iElement.val('');
            scope.$apply(function() {
              controller.$setViewValue('');
            });
          }
        }

        iElement.bind('mousedown mouseup', mouseDownUpHandler);

        function mouseoutHandler(e) {
          oldSelectionLength = getSelectionLength(this);
          iElement.unbind('mouseout', mouseoutHandler);
        }

        function mouseDownUpHandler(e) {
          if (e.type === 'mousedown')
            iElement.bind('mouseout', mouseoutHandler);
          else
            iElement.unbind('mouseout', mouseoutHandler);
        }

        function eventHandler(e) {
          e = e || { which:0, type:'input' };
          // Allows more efficient minification
          var eventWhich = e.which,
              eventType  = e.type;

          // Prevent shift and ctrl from mucking with old values
          if (eventWhich == 16 || eventWhich == 91) return true;

          var elem            = iElement,
              val             = elem.val(),
              valOld          = oldValue,
              valMasked,
              valUnmasked     = unmaskValue(val),
              valUnmaskedOld  = oldValueUnmasked,
              valAltered      = false,

              caretPos        = getCaretPosition(this) || 0,
              caretPosOld     = oldCaretPosition || 0,
              caretPosDelta   = caretPos - caretPosOld,
              caretPosMin     = maskCaretMap[0],
              caretPosMax     = maskCaretMap[valUnmasked.length] || maskCaretMap.slice().shift(),

              selectionLen    = getSelectionLength(this),
              selectionLenOld = oldSelectionLength || 0,
              isSelected      = selectionLen > 0,
              wasSelected     = selectionLenOld > 0,

                                                                // Case: Typing a character to overwrite a selection
              isAddition      = (val.length > valOld.length) || (selectionLenOld && val.length >  valOld.length - selectionLenOld),
                                                                // Case: Delete and backspace behave identically on a selection
              isDeletion      = (val.length < valOld.length) || (selectionLenOld && val.length == valOld.length - selectionLenOld),
              isSelection     = (eventWhich >= 37 && eventWhich <= 40) && e.shiftKey, // Arrow key codes

              isKeyLeftArrow  = eventWhich == 37,
                                                    // Necessary due to "input" event not providing a key code
              isKeyBackspace  = eventWhich == 8  || (eventType != 'keyup' && isDeletion && (caretPosDelta === -1)),
              isKeyDelete     = eventWhich == 46 || (eventType != 'keyup' && isDeletion && (caretPosDelta === 0 ) && !wasSelected),

              // Handles cases where caret is moved and placed in front of invalid maskCaretMap position. Logic below
              // ensures that, on click or leftward caret placement, caret is moved leftward until directly right of
              // non-mask character. Also applied to click since users are (arguably) more likely to backspace
              // a character when clicking within a filled input.
              caretBumpBack   = (isKeyLeftArrow || isKeyBackspace || eventType == 'click') && caretPos > caretPosMin;

          oldSelectionLength  = selectionLen;

          // These events don't require any action
          if (isSelection || (isSelected && (eventType == 'click' || eventType == 'keyup')))
            return true;

          // Value Handling
          // ==============

          // User attempted to delete but raw value was unaffected--correct this grievous offense
          if ((eventType == 'input' || eventType == 'propertychange') && isDeletion && !wasSelected && valUnmasked === valUnmaskedOld) {
            while (isKeyBackspace && caretPos > 0 && !isValidCaretPosition(caretPos))
              caretPos--;
            while (isKeyDelete && caretPos < maskPlaceholder.length && maskCaretMap.indexOf(caretPos) == -1)
              caretPos++;
            var charIndex = maskCaretMap.indexOf(caretPos);
            // Strip out non-mask character that user would have deleted if mask hadn't been in the way.
            valUnmasked = valUnmasked.substring(0, charIndex) + valUnmasked.substring(charIndex + 1);
            valAltered  = true;
          }

          // Update values
          valMasked        = maskValue(valUnmasked);
          oldValue         = valMasked;
          oldValueUnmasked = valUnmasked;
          elem.val(valMasked);
          if (valAltered) {
            // We've altered the raw value after it's been $digest'ed, we need to $apply the new value.
            scope.$apply(function() {
              controller.$setViewValue(valUnmasked);
            });
          }

          // Caret Repositioning
          // ===================

          // Ensure that typing always places caret ahead of typed character in cases where the first char of
          // the input is a mask char and the caret is placed at the 0 position.
          if (isAddition && (caretPos <= caretPosMin))
            caretPos = caretPosMin + 1;

          if (caretBumpBack)
            caretPos--;

          // Make sure caret is within min and max position limits
          caretPos = caretPos > caretPosMax ? caretPosMax : caretPos < caretPosMin ? caretPosMin : caretPos;

          // Scoot the caret back or forth until it's in a non-mask position and within min/max position limits
          while (!isValidCaretPosition(caretPos) && caretPos > caretPosMin && caretPos < caretPosMax)
            caretPos += caretBumpBack ? -1 : 1;

          if ((caretBumpBack && caretPos < caretPosMax) || (isAddition && !isValidCaretPosition(caretPosOld)))
            caretPos++;
          oldCaretPosition = caretPos;
          setCaretPosition(this, caretPos);
        }

        function isValidCaretPosition(pos) { return maskCaretMap.indexOf(pos) > -1; }

        function getCaretPosition(input) {
          if (input.selectionStart !== undefined)
            return input.selectionStart;
          else if (document.selection) {
            // Curse you IE
            input.focus();
            var selection = document.selection.createRange();
            selection.moveStart('character', -input.value.length);
            return selection.text.length;
          }
        }

        function setCaretPosition(input, pos) {
          if (input.offsetWidth === 0 || input.offsetHeight === 0)
            return true; // Input's hidden
          if (input.setSelectionRange) {
            input.focus();
            input.setSelectionRange(pos,pos); }
          else if (input.createTextRange) {
            // Curse you IE
            var range = input.createTextRange();
            range.collapse(true);
            range.moveEnd('character', pos);
            range.moveStart('character', pos);
            range.select();
          }
        }

        function getSelectionLength(input) {
          if (input.selectionStart !== undefined)
            return (input.selectionEnd - input.selectionStart);
          if (document.selection)
            return (document.selection.createRange().text.length);
        }

        // https://developer.mozilla.org/en-US/docs/JavaScript/Reference/Global_Objects/Array/indexOf
        if (!Array.prototype.indexOf) {
          Array.prototype.indexOf = function (searchElement /*, fromIndex */ ) {
            "use strict";
            if (this === null) {
              throw new TypeError();
            }
            var t = Object(this);
            var len = t.length >>> 0;
            if (len === 0) {
              return -1;
            }
            var n = 0;
            if (arguments.length > 1) {
              n = Number(arguments[1]);
              if (n != n) { // shortcut for verifying if it's NaN
                n = 0;
              } else if (n !== 0 && n !== Infinity && n !== -Infinity) {
                n = (n > 0 || -1) * Math.floor(Math.abs(n));
              }
            }
            if (n >= len) {
              return -1;
            }
            var k = n >= 0 ? n : Math.max(len - Math.abs(n), 0);
            for (; k < len; k++) {
              if (k in t && t[k] === searchElement) {
                return k;
              }
            }
            return -1;
          };
        }

      }
    };
  }
]);
/**
 * Add a clear button to form inputs to reset their value
 */
angular.module('ui.directives').directive('uiReset', ['ui.config', function (uiConfig) {
  var resetValue = null;
  if (uiConfig.reset !== undefined)
      resetValue = uiConfig.reset;
  return {
    require: 'ngModel',
    link: function (scope, elm, attrs, ctrl) {
      var aElement;
      aElement = angular.element('<a class="ui-reset" />');
      elm.wrap('<span class="ui-resetwrap" />').after(aElement);
      aElement.bind('click', function (e) {
        e.preventDefault();
        scope.$apply(function () {
          if (attrs.uiReset)
            ctrl.$setViewValue(scope.$eval(attrs.uiReset));
          else
            ctrl.$setViewValue(resetValue);
          ctrl.$render();
        });
      });
    }
  };
}]);

/**
 * uiShow Directive
 *
 * Adds a 'ui-show' class to the element instead of display:block
 * Created to allow tighter control  of CSS without bulkier directives
 *
 * @param expression {boolean} evaluated expression to determine if the class should be added
 */
angular.module('ui.directives').directive('uiShow', [function () {
  return function (scope, elm, attrs) {
    scope.$watch(attrs.uiShow, function (newVal, oldVal) {
      if (newVal) {
        elm.addClass('ui-show');
      } else {
        elm.removeClass('ui-show');
      }
    });
  };
}])

/**
 * uiHide Directive
 *
 * Adds a 'ui-hide' class to the element instead of display:block
 * Created to allow tighter control  of CSS without bulkier directives
 *
 * @param expression {boolean} evaluated expression to determine if the class should be added
 */
  .directive('uiHide', [function () {
  return function (scope, elm, attrs) {
    scope.$watch(attrs.uiHide, function (newVal, oldVal) {
      if (newVal) {
        elm.addClass('ui-hide');
      } else {
        elm.removeClass('ui-hide');
      }
    });
  };
}])

/**
 * uiToggle Directive
 *
 * Adds a class 'ui-show' if true, and a 'ui-hide' if false to the element instead of display:block/display:none
 * Created to allow tighter control  of CSS without bulkier directives. This also allows you to override the
 * default visibility of the element using either class.
 *
 * @param expression {boolean} evaluated expression to determine if the class should be added
 */
  .directive('uiToggle', [function () {
  return function (scope, elm, attrs) {
    scope.$watch(attrs.uiToggle, function (newVal, oldVal) {
      if (newVal) {
        elm.removeClass('ui-hide').addClass('ui-show');
      } else {
        elm.removeClass('ui-show').addClass('ui-hide');
      }
    });
  };
}]);

/**
 * General-purpose validator for ngModel.
 * angular.js comes with several built-in validation mechanism for input fields (ngRequired, ngPattern etc.) but using
 * an arbitrary validation function requires creation of a custom formatters and / or parsers.
 * The ui-validate directive makes it easy to use any function(s) defined in scope as a validator function(s).
 * A validator function will trigger validation on both model and input changes.
 *
 * @example <input ui-validate=" 'myValidatorFunction($value)' ">
 * @example <input ui-validate="{ foo : '$value > anotherModel', bar : 'validateFoo($value)' }">
 * @example <input ui-validate="{ foo : '$value > anotherModel' }" ui-validate-watch=" 'anotherModel' ">
 * @example <input ui-validate="{ foo : '$value > anotherModel', bar : 'validateFoo($value)' }" ui-validate-watch=" { foo : 'anotherModel' } ">
 *
 * @param ui-validate {string|object literal} If strings is passed it should be a scope's function to be used as a validator.
 * If an object literal is passed a key denotes a validation error key while a value should be a validator function.
 * In both cases validator function should take a value to validate as its argument and should return true/false indicating a validation result.
 */
angular.module('ui.directives').directive('uiValidate', function () {

  return {
    restrict: 'A',
    require: 'ngModel',
    link: function (scope, elm, attrs, ctrl) {
      var validateFn, watch, validators = {},
        validateExpr = scope.$eval(attrs.uiValidate);

      if (!validateExpr) return;

      if (angular.isString(validateExpr)) {
        validateExpr = { validator: validateExpr };
      }

      angular.forEach(validateExpr, function (expression, key) {
        validateFn = function (valueToValidate) {
          if (scope.$eval(expression, { '$value' : valueToValidate })) {
            ctrl.$setValidity(key, true);
            return valueToValidate;
          } else {
            ctrl.$setValidity(key, false);
            return undefined;
          }
        };
        validators[key] = validateFn;
        ctrl.$formatters.push(validateFn);
        ctrl.$parsers.push(validateFn);
      });

      // Support for ui-validate-watch
      if (attrs.uiValidateWatch) {
        watch = scope.$eval(attrs.uiValidateWatch);
        if (angular.isString(watch)) {
          scope.$watch(watch, function(){
            angular.forEach(validators, function(validatorFn, key){
              validatorFn(ctrl.$modelValue);
            });
          });
        } else {
          angular.forEach(watch, function(expression, key){
            scope.$watch(expression, function(){
              validators[key](ctrl.$modelValue);
            });
          });
        }
      }
    }
  };
});
