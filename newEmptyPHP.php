<html>
    <body>
        <form name="form01" method="POST" enctype="multipart/form-data" >
            <?php for($i=0 ;$i<4 ; $i++) { ?>
            <input typre="text" name="inputs[]" value="<?php echo $i; ?>"/>
            <?php }?>
            <input type="submit" name="submit" value="submit">
        </form>
    </body>
    
</html>

<?php
if(isset ($_POST["submit"])){
    
        header("Location: http://www.yourwebsite.com/user.php"); /* Redirect browser */
exit();

}

?>



