<?php
/**
 * Company single template
 * @package Aquila.
 */
  get_header();
  // global $post;
  // header breadcumbs contents
	
  $companyInfo = apply_filters( 'futurewordpress/project/rendercompany', [], $post );
	$companyInfo[ 'review' ] = false;
	do_action( 'futurewordpress/project/company/single/before', $companyInfo );

	do_action( 'futurewordpress/project/company/single/header/before', $companyInfo );
	
  echo apply_filters( 'futurewordpress/project/company/single/header', '', $companyInfo );

	do_action( 'futurewordpress/project/company/single/header/after', $companyInfo );

  ?>
  <!-- <pre style="display: none;"><?php // print_r( [ FUTUREWORDPRESS_PROJECT_OPTIONS, $companyInfo ] ); ?></pre> -->
	
	<!-- Company Info Details-->
	<section class="employe_details">
		<div class="container">
			<div class="row">
				<?php do_action( 'futurewordpress/project/company/single/content/before', $companyInfo ); ?>
				<div class="<?php echo esc_attr( is_FwpActive( 'company-sidebar' ) ? 'col-xl-8' : 'col-xl-12' ); ?>">
					<div class="row">
						<div class="col-lg-12">
							<div class="candidate_about_info style2">
								<h4 class="fz20 mb30"><?php esc_html_e( FUTUREWORDPRESS_PROJECT_OPTIONS[ 'company_about_txt' ], FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ); ?></h4>
								<p class="mb30"><?php echo esc_html( isset( $companyInfo[ 'meta' ][ 'company' ][ 'about' ] ) ? $companyInfo[ 'meta' ][ 'company' ][ 'about' ] : '' ); ?></p>
							</div>
						</div>
						<?php if( is_FwpActive( 'company-social-share' ) ) : ?>
						<div class="col-lg-12">
							<div class="job_shareing">
								<div class="candidate_social_widget bgc-fa">
									<ul>
										<li><?php esc_html_e( FUTUREWORDPRESS_PROJECT_OPTIONS[ 'share_this_company_txt' ], FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ); ?>:</li>
										<?php
                    $socialShare = apply_filters( 'futurewordpress/project/company/single/social', '', [] );
                    foreach( $socialShare as $sSi => $sSLink ) :
                      ?>
                      <li><a href="<?php echo esc_url( $sSLink ); ?>" target="_blank"><i class="fa fa-<?php echo esc_attr( $sSi ); ?>"></i></a></li>
                    <?php endforeach; ?>
									</ul>
								</div>
							</div>
						</div>
						<?php endif; ?>

						<?php if( is_FwpActive( 'company-openposition' ) ) : ?>
							<div class="col-lg-12">
								<div class="my_resume_eduarea">
									<h4 class="title mb30"><?php esc_html_e( FUTUREWORDPRESS_PROJECT_OPTIONS[ 'company_open_position_txt' ], FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ); ?></h4>
								</div>
							</div>
							<?php do_shortcode( '[company-open_position company="' . ( isset( $companyInfo[ 'meta' ][ 'company' ][ 'authorizeid' ] ) ? $companyInfo[ 'meta' ][ 'company' ][ 'authorizeid' ] : $companyInfo[ 'post' ]->post_author ) . '"]' ); ?>
						<?php endif; ?>
						<?php if( $companyInfo[ 'review' ] ) : ?>
							<div class="col-lg-12">
								<div class="candidate_review_posted style2">
									<h4 class="title mb30">Company Review</h4>
									<div class="details">
										<img class="img-fluid rounded-circle float-left" src="images/team/1.jpg" alt="1.jpg">
										<h4>Best Company
											<ul class="review float-right">
												<li class="list-inline-item"><a class="av_review" href="#">4.5</a></li>
												<li class="list-inline-item"><a href="#"><i class="fa fa-star"></i></a></li>
												<li class="list-inline-item"><a href="#"><i class="fa fa-star"></i></a></li>
												<li class="list-inline-item"><a href="#"><i class="fa fa-star"></i></a></li>
												<li class="list-inline-item"><a href="#"><i class="fa fa-star"></i></a></li>
												<li class="list-inline-item"><a href="#"><i class="fa fa-star-o"></i></a></li>
											</ul>
										</h4>
										<ul class="meta">
											<li class="list-inline-item"><a class="text-thm2" href="#">Ali Tufan</a></li>
											<li class="list-inline-item"><a href="#"><span class="flaticon-event"></span> 2 days ago</a></li>
										</ul>
										<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce vel augue eget quam fermentum sodales. Aliquam vel congue sapien, quis mollis quam.</p>
									</div>
									<div class="details pt0">
										<img class="img-fluid rounded-circle float-left" src="images/team/2.jpg" alt="2.jpg">
										<h4>Aldus PageMaker including versions
											<ul class="review float-right">
												<li class="list-inline-item"><a class="av_review" href="#">4.5</a></li>
												<li class="list-inline-item"><a href="#"><i class="fa fa-star"></i></a></li>
												<li class="list-inline-item"><a href="#"><i class="fa fa-star"></i></a></li>
												<li class="list-inline-item"><a href="#"><i class="fa fa-star"></i></a></li>
												<li class="list-inline-item"><a href="#"><i class="fa fa-star"></i></a></li>
												<li class="list-inline-item"><a href="#"><i class="fa fa-star-o"></i></a></li>
											</ul>
										</h4>
										<ul class="meta">
											<li class="list-inline-item"><a class="text-thm2" href="#">Dominikus Yuri</a></li>
											<li class="list-inline-item"><a href="#"><span class="flaticon-event"></span> 23 August 2018</a></li>
										</ul>
										<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce vel augue eget quam fermentum sodales. Aliquam vel congue sapien, quis mollis quam.</p>
									</div>
								</div>
							</div>
							<div class="col-lg-12">
								<h4 class="title" style="font-size: 20px;">Leave Your Review</h4>
								<div class="candidate_leave_review text-center">
									<div class="detials">
										<form id="review-form" class="ulockd-mrgn630" action="#" method="post">
												<h4>What is it like to work at Martha</h4>
												<div class="star-rating">
													<input type="radio" name="ratings[1]" id="Overall_5" value="5" class="radio">
													<label for="Overall_5"></label>
													<input type="radio" name="ratings[1]" id="Overall_4" value="4" class="radio">
													<label for="Overall_4"></label>
													<input type="radio" name="ratings[1]" id="Overall_3" value="3" class="radio">
													<label for="Overall_3"></label>
													<input type="radio" name="ratings[1]" id="Overall_2" value="2" class="radio">
													<label for="Overall_2"></label>
													<input type="radio" name="ratings[1]" id="Overall_1" value="1" class="radio">
													<label for="Overall_1"></label>
												</div>
											<div class="form-group text-left">
													<label class="title" for="name2">Review Title</label>
													<input class="form-control" type="text" name="name2" id="name2" value="">
											</div>
											<div class="form-group text-left">
													<label class="control-label title" for="review">Review Content</label>
													<textarea class="form-control" rows="5" name="review" id="review"></textarea>
												<a href="#" class="btn btn-lg btn-thm">Submit Review <span class="flaticon-right-arrow"></span></a>
											</div>
										</form>
									</div>
								</div>
							</div>
						<?php endif; ?>
					</div>
				</div>
				<?php if( is_FwpActive( 'company-sidebar' ) ) : ?>
					<div class="col-xl-4">
						<?php if( is_FwpActive( 'company-single-map' ) ) : ?>
						<div class="map_sidebar_widget mb30">
							<h4 class="fz20 mb30"><?php esc_html_e( 'Location', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ); ?></h4>
							<div class="h300" id="map-canvas" data-args="<?php echo esc_attr( json_encode( ['location' => $companyInfo[ 'meta' ][ 'company' ][ 'location' ]] ) ); ?>"></div>
						</div>
						<?php endif; ?>
							<h4 class="fz20 mb30"><?php esc_html_e( 'Company Information', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ); ?></h4>
							<div class="candidate_working_widget style2 bgc-fa">
								<?php if( is_FwpActive( 'company-viewed' ) ) :
									$seen = get_post_meta( $post->ID, 'fwp_seen_company', true );
									if( ! $seen || $seen <= 0 ) {$seen = 1;}
									update_post_meta( $post->ID, 'fwp_seen_company', ( $seen + 1 ) );
									?>
									<div class="icon text-thm"><span class="flaticon-eye"></span></div>
									<div class="details">
										<p class="color-black22"><?php esc_html_e( 'Viewed', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ); ?></p>
										<p><?php echo esc_html( number_format_i18n( $seen, 0 ) ); ?></p>
									</div>
								<?php endif; ?>
								<?php if( is_FwpActive( 'company-viewed' ) ) : ?>
									<div class="icon text-thm"><span class="flaticon-label"></span></div>
									<div class="details">
										<p class="color-black22"><?php esc_html_e( 'Posted Jobs', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ); ?></p>
										<p><?php echo esc_html( count_user_posts( ( isset( $companyInfo[ 'meta' ][ 'company' ][ 'authorizeid' ] ) ? $companyInfo[ 'meta' ][ 'company' ][ 'authorizeid' ] : $companyInfo[ 'post' ]->post_author ), FUTUREWORDPRESS_PROJECT_CPT_JOB_OPENINGS, false ) ); ?></p>
									</div>
								<?php endif; ?>
								<?php if( is_FwpActive( 'company-address' ) ) : ?>
									<div class="icon text-thm"><span class="flaticon-paper-plane"></span></div>
									<div class="details">
										<p class="color-black22"><?php esc_html_e( 'Locations', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ); ?></p>
										<p><?php echo esc_html( isset( $companyInfo[ 'meta' ][ 'company' ][ 'address' ] ) ? $companyInfo[ 'meta' ][ 'company' ][ 'address' ] : (
                      isset( $companyInfo[ 'meta' ][ 'company' ][ 'location' ] ) ? $companyInfo[ 'meta' ][ 'company' ][ 'location' ] : ''
                    ) ); ?></p>
									</div>
								<?php endif; ?>
								<?php if( is_FwpActive( 'company-category' ) ) : ?>
									<div class="icon text-thm"><span class="flaticon-2-squares"></span></div>
									<div class="details">
										<p class="color-black22"><?php esc_html_e( 'Categories', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ); ?></p>
										<p><?php echo esc_html( implode( ', ', $companyInfo[ 'terms' ] ) ); ?></p>
									</div>
								<?php endif; ?>
								<?php if( is_FwpActive( 'company-since' ) ) : ?>
									<div class="icon text-thm"><span class="flaticon-timeline"></span></div>
									<div class="details">
										<p class="color-black22"><?php esc_html_e( 'Since', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ); ?></p>
										<p><?php echo esc_html( isset( $companyInfo[ 'meta' ][ 'company' ][ 'extblished' ] ) ? $companyInfo[ 'meta' ][ 'company' ][ 'extblished' ] : '' ); ?></p>
									</div>
								<?php endif; ?>
								<?php if( is_FwpActive( 'company-teamsize' ) ) : ?>
									<div class="icon text-thm"><span class="flaticon-team"></span></div>
									<div class="details">
										<p class="color-black22"><?php esc_html_e( 'Team Size', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ); ?></p>
										<p><?php echo esc_html( isset( $companyInfo[ 'meta' ][ 'company' ][ 'teamsize' ] ) ? $companyInfo[ 'meta' ][ 'company' ][ 'teamsize' ] : '' ); ?></p>
									</div>
								<?php endif; ?>
								<?php if( is_FwpActive( 'company-followers' ) ) : ?>
									<div class="icon text-thm"><span class="flaticon-user"></span></div>
									<div class="details">
										<p class="color-black22"><?php esc_html_e( 'Followers', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ); ?></p>
										<p>15</p>
									</div>
								<?php endif; ?>
							</div>
						<?php if( is_FwpActive( 'company-contactmail' ) ) : ?>
							<h4 class="fz20 mb30"><?php esc_html_e( 'Contact', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ); ?></h4>
							<div class="candidate_contact_form bgc-fa">
								<?php
									$userInfo = ( is_user_logged_in() ) ? wp_get_current_user() : (object) [
										'user_nicename' => '',
										'user_email' => ''
									];
								?>
								<form action="" method="post">
									<div class="form-group">
											<input type="text" class="form-control" id="fwp-contact-company-name" placeholder="<?php echo esc_attr( __( 'Your Name', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ) ); ?>" name="fwp-contact-company-form[name]" value="<?php echo esc_attr( $userInfo->user_nicename ); ?>">
									</div>
										<div class="form-group">
											<input type="email" class="form-control" id="fwp-contact-company-email" placeholder="<?php echo esc_attr( __( 'Your Email', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ) ); ?>" name="fwp-contact-company-form[email]" value="<?php echo esc_attr( $userInfo->user_email ); ?>">
										</div>
									<div class="form-group">
											<input type="text" class="form-control" id="fwp-contact-company-subject" placeholder="<?php echo esc_attr( __( 'Subject', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ) ); ?>" name="fwp-contact-company-form[subject]">
									</div>
									<div class="form-group">
											<textarea class="form-control" id="fwp-contact-company-message" rows="5" placeholder="<?php echo esc_attr( __( 'Message', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ) ); ?>" name="fwp-contact-company-form[message]"></textarea>
									</div>
										<button type="submit" class="btn btn-block btn-thm"><?php esc_html_e( 'Send Now', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ); ?> <span class="flaticon-right-arrow"></span></button>
								</form>
							</div>
						<?php endif; ?>
						<?php do_action( 'futurewordpress/project/company/single/sidebar/after', $companyInfo ); ?>
					</div>
				<?php endif; ?>
				<?php do_action( 'futurewordpress/project/company/single/content/after', $companyInfo ); ?>
			</div>
		</div>
	</section>
	<?php do_action( 'futurewordpress/project/company/single/after', $companyInfo ); ?>
	<style>
    .candidate_personal_info .thumb img {max-width: 250px;min-height: 100px;}
	</style>
<?php get_footer(); ?>