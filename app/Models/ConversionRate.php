<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ConversionRate extends Model
{
    public static function forCountryCode(string $countryCode): ?self
    {
        return static::query()->firstWhere(['country_code' => $countryCode]);
    }

    public static function forCurrencyCode(string $currencyCode): ?self
    {
        return static::query()->firstWhere(['currency_code' => $currencyCode]);
    }

    public function getAmountForUsd(int $amountInCents): int
    {
        return (int) ($amountInCents * $this->exchange_rate * $this->ppp_conversion_factor);
    }

    public function getPPPInUsd(int $amountInCents): int
    {
        return (int) ($amountInCents * $this->ppp_conversion_factor);

    }
}
