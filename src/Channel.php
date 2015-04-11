<?php namespace TwitchApi;

class Channel implements Contracts\Channel {

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
	 * @param  \TwitchApi\Contracts\User  $user
	 * @param  string  $channel
	 */
	public function __construct(Contracts\Application $app, Contracts\User $user, $channel)
	{
		$this->app = $app;
		$this->user = $user;
		$this->channel = $channel;
	}

	/**
	 * Get a Twitch channel object.
	 *
	 * @return \TwitchApi\Contracts\Response
	 */
	public function get()
	{
		$endpoint = '/channels/'.$this->channel;

		$response = $this->app->request()->get($endpoint, [], [
			'Authorization: OAuth '.$this->user->accessToken(),
		]);

		return $response;
	}

	/**
	 * Get all the teams that a channel belong to.
	 *
	 * @return \TwitchApi\Contracts\Response
	 */
	public function teams()
	{
		$endpoint = '/channels/'.$this->channel.'/teams';

		$response = $this->app->request()->get($endpoint, [], [
			'Authorization: OAuth '.$this->user->accessToken(),
		]);

		if ( ! isset($response->teams)) return [];

		return $response->teams;
	}

	/**
	 * Get all of the emoticons of a certain channel.
	 *
	 * @return \TwitchApi\Contracts\Response
	 */
	public function emoticons()
	{
		$endpoint = '/chat/'.$this->channel.'/emoticons';

		$response = $this->app->request()->get($endpoint, [], [
			'Authorization: OAuth '.$this->user->accessToken(),
		]);

		return Application::where((array) $response->emoticons, function($key, $value)
		{
			return $value['subscriber_only'];
		});
	}

}
