<?php

declare(strict_types=1);

namespace ro0NL\HttpResponder\Bridge\Bundle;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\DependencyInjection\ConfigurableExtension;

/**
 * @author Marko Kunic <kunicmarko20@gmail.com>
 */
final class HttpResponderExtension extends ConfigurableExtension
{
    protected function loadInternal(array $config, ContainerBuilder $container): void
    {

    }
}
