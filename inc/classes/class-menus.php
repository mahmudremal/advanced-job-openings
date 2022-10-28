<?php
/**
 * Register Menus
 *
 * @package Aquila
 */

namespace FUTUREWORDPRESS_PROJECT\Inc;

use FUTUREWORDPRESS_PROJECT\Inc\Traits\Singleton;

class Menus {

	use Singleton;
	private $getIcons = null;

	protected function __construct() {
		// load class.
		$this->setup_hooks();
	}
	protected function setup_hooks() {
		add_filter( 'futurewordpress/project/settings/fields', [ $this, 'menus' ], 10, 1 );
		add_filter( 'futurewordpress/project/icons/svg', [ $this, 'icons' ], 10, 1 );
		add_filter( 'futurewordpress/project/job/single/header', [ $this, 'jobHeader' ], 10, 2 );
		add_filter( 'futurewordpress/project/job/single/social', [ $this, 'jobSocial' ], 10, 2 );
		add_filter( 'futurewordpress/project/company/single/social', [ $this, 'jobSocial' ], 10, 2 );
		
		add_filter( 'futurewordpress/project/job/salary', [ $this, 'jobSalary' ], 10, 1 );
		add_filter( 'futurewordpress/project/job/icons', [ $this, 'jobIcons' ], 10, 2 );
		add_filter( 'futurewordpress/project/job/apply/link', [ $this, 'jobApplyLink' ], 10, 1 );
		add_filter( 'futurewordpress/project/job/icon/favourite', [ $this, 'jobFavIcon' ], 10, 2 );
		add_filter( 'futurewordpress/project/job/save/favourite', [ $this, 'jobFavourite' ], 10, 1 );
		add_filter( 'futurewordpress/project/job/info/postedon', [ $this, 'jobPosted' ], 10, 1 );
		add_filter( 'template_include', [ $this, 'jobTemplate' ], 10, 1 );
	}
	public function menus( $args ) {
    // get_fwp_option( 'key', 'default' )
		// is_FwpActive( 'key' )
		$args = [];
		$args['standard'] = [
			'title'					=> __( 'General', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
			'description'			=> __( 'Generel fields comst commonly used to changed.', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
			'fields'				=> [
				// [
				// 	'id' 			=> 'currencies',
				// 	'label'			=> __( 'Currencies', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
				// 	'description'	=> sprintf( __( 'Select some allowed currency here. You can also add your additional currency using \'%s\' filter hook.', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ), wp_kses_post( '<b>futurewordpress/project/job/currencies</b>' ) ),
				// 	'type'			=> 'select_multi',
				// 	'options'		=> [ 'linux' => 'Linux', 'mac' => 'Mac', 'windows' => 'Windows' ], // apply_filters( 'futurewordpress/project/job/currencies', [] ),
				// 	'default'		=> [ 'USD' ]
				// ],
				[
					'id' 			=> 'job_autoapproved',
					'label'			=> __( 'Job Auto Approve', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
					'description'	=> __( 'If you enable this, then jobs that will publish from frontend dashboard, will be autometically approved to publish, and you no longer need to approve manually.', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
					'type'			=> 'checkbox',
					'default'		=> true
				],
				[
					'id' 			=> 'job_editpending',
					'label'			=> __( 'On Edit Auto Pending', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
					'description'	=> __( 'Jobs will be autometically goes on pending on edit. If you do decheck it, then it will set job status same as what they were.', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
					'type'			=> 'checkbox',
					'default'		=> true
				],
				[
					'id' 			=> 'job_description',
					'label'			=> __( 'Job Description', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
					'description'	=> __( 'Make Job Description enabled to enable this fields on JOB', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
					'type'			=> 'checkbox',
					'default'		=> true
				],
				[
					'id' 			=> 'responsibilities_include',
					'label'			=> __( 'Responsibilities Include', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
					'description'	=> __( 'Make Responsibilities Include enabled to enable this fields on JOB', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
					'type'			=> 'checkbox',
					'default'		=> true
				],
				[
					'id' 			=> 'skills_experience',
					'label'			=> __( 'Responsibilities Include', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
					'description'	=> __( 'Make Responsibilities Include enabled to enable this fields on JOB', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
					'type'			=> 'checkbox',
					'default'		=> true
				],
				[
					'id' 			=> 'requirments',
					'label'			=> __( 'Requirments', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
					'description'	=> __( 'Make requirments enabled to enable this fields on JOB', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
					'type'			=> 'checkbox',
					'default'		=> true
				],
				[
					'id' 			=> 'offering',
					'label'			=> __( 'Offering', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
					'description'	=> __( 'Make offering enabled to enable this fields on JOB', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
					'type'			=> 'checkbox',
					'default'		=> true
				],
				[
					'id' 			=> 'offered_salary',
					'label'			=> __( 'Offerd Salary', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
					'description'	=> __( 'Make Offerd Salary enabled to enable this fields on JOB', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
					'type'			=> 'checkbox',
					'default'		=> true
				],
				[
					'id' 			=> 'job_social_share_title',
					'label'			=> __( 'Social template' , FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
					'description'	=> __( 'Job social share title template commonly used {post_title}, {post_excerpt} and another custom text.', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
					'type'			=> 'text',
					'default'		=> 'Job Description',
					'placeholder'	=> __( 'Job Description field title here', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN )
				],
				[
					'id' 			=> 'job_internal_id_default',
					'label'			=> __( 'Job Internal ID default', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
					'description'	=> __( 'Enable autometic generation of JOB internal ID. This\'ll replace a default value on JOB internal ID field. ID could be created with a prefix and current time in Microsecond.', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
					'type'			=> 'checkbox',
					'default'		=> true
				],
				[
					'id' 			=> 'job_interna_id_prefix',
					'label'			=> __( 'Internal ID Prefix' , FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
					'description'	=> __( 'Prefix of the JOB internal ID. E.G: \'job-\'.', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
					'type'			=> 'text',
					'default'		=> 'job',
					'placeholder'	=> __( 'Job Inernal ID prefix', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN )
				],
			]
		];
		$args['text'] = [
			'title'					=> __( 'Text', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
			'description'			=> __( 'Modify links and Buttons Text from here.', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
			'fields'				=> [
				[
					'id' 			=> 'job_description_txt',
					'label'			=> __( 'Job Description' , FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
					'description'	=> __( 'Title that should be replace with frontend single page Job description title.', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
					'type'			=> 'text',
					'default'		=> 'Job Description',
					'placeholder'	=> __( 'Job Description field title here', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN )
				],
				[
					'id' 			=> 'responsibilities_include_txt',
					'label'			=> __( 'Responsibilities Include' , FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
					'description'	=> __( 'Title that should be replace with frontend single page Responsibilities Include title.', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
					'type'			=> 'text',
					'default'		=> 'Responsibilities Include',
					'placeholder'	=> __( 'Responsibilities Include field title here', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN )
				],
				[
					'id' 			=> 'skills_experience_txt',
					'label'			=> __( 'Background, Skills & Experience' , FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
					'description'	=> __( 'Title that should be replace with frontend single page Background, Skills & Experience title.', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
					'type'			=> 'text',
					'default'		=> 'Background, Skills & Experience',
					'placeholder'	=> __( 'Background, Skills & Experience field title here', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN )
				],
				[
					'id' 			=> 'requirments_txt',
					'label'			=> __( 'Job Requirments' , FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
					'description'	=> __( 'Title that should be replace with frontend single page Job Requirments title.', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
					'type'			=> 'text',
					'default'		=> 'Job Requirments',
					'placeholder'	=> __( 'Job Requirments field title here', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN )
				],
				[
					'id' 			=> 'offering_txt',
					'label'			=> __( 'Job Offering' , FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
					'description'	=> __( 'Title that should be replace with frontend single page Job Offering title.', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
					'type'			=> 'text',
					'default'		=> 'Job Offering',
					'placeholder'	=> __( 'Job Offering field title here', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN )
				],


				[
					'id' 			=> 'apply_now_txt',
					'label'			=> __( 'Apply Now' , FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
					'description'	=> __( 'Apply Now button title globally. Are under translation.', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
					'type'			=> 'text',
					'default'		=> 'Apply Now',
					'placeholder'	=> __( 'Apply Now button title ', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN )
				],
				[
					'id' 			=> 'shortlist_txt',
					'label'			=> __( 'Shortlist' , FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
					'description'	=> __( 'Shortlist button title globally. Are under translation.', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
					'type'			=> 'text',
					'default'		=> 'Shortlist',
					'placeholder'	=> __( 'Shortlist button title', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN )
				],
				[
					'id' 			=> 'view_all_jobs_txt',
					'label'			=> __( 'View all jobs' , FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
					'description'	=> __( 'View all jobs button title globally. Are under translation.', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
					'type'			=> 'text',
					'default'		=> 'View all jobs',
					'placeholder'	=> __( 'View all jobs title', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN )
				],
				[
					'id' 			=> 'get_job_alerts_txt',
					'label'			=> __( 'Get Job Alerts' , FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
					'description'	=> __( 'Get Job Alerts title globally. Are under translation.', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
					'type'			=> 'text',
					'default'		=> 'Get Job Alerts',
					'placeholder'	=> __( 'Get Job Alerts button title.', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN )
				],
				[
					'id' 			=> 'job_location_txt',
					'label'			=> __( 'Job Location' , FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
					'description'	=> __( 'Job Location / Vanue. Are under translation.', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
					'type'			=> 'text',
					'default'		=> 'Get Job Alerts',
					'placeholder'	=> __( 'Get Job Alerts button title.', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN )
				],
				[
					'id' 			=> 'share_this_job_txt',
					'label'			=> __( 'Share This Job' , FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
					'description'	=> __( 'Share This Job text. Are under translation.', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
					'type'			=> 'text',
					'default'		=> 'Share This Job',
					'placeholder'	=> __( 'Share This Job Text title.', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN )
				],
				[
					'id' 			=> 'share_this_company_txt',
					'label'			=> __( 'Share This Company' , FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
					'description'	=> __( 'Share This Company text. Are under translation.', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
					'type'			=> 'text',
					'default'		=> 'Share This Job',
					'placeholder'	=> __( 'Share This Job Text title.', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN )
				],
				[
					'id' 			=> 'position_information_txt',
					'label'			=> __( 'Position Information' , FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
					'description'	=> __( 'Position Information text. Are under translation.', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
					'type'			=> 'text',
					'default'		=> 'Position Information',
					'placeholder'	=> __( 'Position Information Text title.', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN )
				],
				[
					'id' 			=> 'offered_salary_txt',
					'label'			=> __( 'Offerd Salary' , FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
					'description'	=> __( 'Offerd Salary text. Are under translation.', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
					'type'			=> 'text',
					'default'		=> 'Offerd Salary',
					'placeholder'	=> __( 'Offerd Salary Text title.', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN )
				],
				[
					'id' 			=> 'people_viewed_txt',
					'label'			=> __( 'People Also Viewed' , FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
					'description'	=> __( 'People Also Viewed text. Are under translation.', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
					'type'			=> 'text',
					'default'		=> 'People Also Viewed',
					'placeholder'	=> __( 'People Also Viewed Text title.', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN )
				],
				[
					'id' 			=> 'leatest_applications_txt',
					'label'			=> __( 'Latest Applications' , FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
					'description'	=> __( 'Latest Applications text on dashboard. Are under translation.', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
					'type'			=> 'text',
					'default'		=> 'Latest Applications',
					'placeholder'	=> __( 'Latest Applications Text title.', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN )
				],
				[
					'id' 			=> 'company_about_txt',
					'label'			=> __( 'About Company' , FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
					'description'	=> __( 'Title that should be replace with frontend single page About Company title.', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
					'type'			=> 'text',
					'default'		=> 'Job Description',
					'placeholder'	=> __( 'Job Description field title here', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN )
				],
				[
					'id' 			=> 'company_open_position_txt',
					'label'			=> __( 'Open Position' , FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
					'description'	=> __( 'Single company pages position available field title.', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
					'type'			=> 'text',
					'default'		=> 'Open Position',
					'placeholder'	=> __( 'Open Position field title here', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN )
				],
				[
					'id' 			=> 'candidate_cv_delete_confirm_txt',
					'label'			=> __( 'Cv delete Confirmation' , FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
					'description'	=> __( 'Text on CV delete confirmation will be replace with it.', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
					'type'			=> 'text',
					'default'		=> 'Confirm delete?',
					'placeholder'	=> __( 'Are you sure to delete? Can\'t be undo.', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN )
				],
				[
					'id' 			=> 'msg_apply_added_txt',
					'label'			=> __( 'Application Added' , FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
					'description'	=> __( 'Text on Apply successful message for candidate.', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
					'type'			=> 'text',
					'placeholder'	=> __( 'Application has been created sucessfully.', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN )
				],
				[
					'id' 			=> 'msg_apply_updated_txt',
					'label'			=> __( 'Application Updated' , FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
					'description'	=> __( 'Text on Application updated sucessfully.', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
					'type'			=> 'text',
					'placeholder'	=> __( 'Application has been Updated.', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN )
				],
				[
					'id' 			=> 'candidate_apply_delete_confirm_txt',
					'label'			=> __( 'Confirmation delete Application' , FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
					'description'	=> __( 'Text on Application delete confirmation will be replace with it.', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
					'type'			=> 'text',
					'default'		=> 'Confirm delete?',
					'placeholder'	=> __( 'Are you sure to delete? Can\'t be undo.', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN )
				],
			]
		];
		$args['single'] = [
			'title'					=> __( 'Single', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
			'description'			=> __( 'Setup your single Job page here.', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
			'fields'				=> [
				[
					'id' 			=> 'header',
					'label'			=> __( 'Enable Job header', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
					'description'	=> sprintf( __( 'Enable job header to display job Header on single page that will be on our default layout. Also can be redesign using \'%s\' filter hook.', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ), wp_kses_post( '<b>futurewordpress/project/job/single/header</b>' ) ),
					'type'			=> 'checkbox',
					'default'		=> true
				],
				[
					'id' 			=> 'shortist',
					'label'			=> __( 'Enable Short List', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
					'description'	=> __( 'Enable Short List button to display on single product page.', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
					'type'			=> 'checkbox',
					'default'		=> true
				],
				[
					'id' 			=> 'sidebar',
					'label'			=> __( 'Enable Sidebar', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
					'description'	=> __( 'Enable sidebar to display JOB information like salary, Gender, Career level and like this kind of meta info.', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
					'type'			=> 'checkbox',
					'default'		=> true
				],
				[
					'id' 			=> 'sallery',
					'label'			=> __( 'Display Sallery', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
					'description'	=> __( 'Enable to display sellery on single JOB page.', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
					'type'			=> 'checkbox',
					'default'		=> true
				],
				[
					'id' 			=> 'gender',
					'label'			=> __( 'Display Gender', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
					'description'	=> __( 'Enable to display Gender on single JOB page.', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
					'type'			=> 'checkbox',
					'default'		=> true
				],
				[
					'id' 			=> 'career',
					'label'			=> __( 'Display Career level', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
					'description'	=> __( 'Enable to display Career level on single JOB page.', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
					'type'			=> 'checkbox',
					'default'		=> true
				],
				[
					'id' 			=> 'Industry',
					'label'			=> __( 'Display Industry', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
					'description'	=> __( 'Enable to display Industry level on single page.', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
					'type'			=> 'checkbox',
					'default'		=> true
				],
				[
					'id' 			=> 'experience',
					'label'			=> __( 'Display Experience', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
					'description'	=> __( 'Enable to display experience requirments in years.', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
					'type'			=> 'checkbox',
					'default'		=> true
				],
				[
					'id' 			=> 'qualification',
					'label'			=> __( 'Display Dualification', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
					'description'	=> __( 'Enable to display single qualification in one line.', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
					'type'			=> 'checkbox',
					'default'		=> true
				],

				[
					'id' 			=> 'time_ago',
					'label'			=> __( 'Posted since', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
					'description'	=> __( 'Enable to display how many days apassed since it is posted.', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
					'type'			=> 'checkbox',
					'default'		=> true
				],
				[
					'id' 			=> 'viewed',
					'label'			=> __( 'Total Seen', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
					'description'	=> __( 'Enable to Show how many times is this job viwed by visitors.', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
					'type'			=> 'checkbox',
					'default'		=> true
				],
				[
					'id' 			=> 'applied',
					'label'			=> __( 'Total Applied', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
					'description'	=> __( 'Enable to Show how many people applied for this job.', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
					'type'			=> 'checkbox',
					'default'		=> true
				],
				[
					'id' 			=> 'social',
					'label'			=> __( 'Social share', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
					'description'	=> sprintf( __( 'Enable Social share links. This will display \'Facebook, Twitter, Instagram, Email\' by default. Can be customized using \'%s\' filter hook.', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ), wp_kses_post( '<b>futurewordpress/project/job/single/social</b>' ) ),
					'type'			=> 'checkbox',
					'default'		=> true
				],
				[
					'id' 			=> 'suggest',
					'label'			=> __( 'Job Suggestion', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
					'description'	=> __( 'Enable job suggestion.', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
					'type'			=> 'checkbox',
					'default'		=> true
				],
				// [
				// 	'id' 			=> 'job_alerts',
				// 	'label'			=> __( 'Job Alert', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
				// 	'description'	=> __( 'Job alert will display a button with popup to recieve meail address of a visitor and he will recieve automettic email when any job will publish.', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
				// 	'type'			=> 'checkbox',
				// 	'default'		=> 'on'
				// ],
			]
		];
		$args['joblist'] = [
			'title'					=> __( 'Job List', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
			'description'			=> __( 'Setup  Job list things here.', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
			'fields'				=> [
				[
					'id' 			=> 'joblist-filters',
					'label'			=> __( 'Enable Job Filter', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
					'description'	=> sprintf( __( 'Enable job filters on Job list and Archive pages. Also can be redesign using \'%s\' filter hook.', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ), wp_kses_post( '<b>futurewordpress/project/job/list/filters</b>' ) ),
					'type'			=> 'checkbox',
					'default'		=> true
				],
			]
		];
		$args['company'] = [
			'title'					=> __( 'Company', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
			'description'			=> __( 'Setup company lists, single page and global things here.', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
			'fields'				=> [
				[
					'id' 			=> 'company-header',
					'label'			=> __( 'Company header', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
					'description'	=> __( 'Enable Company header on single company page.', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
					'type'			=> 'checkbox',
					'default'		=> true
				],
				[
					'id' 			=> 'company-contactmail',
					'label'			=> __( 'Direct Mail', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
					'description'	=> __( 'Allow visitor to mail directly from your site. Mail will sent from admin email and reply email will be set as Company email address.', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
					'type'			=> 'checkbox',
					'default'		=> true
				],
				[
					'id' 			=> 'company-sidebar',
					'label'			=> __( 'Company Information', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
					'description'	=> __( 'Enable company sidebar information field for company single profile.', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
					'type'			=> 'checkbox',
					'default'		=> true
				],
				[
					'id' 			=> 'company-social-share',
					'label'			=> __( 'Company Social Share', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
					'description'	=> __( 'Enable social share widget on company single.', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
					'type'			=> 'checkbox',
					'default'		=> true
				],
				[
					'id' 			=> 'company-openposition',
					'label'			=> __( 'Opened Positions', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
					'description'	=> __( 'Enable to view company open postion / job after company about. It\'ll call a shortcode "[company-open_position company=\'company id\'"]" for this company.', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
					'type'			=> 'checkbox',
					'default'		=> true
				],
				[
					'id' 			=> 'company-single-map',
					'label'			=> __( 'Company Location Map', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
					'description'	=> __( 'Enable company location map on single profile.', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
					'type'			=> 'checkbox',
					'default'		=> true
				],
				[
					'id' 			=> 'company-viewed',
					'label'			=> __( 'Company Visitor count', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
					'description'	=> __( 'Enable Company visitor counting function on frontend. Each time visitor visit a company singl profile will increase one on visitor visited and if you disable this, will also deactivate dashboard statics.', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
					'type'			=> 'checkbox',
					'default'		=> true
				],
				[
					'id' 			=> 'company-address',
					'label'			=> __( 'Company location', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
					'description'	=> __( 'Enable Company location on frontend. Disabling this field will hide company location on everywhere possible.', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
					'type'			=> 'checkbox',
					'default'		=> true
				],
				[
					'id' 			=> 'company-category',
					'label'			=> __( 'Company category', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
					'description'	=> __( 'Enable Company category on frontend. Disabling this field will hide company category and category filteritems might be disapear.', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
					'type'			=> 'checkbox',
					'default'		=> true
				],
				[
					'id' 			=> 'company-since',
					'label'			=> __( 'Company Extablished Year', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
					'description'	=> __( 'Enable to public company established year for visitor.', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
					'type'			=> 'checkbox',
					'default'		=> true
				],
				[
					'id' 			=> 'company-teamsize',
					'label'			=> __( 'Company Team Size', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
					'description'	=> __( 'Enable to public company team size fro frontend. Only visible on compay single profile and company archive.', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
					'type'			=> 'checkbox',
					'default'		=> true
				],
				// [
				// 	'id' 			=> 'company-followers',
				// 	'label'			=> __( 'Company Following', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
				// 	'description'	=> __( 'Enable Company followers function if it is exists.', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
				// 	'type'			=> 'checkbox',
				// 	'default'		=> true
				// ],
			]
		];
		$args['message'] = [
			'title'					=> __( 'Message', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
			'description'			=> __( 'Messages on any event can be change from here.', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
			'fields'				=> [
				[
					'id' 			=> 'msg_profile_edit_success_txt',
					'label'			=> __( 'Profile edit success' , FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
					'description'	=> __( 'Message that should make sure profile edit succecced.', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
					'type'			=> 'text',
					'placeholder'	=> __( 'Profile edited successfully', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN )
				],
				[
					'id' 			=> 'msg_job_create_success_txt',
					'label'			=> __( 'Successfully created Job.' , FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
					'description'	=> __( 'Message on Successfully created Job.', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
					'type'			=> 'text',
					'placeholder'	=> __( 'Successfully created Job', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN )
				],
				[
					'id' 			=> 'msg_job_update_success_txt',
					'label'			=> __( 'Successfully Updated Job.' , FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
					'description'	=> __( 'Message on Successfully Updated Job.', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
					'type'			=> 'text',
					'placeholder'	=> __( 'Successfully Updated Job', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN )
				],
				[
					'id' 			=> 'msg_job_autoapproved_txt',
					'label'			=> __( 'Job autometically approved.' , FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
					'description'	=> __( 'Message on Job autometically approved.', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
					'type'			=> 'text',
					'placeholder'	=> __( 'Is autometically approved', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN )
				],
				[
					'id' 			=> 'msg_job_waitapproved_txt',
					'label'			=> __( 'Job waiting to approve.' , FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
					'description'	=> __( 'Message on Job pending for approval.', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
					'type'			=> 'text',
					'placeholder'	=> __( 'Is pending for approval', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN )
				],
			]
		];
		$args['dashboard'] = [
			'title'					=> __( 'Dashboard', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
			'description'			=> __( 'Setup Dashboard things here.', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
			'fields'				=> [
				[
					'id' 			=> 'dashboard_usercard',
					'label'			=> __( 'User profile card', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
					'description'	=> __( 'Enable user profile card on dashboard sidebar.', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
					'type'			=> 'checkbox',
					'default'		=> true
				],
				[
					'id' 			=> 'dashboard_totals',
					'label'			=> __( 'Calculation Card', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
					'description'	=> __( 'Enable calculation card on dashboard home.', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
					'type'			=> 'checkbox',
					'default'		=> true
				],
				// [
				// 	'id' 			=> 'dashboard_statics',
				// 	'label'			=> __( 'Statics', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
				// 	'description'	=> __( 'Enable Statics on dashboard home.', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
				// 	'type'			=> 'checkbox',
				// 	'default'		=> true
				// ],
				// [
				// 	'id' 			=> 'dashboard_traffic',
				// 	'label'			=> __( 'Traffic', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
				// 	'description'	=> __( 'Enable Traffic on dashboard home.', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
				// 	'type'			=> 'checkbox',
				// 	'default'		=> true
				// ],
				[
					'id' 			=> 'dashboard_leatest_applications',
					'label'			=> __( 'Latest Applications', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
					'description'	=> __( 'Enable Latest Applications on dashboard home.', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
					'type'			=> 'checkbox',
					'default'		=> true
				],
			]
		];
		$args['critical'] = [
			'title'					=> __( 'Critical', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
			'description'			=> __( 'Setup Critical settings that should not changed more then one time.', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
			'fields'				=> [
				[
					'id' 			=> 'reedit_author',
					'label'			=> __( 'ReEdit company', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
					'description'	=> __( 'Enable to ReEdit company on those are created from wp-admin dashboard. If you enabled this, that means those company created on wp-admin will directly authorized credential will goes that company owner account. Otherwise it\'s credential remains with administrative. I meant you.', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
					'type'			=> 'checkbox',
					'default'		=> true
				],
			]
		];
		return $args;
	}
	public function icons( $args ) {
		$svgs = [];
		return isset( $svgs[ $args[ 'icon' ] ] ) ? $svgs[ $args[ 'icon' ] ] : false;
	}
	public function jobHeader( $html, $args ) {
		if( ! isset( FUTUREWORDPRESS_PROJECT_OPTIONS[ 'header' ] ) || FUTUREWORDPRESS_PROJECT_OPTIONS[ 'header' ] != 'on' ) {return;}
		$args = wp_parse_args( $args, [
			'post' => [],
			'meta' => [
				'company' => [],
				'jobs' => []
			],
			'terms' => []
		] );
		ob_start();
		?>
		<!-- Candidate Personal Info-->
		<section class="bgc-fa pt80 mt80 mbt45">
			<div class="container">
				<div class="row">
					<div class="col-lg-8 col-xl-9">
						<div class="candidate_personal_info style2">
							<div class="thumb text-center">
								<img class="img-fluid rounded" src="<?php echo esc_url( (
									isset( $args[ 'meta' ][ 'company' ][ 'logo' ] ) && ! empty( $args[ 'meta' ][ 'company' ][ 'logo' ] ) ? $args[ 'meta' ][ 'company' ][ 'logo' ] : 'logo placeholder'
								) ); ?>" alt="<?php esc_attr_e( 'Logo', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ); ?>"><br><br>
								<a class="mt25" href="<?php echo esc_url( site_url( FUTUREWORDPRESS_PROJECT_CPT_JOB_OPENINGS ) ); ?>">
									<!-- <span class="flaticon-right-arrow pl10"></span> --> <?php esc_html_e( FUTUREWORDPRESS_PROJECT_OPTIONS[ 'view_all_jobs_txt' ], FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ); ?> <?php echo apply_filters( 'futurewordpress/project/job/icons', 'right-arrow', true ); ?>
								</a>
							</div>
							<div class="details">
								<small class="text-thm2"><?php echo esc_html( implode( ' | ', $args[ 'terms' ] ) ); ?></small>
								<h3><?php echo esc_html( $args[ 'post' ]->post_title ); ?></h3>
								<p><?php echo wp_kses_post( apply_filters( 'futurewordpress/project/job/info/postedon', $args ) ); ?></p>
								<ul class="address_list">
									<li class="list-inline-item">
										<a href="<?php echo esc_url( ( isset( $args[ 'meta' ][ 'jobs' ][ 'url' ] ) && ! empty( $args[ 'meta' ][ 'jobs' ][ 'url' ] ) ? $args[ 'meta' ][ 'jobs' ][ 'url' ] : '#' ) ); ?>">
										<!-- <span class="fa fa-map-marker -alts"></span> -->
										<img src="<?php echo esc_url( apply_filters( 'futurewordpress/project/job/icons', 'location-pin' ) ); ?>" alt=""> <?php echo esc_html( ( isset( $args[ 'meta' ][ 'jobs' ][ 'location' ] ) && ! empty( $args[ 'meta' ][ 'jobs' ][ 'location' ] ) ? $args[ 'meta' ][ 'jobs' ][ 'location' ] : ( isset( $args[ 'meta' ][ 'company' ][ 'location' ] ) ? $args[ 'meta' ][ 'company' ][ 'location' ] : '' ) ) ); ?>
										</a>
									</li>
									<?php if( isset( FUTUREWORDPRESS_PROJECT_OPTIONS[ 'offered_salary' ] ) && FUTUREWORDPRESS_PROJECT_OPTIONS[ 'offered_salary' ] == 'on' ) : ?>
										<li class="list-inline-item">
											<span>
												<!-- <i class="fa fa-money"></i> -->
												<img src="<?php echo esc_url( apply_filters( 'futurewordpress/project/job/icons', 'money-cash' ) ); ?>" alt=""> <?php echo esc_html( apply_filters( 'futurewordpress/project/job/salary', $args[ 'meta' ][ 'jobs' ] ) ); ?>
											</span>
										</li>
									<?php endif; ?>
								</ul>
							</div>
						</div>
					</div>
					<div class="col-lg-4 col-xl-3">
						<div class="candidate_personal_overview style2">
									<a class="btn btn-block btn-thm mb15" href="<?php echo esc_url( apply_filters( 'futurewordpress/project/job/apply/link', $args ) ); ?>">
										<?php esc_html_e( FUTUREWORDPRESS_PROJECT_OPTIONS[ 'apply_now_txt' ], FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ); ?> <?php echo apply_filters( 'futurewordpress/project/job/icons', 'right-arrow', true ); ?>
										<!-- <span class="flaticon-right-arrow pl10"></span> -->
									</a>
									<?php if( isset( FUTUREWORDPRESS_PROJECT_OPTIONS[ 'shortist' ] ) && FUTUREWORDPRESS_PROJECT_OPTIONS[ 'shortist' ] == 'on' ) : ?>
									<a class="btn btn-block btn-gray" href="<?php echo esc_url( apply_filters( 'futurewordpress/project/job/save/favourite', $args ) ); ?>">
										<!-- <span class="flaticon-favorites "></span> -->
										<?php echo apply_filters( 'futurewordpress/project/job/icon/favourite', $args, true ); ?> <?php esc_html_e( FUTUREWORDPRESS_PROJECT_OPTIONS[ 'shortlist_txt' ], FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ); ?></a>
									<?php endif; ?>
						</div>
					</div>
				</div>
			</div>
		</section>
		<?php
		return ob_get_clean();
	}
	public function jobSocial( $html, $args ) {
		$text = urlencode( str_replace( [
			'{post_title}',
			'{post_excerpt}'
		], [
			get_the_title(),
			get_the_excerpt()
		], get_fwp_option( 'job_social_share_title', '{post_title}' ) ) );
		$args = [
			'facebook' => 'https://www.facebook.com/sharer/sharer.php?u=' . urlencode( get_the_permalink() ) . '',
			'twitter' => 'https://twitter.com/intent/tweet?url=' . urlencode( get_the_permalink() ) . '&text=' . $text,
			'pinterest' => 'https://pinterest.com/pin/create/button/?url=' . urlencode( get_the_permalink() ) . '&media=&description=' . $text,
			'linkedin' => 'https://www.linkedin.com/shareArticle?mini=true&url=' . urlencode( get_the_permalink() ) . '',
			'envelope' => 'mailto:?&subject=&cc=&bcc=&body=' . urlencode( get_the_permalink() ) . '%0A' . $text,
		];
		return $args;
	}
	public function jobTemplate( $template ) {
		if( FUTUREWORDPRESS_PROJECT_CPT_JOB_OPENINGS === get_post_type() ) {
			if( is_single( ) ) {
				$file = FUTUREWORDPRESS_PROJECT_DIR_PATH . '/template-parts/jobs/single.php';
				if( file_exists( $file ) && ! is_dir( $file ) ) {
					return $file;
				} else {
					return $template;
				}
			} elseif( is_archive() ) {
				$file = FUTUREWORDPRESS_PROJECT_DIR_PATH . '/template-parts/jobs/archive.php';
				if( file_exists( $file ) && ! is_dir( $file ) ) {
					return $file;
				} else {
					return $template;
				}
			} else {
				return $template;
			}
		} elseif( 'companies' === get_post_type() ) {
			if( is_single( ) ) {
				$file = FUTUREWORDPRESS_PROJECT_DIR_PATH . '/template-parts/company/single.php';
				if( file_exists( $file ) && ! is_dir( $file ) ) {
					return $file;
				} else {
					return $template;
				}
			} elseif( is_archive() ) {
				$file = FUTUREWORDPRESS_PROJECT_DIR_PATH . '/template-parts/company/archive.php';
				if( file_exists( $file ) && ! is_dir( $file ) ) {
					return $file;
				} else {
					return $template;
				}
			} else {
				return $template;
			}
		} else {
			return $template;
		}
	}
	public function jobSalary( $jobs ) {
		$html = $this->miniNumber( $jobs[ 'salary' ] );
		$html .= ( ! empty( $jobs[ 'salaryto' ] ) ) ? ' - ' . $this->miniNumber( $jobs[ 'salaryto' ] ) : '';
		return $html;
	}
	public function jobIcons( $icon, $load = false ) {
		if( $this->getIcons === null ) {
			$icons = scandir( FUTUREWORDPRESS_PROJECT_DIR_PATH . '/assets/src/icons', true );$getIcons = [];
			foreach( $icons as $i => $ic ) {
				if( ! in_array( $ic, [ '.', '..' ] ) ) {
					$this->getIcons[ pathinfo( $ic, PATHINFO_FILENAME ) ] = $ic;
				}
			}
		}
		return isset( $this->getIcons[ $icon ] ) ? ( 
			( $load ) ? file_get_contents( FUTUREWORDPRESS_PROJECT_DIR_PATH . '/assets/src/icons/' . $this->getIcons[ $icon ] ) : FUTUREWORDPRESS_PROJECT_DIR_URI . '/assets/src/icons/' . $this->getIcons[ $icon ]
			) : false;
	}
	public function miniNumber( $num ) {
		if( $num >= 1000 ) {
			return ( $num / 1000 ) . "k";
	 } else {
			return $num;
	 }
	}
	public function jobApplyLink( $args ) {
		return site_url(  'apply/application/' . $args[ 'post' ]->ID . '/'  );
	}
	public function jobFavourite( $args ) {
		return site_url( 'apply/favourite/' . $args[ 'post' ]->ID . '/' );
	}
	public function jobPosted( $args ) {
		return sprintf( __( 'Posted %s by %s', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ), date( 'd F', strtotime( $args[ 'post' ]->post_date ) ), wp_kses_post( '<a href="' . esc_url( ( isset( $args[ 'meta' ][ 'company' ][ 'url' ] ) && ! empty( $args[ 'meta' ][ 'company' ][ 'url' ] ) ? $args[ 'meta' ][ 'company' ][ 'url' ] : 'javascript:void(0);' ) ) . '" class="text-thm' . ( is_single() ? '2' : '' ) . '">' . ( isset( $args[ 'meta' ][ 'company' ][ 'name' ] ) && ! empty( $args[ 'meta' ][ 'company' ][ 'name' ] ) ? $args[ 'meta' ][ 'company' ][ 'name' ] : __( 'Invisible company', 'domain' ) ) . '</a>' ) );
	}
	public function jobFavIcon( $args, $is_read = false ) {
		if( apply_filters( 'futurewordpress/project/job/is/favourite', $args[ 'post' ]->ID ) ) {
			return '<span class="fa fa-star" style="line-height: 47.5px;"></span>';
			return $this->jobIcons( 'star-fill', $is_read );
		} else {
			return '<span class="flaticon-favorites"></span>';
			return $this->jobIcons( 'star-o', $is_read );
		}
	}

}
