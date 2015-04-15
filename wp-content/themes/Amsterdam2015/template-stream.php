<?php
/*
Template Name: Stream page
*/
get_header();
?>

<main role="main">
    <div class="container">
        <h1 style="color: white;"><?php echo the_title(); ?></h1>
        <?php if (date() < date('2015-04-15 09:00:00')) : ?>
            <iframe src="http://webcolleges.uva.nl/Mediasite/Play/26ebeb816f654bf1acf570fca1bc75261d" width="1280" height="720" frameborder="0"></iframe>
        <?php elseif(date() < date('2015-04-15 11:35:00')) : ?>
            <iframe src="http://webcolleges.uva.nl/Mediasite/Play/390a07b588b14b308f966afb16bc26531d" width="1280" height="720" frameborder="0"></iframe>
        <?php elseif(date() < date('2015-04-15 14:10:00')) : ?>
            <iframe src="http://webcolleges.uva.nl/Mediasite/Play/6882ee0334554c2fb3bf2afed53d14f01d" width="1280" height="720" frameborder="0"></iframe>
        <?php elseif(date() < date('2015-04-15 17:00:00')) : ?>
            <iframe src="http://webcolleges.uva.nl/Mediasite/Play/f2c05de5485b4b579416345be24c07a61d" width="1280" height="720" frameborder="0"></iframe>
        <?php else : ?>
            <h2>The live streams are over!</h2>
        <?php endif; ?>
    </div>
</main>

<?php get_footer(); ?>