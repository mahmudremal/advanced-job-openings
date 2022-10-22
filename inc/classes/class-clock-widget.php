<?php
/**
 * Clock Widget
 *
 * @package Aquila
 */

namespace FUTUREWORDPRESS_PROJECT\Inc;

use WP_Widget;

use FUTUREWORDPRESS_PROJECT\Inc\Traits\Singleton;

class Clock_Widget {

	use Singleton;
	public function __construct() {
		$this->setup_hook();
	}
	private function setup_hook() {
		add_filter( 'futurewordpress/project/job/card', [ $this, 'jobCard' ], 10, 2 );

		add_shortcode( 'job-latest-applications', [ $this, 'latestApplications' ] );
		add_shortcode( 'company-open_position', [ $this, 'openPostion' ] );
		add_shortcode( 'job-people_viewed', [ $this, 'peopleMostlyViewed' ] );
	}
	public function latestApplications( $args ) {
    $args = wp_parse_args( $args, [
      'order' => 'DESC',
      'limit' => 6
    ] );
    $applications = apply_filters( 'futurewordpress/project/job/apply/get', [
      'order' => $args[ 'order' ],
      'limit' => $args[ 'limit' ]
    ] );
    // print_r( $applications );
    ?>
      <div class="recent_job_apply">
        <h4 class="title"><?php esc_html_e( get_fwp_option( 'leatest_applications_txt' ), FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ); ?></h4>
        <?php foreach( $applications as $apply ) :
          $userInfo = get_userdata( $apply->user_id );
          print_r( $userInfo );
          ?>
          <div class="candidate_list_view row style3 mb50">
            <div class="thumb col-md-3 col-lg-2">
              <img class="img-fluid rounded-circle" src="<?php echo esc_html( get_avatar_url( $userInfo->ID, [ 'size' => '51' ] ) ); ?>" alt="">
              <!-- <div class="cpi_av_rating"><span>4.5</span></div> -->
            </div>
            <div class="content col-md-9 col-lg-10">
              <h4 class="title">
                <?php echo esc_html( $userInfo->data->user_nicename ); ?>
                <!-- <span class="verified text-thm pl10"><i class="fa fa-check-circle"></i></span> -->
              </h4>
              <p><?php echo esc_html( substr( $apply->coverletter, 0, 65 ) ); ?></p>
              <a href="<?php echo esc_url( site_url( 'dashboard/company/application-' . $apply->ID . '/' ) ); ?>" class="btn btn-thm"><?php esc_html_e( 'View', 'domain' ); ?></a>
              <!-- <p>App Designer</p>
              <ul class="review_list">
                <li class="list-inline-item"><a href="#"><i class="fa fa-star"></i></a></li>
                <li class="list-inline-item"><a href="#"><i class="fa fa-star"></i></a></li>
                <li class="list-inline-item"><a href="#"><i class="fa fa-star"></i></a></li>
                <li class="list-inline-item"><a href="#"><i class="fa fa-star"></i></a></li>
                <li class="list-inline-item"><a href="#"><i class="fa fa-star-o"></i></a></li>
              </ul> -->
            </div>
              <!-- <ul class="freelancer_place mt25 float-right fn-xsd tac-xsd">
              <li class="list-inline-item"><a href="#"><span class="flaticon-location-pin"></span> Istanbul</a></li>
              <li class="list-inline-item"><a href="#"><button class="btn btn-thm">Hire</button></a></li>
              </ul> -->
          </div>
        <?php endforeach; ?>
      </div>
    <?php
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




	public function jobCard( $post, $isList = false ) {
		$jobInfo = apply_filters( 'futurewordpress/project/renderpost', [], $post );
    if( ! isset( $jobInfo[ 'meta' ][ 'company' ][ 'name' ] ) ) {return;}
    if( isset( $jobInfo[ 'meta' ][ 'jobs' ][ 'closingdate' ] ) ) {
      $expire = strtotime( $jobInfo[ 'meta' ][ 'jobs' ][ 'closingdate' ] );$today = strtotime("today midnight");
      if($today >= $expire){return;}
    }
		if( $isList ) {
			return $this->jobSingleList( $jobInfo );
		} else {
			return $this->jobSingleCard( $jobInfo );
		}
	}
	private function jobSingleList( $jobInfo ) {
		ob_start();
		?>
		<div class="col-lg-12">
			<div class="fj_post style2">
				<div class="details">
					<h5 class="job_chedule text-thm"><?php echo esc_html( implode( ' | ', $jobInfo[ 'terms' ] ) ); ?></h5>
					<a class="thumb fn-smd" href="<?php echo esc_url( get_the_permalink( $jobInfo[ 'post' ]->ID ) ); ?>">
						<img class="img-fluid" src="<?php echo esc_url( (
								isset( $jobInfo[ 'meta' ][ 'company' ][ 'logo' ] ) && ! empty( $jobInfo[ 'meta' ][ 'company' ][ 'logo' ] ) ? $jobInfo[ 'meta' ][ 'company' ][ 'logo' ] : 'logo placeholder'
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
	private function jobSingleCard($args ) {
		ob_start();
		?>
		<?php
		return ob_get_clean();
	}
}
