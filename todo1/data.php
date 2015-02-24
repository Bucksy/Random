<?php

$timeFormat = 'Y-m-d: H:i:s';
/*
Masiv koito shte ni durji menuto, i shte go vkluchim v html index.php i shte go vkarvame

 * Array
(
    [0] => Array
        (
            [name] => Home
            [link] => index.php
        )

    [1] => Array
        (
            [name] => Tasks
            [link] => tasks.php
        )

    [2] => Array
        (
            [name] => Finished Tasks
            [link] => finished_tasks.php
        )

) 
 */

$menu = array(
    0=>array(
     'name' => 'Home',
     'link' => 'index.php',
    ),
    1=>array(
     'name' => 'Tasks',
     'link' => 'index.php?page=tasks&action=list',
    ),
    2=>array(
     'name'=>'Finished Tasks',
     'link' => 'finished_tasks.php',
    ),
    3=>array(
     'name'=>'Statisctics',
     'link' => 'statistics.php',
    ),
);

//echo '<pre>' . print_r($menu, true) . '</pre>';

//For - obhojdane na masiv s for 
//for($i = 0; $i < count($menu); $i++){
//   echo $menu[$i]['name'].' '. $menu[$i]['link'].'<br/>'; 
// 
//}

//foreach-obhojdane na masiv s foreach 
//foreach ($menu as $value) {
//    echo $value['name'] . ' '. $value['link'].'<br/>'; 
//}

//Ctr+Shift + C
//CTR+SHIT+ DOwn arrow

$tds = array('ID','Name', 'Description','Priority','Created', 'Due Date');

$tasks = array(
    0=>array(
        'id'=>'1',
        'name'=> 'Task 1',
        'description'=> 'Description for Task 1',
        'priority'=>'High',
        'created'=> '2015-01-20 17:00',
        'dueDate'=> '2015-01-20 05:00' // date($timeFormat, mktime(22, 0, 0, 1, 20, 2015)),// date($timeFormat , strtotime(+1 day));
    ),
     1=>array(
        'id'=>'2',
        'name'=> 'Task 2',
        'description'=> 'Description for Task 2',
        'priority'=>'Low',
        'created'=>'2015-01-19 12:00',
        'dueDate'=>'2015-01-20 09:00'
    ),
     2=>array(
        'id'=>'3',
        'name'=> 'Task 3',
        'description'=> 'Description for Task 3',
        'priority'=>'Medium',
        'created'=>'2015-01-15 12:07',
        'dueDate'=>'2015-01-20 15:00'
    ),
);

$username = 'User';