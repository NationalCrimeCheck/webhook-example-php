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
        $payload = json_decode((string)$request->getBody(), true);
        if (empty($payload)) {
            return self::err('Missing or invalid payload');
        }

        // Validate that the payload contains all of the expected fields
        if (!isset($payload['person'])) return self::err('Missing payload field: person');
        if (!isset($payload['person']['id'])) return self::err('Missing payload field: person.id');
        if (!isset($payload['person']['client_ref'])) return self::err('Missing payload field: person.client_ref');
        if (!isset($payload['event'])) return self::err('Missing payload field: event');
        if (!isset($payload['event']['id'])) return self::err('Missing payload field: event.id');
        if (!isset($payload['event']['type'])) return self::err('Missing payload field: event.type');
        if (!isset($payload['data'])) return self::err('Missing payload field: data');
        if (!isset($payload['timestamp'])) return self::err('Missing payload field: timestamp');

        return Response::plaintext("OK");
    }


    /**
     * Generate a '400 Bad Request' response message
     *
     * @param string $message Message to be included in the response body
     * @return Response HTTP response for the 400 Bad Request message
     */
    private static function err(string $message): Response
    {
        return new Response(
            Response::STATUS_BAD_REQUEST,
            ['Content-Type' => 'text/plain; charset=utf-8'],
            $message
        );
    }

}
