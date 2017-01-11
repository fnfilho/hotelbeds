<?php namespace StayForLong\HotelBeds;

final class ServiceLocationList
{
	private $request;

	/**
	 * @param ServiceRequest $request
	 * @param array $api_params
	 * @param string $location_type
	 * @throws ServiceLocationListException
	 */
	public function __construct(ServiceRequest $request, $location_type)
	{
		try {
			$this->request = $request
				->setOptions("locations")
				->setOptions($location_type);
		} catch (ServiceRequestException $e) {
			throw new ServiceLocationListException($e->getMessage());
		}
	}

	public function __invoke()
	{
		try {
			$response = $this->request
				->send()
				->getBody();

			return json_decode(response, true);
		} catch (ServiceRequestException $e) {
			throw new ServiceLocationListException($e->getMessage());
		}
	}
}

class ServiceLocationListException extends \ErrorException
{
}