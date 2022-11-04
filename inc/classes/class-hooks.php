<?php
/**
 * Block Patterns
 *
 * @package Aquila
 */

namespace FUTUREWORDPRESS_PROJECT\Inc;

use FUTUREWORDPRESS_PROJECT\Inc\Traits\Singleton;

class Hooks {
	use Singleton;

	protected function __construct() {
		// load class.
		$this->setup_hooks();
	}

	protected function setup_hooks() {

		add_filter( 'futurewordpress/project/job/timeString', [ $this, 'timeString' ], 10, 2 );

    
		add_filter( 'futurewordpress/project/get/activejob', [ $this, 'activeJob' ], 10, 1 );
		add_filter( 'futurewordpress/project/get/totaljob', [ $this, 'totalJob' ], 10, 1 );
		add_filter( 'futurewordpress/project/get/totalapply', [ $this, 'totalApply' ], 10, 1 );
		add_filter( 'futurewordpress/project/get/applied', [ $this, 'jobApplied' ], 10, 1 );

		add_filter( 'futurewordpress/project/get/noapplied', [ $this, 'jobNothingApplied' ], 10, 2 );


    // add_filter( 'posts_results', [ $this, 'posts_results' ], 99, 1 );

    
    add_action( 'admin_post_fwp-company-profile-edit', [ $this, 'editProfile' ], 10, 0 );
    add_action( 'admin_post_nopriv_fwp-company-profile-edit', [ $this, 'editProfile' ], 10, 0 );
    
    add_action( 'admin_post_fwp-company-post-job-action', [ $this, 'postNewJob' ], 10, 0 );
    add_action( 'admin_post_nopriv_fwp-company-post-job-action', [ $this, 'postNewJob' ], 10, 0 );
    
    
    add_action( 'wp_ajax_fwp-candidate-add-cv-action', [ $this, 'cvUpload' ], 10, 0 );
    add_action( 'wp_ajax_nopriv_fwp-candidate-add-cv-action', [ $this, 'cvUpload' ], 10, 0 );
    
    add_action( 'wp_ajax_fwp-candidate-delete-cv-action', [ $this, 'cvDelete' ], 10, 0 );
    add_action( 'wp_ajax_nopriv_fwp-candidate-delete-cv-action', [ $this, 'cvDelete' ], 10, 0 );
    
    add_action( 'admin_post_fwp-apply-job-action', [ $this, 'applyJob' ], 10, 0 );
    add_action( 'admin_post_nopriv_fwp-apply-job-action', [ $this, 'applyJob' ], 10, 0 );
    
    add_action( 'wp_ajax_fwp-candidate-delete-application-action', [ $this, 'applyDelete' ], 10, 0 );
    add_action( 'wp_ajax_nopriv_fwp-candidate-delete-application-action', [ $this, 'applyDelete' ], 10, 0 );
    add_action( 'wp_ajax_fwp-company-delete-application-action', [ $this, 'applyDelete' ], 10, 0 );
    add_action( 'wp_ajax_nopriv_fwp-company-delete-application-action', [ $this, 'applyDelete' ], 10, 0 );
	}
  public function posts_results( $posts ) {
    $filtered_posts = array();
    // print_r( $posts );wp_die();
    foreach ( $posts as $post ) {
      if ( false === strpos($post->post_title, 'selfie')) {
        // safe to add non-selfie title post to array
        $filtered_posts[] = $post;
      }
    }
    return $filtered_posts;
  }

  public function activeJob( $args ) {
    global $wpdb;
    $args[ 'id' ] = isset( $args[ 'id' ] ) ? $args[ 'id' ] : get_current_user_id();
    // $count = $wpdb->get_row("SELECT COUNT(*) AS THE_COUNT FROM $wpdb->postmeta WHERE (meta_key = 'fwp_jobs-positionfilled' AND meta_value = '') AND {$wpdb->posts}.ID = post_id;");
    // return $count->THE_COUNT;
    $total = get_posts( [
      'numberposts'   => -1,
      'post_type'     => FUTUREWORDPRESS_PROJECT_CPT_JOB_OPENINGS,
      'post_status'   => 'publish',
      'post_author'   => $args[ 'id' ],
      'meta_key'      => 'fwp_jobs-positionfilled',
      'meta_value'    => 0
    ] );
    // ( count_user_posts( get_current_user_id(), FUTUREWORDPRESS_PROJECT_CPT_JOB_OPENINGS, false ) - count( $total ) )
    return ( $total ) ? count( $total ) : 0;
  }
  public function totalJob( $args ) {
    return count_user_posts( get_current_user_id(), FUTUREWORDPRESS_PROJECT_CPT_JOB_OPENINGS, false );
  }
  public function totalApply( $args ) {
    $rows = apply_filters( 'futurewordpress/project/job/apply/get', [
      'user' => get_current_user_id()
    ] );
    return count( $rows );
  }
  public function jobApplied( $args ) {
    return count( apply_filters( 'futurewordpress/project/job/apply/get', [ 'job' => $args[ 'id' ] ] ) );
  }
  public function jobNothingApplied( $html, $args ) {
    return $html;
  }


