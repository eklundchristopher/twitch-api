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
	 * Return a Twitch authentication link.
	 *
	 * @return string
	 */
	public function login()
	{
		return sprintf("%s/oauth2/authorize?%s", $this->app->api, http_build_query([
			'response_type'	 => 'code',
			'client_id'		 => $this->app->client(),
			'redirect_uri'	 => $this->app->redirect(),
			'scope'			 => $this->app->scopes(),
		]));
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

}
