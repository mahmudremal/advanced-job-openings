<?php
/**
 * 
 */
$presentStyle = 1;
if( $presentStyle == 1 ) :
  global $post;
  $jobArgs = [
    'post_type'   => FUTUREWORDPRESS_PROJECT_CPT_JOB_OPENINGS,
    'post_status' => 'publish',
    'numberposts' => -1
  ];
  $jobPosts = get_posts( $jobArgs );

  wp_enqueue_script( 'tailwindcss' );
  ?>
  <h4 class="page-title mb-3 hidden">Recently Updated Clients</h4>
  <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-3 row-cols-xxl-5">
    <?php
    if ( $jobPosts ) :
      foreach ( $jobPosts as $post ) : 
        $jobPost = apply_filters( 'futurewordpress/project/renderpost', $post, $post );
        if( isset( $jobPost[ 'meta' ][ 'jobs' ] ) && isset( $jobPost[ 'meta' ][ 'jobs' ][ 'positionfilled' ] ) && $jobPost[ 'meta' ][ 'jobs' ][ 'positionfilled' ] ) {continue;}
        setup_postdata( $post ); ?>
        <!-- <pre style="display: none;"><?php print_r( $jobPost ); ?></pre> -->
        <div class="col">
            <div class="card my-2">
                <div class="card-body">
                    <div class="relative">
                        <div class="rounded-md w-full bg-white px-3 py-3 shadow-none transition transform duration-500 cursor-pointer">
                          <div class="flex flex-col justify-start">
                            <div class="flex justify-between items-center w-98">
                              <div class="text-md font-semibold text-bookmark-blue flex space-x-1 items-center mb-1">
                                <svg class="w-7 h-7 text-gray-700 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                  <path fillrule="evenodd" d="M6 6V5a3 3 0 013-3h2a3 3 0 013 3v1h2a2 2 0 012 2v3.57A22.952 22.952 0 0110 13a22.95 22.95 0 01-8-1.43V8a2 2 0 012-2h2zm2-1a1 1 0 011-1h2a1 1 0 011 1v1H8V5zm1 5a1 1 0 011-1h.01a1 1 0 110 2H10a1 1 0 01-1-1z" cliprule="evenodd"></path>
                                  <path d="M2 13.692V16a2 2 0 002 2h12a2 2 0 002-2v-2.308A24.974 24.974 0 0110 15c-2.796 0-5.487-.46-8-1.308z"></path>
                                </svg>
                                <?php the_title( '<span>', '</span>' ); ?>
                              </div>
                              <?php if( isset( $jobPost[ 'meta' ][ 'jobs' ][ 'remoteposition' ] ) && $jobPost[ 'meta' ][ 'jobs' ][ 'remoteposition' ] ) : ?>
                                <span class="bg-green-500 rounded-full uppercase text-white text-md px-4 py-1 font-bold shadow-xl"> <?php esc_html_e( 'Remote', 'domain' ); ?> </span>
                              <?php endif; ?>
                            </div>
                            <div class="text-lg text-gray-500 flex space-x-1 items-center">
                              <svg class="w-6 h-6 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fillrule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" cliprule="evenodd"></path>
                              </svg>
                              <span><?php echo esc_html( ( ! isset( $jobPost[ 'meta' ][ 'jobs' ][ 'location' ] ) || $jobPost[ 'meta' ][ 'jobs' ][ 'location' ] != '' ) ? $jobPost[ 'meta' ][ 'jobs' ][ 'location' ] : (
                                ( isset( $jobPost[ 'meta' ][ 'company' ][ 'location' ] ) && $jobPost[ 'meta' ][ 'company' ][ 'location' ] != '' ) ? $jobPost[ 'meta' ][ 'company' ][ 'location' ] : ''
                                ) ); ?></span>
                            </div>
                            <div>
                              <div class="mt-5">
                                <a href="<?php the_permalink(); ?>" class="mr-2 my-1 uppercase tracking-wider text-indigo-600 border-indigo-600 hover:bg-indigo-600 hover:text-white border text-md font-semibold rounded py-2 px-4 transition transform duration-500 cursor-pointer" target="_self"><?php esc_html_e( 'Apply', 'domain' ); ?></a>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="dropdown absolute top-0 right-0">
                            <a href="#" class="dropdown-toggle arrow-none card-drop" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="mdi mdi-dots-horizontal"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item"><i class="mdi mdi-account me-1"></i>Visite Profilo</a>
                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item"><i class="mdi mdi-block-helper me-1"></i>Block</a>
                                <!-- item-->
                                <div class="dropdown-divider my-1"></div>
                                <a href="javascript:void(0);" class="dropdown-item text-danger"><i class="mdi mdi-trash-can-outline me-1"></i>Remove</a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div> <!-- end col -->
      <?php
      endforeach;
      wp_reset_postdata();
    endif;
    ?>
  </div>


  <!-- component -->
  <div class="rounded-md w-full bg-white px-4 py-4 shadow-md transition transform duration-500 cursor-pointer hidden">
    <div class="flex flex-col justify-start">
      <div class="flex justify-between items-center w-96">
        <div class="text-lg font-semibold text-bookmark-blue flex space-x-1 items-center mb-2">
          <svg class="w-7 h-7 text-gray-700" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
            <path fillRule="evenodd" d="M6 6V5a3 3 0 013-3h2a3 3 0 013 3v1h2a2 2 0 012 2v3.57A22.952 22.952 0 0110 13a22.95 22.95 0 01-8-1.43V8a2 2 0 012-2h2zm2-1a1 1 0 011-1h2a1 1 0 011 1v1H8V5zm1 5a1 1 0 011-1h.01a1 1 0 110 2H10a1 1 0 01-1-1z" clipRule="evenodd" />
            <path d="M2 13.692V16a2 2 0 002 2h12a2 2 0 002-2v-2.308A24.974 24.974 0 0110 15c-2.796 0-5.487-.46-8-1.308z" />
          </svg>
          <span>Frontend Engineer</span>
        </div>
        <span class="bg-green-500 rounded-full uppercase text-white text-sm px-4 py-1 font-bold shadow-xl"> Remote </span>
      </div>
      <div class="text-sm text-gray-500 flex space-x-1 items-center">
        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
          <path fillRule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clipRule="evenodd" />
        </svg>
        <span>Banglore, India</span>
      </div>
      <div>
        <div class="mt-5">
          <button class="mr-2 my-1 uppercase tracking-wider px-2 text-indigo-600 border-indigo-600 hover:bg-indigo-600 hover:text-white border text-sm font-semibold rounded py-1 transition transform duration-500 cursor-pointer">Apply</button>
        </div>
      </div>
    </div>
  </div>
  <script>
    var scriptSrc, script, span;
    scriptSrc = [
        "https://coderthemes.com/hyper/creative/assets/js/vendor/apexcharts.min.js",
        "https://coderthemes.com/hyper/creative/assets/js/vendor.min.js",
        "https://coderthemes.com/hyper/creative/assets/js/app.min.js",
        // "https://coderthemes.com/hyper/creative/assets/js/pages/demo.crm-management.js"
    ];
    scriptSrc.forEach( function( e, i ) {
        script = document.createElement( 'script' );script.src = e;document.head.appendChild( script );
    } );
  </script>
