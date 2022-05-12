<?php get_header(); ?>  
<?php
$args = array('post_type' => 'videoplay', 'showposts' => 1);
$loop = get_posts($args);
if ($loop): foreach ($loop as $post) : setup_postdata($post);
        ?>
        <div class="top-destaque" <?php thumbnail_bg() ?> > 
            <div class="top-filtro"></div>
            <div class="corpo-destaque">

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

                <h1 class="titulo-destaque"><?php the_title() ?></h1>
				<div class="botao-destaque">
					<a href=<?php the_permalink() ?>>Mais informações</a>
				</div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>Nenhuma postagem</p>
<?php endif; ?>
<?php wp_reset_query(); ?>
    </div>
</div>
<main class="wrap"> 
    <?php
    $args = array('post_type' => 'videoplay', 'showposts' => 10);
    $loop = get_posts($args);
    if ($loop):
        ?>	
        <div class="titulo-section">
            <h2>Vídeos da Play</h2>
        </div>
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

</main>
<?php get_footer(); ?>