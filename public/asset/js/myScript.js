document.getElementsByClassName("global_tweet_button")[0].onmouseover = onmouseoverChangeGloTetBtnBgdCol;
document.getElementsByClassName("global_tweet_button")[0].onmouseout = onmouseoutChangeGloTetBtnBgdCol;

function onmouseoverChangeGloTetBtnBgdCol() {
	this.style.background = "#0084cc";
}

function onmouseoutChangeGloTetBtnBgdCol() {
	this.style.background = "#0084B4";
}

