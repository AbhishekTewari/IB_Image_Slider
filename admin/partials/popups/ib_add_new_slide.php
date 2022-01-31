<!-- 
    * popup section html.
    * Add new images to slider.
    * create new slider.
-->

<div class="ib-add-slider-modal">
    <div class="ib-modal-dialog">
        <div class="ib-modal-content">
            <div class="ib-modal-header">
                <?php esc_html_e( 'Add New Slider Detail', ' Ib-ideabox_slider' ); ?>
                <span><i class="fas fa-times ib-close-modal" aria-hidden="true"></i></span>
            </div>
            <div class="ib-modal-body">
                <div>
                    <div>
                        <label for="ib-slider-name" class="ib-lables" ><?php esc_html_e( 'Slider Name', 'Ib-ideabox_slider' ); ?></label>
                        <input type="text" class="ib-slider-name ib-input" placeholder="<?php esc_html_e( 'Enter Slider Name', ' Ib-ideabox_slider' ); ?>" />
                    </div>
                    <div>
                        <input type="button" class="ib-button " id="ib-add-images" value="<?php esc_html_e( 'Add Images', ' Ib-ideabox_slider' ); ?>">
                    </div>
                </div>
                <!-- add image html through jquery -->
                <div class="ib-display-images">

                </div>
                <div class="ib-modal-footer">
                    <input type="button" class="ib-button ib-save-slider-setting" value="<?php esc_html_e( 'Save', ' Ib-ideabox_slider' ); ?>">
                </div>
            </div>
        </div>
    </div>
</div>
