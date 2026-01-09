@extends('layouts.app')

@section('content')

    <form action="" method="">
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
            <option value="-1" {{ old('gender_id', '-1') == '-1' ? 'selected' : '' }}>
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
            <option value="-1" {{ old('race_id', '-1') == '-1' ? 'selected' : '' }}>
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
                    <input type="radio" name="bumi" value="0" {{ old('bumi') === '0' ? 'checked' : '' }}>
                    <span>Yes</span>
                </label>

                <label class="radio-card">
                    <input type="radio" name="bumi" value="1" {{ old('bumi') === '1' ? 'checked' : '' }}>
                    <span>No</span>
                </label>
            </div>
        
        <!--nationality-->
        <label for="nationality_id">Are you a Malaysian?</label>

        <div class="radio-cards">
            <label class="radio-card">
                <input type="radio" name="nationality" value="0" {{ old('nationality') === '0' ? 'checked' : '' }}>
                <span>Yes</span>
            </label>

            <label class="radio-card">
                <input type="radio" name="nationality" value="1" {{ old('nationality') === '1' ? 'checked' : '' }}>
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
            <option value="-1" {{ old('state_id', '-1') == '-1' ? 'selected' : '' }}>
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
            <option value="-1" {{ old('qualification_id', '-1') == '-1' ? 'selected' : '' }}>
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
            <option value="-1" {{ old('institution_id', '-1') == '-1' ? 'selected' : '' }}>
                Type of Institution
            </option>

            @foreach($institutes as $institute)
                <option value="{{ $institute->id }}"
                    {{ (string) old('institute_id') === (string) $institute->id ? 'selected' : '' }}>
                    {{ $institute->institution }}
                </option>
            @endforeach
        </select>

        <!-- institute name -->
        <label for="institute_name">Institute Name:</label>
        <input 
            type="input" 
            id="institute" 
            name="institute" 
            value="{{ old('institute') }}" 
            required
        > 

        <!-- select an option -->
        <label for="option_id">Options:</label>
            <select id="option_id" name="option_id" required>
                <option value="-1" {{ old('option_id', '-1') == '-1' ? 'selected' : '' }}>
                    Select a course
                </option>

                @foreach($options as $option)
                    <option value="{{ $option->id }}"
                        {{ (string) old('option_id') === (string) $option->id ? 'selected' : '' }}>
                        {{ $option->option }}
                    </option>
                @endforeach
            </select>

<div style="margin-top: 15px;">
        <button type="submit" class="btn-primary">Submit</button>
</div>
        <!-- validation errors -->
    </form>
@endsection