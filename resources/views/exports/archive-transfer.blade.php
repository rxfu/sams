<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <meta name="keywords" content="{{ config('setting.keywords') }}">
        <meta name="description" content="{{ config('setting.description') }}">
        <meta name="author" content="{{ config('setting.author') }}">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>新生档案材料移交表 | {{ config('setting.name', 'Laravel') }}</title>

        <style>
            body {
                font-family: SimSun;
                font-size: 14pt;
                color: #000 !important;
            }
            h1 {
                font-size: 24pt;
                font-weight: bold;
                padding-top: 24pt;
            }
            p {
                text-indent: 2em;
            }
            table {
                table-layout: fixed;
            }
            table th, table td {
                border: 1px solid #000 !important;
                word-wrap: break-word;
                word-break: break-all;
                text-align: center;
                padding: 10px;
                font-size: 12pt;
            }
            table, tr, td, th, tbody, thead, tfoot {
                page-break-inside: avoid !important;
            }
            @page {
                margin: 50px 0;
            }
            .text-center {
                text-align: center;
            }
            .text-left {
                text-align: left;
            }
            .text-right {
                text-align: right;
            }
            .inscribe {
                margin-top: 80px !important;
            }
            .inscribe p {
                position: relative;
                left: 200px;
            }
            .footnote {
                
                font-size: 10pt;
            }
            .no-wrap {
                word-break: keep-all;
                white-space: nowrap;
            }
            .float-left {
                float: left;
            }
            .float-right {
                float: right;
            }
            .clear {
                clear: both;
            }
            .caption {
                border-top-style: none !important;
                border-left-style: none !important;
                border-right-style: none !important;
            }
            .signature {
                display: inline-block;
                width: 480pt;
            }
        </style>
    </head>
    <body>
        <main>
            <header class="text-center">
                <h2>新生档案材料移交登记表</h2>
            </header>
            <table cellspacing="0" cellpadding="0">
                <thead>
                    <tr>
                        <th colspan="{{ $entries->count() + 23 }}" class="caption">
                            学院：{{ $students[0]->department->name }}&nbsp;&nbsp;&nbsp;&nbsp;专业：{{ $students[0]->major->name }}&nbsp;&nbsp;&nbsp;&nbsp;年级：{{ $students[0]->grade }} 级
                        </th>
                    </tr>
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
                            <td class="no-wrap">{{ $student->id }}</td>
                            <td class="no-wrap">{{ $student->name }}</td>
                            @if ($student->archive)
                                @foreach ($student->archive->entries as $item)
                                    <td>{{ $item->pivot->quantity }}</td>
                                @endforeach
                                <td>{{ $student->archive->remark }}</td>
                            @else
                                @for($i = 0; $i <= $entries->count(); $i++)
                                    <td></td>
                                @endfor
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <p class="text-right">人数：共{{ $students->count() }} 人</p>
            <table cellspacing="0" cellpading="0" width="100%">
                <tr>
                    <td style="border: 0 !important">
                        <p>
                            <div class="float-left signature">
                                <p>移交人：</p>
                                <p>移交单位：</p>
                                <p>移交时间：</p>
                            </div>
                            <div class="float-right signature">
                                <p>接收人：</p>
                                <p>接收单位：</p>
                                <p>接收时间：</p>
                            </div>
                        </p>
                    </td>
                </tr>
            </table>
        </main>
        <div class="clear"></div>
    </body>
</html>
