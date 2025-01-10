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
			</div>

			

			<?php do_action( 'epl_property_tab_section_before' ); ?>
			<?php do_action( 'epl_property_tab_section_after' ); ?>

			<?php do_action( 'epl_property_gallery' ); ?>

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
</style>
