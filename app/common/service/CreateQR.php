<?php


namespace app\common\service;
use Endroid\QrCode\Color\Color;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelLow;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Label\Label;
use Endroid\QrCode\Logo\Logo;
use Endroid\QrCode\RoundBlockSizeMode\RoundBlockSizeModeMargin;
use Endroid\QrCode\Writer\PngWriter;


class CreateQR
{

    public static function CreateImg($url)
    {

        $writer = new PngWriter();
        $qrCode = QrCode::create($url)//跳转的url地址
            ->setEncoding(new Encoding('UTF-8'))
            ->setErrorCorrectionLevel(new ErrorCorrectionLevelLow())
            ->setSize(150)//大小
            ->setMargin(20)//边距
            ->setRoundBlockSizeMode(new RoundBlockSizeModeMargin())
            ->setForegroundColor(new Color(0, 0, 0))
            ->setBackgroundColor(new Color(255, 255, 255));
        $label = Label::create('扫码购买')//二维码下面的文字
        ->setTextColor(new Color(0, 0, 0));
        $result = $writer->write($qrCode);
        $result->getString();
        $dataUri = $result->getDataUri();
        return $dataUri;
    }





}