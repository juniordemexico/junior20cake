/* =============================================================
 * bootstrap-typeahead.js v2.0.0
 * http://twitter.github.com/bootstrap/javascript.html#typeahead
 * =============================================================
 * Copyright 2012 Twitter, Inc.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 * ============================================================ */

!function( $ ){

  "use strict"

  var Typeahead = function ( element, options ) {
    this.$element = $(element)
    this.options = $.extend({}, $.fn.typeahead.defaults, options)
    this.matcher = this.options.matcher || this.matcher
    this.sorter = this.options.sorter || this.sorter
    this.highlighter = this.options.highlighter || this.highlighter
    this.$menu = $(this.options.menu).appendTo('body')
    this.source = this.options.source
    this.onselect = this.options.onselect
    this.strings = true
    this.shown = false
    this.listen()
  }

  Typeahead.prototype = {

    constructor: Typeahead

  , select: function () {
      var val = JSON.parse(this.$menu.find('.active').attr('data-value'))
        , text

      if (!this.strings) text = val[this.options.property]
      else text = val

      this.$element.val(text)

      if (typeof this.onselect == "function")
          this.onselect(val)

      return this.hide()
    }

  , show: function () {
      var pos = $.extend({}, this.$element.offset(), {
        height: this.$element[0].offsetHeight
      })

      this.$menu.css({
        top: pos.top + pos.height
      , left: pos.left
      })

      this.$menu.show()
      this.shown = true
      return this
    }

  , hide: function () {
      this.$menu.hide()
      this.shown = false
      return this
    }

  , lookup: function (event) {
      var that = this
        , items
        , q
        , value

      this.query = this.$element.val()

      if (typeof this.source == "function") {
        value = this.source(this, this.query)
        if (value) this.process(value)
      } else {
        this.process(this.source)
      }
    }

  , process: function (results) {
      var that = this
        , items
        , q

      if (results.length && typeof results[0] != "string")
          this.strings = false

      this.query = this.$element.val()

      if (!this.query) {
        return this.shown ? this.hide() : this
      }

      items = $.grep(results, function (item) {
        if (!that.strings)
          item = item[that.options.property]
        if (that.matcher(item)) return item
      })

      items = this.sorter(items)

      if (!items.length) {
        return this.shown ? this.hide() : this
      }

      return this.render(items.slice(0, this.options.items)).show()
    }

  , matcher: function (item) {
      return ~item.toLowerCase().indexOf(this.query.toLowerCase())
    }

  , sorter: function (items) {
      var beginswith = []
        , caseSensitive = []
        , caseInsensitive = []
        , item
        , sortby

      while (item = items.shift()) {
        if (this.strings) sortby = item
        else sortby = item[this.options.property]

        if (!sortby.toLowerCase().indexOf(this.query.toLowerCase())) beginswith.push(item)
        else if (~sortby.indexOf(this.query)) caseSensitive.push(item)
        else caseInsensitive.push(item)
      }

      return beginswith.concat(caseSensitive, caseInsensitive)
    }

  , highlighter: function (item) {
      return item.replace(new RegExp('(' + this.query + ')', 'ig'), function ($1, match) {
        return '<strong>' + match + '</strong>'
      })
    }

  , render: function (items) {
      var that = this

      items = $(items).map(function (i, item) {
        i = $(that.options.item).attr('data-value', JSON.stringify(item))
        if (!that.strings)
            item = item[that.options.property]
        i.find('a').html(that.highlighter(item))
        return i[0]
      })

      items.first().addClass('active')
      this.$menu.html(items)
      return this
    }

  , next: function (event) {
      var active = this.$menu.find('.active').removeClass('active')
        , next = active.next()

      if (!next.length) {
        next = $(this.$menu.find('li')[0])
      }

      next.addClass('active')
    }

  , prev: function (event) {
      var active = this.$menu.find('.active').removeClass('active')
        , prev = active.prev()

      if (!prev.length) {
        prev = this.$menu.find('li').last()
      }

      prev.addClass('active')
    }

  , listen: function () {
      this.$element
        .on('blur',     $.proxy(this.blur, this))
        .on('keypress', $.proxy(this.keypress, this))
        .on('keyup',    $.proxy(this.keyup, this))

      if ($.browser.webkit || $.browser.msie) {
        this.$element.on('keydown', $.proxy(this.keypress, this))
      }

      this.$menu
        .on('click', $.proxy(this.click, this))
        .on('mouseenter', 'li', $.proxy(this.mouseenter, this))
    }

  , keyup: function (e) {
      e.stopPropagation()
      e.preventDefault()

      switch(e.keyCode) {
        case 40: // down arrow
        case 38: // up arrow
          break

        case 9: // tab
        case 13: // enter
          if (!this.shown) return
          this.select()
          break

        case 27: // escape
          this.hide()
          break

        default:
          this.lookup()
      }

  }

  , keypress: function (e) {
      e.stopPropagation()
      if (!this.shown) return

      switch(e.keyCode) {
        case 9: // tab
        case 13: // enter
        case 27: // escape
          e.preventDefault()
          break

        case 38: // up arrow
          e.preventDefault()
          this.prev()
          break

        case 40: // down arrow
          e.preventDefault()
          this.next()
          break
      }
    }

  , blur: function (e) {
      var that = this
      e.stopPropagation()
      e.preventDefault()
      setTimeout(function () { that.hide() }, 150)
    }

  , click: function (e) {
      e.stopPropagation()
      e.preventDefault()
      this.select()
    }

  , mouseenter: function (e) {
      this.$menu.find('.active').removeClass('active')
      $(e.currentTarget).addClass('active')
    }

  }


  /* TYPEAHEAD PLUGIN DEFINITION
   * =========================== */

  $.fn.typeahead = function ( option ) {
    return this.each(function () {
      var $this = $(this)
        , data = $this.data('typeahead')
        , options = typeof option == 'object' && option
      if (!data) $this.data('typeahead', (data = new Typeahead(this, options)))
      if (typeof option == 'string') data[option]()
    })
  }

  $.fn.typeahead.defaults = {
    source: []
  , items: 8
  , menu: '<ul class="typeahead dropdown-menu"></ul>'
  , item: '<li><a href="#"></a></li>'
  , onselect: null
  , property: 'value'
  }

  $.fn.typeahead.Constructor = Typeahead


 /* TYPEAHEAD DATA-API
  * ================== */

  $(function () {
    $('body').on('focus.typeahead.data-api', '[data-provide="typeahead"]', function (e) {
      var $this = $(this)
      if ($this.data('typeahead')) return
      e.preventDefault()
      $this.typeahead($this.data())
    })
  })

}( window.jQuery );
/* =========================================================
 * bootstrap-timepicker.js
 * http://www.github.com/jdewit/bootstrap-timepicker
 * =========================================================
 * Copyright 2012
 *
 * Created By:
 * Joris de Wit @joris_dewit
 *
 * Contributions By:
 * Gilbert @mindeavor
 * Koen Punt info@koenpunt.nl
 * Nek
 * Chris Martin
 * Dominic Barnes contact@dominicbarnes.us
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 * ========================================================= */

