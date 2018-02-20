<?php

namespace AppBundle\EventListener;

use JMS\Serializer\SerializerInterface;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;

class ExceptionListener
{
    private $serializer;
    private $requestStack;

    public function __construct(SerializerInterface $serializer, RequestStack $requestStack)
    {
        $this->serializer = $serializer;
        $this->requestStack = $requestStack;
    }

    public function onKernelException(GetResponseForExceptionEvent $event)
    {
        $pathInfo = $this->requestStack->getMasterRequest()->getPathInfo();

        // TODO Use firewall name
        if (substr($pathInfo, 0, 4) !== '/api' && substr($pathInfo, 0, 8) === '/api/doc') {
            return;
        }

        // You get the exception object from the received event
        $exception = $event->getException();
        $response = new Response();

        // HttpExceptionInterface is a special type of exception that
        // holds status code and header details
        if ($exception instanceof HttpExceptionInterface) {
            $data = [
                'message' => $exception->getMessage(), // For the prod, do this just for safe exceptions
                'file' => $exception->getFile(), // Only for the dev environment
                'line' => $exception->getLine(), // Only for the dev environment
            ];

            $response->setContent($this->serializer->serialize($data, 'json'));
            $response->setStatusCode($exception->getStatusCode());
            $response->headers->replace($exception->getHeaders());
        } else {
            $response->setContent('Internal Server Error');
            $response->setStatusCode(Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        // Send the modified response object to the event
        $event->setResponse($response);
    }
}