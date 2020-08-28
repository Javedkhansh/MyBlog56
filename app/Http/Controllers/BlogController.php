<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Blog;
use App\Category;
use Session;


class BlogController extends Controller
{

    public function __construct(){
        // $this->middleware('author', ['only' => ['create','store','edit','update']]);
        // $this->middleware('admin', ['except' => ['delete','trash','restore','permanentDelete']]);

        $this->middleware('author', ['only' => ['create','store','edit','update']]);
        $this->middleware('admin', ['only' => ['delete','trash','restore','permanentDelete']]);
    }





    //index
    public function index()
    {   //simple show blog
        // $blogs = Blog::all();

        //show latest blog first using
        //used for all blog
        // $blogs = Blog::latest()->get();

        //used for only the status = 1 blogs
        $blogs = Blog::where('status',1)->latest()->get();
        return view('blogs.index', compact('blogs'));
    }

    //create simple
    // public function create(){
    //     return view('blogs.create');
    // }

    //create method and sends categories to the view
    public function create()
    {
        $categories = Category::first()->get();
        return view('blogs.create', compact('categories'));
    }


    //store
    public function store(Request $request)
    {

        //Checking If image is file or not via condition before Request all
        // if ($request->file('featured_image')) {
        //     dd('Yes');
        // }


        //--- method 1 ----
        // $blog = new Blog();
        // $blog->title = $request->title;
        // $blog->body = $request->body;
        // $blog->save();
        // return redirect('/blogs');

        //--- method 2 ---
        //validations
        $rules = [
            'title' => ['required','min:20', 'max:160'],
            'body' => ['required','min:200'],
        ];
            $this->validate($request, $rules);
            
        //end of validation
        $input = $request->all();
        //seo slug, meta_title, meta_description fields
        $input['slug'] = str_slug($request->title);
        $input['meta_title'] = str_limit($request->title, 100);
        $input['meta_description'] = str_limit($request->body, 155);
        if($file = $request->file('featured_image')){
            // getClientOriginalName, getClientOriginalExtension, getSize, getMimeType
            // uniqid()' Generates Uniqueid for the image (start of image)
            $name = uniqid() . $file->getClientOriginalName();
            // $name = strtolower(str_replace(' ','_', $name));
            $file->move('images/featured_images', $name);
            $input['featured_image'] = $name;
            
        }
        // $blog = Blog::create($input);
        $blogByUser = $request->user()->blogs()->create($input);
        //sync blog with category
        if ($request->category_id) {
            // $blog->category()->sync($request->category_id); 
            $blogByUser->category()->sync($request->category_id); 
        }

        // Session::flash('name of the message');
        Session::flash('blog_created_message','Congratulation on Created your post');


        return redirect('/blogs');
    }




    



        //show
    public function show($slug)
    {
        // $blog = Blog::findOrFail($slug);
        $blog = Blog::whereSlug($slug)->first();
        return view('blogs.show', compact('blog'));
    }




    //edit
    public function edit($id)
    {
        $categories = Category::first()->get();
        $blog = Blog::findOrFail($id);

        //cateogry edit code for 'current category and unused category'
        $bc = array();
       foreach ($blog->category as $c) {
            $bc[] = $c->id-1;
        }
        $filtered = array_except($categories, $bc);

        return view('blogs.edit', ['blog'=>$blog , 'categories'=>$categories , 'filtered'=>$filtered]);
    }




    //update
    public function update(Request $request, $id)
    {
        // dd($request->all()); //test for draft and publish
        // dd($request);
        $input = $request->all();
        
        $blog = Blog::findOrFail($id);
        $blog->update($input);
         //sync blog with category
         if($request->category_id){
            $blog->category()->sync($request->category_id); 
        }
        return redirect('/blogs');
    }





    //delete
    public function delete($id)
    {
        $blog = Blog::findOrFail($id);
        // dd($blog);
        $blog->delete();
        return redirect('/blogs');
    }





    //trash softdelete
    public function trash()
    {
        $trashblogs = Blog::onlyTrashed()->get();
        return view('blogs.trash', compact('trashblogs'));
    }


    //restore blog
    public function restore($id)
    {
        $restoreblogs = Blog::onlyTrashed()->findOrFail($id);
        $restoreblogs->restore($restoreblogs);
        return redirect('/blogs');
    }


    //Permanent Delete
    public function permanentDelete($id)
    {
        $permanentDeleteBlogs = Blog::onlyTrashed()->findOrFail($id);
        $permanentDeleteBlogs->forceDelete($permanentDeleteBlogs);
        return back();
    }
}
