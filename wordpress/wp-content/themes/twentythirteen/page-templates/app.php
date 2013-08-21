<?php
/**
 * Template Name: App AAA
 *
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */

?>
<?php get_header() ?>
<div class="container">
  <div class="wrapper">
  <div class="jumbotron">
      <div class="container">
        <h1>Welcome to Spotifair!</h1>
        <p>We may have to change the name for legal reasons at some point, but we're here to 
          help revive the music industry and get the money back to the music makers.
        </p>
      </div>
    </div>
    <section class="playlistRegion"></section>
    <section class="videoPlayerRegion"></section>
  </div>
</div>
  <script data-main="js/main" src="js/lib/require.js"></script>
  <script type="text/javascript">
   require([
      'app',
  ],
  function(app) {
      'use strict';
      app.start();

  });</script>

  <script type="text/javascript" src="https://apis.google.com/js/plusone.js">
   {"parsetags": "explicit"}
   </script>
	
  <?php get_footer() ?>
