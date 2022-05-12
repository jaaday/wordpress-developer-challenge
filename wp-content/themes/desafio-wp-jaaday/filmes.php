<?php get_header(); ?>
<main class="wrap"> 
    <div class="corpo-interno">
		<div class="titulo-section">
            <h2>Filmes</h2>
        </div>
        
		<?php
			$args = array('post_type' => 'videoplay', 'showposts' => 10);
			$loop = get_posts($args);
			if ($loop):
        ?>	

        <section class="content-area">
		
            <?php
            foreach ($loop as $post) : setup_postdata($post);
                ?>

                <div class="cards" style="width: 18rem;">
                    <a href=<?php the_permalink() ?>><img src=<?php the_post_thumbnail_url() ?>></a>
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
                    <div class="cards-body">
                        <h5 class="cards-title"><?php the_title() ?></h5>
                    </div>
                </div>
				<?php endforeach;
			else:
				?>
				<p>Nenhuma postagem</p>
			<?php endif;
			wp_reset_query();
			?>

		</section>
	</div>
</main>
<?php get_footer(); ?>