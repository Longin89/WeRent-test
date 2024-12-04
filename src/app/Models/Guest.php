<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guest extends Model
{
    use HasFactory;
    protected $guarded = false;

    //  Метод для определения страны по номеру телефона

    public static function getCountryFromPhone($phone)
    {

    //  Список стран и соответствующих кодов

        $countries = [
            '+7' => 'Russia',
            '+375' => 'Belarus',
            '+380' => 'Ukraine',
            '+995' => 'Georgia',
            '+998' => 'Uzbekistan',
            '+996' => 'Kyrgyzstan',
            '+994' => 'Azerbaijan',
            '+374' => 'Armenia',
            '+359' => 'Bulgaria',
            '+385' => 'Croatia',
            '+386' => 'Slovenia',
            '+387' => 'Bosnia and Herzegovina',
            '+420' => 'Czech Republic',
            '+421' => 'Slovakia',
            '+370' => 'Lithuania',
            '+372' => 'Estonia',
            '+373' => 'Moldova',
            '+48' => 'Poland',
            '+49' => 'Germany',
            '+45' => 'Denmark',
            '+46' => 'Sweden',
            '+44' => 'United Kingdom',
            '+33' => 'France',
            '+32' => 'Belgium',
            '+31' => 'Netherlands',
            '+30' => 'Greece',
        ];

        foreach ($countries as $code => $country) {
            if (strpos($phone, $code) === 0) {
                return $country;
            }
        }

    //  Если страны нет в списке - выводим соответствующее сообщение

        return 'Country not added or doesn\'t exist';
    }

    //  Метод для установки значения страны при создании нового гостя

    protected static function boot()
    {
        parent::boot();

    //  Если страна не указана - указываем ее, исходя из номера телефона

        self::creating(function ($model) {
            if (!$model->country && $model->phone) {
                $model->country = self::getCountryFromPhone($model->phone);
            }
        });
    }
}
