<?php

function rr($js_code)
	{
	$js_code = str_replace(array(
		")+(",
		"![]",
		"!+[]",
		"[]"
	) , array(
		").(",
		"(!1)",
		"(!0)",
		"(0)"
	) , $js_code);
	return $js_code;
	}

function getClearanceLink($content, $url)
	{
	sleep(4);
	preg_match_all('/name="\w+" value="(.+?)"/', $content, $matches);
	$params = array();
	list($params['s'], $params['jschl_vc'], $params['pass']) = $matches[1];
	$uri = parse_url($url);
	$host = $uri["host"];
	$result = "";
	$t1 = explode('id="cf-dn', $content);
	$t2 = explode(">", $t1[1]);
	$t3 = explode("<", $t2[1]);
	$cf = $t3[0];
	preg_match("/f\,\s?([a-zA-z0-9]+)\=\{\"([a-zA-Z0-9]+)\"\:\s?([\/!\[\]+()]+|[-*+\/]?=[\/!\[\]+()]+)/", $content, $m);
	eval("\$result=" . rr($m[3]) . ";");
	$pat = "/" . $m[1] . "\." . $m[2] . "(.*)+\;/";
	preg_match($pat, $content, $p);
	$t = explode(";", $p[0]);
	for ($k = 0; $k < count($t); $k++)
		{
		if (substr($t[$k], 0, strlen($m[1])) == $m[1])
			{
			if (strpos($t[$k], "function(p){var p") !== false)
				{
				$a1 = explode("function(p){var p", $t[$k]);
				$t[$k] = $a1[0] . $cf;
				$line = str_replace($m[1] . "." . $m[2], "\$result ", rr($t[$k])) . ";";
				eval($line);
				}
			  else
			if (strpos($t[$k], "(function(p){return") !== false)
				{
				$a1 = explode("(function(p){return", $t[$k]);
				$a2 = explode('("+p+")")}', $a1[1]);
				$line = "\$index=" . rr(substr($a2[1], 0, -2)) . ";";
				eval($line);
				$line = str_replace($m[1] . "." . $m[2], "\$result ", rr($a1[0]) . " " . ord($host[$index]) . ");");
				eval($line);
				}
			  else
				{
				$line = str_replace($m[1] . "." . $m[2], "\$result ", rr($t[$k])) . ";";
				eval($line);
				}
			}
		}

	$params['jschl_answer'] = round($result, 10);
	return sprintf("%s://%s/cdn-cgi/l/chk_jschl?%s", $uri['scheme'], $uri['host'], http_build_query($params));
	}
