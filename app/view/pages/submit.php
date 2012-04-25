<?php if ($code) { ?>
<div class='success'>
    <table border='0'>
        <tr>
            <td>http://<?=$server?><?=$base_url?>link/<?=$code?></td>
            <td>&nbsp;&nbsp;</td>
            <td>(Fast Redirect)</td>
        </tr>
        <tr>
            <td>http://<?=$server?><?=$base_url?>link/<?=$code?>?h</td>
            <td>&nbsp;&nbsp;</td>
            <td>(Hides Referrer ezlink.info)</td>
        </tr>
    </table>
</div>
<?php } else { ?>
<div class='error'>Please submit a valid URL</div>
<?php } ?>
<p><a href='/'>Convert another link</a></p>