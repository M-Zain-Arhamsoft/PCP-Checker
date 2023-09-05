@foreach ($ssb_leads as $ssb_lead)
    <tr>
        <td>{{ $ssb_lead->id }}</td>
        <td>{{ $ssb_lead->created_at }}</td>
        <td class="text-danger">{{ $ssb_lead->updated_at }}</td>
        <td>{{ $ssb_lead->case_description }}</td>
        <td>
            @if ($ssb_lead->docs)
                <a href="{{ asset('storage/' . $ssb_lead->docs) }}" target="_blank">Download</a>
            @else
                No Docs Available
            @endif
        </td>
    </tr>
@endforeach
