<h4 class="title is-4">Account</h4>

<div class="columns">
    <div class="column is-one-third">
        @include('partials.textInput', ['name' => 'email', 'label' => 'E-Mail', 'value' => $user->email, 'required' => true])
    </div>
</div>
<div class="columns">
    <div class="column is-two-thirds">
        <p class="content">
            <strong>Avatar</strong>
        </p>
        <div class="box">
            <article class="media">
                <div class="media-left">
                    <figure class="image">
                        <img src="{{ $user->avatarUrl }}" alt="Avatar">
                    </figure>
                </div>
                <div class="media-content">
                    <p class="content">
                        Your avatar is pulled in from <a href="https://gravatar.com">gravatar.com</a> by your e-mail address, head there to create or update your image.  Gravatars are used by many internet services, allowing you to change it once for many locations.
                    </p>
                </div>
            </article>
        </div>
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
        @include('partials.textInput', ['name' => 'roll_number', 'label' => 'Roll Book No.', 'value' => $user->roll_number])
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

@if (Auth::user()->is_admin)
    <div class="columns">
        <div class="column">
            @include('partials.checkboxInput', ['name' => 'lifetime_member', 'label' => 'User has purchased a lifetime membership', 'value' => $user->lifetime_member])
        </div>
    </div>
    <div class="columns">
        <div class="column">
            @include('partials.checkboxInput', ['name' => 'is_admin', 'label' => 'Administrator: grants all site admin capabilities', 'value' => $user->is_admin])
        </div>
    </div>
@endif