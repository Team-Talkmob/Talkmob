<?php

	//SESSION開始
	session_start();

	//インクルード
	require_once("twitteroauth/twitteroauth.php");
	//Consumer keyの値をTwitterAPI開発者ページでご確認下さい。
	$sConsumerKey = "khq3qZqPdT7UczkRPR3Alw";
	//Consumer secretの値を格納
	$sConsumerSecret = "xxxxxxxxx";

	//URLパラメータからoauth_verifierを取得
	if(isset($_GET['oauth_verifier']) && $_GET['oauth_verifier'] != ''){
		$sVerifier = $_GET['oauth_verifier'];
		echo 'asdf';
	}else{
		echo 'oauth_verifier error!';
		exit;
	}

	//リクエストトークンでOAuthオブジェクト生成
	$oOauth = new TwitterOAuth($sConsumerKey,$sConsumerSecret,$_SESSION['requestToken'],$_SESSION['requestTokenSecret']);

	//oauth_verifierを使ってAccess tokenを取得
	$oAccessToken = $oOauth->getAccessToken($sVerifier);

	//取得した値をSESSIONに格納
	$_SESSION['oauthToken'] = 			$oAccessToken['oauth_token'];
	$_SESSION['oauthTokenSecret'] = 	$oAccessToken['oauth_token_secret'];
	$_SESSION['userId'] = 				$oAccessToken['user_id'];
	$_SESSION['screenName'] = 			$oAccessToken['screen_name'];

	//loginページへリダイレクト
	header("Location: talk.php");

	echo('hoge!');
?>
