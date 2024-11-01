jQuery( document ).ready(function() {

jQuery('.start-pgm li:has(ul)').addClass('sc-sublist');


jQuery('body').on('change keyup', 'select[name="demo-panel-skin"], select[name="demo-panel-btn"], select[name="demo-panel-pos"]', function(){
var xtop = jQuery('select[name="demo-panel-pos"]').val();
var xclass = jQuery('select[name="demo-panel-skin"]').val();
var xbtn = jQuery('select[name="demo-panel-btn"]').val();
jQuery('.sc-taskbar').attr('class','sc-taskbar '+xtop+' '+xclass+' '+xbtn);
});

jQuery('body').on('mouseenter', '.start-bmk-init, .start-pgm', function(){
jQuery('.start-pgm').show();
});

jQuery('body').on('mouseleave', '.start-bmk-init, .start-pgm', function(){
jQuery('.start-pgm').hide();
});


jQuery('body').on('click', '.start-back-bg', function(){
jQuery('.start-menu, .start-back-bg').hide();
jQuery('.sc-taskbar .start').removeClass('active');
});



setInterval('updateClock()', 1000);

jQuery('body').on('click', '.start', function() {
jQuery(this).toggleClass('active');
jQuery('.start-menu, .start-back-bg').toggle();
});
});

function updateClock ( )
    {
    var currentTime = new Date ( );
    var currentHours = currentTime.getHours ( );
    var currentMinutes = currentTime.getMinutes ( );
    var currentSeconds = currentTime.getSeconds ( );

    // Pad the minutes and seconds with leading zeros, if required
    currentMinutes = ( currentMinutes < 10 ? "0" : "" ) + currentMinutes;
    currentSeconds = ( currentSeconds < 10 ? "0" : "" ) + currentSeconds;

    // Choose either "AM" or "PM" as appropriate
    var timeOfDay = ( currentHours < 12 ) ? "AM" : "PM";

    // Convert the hours component to 12-hour format if needed
    currentHours = ( currentHours > 12 ) ? currentHours - 12 : currentHours;

    // Convert an hours component of "0" to "12"
    currentHours = ( currentHours == 0 ) ? 12 : currentHours;

    // Compose the string for display
    var currentTimeString = currentHours + ":" + currentMinutes + ":" + currentSeconds + " " + timeOfDay;
   
   
    jQuery(".clock").html(currentTimeString);
       
 }