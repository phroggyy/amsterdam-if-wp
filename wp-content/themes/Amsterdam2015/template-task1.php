<?php
/*
Template Name: Representations page
*/
get_header();

$apiKey = 'lC7UO1LW75kSeyhaHfFB9IMnTuZPn9fdBtDTSTbcX76k1oLXdMp3ZvVFYdv5';
$apiSecret = '1svooKg0SCigJ2pPG3RnfIWpJwlqzesiaEmV76iCnbAZwOBONOqg9JVnKQNM';
$amsterdam = new AmsterdamAPI($apiKey, $apiSecret);


?>

<main role="main">
  <div class="container">
      <?php if (!isset($_GET['committee'])) : ?>
          <section class="albums">
              <?php foreach($albums as $album) { ?>
                  <?php $bgPic = $fb->curl_get($album->cover_photo . '?fields=source'); $bgUrl = $bgPic->source; ?>
                  <div class="single-album col-xs-12 col-sm-6 col-md-4 col-lg-4">
                      <div style="background-image: url(<?php echo $bgUrl; ?>);">
                          <h2 class="text-center album-title"><a href="?album=<?php echo $album->id; ?>"><?php echo $album->name; ?></a></h2>
                      </div>
                  </div>
              <?php } ?>
          </section>
          <?php else : $representations = $amsterdam->taskOneByCommittee($_GET['committee']); dd($representations); ?>
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