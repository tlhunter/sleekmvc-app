<p>The ezlink.info API is extremely easy to work with. All you need to do is request the following url using your language of choice and the page returns the newly generated URL.</p>
<p>This is very useful for programmatically turning a list of long or complex URLs into a list of short ones for your visitor's convenience.</p>
<pre>
Request: http://<?=$server?>/api/create?url=http://www.example.com
Returns: http://<?=$server?>/link/b
</pre>
<p>Here is an example in PHP for generating shorter URLs:</p>
<pre>
$longurl = "http://www.example.com/location.php?asdf=jkl";
$safeurl = urlencode($longurl);
$shorturl = file_get_contents("http://<?=$server?>/api/create?url=$safeurl");
echo $shorturl;
</pre>