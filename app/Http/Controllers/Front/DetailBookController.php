<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\User;
use App\Models\Book;
use Validator;
use Zipper;
use App\Http\Controllers\Controller;

class DetailBookController extends Controller
{

    /**
     * Download book by id.
     *
     * @return Response
     */
    public function downloadSample($idbook)
    {
        $fileBooks = Book::find($idbook)->filebooks()->where('is_sample',1)->get();
        if (count($fileBooks) >= 1) {
            $files = array();
            foreach ($fileBooks as $key => $value) {
                array_push($files,base_path().'/book/'.$idbook.'/'.$value->link);
            }
            Zipper::make(base_path().'/book/'.$idbook.'/sample.zip')->add($files);
        }

        $pathDownload = base_path(). "/book/".$idbook.'/sample.zip';

        return response()->download($pathDownload);
    }

}
