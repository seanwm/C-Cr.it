<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=320">
<meta charset=utf-8>
<link rel="stylesheet" href="./css/screen.css">
<link rel="stylesheet" media="only screen and (max-device-width: 740px)" href="./css/mobile.css?dd">
<title>C-Crit! - Anonymous Password Wallet</title>
<script src="/js/jquery.min.js" type="text/javascript"></script>
<script>
$(document).ready(function(){
    $('div#pwd_form > form').submit(function(){
        var url = $('input#s').val();
        var pass = $('input#p').val();
        $.post('./encode.php', {
        s:url,
        p:pass
        },function(data) {
            $('.result').html(data);
        });
        return false;
    });


});
</script>
</head>
<body>

<hgroup>
<h1>Keep it C-Crit!</h1>
<h2>On-the-fly Passwords</h2>
</hgroup>

<p class="f">
    <div id="pwd_form">
    <form>
        <p class="fe">
            <label for="s">Site (not case sensitive):</label>
            <input name="s" id="s" placeholder="Site name, url, etc" autofocus type="text" required>
            <small>
                It's best to choose one particular site attribute &mdash; name, URL, etc &mdash; with C-Cr.it. Be consistent! To help,
"http://" and trailing backslashes will be automatically removed.
            </small>
        </p>
        <p class="fe">
            <label for="p">Pass key (case sensitive):</label>
            <input name="p" id="p" placeholder="Your master password, phrase, or string." required type=password>
            <small>
                This extra little bit (geeks call it a "salt") makes sure that C-Cr.it returns a password that's just for you.  You can use the same pass key for multiple sites, but make it unique and hard to guess. A phrase is ideal!
            </small>
        </p>
        <p class="fe">
            <input type="submit" value="Keep it C-Cr.it!">
        </p>
    </form>
    <p class=result>
    
    </p>
    </div>
    

</p>
</body>
</html>
