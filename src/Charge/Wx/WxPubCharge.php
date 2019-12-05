<?php

namespace Payment\Charge\Wx;

use Payment\Common\Weixin\Data\BackPubChargeData;
use Payment\Common\Weixin\Data\Charge\PubChargeData;
use Payment\Common\Weixin\WxBaseStrategy;

/**
 * @author: admin
 * @createTime: 2016-07-14 18:28
 * @description: 微信 公众号 支付接口
 */
class WxPubCharge extends WxBaseStrategy
{
    public function getBuildDataClass()
    {
        $this->config->tradeType = 'JSAPI';
        return PubChargeData::class;
    }

    /**
     * 处理公众号支付的返回值。直接返回与微信文档对应的字段
     * @param array $ret
     *
     * @return array
     *
     * ```php
     * $data = [
     *  'appId' => '',   // 公众号id
     *  'package'   => '',  // 订单详情扩展字符串  统一下单接口返回的prepay_id参数值，提交格式如：prepay_id=***
     *  'nonceStr'  => '',   // 随机字符串
     *  'timeStamp' => '',   // 时间戳
     *  'signType'  => '',   // 签名算法，暂支持MD5
     *  'paySign'  => '',  // 签名
     * ];
     * ```
     * @throws \Payment\Common\PayException
     */
    protected function retData(array $ret)
    {
        $back = new BackPubChargeData($this->config, $ret);

        $back->setSign();
        $backData = $back->getData();

        $backData['paySign'] = $backData['sign'];
        // 移除sign
        unset($backData['sign']);

        // 公众号支付返回数组结构
        return $backData;
    }
}
