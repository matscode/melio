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
	defined( 'BASEPATH' ) OR exit( 'No direct script access allowed' );
?>

<div class="main padding-20">
	<div class="">
		<!--Navigation Menu-->
		<?= $navigationMenu ?>

		<h4 class="page-header">
			<strong>
				Profile
			</strong>
			Edit
		</h4>

		<div class="row">
			<div class="col-xs-offset-2 col-xs-offset-2 col-xs-8">

				<div class="text-right margin-bottom-10">
					<?= anchor('control/Profile/setDisplayPicture', 'set display picture <i class="fa fa-photo fa-fw"></i> ', ['class' => 'btn btn-default']) ?>
				</div>

				<?= $this->Notify->getMessage( 'error' ) ?>
				<?= $this->Notify->getMessage( 'success' ) ?>

				<form action="" method="post">

					<div class="row">

						<div class="col-sm-4">
							<div class="form-group margin-vertical-20">
								<label for="firstName" class="input-label">First Name</label>
								<input type="text"
								       class="form-control"
								       name="first_name"
								       placeholder="First name"
								       value="<?= set_value( 'first_name', $user->first_name ) ?>">
							</div>
						</div>

						<div class="col-sm-4">
							<div class="form-group margin-vertical-20">
								<label for="lastName" class="input-label">Surname</label>
								<input type="text"
								       class="form-control"
								       name="last_name"
								       placeholder="Surname"
								       value="<?= set_value( 'last_name', $user->last_name ) ?>">
							</div>
						</div>

						<div class="col-sm-4">
							<div class="form-group margin-vertical-20">
								<label for="otherName" class="input-label">Other Name</label>
								<input type="text"
								       class="form-control"
								       name="other_name"
								       placeholder="Other name"
								       value="<?= set_value( 'other_name', $user->other_name ) ?>">
							</div>
						</div>

					</div>

					<div class="small text-success">
						<i class="fa fa-briefcase fa-fw"></i> Work
					</div>

					<div class="form-group margin-vertical-20">
						<label for="profession" class="input-label">Profession</label>
						<input type="text"
						       class="form-control"
						       name="profession"
						       placeholder="e.g Full-stack Web Developer, Photographer"
						       value="<?= set_value( 'profession', $user->profession ) ?>">
					</div>

					<div class="small text-primary">
						<i class="fa fa-send fa-fw"></i> Contact
					</div>

					<div class="row">

						<div class="col-sm-6">
							<div class="form-group margin-vertical-20">
								<label for="email" class="input-label">Email</label>
								<input type="text"
								       class="form-control"
								       name="email"
								       placeholder="user@example.com"
								       value="<?= set_value( 'email', $user->email ) ?>">
							</div>
						</div>

						<div class="col-sm-6">
							<div class="form-group margin-vertical-20">
								<label for="mobileNumber" class="input-label">
									<small>smart</small>
									Mobile Number</label>
								<input type="text"
								       class="form-control"
								       name="mobile_number"
								       placeholder="08186074929"
								       value="<?= set_value( 'mobile_number', $user->mobile_number ) ?>">
							</div>
						</div>

					</div>

					<div class="small text-warning">
						<i class="fa fa-map-pin fa-fw"></i> Location
					</div>

					<div class="form-group margin-vertical-20">
						<label for="country" class="input-label">Country</label>
						<input type="text"
						       class="form-control"
						       name="country"
						       placeholder="e.g Nigeria"
						       value="<?= set_value( 'country', $user->country ) ?>">
					</div>

					<!--Remember me Check box-->

					<!--Login Button-->
					<div class="from-group text-right">
						<button type="submit" class="btn btn-primary">Update Profile</button>
					</div>

				</form>

				<div class="margin-top-20">
					<div class="small text-danger">
						<i class="fa fa-lock fa-fw"></i> Security
					</div>
					<p class="help-block">Click on the button below if you are willing to change your password</p>
					<div class="">
						<?= anchor( 'control/Profile/password', 'Change Password', [ 'class' => 'btn btn-danger' ] ) ?>
					</div>
				</div>

			</div>
		</div>
	</div>

</div>