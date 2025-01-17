<?php
/**
 * Loop Property Template: Default
 *
 * @package     EPL
 * @subpackage  Templates/LoopListingBlogDefault
 * @copyright   Copyright (c) 2019, Merv Barrett
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       1.0
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $property;
?>

<div id="post-<?php the_ID(); ?>" <?php post_class( 'epl-listing-post epl-property-blog epl-clearfix' ); ?> <?php do_action( 'epl_archive_listing_atts' ); ?>>
	<div class="epl-property-blog-entry-wrapper epl-clearfix">
		<?php do_action( 'epl_property_before_content' ); ?>
			<?php if ( has_post_thumbnail() ) : ?>
				<div class="property-box property-box-left property-featured-image-wrapper">
					<?php do_action( 'epl_property_archive_featured_image' ); ?>
					<div class="price-overlay">
						<?php do_action( 'epl_property_price' ); ?>
					</div>
					<!-- Home Open -->
					<?php do_action( 'epl_property_inspection_times' ); ?>
				</div>
			<?php endif; ?>

			<div class="property-box property-box-right property-content">
				<!-- Heading -->
				<h3 class="entry-title"><a href="<?php the_permalink(); ?>"><?php do_action( 'epl_property_heading' ); ?></a></h3>
				<div class="entry-content">
					<?php epl_the_excerpt(); ?>
				</div>
				<!-- Address -->
				<div class="property-address">
					<a href="<?php the_permalink(); ?>">
						<?php do_action( 'epl_property_address' ); ?>
					</a>
				</div>
				<!-- Property Featured Icons -->
				<div class="property-feature-icons">
					<?php do_action( 'epl_property_icons' ); ?>
				</div>
				<!-- Price -->
				<div class="price">
					<?php do_action( 'epl_property_price' ); ?>
				</div>
			</div>
		<?php do_action( 'epl_property_after_content' ); ?>
	</div>
</div>

<style>
	.epl-property-blog .entry-title a{
		font-weight: 900;
		font-size: 20px;
	}
	.epl-property-blog .entry-title{
		line-height: 1.7!important;
	}
	.epl-property-blog a{
		font-size: 15px;
		font-weight: 800;
	}
	span.page-price{
		font-size: 20px;
		font-weight: 900;
		color: #000;
	}
	.price-overlay {
		position: absolute;
		top: 20px;
		right: 10px;
		background: #ffeeee7a;
		padding: 7px;
		border-radius: 5px;
	}
	.epl-property-blog .price{
		margin-top: 10px;
	}
	.epl-property-blog .property-address{
		line-height: 1.7!important;
	}
</style>