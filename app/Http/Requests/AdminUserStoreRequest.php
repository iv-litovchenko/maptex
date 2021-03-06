<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AdminUserStoreRequest extends FormRequest
{
    /**
     * Флаг разрешения отправки формы
     * <true>, предоставляя право всем желающим отправлять форму
     * <false>, предоставляя право только авторизовавшимся пользователям
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check();
    }

    /**
     * Список правил валидации
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email' => 'required|email|max:50|unique:users',
            'name' => 'required|min:3|max:50',
            'password' => 'required|min:6|confirmed',
            'password_confirmation' => 'required|min:6'
        ];
    }

    /**
     * Сообщения для правил валидации
     *
     * @return array
     */
    public function messages()
    {
        return [
            'email.unique' => 'Email уже существует',
            'email.*' => 'Email заполнен не правильно',
            'name.*' => 'Имя заполнено не правильно',
            'password.*' => 'Пароль заполнен не правильно',
            'password_confirmation.*' => '',
        ];
    }
}
