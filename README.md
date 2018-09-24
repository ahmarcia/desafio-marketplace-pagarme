# desafio-marketplace-pagarme
_Desafio de Plataformas: Marketplace_

### Installation

Install the dependencies and devDependencies and start the server.
Open your favorite Terminal and run these commands.

install dependencies via composer:
```sh
$ php composer.phar install --prefer-dist
```

Init settings:
```sh
$ php composer.phar config-settings
```

__Config settings__

Edit file /config/settings.php.

```sh
// Config SDK PagarMe
'pagarMe' => [
    'api_key' => 'INSERT_API_KEY_PAGARME',
    'code_splits' => [
        1 => 'RECIPIENT_SELLER_CLIENT_ONE',
        2 => 'RECIPIENT_SELLER_CLIENT_TWO'
    ],
    'recipient' => 'INSERT_RECIPIENT_MARKETPLACE'
]
```

### Docker
By default, the Docker will expose port 8080, so change this within the Dockerfile if necessary. When ready, simply use the Dockerfile to build the image.

```sh
$ php composer.phar docker-up
```

Verify the deployment by navigating to your server address in your preferred browser.

```sh
http://127.0.0.1/catalog
```

### Additional Information

Check the Trello here: [Desafio de Plataformas: Marketplace](https://trello.com/b/QNVEmWaW/desafio-de-plataformas-marketplace)

