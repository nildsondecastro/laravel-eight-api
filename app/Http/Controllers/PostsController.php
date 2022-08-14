<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\PostsCreateRequest;
use App\Http\Requests\PostsUpdateRequest;
use App\Repositories\PostsRepository;
use App\Validators\PostsValidator;

class PostsController extends Controller
{
    protected $repository;
    protected $validator;

    public function __construct(PostsRepository $repository, PostsValidator $validator)
    {
        $this->repository = $repository;
        $this->validator  = $validator;
    }

    public function index()
    {
        $this->repository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
        $posts = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $posts,
            ]);
        }

        return response()->json("Accept Application Json Not identified");
    }

    public function store(PostsCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $post = $this->repository->create($request->all());

            $response = [
                'message' => 'Posts created.',
                'data'    => $post->toArray(),
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }

            return redirect()->back()->with('message', $response['message']);
        } catch (ValidatorException $e) {
            if ($request->wantsJson()) {
                return response()->json([
                    'error'   => true,
                    'message' => $e->getMessageBag()
                ]);
            }

            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
    }

    public function show($id)
    {
        $post = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $post,
            ]);
        }

        return response()->json("Accept Application Json Not identified");
    }

    public function edit($id)
    {
        $post = $this->repository->find($id);

        return response()->json("Accept Application Json Not identified");
    }

    public function update(PostsUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $post = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'Posts updated.',
                'data'    => $post->toArray(),
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }

            return redirect()->back()->with('message', $response['message']);
        } catch (ValidatorException $e) {

            if ($request->wantsJson()) {

                return response()->json([
                    'error'   => true,
                    'message' => $e->getMessageBag()
                ]);
            }

            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
    }

    public function destroy($id)
    {
        $deleted = $this->repository->delete($id);

        if (request()->wantsJson()) {

            return response()->json([
                'message' => 'Posts deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'Posts deleted.');
    }
}
