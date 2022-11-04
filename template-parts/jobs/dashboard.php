<?php
/**
 * Job Dashboard path file.
 * @package Divi-child
 */
is_user_logged_in() || auth_redirect();

$args = [
  'page' => get_query_var( 'dashpage' ),
  'dashboard' => get_query_var( 'dashboard' )
];
$userInfo = wp_get_current_user();
get_header();
?>

  <!-- Our Dashbord -->
	<section class="our-dashbord dashbord">
		<div class="container">
			<div class="row">
				<div class="col-sm-12 col-lg-4 col-xl-3 dn-smd">
					<?php if( is_FwpActive( 'dashboard_usercard' ) ) : ?>
						<div class="user_profile">
							<div class="media">
									<img src="<?php echo esc_url( get_avatar_url( $userInfo->ID, [ 'size' => 96, 'default' => 'blank' ] ) ); ?>" class="align-self-start mr-3 rounded-circle" alt="avater">
									<div class="media-body">
										<h5 class="mt-0">Hi, <?php echo esc_html( $userInfo->display_name ); ?></h5>
										<p><?php echo esc_html( $userInfo->user_email ); ?></p>
								</div>
							</div>
						</div>
					<?php endif; ?>
					<div class="dashbord_nav_list">
						<ul>
              <?php do_action( 'futurewordpress/project/job/dashboard/sidebar/list', $args ); ?>
						</ul>
					</div>
				</div>
				<div class="col-sm-12 col-lg-8 col-xl-9">
          <?php
            $transient = 'status_successed_message-' . get_current_user_id();
            $msg = get_transient( $transient );
            if( $msg && ! empty( $msg ) ) {
              $msg = is_array( $msg ) ? $msg : [ 'message' => $msg ];
              $msg[ 'message' ] = isset( $msg[ 'message' ] ) ? $msg[ 'message' ] : '';
              $msg[ 'status' ] = ( isset( $msg[ 'status' ] ) && $msg[ 'status' ] == 'success' ) ? 'primary' : 'warning';
              ?>
              <div class="ui_kit_message_box">
                <div class="alert alert-<?php echo esc_attr( 'primary' ); ?> alert-dismissible show" role="alert">
                  <?php echo esc_html( $msg[ 'message' ] ); ?>
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">×</span>
                  </button>
                </div>
              </div>
              <?php
              delete_transient( $transient );
            }
          ?>
					<?php do_action( 'futurewordpress/project/job/dashboard/content', $args ); ?>
				</div>
			</div>
		</div>
	</section>



  <a class="scrollToHome text-thm" href="#"><i class="flaticon-rocket-launch"></i></a>

<?php get_footer(); ?>

<script src="https://creativelayers.net/themes/careerup-html/js/jquery-3.3.1.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>

<!-- <script type="text/javascript" src="<?php echo FUTUREWORDPRESS_PROJECT_BUILD_LIB_URI; ?>/popper.min.js"></script> -->

<!-- <script type="text/javascript" src="<?php echo FUTUREWORDPRESS_PROJECT_BUILD_LIB_URI; ?>/js/jquery.mmenu.all.js"></script>
<script type="text/javascript" src="<?php echo FUTUREWORDPRESS_PROJECT_BUILD_LIB_URI; ?>/js/ace-responsive-menu.js"></script> -->

<!-- <script type="text/javascript" src="<?php echo FUTUREWORDPRESS_PROJECT_BUILD_LIB_URI; ?>/js/chart.min.js"></script> -->
<!-- <script type="text/javascript" src="https://creativelayers.net/themes/careerup-html/js/chart.custome.js"></script> -->
<script type="text/javascript" src="<?php echo FUTUREWORDPRESS_PROJECT_BUILD_LIB_URI; ?>/js/bootstrap-select.min.js"></script>
<!-- <script type="text/javascript" src="<?php echo FUTUREWORDPRESS_PROJECT_BUILD_LIB_URI; ?>/js/snackbar.min.js"></script>
<script type="text/javascript" src="<?php echo FUTUREWORDPRESS_PROJECT_BUILD_LIB_URI; ?>/js/simplebar.js"></script>
<script type="text/javascript" src="<?php echo FUTUREWORDPRESS_PROJECT_BUILD_LIB_URI; ?>/js/parallax.js"></script> -->
<!-- <script type="text/javascript" src="<?php echo FUTUREWORDPRESS_PROJECT_BUILD_LIB_URI; ?>/js/scrollto.js"></script>
<script type="text/javascript" src="<?php echo FUTUREWORDPRESS_PROJECT_BUILD_LIB_URI; ?>/js/jquery-scrolltofixed-min.js"></script> -->
<!-- <script type="text/javascript" src="<?php echo FUTUREWORDPRESS_PROJECT_BUILD_LIB_URI; ?>/js/jquery.counterup.js"></script>
<script type="text/javascript" src="<?php echo FUTUREWORDPRESS_PROJECT_BUILD_LIB_URI; ?>/js/wow.min.js"></script>
<script type="text/javascript" src="<?php echo FUTUREWORDPRESS_PROJECT_BUILD_LIB_URI; ?>/js/progressbar.js"></script>
<script type="text/javascript" src="<?php echo FUTUREWORDPRESS_PROJECT_BUILD_LIB_URI; ?>/js/slider.js"></script> -->
<script type="text/javascript" src="<?php echo FUTUREWORDPRESS_PROJECT_BUILD_LIB_URI; ?>/js/timepicker.js"></script>



<!-- <script type="text/javascript" src="https://creativelayers.net/themes/careerup-html/js/script.js"></script> -->

<script>
// In your Javascript (external.js resource or <script> tag)
$(document).ready(function() {
  // $('.fwp-selectpicker').select2();
  if($('.datepicker').length){
    $('.datepicker').datetimepicker();
  }
});
</script>

<!-- <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script> -->
<!-- <script src="//select2.github.io/select2/select2-3.3.2/select2.js"></script> -->
<!-- <link rel="stylesheet" type="text/css" href="//select2.github.io/select2/select2-3.3.2/select2.css"/> -->
<!-- <link href="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/css/bootstrap-combined.min.css" rel="stylesheet"> -->
<!-- <link rel="stylesheet" type="text/css" href="http://t0m.github.io/select2-bootstrap-css/select2-bootstrap.css"/> -->