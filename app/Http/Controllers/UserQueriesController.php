<?php

namespace App\Http\Controllers;

use App\Services\UserQueriesService;
use Illuminate\Http\Request;

class UserQueriesController extends Controller
{
    public function __construct(public UserQueriesService $service)
    {
        
    }

    public function index(){
        $queries = $this->service->getAllQueries();
        return view('queries.index', compact('queries'));
    }
}
