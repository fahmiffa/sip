@php 
$no=1;
$step = [5,4,3];
@endphp

@if(in_array($head->status, $step))
    @foreach($doc->title as $row)
        @if($row->name == doc($head->status, $head->type))
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
                                        <input class="form-check-input" type="radio" name="sub[{{$item->id}}][{{$sub->id}}]" value="0" {{$head->status == 3 ? null : 'checked'}}>
                                    @endif
                                    <label class="form-check-label">Tidak Ada</label>
                                </div>   
                                <div class="form-check d-inline-block">
                                    <input class="form-check-input" type="radio" name="sub[{{$item->id}}][{{$sub->id}}]" value="2" {{old('sub['.$sub->id.'}]') == '2' ? 'checked' : null}} {{$head->status == 3 ? 'checked' : null}}>                           
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
                                        <input class="form-check-input" type="radio" name="item[{{$item->id}}]" value="0" {{$head->status == 3 ? null : 'checked'}}>
                                    @endif
                                    <label class="form-check-label">Tidak Ada</label>
                                </div>   
                                <div class="form-check d-inline-block">                             
                                    <input class="form-check-input" type="radio" name="item[{{$item->id}}]" value="2" {{old('item['.$item->id.']') == '2' ? 'checked' : null}} {{$head->status == 3 ? 'checked' : null}}>
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
@else
    <label>Saran :</label>
    <textarea name="content" id="editor" class="form-control"></textarea>
</div>
@endif