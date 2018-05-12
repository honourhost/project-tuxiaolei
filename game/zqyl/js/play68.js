var moreGamesLocation = 'http://game.weixine.net/zqyl/game.html';

function play68_init() {
	updateShare(0);
}

function updateShare(bestScore) {
	imgUrl = 'http://game.weixine.net/zqyl/icon.png';
	lineLink = 'http://game.weixine.net/zqyl/game.html';
	descContent = "考考你的眼力！你的眼睛跟得上吗？";
	updateShareScore(bestScore);
	appid = '';
}

function updateShareScore(bestScore) {
	if(bestScore > 0) {
		shareTitle = "我玩《最强眼力》过了" + bestScore + "关，眼都花了！";
	}
	else{
		shareTitle = "不玩《最强眼力》怎么知道自己的眼力原来那么好？";
	}
}