<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use LaravelQRCode\Facades\QRCode;

class QRCodeController extends Controller
{
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function index(Request $request)
    {

        // $qr = QRCode::url('https://solas.website')
        //     ->setOutfile(Storage::disk("public")->path("qrcode.png"))
        //     ->png();
        $qr = 'test';
        return \view('qr-code', \compact('qr'));
    }
}
