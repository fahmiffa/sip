@extends('layout.base')     
@push('css')
<link rel="stylesheet" href="{{asset('assets/extensions/choices.js/public/assets/styles/choices.css')}}">
@endpush
@section('main')
<div class="page-heading">  

    <section class="section">
        <div class="card">       

            <div class="card-header">
                <h5 class="card-title">{{$data}}</h5>                    
            </div>

            <div class="card-body">

                @isset($consultation)
                <form action="{{route('consultation.update',['consultation'=>$consultation])}}" method="post" enctype="multipart/form-data">                            
                @method('PATCH')   
                @else                                      
                    <form action="{{route('consultation.store')}}" method="post" enctype="multipart/form-data">                               
                @endif                    
                    @csrf           
                    <div class="px-5">
  
                        <div class="form-group row mb-3">        
                            <div class="col-md-8 mb-3">
                                <label>Pilih Dokumen</label>              
                                <select class="choices form-select" name="doc">
                                    <option value="">Pilih Dokumen</option>                                                                                            
                                    @foreach($doc as $item)                                                            
                                        <option value="{{$item->id}}"  @selected(isset($consultation) && $consultation->head == $item->id) >{{$item->reg}} ({{$item->nomor}})</option>                                 
                                    @endforeach                       
                                </select>
                                @error('doc')<div class='small text-danger text-left'>{{$message}}</div>@enderror
                            </div>                  
                        </div>

                        <div class="form-group row mb-3">
                            <div class="col-md-8">       
                                <label>Dokumen Rapat</label>
                                <input class="form-control" name="pile" type="file" accept=".pdf">
                                @error('pile')<div class='small text-danger text-left'>{{$message}}</div>@enderror
                            </div>
                        </div>
                                                
                        <div class="form-group row mb-3">        
                            <div class="col-md-8 mb-3">
                                <label>Notulen Konsultasi</label>              
                                <select class="choices form-select multiple-remove" name="notulen[]" multiple="multiple">
                                    <option value="">Pilih Konsultan</option>                                                                                            
                                    @foreach($user as $item)                         
                                            @isset($consultation);       
                                                @php $var = explode(",",$consultation->konsultan);                                  
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
                                @error('notulen')<div class='small text-danger text-left'>{{$message}}</div>@enderror
                            </div>                          
                        </div>

                        <div class="form-group row mb-3">        
                            <div class="col-md-8 mb-3">
                                <label>Anggota Konsultasi</label>              
                                <select class="choices form-select multiple-remove" name="konsultan[]" multiple="multiple">
                                    <option value="">Pilih Konsultan</option>                                                                                            
                                    @foreach($user as $item)                         
                                            @isset($consultation);       
                                                @php $var = explode(",",$consultation->konsultan);                                  
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
                                @error('konsultan')<div class='small text-danger text-left'>{{$message}}</div>@enderror
                            </div>     
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
<script src="{{asset('assets/extensions/choices.js/public/assets/scripts/choices.js')}}"></script>
<script src="{{asset('assets/static/js/pages/form-element-select.js')}}"></script>
@endpush