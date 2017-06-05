<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device=width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title><?php echo $page_params['title']; ?></title>
	<link rel="stylesheet" type="text/css" href="/assets/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="/assets/css/main.css">
</head>
<body>

	<div class="container">
		<?php
			if ( isset($page_params['page']) ) {
				require_once(HOME_PATH.'/views/'.$page_params['page']);
			}
		?>
	</div>

	<script type="text/javascript" src="/assets/js/jquery-3.2.1.min.js"></script>
	<script type="text/javascript" src="/assets/js/tether.min.js"></script>
	<script type="text/javascript" src="/assets/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="/assets/js/main.js"></script>
</body>
</html>