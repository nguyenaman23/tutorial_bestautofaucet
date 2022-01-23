<?php
error_reporting(0);

function Run($url, $httpheader = 0, $post = 0, $proxy = 0){
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
	curl_setopt($ch, CURLOPT_COOKIE,TRUE);
	if($post){
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
	}
	if($httpheader){
		curl_setopt($ch, CURLOPT_HTTPHEADER, $httpheader);
	}
	if($proxy){
		curl_setopt($ch, CURLOPT_HTTPPROXYTUNNEL, true);
		curl_setopt($ch, CURLOPT_PROXY, $proxy);
	}
	curl_setopt($ch, CURLOPT_HEADER, true);
	$response = curl_exec($ch);
	$httpcode = curl_getinfo($ch);
	if(!$httpcode) return "Curl Error : ".curl_error($ch); else{
		$header = substr($response, 0, curl_getinfo($ch, CURLINFO_HEADER_SIZE));
		$body = substr($response, curl_getinfo($ch, CURLINFO_HEADER_SIZE));
		curl_close($ch);
		return array($header, $body)[1];
	}
}

$url = "https://bestautofaucet.com/session/autofaucet";
$cookie = "_pk_id.9.68ce=f7626fb3f3ebd7ed.1642137699.; session_new=purna.iera@gmail.com; session_new_id=35fd31a80e147ca4ee337c2b20b926fe; _ga=GA1.2.1248714842.1642137792; HstCfa4531111=1642137793836; HstCmu4531111=1642137793836; __dtsu=51A016418759290C221C93A1391ED7F8; _cc_id=ca2a8dd5148851fbf2d397321a758840; HstCnv4531111=4; HstCns4531111=6; HstCla4531111=1642685697486; HstPn4531111=85; HstPt4531111=272; _pk_ref.9.68ce=%5B%22%22%2C%22%22%2C1642778016%2C%22https%3A%2F%2Fphoenixfaucets.xyz%2F%22%5D; _pk_ses.9.68ce=1; session_ok=true; auto={%22email%22:%22purna.iera@gmail.com%22%2C%22coins%22:[%22doge%22%2C%22ltc%22%2C%22dgb%22%2C%22trx%22%2C%22usdt%22%2C%22fey%22%2C%22zec%22%2C%22sol%22]%2C%22mode%22:%22multi%22%2C%22boost%22:%221%22%2C%22payout_mode%22:%22fp%22}";
$user_agent = "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/97.0.4692.71 Safari/537.36";

$req_headers=[
	"cookie: ".$cookie,
	"user-agent: ".$user_agent
	];

while(true){
	$r1=Run($url,$req_headers,true);

	$coin=explode('<i class="fas fa-coins"></i>',$r1)[1];
	$coin=explode('</div>',$coin)[0];

	echo $coin;
	echo "\n";

	preg_match_all('#<div class="AutoACell AAC-success">(.*?)<a#is',$r1,$success);
	for($i=0;$i<count($success[1]);$i++){
    	echo $success[1][$i];
	}
	
	echo "\n";
	echo str_repeat('~',50);
	echo "\n";
	
	for($x=60;$x>0;$x--){
		echo "\r                       \r";
		echo $x;
		sleep(1);
	}
}
