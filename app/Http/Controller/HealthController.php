<?php declare(strict_types=1);
/**
 * 服务健康检查控制器
 *
 * @package  App\Http\Controller 控制器
 * @link     https://xinlianit.github.io
 * @author   jirry <jirenyoucn@gmail.com>
 * @datetime 2019/6/13 16:31
 */

namespace App\Http\Controller;

use Swoft\Http\Server\Annotation\Mapping\Controller;
use Swoft\Http\Server\Annotation\Mapping\RequestMapping;

/**
 * Class HealthController
 * @Controller(prefix="health")
 *
 * @package App\Http\Controller
 */
class HealthController extends BaseController
{
    /**
     * 服务状态
     * @RequestMapping(route="status")
     *
     * @return \Swoft\Http\Message\Response
     */
    public function status()
    {
        $result = [];
        $msg    = "success";
        return $this->success($result, $msg);
    }
}