<?php
session_start();
?>
<html>
    <head>
        <meta charset="UTF-8">
		  <link rel='stylesheet' type="text/css" href="styles/main.css">
        <script type="text/javascript">
        window.onload = function(){
            var sessUser = '<?php echo (isset($_SESSION['user'])) ?
($_SESSION['user']) : (null) ?>';
            document.getElementById('elemout').style.display = 'none'
            if (sessUser != null){
                document.getElementById('elemout').style.display = '';
            };
        };
        </script>
    </head>
<body  class="page">
  <nav class="container">
    <ul>
    <li><a href="index.php?action=feed&controller=home">Home</a></li>
    <!--<li><a href="index.php?action=login&controller=user">Login</a></li>-->
    <li><a id='elemout' href="index.php?action=logout&controller=user">Logout/Login</a></li>
    <li><a href="index.php?action=upload&controller=post">upload</a></li>
    <li><a href="index.php?action=showUsers&controller=user">Show</a></li>
    <li><a href="index.php?action=display&controller=post">Gallery</a></li>
</ul>
  </nav>
</body>
</html>
