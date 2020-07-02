function stopWatch(hour,minute,second)
{
		var hour = hour;
		var minute = minute;
		var second = second;
		
		function runStopwatch() {
		//alert(hour);
	
			second++;

			if(second > 59) {
			  second = 0;
			  minute = minute + 1;
			}

			if(minute > 59) {
			  minute = 0;
			  hour = hour + 1;
			}

			$(".timeHour").html("0".substring(hour >= 10) + hour);
			$(".timeMin").html(":"+ "0".substring(minute >= 10) + minute);
			$(".timeSec").html(":"+ "0".substring(second >= 10) + second);
		}
		setInterval(runStopwatch,1000);
}

function antiClock(hour,minute,second)
{
		var hour = hour;
		var minute = minute;
		var second = second;
		
		function runAntiClock() {
		//alert(hour);
	
			second --;

			if(second < 0) {
			  second = 59;
			  minute = minute - 1;
			}

			if(minute < 0) {
			  minute = 59;
			  if(hour >= 0) {
				hour = 0;
			  }else{
				hour = hour-1;
			  }
			}

			$(".timeHour").html("0".substring(hour >= 10) + hour);
			$(".timeMin").html(":"+ "0".substring(minute >= 10) + minute);
			$(".timeSec").html(":"+ "0".substring(second >= 10) + second);
			
			
			$("#hour").val("0".substring(hour >= 10) + hour);
			$("#min").val("0".substring(minute >= 10) + minute);
			$("#sec").val("0".substring(second >= 10) + second);
			
			if( second==0 && minute==0 && hour==0 ){
				formSubmit();
				//window.location.assign("http://localhost/gefedu_quize/front/cmodel_test/view_common_exam_result");
			}
		}
		setInterval(runAntiClock,1000);
} 