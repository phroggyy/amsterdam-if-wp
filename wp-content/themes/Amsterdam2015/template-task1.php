<?php
/*
Template Name: Representations page
*/
get_header();

require 'class.amsterdamAPI.php';

$apiKey = 'lC7UO1LW75kSeyhaHfFB9IMnTuZPn9fdBtDTSTbcX76k1oLXdMp3ZvVFYdv5';
$apiSecret = '1svooKg0SCigJ2pPG3RnfIWpJwlqzesiaEmV76iCnbAZwOBONOqg9JVnKQNM';
$amsterdam = new AmsterdamAPI($apiKey, $apiSecret);


?>

<main role="main">
  <div class="container">
      <?php if (!isset($_GET['committee'])) : ?>
          <section class="albums">
              <div class="single-album col-xs-12 col-sm-6 col-md-4 col-lg-4">
                  <div>
                      <h2 class="text-center album-title"><a href="?committee=afet">AFET</a></h2>
                  </div>
              </div>
              <div class="single-album col-xs-12 col-sm-6 col-md-4 col-lg-4">
                  <div>
                      <h2 class="text-center album-title"><a href="?committee=agri">AGRI</a></h2>
                  </div>
              </div>
              <div class="single-album col-xs-12 col-sm-6 col-md-4 col-lg-4">
                  <div>
                      <h2 class="text-center album-title"><a href="?committee=imco">IMCO</a></h2>
                  </div>
              </div>
              <div class="single-album col-xs-12 col-sm-6 col-md-4 col-lg-4">
                  <div>
                      <h2 class="text-center album-title"><a href="?committee=inta-i">INTA I</a></h2>
                  </div>
              </div>
              <div class="single-album col-xs-12 col-sm-6 col-md-4 col-lg-4">
                  <div>
                      <h2 class="text-center album-title"><a href="?committee=inta-ii">INTA II</a></h2>
                  </div>
              </div>
              <div class="single-album col-xs-12 col-sm-6 col-md-4 col-lg-4">
                  <div>
                      <h2 class="text-center album-title"><a href="?committee=itre">ITRE</a></h2>
                  </div>
              </div>
              <div class="single-album col-xs-12 col-sm-6 col-md-4 col-lg-4">
                  <div>
                      <h2 class="text-center album-title"><a href="?committee=libe-i">LIBE I</a></h2>
                  </div>
              </div>
              <div class="single-album col-xs-12 col-sm-6 col-md-4 col-lg-4">
                  <div>
                      <h2 class="text-center album-title"><a href="?committee=libe-ii">LIBE II</a></h2>
                  </div>
              </div>
              <div class="single-album col-xs-12 col-sm-6 col-md-4 col-lg-4">
                  <div>
                      <h2 class="text-center album-title"><a href="?committee=sede-i">SEDE I</a></h2>
                  </div>
              </div>
              <div class="single-album col-xs-12 col-sm-6 col-md-4 col-lg-4">
                  <div>
                      <h2 class="text-center album-title"><a href="?committee=sede-ii">SEDE II</a></h2>
                  </div>
              </div>
          </section>
          <?php else : $representations = json_decode($amsterdam->taskOneByCommittee($_GET['committee'])); dd($representations); ?>
          <section class="single-album">
            <ul id="lightGallery">
                <?php foreach ($pictures->data as $picture) : ?>
                    <?php
                    $size = count($picture->images);
                    $small = $picture->images[$size-2]->source;
                    $large = $picture->images[0]->source;
                    ?>
                    <li data-src="<?php echo $large; ?>"><img src="<?php echo $small; ?>" alt=""/></li>
                <?php endforeach; ?>
            </ul>
          </section>
      <?php endif; ?>
  </div>
</main>

    <script type="text/javascript">
        $(document).ready(function() {
            $("#lightGallery").lightGallery();
        });
    </script>

<?php get_footer(); ?>