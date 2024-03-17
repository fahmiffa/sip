@extends('layout.base')     
@push('css')
<link rel="stylesheet" href="{{asset('assets/extensions/choices.js/public/assets/styles/choices.css')}}">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.rtl.min.css" />
@endpush
@section('main')
<div class="page-heading">  

    <section class="section">
        <div class="card">       

            <div class="card-header">
                <div class="divider">
                    <div class="divider-text">{{$data}}</div>
                </div>               
            </div>

            <div class="card-body">

                @isset($meet)
                <form action="{{route('meet.update',['meet'=>$meet])}}" method="post">                            
                @method('PATCH')   
                @else                                      
                    <form action="{{route('meet.store')}}" method="post">                               
                @endif                    
                    @csrf           
                    <div class="px-5">
                        <input type="hidden" name="doc" value="{{$head->id}}">   
                        <div class="row">                       
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label>NIB</label>
                                    <input type="text" name="nib" value="{{old('nib')}}" class="form-control">
                                    @error('nib')<div class='small text-danger text-left'>{{ $message }}</div>@enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label>Tanggal Konsultasi</label>
                                    <input type="date" name="date" value="{{old('date')}}" class="form-control">
                                    @error('date')<div class='small text-danger text-left'>{{ $message }}</div>@enderror
                                </div>
                            </div>                      
                        </div>
                           
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label>Status Kepemilikan</label>
                                    <select class="form-control" name="status" placeholder="status">
                                        <option value="">Pilih Status</option>
                                        <option value="perorangan" @selected(old('kondisi') == 'perorangan') @selected(isset($meet) && $meet->header == 'perorangan')>Perorangan / Badan Usaha</option>
                                        <option value="pemerintah" @selected(old('kondisi') == 'pemerintah') @selected(isset($meet) && $meet->header == 'pemerintah')>Pemerintah</option>                                        
                                    </select>
                                    @error('status')<div class='small text-danger text-left'>{{ $message }}</div>@enderror
                                </div>
                            </div>       
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label>Jenis Permohonan</label>
                                    <select class="form-control" name="jenis">
                                        <option value="">Pilih jenis</option>
                                        @php
                                            $val = ['baru','perubahan','kolektif','prasarana','cagar_budaya','existing'];
                                        @endphp
                                        @foreach($val as $item)
                                            <option value="{{$item}}" @selected(old('jenis') == $item) @selected(isset($meet) && $meet->header == 'permanen')>{{ucwords(str_replace('_',' ',$item))}}</option>
                                        @endforeach                                        
                                    </select>
                                    @error('jenis')<div class='small text-danger text-left'>{{ $message }}</div>@enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label>Fungsi Bangunan</label>
                                    <select class="form-control" name="fungsi">
                                        <option value="">Pilih fungsi</option>
                                        @php
                                            $val = ['hunian','keagamaan','usaha','sosial_budaya','khusus','campuran'];
                                        @endphp
                                        @foreach($val as $item)
                                            <option value="{{$item}}" @selected(old('fungsi') == $item) @selected(isset($meet) && $meet->header == 'permanen')>{{ucwords(str_replace('_',' ',$item))}}</option>
                                        @endforeach                                        
                                    </select>
                                    @error('fungsi')<div class='small text-danger text-left'>{{ $message }}</div>@enderror
                                </div>
                            </div>         
                        </div>
                        
                        <div class="col-md-12" >
                            <button class="btn btn-primary rounded-pill">Save</button>
                            <a class="btn btn-danger ms-1 rounded-pill" href="{{route('meet.index')}}">Back</a>
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
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
$('#type').on('change',function(){
    var tipe = $(this).val();

    if(tipe == 'umum')
    {
        $('#con').html('Fungsi');
    }
    else
    {
        $('#con').html('Koordinat');
    }
});

$( '.select-field' ).select2( {
    theme: 'bootstrap-5'
});

$('#dis').on('change',function(e){
    e.preventDefault();    
    $('#des').empty();
    $.ajax({
        type:'POST',
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url:"{{ route('village') }}",
        data:{id:$(this).val()},
        success:function(data){                        
            $.each(data, function(key, value) {
                $('#des').append('<option value="' + key + '">' + value + '</option>');
            });
        }
    });
});

</script>

@endpush