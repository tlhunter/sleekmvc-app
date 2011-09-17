<h1>All People (Manually Selected)</h1>
<h3><?=$query1?></h3>
<table>
<?php
while($person = $first_people_results->row()) {
    echo "<tr><td>{$person['id']}</td><td>{$person['name']}</td><td>{$person['state_id']}</td><td>{$person['career_id']}</td></tr>\n";
}
?>
</table>

<h1>Adding a new person</h1>
<h3><?=$query2?></h3>
<table>
<?php
while($person = $second_people_results->row()) {
    echo "<tr><td>{$person['id']}</td><td>{$person['name']}</td><td>{$person['state_id']}</td><td>{$person['career_id']}</td></tr>\n";
}
?>
</table>

<h1>Editing an existing person</h1>
<h3><?=$query3?></h3>
<table>
<?php
while($person = $third_people_results->row()) {
    echo "<tr><td>{$person['id']}</td><td>{$person['name']}</td><td>{$person['state_id']}</td><td>{$person['career_id']}</td></tr>\n";
}
?>
</table>


<h1>Deleting a person</h1>
<h3><?=$query4?></h3>
<table>
<?php
while($person = $fourth_people_results->row()) {
    echo "<tr><td>{$person['id']}</td><td>{$person['name']}</td><td>{$person['state_id']}</td><td>{$person['career_id']}</td></tr>\n";
}
?>
</table>
