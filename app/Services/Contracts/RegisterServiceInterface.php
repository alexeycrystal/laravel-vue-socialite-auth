<?php
/**
 * Created by PhpStorm.
 * User: finatoros
 * Date: 31.01.19
 * Time: 18:34
 */

namespace App\Services\Contracts;


use App\Http\Requests\RegistrationRequest;
use Illuminate\Http\JsonResponse;

interface RegisterServiceInterface
{
    public function register(RegistrationRequest $request): array;
}