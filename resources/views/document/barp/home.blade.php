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
                            {{-- @if ($ver == false)
                            <button onclick="location.href='{{route('news.create')}}'" class="btn btn-primary btn-sm rounded-pill">Tambah</button>
                        @endif --}}
                        </div>
                    </div>
                </div>
            </div>

            @foreach ($da as $item)
                @php
                    $header = json_decode($item->header);                    
                @endphp
                @if($item->barp == null)              
                    <a href="{{ route('step.meet', ['id' => md5($item->id)]) }}">
                        <div class="card rounded shadow-sm">
                            <div class="card-header bg-danger text-white small p-1">
                                <div class="d-flex justify-content-between px-1">
                                    <p class="my-auto">
                                        <span style="font-size: 0.85rem">No Dokumen :
                                        </span>{{ $item->number }}
                                    </p>
        
                                    <p class="my-auto">
                                        <span style="font-size: 0.85rem">No Registrasi : </span>{{ $item->reg }}
                                    </p>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row mt-3">
                                    <div class="col-md-4 col-6 mb-3">
                                        <h6>Tipe</h6>
                                        {{ ucfirst($item->type) }}
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
                                        {{ $header[7] }} <br>Kec. {{ $item->region->name }}, Kab.
                                        {{ $item->region->kecamatan->name }}
                                    </div>
                                    <div class="col-md-4 col-6 mb-3">
                                        <h6>Fungsi</h6>
                                        {{ $header[6] }}
                                    </div> 
                                    <div class="col-md-4 col-6">
                                        <h6>Tahun Pembangunan</h6>
                                        {{ $item->bak->plan }}
                                    </div>                 
                                </div>
                            </div>
                        </div>
                    </a>                      
                @else   
                    @php                        
                        $items = json_decode($item->barp->header);    
                    @endphp   
                    <div class="card rounded shadow-sm">
                        <div class="card-header {{($item->barp->grant == 1) ? 'bg-success' : 'bg-primary'}} text-white small p-1">
                            <div class="d-flex justify-content-between px-1">
                                <p class="my-auto">
                                    <span style="font-size: 0.85rem">No Dokumen :
                                    </span>{{ $item->number}}
                                </p>

                                <p class="my-auto">
                                    <span style="font-size: 0.85rem">No Registrasi : </span>{{ $item->reg }}
                                </p>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row mt-3">
                                <div class="col-md-4 col-6 mb-3">
                                    <h6>Tipe</h6>
                                    {{ ucfirst($item->type) }}
                                </div>
                                <div class="col-md-4 col-6">
                                    <h6>Pemohon</h6>
                                    {{ $header[2] }}
                                </div>
                                <div class="col-md-4 col-12">
                                    <h6>NIB</h6>                   
                                    {{$items->nib}}    
                                </div>
                                <div class="col-md-4 col-6 mb-3">
                                    <h6>Status Kepemilikan</h6>                  
                                    {{ucwords(($items->status == 'perorangan') ? 'Perorangan / Badan Usaha' : $items->status)}}
                                </div>
                                <div class="col-md-4 col-6 mb-3">
                                    <h6>Jenis Permohonan</h6> 
                                    {{ucwords(str_replace('_',' ',$items->jenis))}}
                                </div>
                                <div class="col-md-4 col-6 mb-3">
                                    <h6>Fungsi Bangunan</h6>     
                                    {{ucwords(str_replace('_',' ',$items->fungsi))}}   
                                </div>
                                <div class="col-md-4 col-6">
                                    <h6>Tanggal Konsultasi</h6>
                                    {{ dateID($item->barp->tanggal)}}
                                </div>
                                @if($item->bak->grant == 0)
                                <div class="col-md-4 col-6">
                                    <h6>Tanda Tangan</h6>
                                    <button onclick="location.href='{{ route('sign.news', ['id' => md5($item->bak->id)]) }}'" class="btn btn-primary btn-sm"><i class="bi bi-vector-pen"></i></button>                                   
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
