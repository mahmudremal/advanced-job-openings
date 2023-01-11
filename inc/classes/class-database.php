<?php
/**
 * Bootstraps the Theme.
 *
 * @package Aquila
 */

namespace FUTUREWORDPRESS_PROJECT\Inc;

use FUTUREWORDPRESS_PROJECT\Inc\Traits\Singleton;

class Database {
	use Singleton;

	protected function __construct() {
		$this->setup_hooks();
	}

	protected function setup_hooks() {
    add_filter( 'futurewordpress/project/job/toggle/favourite', [ $this, 'toggleFavourite' ], 10, 1 );
    add_filter( 'futurewordpress/project/job/is/favourite', [ $this, 'isFavourite' ], 10, 1 );
    add_filter( 'futurewordpress/project/job/get/favourite', [ $this, 'getFavourite' ], 10, 1 );

    add_filter( 'futurewordpress/project/job/is/applied', [ $this, 'isApplied' ], 10, 1 );
    add_filter( 'futurewordpress/project/job/on/apply', [ $this, 'onApply' ], 10, 1 );

    add_filter( 'futurewordpress/project/job/cv/get', [ $this, 'cvGet' ], 10, 1 );
    add_filter( 'futurewordpress/project/job/cv/edit', [ $this, 'cvEdit' ], 10, 1 );
    add_filter( 'futurewordpress/project/job/cv/add', [ $this, 'cvAdd' ], 10, 1 );
    add_filter( 'futurewordpress/project/job/cv/delete', [ $this, 'cvDelete' ], 10, 1 );

    add_filter( 'futurewordpress/project/job/apply/get', [ $this, 'applicationGet' ], 10, 1 );
    add_filter( 'futurewordpress/project/job/apply/total', [ $this, 'applicationCount' ], 10, 1 );
    add_filter( 'futurewordpress/project/job/apply/range', [ $this, 'appliedRange' ], 10, 1 );
    add_filter( 'futurewordpress/project/job/apply/add', [ $this, 'applicationAdd' ], 10, 1 );
    add_filter( 'futurewordpress/project/job/apply/edit', [ $this, 'applicationEdit' ], 10, 1 );
    add_filter( 'futurewordpress/project/job/apply/delete', [ $this, 'applicationDelete' ], 10, 1 );
    add_filter( 'futurewordpress/project/job/apply/approve', [ $this, 'applicationApprove' ], 10, 1 );

    add_filter( 'futurewordpress/project/job/apply/paid', [ $this, 'applicationPaid' ], 10, 1 );

    add_filter( 'futurewordpress/project/job/invoice/get', [ $this, 'invoiceGet' ], 10, 1 );

    add_filter( 'futurewordpress/project/job/apply/company', [ $this, 'applyCompanyGet' ], 10, 1 );
    add_filter( 'futurewordpress/project/job/company/activity', [ $this, 'companyActivity' ], 10, 1 );
    add_filter( 'futurewordpress/project/job/candidate/activity', [ $this, 'candidateActivity' ], 10, 1 );
	}
  public function toggleFavourite( $post_id ) {
    if( $this->isFavourite( $post_id ) ) {
      return $this->deFavourite( $post_id );
    } else {
      return $this->enFavourite( $post_id );
    }
  }
  public function isFavourite( $post_id ) {
    global $wpdb;
    $isFavourite = $wpdb->get_var(
      $wpdb->prepare(
         "SELECT COUNT(*) FROM {$wpdb->prefix}fwp_job_favourite WHERE post_id = %d AND user_id = %d;",
         $post_id, get_current_user_id()
      )
    );
    return ( $isFavourite && $isFavourite !== null && $isFavourite >= 1 );
  }
  public function getFavourite( $args ) {
    global $wpdb;
    $getFavourite = $wpdb->get_results(
      $wpdb->prepare(
         "SELECT * FROM {$wpdb->prefix}fwp_job_favourite WHERE user_id = %d;",
         get_current_user_id()
      )
    );
    return $getFavourite;
  }
  private function deFavourite( $post_id ) {
    global $wpdb;
    $wpdb->query(
      $wpdb->prepare(
         "DELETE FROM {$wpdb->prefix}fwp_job_favourite WHERE post_id = %d AND user_id = %d;",
         $post_id, get_current_user_id()
      )
    );
    return true;
  }
  private function enFavourite( $post_id ) {
    global $wpdb;
    $wpdb->query(
      $wpdb->prepare(
         "INSERT INTO {$wpdb->prefix}fwp_job_favourite
         ( post_id, user_id )
         VALUES ( %d, %d );",
         $post_id,
         get_current_user_id()
      )
    );
    return true;
  }
  public function isApplied( $post_id ) {
    global $wpdb;
    return false;
  }
  public function onApply( $post_id ) {
    return site_url( 'dashboard/candidate/apply-' . $post_id . '/' );
  }
  private function junkDatabse() {
    $junks = [
      'company' => "CREATE TABLE IF NOT EXISTS `test`.`company` ( `ID` SERIAL NOT NULL , `Name` TEXT NOT NULL , `Address` MEDIUMTEXT NOT NULL , `Zipcode` INT NOT NULL , `City` TEXT NOT NULL , `Phonenumber` TEXT NOT NULL , `Website` TEXT NOT NULL , `Location_area` MEDIUMTEXT NOT NULL COMMENT 'Relation with location_area entity' ) ENGINE = InnoDB CHARSET=utf8mb4 COLLATE utf8mb4_general_ci COMMENT = 'This table is for storing company Entities information';", // For Company information
			'Job_opening' => "CREATE TABLE IF NOT EXISTS `test`.`job_opening` ( `Internal_id` SERIAL NOT NULL COMMENT 'ID used for internal communication' , `Title` TEXT NOT NULL COMMENT 'Title of the job opening' , `Company` TEXT NOT NULL COMMENT 'Relation with company entity. Each job opening has one company' , `State` TEXT NOT NULL COMMENT 'Relation with state entity. Each job opening has one status' , `User` TEXT NOT NULL COMMENT 'Relation with the user entity. Each job opening can have one user.' , `Creation_date` TIMESTAMP NOT NULL COMMENT 'Date when the job opening is created' DEFAULT CURRENT_TIMESTAMP , `Update_date` TIMESTAMP NULL DEFAULT NULL COMMENT 'Last change of the job opening' , `Job_dates` TEXT NOT NULL COMMENT 'Relation with job_date entity. A job opening has multiple job_dates.' , `Description` LONGTEXT NOT NULL COMMENT 'Description of the job opening' , `Requirements` LONGTEXT NOT NULL COMMENT 'Requirements of the user for the job opening' , `Offering` LONGTEXT NOT NULL COMMENT 'What the company offers the user' , `Hide_company` BOOLEAN NOT NULL COMMENT 'Option to hide company information' DEFAULT FALSE , `Closing_date` DATE NOT NULL COMMENT 'Closing date of the job opening' ) ENGINE = InnoDB CHARSET=utf8mb4 COLLATE utf8mb4_general_ci COMMENT = 'For JOB_OPENING table serial 2 on Requirments';",
			'location_area' => "CREATE TABLE IF NOT EXISTS `test`.`location_area` ( `ID` SERIAL NOT NULL COMMENT '' , `Name` TEXT NOT NULL COMMENT '' , `Description` MEDIUMTEXT NOT NULL COMMENT '' ) ENGINE = InnoDB CHARSET=utf8mb4 COLLATE utf8mb4_general_ci COMMENT = 'FOR JOB location Area on Company location serial 3';",
			'state' => "CREATE TABLE IF NOT EXISTS `test`.`state` ( `ID` SERIAL NOT NULL , `Name` TEXT NOT NULL , `Description` MEDIUMTEXT NOT NULL , `Is_available` BOOLEAN NOT NULL DEFAULT FALSE ) ENGINE = InnoDB CHARSET=utf8mb4 COLLATE utf8mb4_general_ci COMMENT = 'FOR JOB location Area on Company sountry State - serial 4';",
			'job_date' => "CREATE TABLE IF NOT EXISTS `test`.`job_date` ( `ID` SERIAL NOT NULL , `Job` INT NOT NULL , `Date` MEDIUMTEXT NOT NULL , `Requirements` MEDIUMTEXT NOT NULL , `Location` TEXT NOT NULL ) ENGINE = InnoDB CHARSET=utf8mb4 COLLATE utf8mb4_general_ci COMMENT = 'FOR JOB Date as said Job date\'ll multiple, expiry one';",
			'User' => "CREATE TABLE IF NOT EXISTS `test`.`user` ( `Name` TEXT NOT NULL COMMENT '' , `Company_name` INT NOT NULL COMMENT 'Name of the company of the user' , `Registration_info` TEXT NOT NULL COMMENT 'Information about the registration on the Chamber of Commerce' , `Address` MEDIUMTEXT NOT NULL COMMENT '' , `Zipcode` TEXT NOT NULL COMMENT '' , `City` INT NOT NULL COMMENT '' , `Emailaddress` INT NOT NULL COMMENT '' , `Phonenumber` INT NOT NULL COMMENT '' , `Username` INT NOT NULL COMMENT 'Assigned, can’t be changed' , `Password` INT NOT NULL COMMENT '' , `Group` INT NOT NULL COMMENT 'Relation with group entity. Each user can have multiple groups' , `Company` INT NOT NULL COMMENT 'A user can be related to a company. A user can only be connected to one company. This field is only used if the user is in the group Hospitality.' ) ENGINE = InnoDB CHARSET=utf8mb4 COLLATE utf8mb4_general_ci COMMENT = 'FOR JOB Applicants User data';",
			'group' => "CREATE TABLE IF NOT EXISTS `test`.`group` ( `Name` TEXT NOT NULL ) ENGINE = InnoDB CHARSET=utf8mb4 COLLATE utf8mb4_general_ci COMMENT = 'FOR JOB Group, 2, Hospitality, Worker';",
			'user_document_type' => "CREATE TABLE IF NOT EXISTS `test`.`user_document_type` ( `Name` TEXT NOT NULL , `Description` LONGTEXT NOT NULL , `Required` BOOLEAN NOT NULL DEFAULT TRUE ) ENGINE = InnoDB CHARSET=utf8mb4 COLLATE utf8mb4_general_ci COMMENT = 'FOR JOB User_document_type from option page';",
			'user_document' => "CREATE TABLE IF NOT EXISTS `test`.`user_document` ( `Name` TEXT NOT NULL , `Filename` TEXT NOT NULL , `User` INT NOT NULL DEFAULT '1' COMMENT 'User that uploaded the document. Each user_document is releated to one user ' , `Type` INT NOT NULL COMMENT 'Type of the uploaded document. Each upload is related to one User_document_type ' , `Date` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Date that document is uploaded' ) ENGINE = InnoDB CHARSET=utf8mb4 COLLATE utf8mb4_general_ci COMMENT = 'FOR JOB User_document on file Upload';",
			'User_job_reaction' => "CREATE TABLE IF NOT EXISTS `test`.`user_job_reaction` ( `User_is_interested` BOOLEAN NOT NULL COMMENT 'Field to indicate that a user is interested in the job opening ' , `User` INT NOT NULL COMMENT 'User that indicated if he / she is interested. Each reaction is related to one user ' ) ENGINE = InnoDB CHARSET=utf8mb4 COLLATE utf8mb4_general_ci COMMENT = 'FOR JOB User_job_reaction';",
			'Invoices' => "CREATE TABLE IF NOT EXISTS `test`.`invoices` ( `User` INT NOT NULL COMMENT 'Each invoice is related to one user ' , `Job` INT NOT NULL COMMENT 'Each invoice is related to one or multiple jobs that happen that week' , `Date` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Creation date of the invoice ' , `Title` TEXT NOT NULL COMMENT 'Title of the invoice' , `Filename` TEXT NOT NULL , `Is_paid` BOOLEAN NOT NULL DEFAULT FALSE ) ENGINE = InnoDB COMMENT = 'FOR JOB invoice';",
    ];
  }


