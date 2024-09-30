<?php

namespace App\Events;

use App\Models\PhoneNumber;
use App\Models\User;
use Illuminate\Support\Str;
use Thunk\Verbs\Event;

/** @method static PhoneNumber commit(string $phone_number, string $email) */
class SubscribedToPhoneNumber extends Event
{
    public string $phone_number;

    public string $email;

    public function validate()
    {
        $this->assert(
            assertion: phone_number($this->phone_number)->isValid(),
            message: 'The phone number you are subscribing to does not appear to be valid.',
        );
    }

    public function handle(): PhoneNumber
    {
        $phone_number = PhoneNumber::findByValueOrCreate($this->phone_number);

        $user = User::firstOrCreate(
            ['email' => $this->email],
            ['name' => str($this->email)->before('@'), 'password' => Str::random(32)],
        );

        $user->subscriptions()->firstOrCreate([
            'user_id' => $user->id,
            'phone_number_id' => $phone_number->id,
        ]);

        return $phone_number;
    }
}
