<?php
	$tv = $_REQUEST['id'];

	$url = 'https://app-etslive-2.vidio.com/live/';
	$tokke = 'https://www.vidio.com/live/'.$tv.'/tokens';

	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $tokke);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');
  
	$headers = ['Content-Type' => 'application/x-www-form-urlencoded', 'charset' => 'utf-8'];
	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

	$result = curl_exec($ch);
	if (curl_errno($ch)) {
		echo 'Error:' . curl_error($ch);
	}

	$result = json_decode($result, true);
	$token = $result['token'];
	curl_close($ch);
	
	if (preg_match("/@/", $url)) {
		$urlreq = $url.'/master.m3u8?'.$token;
	}else{
		$urlreq = $url.$tv.'/master.m3u8?'.$token;
	}
		// echo $urlreq;

   $ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $urlreq);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
	curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');

	$headers = array();
	$headers[] = 'Authority: app-etslive-2.vidio.com';
	$headers[] = 'Origin: https://www.vidio.com';
	$headers[] = 'User-Agent: Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.88 Safari/537.36';
	$headers[] = 'Dnt: 1';
	$headers[] = 'Accept: */*';
	$headers[] = 'Sec-Fetch-Site: same-site';
	$headers[] = 'Sec-Fetch-Mode: cors';
	$headers[] = 'Referer: https://www.vidio.com/';
	$headers[] = 'Accept-Encoding: gzip, deflate, br';
	$headers[] = 'Accept-Language: id-ID,id;q=0.9,en-US;q=0.8,en;q=0.7';
	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

	$result = curl_exec($ch);
	if (curl_errno($ch)) {
	    echo 'Error:' . curl_error($ch);
	}

		$resolusi = explode( "\n",$result );
		print_r($resolusi) ;
		// header("Location: $resolusi[3]");

	curl_close($ch);

?>
