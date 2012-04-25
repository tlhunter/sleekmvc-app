<html>
<head>
<title><?=$title?></title>
<link rel="stylesheet" type="text/css" href="<?=$base_url?>styles/style.css" />
</head>
<body>
<div id="container">
	<div id="top">
		<div id="lefty"><a href="<?=$base_url?>">Home</a> | <a href="<?=$base_url?>statistics">Statistics</a> | <a href="<?=$base_url?>api">API</a></div>
		<div id="righty"><em><small>Totals: <strong><?=$count_urls?></strong> Pages / <strong><?=$count_clicks?></strong> Clicks</small></em></div>
	</div>
	<div id="ie-wrapper"><h1 id="header"><span>ezLink.info</span></h1></div>
	<div id="content">
<?=$content?>
	</div>
	<div id="footer">SleekMVC Sample App by <a href="http://thomashunter.name" target="_blank">Thomas Hunter</a>.</div>
</div>
</body>
</html>