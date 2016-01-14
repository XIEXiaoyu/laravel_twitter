/*change the color of tweet button */
var tweet_button = document.getElementsByClassName("global_tweet_button")[0];

tweet_button.addEventListener("mouseover", global_tweet_mouseOver);
tweet_button.addEventListener("mouseout", global_tweet_mouseOut);

function global_tweet_mouseOver() {
	this.style.background = "#4f7cd8";
}

function global_tweet_mouseOut() {
	this.style.background = "#0084B4";
}



/* If the mouse pointer is on the global profile image, there will be indication of 'profile and settings' appears. When we move the mouse pointer out of the image, the text will disappear
*/
//when the page is loaded, the text should not be loaded
$(document).ready(function(){
	$("p.jsP4ProfileTxtClass").hide();
});
//when mouse pointer is over the image, show the text
$(document).ready(function(){
	$("img.global_profile_img").mouseenter(function(){
		//first need to check if the dropdown list is on the screen, if its on the screen, we shall not let the text appear
		if(!$("ul.globalList").is(":visible"))
		{
			$("p.jsP4ProfileTxtClass").show();
			console.log("show");
		}		
	});
});

//when the mouse pointer is moved out of the image, the text should disappear
$(document).ready(function(){
	$("img.global_profile_img").mouseleave(function(){
		$("p.jsP4ProfileTxtClass").hide();
		console.log("hide");
	});
});



/* This part achieves that when we click the global profile image, the dropdown list will show up*/

//The 'globalList' is existed alreay, but we don't want it show up when the page is just loaded.
$(document).ready(function(){
	$("ul.globalList").hide();
});

//if clicking on the global profile image, there will be a dropdown list appear
$(document).ready(function(){
	$("img.global_profile_img").click(function(e){
		e.stopPropagation(); // Important, using this line to avoid its parent or ancestor, for example, the body, to execute their click event. Or, we would see that the click event of the image doesn't work, because when we click on the image, the dropdown list shows, but immediately after that, the click event on the body takes effect, so the dropdown will disapper, so in all, you would see that there is no effect at all. This is due to the bubbling characterics of javascript.

		// if text 'profile and settings' is on the screen, we need first to let it disappear
		if($("p.jsP4ProfileTxtClass").is(":visible")){
			$("p.jsP4ProfileTxtClass").hide();
		}
		//now can display the dropdown list
		$("ul.globalList").show();
		// console.log("click the button");
	});
})

// Make the dropdown list disappear when clicking the rest of the page 
$(document).ready(function(){
	$(document.body).click(function(){
		$("ul.globalList").hide();
		// console.log("toggle");
	});
});



/* if the mouse pointer is on one of the list items in the global dropdown list, the color the item is changed
*/
$(document).ready(function(){
	$(".globalList li").mouseenter(function(){
		var className = $(this).attr('class');
		$("li."+className).css("background-color", "#0084B4");
    	var classNameOfA = $("."+className+ " a").attr('class');
    	$("a."+classNameOfA).css({"color": "white", "font-weight": "500"});
    	});
})

$(document).ready(function(){
	$(".globalList li").mouseleave(function(){
		var className = $(this).attr('class');
		$("li."+className).css("background-color", "white");
		var classNameOfA = $("."+className+" a").attr('class');
		$("a."+classNameOfA).css({"color": "SlateGray", "font-weight": "400"});
    	});
});

/**/












 


