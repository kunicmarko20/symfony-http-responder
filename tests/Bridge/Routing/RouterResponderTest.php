<?php

declare(strict_types=1);

namespace ro0NL\HttpResponder\Tests\Bridge\Routing;

use ro0NL\HttpResponder\Bridge\Routing\RespondRouteRedirect;
use ro0NL\HttpResponder\Bridge\Routing\RouterResponder;
use ro0NL\HttpResponder\Responder;
use ro0NL\HttpResponder\Test\ResponderTestCase;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

final class RouterResponderTest extends ResponderTestCase
{
    protected const DEFAULT_RESPONSE_CLASS = RedirectResponse::class;
    protected const DEFAULT_RESPONSE_STATUS = 302;

    public function testRespond(): void
    {
        $responder = $this->getResponder();
        $response = $responder->respond(new RespondRouteRedirect('name'));

        self::assertResponse($response);
        self::assertSame('name/1/[]', $response->headers->get('location'));
    }

    public function testRespondWithParameters(): void
    {
        $responder = $this->getResponder();
        $response = $responder->respond(new RespondRouteRedirect('name', ['key' => 'value']));

        self::assertResponse($response);
        self::assertSame('name/1/{"key":"value"}', $response->headers->get('location'));
    }

    public function testRespondWithAbsoluteUrl(): void
    {
        $responder = $this->getResponder();
        $response = $responder->respond((new RespondRouteRedirect('name'))->withAbsoluteUrl());

        self::assertResponse($response);
        self::assertSame('name/0/[]', $response->headers->get('location'));
    }

    public function testRespondWithRelativePath(): void
    {
        $responder = $this->getResponder();
        $response = $responder->respond((new RespondRouteRedirect('name'))->withRelativePath());

        self::assertResponse($response);
        self::assertSame('name/2/[]', $response->headers->get('location'));
    }

    public function testRespondWithNetworkPath(): void
    {
        $responder = $this->getResponder();
        $response = $responder->respond((new RespondRouteRedirect('name'))->withNetworkPath());

        self::assertResponse($response);
        self::assertSame('name/3/[]', $response->headers->get('location'));
    }

    protected function getResponder(): Responder
    {
        $urlGenerator = $this->createMock(UrlGeneratorInterface::class);
        $urlGenerator->expects(self::any())
            ->method('generate')
            ->willReturnCallback(function (string $name, array $params, int $type): string {
                return $name.'/'.$type.'/'.json_encode($params);
            })
        ;

        return new RouterResponder($urlGenerator);
    }
}