com.ebms.widgets.clock = {
    init: function() {
        var aClock = $('#analog-clock');
        var clockWidthHeight = aClock.width();//width and height of the clock
        
        this.startClock(clockWidthHeight);
    },
    
    startClock: function(clockWidthHeight) {
        var aClock = $('#analog-clock');
        aClock.css({
            "height":clockWidthHeight +"px"
        });//sets the height if .js is enabled. If not, height = 0;
        aClock.fadeIn();//fade it in
		
        //call rotatehands function
        setInterval(function(){com.ebms.widgets.clock.rotateHands();}, 200);//1000 = 1 second
			
        com.ebms.widgets.clock.rotateHands();//make sure they start in the right position
    },
    
    rotateHands: function() {
        var aClock = $('#analog-clock');
        var clockWidthHeight = aClock.width();//width and height of the clock
        
        //get current time/date from local computer
        var now = new Date();
		
        //set the second hand
        var secondAngle = 360/60 * now.getSeconds();//turn the time into angle
        $('#secondHand').rotate(secondAngle, 'abs');//set the hand angle
        $('#secondHand').css( {
            "left": (clockWidthHeight - $('#secondHand').width())/2 + "px", 
            "top":(clockWidthHeight - $('#secondHand').height())/2 + "px"
        });//set x and y pos

        //set the minute hand
        var minuteAngle = 360/60 * now.getMinutes();//turn the time into angle
        $('#minuteHand').rotate(minuteAngle, 'abs');//set the hand angle
        $('#minuteHand').css( {
            "left": (clockWidthHeight - $('#minuteHand').width())/2 + "px", 
            "top":(clockWidthHeight - $('#minuteHand').height())/2 + "px"
        });//set x and y pos
		
        //set the hour hand
        var hourAngle = 360/12 * now.getHours();//turn the time into angle
        $('#hourHand').rotate((hourAngle + minuteAngle/12)%360, 'abs');//set the hand angle
        $('#hourHand').css( {
            "left": (clockWidthHeight - $('#hourHand').width())/2 + "px", 
            "top":(clockWidthHeight - $('#hourHand').height())/2 + "px"
        });//set x and y pos

    }
};