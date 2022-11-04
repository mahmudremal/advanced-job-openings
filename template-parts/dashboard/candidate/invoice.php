<?php
/**
 * Job Dashboard Agenda template file
 * @package Aquila.
 */
if( isset( $post_id ) && $post_id != '' ) :
  global $wp;
  $isDownload = ( isset( $_GET[ 'download' ] ) );
  $hasHeaderFooter = false;$activeSignature = false;
  $invoiceLogo = 'invoice.svg';$activeClipingMask = false;

  $invoice = apply_filters( 'futurewordpress/project/job/invoice/get', [ 'id' => $post_id, 'user' => get_current_user_id(), 'is_single' => true ] );
  if( ! isset( $invoice->ID ) ) {wp_die( __( 'Invoice not found on database.', 'domain' ) );}
  if( $invoice->user_id != get_current_user_id() ) {wp_die( __( 'You\'re not allowed to view or download this invoice.', 'domain' ) );}
  $apply = apply_filters( 'futurewordpress/project/job/apply/get', [ 'id' => $invoice->application_id, 'user' => get_current_user_id() ] );
  if( $apply && count( $apply ) >= 1 ) {
    $apply = isset( $apply[0] ) ? $apply[0] : $apply;
  }
  $job = get_post( $apply->job_id );
  $jobInfo = apply_filters( 'futurewordpress/project/renderpost', [], $job );
  $userInfo = wp_get_current_user();
  $getCurrencies = apply_filters( 'futurewordpress/project/job/currencies', [ 'USD', 'EUR' ], true );
  $documentTitle = sprintf( 'Invoice of %s downloaded on %s', $userInfo->display_name, wp_date( 'M d, Y', date( 'M d, Y' ) ) ) . ' | ' . get_bloginfo( 'name' );
  $companyLogo = esc_url( ( isset( $jobInfo[ 'meta' ][ 'company' ][ 'logo' ] ) && ! empty( $jobInfo[ 'meta' ][ 'company' ][ 'logo' ] ) ) ? $jobInfo[ 'meta' ][ 'company' ][ 'logo' ] : FUTUREWORDPRESS_PROJECT_BUILD_IMG_URI . '/placeholder.png' );

  if( $isDownload && false ) :
  else :
    if( $isDownload ){ob_start();}

    // print_r( [$invoice, $apply, $getCurrencies ] ); // , get_user_meta( $userInfo->ID, '', true )
    
    if( ! $isDownload ) {
      add_filter( 'pre_get_document_title', function( $title ) {
        $userInfo = wp_get_current_user();
        return sprintf( 'Invoice of %s printed on %s', $userInfo->display_name, wp_date( 'M d, Y', date( 'M d, Y' ) ) ) . ' | ' . get_bloginfo( 'name' );
      }, 10, 1 );
      get_header();
    }
    ?>
    <!-- Our Invoice Table -->
    <section class="<?php echo esc_attr( $isDownload ? '' : 'our-invoice bgc-fa pb85 col-12' ); ?>">
      <div class="<?php echo esc_attr( $isDownload ? '' : 'container' ); ?>">
        <?php if( ! $isDownload ) : ?>
          <div class="row">
            <div class="col-lg-10 offset-lg-1">
              <ul class="invoice_down_print float-right">
                <li><a href="?download=true"><span class="flaticon-download"></span></a></li>
                <li><a href="javascript:void(0);" onclick="window.print();"><span class="flaticon-printer"></span></a></li>
              </ul>
            </div>
          </div>
        <?php endif; ?>
        <div class="<?php echo esc_attr( $isDownload ? '' : 'row mt20' ); ?>">
          <div class="<?php echo esc_attr( $isDownload ? '' : 'col-lg-10 offset-lg-1' ); ?>">
            <div class="<?php echo esc_attr( $isDownload ? '' : 'invoice_table' ); ?>" style="<?php echo esc_attr( $isDownload ? 'padding: 30px 15px;' : '' ); ?>">
              <?php if( ! $isDownload ) : ?>
                <table class="table" style="border-top: 0;<?php echo esc_attr( $isDownload ? 'margin-bottom: 0;' : '' ); ?>">
                  <tbody>
                    <td align="left" style="padding-left: 0;border-top: 0;">
                      <div class="main _logo">
                        <img class="img-fl uid" src="<?php echo $companyLogo; ?>" alt="" style="<?php echo esc_attr( $isDownload ? 'height: 80px;width: 120px;' : 'max-height: 80px;min-width: 120px;' ); ?>"/>
                      </div>
                    </td>
                  </tbody>
                </table>
              <?php endif; ?>
              <div class="<?php echo esc_attr( $isDownload ? '' : 'row' ); ?>">
                <div class="col-lg-12">
                  <div class="invoice_title">
                    <h1 style="<?php echo esc_attr( $isDownload ? 'font-weight: bold;font-size: 25px;' : '' ); ?>"><?php esc_html_e( 'Invoice', 'domain' ); ?></h1>
                  </div>
                  <table class="invoice_meta table">
                    <tbody>
                      <tr style="<?php echo esc_attr( $isDownload ? 'border-top: 1px solid rgb(250, 250, 250);line-height: 30px;' : '' ); ?>">
                        <td><?php esc_html_e( 'Date', 'domain' ); ?></td>
                        <td><?php esc_html_e( 'Invoice', 'domain' ); ?> </td>
                        <td><?php esc_html_e( 'Date Approved', 'domain' ); ?></td>
                        <td><?php esc_html_e( 'Date Paid', 'domain' ); ?></td>
                      </tr>
                      <tr style="<?php echo esc_attr( $isDownload ? 'border-top: 1px solid rgb(250, 250, 250);line-height: 30px;' : '' ); ?>">
                        <td><?php echo esc_html( wp_date( 'd/m/Y' ) ); ?></td>
                        <td><?php echo esc_html( ( $post_id <= 9 ) ? '00' . $post_id : ( ( $post_id <= 99 ) ? '0' . $post_id : $post_id ) ); ?></td>
                        <td><?php echo esc_html( ( ! empty( $apply->is_approved ) && $apply->is_approved != 0 ) ? wp_date( 'd/m/Y', $apply->is_approved ) : __( 'N/A', 'domain' ) ); ?></td>
                        <td><?php echo esc_html( wp_date( 'd/m/Y', strtotime( $invoice->created_on ) ) ); ?></td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
              <table class="mt40 table">
                <tr>
                  <td style="border-top: 0;">
                    <address>
                      <h2 class="fz18 fwb color-black22" style="<?php echo esc_attr( $isDownload ? 'font-weight: bold;font-size: 18px;' : '' ); ?>"><?php esc_html_e( 'Bill From', 'domain' ); ?>:</h2>
                      <p><?php echo esc_html( $jobInfo[ 'meta' ][ 'company' ][ 'name' ] ); ?><br><?php echo esc_html( isset( $jobInfo[ 'meta' ][ 'company' ][ 'location' ] ) ? $jobInfo[ 'meta' ][ 'company' ][ 'location' ] : ( isset( $jobInfo[ 'meta' ][ 'jobs' ][ 'location' ] ) ? $jobInfo[ 'meta' ][ 'jobs' ][ 'location' ] : '' ) ); ?><br /><?php echo esc_html( $jobInfo[ 'meta' ][ 'company' ][ 'email' ] ); ?><br /><?php echo esc_html( $jobInfo[ 'meta' ][ 'company' ][ 'phone' ] ); ?></p>
                    </address>
                  </td>
                  <td style="border-top: 0;">
                    <address>
                      <h2 class="fz18 fwb color-black22" style="<?php echo esc_attr( $isDownload ? 'font-weight: bold;font-size: 18px;' : '' ); ?>"><?php esc_html_e( 'Bill To', 'domain' ); ?>:</h2>
                      <p><?php echo esc_html( $userInfo->display_name ); ?><br><?php echo wp_kses_post( isset( $userInfo->data->user_address ) ? $userInfo->data->user_address . '<br/>' : '' ); ?><?php echo wp_kses_post( isset( $userInfo->user_phone ) ? $userInfo->user_phone . '<br/>' : '' ); ?><?php echo esc_html( $userInfo->user_email ); ?></p>
                    </address>
                  </td>
                </tr>
              </table>
              <div class="mt50">
                <div class="col-lg-12">
                  <div class="table-responsive invoice_table_list">
                    <table class="table">
                      <thead class="thead-light">
                          <tr style="<?php echo esc_attr( $isDownload ? 'background-color: rgb(250, 250, 250);line-height: 35px;' : '' ); ?>">
                            <th scope="col" colspan="3"><?php esc_html_e( 'Description', 'domain' ); ?></th>
                            <th scope="col"><?php esc_html_e( 'Price', 'domain' ); ?></th>
                          </tr>
                      </thead>
                      <tbody>
                          <tr style="<?php echo esc_attr( $isDownload ? 'border-top: 1px solid rgb(250, 250, 250);line-height: 35px;' : '' ); ?>">
                            <th scope="row" colspan="3" align="left"><?php echo esc_html( $jobInfo[ 'post' ]->post_title ); ?></th>
                            <td><?php echo esc_html( isset( $getCurrencies[ $invoice->currency ] ) ? ( $isDownload ? $invoice->currency : $getCurrencies[ $invoice->currency ] ) : '' ); ?> <?php echo esc_html( number_format_i18n( $invoice->payable, 2 ) ); ?></td>
                          </tr>
                          <tr style="<?php echo esc_attr( $isDownload ? 'border-top: 1px solid rgb(250, 250, 250);line-height: 35px;' : '' ); ?>">
                            <th scope="row"></th>
                            <td></td>
                            <td class="color-black22"><?php esc_html_e( 'Total', 'domain' ); ?></td>
                            <td class="color-black22"><?php echo esc_html( isset( $getCurrencies[ $invoice->currency ] ) ? ( $isDownload ? $invoice->currency : $getCurrencies[ $invoice->currency ] ) : '' ); ?> <?php echo esc_html( number_format_i18n( $invoice->payable, 2 ) ); ?></td>
                          </tr>
                      </tbody>
                      <tfoot>
                        <tr>
                          <td colspan="4">
                            <p class="pt30"><?php echo esc_html( $invoice->note ); ?></p>
                          </td>
                        </tr>
                      </tfoot>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <style>
      .invoice_table .main_logo .img-fluid {max-height: 100px;}
      .invoice_table_list .table .thead-light tr {background: #fafafa;border-top: 1px solid #dee2e6;}
      .invoice_table_list .table tbody tr{border-top: 1px solid #dee2e6;}
    </style>
    <?php if( ! $isDownload ) : ?>
      <style>
        @media print {
          .invoice_down_print {
            display: none;
          }
        }
        #page #header {
          display: none;
        }
      </style>
    <?php else: ?>
      <style>
        <?php
          $csses = [ 'boot strap.min', 'invoice' ];
          foreach( $csses as $css ) {
            $file = FUTUREWORDPRESS_PROJECT_BUILD_LIB_PATH . '/css/' . $css . '.css';
            echo ( file_exists( $file ) && ! is_dir( $file ) ) ? file_get_contents( $file ) : '';
          }
        ?>
      </style>
    <?php endif; ?>
    <?php if( ! $isDownload && $hasHeaderFooter ) {get_footer();} ?>
    <?php
    if( $isDownload ) {
      $html = ob_get_clean();
      ob_end_clean();

      // echo $html;exit;

      if( ! class_exists( "TCPDF" ) ) {require_once( FUTUREWORDPRESS_PROJECT_DIR_PATH . '/inc/frameworks/tcpdf/tcpdf.php' );}
      $pdf = new TCPDF( PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false );
      $pdf->SetCreator(PDF_CREATOR);
      $pdf->SetAuthor( 'Future WordPress' );
      $pdf->SetTitle( $documentTitle );
      $pdf->SetSubject( __( 'Billing Invoice', 'domain') );
      $pdf->SetKeywords( 'Future WordPress, Billing Invoice' );
      // set default header data
      // $invoiceLogo = $companyLogo;
      $pdf->SetHeaderData( false, PDF_HEADER_LOGO_WIDTH, $documentTitle, sprintf( __( "by %s - %s\n%s", 'domain' ), 'FutureWordpress', str_replace( [ 'https://', 'http://' ], [ '', '' ], site_url() ), site_url() ) );
      // set header and footer fonts
      $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
      $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
      // set default monospaced font
      $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
      // set margins
      $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
      $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
      $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
      // set auto page breaks
      $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);


      // set some language-dependent strings (optional)
      // if( file_exists(dirname(__FILE__).'/lang/eng.php' ) ) {
      //     require_once( dirname(__FILE__).'/lang/eng.php' );
      //     $pdf->setLanguageArray($l);
      // }

      // ---------------------------------------------------------

      // set font
      $pdf->SetFont( 'helvetica', '', 10); // freesans | courier | helvetica
      
      // $pdf->setPrintHeader( false );
      // $pdf->setPrintFooter( false );

      $pdf->SetDefaultMonospacedFont( PDF_FONT_MONOSPACED );

      $pdf->SetMargins( PDF_MARGIN_LEFT, 15, PDF_MARGIN_RIGHT );
      $pdf->SetHeaderMargin( PDF_MARGIN_HEADER );
      $pdf->SetFooterMargin( PDF_MARGIN_FOOTER );

      $pdf->SetAutoPageBreak( TRUE, PDF_MARGIN_BOTTOM );

      $pdf->setImageScale( PDF_IMAGE_SCALE_RATIO );

      $pdf->setFontSubsetting( true );

      $pdf->SetFont( 'freesans', '', 11, '', true );

      $pdf->AddPage();

      $pdf->writeHTMLCell( 0, 0, '', '', $html, 0, 1, 0, true, '', true );

      if( $activeSignature ) {
        // set certificate file
        $certificate = 'file://data/cert/tcpdf.crt';
        // set additional information
        $info = array(
          'Name' => 'TCPDF',
          'Location' => 'Office',
          'Reason' => 'Testing TCPDF',
          'ContactInfo' => 'http://www.tcpdf.org',
        );
        // set document signature
        $pdf->setSignature( $certificate, $certificate, 'tcpdfdemo', '', 2, $info);
        // create content for signature (image and/or text)
        $pdf->Image( 'images/tcpdf_signature.png', 180, 60, 15, 15, 'PNG');
        // define active area for signature appearance
        $pdf->setSignatureAppearance(180, 60, 15, 15);
        // *** set an empty signature appearance ***
        $pdf->addEmptySignatureAppearance(180, 80, 15, 15);
      }
      if( $activeClipingMask ) {
        //Start Graphic Transformation
        $pdf->StartTransform();
        // set clipping mask
        $pdf->StarPolygon(105, 100, 30, 10, 3, 0, 1, 'CNZ');
        // draw jpeg image to be clipped
        $pdf->Image('images/image_demo.jpg', 75, 70, 60, 60, '', 'http://www.tcpdf.org', '', true, 72);
        //Stop Graphic Transformation
        $pdf->StopTransform();
      }
      if( true ) {
        $pdf->Image( $companyLogo, 100, 30, 40, 30, 'JPG', esc_url( $jobInfo[ 'meta' ][ 'company' ][ 'url' ] ), '', true, 150, '', false, false, 1, false, false, false);
        // QRCODE,Q : QR-CODE Better error correction
        $pdf->write2DBarcode( isset( $wp->request ) ? $wp->request : site_url( '/dashboard/candidate/home/' ), 'QRCODE,Q', 150, 30, 30, 30, [
          'border' => 2,
          'vpadding' => 'auto',
          'hpadding' => 'auto',
          'fgcolor' => array(0,0,0),
          'bgcolor' => false, //array(255,255,255)
          'module_width' => 1,
          'module_height' => 1
        ], 'N');
      }


      $pdf->Output( sprintf( 'Invoice %s for %s', $jobInfo[ 'post' ]->post_title . '-' . $post_id, $userInfo->display_name ) . '.pdf', 'I' );
      // $pdf->Output( 'doc.pdf', 'I' );
      exit;

    }
  endif;
endif;
?>