<?php

use yii\widgets\ActiveForm;
use yii\helpers;
use yii\helpers\Html;

$this->title = 'Tags';
?>

<h1><a href="?r=tag/create">Create tag</a></h1>
<h1><a href="?r=post/create">Create post</a></h1>
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
