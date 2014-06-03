function SetDispo(id){
  $.ajax({
          url: "php/dispo.php",
          type: "GET",
          data: {key: id},
          success: function(){
                    load();
                   }
     });
}

function load(){
  $('#query').load('php/container.php').fadeIn("slow");
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
  $('.del').nextAll().remove();
 });



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
  url_array[21] = "http://welcometointernet.org/";
  url_array[22] = "http://maninthedark.com/";
	url_array[23] = "http://www.boohbah.tv/zone.html";

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


    /*<![CDATA[*/
function formatText(el,tagstart,tagend){

var selectedText=document.selection?document.selection.createRange().text:el.value.substring(el.selectionStart,el.selectionEnd);// IE:Moz
var newText='['+tagstart+']'+selectedText+'[/'+tagend+']';
if(document.selection){//IE
el.focus();
var st=getCaret(el)+tagstart.length+2;
document.selection.createRange().text=newText;
var range=el.createTextRange();
range.collapse(true);
range.moveStart('character', st);
range.moveEnd('character',selectedText.length);
range.select();
el.focus();
}
else{//Moz
var st=el.selectionStart+tagstart.length+2;
var end=el.selectionEnd+tagstart.length+2;
el.value=el.value.substring(0,el.selectionStart)+newText+el.value.substring(el.selectionEnd,el.value.length);
el.focus();
el.setSelectionRange(st,end)
}
}

function getCaret(el) { // IE mission is tricky :)
    el.focus(); 
    var r = document.selection.createRange(); 
    if (r == null) { 
      return 0; 
    } 
    var re = el.createTextRange(), 
    rc = re.duplicate(); 
    re.moveToBookmark(r.getBookmark()); 
    rc.setEndPoint('EndToStart', re); 

    var add_newlines = 0;
    for (var i=0; i<rc.text.length; i++) {
      if (rc.text.substr(i, 2) == '\r\n') {
        add_newlines += 2;
        i++;
      }
    }

return rc.text.length + add_newlines; 
}

/*]]>*/