<?php

namespace App\Repositories;

use App\Models\Model;
use App\Responses\Repository\RepositoryResponseCollection;
use App\Responses\Repository\RepositoryResponseItem;
use App\Responses\Repository\RepositoryResponsePagination;
use Illuminate\Database\Eloquent\Builder;

class Repository
{
    /*======================================================================
    .* PROPERTIES
    .*======================================================================*/

    /**
     * @var Model
     */
    public $model;

    /*======================================================================
    .* METHODS
    .*======================================================================*/

    protected function responseItem(): RepositoryResponseItem
    {
        return new RepositoryResponseItem(resolve($this->model));
    }

    protected function responseCollection(): RepositoryResponseCollection
    {
        return new RepositoryResponseCollection();
    }

    protected function responsePagination(): RepositoryResponsePagination
    {
        return new RepositoryResponsePagination();
    }

    /**
     * acquire all model records
     * call NTC (No Try Catch) method
     *
     * @param array $attributes
     * @param array $exceptAttributes
     * @param array $orderAttributes
     * @param bool $withTrashed
     *
     * @return RepositoryResponseCollection
     */
    public function acquireAll(array $attributes = [], array $exceptAttributes = [], array $orderByAttributes = [], array $withRelationship = [], bool $withTrashed = false): RepositoryResponseCollection
    {
        $rtn = $this->responseCollection();

        try {
            $rtn = $this->NTCacquireAll($attributes, $exceptAttributes, $orderByAttributes, $withRelationship, $withTrashed);
        } catch (\Exception $e) {
            \RSPRLog::error('Exception: ' . $e->getMessage());
        } catch (\Error $e) {
            \RSPRLog::error($e->getMessage());
        }

        return $rtn;
    }

    /**
     * acquire all model records
     * NTC (No Try Catch) method
     *
     * @param array $attributes
     * @param array $exceptAttributes
     * @param array $orderByAttributes
     * @param bool $withTrashed
     *
     * @return RepositoryResponseCollection
     */
    public function NTCacquireAll(array $attributes = [], array $exceptAttributes = [], array $orderByAttributes = [], array $withRelationship = [], bool $withTrashed = false): RepositoryResponseCollection
    {
        $rtn = $this->responseCollection();

        if (!empty($this->model)) {
            $query = $this->model::query();
            $query = $this->conditionalQueries($query, $attributes, $exceptAttributes, $orderByAttributes, $withRelationship, $withTrashed);
            $rtn->data = $query->get();
            $rtn->success = true;
            $rtn->hasData = $rtn->data->count() > 0;
        }

        return $rtn;
    }

    public function acquireAllReturnPagination(array $attributes = [], array $exceptAttributes = [], array $orderByAttributes = [], array $withRelationship = [], bool $withTrashed = false): RepositoryResponsePagination
    {
        $rtn = $this->responsePagination();
        // dd($this->model);
        try {
            $rtn = $this->NTCacquireAllReturnPagination($attributes, $exceptAttributes, $orderByAttributes, $withRelationship, $withTrashed);
        } catch (\Exception $e) {
            \RSPRLog::error('Exception: ' . $e->getMessage());
        } catch (\Error $e) {
            \RSPRLog::error($e->getMessage());
        }

        return $rtn;
    }

    public function NTCacquireAllReturnPagination(array $attributes = [], array $exceptAttributes = [], array $orderByAttributes = [], array $withRelationship = [], bool $withTrashed = false): RepositoryResponsePagination
    {
        $rtn = $this->responsePagination();

        if (!empty($this->model)) {
            $query = $this->model::query();
            $query = $this->conditionalQueries($query, $attributes, $exceptAttributes, $orderByAttributes, $withRelationship, $withTrashed);
            $rtn->data = $query->paginate(5);
            $rtn->success = true;
            $rtn->hasData = $rtn->data->count() > 0;
        }

        return $rtn;
    }

    /**
     * acquire a model record
     * call NTC (No Try Catch) method
     *
     * @param int $id
     * @param array $attributes
     * @param array $exceptAttributes
     * @param array $orderByAttributes
     * @param bool $withTrashed
     *
     * @return RepositoryResponseItem
     */
    public function acquire(int $id, array $attributes = [], array $exceptAttributes = [], array $orderByAttributes = [], array $withRelationship = [], bool $withTrashed = false): RepositoryResponseItem
    {
        $rtn = $this->responseItem();

        try {
            $rtn = $this->NTCacquire($id, $attributes, $exceptAttributes, $orderByAttributes, $withRelationship, $withTrashed);
        } catch (\Exception $e) {
            \RSPRLog::error('Exception: ' . $e->getMessage());
        } catch (\Error $e) {
            \RSPRLog::error($e->getMessage());
        }

        if (empty($rtn)) {
            $rtn = $this->model::empty();
        }

        return $rtn;
    }

