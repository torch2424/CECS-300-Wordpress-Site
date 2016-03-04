<!--Loop to return only published games to us -->

<!-- Create our Media (Trailers, and Screenshots) query -->
<?php

	//Query for our custom posts
	$customPosts = new WP_Query( array(
		'post_type' => array('trailer', 'screenshot')
	));
	?>

<!-- Loop! -->
<?php if ($customPosts -> have_posts()):
		while ($customPosts -> have_posts()) : $customPosts -> the_post() ?>

		<!-- Automatically create the Header -->
		<article id="article-<?php the_ID() ?>" class="article">

			<header class="article-header">

				<?php if (has_post_thumbnail()): ?>
					<div class="featured-image center">
						<?php the_post_thumbnail() ?>
					</div>
				<?php endif; ?>

				<h1 class="article-title center">

						<a href="<?php the_permalink() ?>" title="<?php the_title_attribute() ?>">
							<?php the_title() ?>
						</a>
				</h1>

				<div class="article-info center">

					<!-- Post Categories -->
					<?php if (has_category()): ?>
						<?php the_category( ", " ); ?>
						<br>
					<?php endif; ?>


					<span class="date">
						<?php the_date('F j, Y') ?>
					</span>
				</div>
			</header>

		<!-- Screenshots -->
		<?php if(get_post_type() == 'screenshot'):?>

				<div class="article-content">

					<!-- The editor content -->
					<?php (is_single()) ? the_content() : the_excerpt() ?>

					<!-- Display the screenshots here -->
					<?php
					echo types_render_field( "screenshot-image",
					array( "alt" => "Screenshot",
					"class" => "screenShot",
					"proportional" => "true" ) )
					?>

				</div>

		<!-- Trailers -->
		<?php elseif(get_post_type() == 'trailer'):?>

				<div class="article-content">

					<!-- The editor content -->
					<?php (is_single()) ? the_content() : the_excerpt() ?>

					<!-- Display the trailer here -->
					<div class = "trailerVideo">
						<?php
						echo types_render_field("trailer-video")
						?>
					</div>

				</div>

		<?php  endif; ?>

		<!--End the article tag -->
		</article>


	<hr />

	<?php endwhile; ?>

<?php else: ?>
	<p>Nothing matches your query.</p>
<?php  endif; ?>
