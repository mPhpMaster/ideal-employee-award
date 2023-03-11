<?php

namespace App\Models;

use App\Traits\TModelTranslation;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @mixin Builder
 */
abstract class Model extends \Illuminate\Database\Eloquent\Model
{
    use HasFactory;
    use TModelTranslation;

    /**
     * @param array|string|null $attributes
     *
     * @return bool
     */
    public function isChanged($attributes = null): bool
    {
        return $this->isInstanceNew() || $this->wasChanged($attributes) || $this->isDirty($attributes);
    }

    /**
     * @return bool
     */
    public function isInstanceNew(): bool
    {
        return $this->wasRecentlyCreated;
    }
}
