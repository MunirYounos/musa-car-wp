<?php
$show_compare = get_theme_mod('show_listing_compare', false);

$show_favorite = get_theme_mod('enable_favorite_items', true);

if(stm_is_dealer_two() || stm_is_aircrafts()) $show_favorite = false;

$car_media = stm_get_car_medias(get_the_id());

$asSold = get_post_meta(get_the_ID(), 'car_mark_as_sold', true);

$dynamicClassPhoto = 'stm-car-photos-' . get_the_id() . '-' . rand();
$dynamicClassVideo = 'stm-car-videos-' . get_the_id() . '-' . rand();
?>

<div class="image">

	<!--Hover blocks-->
	<!---Media-->
	<div class="stm-car-medias">
		<?php if(!empty($car_media['car_photos_count'])): ?>
			<div class="stm-listing-photos-unit stm-car-photos-<?php echo get_the_id(); ?> <?php echo esc_attr($dynamicClassPhoto); ?>">
				<i class="stm-service-icon-photo"></i>
				<span><?php echo esc_html($car_media['car_photos_count']); ?></span>
			</div>

			<script type="text/javascript">
				jQuery(document).ready(function(){
					jQuery(".<?php echo esc_attr($dynamicClassPhoto); ?>").on('click', function() {
                        jQuery(this).lightGallery({
                            dynamic: true,
                            dynamicEl: [
                                <?php foreach($car_media['car_photos'] as $car_photo): ?>
                                {
                                    src  : "<?php echo esc_url($car_photo); ?>"
                                },
                                <?php endforeach; ?>
                            ],
                            download: false,
                            mode: 'lg-fade',
                        })
					});
				});

			</script>
		<?php endif; ?>
		<?php if(!empty($car_media['car_videos_count'])): ?>
			<div class="stm-listing-videos-unit stm-car-videos-<?php echo get_the_id(); ?> <?php echo esc_attr($dynamicClassVideo); ?>">
				<i class="fa fa-film"></i>
				<span><?php echo esc_html($car_media['car_videos_count']); ?></span>
			</div>

			<script type="text/javascript">
				jQuery(document).ready(function(){
					jQuery(".<?php echo esc_attr($dynamicClassVideo); ?>").on('click', function() {

                        jQuery(this).lightGallery({
                            selector: 'this',
                            dynamic: true,
                            dynamicEl: [
                                <?php foreach($car_media['car_videos'] as $car_video): ?>
                                {
                                    src : "<?php echo esc_url($car_video); ?>",
                                    thumb: ''
                                },
                                <?php endforeach; ?>
                            ],
                            download: false,
                            mode: 'lg-video',
                        })
					}); //click
				}); //ready

			</script>
		<?php endif; ?>
	</div>
	<!--Compare-->
	<?php if(!empty($show_compare) and $show_compare): ?>
		<div
			class="stm-listing-compare"
			data-id="<?php echo esc_attr(get_the_id()); ?>"
			data-title="<?php echo stm_generate_title_from_slugs(get_the_id(),false); ?>"
			data-toggle="tooltip" data-placement="auto left" title="<?php esc_attr_e('Add to compare', 'motors') ?>">
			<i class="stm-service-icon-compare-new"></i>
		</div>
	<?php endif; ?>

	<!--Favorite-->
	<?php if(!empty($show_favorite) and $show_favorite): ?>
		<div
			class="stm-listing-favorite"
			data-id="<?php echo esc_attr(get_the_id()); ?>"
			data-toggle="tooltip" data-placement="right" title="<?php esc_attr_e('Add to favorites', 'motors') ?>">
			<i class="stm-service-icon-staricon"></i>
		</div>
	<?php endif; ?>

	<a href="<?php the_permalink() ?>" class="rmv_txt_drctn">
		<div class="image-inner">
			<?php get_template_part('partials/listing-cars/listing-directory', 'badges'); ?>
			<?php if(has_post_thumbnail()): ?>
				<?php
                $sizeImg = (stm_is_dealer_two()) ? "stm-img-275-205" : 'stm-img-280-165';
				$imgRetina = (stm_is_dealer_two()) ? 'stm-img-275-205-x-2' : 'stm-img-280-165-x-2';
                $plchldr = (stm_is_dealer_two()) ? "plchldr-275.jpg" : 'plchldr350.png';
                $plchldr = (stm_is_aircrafts()) ? 'ac_plchldr.jpg' : $plchldr;
				$img = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), $sizeImg);
				if(!empty($imgRetina)) {
					$imgX2 = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), $imgRetina);
				}
				?>
				<img
					data-original="<?php echo esc_url(!empty($img[0]) ? $img[0] : get_stylesheet_directory_uri().'/assets/images/' . $plchldr); ?>"
					<?php if(!empty($imgRetina)): ?>
                        srcset="<?php echo esc_url(!empty($img[0]) ? $img[0] : get_stylesheet_directory_uri().'/assets/images/' . $plchldr); ?> 1x, <?php echo esc_url(!empty($imgX2[0]) ? $imgX2[0] : get_stylesheet_directory_uri().'/assets/images/' . $plchldr); ?> 2x"
					<?php endif; ?>
					src="<?php echo esc_url(get_stylesheet_directory_uri().'/assets/images/' . $plchldr); ?>"
					class="lazy img-responsive"
					alt="<?php the_title(); ?>"
				/>
			<?php else :
                $plchldr = (stm_is_dealer_two()) ? "plchldr-275.jpg" : 'plchldr350.png';
                ?>
				<img
					src="<?php echo esc_url(get_stylesheet_directory_uri().'/assets/images/' . $plchldr); ?>"
					class="img-responsive"
					alt="<?php esc_attr_e('Placeholder', 'motors'); ?>"
				/>
			<?php endif; ?>
			<?php if(is_listing() && !empty($asSold)): ?>
				<div class="stm-badge-directory heading-font" <?php echo sanitize_text_field($badge_bg_color); ?>>
					<?php echo esc_html__('Sold', 'motors'); ?>
				</div>
			<?php endif; ?>
		</div>
	</a>
</div>