  private function getCompany( $args ) {
    $postArgs = [
      'post_type' => 'companies',
      'numberposts' => 1,
      // 'fields' => 'ids, names',
      'orderby'    => 'menu_order',
      'sort_order' => 'desc',
      // 'post_author' => get_current_user_id(),
      
      // 'meta_key'      => 'fwp_company-authorizeid',
      // 'meta_value'    => get_current_user_id(),
      // 'meta_compare'  => '=='
    ];
    if( is_FwpActive( 'reedit_author' ) ) {
      $postArgs[ 'post_author' ] = get_current_user_id();
    } else {
      $postArgs[ 'meta_key' ]      = 'fwp_company-authorizeid';
      $postArgs[ 'meta_value' ]    = get_current_user_id();
      $postArgs[ 'meta_compare' ]  = '==';
    }
    $getCompany = get_posts( $postArgs );
    $getCompany = isset( $getCompany[ 0 ] ) ? $getCompany[ 0 ] : false;
    if( ! $getCompany ) {return false;}
    $getCompany->meta = [];
    foreach( get_post_meta( $getCompany->ID ) as $key => $value ) {
      if( substr( $key, 0, 12 ) == 'fwp_company-' ) {
        $key = str_replace( [ 'fwp_company-' ], [ '' ], $key );
        $getCompany->meta[ $key ] = isset( $value[0] ) ? $value[0] : $value;
      }
    }
    return $getCompany;
  }

