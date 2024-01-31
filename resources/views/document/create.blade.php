@extends('layout.base')     
@push('css')
<link rel="stylesheet" href="{{asset('assets/extensions/choices.js/public/assets/styles/choices.css')}}">
<link rel="stylesheet" href="{{asset('assets/extensions/datatables.net-bs5/css/dataTables.bootstrap5.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/compiled/css/table-datatable-jquery.css')}}">

@endpush
@section('main')
<div class="page-heading">  

    <section class="section">
        <div class="card">       

            <div class="card-header">
                <h5 class="card-title">{{$data}}</h5>                    
            </div>

            <div class="card-body">

                @isset($verifikasi)
                <form action="{{route('verifikasi.update',['verifikasi'=>$verifikasi])}}" method="post">                            
                @method('PATCH')   
                @else                                      
                    <form action="{{route('verifikasi.store')}}" method="post">                               
                @endif                    
                    @csrf           
                    <div class="px-5">
                        <div class="form-group row mb-3">
                            <div class="col-md-8">
                                <label>No Dokumen</label>
                                @if(old('name'))
                                    <input type="text" name="name" value="{{old('name')}}" class="form-control">             
                                @else
                                    <input type="text" name="name" value="{{isset($verifikasi) ? $verifikasi->nomor : nomor()}}"   class="form-control">             
                                @endif                                
                                @error('name')<div class='small text-danger text-left'>{{$message}}</div>@enderror
                            </div>
                        </div> 
                        
                        <div class="form-group row mb-3">
                            <div class="col-md-8 mb-3">
                                <label>Jenis</label>              
                                <select class="choices form-select" name="type">
                                    <option value="">Pilih Jenis</option>
                                    @php $doc = baseDoc();  @endphp                                    
                                    @foreach($doc as $item)
                                    @if(old('type'))
                                        <option value="{{$item}}"  @selected(old('type') == $item) >{{ucfirst($item)}}</option>
                                    @else
                                        <option value="{{$item}}"  @selected(isset($verifikasi) && $verifikasi->type == $item) >{{ucfirst($item)}}</option>
                                    @endif
                                    @endforeach                       
                                </select>
                                @error('type')<div class='small text-danger text-left'>{{$message}}</div>@enderror
                            </div>
                            <div class="col-md-8">
                                <label>Verifikator</label>              
                                <select class="choices form-select multiple-remove" name="verifikator[]" multiple="multiple">
                                    <option value="">Pilih Verifikator</option>                                                                                            
                                    @foreach($user as $item)                         
                                            @isset($verifikasi);       
                                                @php $var = explode(",",$verifikasi->verifikator);                                  
                                                @endphp                                                     
                                                <optgroup label="{{$item->name}}">
                                                    @foreach($item->user as $val)                                                
                                                        <option value="{{$val->id}}"  @selected(in_array($val->id,$var)) >{{ucfirst($val->name)}}</option>                                 
                                                    @endforeach
                                                </optgroup>         
                                            @else

                                            <optgroup label="{{$item->name}}">
                                                @foreach($item->user as $val)                                                
                                                    <option value="{{$val->id}}">{{ucfirst($val->name)}}</option>                                 
                                                @endforeach
                                            </optgroup>  
                                            
                                            @endisset
                                    @endforeach                       
                                </select>
                                @error('verifikator')<div class='small text-danger text-left'>{{$message}}</div>@enderror
                            </div>
                        </div>
                                                
                        <div class="form-group row mb-3">             
                            <div class="col-md-12" >
                                <button class="btn btn-primary rounded-pill">Save</button>
                                <a class="btn btn-danger ms-1 rounded-pill" href="{{route('verifikasi.index')}}">Back</a>
                            </div>
                        </div>

                    </div>             
                </form>
            </div>
        </div>

    </section>

</div>
@endsection

@push('js')    
<script src="{{asset('assets/extensions/jquery/jquery.min.js')}}"></script>
<script src="{{asset('assets/extensions/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/extensions/datatables.net-bs5/js/dataTables.bootstrap5.min.js')}}"></script>
<script src="{{asset('assets/static/js/pages/datatables.js')}}"></script>

<script src="{{asset('assets/extensions/choices.js/public/assets/scripts/choices.js')}}"></script>
<script src="{{asset('assets/static/js/pages/form-element-select.js')}}"></script>

@endpush