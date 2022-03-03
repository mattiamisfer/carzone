<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

         $subcats = SubCategory::all();
      return view('backend.sub_category.index',compact('subcats'));
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

                'label' => 'Category Name',
                'name' => 'category_name',
                'icon' => true,
                'icon_name' => 'box',
                'list' => $categories,
                'type' => 'select',
                'validate' =>  true

            ],
            [

                'label' => 'Sub Category Name',
                'name' => 'sub_category_name',
                'icon' => true,
                'icon_name' => 'box',
                'type' => 'text',
                'validate' =>  true

            ],

          

        ]
          );


        return view('backend.sub_category.create',compact('fields'));
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

      //  return $request->all();


    

        
        $this->validate($request, [
            'input_category_name' => 'required',
            'input_sub_category_name' => 'required'
        ],
        [
            'input_category_name.required'=> 'Category Name is Required', // custom message
            'input_sub_category_name.required' => 'Sub Category Name is Required'


           ]
        );
        $subs = new SubCategory();

        $subs->name =$request->input_sub_category_name;
        $subs->category_id =  $request->input_category_name;

        if($subs->save()) {

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

        $categories = Category::all();
        $subcat = SubCategory::find($id);
        $fields = collect([

            [

                'label' => 'Category Name',
                'name' => 'category_name',
                'icon' => true,
                'icon_name' => 'box',
                'list' => $categories,
                'type' => 'select',
                'validate' =>  true,
                'value' => $subcat->category_id

            ],
            [

                'label' => 'Sub Category Name',
                'name' => 'sub_category_name',
                'icon' => true,
                'icon_name' => 'box',
                'type' => 'text',
                'validate' =>  true,
                'value' => $subcat->name,

            ],

          

        ]
          );

          return view('backend.sub_category.edit',compact('fields','subcat'));
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
          
        // $this->validate($request, [
        //     'input_category_name' => 'required',
        //     'input_sub_category_name' => 'required'
        // ],
        // [
        //     'input_category_name.required'=> 'Category Name is Required', // custom message
        //     'input_sub_category_name.required' => 'Sub Category Name is Required'


        //    ]
        // );
         $subs = SubCategory::find($id);

        $subs->name =$request->input_sub_category_name;
        $subs->category_id =  $request->input_category_name;
       // return $subs->save();

        if($subs->save()) {

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

        
        $delete  = SubCategory::find($id);

        if($delete->delete()) {

            // return 2;
           return back()->with('success','Successfully Deleted');
        }else {
              return back()->with('failure','Sorry Some Error');
        }
    }
}
