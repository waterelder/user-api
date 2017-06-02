<?php

namespace AppBundle\Api\Response;

use JMS\Serializer\SerializationContext;
use JMS\Serializer\Serializer;
use Symfony\Component\HttpFoundation\Response;

class ResponseBuilder
{
    /** @var Serializer */
    private $serializer;

    /**
     * ResponseBuilder constructor.
     *
     * @param Serializer $serializer
     */
    public function __construct(Serializer $serializer)
    {
        $this->serializer = $serializer;
    }

    /**
     * @param mixed             $data
     * @param array|string|null $groups
     * @param int               $statusCode
     *
     * @return Response
     */
    public function createResponse($data, $groups = null, $statusCode = Response::HTTP_OK)
    {
        $response = new Response($this->serialize($data, $groups, 'json'), $statusCode, [
            'Content-Type' => 'application/hal+json',
        ]);

        return $response;
    }

    /**
     * @param mixed $data
     * @param array|string|null $groups
     * @param string $acceptableContentTypes
     *
     * @return mixed|string
     */
    private function serialize($data, $groups, $acceptableContentTypes)
    {
        $context = SerializationContext::create();
        if ($groups != null) {
            $context->setGroups($groups);
        }
        $context->enableMaxDepthChecks();

        return $this->serializer->serialize($data, $acceptableContentTypes, $context);
    }
}
