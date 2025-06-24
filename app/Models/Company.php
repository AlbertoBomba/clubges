<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Traits\WithExtensions;
use Illuminate\Database\Eloquent\SoftDeletes;

class Company extends Model
{
    use HasFactory;
    use WithExtensions;
    use SoftDeletes;


    protected $attributes = [
        'created_user' => null,
        'updated_user' => null,
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get records
     *
     * @param int $model_id
     * @param int $records_in_page
     * @param array $sort (attribute => 'asc'/'desc')
     * @param array $filters
     * @return mixed Colletion
     *
     */
    public static function dlGet(
        int $model_id = 0,
        int $records_in_page = 0,
        array $sort = [],
        ?array $filters = [],
        ?array $with = []
    ) {

        $oQuery = Company::
        when($model_id>0, function($query)  use ($model_id) {
            return $query->where('id', $model_id);
        });

        $oQuery = static::dlApplyFilters($oQuery, $filters);
        // Order by
        foreach ($sort as $key => $value) {
            $oQuery->orderBy($key, $value);
        }

        $model_id = ($model_id > 0) ? $model_id : ((isset($filters['code']) && !empty($filters['code'])) ? 1:0);
        return Company::getModelData($oQuery, $model_id, $records_in_page, $with);
    }
    /**
     * Get summary.
     *
     * @param array $filters
     * @return mixed Colletion
     *
     */
    public static function dlGetSummary(
        ?array $filters = []
    ) {
        $query = static::selectRaw('
            count(companies.id) as companies,
            sum(companies.active) as companies_active
        ');
        $query = static::dlApplyFilters($query, $filters);

        return $query->get()->first();
    }
    /**
     * Apply filters.
     *
     * @param $query
     * @param array $filters
     * @return mixed Query
     *
     */
    public static function dlApplyFilters(
        $query,
        ?array $filters = []
    ) {

        $query->when(isset($filters['code']) && !empty($filters['code']), function ($query) use ($filters) {
            return $query->where('code', '=', $filters['code']);
        });

        return $query;
    }

    
    // public function permission()
    // {
    //     return $this->hasOne(Permission::class, 'model_id', 'id')
    //     ->where('model', 'App\\Models\\Company');
    // }
    /**
     * Users
     */
    // public function users()
    // {
    //     $relation = $this->hasManyThrough(ModelHasPermission::class, Permission::class, 'model_id', 'permission_id', 'id', 'id')
    //     ->where('permissions.model', 'App\\Models\\Company')->with('user');
    //     return($relation);
    // }
    /**
     * Roles
     */
    // public function roles()
    // {
    //     return $this->hasManyThrough(Role::class, RoleHasPermission::class, 'permission_id', 'id', 'id', 'role_id');
    // }

    // public function accountsbanks(){
    //     return $this->hasMany(BanksAccount::class, 'company_id', 'id');
    // }

    // public function retention_types(){
    //     return $this->hasMany(RetentionType::class, 'company_id', 'id');
    // }


   
}
