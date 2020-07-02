<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;
use App\Models\TagCategory;
use App\Models\Prefecture;
use App\Http\Requests\PostRequest;

class PostController extends Controller
{
    private $post;
    private $category;
    private $prefecture;

    public function __construct(Post $post, TagCategory $category, Prefecture $prefecture)
    {
        $this->middleware('auth')->except(['index', 'show']);
        $this->post = $post;
        $this->category = $category;
        $this->prefecture = $prefecture;

        $posts = $this->post->all();
        foreach($posts as $post) {
            $post->where('deadline_date', date('Y-m-d'))
                ->update(['recruit_status' => "募集終了"]);
        }
    }

    /**
     * 投稿一覧表示
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $searches = $request->only(
            ['tag_category_id', 'prefectures', 'recruit_status', 'gender', 'title', 'sort']
        );
        $prefectures = ($searches['prefectures'] ?? '');
        $posts = $this->post->getSearchIndexPost($searches, $prefectures);
        $postCount = $this->post->all()->count();
        $categories = $this->category->all();
        $prefectureList = $this->prefecture->pluck('name', 'id');
        $request->flash();
        return view('posts.index', compact(
            'posts', 'postCount', 'categories', 'prefectureList'
        ));
    }

    /**
     * 投稿作成画面表示
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categoryList = $this->category->pluck('name', 'id');
        $prefectureList = $this->prefecture->pluck('name', 'id');
        return view('posts.create', compact('categoryList', 'prefectureList'));
    }

    /**
     * 新規投稿処理
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        $inputs = $request->all();
        $inputs['user_id'] = Auth::id();
        $inputs['image'] = $request->file('image')->hashName();
        $request->file('image')->store('/public/images');
        $post = $this->post->create($inputs);
        $post->prefectures()->attach($request->input('prefectures'));
        return redirect()->route('post.index')->with('flash_message', '投稿が完了しました');
    }

    /**
     * 投稿詳細画面表示
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($post_id)
    {
        $post = $this->post->find($post_id);
        return view('posts.show', compact('post'));
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
