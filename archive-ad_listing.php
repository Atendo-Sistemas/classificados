<?php
/**
 * Ad listings Archive template.
 *
 * @package ClassiPress\Templates
 * @author  AppThemes
 * @since   ClassiPress 1.0
 */
?>

<?php get_template_part( 'searchbar' ); ?>

<div id="primary" class="content-area row">

	<div class="columns">

		<?php get_template_part( 'parts/breadcrumbs', app_template_base() ); ?>

	</div>

	<?php if ( 'left' == get_theme_mod( 'listing_archive_sidebar_position', 'right' ) ) { get_sidebar(); } ?>

	<main id="main" class="site-main m-large-8 columns" role="main">

		<section>

			<header class="page-header row columns">
				<h1 class="h4"><?php
					if ( is_search() ) {
						printf( __( '%d %s for "%s"', APP_TD ), $wp_query->found_posts, _n( 'result', 'results', number_format_i18n( $wp_query->found_posts ), APP_TD ), get_search_query() );
					} else {
						echo get_post_type_labels( get_post_type_object( APP_POST_TYPE ) )->all_items;
					}
				?></h1>
				<?php
				$page_num = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
				if ( $wp_query->max_num_pages > 1 ) : ?>
					<div class="page-count pull-right"><?php printf( __( 'Page %1$s of %2$s', APP_TD ), number_format_i18n( $page_num ), number_format_i18n( $wp_query->max_num_pages ) ); ?></div>
				<?php
				endif;
			?>
			</header><!-- .page-header -->

			<?php if ( ! is_search() ) {
				the_archive_description( '<div class="taxonomy-description row columns">', '</div>' );
			} ?>

			<?php
			appthemes_before_loop( get_post_type() );

			if ( have_posts() ) : ?>

				<div class="row small-up-1 medium-up-12 list-view listing-wrap">

				<?php while ( have_posts() ) : the_post(); ?>

					<div class="column">

						<?php appthemes_before_post( get_post_type() ); ?>

						<?php get_template_part( 'parts/content-item', get_post_type() ); ?>

						<?php appthemes_after_post( get_post_type() ); ?>

					</div> <!-- .column -->

				<?php endwhile; ?>

				</div> <!-- .row -->

				<?php cp_do_pagination();

			endif;

			appthemes_after_loop( get_post_type() );
			?>

		</section>

	</main>

	<?php if ( 'right' == get_theme_mod( 'listing_archive_sidebar_position', 'right' ) ) { get_sidebar(); } ?>

</div> <!-- #primary -->
