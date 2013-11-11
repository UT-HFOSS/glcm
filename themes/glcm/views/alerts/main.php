<div id="content">
	<div class="content-bg">
		<!-- start block -->
		<div class="big-block">
			<h1><?php echo Kohana::lang('ui_main.alerts_get'); ?></h1>
			<?php if ($form_error): ?>
			<!-- red-box -->
			<div class="red-box">
				<h3>Error!</h3>
				<ul>
				<?php
					foreach ($errors as $error_item => $error_description)
					{
						// print "<li>" . $error_description . "</li>";
						print (!$error_description) ? '' : "<li>" . $error_description . "</li>";
					}
				?>
				</ul>
			</div>
			<?php endif; ?>
			<?php print form::open() ?>
			<div class="step-2">
				<h2><?php echo Kohana::lang('ui_main.alerts_step2_send_alerts'); ?></h2>
				<div class="holder">
					
					<div class="box">
                                        <?php $checked = ($form['alert_email_yes'] == 1) ?>
                                        <?php print form::checkbox('alert_email_yes', '1', $checked); ?>
						<label>
							<span>
								<?php echo Kohana::lang('ui_main.alerts_enter_email'); ?>
							</span>
						</label>
					</div>
				</div>
			</div>
			<input id="btn-send-alerts" class="btn_submit" type="submit" value="<?php echo Kohana::lang('ui_main.alerts_btn_send'); ?>" />
			<BR /><BR />
			<a href="<?php echo url::site()."alerts/confirm";?>"><?php echo Kohana::lang('ui_main.alert_confirm_previous'); ?></a>
			<?php print form::close(); ?>
		</div>
		<!-- end block -->
	</div>
</div>
