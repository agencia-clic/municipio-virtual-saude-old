
@if(!empty($call))

    @foreach ($call as $key => $val)
        <tr style="line-height: 80px;">
            <td class="border align-middle text-left">
                <span class="text-secondary h1 align-middle" style="font-size: 3vh; margin-left: 20%;">{{ $val->user }}</span>
            </td>
            <td class="border align-middle text-center">
                <span class="text-secondary h1 align-middle" style="font-size: 3vh">{{ $val->sala }}</span>
            </td>
            <td class="border align-middle text-center">
                <span class="text-secondary h1 align-middle" style="font-size: 3vh">{{ $val->created_at->format('H:i') }}</span>
            </td>
        </tr>
    @endforeach

@endif