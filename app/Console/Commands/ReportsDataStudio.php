<?php

namespace App\Console\Commands;

use App\Models\GradeGrades;
use App\Models\Variable;
use App\Services\GoogleSheet;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class ReportsDataStudio extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sync:dataStudio';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(GoogleSheet $googleSheet)
    {

        
        $variable = Variable::query()
            ->where('name', 'LastSyncedId')
            ->first();
            Log::info('valor de la variable');
            Log::info($variable);
        $rows = GradeGrades::query()
            ->where('id', '>', $variable->value)
            ->orderBy('id')
            ->limit(50)
            ->get();
          
        if ($rows->count() === 0) {
            return true;
        }
        Log::info('valor del rows');
        Log::info($rows);
        $finalData = collect();
        $lastId = 0;

        foreach ($rows as $row) {

            $fullname=$row->fullname ? $row->fullname : '--';
            $shortname=$row->shortname ? $row->shortname : '--';
            $name=$row->name ? $row->name : '--';
            $itemname=$row->itemname ? $row->itemname : '--';
        // -----------
            $itemid = $row->itemid ? $row->itemid : '--'; 
            $userid = $row->userid ? $row->userid : '--'; 
            $rawgrade = $row->rawgrade ? $row->rawgrade : '--'; 
            $rawgrademax = $row->rawgrademax ? $row->rawgrademax : '--'; 
            $rawgrademin = $row->rawgrademin ? $row->rawgrademin : '--'; 
            $rawscaleid = $row->rawscaleid ? $row->rawscaleid : '--'; 
            $usermodified = $row->usermodified ? $row->usermodified : '--'; 
            $finalgrade = $row->finalgrade ? $row->finalgrade : '--'; 
            $hidden = $row->hidden ? $row->hidden : '--'; 
            $locked = $row->locked ? $row->locked : '--'; 
            $locktime = $row->locktime ? $row->locktime : '--'; 
            $exported = $row->exported ? $row->exported : '--'; 
            $overridden = $row->overridden ? $row->overridden : '--'; 
            $excluded = $row->excluded ? $row->excluded : '--'; 
            $feedback = $row->feedback ? $row->feedback : '--'; 
            $feedbackformat = $row->feedbackformat ? $row->feedbackformat : '--'; 
            $information = $row->information ? $row->information : '--'; 
            $informationformat = $row->informationformat ? $row->informationformat : '--'; 
            $timecreated = $row->timecreated ? $row->timecreated : '--'; 
            $timemodified = $row->timemodified ? $row->timemodified : '--'; 
            $aggregationstatus = $row->aggregationstatus ? $row->aggregationstatus : '--'; 
            $aggregationweight = $row->aggregationweight ? $row->aggregationweight : '--'; 
            // -------------------
            $lastname=$row->lastname ? $row->lastname : '--'; 
            $firstname=$row->firstname ? $row->firstname : '--'; 
            $email=$row->email ? $row->email : '--'; 
            $institution=$row->institution ? $row->institution : '--'; 
            $department=$row->department ? $row->department : '--'; 
            $city=$row->city ? $row->city : '--'; 
            $country=$row->country ? $row->country : '--'; 
            
            $finalData->push([
                $row->id,
                $fullname,
                $shortname,
                $name,
                $itemname,
                $itemid,
                $userid,
                $rawgrade,
                $rawgrademax,
                $rawgrademin,
                $rawscaleid,
                $usermodified,
                $finalgrade,
                $hidden,
                $locked,
                $locktime,
                $exported,
                $overridden,
                $excluded,
                $feedback,
                $feedbackformat,
                $information,
                $informationformat,
                $timecreated,
                $timemodified,
                $aggregationstatus,
                $aggregationweight,
                $lastname,
                $firstname,
                $email,
                $institution,
                $department,
                $city,
                $country,
            ]);

            $lastId = $row->id;
        }
        // $texto = "[".date("Y-m-d H:i:s")."] : data";
        // Storage::append("dataStudio.txt",$texto);
        $googleSheet->saveDataToSheet($finalData->toArray( ),
        '19fWAcRS0VDuo_kWcqQlW02l2tRARsIA5sYItYdu3dSI',
        'Reporte'
    
    );

        $variable->value = $lastId;
        $variable->save();
        
        return true;
    }
}
