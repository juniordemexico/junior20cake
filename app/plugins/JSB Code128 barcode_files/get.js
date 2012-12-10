/*
 * Set and read cookies
 * Copyright (C) Doeke Zanstra 2001-2003
 * Distributed under the BSD License
 * See http://www.xs4all.nl/~zanstra/dzLib/get.htm for more info.
 */

//after running, oGET represents the object, with propertie-names (get-names) and values (get-values)
getParameter.prototype.clearAll=getParameter_clearAll;
getParameter.prototype.toString=getParameter_toString;
function getParameter() {
	var aTemp=location.search.length>0?location.search.split('&'):new Array();
	var aTemper;

	if(aTemp.length>0) {
		aTemp[0]=aTemp[0].substr(1); //Remove the questionmark
	}
	for(var i=0; i<aTemp.length; i++) {
		aTemper=aTemp[i].split('=');
		this[aTemper[0]]=unescape(aTemper[1]);
	}
	delete aTemper, aTemp;
//  this.toString=getParameter_toString;
	return this;
}
function getParameter_clearAll() {
  for(var i in this) {
    delete this[i];
  }
}
function getParameter_toString() {
  var s='';
  for(var i in this) {
    if(typeof this[i]=='string') {
      s+=(s.length==0?'?':'&')+escape(i)+'='+escape(this[i]);
    }
  }
  return s;
}