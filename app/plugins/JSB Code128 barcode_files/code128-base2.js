new function() {

  var Barcode = new base2.Package(this, {
    name:    "Barcode",
    version: "0.1.4",
    exports: "code128, code128behaviour"
  });

  eval(this.imports); 

  var BARS       = [212222,222122,222221,121223,121322,131222,122213,122312,132212,221213,221312,231212,112232,122132,122231,113222,123122,123221,223211,221132,221231,213212,223112,312131,311222,321122,321221,312212,322112,322211,212123,212321,232121,111323,131123,131321,112313,132113,132311,211313,231113,231311,112133,112331,132131,113123,113321,133121,313121,211331,231131,213113,213311,213131,311123,311321,331121,312113,312311,332111,314111,221411,431111,111224,111422,121124,121421,141122,141221,112214,112412,122114,122411,142112,142211,241211,221114,413111,241112,134111,111242,121142,121241,114212,124112,124211,411212,421112,421211,212141,214121,412121,111143,111341,131141,114113,114311,411113,411311,113141,114131,311141,411131,211412,211214,211232,23311120]
    , START_BASE = 38
    , STOP       = 106 //BARS[STOP]==23311120 (manually added a zero at the end)
    ;

  function code128(code, barcodeType) {
    if (arguments.length<2) barcodeType = code128Detect(code);
    if (barcodeType=='C' && code.length%2==1) code = '0'+code; 
    var a = parseBarcode(code,  barcodeType);
    return bar2html(a.join('')) + '<label>' + code + '</label>'; 
  }

  function bar2html(s) {
    for(var pos=0, sb=[]; pos<s.length; pos+=2) {
      sb.push('<div class="bar' + s.charAt(pos) + ' space' + s.charAt(pos+1) + '"></div>');
    }
    return sb.join('');
  }

  function code128Detect(code) {
    if (/^[0-9]+$/.test(code)) return 'C';
    if (/[a-z]/.test(code)) return 'B';
    return 'A';
  }

  function parseBarcode(barcode, barcodeType) {
    var bars = [];
    bars.add = function(nr) {
      var nrCode = BARS[nr];
      this.check = this.length==0 ? nr : this.check + nr*this.length;
      this.push( nrCode || format("UNDEFINED: %1->%2", nr, nrCode) );
    };
    bars.add(START_BASE + barcodeType.charCodeAt(0));
    for(var i=0; i<barcode.length; i++) {
      var code = barcodeType=='C' ? +barcode.substr(i++, 2) : barcode.charCodeAt(i);
      converted = fromType[barcodeType](code);
      if (isNaN(converted) || converted<0 || converted>106) throw new Error(format("Unrecognized character (%1) at position %2 in code '%3'.", code, i, barcode));
      bars.add( converted );
    }
    bars.push(BARS[bars.check % 103], BARS[STOP]);
    return bars;
  }
  var fromType = {
    A: function(charCode) {
      if (charCode>=0 && charCode<32) return charCode+64;
      if (charCode>=32 && charCode<96) return charCode-32;
      return charCode;
    },
    B: function(charCode) {
      if (charCode>=32 && charCode<128) return charCode-32;
      return charCode;
    },
    C: function(charCode) {
      return charCode;
    }
  };
  //--| The CSS (code128.css) as javascript object, so only one file need to be downloaded. 
  //--| Removed, doesn't work in Firefox, see: http://code.google.com/p/base2/issues/detail?id=130 
  /*
  jsb.createStyleSheet(
  {  ".barcode": 
    { "float": "left"
    , "clear": "both"
    , "padding": "0 10px" //quiet zone
    , "overflow": "auto"
    , "height": "0.5in"   //size
    }
  , ".right": { float: "right" }
  , ".barcode div": 
    { "float": "left"
    , "height": "0.35in"  //size
    }
  , ".barcode .bar1": { borderLeft: "1px solid black" }
  , ".barcode .bar2": { borderLeft: "2px solid black" }
  , ".barcode .bar3": { borderLeft: "3px solid black" }
  , ".barcode .bar4": { borderLeft: "4px solid black" }
  , ".barcode .space0": { marginRight: "0px" }
  , ".barcode .space1": { marginRight: "1px" }
  , ".barcode .space2": { marginRight: "2px" }
  , ".barcode .space3": { marginRight: "3px" }
  , ".barcode .space4": { marginRight: "4px" }
  , ".barcode label":
    { clear: "both"
    , display: "block"
    , textAlign: "center"
    , font: "0.125in/100% helvetica" //size
    , "@media screen": { ".barcode": { border: "1px solid gray" } }
    }
  });
  */
  // regular expression to determine if a classname for barcode type is used
  var rxType = /\bcode128([abc])\b/i;
  var code128behaviour = jsb.behavior.extend({
    onattach: function(element, event) {
      var type = rxType.exec(element.className);
      element.innerHTML = type 
        ? code128( element.innerHTML, type[1].toUpperCase()) 
        : code128( element.innerHTML );
    }
  });

  eval(this.exports);

} // end closure