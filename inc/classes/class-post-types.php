<?php
/**
 * Register Post Types
 *
 * @package Aquila
 */

namespace FUTUREWORDPRESS_PROJECT\Inc;

use FUTUREWORDPRESS_PROJECT\Inc\Traits\Singleton;

class Post_Types {
	use Singleton;
	private $postType;
	private $postTypes;
	private $post_statuses;
	private $caps;
	private $meta;

	protected function __construct() {
		$this->postTypes = FUTUREWORDPRESS_PROJECT_CPT_JOB_OPENINGS;
		$this->postType = substr( $this->postTypes, 0, -1 );
		$this->post_statuses = [ 'publish', 'filled', 'expired', 'draft', 'trash', 'pending' ];
		$this->meta = [];
		$this->caps = [
			'manage_' . $this->postTypes,
			'edit_' . $this->postType,
			'read_' . $this->postType,
			'delete_' . $this->postType,
			'edit_' . $this->postTypes,
			'edit_others_' . $this->postTypes,
			'publish_' . $this->postTypes,
			'read_private_' . $this->postTypes,
			'delete_' . $this->postTypes,
			'delete_private_' . $this->postTypes,
			'delete_published_' . $this->postTypes,
			'delete_others_' . $this->postTypes,
			'edit_private_' . $this->postTypes,
			'edit_published_' . $this->postTypes,
			'manage_' . $this->postType . '_terms',
			'edit_' . $this->postType . '_terms',
			'delete_' . $this->postType . '_terms',
			'assign_' . $this->postType . '_terms',
		];
		$this->setup_hooks();
	}

	protected function setup_hooks() {
		add_action( 'init', [ $this, 'create_job_cpt' ], 0 );
		add_action( 'init', [ $this, 'create_company_cpt' ], 0 );

		add_filter( 'enter_title_here', [ $this, 'enter_title_here' ], 1, 2 );
		add_filter( 'manage_edit-' . $this->postTypes . '_columns', [ $this, 'columns' ] );
		add_filter( 'list_table_primary_column', [ $this, 'primary_column' ], 10, 2 );
		add_filter( 'post_row_actions', [ $this, 'row_actions' ] );
		add_action( 'manage_' . $this->postTypes . '_posts_custom_column', [ $this, 'custom_columns' ], 2 );
		add_filter( 'manage_edit-' . $this->postTypes . '_sortable_columns', [ $this, 'sortable_columns' ] );
		add_filter( 'request', [ $this, 'sort_columns' ] );
		add_action( 'parse_query', [ $this, 'search_meta' ] );
		add_action( 'parse_query', [ $this, 'filter_meta' ] );
		add_filter( 'get_search_query', [ $this, 'search_meta_label' ] );
		add_filter( 'post_updated_messages', [ $this, 'post_updated_messages' ] );
		add_action( 'bulk_actions-edit-' . $this->postTypes, [ $this, 'add_bulk_actions' ] );
		add_action( 'handle_bulk_actions-edit-' . $this->postTypes, [ $this, 'do_bulk_actions' ], 10, 3 );
		add_action( 'admin_init', [ $this, 'approve_job' ] );
		add_action( 'admin_notices', [ $this, 'action_notices' ] );
		add_action( 'view_mode_post_types', [ $this, 'disable_view_mode' ] );

		if ( get_option( 'job_manager_enable_categories' ) ) {
			add_action( 'restrict_manage_posts', [ $this, 'jobs_by_category' ] );
		}
		add_action( 'restrict_manage_posts', [ $this, 'jobs_meta_filters' ] );

		foreach ( [ 'post', 'post-new' ] as $hook ) {
			add_action( "admin_footer-{$hook}.php", [ $this, 'extend_submitdiv_post_status' ] );
		}
		add_action( 'admin_head', [ $this, 'inlineCss' ], 10, 0 );
    add_filter( 'fwpj_' . $this->postTypes . '_bulk_actions', [ $this, 'bulkActions' ], 10, 1 );

    add_filter( 'futurewordpress/project/renderpost', [ $this, 'renderPost' ], 10, 2 );

    // add_action( 'pre_get_posts', [ $this, 'search_results' ] );
	}
  
