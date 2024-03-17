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
                    $header = json_decode($item->header);                    
                @endphp
                @if($item->attach == null)              
                    <a href="{{ route('step.attach', ['id' => md5($item->id)]) }}">
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
                        <div class="card-header bg-success text-white small p-1">
                            <div class="d-flex justify-content-between px-1">
                                <p class="my-auto">
                                    <span style="font-size: 0.85rem">No Dokumen :
                                    </span>{{str_replace('SPm','LDP',str_replace('600.1.15','600.1.15/PBLT',$item->nomor))}}
                                </p>

                                <p class="my-auto">
                                    <span style="font-size: 0.85rem">No Registrasi : </span>{{ $item->reg }}
                                </p>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row mt-3">                        
                                <div class="col-md-4 col-6">
                                    <h6>Luas Tanah</h6>
                                    {{ $item->attach->luas }}
                                </div>
                                <div class="col-md-4 col-12">
                                    <h6>Bukti Kepemilikan Tanah</h6>                   
                                    {{ $item->attach->bukti }}
                                </div>
                                <div class="col-md-4 col-6 mb-3">
                                    <h6>Lokasi Bangunan</h6>                  
                                    {{ $item->attach->lokasi }}
                                </div>
                                <div class="col-md-4 col-6 mb-3">
                                    <h6>Kondisi Lahan / Bangunan</h6> 
                                    {{ $item->attach->lahan }}
                                </div>
                                <div class="col-md-4 col-6 mb-3">
                                    <h6>Koordinat</h6>     
                                    {{ $item->attach->koordinat }}<br>
                                    <a target="_blank" class="btn btn-sm btn-primary rounded-pill" href="https://www.google.com/maps/search/?api=1&query={{$item->attach->koordinat}}">Open</a>
                                </div>
                                <div class="col-md-4 col-6 mb-3">
                                    <h6>File</h6>     
                                    <a target="_blank" href="{{ route('doc.attach', ['id'=>md5($item->id)]) }}" class="btn btn-sm btn-danger"><i class="bi bi-file-pdf"></i></a>     
                                </div>
                                <div class="col-md-4 col-6">
                                    <h6>Gambar Denah / Lokasi</h6>
                                    <img src="{{asset('storage/'.$item->attach->gambar)}}" class="w-25">
                                </div>                         
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
