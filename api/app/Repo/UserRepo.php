<?php

namespace App\Repo;

use App\Core\CoreRepo;
use App\Models\User\User;
use App\Models\User\UserLocale\UserLocale;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use RuntimeException;
use Spatie\Permission\Models\Role;

class UserRepo extends CoreRepo
{

    protected function getModelClass(): string
    {
        return User::class;
    }

    /**
     * @param string $email
     * @return Model|null
     */
    public function findByEmail(string $email): ?Model
    {
        $query = $this->query();
        $query->where('email',$email);

        return $query->firstOrFail();
    }

    /**
     * @param array $data
     * @param string $roleName
     * @return User|null
     */
    public function create(array $data, string $roleName): ?User
    {
        if (!$role = Role::findByName($roleName)) {
            throw new RuntimeException('Role not found!',404);
        }
        if (!$user = User::create($data)) {
            throw new RuntimeException('Error on creating user!',500);
        }
        if (!$user->assignRole($role)) {
            throw new RuntimeException('Error on assign role to user!',500);
        }

        return $user;
    }

    /**
     * @param int $id
     * @param array $data
     * @return Model|null
     */
    public function update(int $id, array $data): ?Model
    {
        if (!$user = $this->find($id)) {
            throw new RuntimeException('User not found!',404);
        }
        if(!$user->update($data)) {
            throw new RuntimeException('Error on updating user!',500);
        }
        return $this->find($user->getKey());
    }

    /**
     * @param int $id
     */
    public function logout(int $id): void
    {
        $user = $this->find($id);
        $user->tokens()->delete();
    }

    /**
     * @param array $data
     * @return LengthAwarePaginator
     */
    public function search(array $data): LengthAwarePaginator
    {
        $perPage = array_key_exists('perPage',$data)?$data['perPage']:10;
        $sortBy = 'first_name';
        $sortDesc = array_key_exists('sortDesc',$data)?$data['sortDesc']:true;
        $query = $this->query();
        if (array_key_exists('title',$data)) {
            $query->where(function($q) use($data) {
                $q->where('first_name','like','%'.$data['title'].'%');
                $q->orWhere('second_name','like','%'.$data['title'].'%');
                $q->orWhere('surname','like','%'.$data['title'].'%');
            });
        }
        return $query->orderBy($sortBy,$sortDesc?'desc':'asc')->paginate($perPage);
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function getLocation(int $id): mixed
    {
        if (!$user = $this->find($id)) {
            throw new RuntimeException('User not found!',404);
        }
        if(!$user->locale) {
            return new UserLocale();
        }
        return $user->locale;
    }

    /**
     * @param int $id
     * @param array $data
     * @return mixed
     */
    public function updateLocation(int $id, array $data): mixed
    {
        if (!$user = $this->find($id)) {
            throw new RuntimeException('User not found!',404);
        }
        $data['user_id'] = $user->getKey();
        if(!$user->locale()->updateOrCreate(['user_id' => $data['user_id']],$data)) {
            throw new RuntimeException('Error on updating user location!',500);
        }
        return UserLocale::where('user_id', $data['user_id'])->first();
    }

    /**
     * @param int $id
     * @param array $data
     * @return Builder|Model|object|null
     */
    public function updateCompany(int $id, array $data)
    {
        if (!$user = $this->find($id)) {
            throw new RuntimeException('User not found!',404);
        }
        $data['user_id'] = $user->getKey();
        if(!$user->update($data)) {
            throw new RuntimeException('Error on updating user!',500);
        }
        if(!$user->company()->updateOrCreate(['user_id' => $data['user_id']],$data['company'])) {
            throw new RuntimeException('Error on updating user company!',500);
        }
        return $this->query()->where('id',$user->getKey())->with(['company'])->first();
    }
}
