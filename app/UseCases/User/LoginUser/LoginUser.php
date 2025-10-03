<?php
declare(strict_types=1);
namespace App\UseCases\User\LoginUser;

class LoginUser
{

    private string $email;

    private string $password;

    public function __construct(
        string $email,
        string $password
    ) {
        $this->email = $email;
        $this->password = $password;
    }


    public function email(): string
    {
        return $this->email;
    }

    public function password(): string
    {
        return $this->password;
    }

    /**
     * @param array<string,string|null> $data
     */
    public static function fromRequestData(array $data): self
    {
        return new self(
            $data['email'],
            $data['password']
        );
    }
}
