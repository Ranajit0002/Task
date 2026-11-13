<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>{{ $subcopy ?? 'TaskFlow Notification' }}</title>
    <style type="text/css">
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap');
        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
            background-color: #f4f4f5;
            color: #27272a;
            margin: 0;
            padding: 0;
            -webkit-text-size-adjust: none;
        }
        .email-wrapper {
            width: 100%;
            margin: 0;
            padding: 0;
            background-color: #f4f4f5;
        }
        .email-content {
            width: 100%;
            margin: 0;
            padding: 0;
        }
        .email-body {
            width: 100%;
            margin: 0;
            padding: 0;
            background-color: #ffffff;
            border-top: 1px solid #e4e4e7;
            border-bottom: 1px solid #e4e4e7;
        }
        .email-body_inner {
            width: 570px;
            margin: 0 auto;
            padding: 35px;
        }
        .body-action {
            margin-top: 30px;
            margin-bottom: 30px;
            text-align: center;
        }
        .button {
            background-color: #09090b;
            border-top: 10px solid #09090b;
            border-right: 18px solid #09090b;
            border-bottom: 10px solid #09090b;
            border-left: 18px solid #09090b;
            display: inline-block;
            color: #ffffff;
            text-decoration: none;
            border-radius: 6px;
            box-shadow: 0 2px 3px rgba(0, 0, 0, 0.16);
            -webkit-text-size-adjust: none;
            font-size: 14px;
            font-weight: 500;
        }
        .attributes {
            margin: 0 0 21px;
        }
        .attributes_content {
            background-color: #f4f4f5;
            padding: 16px;
            border-radius: 6px;
        }
        .attributes_item {
            font-size: 13px;
            color: #52525b;
        }
        p {
            margin-top: 0;
            color: #52525b;
            font-size: 15px;
            line-height: 1.6;
        }
        h1 {
            margin-top: 0;
            color: #09090b;
            font-size: 18px;
            font-weight: 600;
        }
    </style>
</head>
<body>
    <table class="email-wrapper" width="100%" cellpadding="0" cellspacing="0" role="presentation">
        <tr>
            <td align="center">
                <table class="email-content" width="100%" cellpadding="0" cellspacing="0" role="presentation">
                    <!-- Email Header -->
                    {{ $header ?? '' }}

                    <!-- Email Body -->
                    <tr>
                        <td class="email-body" width="100%" cellpadding="0" cellspacing="0">
                            <table class="email-body_inner" align="center" width="570" cellpadding="0" cellspacing="0" role="presentation">
                                <tr>
                                    <td>
                                        <!-- Render content (Greeting, lines, action buttons) -->
                                        {{ $slot }}

                                        <!-- Subcopy / Action URL fallback -->
                                        @isset($subcopy)
                                            <table class="attributes" width="100%" cellpadding="0" cellspacing="0" role="presentation">
                                                <tr>
                                                    <td class="attributes_content">
                                                        <table width="100%" cellpadding="0" cellspacing="0" role="presentation">
                                                            <tr>
                                                                <td class="attributes_item">
                                                                    {{ $subcopy }}
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </table>
                                        @endisset
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <!-- Email Footer -->
                    {{ $footer ?? '' }}
                </table>
            </td>
        </tr>
    </table>
</body>
</html>