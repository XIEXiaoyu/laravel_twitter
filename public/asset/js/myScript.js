//change the color of tweet button
var tweet_button = document.getElementsByClassName("global_tweet_button")[0];

tweet_button.addEventListener("mouseover", global_tweet_mouseOver);
tweet_button.addEventListener("mouseout", global_tweet_mouseOut);

function global_tweet_mouseOver() {
	this.style.background = "#0084cc";
}

function global_tweet_mouseOut() {
	this.style.background = "#0084B4";
}


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
	child.parentNode.removeChild(child);
}





 


