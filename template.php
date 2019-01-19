<?php
session_start();
?>
<html>
    <head>
        <meta charset="UTF-8">
		  <link rel='stylesheet' type="text/css" href="styles/main.css">
        <script type="text/javascript">
        window.onload = function(){
            var sessUser = '<?php echo (isset($_SESSION['user']))?
($_SESSION['user']):(null)?>';
            document.getElementById('elemout').style.display = 'none'
            if (sessUser != null){
                document.getElementById('elemout').style.display = '';
            };
        };
        </script>
    </head>
<body  class="page">
<div class='container'>
  <nav class="navbar-navigation">
    <a href="index.php?action=feed&controller=home">Home</a>
    <a href="index.php?action=login&controller=user">Login</a>
    <a id='elemout' href="index.php?action=logout&controller=user">logout</a>
    <a href="index.php?action=upload&controller=post">upload</a>
    <a href="index.php?action=upload&controller=post">upload</a>
    <a href="index.php?action=showUsers&controller=user">Show</a>
    <a href="index.php?action=display&controller=post">Gallery</a>
  </nav>
    <a class="extra"><?php //echo $_SESSION['user']; ?></a>
</div>
</body>
</html>
