<?php namespace TwitchApi\Contracts;

interface User {

	/**
	 * Create a new instance.
	 *
	 * @param  \TwitchApi\Contracts\Application  $app
	 */
	public function __construct(Application $app);

}
