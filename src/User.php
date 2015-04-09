<?php namespace TwitchApi;

class User implements Contracts\User {

	/**
	 * Holds the application implementation.
	 *
	 * @var \TwitchApi\Contracts\Application
	 */
	protected $app;

	/**
	 * Holds the Twitch token response.
	 *
	 * @var \TwitchApi\Contracts\Response
	 */
	protected $token;

	/**
	 * Holds the Twitch user response.
	 *
	 * @var \TwitchApi\Contracts\Response
	 */
	protected $user;

	/**
	 * Create a new instance.
	 *
	 * @param  \TwitchApi\Contracts\Application  $app
	 * @param  \TwitchApi\Contracts\Response  $token
	 * @param  \TwitchApi\Contracts\Response  $user
	 */
	public function __construct(Contracts\Application $app, Contracts\Response $token, Contracts\Response $user)
	{
		$this->app = $app;
		$this->token = $token;
		$this->user = $user;
	}

	/**
	 * Retrieve the Twitch user access token.
	 *
	 * @return string
	 */
	public function accessToken()
	{
		return $this->token->access_token;
	}

	/**
	 * Retrieve the Twitch user refresh token.
	 *
	 * @return string
	 */
	public function refreshToken()
	{
		return $this->token->refresh_token;
	}

	/**
	 * Retrieve the Twitch user's id.
	 *
	 * @return integer
	 */
	public function id()
	{
		return $this->user->_id;
	}

	/**
	 * Retrieve the Twitch user's email.
	 *
	 * @return string
	 */
	public function email()
	{
		return $this->user->email;
	}

	/**
	 * Retrieve the Twitch user's username.
	 *
	 * @return string
	 */
	public function name()
	{
		return $this->user->name;
	}

	/**
	 * Retrieve the Twitch user's display name.
	 *
	 * @return string
	 */
	public function displayname()
	{
		return $this->user->display_name;
	}

	/**
	 * Retrieve the Twitch user's logo.
	 *
	 * @return string
	 */
	public function logo()
	{
		return $this->user->logo;
	}

	/**
	 * Retrieve the Twitch user's bio.
	 *
	 * @return string
	 */
	public function bio()
	{
		return $this->user->bio;
	}

	/**
	 * Retrieve the Twitch user's timestamps.
	 *
	 * @return array
	 */
	public function timestamps()
	{
		return [
			'created' => $this->user->created_at,
			'updated' => $this->user->updated_at,
		];
	}

	/**
	 * Retrieve the Twitch user's partner status.
	 *
	 * @return boolean
	 */
	public function isPartnered()
	{
		return $this->user->partnered;
	}

	/**
	 * Check whether the Twitch user is subscribed to a certain channel.
	 *
	 * @param  string  $streamer
	 * @return boolean
	 */
	public function isSubscribed($streamer)
	{
		$endpoint = '/users/'.$this->name().'/subscriptions/'.strtolower($streamer);

		$response = $this->app->request()->get($endpoint, [], [
			'Authorization: OAuth '.$this->accessToken(),
		]);

		return (boolean) $response->created_at;
	}

	/**
	 * Check whether the Twitch user is following a certain channel.
	 *
	 * @param  string  $streamer
	 * @return boolean
	 */
	public function isFollowing($streamer)
	{
		$endpoint = '/users/'.$this->name().'/follows/channels/'.strtolower($streamer);

		$response = $this->app->request()->get($endpoint, [], [
			'Authorization: OAuth '.$this->accessToken(),
		]);

		return (boolean) $response->created_at;
	}

}
