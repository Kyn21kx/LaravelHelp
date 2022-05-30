<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Instrument;
use App\Models\InstrumentCounter;


class InstrumentController extends Controller {
    public function create(Request $request) {
        //Sacamos el cuerpo de la request
        $body = $request->all();
        //Inicializamos un nuevo instrumento con Eloquent ORM
        $toInsert = Instrument::init($body['price'], $body['description'], $body['category'], $body['picture']);
        $toInsert->save(); //Guardamos a la base de datos
        $counter = new InstrumentCounter(); //Inicializamos un nuevo contador de inventario
        //Le pasamos la disponibilidad de la petición
        $counter->Available = $body['available'];
        //Al inicio no se ha vendido nada
        $counter->Sold = 0;
        //Insertamos el id del instrumento para relacionarlos
        $counter->InstrumentId = $toInsert->id;
        $counter->save(); //Guardar a la base de datos
        return 'Inserted!'; //Respuesta 200 al cliente
    }

    public function getAll() {
        return Instrument::all();
    }

    public function getCounters() {
        return InstrumentCounter::all();
    }

    public function buy($id) {
        //Get the value from the counters based on id
        $stock = InstrumentCounter::where('InstrumentId', $id)->first();
        if ($stock->Available < 1) {
            return '
            <script>
                alert("Lo lamentamos, no tenemos más existencias para este producto");
                window.location.replace("http://localhost:8000/");
            </script>';
        }
        //Esto lo hacemos para evitar que se actualice en masa
        $auxStock = InstrumentCounter::find($stock->id);
        $auxStock->Available--;
        $auxStock->Sold++;
        $auxStock->save();
        return '
        <script>
            alert("Se ha comprado el producto '. $auxStock->Sold .' veces, quedan ' . $auxStock->Available .' disponibles");
            window.location.replace("http://localhost:8000/");
        </script>';
    }

}