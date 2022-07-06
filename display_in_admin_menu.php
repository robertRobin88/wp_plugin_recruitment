<?php 
function recruitment()
{
    $array_all_id_page = array();
    echo '<div class="recruitment">';
    echo '<p class="rdrTitle">RECRUITMENT</p>';
    echo '<p class="rdrDescription">List of post recruitment:</p>';
    echo '<ul>';
    $args = array(
        'numberposts' => '-1',
        'order' => 'DESC',
        'meta_query' => array(
            array(
                "key" => "recruitment",
                "value" => "true"
            )
        )
    );
    
    $the_query = new WP_Query($args); ?>
    <?php if ($the_query->have_posts()) : ?>
        <?php while ($the_query->have_posts()) : $the_query->the_post();
            $pageID = get_the_ID();

            array_push($array_all_id_page, $pageID);

            set_transient('recruitmentPostCache', $the_query, DAY_IN_SECONDS);
        ?>
            <li id="<?php echo $pageID; ?>">
                <?php the_title(); ?>
                <form method="post">
                    <button name="remove_li" id="<?php echo $pageID; ?>" value="<?php echo $pageID; ?>"> DELETE</button>
                </form>
                <!-- <a href="admin.php?page=recruitment-custome?remove_li" name="remove_li">USUŃ</a> -->
            </li>

        <?php endwhile; ?>
        <?php wp_reset_postdata();


        ?>

    <?php else : ?>
        <p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
    <?php endif; ?>

<?php
    echo '</ul>';
        ?>
    <form method="post">
                    <button name="remove_all_recruitment_post" id="remove_all" value="<?php foreach($array_all_id_page as $idPage) echo $idPage.", "; ?>"> DELETE ALL</button>
    </form>
    <?php
    return $array_all_id_page;

}