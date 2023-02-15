<?php

use App\Http\Resources\CommentResource;
use App\Http\Resources\PostResource;
use App\Http\Resources\UserResource;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use Spatie\QueryBuilder\AllowedInclude;
use Spatie\QueryBuilder\Concerns\AddsIncludesToQuery;
use Spatie\QueryBuilder\Exceptions\InvalidIncludeQuery;
use Spatie\QueryBuilder\Includes\IncludeInterface;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\QueryBuilderRequest;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Model::preventLazyLoading();

Route::get('users', function () {
    // $users = QueryBuilder::for(User::class)
    //     ->allowedIncludes([
    //         'comments.post',
    //         'posts.comments.user.profile_picture',
    //         'posts.tags',
    //         'profile_picture',
    //     ])
    //     ->limit(5)
    //     ->get();

    return UserResource::collection(User::limit(5)->get());
});

Route::get('users/{user}', function (User $user) {
    return UserResource::make($user);
});

Route::get('posts', function () {
    return PostResource::collection(Post::all());
});

Route::post('posts', function () {
    return PostResource::make(Post::create([
        'title' => request('title'),
        'content' => request('content'),
        'user_id' => request('user_id'),
    ]));
});

Route::get('posts/{post}', function (Post $post) {
    return PostResource::make($post);
});

Route::get('comments', function () {
    return CommentResource::collection(Comment::all());
});

Route::get('comments/{comment}', function (Comment $comment) {
    return CommentResource::make($comment);
});
// class LoadBuilder
// {
//     use AddsIncludesToQuery;

//     protected QueryBuilderRequest $request;

//     protected Model $subject;

//     protected Collection $allowedIncludes;

//     public function __construct(Model $subject, ?Request $request = null)
//     {
//         $this->subject = $subject;

//         $this->request = $request
//             ? QueryBuilderRequest::fromRequest($request)
//             : app(QueryBuilderRequest::class);
//     }

//     public static function for(Model $subject, ?Request $request): self
//     {
//         return new static($subject, $request);
//     }
// }
// }
