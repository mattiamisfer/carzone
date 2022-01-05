<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Package;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //


        $packages = Package::all();

        return view('backend.package.index',compact('packages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $categories = Category::all();
        $fields = collect([
            [

                'label' => 'Package Name',
                'name' => 'package_name',
                'icon' => true,
                'icon_name' => 'box',
                'type' => 'text',
                'validate' =>  true

            ],
            [

                'label' => 'Category Name',
                'name' => 'category_name',
                'icon' => true,
                'icon_name' => 'box',
                'list' => $categories,
                'type' => 'select',
                'validate' =>  true

            ],
            [

                'label' => 'Image',
                'name' => 'image',
                'icon' => false,
                'icon_name' => 'box',

                'type' => 'image',
                'validate' =>  true

            ],
            [

                'label' => 'Content',
                'name' => 'content',
                'icon' => true,
                'icon_name' => 'box',

                'type' => 'textarea',
                'validate' =>  true

            ],


        ]
          );


        return view('backend.package.create',compact('fields'));
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


        $this->validate($request, [
            'input_category_name' => 'required',
            'input_package_name' => 'required',
            'input_image' => 'required',
            'input_content' => 'required',
        ],
        [
            'input_category_name.required'=> 'Category Name is Required', // custom message
            'input_package_name.required'=> 'Package Name is Required',
            'input_image.required'=> 'Image is Required',
            'input_content.required'=> 'Content is Required',
           ]
        );


        $package = new Package();

        $package->name = $request->input_package_name;
        $package->image = $request->input_image;
        $package->content = $request->input_content;
        $package->category_id = $request->input_category_name;
        if($package->save()) {

            // return 2;
           return back()->with('success','Successfully Created');
        }else {
              return back()->with('failure','Sorry Some Error');
        }
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


     $package = Package::find($id);

        $categories = Category::all();
        $fields = collect([
            [

                'label' => 'Package Name',
                'name' => 'package_name',
                'icon' => true,
                'icon_name' => 'box',
                'type' => 'text',
                'validate' =>  true,
                'value' => $package->name,

            ],
            [

                'label' => 'Category Name',
                'name' => 'category_name',
                'icon' => true,
                'icon_name' => 'box',
                'list' => $categories,
                'type' => 'select',
                'validate' =>  true,
                'value' => $package->category_id,

            ],
            [

                'label' => 'Image',
                'name' => 'image',
                'icon' => false,
                'icon_name' => 'box',

                'type' => 'image',
                'validate' =>  true,
                'value' => $package->image,

            ],
            [

                'label' => 'Content',
                'name' => 'content',
                'icon' => true,
                'icon_name' => 'box',

                'type' => 'textarea',
                'validate' =>  true,
                'value' => $package->content,

            ],


        ]
          );


        return view('backend.package.edit',compact('fields','package'));
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

        $package = Package::find($id);

        $package->name = $request->input_package_name;
        $package->image = $request->input_image;
        $package->content = $request->input_content;
        $package->category_id = $request->input_category_name;
        if($package->save()) {

            // return 2;
           return back()->with('success','Successfully Updated');
        }else {
              return back()->with('failure','Sorry Some Error');
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
        //


        $package = Package::find($id);
        if($package->delete()) {

            // return 2;
           return back()->with('success','Successfully Deleted');
        }else {
              return back()->with('failure','Sorry Some Error');
        }
    }
}
