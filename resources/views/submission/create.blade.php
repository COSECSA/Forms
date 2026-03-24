<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>COSECSA — Programme Submission</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <style>
        :root {
            --navy: #0f2744;
            --navy-mid: #1a3a5c;
            --navy-light: #2a5280;
            --gold: #c9973a;
            --gold-light: #e8b85a;
            --cream: #faf8f4;
            --white: #ffffff;
            --gray-100: #f4f4f2;
            --gray-200: #e8e8e4;
            --gray-400: #9a9a94;
            --gray-600: #5a5a54;
            --red: #c0392b;
            --green: #1a7a4a;
            --green-light: #edf7f1;
            --shadow-sm: 0 2px 8px rgba(15,39,68,0.08);
            --shadow-md: 0 8px 32px rgba(15,39,68,0.12);
            --shadow-lg: 0 20px 60px rgba(15,39,68,0.18);
        }

        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'Montserrat', sans-serif;
            background-color: var(--cream);
            color: var(--navy);
            min-height: 100vh;
        }

        /* ── Header ── */
        .site-header {
            background: var(--navy);
            padding: 0;
            position: relative;
            overflow: hidden;
        }
        .site-header::before {
            content: '';
            position: absolute;
            top: -60px; right: -60px;
            width: 300px; height: 300px;
            border-radius: 50%;
            background: rgba(201,151,58,0.08);
        }
        .site-header::after {
            content: '';
            position: absolute;
            bottom: -40px; left: 30%;
            width: 200px; height: 200px;
            border-radius: 50%;
            background: rgba(201,151,58,0.05);
        }
        .header-inner {
            max-width: 1100px;
            margin: 0 auto;
            padding: 48px 32px 40px;
            position: relative;
            z-index: 1;
        }
        .header-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: rgba(201,151,58,0.15);
            border: 1px solid rgba(201,151,58,0.3);
            color: var(--gold-light);
            font-size: 11px;
            font-weight: 600;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            padding: 6px 14px;
            border-radius: 20px;
            margin-bottom: 20px;
        }
        .header-badge::before {
            content: '';
            width: 6px; height: 6px;
            border-radius: 50%;
            background: var(--gold);
        }
        .site-header h1 {
            font-family: 'Montserrat', serif;
            font-size: 36px;
            font-weight: 700;
            color: var(--white);
            line-height: 1.2;
            margin-bottom: 12px;
        }
        .site-header h1 span { color: var(--gold-light); }
        .site-header p {
            color: rgba(255,255,255,0.6);
            font-size: 15px;
            font-weight: 300;
            max-width: 680px;
            line-height: 1.6;
        }
        .header-divider {
            height: 4px;
            background: linear-gradient(90deg, var(--gold) 0%, var(--gold-light) 50%, transparent 100%);
        }

        /* ── Main Layout ── */
        .main-wrap {
            max-width: 1100px;
            margin: 0 auto;
            padding: 40px 32px 80px;
        }

        /* ── Alerts ── */
        .alert {
            padding: 16px 20px;
            border-radius: 10px;
            margin-bottom: 28px;
            font-size: 14px;
            font-weight: 500;
            display: flex;
            align-items: flex-start;
            gap: 12px;
        }
        .alert-success {
            background: var(--green-light);
            border: 1px solid #a8dfc0;
            color: var(--green);
        }
        .alert-error {
            background: #fdf0ee;
            border: 1px solid #f0b8b2;
            color: var(--red);
        }
        .alert-icon {
            width: 20px; height: 20px;
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            font-size: 12px;
            flex-shrink: 0;
            margin-top: 1px;
        }
        .alert-success .alert-icon { background: var(--green); color: white; }
        .alert-error .alert-icon { background: var(--red); color: white; }

        /* ── Section Cards ── */
        .form-section {
            background: var(--white);
            border-radius: 16px;
            box-shadow: var(--shadow-sm);
            border: 1px solid var(--gray-200);
            margin-bottom: 24px;
            overflow: hidden;
        }
        .section-header {
            padding: 20px 28px;
            background: linear-gradient(135deg, var(--navy) 0%, var(--navy-mid) 100%);
            display: flex;
            align-items: center;
            gap: 14px;
        }
        .section-number {
            width: 32px; height: 32px;
            border-radius: 50%;
            background: rgba(201,151,58,0.2);
            border: 1px solid rgba(201,151,58,0.4);
            color: var(--gold-light);
            font-size: 13px;
            font-weight: 700;
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0;
        }
        .section-title {
            font-family: 'Montserrat', serif;
            font-size: 18px;
            color: var(--white);
            font-weight: 600;
        }
        .section-subtitle {
            font-size: 12px;
            color: rgba(255,255,255,0.5);
            margin-top: 2px;
        }
        .section-body { padding: 28px; }

        /* ── Form Fields ── */
        .field-grid {
            display: grid;
            gap: 20px;
        }
        .field-grid-2 { grid-template-columns: 1fr 1fr; }
        .field-grid-3 { grid-template-columns: 1fr 1fr 1fr; }

        .field-group { display: flex; flex-direction: column; gap: 6px; }

        label {
            font-size: 12px;
            font-weight: 600;
            letter-spacing: 0.06em;
            text-transform: uppercase;
            color: var(--gray-600);
        }

        input[type="text"],
        input[type="email"],
        select,
        textarea {
            width: 100%;
            padding: 11px 14px;
            border: 1.5px solid var(--gray-200);
            border-radius: 8px;
            font-family: 'Montserrat', sans-serif;
            font-size: 14px;
            color: var(--navy);
            background: var(--white);
            transition: border-color 0.2s, box-shadow 0.2s, background 0.2s;
            outline: none;
            appearance: none;
        }
        input:focus, select:focus, textarea:focus {
            border-color: var(--navy-light);
            box-shadow: 0 0 0 3px rgba(42,82,128,0.1);
            background: #fff;
        }
        input::placeholder, textarea::placeholder { color: var(--gray-400); }
        select { background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12'%3E%3Cpath fill='%239a9a94' d='M6 8L1 3h10z'/%3E%3C/svg%3E"); background-repeat: no-repeat; background-position: right 12px center; padding-right: 36px; cursor: pointer; }

        /* ── Add link ── */
        .add-link {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            font-size: 12px;
            font-weight: 600;
            color: var(--navy-light);
            cursor: pointer;
            margin-top: 8px;
            padding: 4px 0;
            border: none;
            background: none;
            transition: color 0.2s;
            text-decoration: none;
        }
        .add-link:hover { color: var(--gold); }
        .add-link svg { transition: transform 0.2s; }
        .add-link:hover svg { transform: rotate(90deg); }

        /* ── Inline field reveal ── */
        .reveal-field {
            display: none;
            margin-top: 10px;
            padding: 16px;
            background: var(--gray-100);
            border-radius: 10px;
            border: 1px dashed var(--gray-200);
        }
        .reveal-field.visible { display: block; }

        /* ── Trainer Cards ── */
        #trainers-container { display: flex; flex-direction: column; gap: 20px; }

        .trainer-card {
            border: 1.5px solid var(--gray-200);
            border-radius: 14px;
            overflow: hidden;
            background: var(--white);
            box-shadow: var(--shadow-sm);
            animation: slideIn 0.25s ease;
        }
        @keyframes slideIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .trainer-card-header {
            padding: 14px 20px;
            background: linear-gradient(135deg, #f0f4f8, #e8eef5);
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-bottom: 1px solid var(--gray-200);
        }
        .trainer-card-title {
            display: flex;
            align-items: center;
            gap: 10px;
            font-weight: 600;
            font-size: 14px;
            color: var(--navy);
        }
        .trainer-pill {
            background: var(--navy);
            color: var(--gold-light);
            font-size: 11px;
            font-weight: 700;
            padding: 3px 10px;
            border-radius: 12px;
            letter-spacing: 0.04em;
        }
        .remove-btn {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            font-size: 12px;
            font-weight: 500;
            color: var(--gray-400);
            cursor: pointer;
            border: none;
            background: none;
            padding: 4px 8px;
            border-radius: 6px;
            transition: all 0.2s;
        }
        .remove-btn:hover { background: #fde8e6; color: var(--red); }

        .trainer-card-body { padding: 20px; }

        /* ── Trainees ── */
        .trainees-section {
            margin-top: 20px;
            padding-top: 18px;
            border-top: 1px dashed var(--gray-200);
        }
        .trainees-label {
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.06em;
            color: var(--gray-600);
            margin-bottom: 12px;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .trainees-label::after {
            content: '';
            flex: 1;
            height: 1px;
            background: var(--gray-200);
        }
        .trainee-row {
            display: flex;
            flex-direction: column;
            gap: 8px;
            margin-bottom: 12px;
            padding: 12px;
            background: var(--gray-100);
            border-radius: 10px;
            border: 1px solid var(--gray-200);
            animation: slideIn 0.2s ease;
        }
        .trainee-row-fields {
            display: grid;
            gap: 8px;
        }
        .trainee-row-fields-top { grid-template-columns: 1fr 1fr 1fr; }
        .trainee-row-fields-bottom { grid-template-columns: 1fr 1fr auto; align-items: end; }
        .remove-trainee {
            width: 32px; height: 32px;
            border-radius: 8px;
            border: 1.5px solid var(--gray-200);
            background: white;
            color: var(--gray-400);
            font-size: 16px;
            display: flex; align-items: center; justify-content: center;
            cursor: pointer;
            transition: all 0.2s;
            flex-shrink: 0;
        }
        .remove-trainee:hover { border-color: var(--red); color: var(--red); background: #fde8e6; }

        /* ── Add Trainer Button ── */
        .add-trainer-btn {
            width: 100%;
            padding: 16px;
            border: 2px dashed var(--gray-200);
            border-radius: 14px;
            background: transparent;
            color: var(--navy-light);
            font-family: 'Montserrat', sans-serif;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            margin-top: 4px;
        }
        .add-trainer-btn:hover {
            border-color: var(--gold);
            color: var(--gold);
            background: rgba(201,151,58,0.04);
        }

        /* ── Submit ── */
        .submit-area {
            text-align: center;
            padding-top: 8px;
        }
        .submit-btn {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            background: linear-gradient(135deg, var(--navy) 0%, var(--navy-light) 100%);
            color: var(--white);
            border: none;
            padding: 16px 48px;
            border-radius: 50px;
            font-family: 'Montserrat', sans-serif;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            letter-spacing: 0.02em;
            box-shadow: 0 6px 24px rgba(15,39,68,0.3);
            transition: all 0.25s;
        }
        .submit-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 32px rgba(15,39,68,0.4);
            background: linear-gradient(135deg, var(--navy-mid) 0%, var(--navy) 100%);
        }
        .submit-btn:active { transform: translateY(0); }
        .submit-note {
            font-size: 12px;
            color: var(--gray-400);
            margin-top: 12px;
        }

        /* ── Empty State ── */
        .empty-trainers {
            text-align: center;
            padding: 32px 20px;
            color: var(--gray-400);
            font-size: 14px;
        }
        .empty-trainers svg { margin-bottom: 10px; opacity: 0.4; }

        /* ── Responsive ── */
        @media (max-width: 640px) {
            .field-grid-2, .field-grid-3 { grid-template-columns: 1fr; }
            .site-header h1 { font-size: 26px; }
            .main-wrap { padding: 24px 16px 60px; }
            .section-body { padding: 20px 16px; }
            .trainee-row-fields-top, .trainee-row-fields-bottom { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>

<!-- Header -->
<header class="site-header">
    <div class="header-inner">
        <div class="header-badge">COSECSA Portal</div>
        <h1>Programme <span>Submission</span> Form</h1>
        <p>Please complete all sections below with accurate details of your hospital's trainers and trainees.</p>
    </div>
    <div class="header-divider"></div>
</header>

<!-- Main -->
<div class="main-wrap">

    {{-- Success --}}
    @if(session('success'))
    <div class="alert alert-success">
        <div class="alert-icon">✓</div>
        <div>{{ session('success') }}</div>
    </div>
    @endif

    {{-- Errors --}}
    @if($errors->any())
    <div class="alert alert-error">
        <div class="alert-icon">!</div>
        <div>
            <strong>Please fix the following:</strong>
            <ul style="margin-top:6px; padding-left:16px;">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    </div>
    @endif

    <form action="{{ route('submission.store') }}" method="POST">
        @csrf

        <!-- Section 1: Programme Director -->
        <div class="form-section">
            <div class="section-header">
                <div class="section-number">1</div>
                <div>
                    <div class="section-title">Programme Director Details</div>
                    <div class="section-subtitle">The person completing this form</div>
                </div>
            </div>
            <div class="section-body">
                <div class="field-grid field-grid-2">
                    <div class="field-group">
                        <label>Full Name</label>
                        <input type="text" name="director_name" value="{{ old('director_name') }}"
                            placeholder="e.g. Dr. Amina Osei">
                    </div>
                    <div class="field-group">
                        <label>Email Address</label>
                        <input type="email" name="director_email" value="{{ old('director_email') }}"
                            placeholder="e.g. director@hospital.org">
                    </div>
                </div>
            </div>
        </div>

        <!-- Section 2: Hospital -->
        <div class="form-section">
            <div class="section-header">
                <div class="section-number">2</div>
                <div>
                    <div class="section-title">Hospital</div>
                    <div class="section-subtitle">Select your affiliated hospital</div>
                </div>
            </div>
            <div class="section-body">
                <div class="field-group">
                    <label>Filter by Country</label>
                    <select id="country-filter" onchange="filterHospitalsByCountry(this.value)">
                        <option value="">— All countries —</option>
                        @foreach($hospitals->pluck('country')->filter()->unique()->sort()->values() as $country)
                            <option value="{{ $country }}">{{ $country }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="field-group">
                    <label>Select Hospital</label>
                    <select name="hospital_id" id="hospital-select" onchange="handleHospitalChange(this)">
                        <option value="">— Choose your hospital —</option>
                        @foreach($hospitals as $hospital)
                            <option value="{{ $hospital->id }}"
                                data-country="{{ $hospital->country }}"
                                {{ old('hospital_id') == $hospital->id ? 'selected' : '' }}>
                                {{ $hospital->name }}{{ $hospital->country ? ' — ' . $hospital->country : '' }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <!-- Section 3: Trainers & Trainees -->
        <div class="form-section">
            <div class="section-header">
                <div class="section-number">3</div>
                <div>
                    <div class="section-title">Trainers & Trainees</div>
                    <div class="section-subtitle">Add each trainer and map their trainees. A trainee can appear under multiple trainers.</div>
                </div>
            </div>
            <div class="section-body">

                <div id="trainers-container">
                    <div class="empty-trainers" id="empty-state">
                        <svg width="40" height="40" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a4 4 0 00-5-3.87M9 20H4v-2a4 4 0 015-3.87m0 0a4 4 0 118 0m-8 0A4 4 0 019 12a4 4 0 014 4"/>
                        </svg>
                        <p>No trainers added yet.<br>Click the button below to get started.</p>
                    </div>
                </div>

                <button type="button" class="add-trainer-btn" onclick="addTrainer()">
                    <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    Add Trainer
                </button>

            </div>
        </div>

        <!-- Submit -->
        <div class="submit-area">
            <button type="submit" class="submit-btn">
                <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
                Submit Form
            </button>
            <p class="submit-note">All data is saved securely and reviewed by the COSECSA team.</p>
        </div>

    </form>
</div>

<script>
    let trainerCount = 0;
    const programs = @json($programs);

    function filterHospitalsByCountry(country) {
        const hospitalSelect = document.getElementById('hospital-select');
        const current = hospitalSelect.value;
        let firstMatch = '';

        Array.from(hospitalSelect.options).forEach(opt => {
            if (opt.value === '' || opt.value === 'new') {
                opt.hidden = false;
                return;
            }
            const match = !country || opt.dataset.country === country;
            opt.hidden = !match;
            if (match && !firstMatch) firstMatch = opt.value;
        });

        // Reset selection if current choice no longer visible
        if (current && current !== 'new') {
            const currentOpt = hospitalSelect.querySelector(`option[value="${current}"]`);
            if (currentOpt && currentOpt.hidden) {
                hospitalSelect.value = '';
                handleHospitalChange(hospitalSelect);
            }
        }
    }

    function handleHospitalChange(select) {}

    function getTraineesFromTrainer(trainerIndex) {
        const container = document.getElementById(`trainees-container-${trainerIndex}`);
        if (!container) return [];
        const rows = container.querySelectorAll('.trainee-row');
        const trainees = [];
        rows.forEach(row => {
            const name        = row.querySelector('input[name*="[name]"]')?.value || '';
            const email       = row.querySelector('input[name*="[email]"]')?.value || '';
            const pen         = row.querySelector('input[name*="[pen]"]')?.value || '';
            const gender      = row.querySelector('select[name*="[gender]"]')?.value || '';
            const nationality = row.querySelector('input[name*="[nationality]"]')?.value || '';
            if (name || email) trainees.push({ name, email, pen, gender, nationality });
        });
        return trainees;
    }

    function getPreviousTrainerIndex() {
        const cards = document.querySelectorAll('.trainer-card');
        if (cards.length < 2) return null;
        // Get the second to last card's index
        const secondLast = cards[cards.length - 2];
        return secondLast ? secondLast.dataset.index : null;
    }

    function copyTraineesFromPrevious(currentIndex) {
        const prevIndex = getPreviousTrainerIndex();
        if (prevIndex === null) return;

        const trainees = getTraineesFromTrainer(prevIndex);
        if (trainees.length === 0) {
            alert('No trainees found in the previous trainer to copy.');
            return;
        }

        // Clear current trainees first
        const container = document.getElementById(`trainees-container-${currentIndex}`);
        container.innerHTML = '';

        // Copy each trainee
        trainees.forEach(trainee => {
            const traineeIndex = container.children.length;
            const html = `
            <div class="trainee-row" id="trainee-${currentIndex}-${traineeIndex}">
                <div class="trainee-row-fields trainee-row-fields-top">
                    <div class="field-group">
                        <label>Full Name</label>
                        <input type="text" name="trainers[${currentIndex}][trainees][${traineeIndex}][name]"
                            placeholder="Trainee full name" value="${escapeHtml(trainee.name)}">
                    </div>
                    <div class="field-group">
                        <label>Email Address</label>
                        <input type="email" name="trainers[${currentIndex}][trainees][${traineeIndex}][email]"
                            placeholder="Trainee email" value="${escapeHtml(trainee.email)}">
                    </div>
                    <div class="field-group">
                        <label>PEN (Programme Entry Number)</label>
                        <input type="text" name="trainers[${currentIndex}][trainees][${traineeIndex}][pen]"
                            placeholder="e.g. PEN-2024-001" value="${escapeHtml(trainee.pen)}">
                    </div>
                </div>
                <div class="trainee-row-fields trainee-row-fields-bottom">
                    <div class="field-group">
                        <label>Gender</label>
                        <select name="trainers[${currentIndex}][trainees][${traineeIndex}][gender]">
                            <option value="">— Select —</option>
                            <option value="Male" ${trainee.gender === 'Male' ? 'selected' : ''}>Male</option>
                            <option value="Female" ${trainee.gender === 'Female' ? 'selected' : ''}>Female</option>
                        </select>
                    </div>
                    <div class="field-group">
                        <label>Nationality</label>
                        <input type="text" name="trainers[${currentIndex}][trainees][${traineeIndex}][nationality]"
                            placeholder="e.g. Kenyan" value="${escapeHtml(trainee.nationality)}">
                    </div>
                    <button type="button" class="remove-trainee"
                        onclick="removeTrainee('${currentIndex}-${traineeIndex}')" title="Remove">×</button>
                </div>
            </div>`;
            container.insertAdjacentHTML('beforeend', html);
        });
    }

    function escapeHtml(str) {
        const div = document.createElement('div');
        div.appendChild(document.createTextNode(str));
        return div.innerHTML;
    }

    function addTrainer() {
        const container = document.getElementById('trainers-container');
        const emptyState = document.getElementById('empty-state');
        if (emptyState) emptyState.remove();

        const index = trainerCount++;
        const programOptions = programs.map(p =>
            `<option value="${p.id}">${p.name}</option>`
        ).join('');

        const trainerCount_display = container.querySelectorAll('.trainer-card').length + 1;
        const showCopyBtn = trainerCount_display > 1;

        const html = `
        <div class="trainer-card" id="trainer-${index}" data-index="${index}">
            <div class="trainer-card-header">
                <div class="trainer-card-title">
                    <span class="trainer-pill">Trainer ${trainerCount_display}</span>
                    <span id="trainer-label-${index}" style="color: var(--gray-600); font-weight:400; font-size:13px;">Fill in details below</span>
                </div>
                <button type="button" class="remove-btn" onclick="removeTrainer(${index})">
                    <svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                    Remove
                </button>
            </div>
            <div class="trainer-card-body">
                <div class="field-grid field-grid-3">
                    <div class="field-group">
                        <label>Trainer Name</label>
                        <input type="text" name="trainers[${index}][name]"
                            placeholder="e.g. Dr. James Mwangi"
                            oninput="updateTrainerLabel(${index}, this.value)">
                    </div>
                    <div class="field-group">
                        <label>Email Address</label>
                        <input type="email" name="trainers[${index}][email]"
                            placeholder="trainer@hospital.org">
                    </div>
                    <div class="field-group">
                        <label>Programme</label>
                        <select name="trainers[${index}][program_id]">
                            <option value="">— Select programme —</option>
                            ${programOptions}
                        </select>
                    </div>
                </div>

                <!-- Trainees -->
                <div class="trainees-section">
                    <div class="trainees-label">Trainees under this trainer</div>
                    <div id="trainees-container-${index}"></div>
                    <div style="display:flex; align-items:center; gap:16px; margin-top:8px; flex-wrap:wrap;">
                        <button type="button" class="add-link" onclick="addTrainee(${index})">
                            <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/>
                            </svg>
                            Add Trainee
                        </button>
                        ${showCopyBtn ? `
                        <button type="button" class="add-link" onclick="copyTraineesFromPrevious(${index})"
                            style="color: var(--gold); border-left: 1px solid var(--gray-200); padding-left: 16px;">
                            <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                            </svg>
                            Copy trainees from previous trainer
                        </button>` : ''}
                        <span style="font-size:11px; color: var(--gray-400);">
                            A trainee can be listed under multiple trainers
                        </span>
                    </div>
                </div>
            </div>
        </div>`;

        container.insertAdjacentHTML('beforeend', html);
    }

    function updateTrainerLabel(index, value) {
        const label = document.getElementById(`trainer-label-${index}`);
        if (label) label.textContent = value || 'Fill in details below';
    }


    function removeTrainer(index) {
        const card = document.getElementById(`trainer-${index}`);
        card.style.opacity = '0';
        card.style.transform = 'translateY(-8px)';
        card.style.transition = 'all 0.2s ease';
        setTimeout(() => {
            card.remove();
            const container = document.getElementById('trainers-container');
            if (!container.querySelector('.trainer-card')) {
                container.insertAdjacentHTML('beforeend', `
                    <div class="empty-trainers" id="empty-state">
                        <svg width="40" height="40" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a4 4 0 00-5-3.87M9 20H4v-2a4 4 0 015-3.87m0 0a4 4 0 118 0m-8 0A4 4 0 019 12a4 4 0 014 4"/>
                        </svg>
                        <p>No trainers added yet.<br>Click the button below to get started.</p>
                    </div>`);
            }
        }, 200);
    }

    function addTrainee(trainerIndex) {
        const container = document.getElementById(`trainees-container-${trainerIndex}`);
        const traineeIndex = container.children.length;

        const html = `
        <div class="trainee-row" id="trainee-${trainerIndex}-${traineeIndex}">
            <div class="trainee-row-fields trainee-row-fields-top">
                <div class="field-group">
                    <label>Full Name</label>
                    <input type="text"
                        name="trainers[${trainerIndex}][trainees][${traineeIndex}][name]"
                        placeholder="Trainee full name">
                </div>
                <div class="field-group">
                    <label>Email Address</label>
                    <input type="email"
                        name="trainers[${trainerIndex}][trainees][${traineeIndex}][email]"
                        placeholder="Trainee email">
                </div>
                <div class="field-group">
                    <label>PEN (Programme Entry Number)</label>
                    <input type="text"
                        name="trainers[${trainerIndex}][trainees][${traineeIndex}][pen]"
                        placeholder="e.g. PEN-2024-001">
                </div>
            </div>
            <div class="trainee-row-fields trainee-row-fields-bottom">
                <div class="field-group">
                    <label>Gender</label>
                    <select name="trainers[${trainerIndex}][trainees][${traineeIndex}][gender]">
                        <option value="">— Select —</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                </div>
                <div class="field-group">
                    <label>Nationality</label>
                    <input type="text"
                        name="trainers[${trainerIndex}][trainees][${traineeIndex}][nationality]"
                        placeholder="e.g. Kenyan">
                </div>
                <button type="button" class="remove-trainee"
                    onclick="removeTrainee('${trainerIndex}-${traineeIndex}')" title="Remove">×</button>
            </div>
        </div>`;

        container.insertAdjacentHTML('beforeend', html);
    }

    function removeTrainee(id) {
        const el = document.getElementById(`trainee-${id}`);
        if (el) el.remove();
    }
</script>

</body>
</html>