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
	child.parentNode.removeChild(child);
}

/*if clicking the global profile image, there will be a dropdown list appear
*/
//add a onclick eventlistener
document.getElementsByClassName("global_profile_img")[0].addEventListener("click", showSettingsList);

//react to the onclick eventlistener
function showSettingsList(){
	//create a dropdown list
	var list = document.createElement("ul");
	var attr = document.createAttribute("class");
    attr.value = "globalListClass";
    list.setAttributeNode(attr);

	//create the profile li
	var profileLi = document.createElement("li");
	var profileA= document.createElement("a");
	var profileATxt = document.createTextNode("View Profile");
	profileA.appendChild(profileATxt);
	profileA.href = "#";
	profileLi.appendChild(profileA);
	attr = document.createAttribute("class");
    attr.value = "dropdownProfileClass";
    profileLi.setAttributeNode(attr);

	//create the signatue li
	var signatureLi = document.createElement("li");
	var signatureA = document.createElement("a");
	var signatureATxt = document.createTextNode("Edit Signature");
	signatureA.appendChild(signatureATxt);
	signatureA.href="#";
	signatureLi.appendChild(signatureA);
	attr = document.createAttribute("class");
    attr.value = "dropdownSignatureClass";
    signatureLi.setAttributeNode(attr);

	//create the logout li
	var logoutLi = document.createElement("li");
	var logoutA = document.createElement("a");
	var logoutATxt = document.createTextNode("Logout");
	logoutA.appendChild(logoutATxt);
	logoutA.href="#";
	logoutLi.appendChild(logoutA);
	attr = document.createAttribute("class");
    attr.value = "dropdownLogoutClass";
    logoutLi.setAttributeNode(attr);

	//append the profile, signatue and logout to ul
	list.appendChild(profileLi);
	list.appendChild(signatureLi);
	list.appendChild(logoutLi);

	//append the ul to the body
	document.body.appendChild(list); //reference http://stackoverflow.com/questions/4772774/how-do-i-create-a-link-using-javascript

	//set the css style of the dropdown list
	//reference http://stackoverflow.com/questions/6840326/how-can-i-create-and-style-a-div-using-javascript
	list.style.width = "140px";
	list.style.height = "120px";
	//set the hight of profile
}

/* if the mouse pointer is on one of the list items in the global dropdown list, the color the item is changed
*/
//set the profile li
// document.getElementsByClassName("dropdownProfileClass")[0].addEventListener("mouseover", function(){ changeListLinkColor(this); 
// 	});

// function changeListLinkColor(obj){
// 	obj.style.backgroundColor = "#0084B4";	
// }







 


