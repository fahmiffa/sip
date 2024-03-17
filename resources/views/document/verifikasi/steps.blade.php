@php 
$no=1;
$level = auth()->user()->roles->kode;
if($head->steps->count() > 0)
{
    $first = $head->steps[0]->kode;
}
else 
{
    $first = null;    
}
@endphp

@if($level == 'VL2')

    @if($vl2)

       @if($head->type == 'umum')
            @if($vl2->status == 3)    
                    @foreach($doc->title as $row)
                        @if($row->name == doc(3,$head->type))
                            <div class="col-md-12">
                                <h6>{{$row->name}}</h6>
                                    @foreach($row->items as $item)                
                                    @if(count($item->sub) > 0)   
                                        <p> {{$no++}}. {{$item->name}}</p>
                                        @foreach($item->sub as $sub)           
                                        <div class="row mb-3 g-0">
                                            <div class="col-md-4 d-flex">
                                                <div class="ms-3">
                                                    {{abjad($loop->index)}}. 
                                                </div>
                                                <p class="ms-1">{{$sub->name}}</p>
                                            </div>
                                            <div class="col-md-5">                                                    
                                                <div class="form-group d-flex justify-content-center">
                                                    <div class="form-check d-inline-block">
                                                        <input class="form-check-input" type="radio" name="sub[{{$item->id}}][{{$sub->id}}]" value="1" {{old('sub['.$sub->id.']') == '1' ? 'checked' : null}}>
                                                        <label class="form-check-label">Ada</label>
                                                    </div>
                                                    <div class="form-check d-inline-block mx-3">
                                                        @if(old('sub['.$sub->id.']'))
                                                            <input class="form-check-input" type="radio" name="sub[{{$item->id}}][{{$sub->id}}]" value="0" {{old('sub['.$sub->id.']') == '0' ? 'checked' : null}}>
                                                        @else
                                                            <input class="form-check-input" type="radio" name="sub[{{$item->id}}][{{$sub->id}}]" value="0">
                                                        @endif
                                                        <label class="form-check-label">Tidak Ada</label>
                                                    </div>   
                                                    <div class="form-check d-inline-block">
                                                        <input class="form-check-input" type="radio" name="sub[{{$item->id}}][{{$sub->id}}]" value="2" {{old('sub['.$sub->id.'}]') == '2' ? 'checked' : null}} checked>                           
                                                        <label class="form-check-label">Tidak Perlu</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <textarea class="form-control" name="saranSub[{{$sub->id}}]" rows="2" >{{old('saranSub['.$sub->id.']')}}</textarea>
                                            </div>
                                        </div>  
                                        @endforeach                
                                    @else
                                        <div class="row mb-3">
                                            <div class="col-md-4 d-flex">
                                                {{$no++}}. <p class="ms-2">{{$item->name}}</p>
                                            </div>
                                            <div class="col-md-5">                                                    
                                                <div class="form-group d-flex justify-content-center">
                                                    <div class="form-check d-inline-block">
                                                        <input class="form-check-input" type="radio" name="item[{{$item->id}}]" value="1" {{old('item['.$item->id.']') == '1' ? 'checked' : null}}>
                                                        <label class="form-check-label">Ada</label>
                                                    </div>
                                                    <div class="form-check d-inline-block mx-3">
                                                        @if(old('item['.$item->id.']'))
                                                            <input class="form-check-input" type="radio" name="item[{{$item->id}}]" value="0" {{old('item['.$item->id.']') == '0' ? 'checked' : null}}>
                                                        @else
                                                            <input class="form-check-input" type="radio" name="item[{{$item->id}}]" value="0">
                                                        @endif
                                                        <label class="form-check-label">Tidak Ada</label>
                                                    </div>   
                                                    <div class="form-check d-inline-block">                             
                                                        <input class="form-check-input" type="radio" name="item[{{$item->id}}]" value="2" {{old('item['.$item->id.']') == '2' ? 'checked' : null}} checked>
                                                        <label class="form-check-label">Tidak Perlu</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <textarea class="form-control" name="saranItem[{{$item->id}}]" rows="2" >{{old('saranItem['.$item->id.']')}}</textarea>
                                            </div>
                                        </div>
                                    @endif             
                                    @endforeach                                   
                            </div>
                        @endif    
                    @endforeach  
            @endif
            @if($vl2->status == 2) 
                    <div class="form-group">
                        <h6>Lain-lain</h6>
                        <div class="row mb-3" id="master">
                            <div class="col-md-3">
                                <input type="text" class="form-control" name="nameOther[0]" placeholder="item name">
                            </div>
                            <div class="col-md-5">
                                <div class="d-flex justify-content-center">
                                    <div class="form-check d-inline-block">
                                        <input class="form-check-input" type="radio" name="item[0]" value="1">
                                        <label class="form-check-label">Ada</label>
                                    </div>
                                    <div class="form-check d-inline-block mx-3">             
                                        <input class="form-check-input" type="radio" name="item[0]" value="0" checked>
                                        <label class="form-check-label">Tidak Ada</label>
                                    </div>   
                                    <div class="form-check d-inline-block">                             
                                        <input class="form-check-input" type="radio" name="item[0]" value="2">
                                        <label class="form-check-label">Tidak Perlu</label>
                                    </div>
                                </div>
                            </div>            
                            <div class="col-md-3">
                                <textarea class="form-control" name="saranOther[0]" rows="2"></textarea>
                            </div>
                        </div>
                        <div id="input"></div>
                        <button class="btn btn-success btn-sm rounded-pill" type="button" id="add-item">Tambah</button>    
                    </div>
                    <div class="form-group">
                        <label>Saran :</label>
                        <textarea name="content" id="editor" class="form-control"></textarea>
                    </div>
            @endif
       @else
        <div class="form-group">
                <h6>Lain-lain</h6>
                <div class="row mb-3" id="master">
                    <div class="col-md-3">
                        <input type="text" class="form-control" name="nameOther[0]" placeholder="item name">
                    </div>
                    <div class="col-md-5">
                        <div class="d-flex justify-content-center">
                            <div class="form-check d-inline-block">
                                <input class="form-check-input" type="radio" name="item[0]" value="1">
                                <label class="form-check-label">Ada</label>
                            </div>
                            <div class="form-check d-inline-block mx-3">             
                                <input class="form-check-input" type="radio" name="item[0]" value="0" checked>
                                <label class="form-check-label">Tidak Ada</label>
                            </div>   
                            <div class="form-check d-inline-block">                             
                                <input class="form-check-input" type="radio" name="item[0]" value="2">
                                <label class="form-check-label">Tidak Perlu</label>
                            </div>
                        </div>
                    </div>            
                    <div class="col-md-3">
                        <textarea class="form-control" name="saranOther[0]" rows="2"></textarea>
                    </div>
                </div>
                <div id="input"></div>
                <button class="btn btn-success btn-sm rounded-pill" type="button" id="add-item">Tambah</button>    
        </div>
        <div class="form-group">
                <label>Saran :</label>
                <textarea name="content" id="editor" class="form-control"></textarea>
        </div> 
       @endif


    @else  
      @foreach($doc->title as $row)
        @if($row->name == doc(4,$head->type))
            <div class="col-md-12">
                <h6>{{$row->name}}</h6>
                    @foreach($row->items as $item)                
                    @if(count($item->sub) > 0)   
                        <p> {{$no++}}. {{$item->name}}</p>
                        @foreach($item->sub as $sub)           
                        <div class="row mb-3 g-0">
                            <div class="col-md-4 d-flex">
                                <div class="ms-3">
                                    {{abjad($loop->index)}}. 
                                </div>
                                <p class="ms-1">{{$sub->name}}</p>
                            </div>
                            <div class="col-md-5">                                                    
                                <div class="form-group d-flex justify-content-center">
                                    <div class="form-check d-inline-block">
                                        <input class="form-check-input" type="radio" name="sub[{{$item->id}}][{{$sub->id}}]" value="1" {{old('sub['.$sub->id.']') == '1' ? 'checked' : null}}>
                                        <label class="form-check-label">Ada</label>
                                    </div>
                                    <div class="form-check d-inline-block mx-3">
                                        @if(old('sub['.$sub->id.']'))
                                            <input class="form-check-input" type="radio" name="sub[{{$item->id}}][{{$sub->id}}]" value="0" {{old('sub['.$sub->id.']') == '0' ? 'checked' : null}}>
                                        @else
                                            <input class="form-check-input" type="radio" name="sub[{{$item->id}}][{{$sub->id}}]" value="0" checked>
                                        @endif
                                        <label class="form-check-label">Tidak Ada</label>
                                    </div>   
                                    <div class="form-check d-inline-block">
                                        <input class="form-check-input" type="radio" name="sub[{{$item->id}}][{{$sub->id}}]" value="2" {{old('sub['.$sub->id.'}]') == '2' ? 'checked' : null}}>                           
                                        <label class="form-check-label">Tidak Perlu</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <textarea class="form-control" name="saranSub[{{$sub->id}}]" rows="2" >{{old('saranSub['.$sub->id.']')}}</textarea>
                            </div>
                        </div>  
                        @endforeach                
                    @else
                        <div class="row mb-3">
                            <div class="col-md-4 d-flex">
                                {{$no++}}. <p class="ms-2">{{$item->name}}</p>
                            </div>
                            <div class="col-md-5">                                                    
                                <div class="form-group d-flex justify-content-center">
                                    <div class="form-check d-inline-block">
                                        <input class="form-check-input" type="radio" name="item[{{$item->id}}]" value="1" {{old('item['.$item->id.']') == '1' ? 'checked' : null}}>
                                        <label class="form-check-label">Ada</label>
                                    </div>
                                    <div class="form-check d-inline-block mx-3">
                                        @if(old('item['.$item->id.']'))
                                            <input class="form-check-input" type="radio" name="item[{{$item->id}}]" value="0" {{old('item['.$item->id.']') == '0' ? 'checked' : null}}>
                                        @else
                                            <input class="form-check-input" type="radio" name="item[{{$item->id}}]" value="0" checked>
                                        @endif
                                        <label class="form-check-label">Tidak Ada</label>
                                    </div>   
                                    <div class="form-check d-inline-block">                             
                                        <input class="form-check-input" type="radio" name="item[{{$item->id}}]" value="2" {{old('item['.$item->id.']') == '2' ? 'checked' : null}}>
                                        <label class="form-check-label">Tidak Perlu</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <textarea class="form-control" name="saranItem[{{$item->id}}]" rows="2" >{{old('saranItem['.$item->id.']')}}</textarea>
                            </div>
                        </div>
                    @endif             
                    @endforeach                                   
            </div>
        @endif    
      @endforeach         
    @endif


