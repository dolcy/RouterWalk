<?php

declare(strict_types=1);

namespace RouterApp\Tests;

use PHPUnit\Framework\TestCase;
use Psr\Container\ContainerInterface;
use RouterApp\ContainerFactory;

/**
 * @coversNothing
 */
class ContainerFactoryTest extends TestCase
{
    public function test_container_start()
    {
        $container = ContainerFactory::start();
        $this->assertInstanceOf(ContainerInterface::class, $container);
    }
}
