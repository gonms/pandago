<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vehiculo;
use App\Models\Requerimiento;
use App\Models\UsoVehiculo;
use App\Models\TipoCliente;
use App\Models\DuracionContrato;
use App\Http\Resources\VehiculoResource;
use Illuminate\Support\Facades\DB;

class VehiculoController extends Controller
{
	function list() {
		/*
		 * Get all vehicles data through an API Resource
		 */
   		return VehiculoResource::collection(Vehiculo::all());
	}

	function search(Request $request) {

		$collection = Vehiculo::where('id', '>', 0);

		/* 
		 * For autonomia and cuota filters, I assume that the filter values have a '-' to separate the min and max value of each option, except the higher value, which the filter value is only the number.
		 * For example, to autonomia filter, the possibles values are:
		 * 1 0-69
		 * 2 70-100
		 * 3 100
		 * So, I create an array with the value given. If array has 2 values, I use the whereBetween method to filter. If not, I use the where method.
		 */

		if ($request->filled('autonomia')) {
			$aAutonomia = explode('-', $request->autonomia);
			if (count($aAutonomia) == 1)
				$collection->where('autonomia','>', $aAutonomia[0]);
			else
				$collection->whereBetween('autonomia', [$aAutonomia[0], $aAutonomia[1]]);
		}

		if ($request->filled('cuota')) {
			$aCuota = explode('-', $request->cuota);
			if (count($aCuota) == 1)
				$collection->where('cuota','>', $aCuota[0]);
			else
				$collection->whereBetween('cuota', [$aCuota[0], $aCuota[1]]);
		}

		/*
		 * To filter by tipo_cliente, uso_vehiculo and duracion_contrato:
		 * First I get the IDs of these tables associated to the value entered, using the corresponding model.
		 * Once I get them into an array, I filter the data searching the IDs on the relationed field using the whereIn method.
		 * 
		 * Code could be simpler and more optimal if filter parameters have the IDs of each value directly, thus I wouldn´t have to search them on the model. But I use this approach to show how to use the Model to get some data.
		 */
		if ($request->filled('tipo_cliente')) {
			$aIDs = array();
			$clientes = TipoCliente::whereIn('nombre', explode(',', $request->tipo_cliente));
			foreach($clientes->get() as $valor)
				$aIDs[] = $valor->id;
			
			$collection->whereIn('tipo_cliente_id',$aIDs);
		}

		if ($request->filled('uso_vehiculo')) {
			$aIDs = array();
			$usos = UsoVehiculo::whereIn('nombre', explode(',', $request->uso_vehiculo));
			foreach($usos->get() as $valor)
				$aIDs[] = $valor->id;

			$collection->whereIn('uso_vehiculo_id',$aIDs);
		}

		if ($request->filled('duracion_contrato')) {
			$aIDs = array();
			$contratos = DuracionContrato::whereIn('nombre', explode(',', $request->duracion_contrato));
			foreach($contratos->get() as $valor)
				$aIDs[] = $valor->id;

			$collection->whereIn('duracion_contrato_id',$aIDs);
		}

		/*
		 * Once I get all desired data, I get all vehicles data through an API Resource
		 */
		return VehiculoResource::collection($collection->get());
	}

	function searchDB(Request $request) {
		/*
		 * I use the Query Builder option to get all data, joining each relationed table in case the user wants to filter with its data 
		 */
		$collection = DB::table('vehiculo')						
						->join('valoracion', 'valoracion.vehiculo_id', '=', 'vehiculo.id')
						->select('vehiculo.*')
						->selectRaw('AVG(valoracion) as valoracion')
						->groupBy('vehiculo.id','vehiculo.nombre','vehiculo.descripcion','vehiculo.autonomia','vehiculo.cuota','vehiculo.imagen');

		/* 
		 * For autonomia and cuota filters, I assume that the filter values have a '-' to separate the min and max value of each option, except the higher value, which the filter value is only the number.
		 * For example, to autonomia filter, the possibles values are:
		 * 1 0-69
		 * 2 70-100
		 * 3 100
		 * So, I create an array with the value given. If array has 2 values, I use the whereBetween method to filter. If not, I use the where method.
		 */
		if ($request->filled('autonomia')) {
			$aAutonomia = explode('-', $request->autonomia);
			if (count($aAutonomia) == 1)
				$collection->where('autonomia','>', $aAutonomia[0]);
			else
				$collection->whereBetween('autonomia', [$aAutonomia[0], $aAutonomia[1]]);
		}

		if ($request->filled('cuota')) {
			$aCuota = explode('-', $request->cuota);
			if (count($aCuota) == 1)
				$collection->where('cuota','>', $aCuota[0]);
			else
				$collection->whereBetween('cuota', [$aCuota[0], $aCuota[1]]);
		}

		/*
		 * To filter by requerimientos, which I consider them as Many-To-Many relationships with vehiculo table, I first join the 3 tables:
		 * 1 vehiculo table
		 * 2 the table I am filtering to
		 * 3 the intermediate (pivot) table that relations both
		 * Then I get the IDs of these tables associated to the value entered, using the corresponding model.
		 * Once I get them into an array, I filter the data searching the IDs on the relationed field using the whereIn method.
		 * 
		 * Code could be simpler and more optimal if filter parameters have the IDs of each value directly, thus I wouldn´t have to search them on the model. But I use this approach to show how to use the Model to get some data.
		 */
		if ($request->filled('requerimientos')) {
			$aIDs = array();
			$collection->join('requerimiento_vehiculo', 'vehiculo.id', '=', 'requerimiento_vehiculo.vehiculo_id')
				->join('requerimiento', 'requerimiento.id', '=', 'requerimiento_vehiculo.requerimiento_id');
			
			$requerimientos = Requerimiento::whereIn('nombre', explode(',', $request->requerimientos));
			foreach($requerimientos->get() as $valor)
				$aIDs[] = $valor->id;

			$collection->whereIn('requerimiento.id',$aIDs);
		}

		/*
		 * To filter by tipo_cliente, uso_vehiculo and duracion_contrato:
		 * First I get the IDs of these tables associated to the value entered, using the corresponding model.
		 * Once I get them into an array, I filter the data searching the IDs on the relationed field using the whereIn method.
		 * 
		 * Code could be simpler and more optimal if filter parameters have the IDs of each value directly, thus I wouldn´t have to search them on the model. But I use this approach to show how to use the Model to get some data.
		 */
		if ($request->filled('tipo_cliente')) {
			$aIDs = array();
			$clientes = TipoCliente::whereIn('nombre', explode(',', $request->tipo_cliente));
			foreach($clientes->get() as $valor)
				$aIDs[] = $valor->id;
			
			$collection->whereIn('tipo_cliente_id',$aIDs);
		}

		if ($request->filled('uso_vehiculo')) {
			$aIDs = array();
			$usos = UsoVehiculo::whereIn('nombre', explode(',', $request->uso_vehiculo));
			foreach($usos->get() as $valor)
				$aIDs[] = $valor->id;

			$collection->whereIn('uso_vehiculo_id',$aIDs);
		}

		if ($request->filled('duracion_contrato')) {
			$aIDs = array();
			$contratos = DuracionContrato::whereIn('nombre', explode(',', $request->duracion_contrato));
			foreach($contratos->get() as $valor)
				$aIDs[] = $valor->id;

			$collection->whereIn('duracion_contrato_id',$aIDs);
		}

		/*
		 * Once I get all desired data, I send it through a JSON object.
		 */
		return response()->json($collection->get(),200);
	}
}