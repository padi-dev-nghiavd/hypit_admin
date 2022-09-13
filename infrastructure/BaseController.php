<?php
namespace Infrastructure;

use App\Http\Controllers\Controller;
use Illuminate\Http\Response;

class BaseController extends Controller
{
    public function apiResponseSuccess($data = [])
    {
        return response()->json(
            [
                "data" => $data,
                "status" => Response::HTTP_OK
            ],
            Response::HTTP_OK
        );
    }

    public function apiResponseError(\Exception $e)
    {
        $code = 500;
        if ($e->getCode()) {
            $code = $e->getCode();
        }
        if (request()->is('api/*')) {
            return response()->json([
                "error" => [
                    "message" => $e->getMessage(),
                ],
                "status" => $code
            ], $code);
        } else {
            return response()->json([
                "data" => [
                    "message" => $e->getMessage(),
                ],
                "status" => $code
            ], $code);
        }
    }

    public function apiResponseErrorWithArray($data = [], $code = 500)
    {
        if (request()->is('api/*')) {
            $message = $this->getFirstMessage($data);
            return response()->json([
                "error" => [
                    "message" => $message,
                ],
                "status" => $code
            ], $code);

        } else {
            return response()->json([
                "data" => $data,
                "status" => $code
            ], $code);
        }
    }

    private function getFirstMessage($errors)
    {
        if (is_array($errors)) {
            $errors = array_values($errors);
            if (isset($errors[0]) && is_array($errors[0])) {
                return $this->getFirstMessage($errors[0]);
            } else {
                return $errors[0];
            }
        } else {
            return $errors;
        }
    }
}
