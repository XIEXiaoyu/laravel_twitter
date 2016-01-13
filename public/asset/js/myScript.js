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
document.addEventListener("DOMContentLoaded", hideDropdownList); //reference: http://youmightnotneedjquery.com/

function hideDropdownList(){
	document.getElementsByClassName("globalList")[0].style.display = 'none';
}

//if clicking on the global profile image, there will be a dropdown list appear
document.getElementsByClassName("global_profile_img")[0].addEventListener("mousedown", showDropdownList);

function showDropdownList(){
	document.getElementsByClassName("globalList")[0].style.display = "block";
}

//When we release the click, we need to let the text of 'profile and settings' disapper when the user click the global image.
document.getElementsByClassName("global_profile_img")[0].addEventListener("mouseup", removeAddProfileP);

/* if the mouse pointer is on one of the list items in the global dropdown list, the color the item is changed
*/
//set for the profile a tag
document.getElementsByClassName("dropdownProfile")[0].addEventListener("mouseover", function(){ changeListLinkColor(this); 
	});

document.getElementsByClassName("dropdownProfile")[0].addEventListener("mouseout", function(){ changeListLinkColorBack(this); 
	});

function changeListLinkColor(obj){
	obj.style.backgroundColor = "#0084B4";	
	var a = document.getElementsByClassName("dropdownProfileA")[0];
	a.style.color = "white";
	a.style.fontWeight = 500;
}

function changeListLinkColorBack(obj){
	obj.style.backgroundColor = "white";
	var a = document.getElementsByClassName("dropdownProfileA")[0];
	a.style.color = "SlateGray";
	a.style.fontWeight = 400;
}









 


