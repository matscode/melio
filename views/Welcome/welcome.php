<?php
	/**
	 *
	 * Description
	 *
	 * @package        Melio
	 * @category
	 * @author         Michael Akanji <matscode@gmail.com>
	 * @date           2017-06-14
	 * @copyright (c)  2016 - 2017, TECRUM (http://www.tecrum.com)
	 *
	 */
	defined( 'BASEPATH' ) OR exit( 'No direct script access allowed' );
?>

<div class="container">

	<div class="row">
		<div class="main col-xs-offset-2 col-xs-8 col-xs-offset-2">
			<div class="profile">
				<img src="<?= $this->UserContent->image( $user->display_picture ) ?>" alt="Image" class="img-circle img-thumbnail" />
				<div class="info">
					<h2 class="name">
						<?= $user->first_name ?> <?= $user->other_name ?> <?= $user->last_name ?>
					</h2>
					<h4 class="career">
						<?= $user->profession ?>
					</h4>
					<p class="nationality text-muted"><?= $user->country ?></p>

					<div class="contact">
						<?=
							safe_mailto( $user->email, 'Get in Touch',
								[
									'class' => 'btn btn-info margin-top-10'
								] )
						?>
					</div>
				</div>
			</div>
		</div>
	</div>

</div>
