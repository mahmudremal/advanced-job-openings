<?php
/**
 * Enqueue theme assets
 *
 * @package Aquila
 */

namespace FUTUREWORDPRESS_PROJECT\Inc;

use FUTUREWORDPRESS_PROJECT\Inc\Traits\Singleton;

class Assets {
	use Singleton;

	protected function __construct() {

		// load class.
		$this->setup_hooks();
	}

	protected function setup_hooks() {
    add_filter( 'body_class', [ $this, 'body_class' ], 10, 1 );
		add_action( 'wp_enqueue_scripts', [ $this, 'register_styles' ] );
		add_action( 'admin_enqueue_scripts', [ $this, 'register_admin_styles' ] );
		add_action( 'wp_enqueue_scripts', [ $this, 'register_scripts' ] );
		add_action( 'enqueue_block_assets', [ $this, 'enqueue_editor_assets' ] );
	}
  public function body_class( $classes ) {
		$class = [ 'fwp-body' ];
		if( is_front_page() ) {$class[] = 'fwp-body-frontpage';}
		return array_merge( $classes, $class );
	}

    public function add_type_attribute( $tag, $handle, $src ) {

        if ( 'main-js' !== $handle ) {
            return $tag;
        }
        $tag = preg_replace("/(.*)(><\/script>)/", '$1 type="module"$2', $tag);
        return $tag;
    }

