<?php
namespace App\Ship\Repositories;

use Jenssegers\Mongodb\Eloquent\Model;

abstract class AbstractRepository
{
    /**
     * @var Model
     */
    protected $entity = '';

    /**
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected function newQuery()
    {
        return $this->newEntity()
            ->newQuery();
    }

    /**
     * @param array $attributes
     * @return mixed
     * @throws \Exception
     */
    public function newEntity($attributes = [])
    {
        if (empty($this->entity)) {
            throw new \Exception('Add $entity model::class on your '.get_class($this).' repository!');
        }
        return new $this->entity($attributes);
    }

    /**
     * @param null $query
     * @param int $take
     * @param bool $paginate
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator|\Illuminate\Database\Eloquent\Collection|static[]
     */
    protected function doQuery($query = null, $take = 15, $paginate = true)
    {
        $query = $query ?? $this->newQuery();

        if (true === $paginate) {
            return $query->paginate($take);
        }

        if ($take > 0 || $take !== false) {
            $query->take($take);
        }

        return $query->get();
    }

    /**
     * @param $id
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|null|static|static[]
     */
    public function getById($id)
    {
        return $this->newQuery()
            ->find($id);
    }

    /**
     * @param int $take
     * @param bool $paginate
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator|\Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getAll($take = 15, $paginate = true)
    {
        return $this
            ->doQuery(null, $take, $paginate);
    }

    /**
     * @param int $take
     * @param bool $paginate
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator|\Illuminate\Database\Eloquent\Collection|static[]
     */
    public function thisMonth($take = 15, $paginate = true)
    {
        $firstDay = new \DateTime('first day of this month');
        $lastDay = new \DateTime('last day of this month');

        $query = $this->newQuery()
            ->where('created_at', '>', $firstDay)
            ->where('created_at', '<' , $lastDay);

        return $this->doQuery($query, $take, $paginate);
    }

    /**
     * @param string $monthName
     * @param int $take
     * @param bool $paginate
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator|\Illuminate\Database\Eloquent\Collection|static[]
     */
    public function fromMonth(string $monthName, $take = 15, $paginate = true)
    {
        $firstDay = new \DateTime('first day of '.$monthName);
        $lastDay = new \DateTime('last day of '.$monthName);
        $query = $this->newQuery()
            ->where('created_at', '>', $firstDay)
            ->where('created_at', '<', $lastDay);

        return $this->doQuery($query, $take, $paginate);
    }

    /**
     * @param $attributes
     * @return bool
     */
    public function save($attributes)
    {
        return $this->newEntity($attributes)
            ->save();
    }

    /**
     * @param $id
     * @return bool|null
     * @throws \Exception
     */
    public function deleteById($id)
    {
        $entity = $this->getById($id);

        if (null === $entity) {
            throw new \Exception('Not found ' . $id . ' id for ' . get_class($entity) . ' entity');
        }

        return $entity->delete();
    }
}
