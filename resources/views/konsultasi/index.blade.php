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
                        <a href="{{route('consultation.create')}}" class="btn btn-primary btn-sm">Tambah {{$data}}</a>
                    </div>
                </div>       
            </div>
        </div>

        @foreach($da as $item)                
        <div class="card rounded shadow-sm">
            <div class="card-header bg-primary text-white small p-1">
                <div class="d-flex justify-content-between px-1">
                    <p class="my-auto">
                        <span style="font-size: 0.85rem">No Dokumen : </span>{{$item->doc->nomor}}
                    </p>

                    <p class="my-auto">          
                        <span style="font-size: 0.85rem">No Registrasi : </span>{{$item->doc->reg}}              
                    </p>          
                    <div></div>
                </div>
            </div>
            <div class="card-body">
                <div class="row mt-3">
                    <div class="col-md-4 col-6 mb-3">
                        <h6>Notulen</h6>                  
                        &#9632; {!! ucfirst(implode("<br>&#9632; ",$item->notulens)) !!}         
                    </div>
                    <div class="col-md-4 col-6 mb-3">
                        <h6>Anggota</h6>
                        &#9632; {!! ucfirst(implode("<br>&#9632; ",$item->kons)) !!}
                    </div>                       
                    <div class="col-md-4 col-12 mb-3">
                        <h6>Action</h6>                  
                        <form onsubmit="return confirm('Apakah Anda Yakin Menghapus ?');" action="{{ route('consultation.destroy', $item->id) }}" method="POST">                                                                       
                            <a href="{{ route('consultation.edit', $item->id) }}" class="btn btn-sm btn-primary"><i class="bi bi-pencil"></i></a>             
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>                                                 
                        </form>
                    </div>                                     
                </div>
            </div>
        </div>
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