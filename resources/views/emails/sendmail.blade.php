<x-mail::message>

    Thông tin liên hệ

    Fullname: {{ $data['name'] }}
    Email: {{ $data['email'] }}
    Message: {{ $data['message'] }}
    Link: {{ $data['link'] }}

    Thanks,
    {{ $data['company'] }}
</x-mail::message>
