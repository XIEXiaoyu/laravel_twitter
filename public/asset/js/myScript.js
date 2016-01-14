//change the color of tweet button
var tweet_button = document.getElementsByClassName("global_tweet_button")[0];

tweet_button.addEventListener("mouseover", global_tweet_mouseOver);
tweet_button.addEventListener("mouseout", global_tweet_mouseOut);

function global_tweet_mouseOver() {
	this.style.background = "#4f7cd8";
}

function global_tweet_mouseOut() {
	this.style.background = "#0084B4";
}

/* If the mouse pointer is on the global profile image, there will be indication of 'profile and settings' appears
*/
//add p tag of 'profile and settings' to the global profile image 
document.getElementsByClassName("global_profile_img")[0].addEventListener("mouseover", addProfileP);

function addProfileP(){
	var jsP4Profile = document.createElement("p");
	var jsP4ProfileTxt = document.createTextNode("profile and settings");
	jsP4Profile.appendChild(jsP4ProfileTxt);
	document.body.appendChild(jsP4Profile);

	var attr = document.createAttribute("class");
    attr.value = "jsP4ProfileTxtClass";
    jsP4Profile.setAttributeNode(attr);
}

//delete the profile and settings text
document.getElementsByClassName("global_profile_img")[0].addEventListener("mouseout", removeAddProfileP);

function removeAddProfileP(){
	var child = document.getElementsByClassName("jsP4ProfileTxtClass")[0];
	var parent = document.body;
	if($.contains(parent, child) == true)
	{
		child.parentNode.removeChild(child);
	}
	//else do nothing
}

/* This part achieves that when we click the global profile image, the dropdown list will show up*/

//The 'globalList' is existed alreay, but we don't want it show up when the page is just loaded.
$(document).ready(function(){
	$("ul.globalList").hide();
});

//if clicking on the global profile image, there will be a dropdown list appear
document.getElementsByClassName("global_profile_img")[0].addEventListener("mousedown", showDropdownList);

function showDropdownList(){
	document.getElementsByClassName("globalList")[0].style.display = "block";
}

//When we release the click, we need to let the text of 'profile and settings' disapper when the user click the global image.
document.getElementsByClassName("global_profile_img")[0].addEventListener("mouseup", removeAddProfileP);

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

/* Make the dropdown list disappear when clicking the rest of the page */
//If I click the image, I want to show the list, but as I've defined that if I click on the body, the list would appear, so the real effect is that I click the image, then the list appears, and immediately as the image is also on the body, so the click event on body would start to work, so the list would disappear. So I need to use the e.stopPropagation to stop any click event to work on image's parent.
$(document).ready(function(){
	$(document.body).click(function(){
		var e = document.getElementsByClassName("globalList")[0];
		e.style.display = ((e.style.display) != 'none'? 'none' : 'block');
	});
});










 


