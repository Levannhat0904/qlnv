<?php
session_start();
require "include/header.php";
//kết nối db
// require "database/connect-db.php";
// require "database/db_helper.php";
?>
<div id="warpper" class="nav-fixed">
    <?php
    require "include/navbar.php";
    ?>
    <!-- end nav  -->
    <div id="page-body" class="d-flex">
        <?php
        require "include/side-bar.php";
        ?>
        <div id="wp-content">
            <?php
            $view = isset($_GET['view']) ? $_GET['view'] : 'analysis-employee';
            require "views/{$view}.php";
            ?>
        </div>
    </div>
</div>
<?php
require "include/footer.php";