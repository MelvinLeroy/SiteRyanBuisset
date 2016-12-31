<div id="YLC">

	<div id="YLC_chat_btn" class="chat-chat-btn btn-<?php echo $opts['button_type']; ?>">
		<div class="chat-ico chat fa fa-comments"></div>
		<div class="chat-ico ylc-toggle fa fa-angle-<?php echo( $opts['button_pos'] == 'bottom' ? 'up' : 'down' ) ?>"></div>
		<div class="chat-title">
			<?php echo ylc_sanitize_text( $this->options['text-chat-title'] ) ?>
		</div>
	</div>

	<div id="YLC_chat" class="chat-widget">

		<div id="YLC_chat_header" class="chat-header">
			<div class="chat-ico chat fa fa-comments"></div>
			<div class="chat-ico ylc-toggle fa fa-angle-<?php echo( $opts['button_pos'] == 'bottom' ? 'down' : 'up' ) ?>"></div>
			<div class="chat-title">
				<?php echo ylc_sanitize_text( $this->options['text-chat-title'] ) ?>
			</div>
			<div class="chat-clear"></div>
		</div>

		<div id="YLC_chat_body" class="chat-body chat-online" style="<?php echo $opts['chat_width'] ?>">
			<div class="chat-cnv" id="YLC_cnv">
				<div class="chat-welc">
					<?php echo ylc_sanitize_text( $this->options['text-start-chat'], true ) ?>
				</div>
			</div>
			<div class="chat-tools">
				<a id="YLC_tool_end_chat" href="javascript:void(0)">
					<i class="fa fa-times"></i>
					<?php _e( 'End chat', 'yith-live-chat' ) ?>
				</a>
				<div id="YLC_popup_ntf" class="chat-ntf"></div>
			</div>
			<div class="chat-cnv-reply">
				<div class="chat-cnv-input">
					<textarea id="YLC_cnv_reply" name="msg" class="chat-reply-input" placeholder="<?php _e( 'Type here and hit enter to chat', 'yith-live-chat' ) ?>"></textarea>
				</div>
			</div>
		</div>

		<div id="YLC_connecting" class="chat-body chat-form" style="<?php echo $opts['form_width'] ?>">
			<div class="chat-sending chat-conn">
				<?php _e( 'Connecting', 'yith-live-chat' ) ?>...
			</div>
		</div>

		<div id="YLC_offline" class="chat-body chat-form" style="<?php echo $opts['form_width'] ?>">
			<div class="chat-lead op-offline">
				<?php echo ylc_sanitize_text( $this->options['text-offline'], true ) ?>
			</div>
			<div class="chat-lead op-busy">
				<?php echo ylc_sanitize_text( $this->options['text-busy'], true ) ?>
			</div>
			<?php if ( file_exists( YLC_DIR . 'templates/chat-frontend/chat-offline-form-premium.php' ) ) : ?>

				<?php include_once( YLC_DIR . 'templates/chat-frontend/chat-offline-form-premium.php' ); ?>

			<?php endif; ?>
		</div>

		<div id="YLC_login" class="chat-body chat-form" style="<?php echo $opts['form_width'] ?>">
			<div class="chat-lead">
				<?php echo ylc_sanitize_text( $this->options['text-welcome'], true ) ?>
			</div>
			<form id="YLC_login_form" action="">
				<label for="YLC_field_name">
					<?php _e( 'Your Name', 'yith-live-chat' ) ?>
				</label>:
				<div class="form-line">
					<input type="text" name="user_name" id="YLC_field_name" placeholder="<?php _e( 'Please enter your name', 'yith-live-chat' ) ?>">
					<i class="chat-ico fa fa-user"></i>
				</div>
				<label for="YLC_field_email">
					<?php _e( 'Your Email', 'yith-live-chat' ) ?>
				</label>:
				<div class="form-line">
					<input type="email" name="user_email" id="YLC_field_email" placeholder="<?php _e( 'Please enter your email', 'yith-live-chat' ) ?>">
					<i class="chat-ico fa fa-envelope-o"></i>
				</div>
				<div class="chat-send">
					<div id="YLC_login_ntf" class="chat-ntf"></div>
					<a href="javascript:void(0)" id="YLC_login_btn" class="chat-form-btn">
						<?php _e( 'Start Chat', 'yith-live-chat' ) ?>
					</a>
				</div>
			</form>
		</div>

		<div id="YLC_end_chat" class="chat-body chat-form" style="<?php echo $opts['form_width'] ?>">
			<div class="chat-lead">
				<?php echo ylc_sanitize_text( $this->options['text-close'], true ); ?>
			</div>
			<?php if ( file_exists( YLC_DIR . 'templates/chat-frontend/chat-end-chat-premium.php' ) ) : ?>

				<?php include_once( YLC_DIR . 'templates/chat-frontend/chat-end-chat-premium.php' ); ?>

			<?php endif; ?>
		</div>

	</div>

</div>


