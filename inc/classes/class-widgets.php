<?php
/**
 * Clock Widget
 *
 * @package Aquila
 */

namespace FUTUREWORDPRESS_PROJECT\Inc;

use WP_Widget;

use FUTUREWORDPRESS_PROJECT\Inc\Traits\Singleton;

class Widgets {

	use Singleton;
	public function __construct() {
		$this->setup_hook();
	}
	private function setup_hook() {
		add_filter( 'futurewordpress/project/job/card', [ $this, 'jobCard' ], 10, 3 );

		add_shortcode( 'company-open_position', [ $this, 'openPostion' ] );
		add_shortcode( 'job-people_viewed', [ $this, 'peopleMostlyViewed' ] );

    // Filter functions on archive
    add_action( 'pre_get_posts', [ $this, 'doFilter' ] );
    add_filter( 'futurewordpress/project/job/archive/before/content', [ $this, 'before_content' ], 1, 2 );
    add_filter( 'futurewordpress/project/job/archive/after/content', [ $this, 'archiveContentAfter' ], 1, 2 );

		add_filter( 'futurewordpress/project/job/list/filters', [ $this, 'jobFilters' ], 10, 2 );

	}
  

  public function archiveContentAfter( $html, $args ) {
    return $html;
  }
  public function before_content( $html, $args ) {
    // FUTUREWORDPRESS_PROJECT_CPT_JOB_OPENINGS
    return $html;
    // return $this->filter_term_content();
  }
  public function archive_filter() {
    if( ! is_post_type_archive( 'clients' ) ) {return;}
    // if ( ! eksell_show_home_filter() ) {return;}
    $filter_taxonomy = ( is_post_type_archive( 'jetpack-portfolio' ) || is_page_template( 'page-templates/template-portfolio.php' ) ) ? 'jetpack-portfolio-type' : 'category';
    $terms = get_terms_by_posttype( 'category', 'clients' );
    if ( is_wp_error( $terms ) || ! $terms ) return;
    $home_url = '';$post_type 	= '';
    if ( is_home() ) {
			$post_type 	= 'post';
			$home_url 	= home_url();
		} elseif ( is_post_type_archive() ) {
			$post_type 	= get_post_type();
			$home_url 	= get_post_type_archive_link( $post_type );
		} else if ( is_page_template( 'page-templates/template-portfolio.php' ) ) {
			$post_type 	= 'jetpack-portfolio';
			$home_url 	= get_post_type_archive_link( $post_type );
		}
    // Make the home URL filterable. If you change the taxonomy of the filtration with <code>eksell_home_filter_get_terms_args</code>,
		// you might want to filter this to make sure it points to the correct URL as well (or maybe remove it altogether).
		$home_url = apply_filters( 'eksell_filter_home_url', $home_url );
    ?>
    <div class="filter-wrapper i-a a-fade-up a-del-200">
			<ul class="filter-list reset-list-style">

				<?php if ( $home_url ) : ?>
					<li class="filter-show-all"><a class="filter-link active" data-filter-post-type="<?php echo esc_attr( $post_type ); ?>" href="<?php echo esc_url( $home_url ); ?>"><?php esc_html_e( 'Show All', 'eksell' ); ?></a></li>
				<?php endif; ?>

				<?php foreach ( $terms as $term ) : ?>
					<li class="filter-term-<?php echo esc_attr( $term->slug ); ?>"><a class="filter-link" data-filter-term-id="<?php echo esc_attr( $term->term_id ); ?>" data-filter-taxonomy="<?php echo esc_attr( $term->taxonomy ); ?>" data-filter-post-type="<?php echo esc_attr( $post_type ); ?>" href="<?php echo esc_url( get_term_link( $term ) ); ?>"><?php echo $term->name; ?></a></li>
				<?php endforeach; ?>
				
			</ul><!-- .filter-list -->
		</div><!-- .filter-wrapper -->
    <?php
  }
  public function filter_term_content() {
    ob_start();
    // https://medium.com/meta-box/how-to-filter-posts-by-custom-fields-and-custom-taxonomies-on-archive-pages-be2e466216c2
    ?>
    <div class="filter-custom-taxonomy">
      <?php
      // job_categories | job_types
      $terms = get_terms( 'job_types' );
      // print_r( $terms );
      foreach ( $terms as $term ) : ?>
      <a href="?getby=types&cat[]=<?php echo esc_attr( $term->slug ); ?>">
        <?php echo esc_html( $term->name ); ?>
      </a>
      <?php endforeach; ?>
    </div>
    <?php
    return ob_get_contents();
  }
  public function filter_term_do( $query ) {
    if( is_admin() ) {return;}
    if( is_archive() && isset( $_GET['getby'] ) ) {
      $taxquery = []; // $query->get( 'tax_query' );
      $taxquery = ( $taxquery == '' ) ? [] : ( is_array( $taxquery ) ? $taxquery : (array) $taxquery );
      // $taxquery[ 'relation' ] = 'OR';
      if( 'categories' === $_GET['getby'] ) {
        array_unshift( $taxquery, [
          'taxonomy' => 'job_categories',
          'field' => 'slug',
          'terms' => $_GET['cat'],
          // 'operator' => 'IN'
        ] );
      } elseif( 'types' === $_GET['getby'] ) {
        array_unshift( $taxquery, [
          'taxonomy' => 'job_types',
          'field' => 'slug',
          'terms' => $_GET['cat'],
          'operator' => 'IN'
        ] );
      }
      $query->set( 'tax_query', $taxquery );
    }
    return $query;
  }
  public function filter_meta_content() {
    global $wpdb;
    $meta_values = $wpdb->get_results( 'SELECT DISTINCT meta_value FROM $wpdb->postmeta WHERE meta_key LIKE "author_book"', OBJECT );
    ob_start();
    ?>
    <div class="filter-custom-field">
      <?php
      foreach ( $meta_values as $meta_value ) : ?>
        <a href="?getby=field&field=<?php echo esc_attr( $meta_value->meta_value ); ?>">
          <?php echo esc_html( $meta_value->meta_value ); ?>
        </a>
      <?php endforeach; ?>
    </div>
    <?php
    return ob_get_contents();
  }
  public function filter_meta_do( $query ) {
    if( is_admin() ) {return;}
    if( is_archive() && isset( $_GET['getby'] ) ) {
      if( 'field' === $_GET['getby'] ) {
        $query->set( 'meta_key', 'author_book' );
        $query->set( 'meta_value', $_GET['field'] );
        $query->set( 'meta_compare', '=' );
      }
    }
  }


