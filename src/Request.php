<?php namespace TwitchApi;

class Request implements Contracts\Request {

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

	/**
	 * Send a HTTP GET request to a specific endpoint.
	 *
	 * @param  string  $endpoint
	 * @param  array  $parameters  []
	 * @param  array  $headers  []
	 * @return \TwitchApi\Response
	 */
	public function get($endpoint, array $parameters = [], array $headers = [])
	{
		return $this->request('GET', $endpoint, $parameters, $headers);
	}

	/**
	 * Send a HTTP POST request to a specific endpoint.
	 *
	 * @param  string  $endpoint
	 * @param  array  $parameters  []
	 * @param  array  $headers  []
	 * @return \TwitchApi\Response
	 */
	public function post($endpoint, array $parameters = [], array $headers = [])
	{
		return $this->request('POST', $endpoint, $parameters, $headers);
	}

	/**
	 * Send a HTTP GET request to a specific endpoint.
	 *
	 * @param  string  $endpoint
	 * @param  array  $parameters  []
	 * @param  array  $headers  []
	 * @return \TwitchApi\Contracts\Response
	 */
	private function request($method, $endpoint, array $parameters = [], array $headers = [])
	{
		$request = curl_init($endpoint = Application::api().$endpoint);

		curl_setopt($request, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($request, CURLOPT_SSL_VERIFYPEER, (boolean) $this->app->verifypeer);

		if (strtoupper($method) === 'POST') curl_setopt($request, CURLOPT_POST, true);

		if ( ! empty($parameters)) curl_setopt($request, CURLOPT_POSTFIELDS, $parameters);

		$headers = array_merge($headers, array_filter([
			$this->app->v3 ? 'Accept: application/vnd.twitchtv.v3+json' : null,
			'Client-ID: '.Application::client(),
		]));

		curl_setopt($request, CURLOPT_HTTPHEADER, $headers);

		$response = curl_exec($request);

		curl_close($request);

		return $this->app->make('TwitchApi\Contracts\Response', [
			$response,
			[
				'method'	 => $method,
				'endpoint'	 => $endpoint,
				'parameters' => $parameters,
				'headers'	 => $headers,
			],
		]);
	}

}
