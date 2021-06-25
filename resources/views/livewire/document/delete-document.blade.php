<div>
    <div x-data="initDeleteDocument()" x-init="main()">
        <form wire:ignore.self x-on:submit.prevent="sendForm()" novalidate>
            <div wire:ignore.self class="modal fade" id="DeleteDocumentModal" tabindex="-1"
                aria-labelledby="DeleteDocumentLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header bg-gray-50">
                            <h5 class="modal-title" id="DeleteDocumentLabel">Eliminar cargo</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <template x-if="error && error.message">
                                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                    <span x-html="error.message"></span>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            </template>
                            <p class="mb-0">
                                ¿Desea eliminar el registro del Estudiante <b x-text="document?.student_name"></b>?
                            </p>
                        </div>
                        <div class="modal-footer bg-gray-100">
                            <button type="submit" class="btn btn-danger">Eliminar registro</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
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
        function initDeleteDocument(){
            return {
                document: {},
                error: null,
                modal: new bootstrap.Modal('#DeleteDocumentModal'),
                main: function(){
                    window.livewire.on('listener.document.delete', (document) => {
                        this.document = document;
                        this.openModal();
                    });
                    window.addEventListener('listener.document.delete-close-modal', () => {
                        this.closeModal();
                    });
                    window.addEventListener('listener.document.delete-error', (res) => {
                        if(res && res.detail && res.detail.message){
                            this.error = res.detail;
                        }
                    });
                },
                openModal: function(e){
                    if(e){
                        e.preventDefault();
                    }
                    this.error = null;
                    this.modal.show();
                },
                closeModal(){
                    this.modal.hide();
                },
                sendForm() {
                    this.error = null;
                    if(this.document && this.document.id){
                        window.livewire.emit('listener.document.destroy', this.document);
                    }
                }
            }
        }
    } catch (error) {
        console.log(error);
    }
</script>
@endpush
