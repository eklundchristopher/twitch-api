## TwitchApi\Application
This class implements the `\TwitchApi\Contracts\Application` contract.

The entire API revolves around the `Application` object.

```php
$twitch = new TwitchApi\Application('client', 'secret', ['scopes'], 'redirect');
```

`client` is your Twitch application client id.

`secret` is your Twitch application client secret (_do not share this with anyone_).

`scopes` is an array of Twitch scopes.

`redirect` is the Twitch application redirect url.

Below is an example of how this might look in a production environment.

```php
$twitch = new TwitchApi\Application(
	'3nyv5fcqdpg8uakewz6mj27r49xhbs',
	'aqdrje795sh4nm2fk8btpwuvy3cg6z',
	['user_read', 'user_subscriptions'],
	'https://www.domain.tld/authenticate',
);
```

### Class Methods

| Visibility | Method | Arguments | Return |
|--------------:|-------------|--------------------------------------------------------------|------------------------------|
| public | __construct | string $client string $secret array $scopes string $redirect | void |
| public | request | - | \TwitchApi\Contracts\Request |
| public | bind | string $abstract, string $concrete | void |
| public | instance | string $abstract, array $parameters [] | \StdClass |
| public | make | string $abstract, array $parameters [] | \StdClass |
| private | instantiate | string $concrete, array $parameters | \StdClass |
| public static | api | - | string |
| public static | client | - | string |
| public static | secret | - | string |
| public static | scopes | - | string |
| public static | redirect | - | string |

## TwitchApi\Authenticator
This class implements the `\TwitchApi\Contracts\Authenticator` contract.

```php
$auth = new TwitchApi\Authenticator($twitch);
```

### Class Methods

| Visibility | Method | Arguments | Return |
|--------------:|--------------|-----------------------------------------------------------------|---------------------------|
| public | __construct | \TwitchApi\Contracts\Application $app | void |
| public | authenticate | - | boolean |
| public | user | - | \TwitchApi\Contracts\User |
| public static | url | string $client null, string $redirect null, string $scopes null | string |

## TwitchApi\User
This class implements the `\TwitchApi\Contracts\User` contract.

### Class Methods

| Visibility | Method | Arguments | Return |
|-----------:|--------------|------------------------------------------------------------------------------------------------------------------|---------|
| public | __construct | \TwitchApi\Contracts\Application $app, \TwitchApi\Contracts\Response $token, \TwitchApi\Contracts\Response $user | void |
| public | accessToken | - | string |
| public | refreshToken | - | string |
| public | id | - | integer |
| public | email | - | string |
| public | name | - | string |
| public | displayname | - | string |
| public | logo | - | string |
| public | bio | - | string |
| public | timestamps | - | array |
| public | isPartnered | - | boolean |
| public | subscribesTo | string $streamer | boolean |

## TwitchApi\Request
This class implements the `\TwitchApi\Contracts\Request` contract.

### Class Methods

| Visibility | Method | Arguments | Return |
|-----------:|-------------|-----------------------------------------------------------|------------------------------|
| public | __construct | \TwitchApi\Contracts\Application $app | void |
| public | get | string $endpoint, array $parameters [], array $headers [] | \TwitchApi\Contract\Response |
| public | post | string $endpoint, array $parameters [], array $headers [] | \TwitchApi\Contract\Response |

## TwitchApi\Response
This class implements the `\TwitchApi\Contracts\Response` contract.

### Class Methods

| Visibility | Method | Arguments | Return |
|-----------:|-------------|-------------------------------------------------------------------------|--------|
| public | __construct | \TwitchApi\Contracts\Application $app, string $response, array $request | void |
| public | __get | string $property | mixed |