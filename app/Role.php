<?php

namespace App;

enum Role: string
{
    case Writer = 'writer';
    case Admin = 'admin';
}
