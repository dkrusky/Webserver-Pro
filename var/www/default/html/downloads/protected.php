<?php
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 *
 *	AUTHOR: MicroVB Inc ( https://www.microvb.com )
 *	GIT:	https://github.com/microvb/Protected-Signed-URLs-Self-Hosted
 *	===================================================================
 *
 *	The MIT License (MIT)
 *	Copyright (c) 2016 MicroVB Inc.
 *
 *	Permission is hereby granted, free of charge, to any person
 *	obtaining a copy of this software and associated documentation
 *	files (the "Software"), to deal in the Software without restriction,
 *	including without limitation the rights to use, copy, modify, merge,
 *	publish, distribute, sublicense, and/or sell copies of the Software,
 *	and to permit persons to whom the Software is furnished to do so,
 *	subject to the following conditions:
 *
 *	The above copyright notice and this permission notice shall be
 *	included in all copies or substantial portions of the Software.
 *
 *	THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND,
 *	EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF
 *	MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT.
 *	IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY
 *	CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT,
 *	TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE
 *	SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.	
 *
 *	===================================================================
 *
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */
if(file_exists('config.inc.php')) { include('config.inc.php'); }

/* Check if private key or public keys are defined */
if(!defined('PRIVATE_KEY') && !defined('PUBLIC_KEY')) {
	
	if(($fh_priv = fopen('PRIVATE_KEY.pem', "r")) && ($fh_pub = fopen('PUBLIC_KEY.pem', "r"))) {
		/* If private key and public key found in current path, load those */
		$priv = fread($fh_priv, filesize('PRIVATE_KEY.pem'));
		$pub = fread($fh_pub, filesize('PRIVATE_KEY.pem'));
		fclose($fh_priv);
		fclose($fh_pub);
		define('PRIVATE_KEY', $priv);
		define('PUBLIC_KEY', $pub);
	} else {
		/* If no private key and public key combination exists, use the default */
		define('PRIVATE_KEY', '-----BEGIN RSA PRIVATE KEY-----
MIIEpQIBAAKCAQEAx6ux0PNiW6QcKqtXxjQJQrv0D4hLkoHdLzNuwvxSQpwF7YkZ
1E7DfGsDUV0hZkc2vuIKIq1wBL/q5BL4lqH2fxotBI9VJf7ldYVqywk/5lEDymxo
g7DmQhUid688xbUCtUUBbZ88jY1x+/rhgf7wwHuV95X5Z5dGwXdO8z64DjWqgb8w
PIiMHuCxm9/KMm3O9fzrzC80oHzXMmJRZ/tPp2odV6xQh5Y3TkzFn6quod5loTiS
sN1Ue9n9QqPVlQJD9yKiAfeg+YdRMfuYI1Vw4cJ+r2iKAuNs+GtQOW3b1VV8hPQe
MSwWShMq8YTm7IAaUaLGEwfMOuBW06OeV+i91wIDAQABAoIBAQCR6wG56APbYOVM
sYcly+VwpZbIuxwvZ0RTOE0bpfYfw5H5c5Yyt5TZGgOEtICyFB0IBnzNtt4EOpTY
NJ0CyD4xyNlZWb4qVEswRV40HwBZup8AkZUXmHHNnVBhEulgutXNzy4qBJLmB5Zj
RYcDz2H16NtB4pIviDgnLp+91/n+NyLFvyPLvZFltewKQ/+7ZsYDcxwTlOtOb1Sz
2ZTL250oL18Gweo82Uuxl6ipHmUfVU2J66ZsXm6A0uA9o3Qrgc4BiI+5mstIJuAO
lawGL2XlbZ2y+kvyVdpmNtgdvLgR2eUCPxk/5uL5aDjRWUBAMp8ERBOKNGgbeOun
9nkuCFwBAoGBAPGJOv40qD3bXdtpv2dMWyEO2CvGELRA+kkBDxFrsQWJw/9pr0PD
5gvtKxPAcZdXDkvR21YayjIxyt1mbuDzdpoIh0IZkiJ3TZ3wHUnjKytVjQqec5IC
cJpQhPz21hd2NbjngwIk7ztaTLf+0wkDmrv81oae93FLxI6+KWDVGu8BAoGBANOg
qgff0rkVtPb4n5GLKQD0Vwzk2zvG7J5GdVZ4W/y4JFScFdMY0/fhLuVc5Gl7A1hn
3YSjecx2CBAsv7+aJeUd8MBKWUJ/xsdWJjdEbwJ7sedN4XxzbGpcdmVzrZj/gq03
10S9hkV2sNUDIBitWLMJRqGT8UxdI1Vk12ZgjgTXAoGBAOHQUeYNpulF6ObUY80Y
lu4+KZ4rK7zKLvUH12WLEFJELYjh7qjlQnMOBcMOnWRHUKdUCMLkgvsQkEATn0AS
fmSd6o7Cx1wPu/IX5doJV3fJIPa3kwcD3vB2rQ6vWxNOQgWf9FyR2VPdJXKz++sm
goiUZqAviNlUY+ysHpVYRzkBAoGBAIlZ4mEf9J0pqH0OWkpVHnS/IOx+cIe4kQQc
yLUpgtJgFTxQ3Z1XpONh5FT62EhZjY9IQi5/B2MbTBprYLwTaPruVr4Gwy30zme7
0yvVn5LmA04TbwCdzUSu5CzuSkJdu0t/TZkQxN+6rARkdeVuRH5Wy9+8rESawn7+
5wpMKoCbAoGAWjwthstDp0oD21TofoUHPtbxovKg+0ygiPON9paUufI7/I7duKX7
lGl6Q8FW++2fsVVxfhQSNtvnqgJrJxggWwAJ9jZGhwb+3sjKI6gyFBHkL4rKEhyf
YxGF1ZZ5ccmwDULVfefXq44oc4u20+TRig2XzGo4mp72+tc/zqCL4Q0=
-----END RSA PRIVATE KEY-----');

		define('PUBLIC_KEY', '-----BEGIN PUBLIC KEY-----
MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAx6ux0PNiW6QcKqtXxjQJ
Qrv0D4hLkoHdLzNuwvxSQpwF7YkZ1E7DfGsDUV0hZkc2vuIKIq1wBL/q5BL4lqH2
fxotBI9VJf7ldYVqywk/5lEDymxog7DmQhUid688xbUCtUUBbZ88jY1x+/rhgf7w
wHuV95X5Z5dGwXdO8z64DjWqgb8wPIiMHuCxm9/KMm3O9fzrzC80oHzXMmJRZ/tP
p2odV6xQh5Y3TkzFn6quod5loTiSsN1Ue9n9QqPVlQJD9yKiAfeg+YdRMfuYI1Vw
4cJ+r2iKAuNs+GtQOW3b1VV8hPQeMSwWShMq8YTm7IAaUaLGEwfMOuBW06OeV+i9
1wIDAQAB
-----END PUBLIC KEY-----');
	}
} elseif(!defined('PUBLIC_KEY')) {
	/* Missing only public key */
	header("HTTP/1.0 500 Internal Server Error", true, 500);
	die('PUBLIC_KEY not defined or missing');
} elseif(!defined('PRIVATE_KEY')) {
	/* Missing only private key */
	header("HTTP/1.0 500 Internal Server Error", true, 500);
	die('PRIVATE_KEY not defined or missing');
}

if(!defined('URLSIGNINCLUDE')) {
	if(URLSigner::verify(URLSigner::current()) === true) {
		/* Signed url is valid. Get local path to file and push to the browser */
		$file = (object)parse_url(URLSigner::current());
		$file = __DIR__ . DIRECTORY_SEPARATOR . basename($file->path);
		URLSigner::push($file);
	} else {
		/* Signed url is invalid. Deny access */
		header('HTTP/1.0 403 Forbidden', true, 403);
		echo 'Access Denied';
	}
}

/* URLSigner class begins here */
class URLSigner {
	
	/* If support on the server is enabled, you can use this method to return a private/public key pair */
	static function generate($bits = 4096) {
		$keys = openssl_pkey_new(
			Array(
				'digest_alg' => 'sha256',
				'private_key_bits' => $bits,
				'private_key_type' => OPENSSL_KEYTYPE_RSA
			)
		);

		if($keys === false) {
			return openssl_error_string();
		}
		
		openssl_pkey_export($keys, $private_key);
		
		$public_key = openssl_pkey_get_details($keys);
		$public_key = $public_key['key'];
		
		return (object)Array(
			'private_key'=>$private_key,
			'public_key'=>$public_key
		);
	}
	
	/* Sign URL using defined private key */
	static function sign($url, $expire = 5) {
		$signature = '';
		$expire = time() + ($expire * 60);
		openssl_sign(
			json_encode(
				Array(
					'expires'=>(int)$expire,
					'url'=>(string)$url
				)
			),
			$signature,
			PRIVATE_KEY,
			OPENSSL_ALGO_SHA256
		);
		
		return sprintf('%s?Expires=%s&Hash=%s',
						$url,
						$expire, 
						str_replace(
							array('+', '=', '/'),
							array('-', '_', '~'),
							base64_encode($signature)
						)
					);
	}

	/* This method is used internally to get the current url to validate */
	static function current() {
		$port = '';
		if (($_SERVER['REQUEST_SCHEME'] == 'https' && (int)$_SERVER['SERVER_PORT'] != 443) || ($_SERVER['REQUEST_SCHEME'] == 'http' && (int)$_SERVER['SERVER_PORT'] != 80) ) { $port = ':' . $_SERVER['SERVER_PORT']; }
		
		if(!isset($_SERVER['REDIRECT_QUERY_STRING'])) { return ''; }
		return rtrim(sprintf(
			'%s://%s%s%s?%s',
			$_SERVER['REQUEST_SCHEME'],
			$_SERVER['HTTP_HOST'],
			$port,
			$_SERVER['REQUEST_URI'],
			$_SERVER['REDIRECT_QUERY_STRING']
		),'?');
		
	}
	
	/* This method will take a full url with parameters and verify if the signature is valid and not expired */
	static function verify($url) {
		if(trim($url) == '') { return false; }
		try{
			/* Parse url for values */
			$r = (object)parse_url($url);
			$u = $r->scheme . '://' . $r->host . $r->path;
			parse_str($r->query, $q);

			/* Check that the required parameters exist */
			if( !isset($q['Expires']) || !isset($q['Hash']) ) { return false; }
			
			/* Verify time hasn't expired */
			$i = (int)$q['Expires'];
			if((time() - $i) >= 0) { return false; }
			
			/* Validate signature */
			$result = openssl_verify(
								json_encode(
									Array(
										'expires'=>(int)$i,
										'url'=>(string)$u
									)
								),
								base64_decode(
									str_replace(
										array('-', '_', '~'),
										array('+', '=', '/'),
										$q['Hash']
									)
								),
								PUBLIC_KEY,
								OPENSSL_ALGO_SHA256
						);

			/* Signature is valid */
			if($result === 1) { return true; }
						
		} catch(Exception $e) {
			error_log(sprintf('%s [%s] : %s', $e->getFile(), $e->getline(), $e->getMessage()));
			return false;
		}
		return false;
	}
	
	/* Force a file to be pushed to the browser using XSendFile */
	static function push($file) {
		if(file_exists($file)) {
			header("X-Sendfile: $file");
			header("Content-Type: application/octet-stream");
			header("Content-Disposition: attachment; filename=\"" . basename($file) . "\"");
			header("Content-Length: " . filesize($file));
			exit;
		} else {
			header('HTTP/1.0 404 Not Found', true, 404);
			echo 'File has been removed';
		}
	}
	
}