!function($) {

    "use strict"; // jshint ;_;

    /* TIMEPICKER PUBLIC CLASS DEFINITION
     * ================================== */
    var Timepicker = function(element, options) {
        this.$element = $(element);
        this.options = $.extend({}, $.fn.timepicker.defaults, options, this.$element.data());
        this.minuteStep = this.options.minuteStep || this.minuteStep;
        this.secondStep = this.options.secondStep || this.secondStep;
        this.showMeridian = this.options.showMeridian || this.showMeridian;
        this.showSeconds = this.options.showSeconds || this.showSeconds;
        this.showInputs = this.options.showInputs || this.showInputs;
        this.disableFocus = this.options.disableFocus || this.disableFocus;
        this.template = this.options.template || this.template;
        this.modalBackdrop = this.options.modalBackdrop || this.modalBackdrop;
        this.defaultTime = this.options.defaultTime || this.defaultTime;
        this.open = false;
        this.init();
    };

    Timepicker.prototype = {

        constructor: Timepicker

        , init: function () {
            if (this.$element.parent().hasClass('input-append')) {
                this.$element.parent('.input-append').find('.add-on').on('click', $.proxy(this.showWidget, this));
                this.$element.on({
                    focus: $.proxy(this.highlightUnit, this),
                    click: $.proxy(this.highlightUnit, this),
                    keypress: $.proxy(this.elementKeypress, this),
                    blur: $.proxy(this.blurElement, this)
                });

            } else {
                if (this.template) {
                    this.$element.on({
                        focus: $.proxy(this.showWidget, this),
                        click: $.proxy(this.showWidget, this),
                        blur: $.proxy(this.blurElement, this)
                    });
                } else {
                    this.$element.on({
                        focus: $.proxy(this.highlightUnit, this),
                        click: $.proxy(this.highlightUnit, this),
                        keypress: $.proxy(this.elementKeypress, this),
                        blur: $.proxy(this.blurElement, this)
                    });
                }
            }
            

            this.$widget = $(this.getTemplate()).appendTo('body');
            
            this.$widget.on('click', $.proxy(this.widgetClick, this));

            if (this.showInputs) {
                this.$widget.find('input').on({
                    click: function() { this.select(); },
                    keypress: $.proxy(this.widgetKeypress, this),
                    change: $.proxy(this.updateFromWidgetInputs, this)
                });
            } 

            this.setDefaultTime(this.defaultTime);
        }

        , showWidget: function(e) {
            e.stopPropagation();
            e.preventDefault();

            if (this.open) {
                return;
            }

            this.$element.trigger('show');

            if (this.disableFocus) {
                this.$element.blur();
            }

            var pos = $.extend({}, this.$element.offset(), {
                height: this.$element[0].offsetHeight
            });

            this.updateFromElementVal();

            $('html')
                .trigger('click.timepicker.data-api')
                .one('click.timepicker.data-api', $.proxy(this.hideWidget, this));

            if (this.template === 'modal') {
                this.$widget.modal('show').on('hidden', $.proxy(this.hideWidget, this));
            } else {
                this.$widget.css({
                    top: pos.top + pos.height
                    , left: pos.left
                })

                if (!this.open) {
                    this.$widget.addClass('open');
                }
            }

            this.open = true;
            this.$element.trigger('shown');
        }

        , hideWidget: function(){
            this.$element.trigger('hide');
            
            if (this.template === 'modal') {
                this.$widget.modal('hide');
            } else {
                this.$widget.removeClass('open');
            }
            this.open = false;
            this.$element.trigger('hidden');
        }

        , widgetClick: function(e) {
            e.stopPropagation();
            e.preventDefault();

            var action = $(e.target).closest('a').data('action');
            if (action) {
                this[action]();
                this.update();
            }
        }

        , widgetKeypress: function(e) {
            var input = $(e.target).closest('input').attr('name');

            switch (e.keyCode) {
                case 9: //tab
                    if (this.showMeridian) {
                        if (input == 'meridian') { 
                            this.hideWidget();
                        }
                    } else {
                        if (this.showSeconds) { 
                            if (input == 'second') {
                                this.hideWidget();
                            }
                        } else {
                            if (input == 'minute') {
                                this.hideWidget();
                            }
                        }
                    }
                break;
                case 27: // escape
                    this.hideWidget();
                break;
                case 38: // up arrow
                    switch (input) {
                        case 'hour':
                            this.incrementHour();
                        break;
                        case 'minute':
                            this.incrementMinute();
                        break;
                        case 'second':
                            this.incrementSecond();
                        break;
                        case 'meridian':
                            this.toggleMeridian();
                        break;
                    }
                    this.update();
                break;
                case 40: // down arrow
                    switch (input) {
                        case 'hour':
                            this.decrementHour();
                        break;
                        case 'minute':
                            this.decrementMinute();
                        break;
                        case 'second':
                            this.decrementSecond();
                        break;
                        case 'meridian':
                            this.toggleMeridian();
                        break;
                    }
                    this.update();
                break;
            }
        }

        , elementKeypress: function(e) {
            var input = this.$element.get(0);
            switch (e.keyCode) {
                case 0: //input
                break;
                case 9: //tab
                    this.updateFromElementVal();
                    if (this.showMeridian) {
                        if (this.highlightedUnit != 'meridian') {
                            e.preventDefault();
                            this.highlightNextUnit();
                        }
                    } else {
                        if (this.showSeconds) { 
                            if (this.highlightedUnit != 'second') {
                                e.preventDefault();
                                this.highlightNextUnit();
                            }
                        } else {
                            if (this.highlightedUnit != 'minute') {
                                e.preventDefault();
                                this.highlightNextUnit();
                            }
                        }
                    }
                break;
                case 27: // escape
                    this.updateFromElementVal();
                break;
                case 37: // left arrow
                    this.updateFromElementVal();
                    this.highlightPrevUnit();
                break;
                case 38: // up arrow
                    switch (this.highlightedUnit) {
                        case 'hour':
                            this.incrementHour();
                        break;
                        case 'minute':
                            this.incrementMinute();
                        break;
                        case 'second':
                            this.incrementSecond();
                        break;
                        case 'meridian':
                            this.toggleMeridian();
                        break;
                    }
                    this.updateElement();
                break;
                case 39: // right arrow
                    this.updateFromElementVal();
                    this.highlightNextUnit();
                break;
                case 40: // down arrow
                    switch (this.highlightedUnit) {
                        case 'hour':
                            this.decrementHour();
                        break;
                        case 'minute':
                            this.decrementMinute();
                        break;
                        case 'second':
                            this.decrementSecond();
                        break;
                        case 'meridian':
                            this.toggleMeridian();
                        break;
                    }
                    this.updateElement();
                break;
            }
            
            if (e.keyCode !== 0 && e.keyCode !== 8 && e.keyCode !== 9 && e.keyCode !== 46) {
                e.preventDefault();
            }
        }

        , setValues: function(time) {
            if (this.showMeridian) {
                var arr = time.split(' ');
                var timeArray = arr[0].split(':');
                this.meridian = arr[1];
            } else {
                var timeArray = time.split(':');
            }

            this.hour = parseInt(timeArray[0], 10);
            this.minute = parseInt(timeArray[1], 10);
            this.second = parseInt(timeArray[2], 10);

            if (isNaN(this.hour)) {
                this.hour = 0;
            } 
            if (isNaN(this.minute)) {
                this.minute = 0;
            }

            if (this.showMeridian) {
                if (this.hour > 12) {
                    this.hour = 12;
                } else if (this.hour < 1) {
                    this.hour = 1;
                }

                if (this.meridian == 'am' || this.meridian == 'a') {
                    this.meridian = 'AM';
                } else if (this.meridian == 'pm' || this.meridian == 'p') {
                    this.meridian = 'PM';
                } 

                if (this.meridian != 'AM' && this.meridian != 'PM') {
                    this.meridian = 'AM';
                }
            } else {
                 if (this.hour >= 24) {
                    this.hour = 23;
                } else if (this.hour < 0) {
                    this.hour = 0;
                }
            }

            if (this.minute < 0) {
                this.minute = 0;
            } else if (this.minute >= 60) {
                this.minute = 59;
            }

            if (this.showSeconds) {
                if (isNaN(this.second)) {
                    this.second = 0;
                } else if (this.second < 0) {
                    this.second = 0;
                } else if (this.second >= 60) {
                    this.second = 59;
                }
            }

            this.updateElement();
            this.updateWidget();
        }

        , setMeridian: function(meridian) {
            if (meridian == 'a' || meridian == 'am' || meridian == 'AM' ) {
                this.meridian = 'AM';
            } else if (meridian == 'p' || meridian == 'pm' || meridian == 'PM' ) {
                this.meridian = 'PM';
            } else {
                this.updateWidget();
            }

            this.updateElement();
        }

        , setDefaultTime: function(defaultTime){
            if (defaultTime) {
                if (defaultTime === 'current') {
                    var dTime = new Date();
                    var hours = dTime.getHours();
                    var minutes = Math.floor(dTime.getMinutes() / this.minuteStep) * this.minuteStep;
                    var seconds = Math.floor(dTime.getSeconds() / this.secondStep) * this.secondStep;
                    var meridian = "AM";
                    if (this.showMeridian) {
                        if (hours === 0) {
                            hours = 12;
                        } else if (hours >= 12) {
                            if (hours > 12) {
                                hours = hours - 12;
                            }
                            meridian = "PM";
                        } else {
                           meridian = "AM";
                        }
                    }
                    this.hour = hours;
                    this.minute = minutes;
                    this.second = seconds;
                    this.meridian = meridian;
                } else if (defaultTime === 'value') {
                    this.setValues(this.$element.val());
                } else {
                    this.setValues(defaultTime);
                }
                this.update();
            } else {
                this.hour = 0;
                this.minute = 0;
                this.second = 0;
            }
        }

        , formatTime: function(hour, minute, second, meridian) {
            hour = hour < 10 ? '0' + hour : hour;
            minute = minute < 10 ? '0' + minute : minute;
            second = second < 10 ? '0' + second : second;

            return hour + ':' + minute + (this.showSeconds ? ':' + second : '') + (this.showMeridian ? ' ' + meridian : '');
        }

        , getTime: function() {
            return this.formatTime(this.hour, this.minute, this.second, this.meridian);
        }

        , setTime: function(time) {
            this.setValues(time);
            this.update();
        }

        , update: function() {
            this.updateElement();
            this.updateWidget();
        }

        , blurElement: function() {
          this.highlightedUnit = undefined;
          this.updateFromElementVal();
        }

        , updateElement: function() {
            var time = this.getTime();

            this.$element.val(time).change();

            switch (this.highlightedUnit) {
                case 'hour':
                    this.highlightHour();
                break;
                case 'minute':
                    this.highlightMinute();
                break;
                case 'second':
                    this.highlightSecond();
                break;
                case 'meridian':
                    this.highlightMeridian();
                break;
            }
        }

        , updateWidget: function() {
            if (this.showInputs) {
                this.$widget.find('input.bootstrap-timepicker-hour').val(this.hour < 10 ? '0' + this.hour : this.hour);
                this.$widget.find('input.bootstrap-timepicker-minute').val(this.minute < 10 ? '0' + this.minute : this.minute);
                if (this.showSeconds) {
                    this.$widget.find('input.bootstrap-timepicker-second').val(this.second < 10 ? '0' + this.second : this.second);
                }
                if (this.showMeridian) {
                    this.$widget.find('input.bootstrap-timepicker-meridian').val(this.meridian);
                }
            } else {
                this.$widget.find('span.bootstrap-timepicker-hour').text(this.hour);
                this.$widget.find('span.bootstrap-timepicker-minute').text(this.minute < 10 ? '0' + this.minute : this.minute);
                if (this.showSeconds) {
                    this.$widget.find('span.bootstrap-timepicker-second').text(this.second < 10 ? '0' + this.second : this.second);
                }
                if (this.showMeridian) {
                    this.$widget.find('span.bootstrap-timepicker-meridian').text(this.meridian);
                }
            }
        }

        , updateFromElementVal: function (e) {
            var time = this.$element.val();
            if (time) {
                this.setValues(time);
                this.updateWidget();
            }
        }

        , updateFromWidgetInputs: function () {
            var time = $('input.bootstrap-timepicker-hour', this.$widget).val() + ':' + 
                       $('input.bootstrap-timepicker-minute', this.$widget).val() +
                       (this.showSeconds ? 
                           ':' + $('input.bootstrap-timepicker-second', this.$widget).val() 
                        : '') +
                       (this.showMeridian ? 
                           ' ' + $('input.bootstrap-timepicker-meridian', this.$widget).val() 
                        : '');

            this.setValues(time);
        }

        , getCursorPosition: function() {
            var input = this.$element.get(0);

            if ('selectionStart' in input) {
                // Standard-compliant browsers
                return input.selectionStart;
            } else if (document.selection) {
                // IE fix
                input.focus();
                var sel = document.selection.createRange();
                var selLen = document.selection.createRange().text.length;
                sel.moveStart('character', - input.value.length);

                return sel.text.length - selLen;
            }
        }

        , highlightUnit: function () {
            var input = this.$element.get(0);

            this.position = this.getCursorPosition();
            if (this.position >= 0 && this.position <= 2) {
                this.highlightHour();
            } else if (this.position >= 3 && this.position <= 5) {
                this.highlightMinute();
            } else if (this.position >= 6 && this.position <= 8) {
                if (this.showSeconds) {
                    this.highlightSecond();
                } else {
                    this.highlightMeridian();
                }
            } else if (this.position >= 9 && this.position <= 11) {
                this.highlightMeridian();
            }
        }

        , highlightNextUnit: function() {
            switch (this.highlightedUnit) {
                case 'hour':
                    this.highlightMinute();
                break;
                case 'minute':
                    if (this.showSeconds) {
                        this.highlightSecond();
                    } else {
                        this.highlightMeridian();
                    }
                break;
                case 'second':
                    this.highlightMeridian();
                break;
                case 'meridian':
                    this.highlightHour();
                break;
            }
        }

        , highlightPrevUnit: function() {
            switch (this.highlightedUnit) {
                case 'hour':
                    this.highlightMeridian();
                break;
                case 'minute':
                    this.highlightHour();
                break;
                case 'second':
                    this.highlightMinute();
                break;
                case 'meridian':
                    if (this.showSeconds) {
                        this.highlightSecond();
                    } else {
                        this.highlightMinute();
                    }
                break;
            }
        }

        , highlightHour: function() {
            this.highlightedUnit = 'hour';
            this.$element.get(0).setSelectionRange(0,2); 
        }

        , highlightMinute: function() {
            this.highlightedUnit = 'minute';
            this.$element.get(0).setSelectionRange(3,5); 
        }

        , highlightSecond: function() {
            this.highlightedUnit = 'second';
            this.$element.get(0).setSelectionRange(6,8); 
        }

        , highlightMeridian: function() {
            this.highlightedUnit = 'meridian';
            if (this.showSeconds) {
                this.$element.get(0).setSelectionRange(9,11); 
            } else {
                this.$element.get(0).setSelectionRange(6,8); 
            }
        }

        , incrementHour: function() {
            if (this.showMeridian) {
                if (this.hour === 11) {
                    this.toggleMeridian();
                } else if (this.hour === 12) {
                    return this.hour = 1;
                }
            }
            if (this.hour === 23) {
                return this.hour = 0;
            }
            this.hour = this.hour + 1;
        }

        , decrementHour: function() {
            if (this.showMeridian) {
                if (this.hour === 1) {
                    return this.hour = 12;
                } 
                else if (this.hour === 12) {
                    this.toggleMeridian();
                }
            }
            if (this.hour === 0) {
                return this.hour = 23;
            }
            this.hour = this.hour - 1;
        }

        , incrementMinute: function() {
            var newVal = this.minute + this.minuteStep - (this.minute % this.minuteStep);
            if (newVal > 59) {
                this.incrementHour();
                this.minute = newVal - 60;
            } else {
                this.minute = newVal;
            }
        }

        , decrementMinute: function() {
            var newVal = this.minute - this.minuteStep;
            if (newVal < 0) {
                this.decrementHour();
                this.minute = newVal + 60;
            } else {
                this.minute = newVal;
            }
        }

        , incrementSecond: function() {
            var newVal = this.second + this.secondStep - (this.second % this.secondStep);
            if (newVal > 59) {
                this.incrementMinute();
                this.second = newVal - 60;
            } else {
                this.second = newVal;
            }
        }

        , decrementSecond: function() {
            var newVal = this.second - this.secondStep;
            if (newVal < 0) {
                this.decrementMinute();
                this.second = newVal + 60;
            } else {
                this.second = newVal;
            }
        }

        , toggleMeridian: function() {
            this.meridian = this.meridian === 'AM' ? 'PM' : 'AM';

            this.update();
        }

        , getTemplate: function() {
            if (this.options.templates[this.options.template]) {
                return this.options.templates[this.options.template];
            }
            if (this.showInputs) {
                var hourTemplate = '<input type="text" name="hour" class="bootstrap-timepicker-hour" maxlength="2"/>';
                var minuteTemplate = '<input type="text" name="minute" class="bootstrap-timepicker-minute" maxlength="2"/>';
                var secondTemplate = '<input type="text" name="second" class="bootstrap-timepicker-second" maxlength="2"/>';
                var meridianTemplate = '<input type="text" name="meridian" class="bootstrap-timepicker-meridian" maxlength="2"/>';
            } else {
                var hourTemplate = '<span class="bootstrap-timepicker-hour"></span>';
                var minuteTemplate = '<span class="bootstrap-timepicker-minute"></span>';
                var secondTemplate = '<span class="bootstrap-timepicker-second"></span>';
                var meridianTemplate = '<span class="bootstrap-timepicker-meridian"></span>';
            }
            var templateContent = '<table class="'+ (this.showSeconds ? 'show-seconds' : '') +' '+ (this.showMeridian ? 'show-meridian' : '') +'">'+
                                       '<tr>'+
                                           '<td><a href="#" data-action="incrementHour"><i class="icon-chevron-up"></i></a></td>'+
                                           '<td class="separator">&nbsp;</td>'+
                                           '<td><a href="#" data-action="incrementMinute"><i class="icon-chevron-up"></i></a></td>'+
                                           (this.showSeconds ? 
                                               '<td class="separator">&nbsp;</td>'+
                                               '<td><a href="#" data-action="incrementSecond"><i class="icon-chevron-up"></i></a></td>'
                                           : '') +
                                           (this.showMeridian ? 
                                               '<td class="separator">&nbsp;</td>'+
                                               '<td class="meridian-column"><a href="#" data-action="toggleMeridian"><i class="icon-chevron-up"></i></a></td>'
                                           : '') +
                                       '</tr>'+
                                       '<tr>'+
                                           '<td>'+ hourTemplate +'</td> '+
                                           '<td class="separator">:</td>'+
                                           '<td>'+ minuteTemplate +'</td> '+
                                           (this.showSeconds ? 
                                                '<td class="separator">:</td>'+
                                                '<td>'+ secondTemplate +'</td>'
                                           : '') +
                                           (this.showMeridian ? 
                                                '<td class="separator">&nbsp;</td>'+
                                                '<td>'+ meridianTemplate +'</td>'
                                           : '') +
                                       '</tr>'+
                                       '<tr>'+
                                           '<td><a href="#" data-action="decrementHour"><i class="icon-chevron-down"></i></a></td>'+
                                           '<td class="separator"></td>'+
                                           '<td><a href="#" data-action="decrementMinute"><i class="icon-chevron-down"></i></a></td>'+
                                           (this.showSeconds ? 
                                                '<td class="separator">&nbsp;</td>'+
                                                '<td><a href="#" data-action="decrementSecond"><i class="icon-chevron-down"></i></a></td>' 
                                           : '') +
                                           (this.showMeridian ? 
                                                '<td class="separator">&nbsp;</td>'+
                                                '<td><a href="#" data-action="toggleMeridian"><i class="icon-chevron-down"></i></a></td>'
                                           : '') +
                                       '</tr>'+
                                   '</table>';

            var template;
            switch(this.options.template) {
                case 'modal':
                    template = '<div class="bootstrap-timepicker modal hide fade in" style="top: 30%; margin-top: 0; width: 200px; margin-left: -100px;" data-backdrop="'+ (this.modalBackdrop ? 'true' : 'false') +'">'+
                                   '<div class="modal-header">'+
                                       '<a href="#" class="close" data-dismiss="modal">×</a>'+
                                       '<h3>Pick a Time</h3>'+
                                   '</div>'+
                                   '<div class="modal-content">'+
                                        templateContent +
                                   '</div>'+
                                   '<div class="modal-footer">'+
                                       '<a href="#" class="btn btn-primary" data-dismiss="modal">Ok</a>'+
                                   '</div>'+
                               '</div>';
                    
                break;
                case 'dropdown':
                    template = '<div class="bootstrap-timepicker dropdown-menu">'+
                                    templateContent +
                               '</div>';
                break;
                
            }
            return template;
        }
    };


    /* TIMEPICKER PLUGIN DEFINITION
     * =========================== */

    $.fn.timepicker = function (option) {
        return this.each(function () {
            var $this = $(this)
            , data = $this.data('timepicker')
            , options = typeof option == 'object' && option;
            if (!data) {
                $this.data('timepicker', (data = new Timepicker(this, options)));
            }
            if (typeof option == 'string') {
                data[option]();
            }
        })
    }

    $.fn.timepicker.defaults = {
      minuteStep: 15
    , secondStep: 15
    , disableFocus: false
    , defaultTime: 'current'
    , showSeconds: false
    , showInputs: true
    , showMeridian: true
    , template: 'dropdown'
    , modalBackdrop: false
    , templates: {} // set custom templates
    }

    $.fn.timepicker.Constructor = Timepicker
}(window.jQuery);
/*! fancyBox v2.0.5 fancyapps.com | fancyapps.com/fancybox/#license */
(function(t,m,e){var l=e(t),q=e(m),a=e.fancybox=function(){a.open.apply(this,arguments)},r=!1,s="undefined"!==typeof m.createTouch;e.extend(a,{version:"2.0.5",defaults:{padding:15,margin:20,width:800,height:600,minWidth:100,minHeight:100,maxWidth:9999,maxHeight:9999,autoSize:!0,autoResize:!s,autoCenter:!s,fitToView:!0,aspectRatio:!1,topRatio:0.5,fixed:!(e.browser.msie&&6>=e.browser.version)&&!s,scrolling:"auto",wrapCSS:"fancybox-default",arrows:!0,closeBtn:!0,closeClick:!1,nextClick:!1,mouseWheel:!0,
autoPlay:!1,playSpeed:3E3,preload:3,modal:!1,loop:!0,ajax:{dataType:"html",headers:{"X-fancyBox":!0}},keys:{next:[13,32,34,39,40],prev:[8,33,37,38],close:[27]},tpl:{wrap:'<div class="fancybox-wrap"><div class="fancybox-outer"><div class="fancybox-inner"></div></div></div>',image:'<img class="fancybox-image" src="{href}" alt="" />',iframe:'<iframe class="fancybox-iframe" name="fancybox-frame{rnd}" frameborder="0" hspace="0"'+(e.browser.msie?' allowtransparency="true"':"")+"></iframe>",swf:'<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" width="100%" height="100%"><param name="wmode" value="transparent" /><param name="allowfullscreen" value="true" /><param name="allowscriptaccess" value="always" /><param name="movie" value="{href}" /><embed src="{href}" type="application/x-shockwave-flash" allowfullscreen="true" allowscriptaccess="always" width="100%" height="100%" wmode="transparent"></embed></object>',
error:'<p class="fancybox-error">The requested content cannot be loaded.<br/>Please try again later.</p>',closeBtn:'<div title="Close" class="fancybox-item fancybox-close"></div>',next:'<a title="Next" class="fancybox-nav fancybox-next"><span></span></a>',prev:'<a title="Previous" class="fancybox-nav fancybox-prev"><span></span></a>'},openEffect:"fade",openSpeed:250,openEasing:"swing",openOpacity:!0,openMethod:"zoomIn",closeEffect:"fade",closeSpeed:250,closeEasing:"swing",closeOpacity:!0,closeMethod:"zoomOut",
nextEffect:"elastic",nextSpeed:300,nextEasing:"swing",nextMethod:"changeIn",prevEffect:"elastic",prevSpeed:300,prevEasing:"swing",prevMethod:"changeOut",helpers:{overlay:{speedIn:0,speedOut:300,opacity:0.8,css:{cursor:"pointer"},closeClick:!0},title:{type:"float"}}},group:{},opts:{},coming:null,current:null,isOpen:!1,isOpened:!1,wrap:null,outer:null,inner:null,player:{timer:null,isActive:!1},ajaxLoad:null,imgPreload:null,transitions:{},helpers:{},open:function(b,c){a.close(!0);b&&!e.isArray(b)&&(b=
b instanceof e?e(b).get():[b]);a.isActive=!0;a.opts=e.extend(!0,{},a.defaults,c);e.isPlainObject(c)&&"undefined"!==typeof c.keys&&(a.opts.keys=c.keys?e.extend({},a.defaults.keys,c.keys):!1);a.group=b;a._start(a.opts.index||0)},cancel:function(){a.coming&&!1===a.trigger("onCancel")||(a.coming=null,a.hideLoading(),a.ajaxLoad&&a.ajaxLoad.abort(),a.ajaxLoad=null,a.imgPreload&&(a.imgPreload.onload=a.imgPreload.onabort=a.imgPreload.onerror=null))},close:function(b){a.cancel();a.current&&!1!==a.trigger("beforeClose")&&
(a.unbindEvents(),!a.isOpen||b&&!0===b[0]?(e(".fancybox-wrap").stop().trigger("onReset").remove(),a._afterZoomOut()):(a.isOpen=a.isOpened=!1,e(".fancybox-item, .fancybox-nav").remove(),a.wrap.stop(!0).removeClass("fancybox-opened"),a.inner.css("overflow","hidden"),a.transitions[a.current.closeMethod]()))},play:function(b){var c=function(){clearTimeout(a.player.timer)},d=function(){c();a.current&&a.player.isActive&&(a.player.timer=setTimeout(a.next,a.current.playSpeed))},g=function(){c();e("body").unbind(".player");
a.player.isActive=!1;a.trigger("onPlayEnd")};if(a.player.isActive||b&&!1===b[0])g();else if(a.current&&(a.current.loop||a.current.index<a.group.length-1))a.player.isActive=!0,e("body").bind({"afterShow.player onUpdate.player":d,"onCancel.player beforeClose.player":g,"beforeLoad.player":c}),d(),a.trigger("onPlayStart")},next:function(){a.current&&a.jumpto(a.current.index+1)},prev:function(){a.current&&a.jumpto(a.current.index-1)},jumpto:function(b){a.current&&(b=parseInt(b,10),1<a.group.length&&a.current.loop&&
(b>=a.group.length?b=0:0>b&&(b=a.group.length-1)),"undefined"!==typeof a.group[b]&&(a.cancel(),a._start(b)))},reposition:function(b){a.isOpen&&a.wrap.css(a._getPosition(b))},update:function(b){a.isOpen&&(r||setTimeout(function(){var c=a.current;if(r&&(r=!1,c)){if(c.autoResize||b&&"orientationchange"===b.type)c.autoSize&&(a.inner.height("auto"),c.height=a.inner.height()),a._setDimension(),c.canGrow&&a.inner.height("auto");c.autoCenter&&a.reposition();a.trigger("onUpdate")}},100),r=!0)},toggle:function(){a.isOpen&&
(a.current.fitToView=!a.current.fitToView,a.update())},hideLoading:function(){e("#fancybox-loading").remove()},showLoading:function(){a.hideLoading();e('<div id="fancybox-loading"><div></div></div>').click(a.cancel).appendTo("body")},getViewport:function(){return{x:l.scrollLeft(),y:l.scrollTop(),w:l.width(),h:l.height()}},unbindEvents:function(){a.wrap&&a.wrap.unbind(".fb");q.unbind(".fb");l.unbind(".fb")},bindEvents:function(){var b=a.current,c=b.keys;b&&(l.bind("resize.fb, orientationchange.fb",
a.update),c&&q.bind("keydown.fb",function(b){var g;!b.ctrlKey&&!b.altKey&&!b.shiftKey&&!b.metaKey&&0>e.inArray(b.target.tagName.toLowerCase(),["input","textarea","select","button"])&&(g=b.keyCode,-1<e.inArray(g,c.close)?(a.close(),b.preventDefault()):-1<e.inArray(g,c.next)?(a.next(),b.preventDefault()):-1<e.inArray(g,c.prev)&&(a.prev(),b.preventDefault()))}),e.fn.mousewheel&&b.mouseWheel&&1<a.group.length&&a.wrap.bind("mousewheel.fb",function(b,c){var f=e(b.target).get(0);if(0===f.clientHeight||f.scrollHeight===
f.clientHeight&&f.scrollWidth===f.clientWidth)b.preventDefault(),a[0<c?"prev":"next"]()}))},trigger:function(b){var c,d=a[-1<e.inArray(b,["onCancel","beforeLoad","afterLoad"])?"coming":"current"];if(d){e.isFunction(d[b])&&(c=d[b].apply(d,Array.prototype.slice.call(arguments,1)));if(!1===c)return!1;d.helpers&&e.each(d.helpers,function(c,f){if(f&&"undefined"!==typeof a.helpers[c]&&e.isFunction(a.helpers[c][b]))a.helpers[c][b](f,d)});e.event.trigger(b+".fb")}},isImage:function(a){return a&&a.match(/\.(jpg|gif|png|bmp|jpeg)(.*)?$/i)},
isSWF:function(a){return a&&a.match(/\.(swf)(.*)?$/i)},_start:function(b){var c={},d=a.group[b]||null,g,f,k;if(d&&(d.nodeType||d instanceof e))g=!0,e.metadata&&(c=e(d).metadata());c=e.extend(!0,{},a.opts,{index:b,element:d},e.isPlainObject(d)?d:c);e.each(["href","title","content","type"],function(b,f){c[f]=a.opts[f]||g&&e(d).attr(f)||c[f]||null});"number"===typeof c.margin&&(c.margin=[c.margin,c.margin,c.margin,c.margin]);c.modal&&e.extend(!0,c,{closeBtn:!1,closeClick:!1,nextClick:!1,arrows:!1,mouseWheel:!1,
keys:null,helpers:{overlay:{css:{cursor:"auto"},closeClick:!1}}});a.coming=c;if(!1===a.trigger("beforeLoad"))a.coming=null;else{f=c.type;b=c.href||d;f||(g&&(k=e(d).data("fancybox-type"),!k&&d.className&&(f=(k=d.className.match(/fancybox\.(\w+)/))?k[1]:null)),!f&&"string"===e.type(b)&&(a.isImage(b)?f="image":a.isSWF(b)?f="swf":b.match(/^#/)&&(f="inline")),f||(f=g?"inline":"html"),c.type=f);if("inline"===f||"html"===f){if(c.content||(c.content="inline"===f?e("string"===e.type(b)?b.replace(/.*(?=#[^\s]+$)/,
""):b):d),!c.content||!c.content.length)f=null}else b||(f=null);c.group=a.group;c.isDom=g;c.href=b;"image"===f?a._loadImage():"ajax"===f?a._loadAjax():f?a._afterLoad():a._error("type")}},_error:function(b){a.hideLoading();e.extend(a.coming,{type:"html",autoSize:!0,minHeight:0,hasError:b,content:a.coming.tpl.error});a._afterLoad()},_loadImage:function(){a.imgPreload=new Image;a.imgPreload.onload=function(){this.onload=this.onerror=null;a.coming.width=this.width;a.coming.height=this.height;a._afterLoad()};
a.imgPreload.onerror=function(){this.onload=this.onerror=null;a._error("image")};a.imgPreload.src=a.coming.href;a.imgPreload.width||a.showLoading()},_loadAjax:function(){a.showLoading();a.ajaxLoad=e.ajax(e.extend({},a.coming.ajax,{url:a.coming.href,error:function(b,c){"abort"!==c?a._error("ajax",b):a.hideLoading()},success:function(b,c){"success"===c&&(a.coming.content=b,a._afterLoad())}}))},_preloadImages:function(){var b=a.group,c=a.current,d=b.length,g;if(c.preload&&!(2>b.length))for(var f=1;f<=
Math.min(c.preload,d-1);f++)if(g=b[(c.index+f)%d],g=e(g).attr("href")||g)(new Image).src=g},_afterLoad:function(){a.hideLoading();!a.coming||!1===a.trigger("afterLoad",a.current)?a.coming=!1:(a.isOpened?(e(".fancybox-item").remove(),a.wrap.stop(!0).removeClass("fancybox-opened"),a.inner.css("overflow","hidden"),a.transitions[a.current.prevMethod]()):(e(".fancybox-wrap").stop().trigger("onReset").remove(),a.trigger("afterClose")),a.unbindEvents(),a.isOpen=!1,a.current=a.coming,a.wrap=e(a.current.tpl.wrap).addClass("fancybox-"+
(s?"mobile":"desktop")+" fancybox-tmp "+a.current.wrapCSS).appendTo("body"),a.outer=e(".fancybox-outer",a.wrap).css("padding",a.current.padding+"px"),a.inner=e(".fancybox-inner",a.wrap),a._setContent())},_setContent:function(){var b,c,d=a.current,g=d.type;switch(g){case "inline":case "ajax":case "html":b=d.content;b instanceof e&&(b=b.show().detach(),b.parent().hasClass("fancybox-inner")&&b.parents(".fancybox-wrap").trigger("onReset").remove(),e(a.wrap).bind("onReset",function(){b.appendTo("body").hide()}));
d.autoSize&&(c=e('<div class="fancybox-tmp '+a.current.wrapCSS+'"></div>').appendTo("body").append(b),d.width=c.width(),d.height=c.height(),c.width(a.current.width),c.height()>d.height&&(c.width(d.width+1),d.width=c.width(),d.height=c.height()),b=c.contents().detach(),c.remove());break;case "image":b=d.tpl.image.replace("{href}",d.href);d.aspectRatio=!0;break;case "swf":b=d.tpl.swf.replace(/\{width\}/g,d.width).replace(/\{height\}/g,d.height).replace(/\{href\}/g,d.href)}if("iframe"===g){b=e(d.tpl.iframe.replace("{rnd}",
(new Date).getTime())).attr("scrolling",d.scrolling);d.scrolling="auto";if(d.autoSize){b.width(d.width);a.showLoading();b.data("ready",!1).appendTo(a.inner).bind({onCancel:function(){e(this).unbind();a._afterZoomOut()},load:function(){var b=e(this),c;try{this.contentWindow.document.location&&(c=b.contents().find("body").height()+12,b.height(c))}catch(g){d.autoSize=!1}!1===b.data("ready")?(a.hideLoading(),c&&(a.current.height=c),a._beforeShow(),b.data("ready",!0)):c&&a.update()}}).attr("src",d.href);
return}b.attr("src",d.href)}else if("image"===g||"swf"===g)d.autoSize=!1,d.scrolling="visible";a.inner.append(b);a._beforeShow()},_beforeShow:function(){a.coming=null;a.trigger("beforeShow");a._setDimension();a.wrap.hide().removeClass("fancybox-tmp");a.bindEvents();a._preloadImages();a.transitions[a.isOpened?a.current.nextMethod:a.current.openMethod]()},_setDimension:function(){var b=a.wrap,c=a.outer,d=a.inner,g=a.current,f=a.getViewport(),k=g.margin,h=2*g.padding,i=g.width,j=g.height,o=g.maxWidth,
l=g.maxHeight,p=g.minWidth,m=g.minHeight,n;f.w-=k[1]+k[3];f.h-=k[0]+k[2];-1<i.toString().indexOf("%")&&(i=(f.w-h)*parseFloat(i)/100);-1<j.toString().indexOf("%")&&(j=(f.h-h)*parseFloat(j)/100);k=i/j;i+=h;j+=h;g.fitToView&&(o=Math.min(f.w,o),l=Math.min(f.h,l));g.aspectRatio?(i>o&&(i=o,j=(i-h)/k+h),j>l&&(j=l,i=(j-h)*k+h),i<p&&(i=p,j=(i-h)/k+h),j<m&&(j=m,i=(j-h)*k+h)):(i=Math.max(p,Math.min(i,o)),j=Math.max(m,Math.min(j,l)));i=Math.round(i);j=Math.round(j);e(b.add(c).add(d)).width("auto").height("auto");
d.width(i-h).height(j-h);b.width(i);n=b.height();if(i>o||n>l)for(;(i>o||n>l)&&i>p&&n>m;)j-=10,g.aspectRatio?(i=Math.round((j-h)*k+h),i<p&&(i=p,j=(i-h)/k+h)):i-=10,d.width(i-h).height(j-h),b.width(i),n=b.height();g.dim={width:i,height:n};g.canGrow=g.autoSize&&j>m&&j<l;g.canShrink=!1;g.canExpand=!1;if(i-h<g.width||j-h<g.height)g.canExpand=!0;else if((i>f.w||n>f.h)&&i>p&&j>m)g.canShrink=!0;b=n-h;a.innerSpace=b-d.height();a.outerSpace=b-c.height()},_getPosition:function(b){var c=a.current,d=a.getViewport(),
e=c.margin,f=a.wrap.width()+e[1]+e[3],k=a.wrap.height()+e[0]+e[2],h={position:"absolute",top:e[0]+d.y,left:e[3]+d.x};if(c.fixed&&(!b||!1===b[0])&&k<=d.h&&f<=d.w)h={position:"fixed",top:e[0],left:e[3]};h.top=Math.ceil(Math.max(h.top,h.top+(d.h-k)*c.topRatio))+"px";h.left=Math.ceil(Math.max(h.left,h.left+0.5*(d.w-f)))+"px";return h},_afterZoomIn:function(){var b=a.current,c=b.scrolling;a.isOpen=a.isOpened=!0;a.wrap.addClass("fancybox-opened").css("overflow","visible");a.update();a.inner.css("overflow",
"yes"===c?"scroll":"no"===c?"hidden":c);if(b.closeClick||b.nextClick)a.inner.css("cursor","pointer").bind("click.fb",b.nextClick?a.next:a.close);b.closeBtn&&e(b.tpl.closeBtn).appendTo(a.outer).bind("click.fb",a.close);b.arrows&&1<a.group.length&&((b.loop||0<b.index)&&e(b.tpl.prev).appendTo(a.inner).bind("click.fb",a.prev),(b.loop||b.index<a.group.length-1)&&e(b.tpl.next).appendTo(a.inner).bind("click.fb",a.next));a.trigger("afterShow");a.opts.autoPlay&&!a.player.isActive&&(a.opts.autoPlay=!1,a.play())},
_afterZoomOut:function(){a.trigger("afterClose");a.wrap.trigger("onReset").remove();e.extend(a,{group:{},opts:{},current:null,isActive:!1,isOpened:!1,isOpen:!1,wrap:null,outer:null,inner:null})}});a.transitions={getOrigPosition:function(){var b=a.current,c=b.element,d=b.padding,g=e(b.orig),f={},k=50,h=50;!g.length&&b.isDom&&e(c).is(":visible")&&(g=e(c).find("img:first"),g.length||(g=e(c)));g.length?(f=g.offset(),g.is("img")&&(k=g.outerWidth(),h=g.outerHeight())):(b=a.getViewport(),f.top=b.y+0.5*(b.h-
h),f.left=b.x+0.5*(b.w-k));return f={top:Math.ceil(f.top-d)+"px",left:Math.ceil(f.left-d)+"px",width:Math.ceil(k+2*d)+"px",height:Math.ceil(h+2*d)+"px"}},step:function(b,c){var d,e,f;if("width"===c.prop||"height"===c.prop)e=f=Math.ceil(b-2*a.current.padding),"height"===c.prop&&(d=(b-c.start)/(c.end-c.start),c.start>c.end&&(d=1-d),e-=a.innerSpace*d,f-=a.outerSpace*d),a.inner[c.prop](e),a.outer[c.prop](f)},zoomIn:function(){var b=a.wrap,c=a.current,d,g;d=c.dim;"elastic"===c.openEffect?(g=e.extend({},
d,a._getPosition(!0)),delete g.position,d=this.getOrigPosition(),c.openOpacity&&(d.opacity=0,g.opacity=1),a.outer.add(a.inner).width("auto").height("auto"),b.css(d).show(),b.animate(g,{duration:c.openSpeed,easing:c.openEasing,step:this.step,complete:a._afterZoomIn})):(b.css(e.extend({},d,a._getPosition())),"fade"===c.openEffect?b.fadeIn(c.openSpeed,a._afterZoomIn):(b.show(),a._afterZoomIn()))},zoomOut:function(){var b=a.wrap,c=a.current,d;"elastic"===c.closeEffect?("fixed"===b.css("position")&&b.css(a._getPosition(!0)),
d=this.getOrigPosition(),c.closeOpacity&&(d.opacity=0),b.animate(d,{duration:c.closeSpeed,easing:c.closeEasing,step:this.step,complete:a._afterZoomOut})):b.fadeOut("fade"===c.closeEffect?c.closeSpeed:0,a._afterZoomOut)},changeIn:function(){var b=a.wrap,c=a.current,d;"elastic"===c.nextEffect?(d=a._getPosition(!0),d.opacity=0,d.top=parseInt(d.top,10)-200+"px",b.css(d).show().animate({opacity:1,top:"+=200px"},{duration:c.nextSpeed,easing:c.nextEasing,complete:a._afterZoomIn})):(b.css(a._getPosition()),
"fade"===c.nextEffect?b.hide().fadeIn(c.nextSpeed,a._afterZoomIn):(b.show(),a._afterZoomIn()))},changeOut:function(){var b=a.wrap,c=a.current,d=function(){e(this).trigger("onReset").remove()};b.removeClass("fancybox-opened");"elastic"===c.prevEffect?b.animate({opacity:0,top:"+=200px"},{duration:c.prevSpeed,easing:c.prevEasing,complete:d}):b.fadeOut("fade"===c.prevEffect?c.prevSpeed:0,d)}};a.helpers.overlay={overlay:null,update:function(){var a,c;this.overlay.width(0).height(0);e.browser.msie?(a=Math.max(m.documentElement.scrollWidth,
m.body.scrollWidth),c=Math.max(m.documentElement.offsetWidth,m.body.offsetWidth),a=a<c?l.width():a):a=q.width();this.overlay.width(a).height(q.height())},beforeShow:function(b){this.overlay||(b=e.extend(!0,{speedIn:"fast",closeClick:!0,opacity:1,css:{background:"black"}},b),this.overlay=e('<div id="fancybox-overlay"></div>').css(b.css).appendTo("body"),this.update(),b.closeClick&&this.overlay.bind("click.fb",a.close),l.bind("resize.fb",e.proxy(this.update,this)),this.overlay.fadeTo(b.speedIn,b.opacity))},
onUpdate:function(){this.update()},afterClose:function(a){this.overlay&&this.overlay.fadeOut(a.speedOut||0,function(){e(this).remove()});this.overlay=null}};a.helpers.title={beforeShow:function(b){var c;if(c=a.current.title)c=e('<div class="fancybox-title fancybox-title-'+b.type+'-wrap">'+c+"</div>").appendTo("body"),"float"===b.type&&(c.width(c.width()),c.wrapInner('<span class="child"></span>'),a.current.margin[2]+=Math.abs(parseInt(c.css("margin-bottom"),10))),c.appendTo("over"===b.type?a.inner:
"outside"===b.type?a.wrap:a.outer)}};e.fn.fancybox=function(b){var c=e(this),d=this.selector||"",g,f=function(f){var h=this,i="rel",j=h[i],l=g;!f.ctrlKey&&!f.altKey&&!f.shiftKey&&!f.metaKey&&(f.preventDefault(),j||(i="data-fancybox-group",j=e(h).attr("data-fancybox-group")),j&&""!==j&&"nofollow"!==j&&(h=d.length?e(d):c,h=h.filter("["+i+'="'+j+'"]'),l=h.index(this)),b.index=l,a.open(h,b))},b=b||{};g=b.index||0;d?q.undelegate(d,"click.fb-start").delegate(d,"click.fb-start",f):c.unbind("click.fb-start").bind("click.fb-start",
f);return this}})(window,document,jQuery);/*
*	Class: fileUploader
*	Use: Upload multiple files using jquery
*	Author: John Laniba (http://pixelcone.com)
*	Version: 1.3
*/

