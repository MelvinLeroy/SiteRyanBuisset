<?php
/**
 * General Function
 *
 * @author Yithemes
 * @package YITH WooCommerce Waiting List
 * @version 1.0.0
 */

if ( ! defined( 'YITH_WCWTL' ) ) {
	exit;
} // Exit if accessed directly

if( ! function_exists( 'yith_waitlist_get' ) ) {
	/**
	 * Get waitlist for product id
	 *
	 * @since 1.0.0
	 * @param int $id
	 * @return array
	 * @author Francesco Licandro <francesco.licandro@yithemes.com>
	 */
	function yith_waitlist_get( $id ) {
		$id = intval( $id );
		return get_post_meta( $id, YITH_WCWTL_META, true );
	}
}

if( ! function_exists( 'yith_waitlist_save' ) ) {
	/**
	 * Save waitlist for product id
	 *
	 * @since 1.0.0
	 * @param int $id
	 * @param array $waitlist
	 * @return void
	 * @author Francesco Licandro <francesco.licandro@yithemes.com>
	 */
	function yith_waitlist_save( $id, $waitlist ) {
		$id = intval( $id );
		update_post_meta( $id, YITH_WCWTL_META, $waitlist );
	}
}

if( ! function_exists( 'yith_waitlist_user_is_register' ) ) {
	/**
	 * Check if user is already register for a waitlist
	 *
	 * @since 1.0.0
	 * @param string $user
	 * @param array $waitlist
	 * @return bool
	 * @author Francesco Licandro <francesco.licandro@yithemes.com>
	 */
	function yith_waitlist_user_is_register( $user, $waitlist ) {
		return in_array( $user, $waitlist );
	}
}

if( ! function_exists( 'yith_waitlist_register_user' ) ) {
	/**
	 * Register user to waitlist
	 *
	 * @since 1.0.0
	 * @param string $user User email
	 * @param int $id Product id
	 * @return bool
	 * @author Francesco Licandro <francesco.licandro@yithemes.com>
	 */
	function yith_waitlist_register_user( $user, $id ) {

		$waitlist = yith_waitlist_get( $id );

		if ( ! is_email( $user ) || ( is_array( $waitlist ) && yith_waitlist_user_is_register( $user, $waitlist ) ) )
			return false;

		$waitlist[] = $user;
		// save it
		yith_waitlist_save( $id, $waitlist );

		return true;
	}
}

if( ! function_exists( 'yith_waitlist_unregister_user' ) ) {
	/**
	 * Unregister user from waitlist
	 *
	 * @since 1.0.0
	 * @param string $user User email
	 * @param int $id Product id
	 * @return bool
	 * @author Francesco Licandro <francesco.licandro@yithemes.com>
	 */
	function yith_waitlist_unregister_user( $user, $id ) {

		$waitlist = yith_waitlist_get( $id );

		if( is_array( $waitlist ) && yith_waitlist_user_is_register( $user, $waitlist ) ) {
			$waitlist = array_diff( $waitlist, array ( $user ) );
			// save it
			yith_waitlist_save( $id, $waitlist );
			return true;
		}

		return false;
	}
}

if( ! function_exists( 'yith_waitlist_get_registered_users' ) ) {
	/**
	 * Get registered users for product waitlist
	 *
	 * @since 1.0.0
	 * @param int $id Product id
	 * @return mixed
	 * @author Francesco Licandro <francesco.licandro@yithemes.com>
	 */
	function yith_waitlist_get_registered_users( $id ) {

		$waitlist = yith_waitlist_get( $id );
		$users = array();

		if( is_array( $waitlist ) ) {
			foreach( $waitlist as $key => $email ) {
				$users[] = $email;
			}
		}

		return $users;
	}
}

if( ! function_exists( 'yith_waitlist_empty' ) ) {
	/**
	 * Empty waitlist by product id
	 *
	 * @since 1.0.0
	 * @param int $id Product id
	 * @return void
	 * @author Francesco Licandro <francesco.licandro@yithemes.com>
	 */
	function yith_waitlist_empty( $id ) {
		update_post_meta( $id, YITH_WCWTL_META, array() );
	}
}

if( ! function_exists( 'yith_waitlist_textarea_editor_html' ) ) {
	/**
	 * Print textarea editor html for email options
	 *
	 * @access public
	 * @since 1.0.0
	 * @param string $key
	 * @param array $data
	 * @param object $email
	 * @return string
	 * @author Francesco Licandro
	 */
	function yith_waitlist_textarea_editor_html( $key, $data, $email ){

		$field  = $email->get_field_key( $key );

		$defaults = array(
			'title'             => '',
			'disabled'          => false,
			'class'             => '',
			'css'               => '',
			'placeholder'       => '',
			'type'              => 'text',
			'desc_tip'          => false,
			'description'       => '',
			'custom_attributes' => array()
		);

		$data = wp_parse_args( $data, $defaults );

		$editor_args = array(
			'wpautop'       => true, // use wpautop?
			'media_buttons' => true, // show insert/upload button(s)
			'textarea_name' => esc_attr( $field ), // set the textarea name to something different, square brackets [] can be used here
			'textarea_rows' => 20, // rows="..."
			'tabindex'      => '',
			'editor_css'    => '', // intended for extra styles for both visual and HTML editors buttons, needs to include the <style> tags, can use "scoped".
			'editor_class'  => '', // add extra class(es) to the editor textarea
			'teeny'         => false, // output the minimal editor config used in Press This
			'dfw'           => false, // replace the default fullscreen with DFW (needs specific DOM elements and css)
			'tinymce'       => true, // load TinyMCE, can be used to pass settings directly to TinyMCE using an array()
			'quicktags'     => true // load Quicktags, can be used to pass settings directly to Quicktags using an array()
		);

		ob_start();
		?>

		<tr valign="top">
			<th scope="row" class="select_categories">
				<label for="<?php echo esc_attr( $field ); ?>"><?php echo wp_kses_post( $data['title'] );  ?></label>
				<?php echo $email->get_tooltip_html( $data ); ?>
			</th>
			<td class="forminp">
				<fieldset>
					<div id="<?php echo esc_attr( $field ); ?>-container">
						<div class="editor"><?php wp_editor( $email->get_option( $key ), esc_attr( $field ), $editor_args ); ?></div>
						<?php echo $email->get_description_html( $data ); ?>
					</div>
				</fieldset>
			</td>
		</tr>

		<?php

		return ob_get_clean();
	}
}