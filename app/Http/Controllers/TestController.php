<?php


namespace App\Http\Controllers;
include "vendor/PHP-Serial-develop/src";

class TestController
{
    public function readPort()
    {


        $serialPort = new SerialPort(new SeparatorParser(), new TTYConfigure());

        $serialPort->open("COM3 USB-SERIAL CH340");
        while ($data = $serialPort->read()) {
            echo $data."\n";

            if ($data === "OK") {
                $serialPort->write("1\n");
                $serialPort->close();
            }
        }
    }

    public function getPort()
    {
        return ['get'];
    }
}
