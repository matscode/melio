<?php
	defined( 'BASEPATH' ) OR exit( 'No direct script access allowed' );
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Michael Akanji <?= $title ? ' - ' . $title : '' ?></title>

		<!-- MetaData for Project -->
		<meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible"
		      content="IE=edge, chrome=1" />
		<meta name="viewport"
		      content="width=device-width, initial-scale=1.0, maximum-scale=1" />

		<meta name="description"
		      content="Contact Me for Web Development" />
		<meta name="keywords"
		      content="ContactMe, Contact Me, Web Developer" />
		<meta name="author"
		      content="Michael Akanji" />

		<!-- Dynamically generated meta element -->
		<?= $meta_element ?>
		<base href="<?= base_url() ?>">
		<?php
			$base_url = str_replace( '//', '', base_url() ); // without its prefix for the sake of OG
		?>

		<meta property="og:title" content="Michael Akanji" />
		<meta property="og:type" content="profile" />
		<meta property="og:url" content="<?= prep_url( $base_url ) ?>" />
		<meta property="og:image" content="<?= prep_url( $base_url . ( 'usercontent/images/mp-processed.jpg' ) ) ?>" />

		<!-- Icon -->
		<!--
		<link type="image/x-icon"
		      href="favicon.ico"
		      rel="icon" />
		-->

		<!-- Style Sheet 'N' JS - Frameworks -->
		<?= // stylesheets
			cssAsset( [
				'font-awesome.min',
				//'angular-csp',
				'bootstrap',
				'melio',
				'melio-animation'
			] )
		?>
		<?=
			jsAsset( [
				'jquery-3.1.1.min',
				'bootstrap.min',
				'main'
			] )
		?>

	</head>
	<body>

		<!-- Dynamic Layout Content Starts Here -->
		<?= $content ?>
		<!-- Dynamic Layout Content Ends Here -->

		<footer class="footer">
			<span class="text-muted">Powered by</span> <span class="text-white">Melio</span>
		</footer> <!-- footer ends here -->

	</body>

</html>

