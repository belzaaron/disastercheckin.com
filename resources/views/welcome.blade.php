<x-app-layout>

    <div class="prose">
        <p>If you are looking for information on a loved one, they may have checked in with us. We have provided a phone
            number to local media where people can send SMS updates about their well-being. You can search for your
            loved on
            by your user's phone number below:</p>
    </div>

    <form
        class="mt-8"
        method="post"
        action="{{ route('search') }}"
    >

        @csrf

        <div class="max-w-lg">
            <x-input
                required
                label="Phone Number"
                name="phone_number"
                type="tel"
                inputmode="tel"
                placeholder="eg. 828-555-1234"
            />
        </div>

        <div class="mt-2">
            <x-button type="submit" size="lg">
                Search
            </x-button>
        </div>
    </form>

</x-app-layout>
