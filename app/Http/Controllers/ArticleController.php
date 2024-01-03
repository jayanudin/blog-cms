<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Category;
use App\Models\Tag;
use App\Models\TagArticle;
use App\Models\CategoryArticle;
use App\Http\Requests\ArticleRequest;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Http\Resources\ModelCollection;
use DB;

class ArticleController extends Controller
{
    protected $page = 1;
    protected $perPage = 10;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = DB::table('articles')->paginate(9);
        return view('backend.article.article', compact('articles'))->with('i');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = DB::table('categories')->whereIn('status', ['1'])->get();
        $tags = DB::table('tags')->whereIn('status', ['1'])->get();
        return view('backend.article.create', compact('categories', 'tags'))->with('i');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ArticleRequest $request)
    {
        $file = $request->file('thumbnail');
        $destinationPath = public_path('images');
        $fileName = time().'.'.$request->thumbnail->extension();
        $file->move($destinationPath, $fileName);
        $articles = $request->all();
        $slug_replace_space = str_replace(' ', '-', $articles['slug']);
        $articles['slug'] = strtolower($slug_replace_space);
        $articles['thumbnail'] = $fileName;

        $article = Article::create($articles);
        $article->category()->sync((array)$request->category_id);
        $article->tag()->sync((array)$request->tag_id);
        
        return redirect('admin/article')->with('success','article has been created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $article = Article::find($id);
        $articleTags = TagArticle::where('article_id', $id)->get();
        $articleCategories = CategoryArticle::where('article_id', $id)->get();

        $collectTags = collect($articleTags)->pluck('tag_id')->all();
        $collectCategories = collect($articleCategories)->pluck('category_id')->all();

        $tags = DB::table('tags')->whereIn('id', $collectTags)->get();
        $categories = DB::table('categories')->whereIn('id', $collectCategories)->get();
        

        return view('backend.article.detail', compact('article', 'tags', 'categories'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $article = Article::find($id);
        $categories = DB::table('categories')->where('status', '1')->get();
        $categoryArticles = DB::table('category_articles')->where('article_id', $id)->get();

        foreach ($categories as $keyCategories => $valueCategories) {
            $valueCategories->checked = 'unchecked';
            foreach ($categoryArticles as $keyCategoryArticle => $valueCategoryArticle) {
                if ($valueCategories->id == $valueCategoryArticle->category_id) {
                    $valueCategories->checked = 'checked';
                }
            }
        }

        $tags = DB::table('tags')->where('status', '1')->get();
        $tagArticlesCollect = DB::table('tag_articles')->where('article_id', $id)->get();
        $tagArticles = collect($tagArticlesCollect)->all();

        foreach ($tags as $keyTags => $valueTags) {
            $valueTags->checked = 'unchecked';
            foreach ($tagArticles as $keyTagArticle => $valueTagArticle) {
                if ($valueTags->id == $valueTagArticle->tag_id) {
                    $valueTags->checked = 'checked';
                }
                
            }
        }
        return view('backend.article.edit', compact('article', 'categories', 'tags'));
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
        $request->validate([
            'title' => 'required|max:100',
            'slug' => 'required|max:100',
            'highlight' => 'required',
            'content' => 'required|min:5',
            'status' => 'required',
        ]);
  
        $input = $request->all();
        
        if ($image = $request->file('thumbnail')) {
            $destinationPath = public_path('images');
            $thumbnail = time().'.'.$image->extension();
            $image->move($destinationPath, $thumbnail);
            $input['thumbnail'] = $thumbnail;
        }else{
            unset($input['thumbnail']);
        }
        $slug_replace_space = str_replace(' ', '-', $input['slug']);
        $input['slug'] = strtolower($slug_replace_space);
        $article = Article::find($request->id);
        $article->update($input);
        $article->category()->sync((array)$request->category_id);
        $article->tag()->sync((array)$request->tag_id);
    
        return redirect('admin/article')->with('success','comment has been updated successfully.');
       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $article = Article::where('id', $id)->delete();
        return redirect('admin/article')->with('success','Remove data has been successfully.');
    }

    /**
     * Get All Article by pagination
     */
    public function getArticlesApi() {
        $articles = DB::table('articles')->paginate(9);
        foreach($articles as $content) {
            $content->thumbnail = asset('images/' . $content->thumbnail);
        }
        $articles = $articles;
        return response()->json($articles);
    }

    /**
     * Get Article by slug
     */
    public function getArticleBySlugApi(string $slug) {
        $article = DB::table('articles')->where('slug', '=', $slug)->first();
        return response()->json($article);
    }

    /**
     * Get Category by id Article
     */
    public function getCategoryById(int $articleId) {
        $categoryIds = [];
        $categoryArticles = DB::table('category_articles')->where('article_id', '=', $articleId)->get();
        foreach($categoryArticles as $categoryArticle) {
            $categoryIds[] = $categoryArticle->category_id;
        }
        $categories = DB::table('categories')->whereIn('id', $categoryIds)->get();
        return response()->json($categories);
    }

    /**
     * Get Tag by Article ID
     */
    public function getTagById(int $articleId) {
        $tagIds = [];
        $tagArticles = DB::table('tag_articles')->where('article_id', '=', $articleId)->get();
        foreach($tagArticles as $tagArticle) {
            $tagIds[] = $tagArticle->tag_id;
        }
        $tags = DB::table('tags')->whereIn('id', $tagIds)->get();
        return response()->json($tags);
    }

    /**
     * Get Comment by Article ID
     */
    public function getCommentById(int $articleId) {
        $commentArticles = DB::table('comments')->where('article_id', '=', $articleId)->paginate(9);
        return response()->json($commentArticles);
    }

}
