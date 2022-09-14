<?php
namespace Modules\Creator\Http\Controllers\Api\V1;

use App\Models\Creator;
use Infrastructure\BaseController;
use Modules\Creator\Http\Requests\CreatorRequest;

class CreatorController extends BaseController
{
    public function create(CreatorRequest $request)
    {
        try{
            $creator = Creator::create($request->only([
                'name',
                'email',
                'phone_number',
                'username',
                'password'
            ]));
        }catch (\Exception $e){
            return $this->apiResponseError($e);
        }
    }
}
