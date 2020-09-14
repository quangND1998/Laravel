<?php

namespace App\Http\Controllers;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Resources\PostResource;


class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return PostResource::collection(Post::latest()->paginate(5));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'body' => 'required',
            'user_id' => 'required',
            'image' => 'required',
        ]);

        $post = new Post;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $name = Str::slug($request->title).'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/uploads/posts');
            $imagePath = $destinationPath . "/" . $name;
            $image->move($destinationPath, $name);
            $post->image = $name;
        }

        $post->user_id = $request->user_id;
        $post->title = $request->title;
        $post->body = $request->body;
        $post->save();

        return new PostResource($post);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show( $id )
    {

        $post = Post::find($id);
        return new PostResource($post);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $this->validate($request, [
            'title' => 'required',
            'body' => 'required',
        ]);
        $post = Post::find($id);
        // dd($post);
        $post->update($request->only(['title', 'body']));

        return new PostResource($post);
    }
    public function destroy( $id)
    {

        $post =  Post::find($id);
        $post->delete();

        return response()->json(null, 204);
    }

    public function all()
    {
        return view('landing', [
            'posts' => Post::latest()->paginate(5)
        ]);
    }


    public function single(Post $post)
    {
        return view('single', compact('post'));
    }
}




// <?php

// namespace App\Http\Controllers;
// use App\Models\Post;
// use Illuminate\Http\Request;
// use Illuminate\Support\Str;
// use App\Http\Resources\PostResource;
// class PostController extends Controller
// {
//     public function all()
//     {
//         return view('landing', [
//             'posts' => Post::latest()->paginate(5)
//         ]);
//     }


//     public function single(Post $post)
//     {
//         return view('single', compact('post'));
//     }

//     public function store(Request $request)
//     {
//         $this->validate($request, [
//             'title' => 'required',
//             'body' => 'required',
//             'user_id' => 'required',
//             'image' => 'required|mimes:jpeg,png,jpg,gif,svg',
//         ]);

//         $post = new Post;

//         if ($request->hasFile('image')) {
//             $image = $request->file('image');
//             $name = Str::slug($request->title).'.'.$image->getClientOriginalExtension();
//             $destinationPath = public_path('/uploads/posts');
//             $imagePath = $destinationPath . "/" . $name;
//             $image->move($destinationPath, $name);
//             $post->image = $name;
//         }

//         $post->user_id = $request->user_id;
//         $post->title = $request->title;
//         $post->body = $request->body;
//         $post->save();

//         return new PostResource($post);
//     }


//     public function index()
//     {
//         return PostResource::collection(Post::latest()->paginate(5));
//     }

//     public function show(Post $post)
//     {
//         return new PostResource($post);
//     }


//     public function update(Request $request, Post $post)
//     {
//         $this->validate($request, [
//             'title' => 'required',
//             'body' => 'required',
//         ]);

//         $post->update($request->only(['title', 'body']));

//         return new PostResource($post);
//     }

//     public function destroy(Post $post)
//     {
//         $post->delete();

//         return response()->json(null, 204);
//     }


// }
