<?php

namespace App\Http\Livewire\Document;

use App\Models\Document;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class DeleteDocument extends Component
{
    protected $listeners = ['listener.document.destroy' => 'destroy'];

    public function render()
    {
        return view('livewire.document.delete-document');
    }

    public function destroy(Document $document)
    {
        try {
            $document->delete();
            if (Storage::exists($document->qr_file)) {
                Storage::delete($document->qr_file);
            }
            if (Storage::exists('documents/' . $document->qr_image)) {
                Storage::delete('documents/' . $document->qr_image);
            }
            $this->emit('listener.document.index-render');
            $this->dispatchBrowserEvent('listener.document.delete-close-modal');
        } catch (\Exception $ex) {
            $this->dispatchBrowserEvent('listener.document.delete-error', [
                'message' => "No se pudo eliminar el registro."
            ]);
        }
    }
}
