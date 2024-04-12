<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted' => 'Поле ":attribute" должно быть принято.',
    'accepted_if' => 'Поле ":attribute" должно быть принято, если ":other" — :value.',
    'active_url' => 'Поле ":attribute" должно быть URL-адресом.',
    'after' => 'Поле ":attribute" должно быть датой после :date.',
    'after_or_equal' => 'Поле ":attribute" должно быть датой не раньше :date.',
    'alpha' => 'Поле ":attribute" должно содержать только буквы.',
    'alpha_dash' => 'Поле ":attribute" должно содержать только буквы, цифры, дефисы, and символы нижнего подчёркивания.',
    'alpha_num' => 'Поле ":attribute" должно содержать только буквы и цифры.',
    'array' => 'Поле ":attribute" должно быть массивом.',
    'ascii' => 'Поле ":attribute" должно содержать только однобайтовые символы.',
    'before' => 'Поле ":attribute" должно быть датой до :date.',
    'before_or_equal' => 'Поле ":attribute" должно быть датой не позднее :date.',
    'between' => [
        'array' => 'Поле ":attribute" должно иметь от :min до :max элементов.',
        'file' => 'Поле ":attribute" должно иметь размер от :min до :max КБ.',
        'numeric' => 'Поле ":attribute" должно быть между :min и :max.',
        'string' => 'Поле ":attribute" должно иметь длину от :min до :max символов.',
    ],
    'boolean' => 'Поле ":attribute" должно иметь значение "истина" либо "ложь".',
    'can' => 'Ошибка доступа по полю ":attribute".',
    'confirmed' => 'Поле ":attribute" и его подтверждение не совпадают.',
    'current_password' => 'Неверный пароль.',
    'date' => 'Поле ":attribute" должно быть корректной датой.',
    'date_equals' => 'Поле ":attribute" должно быть датой :date.',
    'date_format' => 'Поле ":attribute" должно соответствовать формату :format.',
    'decimal' => 'Поле ":attribute" должно иметь :decimal знаков после запятой.',
    'declined' => 'Поле ":attribute" должно быть отклонено.',
    'declined_if' => 'Поле ":attribute" должно быть отклонено, если ":other" — :value.',
    'different' => 'Поля ":attribute" и ":other" должны быть разными.',
    'digits' => 'Поле ":attribute" должно иметь :digits цифр.',
    'digits_between' => 'Поле ":attribute" должно иметь от :min до :max цифр.',
    'dimensions' => 'Поле ":attribute" имеет некорректные размеры изображения.',
    'distinct' => 'Поле ":attribute" не должно дублироваться.',
    'doesnt_end_with' => 'Поле ":attribute" не должно заканчиваться на следующем: :values.',
    'doesnt_start_with' => 'Поле ":attribute" не должно начинаться со следующего: :values.',
    'email' => 'Поле ":attribute" должно быть корректным E-mail адресом.',
    'ends_with' => 'Поле ":attribute" должно заканчиваться на следующем: :values.',
    'enum' => 'Выбранное значение ":attribute" некорректно.',
    'exists' => 'Выбранное значение ":attribute" некорректно.',
    'extensions' => 'Поле ":attribute" должно иметь одно из следующих расширений: :values.',
    'file' => 'Поле ":attribute" должно быть файлом.',
    'filled' => 'Поле ":attribute" должно быть заполнено.',
    'gt' => [
        'array' => 'Поле ":attribute" должно иметь более :value элементов.',
        'file' => 'Поле ":attribute" должно иметь размер более :value КБ.',
        'numeric' => 'Поле ":attribute" должно быть более :value.',
        'string' => 'Поле ":attribute" должно содержать более :value символов.',
    ],
    'gte' => [
        'array' => 'Поле ":attribute" должно иметь не менее :value элементов.',
        'file' => 'Поле ":attribute" должно иметь размер не менее :value КБ.',
        'numeric' => 'Поле ":attribute" должно быть не менее :value.',
        'string' => 'Поле ":attribute" должно содержать не менее :value символов.',
    ],
    'hex_color' => 'Поле ":attribute" должно быть корректных шестнадцатиричным кодом цвета.',
    'image' => 'Поле ":attribute" должно быть изображением.',
    'in' => 'Выбранное значение ":attribute" некорректно.',
    'in_array' => 'Значение поля ":attribute" должно находиться в поле ":other".',
    'integer' => 'Поле ":attribute" должно быть целым числом.',
    'ip' => 'Поле ":attribute" должно быть корректным IP-адресом.',
    'ipv4' => 'Поле ":attribute" должно быть корректным IPv4-адресом.',
    'ipv6' => 'Поле ":attribute" должно быть корректным IPv6-адресом.',
    'json' => 'Поле ":attribute" должно быть корректной JSON-строкой.',
    'list' => 'Поле ":attribute" должно быть списком.',
    'lowercase' => 'Поле ":attribute" должно быть в нижнем регистре.',
    'lt' => [
        'array' => 'Поле ":attribute" должно иметь менее :value элементов.',
        'file' => 'Поле ":attribute" должно иметь размер менее :value КБ.',
        'numeric' => 'Поле ":attribute" должно быть менее :value.',
        'string' => 'Поле ":attribute" должно содержать менее :value символов.',
    ],
    'lte' => [
        'array' => 'Поле ":attribute" должно иметь не более :value элементов.',
        'file' => 'Поле ":attribute" должно иметь размер не более :value КБ.',
        'numeric' => 'Поле ":attribute" должно быть не более :value.',
        'string' => 'Поле ":attribute" должно содержать не более :value символов.',
    ],
    'mac_address' => 'Поле ":attribute" должно быть корректным MAC-адресом.',
    'max' => [
        'array' => 'Поле ":attribute" должно иметь не более :value элементов.',
        'file' => 'Поле ":attribute" должно иметь размер не более :value КБ.',
        'numeric' => 'Поле ":attribute" должно быть не более :value.',
        'string' => 'Поле ":attribute" должно содержать не более :value символов.',
    ],
    'max_digits' => 'Поле ":attribute" должно иметь не более :max цифр.',
    'mimes' => 'Поле ":attribute" должно быть файлом одного из следующих MIME-типов: :values.',
    'mimetypes' => 'Поле ":attribute" должно быть файлом одного из следующих MIME-типов: :values.',
    'min' => [
        'array' => 'Поле ":attribute" должно иметь не менее :value элементов.',
        'file' => 'Поле ":attribute" должно иметь размер не менее :value КБ.',
        'numeric' => 'Поле ":attribute" должно быть не менее :value.',
        'string' => 'Поле ":attribute" должно содержать не менее :value символов.',
    ],
    'min_digits' => 'Поле ":attribute" должно иметь не менее :min цифр.',
    'missing' => 'Поле ":attribute" должно отсутствовать.',
    'missing_if' => 'Поле ":attribute" должно отсутствовать, если ":other" — :value.',
    'missing_unless' => 'Поле ":attribute" должно отсутствовать, если ":other" — не :value.',
    'missing_with' => 'Поле ":attribute" должно отсутствовать, если ":values" есть.',
    'missing_with_all' => 'Поле ":attribute" должно отсутствовать, если :values есть.',
    'multiple_of' => 'Поле ":attribute" должно быть кратным :value.',
    'not_in' => 'Выбранное значение ":attribute" некорректно.',
    'not_regex' => 'Поле ":attribute" имеет некорректный формат.',
    'numeric' => 'Поле ":attribute" должно быть числом.',
    'password' => [
        'letters' => 'Поле ":attribute" должно содержать минимум одну букву.',
        'mixed' => 'Поле ":attribute" должно содержать минимум одну букву в верхнем регистре и одну букву в нижнем регистре.',
        'numbers' => 'Поле ":attribute" должно содержать минимум одну цифру.',
        'symbols' => 'Поле ":attribute" должно содержать минимум один специальный символ.',
        'uncompromised' => 'Это значение поля ":attribute" появлялось в утечках данных. Пожалуйста, введите другое значение.',
    ],
    'present' => 'Поле ":attribute" должно присутствовать.',
    'present_if' => 'Поле ":attribute" должно присутствовать, если ":other" — :value.',
    'present_unless' => 'Поле ":attribute" должно присутствовать, если ":other" — не :value.',
    'present_with' => 'Поле ":attribute" должно присутствовать, если ":values" есть.',
    'present_with_all' => 'Поле ":attribute" должно присутствовать, если :values есть.',
    'prohibited' => 'Значение поля ":attribute" запрещено.',
    'prohibited_if' => 'Значение поля ":attribute" запрещено, если ":other" — :value.',
    'prohibited_unless' => 'Значение поля ":attribute" запрещено, если ":other" — не :values.',
    'prohibits' => 'Значение поля ":attribute" запрещает ":other" к заполнению.',
    'regex' => 'Поле ":attribute" имеет некорректный формат.',
    'required' => 'Поле ":attribute" обязательно.',
    'required_array_keys' => 'Поле ":attribute" должно содержать ключи для: :values.',
    'required_if' => 'Поле ":attribute" обязательно, если ":other" — :value.',
    'required_if_accepted' => 'Поле ":attribute" обязательно, если значение ":other" принято.',
    'required_unless' => 'Поле ":attribute" обязательно, если ":other" — не :values.',
    'required_with' => 'Поле ":attribute" обязательно, если ":values" присутствует.',
    'required_with_all' => 'Поле ":attribute" обязательно, если ":values" присутствует.',
    'required_without' => 'Поле ":attribute" обязательно, если ":values" отсутствует.',
    'required_without_all' => 'Поле ":attribute" обязательно, если ":values" отсутствует.',
    'same' => 'Поле ":attribute" должно совпадать с полем ":other".',
    'size' => [
        'array' => 'Поле ":attribute" должно иметь :size элементов.',
        'file' => 'Файл из поля ":attribute" должен иметь размер :size КБ.',
        'numeric' => 'Поле ":attribute" должно иметь :size цифр.',
        'string' => 'Поле ":attribute" должно содержать :size символов.',
    ],
    'starts_with' => 'Поле ":attribute" должно начинаться со следующего: :values.',
    'string' => 'Поле ":attribute" должно быть строкой.',
    'timezone' => 'Поле ":attribute" должно быть корректным часовым поясом.',
    'unique' => 'Значение поля ":attribute" уже занято.',
    'uploaded' => 'Файл из поля ":attribute" не удалось загрузить.',
    'uppercase' => 'Поле ":attribute" должно быть в верхнем регистре.',
    'url' => 'Поле ":attribute" должно быть корректным URL-адресом.',
    'ulid' => 'Поле ":attribute" должно быть корректным ULID.',
    'uuid' => 'Поле ":attribute" должно быть корректным UUID.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [
        'email' => 'E-mail',
        'password' => 'Пароль',
    ],

];
