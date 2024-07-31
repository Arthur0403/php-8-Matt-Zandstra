<?php

// Listing 3.23
class AddressManager
{
    private $addresses = ["209.101.35.123", "209.101.35.124", "209.101.35.125"];
    public function outputAddresses()
    {
        foreach ($this->addresses as $address) {
            print $address;
            if ($resolve) {
                print " {" . gethostbyaddr($address) . "}";
            }
            print PHP_EOL;
        }
    }
}

// Usage
$settings = simplexml_load_file(__DIR__ . '/resolve.xml');
$manager = new AddressManager();
$manager->outputAddresses((string)$settings->resolvedomains);
