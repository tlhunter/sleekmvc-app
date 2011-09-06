<h1>Here's a list of people!</h1>

<?php
if ($people) {
?>
<table>
<tr><th>Name</th><th>Profession</th></tr>
<?php
while ($person = $people->object()) {
?>
    <tr><td><?=$person->name?></td><td><?=$person->career?></td></tr>
<?php
}
?>
</table>
<?php
}
?>
Wooties!
