
<TITLE> Hello World in PHP </TITLE>
</HEAD>
<BODY>

<?

print("Hello World<br>");

// $HTTP_USER_AGENT and $REMOTE_ADDR are two of many evironment
// variables in PHP.  Environent variables store information about
// the user's and server's environment

print("You are using $_SERVER[HTTP_USER_AGENT]<br>");
print("Your Internet address is $_SERVER[REMOTE_ADDR]<br>");

$ip = $_SERVER['REMOTE_ADDR'];
$details = file_get_contents("http://ipinfo.io/{$ip}");
print_r($details);

print("<br>");

$obj = json_decode($details);

$city=$obj->{'city'};
$state=$obj->{'region'};
print("You are at $city in $state <br>");

print("<br>");
print("<br>");



//
// From http://non-diligent.com/articles/yelp-apiv2-php-example/
//




// Enter the path that the oauth library is in relation to the php file
require_once ('OAuth.php');


// For example, request business with id 'the-waterboy-sacramento'
//$unsigned_url = "http://api.yelp.com/v2/business/the-waterboy-sacramento";
$unsigned_url = "http://api.yelp.com/v2/search?term=Chinese+Food&location=Fremont+California";

//$yelpstring = file_get_contents("http://api.yelp.com/business_review_search?category=bars&lat=".$latitude."&long=".$longitude."&radius=25&num_biz_requested=100&ywsid=<your yelp account id>", true); 


// For examaple, search for 'tacos' in 'sf'
//$unsigned_url = "http://api.yelp.com/v2/search?term=tacos&location=sf";




// Set your keys here
$consumer_key = "M44itCk1vYxpqJJL_CmjMg";
$consumer_secret = "DRG9GUQiJvlfufXd3p8DlA8zHOA";
$token = "_k7AmKTWmBglmPNnLs8xJGNtJBRq4elB";
$token_secret = "dwTWziQ2XMMzsJVcAtlpj27CQKI";


// Token object built using the OAuth library
$token = new OAuthToken($token, $token_secret);


// Consumer object built using the OAuth library
$consumer = new OAuthConsumer($consumer_key, $consumer_secret);


// Yelp uses HMAC SHA1 encoding
$signature_method = new OAuthSignatureMethod_HMAC_SHA1();


// Build OAuth Request using the OAuth PHP library. Uses the consumer and token object created above.
$oauthrequest = OAuthRequest::from_consumer_and_token($consumer, $token, 'GET', $unsigned_url);


// Sign the request
$oauthrequest->sign_request($signature_method, $consumer, $token);


// Get the signed URL
$signed_url = $oauthrequest->to_url();


// Send Yelp API Call
$ch = curl_init($signed_url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HEADER, 0);
$data = curl_exec($ch); // Yelp response
curl_close($ch);

// Handle Yelp response data
$response = json_decode($data);

foreach($response->businesses as $business):
        echo "<img border=0 src='".$business->image_url."'><br/>";
        echo $business->name."<br/>";
		echo $business->phone "</br>";
        echo "<hr>";
    endforeach;

// Print it for debugging
//print_r($response);


?>

</BODY>
</HTML>
