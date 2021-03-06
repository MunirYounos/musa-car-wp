<?php
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ) );

if(!empty($title_counter) && $title_counter == 'yes') {
    wp_enqueue_script( 'stm-countUp.min.js' );
}

stm_motors_enqueue_scripts_styles( 'stm_info_box' );

if ( !empty( $box_bg_color ) ) {
    $box_bg_style = 'style=background-color:' . $box_bg_color . ';';
} else {
    $box_bg_style = '';
}

if ( !empty( $image ) ) {
    $image = explode( ',', $image );
    if ( !empty( $image[0] ) ) {
        $image = $image[0];
        $image = wp_get_attachment_image_src( $image, 'full' );
        $image = $image[0];
    }
} else {
    $image = '';
}

if ( !empty( $title_color ) ) {
    $title_color = 'style=color:' . $title_color . ';';
}

$content_class = 'content-' . rand( 0, 9999 );

if ( !empty( $content_color ) ) {
    $content_color_style = 'style=color:' . $content_color . '!important;';
} else {
    $content_color_style = '';
}

$id = rand(9,9999);

?>

    <div class="stm-info-box <?php echo esc_attr( $css_class ); ?>" <?php echo stm_do_lmth( $box_bg_style ); ?>>
        <div class="inner">
            <?php if ( !empty( $image ) ): ?>
                <img src="<?php echo esc_html( $image ); ?>"/>
            <?php endif; ?>
            <?php if ( !empty( $title ) ): ?>
                <div id="stm-ib-counter_<?php echo esc_attr( $id ); ?>" class="title heading-font" <?php echo stm_do_lmth( $title_color ); ?>><?php echo esc_attr( $title ); ?></div>
            <?php endif; ?>
            <?php if ( !empty( $content ) ): ?>
                <div class="content heading-font <?php echo esc_attr( $content_class ); ?>" <?php echo esc_attr( $content_color_style ); ?>>
                    <?php echo wpb_js_remove_wpautop( $content, true ); ?>
                </div>
            <?php endif; ?>
        </div>
    </div>

<?php if ( !empty( $content_color ) ): ?>
    <style type="text/css">
        .stm-service-layout-info-box .inner .content.<?php echo esc_attr($content_class) ?> ul li:before {
            background-color: <?php echo esc_attr($content_color); ?>;
        }
    </style>
<?php endif; ?>

<?php if(!empty($title_counter) && $title_counter == 'yes'): ?>

    <script>
        jQuery(document).ready(function($) {
            var counter_<?php echo esc_attr( $id ); ?> = new countUp("stm-ib-counter_<?php echo esc_attr( $id ); ?>", 0, <?php echo esc_attr( $title ); ?>, 0, 2.5, {
                useEasing : true,
                useGrouping: true,
                separator : ''
            });

            $(window).on('scroll', function(){
                if( $("#stm-ib-counter_<?php echo esc_attr( $id ); ?>").is_on_screen() ){
                    counter_<?php echo esc_attr( $id ); ?>.start();
                }
            });
        });
    </script>
<?php endif; ?>