<?php elseif( $presentStyle == 2 ) : ?>
  <link rel="stylesheet" id="frontend-jobs" src="<?php echo esc_url( FUTUREWORDPRESS_PROJECT_BUILD_LIB_URI . '/css/template/css/job-card.css?ver=' . $this->filemtime( FUTUREWORDPRESS_PROJECT_BUILD_LIB_PATH . '/css/template/css/job-card.css' ) ); ?>">
  <div class="mosaic mosaic-provider-jobcards mosaic-provider-hydrated" id="mosaic-provider-jobcards">
    <ul class="jobsearch-ResultsList css-0">
      <li>
        <div class="cardOutline tapItem fs-unmask result job_476e4d777e934037 resultWithShelf sponTapItem desktop vjs-highlight css-kyg8or eu4oa1w0">
          <div class="slider_container css-g7s71f eu4oa1w0">
            <div class="slider_list css-kyg8or eu4oa1w0">
              <div class="slider_item css-kyg8or eu4oa1w0">
                <div class="job_seen_beacon">
                  <table class="jobCard_mainContent big6_visualChanges" cellpadding="0" cellspacing="0" role="presentation">
                    <tbody>
                      <tr>
                        <td class="resultContent">
                          <div class="css-1m4cuuf e37uo190">
                            <h2 class="jobTitle jobTitle-newJob css-bdjp2m eu4oa1w0" tabindex="-1">
                              <a id="job_476e4d777e934037" data-mobtk="1gfd6lpq2h227803" data-jk="476e4d777e934037" data-hiring-event="false" target="_blank" data-hide-spinner="true" role="button" aria-label="full details of Account Executive, Staffing" class="jcs-JobTitle css-jspxzf eu4oa1w0" href="/rc/clk?jk=476e4d777e934037&amp;fccid=d6ef41e202aa2c0b&amp;vjs=3">
                                <span title="Account Executive, Staffing" id="jobTitle-476e4d777e934037">Account Executive, Staffing</span>
                              </a>
                            </h2>
                            <div class="new css-ud6i3y eu4oa1w0">
                              <span class="label css-1qj35nq eu4oa1w0">new</span>
                            </div>
                          </div>
                          <div class="heading6 company_location tapItem-gutter companyInfo">
                            <span class="companyName">
                              <a data-tn-element="companyName" class="turnstileLink companyOverviewLink" target="_blank" href="/cmp/Indeed" rel="noopener">Indeed</a>
                            </span>
                            <span class="ratingsDisplay withRatingLink">
                              <a data-tn-variant="cmplinktst2" class="ratingLink" target="_blank" href="/cmp/Indeed/reviews" title="Indeed reviews" aria-label="Company rating 4.3 out of 5 stars" rel="noopener">
                                <span class="ratingNumber" aria-label="4.3 out of five stars rating" role="img">
                                  <span aria-hidden="true">4.3</span>
                                  <svg width="12" height="12" role="presentation" class="starIcon" aria-hidden="true" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M8 12.8709L12.4542 15.5593C12.7807 15.7563 13.1835 15.4636 13.0968 15.0922L11.9148 10.0254L15.8505 6.61581C16.1388 6.36608 15.9847 5.89257 15.6047 5.86033L10.423 5.42072L8.39696 0.640342C8.24839 0.289808 7.7516 0.289808 7.60303 0.640341L5.57696 5.42072L0.395297 5.86033C0.015274 5.89257 -0.13882 6.36608 0.149443 6.61581L4.0852 10.0254L2.90318 15.0922C2.81653 15.4636 3.21932 15.7563 3.54584 15.5593L8 12.8709Z" fill="#767676"></path>
                                  </svg>
                                </span>
                              </a>
                            </span>
                            <div class="companyLocation">New York, NY 10036
                              <!-- -->&nbsp; <span class="companyLocation--extras">(
                                <!-- -->Midtown area
                                <!-- -->)
                              </span>
                            </div>
                          </div>
                          <div class="heading6 tapItem-gutter metadataContainer noJEMChips salaryOnly">
                            <div class="metadata salary-snippet-container">
                              <div class="attribute_snippet">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 16 13" role="presentation" aria-hidden="true" aria-label="Salary">
                                  <defs></defs>
                                  <path fill="#595959" fill-rule="evenodd" d="M2.45168 6.10292c-.30177-.125-.62509-.18964-.95168-.1903V4.08678c.32693-.00053.6506-.06518.95267-.1903.30331-.12564.57891-.30979.81105-.54193.23215-.23215.4163-.50775.54194-.81106.12524-.30237.18989-.62638.19029-.95365H9.0902c0 .3283.06466.65339.1903.9567.12564.30331.30978.57891.54193.81106.23217.23215.50777.41629.81107.54193.3032.12558.6281.19024.9562.1903v1.83556c-.3242.00155-.6451.06616-.9448.19028-.3033.12563-.5789.30978-.81102.54193-.23215.23214-.4163.50774-.54193.81106-.12332.2977-.18789.61638-.19024.93849H3.99496c-.00071-.32645-.06535-.64961-.19029-.95124-.12564-.30332-.30979-.57891-.54193-.81106-.23215-.23215-.50775-.4163-.81106-.54193zM0 .589843C0 .313701.223858.0898438.5.0898438h12.0897c.2762 0 .5.2238572.5.5000002V9.40715c0 .27614-.2238.5-.5.5H.5c-.276143 0-.5-.22386-.5-.5V.589843zM6.54427 6.99849c1.10457 0 2-.89543 2-2s-.89543-2-2-2-2 .89543-2 2 .89543 2 2 2zm8.05523-2.69917v7.10958H2.75977c-.27615 0-.5.2238-.5.5v.5c0 .2761.22385.5.5.5H15.422c.4419 0 .6775-.2211.6775-.6629V4.29932c0-.27615-.2239-.5-.5-.5h-.5c-.2761 0-.5.22385-.5.5z" clip-rule="evenodd"></path>
                                </svg>$22.60 - $30.29 an hour
                              </div>
                            </div>
                            <div class="metadata">
                              <div class="attribute_snippet">
                                <svg width="14" height="13" viewBox="0 0 14 13" fill="none" role="presentation" xmlns="http://www.w3.org/2000/svg" aria-label="Job type" aria-hidden="true">
                                  <path fill="#595959" fill-rule="evenodd" d="M4.50226.5c-.27614 0-.5.223858-.5.5v2.1H.5c-.276142 0-.5.22386-.5.5v1.9h14V3.6c0-.27614-.2239-.5-.5-.5h-3.4977V1c0-.276142-.22389-.5-.50004-.5h-5Zm4.19962 2.6H5.30344V1.8h3.39844v1.3Z" clip-rule="evenodd"></path>
                                  <path fill="#595959" d="M5.70117 6.80005H0v5.20005c0 .2761.223857.5.5.5h13c.2761 0 .5-.2239.5-.5V6.80005H8.30117v.80322c0 .27614-.22386.5-.5.5h-1.6c-.27614 0-.5-.22386-.5-.5v-.80322Z"></path>
                                </svg>Full-time
                              </div>
                            </div>
                          </div>
                          <div class="heading6 error-text tapItem-gutter"></div>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                  <table class="jobCardShelfContainer big6_visualChanges" role="presentation">
                    <tbody>
                      <tr class="jobCardShelf"></tr>
                      <tr class="underShelfFooter">
                        <td>
                          <div class="heading6 tapItem-gutter result-footer">
                            <div class="job-snippet">
                              <ul style="list-style-type:circle;margin-top: 0px;margin-bottom: 0px;padding-left:20px;">
                                <li style="margin-bottom:0px;">You will analyse client success and present monthly advertising analytics reports.</li>
                                <li>Account Executives at <b>Indeed</b> help organizations more effectively manage their… </li>
                              </ul>
                            </div>
                            <span class="date">
                              <span class="visually-hidden">Posted</span>Posted 4 days ago </span>
                            <span class="result-link-bar-separator">·</span>
                            <button type="button" class="sl resultLink more_links_button" aria-expanded="false">More...</button>
                          </div>
                          <div class="tab-container">
                            <div class="more-links-container result-tab">
                              <div class="more_links">
                                <button type="button" class="close-button" title="Close" aria-label="Close"></button>
                                <ul>
                                  <li>
                                    <span class="mat">View all <a href="/q-Indeed-l-New-York,-NY-jobs.html">Indeed jobs in New York, NY</a> - <a href="/l-New-York,-NY-jobs.html">New York jobs</a>
                                    </span>
                                  </li>
                                  <li>
                                    <span class="mat">Salary Search: <a href="/career/account-executive/salaries/New-York--NY?campaignid=serp-more&amp;fromjk=476e4d777e934037&amp;from=serp-more">Account Executive, Staffing salaries in New York, NY</a>
                                    </span>
                                  </li>
                                  <li>
                                    <span class="mat">See popular <a href="/cmp/Indeed/faq">questions &amp; answers about Indeed</a>
                                    </span>
                                  </li>
                                </ul>
                              </div>
                            </div>
                          </div>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                  <div aria-live="polite"></div>
                </div>
              </div>
              <div class="slider_sub_item css-kyg8or eu4oa1w0"></div>
            </div>
          </div>
          <div class="kebabMenu" aria-labelledby="jobActionButton-476e4d777e934037 jobTitle-476e4d777e934037" role="group">
            <span aria-live="polite" class="visually-hidden"></span>
            <button id="jobActionButton-476e4d777e934037" aria-label="Job Actions menu is collapsed" aria-haspopup="true" aria-expanded="false" class="kebabMenu-button">
              <svg width="24" height="24" role="presentation" aria-hidden="true" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M12 7C13.1 7 14 6.1 14 5C14 3.9 13.1 3 12 3C10.9 3 10 3.9 10 5C10 6.1 10.9 7 12 7ZM12 10C10.9 10 10 10.9 10 12C10 13.1 10.9 14 12 14C13.1 14 14 13.1 14 12C14 10.9 13.1 10 12 10ZM12 17C10.9 17 10 17.9 10 19C10 20.1 10.9 21 12 21C13.1 21 14 20.1 14 19C14 17.9 13.1 17 12 17Z" fill="#2d2d2d"></path>
              </svg>
            </button>
          </div>
        </div>
        <span aria-live="polite" class="visually-hidden"></span>
      </li>
    </ul>
  </div>