  public function cvGet( $args ) {
    global $wpdb;
    $sqlQuery = "SELECT * FROM {$wpdb->prefix}fwp_job_cv WHERE 1";
    if( isset( $args[ 'id' ] ) ) {
      $sqlQuery .= " AND ID = " . $args[ 'id' ];
    }
    if( isset( $args[ 'user' ] ) ) {
      $sqlQuery .= " AND user_id = " . $args[ 'user' ];
    }
    $result = $wpdb->get_results(
      $sqlQuery
    );
    return $result;
  }
  public function cvEdit( $args ) {
    global $wpdb;
    $args = wp_parse_args( $args, [
      'id' => false,
      'name' => '',
      'path' => ''
    ] );
    if( ! $args[ 'id' ] || empty( $args[ 'name' ] ) || empty( $args[ 'path' ] ) ) {
      return false;
    }
    $wpdb->query(
      $wpdb->prepare(
         "UPDATE {$wpdb->prefix}fwp_job_cv SET cv_name = %s, cv_path = %s WHERE ID = %d AND user_id = %d",
         $args[ 'name' ],
         $args[ 'path' ],
         $args[ 'id' ],
         get_current_user_id()
      )
    );
    return true;
  }
  public function cvAdd( $args ) {
    global $wpdb;
    $args = wp_parse_args( $args, [
      'name' => '',
      'path' => ''
    ] );
    if( empty( $args[ 'name' ] ) || empty( $args[ 'path' ] ) ) {
      return false;
    }
    $wpdb->query(
      $wpdb->prepare(
         "INSERT INTO {$wpdb->prefix}fwp_job_cv SET cv_name = %s, cv_path = %s, user_id = %d;",
         $args[ 'name' ],
         $args[ 'path' ],
         get_current_user_id()
      )
    );
    return true;
  }
  public function cvDelete( $args ) {
    global $wpdb;
    $wpdb->query(
      $wpdb->prepare(
          "DELETE FROM {$wpdb->prefix}fwp_job_cv WHERE ID = %d AND user_id = %d;",
          $args[ 'id' ],
          get_current_user_id()
      )
    );
    return true;
  }


