<?php
/**
 * Register Meta Boxes
 * https://jeremyhixon.com/tool/wordpress-meta-box-generator
 * @package FutureWordPress Project.
 */

namespace FUTUREWORDPRESS_PROJECT\Inc;

use FUTUREWORDPRESS_PROJECT\Inc\Traits\Singleton;
class Meta_Boxes {

	use Singleton;
  
  /**
   * yOU CAN GET ALL OF THE DATA STORED ON wp_post_meta table USIONG THIS get_post_meta() function.
   * 
   * Retrieving the values:
   * Checkbox = get_post_meta( get_the_ID(), 'futurewordpress_checkbox', true )
   */
  /**
   * All fields datas are stored on there. post
   */
	private $configs = '[
	  {"title":"Company Information","description":"Your Job information field, that might be necessary or required.","prefix":"fwp_","domain":"fwp-ajo","class_name":"fwp-companies-compinfo","post-type":["companies"],"context":"advanced","priority":"core","cpt":"companies","fields":[
      {"type":"select","label":"Authorized by *","default":"0","options":"0: Select Company owner","id":"fwp_company-authorizeid","dynamic":["alluser"]},
      {"type":"text","label":"Name","id":"fwp_company-name"},
      {"type":"text","label":"Tag Line","id":"fwp_company-tag-line"},
      {"type":"textarea","label":"About","id":"fwp_company-about","placeholder": "Company about"},
      {"type":"text","label":"Extblished year","id":"fwp_company-extblished"},
      {"type":"select","label":"Team size *","default":"0","options":"0: Select Team Size\r\n50-100: 50-100\r\n100-150: 100-150\r\n150-200: 150-200\r\n200-0: 200-infinity","id":"fwp_company-teamsize"},
      {"type":"select","label":"Public","default":"1","options":"1: Yes\r\n0: No","id":"fwp_company-is_public"},
      {"type":"text","label":"Address","id":"fwp_company-address"},
      {"type":"text","label":"Zip Code","id":"fwp_company-zip"},
      {"type":"text","label":"City","id":"fwp_company-city"},
      {"type":"email","label":"Email","id":"fwp_company-email"},
      {"type":"phone","label":"Phone Number","id":"fwp_company-phone"},
      {"type":"url","label":"Website","id":"fwp_company-website"},
      {"type":"text","label":"Location area","id":"fwp_company-location"},
      {"type":"media","label":"Logo","button-text":"Upload","return":"url","modal-title":"Choose a Logo","modal-button":"Select Logo","id":"fwp_company-logo"},
      {"type":"url","label":"Social Facebook","id":"fwp_company-social-fb"},
      {"type":"url","label":"Social Twitter","id":"fwp_company-social-tw"},
      {"type":"url","label":"Social Linkedin","id":"fwp_company-social-ln"},
      {"type":"url","label":"Social Github","id":"fwp_company-social-git"}
      ]},
		{"title":"Job Information","description":"Your Job information field, that might be necessary or required.","prefix":"fwp_","domain":"fwp-ajo","class_name":"fwp-job_openings-jobinfo","post-type":["job_openings"],"context":"advanced","priority":"core","cpt":"job_openings","fields":[
			{"type":"select","label":"Posted by","default":"1","options":"0: Select Posted by","id":"fwp_jobs-postedby","dynamic":["alluser"]},
			{"type":"select","label":"Company","default":"1","options":"0: Select Company","id":"fwp_jobs-company","dynamic":["company"]},
			{"type":"editor","label":"Description","id":"fwp_jobs-description"},
      {"type":"editor","label":"Responsibilities","id":"fwp_jobs-responsibilities"},
      {"type":"editor","label":"Experience","id":"fwp_jobs-experience"},
      {"type":"editor","label":"Requirments","id":"fwp_jobs-requirments"},
      {"type":"editor","label":"Offering","id":"fwp_jobs-offering"}
			]
    },
		{"title":"Job Meta","description":"Your Job information field, that might be necessary or required.","prefix":"fwp_","domain":"fwp-ajo","class_name":"fwp-job_openings-jobmeta","post-type":["job_openings"],"context":"side","priority":"core","cpt":"job_openings","fields":[
      {"type":"text","label":"Internal ID","id":"fwp_jobs-internalid","description":"Internal ID, should be an Unique ID.","placeholder": "Job Internal ID","dynamic":["jobunique"]},
      {"type":"text","label":"Salary min","id":"fwp_jobs-salary","description":"Minimum salary amount without any seperator or comma."},
      {"type":"text","label":"Salary max","id":"fwp_jobs-salaryto","description":"Maximum salary possibility without any comma or any saperator. Leave it blank if your salary is fixed."},
      {"type":"select","label":"Salary Round","default":"1","options":"0: Select Round\r\nhourly: Hourly\r\ndaily: Daily\r\nweekly: Weekly\r\nmonthly: Monthly\r\nyearly: Yearly","id":"fwp_jobs-salaryround"},
      {"type":"select","label":"Currency","default":"1","options":"0: Select Currency","id":"fwp_jobs-currency","dynamic":["currency"]},
      {"type":"radio","label":"Gender","default":"both","options":"male: Male\r\nfemale: Female\r\nboth: Both","id":"fwp_jobs-gender"},
			{"type":"text","label":"Location","id":"fwp_jobs-location"},
			{"type":"text","label":"Job State","id":"fwp_jobs-state"},
      {"type":"text","label":"Career Level","id":"fwp_jobs-careerlevel","description":"Career Level in common and short hand.","placeholder": "EG. Executive"},
      {"type":"text","label":"Industry","id":"fwp_jobs-industry","description":"Industry in common and short hand.","placeholder": "EG. Management"},
      {"type":"text","label":"Experience","id":"fwp_jobs-experienceshort","description":"Experience in years or as short as possible."},
      {"type":"text","label":"Qualification","id":"fwp_jobs-qualification","description":"Qualification. Try to reduce text to take around of 20.","placeholder": "EG. Bachelor Degree"},
			{"type":"date","label":"Closing Date","default":"2022-10-12","max-data":"","min":"2022-10-12","step":"1","id":"fwp_jobs-closingdate","dynamic":["mindate","maxdate"]},
			{"type":"checkbox","label":"Featured Listing","description":"Featured listings will be sticky during searches, and can be styled differently.","id":"fwp_jobs-featuredlisting"},
			{"type":"checkbox","label":"Remote Position","description":" Select if this is a remote Job.","id":"fwp_jobs-remoteposition"},
			{"type":"checkbox","label":"Position Filled","description":" Filled listings will no longer accept applications.","id":"fwp_jobs-positionfilled"},
			{"type":"checkbox","label":"Hide Company","description":"Hide company will no longer display company information without location area.","id":"fwp_jobs-hidecompany"}
			]
    }
	]';
	private $config = null;
  /**
   * Construct is a function that autometically called by PHP before reading a classes other functions.
   * So you can configure any thing from here before functions execution
   */
  public function __construct() {
    /**
     * Render data from this custom metabox from an array.
     */
		$this->configs = json_decode( $this->configs, true );
		$this->prepareConfig();
		$this->process_cpts();
		add_action( 'admin_init', [ $this, 'admin_init' ], 2 );
    
    /**
     * add_action() is a function where all plugins and themes functions stored and called according to an order.
     * "add_meta_boxes" is a tag, means this CUSTOM_META_BOXES::add_meta_boxes() function will called when WordPress execute this function on adding metabox tme.
     * "10" means priority or number of order of where this function will called.
     * "0" meant that, this "custom_meta_box()" function accepts no arguments.
     * Here is the function syntex
     * add_action( tag, function_to_add(), priority, accepted_args )
     */
		add_action( 'add_meta_boxes', [ $this, 'add_meta_boxes' ] );
    /**
     * hook 'admin_enqueue_scripts' called when some scripts needed to run metaboxes operational. This will called WP_MEDIA scripts to enclude.
     */
		add_action( 'admin_enqueue_scripts', [ $this, 'admin_enqueue_scripts' ] );
    /**
     * hook 'admin_enqueue_styles' called to include stylesttet and styles on WP meta boxes end.
     */
		add_action( 'admin_enqueue_styles', [ $this, 'admin_enqueue_styles' ] );
    /**
     * 'admin_head' hooks use to insert some script on admin pages <head> tag.
     */
		add_action( 'admin_head', [ $this, 'admin_head' ] );
    /**
     * 'save_post' is called only when user used to save / uppdate a post so save this meta boxes data.
     */
		add_action( 'save_post', [ $this, 'save_post' ] );
    if( is_FwpActive( 'reedit_author' ) ) {
      add_action( 'wp_insert_post_data', [ $this, 'reedit_author' ], 10, 4 );
    }
  }
  public function prepareConfig() {
    foreach( $this->configs as $i => $config ) {
			foreach( $config[ 'fields' ] as $f => $field ) {
				if( isset( $field[ 'dynamic' ] ) ) {
          if( in_array( 'alluser', $field[ 'dynamic' ] ) && isset( $field[ 'options' ] ) ) {
            $allUsersData = get_users( [ 'fields' => [ 'ID', 'display_name' ] ] );
            foreach ( $allUsersData as $user ) {
              $config[ 'fields' ][ $f ][ 'options' ] .= "\r\n" . $user->ID . ': ' . $user->display_name;
            }
          } else if( in_array( 'mindate', $field[ 'dynamic' ] ) ) {
            $config[ 'fields' ][ $f ][ 'min' ] = date( 'Y-m-d' );
          } else if( in_array( 'max', $field[ 'dynamic' ] ) ) {
            $config[ 'fields' ][ $f ][ 'max' ] = date( 'Y-m-d', strtotime( '+2 years', strtotime( time() ) ) );
          } else if( in_array( 'jobunique', $field[ 'dynamic' ] ) ) {
						$config[ 'fields' ][ $f ][ 'default' ] = ( is_FwpActive( 'job_internal_id_default' ) ) ? uniqid( get_fwp_option( 'job_interna_id_prefix', 'job' ) ) : '';
          } else if( in_array( 'currency', $field[ 'dynamic' ] ) ) {
            // FUTUREWORDPRESS_PROJECT_OPTIONS[ 'currencies' ]
						$getCurrency = apply_filters( 'futurewordpress/project/job/currencies', [ 'USD', 'EUR' ] );
            foreach( $getCurrency as $t => $tk ) {
              $config[ 'fields' ][ $f ][ 'options' ] .= "\r\n" . $tk . ': ' . $tk;
            } 
          } else if( in_array( 'company', $field[ 'dynamic' ] ) && isset( $field[ 'options' ] ) ) {
            $allCompanies = get_posts( [
              'post_type' => 'companies',
              'numberposts' => -1,
              // 'fields' => 'ids, names',
              'orderby'    => 'menu_order',
              'sort_order' => 'desc',
            ] );
            foreach ( $allCompanies as $company ) {
              $config[ 'fields' ][ $f ][ 'options' ] .= "\r\n" . $company->ID . ': ' . $company->post_title;
            }
          } else {}
					$this->configs[ $i ] = $config;
				}
			}
		}
  }
  /**
   * Function where custom metabox request function will executed
   */
	public function process_cpts() {
    foreach( $this->configs as $i => $config ) {
			$this->config = $config;
			if ( !empty( $this->config['cpt'] ) ) {
				if ( empty( $this->config['post-type'] ) ) {
					$this->config['post-type'] = [];
				}
				$parts = explode( ',', $this->config['cpt'] );
				$parts = array_map( 'trim', $parts );
				$this->config['post-type'] = array_merge( $this->config['post-type'], $parts );
			}
			$this->configs[ $i ] = $this->config;
		}
	}

	public function add_meta_boxes() {
		foreach( $this->configs as $i => $config ) {
			$this->config = $config;
			foreach ( $this->config['post-type'] as $screen ) {
				add_meta_box(
					sanitize_title( $this->config['title'] ),
					$this->config['title'],
					[ $this, 'add_meta_box_callback_' . $i ],
					$screen,
					$this->config['context'],
					$this->config['priority']
				);
			}
		}
	}
	public function admin_init() {
		add_meta_box( 'fwp_job_vanues-group', __( 'Job dates and Locations', 'domain' ), [ $this, 'repeater' ], 'job_openings', 'normal', 'default');
		add_action('save_post', [ $this, 'save_repeater' ] );
	}
	public function repeater() {
    global $post;
    $fwp_job_vanues_group = get_post_meta($post->ID, 'fwp_jobs-vanues', true);
		wp_nonce_field( 'gpm_repeatable_meta_box_nonce', 'gpm_repeatable_meta_box_nonce' );
    ?>
    <script type="text/javascript">
			jQuery(document).ready(function( $ ){
				$( '#add-row' ).on('click', function() {
					var row = $( '.empty-row.screen-reader-text' ).clone(true);
					row.removeClass( 'empty-row screen-reader-text' );
					row.insertBefore( '#repeatable-fieldset-one tbody>tr:last' );
					return false;
				});
				$( '.remove-row' ).on('click', function() {
					$(this).parents('tr').remove();
					return false;
				});
			});
		</script>
		<table id="repeatable-fieldset-one" width="100%">
			<tbody>
				<?php
				// $fwp_job_vanues_group = 
				$jobLocations = get_terms( [
					'taxonomy'		=> 'job_locations',
					'hide_empty'	=> false
				] );
				
				if ( $fwp_job_vanues_group ) :
					foreach ( $fwp_job_vanues_group as $field ) {
						?>
						<tr>
							<td class="job-row">
								<input class="jobvanuedate" type="date" placeholder="<?php esc_attr_e( 'Date', 'domain' ); ?>" title="<?php esc_attr_e( 'Date', 'domain' ); ?>" name="JobDate[]" value="<?php if($field['JobDate'] != '') echo esc_attr( $field['JobDate'] ); ?>" />
								<select class="jobvanuelocation" name="JobLocation[]">
									<?php foreach( $jobLocations as $location ) : ?>
										<option value="<?php echo esc_attr( $location->term_id ); ?>" <?php echo esc_attr( ( $field['JobLocation'] == $location->term_id ) ? 'checked' : '' ); ?>><?php echo esc_html( $location->name ); ?></option>
									<?php endforeach; ?>
								</select>
								<textarea class="fwp-regular-text jobvanuerequirments" placeholder="Description" cols="55" rows="5" name="JobRequirments[]"><?php echo esc_attr( $field['JobRequirments'] ); ?></textarea>
							</td>
							<td width="15%"><a class="button remove-row" href="#1">Remove</a></td>
						</tr>
						<?php
					}
				else :
				// show a blank one
				?>
				<tr>
					<td class="job-row">
						<input class="jobvanuedate" type="date" placeholder="<?php esc_attr_e( 'Date', 'domain' ); ?>" title="<?php esc_attr_e( 'Date', 'domain' ); ?>" name="JobDate[]" />
						<select class="jobvanuelocation" name="JobLocation[]">
							<?php foreach( $jobLocations as $location ) : ?>
								<option value="<?php echo esc_attr( $location->term_id ); ?>"><?php echo esc_html( $location->name ); ?></option>
							<?php endforeach; ?>
						</select>
						<textarea class="fwp-regular-text jobvanuerequirments" placeholder="<?php esc_attr_e( 'Requirments', 'domain' ); ?>" name="JobRequirments[]" cols="55" rows="5"></textarea>
					</td>
					<td><a class="button cmb-remove-row-button button-disabled" href="#"><?php esc_html_e( 'Remove', 'domain' ); ?></a></td>
				</tr>
				<?php endif; ?>

				<!-- empty hidden one for jQuery -->
				<tr class="empty-row screen-reader-text">
				<td class="job-row">
						<input class="jobvanuedate" type="date" placeholder="<?php esc_attr_e( 'Date', 'domain' ); ?>" title="<?php esc_attr_e( 'Date', 'domain' ); ?>" name="JobDate[]" />
						<select class="jobvanuelocation" name="JobLocation[]">
							<?php foreach( $jobLocations as $location ) : ?>
								<option value="<?php echo esc_attr( $location->term_id ); ?>"><?php echo esc_html( $location->name ); ?></option>
							<?php endforeach; ?>
						</select>
						<textarea class="fwp-regular-text jobvanuerequirments" placeholder="<?php esc_attr_e( 'Requirments', 'domain' ); ?>" name="JobRequirments[]" cols="55" rows="5"></textarea>
					</td>
					<td><a class="button remove-row" href="#"><?php esc_html_e( 'Remove', 'domain' ); ?></a></td>
				</tr>
			</tbody>
		</table>
		<p><a id="add-row" class="button" href="#"><?php esc_html_e( 'Add another', 'domain' ); ?></a></p>
		<style>
			.job-row {
				display: flex;
				flex-wrap: wrap;
			}
			.jobvanuedate, .jobvanuelocation {
				width: 49%;
				margin: auto;
				margin-bottom: 20px;
			}
			@media screen and (max-width: 600px) {
				.jobvanuedate, .jobvanuelocation {
					width: 100%;
				}
			}
		</style>
		<?php
	}
	public function save_repeater( $post_id ) {
		if( ! isset( $_POST['gpm_repeatable_meta_box_nonce'] ) || ! wp_verify_nonce( $_POST['gpm_repeatable_meta_box_nonce'], 'gpm_repeatable_meta_box_nonce' ) ) {return;}
    if( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) {return;}
    if( ! current_user_can( 'edit_post', $post_id ) ) {return;}

		$old = get_post_meta($post_id, 'fwp_jobs-vanues', true);
    $new = [];
    $JobDate = $_POST['JobDate'];
    $JobLocation = $_POST['JobLocation'];
    $JobRequirments = $_POST['JobRequirments'];
		$count = count( $JobLocation );
		// for( $i = 0; $i < $count; $i++ ) {
		// 	if( $JobLocation[ $i ] != '' ) {
		// 		$new[ $i ]['JobDate'] = stripslashes( strip_tags( $JobDate[ $i ] ) );
		// 		$new[ $i ]['JobLocation'] = stripslashes( strip_tags( $JobLocation[ $i ] ) );
		// 		$new[ $i ]['JobRequirments'] = stripslashes( $JobRequirments[ $i ] ); // and however you want to sanitize
		// 	}
    // }
		foreach( $JobDate as $i => $job ) {
			if( $JobDate[ $i ] != '' ) {
				$new[ $i ]['JobDate'] = stripslashes( strip_tags( $JobDate[ $i ] ) );
				$new[ $i ]['JobLocation'] = stripslashes( strip_tags( $JobLocation[ $i ] ) );
				$new[ $i ]['JobRequirments'] = stripslashes( $JobRequirments[ $i ] ); // and however you want to sanitize
			}
		}
    if( ! empty( $new ) && $new != $old ) {
			update_post_meta( $post_id, 'fwp_jobs-vanues', $new );
    } elseif( empty( $new ) && $old ) {
			delete_post_meta( $post_id, 'fwp_jobs-vanues', $old );
		}

		// print_r( [ $_POST, get_post_meta( $post_id ) ] );wp_die();

	}

	public function admin_enqueue_scripts() {
		global $typenow;$types = [];
    foreach( $this->configs as $i => $config ) {
			foreach( $config['post-type'] as $type ) {
        $types[] = $type;
      }
    }
    $types = array_unique( $types );
		if ( in_array( $typenow, $types ) ) {
			wp_enqueue_media();
			wp_enqueue_script( 'wp-color-picker' );
			wp_enqueue_style( 'wp-color-picker' );
		}
	}
	public function admin_enqueue_styles() {
		// Insert your styles Here
		?>
		<style>
      .meta-box-sortables .fwp-regular-text {width: 100%;max-width: 100%;}
    </style>
		<?php
	}

	public function admin_head() {
		global $typenow;
    foreach( $this->configs as $i => $config ) {
			foreach( $config['post-type'] as $type ) {
        $types[] = $type;
      }
    }
    $types = array_unique( $types );
		if ( in_array( $typenow, $types ) ) {
			?><script>
				jQuery.noConflict();
				(function($) {
					$(function() {
						$('body').on('click', '.rwp-media-toggle', function(e) {
							e.preventDefault();
							let button = $(this);
							let rwpMediaUploader = null;
							rwpMediaUploader = wp.media({
								title: button.data('modal-title'),
								button: {
									text: button.data('modal-button')
								},
								multiple: true
							}).on('select', function() {
								let attachment = rwpMediaUploader.state().get('selection').first().toJSON();
								button.prev().val(attachment[button.data('return')]);
							}).open();
						});
						$('.rwp-color-picker').wpColorPicker();
					});
				})(jQuery);
			</script><?php
			?><?php
		}
	}
  
  public function reedit_author( $data, $postarr, $unsanitized_postarr, $update ) {
    /**
     * Is used to change post author of companies.
     * https://developer.wordpress.org/reference/hooks/wp_insert_post_data/
     */
    if( get_post_type() !== 'companies' || ! isset( $_POST[ 'fwp_company-authorizeid' ] ) || $_POST[ 'fwp_company-authorizeid' ] == 0 ) {
      return $data;
    } else {
      $data[ 'post_author' ] = $_POST[ 'fwp_company-authorizeid' ];
      return $data;
    }
  }
  public function save_post( $post_id ) {

    // wp_die( print_r( $_POST ) );
		
    if( in_array( get_post_type(), [ FUTUREWORDPRESS_PROJECT_CPT_JOB_OPENINGS, 'companies' ] ) ) {
      foreach( $this->configs as $i => $config ) {
        $this->config = $config;
        if( ! in_array( get_post_type(), $config[ 'post-type' ] ) ) {continue;}
        foreach ( $this->config['fields'] as $field ) {
          switch ( $field['type'] ) {
            case 'checkbox':
              update_post_meta( $post_id, $field['id'], isset( $_POST[ $field['id'] ] ) ? $_POST[ $field['id'] ] : '' );
              break;
            case 'editor':
              if ( isset( $_POST[ $field['id'] ] ) ) {
                $sanitized = wp_filter_post_kses( $_POST[ $field['id'] ] );
                update_post_meta( $post_id, $field['id'], $sanitized );
              }
              break;
            case 'email':
              if ( isset( $_POST[ $field['id'] ] ) ) {
                $sanitized = sanitize_email( $_POST[ $field['id'] ] );
                update_post_meta( $post_id, $field['id'], $sanitized );
              }
              break;
            case 'url':
              if ( isset( $_POST[ $field['id'] ] ) ) {
                $sanitized = esc_url_raw( $_POST[ $field['id'] ] );
                update_post_meta( $post_id, $field['id'], $sanitized );
              }
              break;
            default:
              if ( isset( $_POST[ $field['id'] ] ) ) {
                $sanitized = sanitize_text_field( $_POST[ $field['id'] ] );
                update_post_meta( $post_id, $field['id'], $sanitized );
              }
          }
        }
      }
    }
	}

	public function add_meta_box_callback_0() {
		$this->add_meta_box_callback( 0 );
	}
	public function add_meta_box_callback_1() {
		$this->add_meta_box_callback( 1 );
	}
	public function add_meta_box_callback_2() {
		$this->add_meta_box_callback( 2 );
	}
	public function add_meta_box_callback_3() {
		$this->add_meta_box_callback( 3 );
	}
	public function add_meta_box_callback_4() {
		$this->add_meta_box_callback( 4 );
	}
	public function add_meta_box_callback_5() {
		$this->add_meta_box_callback( 5 );
	}
	public function add_meta_box_callback_6() {
		$this->add_meta_box_callback( 6 );
	}
	public function add_meta_box_callback_7() {
		$this->add_meta_box_callback( 7 );
	}
	public function add_meta_box_callback_8() {
		$this->add_meta_box_callback( 8 );
	}
	public function add_meta_box_callback( $i ) {
		$this->config = isset( $this->configs[ $i ] ) ? $this->configs[ $i ] : [];
		echo '<div class="rwp-description">' . $this->config['description'] . '</div>';
		$this->fields_table();
	}

	private function fields_table() {
		?><table class="form-table" role="presentation">
			<tbody><?php
				foreach ( $this->config['fields'] as $field ) {
					?><tr>
						<th scope="row"><?php $this->label( $field ); ?></th>
						<td><?php $this->field( $field ); ?></td>
					</tr><?php
				}
			?></tbody>
		</table><?php
	}

	private function label( $field ) {
		switch ( $field['type'] ) {
			case 'editor':
			case 'radio':
				echo '<div class="">' . $field['label'] . '</div>';
				break;
			case 'media':
				printf(
					'<label class="" for="%s_button">%s</label>',
					$field['id'], $field['label']
				);
				break;
			default:
				printf(
					'<label class="" for="%s">%s</label>',
					$field['id'], $field['label']
				);
		}
	}

	private function field( $field ) {
		switch ( $field['type'] ) {
			case 'checkbox':
				$this->checkbox( $field );
				break;
			case 'date':
			case 'month':
			case 'number':
			case 'range':
			case 'time':
			case 'week':
				$this->input_minmax( $field );
				break;
			case 'editor':
				$this->editor( $field );
				break;
			case 'media':
				$this->input( $field );
				$this->media_button( $field );
				break;
			case 'radio':
				$this->radio( $field );
				break;
			case 'select':
				$this->select( $field );
				break;
			case 'textarea':
				$this->textarea( $field );
				break;
			default:
				$this->input( $field );
		}
	}

	private function checkbox( $field ) {
		printf(
			'<label class="rwp-checkbox-label"><input %s id="%s" name="%s" type="checkbox"> %s</label>',
			$this->checked( $field ),
			$field['id'], $field['id'],
			isset( $field['description'] ) ? $field['description'] : ''
		);
	}

	private function editor( $field ) {
		wp_editor( $this->value( $field ), $field['id'], [
			'wpautop' => isset( $field['wpautop'] ) ? true : false,
			'media_buttons' => isset( $field['media-buttons'] ) ? true : false,
			'textarea_name' => $field['id'],
			'textarea_rows' => isset( $field['rows'] ) ? isset( $field['rows'] ) : 20,
			'teeny' => isset( $field['teeny'] ) ? true : false
		] );
	}

	private function input( $field ) {
		if ( $field['type'] === 'media' ) {
			$field['type'] = 'text';
		}
		if ( isset( $field['color-picker'] ) ) {
			$field['class'] = 'rwp-color-picker';
		}
		printf(
			'<input class="fwp-regular-text %s" id="%s" name="%s" %s type="%s" value="%s" placeholder="%s">',
			isset( $field['class'] ) ? $field['class'] : '',
			$field['id'], $field['id'],
			isset( $field['pattern'] ) ? "pattern='{$field['pattern']}'" : '',
			$field['type'],
			$this->value( $field ),
      isset( $field['placeholder'] ) ? $field['placeholder'] : ''
		);
	}

	private function input_minmax( $field ) {
		printf(
			'<input class="fwp-regular-text" id="%s" %s %s name="%s" %s type="%s" value="%s">',
			$field['id'],
			isset( $field['max'] ) ? "max='{$field['max']}'" : '',
			isset( $field['min'] ) ? "min='{$field['min']}'" : '',
			$field['id'],
			isset( $field['step'] ) ? "step='{$field['step']}'" : '',
			$field['type'],
			$this->value( $field )
		);
	}

	private function media_button( $field ) {
		printf(
			' <button class="button rwp-media-toggle" data-modal-button="%s" data-modal-title="%s" data-return="%s" id="%s_button" name="%s_button" type="button">%s</button>',
			isset( $field['modal-button'] ) ? $field['modal-button'] : __( 'Select this file', 'fwp-ajo' ),
			isset( $field['modal-title'] ) ? $field['modal-title'] : __( 'Choose a file', 'fwp-ajo' ),
			$field['return'],
			$field['id'], $field['id'],
			isset( $field['button-text'] ) ? $field['button-text'] : __( 'Upload', 'fwp-ajo' )
		);
	}

	private function radio( $field ) {
		printf(
			'<fieldset><legend class="screen-reader-text">%s</legend>%s</fieldset>',
			$field['label'],
			$this->radio_options( $field )
		);
	}

	private function radio_checked( $field, $current ) {
		$value = $this->value( $field );
		if ( $value === $current ) {
			return 'checked';
		}
		return '';
	}

	private function radio_options( $field ) {
		$output = [];
		$options = explode( "\r\n", $field['options'] );
		$i = 0;
		foreach ( $options as $option ) {
			$pair = explode( ':', $option );
			$pair = array_map( 'trim', $pair );
			$output[] = sprintf(
				'<label><input %s id="%s-%d" name="%s" type="radio" value="%s"> %s</label>',
				$this->radio_checked( $field, $pair[0] ),
				$field['id'], $i, $field['id'],
				$pair[0], $pair[1]
			);
			$i++;
		}
		return implode( '<br>', $output );
	}

	private function select( $field ) {
		printf(
			'<select id="%s" name="%s" class="%s">%s</select>',
			$field['id'], $field['id'], 'fwp-regular-text',
			$this->select_options( $field )
		);
	}

	private function select_selected( $field, $current ) {
		$value = $this->value( $field );
		if ( $value === $current ) {
			return 'selected';
		}
		return '';
	}

	private function select_options( $field ) {
		$output = [];
		$options = explode( "\r\n", $field['options'] );
		$i = 0;
		foreach ( $options as $option ) {
			$pair = explode( ':', $option );
			$pair = array_map( 'trim', $pair );
			$output[] = sprintf(
				'<option %s value="%s"> %s</option>',
				$this->select_selected( $field, $pair[0] ),
				$pair[0], $pair[1]
			);
			$i++;
		}
		return implode( '<br>', $output );
	}

	private function textarea( $field ) {
		printf(
			'<textarea class="fwp-regular-text" id="%s" name="%s" rows="%d">%s</textarea>',
			$field['id'], $field['id'],
			isset( $field['rows'] ) ? $field['rows'] : 5,
			$this->value( $field )
		);
	}

	private function value( $field ) {
		global $post;
		if ( metadata_exists( 'post', $post->ID, $field['id'] ) ) {
			$value = get_post_meta( $post->ID, $field['id'], true );
		} else if ( isset( $field['default'] ) ) {
			$value = $field['default'];
		} else {
			return '';
		}
		return str_replace( '\u0027', "'", $value );
	}

	private function checked( $field ) {
		global $post;
		if ( metadata_exists( 'post', $post->ID, $field['id'] ) ) {
			$value = get_post_meta( $post->ID, $field['id'], true );
			if ( $value === 'on' ) {
				return 'checked';
			}
			return '';
		} else if ( isset( $field['checked'] ) ) {
			return 'checked';
		}
		return '';
	}
}
