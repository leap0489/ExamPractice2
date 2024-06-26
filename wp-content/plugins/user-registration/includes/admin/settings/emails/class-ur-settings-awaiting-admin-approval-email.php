<?php
/**
 * Configure Email
 *
 * @package  UR_Settings_Awaiting_Admin_Approval_Email
 * @extends  UR_Settings_Email
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! class_exists( 'UR_Settings_Awaiting_Admin_Approval_Email', false ) ) :

	/**
	 * UR_Settings_Awaiting_Admin_Approval_Email Class.
	 */
	class UR_Settings_Awaiting_Admin_Approval_Email {
		/**
		 * UR_Settings_Awaiting_Admin_Approval_Email Id.
		 *
		 * @var string
		 */
		public $id;

		/**
		 * UR_Settings_Awaiting_Admin_Approval_Email Title.
		 *
		 * @var string
		 */
		public $title;

		/**
		 * UR_Settings_Awaiting_Admin_Approval_Email Description.
		 *
		 * @var string
		 */
		public $description;

		/**
		 * Constructor.
		 */
		public function __construct() {
			$this->id          = 'awaiting_admin_approval_email';
			$this->title       = __( 'Awaiting Admin Approval', 'user-registration' );
			$this->description = __( 'Email sent to the user notifying the registration is awaiting admin approval', 'user-registration' );
		}

		/**
		 * Get settings
		 *
		 * @return array
		 */
		public function get_settings() {
			/**
			 * Filter to add the options on settings.
			 *
			 * @param array Options to be enlisted.
			 */
			$settings = apply_filters(
				'user_registration_awaiting_admin_approval',
				array(
					'title'    => __( 'Emails', 'user-registration' ),
					'sections' => array(
						'awaiting_admin_approval_email' => array(
							'title'        => __( 'Awaiting Admin Approval Email', 'user-registration' ),
							'type'         => 'card',
							'desc'         => '',
							'back_link'    => ur_back_link( __( 'Return to emails', 'user-registration' ), admin_url( 'admin.php?page=user-registration-settings&tab=email' ) ),
							'preview_link' => ur_email_preview_link(
								__( 'Preview', 'user-registration' ),
								$this->id
							),
							'settings'     => array(
								array(
									'title'    => __( 'Enable this email', 'user-registration' ),
									'desc'     => __( 'Enable this email sent to user notifying the registration is awaiting admin approval.', 'user-registration' ),
									'id'       => 'user_registration_enable_awaiting_admin_approval_email',
									'default'  => 'yes',
									'type'     => 'toggle',
									'autoload' => false,
								),
								array(
									'title'    => __( 'Email Subject', 'user-registration' ),
									'desc'     => __( 'The email subject you want to customize.', 'user-registration' ),
									'id'       => 'user_registration_awaiting_admin_approval_email_subject',
									'type'     => 'text',
									'default'  => __( 'Thank you for registration on {{blog_info}}', 'user-registration' ),
									'css'      => 'min-width: 350px;',
									'desc_tip' => true,
								),
								array(
									'title'    => __( 'Email Content', 'user-registration' ),
									'desc'     => __( 'The email content you want to customize.', 'user-registration' ),
									'id'       => 'user_registration_awaiting_admin_approval_email',
									'type'     => 'tinymce',
									'default'  => $this->ur_get_awaiting_admin_approval_email(),
									'css'      => 'min-width: 350px;',
									'desc_tip' => true,
								),
							),
						),
					),
				)
			);

			/**
			 * Filter to get the settings.
			 *
			 * @param array $settings Setting options to be enlisted.
			 */
			return apply_filters( 'user_registration_get_settings_' . $this->id, $settings );
		}

		/**
		 * Email Format.
		 *
		 * @return string $message Message content for admin approval email.
		 */
		public function ur_get_awaiting_admin_approval_email() {

			/**
			 * Filter to overwrite the admin approval email.
			 *
			 * @param string Message content to overwrite the existing email content.
			 */
			$message = apply_filters(
				'user_registration_get_awaiting_admin_approval_email',
				sprintf(
					__(
						'Hi {{username}}, <br/>

You have registered on <a href="{{home_url}}">{{blog_info}}</a>. <br/>

Please wait until the site admin approves your registration. You will be notified after it is approved. <br/>

Thank You!',
						'user-registration'
					)
				)
			);

			return $message;
		}
	}
endif;

return new UR_Settings_Awaiting_Admin_Approval_Email();
