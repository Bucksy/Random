<?php

//VIEW - tasks = array(); or 
function init(){
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
writeTasks($tasks);
}

//init();

function listTasks(){ //return Tasks Array
 
   $connection = dbConnect(); //vrushta resource - obekt . znae kak da se svurje s mysql ili failova sistema
  
   $query = 'SELECT * FROM tasks';
   $result = mysql_query($query, $connection);//prashtame zaqvka kum mysql, vrushta resource
    if (!$result) {
        echo 'error';
    } else {
        echo 'ok';
    }
    
    while($task = mysql_fetch_assoc($result)){
       $tasks[] = $task;
    }
   
    mysql_close($connection);
    return $tasks;
}

function createTasks() {
   //vrushta resource - obekt . znae kak da se svurje s mysql ili failova sistema
   //we check if this a POst request
   if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
      return;
   }else{
       
        $connection = dbConnect();
        
//       $id = $_POST['id'];
//       $name = trim($_POST['name']);
//       $description = trim($_POST['description']);
//       $priority = (int)$_POST['priority'];
//       $createdDate = trim($_POST['created']);
//       $dueDate = trim($_POST['dueDate']);
       
       //Validation //TODO 
       //Dannite veche sa v bazata , taka nqmame nujda da izvikvame listTasks();
       
//       $sql = mysql_query('INSERT INTO tasks(name, description, priority, dueDate)
////                           VALUES("'.$name.'", "'.$description.'", '.$priority.',"'.$dueDate.'")',$connection);
//       
       $task = fetchPostData();
       $query = sprintf('INSERT INTO tasks(name, description, priority, dueDate)
                VALUES("%s", "%s", "%s", "%s")', 
                       $task['name'],$task['description'], $task['priority'], $task['dueDate']);
       
       if (!$query) {
           echo 'Error';
       }
       
       mysql_query($query, $connection);
       mysql_close($connection);
       
       redirectToDefaultPage();
   }
}

function dbConnect(){
    
     $connection =  mysql_connect('localhost', 'root', '') or die ('Error '); //vrushta resource - obekt . znae kak da se svurje s mysql ili failova sistema
     $db = mysql_select_db('todo', $connection) or die('Error in database'); //Select database
     return $connection;

}

function updateTasks() {

    if (empty($_GET['id'])) {
        $idGet = '';
    }
    
    $idGet = $_GET['id'];
    
    $connection = dbConnect();
    
    if($_SERVER['REQUEST_METHOD'] === 'GET') { //GET
       
        $selected = 'SELECT id, name, description, priority , created, dueDate FROM tasks WHERE id = ' . $idGet . '';
        $query = mysql_query($selected, $connection); //return id of query 
        
        $task = mysql_fetch_assoc($query);
        mysql_close($connection); // tuka trqbva zatvorim koda tui kato pri return nie izlizame ot funkciqta i ne vlizame v else if otdolu
        return $task;
        
    } else if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   
        $name = trim($_POST['name']);
        $description = trim($_POST['description']);
        $priority = (int) $_POST['priority'];
        $dueDate = trim($_POST['dueDate']);
        
        $sql = mysql_query('UPDATE tasks 
                            SET name = "' . $name . '", description = "' . $description . '", priority = ' . $priority . ', dueDate = "' . $dueDate . '"
                            WHERE id = %' . $idGet, $connection);
        if (!$sql) {
            echo 'Error';
        } else {
            mysql_close($connection);
            redirectToDefaultPage();
        }
//        $task = fetchPostData();
       
//        $sql = sprintf('UPDATE tasks SET name = "%s", description = "%s", priority = "%s", dueDate = "%s" 
//                       WHERE id = %s', $task['name'], $task['description'], $task['priority'], $task['dueDate'] );
//        
//        mysql_query($sql, $connection);
//        mysql_close($connection);
//        redirectToDefaultPage();
    }
}

function deleteTasks(){
    
    $connection = dbConnect();

    if (empty($_GET['id'])) {
        $_GET['id'] = '';
    }
    $idGet = $_GET['id'];

    $sql = mysql_query('DELETE FROM tasks WHERE id = ' . $idGet . '', $connection);
    mysql_close($connection);
    
    redirectToDefaultPage();
}

function writeTasks($tasks){
   $json = json_encode($tasks);//CONVERT array tasks INTO JSON and put it in the file
   file_put_contents('./data/tasks.json', $json);
}

