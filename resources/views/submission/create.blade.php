<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>COSECSA — Programme Submission</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --crimson:      #831C09;
            --crimson-dark: #6e1707;
            --crimson-mid:  #a8230b;
            --crimson-bg:   #f5e0db;
            --crimson-soft: #fdf0ed;
            --gold:         #F0C129;
            --gold-bg:      #fef8dc;
            --bg:           #F5EDE8;
            --surface:      #ffffff;
            --border:       #ecddd8;
            --border-light: #f5ede9;
            --text:         #1a0a08;
            --text-2:       #6b4a44;
            --text-3:       #b08a83;
            --red:          #c0392b;
            --red-bg:       #fde8e6;
            --green:        #1e7e4a;
            --green-bg:     #e6f4ed;
            --shadow:       0 2px 8px rgba(131,28,9,0.08), 0 1px 2px rgba(131,28,9,0.05);
            --shadow-lg:    0 4px 20px rgba(131,28,9,0.12), 0 2px 6px rgba(131,28,9,0.06);
        }

        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'Inter', sans-serif;
            background: var(--bg);
            color: var(--text);
            min-height: 100vh;
        }

        /* ── Top Bar ── */
        .topbar {
            background: var(--crimson);
            padding: 0 40px;
            height: 58px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 20;
            box-shadow: 0 2px 12px rgba(131,28,9,0.3);
        }

        .topbar-brand {
            display: flex;
            align-items: center;
            gap: 10px;
            text-decoration: none;
        }

        .topbar-logo {
            display: flex;
            align-items: center;
        }

        .topbar-name {
            font-size: 15px;
            font-weight: 700;
            color: #fff;
            letter-spacing: -0.2px;
        }

        .topbar-name span {
            color: var(--gold);
        }

        .topbar-tag {
            font-size: 12px;
            color: rgba(255,255,255,0.55);
            font-weight: 400;
        }

        /* ── Gold accent bar under topbar ── */
        .gold-bar {
            height: 3px;
            background: linear-gradient(90deg, var(--gold) 0%, #f5d96a 40%, transparent 100%);
        }

        /* ── Main ── */
        .main-wrap {
            max-width: 820px;
            margin: 0 auto;
            padding: 36px 24px 80px;
        }

        .page-heading {
            margin-bottom: 28px;
        }

        .page-heading h1 {
            font-size: 20px;
            font-weight: 700;
            color: var(--text);
            letter-spacing: -0.3px;
        }

        .page-heading p {
            font-size: 13.5px;
            color: var(--text-2);
            margin-top: 4px;
            line-height: 1.5;
        }

        /* ── Alerts ── */
        .alert {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            padding: 14px 18px;
            border-radius: 14px;
            font-size: 13.5px;
            margin-bottom: 20px;
            border: 1px solid transparent;
        }

        .alert-success {
            background: var(--green-bg);
            border-color: #b7dfca;
            color: var(--green);
        }

        .alert-error {
            background: var(--red-bg);
            border-color: #f5c6c3;
            color: var(--red);
        }

        .alert-icon {
            width: 20px;
            height: 20px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 11px;
            font-weight: 700;
            flex-shrink: 0;
            margin-top: 1px;
        }

        .alert-success .alert-icon { background: var(--green); color: #fff; }
        .alert-error .alert-icon   { background: var(--red);   color: #fff; }

        /* ── Section Cards ── */
        .form-section {
            background: var(--surface);
            border-radius: 18px;
            border: 1px solid var(--border);
            margin-bottom: 16px;
            overflow: hidden;
            box-shadow: var(--shadow);
        }

        .section-header {
            padding: 16px 24px;
            border-bottom: 1px solid var(--border-light);
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .section-number {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            background: var(--crimson);
            color: var(--gold);
            font-size: 13px;
            font-weight: 700;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            box-shadow: 0 2px 8px rgba(131,28,9,0.3);
        }

        .section-title {
            font-size: 14px;
            font-weight: 700;
            color: var(--text);
            letter-spacing: -0.1px;
        }

        .section-subtitle {
            font-size: 11.5px;
            color: var(--text-3);
            margin-top: 2px;
        }

        .section-body { padding: 22px 24px; }

        /* ── Form Fields ── */
        .field-grid {
            display: grid;
            gap: 14px;
        }

        .field-grid-2 { grid-template-columns: 1fr 1fr; }
        .field-grid-3 { grid-template-columns: 1fr 1fr 1fr; }

        .field-group {
            display: flex;
            flex-direction: column;
            gap: 6px;
        }

        label {
            font-size: 11.5px;
            font-weight: 600;
            color: var(--text-2);
            letter-spacing: 0.01em;
        }

        input[type="text"],
        input[type="email"],
        select,
        textarea {
            width: 100%;
            padding: 10px 13px;
            border: 1.5px solid var(--border);
            border-radius: 10px;
            font-family: 'Inter', sans-serif;
            font-size: 13.5px;
            color: var(--text);
            background: var(--surface);
            transition: border-color 0.15s, box-shadow 0.15s;
            outline: none;
            appearance: none;
        }

        input:focus, select:focus, textarea:focus {
            border-color: var(--crimson);
            box-shadow: 0 0 0 3px rgba(131,28,9,0.1);
        }

        input::placeholder, textarea::placeholder {
            color: #d4b8b3;
        }

        select {
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='8' viewBox='0 0 12 8'%3E%3Cpath fill='%23b08a83' d='M6 8L0 0h12z'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 12px center;
            padding-right: 36px;
            cursor: pointer;
        }

        /* ── Add link ── */
        .add-link {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            font-size: 13px;
            font-weight: 600;
            color: var(--crimson);
            cursor: pointer;
            padding: 6px 0;
            border: none;
            background: none;
            transition: color 0.15s, gap 0.15s;
            font-family: 'Inter', sans-serif;
        }

        .add-link:hover { color: var(--crimson-dark); gap: 8px; }

        /* ── Trainer Cards ── */
        #trainers-container { display: flex; flex-direction: column; gap: 14px; }

        .trainer-card {
            border: 1.5px solid var(--border);
            border-radius: 14px;
            overflow: hidden;
            background: var(--surface);
            animation: slideIn 0.22s ease;
            box-shadow: 0 1px 4px rgba(131,28,9,0.06);
        }

        @keyframes slideIn {
            from { opacity: 0; transform: translateY(-8px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        .trainer-card-header {
            padding: 11px 18px;
            background: var(--crimson-soft);
            border-bottom: 1.5px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .trainer-card-title {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 13px;
            font-weight: 600;
            color: var(--text);
        }

        .trainer-chip {
            background: var(--crimson);
            color: var(--gold);
            font-size: 10.5px;
            font-weight: 700;
            padding: 2px 10px;
            border-radius: 20px;
            letter-spacing: 0.03em;
        }

        .remove-btn {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            font-size: 12px;
            font-weight: 500;
            color: var(--text-3);
            cursor: pointer;
            border: none;
            background: none;
            padding: 5px 9px;
            border-radius: 8px;
            transition: all 0.15s;
            font-family: 'Inter', sans-serif;
        }

        .remove-btn:hover { background: var(--red-bg); color: var(--red); }

        .trainer-card-body { padding: 18px 20px; }

        /* ── Trainees ── */
        .trainees-section {
            margin-top: 18px;
            padding-top: 16px;
            border-top: 1.5px dashed var(--border);
        }

        .trainees-label {
            font-size: 10.5px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            color: var(--text-3);
            margin-bottom: 12px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .trainees-label::after {
            content: '';
            flex: 1;
            height: 1px;
            background: var(--border-light);
        }

        .trainee-row {
            display: flex;
            flex-direction: column;
            gap: 8px;
            margin-bottom: 10px;
            padding: 12px;
            background: var(--crimson-soft);
            border-radius: 10px;
            border: 1px solid var(--border);
            animation: slideIn 0.2s ease;
        }

        .trainee-row-fields { display: grid; gap: 8px; }
        .trainee-row-fields-top    { grid-template-columns: 1fr 1fr 1fr; }
        .trainee-row-fields-bottom { grid-template-columns: 1fr 1fr auto; align-items: end; }

        .remove-trainee {
            width: 32px;
            height: 32px;
            border-radius: 8px;
            border: 1.5px solid var(--border);
            background: var(--surface);
            color: var(--text-3);
            font-size: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.15s;
            flex-shrink: 0;
        }

        .remove-trainee:hover { border-color: var(--red); color: var(--red); background: var(--red-bg); }

        /* ── Add Trainer Button ── */
        .add-trainer-btn {
            width: 100%;
            padding: 14px;
            border: 2px dashed var(--border);
            border-radius: 14px;
            background: transparent;
            color: var(--crimson);
            font-family: 'Inter', sans-serif;
            font-size: 13.5px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.18s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            margin-top: 4px;
        }

        .add-trainer-btn:hover {
            border-color: var(--crimson);
            background: var(--crimson-soft);
        }

        /* ── Submit Bar ── */
        .submit-bar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: var(--surface);
            border-radius: 18px;
            border: 1px solid var(--border);
            padding: 18px 24px;
            box-shadow: var(--shadow);
        }

        .submit-note {
            font-size: 13px;
            color: var(--text-3);
            max-width: 340px;
            line-height: 1.5;
        }

        .submit-btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: var(--crimson);
            color: #fff;
            border: none;
            padding: 0 32px;
            height: 46px;
            border-radius: 12px;
            font-family: 'Inter', sans-serif;
            font-size: 14px;
            font-weight: 700;
            cursor: pointer;
            box-shadow: 0 3px 12px rgba(131,28,9,0.35);
            transition: all 0.18s;
            white-space: nowrap;
            letter-spacing: -0.1px;
        }

        .submit-btn:hover {
            background: var(--crimson-dark);
            box-shadow: 0 6px 20px rgba(131,28,9,0.45);
            transform: translateY(-1px);
        }

        .submit-btn:active { transform: translateY(0); }

        /* ── Empty State ── */
        .empty-trainers {
            text-align: center;
            padding: 40px 20px;
            color: var(--text-3);
            font-size: 13.5px;
            line-height: 1.6;
        }

        .empty-trainers svg { margin-bottom: 10px; opacity: 0.35; }

        /* ── Responsive ── */
        @media (max-width: 700px) {
            .field-grid-2, .field-grid-3 { grid-template-columns: 1fr; }
            .main-wrap { padding: 20px 14px 60px; }
            .section-body { padding: 16px; }
            .trainee-row-fields-top,
            .trainee-row-fields-bottom { grid-template-columns: 1fr; }
            .submit-bar { flex-direction: column; gap: 14px; align-items: stretch; }
            .submit-btn { justify-content: center; }
            .topbar { padding: 0 16px; }
        }
    </style>
</head>
<body>

<!-- Top Bar -->
<header class="topbar">
    <a href="{{ url('/') }}" class="topbar-brand">
        <div class="topbar-logo">
            <img src="{{ asset('images/Cosecsa Logo.png') }}" alt="COSECSA" style="height:32px;width:auto;object-fit:contain;">
        </div>
        <span class="topbar-name">COSECSA <span>Forms</span></span>
    </a>
    <span class="topbar-tag">Programme Submission Form</span>
</header>
<div class="gold-bar"></div>

<!-- Main -->
<div class="main-wrap">

    <div class="page-heading">
        <h1>Programme Submission Form</h1>
        <p>Complete all sections with accurate details for your hospital's trainers and trainees.</p>
    </div>

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
            <ul style="margin-top:6px; padding-left:18px; line-height:1.8;">
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
                <div class="field-grid field-grid-2" style="margin-bottom:14px;">
                    <div class="field-group">
                        <label>Filter by Country</label>
                        <select id="country-filter" onchange="filterHospitalsByCountry(this.value)">
                            <option value="">All countries</option>
                            @foreach($hospitals->pluck('country')->filter()->unique()->sort()->values() as $country)
                                <option value="{{ $country }}">{{ $country }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="field-group">
                    <label>Select Hospital</label>
                    <select name="hospital_id" id="hospital-select" onchange="handleHospitalChange(this)">
                        <option value="">Choose your hospital</option>
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
                    <div class="section-title">Trainers &amp; Trainees</div>
                    <div class="section-subtitle">Add each trainer and their trainees. A trainee can appear under multiple trainers.</div>
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
                    <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
                    </svg>
                    Add Trainer
                </button>

            </div>
        </div>

        <!-- Submit -->
        <div class="submit-bar">
            <p class="submit-note">
                Your data is saved securely and reviewed by the COSECSA team.
            </p>
            <button type="submit" class="submit-btn">
                <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                </svg>
                Submit Form
            </button>
        </div>

    </form>
</div>

<script>
    let trainerCount = 0;
    const programs = @json($programs);

    function filterHospitalsByCountry(country) {
        const hospitalSelect = document.getElementById('hospital-select');
        const current = hospitalSelect.value;
        Array.from(hospitalSelect.options).forEach(opt => {
            if (opt.value === '') { opt.hidden = false; return; }
            const match = !country || opt.dataset.country === country;
            opt.hidden = !match;
        });
        if (current) {
            const currentOpt = hospitalSelect.querySelector(`option[value="${current}"]`);
            if (currentOpt && currentOpt.hidden) {
                hospitalSelect.value = '';
                handleHospitalChange(hospitalSelect);
            }
        }
    }

    function handleHospitalChange(select) {}

    function escapeHtml(str) {
        const div = document.createElement('div');
        div.appendChild(document.createTextNode(str || ''));
        return div.innerHTML;
    }

    function getTraineesFromTrainer(trainerIndex) {
        const container = document.getElementById(`trainees-container-${trainerIndex}`);
        if (!container) return [];
        const trainees = [];
        container.querySelectorAll('.trainee-row').forEach(row => {
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
        return cards[cards.length - 2]?.dataset.index || null;
    }

    function copyTraineesFromPrevious(currentIndex) {
        const prevIndex = getPreviousTrainerIndex();
        if (prevIndex === null) return;
        const trainees = getTraineesFromTrainer(prevIndex);
        if (!trainees.length) { alert('No trainees found in the previous trainer to copy.'); return; }
        const container = document.getElementById(`trainees-container-${currentIndex}`);
        container.innerHTML = '';
        trainees.forEach(t => {
            container.insertAdjacentHTML('beforeend', buildTraineeRow(currentIndex, container.children.length, t));
        });
    }

    function buildTraineeRow(trainerIndex, traineeIndex, t = {}) {
        return `
        <div class="trainee-row" id="trainee-${trainerIndex}-${traineeIndex}">
            <div class="trainee-row-fields trainee-row-fields-top">
                <div class="field-group">
                    <label>Full Name</label>
                    <input type="text" name="trainers[${trainerIndex}][trainees][${traineeIndex}][name]"
                        placeholder="Trainee full name" value="${escapeHtml(t.name)}">
                </div>
                <div class="field-group">
                    <label>Email Address</label>
                    <input type="email" name="trainers[${trainerIndex}][trainees][${traineeIndex}][email]"
                        placeholder="Trainee email" value="${escapeHtml(t.email)}">
                </div>
                <div class="field-group">
                    <label>PEN (Programme Entry Number)</label>
                    <input type="text" name="trainers[${trainerIndex}][trainees][${traineeIndex}][pen]"
                        placeholder="e.g. PEN-2024-001" value="${escapeHtml(t.pen)}">
                </div>
            </div>
            <div class="trainee-row-fields trainee-row-fields-bottom">
                <div class="field-group">
                    <label>Gender</label>
                    <select name="trainers[${trainerIndex}][trainees][${traineeIndex}][gender]">
                        <option value="">Select</option>
                        <option value="Male" ${(t.gender||'')==='Male'?'selected':''}>Male</option>
                        <option value="Female" ${(t.gender||'')==='Female'?'selected':''}>Female</option>
                    </select>
                </div>
                <div class="field-group">
                    <label>Nationality</label>
                    <input type="text" name="trainers[${trainerIndex}][trainees][${traineeIndex}][nationality]"
                        placeholder="e.g. Kenyan" value="${escapeHtml(t.nationality)}">
                </div>
                <button type="button" class="remove-trainee"
                    onclick="removeTrainee('${trainerIndex}-${traineeIndex}')" title="Remove">×</button>
            </div>
        </div>`;
    }

    function addTrainer() {
        const container = document.getElementById('trainers-container');
        const emptyState = document.getElementById('empty-state');
        if (emptyState) emptyState.remove();

        const index = trainerCount++;
        const programOptions = programs.map(p => `<option value="${p.id}">${escapeHtml(p.name)}</option>`).join('');
        const trainerNum = container.querySelectorAll('.trainer-card').length + 1;
        const showCopy  = trainerNum > 1;

        container.insertAdjacentHTML('beforeend', `
        <div class="trainer-card" id="trainer-${index}" data-index="${index}">
            <div class="trainer-card-header">
                <div class="trainer-card-title">
                    <span class="trainer-chip">Trainer ${trainerNum}</span>
                    <span id="trainer-label-${index}" style="color:#b08a83;font-weight:400;font-size:12.5px;">Fill in details below</span>
                </div>
                <button type="button" class="remove-btn" onclick="removeTrainer(${index})">
                    <svg width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
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
                            <option value="">Select programme</option>
                            ${programOptions}
                        </select>
                    </div>
                </div>

                <div class="trainees-section">
                    <div class="trainees-label">Trainees under this trainer</div>
                    <div id="trainees-container-${index}"></div>
                    <div style="display:flex;align-items:center;gap:20px;margin-top:8px;flex-wrap:wrap;">
                        <button type="button" class="add-link" onclick="addTrainee(${index})">
                            <svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
                            </svg>
                            Add Trainee
                        </button>
                        ${showCopy ? `
                        <button type="button" class="add-link" onclick="copyTraineesFromPrevious(${index})"
                            style="border-left:1px solid #ecddd8;padding-left:20px;color:#b08a00;">
                            <svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                            </svg>
                            Copy from previous trainer
                        </button>` : ''}
                        <span style="font-size:11.5px;color:#b08a83;">A trainee can be listed under multiple trainers</span>
                    </div>
                </div>
            </div>
        </div>`);
    }

    function updateTrainerLabel(index, value) {
        const el = document.getElementById(`trainer-label-${index}`);
        if (el) el.textContent = value || 'Fill in details below';
    }

    function removeTrainer(index) {
        const card = document.getElementById(`trainer-${index}`);
        card.style.opacity = '0';
        card.style.transform = 'translateY(-6px)';
        card.style.transition = 'all 0.18s ease';
        setTimeout(() => {
            card.remove();
            const container = document.getElementById('trainers-container');
            if (!container.querySelector('.trainer-card')) {
                container.insertAdjacentHTML('beforeend', `
                    <div class="empty-trainers" id="empty-state">
                        <svg width="40" height="40" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M17 20h5v-2a4 4 0 00-5-3.87M9 20H4v-2a4 4 0 015-3.87m0 0a4 4 0 118 0m-8 0A4 4 0 019 12a4 4 0 014 4"/>
                        </svg>
                        <p>No trainers added yet.<br>Click the button below to get started.</p>
                    </div>`);
            }
        }, 180);
    }

    function addTrainee(trainerIndex) {
        const container = document.getElementById(`trainees-container-${trainerIndex}`);
        container.insertAdjacentHTML('beforeend', buildTraineeRow(trainerIndex, container.children.length));
    }

    function removeTrainee(id) {
        const el = document.getElementById(`trainee-${id}`);
        if (el) el.remove();
    }
</script>
</body>
</html>
