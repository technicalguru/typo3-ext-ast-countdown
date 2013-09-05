// Countdown
maxDigits = (vDayLen==3)?9:8;

AnzS=''; for(i=0; i<maxDigits; i++) AnzS +=' ';
Leer=''; for(i=0; i<maxDigits; i++) Leer +='0';

n = new Array(10);
for(i=0; i<10; i++) {
	n[i] = new Image(vWidth,vHeight);
	n[i].src = imgPath+'c'+i+'.gif';
}


function addZero(n) {
	str = '';
	if (n<10) str += '0';
	return str+n.toString();
}


function showNums(w) {
	var AnzW=Math.floor(Math.abs(w));
	var we=''+Leer+AnzW;
	we = we.substring(we.length-maxDigits,we.length);
	for(var i=maxDigits-1; i>=0; i-=1) {
		if(AnzS.charAt(i)!= we.charAt(i)) document.images['b'+i].src = imgPath+'c'+we.charAt(i)+'.gif';
	}
	AnzS = we;
}


function countDown() {
	newDate   = new Date();
	vDiff     = Math.floor((evtDate.getTime()-newDate.getTime())/1000);
	vInterval = 1001-(newDate.getTime()%1000);

	if (vDiff<=0) {
		vDays  = (vDayLen==3)?000:00;
		vHours = 00;
		vMins  = 00;
		vSecs  = 00;
		return;
	}


	arrDig = new Array();

	vSecs  = addZero(vDiff%60);
	arrDig['s1'] = vSecs.substr(1,1);
	arrDig['s0'] = vSecs.substr(0,1);

	vDiff  = Math.floor(vDiff/60);
	vMins  = addZero(vDiff%60);
	arrDig['m1'] = vMins.substr(1,1);
	arrDig['m0'] = vMins.substr(0,1);

	vDiff  = Math.floor(vDiff/60);
	vHours = addZero(vDiff%24);
	arrDig['h1'] = vHours.substr(1,1);
	arrDig['h0'] = vHours.substr(0,1);

	vDiff  = Math.floor(vDiff/24);
	vDays  = vDiff.toString();

	if (vDayLen==3) {
		arrDig['d2'] = vDays.substr(2,1);
		arrDig['d1'] = vDays.substr(1,1);
		arrDig['d0'] = vDays.substr(0,1);
	} else {
		arrDig['d1'] = vDays.substr(1,1);
		arrDig['d0'] = vDays.substr(0,1);
	}

	newNum = (vDayLen==3)?''+arrDig['d0']+arrDig['d1']+arrDig['d2']+arrDig['h0']+arrDig['h1']+arrDig['m0']+arrDig['m1']+arrDig['s0']+arrDig['s1']:''+arrDig['d0']+arrDig['d1']+arrDig['h0']+arrDig['h1']+arrDig['m0']+arrDig['m1']+arrDig['s0']+arrDig['s1'];
	showNums(newNum);
	setTimeout('countDown()',vInterval);
}