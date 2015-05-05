<!DOCTYPE html>
<html>
<head>
	<title>Certificate Authority</title>
	<?php foreach ($stylesheets as $row) {
		echo css($row);
	} ?>
	
	<!-- jQuery -->
	<?php foreach ($javascripts as $row) {
		echo js($row);
	} ?>
</head>
<body>
	<div class="container">
	    <div class="container-admin">
	    <?php
	    echo $content;
	    ?>
	    </div>
  </div>  
</body>
</html>