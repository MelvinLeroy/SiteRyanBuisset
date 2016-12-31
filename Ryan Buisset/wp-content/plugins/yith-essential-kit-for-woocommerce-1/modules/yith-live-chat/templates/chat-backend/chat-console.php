<div class="yith-live-chat-console-container">
	<div id="YLC_console" class="yith-live-chat-console">
		<div id="YLC_sidebar_left" class="console-sidebar-left">
			<div class="sidebar-header">
				<?php _e( 'Users', 'yith-live-chat' ); ?>
				<a href="" id="YLC_connect" class="connect button button-disabled">
					<?php _e( 'Please wait', 'yith-live-chat' ); ?>
				</a>
			</div>
			<div id="YLC_users" class="sidebar-users">
				<div id="YLC_queue" class="sidebar-queue"></div>
				<div id="YLC_notify" class="sidebar-notify">
					<?php _e( 'Please wait', 'yith-live-chat' ); ?>...
				</div>
			</div>
		</div>
		<div class="console-footer">
			<span><?php echo date( 'Y' ); ?> YITH Live Chat</span>
		</div>
		<div id="YLC_popup_cnv" class="chat-content chat-welcome">
			<div id="YLC_cnv" class="chat-wrapper">
				<div id="YLC_load_msg" class="chat-load-msg">
					<?php _e( 'Please wait', 'yith-live-chat' ) ?>
				</div>
			</div>
			<div id="YLC_cnv_bottom" class="chat-bottom">
				<div class="chat-notify">
					<div id="YLC_popup_ntf"></div>
				</div>
				<div class="chat-cnv-reply">
					<div class="user-avatar">
						<img src="" />
					</div>
					<div class="chat-cnv-input">
						<textarea name="msg" class="chat-reply-input" id="YLC_cnv_reply" placeholder="<?php _e( 'Type here and hit enter to chat', 'yith-live-chat' ) ?>"></textarea>
					</div>
				</div>
			</div>
		</div>
		<div id="YLC_sidebar_right" class="console-sidebar-right">
			<div class="sidebar-header">
				<?php if ( file_exists( YLC_DIR . 'templates/chat-backend/console-save-btn-premium.php' ) ) : ?>

					<?php include_once( YLC_DIR . 'templates/chat-backend/console-save-btn-premium.php' ); ?>

				<?php endif ?>
				<button id="YLC_end_chat" data-cnv-id="0" class="button">
					<i class="fa fa-times"></i>
					<?php _e( 'End chat', 'yith-live-chat' ) ?>
				</button>
				<input type="hidden" id="YLC_active_cnv" />
				<br />
				<span id="YLC_save_ntf"></span>
			</div>
			<div class="sidebar-info info-name">
				<strong><?php _e( 'User Name', 'yith-live-chat' ) ?></strong>
				<span></span>
			</div>
			<div class="sidebar-info info-ip">
				<strong><?php _e( 'IP Address', 'yith-live-chat' ) ?></strong>
				<span></span>
			</div>
			<div class="sidebar-info info-email">
				<strong><?php _e( 'User Email', 'yith-live-chat' ) ?></strong>
				<a href="">
				</a>
			</div>
			<div class="sidebar-info info-page">
				<strong><?php _e( 'Current Page', 'yith-live-chat' ) ?></strong>
				<a id="YLC_active_page" href="" target="_blank">
				</a>
			</div>
			<?php if ( file_exists( YLC_DIR . 'templates/chat-backend/console-user-tools-premium.php' ) ): ?>

				<?php include_once( YLC_DIR . 'templates/chat-backend/console-user-tools-premium.php' ); ?>

			<?php endif; ?>
		</div>
		<div id="YLC_firebase_offline" class="firebase-offline">
			<div><?php _e( 'Firebase offline or not available. Please wait...', 'yith-live-chat' ); ?></div>
		</div>
	</div>
</div>