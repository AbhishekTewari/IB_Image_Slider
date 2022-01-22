<?php 
    $ib_slider_details = get_option('ib_slider_details');
    $ib_image_is = isset($ib_slider_details['ib_img_ids']) ? $ib_slider_details['ib_img_ids']: array();

    if(!empty($ib_image_is))
    {   ?>
        <div class="ib-slider-main-wrapper">
            <div class="ib-slider-carousel">
                <?php  
                foreach($ib_image_is as $key => $value)
                {?>
                    <div><img src="<?php echo esc_url(wp_get_attachment_url( $value))?>"></div>
                    <?php 
                }?>
            </div>
        </div>
<?php }
?>