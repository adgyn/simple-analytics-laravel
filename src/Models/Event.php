<?php

namespace Adgyn\SimpleAnalytics\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Event extends Model
{
    use HasUuids, HasFactory;

    protected $table = 'simple_analytic_events';

    protected $guarded = ['id'];
}
