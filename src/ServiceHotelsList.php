<?php

namespace StayForLong\HotelBeds;

final class ServiceHotelsList
{
	private $request;

	/**
	 * @param ServiceRequest $request
	 */
	public function __construct(ServiceRequest $request)
	{
		$this->request = $request->setOptions("hotels");
	}

	public function __invoke()
	{
		try {
			$response = $this->request
				->send()
				->getBody();

			return json_decode($response, true);
		} catch (ServiceRequestException $e) {
			throw new ServiceHotelsListException($e->getMessage());
		}
	}
}

class ServiceHotelsListException extends \ErrorException
{
}