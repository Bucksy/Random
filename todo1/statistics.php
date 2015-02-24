<?php
$title = 'Statistics';
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
                <? //=date('Y-m-d H:i:s', time() + 3600); ?>
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

            
        </div>
    </div>
<?php include './inc/footer.php'; ?>
