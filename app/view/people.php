<h1>Here's a list of people!</h1>

<?php
if ($people) {
?>
<table>
<tr><th>Name</th><th>Profession</th></tr>
<?php
foreach ($people as $person) {
?>
    <tr><td><?=$person['name']?></td><td><?=$person['career_id']?></td></tr>
<?php
}
?>
</table>
<?php
}
?>
Wooties!
