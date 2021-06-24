<?php

namespace App\Http\Livewire\Document;

use App\Models\Config;
use App\Models\Document;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Livewire\Component;

class CreateDocument extends Component
{
    public $document;

    public function mount(Document $document)
    {
        $this->document = $document;
    }

    public function render()
    {
        return view('livewire.document.create-document');
    }

    public function store()
    {
        $this->validate();

        $siteurl = Config::where('config_name', 'siteurl')->first();
        $logoqr  = Config::where('config_name', 'logoqr')->first();
        $jsonqr  = json_decode(Config::where('config_name', 'jsonqr')->first()->config_value);

        $uuid   = Str::orderedUuid();
        $qr_url = "{$siteurl->config_value}/doc/{$uuid}";

        $jsonqr->data         = $qr_url;
        $jsonqr->download     = true;
        $jsonqr->config->logo = $logoqr->config_value;

        $response = Http::withBody(json_encode($jsonqr), 'json')
            ->post('https://api.qrcode-monkey.com/qr/custom');
        $result = $response->json();
        if (isset($result['imageUrl']) && $result['imageUrl']) {
            $qr_image = "{$uuid}.svg";
            Storage::put("documents/" . $qr_image, file_get_contents('https:' . $result['imageUrl']));
            $this->document->qr_image = $qr_image;
        }

        $this->document->uuid   = $uuid;
        $this->document->qr_url = $qr_url;
        $this->document->save();
        $this->document = new Document();
        $this->emit('listener.document.index-render');
        $this->dispatchBrowserEvent('listener.document.create-close-modal');
    }

    protected function rules()
    {
        return [
            'document.student_code'   => 'required|min:2|max:12',
            'document.student_name'   => 'required|min:2|max:200',
            'document.course_name'    => 'required|min:2|max:200',
            'document.course_enddate' => 'nullable|date'
        ];
    }

    protected function validationAttributes()
    {
        return [
            'document.student_code'   => 'DNI',
            'document.student_name'   => 'Estudiante',
            'document.course_name'    => 'Curso',
            'document.course_enddate' => 'Fecha de finalzación del curso'
        ];
    }
}
