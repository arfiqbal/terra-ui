<!DOCTYPE html>
<html lang="en">
<head>
    <title>Web Console</title>
    <!-- <link rel="stylesheet" href="css.css" type="text/css" media="screen"/> -->
    <!-- <link rel="stylesheet" href="{{ asset('css/css.css') }}"> -->
</head>
<body>
<pre id="log"></pre>
<div id="toolbar">
    <ul id="status">
        <li><span id="socketStatus">Type your comand:</span></li>
    </ul>
    <input tabindex="1" type="text" id="entry"/>
    <button id="test">Test</button>

    <div id="console"></div>
</div>



<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8/jquery.min.js"></script>

<script type="text/javascript">
           document.getElementById('test').onclick = function() {
             xhr = new XMLHttpRequest();
             xhr.open("GET", "/flush", true);
             xhr.onprogress = function(e) {
               //alert(e.currentTarget.responseText);
                console.log(e.currentTarget.responseText)

             }
             xhr.onreadystatechange = function() {
               if (xhr.readyState == 4) {
                 console.log("Complete = " + xhr.responseText);
               }
             }
             xhr.send();
           };
         </script>
</body>
</html>