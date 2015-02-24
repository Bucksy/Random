<?php
//Copy of Index.php - original 
$title = 'Tasks List';
include './data.php';
include './functions.php';
include './inc/header.php';
?>
<body class="home" onload="startTime();">
        <div class="container">
            <div class="top">
                <div class="logo">
                    <a href="index.php">
                        <img class="logo1"src="img/logo.jpg"></img>
                    </a>
                </div>
                <div class="date" id="txt">
                <?//=date('Y-m-d H:i:s', time() + 3600); ?>
                </div>
                <div class="menu">
                    <ul>
                        <?php
                        foreach ($menu as $value) {
                            echo '<li><a href="' . $value['link'] . '">' . $value['name'] . '</a></li>';
                        }
                        ?>
                    </ul> 
                    <div class="greeting">
                        <?= 'Hello, ' . $username . '!';
                        ?>
                    </div>
                </div>
            </div>
            <div class="body">

                <form action="index.php" method="POST"><br/>
                    Search: <input type="text" name="search"/>
                    <input type="submit" name="submit" value="Go!"/>
                </form>

               <?php
                if (!isset($_POST['search'])) {
                    $_POST['search'] = '';
                }
                echo '<pre>' . print_r($_POST['search'], true) . '</pre>';
                ?>
                <!--Tasks-->
                <table border="1">
<!--                    <tr>
                    <?php
                    foreach ($tds as $td) {
                        echo '<td>' . $td . '</td>';
                    }
                    ?>
                     </tr> -->                    
                    <tr>
                        <td><a href="http://localhost/todo/index.php?order=<?php echo toggle(); ?>&field=id">ID</a></td>
                        <td><a href="http://localhost/todo/index.php?order=<?php echo toggle(); ?>&field=name">Name</a></td>
                        <td><a href="http://localhost/todo/index.php?order=<?php echo toggle(); ?>&field=description">Description</a></td>
                        <td><a href="http://localhost/todo/index.php?order=<?php echo toggle(); ?>&field=priority">Priority</a></td>
                        <td><a href="http://localhost/todo/index.php?order=<?php echo toggle(); ?>&field=created">Created</a></td>
                        <td><a href="http://localhost/todo/index.php?order=<?php echo toggle(); ?>&field=dueDate">Due Date</a></td>
                    </tr>

                    <?php
//                   usort($tasks, 'cmp');
//                   sort2($tasks,  isset($_GET['order']) ? $_GET['order'] : 0);//created

                    sortAll($tasks, isset($_GET['order']) ? $_GET['order'] : 0);
                    
//                    print_r(jsonGetFromFile('data/tasks.json'));
//                    jsonPutInFile($tasks);
                    foreach ($tasks as $task) {
                        $sum = 0;
                        echo '<tr>
                              <td>' . $task['id'] . '</td>
                              <td>' . $task['name'] . '</td>
                              <td>' . $task['description'] . '</td>
                              <td>' . $task['priority'] . '</td>
                              <td>' . $task['created'] . '</td>
                              <td>' . $task['dueDate'] . '</td>
                           </tr>';
                    }
                    ?>

                </table>
            </div>
        </div>

<?php include './inc/footer.php'; ?>

