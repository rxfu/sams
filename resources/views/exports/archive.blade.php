<table>
    <caption>本科生新生档案材料移交登记表</caption>
    <thead>
        <th>学号</th>
        <th>姓名</th>
        @foreach ($entries as $entry)
            <th>{{ $entry->name }}</th>
        @endforeach
        <th>备注</th>
    </thead>
    <tbody>
        @foreach ($students as $student)
            @foreach ($student->archives as $archive)
                <td>{{ $student->id }}</td>
                <td>{{ $student->name }}</td>
                @foreach ($archive->entries as $item)
                    {{ $item->quantity }}
                @endforeach
                <td>{{ $archive->remark }}</td>
            @endforeach
        @endforeach
    </tbody>
</table>