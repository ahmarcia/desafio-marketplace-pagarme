<?php
/**
 * @var array $products
 */

include(__DIR__ . '/../Layout/head.php');
?>

<main class="container">
    <section class="movies" id="movies">
        <h2>Fantasias</h2>
        <div class="row">
            <?php foreach ($products as $product): ?>
                <div class="col-lg-3 col-md-4 col-sm-6" style="margin-top: 20px">
                    <article class="card">
                        <header class="title-header text-center" style="min-height: 70px">
                            <h3><?= $product['name'] ?></h3>
                        </header>
                        <div class="card-block">
                            <div class="img-card">
                                <img src="//placehold.it/300x250" alt="Movie" class="w-100" />
                            </div>
                            <p class="tagline card-text text-xs-center"><?= $product['description']?></p>
                            <p class="tagline card-text text-right" style="min-height: 30px">
                                <small><?= !is_null($product['seller']) ? $product['seller']['name'] : '' ?></small>
                            </p>
                            <p class="tagline card-text text-right"><?= 'R$' . $product['price'] / 100 ?></p>
                            <a href="<?= '/cart/add/' . $product['id']?> " class="btn btn-primary btn-block"><i class="fa fa-eye"></i> Adicionar ao carrinho</a>
                        </div>
                    </article>
                </div>
            <?php endforeach; ?>
        </div>
    </section>
</main>


<?php include(__DIR__ . '/../Layout/footer.php'); ?>
'