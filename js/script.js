var index;
var art = [];

var PayPalIsDown = false;

$(document).ready(function(){
	display_all();
	//ajaxFunction("color");

	$(".welcome-section").click(function(){
		$(".profile-dropdown").toggle();		
	});

	$(".profile-dropdown li").click(function(){
		alert("This feature has not been implemented yet");
	});

	$('.post').click(function(){
		//alert("clicked!");
		index = $(this).attr("id");
		popup(index);
		$("#details").show();
	});

	$(".back-to-results").click(function(){
		$("#details").hide();
	});

	$(".upload-section").click(function(){
		//$("#overlay").show();


		alert("this feature has not been implemented yet");
		/*
		if(getCookie("first-time-upload")!="true"){
			if(confirm("By clicking ok below, you agree that you are the original artist of all art that you upload")){
				setCookie("first-time-upload", "true", 0.01);
				window.open("upload.html");
			} else {
				//prevent click
				$(this).css("pointer-events","none");
			}
		} else {
			window.open("upload.html");

		}
		*/
	});

	$(".change").click(function(){
		alert("This is where you would change billing info, if this was really PayPal");
	});

	$('#search').keydown(function(event){
		var key = event.which || event.keycode;
		if(key == 13){
			search();
			//ajaxFunction();
		}
	});

	$("#search_button").click(function(e){
		e.preventDefault();
		var	str = document.getElementById("search").value;
		//ajaxFunction(str);

	});

});

	function ajaxFunction(str) {

		$("#search-results").empty();
		//alert(str);
		var ajaxRequest;

	   try{
	   //alert("try1");
	      // Opera 8.0+, Firefox, Safari
	      ajaxRequest = new XMLHttpRequest();
	   }catch (e){
	   	   //alert("catch1");
	      // Internet Explorer Browsers
	      try{
	      	   alert("try2");

	         ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
	      }catch (e) {
	      	   alert("catch2");
	         
	         try{
	         	   alert("try3");

	            ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
	         }catch (e){
	         	   alert("catch3");

	            // Something went wrong
	            alert("Your browser broke!");
	            return false;
	         }
	      }
	   }

	  ajaxRequest.onreadystatechange=function() {
	    if (ajaxRequest.readyState==4 /*&& ajaxRequest.status==200*/) {
	    	var res = ajaxRequest.responseText;
	    	var JSONarray_str = res.split("#");

	    	//display_attributes();
	    	$("#search-results").empty();

	    	if(res!=""){
	    	   	convert_to_JSON_array(JSONarray_str);
	    		$("#search-results").empty();
	    		show_all();
	    	} else {
	    		$("#search-results").append("<p id = 'not-found'>Sorry, could not find '"+str+"'</p>");	
	    	}
	    }
	  }
	  ajaxRequest.open("GET","search.php?searchValue="+str,true);//string query sent in through the url
	  ajaxRequest.send(null);
	}


function convert_to_JSON_array(string_array){
	art = [];
	for(var i in string_array){
		//alert(string_array[i]);
		var json = jQuery.parseJSON(string_array[i]);
	 	art.push(json);
	}

}

function display_attributes(){
	//alert("in display_attributes: url: "+art.url+", price: "+art.price+", artist: "+art.artist+", description: "+art.description);
}



var rebind_click = function(){
	$(".upload-section").click(function(){
		//$("#overlay").show();
		if(confirm("By clicking ok below, you agree that you are the original artist of all art that you upload")){
			window.open("upload.html");
		} else {
			//prevent click
			$(this).css("pointer-events","none");
			rebind_click();
		}
	});
}


var display_all = function(){
	var out = "";
	for(var i = 0; i < art.length; i++){
		out += add_post(i);
	}

	document.getElementById("search-results").innerHTML += out;


}

var tag_search = function(){
	display_results(input); 
}

var search = function(){
	var input = document.getElementById("search").value;
	display_results(input); 
}


function show_all(){
	$("#search-results").empty();
	for(var i in art){
		add_post(i);
	}
}

var display_results = function(input){
	$("#search-results").empty();
	var notFound = true;
	var out = "";
	var found = 0;

	for(var i = 0; i < art.length; i++){
		var tags = art[i].tags;
		var match = false;

		for(var j = 0; j < tags.length; j++){
			if (tags[j].tag==input || tags[j].tag==input+"s" || tags[j].tag+"s"==input || input.indexOf(tags[j].tag)>-1) {
				match = true;
			};
		}

		if(match || input == ""){
			out += add_post(i);
			found++;
			notFound = false;
		}
		$('.post').click(function(){
			index = $(this).attr("id");
			$("#details").show();
			popup(index);
		});

	}

	if(input!=""){
		if(notFound){
			out += "<p id = 'not-found'>Sorry, could not find '"+input+"'</p>" ;
		} else{
			out = "<p id = 'not-found'>"+found+" results found for '"+input+"'</p>"+out;	
		}
	}

	$("#search-results").append(out);


	$('.post').click(function(){
		//alert("clicked!");
		index = $(this).attr("id");
		$("#details").show();
		popup(index);
	});
}

var HandleBackFunctionality = function(){
	if (window.event){

		//if(window.event.clientX < 40 && window.event.vlientY < 0){
			alert("back");
		//}
	}
}

