<?php
/**
 * Loadmore Single Posts
 *
 * @package Aquila
 */

namespace FUTUREWORDPRESS_PROJECT\Inc;

use FUTUREWORDPRESS_PROJECT\Inc\Traits\Singleton;
// use \WP_Query;

class Requests {

	use Singleton;

	protected function __construct() {
		$this->setup_hooks();
	}

	protected function setup_hooks() {
    add_action( 'admin_post_fwp-contact-company-form-action', [ $this, 'sendMail' ], 10, 0 );
    add_action( 'admin_post_nopriv_fwp-contact-company-form-action', [ $this, 'sendMail' ], 10, 0 );
    
    add_action( 'wp_ajax_fwp-company-delete-job-action', [ $this, 'deleteJob' ], 10, 0 );
    add_action( 'wp_ajax_nopriv_fwp-company-delete-job-action', [ $this, 'deleteJob' ], 10, 0 );
    
    add_action( 'wp_ajax_fwp-company-approve-job-action', [ $this, 'approveJob' ], 10, 0 );
    add_action( 'wp_ajax_nopriv_fwp-company-approve-job-action', [ $this, 'approveJob' ], 10, 0 );

    add_action( 'admin_post_fwp-job-markas-paid-by-company-action', [ $this, 'payJob' ], 10, 0 );
    add_action( 'admin_post_nopriv_fwp-job-markas-paid-by-company-action', [ $this, 'payJob' ], 10, 0 );
	}
  public function sendMail() {
    if ( ! isset( $_POST[ 'fwp-contact-company-form' ] ) || ! isset( $_POST['fwp-contact-company-form-action'] ) || ! wp_verify_nonce( $_POST['fwp-contact-company-form-action'], 'fwp-contact-company-form-action' ) ) {
      wp_die( __( 'Sorry, your nonce did not verify.', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ), __( 'Authetication error', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ) );
    } else {
      // wp_die( print_r( $_POST ) );
      $request = $_POST[ 'fwp-contact-company-form' ];
      $request = wp_parse_args( $request, [
        'id' => 0, 'to' => '', 'name' => '', 'email' => '', 'subject' => '', 'message' => ''
      ] );
      // can be verify by "id" as company ID Author ID
      $to = $request[ 'to' ];
      $subject = $request[ 'subject' ];
      $body = $request[ 'message' ];
      $headers = [ 'Content-Type: text/plain; charset=UTF-8' ];
      $headers[] = 'Reply-To: ' . $request[ 'name' ] . ' <' . $request[ 'email' ] . '>';

      wp_mail( $to, $subject, $body, $headers );
      // $msg = [ 'status' => 'success', 'message' => __( get_fwp_option( 'msg_profile_edit_success_txt', 'Changes saved' ), FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ) ];
      // set_transient( 'status_successed_message-' . get_current_user_id(), $msg, 300 );
      wp_safe_redirect( wp_get_referer() );
    }
  }
  public function deleteJob() {
    if ( ! isset( $_POST[ 'job' ] ) || ! isset( $_POST['fwp-company-delete-job-action'] ) || ! wp_verify_nonce( $_POST['fwp-company-delete-job-action'], 'fwp-company-delete-job-action-' . $_POST[ 'job' ] ) ) {
      wp_send_json_error( __( 'Sorry, your nonce did not verify.', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ), 400 );
    } else {
      wp_delete_post( $_POST[ 'job' ] );
      $msg = [ 'status' => 'success', 'message' => __( 'Job deleted successfully', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ) ];
      wp_send_json_success( $msg, 200 );
    }
  }
  public function approveJob() {
    if ( ! isset( $_POST[ 'id' ] ) || ! isset( $_POST['fwp-company-approve-job-action'] ) || ! wp_verify_nonce( $_POST['fwp-company-approve-job-action'], 'fwp-company-approve-job-action-' . $_POST[ 'id' ] ) ) {
      wp_send_json_error( __( 'Sorry, your nonce did not verify.', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ), 400 );
    } else {
      if( isset( $_POST[ 'user_id' ] ) && ! empty( $_POST[ 'user_id' ] ) && isset( $_POST[ 'job_id' ] ) && ! empty( $_POST[ 'job_id' ] ) && isset( $_POST[ 'cv_id' ] ) && ! empty( $_POST[ 'cv_id' ] ) ) {
        if( $_POST[ 'markas' ] == 'approved' && apply_filters( 'futurewordpress/project/job/apply/approve', $_POST ) ) {
          $msg = [ 'status' => 'success', 'message' => __( 'Job approved successfully', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ) ];
          wp_send_json_success( $msg, 200 );
        // } elseif( $_POST[ 'markas' ] == 'paid' && false && apply_filters( 'futurewordpress/project/job/apply/paid', $_POST ) ) {
        //   $msg = [ 'status' => 'success', 'message' => __( 'Job marked as Paid successfully', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ) ];
        //   wp_send_json_success( $msg, 200 );
        } else {
          wp_send_json_error( __( 'Failed to execute', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ), 400 );
        }
      } else {
        wp_send_json_error( __( 'Invalid request', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ), 400 );
      }
    }
  }
  public function payJob() {
    if ( ! isset( $_POST[ 'fwp-job-markas-paid-by-company' ] ) || ! isset( $_POST['fwp-job-markas-paid-by-company-action'] ) || ! wp_verify_nonce( $_POST['fwp-job-markas-paid-by-company-action'], 'fwp-job-markas-paid-by-company-action' ) ) {
      wp_send_json_error( __( 'Sorry, your nonce did not verify.', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ), 400 );
    } else {
      $postQuery = $_POST[ 'fwp-job-markas-paid-by-company' ];
      if( ! empty( $postQuery ) && is_array( $postQuery ) ) {
        if( apply_filters( 'futurewordpress/project/job/apply/paid', $postQuery ) ) {
          $msg = [ 'status' => 'success', 'message' => __( 'Job marked as Paid successfully', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ) ];
          set_transient( 'status_successed_message-' . get_current_user_id(), $msg, 300 );
          wp_safe_redirect( wp_get_referer() );
        } else {
          $msg = [ 'status' => 'error', 'message' => __( 'Something went wrong while tring to mark job as paid. Maybe request information isn\'t matching properly.', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ) ];
          set_transient( 'status_successed_message-' . get_current_user_id(), $msg, 300 );
          wp_safe_redirect( wp_get_referer() );
        }
      } else {
        $msg = [ 'status' => 'error', 'message' => __( 'Something went wrong while tring to mark job as paid. Maybe request isn\'t valid detected.', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ) ];
        set_transient( 'status_successed_message-' . get_current_user_id(), $msg, 300 );
        wp_safe_redirect( wp_get_referer() );
      }
    }
  }

}
