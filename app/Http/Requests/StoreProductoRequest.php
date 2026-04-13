<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreProductoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'status'      => 'required|in:Activo,Inactivo',
            'category'    => 'required|in:Producto físico,Producto digital',
            'stock'       => 'required|integer|min:0',
            'price'       => 'required|numeric|min:0',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required'        => 'El campo nombre del producto es obligatorio.',
            'status.required'      => 'El campo estado es obligatorio.',
            'status.in'            => 'El campo estado debe ser Activo o Inactivo.',
            'category.required'    => 'La campo categoría es obligatoria.',
            'category.in'          => 'La campo categoría debe ser Producto físico o Producto digital.',
            'price.required'       => 'El campo precio es obligatorio.',
            'price.numeric'        => 'El campo precio debe ser un número válido.',
            'stock.required'       => 'El campo stock es obligatorio.',
            'stock.numeric'        => 'El campo stock debe ser un número válido.',
        ];
    }
}
