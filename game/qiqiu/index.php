<!DOCTYPE html>
<html lang="en">
<head>
	<title>气球砰砰砰-兔小蕾思维训练游戏</title>
	<meta charset="utf-8">
	<meta name="apple-mobile-web-app-capable" content="yes" />
	<meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no,width=device-width,minimal-ui" />
	
	<link rel="shortcut icon" href="icon.png">
<link rel="icon" href="icon.png">
	<style>
		body {
			margin: 0px;
			padding: 0px;
			width: 100%;
			background-color:black;
		}

		canvas {
			image-rendering: -o-crisp-edges;
			image-rendering: optimize-contrast;
			-ms-interpolation-mode: nearest-neighbor;
			-webkit-tap-highlight-color: rgba(0,0,0,0);
			-moz-tap-highlight-color: rgba(0,0,0,0);
			tap-highlight-color: rgba(0,0,0,0);
			user-select: none;
			-webkit-touch-callout: none;
			-webkit-user-select: none;
			-moz-user-select: none;
			-ms-user-select: none;
		}
	</style>

	<script src="js/viewporter.js"></script>

    <script>
    // Kaisergames API development prototype
    // make sure this code is executed before the game calls any kaisergames.* methods!
    if (typeof window !== "undefined" && !window.kaisergames){
        window.kaisergames = new function(){
            return {
                /**
                 * @param level string[optional]
                 * @param score number[optional]
                 */
                gameOver: function(level, score) {
                    if (!level) level = "-";
                },

                /**
                 * @param level string[optional]
                 * @param score number[optional]
                 */
                levelUp: function(level, score) {
                    if (!level) level = "-";
                },

                /**
                 * @param level string
                 * @param score number
                 */
                submitHighscore: function(level, score) {
                    if (!level) level = "-";
                    
                }
            }
        }
    }
    </script>
</head>

	<body>
		<div id="viewporter">
		   <canvas id="canvas" moz-opaque></canvas>
		</div>
		<input id="bt-game-id" type="hidden" value="8-ball">
		<div id="moregame" style="position:fixed;z-index:99; bottom:20px; left:0px; font-size:20px; width:100%; text-align:center;">
		

	</div>
	</body>
	<script src="js/TweenMax.min.js"></script>
	<script src="js/howler.js"></script>
	<script src="js/app.min.js"></script>
	
	
	
<?php include 'share.php';?>
	<script src="http://libs.baidu.com/jquery/1.7.0/jquery.min.js"></script>
		<script type="text/javascript">
			var shareData={
						imgUrl: "http://tuxiaolei.xiaonongding.com/upload/card/000/001/161/5ad46b2905b9e.png", 
												link: "http://tuxiaolei.xiaonongding.com/game/qiqiu/index.php",						title: "气球砰砰砰-兔小蕾思维训练游戏",
						desc: "思维训练，每日坚持签到打卡，不仅提升宝宝大脑智慧，还可奖励积分哦~"
			};
		</script>
	
		 <script src="https://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
		
	


			
			
</html>