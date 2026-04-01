<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>COSECSA Forms</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'Inter', sans-serif;
            min-height: 100vh;
            background: #F5EDE8;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 24px;
        }

        /* Subtle background decoration */
        body::before {
            content: '';
            position: fixed;
            top: -120px; right: -120px;
            width: 480px; height: 480px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(240,193,41,0.18) 0%, transparent 70%);
            pointer-events: none;
        }
        body::after {
            content: '';
            position: fixed;
            bottom: -100px; left: -100px;
            width: 400px; height: 400px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(131,28,9,0.10) 0%, transparent 70%);
            pointer-events: none;
        }

        .card {
            background: #fff;
            border-radius: 20px;
            box-shadow: 0 4px 6px -1px rgba(131,28,9,0.08), 0 16px 40px -4px rgba(131,28,9,0.12);
            padding: 0;
            width: 100%;
            max-width: 440px;
            overflow: hidden;
            position: relative;
            z-index: 1;
        }

        /* Gold accent top strip */
        .card-top-strip {
            height: 4px;
            background: linear-gradient(90deg, #831C09 0%, #F0C129 60%, #f5d96a 100%);
        }

        .card-body {
            padding: 40px 40px 36px;
            text-align: center;
        }

        .logo-circle {
            display: inline-block;
            margin-bottom: 24px;
        }

        h1 {
            font-size: 22px;
            font-weight: 700;
            color: #1a0a08;
            letter-spacing: -0.3px;
            margin-bottom: 8px;
        }

        h1 em {
            font-style: normal;
            color: #831C09;
        }

        .sub {
            font-size: 14px;
            color: #7c5c56;
            line-height: 1.6;
            margin-bottom: 32px;
            font-weight: 400;
        }

        .section-label {
            font-size: 10px;
            font-weight: 600;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            color: #b08a83;
            text-align: left;
            margin-bottom: 8px;
        }

        .btn {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 9px;
            width: 100%;
            height: 48px;
            border-radius: 12px;
            font-family: 'Inter', sans-serif;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            transition: all 0.18s ease;
            border: none;
        }

        .btn-primary {
            background: #831C09;
            color: #fff;
            box-shadow: 0 2px 8px rgba(131,28,9,0.25), 0 1px 2px rgba(131,28,9,0.2);
        }

        .btn-primary:hover {
            background: #6e1707;
            box-shadow: 0 4px 16px rgba(131,28,9,0.35), 0 2px 4px rgba(131,28,9,0.2);
            transform: translateY(-1px);
        }

        .btn-secondary {
            background: #fef9ec;
            color: #6e4400;
            border: 1.5px solid #F0C129;
        }

        .btn-secondary:hover {
            background: #fef3d0;
            transform: translateY(-1px);
        }

        .divider {
            display: flex;
            align-items: center;
            gap: 12px;
            margin: 24px 0;
        }

        .divider::before, .divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background: #f0e6e3;
        }

        .divider span {
            font-size: 11px;
            color: #c4a09a;
            font-weight: 500;
        }

        footer {
            margin-top: 28px;
            font-size: 12px;
            color: #a07870;
            text-align: center;
            position: relative;
            z-index: 1;
        }
    </style>
</head>
<body>

<div class="card">
    <div class="card-top-strip"></div>
    <div class="card-body">

        <div class="logo-circle">
            <img src="{{ asset('images/Cosecsa Logo.png') }}" alt="COSECSA" style="height:72px;width:auto;object-fit:contain;">
        </div>

        <h1>COSECSA <em>Forms</em></h1>
        <p class="sub">Submit your hospital's programme data or access the admin dashboard.</p>

        <div class="section-label">For hospitals &amp; training sites</div>
        <a href="{{ route('submission.create') }}" class="btn btn-primary">
            <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
            </svg>
            Open Submission Form
        </a>

        <div class="divider"><span>or</span></div>

        <div class="section-label">COSECSA administrators</div>
        <a href="{{ route('login') }}" class="btn btn-secondary">
            <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
            </svg>
            Admin Sign In
        </a>
    </div>
</div>

<footer>&copy; {{ date('Y') }} COSECSA &nbsp;&middot;&nbsp; College of Surgeons of East, Central and Southern Africa</footer>

</body>
</html>
