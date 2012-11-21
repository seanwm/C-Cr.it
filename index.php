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
<script>
$(document).ready(function(){
    $('div#pwd_form > form').submit(function(){
        var url = $('input#s').val();
        var pass = $('input#p').val();
	var algo = $('select#a').val();
        $.post('./encode.php', {
        s:url,
        p:pass,
	a:algo
        },function(data) {
            	$('#password_res').html(data);
		selectText('password_res');
        });
        return false;
    });


});
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
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-34363606-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

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
            <input type="submit" value="Keep it C-Cr.it!" class="submit">
        </div>
    </form>
    <p class="result">
	<span id="usethis">Use this Password: </span><span id="password_res">XXXXXXXXXXXX</span>    
    </p>
    </div>
    

</p>
</body>
</html>