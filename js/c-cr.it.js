$(document).ready(function(){
    $('div#pwd_form > form').submit(function(){
        var url = $('input#s').val();
        var pass = $('input#p').val();
        var algo = $('select#a').val();

        url = url.replace("http://", "");
        url = url.trim();

        $('input#s').val(url);

        if (algo!='bsha256'){
            $.post('./encode.php', {
                s:url,
                p:pass,
                a:algo
            },function(data) {
                $('#password_res').html(data);
                selectText('password_res');
            });
        }
        else{
            var i=1000;

            var str = pass+url+pass+url;
            var hash = Sha256.hash(str);
            while(i>0)
            {
                hash = Sha256.hash(hash);
                i--;
            }
            baseHash = Base64.encode(hash);
            shorthash = baseHash.substr(0,12);
            $('#password_res').html(shorthash);
            selectText('password_res');
        }
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