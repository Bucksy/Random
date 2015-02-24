<?php
//Tri nachina po koito sortirash array - using usort($tasks, 'cmp');

function cmp($a, $b) {
    $a = strtotime($a['created']); //strtotime() - tuka nui prevrushta niza v chasa 
    $b = strtotime($b['created']);

    if ($a == $b) {
        return 0;
    } else if ($a < $b) {
        return -1;
    } else {
        return 1;
    }
}


function sortTasks(&$tasks, $order){
    sort2($tasks, $order = 0);
}

//function sort1(&$tasks, $order){
//    $dates = array();
//    foreach ($tasks as $key => $task) {
//        $dates[$key] = $task['created'];
//    }
//    array_multisort(&$dates, $order == 0 ? SORT_ASC : SORT_DESC, SORT_STRING, $tasks);
//}

function sort2(&$tasks, $order){
    if ($order == 0) {
        uasort($tasks, function($a, $b){
            return strcmp($a['created'], $b['created']); // strcmp(a,b)  : 0, -1, 1
        });
    }else{
        uasort($tasks, function($a, $b){
            return strcmp($b['created'], $a['created']);
        });
}
}

//$arr = array(6,1,3,4);
//$arr = array(
//    'k1' => 2,
//    'k2' => 3,
//    'k3' => 4,
//);

//asort($arr); // Sortira gi  po stoinost, ni kluchovete vurvqt s tqh, ne se precakat
//masivite i obektite  - se predavat po refenrenciq tui kato sa tejki za kopirane , kakvoto mu davash kato argument otvunka napravo nego polzvame 
//Imame i ogranichen length  na URL- zavisi kakuv browser-a polzvash 

function toggle(){
    if(isset($_GET['order'])){
        //dali sushtestvuva n url- order, tui kato potrebitelq moje da pishe gluposti na mqstoot na order
//          var_dump($_GET['order']);//string
          return $_GET['order'] == 0 ? 1 : 0;
//          return (int)!$_GET['order'];, poneje ni vrushta kato bool(false) ili bool(true)
    }
    return 1; // zashtoto za purvi put kato vlizame imame order = 1 po default, no tui kato iskame da se smeni vseki put zatova slagame 1
}

//type casting
//$i = '0';
//$i = 'a';
//var_dump(settype($i, 'int')); //0
//var_dump($i);

//var_dump((int), '100'));//
//var_dump((char) 'a');



//Rabota s fail - suvkupnost ot baitove , stoqt na hard disk , chetat se ot tam , kogato gasim komputera ,dannite se zapazqt v hard diska
//a ot ram se itrivat 
//is_dir? is_file? 
//fopen() - opens file () or url ? - failovete se izvlchat kat potosi - kazvame na OS , pozvoli mi da chetem , otvarqm ot faila !
//fopen(filename, mode=read, write, override); - vrushta RESOURCE - vid promenliva ili ukazatel kum fail ( handler)  

//mode - r - otvarqne 
//kogato fopen nqkakuv faila, trqbva da slojim v edna promenliva klucha(handle) - i kogato izlizame ot fail , trqbva da go zatvorim

//fwrite () = fwrite() - vrushta kolko baita e zapisal
//file_put_contents($filename, FILE_APPEND);
//
//function fileDemo(){
////    $handler = fopen('data/data.txt', 'r');
////   // var_dump($handler);//bool(false) -ako ne e uspql da go otvori , ako uspee - resource(5) of type (stream);
////   //fwrite($handler, "bla bla bla\n");
////    $text = fread($handler, filesize('data/data.txt'));
////    echo $text;
////   fclose($handler);
//    //__FILE__
//    //__DIR__ 
//  
//    file_put_contents('data/data.txt',  "\n sfjsafjs \n ", FILE_APPEND);//vrushta na baitovete koito zapisvame, or FALSE      
////  $text = file_get_contents('data/data.txt', false, null, 5, 10); // ot-do i kolko da prochete 10 - 15 -tiq
//    $textArray = file('data/data.txt');
//   // echo $text;
//   echo '<pre>' . print_r($textArray, true) . '</pre>';
//}
//
//fileDemo();
//
// echo __FILE__.'<br/>';//C:\xampp\htdocs\todo\functions.php
// echo __DIR__.'<br/>';//C:\xampp\htdocs\todo
// echo basename(__FILE__).'<br/>';//functions.php
// echo basename(__DIR__).'<br/>';//todo
// 
// 
//Json - Prinos na danni - moje da go predadem ot php na java 

function json(){
//    $json =  json_encode(array(
//        'firstName' => 'Pesho',
//        'lastName' => 'Georgiev',  
//        'hobbies' => array('hobby1' => 'Sports', 'hobby2'=>'Drinking'),
//        'addresses' => array('Address1', 'Address2'),
//    ));
//    file_put_contents('data/data.txt', $json);
   
     
//    $arr = json_decode($json, true); //- kodirane v format masiv , printirame json kato masiv , true- za da ni vurne kat o MASIV , inache go vrushta kat masiv
//    echo '<pre>' . print_r($arr, true) . '</pre>';
       $text = file_get_contents('data/data.txt');
       echo '<pre>' . print_r($text, true) . '</pre>';
}


json(); //vrushta json (vlojen) obekt-{"firstName":"Pesho","lastName":"Georgiev","hobbies":{"hobby1":"Sports","hobby2":"Drinking"},"addresses":["Address1","Address2"]}


function json1(){
//    $json = json_encode(array(
//        'name' => 'Huyen',
//        'age' => '24',
//        'gender' => 'female',
//    ));
    
//    file_put_contents('data/data1.txt', $json);
    
//    $arr = json_decode($json, true);
    $text = file_get_contents('data/data1.txt');//json obekt
    echo '<pre>' . print_r($text, true) . '</pre>';
}

json1();

//Masiv -> fail - > json - > mysql
// polzvame json tui kato formata mu e po lesno za obrabotvane, otkolkoto da zapishem info v fail 
// trudno text - se obratbotva 
//shte napravim nqkolko funkcii koito mojem da obratbotvam tasks 
// dobri praktiki - ne e hubavo da se dublirat kod , zatova slagame dublikati v edin fail i polzvame na vsqkude 

//
//function jsonPutInFile($arr){
//   $json = json_encode($arr);
//   file_put_contents('data/tasks.json', $json);
//}
//
//function jsonGetFromFile($file){
//    $text = file_get_contents($file);
//    $arr = json_decode($text, true);
//    return $arr;
//}
//
//print_r(jsonGetFromFile('data/tasks.json'));
//jsonPutInFile($tasks);

//function listTasks() {
//    echo 'Tasks';//zarejdane na dannite
//}

//page = tasks , TAzi funckiq ,kogato q vikame - togava imame v body - tablicata 
//MVC- shablona na design, vs frameworks rabotqt s tozi shablon 
//CONTROLLER - processRequest();
//ListTasks () - Model
//View =  include "./$includeFile.php";//list.php;
