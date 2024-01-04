<?php

namespace App\Traits\Model;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;

trait ModelTrait
{
    /*======================================================================
    .* CUSTOM METHODS
    .*======================================================================*/

    /**
     * get valid attribute if exist, if not then return default value
     *
     * @return [ModelProperty] $rtn
     */
    public function getAttr(string $attribute, $default = '')
    {
        $rtn = $default;

        if ($this->isNotEmpty) {
            if (isset($this[$attribute])) {
                $rtn = $this->{$attribute};
            }
        }

        return $rtn;
    }

    /**
     * get valid relationship attribute if exist, if not then return default value
     *
     * @return [ModelProperty] $rtn
     */
    public function getRelAttr(string $relationshipMethodString, string $attribute, $default = '')
    {
        $rtn = $default;

        if (!empty($this->{$relationshipMethodString})) {
            if (isset($this->{$relationshipMethodString}[$attribute])) {
                $rtn = $this->{$relationshipMethodString}->{$attribute};
            }
        }

        return $rtn;
    }

    /**
     * carbon format a property date
     *
     * @param string $property
     * @param string $format
     * @return string $rtn
     */
    public function formatDate(string $property, string $format = 'Y年m月d日'): string
    {
        $rtn = '';

        try {
            if (!empty($this->getAttr($property))) {
                $carbonDate = Carbon::parse($this->{$property});

                if (!empty($carbonDate) && checkdate($carbonDate->month, $carbonDate->day, $carbonDate->year)) {
                    $rtn = $carbonDate->format($format);
                }
            }
        } catch (\Exception $e) {
            \RSPRL0g::error('Exception: ' . $e->getMessage());
        } catch (\Error $e) {
            \RSPRL0g::error($e->getMessage());
        }

        return $rtn;
    }

    /*======================================================================
    .* CUSTOM STATIC METHODS
    .*======================================================================*/

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($data) {
            # DAN (2023/08/16 11:50) - upon creating a record you can insert/update an attribute in here
            // $data->[ATTRIBUTE] = [VALUE];
            return $data;
        });

        static::updating(function ($data) {
            # DAN (2023/08/16 11:48) - upon updating a record you can insert/update an attribute in here
            // $data->[ATTRIBUTE] = [VALUE];
            return $data;
        });
    }

    /**
     * inserting bulk records
     *
     * @param array $attributesArray
     * @return bool $rtn
     */
    public static function inserting(array $attributesArray)
    {
        $rtn = false;
        $insertAttributesArray = [];

        foreach ($attributesArray as $arr) {
            # DAN (2023/08/16 11:50) - upon inserting a record you can insert/update an attribute in here
            // $data->[ATTRIBUTE] = [VALUE];
            $insertAttributesArray[] = $arr;
        }

        if (!empty($insertAttributesArray)) {
            $rtn = self::insert($insertAttributesArray);
        }

        return $rtn;
    }

    /**
     * empty table column values
     */
    public static function empty()
    {
        return new static();
    }

    /*======================================================================
    .* ACCESSORS
    .*======================================================================*/

    /**
     * id (int)
     *
     * @return Attribute
     */
    public function getIdAttribute($value): int
    {
        $rtn = 0;

        if ($this->primaryKey == 'id') {
            if (!is_null($value)) {
                $rtn = $value;
            } else {
                $rtn = $this[$this->primaryKey];
            }
        } else {
            if (isset($this[$this->primaryKey])) {
                $rtn = $this[$this->primaryKey];
            }
        }

        return $rtn;
    }

    /**
     * isEmpty (bool)
     *
     * @return Attribute
     */
    public function isEmpty(): Attribute
    {
        return Attribute::make(
            get: fn($value) => empty($this->id)
        );
    }

    /**
     * isNotEmpty (bool)
     *
     * @return Attribute
     */
    public function isNotEmpty(): Attribute
    {
        return Attribute::make(
            get: fn($value) => !$this->isEmpty
        );
    }

    /*======================================================================
    .* SCOPES
    .*======================================================================*/

    /**
     * whereDeleted
     */
    public function scopeWhereDeleted(Builder $query)
    {
        $query->whereNotNull('deleted_at');
    }

    /**
     * whereNotDeleted
     */
    public function scopeWhereNotDeleted(Builder $query)
    {
        $query->whereNull('deleted_at');
    }

    /**
     * sortAsc
     */
    public function scopeSortAsc(Builder $query)
    {
        $query->orderBy(self::CREATED_AT, 'asc');
    }

    /**
     * sortDesc
     */
    public function scopeSortDesc(Builder $query)
    {
        $query->orderBy('created_at', 'desc');
    }
}
