<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Reviews;
use Illuminate\Http\Request;

class ReviewsController extends Controller
{
    public function index()
    {
        $reviews = Reviews::orderBy('created_at', 'desc')->paginate(15);

        return view('admin.reviews.index',[
            'reviews' => $reviews,
        ]);
    }

    public function edit($id)
    {
        $review = Reviews::find($id);
        return view('admin.reviews.edit',[
            'review' => $review
        ]);
    }

    public function update($id, Request $request)
    {
        $review = Reviews::find($id);
        $data = $request->all();
        $review->update($data);

        return back()->with('success', 'Информация успешно сохранена');
    }

    public function destroy($id)
    {
        $review = Reviews::destroy($id);

        return back()->with('success', 'Отзыв успешно удален');
    }

    public function reviewsAccepted($id)
    {
        Reviews::where('id', $id)->update(['status' => true]);

        return back()->with('success', 'Отзыв опубликован');
    }
}
