<?php namespace TwitchApi;

class Response {

	/**
	 * Holds the original request and response data.
	 *
	 * @var array
	 */
	protected $original;

	/**
	 * Holds all the response attributes.
	 *
	 * @var array
	 */
	protected $attributes;

	/**
	 * Create a new instance.
	 *
	 * @param  \TwitchApi\Contracts\Application  $app
	 * @param  string  $response
	 * @param  array  $request
	 */
	public function __construct(Contracts\Application $app, $response, $request)
	{
		$this->original = [
			'request'	 => $request,
			'response'	 => $response,
		];

		$this->attributes = json_decode($response, true);

		if (empty($this->attributes))
		{
			$this->attributes['error'] = 'Not Found';
			$this->attributes['status'] = 404;
			$this->attributes['message'] = 'Invalid API endpoint.';
		}
	}

	/**
	 * Get a response attribute.
	 *
	 * @param  string  $property
	 * @return mixed
	 */
	public function __get($property)
	{
		if ( ! array_key_exists($property, $this->attributes))
		{
			return null;
		}

		return $this->attributes[$property];
	}

}
