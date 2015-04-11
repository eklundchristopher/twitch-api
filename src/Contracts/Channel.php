<?php namespace TwitchApi\Contracts;

interface Channel {

	/**
	 * Create a new instance.
	 *
	 * @param  \TwitchApi\Contracts\Application  $app
	 * @param  \TwitchApi\Contracts\User  $user
	 * @param  string  $channel
	 */
	public function __construct(Application $app, User $user, $channel);

	/**
	 * Check whether the Twitch user is following a certain channel.
	 *
	 * @return \TwitchApi\Contracts\Response
	 */
	public function get();

	/**
	 * Check whether the Twitch user is following a certain channel.
	 *
	 * @return \TwitchApi\Contracts\Response
	 */
	public function teams();

	/**
	 * Get all of the emoticons of a certain channel.
	 *
	 * @return \TwitchApi\Contracts\Response
	 */
	public function emoticons();

}
