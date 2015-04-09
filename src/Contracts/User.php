<?php namespace TwitchApi\Contracts;

interface User {

	/**
	 * Create a new instance.
	 *
	 * @param  \TwitchApi\Contracts\Application  $app
	 * @param  \TwitchApi\Contracts\Response  $token
	 * @param  \TwitchApi\Contracts\Response  $user
	 */
	public function __construct(Application $app, Response $token, Response $user);

	/**
	 * Retrieve the Twitch user access token.
	 *
	 * @return string
	 */
	public function accessToken();

	/**
	 * Retrieve the Twitch user refresh token.
	 *
	 * @return string
	 */
	public function refreshToken();

	/**
	 * Retrieve the Twitch user's id.
	 *
	 * @return integer
	 */
	public function id();

	/**
	 * Retrieve the Twitch user's email.
	 *
	 * @return string
	 */
	public function email();

	/**
	 * Retrieve the Twitch user's username.
	 *
	 * @return string
	 */
	public function name();

	/**
	 * Retrieve the Twitch user's display name.
	 *
	 * @return string
	 */
	public function displayname();

	/**
	 * Retrieve the Twitch user's logo.
	 *
	 * @return string
	 */
	public function logo();

	/**
	 * Retrieve the Twitch user's bio.
	 *
	 * @return string
	 */
	public function bio();

	/**
	 * Retrieve the Twitch user's timestamps.
	 *
	 * @return array
	 */
	public function timestamps();

	/**
	 * Retrieve the Twitch user's partner status.
	 *
	 * @return boolean
	 */
	public function isPartnered();

	/**
	 * Check whether the Twitch user is subscribed to a certain channel.
	 *
	 * @param  string  $streamer
	 * @return boolean
	 */
	public function isSubscribed($streamer);

	/**
	 * Check whether the Twitch user is following a certain channel.
	 *
	 * @param  string  $streamer
	 * @return boolean
	 */
	public function isFollowing($streamer);

}
