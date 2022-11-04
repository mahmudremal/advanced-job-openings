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
          <li class="list-inline-item"><span class="bgc-fb"></span></li>
          <li class="list-inline-item">Facebook</li>
        </ul>
        <ul class="trafic_list">
          <li>60%</li>
          <li class="list-inline-item"><span class="bgc-gogle"></span></li>
          <li class="list-inline-item">Facebook</li>
        </ul>
      </div>
    </div>
  </div>
<?php endif; ?>
<?php if( is_FwpActive( 'dashboard_leatest_applications' ) ) : ?>
  <div class="col-xl-8">
    <?php
    $args = [
      'order' => 'DESC',
      'limit' => 6
    ];
    $applications = apply_filters( 'futurewordpress/project/job/apply/get', [
      'order' => $args[ 'order' ],
      'limit' => $args[ 'limit' ]
    ] );
    ?>
      <div class="recent_job_apply">
        <h4 class="title"><?php esc_html_e( get_fwp_option( 'leatest_applications_txt' ), FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ); ?></h4>
        <?php if( count( $applications ) >= 1 ) : ?>
          <?php foreach( $applications as $apply ) :
            $userInfo = get_userdata( $apply->user_id );
            ?>
            <div class="candidate_list_view row style3 mb50">
              <div class="thumb col-md-3 col-lg-2">
                <img class="img-fluid rounded-circle" src="<?php echo esc_html( get_avatar_url( $userInfo->ID, [ 'size' => '51' ] ) ); ?>" alt="">
                <!-- <div class="cpi_av_rating"><span>4.5</span></div> -->
              </div>
              <div class="content col-md-9 col-lg-10">
                <h4 class="title">
                  <?php echo esc_html( $userInfo->data->user_nicename ); ?>
                </h4>
                <p>
                  <?php echo esc_html( substr( $apply->coverletter, 0, 148 ) ); ?><?php echo esc_html( ( strlen( $apply->coverletter ) > 148 ) ? '..' : '' ); ?>
                  <a href="<?php echo esc_url( site_url( 'dashboard/company/application-' . $apply->ID . '/' ) ); ?>" class="text-decoration-underline" data-text="<?php echo esc_attr( $apply->coverletter ); ?>" data-onclick="this.parentNode.innerHTML = this.dataset.text;"><?php esc_html_e( 'View', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ); ?></a>
                </p>
              </div>
            </div>
          <?php endforeach; ?>
        <?php else : ?>
          <img class="error svg" src="<?php echo esc_url( FUTUREWORDPRESS_PROJECT_BUILD_URI . '/icons/nill-frawn.svg' ); ?>" alt="" />
        <?php endif; ?>
      </div>
  </div>
<?php endif; ?>
<div class="col-xl-4">
  <div class="recent_job_activity">
    <h4 class="title"><?php esc_html_e( 'Activity', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ); ?></h4>
    <?php
      $activities = apply_filters( 'futurewordpress/project/job/company/activity', [] );
      // print_r( $activities );
      if( count( $activities ) >= 1 ) :
      foreach( $activities as $activity ) : ?>
        <div class="grid">
          <div class="color_bg float-left"></div>
          <ul>
            <li>
              <?php
                echo isset( $activity->applyID ) ? sprintf(
                  __( '%s applied on %s', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
                  wp_kses_post( '<span>' . $activity->userName . '</span>' ),
                  wp_kses_post( '<a class="font-weight-bold" href="' . site_url( '/dashboard/company/application-' . $activity->applyID . '/' ) . '">' . substr( $activity->jobTitle, 0, 15 ) . '..' . '</a>' )
                ) : sprintf(
                  __( '%s liked %s', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
                  wp_kses_post( '<span>' . $activity->userName . '</span>' ),
                  wp_kses_post( '<a class="font-weight-bold" href="#">' . substr( $activity->jobTitle, 0, 15 ) . '..' . '</a>' )
                );
              ?>
            </li>
            <li><?php echo esc_html( apply_filters( 'futurewordpress/project/job/timeString', $activity->createdTime, false ) ); ?></li>
          </ul>
        </div>
        <?php
      endforeach;
      else :
        ?>
        <img class="error svg" src="<?php echo esc_url( FUTUREWORDPRESS_PROJECT_BUILD_URI . '/icons/nill-frawn.svg' ); ?>" alt="" />
        <?php
    endif; ?>
  </div>
</div>