	public function statuses() {
		return [
			'active' => __( 'Active', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
			'inactive' => __( 'Inactive', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
			'draft' => __( 'Draft', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
			'hidden' => __( 'Hidden', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN )
		];
	}
	// Register Custom Post Type
	public function create_job_cpt() {

		$labels = [
			'name'                  => _x( 'Jobs', 'Post Type General Name', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
			'singular_name'         => _x( 'Job', 'Post Type Singular Name', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
			'menu_name'             => _x( 'Jobs', 'Admin Menu text', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
			'name_admin_bar'        => _x( 'Job', 'Add New on Toolbar', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
			'archives'              => __( 'Job Archives', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
			'attributes'            => __( 'Job Attributes', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
			'parent_item_colon'     => __( 'Parent Job:', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
			'all_items'             => __( 'All Jobs', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
			'add_new_item'          => __( 'Add New Job', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
			'add_new'               => __( 'Add New', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
			'new_item'              => __( 'New Job', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
			'edit_item'             => __( 'Edit Job', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
			'update_item'           => __( 'Update Job', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
			'view_item'             => __( 'View Job', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
			'view_items'            => __( 'View Jobs', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
			'search_items'          => __( 'Search Job', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
			'not_found'             => __( 'Not found', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
			'not_found_in_trash'    => __( 'Not found in Trash', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
			'featured_image'        => __( 'Featured Image', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
			'set_featured_image'    => __( 'Set featured image', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
			'remove_featured_image' => __( 'Remove featured image', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
			'use_featured_image'    => __( 'Use as featured image', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
			'insert_into_item'      => __( 'Insert into Job', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
			'uploaded_to_this_item' => __( 'Uploaded to this Job', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
			'items_list'            => __( 'Jobs list', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
			'items_list_navigation' => __( 'Jobs list navigation', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
			'filter_items_list'     => __( 'Filter Jobs list', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
		];
		$args   = [
			'label'               => __( 'Job', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
			'description'         => __( 'The Jobs', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
			'labels'              => $labels,
			'menu_icon'           => FUTUREWORDPRESS_PROJECT_DIR_URI . '/assets/src/icons/man-in-office-desk-with-computer.svg',
			'supports'            => [
				'title',
				// 'editor',
				// 'excerpt',
				// 'thumbnail',
				// 'revisions',
				// 'author',
				// 'comments',
				// 'trackbacks',
				// 'page-attributes',
				// 'custom-fields',
			],
			'taxonomies'          => [],
			'public'              => true,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'menu_position'       => 5,
			'show_in_admin_bar'   => true,
			'show_in_nav_menus'   => true,
			'can_export'          => true,
			'has_archive'         => true,
			'hierarchical'        => false,
			'exclude_from_search' => false,
			'show_in_rest'        => true,
			'publicly_queryable'  => true,
			'capability_type'     => 'post',
		];

		register_post_type( $this->postTypes, $args );

	}
	public function create_company_cpt() {

		$labels = [
			'name'                  => _x( 'Companies', 'Post Type General Name', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
			'singular_name'         => _x( 'Company', 'Post Type Singular Name', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
			'menu_name'             => _x( 'Companies', 'Admin Menu text', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
			'name_admin_bar'        => _x( 'Company', 'Add New on Toolbar', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
			'archives'              => __( 'Company Archives', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
			'attributes'            => __( 'Company Attributes', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
			'parent_item_colon'     => __( 'Parent Company:', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
			'all_items'             => __( 'All Companies', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
			'add_new_item'          => __( 'Add New Company', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
			'add_new'               => __( 'Add New', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
			'new_item'              => __( 'New Company', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
			'edit_item'             => __( 'Edit Company', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
			'update_item'           => __( 'Update Company', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
			'view_item'             => __( 'View Company', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
			'view_items'            => __( 'View Companies', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
			'search_items'          => __( 'Search Company', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
			'not_found'             => __( 'Not found', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
			'not_found_in_trash'    => __( 'Not found in Trash', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
			'featured_image'        => __( 'Featured Image', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
			'set_featured_image'    => __( 'Set featured image', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
			'remove_featured_image' => __( 'Remove featured image', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
			'use_featured_image'    => __( 'Use as featured image', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
			'insert_into_item'      => __( 'Insert into Company', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
			'uploaded_to_this_item' => __( 'Uploaded to this Company', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
			'items_list'            => __( 'Companies list', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
			'items_list_navigation' => __( 'Companies list navigation', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
			'filter_items_list'     => __( 'Filter Companies list', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
		];
		$args   = [
			'label'               => __( 'Company', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
			'description'         => __( 'The Company', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
			'labels'              => $labels,
			'menu_icon'           => FUTUREWORDPRESS_PROJECT_DIR_URI . '/assets/src/icons/mansion.svg',
			'supports'            => [
				'title',
				// 'editor',
				'excerpt',
				'thumbnail',
				// 'revisions',
				// 'author',
				// 'comments',
				// 'trackbacks',
				// 'page-attributes',
				// 'custom-fields',
			],
			'taxonomies'          => [],
			'public'              => true,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'menu_position'       => 5,
			'show_in_admin_bar'   => true,
			'show_in_nav_menus'   => true,
			'can_export'          => true,
			'has_archive'         => true,
			'hierarchical'        => false,
			'exclude_from_search' => false,
			'show_in_rest'        => true,
			'publicly_queryable'  => true,
			'capability_type'     => 'post',
		];

		register_post_type( 'companies', $args );

	}
  public function search_results( $query ) {
    if ( $query->is_main_query() && $query->is_search() && ! is_admin() ) {
      $query->set( 'post_type', [ 'post', 'movies', 'products', 'portfolio', 'job_openings', 'companies' ] ); // any
    }
  }

	public function inlineCss() {
		?>
		<style>
			.widefat td.column-job_position {width: 20%;height: 34px;}
			.widefat td.column-job_position img {width: 32px;height: 32px;position: absolute;right: 7px;top: 0;border-radius: 50%;box-shadow: 0 1px 0 1px rgba(0,0,0,.1);-webkit-box-shadow: 0 1px 0 1px rgba(0,0,0,.1);-moz-box-shadow: 0 1px 0 1px rgba(0,0,0,.1);border: 1px solid #fff;}
			.widefat td.column-job_position .job_position {position: relative;}
			.widefat td.column-job_position .job_position.fwp-pr5{padding-right: 50px;}
			.widefat td.column-job_position a.job_title {font-weight: bold;}
			.widefat td.column-job_position .company {margin-top: .2em;display: block;padding-top: 2px;}
			.column-taxonomy-job_types a {display: inline-grid;background: skyblue;text-align: center;align-items: center;border-radius: 3px;color: #fff;margin-top: 5px;z-index: 1;width: max-content;padding: 3px 10px;}
			.column-taxonomy-job_types a:first-child {margin-top: 0;}
			.widefat th.column-featured_job, .widefat th.column-filled, .widefat th.column-job_status {width: 1em;position: relative;}
			.widefat .column-job_actions .actions .button-icon,.widefat th.column-featured_job span, .widefat th.column-filled span, .widefat th.column-job_status span {display: block;width: 1em;height: 1em;line-height: 1em;padding: 1px 0 0 0;overflow: hidden;}
			.widefat thead tr th.column-taxonomy-job_types {width: 7em;}
			/* .widefat th .tips[data-tip] {position: relative;} */
			.widefat th .tips[data-tip]:hover:after {content: attr( data-tip );height: 15px;width: max-content;padding: 5px 10px;background: #333;color: #fff;border-radius: 3px;position: absolute;top: -15px;right: 0;}
			.widefat .column-job_actions .actions .button-icon {width: 30px;height: 30px;display: inline-grid;margin-left: 2.5px;margin-right: 2.5px;}
			.widefat .column-job_actions .actions .tips[data-tip]:before {margin: auto;margin-left: 7px;margin-right: 20px;line-height: 25px;}
			.widefat th.column-job_status .tips.tips-status:before {content: "\f348";font-family: dashicons;}
			.widefat th.column-featured_job .tips.tips-featured:before {content: "\f155";font-family: dashicons;}
			.widefat th.column-filled .tips.tips-filled:before {content: "\f12e";font-family: dashicons;}

			.widefat td.column-job_status .tips.status-approved:before {content: "\f147";font-family: dashicons;}
			.widefat td.column-job_status .tips.status-pending:before {content: "\f158";font-family: dashicons;}

			.widefat .column-job_actions .actions .tips.icon-view:before {content: "\f504";font-family: dashicons;}
			.widefat .column-job_actions .actions .tips.icon-edit:before {content: "\f464";font-family: dashicons;}
			.widefat .column-job_actions .actions .tips.icon-delete:before {content: "\f182";font-family: dashicons;}

			.type-job_openings .job_status.column-job_status .tips.status-publish:before {font-family: dashicons;margin-right: 20px;align-items: center;text-align: center;font-size: 25px;margin-top: 5px;}
			.type-job_openings .job_status.column-job_status .tips.status-publish {display: flex;overflow: hidden;height: 25px;width: 25px;}
			.type-job_openings .job_status.column-job_status .tips.status-publish:before {content: "\f147";}
			.type-job_openings .job_status.column-job_status .tips.status-pending:before, .type-job_openings .job_status.column-job_status .tips.status-draft:before, .type-job_openings .job_status.column-job_status .tips.status-trash:before, .type-job_openings .job_status.column-job_status .tips.status-expired:before {content: "\f182";}
		</style>
		<?php
	}
	
	/**
	 * Returns the list of bulk actions that can be performed on job listings.
	 *
	 * @return array
	 */
	public function get_bulk_actions() {
		$actions_handled                         = [];
		$actions_handled['approve_jobs']         = [
			// translators: Placeholder (%s) is the plural name of the job listings post type.
			'label'   => __( 'Approve %s', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
			// translators: Placeholder (%s) is the plural name of the job listings post type.
			'notice'  => __( '%s approved', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
			'handler' => [ $this, 'bulk_action_handle_approve_job' ],
		];
		$actions_handled['expired']          = [
			// translators: Placeholder (%s) is the plural name of the job listings post type.
			'label'   => __( 'Expire %s', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
			// translators: Placeholder (%s) is the plural name of the job listings post type.
			'notice'  => __( '%s expired', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
			'handler' => [ $this, 'bulk_action_handle_expire_job' ],
		];
		$actions_handled['mark_jobs_filled']     = [
			// translators: Placeholder (%s) is the plural name of the job listings post type.
			'label'   => __( 'Mark %s Filled', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
			// translators: Placeholder (%s) is the plural name of the job listings post type.
			'notice'  => __( '%s marked as filled', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
			'handler' => [ $this, 'bulk_action_handle_mark_job_filled' ],
		];
		$actions_handled['mark_jobs_not_filled'] = [
			// translators: Placeholder (%s) is the plural name of the job listings post type.
			'label'   => __( 'Mark %s Not Filled', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
			// translators: Placeholder (%s) is the plural name of the job listings post type.
			'notice'  => __( '%s marked as not filled', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
			'handler' => [ $this, 'bulk_action_handle_mark_job_not_filled' ],
		];

		/**
		 * Filters the bulk actions that can be applied to job listings.
		 *
		 * @since 1.27.0
		 *
		 * @param array $actions_handled {
		 *     Bulk actions that can be handled, indexed by a unique key name (approve_jobs, expired, etc). Handlers
		 *     are responsible for checking abilities (`current_user_can( 'manage_' . $this->postTypes . 's', $post_id )`) before
		 *     performing action.
		 *
		 *     @type string   $label   Label for the bulk actions dropdown. Passed through sprintf with label name of job listing post type.
		 *     @type string   $notice  Success notice shown after performing the action. Passed through sprintf with title(s) of affected job listings.
		 *     @type callback $handler Callable handler for performing action. Passed one argument (int $post_id) and should return true on success and false on failure.
		 * }
		 */
		return apply_filters( 'fwpj_' . $this->postTypes . '_bulk_actions', $actions_handled );
	}
  public function bulkActions( $actions_handled ) {
    return $actions_handled;
  }

	/**
	 * Adds bulk actions to drop downs on Job Listing admin page.
	 *
	 * @param array $bulk_actions
	 * @return array
	 */
	public function add_bulk_actions( $bulk_actions ) {
		global $wp_post_types;
		foreach ( $this->get_bulk_actions() as $key => $bulk_action ) {
			if ( isset( $bulk_action['label'] ) ) {
				$bulk_actions[ $key ] = sprintf( $bulk_action['label'], $wp_post_types[ $this->postTypes ]->labels->name );
			}
		}
		return $bulk_actions;
	}

	/**
	 * Performs bulk actions on Job Listing admin page.
	 *
	 * @since 1.27.0
	 *
	 * @param string $redirect_url The redirect URL.
	 * @param string $action       The action being taken.
	 * @param array  $post_ids     The posts to take the action on.
	 *
	 * @return string $redirect_url The redirect URL.
	 */
	public function do_bulk_actions( $redirect_url, $action, $post_ids ) {
		$actions_handled = $this->get_bulk_actions();
		if ( isset( $actions_handled[ $action ] ) && isset( $actions_handled[ $action ]['handler'] ) ) {
			$handled_jobs = [];
			if ( ! empty( $post_ids ) ) {
				foreach ( $post_ids as $post_id ) {
					if (
						$this->postTypes === get_post_type( $post_id )
						&& call_user_func( $actions_handled[ $action ]['handler'], $post_id )
					) {
						$handled_jobs[] = $post_id;
					}
				}
				wp_safe_redirect( add_query_arg( 'handled_jobs', $handled_jobs, add_query_arg( 'action_performed', $action, $redirect_url ) ) );
				exit;
			}
		}

		return $redirect_url;
	}

	/**
	 * Performs bulk action to approve a single job listing.
	 *
	 * @param int $post_id Post ID.
	 *
	 * @return bool
	 */
	public function bulk_action_handle_approve_job( $post_id ) {
		$job_data = [
			'ID'          => $post_id,
			'post_status' => 'publish',
		];
		if( in_array( get_post_status( $post_id ), $this->post_statuses, true ) && wp_update_post( $job_data ) ) {// && current_user_can( 'publish_post', $post_id )
			return true;
		} else {
      return false;
    }
	}

	/**
	 * Performs bulk action to expire a single job listing.
	 *
	 * @param int $post_id Post ID.
	 * @return bool
	 */
	public function bulk_action_handle_expire_job( $post_id ) {
		$job_data = [
			'ID'          => $post_id,
			'post_status' => 'expired',
		];
		if( wp_update_post( $job_data ) ) { // current_user_can( 'manage_' . FUTUREWORDPRESS_PROJECT_CPT_JOB_OPENINGS, $post_id ) && 
			return true;
		} else {
			return false;
    }
	}
	/**
	 * Performs bulk action to mark a single job listing as filled.
	 *
	 * @param int $post_id Post ID.
	 *
	 * @return bool
	 */
	public function bulk_action_handle_mark_job_filled( $post_id ) {
		if( update_post_meta( $post_id, 'fwp_jobs-positionfilled', 'on' ) ) {// current_user_can( 'manage_' . FUTUREWORDPRESS_PROJECT_CPT_JOB_OPENINGS, $post_id ) && 
			return true;
		} else {
      return false;
    }
	}

	/**
	 * Performs bulk action to mark a single job listing as not filled.
	 *
	 * @param int $post_id Post ID.
	 * @return bool
	 */
	public function bulk_action_handle_mark_job_not_filled( $post_id ) {
		if( update_post_meta( $post_id, 'fwp_jobs-positionfilled', 0 ) ) {// current_user_can( 'manage_' . FUTUREWORDPRESS_PROJECT_CPT_JOB_OPENINGS, $post_id ) && 
			return true;
		} else {
      return false;
    }
	}

  /**
	 * Approves a single job.
	 */
	public function approve_job() {
		if (
			! empty( $_GET['approve_job'] )
			&& ! empty( $_REQUEST['_wpnonce'] )
			&& wp_verify_nonce( wp_unslash( $_REQUEST['_wpnonce'] ), 'approve_job' ) // phpcs:ignore WordPress.Security.ValidatedSanitizedInput.InputNotSanitized -- Nonce should not be modified.
			&& current_user_can( 'publish_post', absint( $_GET['approve_job'] ) )
		) {
			$post_id  = absint( $_GET['approve_job'] );
			$job_data = [
				'ID'          => $post_id,
				'post_status' => 'publish',
			];
			wp_update_post( $job_data );
			wp_safe_redirect( remove_query_arg( 'approve_job', add_query_arg( 'handled_jobs', $post_id, add_query_arg( 'action_performed', 'approve_jobs', admin_url( 'edit.php?post_type=' . $this->postTypes ) ) ) ) );
			exit;
		}
	}

	/**
	 * Shows a notice if we did a bulk action.
	 */
	public function action_notices() {
		global $post_type, $pagenow;

		// phpcs:disable WordPress.Security.NonceVerification.Recommended -- Input is used safely.
		$handled_jobs    = isset( $_REQUEST['handled_jobs'] ) && is_array( $_REQUEST['handled_jobs'] ) ? array_map( 'absint', $_REQUEST['handled_jobs'] ) : false;
		$action          = isset( $_REQUEST['action_performed'] ) ? sanitize_text_field( wp_unslash( $_REQUEST['action_performed'] ) ) : false;
		$actions_handled = $this->get_bulk_actions();
		// phpcs:enable WordPress.Security.NonceVerification.Recommended

		if (
			'edit.php' === $pagenow
			&& $this->postTypes === $post_type
			&& $action
			&& ! empty( $handled_jobs )
			&& isset( $actions_handled[ $action ] )
			&& isset( $actions_handled[ $action ]['notice'] )
		) {
			if ( is_array( $handled_jobs ) ) {
				$titles = [];
				foreach ( $handled_jobs as $job_id ) {
					$titles[] = get_the_title( $job_id );
				}
				echo '<div class="updated"><p>' . wp_kses_post( sprintf( $actions_handled[ $action ]['notice'], '&quot;' . implode( '&quot;, &quot;', $titles ) . '&quot;' ) ) . '</p></div>';
			} else {
				echo '<div class="updated"><p>' . wp_kses_post( sprintf( $actions_handled[ $action ]['notice'], '&quot;' . get_the_title( absint( $handled_jobs ) ) . '&quot;' ) ) . '</p></div>';
			}
		}
	}

	/**
	 * Shows category dropdown.
	 */
	public function jobs_by_category() {
		global $typenow, $wp_query;

		if ( $this->postTypes !== $typenow || ! taxonomy_exists( $this->postTypes . '_category' ) ) {
			return;
		}

		include_once JOB_MANAGER_PLUGIN_DIR . '/includes/class-fwp-ajo-category-walker.php';

		$r                 = [];
		$r['taxonomy']     = $this->postTypes . '_category';
		$r['pad_counts']   = 1;
		$r['hierarchical'] = 1;
		$r['hide_empty']   = 0;
		$r['show_count']   = 1;
		$r['selected']     = ( isset( $wp_query->query[$this->postTypes . '_category'] ) ) ? $wp_query->query[$this->postTypes . '_category'] : '';
		$r['menu_order']   = false;
		$terms             = get_terms( $r );
		$walker            = new WP_Job_Manager_Category_Walker();

		if ( ! $terms ) {
			return;
		}

		$allowed_html = [
			'option' => [
				'value'    => [],
				'selected' => [],
				'class'    => [],
			],
		];

		// phpcs:ignore WordPress.Security.NonceVerification.Recommended -- No changes or data exposed based on input.
		$selected_category = isset( $_GET[$this->postTypes . '_category'] ) ? sanitize_text_field( wp_unslash( $_GET[$this->postTypes . '_category'] ) ) : '';
		echo "<select name= ' . $this->postTypes . '_category' id='dropdown_job_listing_category'>";
		echo '<option value="" ' . selected( $selected_category, '', false ) . '>' . esc_html__( 'Select category', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ) . '</option>';
		echo wp_kses( $walker->walk( $terms, 0, $r ), $allowed_html );
		echo '</select>';

	}

	/**
	 * Output dropdowns for filters based on post meta.
	 *
	 * @since 1.31.0
	 */
	public function jobs_meta_filters() {
		global $typenow;

		if ( $this->postTypes !== $typenow ) {
			return;
		}

		// Filter by Filled.
		$this->jobs_filter_dropdown(
			'_filled',
			[
				[
					'value' => '',
					'text'  => __( 'Select Filled', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
				],
				[
					'value' => '1',
					'text'  => __( 'Filled', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
				],
				[
					'value' => '0',
					'text'  => __( 'Not Filled', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
				],
			]
		);

		// Filter by Featured.
		$this->jobs_filter_dropdown(
			'_featured',
			[
				[
					'value' => '',
					'text'  => __( 'Select Featured', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
				],
				[
					'value' => '1',
					'text'  => __( 'Featured', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
				],
				[
					'value' => '0',
					'text'  => __( 'Not Featured', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
				],
			]
		);
	}

	/**
	 * Shows dropdown to filter by the given URL parameter. The dropdown will
	 * have three options: "Select $name", "$name", and "Not $name".
	 *
	 * The $options element should be an array of arrays, each with the
	 * attributes needed to create an <option> HTML element. The attributes are
	 * as follows:
	 *
	 * $options[i]['value']  The value for the <option> HTML element.
	 * $options[i]['text']   The text for the <option> HTML element.
	 *
	 * @since 1.31.0
	 *
	 * @param string $param        The URL parameter.
	 * @param array  $options      The options for the dropdown. See the description above.
	 */
	private function jobs_filter_dropdown( $param, $options ) {
		// phpcs:ignore WordPress.Security.NonceVerification.Recommended -- No changes or data exposed based on input.
		$selected = isset( $_GET[ $param ] ) ? sanitize_text_field( wp_unslash( $_GET[ $param ] ) ) : '';

		echo '<select name="' . esc_attr( $param ) . '" id="dropdown_' . esc_attr( $param ) . '">';

		foreach ( $options as $option ) {
			echo '<option value="' . esc_attr( $option['value'] ) . '"'
				. ( $selected === $option['value'] ? ' selected' : '' )
				. '>' . esc_html( $option['text'] ) . '</option>';
		}
		echo '</select>';

	}

	/**
	 * Filters page title placeholder text to show custom label.
	 *
	 * @param string      $text
	 * @param WP_Post|int $post
	 * @return string
	 */
	public function enter_title_here( $text, $post ) {
		if ( $this->postTypes === $post->post_type ) {
			return esc_html__( 'Job Position', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN );
		} elseif ( 'companies' === $post->post_type ) {
      return esc_html__( 'Company Name', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN );
    } else {
      return $text;
    }
	}

	/**
	 * Filters the post updated message array to add custom post type's messages.
	 *
	 * @param array $messages
	 * @return array
	 */
	public function post_updated_messages( $messages ) {
		global $post, $post_ID, $wp_post_types;

		// phpcs:ignore WordPress.Security.NonceVerification.Recommended -- No changes based on input.
		$revision_title = isset( $_GET['revision'] ) ? wp_post_revision_title( (int) $_GET['revision'], false ) : false;

		$messages[ $this->postTypes ] = [
			0  => '',
			// translators: %1$s is the singular name of the job listing post type; %2$s is the URL to view the listing.
			1  => sprintf( __( '%1$s updated. <a href="%2$s">View</a>', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ), $wp_post_types[ $this->postTypes ]->labels->singular_name, esc_url( get_permalink( $post_ID ) ) ),
			2  => __( 'Custom field updated.', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
			3  => __( 'Custom field deleted.', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
			// translators: %s is the singular name of the job listing post type.
			4  => sprintf( esc_html__( '%s updated.', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ), $wp_post_types[ $this->postTypes ]->labels->singular_name ),
			// translators: %1$s is the singular name of the job listing post type; %2$s is the revision number.
			5  => $revision_title ? sprintf( __( '%1$s restored to revision from %2$s', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ), $wp_post_types[ $this->postTypes ]->labels->singular_name, $revision_title ) : false,
			// translators: %1$s is the singular name of the job listing post type; %2$s is the URL to view the listing.
			6  => sprintf( __( '%1$s published. <a href="%2$s">View</a>', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ), $wp_post_types[ $this->postTypes ]->labels->singular_name, esc_url( get_permalink( $post_ID ) ) ),
			// translators: %1$s is the singular name of the job listing post type; %2$s is the URL to view the listing.
			7  => sprintf( esc_html__( '%s saved.', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ), $wp_post_types[ $this->postTypes ]->labels->singular_name ),
			// translators: %1$s is the singular name of the job listing post type; %2$s is the URL to preview the listing.
			8  => sprintf( __( '%1$s submitted. <a target="_blank" href="%2$s">Preview</a>', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ), $wp_post_types[ $this->postTypes ]->labels->singular_name, esc_url( add_query_arg( 'preview', 'true', get_permalink( $post_ID ) ) ) ),
			9  => sprintf(
				// translators: %1$s is the singular name of the post type; %2$s is the date the post will be published; %3$s is the URL to preview the listing.
				__( '%1$s scheduled for: <strong>%2$s</strong>. <a target="_blank" href="%3$s">Preview</a>', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
				$wp_post_types[ $this->postTypes ]->labels->singular_name,
				wp_date( get_option( 'date_format' ) . ' @ ' . get_option( 'time_format' ), get_post_timestamp() ),
				esc_url( get_permalink( $post_ID ) )
			),
			// translators: %1$s is the singular name of the job listing post type; %2$s is the URL to view the listing.
			10 => sprintf( __( '%1$s draft updated. <a target="_blank" href="%2$s">Preview</a>', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ), $wp_post_types[ $this->postTypes ]->labels->singular_name, esc_url( add_query_arg( 'preview', 'true', get_permalink( $post_ID ) ) ) ),
		];

		return $messages;
	}

	/**
	 * Adds columns to admin listing of Job Listings.
	 *
	 * @param array $columns
	 * @return array
	 */
	public function columns( $columns ) {
		$newColumns = [];
		if ( ! is_array( $columns ) ) {$columns = [];}
		// unset( $columns['title'], $columns['date'], $columns['author'] );
		if( isset( $columns[ 'cb' ] ) ) {
			$newColumns[ 'cb' ] = $columns[ 'cb' ];
		}
		$newColumns['job_position']         = __( 'Position', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN );

		if( isset( $columns[ 'taxonomy-job_types' ] ) ) {
			$newColumns[ 'taxonomy-job_types' ] = __( 'Type', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN );
		} else {
			$newColumns[ $this->postTypes . '_type']     = __( 'Type', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN );
		}
		if( isset( $columns[ 'taxonomy-job_categories' ] ) ) {
			$newColumns[ 'taxonomy-job_categories' ] = __( 'Categories', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN );
		}

		$newColumns['job_location']         = __( 'Location', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN );
		$newColumns['job_status']           = '<span class="tips tips-status" data-tip="' . __( 'Status', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ) . '">' . __( 'Status', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ) . '</span>';
		$newColumns['job_posted']           = __( 'Posted', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN );
		$newColumns['job_expires']          = __( 'Expires', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN );
		$newColumns[ $this->postTypes . '_category'] = __( 'Categories', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN );
		$newColumns['featured_job']         = '<span class="tips tips-featured" data-tip="' . __( 'Featured?', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ) . '">' . __( 'Featured?', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ) . '</span>';
		$newColumns['filled']               = '<span class="tips tips-filled" data-tip="' . __( 'Filled?', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ) . '">' . __( 'Filled?', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ) . '</span>';
		$newColumns['job_actions']          = __( 'Actions', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN );

		if ( ! get_option( 'job_manager_enable_categories' ) ) {
			unset( $newColumns[ $this->postTypes . '_category'] );
		}

		if ( ! get_option( 'job_manager_enable_types' ) ) {
			unset( $newColumns[ $this->postTypes . '_type'] );
		}

		return $newColumns;
	}

	/**
	 * This is required to make column responsive since WP 4.3
	 *
	 * @access public
	 * @param string $column
	 * @param string $screen
	 * @return string
	 */
	public function primary_column( $column, $screen ) {
		if ( 'edit-' . $this->postTypes === $screen ) {
			$column = 'job_position';
		}
		return $column;
	}

	/**
	 * Removes all action links because WordPress add it to primary column.
	 * Note: Removing all actions also remove mobile "Show more details" toggle button.
	 * So the button need to be added manually in custom_columns callback for primary column.
	 *
	 * @access public
	 * @param array $actions
	 * @return array
	 */
	public function row_actions( $actions ) {
		if ( $this->postTypes === get_post_type() ) {
			return [];
		}
		return $actions;
	}

	/**
	 * Displays the content for each custom column on the admin list for Job Listings.
	 *
	 * @param mixed $column
	 */
	public function custom_columns( $column ) {
		global $post;

		switch ( $column ) {
			case $this->postTypes . '_type':
				$types = wpjm_get_the_job_types( $post );

				if ( $types && ! empty( $types ) ) {
					foreach ( $types as $type ) {
						echo '<span class="job-type ' . esc_attr( $type->slug ) . '">' . esc_html( $type->name ) . '</span>';
					}
				}
				break;
			case 'job_position':
				$companyLogo = $this->get_post_meta( $post->ID, 'company-logo' );
				echo '<div class="job_position ' . ( ( $companyLogo ) ? 'fwp-pr5' : '' ) . '">';
				// translators: %d is the post ID for the job listing.
				echo '<a href="' . esc_url( admin_url( 'post.php?post=' . $post->ID . '&action=edit' ) ) . '" class="tips job_title" data-tip="' . sprintf( esc_html__( 'ID: %d', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ), intval( $post->ID ) ) . '">' . wp_kses_post( get_the_title() ) . '</a>';

				echo '<div class="company">';

				if ( $this->get_post_meta( $post->ID, 'company-website' ) ) {
					the_title( '<span class="tips" data-tip="' . esc_attr( $this->get_post_meta( $post->ID, 'company-tag-line' ) ) . '"><a href="' . esc_url( $this->get_post_meta( $post->ID, 'company-website' ) ) . '">', '</a></span>' );
				} else {
					the_title( '<span class="tips" data-tip="' . esc_attr( $this->get_post_meta( $post->ID, 'company-tag-line' ) ) . '">', '</span>' );
				}

				echo '</div>';
				if( $companyLogo ) {
					echo '<img src="' . esc_url( $companyLogo ) . '" alt="">';
				}
				echo '</div>';
				echo '<button type="button" class="toggle-row"><span class="screen-reader-text">' . esc_html__( 'Show more details', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ) . '</span></button>';
				break;
			case 'job_location':
				echo esc_html( $this->get_post_meta( $post->ID, 'jobs-location' ) );
				break;
			case $this->postTypes . '_category':
				$terms = get_the_term_list( $post->ID, $column, '', ', ', '' );
				if ( ! $terms ) {
					echo '<span class="na">&ndash;</span>';
				} else {
					echo wp_kses_post( $terms );
				}
				break;
			case 'filled':
				if ( $this->get_post_meta( $post->ID, 'jobs-positionfilled' ) ) {
					echo '&#10004;';
				} else {
					echo '&ndash;';
				}
				break;
			case 'featured_job':
				if ( $this->get_post_meta( $post->ID, 'jobs-featuredlisting' ) ) {
					echo '&#10004;';
				} else {
					echo '&ndash;';
				}
				break;
			case 'job_posted':
				echo '<strong>' . esc_html( wp_date( get_option( 'date_format' ), get_post_timestamp() ) ) . '</strong><span>';
				// translators: %s placeholder is the username of the user.
				echo ( empty( $post->post_author ) ? esc_html__( 'by a guest', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ) : sprintf( esc_html__( 'by %s', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ), '<a href="' . esc_url( add_query_arg( 'author', $post->post_author ) ) . '">' . esc_html( get_the_author() ) . '</a>' ) ) . '</span>';
				break;
			case 'job_expires':
				$job_expiration = $this->expiration( $post, 'getTimestamp' );
				if ( $job_expiration ) {
					echo '<strong>' . esc_html( $job_expiration ) . '</strong>';
				} else {
					echo '&ndash;';
				}
				break;
			case 'job_status':
				$jobVisibility = ( $this->job_status( $post ) ) ? __( 'Active', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ) : __( 'Inactive', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN );
				echo '<span data-tip="' . esc_attr( $jobVisibility ) . '" class="tips status-' . esc_attr( $post->post_status ) . '">' . esc_html( $jobVisibility ) . '</span>';
				break;
			case 'job_actions':
				echo '<div class="actions">';
				$admin_actions = apply_filters( 'post_row_actions', [], $post );

				if ( in_array( $post->post_status, [ 'pending', 'pending_payment' ], true ) && current_user_can( 'publish_post', $post->ID ) ) {
					$admin_actions['approve'] = [
						'action' => 'approve',
						'name'   => __( 'Approve', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
						'url'    => wp_nonce_url( add_query_arg( 'approve_job', $post->ID ), 'approve_job' ),
					];
				}
				if ( 'trash' !== $post->post_status ) {
					if ( current_user_can( 'read_post', $post->ID ) ) {
						$admin_actions['view'] = [
							'action' => 'view',
							'name'   => __( 'View', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
							'url'    => get_permalink( $post->ID ),
						];
					}
					if ( current_user_can( 'edit_post', $post->ID ) ) {
						$admin_actions['edit'] = [
							'action' => 'edit',
							'name'   => __( 'Edit', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
							'url'    => get_edit_post_link( $post->ID ),
						];
					}
					if ( current_user_can( 'delete_post', $post->ID ) ) {
						$admin_actions['delete'] = [
							'action' => 'delete',
							'name'   => __( 'Delete', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
							'url'    => get_delete_post_link( $post->ID ),
						];
					}
				}

				$admin_actions = apply_filters( 'fwpajo_admin_actions', $admin_actions, $post );

				foreach ( $admin_actions as $action ) {
					if ( is_array( $action ) ) {
						printf( '<a class="button button-icon tips icon-%1$s" href="%2$s" data-tip="%3$s">%4$s</a>', esc_attr( $action['action'] ), esc_url( $action['url'] ), esc_attr( $action['name'] ), esc_html( $action['name'] ) );
					} else {
						echo wp_kses_post( str_replace( 'class="', 'class="button ', $action ) );
					}
				}

				echo '</div>';

				break;
		}
	}

	/**
	 * Filters the list table sortable columns for the admin list of Job Listings.
	 *
	 * @param mixed $columns
	 * @return array
	 */
	public function sortable_columns( $columns ) {
		$custom = [
			'job_posted'   => 'date',
			'job_position' => 'title',
			'job_location' => 'job_location',
			'job_expires'  => 'job_expires',
		];
		return wp_parse_args( $custom, $columns );
	}

	/**
	 * Sorts the admin listing of Job Listings by updating the main query in the request.
	 *
	 * @param mixed $vars Variables with sort arguments.
	 * @return array
	 */
	public function sort_columns( $vars ) {
		if ( isset( $vars['orderby'] ) ) {
			if ( 'job_expires' === $vars['orderby'] ) {
				$vars = array_merge(
					$vars,
					[
						'meta_key' => '_job_expires',
						'orderby'  => 'meta_value',
					]
				);
			} elseif ( 'job_location' === $vars['orderby'] ) {
				$vars = array_merge(
					$vars,
					[
						'meta_key' => '_job_location',
						'orderby'  => 'meta_value',
					]
				);
			}
		}
		return $vars;
	}

	/**
	 * Searches custom fields as well as content.
	 *
	 * @param WP_Query $wp
	 */
	public function search_meta( $wp ) {
		global $pagenow, $wpdb;

		if ( 'edit.php' !== $pagenow || empty( $wp->query_vars['s'] ) || $this->postTypes !== $wp->query_vars['post_type'] ) {
			return;
		}

		$post_ids = array_unique(
			array_merge(
				// phpcs:ignore WordPress.DB.DirectDatabaseQuery.DirectQuery, WordPress.DB.DirectDatabaseQuery.NoCaching -- WP_Query doesn't allow for meta query to be an optional match.
				$wpdb->get_col(
					$wpdb->prepare(
						"SELECT posts.ID
						FROM {$wpdb->posts} posts
						WHERE (
							posts.ID IN (
								SELECT post_id
								FROM {$wpdb->postmeta}
								WHERE meta_value LIKE %s
							)
							OR posts.post_title LIKE %s
							OR posts.post_content LIKE %s
						)
						AND posts.post_type = $this->postTypes . ",
						'%' . $wpdb->esc_like( $wp->query_vars['s'] ) . '%',
						'%' . $wpdb->esc_like( $wp->query_vars['s'] ) . '%',
						'%' . $wpdb->esc_like( $wp->query_vars['s'] ) . '%'
					)
				),
				[ 0 ]
			)
		);

		// Adjust the query vars.
		unset( $wp->query_vars['s'] );
		$wp->query_vars[ $this->postTypes . '_search'] = true;
		$wp->query_vars['post__in']           = $post_ids;
	}

	/**
	 * Filters by meta fields.
	 *
	 * @param WP_Query $wp
	 */
	public function filter_meta( $wp ) {
		global $pagenow;

		if ( 'edit.php' !== $pagenow || empty( $wp->query_vars['post_type'] ) || $this->postTypes !== $wp->query_vars['post_type'] ) {
			return;
		}

		// phpcs:disable WordPress.Security.NonceVerification.Recommended -- Input is used safely.
		$_isFilled   = isset( $_GET[ '_filled'] ) && '' !== $_GET[ '_filled'] ? absint( $_GET[ '_filled'] ) : false;
		$_isFeatured = isset( $_GET[ '_featured'] ) && '' !== $_GET[ '_featured'] ? absint( $_GET[ '_featured'] ) : false;
		// phpcs:enable WordPress.Security.NonceVerification.Recommended

		$meta_query = $wp->get( 'meta_query' );
		if ( ! is_array( $meta_query ) ) {
			$meta_query = [];
		}

		// Filter on _filled meta.
		if ( false !== $_isFilled ) {
			$meta_query[] = [
				'key'   => 'fwp_jobs-positionfilled',
				'value' => ( $_isFilled == 1 ) ? 'on' : '',
			];
		}

		// Filter on _featured meta.
		if ( false !== $_isFeatured ) {
			$meta_query[] = [
				'key'   => 'fwp_jobs-featuredlisting',
				'value' => ( $_isFeatured == 1 ) ? 'on' : '',
			];
		}

		// Set new meta query.
		if ( ! empty( $meta_query ) ) {
			$wp->set( 'meta_query', $meta_query );
		}
	}

	/**
	 * Changes the label when searching meta.
	 *
	 * @param string $query
	 * @return string
	 */
	public function search_meta_label( $query ) {
		global $pagenow, $typenow;

		// phpcs:ignore WordPress.Security.NonceVerification.Recommended -- Input is used safely.
		if ( 'edit.php' !== $pagenow || $this->postTypes !== $typenow || ! get_query_var( $this->postTypes . '_search' ) || ! isset( $_GET['s'] ) ) {
			return $query;
		}

		// phpcs:ignore WordPress.Security.NonceVerification.Recommended -- Input is used safely.
		return sanitize_text_field( wp_unslash( $_GET['s'] ) );
	}

	/**
	 * Adds post status to the "submitdiv" Meta Box and post type WP List Table screens. Based on https://gist.github.com/franz-josef-kaiser/2930190
	 */
	public function extend_submitdiv_post_status() {
		global $post, $post_type;

		// Abort if we're on the wrong post type, but only if we got a restriction.
		if ( $this->postTypes !== $post_type ) {
			return;
		}

		// Get all non-builtin post status and add them as <option>.
		$options = '';
		$display = '';
		foreach ( $this->post_statuses as $status => $name ) {
			$selected = selected( $post->post_status, $status, false );

			// If we one of our custom post status is selected, remember it.
			if ( $selected ) {
				$display = $name;
			}

			// Build the options.
			$options .= "<option{$selected} value='{$status}'>" . esc_html( $name ) . '</option>';
		}
		?>
		<script type="text/javascript">
			jQuery( document ).ready( function($) {
				<?php if ( ! empty( $display ) ) : ?>
					jQuery( '#post-status-display' ).html( decodeURIComponent( '<?php echo rawurlencode( (string) wp_specialchars_decode( $display ) ); ?>' ) );
				<?php endif; ?>

				var select = jQuery( '#post-status-select' ).find( 'select' );
				jQuery( select ).html( decodeURIComponent( '<?php echo rawurlencode( (string) wp_specialchars_decode( $options ) ); ?>' ) );
			} );
		</script>
		<?php
	}
	public function disable_view_mode( $post_types ) {
		unset( $post_types[ $this->postTypes ] );
		return $post_types;
	}
	private function expiration( $onPost, $time = false ) {
		if( $time == 'getTimestamp' ) {
			return wp_date( get_option( 'date_format' ), strtotime( get_post_meta( $onPost->ID, 'fwp_jobs-closingdate', true ) ) );
		}
	}
	private function job_status( $onPost ) {
		$status = $onPost->post_status;
		if( $status && $status == 'publish' ) {
			return true;
		} else {
			return false;
		}
	}
	private function get_post_meta( $post_id, $singleMeta = false ) {
		if( ! isset( $this->meta[ 'post-' . $post_id ] ) ) {
			$meta = get_post_meta( $post_id, false, true );
			foreach( $meta as $key => $value ) {
				if( is_array( $value ) && isset( $value[0] ) ) {
					$meta[ $key ] = $value[0];
				}
			}
			$this->meta[ 'post-' . $post_id ] = $meta;
		}
		if( $singleMeta ) {
			return isset( $this->meta[ 'post-' . $post_id ][ 'fwp_' . $singleMeta ] ) ? $this->meta[ 'post-' . $post_id ][ 'fwp_' . $singleMeta ] : false;
		} else {
			return $this->meta[ 'post-' . $post_id ];
		}
	}
  public function renderPost( $default, $post ) {
    $args = [ 'post' => $post, 'meta' => [], 'terms' => [], 'types' => [], 'categories' => [] ];$newMeta = [ 'company' => [], 'jobs' => [] ];
    foreach( $this->get_post_meta( $post->ID ) as $key => $value ) {
      if( substr( $key, 0, 4 ) == 'fwp_' ) {
        $key = str_replace( [ 'fwp_' ], [ '' ], $key );
        if( substr( $key, 0, 8 ) == 'company-' ) {
        $key = str_replace( [ 'company-' ], [ '' ], $key );
          $newMeta[ 'company' ][ $key ] = $value;
        } else if( substr( $key, 0, 5 ) == 'jobs-' ) {
        $key = str_replace( [ 'jobs-' ], [ '' ], $key );
          $newMeta[ 'jobs' ][ $key ] = $value;
        } else {
          $newMeta[ $key ] = $value;
        }
      }
    }
		if( isset( $newMeta[ 'jobs' ][ 'company' ] ) && ! empty( $newMeta[ 'jobs' ][ 'company' ] ) ) {
			$getCompany = get_post( $newMeta[ 'jobs' ][ 'company' ] );
			if( $getCompany->post_status == 'publish' ) {
				foreach( $this->get_post_meta( $newMeta[ 'jobs' ][ 'company' ] ) as $key => $value ) {
					if( substr( $key, 0, 12 ) == 'fwp_company-' ) {
						$key = str_replace( [ 'fwp_company-' ], [ '' ], $key );
						$newMeta[ 'company' ][ $key ] = $value;
					}
				}
				$newMeta[ 'company' ][ 'title' ] = $getCompany->post_title; // get_the_title( $getCompany );
				$newMeta[ 'company' ][ 'url' ] = get_the_permalink( $getCompany );
			}
		}
		if( isset( $newMeta[ 'jobs' ][ 'closingdate' ] ) && ! empty( $newMeta[ 'jobs' ][ 'closingdate' ] ) ) {
			$diff = ( strtotime( $newMeta[ 'jobs' ][ 'closingdate' ] ) - time() );$diff = round( $diff / 86400 );
			$newMeta[ 'jobs' ][ 'fromtoday' ] = $diff;
			$newMeta[ 'jobs' ][ 'is_expired' ] = ( $diff < 0 );
		}
    if( isset( $post->post_status ) && isset( $newMeta[ 'jobs' ][ 'positionfilled' ] ) ) {
      $newMeta[ 'jobs' ][ '_status' ] = ( $post->post_status == 'publish' ) ? (
        ( ! $newMeta[ 'jobs' ][ 'positionfilled' ] ) ? (
          ( ! isset( $newMeta[ 'jobs' ][ 'is_expired' ] ) || ! $newMeta[ 'jobs' ][ 'is_expired' ] ) ? true : false
        ) : false
      ) : false;
      $newMeta[ 'jobs' ][ '_statusText' ] = ( $newMeta[ 'jobs' ][ '_status' ] ) ? __( 'Active', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ) : ( ( isset( $newMeta[ 'jobs' ][ 'is_expired' ] ) && $newMeta[ 'jobs' ][ 'is_expired' ] ) ? __( 'Expired', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ) : __( 'Inactive', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ) );
    }
    $terms = wp_get_post_terms( $post->ID, 'job_types', [ 'fields' => 'names' ] );if( ! $terms ) {$terms = [];}$args[ 'terms' ] = $terms;$args[ 'types' ] = $terms;
    $categories = wp_get_post_terms( $post->ID, 'job_categories', [ 'fields' => 'names' ] );if( ! $categories ) {$categories = [];}$args[ 'categories' ] = $categories;
    $locations = wp_get_post_terms( $post->ID, 'job_locations', [ 'fields' => 'names' ] );if( ! $locations ) {$locations = [];}$args[ 'locations' ] = $locations;
    $args[ 'meta' ] = $newMeta;
    return $args;
  }
}
