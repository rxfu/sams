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

        <title>学生档案EMS寄档交寄单 | {{ config('setting.name', 'Laravel') }}</title>

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
        </style>
    </head>
    <body>
        @isset ($deliveries)
            <main>
                <header>
                    <p>邮(5008)甲</p>
                    <h2 class="text-center">学生档案EMS寄档交寄单</h2>
                    <h3>寄件单位：广西师范大学档案馆</h3>
                    <hr>
                </header>
                <div>发出日期：{{ $deliveries[0]->send_at->format('Y-m-d') }}</div>
                <table cellspacing="0" cellpadding="0">
                    <thead>
                        <tr>
                            <th rowspan="2">格数</th>
                            <th rowspan="2">收件单位名称及住地</th>
                            <th rowspan="2">档案号</th>
                            <th colspan="3">件数</th>
                            <th rowspan="2">邮寄号</th>
                            <th rowspan="2">备注</th>
                        </tr>
                        <tr>
                            <th>绝</th>
                            <th>机</th>
                            <th>密</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($deliveries as $delivery)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td class="text-left">{{ $delivery->receiver }}</td>
                                <td style="white-space: nowrap">{{ $delivery->archive_id }}</td>
                                <td></td>
                                <td>1</td>
                                <td></td>
                                <td>{{ $delivery->ems }}</td>
                                <td>{{ $delivery->remark }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="3" class="text-left">本页合计 {{ $deliveries->count() }} 件</td>
                            <td rowspan="3" colspan="5" class="text-left" valign="top">
                                <p>接收人&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;接收日戳（章）</p>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3" class="text-left">本号单共计&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;页&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;件</td>
                        </tr>
                        <tr>
                            <td colspan="3" class="text-left">文件资费&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;￥</td>
                        </tr>
                        <tr>
                            <td colspan="8" class="text-left">登记人：&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;送件人：</td>
                        </tr>
                    </tfoot>
                </table>
            </main>
        @endisset
    </body>
</html>
