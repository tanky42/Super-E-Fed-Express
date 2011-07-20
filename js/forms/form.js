function init() {
	var els = getElementsByClassName(document, '*','date');
	
	var label = document.createElement('label');
	label.appendChild(document.createTextNode('Date of Birth'));
	label.setAttribute('for','dob');
	
	removeChildren(els[0]);	
	els[0].appendChild(label);
	els[0].appendChild(document.createTextNode(' '));
	
	var dateSel = document.createElement('input');
	dateSel.type='text';
	dateSel.id='dob';
	dateSel.name='dob';
	dateSel.defaultValue='YYYY/MM/DD'; dateSel.value='YYYY/MM/DD';
	dateSel.className+=' default';
	
	els[0].appendChild(dateSel);
	
	date = new calendarInput(dateSel);
}

AttachEvent(window,'load',init,false);