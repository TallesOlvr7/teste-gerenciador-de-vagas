<?php

namespace App\Actions;

use App\Http\Resources\VacancyCollection;
use DB;
use Illuminate\Database\Query\Builder;

class GetVacanciesAction
{
    private Builder $query;
    public function __construct(
        private readonly string|null $param,
        private readonly string|null $status,
        private readonly string|null $type,
    ) {
        $this->query = DB::table('vacancies');
    }

    public function execute(): VacancyCollection
    {
        return $this->getVacancies();
    }

    private function getVacancies(): VacancyCollection
    {
        if ($this->param || $this->status || $this->type) {
            $this->query = $this->makeQuery($this->query);
            return new VacancyCollection(
                $this->query->paginate(20)->withQueryString()
            );
        }

        return new VacancyCollection($this->query->where('status', '=', 'Aberta')->paginate(20)->withQueryString());
    }

    private function makeQuery(Builder $query): Builder
    {
        if ($this->param && $this->status && $this->type) {
            $query = $this->withStatusFilter($query);
            $query = $this->withTypeFilter($query);
            $query = $this->withParamFilter($query);
            return $query;
        }

        if ($this->param && $this->status) {
            $query = $this->withStatusFilter($query);
            $query = $this->withParamFilter($query);
            return $query;
        }

        if ($this->param && $this->type) {
            $query = $this->withTypeFilter($query);
            $query = $this->withParamFilter($query);
            return $query;
        }

        if ($this->status && $this->type) {
            $query = $this->withStatusFilter($query);
            $query = $this->withTypeFilter($query);
            return $query;
        }

        if ($this->param) {
            $query = $this->withParamFilter($query);
            return $query;
        }

        if ($this->type) {
            $query = $this->withTypeFilter($query);
            return $query;
        }

        if ($this->status) {
            $query = $this->withStatusFilter($query);
            return $query;
        }

        return $query;
    }

    private function withParamFilter(Builder $query): Builder
    {
        return $query->whereAny([
            'title',
            'description'
        ], 'like', "%{$this->param}%");
    }

    private function withTypeFilter(Builder $query): Builder
    {
        return $query->where('type', '=', $this->type);
    }

    private function withStatusFilter(Builder $query): Builder
    {
        return $query->where('status', '=', $this->status);
    }
}