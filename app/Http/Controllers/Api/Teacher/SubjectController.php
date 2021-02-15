<?php

namespace App\Http\Controllers\Api\Teacher;

use App\Http\Requests\Teacher\SubjectStoreRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Subject;
use App\Models\Teacher;
use App\Helpers\Helper;
use Auth;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public static function need() { return 'teacher'; }

    public function index()
    {
        $need = 'all';
        return response()->json(self::pagination($need), 200);
    }

    public function pending() {
        $need = 'pending';
        return response()->json(self::pagination($need), 200);
    }
    public function recent() {
        $need = 'recent';
        return response()->json(self::pagination($need), 200);
    }
    public function drafts() {
        $need = 'drafts';
        return response()->json(self::pagination($need), 200);
    }

    public static function pagination($need) {

        $subjects = Teacher::find(Helper::auth(self::need())->id)->subjects();

        if($need == 'all')
        {
            return $subjects->paginate(6);
        }
        else if($need == 'pending')
        {
            return $subjects->where('status', 0)->paginate(3);
        }
        else if($need == 'recent')
        {
            return $subjects->where('status', 1)
                    ->orderBy('created_at', 'DESC')
                    ->paginate(6);
        }
        else
        {
            return $subjects->where('status', 2)->paginate(6);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SubjectStoreRequest $request)
    {
        $teacher = Teacher::find(Helper::auth(self::need())->id);

        $subject = new Subject();
        $subject->subject_uid = Helper::getUuid();
        $subject->title = $request->title;
        $subject->description = $request->description;
        $subject->type = $request->type;
        $subject->duration = $request->duration;
        $subject->duration_type = $request->duration_type;
        $subject->price = $request->price;

        $teacher->subjects()->save($subject);

        return response()->json($teacher->subjects,200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Subject::where('subject_uid', $id)->first();
        return response()->json($data, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
