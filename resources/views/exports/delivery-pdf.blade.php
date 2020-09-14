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
        <main>
            <header class="text-center">
                <h1>广西师范大学学生档案转递通知单存根</h1>
            </header>
            <div>
                <span class="text-left">梧州市长洲区西堤三路11号梧州市人力资源及社会保障局</span>
                <span class="text-right">No.1207030057</span>
            </div>
            <div>
                <p>现将下列　植文斌  等同学的档案共　壹　袋，材料共　　 　份转去，请按档案内所列目录清点查收，并将回执退回。</p>
            </div>
            <div>
                <p>广西师范大学档案馆学生档案室</p>
                <p>2020年3月21日</p></p>
            </div>
            <table cellspacing="0" cellpadding="0">
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
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            </table>
            <hr>
            <header class="text-center">
                <h1>广西师范大学学生档案转递通知单</h1>
            </header>
            <div>
                <span class="text-left">梧州市长洲区西堤三路11号梧州市人力资源及社会保障局</span>
                <span class="text-right">No.1207030057</span>
            </div>
            <div>
                <p>现将下列　植文斌  等同学的档案共　壹　袋，材料共　　 　份转去，请按档案内所列目录清点查收，并将回执退回。</p>
            </div>
            <div>
                <p>广西师范大学档案馆学生档案室</p>
                <p>2020年3月21日</p></p>
            </div>
            <table cellspacing="0" cellpadding="0">
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
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            </table>
            <br>
            <address>
                通讯地址：广西桂林市雁山区雁中路1号广西师范大学档案馆学生档案室&nbsp;&nbsp;邮编：541006&nbsp;&nbsp;电话：0773-8283207
            </address>
        </main>
    </body>
</html>