<?php
/**
 * Job post new template file
 * @package Aquila.
 */

?>

<div class="row col-12">
  <?php
  $applications = apply_filters( 'futurewordpress/project/job/apply/company', [] );
  foreach( $applications as $apply ) :
    print_r( $apply );
    ?>
    <div class="col-lg-12">
      <div class="candidate_list_view style2">
        <div class="thumb">
          <img class="img-fluid rounded-circle" src="https://creativelayers.net/themes/careerup-html/images/team/c3.jpg" alt="c3.jpg">
          <div class="cpi_av_rating"><span>4.5</span></div>
        </div>
        <div class="content">
          <h4 class="title">Ralph Johnson <small class="verified text-thm2 pl10"><i class="fa fa-check-circle"></i></small></h4>
          <p>Development Manager at <span class="text-thm2">Wiggle CRC</span></p>
          <ul class="review_list">
            <li class="list-inline-item"><a href="#"><i class="fa fa-star"></i></a></li>
            <li class="list-inline-item"><a href="#"><i class="fa fa-star"></i></a></li>
            <li class="list-inline-item"><a href="#"><i class="fa fa-star"></i></a></li>
            <li class="list-inline-item"><a href="#"><i class="fa fa-star"></i></a></li>
            <li class="list-inline-item"><a href="#"><i class="fa fa-star-o"></i></a></li>
          </ul>
          <ul class="address_list">
            <li class="list-inline-item"><a href="#"><span class="flaticon-location-pin"></span> Bothell, WA, USA</a></li>
            <li class="list-inline-item"><a href="#"><span class="flaticon-price"></span> $13.00 - $18.00 per hour</a></li>
          </ul>
        </div>
          <ul class="view_edit_delete_list mt25 float-right fn-xl">
            <li class="list-inline-item"><a href="#" data-toggle="tooltip" data-placement="top" title="Download CV"><span class="flaticon-resume"></span> Download CV</a></li>
            <li class="list-inline-item"><a href="#" data-toggle="tooltip" data-placement="top" title="Send Message"><span class="flaticon-open-envelope-with-letter"></span> Send Message</a></li>
            <li class="list-inline-item"><a href="#" data-toggle="tooltip" data-placement="top" title="Delete"><span class="flaticon-rubbish-bin"></span></a></li>
          </ul>
      </div>
    </div>
  <?php endforeach; ?>
</div>