<?php
/**
 * Single Job template for frontend.
 *
 * @package Aquila
 */
  get_header();
  // global $post;
  // header breadcumbs contents
  $jobInfo = apply_filters( 'futurewordpress/project/renderpost', [], $post );

	do_action( 'futurewordpress/project/job/single/before', $jobInfo );

	do_action( 'futurewordpress/project/job/single/header/before', $jobInfo );
	
  echo apply_filters( 'futurewordpress/project/job/single/header', '', $jobInfo );

	do_action( 'futurewordpress/project/job/single/header/after', $jobInfo );

  ?>
  <pre style="display: none;"><?php print_r( [ FUTUREWORDPRESS_PROJECT_OPTIONS, $jobInfo ] ); ?></pre>
	<!-- Candidate Personal Info Details-->
	<section class="bgc-white pb30">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 col-xl-8">
					<div class="row">
						<div class="col-lg-12">
              <?php do_action( 'futurewordpress/project/job/single/content/before', $jobInfo ); ?>
							<div class="candidate_about_info style2">
                <?php if( isset( FUTUREWORDPRESS_PROJECT_OPTIONS[ 'job_description' ] ) && FUTUREWORDPRESS_PROJECT_OPTIONS[ 'job_description' ] == 'on' && isset( $jobInfo[ 'meta' ][ 'jobs' ][ 'description' ] ) && ! empty( $jobInfo[ 'meta' ][ 'jobs' ][ 'description' ] ) ) : ?>
                  <h4 class="fz20 mb30"><?php esc_html_e( FUTUREWORDPRESS_PROJECT_OPTIONS[ 'job_d