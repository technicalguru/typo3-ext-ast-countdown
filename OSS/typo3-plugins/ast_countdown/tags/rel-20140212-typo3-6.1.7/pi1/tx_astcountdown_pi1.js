// Countdown
AnzS=''; for(i=0; i<9; i++) AnzS +=' ';
Leer=''; for(i=0; i<9; i++) Leer +='0';

// Images
n = new Array(10);
for(i=0; i<10; i++) {
	n[i] = new Image(vWidth,vHeight);
	n[i].src = imgPath+'c'+i+'.'+imgExt;
}


function addZero(n) {
	str = '';
	if (n<10) str += '0';
	return str+n.toString();
}

function addZeros(n) {
	str = '';
	if (n<10) str += '0';
	if (n<100) str += '0';
	return str+n.toString();
}

function showNums(w) {
	var AnzW=Math.floor(Math.abs(w));
	var we=''+Leer+AnzW;
	we = we.substring(we.length-9,we.length);
	for(var i=9-1; i>=0; i-=1) {
		if(AnzS.charAt(i)!= we.charAt(i)) document.images['b'+i].src = imgPath+'c'+we.charAt(i)+'.'+imgExt;
	}
	AnzS = we;
}


function countDown() {
	newDate   = new Date();
	vDiff     = Math.floor((evtDate.getTime()-newDate.getTime())/1000);
	vInterval = 1001-(newDate.getTime()%1000);

	if (vDiff<=0) {
		vDays  = 00;
		vHours = 00;
		vMins  = 00;
		vSecs  = 00;
		return;
	}

	vSecs  = addZero(vDiff%60);
	v8 = vSecs.substr(1,1);
	v7 = vSecs.substr(0,1);

	vDiff  = Math.floor(vDiff/60);
	vMins  = addZero(vDiff%60);
	v6     = vMins.substr(1,1);
	v5     = vMins.substr(0,1);

	vDiff  = Math.floor(vDiff/60);
	vHours = addZero(vDiff%24);
	v4     = vHours.substr(1,1);
	v3     = vHours.substr(0,1);

	vDiff  = Math.floor(vDiff/24);
	vDays  = addZeros(vDiff);
    v2     = vDays.substr(2,1);
	v1     = vDays.substr(1,1);
	v0     = vDays.substr(0,1);

	newNum = ''+v0+v1+v2+v3+v4+v5+v6+v7+v8;
	showNums(newNum);
	setTimeout('countDown()',vInterval);
}
