<?php

class MaterialsController extends \BaseController {

    public function storeRewiews($courseID, $moduleID)
    {

        $validation = Validator::make(Input::all(), Review::$rules);
        if ($validation->fails())
        {
            return dd($validation);
        }

        $materialID = Input::get('material_id');

        $module = Module::where('course_id', $courseID)->findOrFail($moduleID);
        $material = Material::where('module_id', $module->id)->findOrFail($materialID);

        $review = Review::findOrNew(Input::get('review_id'));

        $review->user_id = Auth::user()->id;
        $review->material_id = $material->id;
        $review->rating = Input::get('score');
        $review->comment = Input::get('comment');
        $review->save();

        $material->recalculateRating();

        Flash::success('Valoración creada exitosamente');

        return Redirect::back();
    }

    public function showRewiews($courseID, $moduleID, $materialID)
    {

        $module = Module::where('course_id', $courseID)->findOrFail($moduleID);

        $material = Material::where('module_id', $module->id)->findOrFail($materialID);

        $reviews = Review::where('material_id', $material->id)->where('comment','<>','')->orderBy('created_at', 'DESC')->paginate(5);

        if (Request::ajax())
        {
            return Response::json(View::make('course.partials.show_reviews', compact('course', 'reviews'))->render());
        } else
        {
            return "";
        }


    }

}