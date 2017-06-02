<?php

namespace AppBundle\Api\Request;

class RequestDecoder
{
    /**
     * @param Request $request
     *
     * @return array|mixed
     */
    protected function decodeRequestBody(Request $request)
    {
        $content = $request->getContent();

        if (!$content) {
            return [];
        }

        $content = json_decode($content, true);

        if ($content === null) {
            $apiProblem = new ApiProblem(Response::HTTP_BAD_REQUEST, ApiProblem::TYPE_INVALID_REQUEST_BODY_FORMAT);
            throw new ApiProblemException($apiProblem);
        }

        return $content;
    }
}
