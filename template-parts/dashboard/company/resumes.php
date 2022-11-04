<?php
/**
 * Job post new template file
 * @package Aquila.
 */

?>

<div class="row col-12 m-auto">
  <?php
  $applications = apply_filters( 'futurewordpress/project/job/apply/company', [] );
  if( count( $applications ) >= 1 ) :
    foreach( $applications as $apply ) :
      $job = get_post( $apply->job_id );
      $jobInfo = apply_filters( 'futurewordpress/project/renderpost', [], $job );
      $userInfo = get_userdata( $apply->user_id );
      ?>
      <div class="col-lg-12">
        <div class="candidate_list_view style2">
          <div class="thumb col-md-2 mr-0">
            <img class="img-fluid rounded-circle" src="<?php echo esc_html( get_avatar_url( $userInfo->ID, [ 'size' => '51' ] ) ); ?>" alt="c3.jpg">
            <!-- <div class="cpi_av_rating"><span>4.5</span></div> -->
          </div>
          <div class="content m-0 p-0 d-block">
            <h4 class="title"><?php echo esc_html( $userInfo->data->display_name ); ?>
              <?php if( $apply->is_approved != 0 && $apply->is_paid != 0 ) : ?>
                <small class="verified text-thm2 pl10" title="<?php esc_attr_e( 'Is Paid', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ); ?>"><i class="fa fa-check-circle"></i></small>
              <?php endif; ?>
            </h4>
            <p class="text-justify"><?php echo esc_html( substr( $apply->coverletter, 0, 350 ) ); ?><?php
            if( strlen( $apply->coverletter ) > 350 ) {
              ?>
              <a href="javascript:void(0);" data-text="<?php echo esc_attr( $apply->coverletter ); ?>" onclick="this.parentNode.innerHTML = this.dataset.text;"><?php esc_html_e( 'See more', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ); ?></a>
              <?php
            }
            ?></p>
          </div>
            <ul class="view_edit_delete_list mt25 float-right fn-xl p-0 m-0">
              <?php
                $CV = apply_filters( 'futurewordpress/project/job/cv/get', [ 'id' => $apply->cv_id ] );
                $CV = isset( $CV[0] ) ? $CV[0] : $CV;
                if( isset( $CV->ID ) ) : ?>
                  <li class="list-inline-item"><a href="<?php echo esc_url( site_url( '/dashboard/company/application-' . $apply->ID . '/' ) ); ?>" data-toggle="tooltip" data-placement="top" title="<?php esc_attr_e( 'View CV' ); ?>"><span class="flaticon-eye"></span></a></li>
                  <li class="list-inline-item"><a href="<?php echo esc_url( site_url( str_replace( [ ABSPATH ], [ '' ], $CV->cv_path ) ) ); ?>" download="<?php echo esc_attr( pathinfo( $CV->cv_path, PATHINFO_FILENAME ) ); ?>" data-toggle="tooltip" data-placement="top" title="<?php esc_attr_e( 'Download CV', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ); ?>"><span class="flaticon-resume"></span> <?php esc_html_e( 'Download CV', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ); ?></a></li>
                  <li class="list-inline-item"><a href="javascript:void(0);" class="delete-cv-fwp" data-toggle="tooltip" data-placement="top" title="Delete" data-id="<?php echo esc_attr( $apply->cv_id ); ?>" data-name="<?php echo esc_attr( $CV->cv_name ); ?>"><span class="flaticon-rubbish-bin"></span></a></li>
                <?php endif; ?>
            </ul>
        </div>
      </div>
    <?php endforeach; ?>
  <?php else : ?>
    <div class="col-lg-12">
      <img class="error svg" src="<?php echo esc_url( FUTUREWORDPRESS_PROJECT_BUILD_URI . '/icons/nill-frawn.svg' ); ?>" alt="" />
    </div>
  <?php endif; ?>
</div>
<style>
  .col-lg-12 img.error.svg {
    width: 100%;
    height: auto;
  }
  @media screen and ( min-width: 420px ) {
    .view_edit_delete_list {
      position: absolute;
      top: 20px;
      right: 30px;
    }
  }
</style>