  public function postNewJob() {
    if ( ! isset( $_POST['fwp-company-post-job-action'] ) || ! wp_verify_nonce( $_POST['fwp-company-post-job-action'], 'fwp-company-post-job-action' ) ) {
      wp_die( __( 'Sorry, your nonce did not verify.', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ), __( 'Authetication error', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ) );
    } else {
      $postData = isset( $_POST[ 'fwp-company-post-job' ] ) ? $_POST[ 'fwp-company-post-job' ] : false;
      foreach( $_POST[ 'JobDate' ] as $i => $v ) {
        $postData[ 'vanues' ][ $i ][ 'JobDate' ] = isset( $_POST[ 'JobDate' ][ $i ] ) ? $_POST[ 'JobDate' ][ $i ] : '';
        $postData[ 'vanues' ][ $i ][ 'JobLocation' ] = isset( $_POST[ 'JobLocation' ][ $i ] ) ? $_POST[ 'JobLocation' ][ $i ] : '';
        $postData[ 'vanues' ][ $i ][ 'JobRequirments' ] = isset( $_POST[ 'JobRequirments' ][ $i ] ) ? $_POST[ 'JobRequirments' ][ $i ] : '';
      }

      if( ! $postData ) {
        wp_die( __( 'Post data error', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ), __( 'Error happens', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ) );
      } else {
        $postData = wp_parse_args( $postData, [
          'featuredlisting' => false,
          'remoteposition' => false,
          'positionfilled' => false,
          'hidecompany' => false,
        ] );
        $companyArray = [
          'post_title'   => $postData[ 'title' ],
          'post_type'    => FUTUREWORDPRESS_PROJECT_CPT_JOB_OPENINGS,
          'post_content' => $postData[ 'description' ],
          // 'post_status'  => is_FwpActive( 'job_autoapproved' ) ? 'publish' : 'pending',
          'post_author'  => get_current_user_id(),
          // 'tax_input'    => [
          //   'hierarchical_tax'     => $hierarchical_terms,
            // 'non_hierarchical_tax' => $non_hierarchical_terms,
          // ],
          'meta_input'   => [
            // 'test_meta_key' => 'value of test_meta_key',
          ],
        ];
        foreach( $postData as $pi => $pv ) {
          $companyArray[ 'meta_input' ][ 'fwp_jobs-' . $pi ] = $pv;
          // $companyArray[ 'meta_input' ][] = [ 'key' => 'fwp_jobs-' . $pi, 'value' => $pv ];
        }
        
        // if( isset( $_POST[ 'fwp-company-post-job-types' ] ) ) {$companyArray[ 'tax_input' ][ 'hierarchical_tax' ] = (array) $_POST[ 'fwp-company-post-job-types' ];}
        
        $companyArray[ 'meta_input' ][ 'fwp_jobs-postedby' ] = get_current_user_id();
        // $companyArray[ 'meta_input' ][] = ['key' => 'fwp_jobs-postedby','value' => get_current_user_id()];
        $getCompany = $this->getCompany( [] );
        if( $getCompany ) {
          $companyArray[ 'meta_input' ][ 'fwp_jobs-company' ] = $getCompany->ID;
          // $companyArray[ 'meta_input' ][] = ['key' => 'fwp_jobs-company','value' => $getCompany->ID];
        }
        
        // print_r( [ $_POST, $companyArray ] );wp_die(  );
        // print_r( $_POST );wp_die();
        // $post_id = ( isset( $_POST[ 'fwp-company-profile-action' ] ) && $_POST[ 'fwp-company-profile-action' ] == 'edit' ) ? wp_update_post( $companyArray ) : wp_insert_post( $companyArray );
        if( isset( $_POST[ 'fwp-company-post-job-edit' ] ) && ! empty( $_POST[ 'fwp-company-post-job-edit' ] ) ) {
          $companyArray[ 'ID' ] = $_POST[ 'fwp-company-post-job-edit' ];
          if( is_FwpActive( 'job_editpending' ) ) {$companyArray[ 'post_status' ] = 'pending';}
          $post_id = wp_update_post( $companyArray, true );$is_new = false;
          // wp_die();
        } else {
          $companyArray[ 'post_status' ] = is_FwpActive( 'job_autoapproved' ) ? 'publish' : 'pending';
          $post_id = wp_insert_post( $companyArray, true );$is_new = true;
        }
        if( ! is_wp_error( $post_id ) ) {
          $terms = [ 'job_categories' => [], 'job_types' => [] ];
          foreach( $_POST[ 'fwp-company-post-job-types' ] as $id ) {
            $taxonomy = 'job_categories';$termObj  = get_term_by( 'id', $id, $taxonomy );
            if( ! $termObj ) {
              $taxonomy = 'job_types';$termObj  = get_term_by( 'id', $id, $taxonomy );
            }
            if( $termObj ) {
              $terms[ $taxonomy ][] = intval( $id );
            }
          }
          foreach( $terms as $taxonomy => $taxo_ids ) {
            wp_set_object_terms( $post_id, $taxo_ids, $taxonomy );
          }
          $msg = [ 'status' => 'success', 'message' => __( ( $is_new ) ? get_fwp_option( 'msg_job_create_success_txt', 'Successfully created Job' ) : get_fwp_option( 'msg_job_update_success_txt', 'Successfully Updated Job' ), FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ) . ' ' . __( ( is_FwpActive( 'job_autoapproved' ) ? get_fwp_option( 'msg_job_autoapproved_txt', 'Is publised autometically' ) : get_fwp_option( 'msg_job_waitapproved_txt', 'Is waiting for approval' ) ), FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ) ];
          set_transient( 'status_successed_message-' . get_current_user_id(), $msg, 300 );
          wp_safe_redirect( wp_get_referer() );
        } else {
          wp_die( 'Failed to made changes' );
        }
      }
    }
  }
  public function editProfile() {
    if ( ! isset( $_POST['fwp-company-profile-edit'] ) || ! wp_verify_nonce( $_POST['fwp-company-profile-edit'], 'fwp-company-profile-edit' ) ) {
      wp_die( __( 'Sorry, your nonce did not verify.', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ), __( 'Authetication error', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ) );
    } else {
      $postData = isset( $_POST[ 'fwp-company-profile' ] ) ? $_POST[ 'fwp-company-profile' ] : false;
      if( ! $postData ) {
        wp_die( __( 'Post data error', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ), __( 'Error happens', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ) );
      } else {
        $companyArray = [
          'post_title'   => $postData[ 'name' ],
          'post_type' => 'companies',
          // 'post_content' => $postData[ 'about' ],
          'post_status'  => 'publish',
          'post_author'  => get_current_user_id(),
          // 'tax_input'    => [
          //   'hierarchical_tax'     => $hierarchical_tax,
          //   'non_hierarchical_tax' => $non_hierarchical_terms,
          // ],
          'meta_input'   => [
            // 'test_meta_key' => 'value of test_meta_key',
          ],
        ];
        $getCompany = $this->getCompany( [] );
        if( isset( $getCompany->ID ) && $getCompany->ID && ! empty( $getCompany->ID ) ) {
          $companyArray[ 'ID' ] = $getCompany->ID;
        }
        foreach( $postData as $pi => $pv ) {
          $companyArray[ 'meta_input' ][ 'fwp_company-' . $pi ] = $pv;
          // $companyArray[ 'meta_input' ][] = [ 'key' => 'fwp_company-' . $pi, 'value' => $pv ];
        }
        $post_id = ( isset( $_POST[ 'fwp-company-profile-action' ] ) && $_POST[ 'fwp-company-profile-action' ] == 'edit' ) ? wp_update_post( $companyArray ) : ( ! $getCompany || ! isset( $getCompany->ID ) ? wp_insert_post( $companyArray ) : false );
        if( ! is_wp_error( $post_id ) || ! $post_id ) {
          // print_r( [ $companyArray, $_POST ] );wp_die();
          $msg = [ 'status' => 'success', 'message' => __( get_fwp_option( 'msg_profile_edit_success_txt', 'Changes saved' ), FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ) ];
          set_transient( 'status_successed_message-' . get_current_user_id(), $msg, 300 );
          wp_safe_redirect( wp_get_referer() );
        } else {
          wp_die( 'Failed to made changes' );
        }
      }
    }
  }
  public function timeString( $datetime, $full = false) {
    $now = new \DateTime;
    $ago = new \DateTime( $datetime );
    $diff = $now->diff( $ago );

    $diff->w = floor( $diff->d / 7);
    $diff->d -= $diff->w * 7;

    $string = array(
      'y' => __( 'year', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
      'm' => __( 'month', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
      'w' => __( 'week', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
      'd' => __( 'day', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
      'h' => __( 'hour', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
      'i' => __( 'minute', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
      's' => __( 'second', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN )
    );
    foreach ($string as $k => &$v) {
      if ($diff->$k) {
        $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
      } else {
        unset($string[$k]);
      }
    }

    if (!$full) $string = array_slice($string, 0, 1);
    return $string ? implode(', ', $string) . ' ' . __( 'ago', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ) : __( 'just now', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN );
  }

  
  public function cvUpload() {
    if ( ! isset( $_POST['_nonce'] ) || ! wp_verify_nonce( $_POST['_nonce'], 'admin_ajax_post_nonce' ) ) {
      wp_send_json_error( __( 'Authetication error', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ), 401 );
    } else {
      if( isset( $_POST[ "name" ] ) && isset( $_FILES[ "file" ] ) && ! empty( $_FILES[ "file" ][ "name" ] ) ) {
        $statusMsg = '';
        $targetDir = FUTUREWORDPRESS_PROJECT_CV_UPLOAD_DIR_PATH . '/';
        is_dir( FUTUREWORDPRESS_PROJECT_CV_UPLOAD_DIR_PATH ) || wp_mkdir_p( FUTUREWORDPRESS_PROJECT_CV_UPLOAD_DIR_PATH );
        $fileName = basename( $_FILES["file"]["name"] );
        $targetFilePath = $targetDir . pathinfo( $fileName, PATHINFO_FILENAME ) . '-' . time() . '.' . pathinfo( $fileName, PATHINFO_EXTENSION );
        $fileType = pathinfo( $targetFilePath, PATHINFO_EXTENSION );
        // Allow certain file formats
        $allowTypes = [ 'doc', 'docx', 'pdf' ];
        if( in_array( $fileType, $allowTypes ) ) {
          if( move_uploaded_file( $_FILES[ "file" ][ "tmp_name" ], $targetFilePath ) ) {
            // Insert image file name into database
            $insert = isset( $_POST[ 'edit-cv' ] ) ? apply_filters( 'futurewordpress/project/job/cv/edit', [ 'id' => $_POST[ 'edit-cv' ], 'name' => $_POST[ "name" ], 'path' => $targetFilePath ] ) : apply_filters( 'futurewordpress/project/job/cv/add', [ 'name' => $_POST[ "name" ], 'path' => $targetFilePath ] );
            if( $insert ) {
              $statusMsg = sprintf( __( 'The file "%s" has been uploaded successfully.', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ), $fileName );
              wp_send_json_success( $statusMsg, 200 );
            } else {
              $statusMsg = __( 'File upload failed, please try again.', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN );
            } 
          } else {
            $statusMsg = __( 'Sorry, there was an error uploading your file.' . $targetFilePath, FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN );
          }
        } else {
          $statusMsg = __( 'Sorry, only DOC, DOCX, & PDF files are allowed to upload.', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN );
        }
      } else {
        $statusMsg = __( 'Please select a file to upload.', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN );
      }
      wp_send_json_error( $statusMsg );
    }
  }
  public function cvDelete() {
    if ( ! isset( $_POST['_nonce'] ) || ! wp_verify_nonce( $_POST['_nonce'], 'admin_ajax_post_nonce' ) ) {
      wp_send_json_error( __( 'Authetication error', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ), 401 );
    } else {
      if( isset( $_POST[ 'id' ] ) && ! empty( $_POST[ 'id' ] ) ) {
        $args = ['id' => $_POST[ 'id' ] ];
        if( isset( $_POST[ 'isCompany' ] ) ) {$args[ 'isCompany' ] = $_POST[ 'isCompany' ];}
        $response = apply_filters( 'futurewordpress/project/job/cv/delete', $args );
        if( $response ) {
          wp_send_json_success( __( 'CV has been removed', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ) );
        } else {
          wp_send_json_error( __( 'Error while removing CV', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ) );
        }
      } else {
        wp_send_json_error( __( 'Request has been currupted. Try to right way.', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ) );
      }
    }
  }
  public function applyJob() {
    if ( ! isset( $_POST['fwp-apply-job-action'] ) || ! wp_verify_nonce( $_POST['fwp-apply-job-action'], 'fwp-apply-job-action' ) ) {
      wp_die( __( 'Nonce not verified properly', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ), __( 'Authetication error', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ) );
    } else {
      $job = $_POST[ 'fwp-apply-job' ];
      $args = [
        'job_id' => isset( $_POST[ 'fwp-apply-job-edit' ] ) ? $_POST[ 'fwp-apply-job-edit' ] : (
          isset( $_POST[ 'fwp-apply-job-add' ] ) ? $_POST[ 'fwp-apply-job-add' ] : false
        ),
        'cv_id' => $job[ 'cv' ],
        'coverletter' => $job[ 'coverletter' ]
      ];
      $apply = apply_filters( 'futurewordpress/project/job/apply/get', [ 'job' => $args[ 'job_id' ], 'user' => get_current_user_id() ] );$is_edit = ( count( $apply ) >= 1 );$apply = (array) end( $apply );
      
      if( isset( $apply[ 'ID' ] ) ) {$args[ 'id' ] = $apply[ 'ID' ];}
      if( isset( $_POST[ 'fwp-apply-job-add' ] ) && ! $is_edit ) {
        if( apply_filters( 'futurewordpress/project/job/apply/add', $args ) ) {
          $msg = [ 'status' => 'success', 'message' => __( get_fwp_option( 'msg_apply_added_txt', 'Application has been created successfully.' ), FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ) ];
          set_transient( 'status_successed_message-' . get_current_user_id(), $msg, 300 );
          // print_r( $apply );wp_die();
          wp_safe_redirect( wp_get_referer() );
        } else {
          wp_die( __( 'Failed to create application', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ), __( 'Database error', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ) );
        }
      } else {
        if( apply_filters( 'futurewordpress/project/job/apply/edit', $args ) ) {
          $msg = [ 'status' => 'success', 'message' => __( get_fwp_option( 'msg_apply_updated_txt', 'Application has been Updated successfully.' ), FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ) ];
          set_transient( 'status_successed_message-' . get_current_user_id(), $msg, 300 );
          wp_safe_redirect( wp_get_referer() );
        } else {
          wp_die( __( 'Failed to update application', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ), __( 'Database error', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ) );
        }
      }
    }
  }
  public function applyDelete() {
    if ( ! isset( $_POST['_nonce'] ) || ! wp_verify_nonce( $_POST['_nonce'], 'admin_ajax_post_nonce' ) ) {
      wp_send_json_error( __( 'Authetication error', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ), 401 );
    } else {
      if( isset( $_POST[ 'id' ] ) && ! empty( $_POST[ 'id' ] ) ) {
        $args = [ 'id' => $_POST[ 'id' ] ];
        if( isset( $_POST[ 'isCompany' ] ) ) {
          $args[ 'isCompany' ] = $_POST[ 'isCompany' ];
        }
        if( apply_filters( 'futurewordpress/project/job/apply/delete', $args ) ) {
          wp_send_json_success( __( 'Application has been removed', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ) );
        } else {
          wp_send_json_error( __( 'Error while removing Application', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ) );
        }
      } else {
        wp_send_json_error( __( 'Request has been currupted. Try to right way.', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ) );
      }
    }
  }
}