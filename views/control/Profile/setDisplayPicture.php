<?php
	/**
	 *
	 * Description
	 *
	 * @package        Melio
	 * @category       Source
	 * @author         Michael Akanji <matscode@gmail.com>
	 * @date           2017-07-15
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
				Set
			</strong>
			Display Picture
		</h4>

		<div class="row">
			<div class="col-xs-offset-2 col-xs-offset-2 col-xs-8">


				<div class="profile">
					<img src="<?= $this->UserContent->image( $user->display_picture ) ?>" alt="Image" class="img-circle img-thumbnail" />
				</div>

				<div class="panel panel-success panel-body margin-vertical-20">

					<?= $this->Notify->getMessage( 'error' ) ?>
					<?= $this->Notify->getMessage( 'success' ) ?>

					<form action="" method="post" enctype="multipart/form-data">

						<div class="small text-success">
							<i class="ion-android-laptop fa-fw"></i> From Device
						</div>

						<div class="form-group margin-vertical-10" style="overflow: hidden;">
							<label for="setDisplayPicture" class="input-label">Choose</label>
							<input type="file"
							       class=""
							       name="display_picture"
							       id="setDisplayPicture">

							<div class="small bg-info padding-5 margin-5">
								<strong>Recommendations</strong>
								<ul>
									<li>Select picture less than <strong>2MB</strong></li>
									<li>Square Crop your picture before uploading</li>
									<li>Select an upright picture</li>
								</ul>
							</div>

						</div>

						<!--Remember me Check box-->

						<!--Login Button-->
						<div class="from-group ">
							<button type="submit" class="btn btn-primary btn-block">Set Picture</button>
						</div>

					</form>
				</div>
			</div>
		</div>
	</div>

</div>

