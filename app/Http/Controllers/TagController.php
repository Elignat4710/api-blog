<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchWordRequest;
use App\Services\Interfaces\TagServiceInterface;

class TagController extends Controller
{
    protected $tagService;

    public function __construct(TagServiceInterface $tagService)
    {
        $this->tagService = $tagService;
    }

    public function search(SearchWordRequest $request)
    {
        $search = $request->validated();

        $result = $this->tagService->search($search['search']);

        return $result ?: response()->json(['message' => 'No posts with this tag']);
    }
}
