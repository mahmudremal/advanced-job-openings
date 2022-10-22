<?php
/**
 * Job Dashboard Favourite Jobs template file
 * @package Aquila.
 */
$favouritePosts = apply_filters( 'futurewordpress/project/job/get/favourite', [] );

?>
<?php foreach( $favouritePosts as $fav ) : ?>
  <?php
    echo apply_filters( 'futurewordpress/project/job/card', get_post( $fav->post_id ), true );
    ?>
<?php endforeach; ?>