<?php

class ForumController extends \BaseController {


    public function index($course_id)
    {
        $course = Course::with('subject')->findOrFail($course_id);

        $topics = Topic::with('user')
            ->where('course_id', $course->id)
            ->paginate(20);


        return View::make('course.forum.index', compact('course', 'topics'));
    }

    public function show($course_id, $topic_id)
    {
        $course = Course::with('subject')->findOrFail($course_id);

        $topic = Topic::with('user')
            ->where('course_id', $course->id)
            ->findOrFail($topic_id);

        $topicReplies = TopicReply::with('user')
            ->where('topic_id', $topic->id)
            ->orderBy('created_at', 'DESC')
            ->paginate(20);

        return View::make('course.forum.topic', compact('course', 'topic','topicReplies'));
    }

}