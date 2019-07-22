<?php declare(strict_types=1);
/**
 *  日志控制器
 *
 * @package  App\Http\Controller 控制器
 * @link     https://xinlianit.github.io/
 * @author   jirry <jirenyoucn@gmail.com>
 * @datetime 2019/6/13 16:31
 */

namespace App\Http\Controller;

use Jirry\Rpc\Services\Interfaces\LogInterface;
use Swoft\Http\Server\Annotation\Mapping\Controller;
use Swoft\Http\Server\Annotation\Mapping\RequestMapping;
use Swoft\Http\Server\Annotation\Mapping\RequestMethod;
use Swoft\Log\Helper\CLog;
use Swoft\Rpc\Client\Annotation\Mapping\Reference;

/**
 * Class LoggingController
 * @Controller(prefix="Logging")
 *
 * @package App\Http\Controller
 */
class LoggingController extends BaseController
{
    /**
     * @Reference(pool="log.pool")
     * @var LogInterface
     */
    private $logService;

    /**
     * 日志推送
     * @RequestMapping(route="push",method={RequestMethod::POST})
     *
     * @return \Swoft\Http\Message\Response
     */
    public function push()
    {
        $log    = postData();
        try{
            $result = $this->logService->push(json_encode($log));
        }catch (\Exception $e){
            print_r($e->getMessage());return;
        }

        $data   = [
            'content' => "日志记录",
            'result'  => $result,
            'log'     => $log
        ];
        //CLog::info(json_encode($data));

        return $this->success($data);
    }
}