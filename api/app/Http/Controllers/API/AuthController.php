<?php

namespace App\Http\Controllers\API;

use App\Core\StorageManager;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ChangePasswordRequest;
use App\Http\Requests\Auth\CompanyRegisterRequest;
use App\Http\Requests\Auth\CompanyUpdateRequest;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\UpdatePhotoRequest;
use App\Http\Requests\Auth\UpdateUserLocationRequest;
use App\Http\Requests\Auth\UserRegisterRequest;
use App\Http\Requests\Auth\UserUpdateRequest;
use App\Http\Resources\User\UserLocationResource;
use App\Http\Resources\User\UserSimpleResource;
use App\Repo\UserRepo;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    /**
     * @var UserRepo
     */
    private UserRepo $repository;

    /**
     * @var string[]
     */
    private array $types;

    /**
     * AuthController constructor.
     * @param UserRepo $repository
     */
    public function __construct(UserRepo $repository)
    {
        $this->repository = $repository;
        $this->types = ['user','company'];
    }

    /**
     * @param LoginRequest $request
     * @return JsonResponse
     */
    public function login(LoginRequest $request): JsonResponse
    {
        $data = $request->validated();
        $user = $this->repository->findByEmail($data['email']);
        if (!$user || ! Hash::check($data['password'], $user->password)) {
            return new JsonResponse([
                'message'   =>  'Wrong credentials',
            ],401);
        }

        return new JsonResponse([
            'token'     =>  $user->createToken(env('APP_NAME'))->plainTextToken,
        ]);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     * @throws ValidationException
     */
    public function register(Request $request): JsonResponse
    {
        $type = $request->get('type');
        if ($type && in_array($type, $this->types, true)) {
            if ($type === 'user') {
                return $this->registerUser(UserRegisterRequest::createFrom($request));
            }
            if ($type === 'company') {
                return $this->registerCompany(CompanyRegisterRequest::createFrom($request));
            }

        }
        return new JsonResponse([
            'message'   =>  'Register type not allowed!'
        ]);
    }

    /**
     * @param UserRegisterRequest $request
     * @return JsonResponse
     * @throws ValidationException
     */
    private function registerUser(UserRegisterRequest $request): JsonResponse
    {
        $data = $this->validate($request,$request->rules());
        $data['password'] = Hash::make($data['password']);

        try {
            $user = $this->repository->create($data, 'simple');
        } catch (Exception $e) {
            return new JsonResponse([
                'message' => $e->getMessage(),
            ], $e->getCode());
        }

        return new JsonResponse([
            'token'     =>  $user->createToken(env('APP_NAME'))->plainTextToken,
        ]);
    }

    /**
     * @param CompanyRegisterRequest $request
     * @return JsonResponse
     * @throws ValidationException
     */
    private function registerCompany(CompanyRegisterRequest $request): JsonResponse
    {
        $data = $this->validate($request,$request->rules());
        $data['password'] = Hash::make($data['password']);

        try {
            $user = $this->repository->create($data, 'company');
        } catch (Exception $e) {
            return new JsonResponse([
                'message' => $e->getMessage(),
            ], $e->getCode());
        }

        return new JsonResponse([
            'token'     =>  $user->createToken(env('APP_NAME'))->plainTextToken,
        ]);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function logout(Request $request): JsonResponse
    {
        $this->repository->logout($request->user()->getKey());

        return new JsonResponse([
            'message'   =>  'Logout success',
        ]);
    }

    /**
     * @param Request $request
     * @return UserSimpleResource|JsonResponse
     */
    public function user(Request $request): UserSimpleResource|JsonResponse
    {
        try {
            $user = $this->repository->find($request->user()->getKey());
        } catch (Exception $e) {
            return new JsonResponse([
                'message' => $e->getMessage(),
            ], $e->getCode());
        }

        return new UserSimpleResource($user);
    }

    /**
     * @param Request $request
     * @return UserSimpleResource|JsonResponse
     * @throws ValidationException
     */
    public function update(Request $request): UserSimpleResource|JsonResponse
    {
        $type = $request->get('type');
        if ($type && in_array($type, $this->types, true)) {
            if ($type === 'user') {
                return $this->updateUser(UserUpdateRequest::createFrom($request));
            }
            if ($type === 'company') {
                return $this->updateCompany(CompanyUpdateRequest::createFrom($request));
            }

        }
        return new JsonResponse([
            'message'   =>  'Update type not allowed!'
        ]);
    }

    /**
     * @param CompanyUpdateRequest $request
     * @return UserSimpleResource|JsonResponse
     * @throws ValidationException
     */
    public function updateCompany(CompanyUpdateRequest $request): UserSimpleResource|JsonResponse
    {
        $data = $this->validate($request,$request->rules());
        $user = $request->user();

        try {
            $user = $this->repository->updateCompany($user->getKey(), $data);
        } catch (Exception $e) {
            return new JsonResponse([
                'message' => $e->getMessage(),
            ], 500);
        }

        return new UserSimpleResource($user);
    }

    /**
     * @param UserUpdateRequest $request
     * @return UserSimpleResource|JsonResponse
     * @throws ValidationException
     */
    public function updateUser(UserUpdateRequest $request): UserSimpleResource|JsonResponse
    {
        $data = $this->validate($request,$request->rules());
        $user = $request->user();

        try {
            $user = $this->repository->update($user->getKey(), $data);
        } catch (Exception $e) {
            return new JsonResponse([
                'message' => $e->getMessage(),
            ], $e->getCode());
        }

        return new UserSimpleResource($user);
    }

    /**
     * @param UpdatePhotoRequest $request
     * @return UserSimpleResource|JsonResponse
     */
    public function updatePhoto(UpdatePhotoRequest $request): UserSimpleResource|JsonResponse
    {
        $user = $request->user();
        $storage = new StorageManager();
        if ($user->avatar !== null) {
            $storage->deleteFile($user->avatar,'user_avatar');
        }
        $data['avatar'] = $storage
            ->savePicture($request->file('photo'),'user_avatar',400);

        try {
            $user = $this->repository->update($user->getKey(), $data);
        } catch (Exception $e) {
            return new JsonResponse([
                'message' => $e->getMessage(),
            ]);
        }

        return new UserSimpleResource($user);
    }

    /**
     * @param ChangePasswordRequest $request
     * @return UserSimpleResource|JsonResponse
     */
    public function changePassword(ChangePasswordRequest $request): UserSimpleResource|JsonResponse
    {
        $data = $request->validated();
        $user = $request->user();
        $data['password'] = Hash::make($data['password']);
        if (!$user || ! Hash::check($data['old_password'], $user->password)) {
            return new JsonResponse([
                'message'   =>  'Wrong credentials',
            ],401);
        }

        try {
            $user = $this->repository->update($user->getKey(), $data);
        } catch (Exception $e) {
            return new JsonResponse([
                'message' => $e->getMessage(),
            ],$e->getCode());
        }

        return new UserSimpleResource($user);
    }

    /**
     * @param UpdateUserLocationRequest $request
     * @return UserLocationResource|JsonResponse
     */
    public function getUserLocation(Request $request): UserLocationResource|JsonResponse
    {
        $user = $request->user();

        try {
            $location = $this->repository->getLocation($user->getKey());
        } catch (Exception $e) {
            return new JsonResponse([
                'message' => $e->getMessage(),
            ], 500);
        }

        return new UserLocationResource($location);
    }

    /**
     * @param UpdateUserLocationRequest $request
     * @return UserLocationResource|JsonResponse
     */
    public function updateUserLocation(UpdateUserLocationRequest $request): UserLocationResource|JsonResponse
    {
        $data = $request->validated();
        $user = $request->user();

        try {
            $location = $this->repository->updateLocation($user->getKey(), $data);
        } catch (Exception $e) {
            return new JsonResponse([
                'message' => $e->getMessage(),
            ], 500);
        }

        return new UserLocationResource($location);
    }
}
