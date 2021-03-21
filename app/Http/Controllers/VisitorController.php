<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Visitor;
use Validator;
use Session;

class VisitorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $admin = Session::get('admin');
        if($admin==1){
            $visitors_normaltemp = Visitor::latest()
            ->where('temperature', '<', 37.5)
            ->get();
            return view('visitors.index', compact("visitors_normaltemp"));
        }
        else{
            return view('visitors.create');
        }
        
       
    }

    public function show_data(Request $request)
    {
        $temperature = $request->input( 'temperature' );
        if($temperature=="greater_37.5"){
            $visitors_normaltemp = Visitor::latest()
            ->where('temperature', '>=', 37.5)
            ->get();
        }
        else{
            $visitors_normaltemp = Visitor::latest()
            ->where('temperature', '<', 37.5)
            ->get();
        }
        return response($visitors_normaltemp);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('visitors.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'name' => 'required',
            'date' => 'required',
            'temperature' => 'required',
            'contact_number' => 'required',
        ]);
  
        Visitor::create($request->all());
   
        return redirect()->route('visitors.create')
                        ->with('success','Visitor created successfully.');
    }
    public function set_session(Request $request)
    {
        $default_password = $request->input( 'default_password' );
        session()->put('admin', 1);
    }
    public function clear_session()
    {
        Session::flush();
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
