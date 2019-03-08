<?php

declare(strict_types=1);

namespace ro0NL\HttpResponder;

use ro0NL\HttpResponder\Respond\Respond;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;

/**
 * @author Marko Kunic <kunicmarko20@gmail.com>
 */
final class FlashMessagingResponder implements Responder
{
    /**
     * @var Responder
     */
    private $responder;

    /**
     * @var FlashBagInterface
     */
    private $flashBag;

    public function __construct(Responder $responder, FlashBagInterface $flashBag)
    {
        $this->responder = $responder;
        $this->flashBag = $flashBag;
    }

    public function respond(Respond $respond): Response
    {
        foreach ($respond->flashes as $type => $messages) {
            foreach ((array) $messages as $message) {
                $this->flashBag->add($type, $message);
            }
        }

        return $this->responder->respond($respond);
    }
}
