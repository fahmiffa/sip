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

                @isset($news)
                <form action="{{route('news.update',['news'=>$news])}}" method="post">                            
                @method('PATCH')   
                @else                                      
                    <form action="{{route('news.store')}}" method="post">                               
                @endif                    
                    @csrf           
                    <div class="px-5">
                        <input type="hidden" name="doc" value="{{$head->id}}">                                             
                        <div class="row">
                            <h6>Batas Lahan / Lokasi</h6>
                            <div class="col-md-3">
                                <div class="form-group mb-3">
                                    <label>Utara</label>
                                    <input type="text" name="north" value="{{isset($news) ? $news->reg : old('north')}}" class="form-control">
                                    @error('north')<div class='small text-danger text-left'>{{ $message }}</div>@enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group mb-3">
                                    <label>Selatan</label>
                                    <input type="text" name="south" value="{{isset($news) ? $news->reg : old('south')}}" class="form-control">
                                    @error('south')<div class='small text-danger text-left'>{{ $message }}</div>@enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group mb-3">
                                    <label>Timur</label>
                                    <input type="text" name="east" value="{{isset($news) ? $news->reg : old('east')}}" class="form-control">
                                    @error('east')<div class='small text-danger text-left'>{{ $message }}</div>@enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group mb-3">
                                    <label>Barat</label>
                                    <input type="text" name="west" value="{{isset($news) ? $news->reg : old('west')}}" class="form-control">
                                    @error('west')<div class='small text-danger text-left'>{{ $message }}</div>@enderror
                                </div>
                            </div>
                        </div>         
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label>Kondisi</label>
                                    <select class="form-control" name="kondisi" placeholder="kondisi">
                                        <option value="">Pilih kondisi</option>
                                        <option value="belum" @selected(old('kondisi') == 'belum') @selected(isset($news) && $news->header == 'belum')>Belum</option>
                                        <option value="sedang" @selected(old('kondisi') == 'sedang') @selected(isset($news) && $news->header == 'sedang')>Sedang</option>
                                        <option value="sudah_dibangun" @selected(old('kondisi') == 'sudah_dibangun') @selected(isset($news) && $news->header == 'sudah_dibangun')>Sudah Dibangun</option>
                                    </select>
                                    @error('kondisi')<div class='small text-danger text-left'>{{ $message }}</div>@enderror
                                </div>
                            </div>       
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label>Tingkat Permanensi</label>
                                    <select class="form-control" name="permanensi">
                                        <option value="">Pilih permanensi</option>
                                        <option value="permanen" @selected(old('permanensi') == 'permanen') @selected(isset($news) && $news->header == 'permanen')>Permanen</option>
                                        <option value="non_permanen" @selected(old('permanensi') == 'non_permanen') @selected(isset($news) && $news->header == 'non_permanen')>Non Permanen</option>                                        
                                    </select>
                                    @error('permanensi')<div class='small text-danger text-left'>{{ $message }}</div>@enderror
                                </div>
                            </div>         

                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label>Tahun Pembangunan</label>
                                    <select class="form-control" name="build">
                                        <option value="">Pilih tahun</option>
                                        @php $year = date('Y'); @endphp
                                        @for ($i = 5; $i > 0; $i--)
                                            <option value="{{$year+$i}}" @selected(old('build') == $year+$i)>{{$year+$i}}</option>
                                        @endfor
                                        @for ($i = 0; $i < 5; $i++)
                                            <option value="{{$year-$i}}" @selected(old('build') == $year-$i)>{{$year-$i}}</option>
                                        @endfor                                      
                                    </select>
                                    @error('build')<div class='small text-danger text-left'>{{ $message }}</div>@enderror
                                </div>
                            </div>         
                        </div>
                        
                        <div class="col-md-12" >
                            <button class="btn btn-primary rounded-pill">Save</button>
                            <a class="btn btn-danger ms-1 rounded-pill" href="{{route('news.index')}}">Back</a>
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