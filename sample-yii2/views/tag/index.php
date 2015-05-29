<?php

use yii\widgets\ActiveForm;
use yii\helpers;
?>
<a href="?r=tag/create">Create tag</a>
<br/>
<table>
    <tr>
        <td><?php ?></td>
    </tr>
    <?php
    foreach ($tags as $tag) {
        echo '<tr>'
        . '<td>' . $tag['tag'] . '</td>'
        . '</tr>';
    }
    ?>
</table>