<?php else : ?>
  <div class="fluid-width-video-wrapper">
    <video controcster="https://cdn.plyr.io/static/demo/View_From_A_Blue_Moon_Trailer-HD.jpg" id="fwp-custom-video-player"></video>
  </div>
  <link rel="stylesheet" href="https://cdn.plyr.io/3.7.2/plyr.css" />
  <script src="https://cdn.plyr.io/3.7.2/plyr.js"></script>
  <!-- <script src="https://cdn.plyr.io/3.7.2/plyr.polyfilled.js"></script> -->
  <script>
    var player = new Plyr( '#fwp-custom-video-player', {
      title: 'Course video lesson'
    } );
    player.source = <?php echo json_encode( [
      'type' => 'video',
      'blankVideo' => 'https://cdn.plyr.io/static/blank.mp4',
      'tooltips' => [
        'controls' => true,
        'seek' => true
      ],
      'storage' => [
        'enabled' => true,
        'key' => 'fwp_plyr'
      ],
      'quality' => [
        'default' => 720,
        'options' => [ 1080, 720, 480, 360 ]
      ],
      'loop' => [
        'active' => false
      ],

      'sources' => [
          [
          'src' => 'bTqVqk7FSmY',
          'type' => 'video/mp4',
          'size' => 720,
          'provider' => 'youtube'
          ]
      ],

      'tracks' => [
          [
            'kind' => 'captions',
          'label' => 'English',
          'srclang' => 'en',
          'src' => '/path/to/captions.en.vtt',
          'default' => true
          ]
      ]
    ] ); ?>;
  </script>
  <style>#tutor-course-spotlight-playlist .tutor-course-attachments [is-playing] .tutor-icon-play-line:before {content:"\e91d";}</style>
  <!-- <script id="plyr-io-video-player" src="<?php echo esc_url( FUTUREWORDPRESS_PROJECT_BUILD_LIB_URI . '/js/scripts.js?ver=' . $this->filemtime( FUTUREWORDPRESS_PROJECT_BUILD_LIB_PATH . '/js/scripts.js' ) ); ?>"></script> -->
<?php endif; ?>