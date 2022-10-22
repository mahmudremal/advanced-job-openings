<?php
/**
 * Job Dashboard CV Manager template file
 * @package Aquila.
 */
?>

<div class="row col-12">
  <div class="col-lg-12 mb30">
    <div class="candidate_job_reivew cv_manager">
      <div class="table-responsive job_review_table">
        <table class="table">
          <tbody>
            <?php
            $getCV = apply_filters( 'futurewordpress/project/job/cv/get', [
              'user' => get_current_user_id()
            ] );
            // print_r( $getCV );
            foreach( $getCV as $cv ) :
              $cv->cv_url = str_replace( [ ABSPATH ], [ site_url( ) ], $cv->cv_path );
              $cv->cv_edit = site_url( 'dashboard/candidate/cvmanager-' . $cv->ID );
              $cv->cv_delete = admin_url( 'admin-post.php' );
              ?>
              <tr class="mb30">
                <th scope="row">
                  <ul>
                    <li class="list-inline-item"><a href="<?php echo esc_url( $cv->cv_url ); ?>"><span class="flaticon-doc font"></span></a></li>
                    <li class="list-inline-item cv_sbtitle"><a href="<?php echo esc_url( $cv->cv_edit ); ?>"><?php echo esc_html( $cv->cv_name ); ?></a></li>
                  </ul>
                </th>
                <td></td>
                <td></td>
                <td></td>
                <td>
                  <ul class="view_edit_delete_list">
                    <li class="list-inline-item"><a class="edit-cv-fwp" href="javascript:void(0);" data-id="<?php echo esc_attr( $cv->ID ); ?>" data-name="<?php echo esc_attr( $cv->cv_name ); ?>" data-href="<?php echo esc_url( $cv->cv_edit ); ?>" data-toggle="tooltip" data-placement="top" title="<?php esc_attr_e( 'Edit', 'domain' ); ?>"><span class="flaticon-edit"></span></a></li>
                    <li class="list-inline-item"><a class="delete-cv-fwp" href="javascript:void(0);" data-id="<?php echo esc_attr( $cv->ID ); ?>" data-name="<?php echo esc_attr( $cv->cv_name ); ?>" data-href="<?php echo esc_url( $cv->cv_delete ); ?>" data-toggle="tooltip" data-placement="top" title="<?php esc_attr_e( 'Delete', 'domain' ); ?>"><span class="flaticon-rubbish-bin"></span></a></li>
                  </ul>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <div class="col-lg-12 col-xl-12">
    <div class="candidate_resume_uploader">
      <p class="form_title"><?php esc_html_e( 'Curriculum Vitae', 'domain' ); ?></p>
      <form class="form-inline" name="fwp_form_CV_ADD">
        <input class="upload-path" placeholder="<?php esc_attr_e( 'Design CV', 'domain' ); ?>" name="name" required/>
        <label class="upload">
            <input type="file" accept=".pdf,.doc,.docx" name="file"/>
            <p><span class="flaticon-download"></span> <?php esc_html_e( 'Upload CV', 'domain' ); ?></p>
        </label>
      </form>
        <small class="form-text text-muted"><?php esc_html_e( 'Suitable files are .doc,.docx,.pdf.', 'domain' ); ?></small>
    </div>
  </div>
</div>
<style>
  .cv_manager .job_review_table .table td:not(:first-child) {border-left: 0;}
  .cv_manager .job_review_table .table td:not(:last-child) {border-right: 0;}
  .cv_manager .job_review_table .table th {border-right: 0;}
</style>