<?php

namespace App\Http\Controllers;

use stdClass;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Classes\Api\Interfaces\PostRepositoryInterface;

class PostController extends Controller
{
    protected $api;

    public function __construct(PostRepositoryInterface $client)
    {
        $this->api = new stdClass();
        $this->api->posts = $client;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Pagination settings
        $input = Input::all();
        $input['_page'] = Input::get('_page', 1);
        $input['_limit'] = Input::get('_limit', 3);
        $input['_sort'] = Input::get('_sort', 'id');
        $input['_order'] = Input::get('_order', 'ASC');

        // Get posts from Api
        $response = $this->api->posts->all($input);

        $posts = $response['data'];
        $total = $response['total'];

        // Create our paginator and pass it to the view
        $paginator = new LengthAwarePaginator($posts, $total, $input['_limit'], $input['_page']);

        // Load the view and pass the posts
        return view('posts.index', ['posts' => $paginator->setPath('posts')->setPageName('_page')->appends($input)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate input data
        $this->validate($request, [
            'title' => 'required|max:255',
            'body' => 'required',
            'userId' => 'required|numeric',
        ]);

        try {
            // Create new post
            $this->api->posts->create(Input::all());

            Session::flash('success', 'Post was successfully created.');
        } catch (Exception $e) {
            Session::flash('failure', 'An error occurred. Post was not created.');
        }

        return redirect('posts');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Get the post
        $post = $this->api->posts->get($id);

        // Show the view and pass the post to it
        return view('posts.show', ['post' => $post]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // Get the post
        $post = $this->api->posts->get($id);

        // Show the edit form and pass the post
        return view('posts.edit', ['post' => $post]);
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
        // Validate input data
        $this->validate($request, [
            'title' => 'required|max:255',
            'body' => 'required',
            'userId' => 'required|numeric',
        ]);

        try {
            // Update the post
            $this->api->posts->update($id, Input::all());

            Session::flash('success', 'Post was successfully updated.');
        } catch (Exception $e) {
            Session::flash('failure', 'An error occurred. Post was not updated.');
        }

        return redirect('posts/' . $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            // Remove the post
            $this->api->posts->delete($id);

            Session::flash('success', 'Post was successfully deleted.');
        } catch (Exception $e) {
            Session::flash('failure', 'An error occurred. Post was not deleted.');
        }

        return redirect('posts');
    }
}
