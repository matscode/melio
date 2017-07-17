<?php
	defined( 'BASEPATH' ) OR exit( 'No direct script access allowed' );
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Melio <?= $title ? ' - ' . $title : '' ?></title>

		<!-- MetaData for Project -->
		<meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible"
		      content="IE=edge, chrome=1" />
		<meta name="viewport"
		      content="width=device-width, initial-scale=1.0, maximum-scale=1" />

		<!-- Dynamically generated meta element -->
		<?= $meta_element ?>
		<base href="<?= base_url() ?>">

		<!-- Icon -->
		<!--
		<link type="image/x-icon"
		      href="favicon.ico"
		      rel="icon" />
		-->

		<!-- Style Sheet 'N' JS - Frameworks -->
		<?= // stylesheets
			cssAsset( [
				'bootstrap',
				'font-awesome.min',
				'ionicons.min',
				//'angular-csp',
				'control'
			] )
		?>

		<?=
			jsAsset( [
				'jquery-1.11.3.min',
				'bootstrap.min',
				'main'
			], true )
		?>

	</head>
	<body>
		<div class="container">
			<div class="row">
				<div class="col-xs-offset-1 col-xs-10 col-xs-offset-1 col-sm-offset-2 col-sm-offset-2 col-sm-8 col-md-offset-2 col-md-offset-2 col-md-8">
					<!-- Dynamic Layout Content Starts Here -->
					<?= $content ?>
					<!-- Dynamic Layout Content Ends Here -->
				</div>
			</div>
			<footer class="footer">
				<span class="text-muted">Powered by</span> <span class="text-white">Melio</span>
			</footer> <!-- footer ends here -->
		</div>
	</body>

</html>