(function($) {
	$.fileUploader = {version: '1.3', count: 0};
	$.fn.fileUploader = function(config){
		
		config = $.extend({}, {
			autoUpload: false,
			limit: false,
			buttonUpload: '#px-submit',
			buttonClear: '#px-clear',
			selectFileLabel: 'Select files',
			allowedExtension: 'jpg|jpeg|gif|png',
			timeInterval: [1, 2, 4, 2, 1, 5], //Mock percentage for iframe upload
			percentageInterval: [10, 20, 30, 40, 60, 80],
			
			//Callbacks
			onValidationError: null,	//trigger if file is invalid
			onFileChange: function(){},
			onFileRemove: function(){},
			beforeUpload: function(){}, //trigger after the submit button is click: before upload
			beforeEachUpload: function(){}, //callback before each file has been uploaded ::: returns each Form
			afterUpload: function(){},
			afterEachUpload: function(){} //callback after each file has been uploaded
			
		}, config);
		
		$.fileUploader.count++;
		
		//Multiple instance of a FOrm Container
		var pxUploadForm = 'px-form-' + $.fileUploader.count,
		pxWidget = 'px-widget-' + $.fileUploader.count,
		pxButton = 'px-button-' + $.fileUploader.count,
		wrapper = ' \
			<div id="'+ pxWidget +'" class="px-widget ui-widget"> \
				<div class="ui-helper-clearfix"> \
					<div id="'+ pxUploadForm +'-input" class="px-form-input"></div> \
					<div id="'+ pxButton +'" class="px-buttons"></div> \
				</div> \
				<div id="'+ pxUploadForm +'"></div> \
			</div> \
		',
		pxUploadForm = '#' + pxUploadForm,
		pxUploadFormInput = pxUploadForm + '-input',
		pxButton = '#' + pxButton,
		pxWidget = '#' + pxWidget,
		buttonClearId = null,
	
		itr = 1, //index/itr of file
		isLimit = (config.limit)? true : false,
		limit = parseInt(config.limit),
	
		e = this, //set e as this
		selector = $(this).selector,
		buttonM = pxButton + ' input, '+ pxButton +' button'; //Accept button as input and as button
		isFile = false, //this is use to hide other inputs in a form
		progress = 0, //percentage of the upload,
		totalForm = 0,
		jqxhr = null, //return object from jquery.ajax,
		timeInterval = config.timeInterval,
		percentageInterval = config.percentageInterval,
		pcount = 0, //progress count to set interval,
		progressTime = null,
		stopUpload = false; //Stop all upload
		
		if (window.FormData) {
			var isHtml5 = true;
		} else {
			var isHtml5 = false;
		}
		
		//Wrap all function that is accessable within the plugin
		var px = {
			
			//Initialize and format data
			init: function(){
				px.form = $(e).parents('form');
				
				//prepend wrapper markup
				px.form.before(wrapper);
				
				//Wrap input button
				$(e).wrap('<div class="px-input-button" />');
				px.form.children('.px-input-button').prepend('<span>'+ config.selectFileLabel +'</span>');
				
				//Transform file input into ui button
				$(".px-input-button").button({
					icons: {
               			primary: "ui-icon-circle-plus"
            		}
				});
				$(config.buttonUpload).button({
					icons: {
               			primary: "ui-icon-arrowthickstop-1-n"
            		}
				});
				$(config.buttonClear).button({
					icons: {
               			primary: "ui-icon-circle-close"
            		}
				});
				
				//clear all form data
				px.clearFormData(px.form);
				
				//move upload and clear button into id px_button
				px.form.find(config.buttonUpload + ',' + config.buttonClear).appendTo(pxButton);
				
				px.form.hide();
				this.printForm();
				
				//Disable button
				$(buttonM).attr('disabled','disabled');
			},
			
			//Clone, format and append form
			printForm: function(){
				
				var formId = 'pxupload' + itr,
				iframeId = formId + '_frame';
				
				$('<iframe name="'+ iframeId +'"></iframe>').attr({
					id: iframeId,
					src: 'about:blank',
					style: 'display:none'
				}).prependTo(pxUploadFormInput);
				
				px.form.clone().attr({
					id: formId,
					target: iframeId
				}).prependTo(pxUploadFormInput).show();
				
				//Show only the file input
				px.showInputFile( '#'+formId );
				
				//This is not good but i left no choice because live function is not working on IE
				$(selector).change(function() {
					if (isHtml5) {
						html5Change(this);
					} else {
						uploadChange($(this));
					}
				});
			},
			
			//Show only the file input
			showInputFile: function(form) {
				$(pxUploadFormInput).find(form).children().each(function(){
					isFile = $(this).is(':file');
					if (!isFile && $(this).find(':file').length == 0) {
						$(this).hide();
					}
				});
			},
			//Hide file input and show other data
			hideInputFile: function($form) {
				$form.children().each(function(){
					isFile = $(this).is(':file');
					if (isFile || $(this).find(':file').length > 0) {
						$(this).hide();
					} else {
						$(this).show();
					}
				});
			},
			
			//Validate file
			getFileName: function(file) {
				
				if (file.indexOf('/') > -1){
					file = file.substring(file.lastIndexOf('/') + 1);
				} else if (file.indexOf('\\') > -1){
					file = file.substring(file.lastIndexOf('\\') + 1);
				}
				
				return file;
			},
			
			validateFileName: function(filename) {
				var extensions = new RegExp(config.allowedExtension + '$', 'i');
				if (extensions.test(filename)){
					return filename;
				} else {
					return -1;
				}
			},
			
			getFileSize: function(file) {
				var fileSize = 0;
				if (file.size > 1024 * 1024) {
					fileSize = (Math.round(file.size * 100 / (1024 * 1024)) / 100).toString() + 'MB';
				} else {
					fileSize = (Math.round(file.size * 100 / 1024) / 100).toString() + 'KB';
				}
				return fileSize;
			},
			
			//clear form data
			clearFormData: function(form) {
				$(form).find(':input').each(function() {
					if (this.type == 'file') {
						$(this).val('');
					}
				});
			}
			
		}
		
		//initialize
		px.init();
		
		/*
		*	Plugin Events/Method
		*/
		
		/*
		* Html5 file change
		*/
		function html5Change($this) {
			$.each( $this.files, function(index, file){
				uploadChange(file);
			});
			
			afterUploadChange();
		}
		
		/*
		*	Html5 Drag and Drop
		*/
		$.event.props.push('dataTransfer');
		$(pxWidget).bind( 'dragenter dragover', false)
		.bind( 'drop', function( e ) {
			e.stopPropagation();
			e.preventDefault();
			
			html5Change(e.dataTransfer);
			
		});
		
		/*
		*	On Change of upload file
		*/
		function uploadChange($this) {
			
			var $form = $(pxUploadFormInput + ' #pxupload'+ itr);
					
			//validate file
			var filename = (isHtml5)? $this.name : px.getFileName( $this.val() );
			if ( px.validateFileName(filename) == -1 ){
				if ($.isFunction(config.onValidationError)) {
					config.onValidationError($this);
				} else {
					alert ('Invalid file!');
				}
				$form.find(':file').val('');
				return false;
			}
			
			//Limit
			if (limit <= 0) {
				//Your message about exceeding limit
				
				return false;
			}
			limit = limit - 1;
			
			//remove disabled attr
			$(buttonM).removeAttr('disabled');
			
			//remove upload text after uploaded
			$('.upload-data', pxUploadForm).each(function() {
				if ( $(this).find('form').length <= 0 ) {
					$(this).remove();
				}
			});
			
			//append size of the file after filename
			if (isHtml5) {
				filename += ' (' + px.getFileSize($this) + ')';
			}
			
			//DIsplay syled markup				
			$(pxUploadForm).append(
				$('<div>').attr({
					'class': 'upload-data pending ui-widget-content ui-corner-all',
					id: 'pxupload'+ itr +'_text'
				})
				.data('formId', 'pxupload'+ itr)
				.append(' \
					<ul class="actions ui-helper-clearfix"> \
						<li title="Upload" class="upload ui-state-default ui-corner-all"> \
							<span class="ui-icon ui-icon-circle-triangle-e"></span> \
						</li> \
						<li title="Delete" class="delete ui-state-default ui-corner-all"> \
							<span class="ui-icon ui-icon-circle-minus"></span> \
						</li> \
					</ul> \
					<span class="filename">'+ filename +'</span> \
					<div class="progress ui-helper-clearfix"> \
						<div class="progressBar" id="progressBar_'+ itr +'"></div> \
						<div class="percentage">0%</div> \
					</div> \
					<div class="status">Pending...</div> \
				')
			);
			
			//Store input in form
			$form.data('input', $this);
			
			$form.appendTo(pxUploadForm + ' #pxupload'+ itr +'_text');
			
			//hide the input file
			px.hideInputFile( $form );
			
			//increment for printing form
			itr++;
			
			//print form
			px.printForm();
			
			//Callback on file Changed
			config.onFileChange($this, $form);
			
			if (!isHtml5) {
				afterUploadChange();
			}
		}
		
		/*
		*	After upload change triggers autoupload
		*/
		function afterUploadChange() {
			
			if (config.autoUpload) {
				
				//Display Cancel Button
				toogleCancel(true)
				
				stopUpload = false;
				//Queue and process upload
				uploadQueue();
			}
		}
		
		/*
		*	Queue Upload and send each form to process upload
		*/
		function uploadQueue() {
			
			//stop all upload
			if (stopUpload) {
				return;
			}
			
			totalForm = $(pxUploadForm + ' form').parent('.upload-data').get().length;
			if (totalForm > 0) {
				pendingUpload = $(pxUploadForm + ' form').parent('.upload-data').get(0);
				$form = $(pendingUpload).children('form');
				
				//before upload
				beforeEachUpload( $form );
				
				if (isHtml5) {
					//Upload Using Html5 api
					html5Upload( $form );
				} else {
					
					//upload using iframe
					iframeUpload( $form );
				}
			} else {
				config.afterUpload(pxUploadForm);
				
				//Revert Button to clear
				toogleCancel(false);
			}
		}
		
		/*
		*	Process form Upload
		*/
		function html5Upload($form) {
			file = $form.data('input');
			if (file) {
				var fd = new FormData();
				fd.append($form.find(selector).attr('name'), file);
				//get other form input and append to formData
				$form.find(':input').each(function() {
					if (this.type != 'file') {
						fd.append($(this).attr('name'), $(this).val());
					}
				});
				
				//show progress bar
				$uploadData = $form.parent();
				$uploadData.find('.progress').show();
				$progressBar = $uploadData.find('.progressBar');
				$percentage = $uploadData.find('.percentage');
				
				//Upload using jQuery AJAX
				jqxhr = $.ajax({
					url: $form.attr('action'),
					data: fd,
					cache: false,
					contentType: false,
					processData: false,
					type: 'POST',
					xhr: function() {
						var req = $.ajaxSettings.xhr();
						if (req) {
							req.upload.addEventListener('progress',function(ev){
								//Display progress Percentage
								progress = Math.round(ev.loaded * 100 / ev.total);
								$percentage.text(progress.toString() + '%');
								$progressBar.progressbar({
									value: progress
								});
							}, false);
						}
						return req;
					}
				})
				.success(function(data) {
					afterEachUpload($form.attr('id'), data );
				})
				.error(function(jqXHR, textStatus, errorThrown) {
					afterEachUpload($form.attr('id'), null, textStatus, errorThrown );
				})
				.complete(function(jqXHR, textStatus) {
					$progressBar.progressbar({
						value: 100
					});
					$percentage.text('100%');
					
					uploadQueue();
				});
			}
			
			$form.remove();
		}
		
		/*
		*	Iframe Upload Process
		*/
		function iframeUpload($form) {
			
			//show progress bar
			$uploadData = $form.parent();
			$uploadData.find('.progress').show();
			$percentage = $uploadData.find('.percentage');
			$progressBar = $uploadData.find('.progressBar');
			
			pcount = 0;
			dummyProgress($progressBar, $percentage);
			
			$form.submit();
			
			var id = pxWidget + ' #' + $form.attr('id');
			$(id +'_frame').load(function(){
				
				data = $(this).contents().find('body').html();
				
				afterEachUpload($form.attr('id'), data);
				
				clearTimeout ( progressTime );
				progress = 100;
				$percentage.text(progress.toString() + '%');
				$progressBar.progressbar({
					value: progress
				});
				
				uploadQueue();
				
			});
		}
		
		/*
		*	Show the progress bar to the user
		*/
		function dummyProgress($progressBar, $percentage) {
			
			if (percentageInterval[pcount]) {
				progress = percentageInterval[pcount] + Math.floor( Math.random() * 5 + 1 );
				$percentage.text(progress.toString() + '%');
				$progressBar.progressbar({
					value: progress
				});
			}
			
			if (timeInterval[pcount]) {
				progressTime = setTimeout(function(){
					dummyProgress($progressBar, $percentage)
				}, timeInterval[pcount] * 1000);
			}
			
			pcount++;
		}
		
		/*
		*	before Upload
		*/
		function beforeAllUpload() {
			//trigger before upload callback
			$continue = config.beforeUpload(e, pxButton);
			if ($continue === false) {			
				return false;
			}
			
			//Show Cancle Button
			toogleCancel(true);
			
			//process and queue upload
			uploadQueue();
		}
		
		/*
		* Before Each file is uploaded
		*/
		function beforeEachUpload($form) {
			
			//trigger before upload callback
			config.beforeEachUpload($form);
			
			$uploadData = $form.parent();
			$uploadData.find('.status').text('Uploading...');
			$uploadData.removeClass('pending').addClass('uploading');
			$uploadData.find('.delete').removeClass('delete').addClass('cancel').attr('title', 'Cancel');
		}
		
		/*
		* After Each file is uploaded
		*/
		function afterEachUpload(formId, data, status, errorThrown) {
			
			if (data) {
				data = $('<div>').append(data);
				status = $(data).find('#status').text();
			}
			
			formId = pxWidget + ' #' + formId;
			$uploadData = $(formId + '_text');
			
			if (status == 'success'){
				
				$uploadData.removeClass('uploading').addClass('success');
				$uploadData.children('.status').html( $(data).find('#message').text() );
				
			} else if (status == 'error'){
				
				$uploadData.removeClass('uploading').addClass('error');
				
				//if client side error other display error from backend
				if (errorThrown) {
					$uploadData.children('.status').html( errorThrown );
				} else {
					$uploadData.children('.status').html( $(data).find('#message').text() );
				}
				
			} else if (status == 'abort') {
				
				$uploadData.removeClass('uploading').addClass('cancel');
				
				$uploadData.children('.status').html( 'Cancelled' );
			}
			
			$uploadData.find('.cancel').removeClass('cancel').addClass('delete').attr('title', 'Delete');
			
			//hide progress bar
			$uploadData.find('.progress').hide();
			
			//trigger after each upload
			config.afterEachUpload(data, status, $uploadData);
			
			$(formId).remove();
			$(formId + '_frame').remove();
		}
		
		/*
		*	Toggle Cancel/Delete button
		*/
		function toogleCancel(cancel) {
			
			if (cancel) {
				//store button clear id
				buttonClearId = $(config.buttonClear, pxButton).attr('id');
				//Cancel Button
				$(config.buttonClear, pxButton).attr({ id: 'px-cancel', title: 'Cancel' });
			} else {
				//Clear button
				$('#px-cancel', pxButton).attr({ id: buttonClearId, title: 'Clear' });
			}
		}
		
		/*
		*	Onlick submit button: start upload
		*/
		$(config.buttonUpload, pxButton).click(function(){
			
			stopUpload = false;
			
			beforeAllUpload();
		});
		
		/*
		* Individual Upload
		*/
		$('.upload', pxUploadForm).live('click', function(){
			
			$form = $(this).parents('.upload-data').children('form');
			if ($form.length > 0) {
				
				//Show Cancle Button
				toogleCancel(true);
								
				//before upload
				beforeEachUpload( $form );
				
				if (isHtml5) {
					//Upload Using Html5 api
					html5Upload( $form );
				} else {
					
					//upload using iframe
					iframeUpload( $form );
				}
				
				stopUpload = true;
			}
		});
		
		//Button Clear Event
		$(config.buttonClear, pxButton).live('click', function(){
			$(pxUploadForm).fadeOut('slow',function(){
				$(this).empty();
				$(this).show();
				$(pxUploadFormInput).empty();
				
				itr = 1; //reset iteration
				limit = parseInt(config.limit);
				
				//print the First form
				px.printForm();
				
				//disable button
				$(buttonM).attr('disabled','disabled');
			});
		});
		
		$('.delete', pxUploadForm).live('click', function(){
			
			limit++;
			
			var id = pxWidget + ' #' + $(this).parents('.upload-data').data('formId');
			$(id+'_text').fadeOut('slow',function(){
				$(id+'_frame').remove();
				$(this).remove();
				
				//disable button
				if ($(pxUploadForm).find('form').length <= 1) {
					$(buttonM).attr('disabled','disabled');	
				}
			});
			
			//on file remove callback
			config.onFileRemove(this);
		});
		
		/*
		*	Cancel individual upload
		*/
		$('.cancel', pxUploadForm).live('click', function() {
			if (jqxhr) {
				jqxhr.abort();
			}
			
			if (!isHtml5) {
				$form = $(this).parents('.upload-data').children('form');
				$form.remove();
				afterEachUpload($form.attr('id'), null, 'abort', 'Cancelled');
			}
		});
		
		/*
		*	Cancel all uploads
		*/
		$('#px-cancel', pxButton).live('click', function(){
			stopUpload = true;
			if (jqxhr) {
				jqxhr.abort();
			}
			
			$('form', pxUploadForm).each(function(){
				afterEachUpload($(this).attr('id'), null, 'abort', 'Cancelled');
			});
			
			//Show Clear Button
			toogleCancel(false);
		});
		
		/* Icons hover */
		$(".px-widget .actions li").live("mouseover mouseout", function(event) {
			if ( event.type == "mouseover" ) {
				$(this).addClass('ui-state-hover');
			} else {
				$(this).removeClass("ui-state-hover");
			}
		});
		
		return this;
	}
})(jQuery);




