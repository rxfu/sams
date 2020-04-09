<?php

namespace App\Exceptions;

use Exception;
use App\Services\LogService;

class InternalException extends Exception
{
    protected $exception;

    protected $model;

    protected $action;

    public function __construct($exception, $model, $action)
    {
        $this->exception = $exception;
        $this->model = $model;
        $this->action = $action;
        $message = '系统内部错误：' . $this->exception->getMessage();
        $code = $this->exception->getCode();

        parent::__construct($message, $code);
    }

    /**
     * Report or log an exception.
     *
     * @param App\Services\LogService $log
     * @return void
     */
    public function report(LogService $log)
    {
        $content = [
            'exception' => class_basename($this->exception),
            'message' => $this->getMessage(),
        ];

        $log->log($content, $this->model, $this->action, $this->getCode());
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function render($request)
    {
        return back()->withDanger($this->getMessage())->withInput();
    }
}
