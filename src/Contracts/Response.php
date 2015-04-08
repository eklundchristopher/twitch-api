<?php namespace TwitchApi\Contracts;

interface Response {

	/**
	 * Create a new instance.
	 *
	 * @param  \TwitchApi\Contracts\Application  $app
	 * @param  string  $response
	 * @param  array  $request
	 */
	public function __construct(Application $app, $response, $request);

	/**
	 * Get a response attribute.
	 *
	 * @param  string  $property
	 * @return mixed
	 */
	public function __get($property);

}
