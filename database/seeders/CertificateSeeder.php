<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Training\TrCertificateSetting;
use App\Models\Course\CrCertificateSetting;
use App\Models\Research\RpCertificate;

class CertificateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $trainingTemplate = TrCertificateSetting::orderBy('id','desc')->first();

        if($trainingTemplate){
            $trainingTemplate->delete();

            $assignTrainingTemplate = new TrCertificateSetting;
            $assignTrainingTemplate->template_id = 2;
            $assignTrainingTemplate->save();
        }else{
            $assignTrainingTemplate = new TrCertificateSetting;
            $assignTrainingTemplate->template_id = 2;
            $assignTrainingTemplate->save();
        }


        $courseTemplate = CrCertificateSetting::orderBy('id','desc')->first();

        if($courseTemplate){
            $courseTemplate->delete();

            $assignCourseTemplate = new CrCertificateSetting;
            $assignCourseTemplate->template_id = 2;
            $assignCourseTemplate->save();
        }else{
            $assignCourseTemplate = new CrCertificateSetting;
            $assignCourseTemplate->template_id = 2;
            $assignCourseTemplate->save();
        }


        $researchTemplate = RpCertificate::orderBy('id','desc')->first();

        if($researchTemplate){
            $researchTemplate->delete();

            $researchTemplate = new RpCertificate;
            $researchTemplate->template_id = 2;
            $researchTemplate->save();
        }else{
            $researchTemplate = new RpCertificate;
            $researchTemplate->template_id = 2;
            $researchTemplate->save();
        }
        
    }
}
