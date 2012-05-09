<?php
/*	Copyright 2011, Sean W. Mahan <swm@intendedeffect.com>
	
    This file is part of C-Cr.it.

    C-Cr.it is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    C-Cr.it is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with C-Cr.it.  If not, see <http://www.gnu.org/licenses/>.

*/

header('Content-type: text/javascript');

$rand_id = rand(0, 99999);

?>

    var d=document,
        l=d.location,
        e=window.getSelection,
        k=d.getSelection,
        x=d.selection,
        s=String(e? e(): (k)? k(): (x?x.createRange().text: '')),
        e=encodeURIComponent,
        z=d.createElement('scr'+'ipt');
    
    var i=document.createElement('iframe');
	i.setAttribute('name', 'c-c<?php echo $rand_id?>');
    i.setAttribute('id', 'c-c<?php echo $rand_id?>');

    var c = 'left:10px;top:10px;width:168px;';
    c += ' position: fixed;';

    var ce, container = document.body;
    i.setAttribute('style', 'z-index: 2147483647;'+c+'width:268px;height: 150px; border: 3px solid #aaa;');
    container.appendChild(i);
    i.onLoad=function(){ alert('Loaded!') };


    window.frames['c-c<?php echo $rand_id;?>'].document.write('<html>'+
            '<scr'+'ipt src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js" type="text/javascript"></sc'+'ript>'+
         "<scr"+"ipt>jQuery.noConflict();</scr"+"ipt>\n"+
         '<scr'+'ipt src="http://c-cr.it/js/ZeroClipboard.js" type="text/javascript"></sc'+'ript>'+
         '<scr'+'ipt src="http://c-cr.it/js/sha256.js" type="text/javascript"></sc'+'ript>'+
         '<sc'+'ript>'+
         "function myloadhandler(){\n"+
			"//alert('ready!');\n" +
		"}"+
        'function ccritHash (){'+
        "\n"+
        'shash = Sha256.hash(jQuery("input#s").val());'+
        "\n"+
        'phash = Sha256.hash(jQuery("input#p").val());'+
        "\n"+
        'response = Sha256.hash(shash+phash).substr(0,12);'+
        "\n"+
        "alert(response);\n"+
        'jQuery("p.result").text(response);'+
        "\n"+
        'clip.setText(response);' +
		'}'+
		"\n"+
        "</scr"+"ipt>\n"+
			'<body style="color: #555; background-color: #fff; text-align: center; margin: 0px;">' +
            '<div id="pwd_form" style="text-align: center; width: 80%; padding-bottom: 1px; margin: 0 auto 5px auto; font-size: 13px; border-bottom: 1px solid #ccc; color: #333;">C-Cr.it!</div>' +
        '<input type="text" name="s" id="s" value="'+(document.location.hostname.substr(0,4)=='www.' ? document.location.hostname.substr(4) : document.location.hostname)+'"/>' +
        '<input type="password" name="p" id="p" value="" placeholder="Your Pass Key"/><br>' +
        '<a href="#" id="copy-password" onclick="ccritHash" style="display:block;">Keep it C-Cr.it!</a>'+
        "<p class='result'></p>"+
        '<scr'+'ipt>'+
        "ZeroClipboard.setMoviePath( 'http://c-cr.it/js/ZeroClipboard.swf' );\n"+
         'var clip = new ZeroClipboard.Client();'+
         "\n"+
         "clip.addEventListener( 'onLoad', myloadhandler );\n"+
         "clip.glue( 'copy-password' );\n"+
         "clip.addEventListener('onMouseDown',ccritHash)"+
		'</scr'+'ipt>'+
		"</body>\n</html>");
