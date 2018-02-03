@extends('layouts.app')

@section('content')
  @if($message)
    <div class="row">
      <div class="col-sm-12">
        @if($message['status'] == 'success')
          <div class="alert alert-success">
            {{$message['content']}}
          </div>
        @elseif($message['status'] == 'error')
          <div class="alert alert-warning">
            {{$message['content']}}
          </div>
        @endif
      </div>
    </div>
  @endif

  <div class="row">
    <div class="col-sm-12">
      <form action='<?php if($item!=null){echo route("items.update", $item->id);}else{echo route("items.store");}?>'
        method="<?php if($item!=null){echo 'POST';}else{echo 'POST';}?>"
        enctype="multipart/form-data" class="form">
        {{ csrf_field() }}

        <div class="form-group">
          <label for="title">Title</label>
          <input type="text" class="form-control" id="item_title" name="title"
          <?php if($item!=null){echo 'value="'.$item->title.'"';}else{echo 'value="'.old('title').'"';}?>
          placeholder="Title">
          @if ($errors->has('title'))
            <div class="alert alert-danger">
              @foreach ($errors->get('title') as $message)
                {{$message}}
              @endforeach
            </div>
          @endif
        </div>

        <div class="form-group">
          <label for="price">Price</label>
          <input type="number" class="form-control" id="item_price" name="price"
          <?php if($item!=null){echo 'value="'.$item->price.'"';}else{echo 'value="'.old('price').'"';}?>
          placeholder="Price">
          @if ($errors->has('price'))
            <div class="alert alert-danger">
              @foreach ($errors->get('price') as $message)
                {{$message}}
              @endforeach
            </div>
          @endif
        </div>


        <div class="form-group">
          <label for="priority">Priority</label>
          <input type="number" class="form-control" id="item_priority" name="priority"
          <?php if($item!=null){echo 'value="'.$item->priority.'"';}else{echo 'value="'.old('priority').'"';}?>
          placeholder="Priority">
          @if ($errors->has('priority'))
            <div class="alert alert-danger">
              @foreach ($errors->get('priority') as $message)
                {{$message}}
              @endforeach
            </div>
          @endif
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control" id="item_description" name="description"
            placeholder="Item Description" rows="5">
              <?php if($item!=null){echo $item->description;}else{echo old('description');}?>
            </textarea>
            @if ($errors->has('description'))
              <div class="alert alert-danger">
                @foreach ($errors->get('description') as $message)
                  {{$message}}
                @endforeach
              </div>
            @endif
        </div>

        <div class="form-group">
          <label for="status">Status</label>
          <select name="status" id="item_status" class="form-control">
            @foreach ($statuses as $key => $value)
              <option value="{{$key}}"
              <?php if($item!=null && strcmp($item->status,$value)==0){ echo 'selected';}
              elseif(strcmp(old('status'),$value)==0){echo 'selected';}?>>
                {{$value}}
              </option>
            @endforeach
          </select>
          @if ($errors->has('status'))
            <div class="alert alert-danger">
              @foreach ($errors->get('status') as $message)
                {{$message}}
              @endforeach
            </div>
          @endif
        </div>

        {!! Form::submit('Submit', ['class' => 'btn btn-info']) !!}

      </form>
    </div>
  </div>
@endsection
