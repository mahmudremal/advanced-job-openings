<?php
/**
 * Single Job template for frontend.
 *
 * @package Aquila
 */
  get_header();
  // global $post;
  // header breadcumbs contents
  $jobInfo = apply_filters( 'futurewordpress/project/renderpost', [], $post );

	do_action( 'futurewordpress/project/job/single/before', $jobInfo );

	do_action( 'futurewordpress/project/job/single/header/before', $jobInfo );
	
  echo apply_filters( 'futurewordpress/project/job/single/header', '', $jobInfo );

	do_action( 'futurewordpress/project/job/single/header/after', $jobInfo );

  ?>
  <pre style="display: none;"><?php // print_r( [ FUTUREWORDPRESS_PROJECT_OPTIONS, $jobInfo ] ); ?></pre>
	<!-- Candidate Personal Info Details-->
	<section class="bgc-white pb30">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 col-xl-8">
					<div class="row">
						<div class="col-lg-12">
              <?php do_action( 'futurewordpress/project/job/single/content/before', $jobInfo ); ?>
							<div class="candidate_about_info style2">
                <?php if( is_FwpActive( 'job_description' ) && isset( $jobInfo[ 'meta' ][ 'jobs' ][ 'description' ] ) && ! empty( $jobInfo[ 'meta' ][ 'jobs' ][ 'description' ] ) ) : ?>
                  <h4 class="fz20 mb30"><?php esc_html_e( get_fwp_option( 'job_description_txt', 'Job Description' ), FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ); ?></h4>
                  <p class="mb30">
                    <?php echo wp_kses_post( $jobInfo[ 'meta' ][ 'jobs' ][ 'description' ] ); ?>
                  </p>
                <?php endif; ?>
                <?php if( is_FwpActive( 'responsibilities_include' ) && isset( $jobInfo[ 'meta' ][ 'jobs' ][ 'responsibilities' ] ) && ! empty( $jobInfo[ 'meta' ][ 'jobs' ][ 'responsibilities' ] ) ) : ?>
                  <p class="fwb"><?php esc_html_e( get_fwp_option( 'responsibilities_include_txt', 'Responsibilities include' ), FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ); ?>:</p>
                  <?php echo wp_kses_post( $jobInfo[ 'meta' ][ 'jobs' ][ 'responsibilities' ] ); ?>
                <?php endif; ?>
                <?php if( is_FwpActive( 'skills_experience' ) && isset( $jobInfo[ 'meta' ][ 'jobs' ][ 'experience' ] ) && ! empty( $jobInfo[ 'meta' ][ 'jobs' ][ 'experience' ] ) ) : ?>
                  <p class="fwb"><?php esc_html_e( get_fwp_option( 'skills_experience_txt', 'Skills & Experience' ), FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ); ?></p>
                  <?php echo wp_kses_post( $jobInfo[ 'meta' ][ 'jobs' ][ 'experience' ] ); ?>
                <?php endif; ?>

                <?php if( is_FwpActive( 'requirments' ) && isset( $jobInfo[ 'meta' ][ 'jobs' ][ 'requirments' ] ) && ! empty( $jobInfo[ 'meta' ][ 'jobs' ][ 'requirments' ] ) ) : ?>
                  <p class="fwb"><?php esc_html_e( get_fwp_option( 'requirments_txt', 'Requirements' ), FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ); ?></p>
                  <?php echo wp_kses_post( $jobInfo[ 'meta' ][ 'jobs' ][ 'requirments' ] ); ?>
                <?php endif; ?>

                <?php if( is_FwpActive( 'offering' ) && isset( $jobInfo[ 'meta' ][ 'jobs' ][ 'offering' ] ) && ! empty( $jobInfo[ 'meta' ][ 'jobs' ][ 'offering' ] ) ) : ?>
                  <p class="fwb"><?php esc_html_e( get_fwp_option( 'offering_txt', 'Offering' ), FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ); ?></p>
                  <?php echo wp_kses_post( $jobInfo[ 'meta' ][ 'jobs' ][ 'offering' ] ); ?>
                <?php endif; ?>
                <?php
                $locationData = maybe_unserialize( isset( $jobInfo[ 'meta' ][ 'jobs' ][ 'vanues' ] ) ? $jobInfo[ 'meta' ][ 'jobs' ][ 'vanues' ] : [] );
                // print_r( $locationData );
                if( count( (array) $locationData ) >= 1 ) :
                  ?>
                  <h4 class="fz20"><?php esc_html_e( get_fwp_option( 'job_location_txt', 'Job Location' ), FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ); ?></h4>
                  <div class="ui_kit_table">
                    <table class="table">
                      <thead class="thead-light">
                          <tr>
                            <th scope="col"><?php esc_html_e( 'Date', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ); ?></th>
                            <th scope="col"><?php esc_html_e( 'Location', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ); ?></th>
                            <th scope="col"><?php esc_html_e( 'Requirements', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ); ?></th>
                          </tr>
                      </thead>
                      <tbody>
                        <?php foreach( $locationData as $location ) :
                          if( empty( $location[ 'JobDate' ] ) ) {continue;} ?>
                          <tr>
                            <td><?php echo esc_html( wp_date( 'F jS, Y', strtotime( $location[ 'JobDate' ] ) ) ); ?></td>
                            <td><?php
                            $term = get_term( $location[ 'JobLocation' ], 'job_locations' );
                            echo esc_html( isset( $term->name ) ? $term->name : $location[ 'JobLocation' ] ); ?></td>
                            <td><?php echo nl2br(esc_html( $location[ 'JobRequirments' ] )); ?></td>
                          </tr>
                        <?php endforeach; ?>
                      </tbody>
                    </table>
                  </div>
                <?php endif; ?>
								  <p class="mb60"></p>
                  <?php if( $jobInfo[ 'meta' ][ 'jobs' ][ '_status' ] && ! ( $jobInfo[ 'post' ]->post_author == get_current_user_id() || $jobInfo[ 'meta' ][ 'company' ][ 'authorizeid' ] == get_current_user_id() ) ) : ?>
                    <a class="btn btn-lg btn-thm mb15" href="<?php echo esc_url( apply_filters( 'futurewordpress/project/job/apply/link', $jobInfo ) ); ?>"><?php esc_html_e( get_fwp_option( 'apply_now_txt', 'Apply Now' ), FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ); ?> <span class="flaticon-right-arrow pl10"></span></a>
                  <?php endif; ?>
									<?php if( is_FwpActive( 'job_alerts' ) ) : ?>
                    <button class="btn btn-lg btn-gray float-right"><span class="flaticon-mail pr10"></span> <?php esc_html_e( get_fwp_option( 'get_job_alerts_txt', 'Get job Alerts' ), FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ); ?></button>
                  <?php endif; ?>
							</div>
              <?php do_action( 'futurewordpress/project/job/single/content/after', $jobInfo ); ?>
						</div>
            
            <?php if( is_FwpActive( 'social' ) ) : ?>
						<div class="col-lg-12">
							<div class="job_shareing">
								<div class="candidate_social_widget bgc-fa">
									<ul>
										<li><?php esc_html_e( get_fwp_option( 'share_this_job_txt', 'Share this Job' ), FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ); ?>:</li>
                    <?php
                    $socialShare = apply_filters( 'futurewordpress/project/job/single/social', '', [] );
                    foreach( $socialShare as $sSi => $sSLink ) :
                      ?>
                      <li><a href="<?php echo esc_url( $sSLink ); ?>" target="_blank"><i class="fa fa-<?php echo esc_attr( $sSi ); ?>"></i></a></li>
                    <?php endforeach; ?>
									</ul>
								</div>
							</div>
						</div>
            <?php endif; ?>

            <?php if( is_FwpActive( 'suggest' ) ) : ?>
						<div class="col-lg-12">
							<div class="my_resume_eduarea">
								<h4 class="title"><?php esc_html_e( get_fwp_option( 'people_viewed_txt', 'People viewed' ), FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ); ?></h4>
							</div>
						</div>
						<?php do_shortcode( '[job-people_viewed]' ); ?>
            <?php endif; ?>
					</div>
				</div>
				<?php if( is_FwpActive( 'sidebar' ) ) : ?>
				<div class="col-lg-4 col-xl-4">
					<h4 class="fz20 mb30"><?php esc_html_e( get_fwp_option( 'position_information_txt', 'Position Information' ), FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ); ?></h4>
					<div class="candidate_working_widget style2 bgc-fa">
            <?php if( is_FwpActive( 'offered_salary' ) ) : ?>
              <div class="icon text-thm">
								<span class="fa fa-money-bill-alt"></span>
								<!-- <img src="<?php // echo esc_url( apply_filters( 'futurewordpress/project/job/icons', 'money-cash' ) ); ?>" alt=""> -->
							</div>
              <div class="details">
                <p class="color-black22"><?php esc_html_e( get_fwp_option( 'offered_salary_txt', 'Offered Salary' ), FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ); ?></p>
                <p><?php echo esc_html( apply_filters( 'futurewordpress/project/job/salary', $jobInfo[ 'meta' ][ 'jobs' ] ) ); ?></p>
              </div>
            <?php endif; ?>
						<?php if( is_FwpActive( 'state' ) ) : ?>
              <div class="icon text-thm">
                <span class="flaticon-controls"></span>
                <!-- <img src="<?php // echo esc_url( apply_filters( 'futurewordpress/project/job/icons', 'line-chart' ) ); ?>" alt=""> -->
              </div>
              <div class="details">
                <p class="color-black22"><?php esc_html_e( 'Job State', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ); ?></p>
                <p><?php echo esc_html( $jobInfo[ 'meta' ][ 'jobs' ][ 'state' ] ); ?></p>
              </div>
            <?php endif; ?>
						<?php if( is_FwpActive( 'gender' ) ) : ?>
              <div class="icon text-thm">
                <span class="fa fa-male"></span>
                <!-- <img src="<?php // echo esc_url( apply_filters( 'futurewordpress/project/job/icons', 'gender' ) ); ?>" alt=""> -->
              </div>
              <div class="details">
                <p class="color-black22"><?php esc_html_e( 'Gender', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ); ?></p>
                <p><?php echo esc_html( ucfirst( $jobInfo[ 'meta' ][ 'jobs' ][ 'gender' ] ) ); ?></p>
              </div>
            <?php endif; ?>
						<?php if( is_FwpActive( 'career' ) ) : ?>
              <div class="icon text-thm">
                <span class="flaticon-controls"></span>
                <!-- <img src="<?php // echo esc_url( apply_filters( 'futurewordpress/project/job/icons', 'line-chart' ) ); ?>" alt=""> -->
              </div>
              <div class="details">
                <p class="color-black22">Career Level</p>
                <p><?php echo esc_html( $jobInfo[ 'meta' ][ 'jobs' ][ 'careerlevel' ] ); ?></p>
              </div>
            <?php endif; ?>
						<div class="icon text-thm">
							<span class="flaticon-line-chart"></span>
							<!-- <img src="<?php // echo esc_url( apply_filters( 'futurewordpress/project/job/icons', 'controls' ) ); ?>" alt=""> -->
						</div>
						<div class="details">
							<p class="color-black22"><?php esc_html_e( 'Industry', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ); ?></p>
							<p><?php esc_html_e( 'Management', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ); ?></p>
						</div>
						<?php if( is_FwpActive( 'experience' ) ) : ?>
              <div class="icon text-thm">
                <span class="flaticon-mortarboard"></span>
                <!-- <img src="<?php // echo esc_url( apply_filters( 'futurewordpress/project/job/icons', 'graduate-cap' ) ); ?>" alt=""> -->
              </div>
              <div class="details">
                <p class="color-black22">Experience</p>
                <p><?php echo esc_html( $jobInfo[ 'meta' ][ 'jobs' ][ 'experienceshort' ] ); ?></p>
              </div>
            <?php endif; ?>
						<?php if( is_FwpActive( 'qualification' ) ) : ?>
              <div class="icon text-thm">
                <span class="flaticon-paper"></span>
                <!-- <img src="<?php // echo esc_url( apply_filters( 'futurewordpress/project/job/icons', 'certificate' ) ); ?>" alt=""> -->
              </div>
              <div class="details">
                <p class="color-black22">Qualification</p>
                <p><?php echo esc_html( $jobInfo[ 'meta' ][ 'jobs' ][ 'qualification' ] ); ?></p>
              </div>
            <?php endif; ?>
					</div>
					<div class="job_info_widget">
						<ul>
							<?php if( is_FwpActive( 'time_ago' ) && isset( $jobInfo[ 'meta' ][ 'jobs' ][ 'fromtoday' ] ) ) : ?>
								<li>
									<span class="flaticon-24-hours-support text-thm2"></span>
									<!-- <img class="text-thm2" src="<?php // echo esc_url( apply_filters( 'futurewordpress/project/job/icons', 'clock' ) ); ?>" alt=""> -->
                  <?php
									if( ! isset( $jobInfo[ 'meta' ][ 'jobs' ][ 'is_expired' ] ) || $jobInfo[ 'meta' ][ 'jobs' ][ 'is_expired' ] ) {
										?>
										<span><?php echo esc_html( number_format_i18n( abs( $jobInfo[ 'meta' ][ 'jobs' ][ 'fromtoday' ] ), 0 ) ); ?></span> <span><?php esc_html_e( 'Day Expired', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ); ?></span></li>
										<?php
									} else {
										?>
										<span><?php echo esc_html( number_format_i18n( abs( $jobInfo[ 'meta' ][ 'jobs' ][ 'fromtoday' ] ), 0 ) ); ?></span> <span><?php esc_html_e( 'Day', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ); ?></span></li>
										<?php
									}
									?>
							<?php endif; ?>
							<?php if( is_FwpActive( 'viewed' ) ) :
								$seen = get_post_meta( $post->ID, 'fwp_seenjob', true );
								if( ! $seen || $seen <= 0 ) {$seen = 1;}
								update_post_meta( $post->ID, 'fwp_seenjob', ( $seen + 1 ) );
								?>
								<li>
									<span class="flaticon-zoom-in text-thm2"></span>
									<!-- <img class="text-thm2" src="<?php // echo esc_url( apply_filters( 'futurewordpress/project/job/icons', 'eye-open' ) ); ?>" alt=""> -->
                  <span><?php echo esc_html( number_format_i18n( $seen, 0 ) ); ?></span> <span><?php esc_html_e( 'Displayed', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ); ?></h5></li>
							<?php endif; ?>
							<?php if( is_FwpActive( 'applied' ) ) : ?>
								<li>
									<span class="flaticon-businessman-paper-of-the-application-for-a-job text-thm2"></span>
									<!-- <img class="text-thm2" src="<?php // echo esc_url( apply_filters( 'futurewordpress/project/job/icons', 'resume' ) ); ?>" alt="">  -->
                  <span><?php
                  $applied = apply_filters( 'futurewordpress/project/job/apply/range', [
                    'job' => $post->ID
                  ] );
                  echo esc_html( $applied );
                  ?></span> <span><?php esc_html_e( 'Application', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ); ?></h5></li>
							<?php endif; ?>
						</ul>
					</div>
				</div>
				<?php endif; ?>
			</div>
		</div>
	</section>

  <?php do_action( 'futurewordpress/project/job/single/after', $jobInfo ); ?>
	<style>
		.candidate_personal_info .thumb img {max-width: 250px;min-height: 100px;}
	</style>
<?php get_footer(); ?>