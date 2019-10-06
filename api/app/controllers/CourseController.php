<?php

use Illuminate\Support\Facades\Input;

class CourseController extends BaseController {

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function showList()
    {
        $data = Input::all();
     if ((trim($data['online'])!=""))
        {
            $courses = DB::table('app_course')

                ->where('online',$data['online'] )
                ->orderBy('id', 'desc')
                ->paginate(10);
        }

        else
        {
            $courses = DB::table('app_course')
                ->orderBy('id', 'desc')
                ->paginate(10);
        }
        foreach ( $courses as $course) {
            $plans =  DB::table('app_courseplan')->where('course',$course->id )->orderBy('id', 'desc')->get();
            $course->planlist =$plans;
           $cid= $course->id;
           $flag=0;
            foreach ($plans as $plan)
            {
            $count=   DB::table('app_paylog')->where('courseid',$course->id )->where('userid',$data['loginid'])->where('planid',$plan->id)->orderBy('id', 'desc')->count();
             if($count>0)
             {
                 $flag=1;
             }
           }
            $course->paidstatus =$flag;


    }
   return  $courses->toJson();

       // return Response::json(array('error' => false, 'message' => $result), 200);
    }


    public function showVideoList()
    {
       $data = Input::all();
      if ((trim($data['course'])!=""))
        {
            $videos = DB::table('app_video')

                ->where('course',$data['course'])
                ->orderBy('id', 'desc')
               ->paginate(10);
       }

        else
        {
           $videos = DB::table('app_video')
                ->orderBy('id', 'desc')
                ->paginate(10);
       }
        $plans =  DB::table('app_courseplan')->where('course',$data['course'] )->orderBy('id', 'desc')->get();
        $flag=0;
        foreach ($plans as $plan)
        {
           $count=   DB::table('app_paylog')->where('courseid',$data['course'])->where('userid',$data['loginid'])->where('planid',$plan->id)->orderBy('id', 'desc')->count();
            if($count>0)
           {
                $flag=1;
            }
       }
        foreach ($videos as $video)
        {
           $video->paidstatus=$flag;
        }

       return  $videos->toJson();

    }




}
