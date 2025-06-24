<?php

namespace App\Traits;

use App\Classes\dlSign;
use App\Classes\dlURL;
use Illuminate\Support\Pluralizer;

trait WithExtensions
{

    public function getTokenAttribute() {
        return dlSign::sign($this->id);
    }
    public function getDlSignAttribute() {
        return dlSign::sign($this->attributes['id']);
    }
    public function getDlRouteAttribute() {
        //return dlURL::signedRoute(Pluralizer::plural(strtolower(class_basename(get_class($this)))).'/{id}',['id' => $this->attributes['id']]);
        return dlURL::signedRoute(Pluralizer::plural(strtolower(class_basename(get_class($this)))).'.'.strtolower(class_basename(get_class($this))).'Get',['id' => $this->attributes['id']]);
    }

    public static function getModelData($oQuery, $iModel_id, $iRecordsInPage = 0, $aWithDerived = [], $keyBy = 'id') {

        if (!empty($aWithDerived)) {
            $oQuery->with($aWithDerived);
        }
        if ($iModel_id == 0) {
            $iRecordsInPage = ($iRecordsInPage == 0 ) ? config('constants.pagination.DEFAULT_PAGE_RECORDS') : $iRecordsInPage;
            if ($iRecordsInPage>0) {
                $oRecords = $oQuery->paginate($iRecordsInPage);
                $oRecordsC = $oRecords->getCollection()->keyBy($keyBy);
                $oRecords->setCollection($oRecordsC);
            } else {
                $oRecords = $oQuery->get()->keyBy($keyBy);
            }
        } else {
            $oRecords = $oQuery->get()->first();
        }
        return $oRecords;
    }

}
