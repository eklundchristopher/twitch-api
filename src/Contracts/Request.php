<?php namespace TwitchApi\Contracts;

interface Request {

	/**
	 * Create a new instance.
	 *
	 * @param  \TwitchApi\Contracts\Application  $app
	 */
	public function __construct(Application $app);

	/**
	 * Send a HTTP GET request to a specific endpoint.
	 *
	 * @param  string  $endpoint
	 * @param  array  $parameters  []
	 * @param  array  $headers  []
	 * @return \TwitchApi\Response
	 */
	public function get($endpoint, array $parameters = [], array $headers = []);

	/**
	 * Send a HTTP POST request to a specific endpoint.
	 *
	 * @param  string  $endpoint
	 * @param  array  $parameters  []
	 * @param  array  $headers  []
	 * @return \TwitchApi\Response
	 */
	public function post($endpoint, array $parameters = [], array $headers = []);

}
