<?php

namespace AppBundle\Subscriber;

use AppBundle\Api\Exception\ApiProblem;
use AppBundle\Api\Exception\ApiProblemException;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;
use Symfony\Component\HttpKernel\KernelEvents;

class ExceptionSubscriber implements EventSubscriberInterface
{

    public static function getSubscribedEvents()
    {
        return array(
            KernelEvents::EXCEPTION => array(
                array('onKernelException'),
            ),
        );
    }

    public function onKernelException(GetResponseForExceptionEvent $event)
    {
        $e = $event->getException();

        $statusCode = $e instanceof HttpExceptionInterface ? $e->getStatusCode() : 500;

        if ($e instanceof ApiProblemException) {
            $apiProblem = $e->getApiProblem();
        } else {
            $apiProblem = new ApiProblem(
                $statusCode
            );

            if ($e instanceof HttpExceptionInterface) {
                $apiProblem->set('detail', $e->getMessage());
            }
        }

        $data = $apiProblem->toArray();

        $response = new JsonResponse(
            $data,
            $apiProblem->getStatusCode()
        );

        $response->headers->set('Content-Type', 'application/problem+json');

        $event->setResponse($response);
    }
}
