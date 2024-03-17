@extends('layout.base')
@push('css')
    <link rel="stylesheet" href="{{ asset('assets/extensions/choices.js/public/assets/styles/choices.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.rtl.min.css" />
@endpush
@section('main')
    <div class="page-heading">

        <section class="section">
            <div class="card">

                <div class="card-header">
                    <div class="divider">
                        <div class="divider-text">{{ $data }}</div>
                    </div>
                </div>

                <div class="card-body">

                    @isset($attach)
                        <form action="{{ route('attach.update', ['attach' => $attach]) }}" method="post" enctype="multipart/form-data">
                            @method('PATCH')
                        @else
                            <form action="{{ route('attach.store') }}" method="post" enctype="multipart/form-data">
                                @endif
                                @csrf
                                <div class="px-5">
                                    <input type="hidden" name="doc" value="{{ $head->id }}">

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label>Luas Tanah</label>
                                                <input type="text" name="luas" value="{{ old('luas') }}"
                                                    class="form-control">
                                                @error('luas')
                                                    <div class='small text-danger text-left'>{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label>Bukti Kepemilikan Tanah</label>
                                                <input type="text" name="bukti" value="{{ old('bukti') }}"
                                                    class="form-control">
                                                @error('bukti')
                                                    <div class='small text-danger text-left'>{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group mb-3">
                                                <label>Gambar Denah / Situasi</label>
                                                <input class="form-control" type="file" name="pile" accept=".jpg, .jpeg, .png">                               
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">     
                                                <label>Lokasi Bangunan</label>                                                                    
                                                <textarea class="form-control" name="lokasi" rows="2">{{ old('lokasi') }}</textarea>   
                                                @error('lokasi')
                                                <div class='small text-danger text-left'>{{ $message }}</div>
                                            @enderror                                                                    
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">     
                                                <label>Kondisi Lahan / Bangunan</label>                                                                    
                                                <textarea class="form-control" name="lahan" rows="2">{{ old('lahan') }}</textarea>   
                                                @error('lahan')
                                                <div class='small text-danger text-left'>{{ $message }}</div>
                                            @enderror                                                                    
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label>Koordinat</label>
                                                <input type="text" name="koordinat" value="{{ old('koordinat') }}"
                                                    class="form-control">
                                                @error('koordinat')
                                                    <div class='small text-danger text-left'>{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <button class="btn btn-primary rounded-pill">Save</button>
                                        <a class="btn btn-danger ms-1 rounded-pill" href="{{ route('attach.index') }}">Back</a>
                                    </div>
                                </div>
                            </form>
                    </div>
                </div>

            </section>

        </div>
    @endsection

    @push('js')
        <script src="{{ asset('assets/extensions/jquery/jquery.min.js') }}"></script>
        <script src="{{ asset('assets/extensions/choices.js/public/assets/scripts/choices.js') }}"></script>
        <script src="{{ asset('assets/static/js/pages/form-element-select.js') }}"></script>
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

        <script>
            $('#type').on('change', function() {
                var tipe = $(this).val();

                if (tipe == 'umum') {
                    $('#con').html('Fungsi');
                } else {
                    $('#con').html('Koordinat');
                }
            });

            $('.select-field').select2({
                theme: 'bootstrap-5'
            });

            $('#dis').on('change', function(e) {
                e.preventDefault();
                $('#des').empty();
                $.ajax({
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "{{ route('village') }}",
                    data: {
                        id: $(this).val()
                    },
                    success: function(data) {
                        $.each(data, function(key, value) {
                            $('#des').append('<option value="' + key + '">' + value + '</option>');
                        });
                    }
                });
            });
        </script>
    @endpush
