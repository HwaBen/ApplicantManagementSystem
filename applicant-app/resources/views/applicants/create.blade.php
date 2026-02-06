@extends('layouts.app')

@section('content')

    <form action="{{ route('applicants.store') }}" method="POST">
        @csrf

        <h2>Applicant Form</h2>

        <!-- Name -->
        <label for="name"> Name:</label>
        <input 
            type="text" 
            id="name" 
            name="name"
            value="{{ old('name') }}" 
            required
        >

        <!-- email -->
        <label for="email">Email:</label>
        <input
            id="email" 
            name="email" 
            value="{{ old('email') }}"
            required
        >

        <!-- mobile -->
        <label for="mobile">Phone Number:</label>
        <input
            id="mobile" 
            name="mobile" 
            value="{{ old('mobile') }}"
            required
        >

        <!-- IC -->
        <label for="ic_num">IC Number:</label>
        <input
            id="ic_num" 
            name="ic_num" 
            value="{{ old('ic_num') }}"
            required
        >

        <!-- age -->
        <label for="Age"> Age :</label>
        <input 
            type="number" 
            id="age" 
            name="age" 
            value="{{ old('age') }}"
            required
        >

        <!-- birthdate -->
        <label for="birth_date">Birthdate:</label>
        <input 
            type="date" 
            id="birth_date" 
            name="birth_date" 
            value="{{ old('birth_date') }}" 
            required
        > 

        <!-- select gender -->
        <label for="gender_id">Gender:</label>
        <select id="gender_id" name="gender_id" required>
            <option value="-1" disabled {{ old('gender_id', '-1') == '-1' ? 'selected' : '' }}>
                Select Gender
            </option>

            @foreach($genders as $gender)
                <option value="{{ $gender->id }}"
                    {{ (string) old('gender_id') === (string) $gender->id ? 'selected' : '' }}>
                    {{ $gender->gender }}
                </option>
            @endforeach
        </select>
        
        <!-- select race -->
        <label for="race_id">Race:</label>
        <select id="race_id" name="race_id" required>
            <option value="-1" disabled {{ old('race_id', '-1') == '-1' ? 'selected' : '' }}>
                Select Race
            </option>

            @foreach($races as $race)
                <option value="{{ $race->id }}"
                    {{ (string) old('race_id') === (string) $race->id ? 'selected' : '' }}>
                    {{ $race->race }}
                </option>
            @endforeach
        </select>

        <!-- bumiputera -->
        <label for="bumi_id">Are you Bumiputera?</label>

            <div class="radio-cards">
                <label class="radio-card">
                    <input type="radio" name="bumi_id" value="0" {{ old('bumi_id') === '0' ? 'checked' : '' }}>
                    <span>Yes</span>
                </label>

                <label class="radio-card">
                    <input type="radio" name="bumi_id" value="1" {{ old('bumi_id') === '1' ? 'checked' : '' }}>
                    <span>No</span>
                </label>
            </div>
        
        <!--nationality-->
        <label for="nationality_id">Are you a Malaysian?</label>

        <div class="radio-cards">
            <label class="radio-card">
                <input type="radio" name="nationality_id" value="0" {{ old('nationality_id') === '0' ? 'checked' : '' }}>
                <span>Yes</span>
            </label>

            <label class="radio-card">
                <input type="radio" name="nationality_id" value="1" {{ old('nationality_id') === '1' ? 'checked' : '' }}>
                <span>No</span>
            </label>
        </div>
        
         <!-- address -->
        <label for="address">Address:</label>
        <textarea
            rows="5"
            id="address" 
            name="address" 
            required
        >{{ old('address') }}</textarea>

        <!-- poskod -->
        <label for="pos">City:</label>
        <input 
            type="input" 
            id="pos" 
            name="pos" 
            value="{{ old('pos') }}" 
            required
        > 

        <!-- city -->
        <label for="city">Postcode:</label>
        <input 
            type="input" 
            id="city" 
            name="city" 
            value="{{ old('city') }}" 
            required
        > 

        <!-- state -->
        <label for="state_id">State:</label>
        <select id="state_id" name="state_id" required>
            <option value="-1" disabled {{ old('state_id', '-1') == '-1' ? 'selected' : '' }}>
                Select State
            </option>

            @foreach($states as $state)
                <option value="{{ $state->id }}"
                    {{ (string) old('state_id') === (string) $state->id ? 'selected' : '' }}>
                    {{ $state->state }}
                </option>
            @endforeach
        </select>

        <!-- qualification -->
        <label for="qualification_id">Your Academic Qualification :</label>
        <select id="qualification_id" name="qualification_id" required>
            <option value="-1" disabled {{ old('qualification_id', '-1') == '-1' ? 'selected' : '' }}>
                Academic Qualification
            </option>

            @foreach($qualifications as $qualification)
                <option value="{{ $qualification->id }}"
                    {{ (string) old('qualification_id') === (string) $qualification->id ? 'selected' : '' }}>
                    {{ $qualification->qualification }}
                </option>
            @endforeach
        </select>

        <!--institution type -->
        <label for="institution_id">Type of Institution :</label>
        <select id="institution_id" name="institution_id" required>
            <option value="-1" disabled {{ old('institution_id', '-1') == '-1' ? 'selected' : '' }}>
                Type of Institution
            </option>

            @foreach($institutes as $institute)
                <option value="{{ $institute->id }}"
                    {{ (string) old('institution_id') === (string) $institute->id ? 'selected' : '' }}>
                    {{ $institute->institution }}
                </option>
            @endforeach
        </select>

        <!-- institute name -->
        <label for="institute_name">Institute Name:</label>
        <input 
            type="input" 
            id="institute_name" 
            name="institute_name" 
            value="{{ old('institute_name') }}" 
            required
        > 

        <!-- field -->
        <label for="field">Field of Study:</label>
        <input 
            type="input" 
            id="field" 
            name="field" 
            value="{{ old('field') }}" 
            required
        >

        <!-- grad year -->
        <label for="grad_year">Graduation Year:</label>
        <input 
            type="input" 
            id="grad_year" 
            name="grad_year" 
            value="{{ old('grad_year') }}" 
            required
        >

        <!--computer availability-->
        <label for="computer_availability">Do you have a laptop available?</label>

        <div class="radio-cards">
            <label class="radio-card">
                <input type="radio" name="computer_availability" value="0" {{ old('computer_availability') === '0' ? 'checked' : '' }}>
                <span>Yes</span>
            </label>

            <label class="radio-card">
                <input type="radio" name="computer_availability" value="1" {{ old('computer_availability') === '1' ? 'checked' : '' }}>
                <span>No</span>
            </label>
        </div>

        <!--employment status-->
        <label for="employ_status_id">Your Current Employment Status:</label>
        <select id="employ_status_id" name="employ_status_id" required>
            <option value="-1" disabled {{ old('employ_status_id', '-1') == '-1' ? 'selected' : '' }}>
                Employment Status
            </option>

            @foreach($employStatuses as $employStatus)
                <option value="{{ $employStatus->id }}"
                    {{ (string) old('employ_status_id') === (string) $employStatus->id ? 'selected' : '' }}>
                    {{ $employStatus->employ_status }}
                </option>
            @endforeach
        </select>

        <!--unemployed duration-->
        <div id="unemployed-section" style="display: none;">
        <label for="unemploy_duration_id">Unemployed Duration:</label>
        <select id="unemploy_duration_id" name="unemploy_duration_id">
            <option value="-1" disabled selected>
                Unemployed Duration
            </option>

            @foreach($unemployDurations as $unemployDuration)
            @if($unemployDuration->id != 6)
                <option value="{{ $unemployDuration->id }}"
                    {{ old('unemploy_duration_id') == $unemployDuration->id ? 'selected' : '' }}>
                    {{ $unemployDuration->unemploy_duration }}
                </option>
            @endif
            @endforeach
        </select>
        </div>   

        <!--bantuan recipient-->
        <label for="recepient_bantuan_id">Are you a reciepient of any Government Bantuan?:</label>

        <div class="radio-cards">
            <label class="radio-card">
                <input type="radio" name="recepient_bantuan_id" value="0" {{ old('recepient_bantuan_id') === '0' ? 'checked' : '' }}>
                <span>Yes</span>
            </label>

            <label class="radio-card">
                <input type="radio" name="recepient_bantuan_id" value="1" {{ old('recepient_bantuan_id') === '1' ? 'checked' : '' }}>
                <span>No</span>
            </label>
        </div>

        <!-- household number -->
        <label for="household_num"> Household Number :</label>
        <input 
            type="number" 
            id="household_num" 
            name="household_num" 
            value="{{ old('household_num') }}"
            required
        >              

        <!-- income -->
       <label for="income_id">Current Income:</label>
            <select id="income_id" name="income_id" required>
                <option value="-1" disabled {{ old('income_id', '-1') == '-1' ? 'selected' : '' }}>
                    Income
                </option>

                @foreach($incomes as $income)
                    <option value="{{ $income->id }}"
                        {{ (string) old('income_id') === (string) $income->id ? 'selected' : '' }}>
                        {{ $income->income }}
                    </option>
                @endforeach
            </select>

        <!-- option 1 -->
        <label for="option_1_id">Option 1:</label>
            <select id="option_1_id" name="option_1_id" required>
                <option value="-1" disabled {{ old('option_1_id', '-1') == '-1' ? 'selected' : '' }}>
                    Select a course
                </option>

                @foreach($options as $option)
                    <option value="{{ $option->id }}"
                        {{ (string) old('option_1_id') === (string) $option->id ? 'selected' : '' }}>
                        {{ $option->option }}
                    </option>
                @endforeach
            </select>

        <!-- option 2 -->
        <label for="option_2_id">Option 2:</label>
            <select id="option_2_id" name="option_2_id" required>
                <option value="-1" disabled {{ old('option_2_id', '-1') == '-1' ? 'selected' : '' }}>
                    Select a course
                </option>

                @foreach($options as $option)
                    <option value="{{ $option->id }}"
                        {{ (string) old('option_2_id') === (string) $option->id ? 'selected' : '' }}>
                        {{ $option->option }}
                    </option>
                @endforeach
            </select>

        <!-- option 3 -->
        <label for="option_3_id">Option 3:</label>
            <select id="option_3_id" name="option_3_id" required>
                <option value="-1" disabled {{ old('option_3_id', '-1') == '-1' ? 'selected' : '' }}>
                    Select a course
                </option>

                @foreach($options as $option)
                    <option value="{{ $option->id }}"
                        {{ (string) old('option_3_id') === (string) $option->id ? 'selected' : '' }}>
                        {{ $option->option }}
                    </option>
                @endforeach
            </select>

        <label for="other_programme">Have you participated in other similar programmes?:</label>

        <div class="radio-cards">
            <label class="radio-card">
                <input type="radio" name="other_programme" value="0" {{ old('other_programme') === '0' ? 'checked' : '' }}>
                <span>Yes</span>
            </label>

            <label class="radio-card">
                <input type="radio" name="other_programme" value="1" {{ old('other_programme') === '1' ? 'checked' : '' }}>
                <span>No</span>
            </label>
        </div> 

        <div id="programme-name-section" style="display: none;">
            <label for="other_programme_name">Please specify the programme name:</label>
            <input 
                type="text" 
                id="other_programme_name" 
                name="other_programme_name" 
                value="{{ old('other_programme_name') }}"
                placeholder="Enter programme name">
        </div>

        <!-- exposure -->
        <label for="exposure_id">Where do you heard about us:</label>
        <input 
            type="input" 
            id="exposure_id" 
            name="exposure_id" 
            value="{{ old('exposure_id') }}" 
            required
        >    

        <label for="agree">By checking this box, you agree to the terms of our Privacy Notice *The information provided will be shared between the participating organizations for the purpose of K-Youth Development Programmes only:</label>

        <div class="mt-4">
            <label class="flex items-center">
                <input 
                    type="checkbox" 
                    name="agree" 
                    value="Yes"
                    class="big-checkbox"
                    {{ old('agree') ? 'checked' : '' }}
                    required
                >
            </label>
        </div>                               

