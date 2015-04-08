<?php namespace TwitchApi\Contracts;

interface Application {

	/**
	 * Create a new instance.
	 *
	 * @param  string  $client
	 * @param  string  $secret
	 * @param  array  $scopes
	 * @param  string  $redirect
	 */
	public function __construct($client, $secret, array $scopes, $redirect);

	/**
	 * Return the request implementation.
	 *
	 * @return \TwitchApi\Contracts\Request
	 */
	public function request();

	/**
	 * Bind a concrete class to an abstract contract.
	 *
	 * @param  string  $abstract
	 * @param  string  $concrete
	 * @return void
	 */
	public function bind($abstract, $concrete);

	/**
	 * Retrieve a concrete class, or instantiate a new one if necessary.
	 *
	 * @param  string  $abstract
	 * @param  array  $parameters  []
	 * @return \StdClass
	 */
	public function instance($abstract, array $parameters = []);

	/**
	 * Instantiate a new concrete class from an abstract contract.
	 *
	 * @param  string  $abstract
	 * @param  array  $parameters  []
	 * @return \StdClass
	 */
	public function make($abstract, array $parameters = []);

	/**
	 * Retrieve the Twitch API url.
	 *
	 * @return string
	 */
	public static function api();

	/**
	 * Retrieve the Twitch application client id.
	 *
	 * @return string
	 */
	public static function client();
	
	/**
	 * Retrieve the Twitch application client secret.
	 *
	 * @return string
	 */
	public static function secret();

	/**
	 * Retrieve the Twitch application scopes.
	 *
	 * @return string
	 */
	public static function scopes();

	/**
	 * Retrieve the Twitch application redirect URI.
	 *
	 * @return string
	 */
	public static function redirect();

}
