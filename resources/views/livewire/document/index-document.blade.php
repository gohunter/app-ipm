<div>
    <div x-data="{}">
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Documentos') }}
            </h2>
        </x-slot>
        <x-card-table>
            <div class="px-6 py-4 flex items-center">
                <input type="text" class="form-control flex-1 mr-4" placeholder="Buscar..."
                    wire:model.debounce.750ms="txt_buscar">
                @livewire('document.create-document')
            </div>
            <div class="px-6">
                <div class="row row-cols-2 row-cols-sm-3 row-cols-md-3 row-cols-lg-4 row-cols-xl-6 gx-2 gy-2">
                    @foreach ($documents as $item)
                    <div class="col d-flex">
                        <div class="card h-100">
                            <div class="relative">
                                <img width="100%" class="card-img-top"
                                    src="{{ asset('storage/documents/'.$item->qr_image) }}" />
                                <div class="absolute bottom-1 right-1">
                                    <a target="_blank" class="btn btn-dark btn-sm"
                                        href="{{ route('document.qrdownload', $item->id) }}">
                                        <i class="bi bi-cloud-download"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="card-body">
                                <h6 class="card-subtitle mb-1 text-xs text-gray-900">
                                    <b>DNI:</b> {{ $item->student_code }}
                                </h6>
                                <h5 class="card-title">{{ $item->student_name }}</h5>
                                <p class="card-text"><b>Curso:</b> {{ $item->course_name }}</p>
                                {{ $item->course_enddate_pe }}
                                {{-- <blockquote class="blockquote mb-0">
                                    <p class="card-text"><b>Curso:</b> {{ $item->course_name }}</p>
                                <footer class="blockquote-footer">Finalizó en <cite
                                        title="Source Title">{{ $item->course_enddate }}</cite></footer>
                                </blockquote> --}}
                            </div>
                            {{-- <ul class="list-group list-group-flush">
                                <li class="list-group-item">Curso:</li>
                                <li class="list-group-item">{{ $item->course_name }}</li>
                            <li class="list-group-item">A third item</li>
                            </ul> --}}
                            <div class="card-footer">
                                <small class="text-muted">Last updated 3 mins ago</small>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @if ($documents->hasPages())
            <div class="px-6 py-2 custom-pagination">
                {{ $documents->links() }}
            </div>
            @endif
            {{-- <ul>
                @foreach ($documents as $item)
                <li>
                    {{ $item->student_name }}
            <img width="100%" src="{{ asset('storage/documents/'.$item->qr_image) }}" />
            </li>
            @endforeach
            </ul> --}}
            <pre>@json($documents, JSON_PRETTY_PRINT)</pre>
        </x-card-table>

        {{-- <img src="{{ asset('images/logoqr-ipm.png') }}" alt="">
        <img src="{{ Storage::url('documents/' . 'logoqr-ipm.png') }}" /> --}}
        {{-- <img src="{{ Storage::url('documents/93bc1d38-0daf-4dc9-bff0-6b30e903d1da.svg') }}" />
        <img src="{{ URL::asset('storage/documents/93bc1d38-0daf-4dc9-bff0-6b30e903d1da.svg') }}" alt="" title=""> --}}
    </div>
</div>
