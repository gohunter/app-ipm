<?php

namespace App\Http\Livewire\Config;

use Illuminate\Support\Facades\Http;
use Livewire\Component;

class IndexConfig extends Component
{
    public function render()
    {
        $qrLogo = public_path() . "/images/logoqr-ipm.png";
        //$qrLogo = storage_path('images/logoqr-ipm.png');

        /* $response = Http::attach(
            'file', file_get_contents($qrLogo), 'logoqr-ipm.png'
        )->post('https://api.qrcode-monkey.com/qr/uploadImage');
        $body = $response->getBody();
        dd(json_decode((string) $body)); */
        return view('livewire.config.index-config');
    }
}
