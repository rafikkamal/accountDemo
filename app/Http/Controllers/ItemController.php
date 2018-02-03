<?php

namespace App\Http\Controllers;

use App\item;
use Illuminate\Http\Request;
use Session;
use Validator;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = item::all();
        return view('items.show')->with(compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $item = null;
      $message = null;
      if (Session::has('message')){
        $message = Session::pull('message');
      }
      $statuses = ['active', 'inactive'];
      array_splice($statuses, 0, 0, '--Select status--');
      return view('items.create')->with(compact('message', 'statuses', 'item'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $rules = [
        'title'       => 'required|max:100',
        'price'       => 'required|numeric|between:0,99999999.99',
        'priority'    => 'required|numeric',
        'description' => 'required|max:1000',
        'status'      => 'required|not_in:0',
      ];
      $validator = Validator::make($request->all(), $rules);
      if ($validator->fails()) {
          return redirect('items/create')->withErrors($validator)->withInput();
      }

      //dd($request->all());
      $message = null;

      $item = new item;
      $item->title = $request->title;
      $item->price = $request->price;
      $item->status = $request->status;
      $item->priority = $request->priority;
      $item->description = $request->description;

      if($item->save()){
        $message = array(
          'status'  => 'success',
          'content' => 'Successfully created an item!',
        );
      }
      else{
        $message = array(
          'status'  => 'error',
          'content' => 'Something went wrong! Unable to create item.',
        );
      }

      Session::put('message', $message);
      return redirect('items/create');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\item  $item
     * @return \Illuminate\Http\Response
     */
    public function show($item_id)
    {
      dd('inside d show()');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\item  $item
     * @return \Illuminate\Http\Response
     */
    public function edit($item_id)
    {
      $item = item::find($item_id);
      if(!$item){
        return redirect()->back();
      }
      if (Session::has('message')){
        $message = Session::pull('message');
      }else{
        $message = null;
      }
      $statuses = ['active', 'inactive'];
      array_splice($statuses, 0, 0, '--Select status--');

      return view('items.create')->with(compact('message', 'statuses', 'item'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\item  $item
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $item_id)
    {
      $item = item::find($item_id);
      if(!$item){
        return redirect()->back();
      }
      $rules = [
        'title'       => 'required|max:100',
        'price'       => 'required|numeric|between:0,99999999.99',
        'priority'    => 'required|numeric',
        'description' => 'required|max:1000',
        'status'      => 'required|not_in:0',
      ];
      $validator = Validator::make($request->all(), $rules);
      if ($validator->fails()) {
          return redirect('items/create')->withErrors($validator)->withInput();
      }

      $message = null;
      $item->title = $request->title;
      $item->price = $request->price;
      $item->status = $request->status;
      $item->priority = $request->priority;
      $item->description = $request->description;

      if($item->save()){
        $message = array(
          'status'  => 'success',
          'content' => 'Successfully updated the item!',
        );
      }
      else{
        $message = array(
          'status'  => 'error',
          'content' => 'Something went wrong! Unable to update item.',
        );
      }

      Session::put('message', $message);
      return redirect('items/create');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\item  $item
     * @return \Illuminate\Http\Response
     */
    public function destroy(item $item)
    {
        //
    }

}
