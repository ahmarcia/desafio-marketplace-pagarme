<?php
/**
 * @var array $user
 * @var int   $shipping
 * @var int   $amount
 */

include(__DIR__ . '/../Layout/head.php'); ?>

<div class="container">
    <div class="py-5 text-center">
        <h2>Checkout</h2>
    </div>

    <div class="row">
        <div class="col-md-4 order-md-2 mb-4">
            <h4 class="d-flex justify-content-between align-items-center mb-3">
                <span class="text-muted">Carrinho</span>
                <span class="badge badge-secondary badge-pill"><?= count($user['cart']) ?></span>
            </h4>
            <ul class="list-group mb-3">
                <?php if (count($user['marketplace']) > 0) :
                    foreach ($user['marketplace'] as $product): ?>
                        <li class="list-group-item d-flex justify-content-between lh-condensed">
                            <div>
                                <h6 class="my-0"><?= $product['name'] ?></h6>
                                <small class="text-muted"><?= $product['description'] ?></small>
                            </div>
                            <span class="text-muted">
                                R$ <?= number_format($product['price'] / 100, 2, ',', '') ?>
                            </span>
                        </li>
                    <?php endforeach; ?>
                    <li class="list-group-item d-flex justify-content-between bg-light">
                        <div class="text-success">
                            <h6 class="my-0">Frete</h6>
                        </div>
                        <span class="text-success">
                                R$ <?= number_format($shipping / 100, 2, ',', '') ?>
                        </span>
                    </li>
                <?php endif; ?>

                <?php if (count($user['seller']) > 0) :
                    foreach ($user['seller'] as $seller):
                        foreach ($seller as $product): ?>
                            <li class="list-group-item d-flex justify-content-between lh-condensed">
                                <div>
                                    <h6 class="my-0"><?= $product['name'] ?></h6>
                                    <small class="text-muted"><?= $product['description'] ?></small>
                                </div>
                                <span class="text-muted">
                                    R$ <?= number_format($product['price'] / 100, 2, ',', '') ?>
                                </span>
                            </li>
                        <?php endforeach; ?>
                        <li class="list-group-item d-flex justify-content-between bg-light">
                            <div class="text-success">
                                <h6 class="my-0">Frete</h6>
                                <small>Vendedor: <?= $seller[0]['seller']['name'] ?></small>
                            </div>
                            <span class="text-success">
                                R$ <?= number_format($shipping / 100, 2, ',', '') ?>
                            </span>
                        </li>
                    <?php endforeach;
                endif; ?>
                <li class="list-group-item d-flex justify-content-between">
                    <span>Total (BRL)</span>
                    <strong id="amount">R$ <?= number_format($amount / 100, 2, ',', '') ?></strong>
                </li>
            </ul>
        </div>
        <div class="col-md-8 order-md-1">
            <h4 class="mb-3">Seus dados</h4>
            <form class="needs-validation" method="post" action="/cart/checkout">
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <label for="user-name">Nome</label>
                        <input type="text" class="form-control" id="user-name" name="user[name]" required
                               value="<?= isset($user['name']) ? $user['name'] : '' ?>" >
                        <div class="invalid-feedback">
                            Preencha o campo nome corretamente.
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="user-email">Email</label>
                        <input type="email" class="form-control" id="user-email" name="user[email]"
                               value="<?= isset($user['email']) ? $user['email'] : '' ?>" >
                        <div class="invalid-feedback">
                            Preencha com um e-mail válido.
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="user-document-number">Documento</label>
                        <input type="text" class="form-control" id="user-document-number"
                               name="user[document_number]" required
                               value="<?= isset($user['document_number']) ? $user['document_number'] : '' ?>" >
                        <div class="invalid-feedback">
                            Preencha o CPF corretamente.
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-2 mb-3">
                        <label for="user-phone-ddd">DDD</label>
                        <input type="text" class="form-control" id="user-phone-ddd" name="user[phone][ddd]" required
                               value="<?= isset($user['phone']['ddd']) ? $user['phone']['ddd'] : '' ?>" >
                        <div class="invalid-feedback">
                            Preencha um DDD válido.
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="user-phone-number">Telefone</label>
                        <input type="text" class="form-control" id="user-phone-number" name="user[phone][number]" required
                               value="<?= isset($user['phone']['number']) ? $user['phone']['number'] : '' ?>" >
                        <div class="invalid-feedback">
                            Preencha o número de telefone corretamente.
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="user-birthday">Data de nascimento</label>
                        <input type="text" class="form-control" id="user-birthday" name="user[birthday]" required
                               value="<?= isset($user['birthday']) ? $user['birthday'] : '' ?>" >
                        <div class="invalid-feedback">
                            Preencha a data de nascimento corretamente.
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="user-genre">Sexo</label><br/>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="user[genre]" id="user-genre-f"
                               required <?= isset($user['genre']) && $user['genre'] == 'F' ? 'checked' : '' ?>>
                        <label class="form-check-label" for="user-genre-f">Feminino</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="user[genre]" id="user-genre-m"
                               required <?= isset($user['genre']) && $user['genre'] == 'M' ? 'checked' : '' ?>>
                        <label class="form-check-label" for="user-genre-m">Masculino</label>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="user-address-street">Rua</label>
                    <input type="text" class="form-control" name="user[address][street]" id="user-address-street" required
                           value="<?= isset($user['address']['street']) ? $user['address']['street'] : '' ?>" >
                    <div class="invalid-feedback">
                        Please enter your shipping address.
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="user-address-neighborhood">Bairro</label>
                        <input type="text" class="form-control" name="user[address][neighborhood]" id="user-address-neighborhood" required
                               value="<?= isset($user['address']['neighborhood']) ? $user['address']['neighborhood'] : '' ?>" >
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="user-address-complementary">Complemento</label>
                        <input type="text" class="form-control" name="user[address][complementary]" id="user-address-complementary" required
                               value="<?= isset($user['address']['complementary']) ? $user['address']['complementary'] : '' ?>" >
                    </div>
                    <div class="col-md-2 mb-3">
                        <label for="user-address-street-number">Número</label>
                        <input type="text" class="form-control" name="user[address][street_number]" id="user-address-street-number" required
                               value="<?= isset($user['address']['street_number']) ? $user['address']['street_number'] : '' ?>" >
                        <div class="invalid-feedback">
                            Please enter your shipping address.
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-3 mb-3">
                        <label for="user-address-zipcode">CEP</label>
                        <input type="text" class="form-control" name="user[address][zipcode]" id="user-address-zipcode" required
                               value="<?= isset($user['address']['zipcode']) ? $user['address']['zipcode'] : '' ?>" >
                        <div class="invalid-feedback">
                            Zip code required.
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="user-address-city">Cidade</label>
                        <input type="text" class="form-control" name="user[address][city]" id="user-address-city" required
                               value="<?= isset($user['address']['city']) ? $user['address']['city'] : '' ?>" >

                        <div class="invalid-feedback">
                            Please select a valid country.
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="user-address-country">País</label>
                        <select class="custom-select d-block w-100" name="user[address][country]" id="user-address-country" required>
                            <option value=""></option>
                            <option value="Brasil" <?= isset($user['address']['country']) && $user['address']['country'] == 'Brasil' ? 'selected' : '' ?>>Brasil</option>
                        </select>
                        <div class="invalid-feedback">
                            Please select a valid country.
                        </div>
                    </div>
                    <div class="col-md-2 mb-3">
                        <label for="state">Estado</label>
                        <select class="custom-select d-block w-100" name="user[address][state]" id="state" required>
                            <option value=""></option>
                            <option value="SP" <?= isset($user['address']['state']) && $user['address']['state'] == 'SP' ? 'selected' : '' ?>>SP</option>
                        </select>
                        <div class="invalid-feedback">
                            Please provide a valid state.
                        </div>
                    </div>
                </div>
                <hr class="mb-4">

                <h4 class="mb-3">Pagamento</h4>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="card-name">Nome</label>
                        <input type="text" class="form-control" name="card[name]" id="card-name" value="Marcia Lima" required
                        <small class="text-muted">Nome impresso no cartão</small>
                        <div class="invalid-feedback">
                            Name on card is required
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="card-number">Número do cartão</label>
                        <input type="text" class="form-control" name="card[number]" id="card-number" value="4242424242424242" required>
                        <div class="invalid-feedback">
                            Credit card number is required
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3 mb-3">
                        <label for="card-expiration">Vencimento</label>
                        <input type="text" class="form-control" name="card[expiration]" id="card-expiration" value="10/01" required>
                        <div class="invalid-feedback">
                            Expiration date required
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="card-cvv">CVV</label>
                        <input type="text" class="form-control" name="card[cvv]" id="card-cvv" value="0722" required>
                        <div class="invalid-feedback">
                            Security code required
                        </div>
                    </div>
                </div>
                <hr class="mb-4">
                <?php if ($amount > 0): ?>
                    <button class="btn btn-primary btn-lg btn-block" type="submit">Finalizar pedido</button>
                <?php endif; ?>
            </form>
        </div>
    </div>

    <footer class="my-5 pt-5 text-muted text-center text-small">
        <p class="mb-1">&copy; 2017-2018 Company Name</p>
        <ul class="list-inline">
            <li class="list-inline-item"><a href="#">Privacy</a></li>
            <li class="list-inline-item"><a href="#">Terms</a></li>
            <li class="list-inline-item"><a href="#">Support</a></li>
        </ul>
    </footer>
</div>

<?php include(__DIR__ . '/../Layout/footer.php'); ?>
