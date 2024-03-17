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
                        <h5 class="card-title">Task {{$data}}</h5>
                    </div>
                    <div class="p-2">                     
                    </div>
                </div>       
            </div>
            <div class="card-body d-none">
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
                                            <a href="{{ route('step.verifikasi', ['id'=>md5($item->id)]) }}" class="btn btn-sm btn-primary"><i class="bi bi-files"></i></a>                                                                                                            
                                        @else
                                            <a href="{{ route('step.verifikasi', ['id'=>md5($item->id)]) }}" class="btn btn-sm btn-primary"><i class="bi bi-files"></i></a>                                                                         
                                        @endif                       
                                        {{-- <a target="_blank" href="{{ route('doc.verifikator', ['id'=>md5($item->id)]) }}" class="btn btn-sm btn-danger"><i class="bi bi-file-pdf"></i></a>      --}}
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

        @foreach($da as $item)                
        @php 
        $kode = auth()->user()->roles->kode;
        $header = json_decode($item->header); 
        
        if($item->steps->count() > 0)
        {
            foreach($item->steps as $val)
            {
                $handle = ($val->kode == $kode) ? true : false;
            }
        }
        else
        {
            $handle = false;
        }
        @endphp        
        @if($item->task)
            @if($item->status == 1)
                <div class="card rounded shadow-sm">
                    <div class="card-header bg-primary text-white small p-1">
                        <div class="d-flex justify-content-between px-1">
                            <p class="my-auto">
                                <span style="font-size: 0.85rem">No Dokumen : </span>{{$item->nomor}}
                            </p>

                            <p class="my-auto"> 
                                <span style="font-size: 0.85rem">No Registrasi : </span>{{$item->reg}}
                            </p>          
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row mt-3">
                            <div class="col-md-3 col-6">
                                <h6>Tipe</h6>                  
                                {{ucfirst($item->type)}}
                            </div>
                            <div class="col-md-3 col-6">
                                <h6>Pemohon</h6>
                                {{ $header[2] }}
                            </div>          
                            <div class="col-md-3 col-6">
                                <h6>Nama Bangunan</h6>
                                {{ $header[5] }}              
                            </div>
                            <div class="col-md-3 col-6">
                                <h6>Fungsi</h6>
                                {{ $header[6] }}           
                            </div>                                             
                        </div>
                    </div>
                </div>
            @else
                <a href="{{ route('step.verifikasi', ['id'=>md5($item->id)]) }}">
                    <div class="card rounded shadow-sm">
                        <div class="card-header {{$handle ? 'bg-primary' : 'bg-danger'}} text-white small p-1">
                            <div class="d-flex justify-content-between px-1">
                                <p class="my-auto">
                                    <span style="font-size: 0.85rem">No Dokumen : </span>{{$item->nomor}}                                                   
                                </p>
        
                                <p class="my-auto"> 
                                    <span style="font-size: 0.85rem">No Registrasi : </span>{{$item->reg}}
                                </p>          
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row mt-3">
                                <div class="col-md-3 col-6">
                                    <h6>Tipe</h6>                  
                                    {{ucfirst($item->type)}}
                                </div>
                                <div class="col-md-3 col-6">
                                    <h6>Pemohon</h6>
                                    {{ $header[2] }}
                                </div>          
                                <div class="col-md-3 col-6">
                                    <h6>Nama Bangunan</h6>
                                    {{ $header[5] }}              
                                </div>
                                <div class="col-md-3 col-6">
                                    <h6>Fungsi</h6>
                                    {{ $header[6] }}           
                                </div>                                             
                            </div>
                        </div>
                    </div>
                </a>
            @endif
        @endif
        @endforeach

        {!! $da->withQueryString()->links('pagination::bootstrap-5') !!}
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