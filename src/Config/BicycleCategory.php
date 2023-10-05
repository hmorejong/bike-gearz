<?php

namespace App\Config;

enum BicycleCategory: string
{
    case Road = 'Road bikes';
    case Gravel = 'Gravel bikes';
    case Mountain = 'Mountain bikes';
    case eBikes = 'E-bikes';
    case Kids = 'Kids bikes';
}