<?php


namespace App\Http\Controllers;


class ApiController extends Controller
{
    public function apiResponse($data, $message = null, $code = 200, $resultType = ResultType::Success)
    {
        $response = [];
        $response['success'] = $resultType == ResultType::Success;

        if (isset($data)) {
            if ($resultType != ResultType::Error) {
                $response['data'] = $data;
            }

            if ($resultType == ResultType::Error) {
                $response['errors'] = $data;
            }
        }

        if (isset($message)) {
            $response['message'] = $message;
        }

        return response()->json($response, $code);
    }
}

class ResultType
{
    const Success = 1;
    const Error = 2;
}
