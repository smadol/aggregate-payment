<?php

/*
 * 退款接口参数
 */

namespace LisaoPayment\WxConfig;

class RefundOrderConfig implements \LisaoPayment\ConfigBase\InterfaceConfig {

    private $product_url = 'https://api.mch.weixin.qq.com/secapi/pay/refund'; //生产环境请求接口
    private $sandbox_url = 'https://api.mch.weixin.qq.com/sandboxnew/secapi/pay/refund'; //沙箱环境请求接口
    private $param = []; //参数
    public $cert; //证书
    public $key; //秘钥

    public function __construct($sub_mch_id = '', $sub_appid = '') {
        if ($sub_mch_id) {
            $this->param['sub_mch_id'] = $sub_mch_id;
        }
        if ($sub_appid) {
            $this->param['sub_appid'] = $sub_appid;
        }
    }

    /**
     * 设置参数 - 一般用于设置一些非必需参数
     * @param type $option 参数名
     * @param type $value 值
     * @return boolean
     */
    public function set(string $option, $value) {
        $this->param[$option] = $value;
        return TRUE;
    }

    /**
     * 设置所有参数 - 一般用于设置一些非必需参数
     * @param array $param 参数数组
     * @return boolean
     */
    public function set_all(array $param) {
        foreach ($param as $k => $v) {
            $this->param[$k] = $v;
        }
        return TRUE;
    }

    /**
     * 获取参数
     * @param string $option 参数名
     * @return type 值
     */
    public function get(string $option) {
        return $this->param[$option];
    }

    /**
     * 获取所有参数
     * @return array 值
     */
    public function get_all() {
        return $this->param;
    }

    /**
     * 获取网关地址
     * @param bool $sandbox 是否为沙箱环境
     * @return type
     */
    public function get_url(bool $sandbox = false) {
        if ($sandbox) {
            return $this->sandbox_url;
        } else {
            return $this->product_url;
        }
    }

    /**
     * 设置商户订单号（与微信订单号二选一）
     * @param string $value 商户系统内部订单号，要求32个字符内，只能是数字、大小写字母_-|*@ ，且在同一个商户号下唯一
     */
    public function set_out_trade_no(string $value) {
        $this->param['out_trade_no'] = $value;
    }

    /**
     * 设置退款订单号
     * @param string $value 商户系统内部的退款单号，商户系统内部唯一，只能是数字、大小写字母_-|*@ ，同一退款单号多次请求只退一笔。
     */
    public function set_out_refund_no(string $value) {
        $this->param['out_refund_no'] = $value;
    }

    /**
     * 设置微信支付订单号（与商户订单号二选一）
     * @param string $value 微信的订单号，优先使用 
     */
    public function set_transaction_id(string $value) {
        $this->param['transaction_id'] = $value;
    }

    /**
     * 设置随机串
     * @param string $value 随机字符串，不长于32位。
     */
    public function set_nonce_str(string $value) {
        $this->param['nonce_str'] = $value;
    }

    /**
     * 设置订单总金额
     * @param int $value 订单总金额，只能为整数，单位：分
     */
    public function set_total_fee(int $value) {
        $this->param['total_fee'] = $value;
    }

    /**
     * 设置退款金额
     * @param int $value 订单总金额，只能为整数，单位：分
     */
    public function set_refund_fee(int $value) {
        $this->param['refund_fee'] = $value;
    }

    /**
     * 设置证书
     * @param type $apiclient_cert 商户证书绝对路径
     * @param type $apiclient_key 商户证书秘钥绝对路径
     */
    public function set_cert($apiclient_cert, $apiclient_key) {
        $this->cert = $apiclient_cert;
        $this->key = $apiclient_key;
    }

}