    /**
     * acquire a model record
     * NTC (No Try Catch) method
     *
     * @param int $id
     * @param array $attributes
     * @param array $exceptAttributes
     * @param array $orderByAttributes
     * @param bool $withTrashed
     *
     * @return RepositoryResponseItem
     */
    public function NTCacquire(int $id, array $attributes = [], array $exceptAttributes = [], array $orderByAttributes = [], array $withRelationship = [], bool $withTrashed = false): RepositoryResponseItem
    {
        $rtn = $this->responseItem();

        if (!empty($this->model)) {
            $query = $this->model::where(resolve($this->model)->getKeyName(), $id);
            $query = $this->conditionalQueries($query, $attributes, $exceptAttributes, $orderByAttributes, $withRelationship, $withTrashed);
            $data = $query->first();
            $rtn->success = true;

            if (empty($data)) {
                $rtn->data = $this->model::empty();
            } else {
                $rtn->hasData = true;
                $rtn->data = $data;
            }
        }

        return $rtn;
    }
    public function acquireByAttributes(array $attributes = [], array $exceptAttributes = [], array $orderByAttributes = [], array $withRelationship = [], bool $withTrashed = false): RepositoryResponseItem
    {
        $rtn = $this->responseItem();

        try {
            $rtn = $this->NTCacquireByAttributes($attributes, $exceptAttributes, $orderByAttributes, $withRelationship, $withTrashed);
        } catch (\Exception $e) {
            \RSPRLog::error('Exception: ' . $e->getMessage());
        } catch (\Error $e) {
            \RSPRLog::error($e->getMessage());
        }

        if (empty($rtn)) {
            $rtn = $this->model::empty();
        }

        return $rtn;
    }

    public function NTCacquireByAttributes(array $attributes = [], array $exceptAttributes = [], array $orderByAttributes = [], array $withRelationship = [], bool $withTrashed = false): RepositoryResponseItem
    {
        $rtn = $this->responseItem();

        if (!empty($this->model)) {
            $query = $this->model::query();
            $query = $this->conditionalQueries($query, $attributes, $exceptAttributes, $orderByAttributes, $withRelationship, $withTrashed);
            $data = $query->first();
            $rtn->success = true;

            if (empty($data)) {
                $rtn->data = $this->model::empty();
            } else {
                $rtn->hasData = true;
                $rtn->data = $data;
            }
        }

        return $rtn;
    }

    /**
     * add a model record
     * call NTC (No Try Catch) method
     *
     * @param array $attributes
     * @return RepositoryResponseItem
     */
    public function add(array $attributes): RepositoryResponseItem
    {
        $rtn = $this->responseItem();

        try {
            $rtn = $this->NTCadd($attributes);
        } catch (\Exception $e) {
            \RSPRLog::error('Exception: ' . $e->getMessage());
        } catch (\Error $e) {
            \RSPRLog::error($e->getMessage());
        }

        return $rtn;
    }

    /**
     * add a model record
     * NTC (No Try Catch) method
     *
     * @param array $attributes
     * @return RepositoryResponseItem
     */
    public function NTCadd(array $attributes): RepositoryResponseItem
    {
        $rtn = $this->responseItem();

        if (!empty($this->model) && count($attributes) != 0) {
            $data = $this->model::create($attributes);

            if ($data) {
                $rtn->success = true;

                if (!empty($data)) {
                    $rtn->hasData = true;
                    $rtn->data = $data->fresh();
                }
            }
        }

        \RSPRLog::responseCheck()->warning($rtn);

        return $rtn;
    }

    /**
     * adjust a model record
     * call NTC (No Try Catch) method
     *
     * @param int $id
     * @param array $attributes
     * @return RepositoryResponseItem
     */
    public function adjust(int $id, array $attributes): RepositoryResponseItem
    {
        $rtn = $this->responseItem();

        try {
            $acquiredData = null;

            if (!empty($this->model)) {
                $acquireResponse = $this->NTCacquire($id);

                if ($acquireResponse->success && $acquireResponse->hasData) {
                    $rtn->hasData = true;
                    $rtn->data = $acquireResponse->data;
                    $acquiredData = $rtn->data;
                }
            }

            $rtn = $this->NTCadjust($id, $attributes, $acquiredData);
        } catch (\Exception $e) {
            \RSPRLog::error('Exception: ' . $e->getMessage());
        } catch (\Error $e) {
            \RSPRLog::error($e->getMessage());
        }

        return $rtn;
    }

