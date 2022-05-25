<?php

namespace App\Http\Controllers;

use App\Models\GradeGrades;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class QualificationController extends Controller
{
   public function getQualifications(){

    $qualifications= DB::connection('mysql2')->select(
        'SELECT mdl_course.fullname,mdl_course.shortname,mdl_h5pactivity.name,mdl_grade_items.itemname,mdl_grade_grades.*,
         mdl_user.lastname,mdl_user.firstname,mdl_user.email,mdl_user.institution,mdl_user.department,mdl_user.city,mdl_user.country 
         FROM mdl_course 
         INNER JOIN mdl_h5pactivity on mdl_course.id = mdl_h5pactivity.course 
         INNER JOIN mdl_grade_items on mdl_course.id=mdl_grade_items.courseid 
         INNER JOIN mdl_grade_grades ON mdl_grade_grades.itemid = mdl_grade_items.id 
         INNER JOIN mdl_user ON mdl_grade_grades.userid=mdl_user.id'
        // 'SELECT * FROM mdl_grade_grades'
    );

    $ultimo=GradeGrades::all();
    foreach($qualifications as $qualification){
     
        $grades= new GradeGrades();
        $grades->fullname=$qualification->fullname;
        $grades->shortname=$qualification->shortname;
        $grades->name=$qualification->name;
        $grades->itemname=$qualification->itemname;
        // ------------
        $grades->itemid=$qualification->itemid;
        $grades->userid=$qualification->userid;
        $grades->rawgrade=$qualification->rawgrade;
        $grades->rawgrademax=$qualification->rawgrademax;
        $grades->rawgrademin=$qualification->rawgrademin;
        $grades->rawscaleid=$qualification->rawscaleid;
        $grades->usermodified=$qualification->usermodified;
        $grades->finalgrade=$qualification->finalgrade;
        $grades->hidden=$qualification->hidden;
        $grades->locked=$qualification->locked;
        $grades->locktime=$qualification->locktime;
        $grades->exported=$qualification->exported;
        $grades->overridden=$qualification->overridden;
        $grades->excluded=$qualification->excluded;
        $grades->feedback=$qualification->feedback;
        $grades->feedbackformat=$qualification->feedbackformat;
        $grades->information=$qualification->information;
        $grades->informationformat=$qualification->informationformat;
        $grades->timecreated=$qualification->timecreated;
        $grades->timemodified=$qualification->timemodified;
        $grades->aggregationstatus=$qualification->aggregationstatus;
        $grades->aggregationweight=$qualification->aggregationweight;
        // ---------------
        $grades->lastname=$qualification->lastname;
        $grades->firstname=$qualification->firstname;
        $grades->email=$qualification->email;
        $grades->institution=$qualification->institution;
        $grades->department=$qualification->department;
        $grades->city=$qualification->city;
        $grades->country=$qualification->country;

        if( sizeof($ultimo)===0){  
        $grades->save();
    }
    if(sizeof($ultimo)>0&&$qualification->id > $ultimo->last()->id){
        $grades->save();
    }
    }

    return response()->json($grades);
   }
}
