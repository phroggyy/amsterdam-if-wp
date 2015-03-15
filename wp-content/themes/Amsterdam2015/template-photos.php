<?php
/*
Template Name: Photos page
*/
get_header();
?>

<?php
include 'class.graphAPI.php';

$appId = '691603967627532';
$appSecret = 'cad123459bbf0188d20b53d077da412b';

$fb = new graphAPI($appId, $appSecret);
$obj = $fb->curl_get('amsterdam2015/albums?fields=id,name,description,link,cover_photo,count');
$albums = $obj->data;
?>
<main role="main">
  <div class="container">
      <?php if (!isset($_GET['album'])) : ?>
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
          <?php else : ?>
          <section class="single-album">
            <ul id="lightGallery">
                <?php $pictures = $fb->curl_get($_GET['album'] . '/photos?fields=images'); ?>
                <?php foreach ($pictures->data as $picture) : ?>
                    <?php
                    $size = count($picture->images);
                    $small = $picture->images[$size-2]->source;
                    $large = $picture->images[0]->source;
                    ?>
                    <li class="col-md-3 col-xs-6" data-src="<?php echo $large; ?>"><img src="<?php echo $small; ?>" alt=""/></li>
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