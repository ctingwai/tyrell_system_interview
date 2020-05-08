<?php
/**
 * Cors middleware
 *
 * @author      Chong Ting Wai
 * @since       0.1.0
 * @link        https://blog.twcloud.tech
 */
namespace App\Middleware;

use Cake\Http\Cookie\Cookie;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Psr\Http\Server\MiddlewareInterface;

class CorsMiddleware implements MiddlewareInterface
{
    public function process(
        ServerRequestInterface $request,
        RequestHandlerInterface $handler
    ): ResponseInterface
    {
        $response = $handler->handle($request)
            ->cors($request)
            ->allowOrigin(['*'])
            ->allowMethods(['GET', 'POST', 'PUT', 'PATCH', 'DELETE'])
            ->allowHeaders(['X-CSRF-Token'])
            ->allowCredentials()
            ->maxAge(300)
            ->build();

        return $response;
    }
}
