<?php
ini_set('session.use_cookies', 0);
?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=320">
<meta charset=utf-8>
<link rel="icon" type="image/png" href="https://c-cr.it/ccrit-favicon.png">
<link rel="stylesheet" href="./css/screen.css?v=2.25.2013-A">
<link rel="stylesheet" media="only screen and (max-device-width: 740px)" href="./css/mobile.css?dd">
<link href='https://fonts.googleapis.com/css?family=Nunito:700,400' rel='stylesheet' type='text/css'>
<title>C-Crit! - Anonymous Password Wallet</title>
<!--[if lt IE 9]>
    <script src="./js/iestrfix.js" type="text/javascript"></script>
<![endif]-->
<script src="./js/jquery.min.js" type="text/javascript"></script>
<script src="./js/jquery.cookie.js" type="text/javascript"></script>
<script src="./js/sha256.js" type="text/javascript"></script>
<script src="./js/base64.js" type="text/javascript"></script>
<script src="./js/c-cr.it.js?v=3.18.2013-A" type="text/javascript"></script>
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
<h1>Keep it <span id="sitename">C-Crit!</span></h1>
<h2>On-the-fly Passwords</h2>
</hgroup>

<div class="f">
   <div id="pwd_form">
    <form method="post">
		<div class="front top">
        <div class="fe">
            <label for="s">Site:</label>
            <input name="s" id="s" placeholder="Site name, url, etc" autofocus type="text" required>
                <p class="small">
Choose a site attribute &mdash; name, URL &mdash; to use with C-Cr.it. Be consistent! 
"http://" and trailing backslashes will be removed.</p>
        </div>
				</div>
				<div class="back">
        <div class="fe">
            <label for="p">Key (case sensitive):</label>
            <input name="p" id="p" placeholder="Your master password or phrase" required type=password>
            <p class="small">
                You can use the same key for multiple sites, but make it unique, long, and hard to guess.
            </p>
        </div>
	<div class="fe minor">
		<label for="a">Algorithm:</label>
		<select name="a" id="a" required>
			<option value="alga">Algorithm A (Browser SHA256)</option>
      <option value="algb">Algorithm B (In-Browser SHA256)</option>
      <option value="algc">Algorithm C (In-Browser SHA256)</option>
      <option value="algd">Algorithm D (In-Browser SHA256)</option>
			<option value="orig">Original SHA1: Transmitted to C-CR.IT</option>
            <!--<option value="bcrypt1">BCrypt V1--UNSAFE, DO NOT USE</option>//-->
		</select>
	</div>
	</div>
	<div class="front bottom">
        <div class="fe">
            <input type="submit" value="Keep it C-Cr.it!" class="submit">
        </div>
    </form>
    <p class="result">
	<span id="usethis">Use this Password: </span><span id="password_res">XXXXXXXXXXXX</span>    
    </p>
 </div>
</div>
<footer>
	<a href="./what.html">What is this?</a>
</footer>
</body>
</html>
