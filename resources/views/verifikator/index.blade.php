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
                                <th>Tipe</th>                                                         
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($da as $item)
                            @if($item->task)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$item->nomor}}</td>                   
                                <td>{{ucfirst($item->type)}}</td>                                      
                                <td>                
                                    @if($item->status == 1)
                                        <a target="_blank" href="{{ route('doc.verifikator', ['id'=>md5($item->id)]) }}" class="btn btn-sm btn-danger"><i class="bi bi-file-pdf"></i></a>                                                                                                                                        
                                    @else      
                                        @if($item->step == 2)
                                            @foreach($item->steps as $val)
                                                @if($val->kode != auth()->user()->roles->kode)
                                                    <a href="{{ route('step.verifikasi', ['id'=>md5($item->id)]) }}" class="btn btn-sm btn-primary"><i class="bi bi-files"></i></a>                                                                         
                                                @endif
                                            @endforeach
                                        @else
                                            <a href="{{ route('step.verifikasi', ['id'=>md5($item->id)]) }}" class="btn btn-sm btn-primary"><i class="bi bi-files"></i></a>                                                                         
                                        @endif                       
                                    @endif                                        
                                </td>                    
                            </tr>            
                            @endif
                            @endforeach      
                        </tbody>
                    </table>
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