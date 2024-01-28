@extends('layout.base')     
@push('css')
<link rel="stylesheet" href="{{asset('assets/extensions/choices.js/public/assets/styles/choices.css')}}">
<link rel="stylesheet" href="{{asset('assets/extensions/datatables.net-bs5/css/dataTables.bootstrap5.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/compiled/css/table-datatable-jquery.css')}}">

<link rel="stylesheet" href="{{asset('assets/extensions/quill/quill.snow.css')}}">
<link rel="stylesheet" href="{{asset('assets/extensions/summernote/summernote-lite.css')}}">

<link rel="stylesheet" href="{{asset('assets/compiled/css/form-editor-summernote.css')}}">



@endpush
@section('main')
<div class="page-heading">  

    <section class="section">
        <div class="card">       

            <div class="card-header">
                <h5 class="card-title">{{$data}}</h5>                    
            </div>

            <div class="card-body">

                @isset($footer)
                <form action="{{route('footer.update',['footer'=>$footer])}}" method="post">                            
                @method('PATCH')   
                @else                                      
                    <form action="{{route('footer.store')}}" method="post">                               
                @endif                    
                    @csrf           
                    <div class="px-5">

                        <div class="form-group row mb-3">
                            <div class="col-md-12">
                                <label>Dokumen</label>              
                                <select class="choices form-select" name="document">
                                    @foreach($doc as $item)
                                    <option value="{{$item->id}}"  @selected(isset($footer) && $footer->doc == $item->id)>{{$item->name}}</option>
                                    @endforeach                       
                                </select>
                                @error('document')<div class='small text-danger text-left'>{{$message}}</div>@enderror
                            </div>
                        </div>

                        <div class="form-group row mb-3">
                            <div class="col-md-12">
                               <textarea name="editor" id="editor" class="form-control"></textarea>
                            </div>
                        </div>

                        <div class="form-group row mb-3">
                            <div class="col-md-12">
                                <p>Item Footer</p>
                                <input type="hidden" name="content">
                                 <div id="snow">{!! isset($footer) ? $footer->item : null !!}</div>
                            </div>
                        </div>
                        
              
    
                        <div style="height: 4rem"></div>
                        <div class="form-group row mt-3 position-relative">             
                            <div class="col-md-12" >
                                <button class="btn btn-primary rounded-pill">Save</button>
                                <a class="btn btn-danger ms-1 rounded-pill" href="{{route('header.index')}}">Back</a>
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

<script src="{{asset('assets/extensions/quill/quill.min.js')}}"></script>
<script src="{{asset('assets/extensions/summernote/summernote-lite.min.js')}}"></script>

<script>

$("#editor").summernote({
  tabsize: 2,
  height: 800,
})
$("#hint").summernote({
  height: 100,
  toolbar: false,
  placeholder: "type with apple, orange, watermelon and lemon",
  hint: {
    words: ["apple", "orange", "watermelon", "lemon"],
    match: /\b(\w{1,})$/,
    search: function (keyword, callback) {
      callback(
        $.grep(this.words, function (item) {
          return item.indexOf(keyword) === 0
        })
      )
    },
  },
})

    var quill = new Quill('#snow', {
      theme: 'snow'
    });

    quill.on('text-change', function(delta, oldDelta, source) {
    document.querySelector("input[name='content']").value = quill.root.innerHTML;
  });
</script>

@endpush