	public function openPostion( $args ) {
		$args = wp_parse_args( $args, [
			'company' => false,
			'total' => 3,
			'order' => 'desc'
		] );
		$postArgs = [
      'post_type' => FUTUREWORDPRESS_PROJECT_CPT_JOB_OPENINGS,
      'numberposts' => $args[ 'total' ],
      // 'fields' => 'ids, names',
      'orderby'    => 'menu_order',
      'sort_order' => $args[ 'order' ],
      'post_status' => 'publish',
      
      // 'meta_key'      => 'fwp_company-authorizeid',
      // 'meta_value'    => get_current_user_id(),
      // 'meta_compare'  => '=='
    ];
		if( $args[ 'company' ] ) {
			$postArgs[ 'post_author' ] = $args[ 'company' ];
		}
    $getJobs = get_posts( $postArgs );$jobCard = '';
		if( $getJobs ) {
			foreach( $getJobs as $getPost ) {
				setup_postdata( $getPost );
				$jobCard .= apply_filters( 'futurewordpress/project/job/card', $getPost, true );
			}
			wp_reset_postdata();
		}
		echo $jobCard;
	}
	public function peopleMostlyViewed( $args ) {
		$args = wp_parse_args( $args, [
			'company' => false,
			'total' => 3,
			'order' => 'DESC'
		] );
		$postArgs = [
      'post_type' => FUTUREWORDPRESS_PROJECT_CPT_JOB_OPENINGS,
      'numberposts' => $args[ 'total' ],
      // 'fields' => 'ids, names',
      'orderby'    => 'meta_value_num', //meta_value', //or 'meta_value_num'
      'sort_order' => $args[ 'order' ],
      'post_status' => 'publish',
      // 'meta_query' => [
      //   'order_clause' => [
      //     'key' => 'fwp_seenjob',
      //     'value' => 1,
      //     'type' => 'NUMERIC',
      //     'compare'  => '>='
      //   ]
      // ],
      
      'meta_key'      => 'fwp_seenjob',
      // 'meta_value'    => 1,
      // 'meta_compare'  => '>='
    ];
    $getJobs = get_posts( $postArgs );$jobCard = '';
		if( $getJobs ) {
			foreach( $getJobs as $getPost ) {
				setup_postdata( $getPost );
				$jobCard .= apply_filters( 'futurewordpress/project/job/card', $getPost, true );
			}
			wp_reset_postdata();
		}
		echo $jobCard;
	}



