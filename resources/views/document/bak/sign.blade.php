@extends('layout.base')
@push('css')
    <style>
        .imgs {
            object-fit: cover;
            width: 50px;
            height: 50px;
        }
    </style>
@endpush
@section('main')
    <div class="container">
        <div class="card mt-5">
            <div class="card-body">
                <div class="row">
                    <div class="col-12">               
                        <canvas id="pdf-viewer" class="border border-light" width="100%" height="100%" style="min-height: 80vh;"></canvas>
                        <button class="btn btn-primary rounded-pill mx-auto d-block" type="button" data-bs-toggle="modal" data-bs-target="#signatureModal">Tanda Tangan</button>
                        <div class="modal fade" id="signatureModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="staticBackdropLabel">Tanda Tangan</h5>
                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{route('signed.news',['id'=>md5($news->id)])}}" id="sign" method="post">    
                                        @csrf
                                        <canvas id="signatureCanvas" class="border border-light mx-auto d-block mb-3" width="450" height="200"></canvas>
                                        <select class="form-control" name="user" required>
                                            <option value="">Pilih User</option>
                                            <option value="petugas">Petugas</option>
                                            <option value="pemohon">Pemohon</option>
                                        </select> 
                                        <input type="hidden" name="sign" id="signed">                
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-primary" id="submit">Simpan</button>                                                                
                                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>  
                                </div>
                              </div>
                            </div>
                        </div>                                
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/signature_pad"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.11.338/pdf.min.js"></script>

    <script>
        $(document).ready(function() {
            var canvas = document.getElementById('signatureCanvas');
            var signaturePad = new SignaturePad(canvas);

            $('#signatureModal').on('shown.bs.modal', function() {
                signaturePad.clear(); 
            });

            $('#submit').on('click',function(){
                var signatureData = signaturePad.toDataURL();
                $('#signed').val(signatureData);
                document.getElementById('sign').submit();
            });
        });

        const pdfUrl = "{{ asset('storage/' . $news->files) }}";
        const loadingTask = pdfjsLib.getDocument(pdfUrl);
        loadingTask.promise.then(function(pdf) {
            pdf.getPage(1).then(function(page) {
                const scale = 1.8;
                const viewport = page.getViewport({
                    scale: scale
                });
                const canvas = document.getElementById('pdf-viewer');
                const context = canvas.getContext('2d');
                canvas.height = viewport.height;
                canvas.width = viewport.width;
                const renderContext = {
                    canvasContext: context,
                    viewport: viewport
                };
                const renderTask = page.render(renderContext);
                renderTask.promise.then(function() {
                    console.log('Page rendered');
                });
            });
        });    
    </script>
@endpush
