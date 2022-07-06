<?php 
function rd_add_custom_box()
{
    $screens = ['post', 'rd_cpt'];
    foreach ($screens as $screen) {
        add_meta_box(
            'rd_box_id',                 
            'Recruitment plugin',      
            'rd_custom_box',  
            $screens                           
        );
    }
}

function rd_custom_box($post)
{
    $pageID = get_the_ID();
    $getRecruitmentValue = get_post_meta($pageID, "recruitment", "true");
?>

    <input type="checkbox" name="recruitment_checkbox" id="recruitment_post" <?php echo ($getRecruitmentValue === "true" ? "checked" : ""); ?> class="recruitment_checkbox" value="0"></input>
    <label for="recruitment_post">Check if post is recruitment</label>

<?php
}