	public function jobCard( $post, $isList = false, $isCompany = false ) {
		$jobInfo = apply_filters( 'futurewordpress/project/renderpost', [], $post );
    if( ! isset( $jobInfo[ 'meta' ][ 'company' ][ 'name' ] ) ) {return;}
    if( isset( $jobInfo[ 'meta' ][ 'jobs' ][ 'closingdate' ] ) ) {
      $expire = strtotime( $jobInfo[ 'meta' ][ 'jobs' ][ 'closingdate' ] );$today = strtotime("today midnight");
      // if($today >= $expire){return;}
    }
		if( $isList ) {
			return $this->jobSingleList( $jobInfo, $isCompany );
		} else {
			return $this->jobSingleCard( $jobInfo, $isCompany );
		}
	}
	private function jobSingleList( $jobInfo, $isCompany ) {
		ob_start();
		?>
		<div class="col-lg-12">
			<div class="fj_post style2">
				<div class="details">
					<h5 class="job_chedule text-thm"><?php echo esc_html( implode( ' | ', $jobInfo[ 'terms' ] ) ); ?></h5>
					<a class="thumb fn-smd" href="<?php echo esc_url( get_the_permalink( $jobInfo[ 'post' ]->ID ) ); ?>">
						<img class="img-fluid" src="<?php echo esc_url( (
								isset( $jobInfo[ 'meta' ][ 'company' ][ 'logo' ] ) && ! empty( $jobInfo[ 'meta' ][ 'company' ][ 'logo' ] ) ? $jobInfo[ 'meta' ][ 'company' ][ 'logo' ] : FUTUREWORDPRESS_PROJECT_BUILD_IMG_URI . '/placeholder.png'
							) ); ?>" alt="<?php esc_attr_e( 'Logo', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ); ?>">
					</a>
					<a href="<?php echo esc_url( get_the_permalink( $jobInfo[ 'post' ]->ID ) ); ?>">
            <h4><?php echo esc_html( $jobInfo[ 'post' ]->post_title ); ?></h4>
					</a>
					<p><?php echo wp_kses_post( apply_filters( 'futurewordpress/project/job/info/postedon', $jobInfo ) ); ?></p>
					<ul class="featurej_post">
						<li class="list-inline-item">
							<span class="flaticon-location-pin"></span>
							<!-- <img src="<?php // echo esc_url( apply_filters( 'futurewordpress/project/job/icons', 'location-pin' ) ); ?>" alt=""> --> <?php echo esc_html( ( isset( $jobInfo[ 'meta' ][ 'jobs' ][ 'location' ] ) && ! empty( $jobInfo[ 'meta' ][ 'jobs' ][ 'location' ] ) ? $jobInfo[ 'meta' ][ 'jobs' ][ 'location' ] : $jobInfo[ 'meta' ][ 'company' ][ 'location' ] ) ); ?>
						</li>
						<li class="list-inline-item">
							<span class="flaticon-price pl20"></span>
							<!-- <img src="<?php // echo esc_url( apply_filters( 'futurewordpress/project/job/icons', 'money-cash' ) ); ?>" alt=""> --> <?php echo esc_html( apply_filters( 'futurewordpress/project/job/salary', $jobInfo[ 'meta' ][ 'jobs' ] ) ); ?>
						</li>
					</ul>
				</div>
				<a class="favorit" href="<?php echo esc_url( apply_filters( 'futurewordpress/project/job/save/favourite', $jobInfo ) ); ?>">
					<!-- <span class="flaticon-favorites"></span> -->
					<?php echo apply_filters( 'futurewordpress/project/job/icon/favourite', $jobInfo, true ); ?>
				</a>
			</div>
		</div>
		<?php
		return ob_get_clean();
	}
	private function jobSingleCard( $jobInfo, $isCompany ) {
		ob_start();
		?>
    <div class="col-lg-6 col-xl-4">
      <div class="fj_post style3">
        <div class="details">
          <a class="thumb" href="<?php echo esc_url( get_the_permalink( $jobInfo[ 'post' ]->ID ) ); ?>">
						<img class="img-fluid" src="<?php echo esc_url( (
								isset( $jobInfo[ 'meta' ][ 'company' ][ 'logo' ] ) && ! empty( $jobInfo[ 'meta' ][ 'company' ][ 'logo' ] ) ? $jobInfo[ 'meta' ][ 'company' ][ 'logo' ] : FUTUREWORDPRESS_PROJECT_BUILD_IMG_URI . '/placeholder.png'
							) ); ?>" alt="<?php esc_attr_e( 'Logo', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ); ?>">
					</a>
          <h5 class="job_chedule text-thm2"><?php echo esc_html( implode( ' | ', $jobInfo[ 'terms' ] ) ); ?></h5>
          <a href="<?php echo esc_url( get_the_permalink( $jobInfo[ 'post' ]->ID ) ); ?>">
            <h4><?php echo esc_html( $jobInfo[ 'post' ]->post_title ); ?></h4>
					</a>
          <p><?php echo wp_kses_post( apply_filters( 'futurewordpress/project/job/info/postedon', $jobInfo ) ); ?></p>
          <div class="featurej_post mt40">
            <p><span class="flaticon-location-pin"></span> <?php echo esc_html( ( isset( $jobInfo[ 'meta' ][ 'jobs' ][ 'location' ] ) && ! empty( $jobInfo[ 'meta' ][ 'jobs' ][ 'location' ] ) ? $jobInfo[ 'meta' ][ 'jobs' ][ 'location' ] : $jobInfo[ 'meta' ][ 'company' ][ 'location' ] ) ); ?></p>
            <a class="btn btn-transparent" href="<?php echo esc_url( get_the_permalink( $jobInfo[ 'post' ]->ID ) ); ?>"><?php esc_html_e( 'Browse Job', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ); ?></a>
          </div>
        </div>
      </div>
    </div>
		<?php
		return ob_get_clean();
	}

  
  public function doFilter( $query ) {

    if( is_admin() || ! is_archive() || 'nav_menu_item' === $query->query_vars['post_type'] ) {return;}

    $postquery = []; // $query->get( 'post_type' );
    $postquery = ( $postquery == '' ) ? [] : ( is_array( $postquery ) ? $postquery : (array) $postquery );

    $metaquery = []; // $query->get( 'meta_query' );
    $metaquery = ( $metaquery == '' ) ? [] : ( is_array( $metaquery ) ? $metaquery : (array) $metaquery );

    $taxquery = []; // $query->get( 'tax_query' );
    $taxquery = ( $taxquery == '' ) ? [] : ( is_array( $taxquery ) ? $taxquery : (array) $taxquery );
    $filters = [
      'keyword'     => '',
      'location'    => '',
      'createdon'   => '',
      'types'       => [],
      'categories'  => [],
      'gender'      => [],
      'locations'    => []
    ];
    $filters = isset( $_GET ) ? $_GET : [];
    $filters = wp_parse_args( $filters, $filters );

    // print_r( $filters );
    // array_unshift( $taxquery, [whos to hook] );

    if( isset( $filters[ 'keyword' ] ) && ! empty( $filters[ 'keyword' ] ) ) {

      // $metaquery[] = [
      //   'key'     => 'fwp_jobs-title',
      //   'value'   => $filters[ 'keyword' ],
      //   'compare' => 'LIKE'
      // ];
      // wp_die( print_r( $metaquery ) );
      $taxquery[ 's' ] = $filters[ 'keyword' ];
      $taxquery[] = [ 's' => $filters[ 'keyword' ] ];
      // $query->set( 'orderby', 'title' );
      // $query->set( 'order', 'DESC' );
    }
    if( isset( $filters[ 'location' ] ) && ! empty( $filters[ 'location' ] ) ) {
      $metaquery[] = [
        'key'     => 'fwp_jobs-location',
        'value'   => $filters[ 'location' ],
        'compare' => 'LIKE'
      ];
    }
    if( isset( $filters[ 'createdon' ] ) && ! empty( $filters[ 'createdon' ] ) ) {
      $dateAfter = ( $filters[ 'createdon' ] == 'last-hour' ) ? date( 'M d, Y h', strtotime('-1 hour') ) : (
        ( $filters[ 'createdon' ] == 'last-24' ) ? date( 'M d, Y', strtotime('-1 day') ) : (
          ( $filters[ 'createdon' ] == 'last-7' ) ? date( 'M d, Y', strtotime('-1 week') ) : (
            ( $filters[ 'createdon' ] == 'last-14' ) ? date( 'M d, Y', strtotime('-2 weeks') ) : (
              ( $filters[ 'createdon' ] == 'last-30' ) ? date( 'M d, Y', strtotime('-1 month') ) : date( 'M d, Y', strtotime('-1 year') )
            )
          )
        )
      );
      // print_r( $dateAfter );
      $query->set( 'date_query', [
        [
          'after' => $dateAfter
        ]
			] );
    }
    if( isset( $filters[ 'types' ] ) && count( $filters[ 'types' ] ) >= 1 ) {
      $taxquery[] = [
        'taxonomy'  => 'job_types',
        'field'     => 'slug',
        'terms'     => $filters[ 'types' ],
        'operator'  => 'IN'
      ];
    }
    if( isset( $filters[ 'categories' ] ) && count( $filters[ 'categories' ] ) >= 1 ) {
      $taxquery[] = [
        'taxonomy'  => 'job_categories',
        'field'     => 'slug',
        'terms'     => $filters[ 'categories' ],
        'operator'  => 'IN'
      ];
    }
    if( isset( $filters[ 'gender' ] ) && count( $filters[ 'gender' ] ) >= 1 ) {
      $metaquery[] = [
        'key'     => 'fwp_jobs-gender',
        'value'   => $filters[ 'gender' ],
        'compare' => 'IN'
      ];
    }
    if( isset( $filters[ 'locations' ] ) && count( $filters[ 'locations' ] ) >= 1 ) {
      $taxquery[] = [
        'taxonomy'  => 'job_locations',
        'field'     => 'slug',
        'terms'     => $filters[ 'locations' ],
        'operator'  => 'IN'
      ];
    }

    if( count( $metaquery ) >= 1 ) {
      $query->set( 'meta_query', $metaquery );
    }
    if( count( $taxquery ) >= 0 ) {
      $taxquery[ 'relation' ] = 'AND'; // OR | AND
      $taxquery[ 'post_type' ] = 'any';
      $query->set( 'tax_query', $taxquery );
    }
    if( count( $postquery ) >= 0 ) {
      $postquery[] = FUTUREWORDPRESS_PROJECT_CPT_JOB_OPENINGS;
      $query->set( 'post_type', $postquery );
    }
    return $query;
  }
	public function jobFilters( $html, $args ) {
    $query = isset( $_GET ) ? $_GET : [];
    $query = wp_parse_args( $query, [
      'keyword'     => '',
      'location'    => '',
      'createdon'   => '',
      'types'       => [],
      'categories'  => [],
      'gender'      => [],
      'locations'   => []
    ] );
		ob_start();
		?>
		<div class="col-lg-3 col-xl-3 dn-smd">
      <form action="<?php echo esc_url( site_url( FUTUREWORDPRESS_PROJECT_CPT_JOB_OPENINGS . '/' ) ); ?>" method="get">
        <div class="faq_search_widget mb30">
          <h4 class="fz20 mb15"><?php esc_html_e( 'Search Keywords', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ); ?></h4>
          <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="e.g. web design" aria-label="Recipient's username" aria-describedby="button-addon2" name="keyword" value="<?php echo esc_attr( $query[ 'keyword' ] ); ?>">
            <div class="input-group-append">
                <button class="btn btn-outline-secondary" type="submit" id="button-addon2"><span class="flaticon-search"></span></button>
            </div>
          </div>
        </div>
        <!--
          <div class="faq_search_widget mb30">
            <h4 class="fz20 mb15"><?php esc_html_e( 'Location', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ); ?></h4>
            <div class="input-group mb-3">
              <input type="text" class="form-control" placeholder="All Location" aria-label="Recipient's username" aria-describedby="button-addon2" name="location" value="<?php echo esc_attr( $query[ 'location' ] ); ?>">
              <div class="input-group-append">
                  <button class="btn btn-outline-secondary" type="submit" id="button-addon3"><span class="flaticon-location-pin"></span></button>
              </div>
            </div>
          </div>
          -->
        <div class="cl_latest_activity mb30">
          <h4 class="fz20 mb15"><?php esc_html_e( 'Date Posted', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ); ?></h4>
          <div class="ui_kit_radiobox">
            <?php
              $radios = [
                'last-hour' => __( 'Last Hour', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
                'last-24' => __( 'Last 24 hours', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
                'last-7' => __( 'Last 7 days', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
                'last-14' => __( 'Last 14 days', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
                'last-30' => __( 'Last 30 days', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN )
              ];
              foreach( $radios as $key => $text ) :
              ?>
              <div class="radio">
                <input id="radio_<?php echo esc_attr( $key ); ?>" name="createdon" type="radio" value="<?php echo esc_attr( $key ); ?>" <?php echo esc_attr( ( $query[ 'createdon' ] == $key ) ? 'checked' : '' ); ?>>
                <label for="radio_<?php echo esc_attr( $key ); ?>"><span class="radio-label"></span> <?php echo esc_html( $text ); ?></label>
              </div>
            <?php endforeach; ?>
            <a class="text-thm2 pl30" href="<?php echo esc_url( site_url( FUTUREWORDPRESS_PROJECT_CPT_JOB_OPENINGS ) ); ?>"><?php esc_html_e( 'View All', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ); ?> <span class="flaticon-right-arrow pl10"></span></a>
          </div>
        </div>
        <div class="cl_latest_activity mb30">
          <h4 class="fz20 mb15"><?php esc_html_e( 'Job Types', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ); ?></h4>
          <div class="ui_kit_whitchbox">
            <?php
              $terms = get_terms( 'job_types' );
              // print_r( $terms );
              foreach ( $terms as $term ) : ?>
                <div class="custom-control custom-switch">
                  <input name="types[]" type="checkbox" class="custom-control-input" id="types-<?php echo esc_attr( $term->slug ); ?>" value="<?php echo esc_attr( $term->slug ); ?>" <?php echo esc_attr( in_array( $term->slug, $query[ 'types' ] ) ? 'checked' : '' ); ?>>
                  <label class="custom-control-label" for="types-<?php echo esc_attr( $term->slug ); ?>"><?php echo esc_html( $term->name ); ?></label>
                </div>
            <?php endforeach; ?>
          </div>
        </div>
        <div class="cl_skill_checkbox mb30">
          <h4 class="fz20 mb20"><?php esc_html_e( 'Categories', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ); ?></h4>
          <div class="content ui_kit_checkbox text-left">
          <?php
              $terms = get_terms( 'job_categories' );
              // print_r( $terms );
              foreach ( $terms as $term ) : ?>
                <div class="custom-control custom-checkbox">
                  <input type="checkbox" class="custom-control-input" name="categories[]" id="categories-<?php echo esc_attr( $term->slug ); ?>" value="<?php echo esc_attr( $term->slug ); ?>" <?php echo esc_attr( in_array( $term->slug, $query[ 'categories' ] ) ? 'checked' : '' ); ?>>
                  <label class="custom-control-label" for="categories-<?php echo esc_attr( $term->slug ); ?>"><?php echo esc_html( $term->name ); ?></label>
                </div>
            <?php endforeach; ?>
          </div>
        </div>
        <div class="cl_latest_activity mb30">
          <h4 class="fz20 mb15"><?php esc_html_e( 'Gender', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ); ?></h4>
          <div class="ui_kit_whitchbox">
            <?php
              $terms = [
                'male' => __( 'Male', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
                'female' => __( 'Female', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
                'both' => __( 'Both', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN )
              ];
              // print_r( $terms );
              foreach ( $terms as $slug => $term ) : ?>
                <div class="custom-control custom-switch">
                  <input name="gender[]" type="checkbox" class="custom-control-input" id="gender-<?php echo esc_attr( $slug ); ?>" value="<?php echo esc_attr( $slug ); ?>" <?php echo esc_attr( in_array( $slug, $query[ 'gender' ] ) ? 'checked' : '' ); ?>>
                  <label class="custom-control-label" for="gender-<?php echo esc_attr( $slug ); ?>"><?php echo esc_html( $term ); ?></label>
                </div>
            <?php endforeach; ?>
          </div>
        </div>
        <?php $terms = get_terms( [ 'taxonomy' => 'job_locations', 'hide_empty' => true ] );if( count( $terms ) >= 1 ) : ?>
          <div class="cl_skill_checkbox mb30">
            <h4 class="fz20 mb20"><?php esc_html_e( 'Job Locations', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ); ?></h4>
            <div class="content ui_kit_checkbox text-left">
            <?php
              foreach ( $terms as $term ) : ?>
                <div class="custom-control custom-checkbox">
                  <input type="checkbox" class="custom-control-input" name="locations[]" id="locations-<?php echo esc_attr( $term->slug ); ?>" value="<?php echo esc_attr( $term->slug ); ?>" <?php echo esc_attr( in_array( $term->slug, $query[ 'locations' ] ) ? 'checked' : '' ); ?>>
                  <label class="custom-control-label" for="locations-<?php echo esc_attr( $term->slug ); ?>"><?php echo esc_html( $term->name ); ?></label>
                </div>
              <?php endforeach; ?>
            </div>
          </div>
        <?php endif; ?>
        <div class="faq_search_widget mb30">
          <div class="input-group mb-3">
            <input type="submit" class="form-control border-right-0" aria-describedby="button-addon-submit" value="<?php echo esc_attr( __( 'Filter', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ) ); ?>">
            <div class="input-group-append">
                <button class="btn btn-outline-secondary border-0" type="submit" id="button-addon-submit"><span class="flaticon-search"></span></button>
            </div>
          </div>
        </div>
      </form>
		</div>
		<?php
		return ob_get_clean();
	}
}
