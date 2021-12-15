
<div class="float-left">
    <p>
    <a href="index.php?task=report">All STUDENTS</a>  |
    <a href="index.php?task=add">ADD NEW STUDENT</a>  |
    <a href="index.php?task=seed">SEED</a>
 
    </p>
   
</div>
<div class="float-right">
<?php
  $_SESSION['loggedin']=null;
  if(!$_SESSION['loggedin']):
    ?>
    <a  href="auth.php">Log in</a>
    <?php
  else:
    ?>
    <a href="auth.php?logout=true">Log out</a> 
    <?php
    endif;
    ?>
</div>

   
