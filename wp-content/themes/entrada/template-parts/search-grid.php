<?php global $loop;
$average_rating =  entrada_post_average_rating(get_the_ID()); ?>
<article class="col-md-6 col-lg-4 article has-hover-s1 thumb-full">
    <div class="thumbnail" itemscope itemtype="http://schema.org/Product">
        <?php
        $entrada_social_media_share_img =  entrada_social_media_share_img(get_the_ID());
        ?>
        <!--Wrap image inside a href to make image clickable -->
        <a href="<?php the_permalink(); ?>" itemprop="name"> <?php echo entrada_product_resized_img(get_the_ID(), $resize = array(550, 358)); ?> </a>
        <h3 class="small-space"><a href="<?php the_permalink(); ?>" itemprop="name"><?php the_title(); ?></a></h3>
        <span class="info"><?php entrada_product_categories(get_the_ID(), true); ?></span>
        <aside class="meta">
            <?php entrada_destinations_activities_count(get_the_ID(), true); ?>
        </aside>
        <p itemprop="description"><?php echo entrada_truncate(get_the_ID(), 30, 110, 'id'); ?></p>
        <a href="<?php the_permalink(); ?>" class="btn btn-default" itemprop="url"><?php echo get_theme_mod('square_button_text', 'Explore'); ?></a>
        <footer>
            <?php $share_txt  = entrada_truncate(get_the_ID(), 30, 110, 'id'); ?>
            <ul class="social-networks">
                <?php echo entrada_social_media_share_btn(get_the_title(), get_permalink(), $share_txt, $entrada_social_media_share_img); ?>
            </ul>
            <small class="price-prefix"><?php _e('from',  'entrada' ); ?></small>
            <span class="price"><span <?php echo entrada_price_schema_micro_data_link(get_the_ID()); ?>><?php entrada_product_price(get_the_ID(), true); ?></span></span>
        </footer>
    </div>
</article>