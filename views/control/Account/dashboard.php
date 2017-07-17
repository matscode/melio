<?php
	/**
	 *
	 * Description
	 *
	 * @package        Melio
	 * @category       Source
	 * @author         Michael Akanji <matscode@gmail.com>
	 * @date           2017-07-07
	 * @copyright (c)  2016 - 2017, TECRUM (http://www.tecrum.com)
	 *
	 */
?>

<div class="main padding-20">
	<div class="dashbaord">
		<!--Navigation Menu-->
		<?= $navigationMenu ?>

		<?= $this->Notify->getMessage( 'success' ) ?>

		<h4 class="page-header">
			<strong>
				Melio
			</strong>
			Dashboard
		</h4>

		<div class="statistics row">
			<div class="col-sm-4">
				<div class="views panel panel-primary">
					<div class="icon bg-primary">
						40
					</div>
					<div class="statistic text-muted">
						Views
					</div>
				</div>
			</div>
		</div>

	</div>

</div>