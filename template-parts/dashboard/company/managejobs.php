<?php
/**
 * Manage Job template for company deshboard.
 * 
 * @package Aquila.
 */
 ?>
<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css" />
<script src="//cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
<?php // wp_enqueue_script( 'data-table' ); ?>

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
      <div class="details"><h4><?php echo esc_html( count( apply_filters( 'futurewordpress/project/job/apply/company', [] ) ) ); ?> <?php esc_html_e( 'Applications', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ); ?></h4></div>
    </div>
  </div>
  <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4">
    <div class="icon_boxs">
      <div class="icon style3"><span class="flaticon-work"></span></div>
      <div class="details"><h4><?php echo esc_html( apply_filters( 'futurewordpress/project/get/activejob', [] ) ); ?> <?php esc_html_e( 'Active Jobs', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ); ?></h4></div>
    </div>
  </div>
  <div class="col-md-6 col-lg-6">
    <div class="candidate_revew_search_box mt30">
      <form class="form-inline my-2 my-lg-0">
        <input type="hidden" name="filter" value="title">
        <input class="form-control mr-sm-2" type="search" placeholder="<?php esc_attr_e( 'Serach', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ); ?>" aria-label="Search" name="q">
        <button class="btn my-2 my-sm-0" type="submit"><span class="flaticon-search"></span></button>
      </form>
    </div>
  </div>
  <div class="col-md-6 col-lg-6">
    <div class="candidate_revew_select text-right mt30">
      <ul>
        <li class="list-inline-item"><?php esc_html_e( 'Sort by', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ); ?>:</li>
        <li class="list-inline-item">
          <select class="selectpicker show-tick">
            <option><?php esc_html_e( 'Newest', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ); ?></option>
            <option><?php esc_html_e( 'Recent', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ); ?></option>
            <option><?php esc_html_e( 'Old Review', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ); ?></option>
          </select>
        </li>
      </ul>
    </div>
  </div>
  <div class="col-lg-12">
    <div class="cnddte_fvrt_job candidate_job_reivew style2">
      <div class="table-responsive job_review_table">
        <table class="table fw p-datatable" id="datatable">
          <thead class="thead-light">
              <tr>
                <th scope="col"><?php esc_html_e( 'Job Title', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ); ?></th>
                <th scope="col"><?php esc_html_e( 'Applications', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ); ?></th>
                <th scope="col"><?php esc_html_e( 'Status', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ); ?></th>
                <th scope="col"></th>
              </tr>
          </thead>
          <tbody>
            <?php
              $jobsArgs = [
                'post_type'   => FUTUREWORDPRESS_PROJECT_CPT_JOB_OPENINGS,
                'post_status' => 'any',
                'numberposts' => 12,
                'post_author' => get_current_user_id(),
                'orderby'     => 'menu_order',
                'sort_order'  => 'desc',
              ];
              $getJobs = get_posts( $jobsArgs );
              ?>
              <?php
              foreach( $getJobs as $job ) :
                $jobInfo = apply_filters( 'futurewordpress/project/renderpost', [], $job );
                ?>
                <tr>
                  <th scope="row">
                    <h4><?php echo esc_html( $jobInfo[ 'post' ]->post_title ); ?></h4>
                    <p><span class="flaticon-location-pin"></span> <?php echo wp_kses_post( $jobInfo[ 'meta' ][ 'jobs' ][ 'location' ] ); ?></p>
                    <ul>
                      <li class="list-inline-item"><span class="flaticon-event"> <?php esc_html_e( 'Created', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ); ?>: </span></li>
                      <li class="list-inline-item"><span class="color-black22"><?php echo esc_html( date( 'M d, Y', strtotime( $jobInfo[ 'post' ]->post_date ) ) ); ?></span></li>
                      <li class="list-inline-item"><span class="flaticon-event"> <?php esc_html_e( 'Expiry', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ); ?>: </span></li>
                      <li class="list-inline-item"><span class="color-black22"><?php echo esc_html( date( 'M d, Y', strtotime( $jobInfo[ 'meta' ][ 'jobs' ][ 'closingdate' ] ) ) ); ?></span></li>
                    </ul>
                  </th>
                  <td><span class="color-black22"><?php echo esc_html( apply_filters( 'futurewordpress/project/get/applied', [ 'id' => $jobInfo[ 'post' ]->ID ] ) ); ?></span> <?php esc_html_e( 'Application(s)', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ); ?></td>
                  <td class="text-thm2"><?php echo esc_html( $jobInfo[ 'meta' ][ 'jobs' ][ '_statusText' ] ); ?></td>
                  <td>
                    <ul class="view_edit_delete_list">
                      <li class="list-inline-item"><a href="<?php echo get_the_permalink( $jobInfo[ 'post' ]->ID ); ?>" data-toggle="tooltip" data-placement="bottom" title="View"><span class="flaticon-eye"></span></a></li>
                      <li class="list-inline-item"><a href="<?php echo esc_url( site_url( 'dashboard/company/post-' . $jobInfo[ 'post' ]->ID . '/' ) ); ?>" data-toggle="tooltip" data-placement="bottom" title="Edit"><span class="flaticon-edit"></span></a></li>
                      <li class="list-inline-item"><a class="delete-job-fwp" href="javascript:void(0);" data-nonce="<?php echo esc_attr( wp_create_nonce( 'fwp-company-delete-job-action-' . $jobInfo[ 'post' ]->ID ) ); ?>" data-id="<?php echo esc_attr( $jobInfo[ 'post' ]->ID ); ?>" data-toggle="tooltip" data-placement="bottom" title="Delete"><span class="flaticon-rubbish-bin"></span></a></li>
                    </ul>
                  </td>
                </tr>
              <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<script>
  $( document ).ready( function () {
    $('#datatable').DataTable();
  } );
</script>