<?php
/**
 * Job Dashboard Job Apply form and Applied list template file
 * @package Aquila.
 */ // ;
if( isset( $args[ 'job' ] ) ) :
  $apply = apply_filters( 'futurewordpress/project/job/apply/get', [ 'job' => $args[ 'job' ], 'user' => get_current_user_id() ] );
  $is_edit = ( count( $apply ) >= 1 );
  $apply = (array) end( $apply );
  $apply = wp_parse_args( $apply, [
    'ID' => 0,
    'cv_id' => 0,
    'user_id' => get_current_user_id(),
    'job_id' => $args[ 'job' ],
    'coverletter' => ''
  ] );
  ?>
  <form class="row col-12" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" method="post" enctype="multipart/form-data">
    <input type="hidden" name="fwp-apply-job-<?php echo esc_attr( ( $is_edit ) ? 'edit' : 'add' ); ?>" value="<?php echo esc_attr( $args[ 'job' ] ); ?>">
    <input type="hidden" name="action" value="fwp-apply-job-action">
    <?php wp_nonce_field( 'fwp-apply-job-action', 'fwp-apply-job-action', true, true ); ?>
    <div class="col-lg-12">
      <div class="candidate_resume_select">
        <label for="fwp-apply-job-cv"><?php esc_html_e( 'Select Your CV', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ); ?></label><br>
        <select class="selectpicker show-tick" id="fwp-apply-job-cv" name="fwp-apply-job[cv]">
          <?php
            $getCV = apply_filters( 'futurewordpress/project/job/cv/get', [
              'user' => get_current_user_id()
            ] );
            ?>
            <?php foreach( $getCV as $cv ) : ?>
              <option value="<?php echo esc_attr( $cv->ID ); ?>" <?php echo esc_attr( ( $apply[ 'cv_id' ] == $cv->ID ) ? 'selected' : '' ); ?>><?php echo esc_attr( $cv->cv_name ); ?></option>
            <?php endforeach; ?>
        </select>
      </div>
    </div>
    <div class="col-lg-12">
      <div class="my_resume_textarea mt20">
          <div class="form-group">
            <label for="fwp-apply-job-text"><?php esc_html_e( 'Cover Letter', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ); ?></label>
            <textarea class="form-control" id="fwp-apply-job-text" rows="9" name="fwp-apply-job[coverletter]"><?php echo wp_kses_post( $apply[ 'coverletter' ] ); ?></textarea>
          </div>
      </div>
    </div>
    <div class="col-lg-4">
      <div class="my_profile_input">
        <button type="submit" class="btn btn-lg btn-thm"><?php esc_html_e( 'Send Application', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ); ?></button>
      </div>
    </div>
  </form>
<?php else: ?>
  <?php
  $applications = apply_filters( 'futurewordpress/project/job/apply/get', [ 'user' => get_current_user_id() ] );
  foreach( $applications as $apply ) :
    $job = get_post( $apply->job_id );
    $jobInfo = apply_filters( 'futurewordpress/project/renderpost', [], $job );
    //  print_r( $jobInfo );
    ?>
    <div class="row applyed_job col-12">
      <div class="col-sm-12 col-lg-12">
        <div class="fj_post">
          <div class="details">
            <h5 class="job_chedule text-thm mt0"><?php echo esc_html( implode( ' | ', $jobInfo[ 'terms' ] ) ); ?></h5>
            <div class="thumb fn-smd">
              <a class="thumb fn-smd" href="<?php echo esc_url( get_the_permalink( $jobInfo[ 'post' ]->ID ) ); ?>">
                <img class="img-fluid" src="<?php echo esc_url( (
                  isset( $jobInfo[ 'meta' ][ 'company' ][ 'logo' ] ) && ! empty( $jobInfo[ 'meta' ][ 'company' ][ 'logo' ] ) ? $jobInfo[ 'meta' ][ 'company' ][ 'logo' ] : FUTUREWORDPRESS_PROJECT_BUILD_IMG_URI . '/placeholder.png'
                ) ); ?>" alt="<?php esc_attr_e( 'Logo', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ); ?>">
              </a>
            </div>
            <a href="<?php echo esc_url( get_the_permalink( $jobInfo[ 'post' ]->ID ) ); ?>">
              <h4><?php echo esc_html( $jobInfo[ 'post' ]->post_title ); ?></h4>
            </a>
            <p><?php echo wp_kses_post( apply_filters( 'futurewordpress/project/job/info/postedon', $jobInfo ) ); ?></p>
            <ul class="featurej_post">
              <li class="list-inline-item"><span class="flaticon-location-pin"></span> <?php echo esc_html( ( isset( $jobInfo[ 'meta' ][ 'jobs' ][ 'location' ] ) && ! empty( $jobInfo[ 'meta' ][ 'jobs' ][ 'location' ] ) ? $jobInfo[ 'meta' ][ 'jobs' ][ 'location' ] : $jobInfo[ 'meta' ][ 'company' ][ 'location' ] ) ); ?></li>
              <li class="list-inline-item"><span class="flaticon-price pl20"></span> <?php echo esc_html( apply_filters( 'futurewordpress/project/job/salary', $jobInfo[ 'meta' ][ 'jobs' ] ) ); ?></li>
            </ul>
          </div>
            <ul class="view_edit_delete_list float-right">
              <?php if( $apply->is_approved != 0 && $apply->is_paid != 0 ) : ?>
                <li class="list-inline-item"><a href="<?php echo esc_url( site_url( 
                '/apply/invoice/' . $apply->is_paid . '/' ) ); ?>" data-toggle="tooltip" data-placement="top" title="<?php esc_attr_e( 'Is Paid', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ); ?>" target="_blank"><span class="flaticon-money" data-class="fa fa-check-circle mt-2"></span></a></li>
              <?php elseif( $apply->is_approved != 0 ) : ?>
                <li class="list-inline-item"><a href="javascript:void(0);" data-toggle="tooltip" data-placement="top" title="<?php esc_attr_e( 'JOB Approved', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ); ?>"><span class="flaticon-locked"></span></a></li>
              <?php else : ?>
                <li class="list-inline-item"><a href="<?php echo esc_url( apply_filters( 'futurewordpress/project/job/apply/link', $jobInfo ) ); ?>" data-toggle="tooltip" data-placement="top" title="<?php esc_attr_e( 'Edit', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ); ?>"><span class="flaticon-edit"></span></a></li>
              <?php endif; ?>
              <li class="list-inline-item"><a class="delete-application-fwp" href="javascript:void(0);" data-id="<?php echo esc_attr( $apply->ID ); ?>" data-name="" data-toggle="tooltip" data-placement="top" title="<?php esc_attr_e( 'Delete', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ); ?>"><span class="flaticon-rubbish-bin"></span></a></li>
            </ul>
        </div>
      </div>
    </div>
  <?php endforeach; ?>
  <?php if( count( $applications ) <= 0 ) : ?>
    <?php ob_start(); ?>
      <img class="error svg" src="<?php echo esc_url( FUTUREWORDPRESS_PROJECT_BUILD_URI . '/icons/empty-postbox.svg' ); ?>" alt="" />
    <?php $html = ob_get_clean(); ?>
    <?php echo apply_filters( 'futurewordpress/project/get/noapplied', $html, $args ); ?>
  <?php endif; ?>
<?php endif; ?>