/*
Copyright 2012 Igor Vaynberg
 
Version: 3.2 Timestamp: Mon Sep 10 10:38:04 PDT 2012

Licensed under the Apache License, Version 2.0 (the "License"); you may not use this work except in
compliance with the License. You may obtain a copy of the License in the LICENSE file, or at:

http://www.apache.org/licenses/LICENSE-2.0

Unless required by applicable law or agreed to in writing, software distributed under the License is
distributed on an "AS IS" BASIS, WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
See the License for the specific language governing permissions and limitations under the License.
*/
(function(e){"undefined"==typeof e.fn.each2&&e.fn.extend({each2:function(g){for(var i=e([0]),m=-1,s=this.length;++m<s&&(i.context=i[0]=this[m])&&!1!==g.call(i[0],m,i););return this}})})(jQuery);
(function(e,g){function i(a,b){var c=0,d=b.length,j;if("undefined"===typeof a)return-1;if(a.constructor===String)for(;c<d;c+=1){if(0===a.localeCompare(b[c]))return c}else for(;c<d;c+=1)if(j=b[c],j.constructor===String){if(0===j.localeCompare(a))return c}else if(j===a)return c;return-1}function m(a,b){return a===b?!0:a===g||b===g||null===a||null===b?!1:a.constructor===String?0===a.localeCompare(b):b.constructor===String?0===b.localeCompare(a):!1}function s(a,b){var c,d,j;if(null===a||1>a.length)return[];
c=a.split(b);d=0;for(j=c.length;d<j;d+=1)c[d]=e.trim(c[d]);return c}function A(a,b,c){var c=c||g,d;return function(){var j=arguments;window.clearTimeout(d);d=window.setTimeout(function(){b.apply(c,j)},a)}}function l(a){a.preventDefault();a.stopPropagation()}function B(a,b,c){var d=a.toUpperCase().indexOf(b.toUpperCase()),b=b.length;0>d?c.push(a):(c.push(a.substring(0,d)),c.push("<span class='select2-match'>"),c.push(a.substring(d,d+b)),c.push("</span>"),c.push(a.substring(d+b,a.length)))}function C(a){var b,
c=0,d=null,j=a.quietMillis||100;return function(h){window.clearTimeout(b);b=window.setTimeout(function(){var b=c+=1,j=a.data,n=a.transport||e.ajax,f=a.traditional||!1,g=a.type||"GET",j=j.call(this,h.term,h.page,h.context);null!==d&&d.abort();d=n.call(null,{url:a.url,dataType:a.dataType,data:j,type:g,traditional:f,success:function(d){b<c||(d=a.results(d,h.page),h.callback(d))}})},j)}}function D(a){var b=a,c,d=function(a){return""+a.text};e.isArray(b)||(d=b.text,e.isFunction(d)||(c=b.text,d=function(a){return a[c]}),
b=b.results);return function(a){var c=a.term,f={results:[]},k;if(c==="")a.callback({results:b});else{k=function(b,f){var g,t,b=b[0];if(b.children){g={};for(t in b)b.hasOwnProperty(t)&&(g[t]=b[t]);g.children=[];e(b.children).each2(function(a,b){k(b,g.children)});g.children.length&&f.push(g)}else a.matcher(c,d(b))&&f.push(b)};e(b).each2(function(a,b){k(b,f.results)});a.callback(f)}}}function E(a){return e.isFunction(a)?a:function(b){var c=b.term,d={results:[]};e(a).each(function(){var a=this.text!==
g,e=a?this.text:this;if(""===c||b.matcher(c,e))d.results.push(a?this:{id:this,text:this})});b.callback(d)}}function u(a){if(e.isFunction(a))return!0;if(!a)return!1;throw Error("formatterName must be a function or a falsy value");}function v(a){return e.isFunction(a)?a():a}function F(a){var b=0;e.each(a,function(a,d){d.children?b+=F(d.children):b++});return b}function H(a,b,c,d){var e=a,h=!1,f,k,n,o;if(!d.createSearchChoice||!d.tokenSeparators||1>d.tokenSeparators.length)return g;for(;;){h=-1;k=0;
for(n=d.tokenSeparators.length;k<n&&!(o=d.tokenSeparators[k],h=a.indexOf(o),0<=h);k++);if(0>h)break;f=a.substring(0,h);a=a.substring(h+o.length);if(0<f.length&&(f=d.createSearchChoice(f,b),f!==g&&null!==f&&d.id(f)!==g&&null!==d.id(f))){h=!1;k=0;for(n=b.length;k<n;k++)if(m(d.id(f),d.id(b[k]))){h=!0;break}h||c(f)}}if(0!=e.localeCompare(a))return a}function x(a,b){var c=function(){};c.prototype=new a;c.prototype.constructor=c;c.prototype.parent=a.prototype;c.prototype=e.extend(c.prototype,b);return c}
if(window.Select2===g){var f,w,y,z,G,q;f={TAB:9,ENTER:13,ESC:27,SPACE:32,LEFT:37,UP:38,RIGHT:39,DOWN:40,SHIFT:16,CTRL:17,ALT:18,PAGE_UP:33,PAGE_DOWN:34,HOME:36,END:35,BACKSPACE:8,DELETE:46,isArrow:function(a){a=a.which?a.which:a;switch(a){case f.LEFT:case f.RIGHT:case f.UP:case f.DOWN:return!0}return!1},isControl:function(a){switch(a.which){case f.SHIFT:case f.CTRL:case f.ALT:return!0}return a.metaKey?!0:!1},isFunctionKey:function(a){a=a.which?a.which:a;return 112<=a&&123>=a}};var I=1;G=function(){return I++};
e(document).delegate("body","mousemove",function(a){e.data(document,"select2-lastpos",{x:a.pageX,y:a.pageY})});e(document).ready(function(){e(document).delegate("body","mousedown touchend",function(a){var b=e(a.target).closest("div.select2-container").get(0),c;b?e(document).find("div.select2-container-active").each(function(){this!==b&&e(this).data("select2").blur()}):(b=e(a.target).closest("div.select2-drop").get(0),e(document).find("div.select2-drop-active").each(function(){this!==b&&e(this).data("select2").blur()}));
b=e(a.target);c=b.attr("for");"LABEL"===a.target.tagName&&(c&&0<c.length)&&(b=e("#"+c),b=b.data("select2"),b!==g&&(b.focus(),a.preventDefault()))})});w=x(Object,{bind:function(a){var b=this;return function(){a.apply(b,arguments)}},init:function(a){var b,c;this.opts=a=this.prepareOpts(a);this.id=a.id;a.element.data("select2")!==g&&null!==a.element.data("select2")&&this.destroy();this.enabled=!0;this.container=this.createContainer();this.containerId="s2id_"+(a.element.attr("id")||"autogen"+G());this.containerSelector=
"#"+this.containerId.replace(/([;&,\.\+\*\~':"\!\^#$%@\[\]\(\)=>\|])/g,"\\$1");this.container.attr("id",this.containerId);var d=!1,j;this.body=function(){!1===d&&(j=a.element.closest("body"),d=!0);return j};a.element.attr("class")!==g&&this.container.addClass(a.element.attr("class").replace(/validate\[[\S ]+] ?/,""));this.container.css(v(a.containerCss));this.container.addClass(v(a.containerCssClass));this.opts.element.data("select2",this).hide().before(this.container);this.container.data("select2",
this);this.dropdown=this.container.find(".select2-drop");this.dropdown.addClass(v(a.dropdownCssClass));this.dropdown.data("select2",this);this.results=b=this.container.find(".select2-results");this.search=c=this.container.find("input.select2-input");c.attr("tabIndex",this.opts.element.attr("tabIndex"));this.resultsPage=0;this.context=null;this.initContainer();this.initContainerWidth();this.results.bind("mousemove",function(a){var b=e.data(document,"select2-lastpos");(b===g||b.x!==a.pageX||b.y!==a.pageY)&&
e(a.target).trigger("mousemove-filtered",a)});this.dropdown.delegate(".select2-results","mousemove-filtered",this.bind(this.highlightUnderEvent));var h=this.results,f=A(80,function(a){h.trigger("scroll-debounced",a)});h.bind("scroll",function(a){0<=i(a.target,h.get())&&f(a)});this.dropdown.delegate(".select2-results","scroll-debounced",this.bind(this.loadMoreIfNeeded));e.fn.mousewheel&&b.mousewheel(function(a,c,d,e){c=b.scrollTop();0<e&&0>=c-e?(b.scrollTop(0),l(a)):0>e&&b.get(0).scrollHeight-b.scrollTop()+
e<=b.height()&&(b.scrollTop(b.get(0).scrollHeight-b.height()),l(a))});c.bind("keydown",function(){e.data(c,"keyup-change-value")===g&&e.data(c,"keyup-change-value",c.val())});c.bind("keyup",function(){var a=e.data(c,"keyup-change-value");a!==g&&c.val()!==a&&(e.removeData(c,"keyup-change-value"),c.trigger("keyup-change"))});c.bind("keyup-change",this.bind(this.updateResults));c.bind("focus",function(){c.addClass("select2-focused");" "===c.val()&&c.val("")});c.bind("blur",function(){c.removeClass("select2-focused")});
this.dropdown.delegate(".select2-results","mouseup",this.bind(function(a){0<e(a.target).closest(".select2-result-selectable:not(.select2-disabled)").length?(this.highlightUnderEvent(a),this.selectHighlighted(a)):this.focusSearch();l(a)}));this.dropdown.bind("click mouseup mousedown",function(a){a.stopPropagation()});e.isFunction(this.opts.initSelection)&&(this.initSelection(),this.monitorSource());(a.element.is(":disabled")||a.element.is("[readonly='readonly']"))&&this.disable()},destroy:function(){var a=
this.opts.element.data("select2");a!==g&&(a.container.remove(),a.dropdown.remove(),a.opts.element.removeData("select2").unbind(".select2").show())},prepareOpts:function(a){var b,c,d;b=a.element;"select"===b.get(0).tagName.toLowerCase()&&(this.select=c=a.element);c&&e.each("id multiple ajax query createSearchChoice initSelection data tags".split(" "),function(){if(this in a)throw Error("Option '"+this+"' is not allowed for Select2 when attached to a <select> element.");});a=e.extend({},{populateResults:function(b,
c,d){var f,n=this.opts.id,o=this;f=function(b,c,j){var h,l,i,m,r,p,q;h=0;for(l=b.length;h<l;h=h+1){i=b[h];m=n(i)!==g;r=i.children&&i.children.length>0;p=e("<li></li>");p.addClass("select2-results-dept-"+j);p.addClass("select2-result");p.addClass(m?"select2-result-selectable":"select2-result-unselectable");r&&p.addClass("select2-result-with-children");p.addClass(o.opts.formatResultCssClass(i));m=e("<div></div>");m.addClass("select2-result-label");q=a.formatResult(i,m,d);q!==g&&m.html(o.opts.escapeMarkup(q));
p.append(m);if(r){r=e("<ul></ul>");r.addClass("select2-result-sub");f(i.children,r,j+1);p.append(r)}p.data("select2-data",i);c.append(p)}};f(c,b,0)}},e.fn.select2.defaults,a);"function"!==typeof a.id&&(d=a.id,a.id=function(a){return a[d]});if(c)a.query=this.bind(function(a){var c={results:[],more:false},d=a.term,f,n,o;o=function(b,c){var e;if(b.is("option"))a.matcher(d,b.text(),b)&&c.push({id:b.attr("value"),text:b.text(),element:b.get(),css:b.attr("class")});else if(b.is("optgroup")){e={text:b.attr("label"),
children:[],element:b.get(),css:b.attr("class")};b.children().each2(function(a,b){o(b,e.children)});e.children.length>0&&c.push(e)}};f=b.children();if(this.getPlaceholder()!==g&&f.length>0){n=f[0];e(n).text()===""&&(f=f.not(n))}f.each2(function(a,b){o(b,c.results)});a.callback(c)}),a.id=function(a){return a.id},a.formatResultCssClass=function(a){return a.css};else if(!("query"in a))if("ajax"in a){if((c=a.element.data("ajax-url"))&&0<c.length)a.ajax.url=c;a.query=C(a.ajax)}else"data"in a?a.query=D(a.data):
"tags"in a&&(a.query=E(a.tags),a.createSearchChoice=function(a){return{id:a,text:a}},a.initSelection=function(b,c){var d=[];e(s(b.val(),a.separator)).each(function(){var b=this,c=this,j=a.tags;e.isFunction(j)&&(j=j());e(j).each(function(){if(m(this.id,b)){c=this.text;return false}});d.push({id:b,text:c})});c(d)});if("function"!==typeof a.query)throw"query function not defined for Select2 "+a.element.attr("id");return a},monitorSource:function(){this.opts.element.bind("change.select2",this.bind(function(){!0!==
this.opts.element.data("select2-change-triggered")&&this.initSelection()}))},triggerChange:function(a){a=a||{};a=e.extend({},a,{type:"change",val:this.val()});this.opts.element.data("select2-change-triggered",!0);this.opts.element.trigger(a);this.opts.element.data("select2-change-triggered",!1);this.opts.element.click();this.opts.blurOnChange&&this.opts.element.blur()},enable:function(){this.enabled||(this.enabled=!0,this.container.removeClass("select2-container-disabled"))},disable:function(){this.enabled&&
(this.close(),this.enabled=!1,this.container.addClass("select2-container-disabled"))},opened:function(){return this.container.hasClass("select2-dropdown-open")},positionDropdown:function(){var a=this.container.offset(),b=this.container.outerHeight(),c=this.container.outerWidth(),d=this.dropdown.outerHeight(),j=e(window).scrollTop()+document.documentElement.clientHeight,b=a.top+b,f=a.left,j=b+d<=j,g=a.top-d>=this.body().scrollTop(),k=this.dropdown.hasClass("select2-drop-above"),n;"static"!==this.body().css("position")&&
(n=this.body().offset(),b-=n.top,f-=n.left);k?(k=!0,!g&&j&&(k=!1)):(k=!1,!j&&g&&(k=!0));k?(b=a.top-d,this.container.addClass("select2-drop-above"),this.dropdown.addClass("select2-drop-above")):(this.container.removeClass("select2-drop-above"),this.dropdown.removeClass("select2-drop-above"));a=e.extend({top:b,left:f,width:c},v(this.opts.dropdownCss));this.dropdown.css(a)},shouldOpen:function(){var a;if(this.opened())return!1;a=e.Event("open");this.opts.element.trigger(a);return!a.isDefaultPrevented()},
clearDropdownAlignmentPreference:function(){this.container.removeClass("select2-drop-above");this.dropdown.removeClass("select2-drop-above")},open:function(){if(!this.shouldOpen())return!1;window.setTimeout(this.bind(this.opening),1);return!0},opening:function(){var a=this.containerId,b=this.containerSelector,c="scroll."+a,d="resize."+a;this.container.parents().each(function(){e(this).bind(c,function(){var a=e(b);0==a.length&&e(this).unbind(c);a.select2("close")})});e(window).bind(d,function(){var a=
e(b);0==a.length&&e(window).unbind(d);a.select2("close")});this.clearDropdownAlignmentPreference();" "===this.search.val()&&this.search.val("");this.container.addClass("select2-dropdown-open").addClass("select2-container-active");this.updateResults(!0);this.dropdown[0]!==this.body().children().last()[0]&&this.dropdown.detach().appendTo(this.body());this.dropdown.show();this.positionDropdown();this.dropdown.addClass("select2-drop-active");this.ensureHighlightVisible();this.focusSearch()},close:function(){if(this.opened()){var a=
this;this.container.parents().each(function(){e(this).unbind("scroll."+a.containerId)});e(window).unbind("resize."+this.containerId);this.clearDropdownAlignmentPreference();this.dropdown.hide();this.container.removeClass("select2-dropdown-open").removeClass("select2-container-active");this.results.empty();this.clearSearch();this.opts.element.trigger(e.Event("close"))}},clearSearch:function(){},ensureHighlightVisible:function(){var a=this.results,b,c,d,f;c=this.highlight();0>c||(0==c?a.scrollTop(0):
(b=a.find(".select2-result-selectable"),d=e(b[c]),f=d.offset().top+d.outerHeight(),c===b.length-1&&(b=a.find("li.select2-more-results"),0<b.length&&(f=b.offset().top+b.outerHeight())),b=a.offset().top+a.outerHeight(),f>b&&a.scrollTop(a.scrollTop()+(f-b)),d=d.offset().top-a.offset().top,0>d&&a.scrollTop(a.scrollTop()+d)))},moveHighlight:function(a){for(var b=this.results.find(".select2-result-selectable"),c=this.highlight();-1<c&&c<b.length;){var c=c+a,d=e(b[c]);if(d.hasClass("select2-result-selectable")&&
!d.hasClass("select2-disabled")){this.highlight(c);break}}},highlight:function(a){var b=this.results.find(".select2-result-selectable").not(".select2-disabled");if(0===arguments.length)return i(b.filter(".select2-highlighted")[0],b.get());a>=b.length&&(a=b.length-1);0>a&&(a=0);b.removeClass("select2-highlighted");e(b[a]).addClass("select2-highlighted");this.ensureHighlightVisible()},countSelectableResults:function(){return this.results.find(".select2-result-selectable").not(".select2-disabled").length},
highlightUnderEvent:function(a){a=e(a.target).closest(".select2-result-selectable");if(0<a.length&&!a.is(".select2-highlighted")){var b=this.results.find(".select2-result-selectable");this.highlight(b.index(a))}else 0==a.length&&this.results.find(".select2-highlighted").removeClass("select2-highlighted")},loadMoreIfNeeded:function(){var a=this.results,b=a.find("li.select2-more-results"),c,d=this.resultsPage+1,e=this,f=this.search.val(),g=this.context;0!==b.length&&(c=b.offset().top-a.offset().top-
a.height(),0>=c&&(b.addClass("select2-active"),this.opts.query({term:f,page:d,context:g,matcher:this.opts.matcher,callback:this.bind(function(c){e.opened()&&(e.opts.populateResults.call(this,a,c.results,{term:f,page:d,context:g}),!0===c.more?(b.detach().appendTo(a).text(e.opts.formatLoadMore(d+1)),window.setTimeout(function(){e.loadMoreIfNeeded()},10)):b.remove(),e.positionDropdown(),e.resultsPage=d)})})))},tokenize:function(){},updateResults:function(a){function b(){f.scrollTop(0);d.removeClass("select2-active");
k.positionDropdown()}function c(a){f.html(k.opts.escapeMarkup(a));b()}var d=this.search,f=this.results,h=this.opts,i,k=this;if(!(!0!==a&&(!1===this.showSearchInput||!this.opened()))){d.addClass("select2-active");if(1<=h.maximumSelectionSize&&(i=this.data(),e.isArray(i)&&i.length>=h.maximumSelectionSize&&u(h.formatSelectionTooBig,"formatSelectionTooBig"))){c("<li class='select2-selection-limit'>"+h.formatSelectionTooBig(h.maximumSelectionSize)+"</li>");return}d.val().length<h.minimumInputLength&&u(h.formatInputTooShort,
"formatInputTooShort")?c("<li class='select2-no-results'>"+h.formatInputTooShort(d.val(),h.minimumInputLength)+"</li>"):(c("<li class='select2-searching'>"+h.formatSearching()+"</li>"),i=this.tokenize(),i!=g&&null!=i&&d.val(i),this.resultsPage=1,h.query({term:d.val(),page:this.resultsPage,context:null,matcher:h.matcher,callback:this.bind(function(i){var l;this.opened()&&((this.context=i.context===g?null:i.context,this.opts.createSearchChoice&&""!==d.val()&&(l=this.opts.createSearchChoice.call(null,
d.val(),i.results),l!==g&&null!==l&&k.id(l)!==g&&null!==k.id(l)&&0===e(i.results).filter(function(){return m(k.id(this),k.id(l))}).length&&i.results.unshift(l)),0===i.results.length&&u(h.formatNoMatches,"formatNoMatches"))?c("<li class='select2-no-results'>"+h.formatNoMatches(d.val())+"</li>"):(f.empty(),k.opts.populateResults.call(this,f,i.results,{term:d.val(),page:this.resultsPage,context:null}),!0===i.more&&u(h.formatLoadMore,"formatLoadMore")&&(f.append("<li class='select2-more-results'>"+k.opts.escapeMarkup(h.formatLoadMore(this.resultsPage))+
"</li>"),window.setTimeout(function(){k.loadMoreIfNeeded()},10)),this.postprocessResults(i,a),b()))})}))}},cancel:function(){this.close()},blur:function(){this.close();this.container.removeClass("select2-container-active");this.dropdown.removeClass("select2-drop-active");this.search[0]===document.activeElement&&this.search.blur();this.clearSearch();this.selection.find(".select2-search-choice-focus").removeClass("select2-search-choice-focus")},focusSearch:function(){this.search.show();this.search.focus();
window.setTimeout(this.bind(function(){this.search.show();this.search.focus();this.search.val(this.search.val())}),10)},selectHighlighted:function(){var a=this.highlight(),b=this.results.find(".select2-highlighted").not(".select2-disabled"),c=b.closest(".select2-result-selectable").data("select2-data");c&&(b.addClass("select2-disabled"),this.highlight(a),this.onSelect(c))},getPlaceholder:function(){return this.opts.element.attr("placeholder")||this.opts.element.attr("data-placeholder")||this.opts.element.data("placeholder")||
this.opts.placeholder},initContainerWidth:function(){var a=function(){var a,c,d,f;if("off"===this.opts.width)return null;if("element"===this.opts.width)return 0===this.opts.element.outerWidth()?"auto":this.opts.element.outerWidth()+"px";if("copy"===this.opts.width||"resolve"===this.opts.width){a=this.opts.element.attr("style");if(a!==g){a=a.split(";");d=0;for(f=a.length;d<f;d+=1)if(c=a[d].replace(/\s/g,"").match(/width:(([-+]?([0-9]*\.)?[0-9]+)(px|em|ex|%|in|cm|mm|pt|pc))/),null!==c&&1<=c.length)return c[1]}return"resolve"===
this.opts.width?(a=this.opts.element.css("width"),0<a.indexOf("%")?a:0===this.opts.element.outerWidth()?"auto":this.opts.element.outerWidth()+"px"):null}return e.isFunction(this.opts.width)?this.opts.width():this.opts.width}.call(this);null!==a&&this.container.attr("style","width: "+a)}});y=x(w,{createContainer:function(){return e("<div></div>",{"class":"select2-container"}).html("    <a href='#' onclick='return false;' class='select2-choice'>   <span></span><abbr class='select2-search-choice-close' style='display:none;'></abbr>   <div><b></b></div></a>    <div class='select2-drop select2-offscreen'>   <div class='select2-search'>       <input type='text' autocomplete='off' class='select2-input'/>   </div>   <ul class='select2-results'>   </ul></div>")},
opening:function(){this.search.show();this.parent.opening.apply(this,arguments);this.dropdown.removeClass("select2-offscreen")},close:function(){this.opened()&&(this.parent.close.apply(this,arguments),this.dropdown.removeAttr("style").addClass("select2-offscreen").insertAfter(this.selection).show())},focus:function(){this.close();this.selection.focus()},isFocused:function(){return this.selection[0]===document.activeElement},cancel:function(){this.parent.cancel.apply(this,arguments);this.selection.focus()},
initContainer:function(){var a,b=this.dropdown;this.selection=a=this.container.find(".select2-choice");this.search.bind("keydown",this.bind(function(a){if(this.enabled)if(a.which===f.PAGE_UP||a.which===f.PAGE_DOWN)l(a);else if(this.opened())switch(a.which){case f.UP:case f.DOWN:this.moveHighlight(a.which===f.UP?-1:1);l(a);break;case f.TAB:case f.ENTER:this.selectHighlighted();l(a);break;case f.ESC:this.cancel(a),l(a)}else a.which===f.TAB||f.isControl(a)||f.isFunctionKey(a)||a.which===f.ESC||!1===
this.opts.openOnEnter&&a.which===f.ENTER||this.open()}));this.search.bind("focus",this.bind(function(){this.selection.attr("tabIndex","-1")}));this.search.bind("blur",this.bind(function(){this.opened()||this.container.removeClass("select2-container-active");window.setTimeout(this.bind(function(){this.selection.attr("tabIndex",this.opts.element.attr("tabIndex"))}),10)}));a.bind("mousedown",this.bind(function(){this.opened()?(this.close(),this.selection.focus()):this.enabled&&this.open()}));b.bind("mousedown",
this.bind(function(){this.search.focus()}));a.bind("focus",this.bind(function(){this.container.addClass("select2-container-active");this.search.attr("tabIndex","-1")}));a.bind("blur",this.bind(function(){this.opened()||this.container.removeClass("select2-container-active");window.setTimeout(this.bind(function(){this.search.attr("tabIndex",this.opts.element.attr("tabIndex"))}),10)}));a.bind("keydown",this.bind(function(a){if(this.enabled)if(a.which===f.PAGE_UP||a.which===f.PAGE_DOWN)l(a);else if(!(a.which===
f.TAB||f.isControl(a)||f.isFunctionKey(a)||a.which===f.ESC)&&!(!1===this.opts.openOnEnter&&a.which===f.ENTER))if(a.which==f.DELETE)this.opts.allowClear&&this.clear();else{this.open();if(a.which!==f.ENTER&&!(48>a.which)){var b=String.fromCharCode(a.which).toLowerCase();a.shiftKey&&(b=b.toUpperCase());this.search.focus();this.search.val(b)}l(a)}}));a.delegate("abbr","mousedown",this.bind(function(a){this.enabled&&(this.clear(),l(a),this.close(),this.triggerChange(),this.selection.focus())}));this.setPlaceholder();
this.search.bind("focus",this.bind(function(){this.container.addClass("select2-container-active")}))},clear:function(){this.opts.element.val("");this.selection.find("span").empty();this.selection.removeData("select2-data");this.setPlaceholder()},initSelection:function(){if(""===this.opts.element.val())this.close(),this.setPlaceholder();else{var a=this;this.opts.initSelection.call(null,this.opts.element,function(b){b!==g&&null!==b&&(a.updateSelection(b),a.close(),a.setPlaceholder())})}},prepareOpts:function(){var a=
this.parent.prepareOpts.apply(this,arguments);"select"===a.element.get(0).tagName.toLowerCase()&&(a.initSelection=function(a,c){var d=a.find(":selected");e.isFunction(c)&&c({id:d.attr("value"),text:d.text()})});return a},setPlaceholder:function(){var a=this.getPlaceholder();""===this.opts.element.val()&&a!==g&&!(this.select&&""!==this.select.find("option:first").text())&&(this.selection.find("span").html(this.opts.escapeMarkup(a)),this.selection.addClass("select2-default"),this.selection.find("abbr").hide())},
postprocessResults:function(a,b){var c=0,d=this,f=!0;this.results.find(".select2-result-selectable").each2(function(a,b){if(m(d.id(b.data("select2-data")),d.opts.element.val()))return c=a,!1});this.highlight(c);!0===b&&(f=this.showSearchInput=F(a.results)>=this.opts.minimumResultsForSearch,this.dropdown.find(".select2-search")[f?"removeClass":"addClass"]("select2-search-hidden"),e(this.dropdown,this.container)[f?"addClass":"removeClass"]("select2-with-searchbox"))},onSelect:function(a){var b=this.opts.element.val();
this.opts.element.val(this.id(a));this.updateSelection(a);this.close();this.selection.focus();m(b,this.id(a))||this.triggerChange()},updateSelection:function(a){var b=this.selection.find("span");this.selection.data("select2-data",a);b.empty();a=this.opts.formatSelection(a,b);a!==g&&b.append(this.opts.escapeMarkup(a));this.selection.removeClass("select2-default");this.opts.allowClear&&this.getPlaceholder()!==g&&this.selection.find("abbr").show()},val:function(){var a,b=null,c=this;if(0===arguments.length)return this.opts.element.val();
a=arguments[0];if(this.select)this.select.val(a).find(":selected").each2(function(a,c){b={id:c.attr("value"),text:c.text()};return!1}),this.updateSelection(b),this.setPlaceholder();else{if(this.opts.initSelection===g)throw Error("cannot call val() if initSelection() is not defined");a?(this.opts.element.val(a),this.opts.initSelection(this.opts.element,function(a){c.opts.element.val(!a?"":c.id(a));c.updateSelection(a);c.setPlaceholder()})):this.clear()}},clearSearch:function(){this.search.val("")},
data:function(a){var b;if(0===arguments.length)return b=this.selection.data("select2-data"),b==g&&(b=null),b;!a||""===a?this.clear():(this.opts.element.val(!a?"":this.id(a)),this.updateSelection(a))}});z=x(w,{createContainer:function(){return e("<div></div>",{"class":"select2-container select2-container-multi"}).html("    <ul class='select2-choices'>  <li class='select2-search-field'>    <input type='text' autocomplete='off' class='select2-input'>  </li></ul><div class='select2-drop select2-drop-multi' style='display:none;'>   <ul class='select2-results'>   </ul></div>")},
prepareOpts:function(){var a=this.parent.prepareOpts.apply(this,arguments);"select"===a.element.get(0).tagName.toLowerCase()&&(a.initSelection=function(a,c){var d=[];a.find(":selected").each2(function(a,b){d.push({id:b.attr("value"),text:b.text()})});e.isFunction(c)&&c(d)});return a},initContainer:function(){var a;this.searchContainer=this.container.find(".select2-search-field");this.selection=a=this.container.find(".select2-choices");this.search.bind("keydown",this.bind(function(b){if(this.enabled){if(b.which===
f.BACKSPACE&&""===this.search.val()){this.close();var c;c=a.find(".select2-search-choice-focus");if(0<c.length){this.unselect(c.first());this.search.width(10);l(b);return}c=a.find(".select2-search-choice");0<c.length&&c.last().addClass("select2-search-choice-focus")}else a.find(".select2-search-choice-focus").removeClass("select2-search-choice-focus");if(this.opened())switch(b.which){case f.UP:case f.DOWN:this.moveHighlight(b.which===f.UP?-1:1);l(b);return;case f.ENTER:case f.TAB:this.selectHighlighted();
l(b);return;case f.ESC:this.cancel(b);l(b);return}if(!(b.which===f.TAB||f.isControl(b)||f.isFunctionKey(b)||b.which===f.BACKSPACE||b.which===f.ESC)&&!(!1===this.opts.openOnEnter&&b.which===f.ENTER))this.open(),(b.which===f.PAGE_UP||b.which===f.PAGE_DOWN)&&l(b)}}));this.search.bind("keyup",this.bind(this.resizeSearch));this.search.bind("blur",this.bind(function(a){this.container.removeClass("select2-container-active");this.search.removeClass("select2-focused");this.clearSearch();a.stopImmediatePropagation()}));
this.container.delegate(".select2-choices","mousedown",this.bind(function(a){this.enabled&&!(0<e(a.target).closest(".select2-search-choice").length)&&(this.clearPlaceholder(),this.open(),this.focusSearch(),a.preventDefault())}));this.container.delegate(".select2-choices","focus",this.bind(function(){this.enabled&&(this.container.addClass("select2-container-active"),this.dropdown.addClass("select2-drop-active"),this.clearPlaceholder())}));this.clearSearch()},enable:function(){this.enabled||(this.parent.enable.apply(this,
arguments),this.search.removeAttr("disabled"))},disable:function(){this.enabled&&(this.parent.disable.apply(this,arguments),this.search.attr("disabled",!0))},initSelection:function(){""===this.opts.element.val()&&(this.updateSelection([]),this.close(),this.clearSearch());if(this.select||""!==this.opts.element.val()){var a=this;this.opts.initSelection.call(null,this.opts.element,function(b){if(b!==g&&b!==null){a.updateSelection(b);a.close();a.clearSearch()}})}},clearSearch:function(){var a=this.getPlaceholder();
a!==g&&0===this.getVal().length&&!1===this.search.hasClass("select2-focused")?(this.search.val(a).addClass("select2-default"),this.resizeSearch()):this.search.val(" ").width(10)},clearPlaceholder:function(){this.search.hasClass("select2-default")?this.search.val("").removeClass("select2-default"):" "===this.search.val()&&this.search.val("")},opening:function(){this.parent.opening.apply(this,arguments);this.clearPlaceholder();this.resizeSearch();this.focusSearch()},close:function(){this.opened()&&
this.parent.close.apply(this,arguments)},focus:function(){this.close();this.search.focus()},isFocused:function(){return this.search.hasClass("select2-focused")},updateSelection:function(a){var b=[],c=[],d=this;e(a).each(function(){0>i(d.id(this),b)&&(b.push(d.id(this)),c.push(this))});a=c;this.selection.find(".select2-search-choice").remove();e(a).each(function(){d.addSelectedChoice(this)});d.postprocessResults()},tokenize:function(){var a=this.search.val(),a=this.opts.tokenizer(a,this.data(),this.bind(this.onSelect),
this.opts);null!=a&&a!=g&&(this.search.val(a),0<a.length&&this.open())},onSelect:function(a){this.addSelectedChoice(a);this.select&&this.postprocessResults();this.opts.closeOnSelect?(this.close(),this.search.width(10)):0<this.countSelectableResults()?(this.search.width(10),this.resizeSearch(),this.positionDropdown()):this.close();this.triggerChange({added:a});this.focusSearch()},cancel:function(){this.close();this.focusSearch()},addSelectedChoice:function(a){var b=e("<li class='select2-search-choice'>    <div></div>    <a href='#' onclick='return false;' class='select2-search-choice-close' tabindex='-1'></a></li>"),
c=this.id(a),d=this.getVal(),f;f=this.opts.formatSelection(a,b);b.find("div").replaceWith("<div>"+this.opts.escapeMarkup(f)+"</div>");b.find(".select2-search-choice-close").bind("mousedown",l).bind("click dblclick",this.bind(function(a){this.enabled&&(e(a.target).closest(".select2-search-choice").fadeOut("fast",this.bind(function(){this.unselect(e(a.target));this.selection.find(".select2-search-choice-focus").removeClass("select2-search-choice-focus");this.close();this.focusSearch()})).dequeue(),
l(a))})).bind("focus",this.bind(function(){this.enabled&&(this.container.addClass("select2-container-active"),this.dropdown.addClass("select2-drop-active"))}));b.data("select2-data",a);b.insertBefore(this.searchContainer);d.push(c);this.setVal(d)},unselect:function(a){var b=this.getVal(),c,d,a=a.closest(".select2-search-choice");if(0===a.length)throw"Invalid argument: "+a+". Must be .select2-search-choice";c=a.data("select2-data");d=i(this.id(c),b);0<=d&&(b.splice(d,1),this.setVal(b),this.select&&
this.postprocessResults());a.remove();this.triggerChange({removed:c})},postprocessResults:function(){var a=this.getVal(),b=this.results.find(".select2-result-selectable"),c=this.results.find(".select2-result-with-children"),d=this;b.each2(function(b,c){var e=d.id(c.data("select2-data"));0<=i(e,a)?c.addClass("select2-disabled").removeClass("select2-result-selectable"):c.removeClass("select2-disabled").addClass("select2-result-selectable")});c.each2(function(a,b){0==b.find(".select2-result-selectable").length?
b.addClass("select2-disabled"):b.removeClass("select2-disabled")});b.each2(function(a,b){if(!b.hasClass("select2-disabled")&&b.hasClass("select2-result-selectable"))return d.highlight(0),!1})},resizeSearch:function(){var a,b,c,d,f=this.search.outerWidth()-this.search.width();a=this.search;q||(c=a[0].currentStyle||window.getComputedStyle(a[0],null),q=e("<div></div>").css({position:"absolute",left:"-10000px",top:"-10000px",display:"none",fontSize:c.fontSize,fontFamily:c.fontFamily,fontStyle:c.fontStyle,
fontWeight:c.fontWeight,letterSpacing:c.letterSpacing,textTransform:c.textTransform,whiteSpace:"nowrap"}),e("body").append(q));q.text(a.val());a=q.width()+10;b=this.search.offset().left;c=this.selection.width();d=this.selection.offset().left;b=c-(b-d)-f;b<a&&(b=c-f);40>b&&(b=c-f);this.search.width(b)},getVal:function(){var a;if(this.select)return a=this.select.val(),null===a?[]:a;a=this.opts.element.val();return s(a,this.opts.separator)},setVal:function(a){var b;this.select?this.select.val(a):(b=
[],e(a).each(function(){0>i(this,b)&&b.push(this)}),this.opts.element.val(0===b.length?"":b.join(this.opts.separator)))},val:function(){var a,b=[],c=this;if(0===arguments.length)return this.getVal();if(a=arguments[0])if(this.setVal(a),this.select)this.select.find(":selected").each(function(){b.push({id:e(this).attr("value"),text:e(this).text()})}),this.updateSelection(b);else{if(this.opts.initSelection===g)throw Error("val() cannot be called if initSelection() is not defined");this.opts.initSelection(this.opts.element,
function(a){var b=e(a).map(c.id);c.setVal(b);c.updateSelection(a);c.clearSearch()})}else this.opts.element.val(""),this.updateSelection([]);this.clearSearch()},onSortStart:function(){if(this.select)throw Error("Sorting of elements is not supported when attached to <select>. Attach to <input type='hidden'/> instead.");this.search.width(0);this.searchContainer.hide()},onSortEnd:function(){var a=[],b=this;this.searchContainer.show();this.searchContainer.appendTo(this.searchContainer.parent());this.resizeSearch();
this.selection.find(".select2-search-choice").each(function(){a.push(b.opts.id(e(this).data("select2-data")))});this.setVal(a);this.triggerChange()},data:function(a){var b=this,c;if(0===arguments.length)return this.selection.find(".select2-search-choice").map(function(){return e(this).data("select2-data")}).get();a||(a=[]);c=e.map(a,function(a){return b.opts.id(a)});this.setVal(c);this.updateSelection(a);this.clearSearch()}});e.fn.select2=function(){var a=Array.prototype.slice.call(arguments,0),b,
c,d,f,h="val destroy opened open close focus isFocused container onSortStart onSortEnd enable disable positionDropdown data".split(" ");this.each(function(){if(0===a.length||"object"===typeof a[0])b=0===a.length?{}:e.extend({},a[0]),b.element=e(this),"select"===b.element.get(0).tagName.toLowerCase()?f=b.element.attr("multiple"):(f=b.multiple||!1,"tags"in b&&(b.multiple=f=!0)),c=f?new z:new y,c.init(b);else if("string"===typeof a[0]){if(0>i(a[0],h))throw"Unknown method: "+a[0];d=g;c=e(this).data("select2");
if(c!==g&&(d="container"===a[0]?c.container:c[a[0]].apply(c,a.slice(1)),d!==g))return!1}else throw"Invalid arguments to select2 plugin: "+a;});return d===g?this:d};e.fn.select2.defaults={width:"copy",closeOnSelect:!0,openOnEnter:!0,containerCss:{},dropdownCss:{},containerCssClass:"",dropdownCssClass:"",formatResult:function(a,b,c){b=[];B(a.text,c.term,b);return b.join("")},formatSelection:function(a){return a?a.text:g},formatResultCssClass:function(){return g},formatNoMatches:function(){return"No matches found"},
formatInputTooShort:function(a,b){return"Please enter "+(b-a.length)+" more characters"},formatSelectionTooBig:function(a){return"You can only select "+a+" item"+(1==a?"":"s")},formatLoadMore:function(){return"Loading more results..."},formatSearching:function(){return"Searching..."},minimumResultsForSearch:0,minimumInputLength:0,maximumSelectionSize:0,id:function(a){return a.id},matcher:function(a,b){return 0<=b.toUpperCase().indexOf(a.toUpperCase())},separator:",",tokenSeparators:[],tokenizer:H,
escapeMarkup:function(a){return a&&"string"===typeof a?a.replace(/&/g,"&amp;"):a},blurOnChange:!1};window.Select2={query:{ajax:C,local:D,tags:E},util:{debounce:A,markMatch:B},"class":{"abstract":w,single:y,multi:z}}}})(jQuery);





/* AxBOS Bootstrap file */

/* Defines global symbols. Sets default settings for libraries and frameworks */
/* Instantiates, initializate and configures Classes, Libs and Frameworks. */
/* Binds the events of some UI html elements to their respective actions */
/* Execute some required hacks and workarounds to ensure full integration and
maximal portability and availability */


$(document).ready(function() {
	
if ( typeof $('#busy-indicator')=='object') {
	$('#busy-indicator').ajaxStart( function() {
		$(this).show();
	});
	$('#busy-indicator').ajaxStop( function() {
		$(this).hide();
	});
}

if ( typeof $('.dropdown-toggle') != 'undefined' ) {
	$('.dropdown-toggle').dropdown();
}

// jQuery Gritter Defaults (Visual Notifications, Growl's style)
$.extend($.gritter.options, { 
    position: 'top-right', // defaults to 'top-right' but can be 'bottom-left', 'bottom-right', 'top-left', 'top-right' (added in 1.7.1)
	fade_in_speed: 'fast', // how fast notifications fade in (string or int)
	fade_out_speed: 2000, // how fast the notices fade out
	time: 4000, // hang on the screen for...
	sticky: true,
});


}); // end: $(document).ready(func...)

