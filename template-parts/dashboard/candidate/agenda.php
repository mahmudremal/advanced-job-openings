<?php
/**
 * Job Dashboard Agenda template file
 * @package Aquila.
 */
?>

<!-- UI Accordions & Tabs -->
<section class="job-location bgc-fa pt-2 px-0 pb30 col-12">
  <div class="container">
    <div class="row">
      <div class="col-md-12 col-lg-12">
        <div class="ui_kit_tab mt30">
          <ul class="nav nav-tabs" id="agendaTabs" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="ongoing-jobs-tab" data-toggle="tab" href="#ongoing-jobs" role="tab" aria-controls="ongoing-jobs" aria-selected="true"><?php esc_html_e( 'Future Jobs', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ); ?></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="past-jobs-tab" data-toggle="tab" href="#past-jobs" role="tab" aria-controls="past-jobs" aria-selected="false"><?php esc_html_e( 'Past Jobs', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ); ?></a>
            </li>
          </ul>
          <div class="tab-content" id="agendaTabsContent">
            <div class="tab-pane fade show active" id="ongoing-jobs" role="tabpanel" aria-labelledby="ongoing-jobs-tab">
              <div class="ui_kit_table">
                <table class="table">
                  <thead class="thead-light">
                    <tr>
                      <th scope="col"><?php esc_html_e( 'Date', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ); ?></th>
                      <th scope="col"><?php esc_html_e( 'Location', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ); ?></th>
                      <th scope="col"><?php esc_html_e( 'Requirements', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ); ?></th>
                      <th scope="col"><?php esc_html_e( 'Company', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ); ?></th>
                      <th scope="col"><?php esc_html_e( 'Job name', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ); ?></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $applications = apply_filters( 'futurewordpress/project/job/apply/get', [ 'user' => get_current_user_id() ] );$didntOne = true;
                    foreach( $applications as $apply ) :
                      $job = get_post( $apply->job_id );
                      $jobInfo = apply_filters( 'futurewordpress/project/renderpost', [], $job );
                      if( isset( $jobInfo[ 'meta' ][ 'jobs' ][ '_status' ] ) && ! $jobInfo[ 'meta' ][ 'jobs' ][ '_status' ] ) {continue;}$didntOne = false;
                      ?>
                      <tr>
                        <td><?php echo esc_html( wp_date( 'M d, Y', strtotime( $jobInfo[ 'post' ]->post_date ) ) ); ?></td>
                        <td><?php echo esc_html( substr( $jobInfo[ 'meta' ][ 'jobs' ][ 'location' ], 0, 27 ) . ( ( strlen( $jobInfo[ 'meta' ][ 'jobs' ][ 'location' ] ) > 27 ) ? '..' : '' ) ); ?></td>
                        <td>
                          <?php echo wp_kses_post( substr( $jobInfo[ 'meta' ][ 'jobs' ][ 'requirments' ], 0, 27 ) . ( ( strlen( $jobInfo[ 'meta' ][ 'jobs' ][ 'requirments' ] ) > 27 ) ? '..' : '' ) ); ?>
                          <a href="javascript:void(0);" class="fwp-see-more" data-text="<?php echo esc_attr( $jobInfo[ 'meta' ][ 'jobs' ][ 'requirments' ] ); ?>" data-toggle="modal" data-target="#fwpSeeMoreModalCenter" data-textarget="#fwp-text-see-more"><?php esc_html_e( 'See more', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ); ?></a>
                        </td>
                        <td>
                          <a href="<?php echo esc_url( $jobInfo[ 'meta' ][ 'company' ][ 'url' ] ); ?>" target="_blank">
                            <?php echo esc_html( substr( $jobInfo[ 'meta' ][ 'company' ][ 'name' ], 0, 27 ) . ( ( strlen( $jobInfo[ 'post' ]->post_title ) > 27 ) ? '..' : '' ) ); ?>
                          </a>
                        </td>
                        <td>
                          <a href="<?php echo esc_url( get_the_permalink( $jobInfo[ 'post' ]->ID ) ); ?>" target="_blank">
                            <?php echo esc_html( substr( $jobInfo[ 'post' ]->post_title, 0, 27 ) . ( ( strlen( $jobInfo[ 'post' ]->post_title ) > 27 ) ? '..' : '' ) ); ?></td>
                          </a>
                      </tr>
                      <?php
                    endforeach;
                    if( $didntOne ) :
                      ?>
                      <tr>
                        <td colspan="5" align="center">
                          <?php esc_html_e( 'Nothing left to show', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ); ?>
                        </td>
                      </tr>
                      <?php
                    endif;
                    ?>
                  </tbody>
                </table>
              </div>
            </div>
            <div class="tab-pane fade" id="past-jobs" role="tabpanel" aria-labelledby="past-jobs-tab">
              <div class="ui_kit_table">
                <table class="table">
                  <thead class="thead-light">
                    <tr>
                      <th scope="col"><?php esc_html_e( 'Date', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ); ?></th>
                      <th scope="col"><?php esc_html_e( 'Location', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ); ?></th>
                      <th scope="col"><?php esc_html_e( 'Requirements', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ); ?></th>
                      <th scope="col"><?php esc_html_e( 'Company', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ); ?></th>
                      <th scope="col"><?php esc_html_e( 'Job name', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ); ?></th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                    $applications = apply_filters( 'futurewordpress/project/job/apply/get', [ 'user' => get_current_user_id() ] );$didntOne = true;
                    foreach( $applications as $apply ) :
                      $job = get_post( $apply->job_id );
                      $jobInfo = apply_filters( 'futurewordpress/project/renderpost', [], $job );
                      if( ! isset( $jobInfo[ 'meta' ][ 'jobs' ][ '_status' ] ) || $jobInfo[ 'meta' ][ 'jobs' ][ '_status' ] ) {continue;}$didntOne = false;
                      ?>
                      <tr>
                        <td><?php echo esc_html( wp_date( 'M d, Y', strtotime( $jobInfo[ 'post' ]->post_date ) ) ); ?></td>
                        <td><?php echo esc_html( substr( $jobInfo[ 'meta' ][ 'jobs' ][ 'location' ], 0, 27 ) . ( ( strlen( $jobInfo[ 'meta' ][ 'jobs' ][ 'location' ] ) > 27 ) ? '..' : '' ) ); ?></td>
                        <td>
                          <?php echo wp_kses_post( substr( $jobInfo[ 'meta' ][ 'jobs' ][ 'requirments' ], 0, 27 ) . ( ( strlen( $jobInfo[ 'meta' ][ 'jobs' ][ 'requirments' ] ) > 27 ) ? '..' : '' ) ); ?>
                          <a href="javascript:void(0);" class="fwp-see-more" data-text="<?php echo esc_attr( $jobInfo[ 'meta' ][ 'jobs' ][ 'requirments' ] ); ?>" data-toggle="modal" data-target="#fwpSeeMoreModalCenter" data-textarget="#fwp-text-see-more"><?php esc_html_e( 'See more', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ); ?></a>
                        </td>
                        <td>
                          <a href="<?php echo esc_url( $jobInfo[ 'meta' ][ 'company' ][ 'url' ] ); ?>" target="_blank">
                            <?php echo esc_html( substr( $jobInfo[ 'meta' ][ 'company' ][ 'name' ], 0, 27 ) . ( ( strlen( $jobInfo[ 'post' ]->post_title ) > 27 ) ? '..' : '' ) ); ?>
                          </a>
                        </td>
                        <td>
                          <a href="<?php echo esc_url( get_the_permalink( $jobInfo[ 'post' ]->ID ) ); ?>" target="_blank">
                            <?php echo esc_html( substr( $jobInfo[ 'post' ]->post_title, 0, 27 ) . ( ( strlen( $jobInfo[ 'post' ]->post_title ) > 27 ) ? '..' : '' ) ); ?></td>
                          </a>
                      </tr>
                      <?php
                    endforeach;
                    if( $didntOne ) :
                      ?>
                      <tr>
                        <td colspan="5" align="center">
                          <?php esc_html_e( 'Nothing left to show', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ); ?>
                        </td>
                      </tr>
                      <?php
                    endif;
                    ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>



<!-- Modal -->
<div class="sign_up_modal modal fade" id="fwpSeeMoreModalCenter" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="model-body">
        <div class="login_form">
          <form action="#">
            <div class="heading mb-4">
              <h3 class="text-center"><?php esc_html_e( 'Full Requirments', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ); ?></h3>
              <p class="text-center"><?php esc_html_e( 'Full requirments of selected jobs and this popup can be dispear by pressing x button on top right or by pressing outside of this box.', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ); ?></p>
            </div>
            <div class="text-justify" id="fwp-text-see-more"></div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<style>
  #fwp-text-see-more {
    max-height: calc( 100vh - 10vh );
    overflow: hidden;
    overflow-y: auto;
  }
  @media screen and (min-width: 500px) {
    #fwp-text-see-more {
      max-height: calc( 100vh - 250px );
    }
  }
</style>