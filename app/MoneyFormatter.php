<?php

namespace App;

class MoneyFormatter
{
    /**
     * The current currency.
     * @var string
     */
    protected $currency;

    /**
     * The current locale.
     * @var string
     */
    protected $locale;

    public function __construct(string $currency = 'USD', string $locale = 'en_US')
    {
        $this->currency = $currency;
        $this->locale = $locale;
    }

    public static function formatAmount($amount)
    {
        return (new self)->format($amount);
    }

    /**
     * Format the amount according to currency and locale
     * @param $amount The amount in cents
     * @return string
     */
    public function format($amount)
    {
        $formatter = new \NumberFormatter($this->locale, \NumberFormatter::CURRENCY);

        return (string) $formatter->formatCurrency($amount / 100, $this->currency);
    }

    /**
     * Get the current locale.
     * @return string
     */
    public function getLocale(): string
    {
        return (string) $this->locale;
    }

    /**
     * Sets the current locale
     * @param string $locale
     */
    public function setLocale(string $locale): void
    {
        $this->locale = $locale;
    }

    /**
     * Gets the current currency
     * @return string
     */
    public function getCurrency(): string
    {
        return (string) $this->currency;
    }

    /**
     * Sets the current currency
     * @param string $currency
     */
    public function setCurrency(string $currency): void
    {
        $this->currency = $currency;
    }
}
