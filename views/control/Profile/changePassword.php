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

<div class="main padding-20">
	<div class="">
		<!--Navigation Menu-->
		<?= $navigationMenu ?>

		<h4 class="page-header">
			<strong>
				Change
			</strong>
			Password
		</h4>

		<div class="row">
			<div class="col-xs-offset-2 col-xs-offset-2 col-xs-8">

				<?= $this->Notify->getMessage( 'error' ) ?>
				<?= $this->Notify->getMessage( 'success' ) ?>

				<form action="" method="post">  

					<div class="small text-warning">
						<i class="ion-locked fa-fw"></i> From
					</div>

					<div class="form-group margin-vertical-20">
						<label for="oldPassword" class="input-label">Old Password</label>
						<input type="password"
						       class="form-control"
						       name="old_password"
						       placeholder="D2;:df$54"
						       value="">
					</div>

					<div class="small text-success">
						<i class="ion-locked fa-fw"></i> To
					</div>

					<div class="form-group margin-vertical-20">
						<label for="newPassword" class="input-label">New Password</label>
						<input type="password"
						       class="form-control"
						       name="new_password"
						       placeholder="ifGt$545$2"
						       value="<?= set_value( 'new_password' ) ?>">
					</div>

					<div class="form-group margin-vertical-20">
						<label for="cnewPassword" class="input-label">
							<small>Confirm</small>
							New Password</label>
						<input type="password"
						       class="form-control"
						       name="cnew_password"
						       placeholder="ifGt$545$2"
						       value="">
					</div>

					<!--Remember me Check box-->

					<!--Login Button-->
					<div class="from-group text-right">
						<button type="submit" class="btn btn-primary">Change Password</button>
					</div>

				</form>

			</div>
		</div>
	</div>

</div>
