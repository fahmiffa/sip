@extends('layout.base')     
@push('css')
<link rel="stylesheet" href="{{asset('assets/extensions/datatables.net-bs5/css/dataTables.bootstrap5.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/compiled/css/table-datatable-jquery.css')}}">
@endpush
@section('main')
<div class="page-heading">

    <!-- Basic Tables start -->
    <section class="section">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between py-3">
                    <div class="p-2">
                        <h5 class="card-title">Data {{$data}}</h5>
                    </div>
                    <div class="p-2">
                        <a href="{{route('verifikasi.create')}}" class="btn btn-primary btn-sm">Tambah {{$data}}</a>
                    </div>
                </div>       
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table" id="table1">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Nomor</th>  
                                <th>Task</th>  
                                <th>Verifikator</th>      
                                <th>Tipe</th>                                      
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($da as $item)
                            <tr style="{{($item->deleted_at) ? 'background-color:#fedddd' : null}}">
                                <td>{{$loop->iteration}}</td>
                                <td>{{$item->nomor}}</td> 
                                <td>{{$item->step}} Tahap</td>   
                                <td>&#9632; {!! ucfirst(implode("<br>&#9632; ",$item->verif)) !!}</td>   
                                <td>{{ucfirst($item->type)}}</td>                                      
                                <td>                
                                    @if($item->status == 5)
                                       <button type="button" class="btn btn-dark btn-sm"><i class="bi bi-file-pdf"></i></button>                                    
                                    @endif
                                    @if($item->status < 5 && $item->status != 1)
                                       <button type="button" class="btn btn-warning btn-sm"><i class="bi bi-file-pdf"></i></button>                                 
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
                                </td>  
                                <td>              
                                    @if($item->deleted_at == null && $item->status == 5)  
                                    <form onsubmit="return confirm('Apakah Anda Yakin Menghapus ?');" action="{{ route('verifikasi.destroy', $item->id) }}" method="POST">                                                                       
                                        <a href="{{ route('verifikasi.edit', $item->id) }}" class="btn btn-sm btn-primary"><i class="bi bi-pencil"></i></a>                                       
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>
                                    </form>
                                    @endif
                                </td>                    
                            </tr>            
                            @endforeach      
                        </tbody>
                    </table>

                    @foreach($da as $item)
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
                </div>
            </div>
        </div>

    </section>
    <!-- Basic Tables end -->

</div>
@endsection

@push('js')    
<script src="{{asset('assets/extensions/jquery/jquery.min.js')}}"></script>
<script src="{{asset('assets/extensions/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/extensions/datatables.net-bs5/js/dataTables.bootstrap5.min.js')}}"></script>
<script src="{{asset('assets/static/js/pages/datatables.js')}}"></script>
@endpush