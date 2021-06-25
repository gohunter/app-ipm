<?php

namespace App\Http\Livewire\Document;

use App\Models\Document;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class EditDocument extends Component
{
    use WithFileUploads;
    public $document;
    public $pdf, $pdfnid;

    protected $listeners = ['listener.document.edit' => 'edit'];

    public function render()
    {
        return view('livewire.document.edit-document');
    }

    public function edit(Document $document)
    {
        $this->resetErrorBag();
        $this->document = $document;
        $this->pdfnid   = rand();
    }

    public function update()
    {
        $this->validate();
        if ($this->document->id) {
            if ($this->pdf) {
                //$qr_file = $this->pdf->storeAs('/documents', $this->document->uuid);
                //$qr_file = $this->pdf->storeAs('documents', $this->document->uuid);
                Storage::delete($this->document->qr_file);

                $qr_file = $this->pdf->store('documents');

                $this->document->qr_file = $qr_file;
            }

            $this->document->save();
            $this->reset(['pdf']);
            $this->pdfnid = rand();
        }
        $this->emit('listener.document.index-render');
        $this->dispatchBrowserEvent('listener.document.edit-close-modal');
    }

    public function updatedPdf()
    {
        $this->validate([
            'pdf' => 'nullable|file|mimes:png,jpg,pdf,xlsx|max:102400' // 100MB Max
        ]);
    }

    protected function rules()
    {
        return [
            'pdf'                     => 'nullable|file|mimes:png,jpg,pdf,xlsx|max:102400',
            'document.student_code'   => 'required|min:2|max:12',
            'document.student_name'   => 'required|min:2|max:200',
            'document.course_name'    => 'required|min:2|max:200',
            'document.course_enddate' => 'nullable|date',
            'document.status'         => 'nullable|boolean'
        ];
    }

    protected function validationAttributes()
    {
        return [
            'pdf'                     => 'Documento PDF',
            'document.student_code'   => 'DNI',
            'document.student_name'   => 'Estudiante',
            'document.course_name'    => 'Curso',
            'document.course_enddate' => 'Fecha de finalzación del curso',
            'document.status'         => 'Publicar documento'
        ];
    }
}
