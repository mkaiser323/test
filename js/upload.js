var tag_count = 3;
$(document).ready(function(){

	$('.fa-close').click(function(){
		//alert("clicked");
		if(tag_count==1){
			$("#tag-error").show();
		} else {
			remove_tag(this);

		}
	});

	$(".add").click(function(){
		add_tag();
		$('.fa-close').off();
		$('.fa-close').click(function(){
			//alert("clicked");
			if(tag_count==1){
				$("#tag-error").show();
			} else {
				remove_tag(this);
			}
		});
	});


	$("#upload-file-btn").click(function(){
		$("#pic").trigger("click");
	});

	$("#submit").click(function(e){

		hide_error_messages();
		
		if($(".tag_input_box:first-of-type").val()=="") {
			e.preventDefault();
			$("#tag-error").show();

			//alert("Please type in at least one tag- this will help people find your art");
		}

		if($("#pic").val()==""){
			e.preventDefault();
			$("#img-error").show();
			//alert("You must upload a picture");
		}

		if($("#price_input_box").val()==""){
			//alert("Please enter a price");	
			e.preventDefault();
			$("#price-error").show();
		} else if(isNaN($("#price_input_box").val())){
			//alert("Please enter a valid price");
			e.preventDefault();
			$("#not-a-number-error").show();
		
		}


	});

});

var hide_error_messages = function(){
	$(".error").hide();
}


var remove_tag = function(tag){
	$(tag).parent().remove();
	tag_count--;
	$("#tag_count").attr("value",tag_count);
	//alert($("#tag_count").val());
}

var add_tag = function(){
	$(".tags").append("<div class = 'col-md-12'><input type = 'text' class = 'tag_input_box' name='tag[]'><i class = 'fa fa-close'></i></div>");
	tag_count++;
	$("#tag_count").attr("value",tag_count);

}