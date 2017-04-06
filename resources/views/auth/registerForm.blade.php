<h4 class="title is-4">Account</h4>

<div class="columns">
    <div class="column is-one-third">
        @include('partials.textInput', ['name' => 'email', 'label' => 'E-Mail', 'value' => $user->email, 'required' => true])
    </div>
</div>
<div class="columns">
    <div class="column is-one-third">
        @include('partials.passwdInput', ['name' => 'password', 'label' => 'Password', 'required' => true])
    </div>
    <div class="column is-one-third">
        @include('partials.passwdInput', ['name' => 'password_confirmation', 'label' => 'Confirm Password', 'required' => true])
    </div>
</div>

<br>

<h4 class="title is-4">Contact</h4>
<div class="columns">
    <div class="column is-one-third">
        @include('partials.textInput', ['name' => 'first_name', 'label' => 'First Name', 'value' => $user->first_name, 'required' => true])
    </div>
    <div class="column is-one-third">
        @include('partials.textInput', ['name' => 'last_name', 'label' => 'Last Name', 'value' => $user->last_name, 'required' => true])
    </div>
</div>
<div class="columns">
    <div class="column is-one-third">
        @include('partials.textInput', ['name' => 'address1', 'label' => 'Address', 'value' => $user->address1])
    </div>
    <div class="column is-one-third">
        @include('partials.textInput', ['name' => 'address2', 'label' => 'Address (cont)', 'value' => $user->address2])
    </div>
</div>
<div class="columns">
    <div class="column">
        @include('partials.textInput', ['name' => 'city', 'label' => 'City', 'value' => $user->city])
    </div>
    <div class="column">
        @include('partials.selectInput', ['name' => 'state', 'label' => 'State', 'values' => config('custom.states'), 'value' => $user->state])
    </div>
    <div class="column">
        @include('partials.textInput', ['name' => 'zip', 'label' => 'Postal Code', 'value' => $user->zip])
    </div>
    <div class="column">
        @include('partials.textInput', ['name' => 'phone', 'label' => 'Phone', 'value' => $user->phone])
    </div>
</div>

<br>

<h4 class="title is-4">Additional Information</h4>
<div class="columns">
    <div class="column is-3">
        @include('partials.textInput', ['name' => 'grad_year', 'label' => 'Graduation Year', 'value' => $user->grad_year])
    </div>
    <div class="column is-3">
        @include('partials.textInput', ['name' => 'roll_number', 'label' => 'Roll Book No.', 'value' => $user->roll_book])
    </div>
    <div class="column">
        @include('partials.textInput', ['name' => 'employer', 'label' => 'Employer', 'value' => $user->employer])
    </div>
</div>
<div class="columns">
    <div class="column">
        @include('partials.checkboxInput', ['name' => 'subscribed', 'label' => 'Subscribe to alumni e-mails from this site', 'value' => $user->subscribed])
    </div>
</div>