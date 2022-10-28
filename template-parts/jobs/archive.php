<?php
/**
 * Archive Job template for frontend.
 *
 * @package Aquila
 */
get_header();
global $wp_query;
$jobFilters = ( isset( FUTUREWORDPRESS_PROJECT_OPTIONS[ 'joblist-filters' ] ) && FUTUREWORDPRESS_PROJECT_OPTIONS[ 'joblist-filters' ] == 'on' );
$jobAlert = ( isset( FUTUREWORDPRESS_PROJECT_OPTIONS[ 'job_alerts' ] ) && FUTUREWORDPRESS_PROJECT_OPTIONS[ 'job_alerts' ] == 'on' );
?>


	<!-- Our Candidate List -->
	<section class="our-faq bgc-fa mt50">
		<div class="container">
			<div class="row">
				<?php
					if( $jobFilters ) {
						echo apply_filters( 'futurewordpress/project/job/list/filters', '', [] );
					}
				?>
				<div class="col-md-12 <?php echo esc_attr( ( $jobFilters ) ? 'col-lg-9 col-xl-9' : 'col-lg-12 col-xl-12' ); ?>">
					<?php if( $jobFilters ) : ?>
						<?php // echo apply_filters( 'futurewordpress/project/job/archive/before/content', '', [] ); ?>
					<?php endif; ?>
					<div class="row">
						<div class="col-sm-12 col-lg-6">
							<div class="candidate_job_alart_btn">
								<!-- <h4 class="fz20 mb15"><?php // echo esc_html( sprintf( __( '%s Jobs Found', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ), number_format_i18n( $wp_query->post_count, 0 ) ) ); ?></h4> -->
								<?php if( $jobAlert ) : ?>
									<a class="btn btn-thm" href="#"><span class="flaticon-mail"></span> Get Job Alerts</a>
								<?php endif; ?>
								<button class="btn btn-thm btns dn db-991 float-right">Show Filter</button>
							</div>
						</div>
						<div class="col-sm-12 col-lg-6" style="display: none;">
							<div class="candidate_revew_select text-right mt50 mt10-smd">
								<ul>
									<li class="list-inline-item">Sort by:</li>
									<li class="list-inline-item">
										<select class="selectpicker show-tick" name="sortby">
											<option value="new">Newest</option>
											<option value="recent">Recent</option>
											<option value="old">Old Review</option>
										</select>
									</li>
								</ul>
							</div>
							<div class="content_details">
								<div class="details">
                  <form action="<?php echo esc_url( site_url( FUTUREWORDPRESS_PROJECT_CPT_JOB_OPENINGS ) ); ?>" method="post">
                    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()"><span><?php esc_html_e( 'Hide Filter', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ); ?></span><i>×</i></a>
                    <div class="faq_search_widget mb30">
                      <h4 class="fz20 mb15"><?php esc_html_e( 'Search Keywords', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ); ?></h4>
                      <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Find Your Question" aria-label="Recipient's username" aria-describedby="button-addon2">
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary" type="submit" id="button-addon4"><span class="flaticon-search"></span></button>
                        </div>
                      </div>
                    </div>
                    <div class="faq_search_widget mb30">
                      <h4 class="fz20 mb15">Location</h4>
                      <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Find Your Question" aria-label="Recipient's username" aria-describedby="button-addon2">
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary" type="button" id="button-addon5"><span class="flaticon-location-pin"></span></button>
                        </div>
                      </div>
                    </div>
                    <div class="faq_search_widget mb30">
                      <h4 class="fz20 mb15">Category</h4>
                      <div class="candidate_revew_select">
                        <select class="selectpicker w100 show-tick">
                          <option>All Categories</option>
                          <option>Recent</option>
                          <option>Old Review</option>
                        </select>
                      </div>
                    </div>
                    <div class="cl_latest_activity mb30">
                      <h4 class="fz20 mb15">Date Posted</h4>
                      <div class="ui_kit_radiobox">
                        <div class="radio">
                          <input id="radio_six" name="radio" type="radio" checked="">
                          <label for="radio_six"><span class="radio-label"></span> Last Hour</label>
                        </div>
                        <div class="radio">
                          <input id="radio_seven" name="radio" type="radio">
                          <label for="radio_seven"><span class="radio-label"></span> Last 24 hours</label>
                        </div>
                        <div class="radio">
                          <input id="radio_eight" name="radio" type="radio">
                          <label for="radio_eight"><span class="radio-label"></span> Last 7 days</label>
                        </div>
                        <div class="radio">
                          <input id="radio_nine" name="radio" type="radio">
                          <label for="radio_nine"><span class="radio-label"></span> Last 14 days</label>
                        </div>
                        <div class="radio">
                          <input id="radio_ten" name="radio" type="radio">
                          <label for="radio_ten"><span class="radio-label"></span> Last 30 days</label>
                        </div>
                        <a class="text-thm2 pl30" href="#">View All <span class="flaticon-right-arrow pl10"></span></a>
                      </div>
                    </div>
                    <div class="cl_latest_activity mb30">
                      <h4 class="fz20 mb15">Job Type</h4>
                      <div class="ui_kit_whitchbox">
                        <div class="custom-control custom-switch">
                          <input type="checkbox" class="custom-control-input" id="customSwitch6">
                          <label class="custom-control-label" for="customSwitch6">Freelance</label>
                        </div>
                        <div class="custom-control custom-switch">
                          <input type="checkbox" class="custom-control-input" id="customSwitch7">
                          <label class="custom-control-label" for="customSwitch7">Full Time</label>
                        </div>
                        <div class="custom-control custom-switch">
                          <input type="checkbox" class="custom-control-input" id="customSwitch8">
                          <label class="custom-control-label" for="customSwitch8">Part Time</label>
                        </div>
                        <div class="custom-control custom-switch">
                          <input type="checkbox" class="custom-control-input" id="customSwitch9">
                          <label class="custom-control-label" for="customSwitch9">Internship</label>
                        </div>
                        <div class="custom-control custom-switch">
                          <input type="checkbox" class="custom-control-input" id="customSwitch10">
                          <label class="custom-control-label" for="customSwitch10">Temporary</label>
                        </div>
                      </div>
                    </div>
                    <div class="cl_pricing_slider mb30">
                      <h4 class="fz20 mb20">Hourly Rate</h4>
                      <div id="slider-range2"></div>
                      <p class="text-center">
                        <input class="sl_input" type="text" id="amount2">
                      </p>
                    </div>
                    <div class="cl_skill_checkbox mb30">
                      <h4 class="fz20 mb20">Skills</h4>
                      <div class="content ui_kit_checkbox text-left">
                        <div class="custom-control custom-checkbox">
                          <input type="checkbox" class="custom-control-input" id="customCheck37">
                          <label class="custom-control-label" for="customCheck37">HTML 5</label>
                        </div>
                        <div class="custom-control custom-checkbox">
                          <input type="checkbox" class="custom-control-input" id="customCheck38">
                          <label class="custom-control-label" for="customCheck38">Javascript</label>
                        </div>
                        <div class="custom-control custom-checkbox">
                          <input type="checkbox" class="custom-control-input" id="customCheck39">
                          <label class="custom-control-label" for="customCheck39">PHP</label>
                        </div>
                        <div class="custom-control custom-checkbox">
                          <input type="checkbox" class="custom-control-input" id="customCheck40">
                          <label class="custom-control-label" for="customCheck40">jQuery</label>
                        </div>
                        <div class="custom-control custom-checkbox">
                          <input type="checkbox" class="custom-control-input" id="customCheck41">
                          <label class="custom-control-label" for="customCheck41">UX/UI Design</label>
                        </div>
                        <div class="custom-control custom-checkbox">
                          <input type="checkbox" class="custom-control-input" id="customCheck42">
                          <label class="custom-control-label" for="customCheck42">Design</label>
                        </div>
                        <div class="custom-control custom-checkbox">
                          <input type="checkbox" class="custom-control-input" id="customCheck43">
                          <label class="custom-control-label" for="customCheck43">Web Design</label>
                        </div>
                        <div class="custom-control custom-checkbox">
                          <input type="checkbox" class="custom-control-input" id="customCheck44">
                          <label class="custom-control-label" for="customCheck44">Graphic Design</label>
                        </div>
                        <div class="custom-control custom-checkbox">
                          <input type="checkbox" class="custom-control-input" id="customCheck45">
                          <label class="custom-control-label" for="customCheck45">Sketch App</label>
                        </div>
                        <div class="custom-control custom-checkbox">
                          <input type="checkbox" class="custom-control-input" id="customCheck46">
                          <label class="custom-control-label" for="customCheck46">UI Design</label>
                        </div>
                        <div class="custom-control custom-checkbox">
                          <input type="checkbox" class="custom-control-input" id="customCheck47">
                          <label class="custom-control-label" for="customCheck47">Graphic Design</label>
                        </div>
                        <div class="custom-control custom-checkbox">
                          <input type="checkbox" class="custom-control-input" id="customCheck48">
                          <label class="custom-control-label" for="customCheck48">Sketch App</label>
                        </div>
                        <div class="custom-control custom-checkbox">
                          <input type="checkbox" class="custom-control-input" id="customCheck49">
                          <label class="custom-control-label" for="customCheck49">UI Design</label>
                        </div>
                      </div>
                    </div>
                    <div class="cl_carrer_lever mb30">
                      <div id="accordion6" class="accordion">
                          <div class="link mb10">Career Level<i class="fa fa-caret-up"></i></div>
                          <div class="cl_submenu">
                          <div class="ui_kit_checkbox">
                            <div class="custom-control custom-checkbox">
                              <input type="checkbox" class="custom-control-input" id="customCheck50">
                              <label class="custom-control-label" for="customCheck50">Intermediate</label>
                            </div>
                            <div class="custom-control custom-checkbox">
                              <input type="checkbox" class="custom-control-input" id="customCheck51">
                              <label class="custom-control-label" for="customCheck51">Normal</label>
                            </div>
                            <div class="custom-control custom-checkbox">
                              <input type="checkbox" class="custom-control-input" id="customCheck52">
                              <label class="custom-control-label" for="customCheck52">Special</label>
                            </div>
                            <div class="custom-control custom-checkbox">
                              <input type="checkbox" class="custom-control-input" id="customCheck53">
                              <label class="custom-control-label" for="customCheck53">Experienced</label>
                            </div>
                          </div>
                          </div>
                      </div>
                    </div>
                    <div class="cl_carrer_lever mb30">
                      <div id="accordion7" class="accordion">
                          <div class="link mb10">Experince<i class="fa fa-caret-up"></i></div>
                          <div class="cl_submenu">
                          <div class="ui_kit_checkbox">
                            <div class="custom-control custom-checkbox">
                              <input type="checkbox" class="custom-control-input" id="customCheck54">
                              <label class="custom-control-label" for="customCheck54">1Year to 2Year</label>
                            </div>
                            <div class="custom-control custom-checkbox">
                              <input type="checkbox" class="custom-control-input" id="customCheck55">
                              <label class="custom-control-label" for="customCheck55">2Year to 3Year</label>
                            </div>
                            <div class="custom-control custom-checkbox">
                              <input type="checkbox" class="custom-control-input" id="customCheck56">
                              <label class="custom-control-label" for="customCheck56">3Year to 4Year</label>
                            </div>
                            <div class="custom-control custom-checkbox">
                              <input type="checkbox" class="custom-control-input" id="customCheck57">
                              <label class="custom-control-label" for="customCheck57">4Year to 5Year</label>
                            </div>
                          </div>
                          </div>
                      </div>
                    </div>
                    <div class="cl_carrer_lever mb30">
                      <div id="accordion8" class="accordion">
                          <div class="link mb10">Gender<i class="fa fa-caret-up"></i></div>
                          <div class="cl_submenu">
                          <div class="ui_kit_checkbox">
                            <div class="custom-control custom-checkbox">
                              <input type="checkbox" class="custom-control-input" id="customCheck58">
                              <label class="custom-control-label" for="customCheck58">Male</label>
                            </div>
                            <div class="custom-control custom-checkbox">
                              <input type="checkbox" class="custom-control-input" id="customCheck59">
                              <label class="custom-control-label" for="customCheck59">Female</label>
                            </div>
                            <div class="custom-control custom-checkbox">
                              <input type="checkbox" class="custom-control-input" id="customCheck60">
                              <label class="custom-control-label" for="customCheck60">Others</label>
                            </div>
                          </div>
                          </div>
                      </div>
                    </div>
                    <div class="cl_carrer_lever mb30">
                      <div id="accordion9" class="accordion">
                          <div class="link mb10">Industry<i class="fa fa-caret-up"></i></div>
                          <div class="cl_submenu">
                          <div class="ui_kit_checkbox">
                            <div class="custom-control custom-checkbox">
                              <input type="checkbox" class="custom-control-input" id="customCheck61">
                              <label class="custom-control-label" for="customCheck61">Development</label>
                            </div>
                            <div class="custom-control custom-checkbox">
                              <input type="checkbox" class="custom-control-input" id="customCheck62">
                              <label class="custom-control-label" for="customCheck62">Management</label>
                            </div>
                            <div class="custom-control custom-checkbox">
                              <input type="checkbox" class="custom-control-input" id="customCheck63">
                              <label class="custom-control-label" for="customCheck63">Finance</label>
                            </div>
                            <div class="custom-control custom-checkbox">
                              <input type="checkbox" class="custom-control-input" id="customCheck64">
                              <label class="custom-control-label" for="customCheck64">HTML Department</label>
                            </div>
                            <div class="custom-control custom-checkbox">
                              <input type="checkbox" class="custom-control-input" id="customCheck65">
                              <label class="custom-control-label" for="customCheck65">Seo</label>
                            </div>
                            <div class="custom-control custom-checkbox">
                              <input type="checkbox" class="custom-control-input" id="customCheck66">
                              <label class="custom-control-label" for="customCheck66">Banking</label>
                            </div>
                          </div>
                          </div>
                      </div>
                    </div>
                    <div class="cl_carrer_lever">
                      <div id="accordion10" class="accordion">
                          <div class="link mb10">Qualification<i class="fa fa-caret-up"></i></div>
                          <div class="cl_submenu">
                          <div class="ui_kit_checkbox">
                            <div class="custom-control custom-checkbox">
                              <input type="checkbox" class="custom-control-input" id="customCheck67">
                              <label class="custom-control-label" for="customCheck67">Certificate</label>
                            </div>
                            <div class="custom-control custom-checkbox">
                              <input type="checkbox" class="custom-control-input" id="customCheck68">
                              <label class="custom-control-label" for="customCheck68">Diploma</label>
                            </div>
                            <div class="custom-control custom-checkbox">
                              <input type="checkbox" class="custom-control-input" id="customCheck69">
                              <label class="custom-control-label" for="customCheck69">Associate</label>
                            </div>
                            <div class="custom-control custom-checkbox">
                              <input type="checkbox" class="custom-control-input" id="customCheck70">
                              <label class="custom-control-label" for="customCheck70">Degree Bachelor</label>
                            </div>
                            <div class="custom-control custom-checkbox">
                              <input type="checkbox" class="custom-control-input" id="customCheck71">
                              <label class="custom-control-label" for="customCheck71">Associate</label>
                            </div>
                            <div class="custom-control custom-checkbox">
                              <input type="checkbox" class="custom-control-input" id="customCheck72">
                              <label class="custom-control-label" for="customCheck72">Master's Degree</label>
                            </div>
                          </div>
                          </div>
                      </div>
                    </div>
                  </form>
								</div>
							</div>
						</div>
						<div class="col-lg-12 mt30"></div>
						<?php
              while ( have_posts() ) : the_post();
                if( ! $post ) {$post = get_post( get_the_ID() );}
                echo apply_filters( 'futurewordpress/project/job/card', $post, true );
              endwhile;
              wp_reset_postdata();
						?>
						
						<div class="col-lg-12">
							<div class="mbp_pagination">
										<?php
											// the_posts_pagination( [
											// 	// 'base'               => '%_%',
											// 	// 'format'             => '?paged=%#%',
											// 	// 'total'              => 1,
											// 	// 'current'            => 0,
											// 	// 'show_all'           => false,
											// 	// 'end_size'           => 1,
											// 	'mid_size'           => 2,
											// 	'prev_next'          => true,
											// 	'prev_text'          => __('« Previous'),
											// 	'next_text'          => __('Next »'),
											// 	'type'               => 'plain',
											// 	// 'add_args'           => false,
											// 	// 'add_fragment'       => '',
											// 	'before_page_number' => '<li class="page-item"><span class="page-link">',
											// 	'after_page_number'  => '</span></li>',
											// 	'screen_reader_text' => __( 'Jobs navigation', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN )
											// ] );
											$allowed_tags = [
												'span' => [
													'class' => []
												],
												'li' => [
													'class' => []
												],
												'a' => [
													'class' => [],
													'href' => [],
												]
											];
										
											$args = [
												'mid_size'           => 7,
												'prev_text'          => __('« Previous'),
												'next_text'          => __('Next »'),
												'before_page_number' => '<span class="page-link">',
												'after_page_number' => '</span>',
											];
										
											printf( '<nav class="page_navigation">%s</nav>', wp_kses( paginate_links( $args ), $allowed_tags ) );
										?>
								    <!-- <li class="page-item disabled">
                        <a class="page-link" href="#" tabindex="-1" aria-disabled="true"> <span class="flaticon-left-arrow"></span> Previous</a>
                      </li>
                      <li class="page-item active" aria-current="page">
                        <a class="page-link" href="#">2 <span class="sr-only">(current)</span></a>
                      </li>
                      <li class="page-item"><a class="page-link" href="#">3</a></li>
                      <li class="page-item"><a class="page-link" href="#">4</a></li>
                      <li class="page-item"><a class="page-link" href="#">5</a></li>
                      <li class="page-item"><a class="page-link" href="#">...</a></li>
                      <li class="page-item"><a class="page-link" href="#">45</a></li>
                      <li class="page-item">
                        <a class="page-link" href="#">Next <span class="flaticon-right-arrow"></span></a>
                      </li> -->
							</div>
						</div>

					</div>
          <?php echo apply_filters( 'futurewordpress/project/job/archive/after/content', '', [] ); ?>
				</div>
			</div>
		</div>
	</section>

	
<?php get_footer(); ?>