function fetchPostData() { // VAlidation ? 
    return array(
            'id' => $_POST['id'], //TODO Generate sequent ID
            'name' => $_POST['name'],
            'description' => $_POST['description'],
            'priority' => $_POST['priority'],
            'created' => $_POST['created'],
            'dueDate' => $_POST['dueDate'],
        );
}

function redirectToDefaultPage(){
     header('Location: index.php?page=tasks&action=list');
     exit;
}

function toggle() {
    if (isset($_GET['order'])) {
        return $_GET['order'] == 0 ? 1 : 0;
//          return (int)!$_GET['order'];, poneje ni vrushta kato bool(false) ili bool(true)
    }
    return 1; 
}


//Sort all fields in array tasks
function sortAll(&$tasks, $order) {
    if (isset($_GET['field']) && isset($_GET['order'])){
        if ($order == 0) {
            uasort($tasks, function ($a, $b) {
               return strcmp($a[$_GET['field']] ,$b[$_GET['field']]);//0 - 1, 1 
                    });
        } else{
            uasort($tasks, function($a, $b) {
                        return strcmp($b[$_GET['field']] ,$a[$_GET['field']]);
                    });
        }
    }
}

//step over - ako e funkciq - izpulnqva se funkciq , step over - vliza na vseki red - F8
//continue - videli sme kakvoto ni trqbva, i prosto minavame natatuk

function proccessRequest(){
    if (isset($_GET['page'])) { //http://localhost/todo/functions.php?page=tasks
        $defaultAction = 'list';// 
        $page = $_GET['page']; // $page=tasks
        
        echo "Page: . $page<br/>" ;
        
        if (isset($_GET['action'])) { //http://localhost/todo/functions.php?page=tasks&action=list
            $action = $_GET['action']; // action = list
            //trqbva da zaredim dannite s listTask();
            echo "Action : $action";
            
           $function = $action. ucfirst($page);//list.Tasks() = function listTasks(); = $data = masiv s taskovete otgore
           echo '<br/>';
           echo "Function name: $function ()<br/>";
            
            $includeFile =  "$page/$action"; //tasks/list
            //include "./$includeFIle.php";
        }else{
            
             $function = $defaultAction . ucfirst($page);//listTasks
             echo "Function name:  $function()<br/>";
             $includeFile = "$page/$defaultAction"; // tasks / action = list , ako nqmame tasks a samo action - nqma da raboti, tui kato ne sme proverili za tozi sluchai
        }
       
        $data = $function();//listTasks(); - return array of tasks 
          
        echo "Include File: $includeFile.php<br/>";//Include File: tasks/list.php
        include "./$includeFile.php";//list.php;
    }
}


function getAllParams(){
    if(isset($_GET['action'])){
       return "page=".$_GET['page']. "&" ."action=". $_GET['action'];
    }
    return "page=".$_GET['page'];
}


//function mysqlTest(){
//    // Open a connection to a MySQL Server
//   $connection =  mysql_connect('localhost', 'root', '') or die('Error while connening to the database'); //vrushta resource - obekt . znae kak da se svurje s mysql ili failova sistema
//   //var_dump($connection);  
//   if (!$connection) {
//       echo 'Error while connecting to the database';
//       exit;
//   }else{
//       echo 'Success';
//   }
//   
//   //Select database - resource
//   $db = mysql_select_db('todo', $connection);
//   if (!$db) {
//       echo 'Failed to select to DB';
//       exit;
//   }else{
//       echo 'Success';
//   }
//   //Query
//   
//   $query = 'SELECT * FROM tasks';
//   $result = mysql_query($query, $connection);//prashtame zaqvka kum mysql, vrushta resource
//    if (!$result) {
//        echo 'error';
//    } else {
//        echo 'ok';
//    }
//    
//   echo 'Number of rows : ' . mysql_num_rows($result), '<br/>';//number of rows
//   echo 'Number of fields : ' .  mysql_num_fields($result);//number of columns
//   
//   while ($row = mysql_fetch_assoc($result)) {
//       echo '<pre>' . print_r($row['name'], true) . '</pre>';
//   }
//   
////   print_r(mysql_fetch_array($result));
////    var_dump(mysql_fetch_array($result));
////    $m = mysql_result($result, 3, 1);
////    echo $m;
//   
//    mysql_close($connection);
//}
//
//mysqlTest();
