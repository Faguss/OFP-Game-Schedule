<?php
function url_get_contents($url) {
    if (!function_exists('curl_init'))
        die('CURL is not installed!');

    $request = curl_init();
	curl_setopt($request, CURLOPT_URL, $url);
	curl_setopt($request, CURLOPT_HEADER, 0);
	curl_setopt($request, CURLOPT_RETURNTRANSFER, 1);
    $output = curl_exec($request);
    curl_close($request);
    return $output;
}

function get_text_between($content, $start, $end) {
	$start_index = stripos($content, $start);
    
    if ($start_index === FALSE)
        return "";
    
    $start_index += strlen($start);
    $end_index    = stripos($content, $end, $start_index);
    
    if ($end_index === FALSE)
        $end_index = strlen($content);

    return substr($content, $start_index, $end_index-$start_index);
}

//https://stackoverflow.com/questions/4354904/php-parse-url-reverse-parsed-url
function build_url(array $parts) {
    return (isset($parts['scheme']) ? "{$parts['scheme']}:" : '') . 
        ((isset($parts['user']) || isset($parts['host'])) ? '//' : '') . 
        (isset($parts['user']) ? "{$parts['user']}" : '') . 
        (isset($parts['pass']) ? ":{$parts['pass']}" : '') . 
        (isset($parts['user']) ? '@' : '') . 
        (isset($parts['host']) ? "{$parts['host']}" : '') . 
        (isset($parts['port']) ? ":{$parts['port']}" : '') . 
        (isset($parts['path']) ? "{$parts['path']}" : '') . 
        (isset($parts['query']) ? "?{$parts['query']}" : '') . 
        (isset($parts['fragment']) ? "#{$parts['fragment']}" : '');
}

function get_filename_from_page($url) {
	$url_tokens   = parse_url($url);
	$page_content = url_get_contents($url);
	$filename     = "";
	$keywords     = [];

	switch($url_tokens["host"]) {
		case "drive.google.com" : {
			$keywords = ["<meta itemprop=\"name\" content=\"", "\">"];
			break;
		}
		
		case "www.moddb.com" : {
			if (stripos($url_tokens["path"], "/downloads/start/") !== FALSE)
				$keywords = [">download ", "</a>"];
			else
				$keywords = ["<h5>Filename</h5>", "</div>"];
			break;
		}
		
		case "www.mediafire.com" : {
			$keywords = ["<div class=\"filename\">", "</div>"];
			break;
		}

		case "www.gamefront.com" : {
			if (stripos($url_tokens["path"], "/download") !== FALSE)
				$page_content = url_get_contents(get_text_between($page_content, "Redirecting to ", "</title>"));
			$keywords = ["<i class=\"fa fa-download\"></i> Download '", "'"];
			break;
		}
		
		case "ds-servers.com" : {
			if (stripos($url_tokens["path"], "/files/gf/") !== FALSE)
				$keywords = ["<title>", " &bull;"];
			else
				$keywords = ["<dt>File Name:</dt>", "<dt>"];
			break;
		}
		
		case "www.armaholic.com" : {
			$keywords = ["file=", "\""];
			break;
		}
		
		case "www.sendspace.com" : {
			$keywords = [";\"><b>", "</b></h2>"];
			break;
		}
		
		case "www.lonebullet.com" : {
			if (stripos($url_tokens["path"], "file/") === FALSE) {
				$index_end = strpos($page_content, "'><img src='/imgs/downloadbtn.png'");
				if ($index_end !== FALSE) {
					$index_start = strrpos($page_content, "<a href='", (strlen($page_content)-$index_end)*-1);
					$index_start += 9;
					$url_tokens["path"] = substr($page_content, $index_start, $index_end-$index_start);
					$page_content = url_get_contents(build_url($url_tokens));
				}
			}
			$keywords = ["<h1 style='font-size:30px;'>", " <font"];
			break;
		}
		
		case "www.dropbox.com" : {
			$keywords = ["\"filename\": \"", "\""];
			break;
		}
	}

	if (count($keywords) == 2) {
		$filename = trim(strip_tags(get_text_between($page_content, $keywords[0], $keywords[1])));
		
		if ($url_tokens["host"] == "www.armaholic.com") {
			$words    = explode("/", $filename);
			$filename = empty($words) ? $filename : $words[count($words)-1];
		}
	}
	
	return $filename;
}

$output = "";

if (isset($_POST['filenamefromurl']))
	$output = get_filename_from_page($_POST['filenamefromurl']);
else
	if (isset($_POST['queryserver']) && !empty($_POST['queryserver'])) {
		require_once "minimal_init.php";
		$db = DB::getInstance();
		$ip = $db->cell("gs_serv.ip",["uniqueid","=",$_POST['queryserver']]);

		if (isset($ip)) {
			if (strpos($ip,":") === FALSE)
				$ip .= ":2302";
			
			$output = url_get_contents("https://ofp-api.ofpisnotdead.com/{$ip}");
		}
	}

echo $output;	
?>