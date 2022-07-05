var fecha_fin = new Date('2019-07-16 19:30');
    var _second = 1000;
    var _minute = _second * 60;
    var _hour = _minute * 60;
    var _day = _hour * 24;
    var timer;
    var element = 'tk_6';

    function showTimer(fin,elem) {
        var now = new Date();
        var distance = fin - now;
	var days = Math.floor(distance / _day);
        var hours = Math.floor((distance % _day) / _hour);
        var minutes = Math.floor((distance % _hour) / _minute);
        var seconds = Math.floor((distance % _minute) / _second);

        if (distance < 300000) {
	var is=(seconds%2);
                
	document.getElementById('tr_'+elem).style.background ="#ffc107";
            document.getElementById('tr_'+elem).style.color ="#000";    
        
            if(distance <1000){
		if(is<0){
		document.getElementById('tr_'+elem).style.background ="#ff2727";
            	document.getElementById('tr_'+elem).style.color ="#fff";
 		}
		    else{
		        document.getElementById('tr_'+elem).style.background ="#ff0000";
		    document.getElementById('tr_'+elem).style.color ="#ffff00";
		    }

            //clearInterval('timer_'+elem);
            document.getElementById(elem).innerHTML = 'EXPIRADO!';
           
            return;
        }
    }
        
        //document.getElementById('countdown').innerHTML = days + 'd ';
        document.getElementById(elem).innerHTML = hours + 'h '+ minutes + '\' '+seconds + '\'\'';
    }


