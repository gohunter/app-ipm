<div>
    <div x-data="{}">
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Documentos') }}
            </h2>
        </x-slot>
        <x-card-table>
            <div class="px-6 py-4 flex items-center">
                <input type="text" class="form-control flex-1 mr-4" placeholder="Buscar por estudiante..."
                    wire:model.debounce.750ms="txt_buscar">
                <input type="text" class="form-control flex-1 mr-4" placeholder="Buscar por curso..."
                    wire:model.debounce.750ms="txt_curso">
                <div class="flex items-center">
                    <select class="form-select mr-4" aria-label="Seleccionar" wire:model="txt_status">
                        <option value="">Todos los estados</option>
                        @foreach ($list_status as $key => $value)
                        <option value="{{ $key }}">{{ $value }}</option>
                        @endforeach
                    </select>
                </div>
                @livewire('document.create-document')
            </div>
            <div class="table-responsive">
                <table class="min-w-full divide-y divide-gray-200">
                    <colgroup>
                        <col width="20px" />
                        <col width="100px" />
                        <col width="320px" />
                        <col width="320px" />
                        <col width="50px" />
                    </colgroup>
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col"
                                class="pl-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                N°
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                QR
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Estudiante
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Curso
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Estado
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Acciones
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($documents as $key => $item)
                        <tr>
                            <td class="pl-6 py-4">
                                <div class="text-xs font-medium text-gray-900">
                                    {{ $documents->firstItem() + $key }}
                                </div>
                            </td>
                            <td class="pl-6 py-1">
                                <img width="100%" src="{{ asset('storage/documents/'.$item->qr_image) }}" />
                            </td>
                            <td class="pl-6 py-1">
                                <h6 class="card-subtitle titulo-estudiante titulo-dni">
                                    <span class="label">DNI:</span>
                                    <span class="valor">{{ $item->student_code }}</span>
                                </h6>
                                <h5 class="titulo-estudiante mb-0">
                                    {{-- <span class="label">Estudiante:</span> --}}
                                    <span class="valor text-uppercase">{{ $item->student_name }}</span>
                                </h5>
                            </td>
                            <td class="pl-6 py-1">
                                <p class="titulo-estudiante titulo-curso mb-1">
                                    {{-- <span class="label">Curso:</span> --}}
                                    <span class="valor text-uppercase tracking-tight">{{ $item->course_name }}</span>
                                </p>
                                <p class="titulo-estudiante titulo-fecha mb-0">
                                    <span class="label">Finalizó:</span>
                                    <span class="valor text-uppercase">{{ $item->course_enddate_pe }}</span>
                                </p>
                            </td>
                            <td class="pl-6 py-1 whitespace-nowrap">
                                @if ($item->status === 1)
                                <span
                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                    Publicado
                                </span>
                                @else
                                <span
                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                    Sin publicar
                                </span>
                                @endif
                            </td>
                            <td class="pl-6 py-1 text-sm font-medium whitespace-nowrap">
                                <a target="_blank" class="btn btn-outline-dark btn-sm" title="Descargar QR"
                                    href="{{ route('document.qrdownload', $item->id) }}">
                                    <i class="bi bi-cloud-download"></i>
                                </a>
                                @if ($item->qr_file)
                                <a target="_blank" class="btn btn-outline-success btn-sm" title="Descargar PDF"
                                    href="{{ route('document.vpdfdownload', $item->uuid) }}">
                                    <i class="bi bi-file-earmark-pdf"></i>
                                </a>
                                @endif
                                <button class="btn btn-outline-primary btn-sm" title="Editar"
                                    wire:click.prevent="$emit('listener.document.edit', {{ $item->id }})">
                                    <i class="bi bi-pencil"></i>
                                </button>
                                <button class="btn btn-outline-danger btn-sm" title="Eliminar"
                                    wire:click.prevent="$emit('listener.document.delete', {{ $item }})">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @if ($documents->hasPages())
            <div class="px-6 py-2 custom-pagination">
                {{ $documents->links() }}
            </div>
            @endif
        </x-card-table>
        <div wire:loading>
            <x-spinner></x-spinner>
        </div>
    </div>

    @livewire('document.edit-document')
    @livewire('document.delete-document')
</div>
