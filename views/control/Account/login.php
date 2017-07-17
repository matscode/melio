<?php
	/**
	 *
	 * Description
	 *
	 * @package        Melio
	 * @category       Source
	 * @author         Michael Akanji <matscode@gmail.com>
	 * @date           2017-06-18
	 * @copyright (c)  2016 - 2017, TECRUM (http://www.tecrum.com)
	 *
	 */
?>

<div class="main padding-20">
	<div class="login margin-vertical-40">
		<div class="row">
			<div class="col-xs-offset-3 col-xs-offset-3 col-xs-6">
				<h1>
					<strong>
						Melio
					</strong>
					Login
				</h1>

				<?= $this->Notify->getMessage( 'error' ) ?>
				<?= $this->Notify->getMessage( 'success' ) ?>

				<form action="" class="form" method="post">

					<div class="form-group margin-vertical-20">
						<div class="input-group">
							<i class="input-group-addon ion-person"></i>
							<input type="text"
							       class="form-control"
							       name="username"
							       placeholder="Username"
							       value="<?= set_value( 'username' ) ?>">
						</div>
					</div>

					<div class="form-group margin-vertical-20">
						<div class="input-group">
							<i class="input-group-addon ion-android-lock"></i>
							<input type="password"
							       class="form-control"
							       name="password"
							       placeholder="Password">
						</div>
					</div>
					<!--Remember me Check box-->

					<!--Login Button-->
					<div class="from-group text-right">
						<button type="submit" class="btn btn-primary">Login</button>
					</div>

				</form>
			</div>
		</div>
	</div>

</div>