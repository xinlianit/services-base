<?php declare(strict_types=1);
/**
 * 测试控制器
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
 * Class TestController
 * @Controller(prefix="/test")
 * @Middlewares({
 *     @Middleware(App\Http\Middleware\AuthMiddleware::class)
 * })
 *
 * @package App\Http\Controller
 */
class TestController extends BaseController
{
    /**
     * 首页
     * @RequestMapping(route="index")
     *
     * @return \Swoft\Http\Message\Response
     */
    public function index()
    {
        $bean = bean('db');
        print_r($bean);
        $data = [
            'name'   => 'swoft'
            , 'age'  => 100
            , 'test' => bean('httpServer')
        ];
        return $this->success($data);
    }

    /**
     * 获取URL中Name
     * @RequestMapping(method={RequestMethod::GET},route="getUrlName[/{name}]")
     *
     * @param string $name 名称
     *
     * @return \Swoft\Http\Message\Response
     */
    public function getUrlName(string $name)
    {
        $data = [
            'name' => $name
        ];
        return $this->success($data);
    }

    /**
     * 获取请求数据
     * @RequestMapping(method={RequestMethod::GET,RequestMethod::POST},route="getRequest")
     *
     * @return \Swoft\Http\Message\Response
     */
    public function getRequest()
    {
        $name = getData('name');
        $data = [
            'header'               => headerData($name)
            , 'headers'            => headerData()
            , 'get'                => getData()
            , 'post'               => postData()
            , 'josn'               => request()->json()
            , 'raw'                => request()->raw()
            , 'server'             => request()->getServerParams()
            , 'server_request_uri' => request()->server('request_uri')
        ];
        return $this->success($data);
    }

    /**
     * 获取名称
     * @RequestMapping(method={RequestMethod::GET},route="getName")
     *
     * @return \Swoft\Http\Message\Response
     */
    public function getName()
    {
        $name = getData('name');

        $data = [
            'name' => $name
        ];
        return $this->success($data);
    }

    /**
     * 中间件参数验证
     * @RequestMapping(method={RequestMethod::GET},route="middlewareCheckParams")
     * @Middleware(App\Http\Middleware\ActionMiddleware::class)
     *
     * @return \Swoft\Http\Message\Response
     */
    public function middlewareCheckParams()
    {
        $getData = getData();
        return $this->success($getData);
    }

    /**
     * JWT 登录
     * @RequestMapping(method={RequestMethod::POST},route="jwtAuth")
     * @Middleware(App\Http\Middleware\JWTAuthMiddleware::class)
     *
     * @return \Swoft\Http\Message\Response
     */
    public function jwtAuth()
    {
        $data = [
            'user' => request()
        ];
        return $this->success($data);
    }

    /**
     * 获取用户信息
     * @RequestMapping(method={RequestMethod::GET},route="getUserInfo")
     *
     * @return \Swoft\Http\Message\Response
     */
    public function getUserInfo()
    {
        $userId    = getData('user_id', 0);
        $userLogic = new AppUserLogic();

        $result = $userLogic->userInfo((int)$userId);

        return $this->success(['a'=>$result]);
    }
}