<html>
<head>
<title><?=$title?></title>
<link rel="stylesheet" type="text/css" href="/styles/style.css" />
</head>
<body>
<div id="container">
	<div id="top">
		<div id="lefty"><a href="/">Home</a> | <a href="/statistics">Statistics</a> | <a href="/api">API</a></div>
		<div id="righty"><em><small>Totals: <strong><?=$count_urls?></strong> Pages / <strong><?=$count_clicks?></strong> Clicks</small></em></div>
	</div>
	<div id="ie-wrapper"><h1 id="header"><span>ezLink.info</span></h1></div>
	<div id="content">
<?=$content?>
	</div>
	<div id="footer">Website copyright 2008 - <?=date('Y')?> <a href="http://www.renownedmedia.com" target="_blank">Renowned Media</a>.</div>
</div>
<script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
</script>
<script type="text/javascript">
try {
var pageTracker = _gat._getTracker("UA-1577519-7");
pageTracker._trackPageview();
} catch(err) {}</script>
</body>
</html>