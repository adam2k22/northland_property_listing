<?php
/**
 * Listing Search Shortcode Default View
 *
 * @package     EPL
 * @subpackage  Templates/Shortcodes/ListingSearch/Default
 * @copyright   Copyright (c) 2020, Merv Barrett
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       3.0
 * @since       3.4.0 Security fixes as per WP standards
 * @since       3.4.1 Fixed search templates error : ignoring field added via filters
 * @since       3.5 Each shortcode now will have unique instance ID & each tab a unique tab ID.
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// phpcs:disable WordPress.Security.NonceVerification

/**
 * Listing Search Shortcode Default View
 *
 * @var array  $atts    Shortcode attributes.
 */
foreach ( $atts as $atts_key => $atts_val ) {

	if ( is_array( $atts_val ) ) {
		$atts_val = epl_array_map_recursive( 'sanitize_text_field', $atts_val );
	} else {
		${$atts_key} = sanitize_text_field( $atts_val );
	}
}

$selected_post_types = $atts['post_type'];
$get_data            = epl_array_map_recursive( 'sanitize_text_field', $_GET );
/** Overwrite Atts with Get data, if set */

foreach ( $get_data as $get_key => $get_val ) {

	if ( ! empty( $get_data[ $get_key ] ) ) {
		${$get_key} = $get_val;
	}
}

$queried_post_type = isset( $get_data['post_type'] ) ? $get_data['post_type'] : '';

if ( ! is_array( $selected_post_types ) ) {
	$selected_post_types = explode( ',', $selected_post_types );
	$selected_post_types = array_map( 'trim', $selected_post_types );
}

global $epl_settings;

