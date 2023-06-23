<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\ValoracionResource;

class VehiculoResource extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'nombre' => $this->nombre,
            'descripcion' => $this->descripcion,
            'imagen' => $this->imagen,
            'autonomia' => $this->autonomia,
            'cuota' => $this->cuota,
            'valoracion' => ValoracionResource::collection($this->valoraciones)->avg('valoracion'),
            'requerimientos' => $this->requerimientos,
            'tipo_cliente' => $this->tipo_cliente,
            'uso_vehiculo' => $this->uso_vehiculo,
            'duracion_contrato' => $this->duracion_contrato
        ];
    }
}
