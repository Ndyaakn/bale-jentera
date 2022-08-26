<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Nama bahan</th>
            <th>Tipe</th>
            <th>Jumlah</th>
            <th>Alasan</th>
        </tr>
    </thead>
    <tbody>
        @php $no = 1 @endphp
        @foreach($journal_material as $item)
            <tr>
                <td>{{ $no++ }}</td>
                <td>{{ $item->material->material }}</td>
                <td>{{ $item->type }}</td>
                <td>{{ $item->stock }}</td>
                <td>{{ $item->reason }}</td>
            </tr>
        @endforeach
    </tbody>
</table>