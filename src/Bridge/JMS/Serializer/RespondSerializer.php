<?php

declare(strict_types=1);

namespace ro0NL\HttpResponder\Bridge\JMS\Serializer;

use JMS\Serializer\SerializationContext;
use ro0NL\HttpResponder\Respond;

/**
 * @author Marko Kunic <kunicmarko20@gmail.com>
 */
final class RespondSerializer extends Respond
{
    /**
     * @var mixed
     */
    public $data;

    /**
     * @var string
     */
    public $format;

    /**
     * @var SerializationContext|null
     */
    public $context;

    /**
     * @var string|null
     */
    public $type;

    /**
     * @param mixed $data
     */
    public function __construct(
        $data,
        string $format,
        ?SerializationContext $context = null,
        ?string $type = null
    ) {
        $this->data = $data;
        $this->format = $format;
        $this->context = $context;
        $this->type = $type;
    }

    public function withGroups(array $groups): self
    {
        $context = $this->context ?? SerializationContext::create();

        $context->setGroups($groups);

        $this->context = $context;

        return $this;
    }
}
