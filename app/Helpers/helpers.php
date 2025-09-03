<?php

namespace App\Helpers;
use App\Models\BookRequest;
use DB;

class Helpers{
    public function customPaginate($items, $perPage = 1, $pageName = 'page', $fragment = null)
    {
        $currentPage = request()->query($pageName, 1);


        $paginator = new \Illuminate\Pagination\LengthAwarePaginator(
            $items->forPage($currentPage, $perPage),
            $items->count(),
            $perPage,
            $currentPage,
            ['path' => request()->url(), 'query' => request()->query()]
        );

        return $paginator->appends(request()->except('page'))->fragment($fragment);
    }
    public static function bookReqCount($book_id, $location_id)
    {
        $request = BookRequest::where('book_id', $book_id)
        ->where('book_location_id', $location_id)
        ->whereIn('issue_status', [0, 1, 3])
        ->count();
        return $request;
    }

}