var popup = function(i){
	$('#details').empty();

	var out,
	tags = art[i].tags,
	price = art[i].price,
	url = art[i].url,
	artist = art[i].artist,
	description = art[i].description,
	apID= art[i].apID;

	out = "<div id = 'popup'>";

	out += "<div class = 'row top-bar'>";

	out += "<p class = 'back-to-results'><i class = 'fa fa-arrow-left'></i> Back to search results </p>";

	out += "</div>";//close first row

	out += "<div class = 'row'>";

	out += "<div id = 'img-wrapper' class = 'col-md-8'>";
	out += "<img src = '"+url+"'/>";
	out += "</div>";

	out += "<div id = 'pop-up-text' class = 'col-md-4'>";

	out += "<p class = 'artist'>ARTIST: <span class = 'artist-name'>"+artist+"</span></p>";


	//out += "<p class = 'Tags'>TAGS:</p>";

	out += "<div class = 'tags'>";
	for(var j = 0; j < tags.length; j++){
		out += "<button class = 'tag' name = '"+tags[j].tag+"''>#"+tags[j].tag+"</button>";
	}

	out += "</div>";

	out += "<hr>";

	if(description!=""){
		out += "<p class = 'description'>"+description+"</p>";
		out += "<hr>";
	}

	out += "<p class = 'price'>PRICE: <span class = 'price-number'>$"+price+"</span></p>";
	out += "<p class = 'paypal-description'>When you click 'Continue to PayPal' below, you'll be temporarily redirected to the PayPal site to confirm your payment. \nYou'll then be returned to Gallery and given a download link</p>";
	out += "<button class = 'buy'>Continue to PayPal</button>";

	out += "</div>";//close tags

	out += "</div>";//close second row

	out += "</div>";//close popup

	$('#details').append(out);

	$("#details, #download").css({
		"background":"url('"+url+"') no-repeat center center fixed",
		//"background-repeat":"no-repeat",
		"background-size":"cover"
	});

	$(".back-to-results").click(function(){
		$("#details").hide();
			$('.post').click(function(){
		//alert("clicked!");
		index = $(this).attr("id");
		$("#details").show();
		popup(index);
	});


	});

	/*$('.tag').click(function(){
		var input = $(this).attr("name");
		$("#details").hide();
		display_results(input);
	});*/

	if(!PayPalIsDown){
		$('.buy').click(function(){
			//alert("You are about to be redirected to PayPal. Once you've filled in your payment information, you will be brought back here where you will be given a download link. Click 'ok' to continue");
			$('#insert-total').empty();
			$('#insert-total').append("$"+price);
			$('#paypal').show();
			$('#continue').click(function(e){
				//call order.php from here
				passArtStuff('apID'+i, "buyerID");
				$("#download img").attr("src", url);
				$("#download a").attr("href", url);
				$('#download').show();
				$('.close-download-page').click(function(){
					$('#download').hide();
					$("#paypal").hide();
					$("#details").hide();
				});
			});
		});
	} else {
		$('.buy').click(function(){
			alert("Sorry, our payment system is currently down for maintenance. Please try again in a few hours.");
		});
	}
}


function passArtStuff(apID, buyerID){
	var apIDval = getCookie(apID);
	var buyerIDval = getCookie(buyerID);
	//alert(apIDval + " " + buyerIDval)
	

	$.ajax({
      type: "POST",
      url: 'order.php',
      data: ({
      	apID:apIDval,
      	buyerID:buyerIDval
      })
    });
	//window.location.href="order.php?apID="+apIDval+"&buyerID="+buyerIDval;
};


function add_post(i){
	var out, 
	price = art[i].price,
	url = art[i].url,
	artist = art[i].artist;
	apID = art[i].apID;

	setCookie("apID"+i, apID, 4);
	setCookie("buyerID", "122215", 4);


	out = "<div class = 'col-md-4 post-wrapper'><div class = 'post' id = '"+i+"'>";
	out +="<input type = 'hidden' id = 'buyerID' name = 'buyerID' value = '122215'></input>";
	out +="<input type = 'hidden' id = 'apID' value = '"+apID+"'></input>";
	out += "<img src = '" +url+"'/>";
	out += "<div class = 'text'>";
	out += "<div class = 'row'>";
	out += "<div class = 'col-md-6'><p class = 'artist'>ARTIST: <span class = 'artist-name'>"+artist+"</span></p></div>";
	out += "<div class = 'col-md-6'><p class = 'price'>PRICE: <span class = 'price-number'>$"+price+"</span></p></div>";
	out += "</div></div></div></div>";

	//$("#search-results").append(out);

	$('.post').click(function(){
		//alert("clicked!");
		index = $(this).attr("id");
		popup(index);
		$("#details").show();
	});

	return out

}



/*
var add_post = function(i){
	var out, 
	tags = art[i].tags, 
	price = art[i].price,
	url = art[i].url,
	artist = art[i].artist;

	out = "<div class = 'col-md-4 post-wrapper'><div class = 'post' id = '"+i+"'>";
	out += "<img src = 'img/art/" +url+"'/>";
	out += "<div class = 'text'>";
	out += "<div class = 'row'>";
	out += "<div class = 'col-md-6'><p class = 'artist'>ARTIST: <span class = 'artist-name'>"+artist+"</span></p></div>";
	out += "<div class = 'col-md-6'><p class = 'price'>PRICE: <span class = 'price-number'>$"+price+"</span></p></div>";
	out += "</div></div></div></div>";

	return out;
}

var add_post = function(imageLoc, aristID, apDesc, apPrice, tags, i){
	var out, 
	tags = tags, 
	price = apPrice,
	url = imageLoc,
	artist = aristID;

	out = "<div class = 'col-md-4 post-wrapper'><div class = 'post' id = '"+i+"'>";
	out += "<img src = 'img/art/" +url+"'/>";
	out += "<div class = 'text'>";
	out += "<div class = 'row'>";
	out += "<div class = 'col-md-6'><p class = 'artist'>ARTIST: <span class = 'artist-name'>"+artist+"</span></p></div>";
	out += "<div class = 'col-md-6'><p class = 'price'>PRICE: <span class = 'price-number'>$"+price+"</span></p></div>";
	out += "</div></div></div></div>";

	return out;
}
*/
