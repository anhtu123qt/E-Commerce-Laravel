<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\country;

class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $countries = country::all();
        return view('admin.country',compact('countries'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.add_country');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,
            [
                'country' => 'required',
                'description' => 'required',
                'image' => 'max:2048',
            ],
            [
                'required' => ':attribute không được để trống',
                'max' => ':attribute không được lớn hơn max',
            ]
        );
        $new_country = country::create($request->all());
        return redirect()->route('country.index')->with('success','Add Successfully!');
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
        $country = country::findOrFail($id);
        if ($country) {
            return view('admin.edit_country',compact('country'));
        }else {
            return redirect()->back();
        }
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
        $country = country::findOrFail($id);
        $input = $request->all();
        $this->validate($request,
            [
                'country' => 'required',
                'description' => 'required',
                'image' => 'max:2048',
            ],
            [
                'required' => ':attribute không được để trống',
                'max' => ':attribute không được lớn hơn max',
            ]
        );
        if ($country) {
            $country->update($input);
            return redirect()->back()->with('success','Update Successfully!');
        }else {
             return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $country = country::findOrFail($id);
        if ($country) {
            $country->delete();
            return redirect()->back();
        }else {
            return redirect()->back();
        }
    }
}
