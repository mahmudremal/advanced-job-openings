<?php
/**
 * Loadmore Single Posts
 *
 * @package Aquila
 */

namespace FUTUREWORDPRESS_PROJECT\Inc;

use FUTUREWORDPRESS_PROJECT\Inc\Traits\Singleton;
use \WP_Query;

class Loadmore_Single {

	use Singleton;

	protected function __construct() {
		$this->setup_hooks();
	}

	protected function setup_hooks() {
		add_filter( 'futurewordpress/project/rendercompany', [ $this, 'companyRender' ], 1, 2 );
		add_filter( 'futurewordpress/project/company/single/header', [ $this, 'companyHeader' ], 1, 2 );

	}
  public function companyRender( $html, $post ) {
    return apply_filters( 'futurewordpress/project/renderpost', [], $post );
  }
	public function companyHeader( $html, $companyInfo ) {
		if( ! is_FwpActive( 'company-header' ) ) {return;}
		ob_start();
		?>
    <!-- Company Info-->
    <section class="bgc-fa mt70 pt40 mt50">
      <div class="container">
        <div class="row">
          <div class="col-lg-12 col-xl-12">
            <div class="candidate_personal_info style3">
              <div class="thumb">
                <img class="img-fluid" src="<?php echo esc_url( $companyInfo[ 'meta' ][ 'company' ][ 'logo' ] ); ?>" alt="cl1.jpg">
                <?php if( $companyInfo[ 'review' ] && $companyInfo[ 'review' ][ 'avarage' ] ) : ?>
                  <div class="cpi_av_rating"><span><?php esc_html( number_format_i18n( $companyInfo[ 'review' ][ 'avarage' ], 1 ) ); ?></span></div>
                <?php endif; ?>
              </div>
              <div class="details">
                <?php the_title( '<h3>', '</h3>', true ); ?>
                <p class="text-thm2"><?php echo esc_html( implode( ', ', $companyInfo[ 'terms' ] ) ); ?></p>
                <ul class="address_list">
                  <li class="list-inline-item"><a href="<?php echo esc_url( $companyInfo[ 'meta' ][ 'company' ][ 'website' ] ); ?>"><span class="flaticon-link text-thm2"></span> <?php echo esc_html( str_replace( [ 'http://', 'https://' ], [ '', '' ], $companyInfo[ 'meta' ][ 'company' ][ 'website' ] ) ); ?></a></li>
                  <li class="list-inline-item"><a href="tel:<?php echo esc_attr( $companyInfo[ 'meta' ][ 'company' ][ 'phone' ] ); ?>"><span class="flaticon-phone-call text-thm2"></span> <?php echo esc_html( $companyInfo[ 'meta' ][ 'company' ][ 'phone' ] ); ?></a></li>
                  <li class="list-inline-item"><a href="mailto:<?php echo esc_attr( $companyInfo[ 'meta' ][ 'company' ][ 'email' ] ); ?>"><span class="flaticon-mail text-thm2"></span> <?php echo esc_html( $companyInfo[ 'meta' ][ 'company' ][ 'email' ] ); ?></a></li>
                </ul>
                <?php if( $companyInfo[ 'review' ] && $companyInfo[ 'review' ][ 'avarage' ] ) : ?>
                  <ul class="review_list">
                    <li class="list-inline-item"><a href="#"><i class="fa fa-star"></i></a></li>
                    <li class="list-inline-item"><a href="#"><i class="fa fa-star"></i></a></li>
                    <li class="list-inline-item"><a href="#"><i class="fa fa-star"></i></a></li>
                    <li class="list-inline-item"><a href="#"><i class="fa fa-star"></i></a></li>
                    <li class="list-inline-item"><a href="#"><i class="fa fa-star-o"></i></a></li>
                  </ul>
                <?php endif; ?>
              </div>
            </div>
          </div>
          <!-- <div class="col-lg-3 col-xl-3">
            <div class="candidate_personal_overview style2">
              <button class="btn btn-block btn-thm mb15"><span class="flaticon-alarm pr10"></span> Follow Us</button>
              <button class="btn btn-block btn-gray"><span class="flaticon-consulting-message pr10"></span> Add a Review</button>
            </div>
          </div> -->
        </div>
      </div>
    </section>
		<?php
		return ob_get_clean();
	}

}
