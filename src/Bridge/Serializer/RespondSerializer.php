<?php

declare(strict_types=1);

namespace ro0NL\HttpResponder\Bridge\Serializer;

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
     * @var array
     */
    public $context;

    /**
     * @param mixed $data
     */
    public function __construct($data, string $format, array $context = [])
    {
        $this->data = $data;
        $this->format = $format;
        $this->context = $context;
    }
}
