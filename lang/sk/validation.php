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

    'accepted' => 'Pole :attribute musí byť akceptované.',
    'accepted_if' => 'Pole :attribute must byť akceptované ak :other je :value.',
    'active_url' => 'Pole :attribute musí byť valídna URL.',
    'after' => 'Pole :attribute musí byť dátum po :date.',
    'after_or_equal' => 'Pole :attribute musí byť dátum rovnaký alebo po :date.',
    'alpha' => 'Pole :attribute musí obsahovať iba písmená.',
    'alpha_dash' => 'Pole :attribute musí obsahovať iba písmená, čísal, pomlčky, a podčiarkovníky.',
    'alpha_num' => 'Pole :attribute musí obsahovať iba písmená a čísla.',
    'array' => 'Pole :attribute muí byť pole.',
    'ascii' => 'Pole :attribute musí obsahovať iba jednobajtové alfanumerické znaky a symboly.',
    'before' => 'Pole :attribute musí byť dátum pred :date.',
    'before_or_equal' => 'Pole :attribute musí byť dátum rovnaky alebo pred :date.',
    'between' => [
        'array' => 'Pole :attribute musi mať medzi :min a :max poloziek.',
        'file' => 'Pole :attribute musí mať medzi :min a :max kilobytov.',
        'numeric' => 'Pole :attribute musí byť medzi :min a :max.',
        'string' => 'Pole :attribute musí mať medzi :min a :max znakov.',
    ],
    'boolean' => 'Pole :attribute musí byť áno alebo nie.',
    'confirmed' => 'Potvrdenie :attribute sa nezhoduje.',
    'current_password' => 'Nespravne heslo.',
    'date' => 'Pole :attribute musí byť valídny dátum.',
    'date_equals' => 'Dátum :attribute sa musí rovnať dátumu :date.',
    'date_format' => 'Pole :attribute musí byť vo formáte :format.',
    'decimal' => 'Pole :attribute musí mať :decimal desatinných miest.',
    'declined' => 'Pole :attribute musí byť desatinné.',
    'declined_if' => 'Pole :attribute musí byť desatinné pokial :other je :value.',
    'different' => 'Pole :attribute a :other musia byť odlišné.',
    'digits' => 'Pole :attribute musí mať :digits číslic.',
    'digits_between' => 'Pole :attribute musí mať medzi :min a :max číslic.',
    'dimensions' => 'Pole :attribute má nesprávne rozmery obrázka.',
    'distinct' => 'Pole :attribute má duplicitnú hodnotu.',
    'doesnt_end_with' => 'Pole :attribute nesmie končiť: :values.',
    'doesnt_start_with' => 'Pole :attribute nesmie začínať: :values.',
    'email' => 'Pole :attribute musí mať valídnu emailovú adresu.',
    'ends_with' => 'Pole :attribute musí končiť niektorou z nasledujúcich hodnôt: :values.',
    'enum' => 'Vybraná hodnota pre :attribute je neplatná.',
    'exists' => 'Vybraná hodnota pre :attribute je neplatná.',
    'file' => 'Pole :attribute musí byť súbor.',
    'filled' => 'Pole :attribute musí mať hodnotu.',
    'gt' => [
        'array' => 'Pole :attribute musí obsahovať viac ako :value položiek.',
        'file' => 'Pole :attribute musí byť väčšie ako :value kilobajtov.',
        'numeric' => 'Pole :attribute musí byť väčšie ako :value.',
        'string' => 'Pole :attribute musí byť dlhšie ako :value znakov.',
    ],
    'gte' => [
        'array' => 'Pole :attribute musí obsahovať :value alebo viac položiek.',
        'file' => 'Pole :attribute musí byť väčšie alebo rovné :value kilobajtov.',
        'numeric' => 'Pole :attribute musí byť väčšie alebo rovné :value.',
        'string' => 'Pole :attribute musí byť dlhšie alebo rovné :value znakov.',
    ],
    'image' => 'Pole :attribute musí byť obrázok.',
    'in' => 'Vybraná hodnota pre :attribute je neplatná.',
    'in_array' => 'Pole :attribute musí byť súčasťou :other.',
    'integer' => 'Pole :attribute musí byť celé číslo.',
    'ip' => 'Pole :attribute musí byť platnou IP adresou.',
    'ipv4' => 'Pole :attribute musí byť platnou IPv4 adresou.',
    'ipv6' => 'Pole :attribute musí byť platnou IPv6 adresou.',
    'json' => 'Pole :attribute musí byť platný JSON reťazec.',
    'lowercase' => 'Pole :attribute musí byť v malých písmenách.',
    'lt' => [
        'array' => 'Pole :attribute musí obsahovať menej ako :value položiek.',
        'file' => 'Pole :attribute musí byť menšie ako :value kilobajtov.',
        'numeric' => 'Pole :attribute musí byť menšie ako :value.',
        'string' => 'Pole :attribute musí byť kratšie ako :value znakov.',
    ],
    'lte' => [
        'array' => 'Pole :attribute nesmie obsahovať viac ako :value položiek.',
        'file' => 'Pole :attribute musí byť menšie alebo rovné :value kilobajtov.',
        'numeric' => 'Pole :attribute musí byť menšie alebo rovné :value.',
        'string' => 'Pole :attribute musí byť kratšie alebo rovné :value znakov.',
    ],
    'mac_address' => 'Pole :attribute musí obsahovať platnú MAC adresu.',
    'max' => [
        'array' => 'Pole :attribute nemôže obsahovať viac ako :max položiek.',
        'file' => 'Súbor :attribute nemôže mať viac ako :max kilobajtov.',
        'numeric' => 'Hodnota v poli :attribute nemôže byť väčšia ako :max.',
        'string' => 'Reťazec v poli :attribute nemôže mať viac ako :max znakov.',
    ],
    'max_digits' => 'Pole :attribute nemôže obsahovať viac ako :max číslic.',
    'mimes' => 'Súbor :attribute musí byť typu: :values.',
    'mimetypes' => 'Súbor :attribute musí byť typu: :values.',
    'min' => [
        'array' => 'Pole :attribute musí obsahovať aspoň :min položiek.',
        'file' => 'Súbor :attribute musí mať aspoň :min kilobajtov.',
        'numeric' => 'Hodnota v poli :attribute musí byť aspoň :min.',
        'string' => 'Reťazec v poli :attribute musí mať aspoň :min znakov.',
    ],
    'min_digits' => 'Pole :attribute musí obsahovať aspoň :min číslic.',
    'missing' => 'Pole :attribute musí chýbať.',
    'missing_if' => 'Pole :attribute musí chýbať, ak :other je :value.',
    'missing_unless' => 'Pole :attribute musí chýbať, ak :other nie je :value.',
    'missing_with' => 'Pole :attribute musí chýbať, ak je prítomné :values.',
    'missing_with_all' => 'Pole :attribute musí chýbať, ak sú prítomné všetky :values.',
    'multiple_of' => 'Hodnota v poli :attribute musí byť násobkom čísla :value.',
    'not_in' => 'Vybraná hodnota pre pole :attribute je neplatná.',
    'not_regex' => 'Formát poľa :attribute je neplatný.',
    'numeric' => 'Pole :attribute musí byť číslo.',
    'password' => [
        'letters' => 'Pole :attribute musí obsahovať aspoň jeden znak.',
        'mixed' => 'Pole :attribute musí obsahovať aspoň jeden veľký a jeden malý znak.',
        'numbers' => 'Pole :attribute musí obsahovať aspoň jedno číslo.',
        'symbols' => 'Pole :attribute musí obsahovať aspoň jeden symbol.',
        'uncompromised' => 'Zadané :attribute sa vyskytuje v uniknutých dátach. Zvoľte prosím iné :attribute.',
    ],
    'present' => 'Pole :attribute musí byť prítomné.',
    'prohibited' => 'Pole :attribute je zakázané.',
    'prohibited_if' => 'Pole :attribute je zakázané, keďže :other je :value.',
    'prohibited_unless' => 'Pole :attribute je zakázané, pokiaľ :other nie je v :values.',
    'prohibits' => 'Pole :attribute zakazuje, aby bolo pole :other prítomné.',
    'regex' => 'Formát poľa :attribute je neplatný.',
    'required' => 'Pole :attribute je povinné.',
    'required_array_keys' => 'Pole :attribute musí obsahovať položky pre: :values.',
    'required_if' => 'Pole :attribute je povinné, keďže :other je :value.',
    'required_if_accepted' => 'Pole :attribute je povinné, keďže :other je prijaté.',
    'required_unless' => 'Pole :attribute je povinné, pokiaľ :other nie je v :values.',
    'required_with' => 'Pole :attribute je povinné, keďže :values je vyplnené.',
    'required_with_all' => 'Pole :attribute je povinné, keďže :values sú vyplnené.',
    'required_without' => 'Pole :attribute je povinné, keďže :values nie je vyplnené.',
    'required_without_all' => 'Pole :attribute je povinné, keďže žiadne z :values nie je vyplnené.',
    'same' => 'Pole :attribute musí byť zhodné s :other.',
    'size' => [
        'array' => 'Pole :attribute musí obsahovať :size položiek.',
        'file' => 'Veľkosť súboru :attribute musí byť :size kilobajtov.',
        'numeric' => 'Hodnota poľa :attribute musí byť :size.',
        'string' => 'Dĺžka poľa :attribute musí byť :size znakov.',
    ],
    'starts_with' => 'Pole :attribute musí začínať jednou z nasledujúcich hodnôt: :values.',
    'string' => 'Pole :attribute musí byť reťazec.',
    'timezone' => 'Pole :attribute musí byť platná časová zóna.',
    'unique' => 'Hodnota poľa :attribute už existuje.',
    'uploaded' => 'Nahrávanie poľa :attribute zlyhalo.',
    'uppercase' => 'Pole :attribute musí byť veľkými písmenami.',
    'url' => 'Pole :attribute musí byť platnou URL adresou.',
    'ulid' => 'Pole :attribute musí byť platný ULID.',
    'uuid' => 'Pole :attribute musí byť platný ULID.',
    'deleted' => 'Návod úspešne odstránený',
    'errorParsing' => 'Pri analyzovaní došlo k chybe',
    'notAllowed' => 'Not allowed',
    'notAutorized' => 'Nemáte oprávnenie na prístup k tomuto zdroju',
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

    'attributes' => [],

];
