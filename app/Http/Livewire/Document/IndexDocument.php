<?php

namespace App\Http\Livewire\Document;

use App\Models\Document;
use Livewire\Component;
use Livewire\WithPagination;

class IndexDocument extends Component
{
    use WithPagination;
    protected $paginationTheme = 'tailwind';
    protected $listeners       = ['listener.document.index-render' => 'render'];

    public $txt_buscar, $txt_curso, $txt_status;
    public $list_status;

    public function mount()
    {
        $this->list_status = [
            0 => 'Sin publicar',
            1 => 'Publicado'
        ];
    }

    public function render()
    {
        $documents  = new Document;
        $txt_buscar = trim($this->txt_buscar);
        $txt_curso  = trim($this->txt_curso);
        $txt_status = $this->txt_status;
        if ($txt_buscar) {
            $documents = $documents->where('student_name', 'like', "%{$txt_buscar}%");
        }
        if ($txt_curso) {
            $documents = $documents->where('course_name', 'like', "%{$txt_curso}%");
        }
        if ($txt_status !== '' && $txt_status !== null) {
            $documents = $documents->where('status', (bool) $txt_status);
        }
        $documents = $documents->orderBy('student_name', 'asc')->paginate(10);

        //$documents = Document::orderBy('student_name', 'asc')->paginate(12);
        return view('livewire.document.index-document', compact('documents'));
    }

    public function updatingTxtBuscar()
    {
        $this->resetPage();
    }

    public function updatingTxtCurso()
    {
        $this->resetPage();
    }

    public function updatingTxtStatus()
    {
        $this->resetPage();
    }
}