$global_counters = array();
$tabcounter      = 1;
?>
<div data-instance-id="<?php echo esc_attr( $atts['instance_id'] ); ?>" id="epl-search-container-instance-<?php echo esc_attr( $atts['instance_id'] ); ?>" class="epl-search-container">
	<?php
	if ( ! empty( $selected_post_types ) ) :
		if ( count( $selected_post_types ) > 1 ) :
			echo "<ul class='epl-search-tabs property_search-tabs epl-search-" . esc_attr( $style ) . "'>";
			foreach ( $selected_post_types as $post_type ) : // phpcs:ignore WordPress.WP.GlobalVariablesOverride

				$global_tab_counter             = epl_generate_unique_tab_counter();
				$global_counters[ $tabcounter ] = $global_tab_counter;

				if ( isset( $get_data['action'] ) && 'epl_search' === $get_data['action'] ) {
					if ( $queried_post_type === $post_type ) {
						$is_sb_current = 'epl-sb-current';
					} else {
						$is_sb_current = '';
					}
				} else {
					$is_sb_current = 1 === $tabcounter ? 'epl-sb-current' : '';
				}
				$post_type_label = isset( $epl_settings[ 'widget_label_' . $post_type ] ) ? $epl_settings[ 'widget_label_' . $post_type ] : $post_type;

				if ( empty( $post_type ) ) {
					$post_type_label = epl_get_option( 'widget_label_all', 'All' );
				}
				echo '<li data-tab="epl_ps_tab_' . esc_attr( $global_counters[ $tabcounter ] ) . '" class="tab-link ' . esc_attr( $is_sb_current ) . '">' . esc_attr( $post_type_label ) . '</li>';
				$tabcounter++;

			endforeach;
			echo '</ul>';
		endif;
		?>
		<div class="epl-search-forms-wrapper epl-search-<?php echo esc_attr( $style ); ?>">
		<?php
		$tabcounter = 1; // reset tab counter.

		foreach ( $selected_post_types as $post_type ) : // phpcs:ignore WordPress.WP.GlobalVariablesOverride

			if ( isset( $get_data['action'] ) && 'epl_search' === $get_data['action'] ) {
				if ( $queried_post_type === $post_type ) {
					$is_sb_current = 'epl-sb-current';
				} else {
					$is_sb_current = '';
				}
			} else {
				$is_sb_current = 1 === $tabcounter ? 'epl-sb-current' : '';
			}
			?>
			<div class="epl-search-form <?php echo esc_attr( $is_sb_current ); ?>" id="epl_ps_tab_<?php echo isset( $global_counters[ $tabcounter ] ) ? esc_attr( $global_counters[ $tabcounter ] ) : 1; ?>">
			<?php
			if ( isset( $show_title ) && 'true' === $show_title ) {
				if ( ! empty( $title ) ) {
					?>
					<h3><?php echo esc_html( $title ); ?></h3>
					<?php
				}
			}
			?>
			<form method="get" style="display: flex; align-items: center;" action="<?php echo esc_url( home_url( '/' ) ); ?>">
				<input type="hidden" name="action" value="epl_search" />
				<?php
					$epl_frontend_fields = epl_search_widget_fields_frontend( $post_type, $property_status );
				foreach ( $epl_frontend_fields as &$epl_frontend_field ) {

					if ( 'property_status' === $epl_frontend_field['key'] && 'on' === $show_property_status_frontend ) {
						$epl_frontend_field['type']   = 'select';
						$epl_frontend_field['config'] = 'on';
					}

					if ( 'search_house_category' === $epl_frontend_field['key'] && isset( $house_category_multiple ) && 'on' === $house_category_multiple ) {
						$epl_frontend_field['type']  = 'multiple_select';
						$epl_frontend_field['query'] = array(
							'query'   => 'meta',
							'compare' => 'IN',
						);
					}

					$config = isset( ${$epl_frontend_field['key']} ) ? ${$epl_frontend_field['key']} : '';
					if ( empty( $config ) && isset( $epl_frontend_field['config'] ) ) {
						$config = $epl_frontend_field['config'];
					}
					$value = isset( ${$epl_frontend_field['meta_key']} ) ? ${$epl_frontend_field['meta_key']} : '';
					epl_widget_render_frontend_fields( $epl_frontend_field, $config, $value, $post_type, $property_status );
				}
				?>
					<div class="epl-search-submit-row epl-search-submit property-type-search">
						<input type="submit" value="<?php echo ! empty( $submit_label ) ? esc_attr( $submit_label ) : esc_html__( 'Search', 'easy-property-listings' ); ?>" class="epl-search-btn" />
					</div>
					<input type="hidden" name="instance_id" value="<?php echo esc_attr( $atts['instance_id'] ); ?>">
					<input type="hidden" name="form_tab" value="<?php echo isset( $global_counters[ $tabcounter ] ) ? esc_attr( $global_counters[ $tabcounter ] ) : 1; ?>">
				</form>
				</div>
			<?php
			$tabcounter++;
		endforeach;
		?>
		</div>
	<?php endif; ?>
</div>

<style>
	.epl-search-forms-wrapper.epl-search-default{
		max-width: 100%!important;
	}
	.epl-search-form .epl-search-submit-row{
		margin-top: 30px!important;
		width: 40%;
	}
	input.epl-search-btn{
		padding: 8px;
    	border-radius: 10px;
		background-color: #f8d082;
		color: #000;
		font-weight: 900;
	}
	.epl-search-form .in-field{
		border-radius: 10px!important;
	}
	.epl-search-row.epl-search-row-select.epl-property_category.fm-block.epl-search-row-full{
		Width:50%;
	}
	.epl-search-row.epl-search-row-select.epl-property_location.fm-block.epl-search-row-full{
		Width:50%;
	}
	form {
	display: flex;
	flex-wrap: wrap; /* Allows wrapping of rows */
	justify-content: center; /* Centers the content horizontally */
	align-items: center; /* Centers the content vertically */
	gap: 0.2rem; /* Adds space between elements */
	}

	.epl-search-row {
	flex: 1 1 100%; /* Full width for each row by default */
	}

	.epl-search-row.epl-property_category,
	.epl-search-row.epl-property_location {
	flex: 1; /* Take equal space for category and location */
	}

	.epl-search-submit-row {
	flex: 0 0 auto; /* Keep the button from stretching */
	align-self: flex-start; /* Align the button to the top */
	}

	.epl-search-btn {
	margin-left: auto; /* Pushes the button to the right */
	display: block;
	}

</style>
