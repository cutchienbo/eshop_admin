<!DOCTYPE html>
<html lang="en">

<head>

	<title>
		<?php echo $title ?>
	</title>

	<?php

	require_once(LIB_PATH . 'metadata.php');
	require_once(LIB_PATH . 'icon.php');
	require_once(LIB_PATH . 'css.php');

	?>

</head>

<body class="">

	<?php
	// $this -> render('block/preload', $data);
	if (!isset($have_layout)) {
		$this->render('block/sidebar', $data);
		$this->render('block/header', $data);
	}
	$this->render($content, $data);
	require_once(LIB_PATH . 'script.php');
	?>

</body>

</html>