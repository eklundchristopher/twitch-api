<?php namespace TwitchApi;

class Authenticator implements Contracts\Authenticator {

	/**
	 * Holds the application implementation.
	 *
	 * @var \TwitchApi\Contracts\Application
	 */
	protected $app;

	/**
	 * Create a new instance.
	 *
	 * @param  \TwitchApi\Contracts\Application  $app
	 */
	public function __construct(Contracts\Application $app)
	{
		$this->app = $app;
	}

	/**
	 * Attempt to authenticate the user.
	 *
	 * @return boolean
	 */
	public function authenticate()
	{
		if ( ! isset($_REQUEST['code'])) return false;

		$token = $this->app->request()->post('/oauth2/token', [
			'client_id'		 => $this->app->client(),
			'client_secret'	 => $this->app->secret(),
			'grant_type'	 => 'authorization_code',
			'redirect_uri'	 => $this->app->redirect(),
			'code'			 => $_REQUEST['code'],
		]);

		if ($token->error) return false;

		$user = $this->app->request()->get('/user', [], [
			'Authorization: OAuth '.$token->access_token,
		]);

		if ($user->error) return false;

		return $this->app->instance('TwitchApi\Contracts\User', [
			$token, $user
		]);
	}

	/**
	 * Retrieve the user implementation.
	 *
	 * @return \TwitchApi\Contracts\User
	 */
	public function user()
	{
		return $this->app->instance('TwitchApi\Contracts\User');
	}

	/**
	 * Create a channel instance.
	 *
	 * @param  string  $channel
	 * @return \TwitchApi\Contracts\Channel
	 */
	public function channel($channel)
	{
		return $this->app->make('TwitchApi\Contracts\Channel', [$this->user(), $channel]);
	}

	/**
	 * Return a Twitch authentication URL.
	 *
	 * @param  string  $client
	 * @param  string  $redirect
	 * @param  string  $scopes
	 * @return string
	 */
	public static function url($client = null, $redirect = null, $scopes = null)
	{
		return sprintf("%s/oauth2/authorize?%s", Application::api(), http_build_query([
			'response_type'	 => 'code',
			'client_id'		 => $client ?: Application::client(),
			'redirect_uri'	 => $redirect ?: Application::redirect(),
			'scope'			 => $scopes ?: Application::scopes(),
		]));
	}

}
