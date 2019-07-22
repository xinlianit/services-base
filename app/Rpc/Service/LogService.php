<?php declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/7/14
 * Time: 14:49
 */

namespace App\Rpc\Service;

use Jirry\Rpc\Services\Interfaces\LogInterface;
use Swoft\Rpc\Server\Annotation\Mapping\Service;

/**
 * Class LogService
 *
 * @Service()
 * @package App\Rpc\Service
 */
class LogService implements LogInterface
{
    public function push(string $logContent = null): bool
    {
        // TODO: Implement push() method.
        print_r($logContent);
        return true;
    }

    public function listLogs(): array
    {
        // TODO: Implement listLogs() method.
        return [];
    }

    public function getLog(): array
    {
        // TODO: Implement getLog() method.
        return [];
    }
}