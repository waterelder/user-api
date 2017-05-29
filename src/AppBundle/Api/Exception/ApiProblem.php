<?php

namespace AppBundle\Api\Exception;

use Symfony\Component\HttpFoundation\Response;

class ApiProblem
{
    const TYPE_INVALID_REQUEST_BODY_FORMAT = 'Invalid request body';
    const TYPE_VALIDATION_ERROR = 'validation_error';
    const TYPE_NOT_FOUND = 'entity_not_found';
    const TYPE_SERIALIZATION_ERROR = 'serialization_error';
    const TYPE_NOT_FOUND_DESERIALIZATION_TYPE = 'deserialization_type_not_found';
    const TYPE_INTERNAL_ERROR = 'Something went wrong';

    private static $titles = array(
        self::TYPE_INVALID_REQUEST_BODY_FORMAT => "Can't deserialize",
        self::TYPE_INTERNAL_ERROR => "Something went wrong",
        self::TYPE_VALIDATION_ERROR => 'There was a validation error',
        self::TYPE_NOT_FOUND => 'Entity not found in database',
        self::TYPE_SERIALIZATION_ERROR => 'Serialization error',
        self::TYPE_NOT_FOUND_DESERIALIZATION_TYPE => 'Deserialization type not found',
    );

    private $statusCode;

    private $type;

    private $title;

    private $extraData = array();

    public function __construct($statusCode, $type = null)
    {
        $this->statusCode = $statusCode;

        if ($type === null) {
            $type = 'about:blank';
            $title = isset(Response::$statusTexts[$statusCode])
                ? Response::$statusTexts[$statusCode]
                : 'Unknown status code :(';
        } else {
            if (!isset(self::$titles[$type])) {
                throw new \InvalidArgumentException('No title for type '.$type);
            }

            $title = self::$titles[$type];
        }

        $this->type = $type;
        $this->title = $title;
    }

    public function toArray()
    {
        return array_merge(
            $this->extraData,
            array(
                'status' => $this->statusCode,
                'type' => $this->type,
                'title' => $this->title,
            )
        );
    }

    public function set($name, $value)
    {
        $this->extraData[$name] = $value;
    }

    public function getExtraData()
    {
        return $this->extraData;
    }

    public function getStatusCode()
    {
        return $this->statusCode;
    }

    public function getTitle()
    {
        return $this->title;
    }
}
