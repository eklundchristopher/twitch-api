<?php namespace TwitchApi;

class User implements Contracts\User {

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

}
