<?php
/**
 * Single Property Template: Expanded
 *
 * @package     EPL
 * @subpackage  Templates/ContentListingSingle
 * @copyright   Copyright (c) 2020, Merv Barrett
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       1.0
 * @since       3.5.0 epl_property_tab_section hook is replaced with epl_property_features.
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>

<div id="post-<?php the_ID(); ?>" <?php post_class( 'epl-listing-single epl-property-single view-expanded' ); ?>>
	<div class="entry-header epl-header epl-clearfix">
		<div class="title-meta-wrapper">
			<div class="entry-col epl-property-details property-details">
				<h1 class="entry-title">
					<?php do_action( 'epl_property_heading' ); ?>
				</h1>
				<?php do_action( 'epl_property_address' ); ?>
			</div>

			<div class="entry-col property-pricing-details">
				<div class="epl-property-meta property-meta pricing">
					<h1 class="entry-title">
						<?php do_action( 'epl_property_price' ); ?>
					</h1>
				</div>
				<div class="epl-property-featured-icons property-feature-icons epl-clearfix">
					<?php do_action( 'epl_property_icons' ); ?>
				</div>

			</div>
		</div>
	</div>

	<div class="entry-content epl-content epl-clearfix">

		<?php do_action( 'epl_property_featured_image' ); ?>

		



		<?php do_action( 'epl_buttons_single_property' ); ?>

		<div class="epl-tab-wrapper tab-wrapper">
			<div class="epl-tab-section epl-section-description">
				<h5 class="epl-tab-title">
					<?php
						$title_desc = apply_filters( 'epl_property_tab_title_description', __( 'Description', 'easy-property-listings' ) );
						echo esc_html( $title_desc );
					?>
				</h5>
				<div class="epl-tab-content tab-content">
					<?php
						do_action( 'epl_property_the_content' );
					?>
				</div>
			</div>

			<div class="epl-tab-section epl-section-property-details">
				<h5 class="epl-tab-title">
					<?php
						$title_details = apply_filters( 'property_tab_title', __( 'Property Details', 'easy-property-listings' ) );
						echo esc_html( $title_details );
					?>
				</h5>
				<div class="epl-tab-content tab-content">
					<div class="row">
						<div class="col-6">
							<span class="details-heading">Property Category:</span> <?php do_action( 'epl_property_secondary_heading' ); ?>
						</div>
						<div class="col-6">
							<span class="details-heading">Property Price:</span> <?php do_action( 'epl_property_price_content' ); ?>
						</div>
					</div>
				</div>
				<h5 class="epl-tab-title">
					<?php
						$title_details = apply_filters( 'property_tab_title', __( 'Property Gallery', 'easy-property-listings' ) );
						echo esc_html( $title_details );
					?>
				</h5>
				<?php 
					// Get the gallery field value
					$gallery = get_field('property_gallery'); // Use the field name you created in ACF

					if ($gallery) {
						echo '<div class="property-gallery">';
						$counter = 0; // Initialize a counter to track images
						foreach ($gallery as $image) {
							if ($counter % 4 === 0) {
								// Start a new row after every 4 images
								if ($counter !== 0) {
									echo '</div>'; // Close the previous row
								}
								echo '<div class="gallery-row">'; // Start a new row
							}
							echo '<div class="gallery-item">';
							echo '<img src="' . esc_url($image['url']) . '" alt="' . esc_attr($image['alt']) . '" />';
							echo '</div>';
							$counter++;
						}
						echo '</div>'; // Close the last row
						echo '</div>'; // Close the gallery container
					}
				?>
			</div>
			

			

			<?php do_action( 'epl_property_tab_section_before' ); ?>
			<?php do_action( 'epl_property_tab_section_after' ); ?>

			<?php do_action( 'epl_property_map' ); ?>

			<?php do_action( 'epl_single_extensions' ); ?>

			<?php do_action( 'epl_single_before_author_box' ); ?>
			<?php do_action( 'epl_single_author' ); ?>
			<?php do_action( 'epl_single_after_author_box' ); ?>
		</div>
	</div>
	<!-- categories, tags and comments -->
	<div class="entry-footer epl-footer epl-clearfix">
		<div class="entry-meta">
			<?php
			wp_link_pages(
				array(
					'before'         => '<div class="entry-utility entry-pages">' . __( 'Pages:', 'easy-property-listings' ) . '',
					'after'          => '</div>',
					'next_or_number' => 'number',
				)
			);
			?>
		</div>
	</div>
</div>
<!-- end property -->

<style>
	.entry-title{
		font-size:30px!important;
		font-weight: 700!important;
		line-height: 1.4!important;
		color: #484848!important;
	}
	.details-heading {
		font-size:18px!important;
		font-weight: 700!important;
		line-height: 1.4!important;
		color: #484848!important;
	}

	.entry-image{
		display: flex;
    	justify-content: center;
	}
	.epl-button-wrapper.epl-clearfix {
		display: flex;
    	justify-content: center;
	}
	.epl-button{
		margin: 5px;
	}
	div#secondary {
		display: none;
	}
	.property-gallery {
    display: flex;
    flex-wrap: wrap; /* Allows rows to wrap automatically */
    gap: 16px; /* Adds space between items */
}

.gallery-row {
    display: flex;
    flex-wrap: wrap; /* Ensures items in the row wrap if needed */
    justify-content: space-between; /* Adjusts spacing between items */
    margin-bottom: 16px; /* Adds space between rows */
}

.gallery-item {
    flex: 1 1 calc(25% - 16px); /* Ensures 4 items per row with gap adjustment */
    box-sizing: border-box; /* Includes padding and border in the width calculation */
    max-width: calc(25% - 16px); /* Prevents items from exceeding the row width */
}

.gallery-item img {
    width: 100%;
    height: auto;
    object-fit: cover;
    border-radius: 8px; /* Optional: rounded corners */
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* Optional: shadow for better aesthetics */
}

</style>
