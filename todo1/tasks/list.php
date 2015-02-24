 <?php ?>
<a href="index.php?page=tasks&action=create">Create</a>

<table border="1">
<!--                    <tr>
                    <?php
                    foreach ($tds as $td) {
                        echo '<td>' . $td . '</td>';
                    }
                    ?>
                  </tr>     -->                    
                    <tr>
                        <td><a href="index.php?<?php echo getAllParams(); ?>&order=<?php echo toggle(); ?>&field=id">ID</a></td>
                        <td><a href="index.php?<?php echo getAllParams(); ?>&order=<?php echo toggle(); ?>&field=name">Name</a></td>
                        <td><a href="index.php?<?php echo getAllParams(); ?>&order=<?php echo toggle(); ?>&field=description">Description</a></td>
                        <td><a href="index.php?<?php echo getAllParams(); ?>&order=<?php echo toggle(); ?>&field=priority">Priority</a></td>
                        <td><a href="index.php?<?php echo getAllParams(); ?>&order=<?php echo toggle(); ?>&field=created">Created</a></td>
                        <td><a href="index.php?<?php echo getAllParams(); ?>&order=<?php echo toggle(); ?>&field=dueDate">Due Date</a></td>
                        <td colspan="2">Actions</td>
                    </tr>

                    <?php
//                   usort($tasks, 'cmp');
//                   sort2($tasks,  isset($_GET['order']) ? $_GET['order'] : 0);//created
                    //sortAll($tasks, isset($_GET['order']) ? $_GET['order'] : 0);
                    
                    sortAll($data, isset($_GET['order']) ? $_GET['order'] : 0);
                    
//                    print_r(jsonGetFromFile('data/tasks.json'));
//                    jsonPutInFile($tasks);
                    //table 
                    foreach ($data as $task) {
                        echo '<tr>
                              <td>' . $task['id'] . '</td>
                              <td>' . $task['name'] . '</td>
                              <td>' . $task['description'] . '</td>
                              <td>' . $task['priority'] . '</td>
                              <td>' . $task['created'] . '</td>
                              <td>' . $task['dueDate'] . '</td>
                              <td><a href="index.php?page=tasks&action=update&id='. $task['id'] .'">Update</a></td>
                              <td><a href="index.php?page=tasks&action=delete&id='. $task['id'] .'">Delete</td>
                           </tr>';
                    }
                    ?>

                </table>