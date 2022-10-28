<?php
/**
 * Dashboard Company profile content.
 * @package Aquila.
 */
  $getCompany = $this->getCompany( $args );$is_edit = true;
  if( ! $getCompany ) {
    $getCompany = (object) [ 'post' => [], 'meta' => [] ];$is_edit = false;
  }
  $getCompany->meta = wp_parse_args( $getCompany->meta, [
    'name' => '',
    'email' => '',
    'phone' => '',
    'website' => '',
    'extblished' => '',
    'teamsize' => '',
    'categories' => [],
    'is_public' => 1,
    'about' => '',
    'address' => '',
    'social-fb' => '',
    'social-tw' => '',
    'social-ln' => '',
    'social-git' => '',
    'map-latitude' => '',
    'map-longitude' => '',
    'map-zoom' => '',
  ] );
?>
  <form class="my_profile_form_area employer_profile" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" method="post" enctype="multipart/form-data">
    <input type="hidden" name="fwp-company-profile-action" value="<?php echo esc_attr( $is_edit ? 'edit' : 'new' ); ?>">
    <input type="hidden" name="action" value="fwp-company-profile-edit">
    <?php wp_nonce_field( 'fwp-company-profile-edit', 'fwp-company-profile-edit', true, true ); ?>
    <div class="row">
      <div class="col-lg-12">
        <h4 class="fz20 mb20">Company Profile</h4>
      </div>
      <div class="col-lg-12">
          <div class="avatar-upload mb30">
              <div class="avatar-edit">
                  <input class="btn btn-thm" type='file' id="imageUpload" accept=".png, .jpg, .jpeg" />
                  <label for="imageUpload"></label>
              </div>
              <div class="avatar-preview">
                  <div id="imagePreview"></div>
              </div>
          </div>
      </div>
      <div class="col-lg-12">
        <div class="my_profile_thumb_edit"></div>
      </div>
      <div class="col-md-6 col-lg-6">
        <div class="my_profile_input form-group">
            <label for="fwp-dashboard-profile-company-name"><?php esc_html_e( 'Company Name', 'domain' ); ?></label>
            <input type="text" class="form-control" id="fwp-dashboard-profile-company-name" placeholder="Future WordPress" value="<?php echo esc_attr( $getCompany->meta[ 'name' ] ); ?>" name="fwp-company-profile[name]">
        </div>
      </div>
      <div class="col-md-6 col-lg-6">
        <div class="my_profile_input form-group">
            <label for="fwp-dashboard-profile-company-email"><?php esc_html_e( 'Email address', 'domain' ); ?></label>
            <input type="email" class="form-control" id="fwp-dashboard-profile-company-email" placeholder="info@futurewordpress.com" value="<?php echo esc_attr( $getCompany->meta[ 'email' ] ); ?>" name="fwp-company-profile[email]">
        </div>
      </div>
      <div class="col-md-6 col-lg-6">
        <div class="my_profile_input form-group">
            <label for="fwp-dashboard-profile-company-phone"><?php esc_html_e( 'Phone', 'domain' ); ?></label>
            <input type="text" class="form-control" id="fwp-dashboard-profile-company-phone" aria-describedby="phoneNumber" placeholder="+00 0000-000 000" value="<?php echo esc_attr( $getCompany->meta[ 'phone' ] ); ?>" name="fwp-company-profile[phone]">
        </div>
      </div>
      <div class="col-md-6 col-lg-6">
        <div class="my_profile_input form-group">
            <label for="fwp-dashboard-profile-company-website"><?php esc_html_e( 'Website', 'domain' ); ?></label>
            <input type="url" class="form-control" id="fwp-dashboard-profile-company-website" placeholder="www.example.com" value="<?php echo esc_attr( $getCompany->meta[ 'website' ] ); ?>" name="fwp-company-profile[website]">
        </div>
      </div>
      <div class="col-md-6 col-lg-6">
        <div class="my_profile_input form-group">
            <label for="fwp-dashboard-profile-company-extblished"><?php esc_html_e( 'Est. Since', 'domain' ); ?></label>
            <input type="text" class="form-control datepicker" id="fwp-dashboard-profile-company-extblished" placeholder="22/05/2010" value="<?php echo esc_attr( $getCompany->meta[ 'extblished' ] ); ?>" name="fwp-company-profile[extblished]">
        </div>
      </div>
      <div class="col-md-6 col-lg-6">
        <div class="my_profile_select_box form-group">
          <label for="fwp-dashboard-profile-company-team-size"><?php esc_html_e( 'Team Size', 'domain' ); ?></label><br>
          <select class="selectpicker" name="fwp-company-profile[teamsize]">
            <?php
              foreach( [
                "50-100" => "50-100",
                "100-150" => "100-150",
                "150-200" => "150-200",
                "200-0" => "200-infinity"
              ] as $oi => $ov ) {
                echo wp_kses( '<option value="' . $oi . '" data-value="' . $oi . '" ' . ( ( $oi == $getCompany->meta[ 'teamsize' ] ) ? 'selected="true"' : '' ) . '>' . $ov . '</option>', [ 'option' => ['value' => [], 'data-value' => [], 'selected' => [] ] ] );
              }
            ?>
          </select>
        </div>
      </div>
      <div class="col-md-6 col-lg-6">
        <div class="my_profile_select_box form-group">
          <label for="fwp-dashboard-profile-company-category"><?php esc_html_e( 'Categories', 'domain' ); ?></label><br>
          <select class="selectpicker" multiple data-actions-box="true" name="fwp-company-profile[categories]">
            <?php
              $getCategories = get_terms( 'job_categories', [ 'taxonomy' => 'job_categories', 'hide_empty' => false ] );
              foreach( $getCategories as $oi => $ov ) {
                echo wp_kses( '<option value="' . $ov->term_id . '" data-value="' . $ov->term_id . '" ' . ( in_array( $ov->term_id, (array) $getCompany->meta[ 'categories' ] ) ? 'selected="true"' : '' ) . '>' . $ov->name . '</option>', [ 'option' => ['value' => [], 'data-value' => [], 'selected' => [] ] ] );
              }
            ?>
          </select>
        </div>
      </div>
      <div class="col-md-6 col-lg-6">
        <div class="my_profile_select_box form-group">
            <label for="fwp-dashboard-profile-company-is_public"><?php esc_html_e( 'Allow In Search & Listing', 'domain' ); ?></label><br>
            <select class="selectpicker" name="fwp-company-profile[is_public]">
            <?php
            foreach( [ __( 'Yes', 'domain' ), __( 'No', 'domain' ) ] as $oi => $ov ) {
              echo wp_kses( '<option value="' . $oi . '" data-value="' . $oi . '" ' . ( ( $oi == $getCompany->meta[ 'is_public' ] ) ? 'selected="true"' : '' ) . '>' . $ov . '</option>', [ 'option' => ['value' => [], 'data-value' => [], 'selected' => [] ] ] );
            }
            ?>
          </select>
        </div>
      </div>
      <div class="col-lg-12">
        <div class="my_resume_textarea mt20">
            <div class="form-group">
              <label for="fwp-dashboard-profile-company-about"><?php esc_html_e( 'About Company', 'domain' ); ?></label>
              <textarea class="form-control" id="fwp-dashboard-profile-company-about" rows="9" name="fwp-company-profile[about]"><?php echo esc_html( $getCompany->meta[ 'about' ] ); ?></textarea>
            </div>
        </div>
      </div>
      <div class="col-lg-12">
        <h4 class="fz18 mb20"><?php esc_html_e( 'Social Network', 'domain' ); ?></h4>
      </div>
        <div class="col-md-6 col-lg-6">
          <div class="my_profile_input form-group">
              <label for="fwp-dashboard-profile-company-social-fb"><?php esc_html_e( 'Facebook', 'domain' ); ?></label>
              <input type="text" class="form-control" id="fwp-dashboard-profile-company-social-fb" placeholder="<?php esc_attr_e( 'Your social link', 'domain' ); ?>" value="<?php echo esc_attr( $getCompany->meta[ 'social-fb' ] ); ?>" name="fwp-company-profile[social-fb]">
          </div>
        </div>
        <div class="col-md-6 col-lg-6">
          <div class="my_profile_input form-group">
              <label for="fwp-dashboard-profile-company-social-tw"><?php esc_html_e( 'Twitter', 'domain' ); ?></label>
              <input type="text" class="form-control" id="fwp-dashboard-profile-company-social-tw" placeholder="<?php esc_attr_e( 'Your social link', 'domain' ); ?>" value="<?php echo esc_attr( $getCompany->meta[ 'social-tw' ] ); ?>" name="fwp-company-profile[social-tw]">
          </div>
        </div>
        <div class="col-md-6 col-lg-6">
          <div class="my_profile_input form-group">
              <label for="fwp-dashboard-profile-company-social-ln"><?php esc_html_e( 'Linkedin', 'domain' ); ?></label>
              <input type="text" class="form-control" id="fwp-dashboard-profile-company-social-ln" placeholder="<?php esc_attr_e( 'Your social link', 'domain' ); ?>" value="<?php echo esc_attr( $getCompany->meta[ 'social-ln' ] ); ?>" name="fwp-company-profile[social-ln]">
          </div>
        </div>
        <div class="col-md-6 col-lg-6">
          <div class="my_profile_input form-group">
              <label for="fwp-dashboard-profile-company-social-gh"><?php esc_html_e( 'GitHub', 'domain' ); ?></label>
              <input type="text" class="form-control" id="fwp-dashboard-profile-company-social-gh" placeholder="<?php esc_attr_e( 'Your social link', 'domain' ); ?>" value="<?php echo esc_attr( $getCompany->meta[ 'social-git' ] ); ?>" name="fwp-company-profile[social-git]">
          </div>
        </div>
      <div class="col-lg-12">
        <h4 class="fz18 mb20"><?php esc_html_e( 'Contact Information', 'domain' ); ?></h4>
      </div>
      <!-- 
        <div class="col-md-6 col-lg-6">
          <div class="my_profile_select_box form-group">
              <label for="fwp-dashboard-profile-company-country"><?php esc_html_e( 'Country', 'domain' ); ?></label><br>
              <select class="selectpicker" name="fwp-company-profile[country]">
              <option>United Kingdom</option>
              <option>United State</option>
            </select>
          </div>
        </div>
        <div class="col-md-6 col-lg-6">
          <div class="my_profile_select_box form-group">
              <label for="fwp-dashboard-profile-company-city"><?php esc_html_e( 'City', 'domain' ); ?></label><br>
              <select class="selectpicker" name="fwp-company-profile[city]">
              <option>London</option>
              <option>Manchester</option>
              <option>Birmingham</option>
            </select>
          </div>
        </div> -->
      <div class="col-lg-12">
        <div class="my_resume_textarea mt20">
          <div class="form-group">
              <label for="fwp-dashboard-profile-company-address-full"><?php esc_html_e( 'Full Address', 'domain' ); ?></label>
              <textarea class="form-control" id="fwp-dashboard-profile-company-address-full" rows="3" name="fwp-company-profile[address]"><?php echo esc_html( $getCompany->meta[ 'address' ] ); ?></textarea>
          </div>
        </div>
      </div>
      <div class="col-md-4 col-lg-4">
        <div class="my_profile_input form-group">
            <label for="fwp-dashboard-profile-company-latitude"><?php esc_html_e( 'Latitude', 'domain' ); ?></label>
            <input type="text" class="form-control" id="fwp-dashboard-profile-company-latitude" aria-describedby="latNumber" placeholder="51.5073509" value="<?php echo esc_attr( $getCompany->meta[ 'map-latitude' ] ); ?>" name="fwp-company-profile[map-latitude]">
        </div>
      </div>
      <div class="col-md-4 col-lg-4">
        <div class="my_profile_input form-group">
            <label for="fwp-dashboard-profile-company-longitude"><?php esc_html_e( 'Longitude', 'domain' ); ?></label>
            <input type="text" class="form-control" id="fwp-dashboard-profile-company-longitude" aria-describedby="latNumber" placeholder="-0.12775829999998223" value="<?php echo esc_attr( $getCompany->meta[ 'map-longitude' ] ); ?>" name="fwp-company-profile[map-longitude]">
        </div>
      </div>
      <div class="col-md-4 col-lg-4">
        <div class="my_profile_input form-group">
            <label for="fwp-dashboard-profile-company-map-zoom"><?php esc_html_e( 'Zoom', 'domain' ); ?></label>
            <input type="text" class="form-control" id="fwp-dashboard-profile-company-map-zoom" aria-describedby="latNumber" placeholder="16" value="<?php echo esc_attr( $getCompany->meta[ 'map-zoom' ] ); ?>" name="fwp-company-profile[map-zoom]">
        </div>
      </div>
      <div class="col-lg-12">
        <div class="h300" id="map-canvas"></div>
      </div>
      <div class="col-lg-4">
        <div class="my_profile_input">
          <button type="submit" class="btn btn-lg btn-thm"><?php esc_html_e( 'Save Changes', 'domain' ); ?></button>									
        </div>
      </div>
    </div>
  </form>