<div style="margin-top: 15px;">
        <button type="submit" class="btn-primary">Submit</button>
</div>
    
    <!-- validation errors -->
    @if ($errors->any())
      <ul class="px-4 py-2 bg-red-100">
        @foreach ($errors->all() as $error)
          <li class="my-2 text-red-500">{{ $error }}</li>
         @endforeach
      </ul>
    @endif  
    
    </form>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const statusSelect = document.getElementById('employ_status_id');
    const unemployedSection = document.getElementById('unemployed-section');
    const radios = document.querySelectorAll('input[name="other_programme"]');
    const programmeSection = document.getElementById('programme-name-section');
    const programmeInput = document.getElementById('other_programme_name');
    const unemployDurationSelect = document.getElementById('unemploy_duration_id');

    const UNEMPLOYED_ID = "7"; // <-- change to the actual ID of "Unemployed"
    const DEFAULT_DURATION_ID = "6";

function toggleUnemployedSection() { 
    if (statusSelect.value === UNEMPLOYED_ID) { 
        unemployedSection.style.display = 'block';
        unemployDurationSelect.disabled = false;
        unemployDurationSelect.value = "-1"; 
    } 
    else { 
        unemployedSection.style.display = 'none';
        unemployDurationSelect.value = DEFAULT_DURATION_ID;
        unemployDurationSelect.disabled = true;

 
    } 
    }
    function toggleProgrammeField() {
    const selected = document.querySelector('input[name="other_programme"]:checked');

        if (selected && selected.value === "0") {
            // "No" selected → show textbox
            programmeSection.style.display = 'block';
            programmeInput.required = true;
        } else {
            // "Yes" or nothing selected → hide textbox
            programmeSection.style.display = 'none';
            programmeInput.required = false;
            programmeInput.value = '';
        }
    }

    // Run on page load (for old() values)
    toggleUnemployedSection();

    // Run when selection changes
    statusSelect.addEventListener('change', toggleUnemployedSection);

    // Run on page load (for old() values)
    toggleProgrammeField();

    // Run when radio changes
    radios.forEach(radio => {
        radio.addEventListener('change', toggleProgrammeField);
    });

});
</script>

@endsection
