@extends('layout.base')
@push('css')
    <link rel="stylesheet" href="{{ asset('assets/extensions/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/compiled/css/table-datatable-jquery.css') }}">
@endpush
@section('main')
    <div class="page-heading">
        <section class="section">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <div class="p-1">
                            <h5 class="card-title">Data {{ $data }}</h5>
                        </div>
                        <div class="p-1">                     
                        </div>
                    </div>
                </div>
            </div>

            @foreach ($da as $item)           
                @php                
                    $header = json_decode($item->doc->header);                 
                @endphp
                @if($item->doc->bak == null)              
                    <a href="{{ route('step.news', ['id' => md5($item->head)]) }}">
                        <div class="card rounded shadow-sm">
                            <div class="card-header bg-danger text-white small p-1">
                                <div class="d-flex justify-content-between px-1">
                                    <p class="my-auto">
                                        <span style="font-size: 0.85rem">No Dokumen :
                                        </span>{{ $item->doc->nomor }}
                                    </p>
        
                                    <p class="my-auto">
                                        <span style="font-size: 0.85rem">No Registrasi : </span>{{ $item->doc->reg }}
                                    </p>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row mt-3">
                                    <div class="col-md-4 col-6 mb-3">
                                        <h6>Tipe</h6>
                                        {{ ucfirst($item->doc->type) }}
                                    </div>
                                    <div class="col-md-4 col-6">
                                        <h6>Pemohon</h6>
                                        {{ $header[2] }}
                                    </div>
                                    <div class="col-md-4 col-12">
                                        <h6>Alamat</h6>
                                        {{ $header[4] }}
                                    </div>
                                    <div class="col-md-4 col-6 mb-3">
                                        <h6>Nama Bangunan</h6>
                                        {{ $header[5] }}
                                    </div>
                                    <div class="col-md-4 col-6 mb-3">
                                        <h6>Alamat Bangunan</h6>
                                        {{ $header[7] }} <br>Kec. {{ $item->doc->region->name }}, Kab.
                                        {{ $item->doc->region->kecamatan->name }}
                                    </div>
                                    <div class="col-md-4 col-6 mb-3">
                                        <h6>Fungsi</h6>
                                        {{ $header[6] }}
                                    </div>                  
                                </div>
                            </div>
                        </div>
                    </a>                      
                @else      
                    <div class="card rounded shadow-sm">
                        <div class="card-header {{($item->doc->bak->grant == 1) ? 'bg-success' : 'bg-primary'}} text-white small p-1">
                            <div class="d-flex justify-content-between px-1">
                                <p class="my-auto">
                                    <span style="font-size: 0.85rem">No Dokumen :
                                    </span>{{ $item->doc->number}}
                                </p>

                                <p class="my-auto">
                                    <span style="font-size: 0.85rem">No Registrasi : </span>{{ $item->doc->reg }}
                                </p>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row mt-3">
                                <div class="col-md-4 col-6 mb-3">
                                    <h6>Tipe</h6>
                                    {{ ucfirst($item->doc->type) }}
                                </div>
                                <div class="col-md-4 col-6">
                                    <h6>Pemohon</h6>
                                    {{ $header[2] }}
                                </div>
                                <div class="col-md-4 col-12">
                                    <h6>Alamat</h6>
                                    {{ $header[4] }}
                                </div>
                                <div class="col-md-4 col-6 mb-3">
                                    <h6>Nama Bangunan</h6>
                                    {{ $header[5] }}
                                </div>
                                <div class="col-md-4 col-6 mb-3">
                                    <h6>Alamat Bangunan</h6>
                                    {{ $header[7] }} <br>Kec. {{ $item->doc->region->name }}, Kab.
                                    {{ $item->doc->region->kecamatan->name }}
                                </div>
                                <div class="col-md-4 col-6 mb-3">
                                    <h6>Fungsi</h6>
                                    {{ $header[6] }}
                                </div>
                                <div class="col-md-4 col-6">
                                    <h6>Tahun Pembangunan</h6>
                                    {{ $item->doc->bak->plan }}
                                </div>
                                @if($item->doc->bak->grant == 0)
                                <div class="col-md-4 col-6">
                                    <h6>Tanda Tangan</h6>
                                    <button onclick="location.href='{{ route('sign.news', ['id' => md5($item->doc->bak->id)]) }}'" class="btn btn-primary btn-sm"><i class="bi bi-vector-pen"></i></button>                                   
                                </div>                    
                                @endif       
                            </div>
                        </div>
                    </div>          
                @endif
            @endforeach

            {!! $da->withQueryString()->links('pagination::bootstrap-5') !!}
        </section>
    </div>
@endsection

@push('js')
    <script src="{{ asset('assets/extensions/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/extensions/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/extensions/datatables.net-bs5/js/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('assets/static/js/pages/datatables.js') }}"></script>
@endpush
