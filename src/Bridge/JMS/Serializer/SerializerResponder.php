<?php

declare(strict_types=1);

namespace ro0NL\HttpResponder\Bridge\JMS\Serializer;

use JMS\Serializer\SerializerInterface;
use ro0NL\HttpResponder\Exception\BadRespondTypeException;
use ro0NL\HttpResponder\Respond;
use ro0NL\HttpResponder\Responder;
use Symfony\Component\HttpFoundation\Response;

/**
 * @author Marko Kunic <kunicmarko20@gmail.com>
 */
final class SerializerResponder implements Responder
{
    /**
     * @var SerializerInterface
     */
    private $serializer;

    public function __construct(SerializerInterface $serializer)
    {
        $this->serializer = $serializer;
    }

    public function respond(Respond $respond): Response
    {
        if ($respond instanceof RespondSerializer) {
            return new Response(
                $this->serializer->serialize(
                    $respond->data,
                    $respond->format,
                    $respond->context,
                    $respond->type
                ),
                $respond->status,
                $respond->headers
            );
        }

        throw BadRespondTypeException::create($this, $respond);
    }
}
