$(document).ready(function(){
	
	var pref = $.cookie("algo");
	
	if (pref=='alga' || pref=='algb' || pref=='algc' || pref=='algd'){
		setAlgo(pref);
		changeAlgoSelectionTo(pref);
	}
	else {
		var rnd = Math.floor((Math.random()*4)+1);
		switch(rnd)
		{
			case 2:
				changeAlgoSelectionTo('algb');
				setAlgo('algb');
				break;
			case 3:
				changeAlgoSelectionTo('algc');
				setAlgo('algc');
				break;
			case 4:
				changeAlgoSelectionTo('algd');
				setAlgo('algd');
				break;
			default:
				changeAlgoSelectionTo('alga');
				setAlgo('alga');
				break;
		}
	}	
	
	
	$('select#a').change(function(){
		var alg = $('select#a').val();
		setAlgo(alg);		
		if (
			$('span#password_res').html()!="XXXXXXXXXXXX"
		&&
			(alg=='alga' || alg=='algb' || alg=='algc' || alg=='algd')
		)
		{
			inBrowserHashWithAlgo(alg);
		}
	});
	
	$('div#pwd_form > form').submit(function(){
		var url = $('input#s').val();
		var pass = $('input#p').val();
		var algo = $('select#a').val();
		
		url = url.replace("http://", "");
		url = url.replace("https://", "");
		url = url.trim();
		
		$('input#s').val(url);
		
		if (algo.substring(0,3)!='alg'){
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
			inBrowserHashWithAlgo(algo);
		}
		return false;
	});


});

function inBrowserHashWithAlgo(algo)
{
	var url = $('input#s').val();
	var pass = $('input#p').val();
	var algo = $('select#a').val();
	
	url = url.replace("http://", "");
	url = url.trim();
	
	$('input#s').val(url);

	var i=1000;
	if (algo=='alga')
		i = 1100;
	else if (algo=='algb')
		i = 1200;
	else if (algo=='algc')
		i = 1300;
	else if (algo=='algd')
		i = 1400;
	
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

function clearStyles()
{
	$('input.submit').removeClass('alga algb algc algd orig bcrypt1');
	$('span#password_res').removeClass('alga algb algc algd orig bcrypt1');
	$('span#sitename').removeClass('alga algb algc algd orig bcrypt1');
}

function setAlgo(algo)
{
	clearStyles();
	if (algo=='alga' || algo=='algb' || algo=='algc' || algo=='algd'){
		$('input.submit').addClass(algo);
		$('span#password_res').addClass(algo);
		$('span#sitename').addClass(algo);
	}
	$.cookie("algo",  algo, { expires:999 });
}
function changeAlgoSelectionTo(algo)
{
	if (algo=='alga' || algo=='algb' || algo=='algc' || algo=='algd'){
		$("select#a").find("option[value='"+algo+"']").attr("selected", "selected");
	}
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
