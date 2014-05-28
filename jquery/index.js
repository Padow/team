function createCookie(name,value,days) {
	if (days) {
		var date = new Date();
		date.setTime(date.getTime()+(days*24*60*60*1000));
		var expires = "; expires="+date.toGMTString();
	}
	else var expires = "";
	document.cookie = name+"="+value+expires+"; path=/";
}
			
function readCookie(name) {
	var nameEQ = name + "=";
	var ca = document.cookie.split(';');
	for(var i=0;i < ca.length;i++) {
		var c = ca[i];
		while (c.charAt(0)==' ') c = c.substring(1,c.length);
		if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
	}
	return null;
}


function SetDispo(id){
	var key = id;
	createCookie('key',key,7);
	$('#query').load('php/dispo.php').fadeIn("slow");
}

function check(){
	if($('#checkboxes-0').prop('checked')){
		$('#checkboxes-0').prop('checked', false);
	}else{
		$('#checkboxes-0').prop('checked', true);
	}
}

var image_array = new Array();
    image_array[0] = "style/background/0.jpg";
    image_array[1] = "style/background/1.jpg";
    image_array[2] = "style/background/2.jpg";
    image_array[3] = "style/background/3.jpg";

    var rand_path = image_array[Math.floor(Math.random() * image_array.length)];

$(window).ready(function(){
	$('body').css({"background-image": 'url('+rand_path+')', "margin": '0px', "padding": '0px'});
	$('#pass1').val("");
})

var url_array = new Array();
	url_array[0] = "http://heyyeyaaeyaaaeyaeyaa.com/";
	url_array[1] = "http://z0r.de/1933";
	url_array[2] = "http://rickrolled.fr/";
	url_array[3] = "http://leekspin.com/";
	url_array[4] = "http://z0r.de/3714";
	url_array[5] = "http://www.nelson-haha.com/";
	url_array[6] = "http://www.nyan.cat/";
	url_array[7] = "http://z0r.de/1466";
	url_array[8] = "http://image.noelshack.com/fichiers/2011/28/1310392915-faut_que_vous_arretiez-6f5db00397.swf";
	url_array[9] = "http://thebest404pageever.com/swf/When_Im_Hungry.swf";
	url_array[10] = "http://thebest404pageever.com/swf/tf_toast.swf";
	url_array[11] = "http://thebest404pageever.com/swf/walama.swf";
	url_array[12] = "http://z0r.de/1410";
	url_array[13] = "http://www.you-failed.com/";
	url_array[14] = "http://noelswf.info/swf/1212.swf";
	url_array[15] = "http://noelswf.info/swf/3200.swf";
	url_array[16] = "http://noelswf.info/swf/3501.swf";
	url_array[17] = "http://noelswf.info/swf/3065.swf";
	url_array[18] = "http://noelswf.info/swf/831.swf";
	url_array[19] = "http://noelswf.info/swf/58.swf";
	url_array[20] = "http://noelswf.info/swf/3806.swf";

  if ( window.addEventListener ) {
    var kkeys = [], konami = "38,38,40,40,37,39,37,39,66,65";
    window.addEventListener("keydown", function(e){
      kkeys.push( e.keyCode );
      if ( kkeys.toString().indexOf( konami ) >= 0 ) {
      	var rand_url = url_array[Math.floor(Math.random() * url_array.length)];	
        window.location = rand_url;
      }
    }, true);
  }

  function newpassword(){
  	var pass1 = $( '#pass1' ).val();
  	if(pass1 != ""){
  		$( "#pass2" ).prop( "disabled", false );
  	}else{
  		$( "#pass2" ).prop( "disabled", true );
  	}
  	$( "#pass2" ).val("");
  	$( "#changepw" ).prop( "disabled", true );
  	$( '#chkimg' ).attr("src","style/images/default.png");
  }

  function passwordCheck(){
  	var pass1 = $( '#pass1' ).val();
  	var pass2 = $( '#pass2' ).val();

  	if(pass1 != pass2){
  		$( '#chkimg' ).attr("src","style/images/warning_orange.png");
  		$( "#changepw" ).prop( "disabled", true );
  	}

  	if(pass1 == pass2){
  		$( '#chkimg' ).attr("src","style/images/valide.png");
  		$( "#changepw" ).prop( "disabled", false );
  	}

  }