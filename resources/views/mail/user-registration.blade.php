<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>User registration mail</title>

    <style>
    @media only screen and (max-width: 600px) {
        div.zm_8759279705542506507_parse_-7587606107956162749 *.x_-519424683inner-body {
            width: 100%
        }
        div.zm_8759279705542506507_parse_-7587606107956162749 *.x_-519424683footer {
            width: 100%
        }
    }

    @media only screen and (max-width: 500px) {
        div.zm_8759279705542506507_parse_-7587606107956162749 *.x_-519424683button {
            width: 100%
        }
    }
    </style>

    @php
        $gotoURL = env('APP_URL').'/login';
    @endphp
</head>
<body>

    <div style="box-sizing: border-box;position: relative;background-color: rgb(255,255,255);color: rgb(113,128,150);min-height: 100.0%;line-height: 1.4;margin: 0;padding: 0;width: 100.0%;"
        class=" zm_8759279705542506507_parse_-7587606107956162749">

        <table class="x_-519424683wrapper" width="100%" cellpadding="0" cellspacing="0"
            style="box-sizing: border-box;position: relative;background-color: rgb(237,242,247);margin: 0;padding: 0;width: 100.0%;">
            <tbody>
                <tr>
                    <td align="center" style="box-sizing: border-box;position: relative;">
                        <table class="x_-519424683content" width="100%" cellpadding="0" cellspacing="0" style="box-sizing: border-box;position: relative;margin: 0;padding: 0;width: 100.0%;">
                            <tbody>
                                <tr>
                                    <td class="x_-519424683header"
                                        style="box-sizing: border-box;position: relative;padding: 25.0px 0;text-align: center;">
                                        <a href="{{env('APP_URL')}}"
                                            style="box-sizing: border-box;position: relative;color: rgb(61,72,82);font-size: 19.0px;font-weight: bold;text-decoration: none;display: inline-block;"
                                            target="_blank">
                                            {{env('APP_NAME')}}
                                        </a>
                                    </td>
                                </tr>

                                <tr>
                                    <td class="x_-519424683body" width="100%"
                                        style="box-sizing: border-box;position: relative;background-color: rgb(237,242,247);border-bottom: 1.0px solid rgb(237,242,247);border-top: 1.0px solid rgb(237,242,247);margin: 0;padding: 0;width: 100.0%;">
                                        <table class="x_-519424683inner-body" align="center" width="570" cellpadding="0" cellspacing="0"
                                            style="box-sizing: border-box;position: relative;background-color: rgb(255,255,255);border-color: rgb(232,229,239);border-radius: 2.0px;border-width: 1.0px;margin: 0 auto;padding: 0;width: 570.0px;">

                                            <tbody>
                                                <tr>
                                                    <td class="x_-519424683content-cell"
                                                        style="box-sizing: border-box;position: relative;padding: 32.0px;">
                                                        <h1
                                                            style="box-sizing: border-box;position: relative;color: rgb(61,72,82);font-size: 18.0px;font-weight: bold;margin-top: 0;text-align: left;">
                                                            Hello, {{$name}}!</h1>
                                                        <p style="box-sizing: border-box;position: relative;font-size: 16.0px;line-height: 1.5em;margin-top: 0;text-align: left;">
                                                            You are receiving this email because you created an account with {{env('APP_NAME')}}. Please note your log-in credentials.
                                                        </p>
                                                        <p style="box-sizing: border-box;position: relative;font-size: 16.0px;line-height: 1.5em;margin-top: 0;text-align: left;">
                                                            User id : <strong>{{$email}}</strong></p>
                                                        <p style="box-sizing: border-box;position: relative;font-size: 16.0px;line-height: 1.5em;margin-top: 0;text-align: left;">
                                                            Password : <strong>{{$password}}</strong></p>
                                                        <table class="x_-519424683action" align="center" width="100%" cellpadding="0"
                                                            cellspacing="0"
                                                            style="box-sizing: border-box;position: relative;margin: 30.0px auto;padding: 0;text-align: center;width: 100.0%;">
                                                            <tbody>
                                                                <tr>
                                                                    <td align="center" style="box-sizing: border-box;position: relative;">
                                                                        <table width="100%" border="0" cellpadding="0" cellspacing="0"
                                                                            style="box-sizing: border-box;position: relative;">
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td align="center"
                                                                                        style="box-sizing: border-box;position: relative;">
                                                                                        <table border="0" cellpadding="0" cellspacing="0"
                                                                                            style="box-sizing: border-box;position: relative;">
                                                                                            <tbody>
                                                                                                <tr>
                                                                                                    <td
                                                                                                        style="box-sizing: border-box;position: relative;">
                                                                                                        <a href="{{$gotoURL}}"
                                                                                                            class="x_-519424683button x_-519424683button-primary"
                                                                                                            target="_blank"
                                                                                                            style="box-sizing: border-box;position: relative;border-radius: 4.0px;color: rgb(255,255,255);display: inline-block;overflow: hidden;text-decoration: none;background-color: rgb(45,55,72);border-bottom: 8.0px solid rgb(45,55,72);border-left: 18.0px solid rgb(45,55,72);border-right: 18.0px solid rgb(45,55,72);border-top: 8.0px solid rgb(45,55,72);">Login Now</a>
                                                                                                    </td>
                                                                                                </tr>
                                                                                            </tbody>
                                                                                        </table>
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                        <p
                                                            style="box-sizing: border-box;position: relative;font-size: 16.0px;line-height: 1.5em;margin-top: 0;text-align: left;">
                                                            Regards,<br>
                                                            {{env('APP_NAME')}}</p>

                                                        <table class="x_-519424683subcopy" width="100%" cellpadding="0" cellspacing="0"
                                                            style="box-sizing: border-box;position: relative;border-top: 1.0px solid rgb(232,229,239);margin-top: 25.0px;padding-top: 25.0px;">
                                                            <tbody>
                                                                <tr>
                                                                    <td style="box-sizing: border-box;position: relative;">
                                                                        <p
                                                                            style="box-sizing: border-box;position: relative;line-height: 1.5em;margin-top: 0;text-align: left;font-size: 14.0px;">
                                                                            If you're having trouble clicking the "Login Now" button,
                                                                            copy and paste the URL below into your web browser: <span class="x_-519424683break-all" style="box-sizing: border-box;position: relative;">
                                                                                <a href="{{$gotoURL}}" style="box-sizing: border-box;position: relative;color: rgb(56,105,212);" target="_blank">{{$gotoURL}}</a></span>
                                                                        </p>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>

                                <tr>
                                    <td style="box-sizing: border-box;position: relative;">
                                        <table class="x_-519424683footer" align="center" width="570" cellpadding="0" cellspacing="0"
                                            style="box-sizing: border-box;position: relative;margin: 0 auto;padding: 0;text-align: center;width: 570.0px;">
                                            <tbody>
                                                <tr>
                                                    <td class="x_-519424683content-cell" align="center"
                                                        style="box-sizing: border-box;position: relative;padding: 32.0px;">
                                                        <p
                                                            style="box-sizing: border-box;position: relative;line-height: 1.5em;margin-top: 0;color: rgb(176,173,197);font-size: 12.0px;text-align: center;">
                                                            &copy; {{date('Y')}} {{env('APP_NAME')}}. All rights reserved.</p>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

</body>
</html>