    /**
     * adjust a model record
     * NTC (No Try Catch) method
     *
     * @param int $id
     * @param array $attributes
     * @return RepositoryResponseItem
     */
    public function NTCadjust(int $id, array $attributes, null|Model $acquiredData = null): RepositoryResponseItem
    {
        $rtn = $this->responseItem();
        $hasAcquiredData = !empty($acquiredData);

        if (!empty($this->model) && count($attributes) != 0) {
            if (!$hasAcquiredData) {
                $acquireResponse = $this->NTCacquire($id);

                if ($acquireResponse->success && $acquireResponse->hasData) {
                    $hasAcquiredData = true;
                    $acquiredData = $acquireResponse->data;
                }
            }

            if ($hasAcquiredData) {
                $rtn->hasData = true;
                $rtn->data = $acquiredData;
                $success = $acquiredData->update($attributes);

                if ($success) {
                    $rtn->success = true;
                    $rtn->data = $acquireResponse->data->fresh();
                }
            }
        }

        \RSPRLog::responseCheck()->warning($rtn);

        return $rtn;
    }

    /**
     * annul a model record
     * call NTC (No Try Catch) method
     *
     * @param int $id
     * @return RepositoryResponseItem
     */
    public function annul(int $id, null|bool $hardDelete = null): RepositoryResponseItem
    {
        $rtn = $this->responseItem();

        try {
            $acquiredData = null;

            if (!empty($this->model)) {
                $acquireResponse = $this->NTCacquire($id);

                if ($acquireResponse->success && $acquireResponse->hasData) {
                    $rtn->hasData = true;
                    $rtn->data = $acquireResponse->data;
                    $acquiredData = $rtn->data;
                }
            }

            $rtn = $this->NTCannul($id, $hardDelete, $acquiredData);
        } catch (\Exception $e) {
            \RSPRLog::error('Exception: ' . $e->getMessage());
        } catch (\Error $e) {
            \RSPRLog::error($e->getMessage());
        }

        return $rtn;
    }

    /**
     * annul a model record
     * NTC (No Try Catch) method
     *
     * @param int $id
     * @return RepositoryResponseItem
     */
    public function NTCannul(int $id, null|bool $hardDelete = null, null|Model $acquiredData = null): RepositoryResponseItem
    {
        $rtn = $this->responseItem();
        $hasAcquiredData = !empty($acquiredData);

        if (!empty($this->model)) {
            if (!$hasAcquiredData) {
                $acquireResponse = $this->NTCacquire($id);

                if ($acquireResponse->success && $acquireResponse->hasData) {
                    $hasAcquiredData = true;
                    $acquiredData = $acquireResponse->data;
                }
            }

            if ($hasAcquiredData) {
                $rtn->hasData = true;
                $rtn->data = $acquiredData;
                $success = $acquiredData->delete();

                if ($success) {
                    $rtn->success = true;
                }
            }
        }

        \RSPRLog::responseCheck()->warning($rtn);

        return $rtn;
    }

    /*======================================================================
    .* PRIVATE METHODS
    .*======================================================================*/

    private function conditionalQueries(Builder $query, array $attributes = [], array $exceptAttributes = [], array $orderByAttributes = [], array $withRelationship = [], bool $withTrashed = false): Builder
    {
        $query = $query->where(function ($query) use ($attributes) {
            foreach ($attributes as $key => $value) {
                if (is_array($value)) {
                    if (is_numeric($key)) {
                        $query->where(function ($query) use ($value) {
                            foreach ($value as $key2 => $value2) {
                                $query->where($key2, $value2);
                            }

                            return $query;
                        });
                    } else {
                        $query->whereIn($key, $value);
                    }
                } else {
                    $query->where($key, $value);
                }
            }

            return $query;
        });

        foreach ($exceptAttributes as $key => $value) {
            $query = $query->where($key, '!=', $value);
        }

        foreach ($orderByAttributes as $key => $value) {
            $query = $query->orderBy($key, $value);
        }

        if ($withTrashed) {
            $query = $query->withTrashed();
        }

        if (count($withRelationship) > 0) {
            $query = $query->with($withRelationship);
        }

        return $query;
    }
}
