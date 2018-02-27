# Odoo OAuth2-Server support for the PHP League's OAuth 2.0 Client
[![Build Status](https://travis-ci.org/zestsoftware/oauth2-client-odoo.svg?branch=master)](https://travis-ci.org/zestsoftware/oauth2-client-odoo)
This package provides Odoo OAuth 2.0 support for the PHP League's [OAuth 2.0 Client](https://github.com/thephpleague/oauth2-client).

## Installation

To install, use composer:

```
composer require zestsoftware/oauth2-client-odoo
```

## Usage

Usage is the same as The League's OAuth client, using `\ZestSoftware\OAuth2\Client\Provider\Odoo` as the provider.

### Authorization Code Flow

```php

require_once('./vendor/autoload.php');
session_start();

$provider = new \ZestSoftware\OAuth2\Client\Provider\Odoo([
    'clientId'          => '{Odoo-client-id}',
    'clientSecret'      => '{Odoo-client-secret}',
    'redirectUri'       => 'https://example.com/callback-url',
    'baseUrl'           => 'https://example.com',
]);

if (!isset($_GET['code'])) {

    // If we don't have an authorization code then get one
    $authUrl = $provider->getAuthorizationUrl();
    $_SESSION['oauth2state'] = $provider->getState();
    header('Location: '.$authUrl);
    exit;

// Check given state against previously stored one to mitigate CSRF attack
} elseif (empty($_GET['state']) || ($_GET['state'] !== $_SESSION['oauth2state'])) {

    unset($_SESSION['oauth2state']);
    exit('Invalid state');

} else {

    // Try to get an access token (using the authorization code grant)
    $token = $provider->getAccessToken('authorization_code', [
        'code' => $_GET['code']
    ]);

    // Optional: Now you have a token you can look up a users profile data
    try {

        // We got an access token, let's now get the user's details
        $user = $provider->getResourceOwner($token);

        // Use these details to create a new profile
        printf('Hello %s!', $user->getName());

    } catch (Exception $e) {

        // Failed to get user details
        exit('Oh dear...');
    }

    // Use this to interact with an API on the users behalf
    echo $token->getToken();
}

```

## Testing

``` bash
$ ./vendor/bin/phpunit
```

## Contributing

Please see [CONTRIBUTING](https://bitbucket.com/zestsoftware/oauth2-client-odoo/blob/master/CONTRIBUTING.md) for details.

## Credits

- [Jean-Paul Ladage](https://bitbucket.com/zestsoftware/oauth2-client-odoo)
- [All Contributors](https://bitbucket.com/zestsoftware/oauth2-client-odoo/contributors)


## License

The MIT License (MIT). Please see [License File](https://bitbucket.com/zestsoftware/oauth2-client-odoo/blob/master/LICENSE) for more information.

