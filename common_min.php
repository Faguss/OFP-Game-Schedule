<?php
// Download website
function GS_url_get_contents($url, $timeout=NULL) {
    if (!function_exists('curl_init'))
        die('CURL is not installed!');

    $request = curl_init();
	curl_setopt($request, CURLOPT_URL, $url);
	curl_setopt($request, CURLOPT_HEADER, 0);
	curl_setopt($request, CURLOPT_RETURNTRANSFER, 1);
	
	if (isset($timeout))
		curl_setopt($request, CURLOPT_TIMEOUT, $timeout);
	
    $output = curl_exec($request);
    curl_close($request);
    return $output;
}

// Get OFP game server status
function GS_query_ofp_server($address) {
	$output = "{\"error\":\"server error\"}";
	
	if (extension_loaded("sockets")) {
		if (strpos($address,":") === FALSE)
			$address .= ":2303";
		
		$address_tokens = explode(":", $address);
		$server         = $address_tokens[0];
		$port           = intval($address_tokens[1]) + 1;
		$sock           = socket_create(AF_INET, SOCK_DGRAM, SOL_UDP);
		
		if ($sock === false) {
			$errorcode = socket_last_error();
			$errormsg  = socket_strerror($errorcode);
			$output = "{\"error\":\"server error\", \"code\":$errorcode}";
			#echo "Couldn't create socket: [$errorcode] $errormsg \n";
			return $output;
		}
		
		socket_set_option($sock, SOL_SOCKET,SO_RCVTIMEO, ["sec"=>1,"usec"=>0]);
		
		$input = "\\status\\";
		if (socket_sendto($sock, $input , strlen($input) , 0 , $server , $port) === false) {
			$errorcode = socket_last_error();
			$errormsg  = socket_strerror($errorcode);
			$output = "{\"error\":\"server error\", \"code\":$errorcode}";
			#echo "Could not send data: [$errorcode] $errormsg \n";
			return $output;
		}
			
		$from   = '';
		$port   = 0;
		$result = socket_recvfrom($sock, $buf, 4096, 0, $from, $port);

		if ($result === false) {
			$errorcode = socket_last_error();
			$errormsg  = socket_strerror($errorcode);        
			$output = "{\"error\":\"server error\", \"code\":$errorcode}";
			#echo "Could not receive data: [$errorcode] $errormsg \n";
			return $output;
		}
		$buf   = trim($buf, "\\");
		$parts = explode("\\", $buf);

		$name         = true;
		$server_data  = [];
		$players      = [];
		$add_to_array = true;

		for ($i=0; $i<count($parts)-1; $i+=2) {
			$name  = $parts[$i];
			$value = $parts[$i+1];

			if (substr_compare($name,'player',0,6) == 0) {
				$add_to_array = false;
				$players[]    = mb_convert_encoding($value, 'UTF-8', 'ISO-8859-1');
			}

			if ($add_to_array)
				$server_data[$name] = $value;
		}
		
		$server_data["players"] = $players;
		$output = json_encode($server_data);
	} else {
		if (strpos($address,":") === FALSE)
			$address .= ":2302";
		
		$output = GS_url_get_contents("https://ofp-api.ofpisnotdead.com/{$address}");
	}
	
	return $output;
}
?>