  public function applicationGet( $args ) {
    global $wpdb;
    $sqlQuery = "SELECT * FROM {$wpdb->prefix}fwp_job_application WHERE 1";
    if( isset( $args[ 'id' ] ) ) {$sqlQuery .= " AND ID = " . $args[ 'id' ];}
    if( isset( $args[ 'user' ] ) ) {$sqlQuery .= " AND user_id = " . $args[ 'user' ];}
    if( isset( $args[ 'cv' ] ) ) {$sqlQuery .= " AND cv_id = " . $args[ 'cv' ];}
    if( isset( $args[ 'job' ] ) ) {$sqlQuery .= " AND job_id = " . $args[ 'job' ];}
    if( isset( $args[ 'order' ] ) ) {$sqlQuery .= " ORDER BY ID " . $args[ 'order' ];}
    if( isset( $args[ 'limit' ] ) ) {$sqlQuery .= " LIMIT " . $args[ 'limit' ];}
    $result = $wpdb->get_results(
      $sqlQuery
    );
    return $result;
  }
  public function applyCompanyGet( $args ) {
    global $wpdb;
    $sql = "SELECT apply.*, post.* FROM {$wpdb->prefix}fwp_job_application apply LEFT JOIN {$wpdb->posts} post ON post.ID = apply.job_id WHERE post.post_type = '%s' ORDER BY apply.job_id";
    $sqlArgs = [ FUTUREWORDPRESS_PROJECT_CPT_JOB_OPENINGS ];
    if( isset( $args[ 'id' ] ) ) {
      $sql .= " AND apply.ID = %d";
      $sqlArgs[] = $args[ 'id' ];
    }
    $result = $wpdb->get_results(
      $wpdb->prepare(
        $sql,
        ...$sqlArgs
      )
    );
    return $result;
  }
  public function applicationAdd( $args ) {
    global $wpdb;
    $args = wp_parse_args( $args, [
      'job_id' => false,
      'cv_id' => false,
      'coverletter' => false
    ] );
    if( $args[ 'job_id' ] === false || empty( $args[ 'job_id' ] ) || empty( $args[ 'cv_id' ] ) || empty( $args[ 'coverletter' ] ) ) {
      return false;
    }
    $wpdb->query(
      $wpdb->prepare(
        "INSERT INTO {$wpdb->prefix}fwp_job_application SET user_id = %d, job_id = %d, cv_id = %d, coverletter = %s;",
        get_current_user_id(),
        $args[ 'job_id' ],
        $args[ 'cv_id' ],
        $args[ 'coverletter' ]
      )
    );
    return true;
  }
  public function applicationEdit( $args ) {
    global $wpdb;
    $args = wp_parse_args( $args, [
      'id' => false,
      'job_id' => false,
      'cv_id' => false,
      'coverletter' => false
    ] );
    if( $args[ 'id' ] === false || $args[ 'job_id' ] === false || empty( $args[ 'job_id' ] ) || empty( $args[ 'cv_id' ] ) || empty( $args[ 'coverletter' ] ) ) {
      return false;
    }
    $wpdb->query(
      $wpdb->prepare(
        "UPDATE FROM {$wpdb->prefix}fwp_job_application SET user_id = %d, job_id = %d, cv_id = %d, coverletter = %s WHERE ID = %d;",
        get_current_user_id(),
        $args[ 'job_id' ],
        $args[ 'cv_id' ],
        $args[ 'coverletter' ],
        $args[ 'id' ]
      )
    );
    return true;
  }
  public function applicationDelete( $args ) {
    global $wpdb;
    if( isset( $args[ 'isCompany' ] ) ) {
      $apply = $wpdb->get_row(
        $wpdb->prepare(
           "SELECT apply.ID, apply.job_id FROM {$wpdb->prefix}fwp_job_application apply INNER JOIN {$wpdb->posts} posts WHERE apply.ID = %d AND posts.ID = apply.job_id AND posts.post_author = %d;",
           $args[ 'id' ],
           get_current_user_id()
        )
      );
      // wp_die( print_r( $apply ) );
      if( $apply && isset( $apply->ID ) ) {
        $wpdb->query(
          $wpdb->prepare(
             "DELETE FROM {$wpdb->prefix}fwp_job_application WHERE ID = %d AND job_id = %d;",
             $apply->ID,
             $apply->job_id
          )
        );
        return true;
      } else {
        return false;
      }
    } else {
      $wpdb->query(
        $wpdb->prepare(
           "DELETE FROM {$wpdb->prefix}fwp_job_application WHERE ID = %d AND user_id = %d;",
           $args[ 'id' ],
           get_current_user_id()
        )
      );
      return true;
    }
    return false;
  }
  public function applicationApprove( $args ) {
    global $wpdb;
    $args = wp_parse_args( $args, [
      'id' => false,
      'user_id' => false,
      'job_id' => false,
      'cv_id' => false
    ] );
    if( $args[ 'id' ] === false || $args[ 'user_id' ] === false || $args[ 'job_id' ] === false || $args[ 'cv_id' ] === false ) {
      return false;
    }
    $wpdb->query(
      $wpdb->prepare(
        "UPDATE {$wpdb->prefix}fwp_job_application SET is_approved = %s WHERE ID = %d AND user_id = %d AND job_id = %d AND cv_id = %d AND is_approved = 0;",
        time(),
        $args[ 'id' ],
        $args[ 'user_id' ],
        $args[ 'job_id' ],
        $args[ 'cv_id' ]
      )
    );
    return true;
  }
  public function applicationPaid( $args ) {
    global $wpdb;
    $args = wp_parse_args( $args, [
      'user_id' => get_current_user_id(),
      'job_id' => false,
      'id' => false,
      'payable' => false,
      'currency' => false,
      'note' => false,
      'cv_id' => false
    ] );
    if( $args[ 'id' ] === false || $args[ 'user_id' ] === false || $args[ 'job_id' ] === false || $args[ 'cv_id' ] === false ) {
      return false;
    }
    // print_r( $args );
    $wpdb->query(
      $wpdb->prepare(
        "INSERT INTO {$wpdb->prefix}fwp_job_payment SET user_id = %d , job_id = %d , application_id = %d , payable = %s , currency = %s , note = %s;",
        $args[ 'user_id' ],
        $args[ 'job_id' ],
        $args[ 'id' ],
        $args[ 'payable' ],
        $args[ 'currency' ],
        $args[ 'note' ]
      )
    );
    // wp_die( $wpdb->insert_id );
    if( $wpdb->insert_id && $wpdb->insert_id != 0 ) {
      $wpdb->query(
        $wpdb->prepare(
          "UPDATE {$wpdb->prefix}fwp_job_application SET is_paid = %d WHERE ID = %d AND user_id = %d AND job_id = %d AND cv_id = %d AND is_approved != 0;",
          $wpdb->insert_id, // time(),
          $args[ 'id' ],
          $args[ 'user_id' ],
          $args[ 'job_id' ],
          $args[ 'cv_id' ]
        )
      );
      return true;
    } else {
      return false;
    }
  }

