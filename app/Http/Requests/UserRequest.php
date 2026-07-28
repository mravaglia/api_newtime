<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
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
        $userId = $this->route('user'); // id preso dalla rotta

        $ret = [
                'name'    => ['required', 'string', 'max:255'],
                'lastname' => ['required', 'string', 'max:255'],
        ];

        //In update devo ignorare l'id per evitare che contrrolli l'unicità della mail nella riga che sto aggiornando
        if($userId) {
            $ret['email'] = ['required', 'string', 'email', 'max:255',
                    Rule::unique('users', 'email')->ignore($userId)];
        } else {
            $ret['email'] = ['required', 'string', 'email', 'max:255', 'unique:users'];
        }
        return $ret;
    }

    public function messages(): array
    {
        return [
            'name.required'    => 'Il nome è obbligatorio.',
            'name.string'      => 'Il nome deve essere una stringa di testo.',
            'name.max'         => 'Il nome non può superare i 255 caratteri.',

            'lastname.required' => 'Il cognome è obbligatorio.',
            'lastname.string'   => 'Il cognome deve essere una stringa di testo.',
            'lastname.max'      => 'Il cognome non può superare i 255 caratteri.',

            'email.required'   => "L'email è obbligatoria.",
            'email.string'     => "L'email deve essere una stringa di testo.",
            'email.email'      => "L'email non è formattata correttamente.",
            'email.max'        => "L'email non può superare i 255 caratteri.",
            'email.unique'     => 'Questa email è già registrata.',
        ];
    }
}
