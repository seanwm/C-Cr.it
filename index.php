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
<script src="/js/base64.js" type="text/javascript"></script>
<script src="/js/MochiKit/MochiKit.js" type="text/javascript"/></script>
<script src="/js/Clipperz/Base.js" type="text/javascript"></script>
<script src="/js/Clipperz/ByteArray.js" type="text/javascript"></script>
<script src="/js/Clipperz/Crypto/BigInt.js" type="text/javascript"></script>
<script src="/js/Clipperz/Crypto/SHA.js" type="text/javascript"></script>
<script src="/js/Clipperz/Crypto/AES.js" type="text/javascript"></script>
<script src="/js/Clipperz/Crypto/PRNG.js" type="text/javascript"></script>
<script src="/js/bCrypt.js" type="text/javascript"></script>
<script src="/js/jquery.min.js" type="text/javascript"></script>
<script type="text/javascript">
var id;
var bcrypt = new bCrypt();

function enable(){
	/*if(bcrypt.ready()){
		//$("#submit").removeAttr("disabled");
		clearInterval(id);
		//alert("bcrypt is ready!");
	}*/
}

function randomCharacter() {
	var chars = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXTZabcdefghiklmnopqrstuvwxyz";
	var string_length = 1;
	var randomstring = '';
	for (var i=0; i<string_length; i++) {
		var rnum = Math.floor(Math.random() * chars.length);
		randomstring += chars.substring(rnum,rnum+1);
	}
	return randomstring;
}

function randomizePlaceholder()
{
	current_val = $('#password_res').html();
	var rch = Math.floor(Math.random() * current_val.length);
	if (rch>0){
		new_val = current_val.substring(0,rch-1) + randomCharacter() + current_val.substring(rch);
		$('#password_res').html(new_val);
	}
}

$(document).ready(function(){
	//id = setInterval(enable,250);
    $('#submit').click(function(){
	$('#usethis').html('Generating...');
	var value = 0;
	//console.log("Form submitted");
        var url = $('input#s').val();
        var pass = $('input#p').val();

				var formatted_pass = massageSalt(pass);
				var formatted_url = massageUrl(url);

			//console.log("Formmated pass: "+formatted_pass);
			//console.log("Formmated url: "+formatted_url);
				try{
					bcrypt.hashpw(
						formatted_url, formatted_pass, result, function() {
							randomizePlaceholder();
							//current_val = $('#password_res').html();
							//new_val = current_val.
			                		//$('#password_res').var value = $('#progressbar').progressbar( "option", "value" );
									//$('#progressbar').progressbar({ value: value + 1 });
            }
					);
		return false;
        }catch(err){
					alert(err);
					return false;
        }
	return false;
    });
});

var begin = '';
function result(hash)
{
	//console.log("In result.");
	//console.log("Hash: "+hash);
	$('#usethis').html("Use this Password: ");
	$('#password_res').html(massageResult(hash));
	selectText('password_res');
	//return false;
}
function massageResult(hash)
{
	hash = hash.replace('/','_');
	hash = hash.replace('+','-');
	hash = hash.substring(0,$('#password_res').html().length);
	return hash;
}

function massageSalt(salt)
{
	asalt = salt.replace(" ", "");
	if (asalt.length < 40) {
		for (i = (40/asalt.length); i>0; i--){
			asalt = asalt + asalt;
		}
	}
	//salt = Base64.encode(salt);
	bsalt = asalt.replace(" ",'');
	csalt = bsalt.replace(/[^A-Za-z0-9]/,'');
	dsalt = '$2a$12$t' + csalt.substring(0,28);
	return dsalt;
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
            <input type="button" value="Keep it C-Cr.it!" class="submit" id="submit">
        </div>
    </form>
    <p class="result">
	<span id="usethis">Use this Password: </span><span id="password_res">XXXXXXXXXXXX</span>    
    </p>
    </div>
    

</p>
</body>
</html>
