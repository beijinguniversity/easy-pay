<?php
namespace Payment\Charge\Wx;

use Payment\Common\Weixin\Data\Charge\WapChargeData;
use Payment\Common\Weixin\WxBaseStrategy;

/**
 * @author: admin
 * @createTime: 2016-07-14 18:29
 * @description: 微信 h5 支付
 */
class WxWapCharge extends WxBaseStrategy
{

    public function getBuildDataClass()
    {
        $this->config->tradeType = 'MWEB';
        return WapChargeData::class;
    }

    /**
     * 这里由于
     * @param array $ret
     * @return mixed
     */
    protected function retData(array $ret)
    {
        if ($this->config->returnRaw) {
            return $ret;
        }

        $wabUrl = $ret['mweb_url'];
        if ($this->config->returnUrl) {
            $wabUrl .= '&redirect_url=' . urlencode($this->config->returnUrl);
        }

        return $wabUrl;
    }
}