	public function register_styles() {
		// Register styles.
		wp_register_style( 'bootstrap-css', FUTUREWORDPRESS_PROJECT_BUILD_LIB_URI . '/css/bootstrap.min.css', [], false, 'all' );
		wp_register_style( 'slick-css', FUTUREWORDPRESS_PROJECT_BUILD_LIB_URI . '/css/slick.css', [], false, 'all' );
		wp_register_style( 'slick-theme-css', FUTUREWORDPRESS_PROJECT_BUILD_LIB_URI . '/css/slick-theme.css', ['slick-css'], false, 'all' );
		wp_register_style( 'main-css', FUTUREWORDPRESS_PROJECT_BUILD_CSS_URI . '/main.css', ['bootstrap-css'], $this->filemtime( FUTUREWORDPRESS_PROJECT_BUILD_CSS_DIR_PATH . '/main.css' ), 'all' );
		wp_register_style( 'job-opening-frontend-base', FUTUREWORDPRESS_PROJECT_BUILD_LIB_URI . '/css/frontend-base.css', ['bootstrap-css'], $this->filemtime( FUTUREWORDPRESS_PROJECT_BUILD_LIB_PATH . '/css/frontend-base.css' ), 'all' );
		wp_register_style( 'select2', 'https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css', [], false, 'all' );
		wp_register_style( 'font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css', [], false, 'all' );

		// Enqueue Styles.
		// wp_enqueue_style( 'bootstrap-css' );
		// wp_enqueue_style( 'slick-css' );
		// wp_enqueue_style( 'slick-theme-css' );
		// wp_enqueue_style( 'main-css' );
		wp_enqueue_style( 'font-awesome' );
		wp_enqueue_style( 'job-opening-frontend-base' );

	}
	public function register_scripts() {
		// Register scripts.
		wp_register_script( 'slick-js', FUTUREWORDPRESS_PROJECT_BUILD_LIB_URI . '/js/slick.min.js', ['jquery'], false, true );
		wp_register_script( 'main-js', FUTUREWORDPRESS_PROJECT_BUILD_JS_URI . '/main.js', ['jquery', 'slick-js'], $this->filemtime( FUTUREWORDPRESS_PROJECT_BUILD_JS_DIR_PATH . '/main.js' ), true );
		wp_register_script( 'single-js', FUTUREWORDPRESS_PROJECT_BUILD_JS_URI . '/single.js', ['jquery', 'slick-js'], $this->filemtime( FUTUREWORDPRESS_PROJECT_BUILD_JS_DIR_PATH . '/single.js' ), true );
		wp_register_script( 'author-js', FUTUREWORDPRESS_PROJECT_BUILD_JS_URI . '/author.js', ['jquery'], $this->filemtime( FUTUREWORDPRESS_PROJECT_BUILD_JS_DIR_PATH . '/author.js' ), true );
		wp_register_script( 'bootstrap-js', FUTUREWORDPRESS_PROJECT_BUILD_LIB_URI . '/js/bootstrap.min.js', ['jquery'], false, true );
		wp_register_script( 'tailwindcss', 'https://cdn.tailwindcss.com', [], false, true );
		wp_register_script( 'select2', 'https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js', [], false, true );
		wp_register_script( 'ckeditor', 'https://cdn.ckeditor.com/ckeditor5/35.2.1/classic/ckeditor.js', [], false, true );
		// wp_register_script( 'data-table', 'https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap4.min.js', [ 'jquery' ], false, true );

		// Enqueue Scripts.
		wp_enqueue_script( 'main-js' );
        add_filter( 'script_loader_tag', [ $this, 'add_type_attribute' ], 10, 3 );

        // wp_enqueue_script( 'bootstrap-js' );
		// wp_enqueue_script( 'slick-js' );

		// If single post page
		if ( is_single() ) {
			wp_enqueue_script( 'single-js' );
		}

		// If author archive page
		if ( is_author() ) {
			wp_enqueue_script( 'author-js' );
		}

		wp_localize_script( 'main-js', 'siteConfig', [
			'ajaxUrl'    => admin_url( 'admin-ajax.php' ),
			'ajax_nonce' => wp_create_nonce( 'admin_ajax_post_nonce' ),
      'confirmdeletecv' => __( get_fwp_option( 'candidate_cv_delete_confirm_txt', 'Are you sure you want to delete Your CV? This can\'t be undo.' ), FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
      'confirmdeleteapply' => __( get_fwp_option( 'candidate_apply_delete_confirm_txt', 'Are you sure you want to delete Your Application? This can\'t be undo.' ), FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
      'confirmdeletejob' => __( get_fwp_option( 'candidate_job_delete_confirm_txt', 'Are you sure you want to delete this Job? This can\'t be undo.' ), FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
		] );
	}
	public function register_admin_styles() {
    // if( is_admin() && get_post_type( ) == FUTUREWORDPRESS_PROJECT_CPT_JOB_OPENINGS ) {
			wp_enqueue_style( 'admin-side', FUTUREWORDPRESS_PROJECT_BUILD_LIB_URI . '/css/admin.css', [], $this->filemtime( FUTUREWORDPRESS_PROJECT_BUILD_LIB_PATH . '/css/admin.css' ), 'all' );
		// }
	}
	public function enqueue_editor_assets() {

		$asset_config_file = sprintf( '%s/assets.php', FUTUREWORDPRESS_PROJECT_BUILD_PATH );

		if ( ! file_exists( $asset_config_file ) ) {
			return;
		}

		$asset_config = require_once $asset_config_file;

		if ( empty( $asset_config['js/editor.js'] ) ) {
			return;
		}

		$editor_asset    = $asset_config['js/editor.js'];
		$js_dependencies = ( ! empty( $editor_asset['dependencies'] ) ) ? $editor_asset['dependencies'] : [];
		$version         = ( ! empty( $editor_asset['version'] ) ) ? $editor_asset['version'] : $this->filemtime( $asset_config_file );

		// Theme Gutenberg blocks JS.
		if ( is_admin() ) {
			wp_enqueue_script(
				'aquila-blocks-js',
				FUTUREWORDPRESS_PROJECT_BUILD_JS_URI . '/blocks.js',
				$js_dependencies,
				$version,
				true
			);
		}

		// Theme Gutenberg blocks CSS.
		$css_dependencies = [
			'wp-block-library-theme',
			'wp-block-library',
		];

		wp_enqueue_style(
			'aquila-blocks-css',
			FUTUREWORDPRESS_PROJECT_BUILD_CSS_URI . '/blocks.css',
			$css_dependencies,
			$this->filemtime( FUTUREWORDPRESS_PROJECT_BUILD_CSS_DIR_PATH . '/blocks.css' ),
			'all'
		);

	}
  protected function filemtime( $file ) {
    return ( file_exists( $file ) && ! is_dir( $file ) ) ? filemtime( $file ) : rand( 0, 9999999 );
  }

}
