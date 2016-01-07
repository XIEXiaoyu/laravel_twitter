var tweet_button = document.getElementsByClassName("global_tweet_button")[0];

tweet_button.addEventListener("mouseover", global_tweet_mouseOver);
tweet_button.addEventListener("mouseout", global_tweet_mouseOut);

function global_tweet_mouseOver() {
	this.style.background = "#0084cc";
}

function global_tweet_mouseOut() {
	this.style.background = "#0084B4";
}

