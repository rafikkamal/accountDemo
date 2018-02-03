@extends('layouts.app')

@section('content')

  <div class="row">
    @forelse ($items as $item)
      {{$item->id}} - {{$item->price}}
    @empty
      <p>No items</p>
    @endforelse
  </div>

  <div class="row">
    <table id="table_id" class="display">
        <thead>
            <tr>
                <th>Column 1</th>
                <th>Column 2</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Row 1 Data 1</td>
                <td>Row 1 Data 2</td>
            </tr>
            <tr>
                <td>Row 2 Data 1</td>
                <td>Row 2 Data 2</td>
            </tr>
        </tbody>
    </table>
  </div>

@endsection
