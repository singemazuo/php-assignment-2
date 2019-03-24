<div id="footer">
    <?php
        if (isset($_SESSION["user_type"])){
            if ($_SESSION["user_type"] == 'Admin'){
                include 'includes/admin_footer.php';
            }else if($_SESSION["user_type"] == 'User'){
                include 'includes/user_footer.php';
            }
        }else{
            include 'includes/user_footer.php';
        }
    ?>
</div>

