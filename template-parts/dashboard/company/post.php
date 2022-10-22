<?php
/**
 * Job post new template file
 * @package Aquila.
 */

$jobInfo = [];
if( ! $args ) {
  $args = [];
}
$is_edit = ( isset( $args[ 'job' ] ) );
if( $is_edit ) {
  $job = get_post( $args[ 'job' ] );
  $jobInfo = apply_filters( 'futurewordpress/project/renderpost', [], $job );
}
$jobInfo = wp_parse_args( $jobInfo, [
  'post' => [],
  'meta' => [
    'company' => [],
    'jobs' => []
  ],
  'terms' => []
] );
$jobInfo[ 'post' ] = (array) $jobInfo[ 'post' ];
wp_enqueue_script( 'ckeditor' );
?>
	<!-- Post a new JOB -->
  <form class="my_profile_form_area" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" method="post" enctype="multipart/form-data">
    <input type="hidden" name="fwp-company-post-job-<?php echo esc_attr( ( $is_edit ) ? 'edit' : 'new' ); ?>" value="<?php echo esc_attr( isset( $jobInfo[ 'post' ][ 'ID' ] ) ? $jobInfo[ 'post' ][ 'ID' ] : 0 ); ?>">
    <input type="hidden" name="action" value="fwp-company-post-job-action">
    <?php wp_nonce_field( 'fwp-company-post-job-action', 'fwp-company-post-job-action', true, true ); ?>
    <div class="row">
      <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4">
        <div class="icon_boxs">
          <div class="icon"><span class="flaticon-work"></span></div>
          <div class="details"><h4><?php echo esc_html( apply_filters( 'futurewordpress/project/get/totaljob', [] ) ); ?> <?php esc_html_e( 'Job Posted', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ); ?></h4></div>
        </div>
      </div>
      <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4">
        <div class="icon_boxs">
          <div class="icon style2"><span class="flaticon-resume"></span></div>
          <div class="details"><h4><?php echo esc_html( apply_filters( 'futurewordpress/project/get/totalapply', [] ) ); ?> <?php esc_html_e( 'Applications', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ); ?></h4></div>
        </div>
      </div>
      <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4">
        <div class="icon_boxs">
          <div class="icon style3"><span class="flaticon-work"></span></div>
          <div class="details"><h4><?php echo esc_html( apply_filters( 'futurewordpress/project/get/activejob', [] ) ); ?> <?php esc_html_e( 'Active Jobs', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ); ?></h4></div>
        </div>
      </div>
      <div class="col-lg-12 mt30">
        <div class="my_profile_thumb_edit"></div>
      </div>
      <div class="col-lg-12">
        <div class="my_profile_input form-group">
            <label for="fwp-company-post-job-title"><?php esc_html_e( 'Job Title', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ); ?></label>
            <input type="text" class="form-control" id="fwp-company-post-job-title" name="fwp-company-post-job[title]" placeholder="<?php esc_attr_e( 'Job Position / title', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ); ?>" value="<?php echo esc_attr( isset( $jobInfo[ 'post' ][ 'post_title' ] ) ? $jobInfo[ 'post' ][ 'post_title' ] : '' ); ?>">
        </div>
      </div>
      <div class="col-lg-12">
        <div class="my_resume_textarea">
          <div class="form-group">
              <label for="fwp-company-post-job-location"><?php esc_html_e( 'Location', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ); ?></label>
              <textarea class="form-control" id="fwp-company-post-job-location" name="fwp-company-post-job[location]" rows="3"><?php echo esc_html( isset( $jobInfo[ 'meta' ][ 'jobs'][ 'location' ] ) ? $jobInfo[ 'meta' ][ 'jobs'][ 'location' ] : '' ); ?></textarea>
          </div>
        </div>
      </div>
      
      <div class="col-md-6 col-lg-6">
        <div class="my_profile_input form-group">
            <label for="fwp-company-post-job-salary-min"><?php esc_html_e( 'Salary min', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ); ?></label>
            <input type="number" class="form-control" id="fwp-company-post-job-salary-min" name="fwp-company-post-job[salary]" placeholder="<?php esc_attr_e( 'Salary Minimum. Is required', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ); ?>" value="<?php echo esc_attr( isset( $jobInfo[ 'meta' ][ 'jobs'][ 'salary' ] ) ? $jobInfo[ 'meta' ][ 'jobs'][ 'salary' ] : '' ); ?>">
        </div>
      </div>
      <div class="col-md-6 col-lg-6">
        <div class="my_profile_input form-group">
            <label for="fwp-company-post-job-salary-max"><?php esc_html_e( 'Salary max', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ); ?></label>
            <input type="number" class="form-control" id="fwp-company-post-job-salary-max" name="fwp-company-post-job[salaryto]" placeholder="<?php esc_attr_e( 'Salary Maximum. Leave blank it salary Fixed', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ); ?>" value="<?php echo esc_attr( isset( $jobInfo[ 'meta' ][ 'jobs'][ 'salaryto' ] ) ? $jobInfo[ 'meta' ][ 'jobs'][ 'salaryto' ] : '' ); ?>">
        </div>
      </div>
      <div class="col-md-6 col-lg-6">
        <div class="my_profile_select_box form-group">
            <label for="fwp-company-post-job-salary-round"><?php esc_html_e( 'Salary Round', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ); ?></label><br>
            <select class="selectpicker" id="fwp-company-post-job-salary-round" name="fwp-company-post-job[salaryround]">
              <?php
                $options = [
                  '0' => esc_html_e( 'Select Round', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
                  'hourly' => esc_html_e( 'Hourly', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
                  'daily' => esc_html_e( 'Daily', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
                  'weekly' => esc_html_e( 'Weekly', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
                  'monthly' => esc_html_e( 'Monthly', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
                  'yearly' => esc_html_e( 'Yearly', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN )
                ];
                foreach( $options as $i => $opt ) {
                  ?>
                  <option value="<?php echo esc_attr( $i ); ?>" <?php echo esc_attr( ( isset( $jobInfo[ 'meta' ][ 'jobs'][ 'salaryround' ] ) && ( $jobInfo[ 'meta' ][ 'jobs'][ 'salaryround' ] == $i ) ) ? 'selected' : '' ); ?>><?php esc_html_e( $opt, FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ); ?></option>
                  <?php
                }
                ?>
          </select>
        </div>
      </div>
      <div class="col-md-6 col-lg-6">
        <div class="my_profile_select_box form-group">
            <label for="fwp-company-post-job-currency"><?php esc_html_e( 'Currency', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ); ?></label><br>
            <select class="selectpicker" id="fwp-company-post-job-currency" name="fwp-company-post-job[currency]">
              <option value="0"> <?php esc_html_e( 'Select Currency', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ); ?></option>
              <?php
                $getCurrency = apply_filters( 'futurewordpress/project/job/currencies', [ 'USD', 'EUR' ] );
                foreach( $getCurrency as $t => $tk ) {
                  ?><option value="<?php echo esc_attr( $tk ); ?>" <?php echo esc_attr( ( isset( $jobInfo[ 'meta' ][ 'jobs'][ 'currency' ] ) && ( $jobInfo[ 'meta' ][ 'jobs'][ 'currency' ] == $tk ) ) ? 'selected' : '' ); ?>><?php echo esc_html( $tk ); ?></option><?php
                }
              ?>
          </select>
        </div>
      </div>
      <div class="col-md-6 col-lg-6">
        <h5 class="fz16 mb20 mt20"><?php esc_html_e( 'Gender', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ); ?></h5>
        <div class="ui_kit_radiobox">
          <?php
            $options = [
              'Male', 'Female', 'Both'
            ];
            foreach( $options as $option ) {
              ?>
              <div class="radio">
                <input id="fwp-company-post-job-gender_<?php echo esc_attr( $option ); ?>" name="fwp-company-post-job[gender]" type="radio" value="<?php echo esc_attr( strtolower( $option ) ); ?>" <?php echo esc_attr( ( isset( $jobInfo[ 'meta' ][ 'jobs'][ 'gender' ] ) && ( $jobInfo[ 'meta' ][ 'jobs'][ 'gender' ] == strtolower( $option ) ) ) ? 'checked' : '' ); ?>>
                <label for="fwp-company-post-job-gender_<?php echo esc_attr( $option ); ?>"><span class="radio-label"></span> <?php esc_html_e( $option, FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ); ?></label>
              </div>
              <?php
            }
            ?>
        </div>
      </div>
      
      <div class="col-md-12 col-lg-12">
        <div class="my_profile_input form-group">
            <label for="fwp-company-post-job-careerlevel"><?php esc_html_e( 'Career Level', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ); ?></label>
            <input type="text" class="form-control" id="fwp-company-post-job-careerlevel" name="fwp-company-post-job[careerlevel]" placeholder="<?php esc_attr_e( 'EG. Executive', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ); ?>" value="<?php echo esc_attr( isset( $jobInfo[ 'meta' ][ 'jobs'][ 'careerlevel' ] ) ? $jobInfo[ 'meta' ][ 'jobs'][ 'careerlevel' ] : '' ); ?>">
        </div>
      </div>
      <div class="col-md-12 col-lg-12">
        <div class="my_profile_input form-group">
            <label for="fwp-company-post-job-industry"><?php esc_html_e( 'Industry', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ); ?></label>
            <input type="text" class="form-control" id="fwp-company-post-job-industry" name="fwp-company-post-job[industry]" placeholder="<?php esc_attr_e( 'EG. Management', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ); ?>" value="<?php echo esc_attr( isset( $jobInfo[ 'meta' ][ 'jobs'][ 'industry' ] ) ? $jobInfo[ 'meta' ][ 'jobs'][ 'industry' ] : '' ); ?>">
        </div>
      </div>
      <div class="col-md-12 col-lg-12">
        <div class="my_profile_input form-group">
            <label for="fwp-company-post-job-qualification"><?php esc_html_e( 'Qualification', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ); ?></label>
            <input type="text" class="form-control" id="fwp-company-post-job-qualification" name="fwp-company-post-job[qualification]" placeholder="<?php esc_attr_e( 'EG. Bachelor Degree', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ); ?>" value="<?php echo esc_attr( isset( $jobInfo[ 'meta' ][ 'jobs'][ 'qualification' ] ) ? $jobInfo[ 'meta' ][ 'jobs'][ 'qualification' ] : '' ); ?>">
        </div>
      </div>
      <div class="col-md-6 col-lg-6">
        <div class="my_profile_input form-group">
            <label for="fwp-company-post-job-closingdate"><?php esc_html_e( 'Application Deadline Date', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ); ?></label>
            <input type="text" class="form-control datepicker" id="fwp-company-post-job-closingdate" name="fwp-company-post-job[closingdate]" min="<?php esc_attr( date( 'Y-m-d' ) ); ?>" step="1" value="<?php echo esc_attr( isset( $jobInfo[ 'meta' ][ 'jobs'][ 'closingdate' ] ) ? $jobInfo[ 'meta' ][ 'jobs'][ 'closingdate' ] : '' ); ?>">
        </div>
      </div>
      <div class="col-lg-4">
        <div class="ui_kit_whitchbox">
          <div class="custom-control custom-switch">
            <input type="checkbox" class="custom-control-input" id="fwp-company-post-job-featured" name="fwp-company-post-job[featuredlisting]" <?php echo esc_attr( isset( $jobInfo[ 'meta' ][ 'jobs'][ 'featuredlisting' ] ) && $jobInfo[ 'meta' ][ 'jobs'][ 'featuredlisting' ] ? 'checked' : '' ); ?>>
            <label class="custom-control-label" for="fwp-company-post-job-featured"><?php esc_html_e( 'Featured Listing', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ); ?></label>
          </div>
          <div class="custom-control custom-switch">
            <input type="checkbox" class="custom-control-input" id="fwp-company-post-job-remote" name="fwp-company-post-job[remoteposition]" <?php echo esc_attr( isset( $jobInfo[ 'meta' ][ 'jobs'][ 'remoteposition' ] ) && $jobInfo[ 'meta' ][ 'jobs'][ 'remoteposition' ] ? 'checked' : '' ); ?>>
            <label class="custom-control-label" for="fwp-company-post-job-remote"><?php esc_html_e( 'Remote Position', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ); ?></label>
          </div>
          <div class="custom-control custom-switch">
            <input type="checkbox" class="custom-control-input" id="fwp-company-post-job-positionfilled" name="fwp-company-post-job[positionfilled]" <?php echo esc_attr( isset( $jobInfo[ 'meta' ][ 'jobs'][ 'positionfilled' ] ) && $jobInfo[ 'meta' ][ 'jobs'][ 'positionfilled' ] ? 'checked' : '' ); ?>>
            <label class="custom-control-label" for="fwp-company-post-job-positionfilled"><?php esc_html_e( 'Position Filled', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ); ?></label>
          </div>
          <div class="custom-control custom-switch">
            <input type="checkbox" class="custom-control-input" id="fwp-company-post-job-hidecompany" name="fwp-company-post-job[hidecompany]" <?php echo esc_attr( isset( $jobInfo[ 'meta' ][ 'jobs'][ 'hidecompany' ] ) && $jobInfo[ 'meta' ][ 'jobs'][ 'hidecompany' ] ? 'checked' : '' ); ?>>
            <label class="custom-control-label" for="fwp-company-post-job-hidecompany"><?php esc_html_e( 'Hide Company', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ); ?></label>
          </div>
        </div>
      </div>
      <!--
          <div class="col-lg-4">
          <h5 class="fz16 mb20 mt20"><?php // esc_html_e( 'Job types', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ); ?></h5>
          <div class="ui_kit_whitchbox">
            <?php
              // $jobTypes = get_terms( [
              //   'taxonomy' => 'job_types', // job_categories
              //   'hide_empty' => false
              // ] );
              // foreach( $jobTypes as $jobType ) :
            ?>
            <div class="custom-control custom-switch">
              <input type="checkbox" class="custom-control-input" id="fwp-company-post-job-types-<?php // echo esc_attr( $jobType->term_id ); ?>" name="fwp-company-post-job-types[<?php // echo esc_attr( $jobType->term_id ); ?>]">
              <label class="custom-control-label" for="fwp-company-post-job-types-<?php // echo esc_attr( $jobType->term_id ); ?>"><?php // echo esc_html( $jobType->name ); ?></label>
            </div>
            <?php // endforeach; ?>
          </div>
        </div>
        <div class="col-lg-4">
          <h5 class="fz16 mb20 mt20"><?php esc_html_e( 'Job Categories', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ); ?></h5>
          <div class="ui_kit_whitchbox">
            <?php
              // $jobTypes = get_terms( [
              //   'taxonomy' => 'job_categories',
              //   'hide_empty' => false
              // ] );
              // foreach( $jobTypes as $jobType ) :
            ?>
            <div class="custom-control custom-switch">
              <input type="checkbox" class="custom-control-input" id="fwp-company-post-job-types-<?php // echo esc_attr( $jobType->term_id ); ?>" name="fwp-company-post-job-types[<?php // echo esc_attr( $jobType->term_id ); ?>]">
              <label class="custom-control-label" for="fwp-company-post-job-types-<?php // echo esc_attr( $jobType->term_id ); ?>"><?php // echo esc_html( $jobType->name ); ?></label>
            </div>
            <?php // endforeach; ?>
          </div>
        </div> -->
      <div class="col-lg-6">
        <h5 class="fz16 mb20 mt20"><?php esc_html_e( 'Job Types', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ); ?></h5>
        
        <div class="ui_kit_multi_select_box">
          <select class="selectpicker" name="fwp-company-post-job-types[]" multiple>
            <?php
              $jobTypes = get_terms( [
                'taxonomy' => 'job_types',
                'hide_empty' => false
              ] );
              foreach( $jobTypes as $jobType ) :
                ?>
                <option value="<?php echo esc_attr( $jobType->term_id ); ?>" <?php echo esc_attr( ( isset( $jobInfo[ 'terms' ] ) && in_array( $jobType->name, $jobInfo[ 'terms' ] ) ) ? 'selected' : '' ); ?>><?php echo esc_html( $jobType->name ); ?></option>
            <?php endforeach; ?>
          </select>
        </div>
      </div>
      <div class="col-lg-6">
        <h5 class="fz16 mb20 mt20"><?php esc_html_e( 'Job Categories', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ); ?></h5>
        
        <div class="ui_kit_multi_select_box">
          <select class="selectpicker" name="fwp-company-post-job-types[]" multiple>
            <?php
              $jobCats = get_terms( [
                'taxonomy' => 'job_categories',
                'hide_empty' => false
              ] );
              foreach( $jobCats as $jobCat ) :
                ?>
                <option value="<?php echo esc_attr( $jobCat->term_id ); ?>" <?php echo esc_attr( ( isset( $jobInfo[ 'categories' ] ) && in_array( $jobCat->name, $jobInfo[ 'categories' ] ) ) ? 'selected' : '' ); ?>><?php echo esc_html( $jobCat->name ); ?></option>
            <?php endforeach; ?>
          </select>
        </div>
      </div>

      <div class="col-md-6 col-lg-6">
        <div class="my_profile_input form-group">
            <label for="fwp-company-post-job-experienceshort"><?php esc_html_e( 'Experience in Short', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ); ?></label>
            <input type="text" class="form-control" id="fwp-company-post-job-experienceshort" name="fwp-company-post-job[experienceshort]" value="<?php echo esc_attr( isset( $jobInfo[ 'meta' ][ 'jobs'][ 'experienceshort' ] ) ? $jobInfo[ 'meta' ][ 'jobs'][ 'experienceshort' ] : '' ); ?>">
        </div>
      </div>
      
      <div class="col-lg-12">
        <div class="my_resume_textarea">
            <div class="form-group">
              <label for="fwp-company-post-job-description"><?php esc_html_e( 'Job Description', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ); ?></label>
              <textarea class="form-control ckeditor" id="fwp-company-post-job-description" name="fwp-company-post-job[description]" rows="9"><?php echo esc_html( isset( $jobInfo[ 'meta' ][ 'jobs'][ 'description' ] ) ? $jobInfo[ 'meta' ][ 'jobs'][ 'description' ] : '' ); ?></textarea>
            </div>
        </div>
      </div>
      <div class="col-lg-12">
        <div class="my_resume_textarea">
            <div class="form-group">
              <label for="fwp-company-post-job-responsibilities"><?php esc_html_e( 'Job Responsibilities', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ); ?></label>
              <textarea class="form-control ckeditor" id="fwp-company-post-job-responsibilities" name="fwp-company-post-job[responsibilities]" rows="9"><?php echo esc_html( isset( $jobInfo[ 'meta' ][ 'jobs'][ 'responsibilities' ] ) ? $jobInfo[ 'meta' ][ 'jobs'][ 'responsibilities' ] : '' ); ?></textarea>
            </div>
        </div>
      </div>
      <div class="col-lg-12">
        <div class="my_resume_textarea">
            <div class="form-group">
              <label for="fwp-company-post-job-experience"><?php esc_html_e( 'Job Experience', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ); ?></label>
              <textarea class="form-control ckeditor" id="fwp-company-post-job-experience" name="fwp-company-post-job[experience]" rows="9"><?php echo esc_html( isset( $jobInfo[ 'meta' ][ 'jobs'][ 'experience' ] ) ? $jobInfo[ 'meta' ][ 'jobs'][ 'experience' ] : '' ); ?></textarea>
            </div>
        </div>
      </div>
      <div class="col-lg-12">
        <div class="my_resume_textarea">
            <div class="form-group">
              <label for="fwp-company-post-job-requirments"><?php esc_html_e( 'Job Requirments', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ); ?></label>
              <textarea class="form-control ckeditor" id="fwp-company-post-job-requirments" name="fwp-company-post-job[requirments]" rows="9"><?php echo esc_html( isset( $jobInfo[ 'meta' ][ 'jobs'][ 'requirments' ] ) ? $jobInfo[ 'meta' ][ 'jobs'][ 'requirments' ] : '' ); ?></textarea>
            </div>
        </div>
      </div>
      <div class="col-lg-12">
        <div class="my_resume_textarea">
            <div class="form-group">
              <label for="fwp-company-post-job-offering"><?php esc_html_e( 'Job Offering', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ); ?></label>
              <textarea class="form-control ckeditor" id="fwp-company-post-job-offering" name="fwp-company-post-job[offering]" rows="9"><?php echo esc_html( isset( $jobInfo[ 'meta' ][ 'jobs'][ 'offering' ] ) ? $jobInfo[ 'meta' ][ 'jobs'][ 'offering' ] : '' ); ?></textarea>
            </div>
        </div>
      </div>

      
      <div class="col-lg-4">
        <div class="my_profile_input">
          <button type="submit" class="btn btn-lg btn-thm" name="submit_form"><?php esc_html_e( 'Save Changes', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ); ?></a>
        </div>
      </div>
    </div>
  </form>
  <style>
    .ui_kit_radiobox .radio {margin-top: -5px;}
  </style>
  <script>
    jQuery( document ).on( 'ready', function() {
      if( ClassicEditor ) {
        document.querySelectorAll( 'textarea.ckeditor' ).forEach( function( e, i ) {
            ClassicEditor.create( e ).then( editor => {
              // console.log( editor );
            } ).catch( error => {
              // console.error( error );
            } );
        } );
      }
    } );
  </script>