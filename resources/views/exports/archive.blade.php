
<h1>新生档案材料移交登记表</h1>
<p>人数：{{ $students->count() }} 人</p>
<table>
    <thead>
        <tr>
            <th>学号</th>
            <th>姓名</th>
            @foreach ($entries as $entry)
                <th>{{ $entry->name }}</th>
            @endforeach
            <th>备注</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($students as $student)
            <tr>
                <td>{{ $student->id }}</td>
                <td>{{ $student->name }}</td>
                @foreach ($student->archive->entries as $item)
                    {{ $item->quantity }}
                @endforeach
                <td>{{ $student->archive->remark }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
