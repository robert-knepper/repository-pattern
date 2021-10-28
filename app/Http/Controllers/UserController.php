<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchRequest;
use App\Http\Requests\UserRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\User;
use App\Repositories\Eloquent\UserRepository;

class UserController extends Controller
{
    private $userRepository;
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function index()
    {
        return $this->userRepository->all();
    }

    public function searchByName(SearchRequest $searchRequest)
    {
        return User::where('name', 'like',
            '%'
            . $searchRequest->input('query_param')
            . '%')->get();
    }

    public function store(UserRequest $request)
    {
        return $this->userRepository->create($request->all());
    }

    public function show($id)
    {
        return $this->userRepository->findOrFail($id);
    }

    public function update(UserUpdateRequest $request, $id)
    {
        return $this->userRepository->update($id,$request->all());
    }

    public function destroy($id) : bool
    {
        return $this->userRepository->delete($id);
    }
}
