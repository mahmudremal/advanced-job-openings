<?php
/**
 * Job Dashboard Home template file
 * @package Aquila.
 */
$isCompany = ( isset( $args[ 'dashboard' ] ) && $args[ 'dashboard' ] == 'company' );
?>

<?php if( is_FwpActive( 'dashboard_totals' ) ) : ?>
  <div class="col-12 row">
    <?php if( $isCompany ) : ?>
      <div class="col-sm-6 col-md-6 col-lg-6 col-xl-3">
        <div class="ff_one">
          <div class="icon"><span class="flaticon-paper-plane"></span></div>
          <div class="detais">
            <div class="timer"><?php echo esc_html( count_user_posts( get_current_user_id(), FUTUREWORDPRESS_PROJECT_CPT_JOB_OPENINGS, false ) ); ?></div>
            <p><?php esc_html_e( 'Posted', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ); ?></p>
          </div>
        </div>
      </div>
    <?php endif; ?>
    <!-- <div class="col-sm-6 col-md-6 col-lg-6 col-xl-3">
      <div class="ff_one style2">
        <div class="icon"><span class="flaticon-favorites"></span></div>
        <div class="detais">
          <div class="timer">107</div>
          <p>Review</p>
        </div>
      </div>
    </div> -->
    <?php if( $isCompany ) : ?>
    <div class="col-sm-6 col-md-6 col-lg-6 col-xl-3">
      <div class="ff_one style3">
        <div class="icon"><span class="flaticon-alarm"></span></div>
        <div class="detais">
          <div class="timer"><?php echo esc_html( count( apply_filters( 'futurewordpress/project/job/apply/company', [] ) ) ); ?></div>
          <p><?php esc_html_e( 'Resumes', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ); ?></p>
        </div>
      </div>
    </div>
    <?php endif; ?>
    <!-- <div class="col-sm-6 col-md-6 col-lg-6 col-xl-3">
      <div class="ff_one style4">
        <div class="icon"><span class="flaticon-tag"></span></div>
        <div class="detais">
          <div class="timer">279</div>
          <p><?php // esc_html_e( 'Meeting', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ); ?></p>
        </div>
      </div>
    </div> -->
  </div>
<?php endif; ?>
<?php if( is_FwpActive( 'dashboard_statics' ) ) : ?>
  <div class="col-xl-8">
    <div class="application_statics">
      <h4><?php esc_html_e( 'Statistics', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ); ?></h4>
      <div class="c_container"></div>
    </div>
  </div>
<?php endif; ?>
<?php if( is_FwpActive( 'dashboard_traffic' ) ) : ?>
  <div class="col-xl-4">
    <div class="recent_job_trafic">
      <h4><?php esc_html_e( 'Traffic', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ); ?></h4>
      <div class="trafic_details">
        <div class="circlechart" data-percentage="60">1.5 M</div>
        <h4>Traffic for the day</h4>
        <p>Traffic through the sources google and facebook for the day</p>
        <ul class="trafic_list float-left">
          <li>40%</li>
          