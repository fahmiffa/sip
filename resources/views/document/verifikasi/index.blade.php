@extends('layout.base')
@push('css')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.rtl.min.css" />
@endpush
@section('main')

    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h6>{{ $data }}</h6>
                </div>
            </div>

            <section class="section">
                <div class="card">

                    <div class="card-header">
                        <h6 class="card-title text-center">{{ $doc->titles }}</h6>
                        <p class="text-center">{{ $head->nomor }}</p>
                    </div>

                    <div class="card-body">     
                        
                        @if($head->step == 1)
                            <form action="{{ route('next.verifikasi', ['id' => md5($head->id)]) }}" method="post">
                                @csrf                                             
                                @include('document.verifikasi.step')                
                                <div class="col-md-12">
                                    <div class="col-md-12">
                                        <div class="d-flex justify-content-between">
                                            <button class="btn btn-primary rounded-pill">Next</button>     
                                            {{-- @if($head->status != 5)
                                                <button type="button" onclick="prev()" class="btn btn-danger rounded-pill float-end">Back</button>                                                    
                                            @endif --}}
                                        </div>
                                    </div>
                                </div>
                            </form>  
                            {{-- <form action="{{ route('back.verifikasi', ['id' => md5($head->id)]) }}" id="back" method="post">
                                @csrf
                            </form> --}}
                        @else
                            <form action="{{ route('nexts.verifikasi', ['id' => md5($head->id)]) }}" method="post">
                                @csrf                                                 
                                @include('document.verifikasi.steps')                
                                <div class="col-md-12">
                                    <div class="col-md-12">
                                        <div class="d-flex justify-content-between">
                                            <button class="btn btn-primary rounded-pill">Save</button>                                     
                                        </div>
                                    </div>
                                </div>
                            </form>  
                        @endif                                         
                    </div>
                </div>

            </section>

        </div>
    </div>
    @endsection

    @push('js')
        <script src="{{ asset('assets/extensions/jquery/jquery.min.js') }}"></script>   
    @endpush
