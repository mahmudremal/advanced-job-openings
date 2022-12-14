<?php
/**
 * Job Application details template file
 * @package Aquila.
 */
$jobApplication = apply_filters( 'futurewordpress/project/job/apply/company', [
  'id' => $args[ 'job' ]
] );
$jobApplication = isset( $jobApplication[0] ) ? $jobApplication[0] : $jobApplication;
if( isset( $jobApplication->ID ) ) :
  ?>
	<section class="how-it-works bgc-fa">
		<div class="container">
			<div class="row">
				<div class="col-md-12 col-lg-12">
					<div class="how_it_works_sn">
						<!-- <div class="hiwc">1</div> -->
						<div class="details pl-0">
							<h4><?php esc_html_e( 'Cover Letter', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ); ?></h4>
							<p><?php echo esc_html( $jobApplication->coverletter ); ?></p>
              <ul class="view_edit_delete_list single mt25 float-right fn-xl p-0 m-0">
                <?php
                  $CV = apply_filters( 'futurewordpress/project/job/cv/get', [ 'id' => $jobApplication->cv_id ] );
                  $CV = isset( $CV[0] ) ? $CV[0] : $CV;
                  // print_r( $jobApplication );
                  if( isset( $CV->ID ) ) : ?>
                    <?php if( $jobApplication->is_approved == 0 ) : ?>
                      <li class="list-inline-item">
                        <a href="javascript:void(0);" class="mark-job-fwp" data-markas="approved" data-id="<?php echo esc_attr( $jobApplication->ID ); ?>" data-user_id="<?php echo esc_attr( $jobApplication->user_id ); ?>" data-job_id="<?php echo esc_attr( $jobApplication->job_id ); ?>" data-cv_id="<?php echo esc_attr( $jobApplication->cv_id ); ?>" data-nonce="<?php echo esc_attr( wp_create_nonce( 'fwp-company-approve-job-action-' . $jobApplication->ID ) ); ?>" data-toggle="tooltip" data-placement="top" title="<?php esc_attr_e( 'Mark Job Approved', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ); ?>"><span class="flaticon-fax"></span> <?php esc_html_e( 'Mark Job Approved', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ); ?></a>
                      </li>
                    <?php elseif( $jobApplication->is_approved != 0 && $jobApplication->is_paid == 0 ) : ?>
                      <li class="list-inline-item">
                        <a href="javascript:void(0);" class="ma rk-job-fwp" data-markas="paid" data-id="<?php echo esc_attr( $jobApplication->ID ); ?>" data-user_id="<?php echo esc_attr( $jobApplication->user_id ); ?>" data-job_id="<?php echo esc_attr( $jobApplication->job_id ); ?>" data-cv_id="<?php echo esc_attr( $jobApplication->cv_id ); ?>" data-nonce="<?php // echo esc_attr( wp_create_nonce( 'fwp-company-approve-job-action-' . $jobApplication->ID ) ); ?>" data-toggl-e="tooltip" data-placement="top" title="<?php esc_attr_e( 'Mark as Paid', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ); ?>" data-toggle="modal" data-target="#fwpMarkAsPaidJob"><span class="flaticon-fax"></span> <?php esc_html_e( 'Mark as Paid', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ); ?></a>
                      </li>
                    <?php else: ?>
                    <?php endif; ?>
                    <li class="list-inline-item">
                      <a href="<?php echo esc_url( site_url( str_replace( [ ABSPATH ], [ '' ], $CV->cv_path ) ) ); ?>" download="<?php echo esc_attr( pathinfo( $CV->cv_path, PATHINFO_FILENAME ) ); ?>" data-toggle="tooltip" data-placement="top" title="<?php esc_attr_e( 'Download CV', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ); ?>"><span class="flaticon-resume"></span> <?php esc_html_e( 'Download CV', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ); ?></a>
                    </li>
                    <li class="list-inline-item">
                      <a href="javascript:void(0);" class="delete-cv-fwp" data-toggle="tooltip" data-placement="top" title="<?php esc_attr_e( 'Delete', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ); ?>" data-id="<?php echo esc_attr( $jobApplication->ID ); ?>" data-name="<?php echo esc_attr( $CV->cv_name ); ?>" data-is-company="true"><span class="flaticon-rubbish-bin"></span></a>
                    </li>
                  <?php endif; ?>
              </ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
  <!-- Modal -->
  <div class="sign_up_modal modal fade" id="fwpMarkAsPaidJob" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="model-body">
          <div class="login_form">
            <form action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" method="post" enctype="multipart/form-data">
              <input type="hidden" name="action" value="fwp-job-markas-paid-by-company-action">
              <?php wp_nonce_field( 'fwp-job-markas-paid-by-company-action', 'fwp-job-markas-paid-by-company-action', true, true ); ?>
              <input type="hidden" name="fwp-job-markas-paid-by-company[id]" value="<?php echo esc_attr( $jobApplication->ID ); ?>">
              <input type="hidden" name="fwp-job-markas-paid-by-company[user_id]" value="<?php echo esc_attr( $jobApplication->user_id ); ?>">
              <input type="hidden" name="fwp-job-markas-paid-by-company[job_id]" value="<?php echo esc_attr( $jobApplication->job_id ); ?>">
              <input type="hidden" name="fwp-job-markas-paid-by-company[cv_id]" value="<?php echo esc_attr( $jobApplication->cv_id ); ?>">

              <div class="heading mb-4">
                <h3 class="text-center"><?php esc_html_e( 'Mark Job as Paid', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ); ?></h3>
                <p class="text-center"><?php esc_html_e( 'Submit any short comment that should included on Invoice as note. Try to control it less then 300 keys.', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ); ?></p>
              </div>
              <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-12">
                  <div class="ui_kit_input">
                    <form>
                      <div class="form-group">
                        <h5 class="fz16 mb5"><?php esc_html_e( 'Payable', 'domain' ); ?></h5>
                        <input type="number" class="form-control h50" placeholder="<?php esc_attr_e( 'Payment value.', 'domain' ); ?>" name="fwp-job-markas-paid-by-company[payable]">
                      </div>
                    </form>
                  </div>
                  <div class="ui_kit_select_search">
                    <h5 class="fz16 mb5 mt10"><?php esc_html_e( 'Currency', 'domain' ); ?></h5>
                    <select class="selectpicker" data-live-search="true" data-width="100%" name="fwp-job-markas-paid-by-company[currency]">
                      <?php
                        $getCurrency = apply_filters( 'futurewordpress/project/job/currencies', [ 'USD', 'EUR' ] );
                        foreach( $getCurrency as $t => $tk ) {
                          ?>
                          <option data-tokens="<?php echo esc_attr( $tk ); ?>" value="<?php echo esc_attr( $tk ); ?>"><?php echo esc_html( $tk ); ?></option>
                          <?php
                        } 
                      ?>
                    </select>
                  </div>
                  <div class="ui_kit_textarea">
                    <div class="form-group">
                        <h5 class="fz16 mb5 mt10"><?php esc_html_e( 'Note/Comment.', 'domain' ); ?></h5>
                        <textarea class="form-control"  name="fwp-job-markas-paid-by-company[note]" rows="5"></textarea>
                    </div>
                  </div>
                  <button type="submit" class="btn btn-log btn-block btn-dark"><?php esc_html_e( 'Mark as Paid', 'domain' ); ?></button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php else : ?>
  <div class="container">
    <div class="row col-12">
      <div class="col-md-12 col-lg-12">
        <svg class="error svg" id="Layer_1" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 400 300" width="406" height="306" class="illustration styles_illustrationTablet__1DWOa"><path d="M286.63,221.35s-3.49-7.46,1.1-10.18,11.83,2.21,10,6a8.27,8.27,0,0,1-6,4.22Z" fill="#68e1fd" opacity="0.73"></path><path d="M253.94,125.26s17,26.08,0,76.89" fill="none" stroke="#24285b" stroke-linecap="round" stroke-linejoin="round" stroke-width="8"></path><path d="M144.16,141s-20.43,24-11.75,36,30.46,1.6,37.57-21.63" fill="none" stroke="#24285b" stroke-linecap="round" stroke-linejoin="round" stroke-width="8"></path><path d="M137.69,135.16s-8.48,1.35-7.52,7.74,10.89,14.66,17.82,12,3.32-13.9,3.32-13.9Z" fill="#ffd200"></path><path d="M137.69,135.16s-8.48,1.35-7.52,7.74,10.89,14.66,17.82,12,3.32-13.9,3.32-13.9Z" fill="#fff" opacity="0.44"></path><path d="M172.51,82.61a10.12,10.12,0,0,0-10.13-10.13,9.87,9.87,0,0,0-1.63.14,13.63,13.63,0,0,0-12-7.19l-.5,0a16.38,16.38,0,0,0,.5-3.92,16.21,16.21,0,1,0-32.42,0,16.38,16.38,0,0,0,.5,3.92l-.5,0a13.66,13.66,0,0,0,0,27.31H163.7v-.1A10.11,10.11,0,0,0,172.51,82.61Z" fill="#efefef"></path><path d="M251,61.47a7.55,7.55,0,0,1,7.55-7.55,6.89,6.89,0,0,1,1.21.11,10.18,10.18,0,0,1,9-5.36l.37,0a12.31,12.31,0,0,1-.37-2.93,12.09,12.09,0,1,1,24.17,0,11.83,11.83,0,0,1-.38,2.93l.38,0a10.18,10.18,0,0,1,0,20.36H257.52V69A7.55,7.55,0,0,1,251,61.47Z" fill="#efefef"></path><ellipse cx="210.19" cy="235.87" rx="119.13" ry="12.31" fill="#e6e6e6" opacity="0.45"></ellipse><path d="M225.09,164.05s.59,30.87-5.63,52.54" fill="none" stroke="#24285b" stroke-linecap="round" stroke-linejoin="round" stroke-width="8"></path><polygon points="231.78 194.92 210.64 194.92 210.64 235.25 250.95 235.25 229.49 222.09 231.78 194.92" fill="#ffd200"></polygon><path d="M192.67,164.05s-6.22,30.87,0,52.54" fill="none" stroke="#24285b" stroke-linecap="round" stroke-linejoin="round" stroke-width="8"></path><circle cx="204.61" cy="114.83" r="62.21" fill="#68e1fd"></circle><path d="M242.19,65.37A62.2,62.2,0,0,1,156.13,154a62.21,62.21,0,1,0,86.06-88.6Z" opacity="0.09"></path><ellipse cx="183.53" cy="103.95" rx="6" ry="13.24" transform="translate(-16.9 38.24) rotate(-11.37)" fill="#24285b"></ellipse><ellipse cx="219.46" cy="96.72" rx="6" ry="13.24" transform="translate(-14.77 45.18) rotate(-11.37)" fill="#24285b"></ellipse><path d="M241.49,146.54s-6.71-24-33.76-17.7S184.44,158,184.44,158" fill="none" stroke="#24285b" stroke-linecap="round" stroke-linejoin="round" stroke-width="3"></path><ellipse cx="173.54" cy="124.32" rx="9" ry="4.76" transform="translate(-21.11 36.67) rotate(-11.37)" fill="#fff" opacity="0.36"></ellipse><ellipse cx="237.72" cy="111.41" rx="9" ry="4.76" transform="translate(-17.3 49.07) rotate(-11.37)" fill="#fff" opacity="0.36"></ellipse><polygon points="179.73 192.82 200.59 196.31 193.93 236.09 154.18 229.44 177.51 220 179.73 192.82" fill="#ffd200"></polygon><path d="M250.41,189.2s-12.7.88-11.56,7.82,6.64,6.93,6.64,6.93-5,13.46,7.22,13.77,18.62-15.14,15-24.54S250.41,189.2,250.41,189.2Z" fill="#ffd200"></path><path d="M269.44,179.61s-27.43-9.29-26.51,2.14,15.7,9.66,23.86,11.3S279.45,184.27,269.44,179.61Z" fill="#ffd200"></path><path d="M269.44,179.61s-27.43-9.29-26.51,2.14,15.7,9.66,23.86,11.3S279.45,184.27,269.44,179.61Z" fill="#fff" opacity="0.44"></path><polygon points="282.1 221.35 284.06 234.73 296.37 234.78 298.19 221.42 282.1 221.35" fill="#24285b"></polygon><path d="M174.2,96.72a17.86,17.86,0,0,0,8.38-12.44" fill="none" stroke="#24285b" stroke-linecap="round" stroke-linejoin="round" stroke-width="3"></path><path d="M212.63,78.55a24.65,24.65,0,0,0,13.66,9.36" fill="none" stroke="#24285b" stroke-linecap="round" stroke-linejoin="round" stroke-width="3"></path><path d="M137.8,122.57s-4.62-27.91,8.29-24c8.19,2.5.27,16.46,3,24s8.66,19.2,2.81,23.44S135.32,149.58,137.8,122.57Z" fill="#ffd200"></path><path d="M290.14,221.39s-.28-6.3,5.59-6.73,11.15,9.36,6.64,15.23l-4.6-8.34Z" fill="#68e1fd"></path><path d="M290.14,221.39s-1.83-7.44-8-6.74-8.58,8.86-5.18,14.22l5.18-7.52Z" fill="#68e1fd" opacity="0.58"></path></svg>
      </div>
    </div>
  </div>
<?php endif; ?>