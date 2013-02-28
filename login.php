<?php
header('Content-Type: text/html; charset="UTF-8"');

//SESSION開始
session_start();
//twitteroauth.phpをインクルードします。ファイルへのパスはご自分で決めて下さい。
//同じディレクトリにファイルがある場合は以下でOKです。
require_once("twitteroauth/twitteroauth.php");
//Consumer keyの値をTwitterAPI開発者ページでご確認下さい。
$consumerKey = "khq3qZqPdT7UczkRPR3Alw";
//Consumer secretの値を格納
$consumerSecret = "1SgZKbNyOngUcJfWkki11J07fbR3UMN2Drkx8tdc";


//Access Tokenの値を格納
$accessToken = "85602795-H2UHf5rpjTVd8k16jAz7zUuVShy2qrlWSSjZSm4BL";
//Access Token Secretの値を格納
$accessTokenSecret = "MxhqjftYmzpfiW1gkUBrOCJbVUIDG6zxPmxC0cBI";

/*
 //------- local環境用 -----------//
//取得した値をSESSIONに格納
$_SESSION['oauthToken'] = 			"85602795-H2UHf5rpjTVd8k16jAz7zUuVShy2qrlWSSjZSm4BL";
$_SESSION['oauthTokenSecret'] = 	"MxhqjftYmzpfiW1gkUBrOCJbVUIDG6zxPmxC0cBI";
$_SESSION['userId'] = "85602795";
$_SESSION['screenName'] = "meganehiroshi";
//------- local環境用 -----------//
*/
$sCallBackUrl = "http://".$_SERVER["HTTP_HOST"]."/Team-Talkmob/callback.php";
//	$sCallBackUrl = "http://ec2-54-248-166-204.ap-northeast-1.compute.amazonaws.com/chornica_test2/callback.php";


			//OAuthオブジェクト生成
			$oOauth = new TwitterOAuth($consumerKey,$consumerSecret);

			//callback url を指定して request tokenを取得
			$oOauthToken = $oOauth->getRequestToken($sCallBackUrl);

			//セッション格納
			$_SESSION['requestToken'] = 			$sToken = $oOauthToken['oauth_token'];
			$_SESSION['requestTokenSecret'] = 		$oOauthToken['oauth_token_secret'];

			//認証URLの引数 falseの場合はtwitter側で認証確認表示
			if(isset($_GET['authorizeBoolean']) && $_GET['authorizeBoolean'] != ''){
				$bAuthorizeBoolean = false;
			}else{
				$bAuthorizeBoolean = true;
			}

			//Authorize url を取得
			$sUrl = $oOauth->getAuthorizeURL($sToken, $bAuthorizeBoolean);
?>


<html>
<head>
  <title>Talkmob / Welcome</title>

  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0"/>


    <link rel="stylesheet" type="text/css" href="./css/main.css">
	<link rel="stylesheet" type="text/css" href="./css/parts.css">


</head>

<body >



<div id="main">

	<div id="SignUp" class="logo_exp">

	  <div class="">
	      <p>Welcome to</p>
	      <img width="251" height="61" src="https://s-passets-ec.pinimg.com/images/join/pinterest.png">
	  </div>

	  <div class="wrapper">
	    <div class="content">
	      <div class="">

	            <div class="getStarted">
	              Step 1 of 2
	            </div>

	          <h1>Create your account to explore Pinterest.</h1>

	      </div>

	      <div class="intermission">
	        <h2 class="text">Connect with</h2>
	      </div>


	      <ul class="buttons">
	        <li>
	        <!-- <a href="/facebook/register/?scope=email,user_likes,user_birthday,publish_actions" class="BigButton facebook" data-network="facebook" data-callback-url="/facebook/register/"> -->
	        <a href="" class="BigButton facebook" >
	              <span class="logo"></span>
	              Facebook
	          </a>
	        </li>
	        <li>
	          <!-- <a href="/twitter/" class="BigButton twitter" data-network="twitter" data-callback-url="/twitter/register/"> -->
	          <a href="<?php echo $sUrl; ?>" class="BigButton twitter">
		          <span class="logo"></span>
	              Twitter
	          </a>
	        </li>
	      </ul>

	      <div class="footer">
	          <h3 class="login">
	            <span>Already have an account? </span>
	            <a href="/login/">Log in.</a>
	          </h3>
	          <h3 class="login">
	            <span>Are you a business? </span>
	            <a href="http://business.pinterest.com/">Learn more.</a>
	          </h3>
	      </div>

	</div>
</div>

<div id="Loading"></div>
</div>
</div>




</body>
</html>