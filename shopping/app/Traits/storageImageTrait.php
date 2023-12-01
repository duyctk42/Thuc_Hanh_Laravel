<?php
namespace App\Traits;

use http\Env\Request;
use Storage;
trait StorageImageTrait{
    public  function StorageTraitUpload($request, $fieldName, $foderName){
        if ( $request-> hasFile($fieldName)){
            $flile =$request->$fieldName;
            $fileNameOrigin = $flile->getClientOriginalName();
            $fileNameHard = str_random('20') . '.' . $flile->getClientOriginalExtension();
            $filepath = $request->file($fieldName)->storeAs('public/'.$foderName.'/'. auth()->id(),$fileNameHard);
            $dataUploadTrait = [
                'file_name' =>$fileNameOrigin,
                'file_path' =>Storage::url($filepath)
            ];
            return $dataUploadTrait;
        }
        return null;

    }
    public  function StorageTraitUploadMutiple($file, $foderName)
    {
            $fileNameOrigin = $file->getClientOriginalName();
            $fileNameHard = str_random('20') . '.' . $file->getClientOriginalExtension();
            $filepath = $file->storeAs('public/'.$foderName.'/'. auth()->id(),$fileNameHard);
            $dataUploadTrait = [
                'file_name' =>$fileNameOrigin,
                'file_path' =>Storage::url($filepath)
            ];
            return $dataUploadTrait;
    }

}
