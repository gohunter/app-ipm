<?php

namespace App\Http\Livewire\Document;

use App\Models\Document;
use Livewire\Component;
use Livewire\WithPagination;

class IndexDocument extends Component
{
    use WithPagination;

    public $txt_buscar;

    public function render()
    {
        $documents = Document::orderBy('student_name', 'asc')->paginate(12);
        return view('livewire.document.index-document', compact('documents'));
    }
}
