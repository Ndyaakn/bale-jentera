<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Tanggal</th>
            <th>Jumlah pemasukan</th>
            <th>Jumlah pengeluaran</th>
            <th>Deskripsi</th>
            <th>Jumlah saldo</th>
        </tr>
    </thead>
    <tbody>
        @php $no = 1 @endphp
        @foreach($financial_statement as $item)
            <tr>
                <td>{{ $no++ }}</td>
                <td>{{ $item->date }}</td>
                <td>{{ $item->debit }}</td>
                <td>{{ $item->credit }}</td>
                <td>{{ $item->description }}</td>
            </tr>
        @endforeach
    </tbody>
</table>