<?php get_header(); ?>
<main class="wrap">
  <section class="content-area content-full-width">
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
      <article class="article-full">
       <div class="conte-video"> 
	   <div class="cont-duracao">
			<?php
			$duracao = get_post_meta($post->ID, 'tempo-duracao', true);
			if ($duracao) {
				?>
				<p><?php echo $duracao; ?></p> 
				<?php
			} else {
				
			}
			?>
      </div>
	  <header>
          <h2><?php the_title(); ?></h2>
      </header>
	  </div>
	  <div class="cont-video">
		<?php
		$embedv = get_post_meta($post->ID, 'embed-video', true);
		if ($embedv) {
			echo $embedv;
		} else {
			
		}
		?>
      </div>
	  <div class="conte-video"> 
	  <div class="desc-video">
	  <?php the_content(); ?>
	  </div>
	  
	  </div>

      </article>
<?php endwhile; else : ?>
      <article>
        <p>Sorry, no post was found!</p>
      </article>
<?php endif; ?>
  </section>
</main>
<?php get_footer(); ?>