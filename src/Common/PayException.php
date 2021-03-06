<?php
namespace Payment\Common;

/**
 * @author: admin
 * @createTime: 2016-07-14 18:02
 * @description: 统一的异常处理类
 */
class PayException extends \Exception
{
    /**
     * 获取异常错误信息
     * @return string
     */
    public function errorMessage()
    {
        return $this->getMessage();
    }
}
