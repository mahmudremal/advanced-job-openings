<?php
/**
 * Blocks
 *
 * @package Aquila
 */

namespace FUTUREWORDPRESS_PROJECT\Inc;

use FUTUREWORDPRESS_PROJECT\Inc\Traits\Singleton;

class Dashboard {
	use Singleton;

	protected function __construct() {
    $this->setup_hooks();
	}
	protected function setup_hooks() {
		add_action( 'init', [ $this, 'init' ], 10, 0 );

    
    add_action( 'futurewordpress/project/job/dashboard/title', [ $this, 'titleArea' ], 1, 1 );
    add_action( 'futurewordpress/project/job/dashboard/content', [ $this, 'contentArea' ], 1, 1 );
    add_action( 'futurewordpress/project/job/dashboard/sidebar/list', [ $this, 'sideBarList' ], 1, 1 );
    add_filter( 'futurewordpress/project/job/dashboard/sidebar/menus', [ $this, 'sideBarMenus' ], 10, 1 );

    add_action( 'futurewordpress/project/job/dashboard/content/home', [ $this, 'dashboardHome' ], 1, 1 );
    add_action( 'futurewordpress/project/job/dashboard/content/profile', [ $this, 'dashboardProfile' ], 1, 1 );
    add_action( 'futurewordpress/project/job/dashboard/content/post', [ $this, 'dashboardPostJob' ], 1, 1 );
    add_action( 'futurewordpress/project/job/dashboard/content/managejobs', [ $this, 'dashboardCommonPage' ], 1, 1 );
    add_action( 'futurewordpress/project/job/dashboard/content/resumes', [ $this, 'dashboardResumes' ], 1, 1 );
    add_action( 'futurewordpress/project/job/dashboard/content/apply', [ $this, 'dashboardApplyJobs' ], 1, 1 );
    add_action( 'futurewordpress/project/job/dashboard/content/cvmanager', [ $this, 'dashboardCVManager' ], 1, 1 );
    add_action( 'futurewordpress/project/job/dashboard/content/favourite', [ $this, 'dashboardCommonPage' ], 1, 1 );
    add_action( 'futurewordpress/project/job/dashboard/content/application', [ $this, 'dashboardCommonPage' ], 1, 1 );
    add_action( 'futurewordpress/project/job/dashboard/content/agenda', [ $this, 'dashboardCommonPage' ], 1, 1 );
    add_action( 'futurewordpress/project/job/dashboard/content/invoice', [ $this, 'dashboardCommonPage' ], 1, 1 );
	}
  public function init() {
    // add_rewrite_endpoint( 'apply', EP_ROOT | EP_PAGES ); // add_rewrite_endpoint( 'cources', EP_PAGES );
    /**
     * Jobs appling URL.
     * 1: Job ID
     * 2: ...
     */
    add_rewrite_rule( 'apply/([^/]*)/([^/]*)/?', 'index.php?apply=$matches[1]&post_id=$matches[2]', 'top' );
    add_rewrite_rule( 'dashboard/(candidate|company)/([^/]*)/?', 'index.php?dashboard=$matches[1]&dashpage=$matches[2]', 'top' );

    add_filter( 'query_vars', [ $this, 'query_vars' ], 10, 1 );
    add_filter( 'template_include', [ $this, 'template_include' ], 10, 1 );
    // add_filter( 'template_redirect', [ $this, 'template_include' ], 10, 1 );
    // add_action( 'rest_api_init', [ $this, 'restEndpoint' ], 10, 0 );
  }

  
  public function titleArea( $args ) {
    $page = isset( $args[ 'page' ] ) ? $args[ 'page' ] : get_query_var( 'dashpage' );
    if( ( $pages = explode( '-', $page ) ) && isset( $pages[1] ) && ! empty( $pages[1] ) ) {
      $args[ 'single' ] = $pages[1];$page = $pages[0];$args[ 'page' ] = $page;
    }
    $company = [
      'home' => __( 'Hospitality Dashboard', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
      'profile' => __( 'Company Profile', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
      'post' => isset( $args[ 'single' ] ) ? __( 'Edit Job', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ) : __( 'Post a New Job', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
      'managejobs' => __( 'Manage Jobs', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
      'resumes' => __( 'All Resumes', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
      'application' => isset( $args[ 'single' ] ) ? __( 'Application details', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ) : __( 'Applications', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
    ];
    $personal = [
      'home' => __( 'Worker Dashboard', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
      'favourite' => __( 'Favourite Jobs', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
      'apply' => isset( $args[ 'single' ] ) ? __( 'Edit application', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ) : __( 'Applied Jobs', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
      'cvmanager' => __( 'CV Manager', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
      'agenda' => __( 'Agenda', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
      'invoice' => sprintf( __( 'Invoice printout on %s.', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ), wp_date( 'M d, Y', date( 'M d, Y' ) ) ),
    ];
    $titles = ( $args[ 'dashboard' ] == 'company' ) ? $company : $personal;
    return isset( $titles[ $page ] ) ? $titles[ $page ] : false;
  }
  public function contentArea( $args ) {
    $page = isset( $args[ 'page' ] ) ? $args[ 'page' ] : get_query_var( 'dashpage' );
    if( ( $pages = explode( '-', $page ) ) && isset( $pages[1] ) && ! empty( $pages[1] ) ) {
      $args[ 'job' ] = $pages[1];$page = $pages[0];$args[ 'page' ] = $page;
    }

    $pages = apply_filters( 'futurewordpress/project/job/dashboard/sidebar/menus', $args );
    $page_title = ( isset( $pages[ $page ] ) && isset( $pages[ $page ][ 'title' ] ) ) ? $pages[ $page ][ 'title' ] : __( 'Dashboard', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN );
    ?>
    <div class="row">
      <div class="col-lg-12">
        <h4 class="mb30"><?php echo esc_html( $page_title ); ?></h4>
      </div>
      <?php do_action( 'futurewordpress/project/job/dashboard/content/' . $page, $args ); ?>
    </div>
    <?php
  }
  public function sideBarList( $args ) {
    $page = isset( $args[ 'page' ] ) ? $args[ 'page' ] : get_query_var( 'dashpage' );
    if( ( $pages = explode( '-', $page ) ) && isset( $pages[1] ) && ! empty( $pages[1] ) ) {
      $args[ 'single' ] = $pages[1];$page = $pages[0];$args[ 'page' ] = $page;
    }
    foreach( apply_filters( 'futurewordpress/project/job/dashboard/sidebar/menus', $args ) as $key => $row ) {
      $img = in_array( substr( $row[ 'icon' ], 0, 4 ), [ 'http', 'data' ] ) ? '<img src="' . $row[ 'icon' ] . '" alt="" />' : '<i class="' . $row[ 'icon' ] . '"></i>';
      ?>
      <li class="<?php echo esc_attr( ( $key == $page ) ? 'active' : '' ); ?>">
        <a href="<?php echo esc_url( site_url( 'dashboard/' . ( isset( $args[ 'dashboard' ] ) ? $args[ 'dashboard' ] : get_query_var( 'dashboard' ) ) . '/' . $key . '/' ) ); ?>">
          <?php echo wp_kses_post( $img ); ?> <?php echo esc_html( $row[ 'title' ] ); ?>
        </a>
      </li>
      <?php
    }
  }
  public function sideBarMenus( $args ) {
    $company = [
      'home' => [ 'icon' => 'flaticon-dashboard', 'title' => __( 'Dashboard', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ) ],
      'profile' => [ 'icon' => 'flaticon-profile', 'title' => __( 'Profile', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ) ],
      'post' => [ 'icon' => 'flaticon-resume', 'title' => __( 'Post a New Job', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ) ],
      'managejobs' => [ 'icon' => 'flaticon-businessman-paper-of-the-application-for-a-job', 'title' => __( 'Manage Jobs', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ) ],
      'resumes' => [ 'icon' => 'flaticon-resume', 'title' => __( 'Resumes', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ) ],
      // 'packages' => [ 'icon' => 'flaticon-favorites', 'title' => __( 'Packages', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ) ],
      // 'transactions' => [ 'icon' => 'flaticon-chat', 'title' => __( 'Transactions', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ) ],
    ];
    $personal = [
      'home' => [ 'icon' => 'flaticon-dashboard', 'title' => __( 'Dashboard', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ) ],
      // 'profile' => [ 'icon' => 'flaticon-profile', 'title' => __( 'Profile', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ) ],
      'favourite' => [ 'icon' => 'flaticon-favorites', 'title' => __( 'Favourite Jobs', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ) ],
      'apply' => [ 'icon' => 'flaticon-paper-plane', 'title' => __( 'Applied Jobs', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ) ],
      'cvmanager' => [ 'icon' => 'flaticon-analysis', 'title' => __( 'CV Manager', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ) ],
      'agenda' => [ 'icon' => 'flaticon-career', 'title' => __( 'Agenda', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ) ],
    ];
    return ( $args[ 'dashboard' ] == 'company' ) ? $company : $personal;
  }
  
  public function dashboardHome( $args ) {
    $type = ( $args[ 'dashboard' ] == 'company' ) ? 'company' : 'candidate';
    $file = FUTUREWORDPRESS_PROJECT_DIR_PATH . '/template-parts/dashboard/' . $type . '/home.php';
    if( file_exists( $file ) && ! is_dir( $file ) ) {
      include $file;
    }
  }
  public function dashboardProfile( $args ) {
    $file = FUTUREWORDPRESS_PROJECT_DIR_PATH . '/template-parts/dashboard/' . ( ( $args[ 'dashboard' ] == 'company' ) ? 'company' : 'candidate' ) . '/profile.php';
    if( file_exists( $file ) && ! is_dir( $file ) ) {
      include $file;
    }
  }
  public function dashboardPostJob( $args ) {
    if( $args[ 'dashboard' ] == 'company' ) {
      $file = FUTUREWORDPRESS_PROJECT_DIR_PATH . '/template-parts/dashboard/company/post.php';
      if( file_exists( $file ) && ! is_dir( $file ) ) {
        include $file;
      }
    }
  }
  public function dashboardResumes( $args ) {
    if( $args[ 'dashboard' ] == 'company' ) {
      $file = FUTUREWORDPRESS_PROJECT_DIR_PATH . '/template-parts/dashboard/company/resumes.php';
      if( file_exists( $file ) && ! is_dir( $file ) ) {
        include $file;
      }
    }
  }
  public function dashboardCVManager( $args ) {
    if( $args[ 'dashboard' ] == 'candidate' ) {
      $file = FUTUREWORDPRESS_PROJECT_DIR_PATH . '/template-parts/dashboard/candidate/cvmanager.php';
      if( file_exists( $file ) && ! is_dir( $file ) ) {
        include $file;
      }
    }
  }
  public function dashboardApplyJobs( $args ) {
    if( $args[ 'dashboard' ] == 'candidate' ) {
      $file = FUTUREWORDPRESS_PROJECT_DIR_PATH . '/template-parts/dashboard/candidate/apply.php';
      if( file_exists( $file ) && ! is_dir( $file ) ) {
        include $file;
      }
    }
  }
  public function dashboardCommonPage( $args ) {
    $file = FUTUREWORDPRESS_PROJECT_DIR_PATH . '/template-parts/dashboard/' . ( ( $args[ 'dashboard' ] == 'company' ) ? 'company' : 'candidate' ) . '/' . ( isset( $args[ 'page' ] ) ? $args[ 'page' ] : '404' ) . '.php';
    if( file_exists( $file ) && ! is_dir( $file ) ) {
      include $file;
    }
  }




  public function query_vars( $query_vars  ) {
		$query_vars[] = 'apply';
		$query_vars[] = 'post_id';
		$query_vars[] = 'dashboard';
		$query_vars[] = 'dashpage';
    return $query_vars;
	}
	public function template_include( $template ) {
    $apply = get_query_var( 'apply' );$dashboard = get_query_var( 'dashboard' );
    if ( ( $apply == false || $apply == '' ) && ( $dashboard == false || $dashboard == '' ) ) {
      return $template;
    } else {
      if( $apply !== false && $apply != '' ) {
        $file = FUTUREWORDPRESS_PROJECT_DIR_PATH . '/template-parts/apply.php';
        if( file_exists( $file ) ) {
          // add_action( 'wp_head', [ $this, 'wp_head' ], 10, 0 );
          return $file;
        } else {
          return $template;
        }
      } elseif( $dashboard !== false && $dashboard != '' ) {
        $file = FUTUREWORDPRESS_PROJECT_DIR_PATH . '/template-parts/dashboard/dashboard.php';
        if( file_exists( $file ) ) {
          // add_action( 'wp_head', [ $this, 'wp_head' ], 10, 0 );
          return $file;
        } else {
          return $template;
        }
      } else {
        return $template;
      }
    }
	}
	public function restEndpoint() {
    register_rest_route( 'certificate/v1', '/learner/(?P<id>\d+)', [
      // 'methods'  => 'GET',
      'methods'     => WP_REST_Server::READABLE,
      'callback'    => [ $this, 'restCertificate' ],
      'args'        => [],
      'permission_callback' => [ $this, 'restPermission' ],
    ] );
	}
  public function restPermission() {
		/**
		 * Permit if this user has access on this course.
		 */
		return true;
	}
  public function restCertificate() {
		$posts = get_posts( [
			'author' => $data['id'],
		] );
		if ( empty( $posts ) ) {
			return null;
		}
		return $posts;
		// return $posts[0]->post_title;
	}
  public function filemtime( $file ) {
    return ( file_exists( $file ) && ! is_dir( $file ) ) ? filemtime( $file ) : rand( 0, 999999 );
  }
}
