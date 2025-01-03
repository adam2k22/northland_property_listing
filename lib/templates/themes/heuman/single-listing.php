<?php
/**
 * The Template for displaying all Easy Property Listings single posts with the Heuman Theme
 *
 * @package EPL
 * @subpackage Templates/Themes/Heuman
 * @since 1.0
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header(); ?>

<section class="content">

	<?php get_template_part( 'inc/page-title' ); ?>

	<div class="pad group">

		<?php
		while ( have_posts() ) :
			the_post();
			?>
			<article <?php post_class(); ?>>
				<div class="post-inner group">

					<h1 class="post-title"><?php the_title(); ?></h1>
					<p class="post-byline"><?php esc_html_e( 'by', 'easy-property-listings' ); ?> <?php wp_kses_post( the_author_posts_link() ); ?> &middot; <?php the_time( get_option( 'date_format' ) ); ?></p>

					<?php do_action( 'epl_property_single' ); ?>

					<div class="clear"></div>

					<div class="entry">
						<div class="entry-inner">
							<?php the_content(); ?>
							<?php
							wp_link_pages(
								array(
									'before' => '<div class="post-pages">' . __( 'Pages:', 'easy-property-listings' ),
									'after'  => '</div>',
								)
							);
							?>
						</div>
						<div class="clear"></div>
					</div><!--/.entry-->

				</div><!--/.post-inner-->
			</article><!--/.post-->
		<?php endwhile; ?>

		<div class="clear"></div>

		<?php the_tags( '<p class="post-tags"><span>' . __( 'Tags:', 'easy-property-listings' ) . '</span> ', '', '</p>' ); ?>

		<?php if ( ( 'off' !== ot_get_option( 'author-bio' ) ) && get_the_author_meta( 'description' ) ) : ?>
			<div class="author-bio">
				<div class="bio-avatar"><?php echo get_avatar( get_the_author_meta( 'user_email' ), '128' ); ?></div>
				<p class="bio-name"><?php the_author_meta( 'display_name' ); ?></p>
				<p class="bio-desc"><?php the_author_meta( 'description' ); ?></p>
				<div class="clear"></div>
			</div>
		<?php endif; ?>

		<?php
		if ( 'content' === ot_get_option( 'post-nav' ) ) {
			get_template_part( 'inc/post-nav' ); }
		?>

		<?php
		if ( 1 !== (int) ot_get_option( 'related-posts' ) ) {
			get_template_part( 'inc/related-posts' ); }
		?>

		<?php comments_template( '/comments.php', true ); ?>

	</div><!--/.pad-->

</section><!--/.content-->

<?php get_sidebar(); ?>

<?php get_footer(); ?>
