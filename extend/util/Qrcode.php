<?php
namespace util;

use Endroid\QrCode\Color\Color;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelLow;
use Endroid\QrCode\RoundBlockSizeMode\RoundBlockSizeModeMargin;
use Endroid\QrCode\Writer\PngWriter;
use Endroid\QrCode\Label\Label;
use Endroid\QrCode\Logo\Logo;

class Qrcode
{
    // 生成邀请二维码
    public function create(array $params = [])
    {
        $text = $params['text'];
        $size = $params['size'] ?? 300;
        $padding = $params['padding'] ?? 10;
        $logoImage = $params['logo'] ?? null;
        $labelText = $params['label'] ?? null;
        $isShow = $params['isShow'] ?? 0;

        $qrPath = '/uploads/shareqr/'.md5($text).'.png';
        if ($isShow || !file_exists(ROOT_PATH.'public'.$qrPath)) {
            $qrCode = \Endroid\QrCode\QrCode::create($text)
                ->setEncoding(new Encoding('UTF-8'))
                ->setErrorCorrectionLevel(new ErrorCorrectionLevelLow())
                ->setSize($isShow ? $size : 88)
                ->setMargin($isShow ? $padding : 1)
                ->setRoundBlockSizeMode(new RoundBlockSizeModeMargin())
                ->setForegroundColor(new Color(0, 0, 0))
                ->setBackgroundColor(new Color(255, 255, 255));
            // 添加Logo
            if ($logoImage) {
                $logo = Logo::create($logoImage)->setResizeToWidth(50);
            }
            // 添加文字
            if ($labelText) {
                $label = Label::create($labelText)->setTextColor(new Color(0, 0, 0));
            }

            $writer = new PngWriter();
            $result = $writer->write($qrCode, $logo ?? null, $label ?? null);
            if ($isShow) {
                // 直接输出
                return response($result->getString(), 200, ['Content-Type' => $result->getMimeType()]);
            }

            // 保存图片
            if (!is_dir(ROOT_PATH."public/uploads/shareqr/")) {
                mkdir(ROOT_PATH."public/uploads/shareqr/");
            }
            $result->saveToFile(ROOT_PATH."public/uploads/shareqr/".md5($text).'.png');
        }
        return $qrPath;
    }

}

