<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Post;
use App\Models\TagCategory;
use App\Models\SubCategory;
use App\Models\Prefecture;
use App\Http\Requests\PostRequest;
use App\Http\Requests\UpdatePostRequest;
use Carbon\Carbon;

class PostController extends Controller
{
    private $post;
    private $category;
    private $subCategory;
    private $prefecture;

    public function __construct(Post $post, TagCategory $category, SubCategory $subCategory, Prefecture $prefecture)
    {
        $this->middleware('auth')->except(['index', 'show']);
        $this->post = $post;
        $this->category = $category;
        $this->subCategory = $subCategory;
        $this->prefecture = $prefecture;
    }

    /**
     * 投稿一覧表示(検索時は検索結果を返す)
     *
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function index(Request $request)
    {
      $this->post->updateStateByDeadline();
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
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function create()
    {
        $categoryList = $this->category->pluck('name', 'id');
        $prefectureList = $this->prefecture->pluck('name', 'id');
        return view('posts.create', compact(
            'categoryList', 'prefectureList'));
    }

    /**
     * ajaxリクエストを受け取り、サブカテゴリと、postsテーブルの1レコードを返す
     *
     * @param Request $request
     * @return json $subCategory
     */
    public function fetch(Request $request)
    {
        $cateVal = $request['category_val'];
        $postId = $request['post_id'];
        $post = $this->post->find($postId);
        $subCategory = $this->subCategory
                            ->where('tag_category_id', $cateVal)
                            ->get();
        return [$post, $subCategory];
    }

    /**
     * 新規投稿処理
     *
     * @param  \Illuminate\Http\Request request
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse

     */
    public function store(PostRequest $request)
    {
        $inputs = $request->all();
        $inputs['user_id'] = Auth::id();
        $inputs['recruit_status'] = '里親募集中';
        $inputs['image'] = $request->file('image')->hashName();
        $request->file('image')->store('/public/images');
        $post = $this->post->create($inputs);
        $post->prefectures()->attach($request->input('prefecture_id'));
        return redirect()->route('post.index')->with([
            'msg_success' => '投稿しました',
            'color'  => 'success',
        ]);
    }

    /**
     * 投稿詳細画面表示
     *
     * @param  int  $id
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function show($post_id)
    {
        $post = $this->post->find($post_id);
        $diff = $post->updated_at->diffInDays(Carbon::now());
        return view('posts.show', compact('post', 'diff'));
    }

    /**
     * 編集画面表示
     *
     * @param  int  $id
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function edit($post_id)
    {
        $post = $this->post->with('prefectures')->find($post_id);
        $categoryList = $this->category->pluck('name', 'id');
        $prefectureList = $this->prefecture->pluck('name', 'id');
        return view('posts.edit', compact(
            'post',
            'categoryList',
            'prefectureList'
        ));
    }

    /**
     * 投稿更新処理
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    public function update(UpdatePostRequest $request, $post_id)
    {
        $inputs = $request->all();
        $inputs['user_id'] = Auth::id();
        if (!is_null($request->file('image'))) {
          if (app()->isLocal()) {
            $request->file('image')->store('/public/images');
            $inputs['image'] = $request->file('image')->hashName();
          } else {
            $path = Storage::disk('s3')->put('/', $request->file('image'), 'public');
            $inputs['image'] = Storage::disk('s3')->url($path);
          }
        }
        $post = $this->post->find($post_id);
        $post->update($inputs);
        $post->prefectures()->sync($inputs['prefecture_id']);
        return redirect()->route('post.index')->with([
            'msg_success' => '更新しました',
            'color'  => 'success',
        ]);
    }

    /**
     * 投稿削除処理
     *
     * @param  int  $id
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    public function destroy($post_id)
    {
        $post = $this->post->find($post_id);
        $post->delete();
        Storage::delete('public/images/'.$post->image);
        return redirect()->route('user.show', $post->user->id)->with([
            'msg_danger' => '削除しました',
            'color'  => 'error',
        ]);
    }
}
