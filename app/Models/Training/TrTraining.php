<?php

namespace App\Models\Training;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrTraining extends Model
{
    protected $table = 'tr_training';


    public function Place(){
        return $this->hasOne('App\Models\Training\TrTrainingPlace','id','training_place_id');
    }

    public function Course(){
        return $this->hasOne('App\Models\Training\TrCourse','id','training_course_id');
    }

    public function TrainingCart(){
        return $this->hasOne('App\Models\Training\TrAddToCart','training_id','id');
    }

    public function Batch(){
        return $this->hasOne('App\Models\Training\TrBatch','training_id','id');
    }

    public function TotalBatches(){
        return $this->hasMany('App\Models\Training\TrBatch','training_id','id')->orderBy('id','desc');
    }

    public function TotalEnrollOrders(){
        return $this->hasMany('App\Models\Training\TrTrainingOrder','training_id','id');
    }

    public function TrainingImage(){
        return $this->hasOne('App\Models\Training\TrainingImages','training_id','id')->orderBy('id','desc');
    }

    public function language(){
        return $this->hasOne('App\Models\Language','id','language_id');
    }

    public function TrainingCategory(){
        return $this->hasOne('App\Models\Training\TrCategory','id','training_category_id');
    }

    public function TrainingCategoryEnrollments(){
        return $this->hasOne('App\Models\Training\TrCategoryEnrollment','category_id','training_category_id');
    }

    public function TrainingEnrolls(){
        return $this->hasMany('App\Models\Training\TrTrainingOrder','training_id','id');
    }

    public function TrainingClasses(){
        return $this->hasMany('App\Models\Training\TrTrainingClass','training_id','id');
    }

    public function TrainingReviews(){
        return $this->hasMany('App\Models\Training\TrStudentReview','training_id','id');
    }

    public function User(){
        return $this->hasOne('App\Models\User','id','created_by');
    }

}
