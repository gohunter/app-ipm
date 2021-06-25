<div>
    <div x-data="initEditDocument()" x-init="main()" x-on:livewire-upload-start="isUploading = true"
        x-on:livewire-upload-finish="isUploading = false" x-on:livewire-upload-error="isUploading = false"
        x-on:livewire-upload-progress="progress = $event.detail.progress">
        <form wire:ignore.self wire:submit.prevent="update" novalidate>
            <div wire:ignore.self class="modal fade" id="EditDocumentModal" tabindex="-1"
                aria-labelledby="EditDocumentLabel" aria-hidden="true" data-bs-backdrop="static"
                data-bs-keyboard="false">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header bg-gray-50">
                            <h5 class="modal-title" id="EditDocumentLabel">Editar documento</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row g-3">
                                <div class="col-sm-5">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" maxlength="12" minlength="2"
                                            wire:model.defer="document.student_code" required />
                                        <x-form-label model="document.student_code" required="true">
                                            DNI
                                        </x-form-label>
                                    </div>
                                </div>
                                <div class="col-sm-7">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" maxlength="200" minlength="2"
                                            wire:model.defer="document.student_name" required />
                                        <x-form-label model="document.student_name" required="true">
                                            Estudiante
                                        </x-form-label>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" maxlength="200" minlength="2"
                                            wire:model.defer="document.course_name" required />
                                        <x-form-label model="document.course_name" required="true">
                                            Curso
                                        </x-form-label>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-floating">
                                        <input type="date" class="form-control" maxlength="200" minlength="2"
                                            wire:model.defer="document.course_enddate" required />
                                        <x-form-label model="document.course_enddate" required="true">
                                            Fecha de finalzación del curso
                                        </x-form-label>
                                    </div>
                                </div>
                                {{-- <div class="col-sm-12">
                                    <label for="formFile" class="form-label">Documento PDF</label>
                                    <input class="form-control" type="file" id="formFile">
                                </div> --}}
                                <div class="col-sm-12">
                                    <label for="formFile{{ $pdfnid }}" class="form-label">Documento PDF</label>
                                    <div class="input-group">
                                        <label class="input-group-text" for="formFile{{ $pdfnid }}">
                                            <i class="bi bi-file-earmark-pdf"></i>
                                        </label>
                                        <input class="form-control" type="file" id="formFile{{ $pdfnid }}"
                                            wire:model.def="pdf" />
                                    </div>
                                    <x-invalid-feedback for="pdf" />
                                    <div x-show="isUploading">
                                        <progress max="100" x-bind:value="progress" style="width:100%;"></progress>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="checkStatus"
                                            wire:model.defer="document.status">
                                        <label class="form-check-label" for="checkStatus">
                                            Publicar documento
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer bg-gray-100">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            @if ($document && $document->id)
                            <button type="button" class="btn btn-dark"
                                wire:click="edit({{ $document->id }})">Recargar</button>
                            @endif
                            <button type="submit" class="btn btn-primary">Guardar cambios</button>
                        </div>
                        <div wire:loading>
                            <x-spinner></x-spinner>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

@push('js')
<script type="text/javascript">
    try {
        function initEditDocument(){
            return {
                isUploading: false, progress: 0,
                modal: new bootstrap.Modal('#EditDocumentModal'),
                main: function(){
                    window.livewire.on('listener.document.edit', (e) => {
                        this.openModal();
                    });
                    window.addEventListener('listener.document.edit-close-modal', () => {
                        this.closeModal();
                    });
                },
                openModal: function(e){
                    if(e){
                        e.preventDefault();
                    }
                    this.modal.show();
                },
                closeModal(){
                    this.modal.hide();
                }
            }
        }
    } catch (error) {
        console.log(error);
    }
</script>
@endpush
