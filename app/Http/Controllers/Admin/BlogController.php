<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Blog;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $getBlog = Blog::Paginate(3);
        return view('admin.blog',compact('getBlog'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.add_blog');
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
                'title' => 'required',
                'description' => 'required',
            ],
            [
                'required' => ':attribute không được để trống',
            ]
        );
        $data = $request->all();
        $get_image = $request->file('image');
        if ($get_image) {
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image = rand(0,99).'.'.$name_image.'.'.$get_image->getClientOriginalExtension();
            $get_image->move('upload/blog',$new_image);
            $data['image'] = $new_image;
            // dd($data);
            $new_blog = Blog::create($data);
        }   
        return redirect()->route('blog.index')->with('success','Add Successfully!');
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
        $getBlog = Blog::findOrFail($id);
        if ($getBlog) {
         return view('admin.edit_blog',compact('getBlog'));
     }else {
        return view('admin.blog');
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
        $getBlog = BLog::findOrFail($id);
        $input = $request->all();
        $this->validate($request,
            [
                'title' => 'required',
                'description' => 'required',
            ],
            [
                'required' => ':attribute không được để trống',
            ]
        );
        if ($getBlog) {
            $getBlog->update($input);
            return redirect()->route('blog.index')->with('success','Update Successfully!');
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
        $getBlog = BLog::findOrFail($id);
        if ($getBlog) {
            $getBlog->delete();
            return redirect()->back()->with('delete','Delete Successfully!');
        }
    }
}
