<?php

namespace App\Interfaces;

use Illuminate\Http\JsonResponse;

interface JsonOutputInterface
{
    /**
     * @return mixed
     */
    public function response(): JsonResponse;

    /**
     * @param  array  $data
     * @return $this
     */
    public function setData(mixed $data): self;

    /**
     * @param  string  $message
     * @return $this
     */
    public function setMessage(string $message): self;

    /**
     * @param  bool  $status
     * @return $this
     */
    public function setStatus(bool $status): self;

    /**
     * @param  int  $code
     * @return $this
     */
    public function setStatusCode(int $code): self;
}
