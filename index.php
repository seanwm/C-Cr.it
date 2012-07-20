<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=320">
<meta charset=utf-8>
<link rel="icon" type="image/png" href="https://c-cr.it/ccrit-favicon.png">
<link rel="stylesheet" href="./css/screen.css">
<link rel="stylesheet" media="only screen and (max-device-width: 740px)" href="./css/mobile.css?dd">
<link href='https://fonts.googleapis.com/css?family=Nunito:700,400' rel='stylesheet' type='text/css'>
<title>C-Crit! - Anonymous Password Wallet</title>
<script src="/js/jquery.min.js" type="text/javascript"></script>
<script src="/js/base64.js" type="text/javascript"></script>
<script src="/js/Clipperz/Base.js" type="text/javascript"></script>
<script src="/js/Clipperz/ByteArray.js" type="text/javascript"></script>
<script src="/js/Clipperz/Crypto/BigInt.js" type="text/javascript"></script>
<script src="/js/Clipperz/Crypto/SHA.js" type="text/javascript"></script>
<script src="/js/Clipperz/Crypto/AES.js" type="text/javascript"></script>
<script src="/js/Clipperz/Crypto/PRNG.js" type="text/javascript"></script>
<script src="/js/bCrypt.js" type="text/javascript"></script>
<script type="text/javascript">
var id;
var bcrypt = new bCrypt();
function enable(){
	if(bcrypt.ready()){
		$("#submit").removeAttr("disabled");
		clearInterval(id);
	}
}

$(document).ready(function(){
	
    $('div#pwd_form > form').submit(function(){
	
        var url = $('input#s').val();
        var pass = $('input#p').val();

				var formatted_pass = massageSalt(pass);
				var formatted_url = massageUrl(url);
				var result = "";
				try{
					bcrypt.hashpw(
						formatted_url, formatted_pass, result, function() {
                	//var value = $('#progressbar').progressbar( "option", "value" );
									//$('#progressbar').progressbar({ value: value + 1 });
            }
					);
        }catch(err){
					alert(err);
					return;
        }
    });
});

function result(hash)
{
	//resultstr = Base64.encode(hash);
	$('#password_res').html(hash);
	selectText('password_res');
}

function massageSalt(salt)
{
	if (salt.length < 23) {
		for (i = (23/salt.length); i>0; i--){
			salt = salt + salt;
		}
	}
	salt = Base64.encode(salt);
	salt = salt.replace('[^A-Za-z0-9]','');
	salt = '$2a$12' + salt.substring(0,22);
	return salt;
}

function massageUrl(url)
{
	url = jQuery.trim(url);
	if (url.substring(url.length-1)=='/') url = url.substring(0,url.length-1);
	if (url.substring(0,7)=='http://') url = url.substring(7);
	if (url.substring(0,8)=='https://') url = url.substring(8);	
	return url;
}

function selectText(element) {
    var doc = document;
    var text = doc.getElementById(element); 

    if (doc.body.createTextRange) { // ms
        var range = doc.body.createTextRange();
        range.moveToElementText(text);
        range.select();
    } else if (window.getSelection) { // moz, opera, webkit
        var selection = window.getSelection();
        var range = doc.createRange();
        range.selectNodeContents(text);
        selection.removeAllRanges();
        selection.addRange(range);
    }
}

</script>
</head>
<body>

<hgroup>
<h1>Keep it C-Crit!</h1>
<h2>On-the-fly Passwords</h2>
</hgroup>

<div class="f">
   <div id="pwd_form">
    <form>
        <div class="fe">
            <label for="s">Site (not case sensitive):</label>
            <input name="s" id="s" placeholder="Site name, url, etc" autofocus type="text" required>
                <p class="small">
It's best to choose one particular site attribute &mdash; name, URL, etc &mdash; with C-Cr.it. Be consistent! To help,
"http://" and trailing backslashes will be automatically removed.</p>
        </div>
        <div class="fe">
            <label for="p">Pass key (case sensitive):</label>
            <input name="p" id="p" placeholder="Your master password or phrase" required type=password>
            <p class="small">
                This extra little bit is used to make sure that C-Cr.it returns a password that's just for you.  You can use the same pass key 
		for multiple sites, but make it unique, long, and hard to guess.
            </p>
        </div>
	<div class="fe minor">
		<label for="a">Algorithm:</label>
		<select name="a" id="a" required>
			<option value="orig">Original (SHA1)</option>
			<option value="bcrypt1">BCrypt V1</option>
		</select>
	</div>
        <div class="fe">
            <input type="submit" value="Keep it C-Cr.it!" class="submit" id="submit" disabled="disabled">
        </div>
    </form>
    <p class="result">
	<span id="usethis">Use this Password: </span><span id="password_res">XXXXXXXXXXXX</span>    
    </p>
    </div>
    

</p>
</body>
</html>
