<?php namespace App\Traits;
use Illuminate\Database\Eloquent\Builder;
/**
 * Allows for the usage of composite keys when retrieving models as well as
 * performing updates and deletes to prevent mass overwrites. Modified from
 * a Stack Overflow answer.
 *
 * @see https://stackoverflow.com/a/36995763
 */
trait HasCompositePrimaryKey
{
	/**
     * Get the value indicating whether the IDs are incrementing.
     *
     * @return bool
     */
    public function getIncrementing() {
        return false;
    }
    /**
     * Updates the given Builder query to set the composite key constraints.
     *
     * @param aray $values Optional associative array to override PK column values
     * @return Builder
     */
    public function buildCompositeKeyConstraint(Builder $query, $values=[]) {
        foreach ($this->getKeyName() as $key) {
            // UPDATE: Added isset() per devflow's comment.
            if(array_key_exists($key, $values)) {
                // allow for the value override first
                $query->where($key, '=', $values[$key]);
            }
            elseif (isset($this->$key)) {
                // pull the existing model attribute value
                $query->where($key, '=', $this->$key);
            }
            else
            {
                throw new \BadMethodCallException(__METHOD__ . 'Missing part of the primary key: ' . $key);
            }
        }
        return $query;
    }
    /**
     * Set the keys for a save update query.
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected function setKeysForSaveQuery(Builder $query) {
        return $this->buildCompositeKeyConstraint($query);
    }
    // UPDATE: From jessedp. See his edit, below.
    /**
     * Execute a query for a single record by ID.
     *
     * @param  array  $ids Array of keys, like [column => value].
     * @param  array  $columns
     * @return mixed|static
     */
    public static function find($ids, $columns = ['*'])
    {
        $me = new self;
        $query = $me->buildCompositeKeyConstraint($me->newQuery(), $ids);
        return $query->first($columns);
    }
    // UPDATE: From jessedp. See his edit, below.
    /**
     * Execute a query for a single record by ID.
     *
     * @param  array  $ids Array of keys, like [column => value].
     * @param  array  $columns
     * @return mixed|static
     *
     * @throws ModelNotFoundException
     */
    public static function findOrFail($ids, $columns = ['*'])
    {
        $me = new self;
        $query = $me->buildCompositeKeyConstraint($me->newQuery(), $ids);
        return $query->firstOrFail($columns);
    }
}