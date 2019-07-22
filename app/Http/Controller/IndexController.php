<?php declare(strict_types=1);
/**
 * 首页控制器
 *
 * @package  App\Http\Controller 控制器
 * @link     https://xinlianit.github.io/
 * @author   jirry <jirenyoucn@gmail.com>
 * @datetime 2019/6/13 16:31
 */

namespace App\Http\Controller;

use App\Model\Logic\AppUserLogic;
use swoft\base\Services;
use Swoft\Http\Server\Annotation\Mapping\Controller;
use Swoft\Http\Server\Annotation\Mapping\Middleware;
use Swoft\Http\Server\Annotation\Mapping\Middlewares;
use Swoft\Http\Server\Annotation\Mapping\RequestMapping;
use Swoft\Http\Server\Annotation\Mapping\RequestMethod;

/**
 * Class IndexController
 * @Controller(prefix="/index")
 *
 * @package App\Http\Controller
 */
class IndexController extends BaseController
{
    /**
     * 首页
     * @RequestMapping(route="index")
     *
     * @return \Swoft\Http\Message\Response
     */
    public function index()
    {
        $algo = 'sha1';
        $data = 'jirenyou'.time();
        $key  = 'AD56YU28IDUJEYJADK090991KDADDEBJCV';
        $sign = hash_hmac($algo, $data, $key);
        $data = [
            'content'       => 'Base 服务！',
            'sha1_sign'     => $sign,
            'sha1_sign_len' => strlen($sign),
            'request'   => $_REQUEST
        ];
        return $this->success($data);
    }
}