  public function applicationCount( $args ) {
    global $wpdb;
    $sqlQuery = "SELECT COUNT(*) AS total FROM {$wpdb->prefix}fwp_job_application WHERE 1";
    if( isset( $args[ 'id' ] ) ) {$sqlQuery .= " AND ID = " . $args[ 'id' ];}
    if( isset( $args[ 'user' ] ) ) {$sqlQuery .= " AND user_id = " . $args[ 'user' ];}
    if( isset( $args[ 'cv' ] ) ) {$sqlQuery .= " AND cv_id = " . $args[ 'cv' ];}
    if( isset( $args[ 'job' ] ) ) {$sqlQuery .= " AND job_id = " . $args[ 'job' ];}
    if( isset( $args[ 'order' ] ) ) {$sqlQuery .= " ORDER BY ID " . $args[ 'order' ];}
    if( isset( $args[ 'limit' ] ) ) {$sqlQuery .= " LIMIT " . $args[ 'limit' ];}
    $result = $wpdb->get_row(
      $sqlQuery
    );
    return $result;
  }
  public function appliedRange( $args ) {
    $applied = $this->applicationCount( $args );
    $applied = $applied->total;
    if( $applied >= 0 && $applied < 20 ) {return __( '0-20', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN );}
    elseif( $applied >= 20 && $applied < 50 ) {return __( '20-50', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN );}
    elseif( $applied >= 50 && $applied < 200 ) {return __( '50-200', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN );}
    elseif( $applied >= 200 && $applied < 500 ) {return __( '200-500', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN );}
    elseif( $applied >= 500 && $applied < 1000 ) {return __( '500-1000', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN );}
    else {return $applied->total;}
  }

  
  public function invoiceGet( $args ) {
    global $wpdb;
    $sqlQuery = "SELECT * FROM {$wpdb->prefix}fwp_job_payment WHERE 1";
    if( isset( $args[ 'id' ] ) ) {$sqlQuery .= " AND ID = " . $args[ 'id' ];}
    if( isset( $args[ 'user' ] ) ) {$sqlQuery .= " AND user_id = " . $args[ 'user' ];}
    if( isset( $args[ 'cv' ] ) ) {$sqlQuery .= " AND cv_id = " . $args[ 'cv' ];}
    if( isset( $args[ 'job' ] ) ) {$sqlQuery .= " AND job_id = " . $args[ 'job' ];}
    if( isset( $args[ 'order' ] ) ) {$sqlQuery .= " ORDER BY ID " . $args[ 'order' ];}
    if( isset( $args[ 'limit' ] ) ) {$sqlQuery .= " LIMIT " . $args[ 'limit' ];}
    $result = $wpdb->get_results(
      $sqlQuery
    );
    if( isset( $args[ 'is_single' ] ) && $args[ 'is_single' ] ) {$result = isset( $result[0] ) ? $result[0] : $result;}
    return $result;
  }

