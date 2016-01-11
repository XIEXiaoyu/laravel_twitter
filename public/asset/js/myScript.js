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
var profileImage = document.getElementsByClassName("global_profile");
profileImage[0].addEventListener("mouseover",function(){ addProfileP(this);
});

function addProfileP(obj){
	var jsP4Profile = document.createElement("p");
	var jsP4ProfileTxt = document.createTextNode("profile and settings");
	jsP4Profile.appendChild(jsP4ProfileTxt);
	obj.appendChild(jsP4Profile);
}



 