@else
    @foreach($doc->title as $row)
        @if($row->name == doc(5,$head->type))
            <div class="col-md-12">
                <h6>{{$row->name}}</h6>
                    @foreach($row->items as $item)                
                    @if(count($item->sub) > 0)   
                        <p> {{$no++}}. {{$item->name}}</p>
                        @foreach($item->sub as $sub)           
                        <div class="row mb-3 g-0">
                            <div class="col-md-4 d-flex">
                                <div class="ms-3">
                                    {{abjad($loop->index)}}. 
                                </div>
                                <p class="ms-1">{{$sub->name}}</p>
                            </div>
                            <div class="col-md-5">                                                    
                                <div class="form-group d-flex justify-content-center">
                                    <div class="form-check d-inline-block">
                                        <input class="form-check-input" type="radio" name="sub[{{$item->id}}][{{$sub->id}}]" value="1" {{old('sub['.$sub->id.']') == '1' ? 'checked' : null}}>
                                        <label class="form-check-label">Ada</label>
                                    </div>
                                    <div class="form-check d-inline-block mx-3">
                                        @if(old('sub['.$sub->id.']'))
                                            <input class="form-check-input" type="radio" name="sub[{{$item->id}}][{{$sub->id}}]" value="0" {{old('sub['.$sub->id.']') == '0' ? 'checked' : null}}>
                                        @else
                                            <input class="form-check-input" type="radio" name="sub[{{$item->id}}][{{$sub->id}}]" value="0" checked>
                                        @endif
                                        <label class="form-check-label">Tidak Ada</label>
                                    </div>   
                                    <div class="form-check d-inline-block">
                                        <input class="form-check-input" type="radio" name="sub[{{$item->id}}][{{$sub->id}}]" value="2" {{old('sub['.$sub->id.'}]') == '2' ? 'checked' : null}}>                           
                                        <label class="form-check-label">Tidak Perlu</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <textarea class="form-control" name="saranSub[{{$sub->id}}]" rows="2" >{{old('saranSub['.$sub->id.']')}}</textarea>
                            </div>
                        </div>  
                        @endforeach                
                    @else
                        <div class="row mb-3">
                            <div class="col-md-4 d-flex">
                                {{$no++}}. <p class="ms-2">{{$item->name}}</p>
                            </div>
                            <div class="col-md-5">                                                    
                                <div class="form-group d-flex justify-content-center">
                                    <div class="form-check d-inline-block">
                                        <input class="form-check-input" type="radio" name="item[{{$item->id}}]" value="1" {{old('item['.$item->id.']') == '1' ? 'checked' : null}}>
                                        <label class="form-check-label">Ada</label>
                                    </div>
                                    <div class="form-check d-inline-block mx-3">
                                        @if(old('item['.$item->id.']'))
                                            <input class="form-check-input" type="radio" name="item[{{$item->id}}]" value="0" {{old('item['.$item->id.']') == '0' ? 'checked' : null}}>
                                        @else
                                            <input class="form-check-input" type="radio" name="item[{{$item->id}}]" value="0" checked>
                                        @endif
                                        <label class="form-check-label">Tidak Ada</label>
                                    </div>   
                                    <div class="form-check d-inline-block">                             
                                        <input class="form-check-input" type="radio" name="item[{{$item->id}}]" value="2" {{old('item['.$item->id.']') == '2' ? 'checked' : null}}>
                                        <label class="form-check-label">Tidak Perlu</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <textarea class="form-control" name="saranItem[{{$item->id}}]" rows="2" >{{old('saranItem['.$item->id.']')}}</textarea>
                            </div>
                        </div>
                    @endif             
                    @endforeach                                   
            </div>
        @endif
    @endforeach  
@endif