  public function companyActivity( $args ) {
    global $wpdb;
    $apply = $wpdb->get_results(
      $wpdb->prepare(
        "SELECT apply.ID AS applyID, apply.created_on AS createdTime, user.display_name AS userName, post.post_title as jobTitle FROM {$wpdb->prefix}fwp_job_application apply LEFT JOIN {$wpdb->posts} post ON post.ID = apply.job_id LEFT JOIN {$wpdb->users} user ON user.ID = apply.user_id WHERE post.post_type = %s AND post.post_author = %d ORDER BY apply.ID DESC LIMIT 6;",
        FUTUREWORDPRESS_PROJECT_CPT_JOB_OPENINGS, get_current_user_id()
      )
    );
    $activity = ( $apply && count( $apply ) >= 1 ) ? $apply : [];
    $favourites = $wpdb->get_results(
      $wpdb->prepare(
        "SELECT fav.ID AS favID, user.display_name AS userName, post.post_title as jobTitle, fav.created_time AS createdTime FROM {$wpdb->prefix}fwp_job_favourite fav LEFT JOIN {$wpdb->posts} post ON post.ID = fav.post_id LEFT JOIN {$wpdb->users} user ON user.ID = fav.user_id WHERE post.post_type = %s AND post.post_author = %d ORDER BY fav.ID DESC LIMIT 6;",
        FUTUREWORDPRESS_PROJECT_CPT_JOB_OPENINGS, get_current_user_id()
      )
    );
    foreach( $favourites as $fav ) {
      $activity[] = $fav;
    }
    // usort | ksort
    usort( $activity, [ $this, 'usort' ] );
    return $activity;
  }
  public function candidateActivity( $args ) {
    global $wpdb;
    $apply = $wpdb->get_results(
      $wpdb->prepare(
        "SELECT apply.ID AS applyID, apply.created_on AS createdTime, user.display_name AS userName, post.post_title as jobTitle FROM {$wpdb->prefix}fwp_job_application apply LEFT JOIN {$wpdb->posts} post ON post.ID = apply.job_id LEFT JOIN {$wpdb->users} user ON user.ID = apply.user_id WHERE post.post_type = %s AND apply.user_id = %d ORDER BY apply.ID DESC LIMIT 6;",
        FUTUREWORDPRESS_PROJECT_CPT_JOB_OPENINGS, get_current_user_id()
      )
    );
    $activity = ( $apply && count( $apply ) >= 1 ) ? $apply : [];

    $favourites = $wpdb->get_results(
      $wpdb->prepare(
        "SELECT fav.ID AS favID, user.display_name AS userName, post.post_title as jobTitle, fav.created_time AS createdTime FROM {$wpdb->prefix}fwp_job_favourite fav LEFT JOIN {$wpdb->posts} post ON post.ID = fav.post_id LEFT JOIN {$wpdb->users} user ON user.ID = fav.user_id WHERE post.post_type = %s AND fav.user_id = %d ORDER BY fav.ID DESC LIMIT 6;",
        FUTUREWORDPRESS_PROJECT_CPT_JOB_OPENINGS, get_current_user_id()
      )
    );
    foreach( $favourites as $fav ) {
      $activity[] = $fav;
    }

    $approved = $wpdb->get_results(
      $wpdb->prepare(
        "SELECT apply.ID AS approveID, apply.created_on AS createdTime, user.display_name AS userName, post.post_title as jobTitle FROM {$wpdb->prefix}fwp_job_application apply LEFT JOIN {$wpdb->posts} post ON post.ID = apply.job_id LEFT JOIN {$wpdb->users} user ON user.ID = apply.user_id WHERE apply.is_approved != 0 AND post.post_type = %s AND apply.user_id = %d ORDER BY apply.ID DESC LIMIT 6;",
        FUTUREWORDPRESS_PROJECT_CPT_JOB_OPENINGS, get_current_user_id()
      )
    );
    foreach( $approved as $row ) {
      $activity[] = $row;
    }

    $paidDone = $wpdb->get_results(
      $wpdb->prepare(
        "SELECT payment.ID AS paymentID, payment.created_on AS createdTime, user.display_name AS userName, post.post_title as jobTitle FROM {$wpdb->prefix}fwp_job_payment payment LEFT JOIN {$wpdb->prefix}fwp_job_application apply ON payment.application_id = apply.ID LEFT JOIN {$wpdb->posts} post ON post.ID = apply.job_id LEFT JOIN {$wpdb->users} user ON user.ID = apply.user_id WHERE post.post_type = %s AND apply.user_id = %d ORDER BY apply.ID DESC LIMIT 6;",
        FUTUREWORDPRESS_PROJECT_CPT_JOB_OPENINGS, get_current_user_id()
      )
    );
    foreach( $paidDone as $row ) {
      $activity[] = $row;
    }

    // usort | ksort
    usort( $activity, [ $this, 'usort' ] );
    return $activity;
  }
  private function usort( $a, $b ) {
    $aTime = new \DateTime( $a->createdTime );$bTime = new \DateTime( $b->createdTime );
    // if( $aTime == $bTime ) {return 0;}
    // return ( $aTime < $bTime ) ? -1 : 1;
    return ( $aTime <=> $bTime  ? +1 : -1);
  }

}
