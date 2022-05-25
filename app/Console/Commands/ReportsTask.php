<?php

namespace App\Console\Commands;

use App\Http\Controllers\QualificationController;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class ReportsTask extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'report:reporTask';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Traer reportes de calificaciones demoodle';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        
        $texto = "[".date("Y-m-d H:i:s")."] : Reportes";
        Storage::append("pruebaTarea.txt",$texto);

        /* Enviar Solicitud a Nuwwe */
        $objeto = new QualificationController();
        $respuesta = $objeto->getQualifications(); 
    }
}
