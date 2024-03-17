@extends('layout.base')
@push('css')
    <link rel="stylesheet" href="https://unpkg.com/x-data-spreadsheet@latest/dist/xspreadsheet.css" />
    {{-- <style>
    .x-spreadsheet-sheet {
        width: 925px !important;
        height: 400px;
        overflow: hidden;
    }
    </style> --}}
@endpush
@section('main')
    <div class="page-heading">

        <section class="section">
            <div class="card">

                <div class="card-header">
                    <h5 class="card-title">Perhitungan Retribusi</h5>
                    <div class="divider">
                        <div class="divider-text">{{ $data }}</div>
                    </div>
                </div>

                <div class="card-body">

                    <form action="{{ route('tax.store', ['id' => md5($head->id)]) }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-12">
                                <div id="spreadsheet" class="my-3 shadow-sm border border-light overflow-hidden"></div>    
                            </div>
                        </div>
                        <br>        
                        <div class="px-5">
                            
                            @if ($tax)               
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group mb-3">
                                            <h6>Perhitungan Nilai Retribusi Bangunan Gedung</h6>
                                            <div class="form-group">
                                                <div class="row mb-3" id="master">
                                                    <div class="col-md-4">
                                                        <input type="text" class="form-control" name="bg[]"
                                                            placeholder="Uraian">
                                                    </div>
                                                    <div class="col-md-4">
                                                        <input type="text" class="form-control" name="bgv[]"
                                                            placeholder="Luas">
                                                    </div>
                                                </div>
                                                <div id="input"></div>
                                                <button class="btn btn-success btn-sm rounded-pill" type="button"
                                                    id="add-item">Tambah</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group mb-3">
                                            <h6>Perhitungan Nilai Retribusi Prasarana</h6>
                                            <div class="form-group">
                                                <div class="row mb-3" id="masters">
                                                    <div class="col-md-4">
                                                        <input type="text" class="form-control" name="rp[]"
                                                            placeholder="Uraian">
                                                    </div>
                                                    <div class="col-md-4">
                                                        <input type="text" class="form-control" name="vol[]"
                                                            placeholder="Volume">
                                                    </div>
                                                    <div class="col-md-4 mb-3">
                                                        <input type="text" class="form-control" name="sat[]"
                                                            placeholder="Satuan">
                                                    </div>
                                                    <div class="col-md-4">
                                                        <input type="text" class="form-control" name="price[]"
                                                            placeholder="Harga Satuan">
                                                    </div>
                                                    <div class="col-md-4">
                                                        <input type="text" class="form-control" name="jml[]"
                                                            placeholder="Jumlah Harga">
                                                    </div>
                                                </div>
                                                <div id="sub"></div>
                                                <button class="btn btn-success btn-sm rounded-pill" type="button"
                                                    id="add-pra">Tambah</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group mb-3">
                                            <label>Tanggal</label>
                                            <input type="date" name="tanggal" value="{{ old('tanggal') }}"
                                                class="form-control">
                                            @error('tanggal')
                                                <div class='small text-danger text-left'>{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <h6>Parameter</h6>
                                    <div class="col-md-4 my-auto">
                                        <div class="form-group mb-3">
                                            <label>Fungsi Bangunan <i>(If)</i></label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group mb-3">
                                            <input type="text" name="par[]" class="form-control" placeholder="Uraian">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group mb-3">
                                            <input type="text" name="index[]" class="form-control" placeholder="Indexs">
                                        </div>
                                    </div>

                                    <div class="col-md-4 my-auto">
                                        <div class="form-group mb-3">
                                            <label>Kompleksitas<i>(Ik)</i></label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group mb-3">
                                            <input type="text" name="par[]" class="form-control"
                                                placeholder="Uraian">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group mb-3">
                                            <input type="text" name="index[]" class="form-control"
                                                placeholder="Indexs">
                                        </div>
                                    </div>


                                    <div class="col-md-4 my-auto">
                                        <div class="form-group mb-3">
                                            <label>Tingkat Permanensi<i>(Ip)</i></label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group mb-3">
                                            <input type="text" name="par[]" class="form-control"
                                                placeholder="Uraian">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group mb-3">
                                            <input type="text" name="index[]" class="form-control"
                                                placeholder="Indexs">
                                        </div>
                                    </div>


                                    <div class="col-md-4 my-auto">
                                        <div class="form-group mb-3">
                                            <label>Jumlah Lantai<i>(Il)</i></label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group mb-3">
                                            <input type="text" name="par[]" class="form-control"
                                                placeholder="Uraian">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group mb-3">
                                            <input type="text" name="index[]" class="form-control"
                                                placeholder="Indexs">
                                        </div>
                                    </div>

                                    <div class="col-md-4 my-auto">
                                        <div class="form-group mb-3">
                                            <label>Status Kepemilikan<i>(Fm)</i></label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group mb-3">
                                            <input type="text" name="par[]" class="form-control"
                                                placeholder="Uraian">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group mb-3">
                                            <input type="text" name="index[]" class="form-control"
                                                placeholder="Indexs">
                                        </div>
                                    </div>

                                    <div class="col-md-4 my-auto">
                                        <div class="form-group mb-3">
                                            <label>Indeks Terintegrasi<i>(It)</i></label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group mb-3">
                                            <input type="text" name="par[]" class="form-control"
                                                placeholder="Uraian">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group mb-3">
                                            <input type="text" name="index[]" class="form-control"
                                                placeholder="Indexs">
                                        </div>
                                    </div>

                                    <div class="col-md-4 my-auto">
                                        <div class="form-group mb-3">
                                            <label>Indeks BG Terbangun<i>(Ibg)</i></label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group mb-3">
                                            <input type="text" name="par[]" class="form-control"
                                                placeholder="Uraian">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group mb-3">
                                            <input type="text" name="index[]" class="form-control"
                                                placeholder="Indexs">
                                        </div>
                                    </div>

                                    <div class="col-md-4 my-auto">
                                        <div class="form-group mb-3">
                                            <label>Indeks Lokalitas<i>(Ilo)</i></label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group mb-3">
                                            <input type="text" name="par[]" class="form-control"
                                                placeholder="Uraian">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group mb-3">
                                            <input type="text" name="index[]" class="form-control"
                                                placeholder="Indexs">
                                        </div>
                                    </div>

                                    <div class="col-md-4 my-auto">
                                        <div class="form-group mb-3">
                                            <label>SHST Tahun 2023</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group mb-3">
                                            <input type="text" name="par[]" class="form-control"
                                                placeholder="Uraian">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group mb-3">
                                            <input type="text" name="index[]" class="form-control"
                                                placeholder="Indexs">
                                        </div>
                                    </div>

                                </div>
                            @endif
                            <div class="col-md-12">
                                <button class="btn btn-primary rounded-pill">Save</button>
                                <a class="btn btn-danger ms-1 rounded-pill" href="{{ route('tax.index') }}">Back</a>
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
    <script src="https://unpkg.com/x-data-spreadsheet@latest/dist/xspreadsheet.js"></script>

    <script>
        var spread = new x_spreadsheet("#spreadsheet", {            
            showToolbar: false,
            showGrid: true,
            // col: {
            //     len: 10, 
            //     index: 0,           
            // },
            // row: {
            //     len: 25, 
            //     index: 0, 
            // },
        });

        function remove(e) {
            e.parentNode.remove();
        }

        $('#add-item').on('click', function() {
            var clonedDiv = $("#master").clone(); // Mengkloning elemen original
            clonedDiv.append(
                '<button class="btn btn-danger btn-sm my-auto" style="width:fit-content;height:fit-content" onclick="remove(this)"  type="button"><i class="bi bi-trash"></i></button>'
                );
            $("#input").append(clonedDiv);
        });

        $('#add-pra').on('click', function() {
            var clonedDiv = $("#masters").clone(); // Mengkloning elemen original
            clonedDiv.append(
                '<button class="btn btn-danger btn-sm my-auto" style="width:fit-content;height:fit-content" onclick="remove(this)"  type="button"><i class="bi bi-trash"></i></button>'
                );
            $("#sub").append(clonedDiv);
        });
    </script>
@endpush
