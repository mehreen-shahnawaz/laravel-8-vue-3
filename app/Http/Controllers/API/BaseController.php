<?php

namespace App\Http\Controllers\API;

use Response;
use Illuminate\Pagination\LengthAwarePaginator as Paginator;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use \Illuminate\Http\Response as Res;

class BaseController extends Controller
{
    public function __construct()
    {
    }
    /**
     * @var int
     */

    protected $statusCode = Res::HTTP_OK;
    /**
     * @return mixed
     */
    public function getStatusCode() {
        return $this->statusCode;
    }

    /**
     * @param $message
     * @return json response
     */
    public function setStatusCode($statusCode) {
        $this->statusCode = $statusCode;
        return $this;
    }

    public function respondCreated($message, $data=null){
        return $this->respond([
            'status' => 'success',
            'status_code' => Res::HTTP_CREATED,
            'message' => $message,
            'data' => $data
        ]);
    }

    /**
     * @param Paginator $paginate
     * @param $data
     * @return mixed
     */
    protected function respondWithPagination(Paginator $paginate, $data, $message){
        // $d = array_merge($data, [
        //     'paginator' => [
        //         'total_count'  => $paginate->total(),
        //         'total_pages' => ceil($paginate->total() / $paginate->perPage()),
        //         'current_page' => $paginate->currentPage(),
        //         'limit' => $paginate->perPage(),
        //     ]
        // ]);
        return $this->respond([
            'status' => 'success',
            'status_code' => Res::HTTP_OK,
            'message' => $message,
            'data' => $data
        ]);
    }

    public function respondNotFound($message = 'Not Found!'){
        return $this->respond([
            'status' => 'error',
            'status_code' => Res::HTTP_NOT_FOUND,
            'message' => $message,
        ]);
    }

    public function respondInternalError($message){
        return $this->respond([
            'status' => 'error',
            'status_code' => Res::HTTP_INTERNAL_SERVER_ERROR,
            'message' => $message,
        ]);
    }

    public function respondValidationError($message, $errors){
        return $this->respond([
            'status' => 'error',
            'status_code' => Res::HTTP_UNPROCESSABLE_ENTITY,
            'message' => $message,
            'data' => $errors
        ],Res::HTTP_UNPROCESSABLE_ENTITY);
    }

    public function respond($data, $headers = []){
        return Response::json($data, $this->getStatusCode(), $headers);
    }

    public function sendSuccessResponse($result, $message){
    	return $this->respond([
            'status' => 'success',
            'status_code' => Res::HTTP_OK,
            'message' => $message,
            'data'    => $result,
        ]);
    }

    public function respondNoContent($message){
        return $this->respond([
            'status' => 'success',
            'status_code' => Res::HTTP_NO_CONTENT,
            'message' => $message,
        ]);
    }

    public function respondWithError($message){
        return $this->respond([
            'status' => 'error',
            'status_code' => Res::HTTP_BAD_REQUEST,
            'message' => $message,
        ]);
    }

    public function respondWithUnauthorized($message){
        return $this->respond([
            'status' => 'error',
            'status_code' => Res::HTTP_UNAUTHORIZED,
            'message' => $message,
        ]);
    }

    public function respondForbidden($message){
        return $this->respond([
            'status' => 'error',
            'status_code' => Res::HTTP_FORBIDDEN,
            'message' => $message,
        ],Res::HTTP_FORBIDDEN);
    }
    public function respondWithGone($message){
        return $this->respond([
            'status' => 'error',
            'status_code' => Res::HTTP_GONE,
            'message' => $message,
        ]);
    }
    public function respondExpectationFailed($message)
    {
        return $this->respond([
            'status' => 'error',
            'status_code' => Res::HTTP_EXPECTATION_FAILED,
            'message' => $message,
        ]);
    }
}
