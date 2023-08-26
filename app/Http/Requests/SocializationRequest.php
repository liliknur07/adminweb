<?php

namespace App\Http\Requests;

use App\Traits\ApiResponder;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Response;

class SocializationRequest extends FormRequest
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
      'nama' => 'required|string|max:191',
      'instansi' => 'required|string|max:191',
      'keperluan' => 'required|string|max:191',
      'tanggal' => 'required|date',
      'waktu' => 'required',
    ];
  }

  public function messages()
  {
    return [
      'nama.required' => 'Nama harus diisi',
      'nama.string' => 'Nama harus berupa string',
      'nama.max' => 'Nama tidak boleh lebih dari 191 karakter',
      'instansi.required' => 'Instansi harus diisi',
      'instansi.string' => 'Instansi harus berupa string',
      'instansi.max' => 'Instansi tidak boleh lebih dari 191 karakter',
      'keperluan.required' => 'Keperluan harus diisi',
      'keperluan.string' => 'Keperluan harus berupa string',
      'keperluan.max' => 'Keperluan tidak boleh lebih dari 191 karakter',
      'tanggal.required' => 'Tanggal harus diisi',
      'tanggal.date' => 'Tanggal harus berupa tanggal',
      'waktu.required' => 'Waktu harus diisi',
      'waktu.time' => 'Waktu harus berupa waktu',
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
