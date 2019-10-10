<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
/**
* @property  int creator_id
*/

class Organization extends Model
{
    use SoftDeletes;
    
     /******* Properties *******/

    protected $hidden = [
        'api_token', 'deleted_at', 'pivot'
    ];
    protected $fillable = [ 
        'title', 
        'country',
        'city',
        'creator_id'
    ];
    
    public static function boot()
    {
        parent::boot();

        static::creating(function($table)//self $model)
        {
            $table->creator_id = auth()->user()->id;
//             if(\Auth::id()){
//                 $model->user_id = \Auth::id();
//             }
//         });
    }
    
     /******* Relations *******/

    public function creator()
    {
    	return $this->belongsTo(User::class, 'creator_id');
    }

    public function vacancies()
    {
    	return $this->hasMany('App\Vacancy');
    }
    public function workers()
    {
        return $this->hasManyThrough('App\User' ,'App\Vacancy');
    }

    /******* CRUD Functions *******/

    public static function add($fields)
    {
        $organization = new static;
        $organization->fill($fields);
        //$organization->creator_id = \Auth::user()->id;
        $organization->save();

        return $organization;
    }

     /******* Static Functions *******/

    public static function getOrganizationList(Request $request)
    {
        $organizations = \App\Http\Resources\UserCollection::make(User::all());
        $all = $organizations->count();
        $active = $organizations->where('deleted_at', '=', null)->all()->count();
        $softDelete = $all - $active;
        return $organization = collect(['active' =>  $active, 'softDelete' => $softDelete, 'all' => $all]);
    }
}
