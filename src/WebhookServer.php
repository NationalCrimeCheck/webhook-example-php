<?php
namespace WebhookExample;

use Psr\Http\Message\ServerRequestInterface;
use React\Http\Message\Response;


class WebhookServer
{

    /**
     * Receive and handle an incoming HTTP request
     *
     * @param ServerRequestInterface $request Request details
     * @return Response HTTP response
     */
    public function handler(ServerRequestInterface $request)
    {
        return Response::plaintext("OK");
    }

}
