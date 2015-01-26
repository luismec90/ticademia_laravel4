<?php

class MaterialsController extends \BaseController {

    public function store($courseID, $moduleID)
    {
        $course = Course::findOrFail($courseID);
        $module = Module::where('course_id', $course->id)->findOrFail($moduleID);

        $validation = Validator::make(Input::all(), Material::$videoRules);
        if ($validation->fails())
        {
            Flash::error('Por favor inténtalo nuevamente');

            return Redirect::back();
        }

        $xml = simplexml_load_file('http://gdata.youtube.com/feeds/api/videos/' . Input::get('url'));
        $duration = strval($xml->xpath('//yt:duration[@seconds]')[0]->attributes()->seconds);

        $material = new Material;
        $material->module_id = $module->id;
        $material->name = Input::get('name');
        $material->description = Input::get('description');
        $material->url = Input::get('url');
        $material->duration = $duration;
        $material->type = Input::get('type');
        $material->save();

        Flash::success('Material creado exitosamente');

        return Redirect::back();
    }

    public function storeRewiews($courseID, $moduleID)
    {

        $course = Course::findOrFail($courseID);

        $validation = Validator::make(Input::all(), Review::$rules);
        if ($validation->fails())
        {
            Flash::error('Por favor inténtalo nuevamente');

            return Redirect::back();
        }

        $materialID = Input::get('material_id');

        $module = Module::where('course_id', $courseID)->findOrFail($moduleID);
        $material = Material::where('module_id', $module->id)->findOrFail($materialID);

        $review = Review::findOrNew(Input::get('review_id'));

        $review->user_id = Auth::user()->id;
        $review->material_id = $material->id;
        $review->rating = Input::get('score');
        $review->comment = Input::get('comment');

        if (Input::has('anonymous'))
            $review->anonymous = 1;
        else
            $review->anonymous = 0;

        $review->save();

        $material->recalculateRating();

        AchievementHelper::achievement_valoracionesMateriales(Auth::user(), $course);

        Flash::success('Valoración creada exitosamente');

        return Redirect::back();
    }

    public function showRewiews($courseID, $moduleID, $materialID)
    {

        $module = Module::where('course_id', $courseID)->findOrFail($moduleID);

        $material = Material::where('module_id', $module->id)->findOrFail($materialID);

        $reviews = Review::where('material_id', $material->id)->where('comment', '<>', '')->orderBy('created_at', 'DESC')->paginate(5);

        if (Request::ajax())
        {
            return Response::json(View::make('course.partials.show_reviews', compact('course', 'reviews'))->render());
        } else
        {
            return "";
        }


    }

}