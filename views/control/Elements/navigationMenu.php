<?php
	/**
	 *
	 * Description
	 *
	 * @package        Melio
	 * @category       Source
	 * @author         Michael Akanji <matscode@gmail.com>
	 * @date           2017-07-09
	 * @copyright (c)  2016 - 2017, TECRUM (http://www.tecrum.com)
	 *
	 */

?>
<nav class="main-navigation navbar">

	<div class="navbar-header">
		<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#mainNavigation" aria-expanded="false">
			<i class="fa fa-bars fa-fw icon-bar"></i>
		</button>
		<a href="" class="navbar-brand">
			<img src="assets/images/melio-logo-48.png" alt="Melio" class="img-thumbnail">
		</a>
	</div>

	<div class="collapse navbar-collapse" id="mainNavigation">
		<ul class="nav navbar-nav navbar-right">
			<li><?= anchor( 'control', 'Home' ) ?></li>
			<li><?= anchor( 'control/Profile/edit', 'Profile' ) ?></li>
			<li class="dropdown">
				<?= anchor( '#', 'Settings <i class="caret"></i>', [
					'class'         => 'dropdown-toggle',
					'data-toggle'   => 'dropdown',
					'role'          => 'button',
					'aria-haspopup' => 'true',
					'aria-expanded' => 'false'
				] ) ?>
				<ul class="dropdown-menu">
					<li><?= anchor( 'control/#', 'Welcome' ) ?></li>
					<li role="separator" class="divider"></li>
					<li><?= anchor( 'control/#', 'Meta Data' ) ?></li>
				</ul>
			</li>
			<li></li>
			<li><?= anchor( 'control/Account/logout', 'Logout' ) ?></li>
		</ul>
	</div>

</nav>