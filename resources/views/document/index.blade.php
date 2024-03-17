@extends('layout.base')     
@push('css')
<link rel="stylesheet" href="{{asset('assets/extensions/datatables.net-bs5/css/dataTables.bootstrap5.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/compiled/css/table-datatable-jquery.css')}}">
@endpush
@section('main')
<div class="page-heading">
    <section class="section">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <div class="p-1">
                        <h5 class="card-title">Data {{$data}}</h5>
                    </div>
                    <div class="p-1">
                        <a href="{{route('verifikasi.create')}}" class="btn btn-primary btn-sm rounded-pill">Tambah {{$data}}</a>
                    </div>
                </div>       
            </div>
            <div class="card-body">                   
               <div class="px-1">
                <form action="{{route('verifikasi.index')}}" method="get">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">               
                                <input type="text" class="form-control" name="key" placeholder="Masukan kata kunci">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">                 
                                <select class="form-control" name="opsi" required>
                                    <option value="">Pilih Opsi</option>
                                    <option value="step">Tahap</option>
                                    <option value="nomor">Nomor Dokumen</option>                              
                                    <option value="type">Tipe</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <button class="btn btn-primary rounded-pill">Filter</button>
                            <button type="button" onclick="location.href='{{route('verifikasi.index')}}'" class="btn btn-secondary rounded-pill">Reset</button>
                        </div>
                    </div>
                </form>
               </div>
            </div>
        </div>

        @foreach($da as $item)                
        <div class="card rounded shadow-sm">
            <div class="card-header {{$item->grant == 1 ? 'bg-success' : 'bg-primary'}} text-white small p-1">
                <div class="d-flex justify-content-between px-1">
                    <p class="my-auto">
                        <span style="font-size: 0.85rem">No Dokumen : </span>{{$item->id}}  {{$item->nomor}}
                    </p>

                    <p class="my-auto"> 
                        <span style="font-size: 0.85rem">No Registrasi : </span>{{$item->reg}}
                    </p>

                    <p class="my-auto"> 
                        <span style="font-size: 0.85rem">Status Dokumen : </span>{{$item->dokumen}}
                    </p>

                    @if($item->head->count() > 0)
                    <button type="button" class="btn btn-dark btn-sm" data-bs-toggle="modal" data-bs-target="#log{{$item->id}}"><i class="bi bi-tools"></i></button> 
                    @else
                    <div></div>
                    @endif
                </div>
            </div>
            <div class="card-body">
                <div class="row mt-3">
                    <div class="col-md-3 col-6 mb-3">
                        <h6>Task</h6>
                        {{$item->step}} Tahap
                    </div>
                    <div class="col-md-3 col-6 mb-3">
                        <h6>Verifikator</h6>
                        &#9632; {!! ucfirst(implode("<br>&#9632; ",$item->verif)) !!}                
                    </div>
                    <div class="col-md-3 col-6 mb-3">
                        <h6>Tipe</h6>                  
                        {{ucfirst($item->type)}}
                    </div>
                    @if($item->status != 5)              
                    <div class="col-md-3 col-12 mb-3">
                        <h6>Status</h6>                                                         
                        @if($item->status < 5 && $item->status != 1)
                        {{-- <a target="_blank" href="{{ route('doc.verifikasi', ['id'=>md5($item->id)]) }}" class="btn btn-sm btn-danger"><i class="bi bi-file-pdf"></i></a>   --}}
                            <button type="button" class="btn btn-warning text-dark btn-sm rounded-pill">On Progress</button>                             
                        @endif

                        @if($item->status == 1 && $item->deleted_at == null)                     
                            <a target="_blank" href="{{ route('doc.verifikasi', ['id'=>md5($item->id)]) }}" class="btn btn-sm btn-danger"><i class="bi bi-file-pdf"></i></a>  
                            @if($item->grant == 0)
                                <button type="button" class="btn btn-primary btn-sm rounded-pill" data-bs-toggle="modal" data-bs-target="#ver{{$item->id}}">
                                Verifikasi
                                </button>
                            @else
                            <button type="button" class="btn btn-success btn-sm rounded-pill">Success</button>
                            @endif
                        @endif                                          
                    </div>
                    @elseif($item->status == 5)  
                    <div class="col-md-3 col-12 mb-3">
                        <h6>Action</h6>                  
                        <form onsubmit="return confirm('Apakah Anda Yakin Menghapus ?');" action="{{ route('verifikasi.destroy', $item->id) }}" method="POST">                                                                       
                            <a href="{{ route('verifikasi.edit', $item->id) }}" class="btn btn-sm btn-primary"><i class="bi bi-pencil"></i></a>                                       
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>                     
                        </form>
                    </div>                  
                    @endif         
                </div>
            </div>
        </div>

        <div class="modal fade" id="ver{{$item->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel{{$item->id}}">Verifikasi Dokumen</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{route('doc.approve',['id'=>md5($item->id)])}}" method="post">                                                                               
                        @csrf   
                        <p>Anda akan menerima dokumen ini dan melanjutkan ke Penunjukan TPA/TPT ?<p>                                         
                        <button class="btn btn-success rounded-pill">Diterima</button>
                        <button type="button" class="btn btn-danger rounded-pill" data-bs-toggle="modal" data-bs-target="#re{{$item->id}}">Ditolak</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>                            
                </div>
            </div>
            </div>
        </div>

        @if($item->head->count() > 0)
            <div class="modal fade" id="log{{$item->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel{{$item->id}}">Riwayat Perbaikan Dokumen</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <ol>
                            @foreach($item->head as $val)
                            <li>{{$val->id}} {{$val->reg}} ({{$val->nomor}}) <a target="_blank" href="{{ route('doc.verifikasi', ['id'=>md5($val->id)]) }}" class="btn btn-sm btn-danger"><i class="bi bi-file-pdf"></i></a>  </li>
                            @endforeach
                        </ol>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>                            
                    </div>
                </div>
                </div>
            </div>
        @endif

        <div class="modal fade" id="re{{$item->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel{{$item->id}}">Menolak Verifikasi Dokumen</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{route('doc.reject',['id'=>md5($item->id)])}}" method="post">                                                                                  
                        @csrf   
                        <p class="mb-3">Anda akan menolak dokumen ini ?<p>
                        <label>Catatan : </label>
                         <textarea class="form-control" name="noted" required></textarea>
                        <button class="btn btn-success rounded-pill mt-3">Setuju</button>                                        
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>                            
                </div>
            </div>
            </div>
        </div>
        @endforeach

        {!! $da->withQueryString()->links('pagination::bootstrap-5') !!}
    </section>  
</div>
@endsection

@push('js')    
<script src="{{asset('assets/extensions/jquery/jquery.min.js')}}"></script>
<script src="{{asset('assets/extensions/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/extensions/datatables.net-bs5/js/dataTables.bootstrap5.min.js')}}"></script>
<script src="{{asset('assets/static/js/pages/datatables.js')}}"></script>
@endpush