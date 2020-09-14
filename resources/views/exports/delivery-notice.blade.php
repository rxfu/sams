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

        <title>学生档案转递通知单 | {{ config('setting.name', 'Laravel') }}</title>

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
                float: right;
            }
            .inscribe {
                margin-top: 80px !important;
            }
            .inscribe p {
                position: relative;
                left: 200px;
            }
            .page-break {
                page-break-after: always;
            }
            .interval {
                margin-bottom: 40px;
            }
            .clear {
                clear: both;
            }
            address {
                font-size: 90%;
                font-style: normal;
            }
        </style>
    </head>
    <body>
        <main>
            @foreach ($deliveries as $delivery)
                @if (!$loop->first)
                    <div class="page-break"></div>
                @endif
                <header class="text-center">
                    <h1>广西师范大学学生档案转递通知单存根</h1>
                </header>
                <div>
                    <span class="text-left">{{ $delivery->address }}</span>
                    <span class="text-right">No.{{ $delivery->archive_id }}</span>
                </div>
                <div>
                    <p>现将&nbsp;&nbsp;{{ $delivery->archive->student->name }}&nbsp;&nbsp;同学的档案共&nbsp;&nbsp;壹&nbsp;&nbsp;袋，材料共&nbsp;&nbsp;{{ $delivery->archive->entries->sum('pivot.quantity') }}&nbsp;&nbsp;份转去，请按档案内所列目录清点查收，并将回执退回。</p>
                </div>
                <div>
                    <span class="text-right">广西师范大学档案馆学生档案室</span>
                </div>
                <div class="clear"></div>
                <div>
                    <span class="text-right">{{ date('Y年m月d日') }}</span>
                </div>
                <div class="clear"></div>
                <div class="interval"></div>
                <table cellspacing="0" cellpadding="0" align="center">
                    <tr>
                        <th>姓名</th>
                        <th>学号</th>
                        <th>学院</th>
                        <th>专业</th>
                        <th>年级</th>
                        <th>转递原因</th>
                        <th>档案材料</th>
                    </tr>
                    <tr>
                        <td>{{ $delivery->archive->student->name }}</td>
                        <td>{{ $delivery->archive->student->id }}</td>
                        <td>{{ $delivery->archive->student->department }}</td>
                        <td>{{ $delivery->archive->student->major }}</td>
                        <td>{{ $delivery->archive->student->grade }}</td>
                        <td>{{ $delivery->reason }}</td>
                        <td></td>
                    </tr>
                </table>
                <div class="interval"></div>
                <hr>
                <header class="text-center">
                    <h1>广西师范大学学生档案转递通知单</h1>
                </header>
                <div>
                    <span class="text-left">{{ $delivery->address }}</span>
                    <span class="text-right">No.{{ $delivery->archive_id }}</span>
                </div>
                <div>
                    <p>现将&nbsp;&nbsp;{{ $delivery->archive->student->name }}&nbsp;&nbsp;同学的档案共&nbsp;&nbsp;壹&nbsp;&nbsp;袋，材料共&nbsp;&nbsp;{{ $delivery->archive->entries->sum('pivot.quantity') }}&nbsp;&nbsp;份转去，请按档案内所列目录清点查收，并将回执退回。</p>
                </div>
                <div>
                    <span class="text-right">广西师范大学档案馆学生档案室</span>
                </div>
                <div class="clear"></div>
                <div>
                    <span class="text-right">{{ date('Y年m月d日') }}</span>
                </div>
                <div class="clear"></div>
                <div class="interval"></div>
                <table cellspacing="0" cellpadding="0" align="center">
                    <tr>
                        <th>姓名</th>
                        <th>学号</th>
                        <th>学院</th>
                        <th>专业</th>
                        <th>年级</th>
                        <th>转递原因</th>
                        <th>档案材料</th>
                    </tr>
                    <tr>
                        <td>{{ $delivery->archive->student->name }}</td>
                        <td>{{ $delivery->archive->student->id }}</td>
                        <td>{{ $delivery->archive->student->department }}</td>
                        <td>{{ $delivery->archive->student->major }}</td>
                        <td>{{ $delivery->archive->student->grade }}</td>
                        <td>{{ $delivery->reason }}</td>
                        <td></td>
                    </tr>
                </table>
                <div class="interval"></div>
                <table cellspacing="0" cellpadding="0">
                    <tr>
                        <th>
                            <h3>回执</h3>
                        </th>
                        <td class="text-left">
                            <div>
                                <span class="text-left">广西师范大学档案馆学生档案室</span>
                                <span class="text-right">No.{{ $delivery->archive_id }}</span>
                            </div>
                            <div>
                                <p>你处于&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;年&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;月&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;日转来&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;同学的档案共&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;袋材料共&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;份已全部收到，现将回执寄回。</p>
                            </div>
                            <div>
                                <span class="text-right">收件人签名：&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;收件机关盖章：&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                            </div>
                            <div class="clear"></div>
                            <div>
                                <span class="text-right">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;年&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;月&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;日</span>
                            </div>
                        </td>
                    </tr>
                </table>
                <br>
                <address class="text-center">
                    通讯地址：广西桂林市雁山区雁中路1号广西师范大学档案馆学生档案室&nbsp;&nbsp;&nbsp;&nbsp;邮编：541006&nbsp;&nbsp;&nbsp;&nbsp;电话：0773-8283207
                </address>
            @endforeach
        </main>
    </body>
</html>