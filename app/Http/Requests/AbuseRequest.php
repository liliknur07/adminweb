<?php

namespace App\Http\Requests;

use App\Traits\ApiResponder;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Response;

class AbuseRequest extends FormRequest
{
  use ApiResponder;
  /**
   * Determine if the user is authorized to make this request.
   *
   * @return bool
   */
  public function authorize()
  {
    return true;
  }

  /**
   * Get the validation rules that apply to the request.
   *
   * @return array<string, mixed>
   */
  public function rules()
  {
    return [
      'phone' => 'required|max:20',
      'kecamatan' => 'required|string|max:50',
      'alamat' => 'required|string|max:191',
      'long' => 'required|string|max:191',
      'lat' => 'required|string|max:191',
      'foto' => 'required|image|max:10240',
    ];
  }

  public function messages()
  {
    return [
      'phone.max' => 'Nomor HP maksimal 20 karakter',
      'kecamatan.required' => 'Kecamatan harus diisi',
      'kecamatan.string' => 'Kecamatan harus berupa string',
      'kecamatan.max' => 'Kecamatan maksimal 50 karakter',
      'alamat.required' => 'Alamat harus diisi',
      'alamat.string' => 'Alamat harus berupa string',
      'alamat.max' => 'Alamat maksimal 191 karakter',
      'long.required' => 'Longitude harus diisi',
      'long.string' => 'Longitude harus berupa string',
      'long.max' => 'Longitude maksimal 191 karakter',
      'lat.required' => 'Latitude harus diisi',
      'lat.string' => 'Latitude harus berupa string',
      'lat.max' => 'Latitude maksimal 191 karakter',
      'foto.required' => 'Foto harus diisi',
      'foto.image' => 'Foto harus berupa gambar',
      'foto.max' => 'Foto maksimal berukuran 5 Mb',
    ];
  }

  public function failedValidation(Validator $validator)
  {
    throw new HttpResponseException(response()->json([
      'status'   => Response::HTTP_UNPROCESSABLE_ENTITY,
      'message'   => 'Validation errors',
      'data'      => $validator->errors()
    ], Response::HTTP_UNPROCESSABLE_ENTITY));
  }
}
