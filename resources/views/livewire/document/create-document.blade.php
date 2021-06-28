<div>
    <div x-data="initCreateDocument()" x-init="main()">
        <button type="button" class="btn btn-primary" @click="openModal(event)" title="Registrar documento">
            <i class="bi bi-plus-lg"></i>
        </button>
        <form wire:ignore.self wire:submit.prevent="store" novalidate>
            <div wire:ignore.self class="modal fade" id="CreateDocumentModal" tabindex="-1"
                aria-labelledby="CreateDocumentLabel" aria-hidden="true" data-bs-backdrop="static"
                data-bs-keyboard="false">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header bg-gray-50">
                            <h5 class="modal-title" id="CreateDocumentLabel">Registrar documento</h5>
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
                                            Fecha de inicio del curso
                                        </x-form-label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer bg-gray-100">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-primary">Crear</button>
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
{{-- data-bs-toggle="modal" data-bs-target="#CreateDocumentModal" --}}

@push('js')
<script type="text/javascript">
    try {
        function initCreateDocument(){
            return {
                modal: new bootstrap.Modal('#CreateDocumentModal'),
                main: function(){
                    window.addEventListener('listener.document.create-close-modal', () => {
                        this.closeModal();
                    });
                },
                openModal: function(e){
                    e.preventDefault();
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
