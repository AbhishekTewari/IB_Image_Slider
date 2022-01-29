<?php 
    $ib_slider_details = get_option('ib_slider_details', array());
?>
<div class="ib-main-admin-panel-wrapper"> 
    <div class="ib-main-heading">
        <span class="ib-heading-icon-img"><i class="fab fa-slideshare "></i></span>
        <span class="ib-heading-text"><?php esc_html_e('IB - Ideabox Image Slider',' Ib-ideabox_slider'); ?></span>
    </div>
    <div class="ib-main-content-wrapper">
        <div class="ib-add-slider-button">
            <?php if(empty($ib_slider_details))
                {?>
                    <input type="button" class="ib-button" id="ib-add-slider" value="<?php esc_html_e('Add Slider',' Ib-ideabox_slider') ?>">
                    <?php
                }
                else
                {?>      
                    <input type="button" data-name="<?php echo isset($ib_slider_details['ib_name']) ? esc_attr($ib_slider_details['ib_name']) : ""; ?>" class="ib-button" id="ib-add-more-img" value="<?php esc_html_e('Add More Image',' Ib-ideabox_slider') ?>">
                    <div class="ib-shortcode-data">
                        <label class="ib-shortcode-label"><?php esc_html_e('Slider Shortcode :',' Ib-ideabox_slider') ?></label>
                        <input type="text" class="ib-shortcode" value="<?php echo esc_html('[ib_show_slideshow]') ?>" disabled></input>
                        <input type="button" class="ib-copy-button" id="ib-copy-short" value="<?php esc_html_e('copy',' Ib-ideabox_slider') ?>">
                        <span class="ib-tooltiptext"><?php esc_html_e('Copied',' Ib-ideabox_slider') ?></span>
                        <label class="ib-short-mess"><?php esc_html_e('Copy Shortcode and paste where you want to display the slider ',' Ib-ideabox_slider') ?></label>
                    </div>
                    <?php
                }?> 
        </div>
    </div>
    <div class="ib-img-slid-show">
        <div class="owl-carousel owl-theme">
            <?php if(!empty($ib_slider_details) && isset($ib_slider_details['ib_img_ids']))
            {
                foreach($ib_slider_details['ib_img_ids'] as $key => $value)
                {
                ?>    
                    <div class="item ib-slider-img-div my-id<?php echo esc_attr($value) ?>"><img class="ib-slide-img"  src="<?php echo esc_url(wp_get_attachment_url( $value))?>"></div>
                    <?php
                } 
            }?>
        </div>
    </div>
    <div  class="id-image-prev-wrapper">
        <?php if(!empty($ib_slider_details) && isset($ib_slider_details['ib_img_ids']))
        {
            foreach($ib_slider_details['ib_img_ids'] as $key => $value)
            {
                ?>    
                <div class="id-image-prev" data-image_id="<?php echo esc_attr($value)?>">
                    <span class="ib-delete-img" data-img_key="<?php echo esc_attr($key)?>"><i class="fas fa-trash-alt"></i></span>
                    <img class="ib-slide-img"  src="<?php echo esc_url(wp_get_attachment_url( $value))?>">
                </div>
                <?php
            } 
        }?>
    </div>    
</div>

<?php 
	include IB_DIR."admin/partials/popups/ib_add_new_slide.php";
