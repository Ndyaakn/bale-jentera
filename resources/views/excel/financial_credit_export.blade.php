<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Tanggal</th>
            <th>Deskripsi</th>
            <th>Jumlah pengeluaran</th>
        </tr>
    </thead>
    <tbody>
        @php $no = 1 @endphp
        @foreach($financial_statement as $item)
            <tr>
                <td>{{ $no++ }}</td>
                <td>{{ $item->financial_statement_title->date }}</td>
                <td>{{ $item->description }}</td>
                <td colspan="2">{{ $item->credit }}</td>
            </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <td colspan="3"><b>TOTAL:</b></td>
            <td colspan="2"><b>{{ $total_financial_statement }}</b></td>
        </tr>
    </tfoot>
</table>