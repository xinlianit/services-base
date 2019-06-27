<?php declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/6/15
 * Time: 16:58
 */

namespace App\Http\Middleware;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Swoft\Bean\Annotation\Mapping\Bean;
use Swoft\Http\Server\Contract\MiddlewareInterface;

/**
 * 认证中间件
 * @Bean()
 *
 * @package App\Http\Middleware
 */
class AuthMiddleware implements MiddlewareInterface
{
    /**
     * 中间件处理函数
     *
     * @param ServerRequestInterface  $request
     * @param RequestHandlerInterface $handler
     *
     * @return ResponseInterface
     */
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $token = $request->getHeaderLine('token');

        if (!$token) {
            $data = [
                'code'    => -1
                , 'msg'   => 'Token错误'
                , 'token' => $token
            ];

            return response()->withData($data);
        }

        return $handler->handle($request);
    }
}